<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\ApiProperty;
use App\Repository\IngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: IngredientRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['ingredient:read']],
    denormalizationContext: ['groups' => ['ingredient:write']]
)]
class Ingredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[ApiProperty(identifier: true)]
    #[Groups(["ingredient:read", "ingredient:write"])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(["ingredient:read", "ingredient:write"])]
    private ?string $name = null;

    #[ORM\Column]
    #[Groups(["ingredient:read", "ingredient:write"])]
    private ?int $stockQuantity = null;

    #[ORM\Column(length: 255)]
    #[Groups(["ingredient:read", "ingredient:write"])]
    private ?string $imageUrl = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, options: ["default" => "CURRENT_TIMESTAMP"], nullable: true)]
    #[Groups(["ingredient:read", "ingredient:write"])]
    private ?\DateTimeInterface $createdAt = null;

    /**
     * @var Collection<int, DishIngredient>
     */
    #[ORM\OneToMany(targetEntity: DishIngredient::class, mappedBy: 'ingredient')]
    #[Groups(["ingredient:read", "ingredient:write"])]
    private Collection $dishIngredients;

    public function __construct()
    {
        $this->dishIngredients = new ArrayCollection();
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

    public function getStockQuantity(): ?int
    {
        return $this->stockQuantity;
    }

    public function setStockQuantity(int $stockQuantity): static
    {
        $this->stockQuantity = $stockQuantity;
        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(string $imageUrl): static
    {
        $this->imageUrl = $imageUrl;
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
            $dishIngredient->setIngredient($this);
        }

        return $this;
    }

    public function removeDishIngredient(DishIngredient $dishIngredient): static
    {
        if ($this->dishIngredients->removeElement($dishIngredient)) {
            // set the owning side to null (unless already changed)
            if ($dishIngredient->getIngredient() === $this) {
                $dishIngredient->setIngredient(null);
            }
        }

        return $this;
    }
}
