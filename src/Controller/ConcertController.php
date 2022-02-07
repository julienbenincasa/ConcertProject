<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\CpConcert;
use App\Form\CpConcertType;
use App\Repository\CpConcertRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class ConcertController extends AbstractController
{

    /**
     * Affiche une liste de concert
     * 
     * @return Response
     * 
     * @Route("/list", name="list")
     */
    public function list(CpConcertRepository $cpConcertRepository): Response
    {
        $concerts = $cpConcertRepository->findAll();

        return $this->render('concert/list.html.twig', [
            'concerts' => $concerts,
        ]);
    }

    /**
     * @return Response
     * 
     * Crée un nouveau concert
     * 
     * @Route("/concert/create", name="concert_create")
     * @isGranted("ROLE_ADMIN")
     */
    public function createConcert(Request $request): Response
    {
        $concert = new CpConcert();

        $form = $this->createForm(CpConcertType::class, $concert);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $show = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($concert);
            $entityManager->flush();

            return $this->redirectToRoute('concert_success');
        }

        return $this->render('concert/new.html.twig', [
            'form' => $form->createView() ,
        ]);
    }

    /**
     * @return Response
     * 
     * Concert bien créé
     * 
     * @Route("/concert/success", name="concert_success")
     */
    public function success(Request $request): Response
    {

        return $this->render('concert/success.html.twig');
    }

    /**
     * @return Response
     * 
     * Supprimer un concert
     * 
     * @Route("/delete/concert/{id}", name="concert_delete")
     * @isGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, CpConcert $concert): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($concert);
        $entityManager->flush();

        return $this->redirectToRoute('list');
    }

    /**
     * @Route("/concert/{id}", name="concert_show", methods={"GET"})
     */
    public function show(CpConcert $concert): Response
    {
        return $this->render('concert/show.html.twig', [
            'concert' => $concert,
        ]);
    }

    /**
     * @return Response
     * 
     * Modifier un concert
     * 
     * @Route("/concert/edit/{id}", name="concert_modify")
     * @isGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, CpConcert $concert): Response
    {

        $form = $this->createForm(CpConcertType::class, $concert);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $show = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($concert);
            $entityManager->flush();

            return $this->redirectToRoute('concert_success');
        }

        return $this->render('concert/new.html.twig', [
            'form' => $form->createView() ,
        ]);
    }
}
