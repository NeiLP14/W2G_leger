<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\UnitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UnitController extends AbstractController
{
    #[Route('/unit/configure', name: 'app_unit_configure', methods: ['POST'])]
    public function configure(
        Request $request,
        UnitRepository $unitRepository,
        EntityManagerInterface $em
    ): Response {

        $unitId = $request->request->get('unit_id');
        $nomTemp = $request->request->get('nom_temp');

        $unit = $unitRepository->find($unitId);

        if (!$unit) {
            throw $this->createNotFoundException();
        }

        $unit->setNomTemp($nomTemp);

        $em->flush();

        $this->addFlash('success', 'Unité configurée.');

        return $this->redirectToRoute('reservation_manage', [
            'id' => $unit->getReservation()->getId()
        ]);
    }
}
