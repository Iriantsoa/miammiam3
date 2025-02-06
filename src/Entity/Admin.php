<?php

namespace App\Entity;

use App\Repository\AdminRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: AdminRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['admin:read']],
    denormalizationContext: ['groups' => ['admin:write']]
)]
class Admin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["admin:read", "admin:write"])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(["admin:read", "admin:write"])]
    private ?string $username = null;

    #[ORM\Column(length: 255)]
    #[Groups(["admin:read", "admin:write"])]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    #[Groups(["admin:read", "admin:write"])]
    private ?string $email = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, options: ["default" => "CURRENT_TIMESTAMP"], nullable: true)]
    #[Groups(["admin:read", "admin:write"])]
    private ?\DateTimeInterface $createdAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;
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
}
