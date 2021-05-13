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
        $query = Database::prepare("INSERT INTO `TOURNOIS` (`TITRE`, `DESCRIPTION`, `DATE_HEURE_DEMARRAGE`, `NB_EQUIPES`, `DATE_HEURE_DEBUT_INSCRIPTION`, `DATE_HEURE_FIN_INSCRIPTION`, `TEMPS_ENTRE_RONDES`) VALUES (:TITRE, :DESCRIPTION, :DATE_HEURE_DEMARRAGE, :NB_EQUIPES, :DATE_HEURE_DEBUT_INSCRIPTION, :DATE_HEURE_FIN_INSCRIPTION, :TEMPS_ENTRE_RONDES)");

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

    public static function SelectTournament($idTournoi)
    {
        $query = Database::prepare("SELECT `ID`, `TITRE`, `DESCRIPTION`, `DATE_HEURE_DEMARRAGE`, `NB_EQUIPES`, `DATE_HEURE_DEBUT_INSCRIPTION`, `DATE_HEURE_FIN_INSCRIPTION`, `TEMPS_ENTRE_RONDES` FROM TOURNOIS WHERE `ID` = :ID");

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
                self::LoadTournamentTeams($tournoi);
                // Charger les roundes
                self::LoadTournamentRounds($tournoi);

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

        $query = Database::prepare("SELECT `ID`, `TITRE`, `DESCRIPTION`, `DATE_HEURE_DEMARRAGE`, `NB_EQUIPES`, `DATE_HEURE_DEBUT_INSCRIPTION`, `DATE_HEURE_FIN_INSCRIPTION`, `TEMPS_ENTRE_RONDES` FROM TOURNOIS");
        $query->execute();

        while ($rowInDb = $query->fetch(PDO::FETCH_ASSOC)) {

            $tournoi = new Tournoi_tM();

            $tournoi->setId($rowInDb['ID']);
            $tournoi->setTitre($rowInDb['TITRE']);
            $tournoi->setDescription($rowInDb['DESCRIPTION']);
            $tournoi->setDateHeureDemarrage($rowInDb['DATE_HEURE_DEMARRAGE']);
            $tournoi->setNbEquipes($rowInDb['NB_EQUIPES']);
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
    public function DeleteTournament($idTournoi): bool
    {
        $query = Database::prepare("DELETE FROM TOURNOIS WHERE ID = :ID");

        $query->bindParam(":ID", $idTournoi);

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
        $query = Database::prepare("UPDATE TOURNOIS SET `TITRE` = :TITRE, `DESCRIPTION` = :DESCRIPTION, `DATE_HEURE_DEMARRAGE` = :DATE_HEURE_DEMARRAGE, `NB_EQUIPES` = :NB_EQUIPES, `DATE_HEURE_DEBUT_INSCRIPTION` = :DATE_HEURE_DEBUT_INSCRIPTION, `DATE_HEURE_FIN_INSCRIPTION` = :DATE_HEURE_FIN_INSCRIPTION, `TEMPS_ENTRE_RONDES` = :TEMPS_ENTRE_RONDES WHERE `ID` = :ID");

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

    public function RegisterTeam($idTournoi, $idEquipe)
    {
        $query = Database::prepare("INSERT INTO TOURNOIS_has_EQUIPE (`TOURNOIS_ID`, `EQUIPE_UTILISATEUR_ID`) VALUES (:TOURNOIS_ID, :EQUIPE_UTILISATEUR_ID)");

        // $tournoiId = $unTournoi->getId();
        // $utilisateurId = $equipe->getId();

        $query->bindParam(':TOURNOIS_ID', $idTournoi, PDO::PARAM_INT);
        $query->bindParam(':EQUIPE_UTILISATEUR_ID', $idEquipe, PDO::PARAM_INT);

        try {

            $insertSuccess = $query->execute();
            return $insertSuccess;
        } catch (PDOException $e) {

            echo "Exception - RegisterTeam() :" . $e->getMessage();
            return false;
        }
        return false;
    }


    public function UnregisterTeam($idTournoi, $idEquipe)
    {
        $query = Database::prepare("DELETE FROM TOURNOIS_has_EQUIPE WHERE TOURNOIS_ID = :TOURNOIS_ID AND EQUIPE_UTILISATEUR_ID = :EQUIPE_UTILISATEUR_ID");

        // $idTournoi = $unTournoi->getId();
        // $idUtilisateur = $uneEquipe->getId();

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

    public function StartTournament(Tournoi_tM $unTournoi)
    {
    }

    public function StopTournament(Tournoi_tM $unTournoi)
    {
    }

    public function CreateRoundTournament(Tournoi_tM $unTournoi, $level, $nbMatches, $tempsPreparation = "00:00")
    {

        $query = Database::prepare("INSERT INTO `RONDE` (`TOURNOIS_ID`, `ETAPE`, `NB_MATCHES`, `TEMPS_PREPARATION`) VALUES (:TOURNOIS_ID, :ETAPE, :NB_MATCHES, :TEMPS_PREPARATION)");

        $tournoiId = $unTournoi->getId();

        $query->bindParam(':TOURNOIS_ID', $tournoiId, PDO::PARAM_INT);
        $query->bindParam(':ETAPE', $level, PDO::PARAM_INT);
        $query->bindParam(':NB_MATCHES', $nbMatches, PDO::PARAM_INT);
        $query->bindParam(':TEMPS_PREPARATION', $tempsPreparation, PDO::PARAM_STR);

        try {
            $insertSuccess = $query->execute();
            return $insertSuccess;
        } catch (PDOException $e) {

            echo "Exception - CreateRoundTournament() :" . $e->getMessage();
            return false;
        }
        return false;
    }



    public function CreateMatchTournament(Equipe_tM $team1, Equipe_tM $team2)
    {
        $query = Database::prepare("INSERT INTO `MATCHES` (`EQUIPE_UTILISATEUR_ID1`, `EQUIPE_UTILISATEUR_ID2`) VALUES (:EQUIPE_UTILISATEUR_ID1, :EQUIPE_UTILISATEUR_ID2)");

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

    public function CheckIfTeamsHaveMet(Tournoi_tM $unTournoi, Equipe_tM $team1, Equipe_tM $team2)
    {
        $query = Database::prepare("SELECT `ID`, `MATCHES_ID`
        FROM MATCHES, RONDE_has_MATCHES 
        WHERE RONDE_TOURNOIS_ID = :RONDE_TOURNOIS_ID 
        AND MATCHES_ID = ID 
        AND ((EQUIPE_UTILISATEUR_ID1 = :EQUIPE_UTILISATEUR_ID1 AND EQUIPE_UTILISATEUR_ID2 = :EQUIPE_UTILISATEUR_ID2) OR (EQUIPE_UTILISATEUR_ID1 = :EQUIPE_UTILISATEUR_ID2 AND EQUIPE_UTILISATEUR_ID2 = :EQUIPE_UTILISATEUR_ID1))");

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

        $query = Database::prepare("SELECT `EQUIPE_UTILISATEUR_ID` FROM `TOURNOIS_has_EQUIPE` WHERE TOURNOIS_ID = :TOURNOIS_ID");

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
        $query = Database::prepare("SELECT `RONDE_TOURNOIS_ID`, `RONDE_ETAPE`, `MATCHES_ID` FROM RONDE_has_MATCHES WHERE RONDE_TOURNOIS_ID = :RONDE_TOURNOIS_ID ORDER BY `RONDE_TOURNOIS_ID`, `RONDE_ETAPE`");

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


                $query = Database::prepare("SELECT `EQUIPE_UTILISATEUR_ID1`, `EQUIPE_UTILISATEUR_ID2`, `VAINQUEUR_ID` FROM MATCHES, RONDE_has_MATCHES WHERE  RONDE_TOURNOIS_ID = :RONDE_TOURNOIS_ID AND `MATCHES`.`ID` = :MATCHES_ID");
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

    #endregion

}
