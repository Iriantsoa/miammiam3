<?php

namespace App\Entity;

use App\Repository\DishIngredientRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    normalizationContext: ['groups' => ['dishIngredient:read']],
    denormalizationContext: ['groups' => ['dishIngredient:write']]
)]
#[ORM\Entity(repositoryClass: DishIngredientRepository::class)]
class DishIngredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["dishIngredient:read", "dishIngredient:write", "dish:read"])]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Dish::class, inversedBy: 'dishIngredients')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["dishIngredient:read", "dishIngredient:write"])]
    private ?Dish $dish = null;

    #[ORM\ManyToOne(targetEntity: Ingredient::class)]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["dishIngredient:read", "dishIngredient:write", "dish:read"])]
    private ?Ingredient $ingredient = null;

    #[ORM\Column]
    #[Groups(["dishIngredient:read", "dishIngredient:write", "dish:read"])]
    private ?int $quantity = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIngredient(): ?Ingredient
    {
        return $this->ingredient;
    }

    public function setIngredient(?Ingredient $ingredient): static
    {
        $this->ingredient = $ingredient;

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
