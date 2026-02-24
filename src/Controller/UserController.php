<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;

class UserController extends AbstractController
{
    #[Route('/profil/{id}', name: 'user_profile')]
    public function profile(User $user) : Response
    {
        return $this->render('user/profile.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/profil/{id}/edit', name: 'user_profile_edit')]
    public function edit(
        User $user,
        Request $request,
        UserPasswordHasherInterface $hasher,
        EntityManagerInterface $em
    ): Response
    {
        // Sécurité : seul le propriétaire
        if ($this->getUser() !== $user) {
            throw $this->createAccessDeniedException();
        }

        if ($request->isMethod('POST')) {

            $user->setUsername($request->request->get('username'));
            if (in_array('ROLE_CUSTOMER', $user->getRoles(), true)) {
                $user->setNom($request->request->get('nom', $user->getNom()));
                $user->setPrenom($request->request->get('prenom', $user->getPrenom()));
            }

            $oldPassword = $request->request->get('old_password');
            $newPassword = $request->request->get('new_password');

            if ($newPassword) {
                if (!$hasher->isPasswordValid($user, $oldPassword)) {
                    $this->addFlash('error', 'Ancien mot de passe incorrect.');
                } else {
                    $user->setPassword(
                        $hasher->hashPassword($user, $newPassword)
                    );
                }
            }

            $em->flush();

            $this->addFlash('success', 'Profil mis à jour.');

            return $this->redirectToRoute('user_profile', [
                'id' => $user->getId()
            ]);
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user
        ]);
    }
}
