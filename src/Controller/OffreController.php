<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Offre;
use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Repository\OffreRepository;
use App\Repository\UnitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class OffreController extends AbstractController
{
    #[Route('/offre', name: 'app_offre_index')]
    public function index(OffreRepository $offreRepository): Response
    {
        return $this->render('offre/index.html.twig', [
            'offres' => $offreRepository->findAll(),
        ]);
    }

    #[Route('/offre/{id}', name: 'app_offre_detail')]
    public function detail(
        Offre $offre,
        Request $request,
        EntityManagerInterface $em,
        UnitRepository $unitRepository
    ): Response {

        if (!$this->isGranted('ROLE_CUSTOMER') && !$this->isGranted('ROLE_COMPANY')) {
            throw $this->createAccessDeniedException();
        }

        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        // 🔹 Calculs prix
        $monthlyPrice = (float) $offre->getPrice();
        $nbUnits = $offre->getNbUnit();

        $annualPrice = $monthlyPrice * 12;

        if ($offre->getReduction() > 0) {
            $annualPrice = $annualPrice * (1 - ($offre->getReduction() / 100));
        }

        if ($form->isSubmitted() && $form->isValid()) {

            $duration = $form->get('duration')->getData();

            $reservation->setUser($this->getUser());
            $reservation->setOffre($offre);
            $reservation->setDateDeb(new \DateTime());

            $dateFin = (new \DateTime())->modify("+$duration month");
            $reservation->setDateFin($dateFin);

            $units = $unitRepository->findBy(
                ['is_occuped' => false],
                [],
                $offre->getNbUnit()
            );

            if (count($units) < $offre->getNbUnit()) {
                $this->addFlash('error', 'Pas assez d’unités disponibles.');
                return $this->redirectToRoute('app_offre_detail', ['id' => $offre->getId()]);
            }

            foreach ($units as $unit) {
                $unit->setIsOccuped(true);
                $reservation->addUnit($unit);
            }

            $em->persist($reservation);
            $em->flush();

            $this->addFlash('success', 'Commande effectuée avec succès.');

            return $this->redirectToRoute('app_offre_index');
        }

        return $this->render('offre/detail.html.twig', [
            'offre' => $offre,
            'form' => $form->createView(),
            'monthlyPrice' => $monthlyPrice,
            'annualPrice' => $annualPrice,
            'nbUnits' => $nbUnits,
        ]);
    }
}
