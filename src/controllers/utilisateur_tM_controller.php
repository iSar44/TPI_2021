<?php
require_once('./src/model/db_model/database.php');
require_once('./src/model/classes/utilisateur_tM.php');

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


    /**
     * Fonction qui retourne un tableau d'objets, chaque objet dans le tableau est un utilisateur
     *
     * @return array
     */
    public function SelectAll(): array
    {
        $results = array();

        $query = Database::getInstance()->prepare("SELECT * FROM UTILISATEUR");
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
