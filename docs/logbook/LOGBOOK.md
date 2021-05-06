# Journal de bord 📝

## <u>1er jour - 03/05/2021</u>

### Matin:

- 7:30 : Enfin arrivé en classe, je peux débuter mon TPI. J'ai reçu l'énoncé du travail par email. Actuellement j'essaye de me familiariser avec toutes les tâches réquises. Je m'octroie une bonne heure afin d'être au clair avec chaque critères, puis je vais passer à l'élaboration du planning prévisionnel.

- 8:30 : Passage à l'élaboration du planning prévisionnel 🚧

- 9:40 : Début de la pause

- 10:05 : Fin de la pause. Après avoir établi les tâches principales dans le planning, je passe à l'élaboration du MCD (celui-ci changera au fur et à mesure que M. Aigroz me précise les différentes choses qui doivent être stockées dans la base de données) ❗

### MCD Initial 🛠️

<img src="../../src/public/ressources/mcd_tpi2021.svg" height="auto;">

- 11:40 : Structure du projet mise à jour, voir README à la racine du projet

### Après-midi:

- 12:40 : Problème avec Apache et WSL2 🔺

- 13:10 : Apache s'est finalement lancé, cepedant j'ai perdu 30 min donc je devrai accélerer le rythme dès à présent!

- 13:10 - 14:15 : Je vais passer sur la "construction" ou plutôt l'assemblage de ma page d'accueil qui servira de patron pour les autres pages du site

- 14:15 : Début de la pause

- 14:35 : Fin de la pause

- 14:35 - 16:00 : Je paufine l'affichage de la page d'accueil pour pouvoir par la suite simplement intégré le conteneur (c-à-d div) dans lequel j'afficherai les tournois en cours ainsi que les tournois à venir

- 16:00 : Pour les dernières 45 minutes de la journée, je vais me focaliser sur la documentation ➡️ en fonction du temps disponible durant les prochains jours, j'essayerai d'allouer quotidiennement ces trois quarts d'heures pour rédiger et compléter ma documentation technique ainsi que le manuel d'utilisateur

- 16:45 : Fin de la 1ère journée

  - Bilan:
    - Planning prévisionnel établi
    - MCD v0.1 -> à retravailler par la suite
    - Page d'accueil prête à ~ 50 %
    - La structure et les bases du projet sont posées

- N.B.: J'ai un certain nombre de questions pour M. Aigroz

## <u>2ème jour - 04/05/2021</u>

### Matin:

- 7:30 : Le début d'une nouvelle journée commence. La veille j'ai eu une visio-conférence avec M. Aigroz et les deux autres élèves qu'il suit pour le TPI. Nous avons eu l'occasion de pouvoir clarifier certains détails ainsi qu'obtenir des réponses à nos questions. M. Aigroz m'a indiqué que je dois consacrer la journée d'aujourd'hui à l'élaboration des maquettes des pages du site internet et par la suite approfondir le MCD car comme je le pensais, il était bien trop léger.

- 09:01 : Vu que j'avais un doute concernant l'énoncé, j'ai décidé de poser la question à M. Aigroz

> Bonjour Monsieur, je voulais vous demander si dans mon énoncé la phrase "- (optionnel) Temps en heures entre les rondes (phases) du tournoi" signifie optionnel pour le développement ou c'est un critère optionnel pour la création d'un tournoi que je devrai cependant développer?

- 09:13 : M. Aigroz m'a répondu en clarifiant que c'est une fonctionnalité que je dois implémenter

> Ce qui est optionnel, c'est qu'au moment de créer le tournoi, l'administrateur peut (optionnel) spécifier un temps en heures entre les rondes. Si l'administrateur ne spécifie rien, la ronde suivante sera démarrée lorsque l'administrateur aura saisi tous les résultats de la ronde en cours.

- 09:40 : Début de la pause

- 10:05 : Fin de la pause, j'ai terminé les maquettes provisoires, dès à présent je vais continuer le travail sur le MCD

- 11:20 : Nouvelle version du MCD ❗

<img src="../MCD/TPI_2021_MCD.png" height="auto">

- 11:40 : C'est tout pour la matinée! 🍕

### Après-midi:

- 12:40 : En ayant terminé le matin les choses demandées par M. Aigroz, je décide de passer au design du site, je vais me concentrer en particulier sur la page d'accueil et la page d'authentification.

- 13:00 : Recherche des templates sur Bootstrap Studio pour le CRUD de la page d'accueil

- 13:00 : Template trouvée, je passe à l'intégration du CRUD dans ma page d'accueil

- 14:15 : Début de la pause ☕, l'intégration du CRUD est presque terminée, il ne reste plus qu'à ajuster la CSS afin que les éléments du filtre pour la recherche soient correctement alignés

- 14:35 : Fin de la pause, je reprends le travail

- 15:00 : Design de la page d'accueil terminé ✅

<img src="../maquetteSite/screenshots/tpi2021_homepage.png">

- 15:10 : Je passe à la page d'authentification, recherche des templates sur Bootstrap Studio pour le login

