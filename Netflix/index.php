<?php
	session_start();

    require_once('controllers/controller.php');
    autoConnect();
    if(isset($_GET['page'])){
        $location = htmlspecialchars($_GET['page']);
        if($location == 'accueil'){
            logIn();
        }
        elseif($location == 'inscription' && !isset($_SESSION['connect'])){
            signUp();
        }elseif($location == 'deconnexion'){
            logOut();
        }else {
            logIn();
        }
    }else{
        logIn();
    }