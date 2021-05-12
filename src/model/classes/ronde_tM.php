<?php
require_once('./src/model/classes/match_tM.php');

class Ronde_tM
{

    /**
     * Tableau des matches
     *
     * @var array Tableau contenant les matches
     */
    private $matches;

    /**
     * l'ID du tournoi concerné
     *
     * @var int
     */
    private $tournamentId;

    /**
     * Niveau de la ronde
     *
     * @var int
     */
    private $level;

    /**
     * Get the value of matches
     */
    public function getMatches()
    {
        return $this->matches;
    }

    /**
     * Set the value of matches
     */
    public function setMatches($matches): self
    {
        $this->matches = $matches;

        return $this;
    }

    /**
     * Get the value of tournamentId
     */
    public function getTournamentId()
    {
        return $this->tournamentId;
    }

    /**
     * Set the value of tournamentId
     */
    public function setTournamentId($tournamentId): self
    {
        $this->tournamentId = $tournamentId;

        return $this;
    }

    /**
     * Get the value of level
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set the value of level
     */
    public function setLevel($level): self
    {
        $this->level = $level;

        return $this;
    }


    /**
     * Constructeur de la classe Ronde_tM
     *
     * @param array $tabMatches
     * @param integer $idTournoi
     * @param integer $niveauRonde
     */
    public function __construct($tabMatches = array(), $idTournoi = 0, $niveauRonde = 0)
    {
        $this->setMatches($tabMatches);
        $this->setTournamentId($idTournoi);
        $this->setLevel($niveauRonde);
    }
}
