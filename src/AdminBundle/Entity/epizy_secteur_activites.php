<?php

namespace AdminBundle\Entity;

/**
 * epizy_secteur_activites
 */
class epizy_secteur_activites
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

    
    public function __construct()
    {

        $this->created = new \Datetime();

    }

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
     * @return epizy_secteur_activites
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
     * @return epizy_secteur_activites
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
     * @param \DateTime  $created
     *
     * @return epizy_secteur_activites
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
}
