<?php 
    require_once('./models/user/SignUp.php');

    spl_autoload_register(function($class){
        // Chemin où se trouve les classes
            $path = './models/user/' . $class . '.php';        if(file_exists($path)){
            require_once $path;
        }
    });
    function AddUser(){
        $emptyFormInput = empty($_POST['name']) && empty($_POST['pseudo']) && empty($_POST['email']) && empty($_POST['password']) ;
        if(!$emptyFormInput) {
            $name = htmlspecialchars($_POST['name']);
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);
            $checkEmail = new Verifier;
            $doublonEmail = $checkEmail->doublonEmail($email);
            var_dump($email);
            if(!Verifier::syntaxeEmail($email)){
                exit();
            }
            if($doublonEmail){
                header('location: index.php?error=true&message=Adresse email deja utilisée');
                exit();
            }
            $password = Securite::hash($password);

            $user = new SignUp($name,$pseudo,$email,$password);
            $user->save();
            // créer immediatement une session de connexion 
            $user->creerLesSessions();
            header('location: index.php?success=true&message=Inscription réaliser avec succes');
            exit();

        }

    }