<?php

namespace AdminBundle\Entity;

/**
 * epizy_demandeur_formations
 */
class epizy_demandeur_formations
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $annee;

    /**
     * @var string
     */
    private $ville;
    
    /**
     * @var string
     */
    private $pays;

    /**
     * @var string
     */
    private $diplomes;

    /**
     * @var string
     */
    private $universites;


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
     * Set annee
     *
     * @param string $annee
     *
     * @return epizy_demandeur_formations
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * Get annee
     *
     * @return string
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
     * @return epizy_demandeur_formations
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
     * Set pays
     *
     * @param string $pays
     *
     * @return epizy_demandeur_formations
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
     * Set diplomes
     *
     * @param string $diplomes
     *
     * @return epizy_demandeur_formations
     */
    public function setdiplomes($diplomes)
    {
        $this->diplomes = $diplomes;

        return $this;
    }

    /**
     * Get diplomes
     *
     * @return string
     */
    public function getdiplomes()
    {
        return $this->diplomes;
    }

    /**
     * Set universites
     *
     * @param string $universites
     *
     * @return epizy_demandeur_formations
     */
    public function setuniversites($universites)
    {
        $this->universites = $universites;

        return $this;
    }

    /**
     * Get universites
     *
     * @return string
     */
    public function getuniversites()
    {
        return $this->universites;
    }

    /**
     * @var \AdminBundle\Entity\epizy_diplomes
     */
    private $diplome;

    /**
     * @var \AdminBundle\Entity\epizy_universites
     */
    private $universite;


    /**
     * Set diplome
     *
     * @param \AdminBundle\Entity\epizy_diplomes $diplome
     *
     * @return epizy_demandeur_formations
     */
    public function setDiplome(\AdminBundle\Entity\epizy_diplomes $diplome = null)
    {
        $this->diplome = $diplome;

        return $this;
    }

    /**
     * Get diplome
     *
     * @return \AdminBundle\Entity\epizy_diplomes
     */
    public function getDiplome()
    {
        return $this->diplome;
    }

    /**
     * Set universite
     *
     * @param \AdminBundle\Entity\epizy_universites $universite
     *
     * @return epizy_demandeur_formations
     */
    public function setUniversite(\AdminBundle\Entity\epizy_universites $universite = null)
    {
        $this->universite = $universite;

        return $this;
    }

    /**
     * Get universite
     *
     * @return \AdminBundle\Entity\epizy_universites
     */
    public function getUniversite()
    {
        return $this->universite;
    }
    /**
     * @var \AdminBundle\Entity\epizy_demandeur_emplois
     */
    private $id_demandeur;


    /**
     * Set idDemandeur
     *
     * @param \AdminBundle\Entity\epizy_demandeur_emplois $idDemandeur
     *
     * @return epizy_demandeur_formations
     */
    public function setIdDemandeur(\AdminBundle\Entity\epizy_demandeur_emplois $idDemandeur)
    {
        $this->id_demandeur = $idDemandeur;
        

        return $this;
    }

    /**
     * Get idDemandeur
     *
     * @return \AdminBundle\Entity\epizy_demandeur_emplois
     */
    public function getIdDemandeur()
    {
        return $this->id_demandeur;
    }
    
    /**
     * @var \AdminBundle\Entity\epizy_demandeur_cvs
     */
    private $id_cvs;


    /**
     * Set idCvs
     *
     * @param \AdminBundle\Entity\epizy_demandeur_cvs $idCvs
     *
     * @return epizy_demandeur_formations
     */
    public function setIdCvs(\AdminBundle\Entity\epizy_demandeur_cvs $idCvs = null)
    {
        $this->id_cvs = $idCvs;

        return $this;
    }

    /**
     * Get idCvs
     *
     * @return \AdminBundle\Entity\epizy_demandeur_cvs
     */
    public function getIdCvs()
    {
        return $this->id_cvs;
    }
    /**
     * @var \AdminBundle\Entity\epizy_demandeur_cvs
     */
    private $formation;


    /**
     * Set formation
     *
     * @param \AdminBundle\Entity\epizy_demandeur_cvs $formation
     *
     * @return epizy_demandeur_formations
     */
    public function setFormation(\AdminBundle\Entity\epizy_demandeur_cvs $formation = null)
    {
        $this->formation = $formation;

        return $this;
    }

    /**
     * Get formation
     *
     * @return \AdminBundle\Entity\epizy_demandeur_cvs
     */
    public function getFormation()
    {
        return $this->formation;
    }
    /**
     * @var \AdminBundle\Entity\epizy_villes
     */
    private $ville_id;


    /**
     * Set villeId
     *
     * @param \AdminBundle\Entity\epizy_villes $villeId
     *
     * @return epizy_demandeur_formations
     */
    public function setVilleId(\AdminBundle\Entity\epizy_villes $villeId)
    {
        $this->ville_id = $villeId;
        return $this;
    }

    /**
     * Get villeId
     *
     * @return \AdminBundle\Entity\epizy_villes
     */
    public function getVilleId()
    {
        return $this->ville_id;
    }
}
