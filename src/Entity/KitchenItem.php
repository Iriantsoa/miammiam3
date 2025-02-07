<?php

namespace App\Entity;

use App\Enum\StatusPlat;
use App\Repository\KitchenItemRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    normalizationContext: ['groups' => ['kitchenItem:read']],
    denormalizationContext: ['groups' => ['kitchenItem:write']]
)]
#[ORM\Entity(repositoryClass: KitchenItemRepository::class)]
class KitchenItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["kitchenItem:read", "kitchenItem:write"])]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'kitchenItems')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Order $commande = null;

    #[ORM\ManyToOne(targetEntity: Dish::class, inversedBy: 'kitchenItems')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["kitchenItem:read", "kitchenItem:write"])]
    private ?Dish $dish = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $startedAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $finishedAt = null;

    #[ORM\Column(length: 20)]
    private ?string $status = null;

    #[ORM\Column]
    #[Groups(["kitchenItem:read", "kitchenItem:write"])]
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

    public function getStartedAt(): ?\DateTimeInterface
    {
        return $this->startedAt;
    }

    public function setStartedAt(?\DateTimeInterface $startedAt): static
    {
        $this->startedAt = $startedAt;

        return $this;
    }

    public function getFinishedAt(): ?\DateTimeInterface
    {
        return $this->finishedAt;
    }

    public function setFinishedAt(?\DateTimeInterface $finishedAt): static
    {
        $this->finishedAt = $finishedAt;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

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
