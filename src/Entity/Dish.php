<?php

namespace App\Entity;

use App\Repository\DishRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    normalizationContext: ['groups' => ['dish:read']],
    denormalizationContext: ['groups' => ['dish:write']]
)]
#[ORM\Entity(repositoryClass: DishRepository::class)]
class Dish
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["dish:read", "dish:write"])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(["dish:read", "dish:write"])]
    private ?string $name = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    #[Groups(["dish:read", "dish:write"])]
    private ?string $price = null;

    #[ORM\Column]
    #[Groups(["dish:read", "dish:write"])]
    private ?int $cookingDuration = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, options: ["default" => "CURRENT_TIMESTAMP"], nullable: true)]
    #[Groups(["dish:read", "dish:write"])]
    private ?\DateTimeInterface $createdAt = null;

    /**
     * @var Collection<int, DishIngredient>
     */
    #[ORM\OneToMany(mappedBy: "dish", targetEntity: DishIngredient::class, cascade: ["persist"])]
    #[Groups(["dish:read", "dish:write"])]
    private Collection $dishIngredients;

    /**
     * @var Collection<int, OrderItem>
     */
    #[ORM\OneToMany(targetEntity: OrderItem::class, mappedBy: 'dish')]
    #[Groups(["dish:read", "dish:write"])]
    private Collection $orderItems;

    /**
     * @var Collection<int, KitchenItem>
     */
    #[ORM\OneToMany(targetEntity: KitchenItem::class, mappedBy: 'dish')]
    #[Groups(["dish:read", "dish:write"])]
    private Collection $kitchenItems;

    public function __construct()
    {
        $this->dishIngredients = new ArrayCollection();
        $this->orderItems = new ArrayCollection();
        $this->kitchenItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getCookingDuration(): ?int
    {
        return $this->cookingDuration;
    }

    public function setCookingDuration(int $cookingDuration): static
    {
        $this->cookingDuration = $cookingDuration;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection<int, DishIngredient>
     */
    public function getDishIngredients(): Collection
    {
        return $this->dishIngredients;
    }

    public function addDishIngredient(DishIngredient $dishIngredient): static
    {
        if (!$this->dishIngredients->contains($dishIngredient)) {
            $this->dishIngredients->add($dishIngredient);
            $dishIngredient->setDish($this);
        }

        return $this;
    }

    public function removeDishIngredient(DishIngredient $dishIngredient): static
    {
        if ($this->dishIngredients->removeElement($dishIngredient)) {
            // set the owning side to null (unless already changed)
            if ($dishIngredient->getDish() === $this) {
                $dishIngredient->setDish(null);
            }
        }

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
            $orderItem->setDish($this);
        }

        return $this;
    }

    public function removeOrderItem(OrderItem $orderItem): static
    {
        if ($this->orderItems->removeElement($orderItem)) {
            // set the owning side to null (unless already changed)
            if ($orderItem->getDish() === $this) {
                $orderItem->setDish(null);
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
            $kitchenItem->setDish($this);
        }

        return $this;
    }

    public function removeKitchenItem(KitchenItem $kitchenItem): static
    {
        if ($this->kitchenItems->removeElement($kitchenItem)) {
            // set the owning side to null (unless already changed)
            if ($kitchenItem->getDish() === $this) {
                $kitchenItem->setDish(null);
            }
        }

        return $this;
    }
}
