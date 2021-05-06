<?php

/**
 * @author Iliya Saroukhanian <iliya.srkhn@eduge.ch>
 * @copyright 2021 Iliya Saroukhanian
 * @version 1.0.0
 */

require_once('./src/model/db_model/database.php');
require_once('./src/model/classes/utilisateur_tM.php');

/**
 * Contrôleur de la classe Utilisateur_tM
 */
class Utilisateur_tM_Controller
{
    private Utilisateur_tM $user_tM;

    /**
     * Get the value of user_tM
     *
     * @return Utilisateur_tM
     */
    public function getUserTM(): Utilisateur_tM
    {
        return $this->user_tM;
    }

    /**
     * Set the value of user_tM
     *
     * @param Utilisateur_tM $user_tM
     *
     * @return self
     */
    public function setUserTM(Utilisateur_tM $user_tM): self
    {
        $this->user_tM = $user_tM;

        return $this;
    }



    public function CheckIfEmailExists($anEmail): bool
    {
        $query = Database::prepare("SELECT * FROM UTILISATEUR WHERE `EMAIL` = :EMAIL");

        $query->bindParam(':EMAIL', $anEmail, PDO::PARAM_STR);

        try {

            $query->execute();
            $userExists = $query->fetch();

            if ($userExists != false) {
                $userExists = true;
            }

            return $userExists;
        } catch (PDOException $e) {

            return false;
        }
    }


    /**
     * Fonction qui vérifie si l'email et le mot de passe fournis correspondent à un
     * enregistrement dans la BDD
     *
     * @param string $anEmail
     * @param string $aPassword
     * @return boolean
     */
    public function CheckIfUserExists($anEmail, $hashedPwd): bool
    {
        $query = Database::prepare("SELECT * FROM UTILISATEUR WHERE `EMAIL` = :EMAIL AND `MDP` = :MDP");

        $query->bindParam(':EMAIL', $anEmail, PDO::PARAM_STR);
        $query->bindParam(':EMAIL', $hashedPwd, PDO::PARAM_STR);
        try {

            $query->execute();
            $userExists = $query->fetch();

            return $userExists;
        } catch (PDOException $e) {

            return false;
        }
    }

    public function GetHashPassword($anEmail): string
    {
        $query = Database::prepare("SELECT MDP FROM UTILISATEUR WHERE `EMAIL` = :EMAIL");

        $query->bindParam(':EMAIL', $anEmail, PDO::PARAM_STR);
        $query->setFetchMode(PDO::FETCH_ASSOC);

        try {
            $query->execute();
            $queryResult = $query->fetch();

            $pwd = $queryResult['MDP'];

            return $pwd;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function GetNicknameOfUser($anEmail): string
    {
        $query = Database::prepare("SELECT `NICKNAME` FROM UTILISATEUR WHERE `EMAIL` = :EMAIL");

        $query->bindParam(':EMAIL', $anEmail, PDO::PARAM_STR);
        $query->setFetchMode(PDO::FETCH_ASSOC);

        try {
            $query->execute();
            $queryResult = $query->fetch();

            $nickname = $queryResult['NICKNAME'];

            return $nickname;
        } catch (PDOException $e) {
            return false;
        }
    }


    /**
     * Fonction qui retourne un tableau d'objets, chaque objet dans le tableau est un utilisateur
     *
     * @return array
     */
    public function SelectAll(): array
    {
        $results = array();

        $query = Database::prepare("SELECT `ID`, `NICKNAME`, `EMAIL`, `MDP`, `ADMIN` FROM UTILISATEUR");
        $query->execute();

        while ($rowInDb = $query->fetch(PDO::FETCH_ASSOC)) {

            $utilisateur = new Utilisateur_tM();

            $utilisateur->setId($rowInDb['ID']);
            $utilisateur->setNickname($rowInDb['NICKNAME']);
            $utilisateur->setEmail($rowInDb['EMAIL']);
            $utilisateur->setMdp($rowInDb['MDP']);
            $utilisateur->setAdmin((int)$rowInDb['ADMIN']);

            array_push($results, $utilisateur);
        }

        return $results;
    }
}
