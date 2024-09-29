<?php 
    require_once('./models/Manager.php');
    spl_autoload_register(function($class){
        // Chemin où se trouve les classes
        $path = "classes/". $class . ".php";
        if(file_exists($path)){
            require_once $path;
        }
    });
    class SignUp extends Manager {
       // Attributs
        private $_name;
        private $_pseudo;
        private $_email;
        private $_password;

        // construteur
        public function __construct($name,$pseudo,$email,$password)
        {
            $this->setName($name);
            $this->setPseudo($pseudo);
            $this->setEmail($email);
            $this->setPassword($password);
        }

        // Getters
        public function getName(){
            return $this->_name;
        }
        public function getPseudo(){
            return $this->_pseudo;
        }
        public function getEmail(){
            return $this->_email;
        }
        public function getPassword(){
            return $this->_password;
        }

        // Setters 
        public function setName($name){
            $this->_name = $name;
        }
        public function setPseudo($pseudo){
            $this->_pseudo = $pseudo;
        }
        public function setEmail($email){
            $this->_email = $email;
        }
        public function setPassword($password){
            $this->_password = $password;
        }

        // Méthodes

        public function save(){
            $db = $this->connection();
            $request = $db->prepare('INSERT INTO users(name,pseudo,email,password) VALUES(?,?,?,?)');
            $request->execute([$this->getName(),$this->getPseudo(),$this->getEmail(),$this->getPassword()]);
        }

        public function creerLesSessions() {

			$_SESSION['connect'] = 1;
			$_SESSION['pseudo']  = $this->getPseudo();
			$_SESSION['email']   = $this->getEmail();

		}
    }