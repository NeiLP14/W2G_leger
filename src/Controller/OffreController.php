<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Offre;
use App\Repository\OffreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class OffreController extends AbstractController
{
    #[Route('/offre/{id}', name: 'offre_detail')]
    public function detail(Offre $offre): Response
    {
        return $this->render('offre/detail.html.twig', [
            'offre' => $offre,
        ]);
    }

    #[Route('/offre', name: 'app_offre_index')]
    public function index(OffreRepository $offreRepository): Response
    {
        $offres = $offreRepository->findAll();

        return $this->render('offre/index.html.twig', [
            'offres' => $offres,
        ]);
    }
}
