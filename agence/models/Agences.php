<?php
class Lieu{
    // Connexion
    private $connexion;
    private $table = "lieu";
    private $table2 = "evenement_lieux";

    // object properties
    public $Lieu_ID;
    public $Lieu_Ville;
    public $Lieu_CP;
    public $Lieu_Dep;
    public $commentaire;
    public $mairie;
    public $office;
    public $internet;
    public $facebook;
    public $wikipedia;
    public $logo;
    public $image1;
    public $google_map;
    public $lat;
    public $lng;
    public $mail;


    /**
     * Constructeur avec $db pour la connexion à la base de données
     *
     * @param $db
     */
    public function __construct($db){
        $this->connexion = $db;
    }

    /**
     * Lecture des agences
     *
     * @return void
     */
    public function lire(){
        // On écrit la requête
        $sql = "SELECT * FROM lieu l INNER JOIN evenement_lieux e ON l.Lieu_ID = e.Lieu_id GROUP BY l.Lieu_ID ORDER BY l.Lieu_ID LIMIT 50";
        // $sql = "SELECT DISTINCT * FROM lieu ORDER BY Lieu_ID LIMIT 50";

        // On prépare la requête
        $query = $this->connexion->prepare($sql);

        // On exécute la requête
        $query->execute();

        // On retourne le résultat
        return $query;
    }


}