<?php

namespace App\Controller;

use App\Entity\Consulta;
use App\Form\ConsultaType;
use App\Repository\ConsultaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/consulta')]
class ConsultaController extends AbstractController
{
    #[Route('/', name: 'app_consulta_index', methods: ['GET'])]
    public function index(ConsultaRepository $consultaRepository): Response
    {
        return $this->render('consulta/index.html.twig', [
            'consultas' => $consultaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_consulta_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $consultum = new Consulta();
        $form = $this->createForm(ConsultaType::class, $consultum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($consultum);
            $entityManager->flush();

            return $this->redirectToRoute('app_consulta_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('consulta/new.html.twig', [
            'consultum' => $consultum,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_consulta_show', methods: ['GET'])]
    public function show(Consulta $consultum): Response
    {
        return $this->render('consulta/show.html.twig', [
            'consultum' => $consultum,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_consulta_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Consulta $consultum, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ConsultaType::class, $consultum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_consulta_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('consulta/edit.html.twig', [
            'consultum' => $consultum,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_consulta_delete', methods: ['POST'])]
    public function delete(Request $request, Consulta $consultum, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$consultum->getId(), $request->request->get('_token'))) {
            $entityManager->remove($consultum);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_consulta_index', [], Response::HTTP_SEE_OTHER);
    }
}
