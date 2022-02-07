<?php

namespace App\Controller;

use App\Entity\CpMember;
use App\Form\CpMemberType;
use App\Repository\CpMemberRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/member")
 */
class MemberController extends AbstractController
{
    /**
     * @Route("/", name="member_index", methods={"GET"})
     */
    public function index(CpMemberRepository $cpMemberRepository): Response
    {
        return $this->render('member/index.html.twig', [
            'cp_members' => $cpMemberRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="member_new", methods={"GET", "POST"})
     * @isGranted("ROLE_ADMIN")
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $cpMember = new CpMember();
        $form = $this->createForm(CpMemberType::class, $cpMember);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($cpMember);
            $entityManager->flush();

            return $this->redirectToRoute('member_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('member/new.html.twig', [
            'cp_member' => $cpMember,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="member_show", methods={"GET"})
     * @isGranted("ROLE_ADMIN")
     */
    public function show(CpMember $cpMember): Response
    {
        return $this->render('member/show.html.twig', [
            'cp_member' => $cpMember,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="member_edit", methods={"GET", "POST"})
     * @isGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, CpMember $cpMember, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CpMemberType::class, $cpMember);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('member_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('member/edit.html.twig', [
            'cp_member' => $cpMember,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="member_delete", methods={"POST"})
     * @isGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, CpMember $cpMember, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cpMember->getId(), $request->request->get('_token'))) {
            $entityManager->remove($cpMember);
            $entityManager->flush();
        }

        return $this->redirectToRoute('member_index', [], Response::HTTP_SEE_OTHER);
    }
}
