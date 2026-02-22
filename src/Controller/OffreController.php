<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Offre;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class OffreController extends AbstractController
{
    #[Route('/offre/{id}', name: 'offre_detail')]
    public function detail(Offre $offre): Response
    {
        return $this->render('offre/index.html.twig', [
            'offre' => $offre,
        ]);
    }
}
