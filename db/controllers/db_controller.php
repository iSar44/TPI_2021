<?php
require_once '../classes/database.php';
require_once '../classes/utilisateur.php';


class Db_Controller{

    private Utilisateur $aUser;

    /**
     * Get the value of aUser
     *
     * @return Utilisateur
     */
    public function getAUser() : Utilisateur
    {
        return $this->aUser;
    }

    /**
     * Set the value of aUser
     *
     * @param Utilisateur $aUser
     *
     * @return self
     */
    public function setAUser(Utilisateur $aUser) : self
    {
        $this->aUser = $aUser;

        return $this;
    }


    /**
     * @brief Insertion d'un nouvel utilisateur dans la BDD
     *
     * @param Utilisateur $aUser
     * @return boolean
     */
    public function AddUser(Utilisateur $aUser): bool{

        $query = Database::GetInstance()->prepare("INSERT INTO utilisateur (nomUtilisateur, prenom, nom, age, numTel, email, mdp) VALUES (:nomUtilisateur, :prenom, :nom, :age, :numTel, :email, :mdp)");

        $newUserName = $aUser->getUserName();
        $newFname = $aUser->getFname();
        $newLname = $aUser->getLname();
        $newAge = $aUser->getAge();
        $newPhoneNumber = $aUser->getPhoneNumber();
        $newEmail = $aUser->getEmail();
        $newPwd = $aUser->getPwd();


        $query->bindParam(':nomUtilisateur', $newUserName, PDO::PARAM_STR, 45);
        $query->bindParam(':prenom', $newFname, PDO::PARAM_STR, 30);
        $query->bindParam(':nom', $newLname, PDO::PARAM_STR, 50);
        $query->bindParam(':age', $newAge, PDO::PARAM_INT);
        $query->bindParam(':numTel', $newPhoneNumber, PDO::PARAM_STR, 30);
        $query->bindParam(':email', $newEmail, PDO::PARAM_STR);
        $query->bindParam(':mdp', $newPwd, PDO::PARAM_STR, 255);

        $success = $query->execute();
        return $success;

    }


    /**
     * Fonction qui retourne tous les utilisateurs et leurs infos stockées dans la BDD
     *
     * @return array
     */
    public function SelectAll(): array{

        $query = Database::GetInstance()->prepare("SELECT * FROM utilisateur");
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $query->execute();

        $result = $query->fetchAll();
        return $result;
    }


}
