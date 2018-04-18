<?php

namespace AdminBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * epizy_demandeur_cvs
 */
class epizy_demandeur_cvs
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $permis;

    /**
     * @var string
     */
    private $emploiRecherche;

    /**
     * @var string
     */
    private $logiciel;

    /**
     * @var string
     */
    private $langue;

    /**
     * @var int
     */
    private $statu;

    /**
     * @var string
     */
    private $reference;

    /**
     * @var string
     */
    private $centreInteretCertificat;

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
     * @var string
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
     * Set permis
     *
     * @param string $permis
     *
     * @return epizy_demandeur_cvs
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
     * @return epizy_demandeur_cvs
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
     * Set logiciel
     *
     * @param string $logiciel
     *
     * @return epizy_demandeur_cvs
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
     * Set langue
     *
     * @param string $langue
     *
     * @return epizy_demandeur_cvs
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
     * Set statu
     *
     * @param integer $statu
     *
     * @return epizy_demandeur_cvs
     */
    public function setStatu($statu)
    {
        $this->statu = $statu;

        return $this;
    }

    /**
     * Get statu
     *
     * @return int
     */
    public function getStatu()
    {
        return $this->statu;
    }

    /**
     * Set reference
     *
     * @param string $reference
     *
     * @return epizy_demandeur_cvs
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
     * @return epizy_demandeur_cvs
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
     * Set centreInteretProjet
     *
     * @param string $centreInteretProjet
     *
     * @return epizy_demandeur_cvs
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
     * @return epizy_demandeur_cvs
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
     * @return epizy_demandeur_cvs
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
     * @return epizy_demandeur_cvs
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
     * @param string $position
     *
     * @return epizy_demandeur_cvs
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @var \AdminBundle\Entity\epizy_demandeur_emplois
     */
    protected $id_demandeur;


    /**
     * Set idDemandeur
     *
     * @param \AdminBundle\Entity\epizy_demandeur_emplois $idDemandeur
     *
     * @return epizy_demandeur_cvs
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
     * @var \AdminBundle\Entity\epizy_langues
     */
    private $langue_id;


    /**
     * Set langueId
     *
     * @param \AdminBundle\Entity\epizy_langues $langueId
     *
     * @return epizy_demandeur_cvs
     */
    public function setLangueId(\AdminBundle\Entity\epizy_langues $langueId = null)
    {
        $this->langue_id = $langueId;

        return $this;
    }

    /**
     * Get langueId
     *
     * @return \AdminBundle\Entity\epizy_langues
     */
    public function getLangueId()
    {
        return $this->langue_id;
    }

    /**
     * @var \AdminBundle\Entity\epizy_logiciels
     */
    private $logiciel_id;

    /**
     * Set logicielId
     *
     * @param \AdminBundle\Entity\epizy_logiciels $logicielId
     *
     * @return epizy_demandeur_cvs
     */
    public function setLogicielId(\AdminBundle\Entity\epizy_logiciels $logicielId = null)
    {
        $this->logiciel_id = $logicielId;

        return $this;
    }

    /**
     * Get logicielId
     *
     * @return \AdminBundle\Entity\epizy_logiciels
     */
    public function getLogicielId()
    {
        return $this->logiciel_id;
    }

    /**
     * @var \AdminBundle\Entity\epizy_emploi_recherches
     */
    private $emploirecherche_id;

    /**
     * Set emploirechercheId
     *
     * @param \AdminBundle\Entity\epizy_emploi_recherches $emploirechercheId
     *
     * @return epizy_demandeur_cvs
     */
    public function setEmploirechercheId(\AdminBundle\Entity\epizy_emploi_recherches $emploirechercheId = null)
    {
        $this->emploirecherche_id = $emploirechercheId;

        return $this;
    }

    /**
     * Get emploirechercheId
     *
     * @return \AdminBundle\Entity\epizy_emploi_recherches
     */
    public function getEmploirechercheId()
    {
        return $this->emploirecherche_id;
    }
    
    /**
     * @var \AdminBundle\Entity\epizy_certifications
     */
    private $certification_id;


    /**
     * Set certificationId
     *
     * @param \AdminBundle\Entity\epizy_certifications $certificationId
     *
     * @return epizy_demandeur_cvs
     */
    public function setCertificationId(\AdminBundle\Entity\epizy_certifications $certificationId = null)
    {
        $this->certification_id = $certificationId;

        return $this;
    }

    /**
     * Get certificationId
     *
     * @return \AdminBundle\Entity\epizy_certifications
     */
    public function getCertificationId()
    {
        return $this->certification_id;
    }

    private $formations;
    private $experiences;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->formations = new ArrayCollection();
        $this->experiences = new ArrayCollection();
    }


    /**
     * Add experience
     *
     * @param \AdminBundle\Entity\epizy_demandeur_experience $experience
     *
     * @return epizy_demandeur_cvs
     */
    public function addExperience(\AdminBundle\Entity\epizy_demandeur_experience $experience)
    {
        $this->experiences[] = $experience;

        return $this;
    }

    /**
     * Remove experience
     *
     * @param \AdminBundle\Entity\epizy_demandeur_experience $experience
     */
    public function removeExperience(\AdminBundle\Entity\epizy_demandeur_experience $experience)
    {
        $this->experiences->removeElement($experience);
    }

    /**
     * Get experiences
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getExperiences()
    {
        return $this->experiences;
    }

    /**
     * Add formation
     *
     * @param \AdminBundle\Entity\epizy_demandeur_formations $formation
     *
     * @return epizy_demandeur_cvs
     */
    public function addFormation(\AdminBundle\Entity\epizy_demandeur_formations $formation)
    {
        $this->formations[] = $formation;

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
