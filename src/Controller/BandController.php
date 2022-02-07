<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CpBandRepository;
use App\Repository\CpConcertRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\CpBand;
use App\Form\CpBandType;
use Doctrine\ORM\EntityManagerInterface;

class BandController extends AbstractController
{
    /**
     * @return Response
     * 
     * Crée un nouveau band
     * 
     * @Route("/band/create", name="band_create")
     * @isGranted("ROLE_ADMIN")
     */
    public function createBand(Request $request): Response
    {
        $band = new CpBand();

        $form = $this->createForm(CpBandType::class, $band);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $show = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($band);
            $entityManager->flush();

            return $this->redirectToRoute('band_success');
        }

        return $this->render('band/new.html.twig', [
            'form' => $form->createView() ,
        ]);
    }

    
    /**
     * @Route("/band/{id}", name="band_show", methods={"GET"})
     */
    public function show(CpBandRepository $cpBandsRepository, int $id, CpConcertRepository $cpConcertRepository): Response
    {
        $band = $cpBandsRepository->find($id);
        $members = $band->getMembers();

        $incommingConcertsOfBand = $cpConcertRepository->incomingConcertsByBand($id);

        return $this->render('band/show.html.twig', [
            'controller_name' => 'BandController',
            'band' => $band,
            'members' => $members,
            'incomingConcerts' => $incommingConcertsOfBand
        ]);
    }

    /**
     * @Route("/aa", name="bands_list")
     */
    public function list(CpBandRepository $cpBandRepository): Response
    {
        $bands = $cpBandRepository->findAll();

        return $this->render('band/list.html.twig', [
            'controller_name' => 'BandController',
            'bands' => $bands,
        ]);
    }
    
    
    /**
     * @Route("/band", name="band_index", methods={"GET"})
     */
    public function index(CpBandRepository $cpBandRepository): Response
    {
        return $this->render('band/index.html.twig', [
            'cp_bands' => $cpBandRepository->findAll(),
        ]);
    }

    /**
     * @return Response
     * 
     * Supprimer un band
     * 
     * @Route("/delete/band/{id}", name="band_delete")
     * @isGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, CpBand $band): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($band);
        $entityManager->flush();

        return $this->redirectToRoute('band_index');
    }


    /**
     * @Route("band/{id}/edit", name="band_modify", methods={"GET", "POST"})
     * @isGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, CpBand $cpBand, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CpBandType::class, $cpBand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('band_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('band/edit.html.twig', [
            'cp_band' => $cpBand,
            'form' => $form,
        ]);
    }
}
