<?php

namespace AdminBundle\Entity;

/**
 * epizy_logiciels
 */
class epizy_logiciels
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
     * @var int
     */
    private $etat;

    /**
     * @var datetime
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
     * @return epizy_logiciels
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
     * @param integer $etat
     *
     * @return epizy_logiciels
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return int
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set created
     *
     * @param string $datetime
     *
     * @return epizy_logiciels
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return string
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $demandeur_cvs;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->demandeur_cvs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add demandeurCv
     *
     * @param \AdminBundle\Entity\epizy_demandeur_cvs $demandeurCv
     *
     * @return epizy_logiciels
     */
    public function addDemandeurCv(\AdminBundle\Entity\epizy_demandeur_cvs $demandeurCv)
    {
        $this->demandeur_cvs[] = $demandeurCv;

        return $this;
    }

    /**
     * Remove demandeurCv
     *
     * @param \AdminBundle\Entity\epizy_demandeur_cvs $demandeurCv
     */
    public function removeDemandeurCv(\AdminBundle\Entity\epizy_demandeur_cvs $demandeurCv)
    {
        $this->demandeur_cvs->removeElement($demandeurCv);
    }

    /**
     * Get demandeurCvs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDemandeurCvs()
    {
        return $this->demandeur_cvs;
    }
}
