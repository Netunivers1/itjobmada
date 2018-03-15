<?php

namespace AdminBundle\Entity;

/**
 * epizy_demandeur_experience
 */
class epizy_demandeur_experience
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
     * @var string
     */
    private $moisDebut;

    /**
     * @var string
     */
    private $moisFin;

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
    private $nomEntreprise;

    /**
     * @var string
     */
    private $secteurActivite;

    /**
     * @var int
     */
    private $secteuractiviteId;

    /**
     * @var string
     */
    private $posteOccupe;

    /**
     * @var int
     */
    private $posteoccupeId;

    /**
     * @var string
     */
    private $missionTache;


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
     * @return epizy_demandeur_experience
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
     * @return epizy_demandeur_experience
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
     * Set moisDebut
     *
     * @param string $moisDebut
     *
     * @return epizy_demandeur_experience
     */
    public function setMoisDebut($moisDebut)
    {
        $this->moisDebut = $moisDebut;

        return $this;
    }

    /**
     * Get moisDebut
     *
     * @return string
     */
    public function getMoisDebut()
    {
        return $this->moisDebut;
    }

    /**
     * Set moisFin
     *
     * @param string $moisFin
     *
     * @return epizy_demandeur_experience
     */
    public function setMoisFin($moisFin)
    {
        $this->moisFin = $moisFin;

        return $this;
    }

    /**
     * Get moisFin
     *
     * @return string
     */
    public function getMoisFin()
    {
        return $this->moisFin;
    }

    /**
     * Set annee
     *
     * @param integer $annee
     *
     * @return epizy_demandeur_experience
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
     * @return epizy_demandeur_experience
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
     * @return epizy_demandeur_experience
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
     * @return epizy_demandeur_experience
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
     * Set nomEntreprise
     *
     * @param string $nomEntreprise
     *
     * @return epizy_demandeur_experience
     */
    public function setNomEntreprise($nomEntreprise)
    {
        $this->nomEntreprise = $nomEntreprise;

        return $this;
    }

    /**
     * Get nomEntreprise
     *
     * @return string
     */
    public function getNomEntreprise()
    {
        return $this->nomEntreprise;
    }

    /**
     * Set secteurActivite
     *
     * @param string $secteurActivite
     *
     * @return epizy_demandeur_experience
     */
    public function setSecteurActivite($secteurActivite)
    {
        $this->secteurActivite = $secteurActivite;

        return $this;
    }

    /**
     * Get secteurActivite
     *
     * @return string
     */
    public function getSecteurActivite()
    {
        return $this->secteurActivite;
    }

    /**
     * Set secteuractiviteId
     *
     * @param integer $secteuractiviteId
     *
     * @return epizy_demandeur_experience
     */
    public function setSecteuractiviteId($secteuractiviteId)
    {
        $this->secteuractiviteId = $secteuractiviteId;

        return $this;
    }

    /**
     * Get secteuractiviteId
     *
     * @return int
     */
    public function getSecteuractiviteId()
    {
        return $this->secteuractiviteId;
    }

    /**
     * Set posteOccupe
     *
     * @param string $posteOccupe
     *
     * @return epizy_demandeur_experience
     */
    public function setPosteOccupe($posteOccupe)
    {
        $this->posteOccupe = $posteOccupe;

        return $this;
    }

    /**
     * Get posteOccupe
     *
     * @return string
     */
    public function getPosteOccupe()
    {
        return $this->posteOccupe;
    }

    /**
     * Set posteoccupeId
     *
     * @param integer $posteoccupeId
     *
     * @return epizy_demandeur_experience
     */
    public function setPosteoccupeId($posteoccupeId)
    {
        $this->posteoccupeId = $posteoccupeId;

        return $this;
    }

    /**
     * Get posteoccupeId
     *
     * @return int
     */
    public function getPosteoccupeId()
    {
        return $this->posteoccupeId;
    }

    /**
     * Set missionTache
     *
     * @param string $missionTache
     *
     * @return epizy_demandeur_experience
     */
    public function setMissionTache($missionTache)
    {
        $this->missionTache = $missionTache;

        return $this;
    }

    /**
     * Get missionTache
     *
     * @return string
     */
    public function getMissionTache()
    {
        return $this->missionTache;
    }
}
