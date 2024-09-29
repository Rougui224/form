<?php 

require_once('models/Manager.php');

class LogIn extends Manager {
    private $_name;
    private $_pseudo;
    private $_email;
    private $_password;
    private $_key;

    public function __construct($email,$password)
    {
    
        $this->setEmail($email);
        $this->setPassword($password);
    
    }
    public function setUserInfo($name,$pseudo,$key)
    {
        $this->setName($name);
        $this->setPseudo($pseudo);
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

     public function getUserInfo(){
        $db=$this->dbConnect();
        $request = $db->prepare('SELECT * FROM users WHERE email=?  ');
        $request->execute([
            $this->getEmail(),
        ]);
        while($informations = $request->fetch()){
            $this->setUserInfo($informations['name'],$informations['pseudo'],$informations['secureKey']);
        }
    }
    public function createCookie(){
        setCookie('auth',$this->getKey(),(time() + 365*24*3600),'/',null,false,true);
    }
    public function creatSession(){
        $_SESSION['connect'] = 1;
        $_SESSION['email']  = $this->getEmail();
        $_SESSION['pseudo'] = $this->getPseudo();
        $_SESSION['secret'] = $this->getkey();
    }
}
