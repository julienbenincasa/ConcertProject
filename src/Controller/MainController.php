<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CpConcertRepository;

class MainController extends AbstractController
{
    /**
     * @Route("/{page<\d+>?1}", name="home")
     */
    public function home(CpConcertRepository $cpConcertRepository, int $page): Response
    {
        $incomingConcertsIDs = $cpConcertRepository->incomingConcerts($page);
        
        foreach($incomingConcertsIDs as $id) {
            $incomingConcerts[] = $cpConcertRepository->find($id);
        }
    
        return $this->render('main/index.html.twig', [
            'incomingConcerts' => $incomingConcerts
        ]);
    }
}
