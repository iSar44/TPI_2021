# <u>TIP 2021</u>

## Table des matières

- [1. Introduction](#1-introduction)
  - [1.1 Structure des fichiers](#1.1-structureFichiers)
- [2. Rappel de l'énoncé](#2-rappelDeLenonce)
  - [2.1 Organisation](#2.1-organisation)
  - [2.2 Livrables](#2.2-livrables)
  - [2.3 Matériel et logiciels à disposition](#2.3-materielEtLogiciels)
  - [2.4 Description de l'application Web](#2.4-descriptionWebApp)
-

## 1. Introduction

### 1.1 Structure des fichiers

```
.
├── db
│   ├── configDb
│   │   └── paramconn.php
│   ├── controllers
│   │   └── db_controller.php
│   └── classes
│       ├── database.php
│       └── utilisateur.php
└── public
    └── index.php

```

```php
    public function __construct($unUsername, $unPrenom, $unNom, $unAge, $unNumTel, $unEmail, $unMdp)
    {
        $this->setNomUtilisateur($unUsername);
        $this->setPrenom($unPrenom);
        $this->setNom($unNom);
        $this->setAge($unAge);
        $this->setNumTel($unNumTel);
        $this->setEmail($unEmail);
        $this->setMdp($unMdp);
    }

    #endregion

    #region Méthodes

    /**
     * Fonction qui retourne toutes les données associées à un utilisateur
     *
     * @return array
     */
    public static function SelectAllInfoFromUser(string $unNomUtilisateur): array
    {
        $request = ConnexionPdo::getInstance()->prepare("SELECT * FROM utilisateur WHERE nomUtilisateur = :nomUtilisateur");
        $request->bindParam(":nomUtilisateur", $unNomUtilisateur, PDO::PARAM_STR, 45);
        $request->setFetchMode(PDO::FETCH_ASSOC);
        $request->execute();

        $resultFromReq = $request->fetch();
        return $resultFromReq;
        die();
    }
```
