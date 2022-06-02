<?php

namespace App\Controller;

use App\Entity\Oferta;
use App\Entity\Usuario;
use App\Form\FiltroType;
use App\Form\VenderType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cuatroRuedas")
 */

class CuatroRuedasController extends AbstractController
{
    /**
     * @Route("/inicio", name="app_cuatro_ruedas")
     * Página inicio de la seccion 4 ruedas
     */
    public function index(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        /** @var \App\Entity\Usuario $user */
        $user = $this->getUser();
        $repositorio = $this->getDoctrine()->getRepository(Oferta::class);
        $form = $this->createForm(FiltroType::class);
        $form->handleRequest($request);

        //En caso de rellenar el formulario de filtro, se aplican los filtros a las ofertas

        if ($form->isSubmitted() && $form->isValid()) {
            $precioMin = $form->get('precio_minimo')->getData();
            $precioMax = $form->get('precio_maximo')->getData();
            $potMin = $form->get('potencia_minima')->getData();
            $potMax = $form->get('potencia_maxima')->getData();
            $kmMin = $form->get('km_minimo')->getData();
            $kmMax = $form->get('km_maximo')->getData();
            $plazas = $form->get('plazas')->getData();
            $puertas = $form->get('puertas')->getData();
            $cambio = $form->get('cambio')->getData();
            $combustible = $form->get('combustible')->getData();

            $ofertas = $repositorio->findByFilters($precioMin, $precioMax, $potMin, $potMax, $kmMin, $kmMax, $plazas, $puertas, $cambio, $combustible);
        } else {
            $ofertas = $repositorio->findAll();
        }


        return $this->render('cuatro_ruedas/index.html.twig', [
            'controller_name' => 'CuatroRuedasController',
            'usuario' => $user,
            'form' => $form->createView(),
            'ofertas' => $ofertas
        ]);
    }
    /**
     * @Route("/vende", name="app_vende")
     * Pagina para añadir la oferta de tu coche
     */
    public function vende(Request $request, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        /** @var \App\Entity\Usuario $user */
        $user = $this->getUser();
        $oferta = new Oferta();
        $form = $this->createForm(VenderType::class, $oferta);
        $form->handleRequest($request);

        //Si se rellena el formulario y es correcto, se guardan los datos de la oferta,
        //la imagen se guarda dentro de la carpeta public/imgs/ofertas y se guarda el nombre del archivo en la bbdd
        if ($form->isSubmitted() && $form->isValid()) {
            $oferta->setUsuario($user);
            $imagen = $form->get('foto')->getData();
            $extension = $imagen->guessExtension();
            $nombreImagen = "oferta" . time() . "." . $extension;
            $oferta->setFoto($nombreImagen);
            try {
                $em->persist($oferta);
                $em->flush();
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage());
            }
            $imagen->move("imgs/ofertas", $nombreImagen);
            return $this->redirectToRoute('app_cuatro_ruedas');
        }
        //Si no se envia el formulario, se mostraran las ofertas subidas por el usuario
        $tusOfertas = $this->getDoctrine()->getRepository(Oferta::class)->findByUser($user);


        return $this->render('cuatro_ruedas/venta.html.twig', [
            'controller_name' => 'CuatroRuedasController',
            'usuario' => $user,
            'form' => $form->createView(),
            'ofertas' => $tusOfertas
        ]);
    }
    /**
     * @Route("/oferta/{id}", name="app_oferta")
     * Metodo para mostrar una oferta seleccionada
     */
    public function oferta(Request $request, $id = null): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        /** @var \App\Entity\Usuario $user */
        $user = $this->getUser();

        //en caso de que no se indique id de la oferta, se redirige a la seccion principal de 4 ruedas
        //en caso de que la oferta no exista, enviara la oferta como nulo, y el twig se encarga de indicar que no existe
        if($id==null){
            return $this->redirectToRoute('app_cuatro_ruedas');
        }else{
            $repositorio = $this->getDoctrine()->getRepository(Oferta::class);
            $repositorioUsuario = $this->getDoctrine()->getRepository(Usuario::class);
            $oferta = $repositorio->find($id);
            if($oferta!=null){
                $vendedor = $repositorioUsuario->find($oferta->getUsuario());
            }else{
                $vendedor = null;
            }
            
            return $this->render('cuatro_ruedas/oferta.html.twig', [
                'controller_name' => 'CuatroRuedasController',
                'usuario' => $user,
                'oferta' => $oferta,
                'vendedor' => $vendedor
            ]);
        }
    }
        /**
     * @Route("/borrarOferta/{id}", name="app_borrar_oferta")
     * Método para eliminar una oferta en concreto
     * 
     */
    public function borraPublicacion( EntityManagerInterface $em, $id = null): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        if($id==null){
            return $this->redirectToRoute('app_cuatro_ruedas');
        }else{
            $repositorio = $this->getDoctrine()->getRepository(Oferta::class);
            $oferta = $repositorio->find($id);
            
            
            if($oferta!=null){
                try {
                    $em->remove($oferta);
                    $em->flush();
                } catch (\Exception $e) {
                    throw new \Exception($e->getMessage());
                }
            }
            return $this->redirectToRoute('app_cuatro_ruedas');
        }
    }
}
