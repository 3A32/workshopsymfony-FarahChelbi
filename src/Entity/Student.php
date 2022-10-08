<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudentRepository::class)]
class Student
{
    #[ORM\Id]
    #[ORM\Column(length: 10)]
    private ?string $cne = null;

    #[ORM\Column(length: 255)]
    private ?string $username = null;

    public function getNce(): ?string
    {
        return $this->nce;
    }

    public function setNce(?string $nce): void
    {
        $this->nce = $nce;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }
}
