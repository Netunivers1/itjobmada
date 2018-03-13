<?php

namespace AdminBundle\Entity;

/**
 * Epizy_demandeur_cvs
 */
class Epizy_demandeur_cvs
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
     * @var string
     */
    private $permis;

    /**
     * @var string
     */
    private $emploiRecherche;

    /**
     * @var int
     */
    private $emploirechercheId;

    /**
     * @var string
     */
    private $logiciel;

    /**
     * @var int
     */
    private $logicielId;

    /**
     * @var string
     */
    private $langue;

    /**
     * @var int
     */
    private $status;

    /**
     * @var string
     */
    private $reference;

    /**
     * @var string
     */
    private $centreInteretCertificat;

    /**
     * @var int
     */
    private $certificationId;

    /**
     * @var string
     */
    private $centreInteretProjet;

    /**
     * @var \DateTime
     */
    private $dateCreation;

    /**
     * @var \DateTime
     */
    private $datePublished;

    /**
     * @var int
     */
    private $nbrVue;

    /**
     * @var int
     */
    private $position;


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
     * @return Epizy_demandeur_cvs
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
     * Set permis
     *
     * @param string $permis
     *
     * @return Epizy_demandeur_cvs
     */
    public function setPermis($permis)
    {
        $this->permis = $permis;

        return $this;
    }

    /**
     * Get permis
     *
     * @return string
     */
    public function getPermis()
    {
        return $this->permis;
    }

    /**
     * Set emploiRecherche
     *
     * @param string $emploiRecherche
     *
     * @return Epizy_demandeur_cvs
     */
    public function setEmploiRecherche($emploiRecherche)
    {
        $this->emploiRecherche = $emploiRecherche;

        return $this;
    }

    /**
     * Get emploiRecherche
     *
     * @return string
     */
    public function getEmploiRecherche()
    {
        return $this->emploiRecherche;
    }

    /**
     * Set emploirechercheId
     *
     * @param integer $emploirechercheId
     *
     * @return Epizy_demandeur_cvs
     */
    public function setEmploirechercheId($emploirechercheId)
    {
        $this->emploirechercheId = $emploirechercheId;

        return $this;
    }

    /**
     * Get emploirechercheId
     *
     * @return int
     */
    public function getEmploirechercheId()
    {
        return $this->emploirechercheId;
    }

    /**
     * Set logiciel
     *
     * @param string $logiciel
     *
     * @return Epizy_demandeur_cvs
     */
    public function setLogiciel($logiciel)
    {
        $this->logiciel = $logiciel;

        return $this;
    }

    /**
     * Get logiciel
     *
     * @return string
     */
    public function getLogiciel()
    {
        return $this->logiciel;
    }

    /**
     * Set logicielId
     *
     * @param integer $logicielId
     *
     * @return Epizy_demandeur_cvs
     */
    public function setLogicielId($logicielId)
    {
        $this->logicielId = $logicielId;

        return $this;
    }

    /**
     * Get logicielId
     *
     * @return int
     */
    public function getLogicielId()
    {
        return $this->logicielId;
    }

    /**
     * Set langue
     *
     * @param string $langue
     *
     * @return Epizy_demandeur_cvs
     */
    public function setLangue($langue)
    {
        $this->langue = $langue;

        return $this;
    }

    /**
     * Get langue
     *
     * @return string
     */
    public function getLangue()
    {
        return $this->langue;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Epizy_demandeur_cvs
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set reference
     *
     * @param string $reference
     *
     * @return Epizy_demandeur_cvs
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set centreInteretCertificat
     *
     * @param string $centreInteretCertificat
     *
     * @return Epizy_demandeur_cvs
     */
    public function setCentreInteretCertificat($centreInteretCertificat)
    {
        $this->centreInteretCertificat = $centreInteretCertificat;

        return $this;
    }

    /**
     * Get centreInteretCertificat
     *
     * @return string
     */
    public function getCentreInteretCertificat()
    {
        return $this->centreInteretCertificat;
    }

    /**
     * Set certificationId
     *
     * @param integer $certificationId
     *
     * @return Epizy_demandeur_cvs
     */
    public function setCertificationId($certificationId)
    {
        $this->certificationId = $certificationId;

        return $this;
    }

    /**
     * Get certificationId
     *
     * @return int
     */
    public function getCertificationId()
    {
        return $this->certificationId;
    }

    /**
     * Set centreInteretProjet
     *
     * @param string $centreInteretProjet
     *
     * @return Epizy_demandeur_cvs
     */
    public function setCentreInteretProjet($centreInteretProjet)
    {
        $this->centreInteretProjet = $centreInteretProjet;

        return $this;
    }

    /**
     * Get centreInteretProjet
     *
     * @return string
     */
    public function getCentreInteretProjet()
    {
        return $this->centreInteretProjet;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return Epizy_demandeur_cvs
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set datePublished
     *
     * @param \DateTime $datePublished
     *
     * @return Epizy_demandeur_cvs
     */
    public function setDatePublished($datePublished)
    {
        $this->datePublished = $datePublished;

        return $this;
    }

    /**
     * Get datePublished
     *
     * @return \DateTime
     */
    public function getDatePublished()
    {
        return $this->datePublished;
    }

    /**
     * Set nbrVue
     *
     * @param integer $nbrVue
     *
     * @return Epizy_demandeur_cvs
     */
    public function setNbrVue($nbrVue)
    {
        $this->nbrVue = $nbrVue;

        return $this;
    }

    /**
     * Get nbrVue
     *
     * @return int
     */
    public function getNbrVue()
    {
        return $this->nbrVue;
    }

    /**
     * Set position
     *
     * @param integer $position
     *
     * @return Epizy_demandeur_cvs
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }
}

