<?php

namespace AdminBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * epizy_emploi_recherches
 */
class epizy_emploi_recherches
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

    private $cvs_id;

    public function __construct()
    {
        $this->cvs_id = new ArrayCollection();
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
     * @return epizy_emploi_recherches
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
     * @return epizy_emploi_recherches
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
     * @return epizy_emploi_recherches
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

    /**
     * Add cvsId
     *
     * @param \AdminBundle\Entity\epizy_demandeur_cvs $cvsId
     *
     * @return epizy_emploi_recherches
     */
    public function addCvsId(\AdminBundle\Entity\epizy_demandeur_cvs $cvsId)
    {
        $this->cvs_id[] = $cvsId;

        return $this;
    }

    /**
     * Remove cvsId
     *
     * @param \AdminBundle\Entity\epizy_demandeur_cvs $cvsId
     */
    public function removeCvsId(\AdminBundle\Entity\epizy_demandeur_cvs $cvsId)
    {
        $this->cvs_id->removeElement($cvsId);
    }

    /**
     * Get cvsId
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCvsId()
    {
        return $this->cvs_id;
    }
}
