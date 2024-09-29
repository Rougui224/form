<?php
    require_once('models/Inscription.php');
    require_once('models/Connexion.php');
    require_once('middleware/Securite.php');
    require_once('middleware/Verify.php');
    require_once('middleware/AutoConnect.php');
    function autoConnect(){
        if(isset($_COOKIE['auth']) && !isset($_SESSION['connect'])){
            $key = htmlspecialchars($_COOKIE['auth']);
            $user = new AutoConnect;
            $userKey = $user->checkedKey($key);
            if($userKey){
                $user->connectUser($key);
            }else{
                header('location: /?page=accueil');
                exit();
            }
        }
    }
    function signUp(){
        $emptyInputForm = empty($_POST['name']) || empty($_POST['pseudo']) || empty($_POST['email']) || empty($_POST['password']);
        if(!$emptyInputForm) {

            $name = htmlspecialchars($_POST['name']);
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);
            $confirmPassword = htmlspecialchars($_POST['password_two']);
            $Verifiy = new Verify;
            $doublonEmail = $Verifiy->doublonEmail($email);
            if(!Verify::syntaxeEmail($email,'inscription')){
                exit();
            }
            if($doublonEmail){
                header('location: /?page=inscription&error=true&message=Adresse mail déjà utilisée');
                exit();
            }
            if(!Verify::confirmPassword($password,$confirmPassword)){
                header('location: /?page=inscription&error=true&message=Les mots de passe ne sont pas identiques.');
                exit();
            }

            $password = Securite::hash($password);
            $key = Securite::secureKey($email);

            $user = new NewUser($name,$pseudo,$email,$password,$key);
            $user->save();
            header('location: /?page=inscription&success=true');
            exit();
            
        }
        require_once('./views/inscription.php');
    }
    function logIn(){
         $emptyInputForm = empty($_POST['email']) || empty($_POST['password']) ;
         if(!$emptyInputForm){
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);
                        $autoConnect = htmlspecialchars($_POST['auto']);
            if(!Verify::syntaxeEmail($email,'accueil')){
                exit();
            }

            $Verifiy = new Verify;
            $correctEmail = $Verifiy->email($email);
            $password = Securite::hash($password);
            $correctEmail = $Verifiy->email($email);
            $correctPassword = $Verifiy->password($email,$password);

            if(!$correctEmail){
                header('location: /?page=accueil&error=true&message=Impossible de vous identifier email.');
                exit();
            }
            if(!$correctPassword){
                header('location: /?page=accueil&error=true&message=Impossible de vous identifier mdp.');
                exit();
            }

            $user = new LogIn($email,$password);
            $user->getUserInfo();
            $user->creatSession();
            if($autoConnect){
                $user->createCookie();
            }
            header('location: /?page=accueil&success=true');
            exit();
        }
        require_once('./views/connexion.php');
    }
    function logOut(){
        session_unset();
        session_destroy();
        setcookie('auth', '', time() - 1);
        require_once('./views/connexion.php');
    }