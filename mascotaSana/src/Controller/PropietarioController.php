<?php

namespace App\Controller;

use App\Entity\Propietario;
use App\Form\PropietarioType;
use App\Repository\PropietarioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/propietario')]
class PropietarioController extends AbstractController
{
    #[Route('/', name: 'app_propietario_index', methods: ['GET'])]
    public function index(PropietarioRepository $propietarioRepository): Response
    {
        return $this->render('propietario/index.html.twig', [
            'propietarios' => $propietarioRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_propietario_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $propietario = new Propietario();
        $form = $this->createForm(PropietarioType::class, $propietario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($propietario);
            $entityManager->flush();

            return $this->redirectToRoute('app_propietario_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('propietario/new.html.twig', [
            'propietario' => $propietario,
            'form' => $form,
        ]);
    }

    #[Route('/mascotas/{id}', name: 'app_propietario_show', methods: ['GET'])]
    public function show(Propietario $propietario): Response
    {
        return $this->render('propietario/show.html.twig', [
            'propietario' => $propietario,
        ]);
    }

    //Para mostrar las mascotas del propietario
    #[Route('/{id}', name: 'app_propietario_mascotas', methods: ['GET'])]
    public function mascotas(Propietario $propietario): Response
    {
        return $this->render('propietario/mascotas.html.twig', [
            'propietario' => $propietario,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_propietario_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Propietario $propietario, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PropietarioType::class, $propietario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_propietario_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('propietario/edit.html.twig', [
            'propietario' => $propietario,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_propietario_delete', methods: ['POST'])]
    public function delete(Request $request, Propietario $propietario, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$propietario->getId(), $request->request->get('_token'))) {
            $entityManager->remove($propietario);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_propietario_index', [], Response::HTTP_SEE_OTHER);
    }
}
