<?php

    class Manager {
        protected function dbConnect(){
           try {
            // Correction de la chaîne de connexion : "mysql" au lieu de "sql"
            $db = new PDO('mysql:host=localhost;dbname=netflix;charset=utf8', 'root', '');
            } catch (Exception $e) {
                die('ERREUR : ' . $e->getMessage());
            }
            return $db;
        }
        
    }
