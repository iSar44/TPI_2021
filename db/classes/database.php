<?php
/**
 * @author M. Dominique Aigroz
 */

/**
 * @remark Mettre le bon chemin d'accès à votre fichier contenant les constantes
 */
require_once '../configDb/paramconn.php';

class Database
{

    private static $objInstance;

    /**
     * @brief Constructeur de la class Database
     * 
     * Si la classe n'a jamais été instanciée, le constructeur 
     * crée une nouvelle connexion à la BDD. Le constructeur est 'private'
     * afin que personne puisse créer une nouvelle instance de la classe Database
     */
    private function __construct()
    {
    }

    /**
     * @brief Comme avec le constructeur, la méthode '__clone' est privée afin que
     * personne ne puisse cloner une instance déjà existante
     */

    private function __clone()
    {
    }

    /**
     * @brief Méthode qui crée une connexion avec la BDD si elle n'existait pas auparavant
     * ou dans le cas contraire elle retourn l'instance déjà créée
     * @return $objInstance
     */
    public static function GetInstance()
    {
        if (!self::$objInstance) {
            try {
                $dsn = DATABASE_DBTYPE . ':host=' . DATABASE_HOST . ';port=' . DATABASE_PORT . ';dbname=' . DATABASE_DBNAME;
                self::$objInstance = new PDO($dsn, DATABASE_USER, DATABASE_PASS, array('charset' => 'utf8'));
                self::$objInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Connection failed, error: " . $e;
            }
        }
        return self::$objInstance;
    }

	/**
	 * @brief	Passes on any static calls to this class onto the singleton PDO instance
	 * @param 	$chrMethod		The method to call
	 * @param 	$arrArguments	The method's parameters
	 * @return 	$mix			The method's return value
	 */
    final public static function __callStatic($chrMethod, $arrArguments)
    {
        $objInstance = self::GetInstance();
        return call_user_func_array(array($objInstance, $chrMethod), $arrArguments);
    }

}
