<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    normalizationContext: ['groups' => ['order:read']],
    denormalizationContext: ['groups' => ['order:write']]
)]
#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["order:read", "order:write"])]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'ordersUser')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["order:read", "order:write"])]
    private ?User $utilisateur = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 8, scale: 2)]
    #[Groups(["order:read", "order:write"])]
    private ?string $totalAmount = null;

    #[ORM\Column(length: 20)]
    #[Groups(["order:read", "order:write"])]
    private ?string $status = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, options: ["default" => "CURRENT_TIMESTAMP"], nullable: true)]
    #[Groups(["order:read", "order:write"])]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, options: ["default" => "CURRENT_TIMESTAMP"], nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    /**
     * @var Collection<int, OrderItem>
     */
    #[ORM\OneToMany(mappedBy: 'commande', targetEntity: OrderItem::class, cascade: ['persist'])]
    #[Groups(["order:read", "order:write"])]
    private Collection $orderItems;

    /**
     * @var Collection<int, Payment>
     */
    #[ORM\OneToMany(targetEntity: Payment::class, mappedBy: 'commande')]
    #[Groups(["order:read", "order:write"])]
    private Collection $payments;

    /**
     * @var Collection<int, KitchenItem>
     */
    #[ORM\OneToMany(targetEntity: KitchenItem::class, mappedBy: 'commande')]
    #[Groups(["order:read", "order:write"])]
    private Collection $kitchenItems;

    public function __construct()
    {
        $this->orderItems = new ArrayCollection();
        $this->payments = new ArrayCollection();
        $this->kitchenItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUtilisateur(): ?user
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?user $utilisateur): static
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getTotalAmount(): ?string
    {
        return $this->totalAmount;
    }

    public function setTotalAmount(string $totalAmount): static
    {
        $this->totalAmount = $totalAmount;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, OrderItem>
     */
    public function getOrderItems(): Collection
    {
        return $this->orderItems;
    }

    public function addOrderItem(OrderItem $orderItem): static
    {
        if (!$this->orderItems->contains($orderItem)) {
            $this->orderItems->add($orderItem);
            $orderItem->setCommande($this);
        }

        return $this;
    }

    public function removeOrderItem(OrderItem $orderItem): static
    {
        if ($this->orderItems->removeElement($orderItem)) {
            // set the owning side to null (unless already changed)
            if ($orderItem->getCommande() === $this) {
                $orderItem->setCommande(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Payment>
     */
    public function getPayments(): Collection
    {
        return $this->payments;
    }

    public function addPayment(Payment $payment): static
    {
        if (!$this->payments->contains($payment)) {
            $this->payments->add($payment);
            $payment->setCommande($this);
        }

        return $this;
    }

    public function removePayment(Payment $payment): static
    {
        if ($this->payments->removeElement($payment)) {
            // set the owning side to null (unless already changed)
            if ($payment->getCommande() === $this) {
                $payment->setCommande(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, KitchenItem>
     */
    public function getKitchenItems(): Collection
    {
        return $this->kitchenItems;
    }

    public function addKitchenItem(KitchenItem $kitchenItem): static
    {
        if (!$this->kitchenItems->contains($kitchenItem)) {
            $this->kitchenItems->add($kitchenItem);
            $kitchenItem->setCommande($this);
        }

        return $this;
    }

    public function removeKitchenItem(KitchenItem $kitchenItem): static
    {
        if ($this->kitchenItems->removeElement($kitchenItem)) {
            // set the owning side to null (unless already changed)
            if ($kitchenItem->getCommande() === $this) {
                $kitchenItem->setCommande(null);
            }
        }

        return $this;
    }
}
