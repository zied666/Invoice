<?php

namespace FactureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Validation as Assert;

/**
 * Tva
 *
 * @ORM\Table(name="comm_tva")
 * @ORM\Entity
 */
class Tva
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="valeur", type="integer")
     */
    private $valeur;

    /**
     * @var string
     *
     * @ORM\Column(name="compteComptable", type="string", length=20)
     */
    private $compteComptable;

    /**
     * @ORM\OneToMany(targetEntity="Produit", mappedBy="tva")
     */
    protected $produits;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set valeur
     *
     * @param integer $valeur
     * @return Tva
     */
    public function setValeur($valeur)
    {
        $this->valeur=$valeur;

        return $this;
    }

    /**
     * Get valeur
     *
     * @return integer 
     */
    public function getValeur()
    {
        return $this->valeur;
    }

    /**
     * Set compteComptable
     *
     * @param string $compteComptable
     * @return Tva
     */
    public function setCompteComptable($compteComptable)
    {
        $this->compteComptable=$compteComptable;

        return $this;
    }

    /**
     * Get compteComptable
     *
     * @return string 
     */
    public function getCompteComptable()
    {
        return $this->compteComptable;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->produits=new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add produits
     *
     * @param \FactureBundle\Entity\Produit $produits
     * @return Tva
     */
    public function addProduit(\FactureBundle\Entity\Produit $produits)
    {
        $this->produits[]=$produits;

        return $this;
    }

    /**
     * Remove produits
     *
     * @param \FactureBundle\Entity\Produit $produits
     */
    public function removeProduit(\FactureBundle\Entity\Produit $produits)
    {
        $this->produits->removeElement($produits);
    }

    /**
     * Get produits
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProduits()
    {
        return $this->produits;
    }
    
    public function __toString()
    {
        return $this->valeur." %";
    }

}
