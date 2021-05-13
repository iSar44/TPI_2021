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

            $equipe->setId($rowInDb['UTILISATEUR_ID']);
            $equipe->setNomEquipe($rowInDb['NOM_EQUIPE']);

            array_push($resultEquipes, $equipe);
        }

        return $resultEquipes;
    }

    public function FindTeam($idUser)
    {
        $query = Database::prepare("SELECT `UTILISATEUR_ID`, `NOM_EQUIPE`, `NICKNAME`, `EMAIL`, `ADMIN` FROM `EQUIPE`, `UTILISATEUR` WHERE UTILISATEUR_ID = :UTILISATEUR_ID AND ID = :ID");
        $query->bindParam(':UTILISATEUR_ID', $idUser, PDO::PARAM_INT);
        $query->bindParam(':ID', $idUser, PDO::PARAM_INT);

        try {
            $query->execute();
            if ($rowInDb = $query->fetch(PDO::FETCH_ASSOC)) {

                $equipe = new Equipe_tM();

                $equipe->setId($rowInDb['UTILISATEUR_ID']);
                $equipe->setNomEquipe($rowInDb['NOM_EQUIPE']);
                $equipe->setNickname($rowInDb['NICKNAME']);
                $equipe->setEmail($rowInDb['EMAIL']);
                $equipe->setAdmin($rowInDb['ADMIN']);

                return $equipe;
            }
        } catch (PDOException $e) {
            echo "Exception - function FindTeam(idUser): " . $e->getMessage();
            return false;
        }

        return false;
    }
}
