<?php

namespace App\Controller;
use App\Repository\ConsultaRepository;
use App\Repository\MascotaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

//Estas importarlas
use Symfony\Component\HttpFoundation\Request;
use App\Repository\UserRepository;


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


    
    #[Route('/buscar-consultas', name: 'buscar_consultas', methods: ['GET', 'POST'])]
    public function search(Request $request,  $consultaRepository): Response
    {
        $form = $this->createForm(ConsultasType::class);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $searchTerm = $form->get('nombre')->getData(); // Suponiendo que 'nombre' es el campo de búsqueda en tu formulario
    
            // Realiza la lógica para buscar en tu base de datos o donde sea que estén tus datos
            $searchResults = $consultaRepository->consultaPorMascota($searchTerm);
    
            // Aquí deberías devolver los resultados de la búsqueda a la vista, en lugar de redirigir
            return $this->render('consultas/new.html.twig', [
                
                'form' => $form->createView(),
            ]);
        }
    
        return $this->render('consultas/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
}

    /* #[Route('/', name: 'app_consultas_mascotas', methods: ['GET'])]
    public function mascotas(MascotaRepository $mascotaRepository): Response
    {
        return $this->render('/index.html.twig', [
            
        ]);
    } */

