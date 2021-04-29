<?php
require_once '../db/classes/database.php';
require_once '../db/controllers/db_controller.php';
require_once '../db/classes/utilisateur.php';

$dbControl = new Db_Controller();

$message = "";

if ($_POST['send']) {


    $newUser = new Utilisateur($_POST['username'], $_POST['fname'], $_POST['lname'], $_POST['age'], $_POST['phoneNumber'], $_POST['email'], $_POST['pwd']);
    $dbControl->AddUser($newUser);

    $message .= "SUCCESS!";
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="POST" action="#" style="display:flex; flex-direction:column; width:70vw; margin:auto">
        <span>USERNAME:</span>
        <input type="text" name="username" required />
        <span>FIRST NAME:</span>
        <input type="text" name="fname" required />
        <span>LAST NAME:</span>
        <input type="text" name="lname" required />
        <span>AGE:</span>
        <input type="text" name="age" required />
        <span>PHONE NUMBER:</span>
        <input type="text" name="phoneNumber" required />
        <span>EMAIL:</span>
        <input type="text" name="email" required />
        <span>PASSWORD:</span>
        <input type="text" name="pwd" required />
        <br />
        <br />
        <input type="submit" value="Envoyer" name="send" />
    </form>
    <?php

    echo "<pre>";
    print_r($dbControl->SelectAll());
    echo "</pre>";

    ?>
</body>

</html>