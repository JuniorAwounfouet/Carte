<?php
class Database{
    // Connexion à la base de données
    private $host = "localhost";
    private $db_name = "baseinfolimo2023il";
    private $username = "root";
    private $password = "";
    public $connexion;

    // Connexion à la base de données
    // private $host = "dy1616-001.eu.clouddb.ovh.net:35803";
    // private $db_name = "Baseinfolimo2023il";
    // private $username = "3il2023";
    // private $password = "DFT521sdg";
    // public $connexion;

    // getter pour la connexion
    public function getConnection(){

        $this->connexion = null;

        try{
            $this->connexion = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->connexion->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Erreur de connexion : " . $exception->getMessage();
        }

        return $this->connexion;
    }   
}