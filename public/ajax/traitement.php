<?php

require_once(__DIR__ . '/../../src/Core/Database.php');
require_once(__DIR__ . '/../../src/Models/Users.php');
require_once(__DIR__ . '/../../src/Models/Roles.php');
require_once(__DIR__ . '/../../src/Models/Address.php');
require_once(__DIR__ . '/../../src/Models/Basket.php');


$database = new Database();

////////////////////////////  Darkmode  /////////////////////////////////

if (isset($_POST['themeChoose'])) {
        $themeSelected = 'regularTheme';
        $theme = json_decode($_POST['themeChoose']);
        if($theme == '1') {
                $themeSelected = 'darkTheme';
        }
        setcookie('theme', $themeSelected, time() + 3600, '/');
}

////////////////////////////////////////////////////////////////////////////

////////////////////////////  Register /////////////////////////////////
if(isset($_POST['email'])) {
    $email = htmlspecialchars(trim($_POST['email']));

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        print('Adresse email invalide');
    } else {
        $userEmail = $database->getEntityManager()->getRepository('Users')->findOneBy(['email' => $email]);;
        if(isset($userEmail)) {
            print('Adresse email non disponible');  
        } else {
            print(1);  
        }
    }
}
if(isset($_POST['username'])) {
    $username = htmlspecialchars(trim($_POST['username']));

    if(!preg_match('/\S*(?=\S{8,})(?=\S*[a-zA-Z])\S*$/', $username)) {
        print('Nom d\'utilisateur incorrect');
    } else {
        $usernameUser = $database->getEntityManager()->getRepository('Users')->findOneBy(['username' => $username]);
        if(isset($usernameUser)) {
            print('Nom d\'utilisateur non disponible');  
        } else {
            print(1);  
        }
    }
}


if(isset($_POST['passw'])) {
    $pass = htmlspecialchars(trim($_POST['passw']));
    if(preg_match('/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', $pass)) {
        print('1');
    } else {
        print('Le mot de passe doit faire minimum 8 lettres, contenir une majuscule et au moins un chiffre');
    }
}
////////////////////////////////////////////////////////////////////////////

////////////////////////////  Basket  /////////////////////////////////

if(isset($_POST['quantityBasket'])) {

 echo 'lol';

}

////////////////////////////////////////////////////////////////////////////

?>