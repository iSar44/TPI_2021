<?php

/**
 * @author Iliya Saroukhanian <iliya.srkhn@eduge.ch>
 * @copyright 2021 Iliya Saroukhanian
 * @version 1.0.0
 */

require_once('./src/web.inc.all.php');

/**
 * Classe qui représente le contrôleur de la classe Equipe_tM
 */
class Equipe_tM_Controller
{

    private Equipe_tM $equipe_tM;

    /**
     * Get the value of equipe_tM
     *
     * @return Equipe_tM
     */
    public function getEquipeTM(): Equipe_tM
    {
        return $this->equipe_tM;
    }

    /**
     * Set the value of equipe_tM
     *
     * @param Equipe_tM $equipe_tM
     *
     * @return self
     */
    public function setEquipeTM(Equipe_tM $equipe_tM): self
    {
        $this->equipe_tM = $equipe_tM;

        return $this;
    }

    /**
     * Fonction qui retourne un tableau contenant toutes les équipes stockées dans la base de données
     *
     * @return array $resultEquipes
     */
    public function SelectAll(): array
    {
        $resultEquipes = array();

        $query = Database::prepare("SELECT `UTILISATEUR_ID`, `NOM_EQUIPE` FROM EQUIPE");
        $query->execute();

        while ($rowInDb = $query->fetch(PDO::FETCH_ASSOC)) {

            $equipe = new Equipe_tM();

            $equipe->setId((int)$rowInDb['UTILISATEUR_ID']);
            $equipe->setNomEquipe($rowInDb['NOM_EQUIPE']);

            array_push($resultEquipes, $equipe);
        }

        return $resultEquipes;
    }

    /**
     * Fonction qui retourne l'équipe (objet) associée à l'ID passé en paramètre
     *
     * @param integer $idUser
     * @return Equipe_tM $equipe
     */
    public static function FindTeam($idUser): Equipe_tM
    {
        $query = Database::prepare("SELECT `UTILISATEUR_ID`, `NOM_EQUIPE`, `NICKNAME`, `EMAIL`, `ADMIN` FROM `EQUIPE`, `UTILISATEUR` WHERE UTILISATEUR_ID = :UTILISATEUR_ID AND ID = :ID");
        $query->bindParam(':UTILISATEUR_ID', $idUser, PDO::PARAM_INT);
        $query->bindParam(':ID', $idUser, PDO::PARAM_INT);

        try {
            $query->execute();
            if ($rowInDb = $query->fetch(PDO::FETCH_ASSOC)) {

                $equipe = new Equipe_tM();

                $equipe->setId((int)$rowInDb['UTILISATEUR_ID']);
                $equipe->setNomEquipe($rowInDb['NOM_EQUIPE']);
                $equipe->setNickname($rowInDb['NICKNAME']);
                $equipe->setEmail($rowInDb['EMAIL']);
                $equipe->setAdmin((int)$rowInDb['ADMIN']);

                return $equipe;
            }
        } catch (PDOException $e) {
            echo "Exception - function FindTeam(idUser): " . $e->getMessage();
            return false;
        }

        return false;
    }

    /**
     * Fonction qui retourne l'équipe (objet) associée au nom de l'équipe passé en paramètre
     *
     * @param string $teamName
     * @return Equipe_tM $equipe
     */
    public static function FindTeamByTeamname($teamName): Equipe_tM
    {
        $toUpperCaseName = strtoupper($teamName);

        $query = Database::prepare("SELECT `UTILISATEUR_ID`, `NOM_EQUIPE`, `NICKNAME`, `EMAIL`, `ADMIN` FROM `EQUIPE`, `UTILISATEUR` WHERE NOM_EQUIPE = :NOM_EQUIPE AND NICKNAME = :NICKNAME");
        $query->bindParam(':NOM_EQUIPE', $toUpperCaseName, PDO::PARAM_STR);
        $query->bindParam(':NICKNAME', $teamName, PDO::PARAM_STR);

        try {
            $query->execute();
            if ($rowInDb = $query->fetch(PDO::FETCH_ASSOC)) {

                $equipe = new Equipe_tM();

                $equipe->setId((int)$rowInDb['UTILISATEUR_ID']);
                $equipe->setNomEquipe($rowInDb['NOM_EQUIPE']);
                $equipe->setNickname($rowInDb['NICKNAME']);
                $equipe->setEmail($rowInDb['EMAIL']);
                $equipe->setAdmin((int)$rowInDb['ADMIN']);

                return $equipe;
            }
        } catch (PDOException $e) {
            echo "Exception - function FindTeamByTeamname(teamName): " . $e->getMessage();
            return false;
        }

        return false;
    }

