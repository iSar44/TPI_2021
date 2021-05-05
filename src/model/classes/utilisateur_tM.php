<?php

class Utilisateur_tM
{

    #region Champs
    private $id;
    private $nickname;
    private $email;
    private $mdp;
    private $admin;
    #endregion

    #region Propriétés
    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nickname
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * Set the value of nickname
     */
    public function setNickname($nickname): self
    {
        $this->nickname = $nickname;

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
    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of mdp
     */
    public function getMdp()
    {
        return $this->mdp;
    }

    /**
     * Set the value of mdp
     */
    public function setMdp($mdp): self
    {
        $this->mdp = $mdp;

        return $this;
    }

    /**
     * Get the value of admin
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * Set the value of admin
     */
    public function setAdmin($admin): self
    {
        $this->admin = $admin;

        return $this;
    }
    #endregion

    public function __construct()
    {
        $this->setNickname("Un nickname");
        $this->setEmail("email@email.com");
        $this->setMdp("Super");
        $this->setAdmin(0);
    }

    public function __toString()
    {
        return printf("NICKNAME: %s; EMAIL: %s; MDP: %s, ADMIN: %s", $this->getNickname(), $this->getEmail(), $this->getMdp(), $this->getAdmin());
    }
}
