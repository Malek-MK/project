<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommandeRepository")
 */
class Commande
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
    private $numcom;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="commandes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_client;

    /**
     * @ORM\Column(type="float")
     */
    private $tht;

    /**
     * @ORM\Column(type="float")
     */
    private $ttva;

    /**
     * @ORM\Column(type="float")
     */
    private $tttc;

    /**
     * @ORM\OneToMany(targetEntity=Lcommande::class, mappedBy="id_commande")
     */
    private $Id_produit;

     /**
     * @ORM\Column(type="string", length=50)
     */
    private $obs;
    /**
     * @ORM\Column(type="float")
     */
    private $montht;

    /**
     * @ORM\ManyToOne(targetEntity=Livraison::class, inversedBy="id_liv")
     */
    private $id_liv;

    

   

   

    public function __construct()
    {
        $this->Id_produit = new ArrayCollection();
        $this->id_liv = new ArrayCollection();
     
        
    }

   


   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumcom(): ?int
    {
        return $this->numcom;
    }

    public function setNumcom(int $numcom): self
    {
        $this->numcom = $numcom;

        return $this;
    }
   
    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getIdClient(): ?Client
    {
        return $this->id_client;
    }

    public function setIdClient(?Client $id_client): self
    {
        $this->id_client = $id_client;

        return $this;
    }

    public function getTht(): ?float
    {
        return $this->tht;
    }

    public function setTht(float $tht): self
    {
        $this->tht = $tht;

        return $this;
    }

    public function getTtva(): ?float
    {
        return $this->ttva;
    }

    public function setTtva(float $ttva): self
    {
        $this->ttva = $ttva;

        return $this;
    }

    public function getTttc(): ?float
    {
        return $this->tttc;
    }

    public function setTttc(float $tttc): self
    {
        $this->tttc = $tttc;

        return $this;
    }
    public function getObs(): ?string
    {
        return $this->obs;
    }

    public function setObs(string $obs): self
    {
        $this->obs = $obs;

        return $this;
    }
    public function getMontht(): ?float
    {
        return $this->montht;
    }

    public function setMontht(float $montht): self
    {
        $this->montht = $montht;

        return $this;
    }

    /**
     * @return Collection|Lcommande[]
     */
    public function getIdProduit(): Collection
    {
        return $this->Id_produit;
    }

    public function addIdProduit(Lcommande $idProduit): self
    {
        if (!$this->Id_produit->contains($idProduit)) {
            $this->Id_produit[] = $idProduit;
            $idProduit->setIdCommande($this);
        }

        return $this;
    }

    public function removeIdProduit(Lcommande $idProduit): self
    {
        if ($this->Id_produit->removeElement($idProduit)) {
            // set the owning side to null (unless already changed)
            if ($idProduit->getIdCommande() === $this) {
                $idProduit->setIdCommande(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Livraison[]
     */
    public function getIdLiv(): Collection
    {
        return $this->id_liv;
    }

    public function addIdLiv(Livraison $idLiv): self
    {
        if (!$this->id_liv->contains($idLiv)) {
            $this->id_liv[] = $idLiv;
            $idLiv->setCommande($this);
        }

        return $this;
    }

    public function removeIdLiv(Livraison $idLiv): self
    {
        if ($this->id_liv->removeElement($idLiv)) {
            // set the owning side to null (unless already changed)
            if ($idLiv->getCommande() === $this) {
                $idLiv->setCommande(null);
            }
        }

        return $this;
    }

   
/**
    * toString
    * @return string
    */
    public function __toString()
    {
            return $this->id;
    }
   

    

    

   

   
}