    /**
     * Fonction qui retourne le nom de l'équipe associé à l'ID passé en paramètre
     *
     * @param integer $idUser
     * @return string $name
     */
    public function GetTeamName($idUser): string
    {
        $query = Database::prepare("SELECT `EQUIPE`.`NOM_EQUIPE`
        FROM `tournamentManager`.`EQUIPE`
        WHERE `EQUIPE`.`UTILISATEUR_ID` = :UTILISATEUR_ID");

        $query->bindParam(':UTILISATEUR_ID', $idUser, PDO::PARAM_INT);

        try {
            $query->execute();

            if ($rowInDb = $query->fetch(PDO::FETCH_ASSOC)) {

                $name = $rowInDb['NOM_EQUIPE'];

                return $name;
            }
        } catch (PDOException $e) {
            echo "Exception - function GetTeamName(idUser): " . $e->getMessage();
            return false;
        }

        return false;
    }


    /**
     * Fonction qui retourne un tableau des noms des équipes associées au tournoi passé en paramètre
     *
     * @param Tournoi_tM $unTournoi
     * @return array $tabTeamNames
     */
    public function GetTeamNamesInTournament(Tournoi_tM $unTournoi): array
    {
        $tabTeamNames = array();

        $query = Database::prepare("SELECT DISTINCT `EQUIPE`.`NOM_EQUIPE`
        FROM `tournamentManager`.`EQUIPE`
        INNER JOIN `tournamentManager`.`TOURNOIS_has_EQUIPE`
        WHERE `TOURNOIS_has_EQUIPE`.`EQUIPE_UTILISATEUR_ID` = `EQUIPE`.`UTILISATEUR_ID`
        AND `TOURNOIS_has_EQUIPE`.`TOURNOIS_ID` = :TOURNOIS_ID");

        $tournoiId = $unTournoi->getId();
        $query->bindParam(':TOURNOIS_ID', $tournoiId, PDO::PARAM_INT);


        try {

            $query->execute();

            while ($rowInDb = $query->fetch(PDO::FETCH_ASSOC)) {

                $teamName = $rowInDb['NOM_EQUIPE'];
                array_push($tabTeamNames, $teamName);
            }

            return $tabTeamNames;
        } catch (PDOException $e) {
            echo "Exception - function GetTeamNamesInTournament(Tournoi_tM unTournoi): " . $e->getMessage();
            return false;
        }

        return false;
    }

    /**
     * Fonction qui retourne la totalité des résultats d'une équipe inscrite à un tournoi
     *
     * @param Tournoi_tM $unTournoi
     * @param Equipe_tM $uneEquipe
     * @return array $userStatInfo
     */
    public static function GetTeamResultsFromTournament(Tournoi_tM $unTournoi, Equipe_tM $uneEquipe): array
    {
        $query = Database::prepare("SELECT COUNT(`MATCHES`.`VAINQUEUR_ID`)
        FROM `tournamentManager`.`MATCHES`
        INNER JOIN `tournamentManager`.`RONDE_has_MATCHES`
        WHERE `RONDE_has_MATCHES`.`RONDE_TOURNOIS_ID` = :RONDE_TOURNOIS_ID
        AND `RONDE_has_MATCHES`.`MATCHES_ID` = `MATCHES`.`ID`
        AND `MATCHES`.`VAINQUEUR_ID` IN ( :TEAM_ID )");

        $tournoiId = $unTournoi->getId();
        $teamId = $uneEquipe->getId();

        $userStatInfo = array();


        $query->bindParam(':RONDE_TOURNOIS_ID', $tournoiId, PDO::PARAM_INT);
        $query->bindParam(':TEAM_ID', $teamId, PDO::PARAM_INT);


        try {

            $query->execute();

            if ($rowInDb = $query->fetch(PDO::FETCH_ASSOC)) {

                $equipe = new Equipe_tM();

                $equipe->setId($uneEquipe->getId());
                $equipe->setNomEquipe($uneEquipe->getNomEquipe());
                $equipe->setNickname($uneEquipe->getNickname());
                $equipe->setEmail($uneEquipe->getEmail());


                $nbVictoires = (int)$rowInDb['COUNT(`MATCHES`.`VAINQUEUR_ID`)'];

                array_push($userStatInfo, $equipe, $nbVictoires);
            }

            return $userStatInfo;
        } catch (PDOException $e) {
            echo "Exception - function GetTeamResultsFromTournament(Tournoi_tM unTournoi, Equipe_tM uneEquipe): " . $e->getMessage();
            return false;
        }

        return false;
    }


    /**
     * Fonction qui permet de vérifier si une équipe est déjà inscrite à un tournoi passé en paramètre
     *
     * @param Tournoi_tM $unTournoi
     * @param Equipe_tM $uneEquipe
     * @return boolean
     */
    public function CheckIfTeamIsRegistered(Tournoi_tM $unTournoi, Equipe_tM $uneEquipe): bool
    {
        $query = Database::prepare("SELECT `TOURNOIS_has_EQUIPE`.`TOURNOIS_ID`, `TOURNOIS_has_EQUIPE`.`EQUIPE_UTILISATEUR_ID`
        FROM `tournamentManager`.`TOURNOIS_has_EQUIPE`
        WHERE `TOURNOIS_has_EQUIPE`.`TOURNOIS_ID` = :TOURNOIS_ID
        AND `TOURNOIS_has_EQUIPE`.`EQUIPE_UTILISATEUR_ID` = :UTILISATEUR_ID");

        $tournoiId = $unTournoi->getId();
        $equipeId = $uneEquipe->getId();

        $query->bindParam(':TOURNOIS_ID', $tournoiId, PDO::PARAM_INT);
        $query->bindParam(':UTILISATEUR_ID', $equipeId, PDO::PARAM_INT);


        try {

            $query->execute();
            if ($query->fetch(PDO::FETCH_ASSOC)) {

                return true;
            }
        } catch (PDOException $e) {
            echo "Exception - function CheckIfTeamIsRegistered(Tournoi_tM unTournoi, Equipe_tM uneEquipe): " . $e->getMessage();
            return false;
        }

        return false;
    }
}
