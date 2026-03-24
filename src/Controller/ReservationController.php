<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Reservation;
use App\Repository\InterventionRepository;
use App\Repository\TypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

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
    
    #[Route('/reservation/{id}/renew', name: 'app_reservation_renew')]
    public function renew(
        Reservation $reservation,                     // L'entité Reservation correspondante à l'ID passé dans l'URL
        \Doctrine\ORM\EntityManagerInterface $em      // L'EntityManager de Doctrine pour gérer la base de données
    ): Response {

        // Calcul de la durée actuelle de l'abonnement
        // diff() renvoie un objet DateInterval représentant la différence entre dateDeb et dateFin
        $duration = $reservation->getDateDeb()->diff($reservation->getDateFin());

        // Début de la nouvelle période : juste après la fin de l'abonnement actuel
        $newDateDeb = $reservation->getDateFin();

        // Fin de la nouvelle période : on ajoute la même durée que l'abonnement actuel
        // clone pour ne pas modifier la dateFin originale
        $newDateFin = (clone $reservation->getDateFin())->add($duration);

        $reservation->setDateDeb($newDateDeb);
        $reservation->setDateFin($newDateFin);

        // Persistance des modifications en base de données
        $em->flush();

        $this->addFlash('success', 'Abonnement renouvelé avec succès.');

        return $this->redirectToRoute('reservation_manage', [
            'id' => $reservation->getId()   
        ]);
    }
}
