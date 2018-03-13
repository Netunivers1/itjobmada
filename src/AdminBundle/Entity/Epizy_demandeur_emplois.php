<?php

namespace AdminBundle\Entity;

/**
 * Epizy_demandeur_emplois
 */
class Epizy_demandeur_emplois
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $idUser;

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
     * Set idUser
     *
     * @param integer $idUser
     *
     * @return Epizy_demandeur_emplois
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return int
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set audition
     *
     * @param string $audition
     *
     * @return Epizy_demandeur_emplois
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
     * @return Epizy_demandeur_emplois
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
     * @return Epizy_demandeur_emplois
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
     * @return Epizy_demandeur_emplois
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
     * @return Epizy_demandeur_emplois
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
     * @return Epizy_demandeur_emplois
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
     * @return Epizy_demandeur_emplois
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
     * @return Epizy_demandeur_emplois
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
     * @return Epizy_demandeur_emplois
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
     * @return Epizy_demandeur_emplois
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
     * @return Epizy_demandeur_emplois
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
     * @param \Date $dateDeNaissance
     *
     * @return Epizy_demandeur_emplois
     */
    public function setDateDeNaissance($dateDeNaissance)
    {
        $this->dateDeNaissance = $dateDeNaissance;

        return $this;
    }

    /**
     * Get dateDeNaissance
     *
     * @return \Date
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
     * @return Epizy_demandeur_emplois
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
     * @return Epizy_demandeur_emplois
     */
    public function setChoixFormation($choixFormation)
    {
        $this->choixFormation = $choixFormation;

        return $this;
    }

    /**
     * Get choixFormation
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
     * @return Epizy_demandeur_emplois
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
     * Set photo
     *
     * @param string $photo
     *
     * @return Epizy_demandeur_emplois
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
     * @return Epizy_demandeur_emplois
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
     * @return Epizy_demandeur_emplois
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
}
