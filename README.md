# TPI 2021 📃

## Table des matières

- [TPI 2021 📃](#tip-2021-page_with_curl)
  - [Table des matières](#table-des-matières)
  - [1. Introduction](#1-introduction)
    - [1.1 Installation 💻](#11-installation-computer)
    - [1.2 Structure des fichiers 🚧](#12-structure-des-fichiers-construction)
  - [2. Rappel de l'énoncé](#2-rappel-de-lénoncé)
  - [3. Méthodologie](#3-méthodologie)
  - [4. Planification](#4-planification)

## 1. Introduction

### 1.1 Installation 💻

**Installer GIT**

```sh
$ sudo apt update
$ sudo apt install git
```

**Cloner le projet**

```sh
$ sudo git clone https://github.com/iSar44/TIP_2021.git
```

### 1.2 Structure des fichiers 🚧

```
.
├── docs
│   ├── logbook
│   │   └── LOGBOOK.md
│   └── planning
├── src
│   ├── db
│   │   ├── classes
│   │   │   ├── database.php
│   │   │   └── utilisateur.php
│   │   ├── configDb
│   │   │   └── paramconn.php
│   │   └── controllers
│   │       └── db_controller.php
│   └── public
│       └── views
│           └── home.php
├── .gitignore
├── .htaccess
├── index.php
└── README.md
```


## 2. Rappel de l'énoncé

## 3. Méthodologie

<img src="./ressources/methodologie.svg" style="height: 500px;">

## 4. Planification

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
