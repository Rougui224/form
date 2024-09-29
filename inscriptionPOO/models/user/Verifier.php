<?php 
    require_once('models/Manager.php');
    class Verifier extends Manager {
        // Verifier la syntaxe de l'email
        public static function syntaxeEmail($email){
        // Vérifier la syntaxe de l'email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header('location: index.php?error=true&message=Adresse email invalide');
            exit();
        }

        // Extraire le domaine de l'email
        $domain = substr(strrchr($email, "@"), 1);

        // Vérifier si le domaine a des enregistrements DNS
        if (!checkdnsrr($domain, "MX")) {
            header('location: index.php?error=true&message=Le domaine de l\'email n\'existe pas.');
            exit();
        }

        return true  ; 
    }

        // Verifier
        public function doublonEmail($email){
            $db = $this->connection();
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
           ;

            // Si count est different de 0 , un doublon existe
          
        }
    }
