<?php

namespace AdminBundle\Entity;

/**
 * Epizy_demandeur_formations
 */
class Epizy_demandeur_formations
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $idDemandeur;

    /**
     * @var int
     */
    private $idCvs;

    /**
     * @var int
     */
    private $annee;

    /**
     * @var string
     */
    private $ville;

    /**
     * @var int
     */
    private $villeId;

    /**
     * @var string
     */
    private $pays;

    /**
     * @var string
     */
    private $diplome;

    /**
     * @var int
     */
    private $diplomeId;

    /**
     * @var string
     */
    private $universite;

    /**
     * @var int
     */
    private $universiteId;


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
     * Set idDemandeur
     *
     * @param integer $idDemandeur
     *
     * @return Epizy_demandeur_formations
     */
    public function setIdDemandeur($idDemandeur)
    {
        $this->idDemandeur = $idDemandeur;

        return $this;
    }

    /**
     * Get idDemandeur
     *
     * @return int
     */
    public function getIdDemandeur()
    {
        return $this->idDemandeur;
    }

    /**
     * Set idCvs
     *
     * @param integer $idCvs
     *
     * @return Epizy_demandeur_formations
     */
    public function setIdCvs($idCvs)
    {
        $this->idCvs = $idCvs;

        return $this;
    }

    /**
     * Get idCvs
     *
     * @return int
     */
    public function getIdCvs()
    {
        return $this->idCvs;
    }

    /**
     * Set annee
     *
     * @param integer $annee
     *
     * @return Epizy_demandeur_formations
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * Get annee
     *
     * @return int
     */
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Epizy_demandeur_formations
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set villeId
     *
     * @param integer $villeId
     *
     * @return Epizy_demandeur_formations
     */
    public function setVilleId($villeId)
    {
        $this->villeId = $villeId;

        return $this;
    }

    /**
     * Get villeId
     *
     * @return int
     */
    public function getVilleId()
    {
        return $this->villeId;
    }

    /**
     * Set pays
     *
     * @param string $pays
     *
     * @return Epizy_demandeur_formations
     */
    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return string
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set diplome
     *
     * @param string $diplome
     *
     * @return Epizy_demandeur_formations
     */
    public function setDiplome($diplome)
    {
        $this->diplome = $diplome;

        return $this;
    }

    /**
     * Get diplome
     *
     * @return string
     */
    public function getDiplome()
    {
        return $this->diplome;
    }

    /**
     * Set diplomeId
     *
     * @param integer $diplomeId
     *
     * @return Epizy_demandeur_formations
     */
    public function setDiplomeId($diplomeId)
    {
        $this->diplomeId = $diplomeId;

        return $this;
    }

    /**
     * Get diplomeId
     *
     * @return int
     */
    public function getDiplomeId()
    {
        return $this->diplomeId;
    }

    /**
     * Set universite
     *
     * @param string $universite
     *
     * @return Epizy_demandeur_formations
     */
    public function setUniversite($universite)
    {
        $this->universite = $universite;

        return $this;
    }

    /**
     * Get universite
     *
     * @return string
     */
    public function getUniversite()
    {
        return $this->universite;
    }

    /**
     * Set universiteId
     *
     * @param integer $universiteId
     *
     * @return Epizy_demandeur_formations
     */
    public function setUniversiteId($universiteId)
    {
        $this->universiteId = $universiteId;

        return $this;
    }

    /**
     * Get universiteId
     *
     * @return int
     */
    public function getUniversiteId()
    {
        return $this->universiteId;
    }
}

