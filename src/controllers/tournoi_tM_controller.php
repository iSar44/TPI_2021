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

    public function SelectTournament($idTournoi)
    {
        $query = Database::prepare("SELECT `ID`, `TITRE`, `DESCRIPTION`, `DATE_HEURE_DEMARRAGE`, `NB_EQUIPES`, `DATE_HEURE_DEBUT_INSCRIPTION`, `DATE_HEURE_FIN_INSCRIPTION`, `TEMPS_ENTRE_RONDES` FROM TOURNOIS WHERE `ID` = :ID");

        $query->bindParam(":ID", $idTournoi, PDO::PARAM_INT);
        $query->setFetchMode(PDO::FETCH_ASSOC);

        try {
            $query->execute();

            if ($rowInDb = $query->fetch()) {

                $tournoi = new Tournoi_tM();

                $tournoi->setId($rowInDb['ID']);
                $tournoi->setTitre($rowInDb['TITRE']);
                $tournoi->setDescription($rowInDb['DESCRIPTION']);
                $tournoi->setDateHeureDemarrage($rowInDb['DATE_HEURE_DEMARRAGE']);
                $tournoi->setNbEquipes($rowInDb['NB_EQUIPES']);
                $tournoi->setDateHeureDebutInscription($rowInDb['DATE_HEURE_DEBUT_INSCRIPTION']);
                $tournoi->setDateHeureFinInscription($rowInDb['DATE_HEURE_FIN_INSCRIPTION']);
                $tournoi->setTempsEntreRondes($rowInDb['TEMPS_ENTRE_RONDES']);

                // Charger les équipes
                self::LoadTournamentTeams($tournoi);
                // Charger les roundes
                //self::LoadTournamentRounds($tournoi);

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

    public function CreateRoundTournament(Tournoi_tM $unTournoi, $level)
    {
    }

    //Charger les équipes
    private static function LoadTournamentTeams(Tournoi_tM $unTournoi)
    {
        $arr = array();

        $query = Database::prepare("SELECT `EQUIPE_UTILISATEUR_ID` FROM `TOURNOIS_has_EQUIPE` WHERE TOURNOIS_ID = :ID");
        $query->bindParam(":ID", $unTournoi->getId());
        $query->execute();

        while ($rowInDb = $query->fetch(PDO::FETCH_ASSOC)) {

            $t = FindTeam($rowInDb['EQUIPE_UTILISATEUR_ID']);
            if ($t !== false)
                array_push($arr, $t);
        }
        $unTournoi->setTeams($arr);
    }


    // Charger les roundes
    private static function LoadTournamentRounds(Tournoi_tM $unTournoi)
    {
        $tabRounds = array();

        $query = Database::prepare("SELECT `ID`, `TITRE`, `DESCRIPTION`, `DATE_HEURE_DEMARRAGE`, `NB_EQUIPES`, `DATE_HEURE_DEBUT_INSCRIPTION`, `DATE_HEURE_FIN_INSCRIPTION`, `TEMPS_ENTRE_RONDES` FROM TOURNOIS");
        $query->bindParam(":ID", $unTournoi->getId());
        $query->execute();

        while ($rowInDb = $query->fetch(PDO::FETCH_ASSOC)) {

            $ronde = new Ronde_tM();

            $ronde->setMatches($rowInDb['']);
            $ronde->setTournamentId($rowInDb['']);
            $ronde->setLevel($rowInDb['']);

            array_push($tabRounds, $ronde);
        }
        $unTournoi->setRounds($tabRounds);

        // Parcourir les rondes et on récupère les matches
        foreach ($tabRounds as $round) {

            $tabMatches = array();

            $query = Database::prepare("SELECT `ID`, `TITRE`, `DESCRIPTION`, `DATE_HEURE_DEMARRAGE`, `NB_EQUIPES`, `DATE_HEURE_DEBUT_INSCRIPTION`, `DATE_HEURE_FIN_INSCRIPTION`, `TEMPS_ENTRE_RONDES` FROM TOURNOIS");
            $query->bindParam(":ID", $tournoi->getId());
            $query->execute();

            while ($rowInDb = $query->fetch(PDO::FETCH_ASSOC)) {

                $match = new Match_tM();

                $match->setIdTeam1($rowInDb['ID']);
                $match->setIdTeam2($rowInDb['TITRE']);
                $match->setIdWinner($rowInDb['DESCRIPTION']);

                array_push($matches, $match);
            }
            $rnd->setMatches($matches);
        }
    }

    #endregion

}
