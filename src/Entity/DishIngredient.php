<?php

namespace App\Entity;

use App\Repository\DishIngredientRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

#[ApiResource]
#[ORM\Entity(repositoryClass: DishIngredientRepository::class)]
class DishIngredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'dishIngredients')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Dish $dish = null;

    #[ORM\ManyToOne(inversedBy: 'dishIngredients')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ingredient $ingredient = null;

    #[ORM\Column]
    private ?int $quantityRequired = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIngredient(): ?ingredient
    {
        return $this->ingredient;
    }

    public function setIngredient(?ingredient $ingredient): static
    {
        $this->ingredient = $ingredient;

        return $this;
    }

    public function getQuantityRequired(): ?int
    {
        return $this->quantityRequired;
    }

    public function setQuantityRequired(int $quantityRequired): static
    {
        $this->quantityRequired = $quantityRequired;

        return $this;
    }
}
