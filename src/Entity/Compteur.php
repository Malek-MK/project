<?php

namespace App\Entity;

use App\Repository\CompteurRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompteurRepository")
 */
class Compteur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $numcomp;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumcomp(): ?int
    {
        return $this->numcomp;
    }

    public function setNumcomp(int $numcomp): self
    {
        $this->numcomp = $numcomp;

        return $this;
    }
}
