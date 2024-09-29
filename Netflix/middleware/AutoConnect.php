<?php
    require_once('models/Manager.php');
    class AutoConnect extends Manager {
        private $_key;

        public function getkey(){
            return $this->_key;
        }
        public function setkey($key){
            return $this->_key =$key;
        }

        public function checkedKey($key){
            $db = $this->dbConnect();
            $request = $db->prepare('SELECT COUNT(*) AS count FROM users WHERE email = ?');
            $request->execute([$key]);
            while( $result = $request->fetch()){
                if($result['count'] !=1){
                    return false;
                }
            else{
                    return true;
                }
            }
        }
        public function connectUser($key){
            $db = $this->dbConnect();
            $request = $db->prepare('SELECT * FROM users WHERE secureKey = ?');
            $request->execute([$key]);
            while( $result = $request->fetch()){
                    $_SESSION['connect'] = 1;
                    $_SESSION['email']  = $result['email'];
                    $_SESSION['pseudo'] = $result['pseudo'];
                    $_SESSION['name'] = $result['name'];
            
            }
        }

    }