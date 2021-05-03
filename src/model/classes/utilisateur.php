<?php

class Utilisateur{

    #region Champs
    private $idUser;
    private $userName;
    private $fname;
    private $lname;
    private $age;
    private $phoneNumber;
    private $email;
    private $pwd;
    #endregion

    #region Propriétés
    /**
     * Get the value of idUser
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set the value of idUser
     */
    public function setIdUser($idUser) : self
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get the value of userName
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * Set the value of userName
     */
    public function setUserName($userName) : self
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * Get the value of fname
     */
    public function getFname()
    {
        return $this->fname;
    }

    /**
     * Set the value of fname
     */
    public function setFname($fname) : self
    {
        $this->fname = $fname;

        return $this;
    }

    /**
     * Get the value of lname
     */
    public function getLname()
    {
        return $this->lname;
    }

    /**
     * Set the value of lname
     */
    public function setLname($lname) : self
    {
        $this->lname = $lname;

        return $this;
    }

    /**
     * Get the value of age
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set the value of age
     */
    public function setAge($age) : self
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get the value of phoneNumber
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set the value of phoneNumber
     */
    public function setPhoneNumber($phoneNumber) : self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     */
    public function setEmail($email) : self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of pwd
     */
    public function getPwd()
    {
        return $this->pwd;
    }

    /**
     * Set the value of pwd
     */
    public function setPwd($pwd) : self
    {
        $this->pwd = $pwd;

        return $this;
    }
    #endregion

    #region Constructeur
    public function __construct($aUserName, $aFname, $aLname, $anAge, $aPhoneNumber, $anEmail, $aPwd)
    {
        $this->setUserName($aUserName);
        $this->setFname($aFname);
        $this->setLname($aLname);
        $this->setAge($anAge);
        $this->setPhoneNumber($aPhoneNumber);
        $this->setEmail($anEmail);
        $this->setPwd($aPwd);
    }
    #endregion

    #region Méthodes
    public function __toString()
    {
        $string = printf("Username: %s; First Name: %s; Last Name: %s; Age: %s; Phone Number: %s; Email: %s; Password: %s", $this->getUserName(), $this->getFname(), $this->getLname(), $this->getAge(), $this->getPhoneNumber(), $this->getEmail(), $this->getPwd());

        return $string;
    }
    #endregion

}