- 15:20 : Template choisie, je passe à l'intégration

- 15:40 : Je décide d'ajouter un effet parallax à la page

- 15:55 : Design de la page d'authentification terminé

<img src="../maquetteSite/screenshots/login.png">

- 16:00 : En essayant de respecter la règle que je me suis imposée, je passer à la partie documentation de la journée 📄

- 16:45 : Fin de la journée, enfin.. 😵

## <u>3ème jour - 05/05/2021</u>

### Matin:

- 7:30 : Lors du "webmeeting" de la veille, M. Aigroz m'a conseillé de retravailler mes maquettes en supprimant certaines qui seront inutiles par contre il faut impérativement que je refasse les maquettes pour la page du détails des tournois, avec les différents use-cases (utilisateur déconnecté/connecté, compte admin). C'est ce que je vais faire maintenant.

- 9:40 : Début de la pause.

- 10:05 : Fin de la pause.

- 10:45 : J'ai terminé la grande majorité des maquettes avec les différents use-cases.

- 10:50 : Je vais approfondir la documentation technique.

- 11:40 : Pause de midi.

### Après-midi:

- 12:40 : J'avance la doc...

- 13:30 : La partie avant la planification est terminée, je passe à l'implémentation du MCD, pour cela j'utiliserai phpMyAdmin.

- 14:00 : Voici la première version du MPD basé sur le deuxième version du MCD

<img src="../MCD/mpd.png">

- 14:15 : Début de la pause ☕

- 14:35 : Fin de la pause, dès à présent je vais travailler sur ma classe utilisateur_tM. M. Aigroz m'a indiqué ma fonction SelectAll() retournait un tableau de valeur et non pas un tableau d'objet. Suite à cela je vais retravailler cette fonction afin que j'obtienne les résultats désiré.

- 15:45 : Voici la fonction retravaillée:

```php
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
```

Afin de pouvoir comparé, voici la fonction précédente:

```php
    /**
     * Fonction qui retourne tous les utilisateurs et leurs infos stockées dans la BDD
     *
     * @return array
     */
    public function SelectAll(): array
    {

        $query = Database::getInstance()->prepare("SELECT * FROM utilisateur");
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $query->execute();

        $result = $query->fetchAll();
        return $result;
    }
```

- 16:00 : Je passe à la partie documentation de la journée 📄

- 16:45 : Fin d'une longue et triste journée...

## <u>4ème jour - 06/05/2021 (Fin de la première semaine)</u>

### Matin:

- 7:30 : Arrivé en classe, je revois les choses qui ont été faites la veille afin d'éviter de se perdre dès le début de la journée

- 8:05 : Webmeeting avec M. Aigroz.

  - La première remarque était que la table RESULTAT n'est pas vraiment utile, je pourrais la remplacer avec une table MATCH dans laquelle je stockerai l'ID du vainqueur du match
  - Le deuxième point consistait à revoir la fonction qui retourne tous les utilisateurs, suivant l'exemple qui a été déposé sur Classroom par M. Aigroz
  - ❗ expliciter les champs dans la requête SQL, éviter '(SELECT \* FROM ....)'
  - Dans le modèle de la base de données (database.php), déclarer le constructeur comme privé. Utiliser la fonction finale \_\_callStatic qui appellera elle-même la fonction getInstance()
  - Dernières remarques, créer un en-tête dans tous les fichiers et **commenter les return de TOUTES les fonctions**

- 8:40 : Fin du Webmeeting, je vais passer sur l'implémentation de la table MATCHS dans la bdd

- 9:00 : Voici le nouveau MCD

<img src="../MCD/TPI_2021_v2.png">

- 9:10 : Voici le MPD:

<img src="../MCD/mpd_v2.png">

- 9:30 : Visites des experts

- 11:40 : Début de la pause de midi

### Après-midi:

- 12:40 : Fin de la pause de midi, dès à présent je vais me focaliser sur le mécanisme sur la logique de l'authentification

- 16:25 : Cela m'a pris plus de temps que je voulais, cependant l'authentification fonctionne sans bug et tous les cas d'erreur sont gérés ✅

Voici la logique pour l'authentification:

```php
if ($submit) {

    if (count($_POST) === NB_POST_INPUT) {

        if (preg_match($regexEmail, $_POST['email'])) {

            $userEmail = $_POST['email'];
        }

        if ($u_controller->CheckIfEmailExists($userEmail)) {

            if (isset($_POST['password'])) {

                $userPassword = $_POST['password'];

                $hashedPassword = $u_controller->GetHashPassword($userEmail);

                if (password_verify($userPassword, $hashedPassword)) {

                    $_SESSION['isLoggedIn'] = true;

                    $_SESSION['username'] = $u_controller->GetNicknameOfUser($userEmail);

                    header('Location: ./');
                } else {
                    $error = true;
                }
            }
        } else {

            $error = true;
        }
    } else {
        $error = true;
    }
}
```

Et voici les fonctions qui en lien avec l'authentification qui se trouvent dans le fichier utlisateur_tM_controller.php

```php
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
```

- 16:45 : Fin de la journée ❗
