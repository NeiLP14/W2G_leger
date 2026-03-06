<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Reservation;
use App\Repository\InterventionRepository;
use App\Repository\TypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ReservationController extends AbstractController
{
    #[Route('/reservation/{id}/manage', name: 'reservation_manage')]
    public function manage(
        Reservation $reservation,
        TypeRepository $typeRepository
    ): Response {

        // Sécurité : empêcher un user d'accéder à une autre réservation
        if ($reservation->getUser() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }

        $types = $typeRepository->findAll();

        return $this->render('reservation/manage.html.twig', [
            'reservation' => $reservation,
            'types' => $types
        ]);
    }

    #[Route('/reservation/{id}/interventions', name: 'reservation_interventions')]
    public function interventions(
        Reservation $reservation
    ): Response {

        if ($reservation->getUser() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }

        // Récupérer les unités de la réservation
        $reservationUnits = $reservation->getUnits();

        // Récupérer toutes les interventions liées à ces unités
        $interventions = [];
        foreach ($reservationUnits as $unit) {
            foreach ($unit->getInterventions() as $intervention) {
                $interventions[$intervention->getId()] = $intervention;
            }
        }

        return $this->render('reservation/interventions.html.twig', [
            'reservation' => $reservation,
            'interventions' => $interventions
        ]);
    }
}
