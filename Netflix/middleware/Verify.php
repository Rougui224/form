<?php 
    require_once('models/Manager.php');
    class Verify extends Manager {

        // Verifier la syntaxe de l'email
        public static function syntaxeEmail($email,$location){
        // Vérifier la syntaxe de l'email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                header('location: /?page='.$location.'&error=true&message=Adresse mail invalide');
                exit();
        }

        // Extraire le domaine de l'email
        $domain = substr(strrchr($email, "@"), 1);

        // Vérifier si le domaine a des enregistrements DNS
        if (!checkdnsrr($domain, "MX")) {
            header('location: /?page='.$location.'&error=true&message=Le domaine de l\'email n\'existe pas.');
            exit();
        }

        return true  ; 
    }

        // Verifier
        public function doublonEmail($email){
            $db = $this->dbConnect();
            $request = $db->prepare('SELECT COUNT(*) AS count FROM users WHERE email = ?');
            $request->execute([$email]);
            while( $result = $request->fetch()){
                if($result['count'] !=0){
                    return true;
                }
            else{
                    return false;
                }
            }
        }
        public function email($email){
            $db = $this->dbConnect();
            $request = $db->prepare('SELECT COUNT(*) AS count FROM users WHERE email = ?');
            $request->execute([$email]);
            while( $result = $request->fetch()){
                if($result['count'] !=1){
                    return false;
                }
            else{
                    return true;
                }
            }
        }
        public function password($email,$password){
            $db = $this->dbConnect();
            $request = $db->prepare('SELECT * FROM users WHERE email = ?');
            $request->execute([$email]);
            while( $result = $request->fetch()){
                if($result['password'] != $password){
                    return false;
                }
            else{
                    return true;
                }
            }
        }

        public static function confirmPassword($password,$confirmPassword){
            return $password===$confirmPassword;
        }
    }
