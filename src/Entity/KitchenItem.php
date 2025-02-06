<?php

namespace App\Entity;

use App\Enum\StatusPlat;
use App\Repository\KitchenItemRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
#[ApiResource]
#[ORM\Entity(repositoryClass: KitchenItemRepository::class)]
class KitchenItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'kitchenItems')]
    #[ORM\JoinColumn(nullable: false)]
    private ?order $commande = null;

    #[ORM\ManyToOne(inversedBy: 'kitchenItems')]
    #[ORM\JoinColumn(nullable: false)]
    private ?dish $dish = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $startedAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $finishedAt = null;

    #[ORM\Column(type: 'string', enumType: StatusPlat::class, length: 20)]
    private ?string $status = null;

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

    public function getDish(): ?dish
    {
        return $this->dish;
    }

    public function setDish(?dish $dish): static
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
}
