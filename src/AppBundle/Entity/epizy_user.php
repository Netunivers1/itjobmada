<?php

namespace AppBundle\Entity;

/**
 * epizy_user
 */
class epizy_user
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $seoname;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var int
     */
    private $mdpChange;

    /**
     * @var string
     */
    private $description;

    /**
     * @var int
     */
    private $status;

    /**
     * @var int
     */
    private $idRole;

    /**
     * @var int
     */
    private $idLocation;

    /**
     * @var \DateTime
     */
    private $created;

    /**
     * @var \DateTime
     */
    private $lastModified;

    /**
     * @var string
     */
    private $logins;

    /**
     * @var int
     */
    private $lastIp;

    /**
     * @var string
     */
    private $userAgent;

    /**
     * @var string
     */
    private $token;

    /**
     * @var \DateTime
     */
    private $tokenCreated;

    /**
     * @var \DateTime
     */
    private $tokenExpires;

    /**
     * @var string
     */
    private $apiToken;

    /**
     * @var string
     */
    private $hybridauthProvidername;

    /**
     * @var string
     */
    private $hybridauthProvideruid;

    /**
     * @var int
     */
    private $subscriber;

    /**
     * @var float
     */
    private $rate;

    /**
     * @var int
     */
    private $hasImage;

    /**
     * @var int
     */
    private $failedAttempts;

    /**
     * @var \DateTime
     */
    private $lastFailed;

    /**
     * @var \DateTime
     */
    private $notifictionDate;

    /**
     * @var string
     */
    private $deviceId;

    /**
     * @var string
     */
    private $stripeUserId;

    /**
     * @var string
     */
    private $googleAuthenticator;


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
     * Set name
     *
     * @param string $name
     *
     * @return epizy_user
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set seoname
     *
     * @param string $seoname
     *
     * @return epizy_user
     */
    public function setSeoname($seoname)
    {
        $this->seoname = $seoname;

        return $this;
    }

    /**
     * Get seoname
     *
     * @return string
     */
    public function getSeoname()
    {
        return $this->seoname;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return epizy_user
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
     * Set password
     *
     * @param string $password
     *
     * @return epizy_user
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set mdpChange
     *
     * @param integer $mdpChange
     *
     * @return epizy_user
     */
    public function setMdpChange($mdpChange)
    {
        $this->mdpChange = $mdpChange;

        return $this;
    }

    /**
     * Get mdpChange
     *
     * @return int
     */
    public function getMdpChange()
    {
        return $this->mdpChange;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return epizy_user
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return epizy_user
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
     * Set idRole
     *
     * @param integer $idRole
     *
     * @return epizy_user
     */
    public function setIdRole($idRole)
    {
        $this->idRole = $idRole;

        return $this;
    }

    /**
     * Get idRole
     *
     * @return int
     */
    public function getIdRole()
    {
        return $this->idRole;
    }

    /**
     * Set idLocation
     *
     * @param integer $idLocation
     *
     * @return epizy_user
     */
    public function setIdLocation($idLocation)
    {
        $this->idLocation = $idLocation;

        return $this;
    }

    /**
     * Get idLocation
     *
     * @return int
     */
    public function getIdLocation()
    {
        return $this->idLocation;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return epizy_user
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
     * Set lastModified
     *
     * @param \DateTime $lastModified
     *
     * @return epizy_user
     */
    public function setLastModified($lastModified)
    {
        $this->lastModified = $lastModified;

        return $this;
    }

    /**
     * Get lastModified
     *
     * @return \DateTime
     */
    public function getLastModified()
    {
        return $this->lastModified;
    }

    /**
     * Set logins
     *
     * @param string $logins
     *
     * @return epizy_user
     */
    public function setLogins($logins)
    {
        $this->logins = $logins;

        return $this;
    }

    /**
     * Get logins
     *
     * @return string
     */
    public function getLogins()
    {
        return $this->logins;
    }

    /**
     * Set lastIp
     *
     * @param integer $lastIp
     *
     * @return epizy_user
     */
    public function setLastIp($lastIp)
    {
        $this->lastIp = $lastIp;

        return $this;
    }

    /**
     * Get lastIp
     *
     * @return int
     */
    public function getLastIp()
    {
        return $this->lastIp;
    }

    /**
     * Set userAgent
     *
     * @param string $userAgent
     *
     * @return epizy_user
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;

        return $this;
    }

    /**
     * Get userAgent
     *
     * @return string
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    /**
     * Set token
     *
     * @param string $token
     *
     * @return epizy_user
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set tokenCreated
     *
     * @param \DateTime $tokenCreated
     *
     * @return epizy_user
     */
    public function setTokenCreated($tokenCreated)
    {
        $this->tokenCreated = $tokenCreated;

        return $this;
    }

    /**
     * Get tokenCreated
     *
     * @return \DateTime
     */
    public function getTokenCreated()
    {
        return $this->tokenCreated;
    }

    /**
     * Set tokenExpires
     *
     * @param \DateTime $tokenExpires
     *
     * @return epizy_user
     */
    public function setTokenExpires($tokenExpires)
    {
        $this->tokenExpires = $tokenExpires;

        return $this;
    }

    /**
     * Get tokenExpires
     *
     * @return \DateTime
     */
    public function getTokenExpires()
    {
        return $this->tokenExpires;
    }

    /**
     * Set apiToken
     *
     * @param string $apiToken
     *
     * @return epizy_user
     */
    public function setApiToken($apiToken)
    {
        $this->apiToken = $apiToken;

        return $this;
    }

    /**
     * Get apiToken
     *
     * @return string
     */
    public function getApiToken()
    {
        return $this->apiToken;
    }

    /**
     * Set hybridauthProvidername
     *
     * @param string $hybridauthProvidername
     *
     * @return epizy_user
     */
    public function setHybridauthProvidername($hybridauthProvidername)
    {
        $this->hybridauthProvidername = $hybridauthProvidername;

        return $this;
    }

    /**
     * Get hybridauthProvidername
     *
     * @return string
     */
    public function getHybridauthProvidername()
    {
        return $this->hybridauthProvidername;
    }

    /**
     * Set hybridauthProvideruid
     *
     * @param string $hybridauthProvideruid
     *
     * @return epizy_user
     */
    public function setHybridauthProvideruid($hybridauthProvideruid)
    {
        $this->hybridauthProvideruid = $hybridauthProvideruid;

        return $this;
    }

    /**
     * Get hybridauthProvideruid
     *
     * @return string
     */
    public function getHybridauthProvideruid()
    {
        return $this->hybridauthProvideruid;
    }

    /**
     * Set subscriber
     *
     * @param integer $subscriber
     *
     * @return epizy_user
     */
    public function setSubscriber($subscriber)
    {
        $this->subscriber = $subscriber;

        return $this;
    }

    /**
     * Get subscriber
     *
     * @return int
     */
    public function getSubscriber()
    {
        return $this->subscriber;
    }

    /**
     * Set rate
     *
     * @param float $rate
     *
     * @return epizy_user
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate
     *
     * @return float
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set hasImage
     *
     * @param integer $hasImage
     *
     * @return epizy_user
     */
    public function setHasImage($hasImage)
    {
        $this->hasImage = $hasImage;

        return $this;
    }

    /**
     * Get hasImage
     *
     * @return int
     */
    public function getHasImage()
    {
        return $this->hasImage;
    }

    /**
     * Set failedAttempts
     *
     * @param integer $failedAttempts
     *
     * @return epizy_user
     */
    public function setFailedAttempts($failedAttempts)
    {
        $this->failedAttempts = $failedAttempts;

        return $this;
    }

    /**
     * Get failedAttempts
     *
     * @return int
     */
    public function getFailedAttempts()
    {
        return $this->failedAttempts;
    }

    /**
     * Set lastFailed
     *
     * @param \DateTime $lastFailed
     *
     * @return epizy_user
     */
    public function setLastFailed($lastFailed)
    {
        $this->lastFailed = $lastFailed;

        return $this;
    }

    /**
     * Get lastFailed
     *
     * @return \DateTime
     */
    public function getLastFailed()
    {
        return $this->lastFailed;
    }

    /**
     * Set notifictionDate
     *
     * @param \DateTime $notifictionDate
     *
     * @return epizy_user
     */
    public function setNotifictionDate($notifictionDate)
    {
        $this->notifictionDate = $notifictionDate;

        return $this;
    }

    /**
     * Get notifictionDate
     *
     * @return \DateTime
     */
    public function getNotifictionDate()
    {
        return $this->notifictionDate;
    }

    /**
     * Set deviceId
     *
     * @param string $deviceId
     *
     * @return epizy_user
     */
    public function setDeviceId($deviceId)
    {
        $this->deviceId = $deviceId;

        return $this;
    }

    /**
     * Get deviceId
     *
     * @return string
     */
    public function getDeviceId()
    {
        return $this->deviceId;
    }

    /**
     * Set stripeUserId
     *
     * @param string $stripeUserId
     *
     * @return epizy_user
     */
    public function setStripeUserId($stripeUserId)
    {
        $this->stripeUserId = $stripeUserId;

        return $this;
    }

    /**
     * Get stripeUserId
     *
     * @return string
     */
    public function getStripeUserId()
    {
        return $this->stripeUserId;
    }

    /**
     * Set googleAuthenticator
     *
     * @param string $googleAuthenticator
     *
     * @return epizy_user
     */
    public function setGoogleAuthenticator($googleAuthenticator)
    {
        $this->googleAuthenticator = $googleAuthenticator;

        return $this;
    }

    /**
     * Get googleAuthenticator
     *
     * @return string
     */
    public function getGoogleAuthenticator()
    {
        return $this->googleAuthenticator;
    }
}

