<?php

/**
 * @author Iliya Saroukhanian <iliya.srkhn@eduge.ch>
 * @copyright 2021 Iliya Saroukhanian
 * @version 1.0.0
 */

require_once('./src/web.inc.all.php');

/**
 * Classe qui représente le contrôleur de la classe Utilisateur_tM
 */
class Utilisateur_tM_Controller
{
    #region Champ
    private Utilisateur_tM $user_tM;
    #endregion

    #region Accesseur/Mutateur
    /**
     * Accesseur qui retourne l'utilisateur
     *
     * @return Utilisateur_tM
     */
    public function getUserTM(): Utilisateur_tM
    {
        return $this->user_tM;
    }

    /**
     * Mutateur qui "set" l'utilisateur
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


    /**
     * Fonction qui vérifie si l'email passé en paramètre existe déjà dans la base de données
     *
     * @param string $anEmail
     * @return boolean
     */
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

            return $e->getMessage();
        }
    }


    /**
     * Fonction qui vérifie si l'email et le mot de passe fournis correspondent à un
     * enregistrement dans la base de données
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

            return $e->getMessage();
        }
    }

    /**
     * Fonction qui permet d'obtenir le mot de passe hashé associé à l'email passé en paramètre
     *
     * @param string $anEmail
     * @return string
     */
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
            return $e->getMessage();
        }
    }

    /**
     * Fonction qui permet d'obtenir l'ID de l'utilisateur dans la base de données en fonction du nickname passé
     * en paramètre
     *
     * @param string $aNickname
     * @return integer $id
     */
    public function GetIdOfUser($aNickname): int
    {
        $query = Database::prepare("SELECT `ID` FROM UTILISATEUR WHERE `NICKNAME` = :NICKNAME");

        $query->bindParam(':NICKNAME', $aNickname, PDO::PARAM_STR);
        $query->setFetchMode(PDO::FETCH_ASSOC);

        try {
            $query->execute();
            $queryResult = $query->fetch();

            $id = (int)$queryResult['ID'];

            return $id;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }


    /**
     * Fonction qui permet d'obtenir le nickname de l'utilisateur en fonction de l'email passe en paramètre
     *
     * @param string $anEmail
     * @return string
     */
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
            return $e->getMessage();
        }
    }

    /**
     * Fonction qui vérifie si l'utilisateur est un administrateur ou un joueur
     *
     * @param string $aNickname
     * @return integer $admin
     */
    public function CheckIfUserIsAdmin($aNickname): int
    {
        $query = Database::prepare("SELECT `ADMIN` FROM UTILISATEUR WHERE `NICKNAME` = :NICKNAME");

        $query->bindParam(':NICKNAME', $aNickname, PDO::PARAM_STR);
        $query->setFetchMode(PDO::FETCH_ASSOC);

        try {
            $query->execute();
            $queryResult = $query->fetch();

            $admin = (int)$queryResult['ADMIN'];

            return $admin;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
        // fails
        return 0;
    }


    /**
     * Fonction qui retourne un tableau d'objets, chaque objet dans le tableau est un utilisateur (Utilisateur_tM)
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
