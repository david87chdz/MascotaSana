<?php

namespace App\Controller;

use App\Entity\Raza;
use App\Form\RazaType;
use App\Repository\RazaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/raza')]
class RazaController extends AbstractController
{
    #[Route('/', name: 'app_raza_index', methods: ['GET'])]
    public function index(RazaRepository $razaRepository): Response
    {
        return $this->render('raza/index.html.twig', [
            'razas' => $razaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_raza_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $raza = new Raza();
        $form = $this->createForm(RazaType::class, $raza);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($raza);
            $entityManager->flush();

            return $this->redirectToRoute('app_raza_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('raza/new.html.twig', [
            'raza' => $raza,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_raza_show', methods: ['GET'])]
    public function show(Raza $raza): Response
    {
        return $this->render('raza/show.html.twig', [
            'raza' => $raza,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_raza_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Raza $raza, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RazaType::class, $raza);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_raza_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('raza/edit.html.twig', [
            'raza' => $raza,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_raza_delete', methods: ['POST'])]
    public function delete(Request $request, Raza $raza, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$raza->getId(), $request->request->get('_token'))) {
            $entityManager->remove($raza);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_raza_index', [], Response::HTTP_SEE_OTHER);
    }
}
