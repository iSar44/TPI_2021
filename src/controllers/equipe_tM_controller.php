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

    public function SelectAll()
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

    public static function FindTeam($idUser)
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

    public static function FindTeamByTeamname($teamName)
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
            echo "Exception - function FindTeam(idUser): " . $e->getMessage();
            return false;
        }

        return false;
    }

    public function GetTeamName($idUser)
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


    public function GetTeamNamesInTournament(Tournoi_tM $unTournoi)
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


    public function CheckIfTeamIsRegistered(Tournoi_tM $unTournoi, Equipe_tM $uneEquipe)
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
