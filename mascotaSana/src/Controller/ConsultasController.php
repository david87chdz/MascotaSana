<?php

namespace App\Controller;
use App\Repository\ConsultaRepository;
use App\Repository\MascotaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConsultasController extends AbstractController
{
    #[Route('/consultas', name: 'app_consultas')]
    public function index(ConsultaRepository $consultaRepository, MascotaRepository $mascotaRepository): Response
    {
        return $this->render('consultas/index.html.twig', [
            'controller_name' => 'ConsultasController',
            'mascotass' => $mascotaRepository->mascotasPropietarios(),
            'resultados' => $mascotaRepository->mascotasPorTipo(),
            'razas' => $mascotaRepository->mascotasPorRaza(),
            'consultas' =>$consultaRepository-> consultaPorMascota("Hope"),
        ]);
    }

    /* #[Route('/', name: 'app_consultas_mascotas', methods: ['GET'])]
    public function mascotas(MascotaRepository $mascotaRepository): Response
    {
        return $this->render('/index.html.twig', [
            
        ]);
    } */
}
