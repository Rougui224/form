<?php 

require_once('models/Manager.php');

class NewUser extends Manager {
    private $_name;
    private $_pseudo;
    private $_email;
    private $_password;
    private $_key;

    public function __construct($name,$pseudo,$email,$password,$key)
    {
        $this->setName($name);
        $this->setPseudo($pseudo);
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setKey($key);

    }

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
    public function getKey(){
        return $this->_key;
    }

    public function setName($name){
        return $this->_name = $name;
    }
    public function setPseudo($pseudo){
        return $this->_pseudo = $pseudo;
    }
    public function setEmail($email){
        return $this->_email = $email;
    }
    public function setPassword($password){
        return $this->_password = $password;
    }
    public function setKey($key){
        return $this->_key = $key;
    }

    public function save(){
        $db=$this->dbConnect();
        $request = $db->prepare('INSERT INTO users(name,pseudo,email, password, secureKey) VALUES(?, ?, ?,?,?) ');
        $request->execute([
            $this->getName(),
            $this->getPseudo(),
            $this->getEmail(),
            $this->getPassword(),
            $this->getKey(),
        ]);
    }
}
