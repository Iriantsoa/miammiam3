<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    #[Route('/api/users/firebase/{firebaseUid}', name: 'get_user_by_firebase_uid', methods: ['GET'])]
    public function getUserByFirebaseUid(string $firebaseUid, UserRepository $userRepository): JsonResponse
    {
        $user = $userRepository->findOneBy(['firebaseUid' => $firebaseUid]);

        if (!$user) {
            return new JsonResponse(['error' => 'User not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        return $this->json($user, JsonResponse::HTTP_OK, [], ['groups' => 'user:read']);
    }
}