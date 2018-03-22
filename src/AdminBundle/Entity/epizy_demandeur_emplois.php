<?php

namespace AdminBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * epizy_demandeur_emplois
 */
class epizy_demandeur_emplois
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $audition;

    /**
     * @var string
     */
    private $emploiTrouve;

    /**
     * @var string
     */
    private $titre;

    /**
     * @var string
     */
    private $nom;

    /**
     * @var string
     */
    private $prenom;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $adresse;

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
    private $region;

    /**
     * @var string
     */
    private $telephone;

    /**
     * @var \DateTime
     */
    private $dateDeNaissance;

    /**
     * @var string
     */
    private $choixEmploi;

    /**
     * @var string
     */
    private $choixFormation;

    /**
     * @var string
     */
    private $notificationEmploiPoste;

    /**
     * @var string
     */
    private $notificationFormationPoste;

    /**
     * @var string
     */
    private $photo;

    /**
     * @var int
     */
    private $status;

    /**
     * @var string
     */
    private $newsletter;

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
     * Set audition
     *
     * @param string $audition
     *
     * @return epizy_demandeur_emplois
     */
    public function setAudition($audition)
    {
        $this->audition = $audition;

        return $this;
    }

    /**
     * Get audition
     *
     * @return string
     */
    public function getAudition()
    {
        return $this->audition;
    }

    /**
     * Set emploiTrouve
     *
     * @param string $emploiTrouve
     *
     * @return epizy_demandeur_emplois
     */
    public function setEmploiTrouve($emploiTrouve)
    {
        $this->emploiTrouve = $emploiTrouve;

        return $this;
    }

    /**
     * Get emploiTrouve
     *
     * @return string
     */
    public function getEmploiTrouve()
    {
        return $this->emploiTrouve;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return epizy_demandeur_emplois
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return epizy_demandeur_emplois
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return epizy_demandeur_emplois
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return epizy_demandeur_emplois
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return epizy_demandeur_emplois
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return epizy_demandeur_emplois
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
     * @return epizy_demandeur_emplois
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
     * Set region
     *
     * @param string $region
     *
     * @return epizy_demandeur_emplois
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return epizy_demandeur_emplois
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set dateDeNaissance
     *
     * @param \DateTime $dateDeNaissance
     *
     * @return epizy_demandeur_emplois
     */
    public function setDateDeNaissance($dateDeNaissance)
    {
        $this->dateDeNaissance = $dateDeNaissance;

        return $this;
    }

    /**
     * Get dateDeNaissance
     *
     * @return \DateTime
     */
    public function getDateDeNaissance()
    {
        return $this->dateDeNaissance;
    }

    /**
     * Set choixEmploi
     *
     * @param string $choixEmploi
     *
     * @return epizy_demandeur_emplois
     */
    public function setChoixEmploi($choixEmploi)
    {
        $this->choixEmploi = $choixEmploi;

        return $this;
    }

    /**
     * Get choixEmploi
     *
     * @return string
     */
    public function getChoixEmploi()
    {
        return $this->choixEmploi;
    }

    /**
     * Set choixFormation
     *
     * @param string $choixFormation
     *
     * @return epizy_demandeur_emplois
     */
    public function setChoixFormation($choixFormation)
    {
        $this->choixFormation = $choixFormation;

        return $this;
    }

    /**
     * Get choixEmploi
     *
     * @return string
     */
    public function getChoixFormation()
    {
        return $this->choixFormation;
    }

    /**
     * Set notificationEmploiPoste
     *
     * @param string $notificationEmploiPoste
     *
     * @return epizy_demandeur_emplois
     */
    public function setNotificationEmploiPoste($notificationEmploiPoste)
    {
        $this->notificationEmploiPoste = $notificationEmploiPoste;

        return $this;
    }

    /**
     * Get notificationEmploiPoste
     *
     * @return string
     */
    public function getNotificationEmploiPoste()
    {
        return $this->notificationEmploiPoste;
    }

    /**
     * Set notificationFormationPoste
     *
     * @param string $notificationFormationPoste
     *
     * @return epizy_demandeur_emplois
     */
    public function setNotificationFormationPoste($notificationFormationPoste)
    {
        $this->notificationFormationPoste = $notificationFormationPoste;

        return $this;
    }

    /**
     * Get notificationFormationPoste
     *
     * @return string
     */
    public function getNotificationFormationPoste()
    {
        return $this->notificationFormationPoste;
    }

    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return epizy_demandeur_emplois
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return epizy_demandeur_emplois
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
     * Set newsletter
     *
     * @param string $newsletter
     *
     * @return epizy_demandeur_emplois
     */
    public function setNewsletter($newsletter)
    {
        $this->newsletter = $newsletter;

        return $this;
    }

    /**
     * Get newsletter
     *
     * @return string
     */
    public function getNewsletter()
    {
        return $this->newsletter;
    }
    /**
     * @var \AppBundle\Entity\epizy_users
     */
    protected $id_user;

    /**
     * Set idUser
     *
     * @param \AppBundle\Entity\epizy_users $idUser
     *
     * @return epizy_demandeur_emplois
     */
    public function setIdUser(\AppBundle\Entity\epizy_users $idUser = null)
    {
        $this->id_user = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return \AppBundle\Entity\epizy_users
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

}
