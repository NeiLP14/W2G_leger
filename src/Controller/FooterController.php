<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\OffreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class FooterController extends AbstractController
{
    public function footer(OffreRepository $offreRepository): Response
    {
        return $this->render('layout/_footer.html.twig', [
            'offres' => $offreRepository->findAll(),
        ]);
    }
}
