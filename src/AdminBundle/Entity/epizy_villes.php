<?php

namespace AdminBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * epizy_villes
 */
class epizy_villes
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $libele;

    /**
     * @var string
     */
    private $etat;

    /**
     * @var \DateTime
     */
    private $created;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set libele
     *
     * @param string $libele
     *
     * @return epizy_villes
     */
    public function setLibele($libele)
    {
        $this->libele = $libele;

        return $this;
    }

    /**
     * Get libele
     *
     * @return string
     */
    public function getLibele()
    {
        return $this->libele;
    }

    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return epizy_villes
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return epizy_villes
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    private $formations ;
    public function __construct()
    {
        $this->formations = new ArrayCollection();
    }

    /**
     * Add formation
     *
     * @param \AdminBundle\Entity\epizy_demandeur_formations $formation
     *
     * @return epizy_villes
     */
    public function addFormation(\AdminBundle\Entity\epizy_demandeur_formations $formation)
    {
        $this->formations[] = $formation;
        $formation->setVilleId($this);
        return $this;
    }

    /**
     * Remove formation
     *
     * @param \AdminBundle\Entity\epizy_demandeur_formations $formation
     */
    public function removeFormation(\AdminBundle\Entity\epizy_demandeur_formations $formation)
    {
        $this->formations->removeElement($formation);
    }

    /**
     * Get formations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFormations()
    {
        return $this->formations;
    }
}
