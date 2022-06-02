<?php

namespace App\Controller;

use App\Entity\Partida;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/aTodaRueda")
 */
class ATodaRuedaController extends AbstractController
{
    /**
     * @Route("/inicio", name="app_a_toda_rueda")
     */
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        /** @var \App\Entity\Usuario $user */
        $user = $this->getUser();
        return $this->render('a_toda_rueda/index.html.twig', [
            'controller_name' => 'ATodaRuedaController',
            'usuario' => $user
        ]);
    }
    /**
     * @Route("/guardar/{puntuacion}", name="app_a_toda_rueda_guardar")
     */
    public function guardar($puntuacion = null, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        /** @var \App\Entity\Usuario $user */
        $user = $this->getUser();
        if ($puntuacion != null) {
            $partida = new Partida();
            $partida->setUsuario($user);
            $partida->setPuntuacion($puntuacion);
            try {
                $em->persist($partida);
                $em->flush();
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage());
            }
            return $this->redirectToRoute('app_a_toda_rueda_ranking');
        } else {
            return $this->redirectToRoute('app_a_toda_rueda');
        }
    }
    /**
     * @Route("/ranking", name="app_a_toda_rueda_ranking")
     */
    public function ranking(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        /** @var \App\Entity\Usuario $user */
        $user = $this->getUser();
        $repositorio = $this->getDoctrine()->getRepository(Partida::class);
        $partidas = $repositorio->findTop10();
        
        return $this->render('a_toda_rueda/ranking.html.twig', [
            'controller_name' => 'ATodaRuedaController',
            'usuario' => $user,
            'partidas' => $partidas
        ]);
    }
}
