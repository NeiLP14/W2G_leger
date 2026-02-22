<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    #[Route('/profil/{id}', name: 'user_profile')]
    public function profile(User $user) : Response
    {
        return $this->render('user/profile.html.twig', [
            'user' => $user,
        ]);
    }
}
