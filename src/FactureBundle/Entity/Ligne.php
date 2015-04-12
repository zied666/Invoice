<?php

namespace FactureBundle\Entity ;

use Doctrine\ORM\Mapping as ORM ;

/**
 * Ligne
 *
 * @ORM\Table(name="comm_ligne")
 * @ORM\Entity
 */
class Ligne
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id ;

    /**
     * @ORM\ManyToOne(targetEntity="Entete", inversedBy="lignes")
     * @ORM\JoinColumn(name="entete_id", referencedColumnName="id")
     */
    protected $entete ;

    /**
     * @ORM\ManyToOne(targetEntity="Ligne", inversedBy="fils")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    protected $parent ;

    /**
     * @ORM\OneToMany(targetEntity="Ligne", mappedBy="parent")
     */
    protected $fils ;

    /**
     * @ORM\ManyToOne(targetEntity="Produit")
     * @ORM\JoinColumn(name="produit_id", referencedColumnName="id")
     */
    protected $produit ;

    /**
     * @var string
     *
     * @ORM\Column(name="designation", type="string", length=255)
     */
    private $designation ;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantite", type="integer")
     */
    private $quantite ;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbrAdulte", type="integer")
     */
    private $nbrAdulte ;

    /**
     * @var string
     *
     * @ORM\Column(name="puhtAdulte", type="decimal", precision=11, scale=3)
     */
    private $puhtAdulte ;

    /**
     * @var string
     *
     * @ORM\Column(name="puttAdulte", type="decimal", precision=11, scale=3)
     */
    private $puttAdulte ;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbrEnfant", type="integer",nullable=true)
     */
    private $nbrEnfant ;

    /**
     * @var string
     *
     * @ORM\Column(name="puhtEnfant", type="decimal", precision=11, scale=3,nullable=true)
     */
    private $puhtEnfant ;

    /**
     * @var string
     *
     * @ORM\Column(name="puttEnfant", type="decimal", precision=11, scale=3,nullable=true)
     */
    private $puttEnfant ;

    /**
     * @var integer
     *
     * @ORM\Column(name="tauxTva", type="integer")
     */
    private $tauxTva ;

    /**
     * @var string
     *
     * @ORM\Column(name="mntTva", type="decimal", precision=11, scale=3)
     */
    private $mntTva ;

    /**
     * @var string
     *
     * @ORM\Column(name="montantTaxable", type="decimal", precision=11, scale=3)
     */
    private $montantTaxable ;

    /**
     * @var string
     *
     * @ORM\Column(name="montantNonTaxable", type="decimal", precision=11, scale=3)
     */
    private $montantNonTaxable ;

    /**
     * @var string
     *
     * @ORM\Column(name="montantRemise", type="decimal", precision=11, scale=3,nullable=true)
     */
    private $montantRemise ;

    /**
     * @var string
     *
     * @ORM\Column(name="fraisDossier", type="decimal", precision=11, scale=3,nullable=true)
     */
    private $fraisDossier ;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id ;
    }

    /**
     * Set designation
     *
     * @param string $designation
     * @return Ligne
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation ;

        return $this ;
    }

    /**
     * Get designation
     *
     * @return string 
     */
    public function getDesignation()
    {
        return $this->designation ;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     * @return Ligne
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite ;

        return $this ;
    }

    /**
     * Get quantite
     *
     * @return integer 
     */
    public function getQuantite()
    {
        return $this->quantite ;
    }

    /**
     * Set nbrAdulte
     *
     * @param integer $nbrAdulte
     * @return Ligne
     */
    public function setNbrAdulte($nbrAdulte)
    {
        $this->nbrAdulte = $nbrAdulte ;

        return $this ;
    }

    /**
     * Get nbrAdulte
     *
     * @return integer 
     */
    public function getNbrAdulte()
    {
        return $this->nbrAdulte ;
    }

    /**
     * Set puhtAdulte
     *
     * @param string $puhtAdulte
     * @return Ligne
     */
    public function setPuhtAdulte($puhtAdulte)
    {
        $this->puhtAdulte = $puhtAdulte ;

        return $this ;
    }

    /**
     * Get puhtAdulte
     *
     * @return string 
     */
    public function getPuhtAdulte()
    {
        return $this->puhtAdulte ;
    }

    /**
     * Set puttAdulte
     *
     * @param string $puttAdulte
     * @return Ligne
     */
    public function setPuttAdulte($puttAdulte)
    {
        $this->puttAdulte = $puttAdulte ;

        return $this ;
    }

    /**
     * Get puttAdulte
     *
     * @return string 
     */
    public function getPuttAdulte()
    {
        return $this->puttAdulte ;
    }

    /**
     * Set nbrEnfant
     *
     * @param integer $nbrEnfant
     * @return Ligne
     */
    public function setNbrEnfant($nbrEnfant)
    {
        $this->nbrEnfant = $nbrEnfant ;

        return $this ;
    }

    /**
     * Get nbrEnfant
     *
     * @return integer 
     */
    public function getNbrEnfant()
    {
        return $this->nbrEnfant ;
    }

    /**
     * Set puhtEnfant
     *
     * @param string $puhtEnfant
     * @return Ligne
     */
    public function setPuhtEnfant($puhtEnfant)
    {
        $this->puhtEnfant = $puhtEnfant ;

        return $this ;
    }

    /**
     * Get puhtEnfant
     *
     * @return string 
     */
    public function getPuhtEnfant()
    {
        return $this->puhtEnfant ;
    }

    /**
     * Set puttEnfant
     *
     * @param string $puttEnfant
     * @return Ligne
     */
    public function setPuttEnfant($puttEnfant)
    {
        $this->puttEnfant = $puttEnfant ;

        return $this ;
    }

    /**
     * Get puttEnfant
     *
     * @return string 
     */
    public function getPuttEnfant()
    {
        return $this->puttEnfant ;
    }

    /**
     * Set tauxTva
     *
     * @param integer $tauxTva
     * @return Ligne
     */
    public function setTauxTva($tauxTva)
    {
        $this->tauxTva = $tauxTva ;

        return $this ;
    }

    /**
     * Get tauxTva
     *
     * @return integer 
     */
    public function getTauxTva()
    {
        return $this->tauxTva ;
    }

    /**
     * Set mntTva
     *
     * @param string $mntTva
     * @return Ligne
     */
    public function setMntTva($mntTva)
    {
        $this->mntTva = $mntTva ;

        return $this ;
    }

    /**
     * Get mntTva
     *
     * @return string 
     */
    public function getMntTva()
    {
        return $this->mntTva ;
    }

    /**
     * Set montantTaxable
     *
     * @param string $montantTaxable
     * @return Ligne
     */
    public function setMontantTaxable($montantTaxable)
    {
        $this->montantTaxable = $montantTaxable ;

        return $this ;
    }

    /**
     * Get montantTaxable
     *
     * @return string 
     */
    public function getMontantTaxable()
    {
        return $this->montantTaxable ;
    }

    /**
     * Set montantNonTaxable
     *
     * @param string $montantNonTaxable
     * @return Ligne
     */
    public function setMontantNonTaxable($montantNonTaxable)
    {
        $this->montantNonTaxable = $montantNonTaxable ;

        return $this ;
    }

    /**
     * Get montantNonTaxable
     *
     * @return string 
     */
    public function getMontantNonTaxable()
    {
        return $this->montantNonTaxable ;
    }

    /**
     * Set montantRemise
     *
     * @param string $montantRemise
     * @return Ligne
     */
    public function setMontantRemise($montantRemise)
    {
        $this->montantRemise = $montantRemise ;

        return $this ;
    }

    /**
     * Get montantRemise
     *
     * @return string 
     */
    public function getMontantRemise()
    {
        return $this->montantRemise ;
    }

    /**
     * Set fraisDossier
     *
     * @param string $fraisDossier
     * @return Ligne
     */
    public function setFraisDossier($fraisDossier)
    {
        $this->fraisDossier = $fraisDossier ;

        return $this ;
    }

    /**
     * Get fraisDossier
     *
     * @return string 
     */
    public function getFraisDossier()
    {
        return $this->fraisDossier ;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fils = new \Doctrine\Common\Collections\ArrayCollection() ;
    }

    /**
     * Set entete
     *
     * @param \FactureBundle\Entity\Entete $entete
     * @return Ligne
     */
    public function setEntete(\FactureBundle\Entity\Entete $entete = null)
    {
        $this->entete = $entete ;

        return $this ;
    }

    /**
     * Get entete
     *
     * @return \FactureBundle\Entity\Entete 
     */
    public function getEntete()
    {
        return $this->entete ;
    }

    /**
     * Set parent
     *
     * @param \FactureBundle\Entity\Ligne $parent
     * @return Ligne
     */
    public function setParent(\FactureBundle\Entity\Ligne $parent = null)
    {
        $this->parent = $parent ;

        return $this ;
    }

    /**
     * Get parent
     *
     * @return \FactureBundle\Entity\Ligne 
     */
    public function getParent()
    {
        return $this->parent ;
    }

    /**
     * Add fils
     *
     * @param \FactureBundle\Entity\Ligne $fils
     * @return Ligne
     */
    public function addFil(\FactureBundle\Entity\Ligne $fils)
    {
        $this->fils[] = $fils ;

        return $this ;
    }

    /**
     * Remove fils
     *
     * @param \FactureBundle\Entity\Ligne $fils
     */
    public function removeFil(\FactureBundle\Entity\Ligne $fils)
    {
        $this->fils->removeElement($fils) ;
    }

    /**
     * Get fils
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFils()
    {
        return $this->fils ;
    }

    /**
     * Set produit
     *
     * @param \FactureBundle\Entity\Produit $produit
     * @return Ligne
     */
    public function setProduit(\FactureBundle\Entity\Produit $produit = null)
    {
        $this->produit = $produit ;

        return $this ;
    }

    /**
     * Get produit
     *
     * @return \FactureBundle\Entity\Produit 
     */
    public function getProduit()
    {
        return $this->produit ;
    }

    public function __toString()
    {
        return $this->designation ;
    }

    public function calculeTva()
    {
        $this->mntTva = $this->montantTaxable-(($this->montantTaxable*100)/($this->tauxTva+100)) ;

        return $this ;
    }

    public function calculMontantNonTaxable()
    {
        $this->setMontantNonTaxable(
                (
                ($this->getPuhtAdulte() * $this->getNbrAdulte()) +
                ($this->getPuhtEnfant() + $this->getNbrEnfant())
                ) * $this->getQuantite()) ;

        return $this ;
    }

    public function calculMontantTaxable()
    {
        $this->setMontantTaxable(
                ((($this->getPuttAdulte() * $this->getNbrAdulte()) + ($this->getPuttEnfant() + $this->getNbrEnfant())) * $this->getQuantite()) -
                $this->montantNonTaxable
        ) ;

        return $this ;
    }
    
    public function getTotal()
    {
        return $this->montantNonTaxable+$this->montantTaxable+$this->fraisDossier-$this->montantRemise;
    }

}
