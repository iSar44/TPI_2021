<?php

/**
 * @author Iliya Saroukhanian <iliya.srkhn@eduge.ch>
 * @copyright 2021 Iliya Saroukhanian
 * @version 1.0.0
 */

require_once('./src/web.inc.all.php');

/**
 * Classe qui répresente une équipe du site tournamentManager
 */
class Equipe_tM extends Utilisateur_tM
{
    #region Champs
    private $nomEquipe;
    #endregion

    #region Accesseurs/Mutateurs
    /**
     * Get the value of nomEquipe
     */
    public function getNomEquipe()
    {
        return $this->nomEquipe;
    }

    /**
     * Set the value of nomEquipe
     */
    public function setNomEquipe($nomEquipe): self
    {
        $this->nomEquipe = $nomEquipe;

        return $this;
    }
    #endregion


    /**
     * Undocumented function
     *
     * @param integer $anId
     * @param string $aNickname
     * @param string $anEmail
     * @param integer $anAdmin
     * @param string $nomEquipe
     */
    public function __construct($anId = -1, $aNickname = "Un nickname", $anEmail = "email@email.com", $anAdmin = 0, $nomEquipe = "")
    {
        parent::__construct($anId, $aNickname, $anEmail, $anAdmin);
        $this->setNomEquipe($nomEquipe);
    }
}
