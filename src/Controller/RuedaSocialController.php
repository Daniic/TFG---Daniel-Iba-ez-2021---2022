<?php

namespace App\Controller;

use App\Entity\Interactua;
use App\Entity\Publicacion;
use App\Entity\Usuario;
use App\Form\PublicaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/social")
 */
class RuedaSocialController extends AbstractController
{
    /**
     * @Route("/inicio/{nick}", name="app_social")
     * Pagina principal de la red social, si se pasa por parametro un nick 
     * se mostraran todas las publicaciones del usuario
     */
    public function social($nick = null): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        /** @var \App\Entity\Usuario $user */
        $user = $this->getUser();
        $repositorio = $this->getDoctrine()->getRepository(Publicacion::class);

        //Si no se pasa ningun nick, se mostraran las ultimas 20 publicaciones subidas a la plataforma
        if ($nick == null) {
            $publicaciones = $repositorio->findLast();

            //Si se pasa un nick se mostraran todas sus publicaciones
        } else {
            $repositorioUsuario = $this->getDoctrine()->getRepository(Usuario::class);

            $usuario = $repositorioUsuario->findOneBy(array('nick' => $nick));

            $publicaciones = $repositorio->findBy(array('usuario' => $usuario), array('id' => 'DESC'));
        }

        return $this->render('rueda_social/index.html.twig', [
            'controller_name' => 'RuedaSocialController',
            'usuario' => $user,
            'publicaciones' => $publicaciones
        ]);
    }
    /**
     * @Route("/publicacion/{id}", name="app_social_publicacion")
     * Pagina de la publicacion
     */
    public function publicacion(Request $request, EntityManagerInterface $em, $id = null): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        /** @var \App\Entity\Usuario $user */
        $user = $this->getUser();
        if ($id == null) {
            return $this->redirectToRoute('app_social');
        } else {
            $repositorio = $this->getDoctrine()->getRepository(Publicacion::class);
            $publicacion = $repositorio->findOneBy(array('id' => $id));

            //si la publicacion existe  cargaremos los comentarios y los likes de la publicacion
            if (!is_null($publicacion)) {
                $repositorioInteractua = $this->getDoctrine()->getRepository(Interactua::class);
                $comentarios = $repositorioInteractua->findBy(array('publicacion' => $publicacion, 'tipo' => 'comentario'), array('id' => 'DESC'));
                $likes = $repositorioInteractua->findBy(array('publicacion' => $publicacion, 'tipo' => 'like'));
                $likeUsuario = $repositorioInteractua->findOneBy(array('publicacion' => $publicacion, 'tipo' => 'like', 'usuario' => $user));
                $numComentarios = count($comentarios);
                $numLikes = count($likes);
                return $this->render('rueda_social/publicacion.html.twig', [
                    'controller_name' => 'RuedaSocialController',
                    'usuario' => $user,
                    'publicacion' => $publicacion,
                    'comentarios' => $comentarios,
                    'numComentarios' => $numComentarios,
                    'numLikes' => $numLikes,
                    'likeUsuario' => $likeUsuario
                ]);
            }else{
                return $this->render('rueda_social/publicacion.html.twig', [
                    'controller_name' => 'RuedaSocialController',
                    'usuario' => $user,
                    'publicacion' => $publicacion
                    
                ]);
            }
            
        }
    }
    /**
     * @Route("/borraPublicacion/{id}", name="app_borrar_publicacion")
     * Método para eliminar una publicacion en concreto
     * 
     */
    public function borraPublicacion( EntityManagerInterface $em, $id = null): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        if($id==null){
            return $this->redirectToRoute('app_social');
        }else{
            $repositorio = $this->getDoctrine()->getRepository(Publicacion::class);
            $publicacion = $repositorio->find($id);
            
            $repositorioInteractua = $this->getDoctrine()->getRepository(Interactua::class);
            $interactuas = $repositorioInteractua->findBy(array('publicacion' => $publicacion));

            if($publicacion!=null){
                try {
                    foreach ($interactuas as $interactua) {
                        $em->remove($interactua);    
                    }
                    
                    $em->remove($publicacion);
                    $em->flush();
                } catch (\Exception $e) {
                    throw new \Exception($e->getMessage());
                }
            }
            return $this->redirectToRoute('app_social');
        }
    }

    /**
     * @Route("/publicar", name="app_social_publicar")
     * Formulario para publicar una foto
     */
    public function publicar(Request $request, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        /** @var \App\Entity\Usuario $user */
        $user = $this->getUser();

        $publicacion = new Publicacion();
        $form = $this->createForm(PublicaType::class, $publicacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //cogemos el nombre de la foto y lo añadimos a la bbdd
            $imagen = $form->get('foto')->getData();
            $extension = $imagen->guessExtension();
            $nombreImagen = "publicacion" . time() . "." . $extension;
            $publicacion->setFoto($nombreImagen);
            $publicacion->setUsuario($user);
            try {
                $em->persist($publicacion);
                $em->flush();
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage());
            }
            //movemos la foto a la carpeta dentro del proyecto con el nombre que se ha introducido en la bbdd
            $imagen->move("imgs/publicaciones", $nombreImagen);
            return $this->redirectToRoute('app_social');
        }

        return $this->render('rueda_social/publicar.html.twig', [
            'controller_name' => 'RuedaSocialController',
            'usuario' => $user,
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/comenta", name="app_social_comenta")
     * metodo al que llama el formulario de comentar una foto
     */
    public function comenta(EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        /** @var \App\Entity\Usuario $user */
        $user = $this->getUser();

        if (isset($_POST['id']) && isset($_POST['comenta'])) {

            //El id de la publicacion se coge del campo input hidden del formulario
            $id = $_POST['id'];
            $comentario =  $_POST['comenta'];
            $interactua = new Interactua();
            $repositorioPublicacion = $this->getDoctrine()->getRepository(Publicacion::class);
            $publicacion = $repositorioPublicacion->find($id);
            $interactua->setPublicacion($publicacion);
            $interactua->setUsuario($user);
            $interactua->setTexto($comentario);
            $interactua->setTipo('comentario');

            try {
                $em->persist($interactua);
                $em->flush();
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage());
            }
            return $this->redirectToRoute('app_social_publicacion', array('id' => $id));
        } else {
            return $this->redirectToRoute('app_social');
        }
    }

    /**
     * @Route("/busqueda", name="app_social_busqueda")
     * metodo al que llama el formulario de busqueda por nick
     */
    public function buscar(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        if (isset($_POST['busqueda'])) {
            return $this->redirectToRoute('app_social', array('nick' => $_POST['busqueda']));
        } else {
            return $this->redirectToRoute('app_social');
        }
    }
    /**
     * @Route("/like/{id}", name="app_social_like")
     * metodo al que llama el formulario de busqueda por nick
     */
    public function like(EntityManagerInterface $em, $id = null): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        if ($id != null) {
            /** @var \App\Entity\Usuario $user */
            $user = $this->getUser();
            $repositorioPublicacion = $this->getDoctrine()->getRepository(Publicacion::class);
            $publicacion = $repositorioPublicacion->find($id);

            $repositorioInteractua = $this->getDoctrine()->getRepository(Interactua::class);
            $like = $repositorioInteractua->findOneBy(array('publicacion' => $publicacion, 'tipo' => 'like', 'usuario' => $user));
            
            if(is_null($like)){
                $nuevoLike = new Interactua();
                $nuevoLike->setTipo('like');
                $nuevoLike->setPublicacion($publicacion);
                $nuevoLike->setUsuario($user);

                try {
                    $em->persist($nuevoLike);
                    $em->flush();
                } catch (\Exception $e) {
                    throw new \Exception($e->getMessage());
                }
            }else{
                try {
                    $em->remove($like);
                    $em->flush();
                } catch (\Exception $e) {
                    throw new \Exception($e->getMessage());
                }
            }
            return $this->redirectToRoute('app_social_publicacion', array('id' => $id));


        } else {
            return $this->redirectToRoute('app_social');
        }
    }
}
