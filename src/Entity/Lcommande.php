<?php

namespace App\Entity;

use App\Repository\LcommandeRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Commande;
/**
 * @ORM\Entity(repositoryClass="App\Repository\LcommandeRepository")
 */
class Lcommande
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
    private $qte;

    /**
     * @ORM\Column(type="float")
     */
    private $pu;

    /**
     * @ORM\Column(type="integer")
     */
    private $tva;

    /**
     * @ORM\ManyToOne(targetEntity=Produit::class,cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_produit;

   
    /**
     * @ORM\Column(type="string", length=50)
     */
    private $lig;
     /**
     * @ORM\Column(type="string", length=50)
     */
    private $Numc;

    public function getNumc(): ?string
    {
        return $this->Numc;
    }

    public function setNumc(string $Numc): self
    {
        $this->Numc = $Numc;

        return $this;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQte(): ?int
    {
        return $this->qte;
    }

    public function setQte(int $qte): self
    {
        $this->qte = $qte;

        return $this;
    }

    public function getPu(): ?float
    {
        return $this->pu;
    }

    public function setPu(float $pu): self
    {
        $this->pu = $pu;

        return $this;
    }

    public function getTva(): ?int
    {
        return $this->tva;
    }

    public function setTva(int $tva): self
    {
        $this->tva = $tva;

        return $this;
    }
    public function getLig(): ?string
    {
        return $this->lig;
    }

    public function setLig(string $lig): self
    {
        $this->lig = $lig;

        return $this;
    }

    public function getIdProduit(): ?Produit
    {
        return $this->id_produit;
    }

    public function setIdProduit(?Produit $id_produit): self
    {
        $this->id_produit = $id_produit;

        return $this;
    }

    
}
