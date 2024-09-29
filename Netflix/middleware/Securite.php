<?php

class Securite {
        public static function hash($password){
            return "1D94JD".sha1($password.'djndf').'fsjdn';
        }
        public static function secureKey($email){
            $secret = sha1($email).time();
		    $secret = sha1($secret).time();
            return $secret;
        }
}