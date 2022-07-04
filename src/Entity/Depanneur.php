<?php

namespace App\Entity;

use App\Repository\DepanneurRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DepanneurRepository::class)]
class Depanneur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'depanneurs')]
    private $Depanneur;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'depanneurs')]
    private $Visiteur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDepanneur(): ?User
    {
        return $this->Depanneur;
    }

    public function setDepanneur(?User $Depanneur): self
    {
        $this->Depanneur = $Depanneur;

        return $this;
    }

    public function getVisiteur(): ?User
    {
        return $this->Visiteur;
    }

    public function setVisiteur(?User $Visiteur): self
    {
        $this->Visiteur = $Visiteur;

        return $this;
    }
}
