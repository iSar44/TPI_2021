<?php

/**
 * @author Iliya Saroukhanian <iliya.srkhn@eduge.ch>
 * @copyright 2021 Iliya Saroukhanian
 * @version 1.0.0
 */

define("NB_POST_INPUT", 3);

$regexEmail = '/([\w\-]+\@[\w\-]+\.[\w\-]+)/';
$submit = filter_input(INPUT_POST, 'seConnecter');
$u_controller = new Utilisateur_tM_Controller();

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

                    $_SESSION['idUser'] = $u_controller->GetIdOfUser($_SESSION['username']);

                    $_SESSION['admin'] = $u_controller->CheckIfUserIsAdmin($_SESSION['username']);

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

?>




<form method="POST" action="#">
    <h2 class="visually-hidden">Login Form</h2>
    <?php if (isset($error) && $error == true) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <div style="text-align:center;">
                <strong>Erreur!</strong>
                <br />
                Votre email ou mot de passe sont erronés!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    <?php endif; ?>
    <div class="illustration">
        <i class="bi bi-door-open"></i>
    </div>
    <div class="mb-3">
        <input class="form-control" type="email" name="email" placeholder="Email" required />
    </div>
    <div class="mb-3">
        <input class="form-control" type="password" name="password" placeholder="Mot de passe" required />
    </div>
    <div class="mb-3">
        <input class="btn btn-primary d-block w-100" name="seConnecter" type="submit" value="Log In" />
    </div>
</form>