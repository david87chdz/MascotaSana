<?php

namespace App\Controller;

use App\Entity\Tratamiento;
use App\Form\TratamientoType;
use App\Repository\TratamientoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/tratamiento')]
class TratamientoController extends AbstractController
{
    #[Route('/', name: 'app_tratamiento_index', methods: ['GET'])]
    public function index(TratamientoRepository $tratamientoRepository): Response
    {
        return $this->render('tratamiento/index.html.twig', [
            'tratamientos' => $tratamientoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_tratamiento_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $tratamiento = new Tratamiento();
        $form = $this->createForm(TratamientoType::class, $tratamiento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($tratamiento);
            $entityManager->flush();

            return $this->redirectToRoute('app_tratamiento_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tratamiento/new.html.twig', [
            'tratamiento' => $tratamiento,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tratamiento_show', methods: ['GET'])]
    public function show(Tratamiento $tratamiento): Response
    {
        return $this->render('tratamiento/show.html.twig', [
            'tratamiento' => $tratamiento,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tratamiento_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tratamiento $tratamiento, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TratamientoType::class, $tratamiento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_tratamiento_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tratamiento/edit.html.twig', [
            'tratamiento' => $tratamiento,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tratamiento_delete', methods: ['POST'])]
    public function delete(Request $request, Tratamiento $tratamiento, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tratamiento->getId(), $request->request->get('_token'))) {
            $entityManager->remove($tratamiento);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_tratamiento_index', [], Response::HTTP_SEE_OTHER);
    }
}
