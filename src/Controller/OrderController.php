<?php

namespace App\Controller;

use App\Entity\Order;
use App\Repository\OrderRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderController extends AbstractController
{
    #[Route('/api/orders/by_user/{userId}', name: 'get_orders_by_user', methods: ['GET'])]
    public function getOrdersByUser(int $userId, OrderRepository $orderRepository): JsonResponse
    {
        $orders = $orderRepository->findBy(['utilisateur' => $userId]);

        if (!$orders) {
            return new JsonResponse(['error' => 'No orders found for this user'], JsonResponse::HTTP_NOT_FOUND);
        }

        return $this->json($orders, JsonResponse::HTTP_OK, [], ['groups' => 'order:read']);
    }
}
