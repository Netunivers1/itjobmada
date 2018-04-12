<?php

namespace AdminBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;

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
     * @var string
     */
    private $posteOccupe;

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

    /**
     * @var \AdminBundle\Entity\epizy_demandeur_emplois
     */
    private $id_demandeur;
    /**
     * Set idDemandeur
     *
     * @param \AdminBundle\Entity\epizy_demandeur_emplois $idDemandeur
     *
     * @return epizy_demandeur_experience
     */
    public function setIdDemandeur(\AdminBundle\Entity\epizy_demandeur_emplois $idDemandeur = null)
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
    private $id_cv;


    /**
     * Set idCv
     *
     * @param \AdminBundle\Entity\epizy_demandeur_cvs $idCv
     *
     * @return epizy_demandeur_experience
     */
    public function setIdCv(\AdminBundle\Entity\epizy_demandeur_cvs $idCv = null)
    {
        $this->id_cv = $idCv;
        return $this;
    }

    /**
     * Get idCv
     *
     * @return \AdminBundle\Entity\epizy_demandeur_cvs
     */
    public function getIdCv()
    {
        return $this->id_cv;
    }
    /**
     * @var \AdminBundle\Entity\epizy_poste_occupes
     */
    private $posteoccupe_id;


    /**
     * Set posteoccupeId
     *
     * @param \AdminBundle\Entity\epizy_poste_occupes $posteoccupeId
     *
     * @return epizy_demandeur_experience
     */
    public function setPosteoccupeId(\AdminBundle\Entity\epizy_poste_occupes $posteoccupeId = null)
    {
        $this->posteoccupe_id = $posteoccupeId;

        return $this;
    }

    /**
     * Get posteoccupeId
     *
     * @return \AdminBundle\Entity\epizy_poste_occupes
     */
    public function getPosteoccupeId()
    {
        return $this->posteoccupe_id;
    }
    /**
     * @var \AdminBundle\Entity\epizy_secteur_activites
     */
    private $secteurActivite_id;


    /**
     * Set secteurActiviteId
     *
     * @param \AdminBundle\Entity\epizy_secteur_activites $secteurActiviteId
     *
     * @return epizy_demandeur_experience
     */
    public function setSecteurActiviteId(\AdminBundle\Entity\epizy_secteur_activites $secteurActiviteId = null)
    {
        $this->secteurActivite_id = $secteurActiviteId;

        return $this;
    }

    /**
     * Get secteurActiviteId
     *
     * @return \AdminBundle\Entity\epizy_secteur_activites
     */
    public function getSecteurActiviteId()
    {
        return $this->secteurActivite_id;
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
     * @return epizy_demandeur_experience
     */
    public function setVilleId(\AdminBundle\Entity\epizy_villes $villeId = null)
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
    /**
     * @var \AdminBundle\Entity\epizy_demandeur_cvs
     */
    private $experience;


    /**
     * Set experience
     *
     * @param \AdminBundle\Entity\epizy_demandeur_cvs $experience
     *
     * @return epizy_demandeur_experience
     */
    public function setExperience(\AdminBundle\Entity\epizy_demandeur_cvs $experience = null)
    {
        $this->experience = $experience;

        return $this;
    }

    /**
     * Get experience
     *
     * @return \AdminBundle\Entity\epizy_demandeur_cvs
     */
    public function getExperience()
    {
        return $this->experience;
    }
}
