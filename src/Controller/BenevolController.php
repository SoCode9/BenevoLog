<?php

namespace App\Controller;

use App\Entity\Benevol;
use App\Form\BenevolType;
use App\Repository\BenevolRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/benevol')]
class BenevolController extends AbstractController
{
    #[Route('/', name: 'app_benevol_index', methods: ['GET'])]
    public function index(BenevolRepository $benevolRepository): Response
    {
        return $this->render('benevol/index.html.twig', [
            'benevols' => $benevolRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_benevol_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $benevol = new Benevol();
        $form = $this->createForm(BenevolType::class, $benevol);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($benevol);
            $entityManager->flush();

            return $this->redirectToRoute('app_benevol_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('benevol/new.html.twig', [
            'benevol' => $benevol,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_benevol_show', methods: ['GET'])]
    public function show(Benevol $benevol): Response
    {
        return $this->render('benevol/show.html.twig', [
            'benevol' => $benevol,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_benevol_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Benevol $benevol, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BenevolType::class, $benevol);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_benevol_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('benevol/edit.html.twig', [
            'benevol' => $benevol,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_benevol_delete', methods: ['POST'])]
    public function delete(Request $request, Benevol $benevol, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$benevol->getId(), $request->request->get('_token'))) {
            $entityManager->remove($benevol);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_benevol_index', [], Response::HTTP_SEE_OTHER);
    }
}
