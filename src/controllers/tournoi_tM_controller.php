<?php

/**
 * @author Iliya Saroukhanian <iliya.srkhn@eduge.ch>
 * @copyright 2021 Iliya Saroukhanian
 * @version 1.0.0
 */

require_once('./src/web.inc.all.php');

/**
 * Classe qui représente le contrôleur de la classe Tournoi_tM
 */
class Tournoi_tM_Controller
{
    #region Champ
    private Tournoi_tM $tournoi_tM;
    #endregion

    #region Accesseur/Mutateur
    /**
     * Accesseur qui retourne le tournoi
     *
     * @return Tournoi_tM
     */
    public function getTournoiTM(): Tournoi_tM
    {
        return $this->tournoi_tM;
    }

    /**
     * Mutateur qui "set" le tournoi
     *
     * @param Tournoi_tM $tournoi_tM
     *
     * @return self
     */
    public function setTournoiTM(Tournoi_tM $tournoi_tM): self
    {
        $this->tournoi_tM = $tournoi_tM;

        return $this;
    }
    #endregion


    #region Fonctions
    /**
     * Fonction qui insère un nouveau tournoi dans la base de données
     *
     * @param Tournoi_tM $nouveauTournoi
     * @return boolean
     */
    public function CreateTournament(Tournoi_tM $nouveauTournoi): bool
    {
        $query = Database::prepare("INSERT INTO `TOURNOIS` (`TITRE`, `DESCRIPTION`, `DATE_HEURE_DEMARRAGE`, `NB_EQUIPES`, `DATE_HEURE_DEBUT_INSCRIPTION`, `DATE_HEURE_FIN_INSCRIPTION`, `TEMPS_ENTRE_RONDES`) 
        VALUES (:TITRE, :DESCRIPTION, :DATE_HEURE_DEMARRAGE, :NB_EQUIPES, :DATE_HEURE_DEBUT_INSCRIPTION, :DATE_HEURE_FIN_INSCRIPTION, :TEMPS_ENTRE_RONDES)");

        $titre = $nouveauTournoi->getTitre();
        $description = $nouveauTournoi->getDescription();
        $dateHeureDemarrage = $nouveauTournoi->getDateHeureDemarrage();
        $nbEquipes = $nouveauTournoi->getNbEquipes();
        $dateHeureDebutInscription = $nouveauTournoi->getDateHeureDebutInscription();
        $dateHeureFinInscription = $nouveauTournoi->getDateHeureFinInscription();

        if ($nouveauTournoi->getTempsEntreRondes() == "") {
            $tempsEntreRondes = "00:00";
        } else {
            $tempsEntreRondes = $nouveauTournoi->getTempsEntreRondes();
        }

        $query->bindParam(':TITRE', $titre, PDO::PARAM_STR, 50);
        $query->bindParam(':DESCRIPTION', $description, PDO::PARAM_STR, 100);
        $query->bindParam(':DATE_HEURE_DEMARRAGE', $dateHeureDemarrage);
        $query->bindParam(':NB_EQUIPES', $nbEquipes, PDO::PARAM_INT);
        $query->bindParam(':DATE_HEURE_DEBUT_INSCRIPTION', $dateHeureDebutInscription);
        $query->bindParam(':DATE_HEURE_FIN_INSCRIPTION', $dateHeureFinInscription);
        $query->bindParam(':TEMPS_ENTRE_RONDES', $tempsEntreRondes);

        $insertSuccess = $query->execute();

        return $insertSuccess;
    }


    // public function FindTournamentByTitle($unTitre)
    // {
    //     $query = Database::prepare()
    // }


    public static function SelectTournament($idTournoi)
    {
        $query = Database::prepare("SELECT `ID`, `TITRE`, `DESCRIPTION`, `DATE_HEURE_DEMARRAGE`, `NB_EQUIPES`, `DATE_HEURE_DEBUT_INSCRIPTION`, `DATE_HEURE_FIN_INSCRIPTION`, `TEMPS_ENTRE_RONDES` 
        FROM TOURNOIS 
        WHERE `ID` = :ID");

        $query->bindParam(":ID", $idTournoi, PDO::PARAM_INT);
        $query->setFetchMode(PDO::FETCH_ASSOC);

        try {
            $query->execute();

            if ($rowInDb = $query->fetch()) {

                $tournoi = new Tournoi_tM();

                $tournoi->setId((int)$rowInDb['ID']);
                $tournoi->setTitre($rowInDb['TITRE']);
                $tournoi->setDescription($rowInDb['DESCRIPTION']);
                $tournoi->setDateHeureDemarrage($rowInDb['DATE_HEURE_DEMARRAGE']);
                $tournoi->setNbEquipes((int)$rowInDb['NB_EQUIPES']);
                $tournoi->setDateHeureDebutInscription($rowInDb['DATE_HEURE_DEBUT_INSCRIPTION']);
                $tournoi->setDateHeureFinInscription($rowInDb['DATE_HEURE_FIN_INSCRIPTION']);
                $tournoi->setTempsEntreRondes($rowInDb['TEMPS_ENTRE_RONDES']);

                // Charger les équipes
                // self::LoadTournamentTeams($tournoi);
                // Charger les roundes
                // self::LoadTournamentRounds($tournoi);

                return $tournoi;
            }
        } catch (PDOException $e) {
            echo "Exception - SelectTournament() :" . $e->getMessage();
            return false;
        }

        return false;
    }

    public function SelectAll()
    {
        $results = array();

        $query = Database::prepare("SELECT `ID`, `TITRE`, `DESCRIPTION`, `DATE_HEURE_DEMARRAGE`, `NB_EQUIPES`, `DATE_HEURE_DEBUT_INSCRIPTION`, `DATE_HEURE_FIN_INSCRIPTION`, `TEMPS_ENTRE_RONDES` 
        FROM TOURNOIS");

        $query->execute();

        while ($rowInDb = $query->fetch(PDO::FETCH_ASSOC)) {

            $tournoi = new Tournoi_tM();

            $tournoi->setId((int)$rowInDb['ID']);
            $tournoi->setTitre($rowInDb['TITRE']);
            $tournoi->setDescription($rowInDb['DESCRIPTION']);
            $tournoi->setDateHeureDemarrage($rowInDb['DATE_HEURE_DEMARRAGE']);
            $tournoi->setNbEquipes((int)$rowInDb['NB_EQUIPES']);
            $tournoi->setDateHeureDebutInscription($rowInDb['DATE_HEURE_DEBUT_INSCRIPTION']);
            $tournoi->setDateHeureFinInscription($rowInDb['DATE_HEURE_FIN_INSCRIPTION']);
            $tournoi->setTempsEntreRondes($rowInDb['TEMPS_ENTRE_RONDES']);

            array_push($results, $tournoi);
        }

        return $results;
    }

    /**
     * Fonction qui efface un tournoi stocké dans la base de données
     *
     * @param int $idTournoi
     * @return boolean
     */
    public function DeleteTournament(Tournoi_tM $unTournoi): bool
    {
        $query = Database::prepare("DELETE FROM TOURNOIS 
        WHERE ID = :ID");

        $idTournoi = $unTournoi->getId();

        $query->bindParam(":ID", $idTournoi, PDO::PARAM_INT);

        $delSuccess = $query->execute();
        return $delSuccess;
    }


    /**
     * Fonction qui permet de modifier un tournoi stocké dans la base de données
     *
     * @param Tournoi_tM $unTournoi
     * @param int $idTournoi
     * @return boolean
     */
    public function EditTournament(Tournoi_tM $unTournoi, $idTournoi): bool
    {
        $query = Database::prepare("UPDATE TOURNOIS 
        SET `TITRE` = :TITRE, `DESCRIPTION` = :DESCRIPTION, `DATE_HEURE_DEMARRAGE` = :DATE_HEURE_DEMARRAGE, `NB_EQUIPES` = :NB_EQUIPES, `DATE_HEURE_DEBUT_INSCRIPTION` = :DATE_HEURE_DEBUT_INSCRIPTION, `DATE_HEURE_FIN_INSCRIPTION` = :DATE_HEURE_FIN_INSCRIPTION, `TEMPS_ENTRE_RONDES` = :TEMPS_ENTRE_RONDES 
        WHERE `ID` = :ID");

        $titre = $unTournoi->getTitre();
        $description = $unTournoi->getDescription();
        $dateHeureDemarrage = $unTournoi->getDateHeureDemarrage();
        $nbEquipes = $unTournoi->getNbEquipes();
        $dateHeureDebutInscription = $unTournoi->getDateHeureDebutInscription();
        $dateHeureFinInscription = $unTournoi->getDateHeureFinInscription();

        if ($unTournoi->getTempsEntreRondes() == "") {
            $tempsEntreRondes = "00:00";
        } else {
            $tempsEntreRondes = $unTournoi->getTempsEntreRondes();
        }

        $query->bindParam(':ID', $idTournoi, PDO::PARAM_INT);
        $query->bindParam(':TITRE', $titre, PDO::PARAM_STR, 50);
        $query->bindParam(':DESCRIPTION', $description, PDO::PARAM_STR, 100);
        $query->bindParam(':DATE_HEURE_DEMARRAGE', $dateHeureDemarrage);
        $query->bindParam(':NB_EQUIPES', $nbEquipes, PDO::PARAM_INT);
        $query->bindParam(':DATE_HEURE_DEBUT_INSCRIPTION', $dateHeureDebutInscription);
        $query->bindParam(':DATE_HEURE_FIN_INSCRIPTION', $dateHeureFinInscription);
        $query->bindParam(':TEMPS_ENTRE_RONDES', $tempsEntreRondes);

        $editSuccess = $query->execute();

        return $editSuccess;
    }

    public function RegisterTeam(Tournoi_tM $unTournoi, Equipe_tM $uneEquipe)
    {
        $query = Database::prepare("INSERT INTO TOURNOIS_has_EQUIPE (`TOURNOIS_ID`, `EQUIPE_UTILISATEUR_ID`) 
        VALUES (:TOURNOIS_ID, :EQUIPE_UTILISATEUR_ID)");

        $tournoiId = $unTournoi->getId();
        $equipeId = $uneEquipe->getId();

        $query->bindParam(':TOURNOIS_ID', $tournoiId, PDO::PARAM_INT);
        $query->bindParam(':EQUIPE_UTILISATEUR_ID', $equipeId, PDO::PARAM_INT);

        try {

            $insertSuccess = $query->execute();
            return $insertSuccess;
        } catch (PDOException $e) {

            echo "Exception - RegisterTeam() :" . $e->getMessage();
            return false;
        }
        return false;
    }


    public function UnregisterTeam(Tournoi_tM $unTournoi, Equipe_tM $uneEquipe)
    {
        $query = Database::prepare("DELETE FROM TOURNOIS_has_EQUIPE 
        WHERE TOURNOIS_ID = :TOURNOIS_ID 
        AND EQUIPE_UTILISATEUR_ID = :EQUIPE_UTILISATEUR_ID");

        $idTournoi = $unTournoi->getId();
        $idEquipe = $uneEquipe->getId();

        $query->bindParam(':TOURNOIS_ID', $idTournoi, PDO::PARAM_INT);
        $query->bindParam(':EQUIPE_UTILISATEUR_ID', $idEquipe, PDO::PARAM_INT);

        try {

            $deleteSuccess = $query->execute();
            return $deleteSuccess;
        } catch (PDOException $e) {

            echo "Exception - Unregisterteam() :" . $e->getMessage();
            return false;
        }
        return false;
    }

    public function GetResultsFromTournament(Tournoi_tM $unTournoi)
    {

        // $getPrevLevelQuery = Database::prepare("SELECT MAX(`RONDE_has_MATCHES`.`RONDE_ETAPE`) 
        // FROM `tournamentManager`.`RONDE_has_MATCHES`
        // WHERE `RONDE_has_MATCHES`.`RONDE_TOURNOIS_ID` = :RONDE_TOURNOIS_ID");

        $tournoiId = $unTournoi->getId();

        $tabRounds = array();
        $tabMatches = array();

        // $getPrevLevelQuery->bindParam(':RONDE_TOURNOIS_ID', $tournoiId, PDO::PARAM_INT);

        // $getPrevLevelQuery->execute();
        // if ($rowInDb = $getPrevLevelQuery->fetch(PDO::FETCH_ASSOC)) {

        //     $prevLevel = (int)$rowInDb['MAX(`RONDE_has_MATCHES`.`RONDE_ETAPE`)'];
        // }


        $queryGetResult = Database::prepare("SELECT `RONDE_has_MATCHES`.`RONDE_ETAPE`, `MATCHES`.`EQUIPE_UTILISATEUR_ID1`, `MATCHES`.`EQUIPE_UTILISATEUR_ID2`, `MATCHES`.`VAINQUEUR_ID`
        FROM `tournamentManager`.`MATCHES`
        INNER JOIN `tournamentManager`.`RONDE_has_MATCHES`
        WHERE `MATCHES`.`ID` = `RONDE_has_MATCHES`.`MATCHES_ID`
        AND `RONDE_has_MATCHES`.`RONDE_TOURNOIS_ID` = :RONDE_TOURNOIS_ID");

        $queryGetResult->bindParam(':RONDE_TOURNOIS_ID', $tournoiId, PDO::PARAM_INT);

        try {
            $queryGetResult->execute();
            while ($rowInDb = $queryGetResult->fetch(PDO::FETCH_ASSOC)) {

                $ronde = new Ronde_tM();
                $level = (int)$rowInDb['RONDE_ETAPE'];

                $match = new Match_tM();
                $match->setIdTeam1((int)$rowInDb['EQUIPE_UTILISATEUR_ID1']);
                $match->SetIdTeam2((int)$rowInDb['EQUIPE_UTILISATEUR_ID2']);
                $match->setIdWinner((int)$rowInDb['VAINQUEUR_ID']);

                array_push($tabMatches, $match);

                $ronde->setLevel($level);
                $ronde->setMatches($tabMatches);

                array_push($tabRounds, $ronde);
            }

            return $tabRounds;
        } catch (PDOException $e) {
            echo "Exception - GetResultsFromTournament :" . $e->getMessage();
            return false;
        }
        return false;
    }


    public static function StartTournament(Tournoi_tM $unTournoi)
    {
        // Chargement des équipes
        self::LoadTournamentTeams($unTournoi);
        // self::LoadTournamentRounds($unTournoi);

        $allRounds = $unTournoi->getRounds();
        $firstRound = $allRounds[0];
        $levelRound = $firstRound->getLevel();

        $tabTeams = $unTournoi->getTeams();
        shuffle($tabTeams);

        $tabTeamsPerMatch = array_chunk($tabTeams, 2);

        $allMatchesTeams = array();
        $allMatchesIds = array();

        foreach ($tabTeamsPerMatch as $teamsMatch) {

            $match = new Match_tM();

            $firstTeam = $teamsMatch[0];
            $firstTeamId = $firstTeam->getId();
            $secondTeam = $teamsMatch[1];
            $secondTeamId = $secondTeam->getId();

            $match->setIdTeam1($firstTeamId);
            $match->setIdTeam2($secondTeamId);

            self::CreateMatchTournament($firstTeam, $secondTeam);

            array_push($allMatchesTeams, $teamsMatch);
            array_push($allMatchesIds, $match);

            $idMatch = self::SelectMatchTournament($firstTeam, $secondTeam);

            $tournoiId = $unTournoi->getId();

            $query = Database::prepare("INSERT INTO `RONDE_has_MATCHES` (`RONDE_TOURNOIS_ID`, `RONDE_ETAPE`, `MATCHES_ID`) 
            VALUES (:RONDE_TOURNOIS_ID, :RONDE_ETAPE, :MATCHES_ID)");

            $query->bindParam(':RONDE_TOURNOIS_ID', $tournoiId, PDO::PARAM_INT);
            $query->bindParam(':RONDE_ETAPE', $levelRound, PDO::PARAM_INT);
            $query->bindParam(':MATCHES_ID', $idMatch, PDO::PARAM_INT);

            $query->execute();
        }

        $firstRound->setMatches($allMatchesTeams);
        $firstRound->setMatchesIds($allMatchesIds);
    }

    public function SetWinner(Equipe_tM $winnerTeam, Equipe_tM $loserTeam)
    {
        $query = Database::prepare("UPDATE `tournamentManager`.`MATCHES` 
        INNER JOIN `tournamentManager`.`RONDE_has_MATCHES`
        ON `RONDE_has_MATCHES`.`MATCHES_ID` = `MATCHES`.`ID`
        SET `MATCHES`.`VAINQUEUR_ID` = :VAINQUEUR_ID
        WHERE `MATCHES`.`ID` = :MATCHES_ID");

        $idVainqueur = $winnerTeam->getId();
        $matchId = self::SelectMatchTournament($winnerTeam, $loserTeam);

        if ($matchId === false) {
            return false;
        }

        $query->bindParam(':VAINQUEUR_ID', $idVainqueur, PDO::PARAM_INT);
        $query->bindParam(':MATCHES_ID', $matchId, PDO::PARAM_INT);

        try {
            $insertSuccess = $query->execute();
            return $insertSuccess;
        } catch (PDOException $e) {

            echo "Exception - SetWinner() : " . $e->getMessage();
            return false;
        }
        return false;
    }


    /**
     * Arrange les matchs des équipes
     *
     * @param Tournoi_tM $unTournoi
     * @param array $arr Le tableau des équipes pour lesquels on doit organiser les matches
     * @return array Un tableau qui contient les équipes dans l'ordre des matches, première équipe contre deuxième équipe, troisième contre quatrième équipe etc...
     */
    private static function ArrangeMatchTeams(Tournoi_tM $unTournoi, $arr)
    {
        $finalMatchTeams = array();
        //$count = count($arr);
        for ($i = array_key_first($arr); $i < array_key_last($arr); $i++) {

            $team1 = $arr[$i];

            if (in_array($team1, $finalMatchTeams)) {
                continue;
            }

            $team2 = null;

            $bFound = false;
            for ($y = $i + 1; $y < array_key_last($arr) + 1; $y++) {

                $team2 = $arr[$y];

                if (self::CheckIfTeamsHaveMet($unTournoi, $team1, $team2) == false) {
                    $bFound = true;
                    break;
                }
            }
            if ($bFound && $team2 != null) {
                array_push($finalMatchTeams, $team1);
                array_push($finalMatchTeams, $team2);
            } else {
                //error
                return false;
            }
        }
        return $finalMatchTeams;
    }


    public static function TournamentContinues(Tournoi_tM $unTournoi)
    {

        self::LoadTournamentTeams($unTournoi);
        self::CreateRoundForTournament($unTournoi, 8, "00:02");

        //self::LoadTournamentRounds($unTournoi);


        $query = Database::prepare("SELECT COUNT(`RONDE_has_MATCHES`.`MATCHES_ID`) 
        FROM `tournamentManager`.`RONDE_has_MATCHES`
        HAVING COUNT(`RONDE_has_MATCHES`.`RONDE_ETAPE`) = COUNT(`RONDE_has_MATCHES`.`MATCHES_ID`)");

        $query->execute();

        $tournoiId = $unTournoi->getId();

        $nextRoundAllMatches = array();
        $nextRoundAllMatchesIds = array();


        if ($query->fetch(PDO::FETCH_ASSOC)) {

            $tabWinners = array();
            $tabLosers = array();

            $getPrevLevelQuery = Database::prepare("SELECT MAX(`RONDE_has_MATCHES`.`RONDE_ETAPE`) 
            FROM `tournamentManager`.`RONDE_has_MATCHES`
            WHERE `RONDE_has_MATCHES`.`RONDE_TOURNOIS_ID` = :RONDE_TOURNOIS_ID");

            $getPrevLevelQuery->bindParam(':RONDE_TOURNOIS_ID', $tournoiId, PDO::PARAM_INT);

            $getPrevLevelQuery->execute();

            if ($rowInDb = $getPrevLevelQuery->fetch(PDO::FETCH_ASSOC)) {

                $prevLevel = (int)$rowInDb['MAX(`RONDE_has_MATCHES`.`RONDE_ETAPE`)'];
            }

            $nextRound = $unTournoi->getRounds();
            $currentRound = $nextRound[0];

            $queryGetIdsWinners = Database::prepare("SELECT DISTINCT `MATCHES`.`VAINQUEUR_ID` 
            FROM `tournamentManager`.`MATCHES`
            INNER JOIN `tournamentManager`.`RONDE_has_MATCHES`
            WHERE `MATCHES`.`ID` = `RONDE_has_MATCHES`.`MATCHES_ID`
            AND `RONDE_has_MATCHES`.`RONDE_ETAPE` = :RONDE_ETAPE
            AND `RONDE_has_MATCHES`.`RONDE_TOURNOIS_ID` = :RONDE_TOURNOIS_ID
            ORDER BY `MATCHES`.`ID` DESC
            LIMIT 4;");

            $queryGetIdsWinners->bindParam(':RONDE_ETAPE', $prevLevel, PDO::PARAM_INT);
            $queryGetIdsWinners->bindParam(':RONDE_TOURNOIS_ID', $tournoiId, PDO::PARAM_INT);

            $queryGetIdsWinners->execute();

            while ($rowInDb = $queryGetIdsWinners->fetch(PDO::FETCH_ASSOC)) {

                $equipeWinner = Equipe_tM_Controller::FindTeam((int)$rowInDb['VAINQUEUR_ID']);
                array_push($tabWinners, $equipeWinner);
            }

            $arrWinnersIds = array();

            foreach ($tabWinners as $winnerTeam) {

                $idTeam = (int)$winnerTeam->getId();
                array_push($arrWinnersIds, $idTeam);
            }

            $queryGetIdsLosers = Database::prepare("SELECT DISTINCT `EQUIPE`.`UTILISATEUR_ID`
            FROM `tournamentManager`.`EQUIPE`, `tournamentManager`.`MATCHES`, `tournamentManager`.`RONDE_has_MATCHES`, `tournamentManager`.`TOURNOIS_has_EQUIPE`
            WHERE `RONDE_has_MATCHES`.`RONDE_ETAPE` = :RONDE_ETAPE
            AND `RONDE_has_MATCHES`.`RONDE_TOURNOIS_ID` = :RONDE_TOURNOIS_ID
            AND `EQUIPE`.`UTILISATEUR_ID` = `TOURNOIS_has_EQUIPE`.`EQUIPE_UTILISATEUR_ID`
            AND `EQUIPE`.`UTILISATEUR_ID` NOT IN (
                :winner1, :winner2, :winner3, :winner4
            )");

            $queryGetIdsLosers->bindParam(':RONDE_ETAPE', $prevLevel, PDO::PARAM_INT);
            $queryGetIdsLosers->bindParam(':RONDE_TOURNOIS_ID', $tournoiId, PDO::PARAM_INT);
            $queryGetIdsLosers->bindParam(':winner1', $arrWinnersIds[0], PDO::PARAM_STR);
            $queryGetIdsLosers->bindParam(':winner2', $arrWinnersIds[1], PDO::PARAM_STR);
            $queryGetIdsLosers->bindParam(':winner3', $arrWinnersIds[2], PDO::PARAM_STR);
            $queryGetIdsLosers->bindParam(':winner4', $arrWinnersIds[3], PDO::PARAM_STR);

            $queryGetIdsLosers->execute();

            while ($rowInDb = $queryGetIdsLosers->fetch(PDO::FETCH_ASSOC)) {

                // $equipeLoser = Equipe_tM_Controller::FindTeam((int)$rowInDb['UTILISATEUR_ID']);
                $equipeLoser = $rowInDb['UTILISATEUR_ID'];
                array_push($tabLosers, (int)$equipeLoser);
            }

            $count = 0;
            foreach ($tabLosers as $team) {
                $equipeLoser = Equipe_tM_Controller::FindTeam($team);
                unset($tabLosers[$count]);
                array_push($tabLosers, $equipeLoser);
                $count++;
            }


            // $tabWinners = array_chunk($tabWinners, 2);
            // $tabLosers = array_chunk($tabLosers, 2);

            $arrWinners = self::ArrangeMatchTeams($unTournoi, $tabWinners);
            $arrLosers = self::ArrangeMatchTeams($unTournoi, $tabLosers);

            $arrWinners = array_chunk($arrWinners, 2);
            $arrLosers = array_chunk($arrLosers, 2);


            foreach ($arrWinners as $teamsWinnerMatch) {

                $match = new Match_tM();

                $firstTeam = $teamsWinnerMatch[0];
                $firstTeamId = $firstTeam->getId();

                $secondTeam = $teamsWinnerMatch[1];
                $secondTeamId = $secondTeam->getId();

                $match->setIdTeam1($firstTeamId);
                $match->setIdTeam2($secondTeamId);

                #region Deprecated
                // if (self::CheckIfTeamsHaveMet($unTournoi, $firstTeam, $secondTeam) == false) {

                //     self::CreateMatchTournament($firstTeam, $secondTeam);
                // }

                // $condition = self::CheckIfTeamsHaveMet($unTournoi, $firstTeam, $secondTeam);

                // while ($condition) {

                //     shuffle($tabWinners);
                //     shuffle($tabLosers);

                //     $firstTeam = $teamsWinnerMatch[0];
                //     $firstTeamId = $firstTeam->getId();

                //     $secondTeam = $teamsWinnerMatch[1];
                //     $secondTeamId = $secondTeam->getId();

                //     $match->setIdTeam1($firstTeamId);
                //     $match->setIdTeam2($secondTeamId);

                //     $condition = self::CheckIfTeamsHaveMet($unTournoi, $firstTeam, $secondTeam);
                // }
                #endregion

                self::CreateMatchTournament($firstTeam, $secondTeam);

                array_push($nextRoundAllMatches, $teamsWinnerMatch);
                array_push($nextRoundAllMatchesIds, $match);

                $idMatch = self::SelectMatchTournament($firstTeam, $secondTeam);

                $tournoiId = $unTournoi->getId();
                $levelRound = $currentRound->getLevel();

                $query = Database::prepare("INSERT INTO `RONDE_has_MATCHES` (`RONDE_TOURNOIS_ID`, `RONDE_ETAPE`, `MATCHES_ID`) 
                VALUES (:RONDE_TOURNOIS_ID, :RONDE_ETAPE, :MATCHES_ID)");

                $query->bindParam(':RONDE_TOURNOIS_ID', $tournoiId, PDO::PARAM_INT);
                $query->bindParam(':RONDE_ETAPE', $levelRound, PDO::PARAM_INT);
                $query->bindParam(':MATCHES_ID', $idMatch, PDO::PARAM_INT);

                $query->execute();
            }

            foreach ($arrLosers as $teamsLoserMatch) {

                $match = new Match_tM();

                $firstTeam = $teamsLoserMatch[0];
                $firstTeamId = $firstTeam->getId();

                $secondTeam = $teamsLoserMatch[1];
                $secondTeamId = $secondTeam->getId();

                $match->setIdTeam1($firstTeamId);
                $match->setIdTeam2($secondTeamId);

                #region Deprecated
                // if (self::CheckIfTeamsHaveMet($unTournoi, $firstTeam, $secondTeam) === false) {

                // }

                // while (self::CheckIfTeamsHaveMet($unTournoi, $firstTeam, $secondTeam)) {

                //     shuffle($tabWinners);
                //     shuffle($tabLosers);

                //     $firstTeam = $teamsWinnerMatch[0];
                //     $firstTeamId = $firstTeam->getId();

                //     $secondTeam = $teamsWinnerMatch[1];
                //     $secondTeamId = $secondTeam->getId();

                //     $match->setIdTeam1($firstTeamId);
                //     $match->setIdTeam2($secondTeamId);
                // }

                #endregion

                self::CreateMatchTournament($firstTeam, $secondTeam);

                array_push($nextRoundAllMatches, $teamsLoserMatch);
                array_push($nextRoundAllMatchesIds, $match);

                $idMatch = self::SelectMatchTournament($firstTeam, $secondTeam);

                $tournoiId = $unTournoi->getId();
                $levelRound = $currentRound->getLevel();

                $query = Database::prepare("INSERT INTO `RONDE_has_MATCHES` (`RONDE_TOURNOIS_ID`, `RONDE_ETAPE`, `MATCHES_ID`) 
                VALUES (:RONDE_TOURNOIS_ID, :RONDE_ETAPE, :MATCHES_ID)");

                $query->bindParam(':RONDE_TOURNOIS_ID', $tournoiId, PDO::PARAM_INT);
                $query->bindParam(':RONDE_ETAPE', $levelRound, PDO::PARAM_INT);
                $query->bindParam(':MATCHES_ID', $idMatch, PDO::PARAM_INT);

                $query->execute();
            }


            $currentRound->setMatches($nextRoundAllMatches);
            $currentRound->setMatchesIds($nextRoundAllMatchesIds);

            #region Deprecated

            // $newRoundLevel = $newRound->getLevel();

            // $tabMatchesIds = array();
            // $tabMatchesTeams = array();

            // $newRound->setTournamentId($tournoiId);
            // $newRound->setLevel($newRoundLevel);
            // $newRound->setMatchesIds($tabMatchesIds);
            // $newRound->setMatches($tabMatchesTeams);

            //$unTournoi->setRounds($ronde);
            #endregion
        }


        // self::LoadTournamentRounds($unTournoi);
    }




    public function StopTournament(Tournoi_tM $unTournoi)
    {
    }


    //Create A Round
    public static function CreateRoundForTournament(Tournoi_tM $unTournoi, $nbMatches, $tempsPreparation = "00:00")
    {
        $tabRounds = array();

        $tournoiId = $unTournoi->getId();

        $getPrevLevelQuery = Database::prepare("SELECT MAX(`RONDE_has_MATCHES`.`RONDE_ETAPE`) 
        FROM `tournamentManager`.`RONDE_has_MATCHES`
        WHERE `RONDE_has_MATCHES`.`RONDE_TOURNOIS_ID` = :RONDE_TOURNOIS_ID");

        $getPrevLevelQuery->bindParam(':RONDE_TOURNOIS_ID', $tournoiId, PDO::PARAM_INT);

        $getPrevLevelQuery->execute();

        if ($rowInDb = $getPrevLevelQuery->fetch(PDO::FETCH_ASSOC)) {

            if ($rowInDb['MAX(`RONDE_has_MATCHES`.`RONDE_ETAPE`)'] == null) {
                $nbRound = 1;
            } else {
                $prevNbRound = (int)$rowInDb['MAX(`RONDE_has_MATCHES`.`RONDE_ETAPE`)'];
                $nbRound = $prevNbRound + 1;
            }
        }

        /**
         * For my future self
         * 
         * $nbEquipes = $unTournoi->getNbEquipes();
         * 
         * if($nbEquipes === 8){
         *      $nbRound = 4
         * }else{
         *      $nbRound = 5;
         * }
         */
        $query = Database::prepare("INSERT INTO `RONDE` (`TOURNOIS_ID`, `ETAPE`, `NB_MATCHES`, `TEMPS_PREPARATION`) VALUES (:TOURNOIS_ID, :ETAPE, :NB_MATCHES, :TEMPS_PREPARATION)");

        $tournoiId = $unTournoi->getId();

        $query->bindParam(':TOURNOIS_ID', $tournoiId, PDO::PARAM_INT);
        $query->bindParam(':ETAPE', $nbRound, PDO::PARAM_INT);
        $query->bindParam(':NB_MATCHES', $nbMatches, PDO::PARAM_INT);
        $query->bindParam(':TEMPS_PREPARATION', $tempsPreparation, PDO::PARAM_STR);

        try {
            $query->execute();

            $ronde = new Ronde_tM();
            $tabMatchesIds = array();
            $tabMatchesTeams = array();



            $ronde->setTournamentId($tournoiId);
            $ronde->setLevel($nbRound);
            $ronde->setMatchesIds($tabMatchesIds);
            $ronde->setMatches($tabMatchesTeams);

            array_push($tabRounds, $ronde);
        } catch (PDOException $e) {

            echo "Exception - CreateAllRoundsForTournament() : " . $e->getMessage();
            return false;
        }

        // for ($nbRound = 1; $nbRound <= 5; $nbRound++) {

        // }

        $unTournoi->setRounds($tabRounds);

        if ($nbRound == 1) {
            self::StartTournament($unTournoi);
        }
    }

    public static function StopRound(Tournoi_tM $unTournoi)
    {
        self::LoadTournamentTeams($unTournoi);
        self::LoadTournamentRounds($unTournoi);

        $nbEquipes = $unTournoi->getNbEquipes();
        $nbMatches = $nbEquipes / 2;

        $rounds = $unTournoi->getRounds();
        $lastRound = end($rounds);
        $lastRoundLevel = $lastRound->getLevel();

        $query = Database::prepare("SELECT COUNT(`MATCHES`.`VAINQUEUR_ID`) 
        FROM `tournamentManager`.`MATCHES`
        INNER JOIN `tournamentManager`.`RONDE_has_MATCHES`
        ON `RONDE_has_MATCHES`.`MATCHES_ID` = `MATCHES`.`ID`
        AND `RONDE_has_MATCHES`.`RONDE_ETAPE` = :RONDE_ETAPE");

        $query->bindParam(':RONDE_ETAPE', $lastRoundLevel, PDO::PARAM_INT);


        try {
            $query->execute();

            if ($rowInDb = $query->fetch(PDO::FETCH_ASSOC)) {

                if ((int)$rowInDb['COUNT(`MATCHES`.`VAINQUEUR_ID`)'] === $nbMatches) {

                    self::TournamentContinues($unTournoi);
                }
            }
        } catch (PDOException $e) {

            echo "Exception - SelectMatchTournament() :" . $e->getMessage();
            return false;
        }
    }


    public static function SelectMatchTournament(Equipe_tM $team1, Equipe_tM $team2)
    {
        $query = Database::prepare("SELECT `ID`
        FROM MATCHES
        WHERE (EQUIPE_UTILISATEUR_ID1 = :EQUIPE_UTILISATEUR_ID1 
        AND EQUIPE_UTILISATEUR_ID2 = :EQUIPE_UTILISATEUR_ID2) 
        OR (EQUIPE_UTILISATEUR_ID1 = :EQUIPE_UTILISATEUR_ID2 
        AND EQUIPE_UTILISATEUR_ID2 = :EQUIPE_UTILISATEUR_ID1)");

        $team1Id = $team1->getId();
        $team2Id = $team2->getId();

        $query->bindParam(':EQUIPE_UTILISATEUR_ID1', $team1Id, PDO::PARAM_INT);
        $query->bindParam(':EQUIPE_UTILISATEUR_ID2', $team2Id, PDO::PARAM_INT);

        try {

            $query->execute();

            if ($rowInDb = $query->fetch(PDO::FETCH_ASSOC)) {
                return (int)$rowInDb['ID'];
            }
        } catch (PDOException $e) {
            echo "Exception - SelectMatchTournament() :" . $e->getMessage();
            return false;
        }

        return false;
    }

    public static function CreateMatchTournament(Equipe_tM $team1, Equipe_tM $team2)
    {
        $query = Database::prepare("INSERT INTO `MATCHES` (`EQUIPE_UTILISATEUR_ID1`, `EQUIPE_UTILISATEUR_ID2`) 
        VALUES (:EQUIPE_UTILISATEUR_ID1, :EQUIPE_UTILISATEUR_ID2)");

        $team1Id = $team1->getId();
        $team2Id = $team2->getId();

        $query->bindParam(':EQUIPE_UTILISATEUR_ID1', $team1Id, PDO::PARAM_INT);
        $query->bindParam(':EQUIPE_UTILISATEUR_ID2', $team2Id, PDO::PARAM_INT);

        try {
            $insertSuccess = $query->execute();
            return $insertSuccess;
        } catch (PDOException $e) {

            echo "Exception - CreateMatchTournament() :" . $e->getMessage();
            return false;
        }
        return false;
    }

    public static function CheckIfTeamsHaveMet(Tournoi_tM $unTournoi, Equipe_tM $team1, Equipe_tM $team2)
    {
        $query = Database::prepare("SELECT `ID`, `MATCHES_ID`
        FROM MATCHES, RONDE_has_MATCHES 
        WHERE RONDE_TOURNOIS_ID = :RONDE_TOURNOIS_ID 
        AND MATCHES_ID = ID 
        AND ((EQUIPE_UTILISATEUR_ID1 = :EQUIPE_UTILISATEUR_ID1 
        AND EQUIPE_UTILISATEUR_ID2 = :EQUIPE_UTILISATEUR_ID2) 
        OR (EQUIPE_UTILISATEUR_ID1 = :EQUIPE_UTILISATEUR_ID2 
        AND EQUIPE_UTILISATEUR_ID2 = :EQUIPE_UTILISATEUR_ID1))");

        $tournoiId = $unTournoi->getId();
        $team1Id = $team1->getId();
        $team2Id = $team2->getId();

        $query->bindParam(':RONDE_TOURNOIS_ID', $tournoiId, PDO::PARAM_INT);
        $query->bindParam(':EQUIPE_UTILISATEUR_ID1', $team1Id, PDO::PARAM_INT);
        $query->bindParam(':EQUIPE_UTILISATEUR_ID2', $team2Id, PDO::PARAM_INT);

        try {

            $query->execute();

            if ($query->fetch(PDO::FETCH_ASSOC)) {

                return true;
            }
        } catch (PDOException $e) {

            echo "Exception - CheckIfTeamsHaveMet() :" . $e->getMessage();
            return false;
        }
        return false;
    }

    //Charger les équipes
    /*Tournoi_tM $unTournoi*/
    private static function LoadTournamentTeams(Tournoi_tM $unTournoi)
    {
        $tabTeams = array();

        $query = Database::prepare("SELECT `EQUIPE_UTILISATEUR_ID` 
        FROM `TOURNOIS_has_EQUIPE` 
        WHERE TOURNOIS_ID = :TOURNOIS_ID");

        $tournoiId = $unTournoi->getId();
        $query->bindParam(':TOURNOIS_ID', $tournoiId, PDO::PARAM_INT);
        $query->execute();

        $t_controller = new Equipe_tM_Controller();

        while ($rowInDb = $query->fetch(PDO::FETCH_ASSOC)) {

            $team = $t_controller->FindTeam($rowInDb['EQUIPE_UTILISATEUR_ID']);
            if ($team !== false) {
                array_push($tabTeams, $team);
            }
        }

        $unTournoi->setTeams($tabTeams);
    }


    // Charger les roundes
    private static function LoadTournamentRounds(Tournoi_tM $unTournoi)
    {
        $tabRounds = array();

        // $query = Database::prepare("SELECT `RONDE_TOURNOIS_ID`, `RONDE_ETAPE`, `MATCHES_ID` FROM RONDE_has_MATCHES WHERE RONDE_TOURNOIS_ID = :RONDE_TOURNOIS_ID");
        $query = Database::prepare("SELECT `RONDE_TOURNOIS_ID`, `RONDE_ETAPE`, `MATCHES_ID` 
        FROM RONDE_has_MATCHES 
        WHERE RONDE_TOURNOIS_ID = :RONDE_TOURNOIS_ID 
        ORDER BY `RONDE_TOURNOIS_ID`, `RONDE_ETAPE`");

        $tournoiId = $unTournoi->getId();
        $query->bindParam(":RONDE_TOURNOIS_ID", $tournoiId, PDO::PARAM_INT);
        $query->execute();

        $previousLevel = -1;
        $ronde = null;
        $matchesIds = null;
        while ($rowInDb = $query->fetch(PDO::FETCH_ASSOC)) {

            $level = (int)$rowInDb['RONDE_ETAPE'];

            if ($level != $previousLevel) {

                if ($ronde != null) {

                    $ronde->setMatchesIds($matchesIds);
                    array_push($tabRounds, $ronde);
                }

                $ronde = new Ronde_tM();

                $ronde->setTournamentId($tournoiId);
                $ronde->setLevel($level);
                $matchesIds = array();
            }
            array_push($matchesIds, (int)$rowInDb['MATCHES_ID']);
            // $ronde->setMatches((int)$rowInDb['MATCHES_ID']);

            $previousLevel = $level;
            //array_push($tabRounds, $ronde);
        }

        if ($ronde != null) {
            $ronde->setMatchesIds($matchesIds);
            array_push($tabRounds, $ronde);
        }
        $unTournoi->setRounds($tabRounds);

        //Parcourir les rondes et on récupère les matches
        foreach ($tabRounds as $round) {

            $tabMatches = array();
            foreach ($round->getMatchesIds() as $matchId) {


                $query = Database::prepare("SELECT `EQUIPE_UTILISATEUR_ID1`, `EQUIPE_UTILISATEUR_ID2`, `VAINQUEUR_ID`
                FROM MATCHES, RONDE_has_MATCHES 
                WHERE  RONDE_TOURNOIS_ID = :RONDE_TOURNOIS_ID 
                AND `MATCHES`.`ID` = :MATCHES_ID");

                $query->bindParam(":RONDE_TOURNOIS_ID", $tournoiId, PDO::PARAM_INT);
                $query->bindParam(":MATCHES_ID", $matchId, PDO::PARAM_INT);
                $query->execute();

                if ($rowInDb = $query->fetch(PDO::FETCH_ASSOC)) {

                    $match = new Match_tM();

                    $match->setIdTeam1((int)$rowInDb['EQUIPE_UTILISATEUR_ID1']);
                    $match->setIdTeam2((int)$rowInDb['EQUIPE_UTILISATEUR_ID2']);
                    $match->setIdWinner((int)$rowInDb['VAINQUEUR_ID']);

                    array_push($tabMatches, $match);
                }
            }
            $round->setMatches($tabMatches);
        }
        // $round->setMatches($tabMatches);
    }


    public function GetIntermediateResultsOfTeam(Tournoi_tM $unTournoi, $rondeEtape, Equipe_tM $aTeam)
    {
        $tournoiId = $unTournoi->getId();
        $teamId = $aTeam->getId();


        $query = Database::prepare("SELECT COUNT(`MATCHES`.`VAINQUEUR_ID`)
        FROM `tournamentManager`.`MATCHES`
        INNER JOIN `tournamentManager`.`RONDE_has_MATCHES`
        WHERE `RONDE_has_MATCHES`.`RONDE_TOURNOIS_ID` = :RONDE_TOURNOIS_ID
        AND `RONDE_has_MATCHES`.`RONDE_ETAPE` = :RONDE_ETAPE
        AND `RONDE_has_MATCHES`.`MATCHES_ID` = `MATCHES`.`ID`
        AND `MATCHES`.`VAINQUEUR_ID` = :VAINQUEUR_ID");

        $query->bindParam(':RONDE_TOURNOIS_ID', $tournoiId, PDO::PARAM_INT);
        $query->bindParam(':RONDE_ETAPE', $rondeEtape, PDO::PARAM_INT);
        $query->bindParam(':VAINQUEUR_ID', $teamId, PDO::PARAM_INT);


        try {

            $query->execute();

            if ($rowInDb = $query->fetch(PDO::FETCH_ASSOC)) {

                $result = (int)$rowInDb['COUNT(`MATCHES`.`VAINQUEUR_ID`)'];
                return $result;
            }
        } catch (PDOException $e) {
        }

        return false;
    }

    public function GetTournamentRounds(Tournoi_tM $unTournoi)
    {
        $tabRounds = array();

        // $query = Database::prepare("SELECT `RONDE_TOURNOIS_ID`, `RONDE_ETAPE`, `MATCHES_ID` FROM RONDE_has_MATCHES WHERE RONDE_TOURNOIS_ID = :RONDE_TOURNOIS_ID");
        $query = Database::prepare("SELECT `RONDE_TOURNOIS_ID`, `RONDE_ETAPE`, `MATCHES_ID` 
        FROM RONDE_has_MATCHES 
        WHERE RONDE_TOURNOIS_ID = :RONDE_TOURNOIS_ID 
        ORDER BY `RONDE_TOURNOIS_ID`, `RONDE_ETAPE`");

        $tournoiId = $unTournoi->getId();
        $query->bindParam(":RONDE_TOURNOIS_ID", $tournoiId, PDO::PARAM_INT);
        $query->execute();

        $previousLevel = -1;
        $ronde = null;
        $matchesIds = null;
        while ($rowInDb = $query->fetch(PDO::FETCH_ASSOC)) {

            $level = (int)$rowInDb['RONDE_ETAPE'];

            if ($level != $previousLevel) {

                if ($ronde != null) {

                    $ronde->setMatchesIds($matchesIds);
                    array_push($tabRounds, $ronde);
                }

                $ronde = new Ronde_tM();

                $ronde->setTournamentId($tournoiId);
                $ronde->setLevel($level);
                $matchesIds = array();
            }
            array_push($matchesIds, (int)$rowInDb['MATCHES_ID']);
            // $ronde->setMatches((int)$rowInDb['MATCHES_ID']);

            $previousLevel = $level;
            //array_push($tabRounds, $ronde);
        }

        if ($ronde != null) {
            $ronde->setMatchesIds($matchesIds);
            array_push($tabRounds, $ronde);
        }
        $unTournoi->setRounds($tabRounds);

        //Parcourir les rondes et on récupère les matches
        foreach ($tabRounds as $round) {

            $tabMatches = array();
            foreach ($round->getMatchesIds() as $matchId) {


                $query = Database::prepare("SELECT `EQUIPE_UTILISATEUR_ID1`, `EQUIPE_UTILISATEUR_ID2`, `VAINQUEUR_ID`
                FROM MATCHES, RONDE_has_MATCHES 
                WHERE  RONDE_TOURNOIS_ID = :RONDE_TOURNOIS_ID 
                AND `MATCHES`.`ID` = :MATCHES_ID");

                $query->bindParam(":RONDE_TOURNOIS_ID", $tournoiId, PDO::PARAM_INT);
                $query->bindParam(":MATCHES_ID", $matchId, PDO::PARAM_INT);
                $query->execute();

                if ($rowInDb = $query->fetch(PDO::FETCH_ASSOC)) {

                    $match = new Match_tM();

                    $match->setIdTeam1((int)$rowInDb['EQUIPE_UTILISATEUR_ID1']);
                    $match->setIdTeam2((int)$rowInDb['EQUIPE_UTILISATEUR_ID2']);
                    $match->setIdWinner((int)$rowInDb['VAINQUEUR_ID']);

                    array_push($tabMatches, $match);
                }
            }
            $round->setMatches($tabMatches);
        }

        return $tabRounds;
    }

    #endregion

}
