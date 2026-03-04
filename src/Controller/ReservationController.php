<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Reservation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ReservationController extends AbstractController
{
    #[Route('/reservation/{id}/manage', name: 'reservation_manage')]
    public function manage(
        Reservation $reservation
    ): Response {

        // Sécurité : empêcher un user d'accéder à une autre réservation
        if ($reservation->getUser() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }

        return $this->render('reservation/manage.html.twig', [
            'reservation' => $reservation
        ]);
    }
}
