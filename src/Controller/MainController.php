<?php

namespace App\Controller;

use App\Entity\Articulo;
use App\Entity\Califica;
use App\Entity\Interactua;
use App\Entity\Usuario;
use App\Form\AnyadeArticuloType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Form\RegistroType;
use App\Repository\ArticuloRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\Request;

class MainController extends AbstractController
{

    /**
     * @Route("/logout", name="app_logout")
     * Método para cerrar sesión
     */
    public function logout(): void
    {
        throw new \Exception('Error al cerrar sesión');
    }

    /**
     * @Route("/login", name="app_login")
     * Método para iniciar sesión
     */
    public function index(AuthenticationUtils $au): Response
    {

        $error = $au->getLastAuthenticationError();
        $ultimousuario = $au->getLastUsername();

        return $this->render('main/login.html.twig', [
            'controller_name' => 'MainController',
            'error' => $error,
            'ultimo_usuario' => $ultimousuario
        ]);
    }

    /**
     * @Route("/registro", name="app_registro")
     * Método para crear una cuenta
     */
    public function registro(UserPasswordHasherInterface $ph, Request $request, EntityManagerInterface $em): Response
    {
        $usuario = new Usuario();
        $form = $this->createForm(RegistroType::class, $usuario);
        $form->handleRequest($request);

        //si se rellena el formulario correctamente, las contraseñas coinciden y
        //el email cumple la sintaxis, se crea un usuario basico y redirecciona al login
        //en caso contrario muestra el error correspondiente
        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('password')->getData() == $form->get('repetir_password')->getData()) {
                if (1 == preg_match('/[A-z0-9\\._-]+@[A-z0-9]+.[A-z]+/', $form->get('email')->getData())) {
                    $a = [];
                    $usuario->setRoles($a);
                    $hashedPasword = $ph->hashPassword(
                        $usuario,
                        $form->get('password')->getData()
                    );
                    $usuario->setPassword($hashedPasword);
                    try {
                        $em->persist($usuario);
                        $em->flush();
                    } catch (\Exception $e) {
                        if ($e->getCode() == 1062) {
                            return $this->render('main/registro.html.twig', [
                                'controller_name' => 'MainController',
                                'form' => $form->createView(),
                                'error' => 'Ya existe un usuario con ese email'
                            ]);
                        }
                        return new Response("Esto ha petao, Error: " . $e->getCode());
                    }
                    return $this->redirectToRoute('app_login');
                } else {
                    return $this->render('main/registro.html.twig', [
                        'controller_name' => 'MainController',
                        'form' => $form->createView(),
                        'error' => 'La sintaxis del email no es correcta'
                    ]);
                }
            } else {
                return $this->render('main/registro.html.twig', [
                    'controller_name' => 'MainController',
                    'form' => $form->createView(),
                    'error' => 'Las contraseñas no coinciden'
                ]);
            }
        } else {
            return $this->render('main/registro.html.twig', [
                'controller_name' => 'MainController',
                'form' => $form->createView(),
                'error' => null
            ]);
        }
    }

    /**
     * @Route("/articulo/{id}/{puntuacion}", name="app_articulo")
     * Método para mostrar un articulo en concreto
     * Puntuacion: -1 => dislike, 1 => like
     */
    public function articulo(EntityManagerInterface $em, $id = null, $puntuacion = null): Response
    {
        /** @var \App\Entity\Usuario $user */
        $user = $this->getUser();

        //en caso de que no exista el id, se redirecciona a la pagina inicio
        if ($id == null) {
            return $this->redirectToRoute('app_inicio');
        } else {

            //en caso de que la puntuacion sea distinta a like o dislike, siempre será nula
            if ($puntuacion != 1 && $puntuacion != -1) {
                $puntuacion = null;
            }
            $repositorio = $this->getDoctrine()->getRepository(Articulo::class);
            $articulo = $repositorio->find($id);
            if (!is_null($articulo)) {
                $repositorioCalifica = $this->getDoctrine()->getRepository(Califica::class);

                // si se ha puntuado el articulo, se comprueba que el usuario no haya puntuado el articulo antes,
                // y se recalcula la puntuación en base a ello y a la nueva puntuación
                if ($puntuacion != null) {

                    $califica = $repositorioCalifica->findOneBy(["articulo" => $articulo, "usuario" => $user]);
                    if (!is_null($califica)) {
                        if ($califica->getPuntuacion() == 1) {
                            $nuevaPuntuacion = $articulo->getPuntuacion() - 1;
                        } else {
                            $nuevaPuntuacion = $articulo->getPuntuacion() + 1;
                        }

                        $califica->setPuntuacion($puntuacion);
                        $nuevaPuntuacion = ($puntuacion == -1) ? $nuevaPuntuacion - 1 : $nuevaPuntuacion + $puntuacion;
                    } else {

                        $califica = new Califica();
                        $califica->setPuntuacion($puntuacion);
                        $califica->setUsuario($user);
                        $califica->setArticulo($articulo);
                        $nuevaPuntuacion = ($puntuacion == -1) ? $articulo->getPuntuacion() - 1 : $articulo->getPuntuacion() + $puntuacion;
                    }
                    $articulo->setPuntuacion($nuevaPuntuacion);

                    try {
                        $em->persist($articulo);
                        $em->persist($califica);
                        $em->flush();
                    } catch (\Exception $e) {
                        
                        throw new \Exception($e->getMessage());
                    }
                }

                $calificaUsuario = $repositorioCalifica->findOneBy(["articulo" => $articulo, "usuario" => $user]);

                return $this->render('inicio/articulo.html.twig', [
                    'controller_name' => 'MainController',
                    'usuario' => $user,
                    'articulo' => $articulo,
                    'califica' => $calificaUsuario
                ]);
            }else{
                return $this->render('inicio/articulo.html.twig', [
                    'controller_name' => 'MainController',
                    'usuario' => $user,
                    'articulo' => $articulo
                ]);
            }
        }
    }
    /**
     * @Route("/borraArticulo/{id}", name="app_borrar_articulo")
     * Método para eliminar un articulo en concreto
     * 
     */
    public function borraArticulo(EntityManagerInterface $em, $id = null): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        if ($id == null) {
            return $this->redirectToRoute('app_inicio');
        } else {
            $repositorio = $this->getDoctrine()->getRepository(Articulo::class);
            $articulo = $repositorio->find($id);

            $repositorioCalifica = $this->getDoctrine()->getRepository(Califica::class);
            $calificas = $repositorioCalifica->findBy(array('articulo' => $articulo));

            if ($articulo != null) {
                try {
                    foreach ($calificas as $califica) {
                        $em->remove($califica);
                    }

                    $em->remove($articulo);
                    $em->flush();
                } catch (\Exception $e) {
                    throw new \Exception($e->getMessage());
                }
            }
            return $this->redirectToRoute('app_inicio');
        }
    }

    /**
     * @Route("/{pagina}", name="app_inicio")
     * Método de la pagina principal
     */
    public function inicio(Request $request, EntityManagerInterface $em, $pagina = 1): Response
    {

        /** @var \App\Entity\Usuario $user */
        $user = $this->getUser();
        $repositorio = $this->getDoctrine()->getRepository(Articulo::class);

        //articulos que se mostrarán por pagina
        $articulosF1PorPagina = 5;
        $articulosNoticiasPorPagina = 3;
        //en caso de que se introduzca un valor no numerico, se mostrará la primera página
        if (!\is_numeric($pagina)) {
            $pagina = 1;
        }

        //Se buscan los articulos a mostrar en base a la pagina que se va a mostrar, y el numero de articulos por pagina
        $articulosF1 = $repositorio->findLastByType("f1", $articulosF1PorPagina, $pagina);
        $articulosNoticias = $repositorio->findLastByType("noticia", $articulosNoticiasPorPagina, 1);

        //Se guarda el numero total de paginas para que el twig no muestre el boton siguiente en la ultima pagina
        $totalPaginas = $repositorio->getMaxPages($articulosF1PorPagina);

        $articulo = new Articulo();
        $form = $this->createForm(AnyadeArticuloType::class, $articulo);
        $form->handleRequest($request);


        // Si un admin rellena el formulario de añadir articulo, se añade el articulo y redirecciona a la primera pagina,
        // el nuevo articulo deberia mostrarse el primero
        if ($form->isSubmitted() && $form->isValid()) {

            $imagen = $form->get('archivo')->getData();
            $extension = $imagen->guessExtension();
            $nombreImagen = "articulo" . time() . "." . $extension;
            $articulo->setFoto($nombreImagen);
            $articulo->setUsuario($user);
            $articulo->setPuntuacion(0);
            try {
                $em->persist($articulo);
                $em->flush();
            } catch (\Exception $e) {

                if($e->getCode()){
                    return $this->render('inicio/inicio.html.twig', [
                        'controller_name' => 'MainController',
                        'usuario' => $user,
                        'form' => $form->createView(),
                        'articulosF1' => $articulosF1,
                        'articulosNoticia' => $articulosNoticias,
                        'pagina' => $pagina,
                        'pagTotales' => $totalPaginas,
                        'error' => 'No puedes exceder los 255 caracteres'
                    ]);
                }

                throw new \Exception($e->getMessage());
            }
            $imagen->move("imgs/articulos", $nombreImagen);

            return $this->redirectToRoute('app_inicio');
        } else {
            return $this->render('inicio/inicio.html.twig', [
                'controller_name' => 'MainController',
                'usuario' => $user,
                'form' => $form->createView(),
                'articulosF1' => $articulosF1,
                'articulosNoticia' => $articulosNoticias,
                'pagina' => $pagina,
                'pagTotales' => $totalPaginas,
                'error' => null
            ]);
        }
    }
    /**
     * @Route("/inicio/anyadeAdmin", name="app_registro_admin")
     * Método para crear una cuenta admin
     */
    public function registroAdmin(UserPasswordHasherInterface $ph, Request $request, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        /** @var \App\Entity\Usuario $user */
        $user = $this->getUser();
        $usuario = new Usuario();
        $form = $this->createForm(RegistroType::class, $usuario);
        $form->handleRequest($request);

        //si se rellena el formulario correctamente, las contraseñas coinciden y
        //el email cumple la sintaxis, se crea un usuario basico y redirecciona al login
        //en caso contrario muestra el error correspondiente
        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('password')->getData() == $form->get('repetir_password')->getData()) {
                if (1 == preg_match('/[A-z0-9\\._-]+@[A-z0-9]+.[A-z]+/', $form->get('email')->getData())) {
                    $a = ['ROLE_ADMIN'];
                    $usuario->setRoles($a);
                    $hashedPasword = $ph->hashPassword(
                        $usuario,
                        $form->get('password')->getData()
                    );
                    $usuario->setPassword($hashedPasword);
                    try {
                        $em->persist($usuario);
                        $em->flush();
                    } catch (\Exception $e) {
                        if ($e->getCode() == 1062) {
                            return $this->render('inicio/registroAdmin.html.twig', [
                                'controller_name' => 'MainController',
                                'form' => $form->createView(),
                                'error' => 'Ya existe un usuario con ese email',
                                'usuario' => $user
                            ]);
                        }
                        return new Response("Esto ha petao, Error: " . $e->getCode());
                    }
                    return $this->redirectToRoute('app_inicio');
                } else {
                    return $this->render('inicio/registroAdmin.html.twig', [
                        'controller_name' => 'MainController',
                        'form' => $form->createView(),
                        'error' => 'La sintaxis del email no es correcta',
                        'usuario' => $user
                    ]);
                }
            } else {
                return $this->render('inicio/registroAdmin.html.twig', [
                    'controller_name' => 'MainController',
                    'form' => $form->createView(),
                    'error' => 'Las contraseñas no coinciden',
                    'usuario' => $user
                ]);
            }
        } else {
            return $this->render('inicio/registroAdmin.html.twig', [
                'controller_name' => 'MainController',
                'form' => $form->createView(),
                'error' => null,
                'usuario' => $user
            ]);
        }
    }
}
