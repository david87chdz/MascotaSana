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


    
    #[Route('/consultas', name: 'buscar')]
    public function search(Request $request)
    {
        $form = $this->createForm(ConsultasType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Procesa la búsqueda aquí, por ejemplo, busca usuarios en la base de datos
            $searchTerm = $form->get('nombre')->getData();
            // Realiza la lógica para buscar en tu base de datos o donde sea que estén tus datos
            $searchResults = $userRepository->findByNombre($searchTerm);
        }

        return $this->render('consultas/index.html.twig', [
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

