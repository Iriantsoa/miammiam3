<?php

namespace App\Entity;

use App\Repository\OrderItemRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    normalizationContext: ['groups' => ['orderItem:read']],
    denormalizationContext: ['groups' => ['orderItem:write']]
)]
#[ORM\Entity(repositoryClass: OrderItemRepository::class)]
class OrderItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["orderItem:read", "orderItem:write"])]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'orderItems')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["orderItem:read", "orderItem:write"])]
    private ?Order $commande = null;

    #[ORM\ManyToOne(targetEntity: Dish::class, inversedBy: 'orderItems')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["orderItem:read", "orderItem:write"])]
    private ?Dish $dish = null;

    #[ORM\Column]
    #[Groups(["orderItem:read", "orderItem:write"])]
    private ?int $quantity = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommande(): ?order
    {
        return $this->commande;
    }

    public function setCommande(?order $commande): static
    {
        $this->commande = $commande;

        return $this;
    }

    public function getDish(): ?Dish
    {
        return $this->dish;
    }

    public function setDish(?Dish $dish): static
    {
        $this->dish = $dish;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }
}
