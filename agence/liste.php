<?php
// Headers requis
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// On vérifie que la méthode utilisée est correcte
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    // On inclut les fichiers de configuration et d'accès aux données
    include_once './config/Database.php';
    include_once './models/Agences.php';

    // On instancie la base de données
    $database = new Database();
    $db = $database->getConnection();

    // On instancie les agences
    $lieux = new Lieu($db);

    // On récupère les données
    $stmt = $lieux->lire();

    // On vérifie si on a au moins 1 agence
    if($stmt->rowCount() > 0){
        // On initialise un tableau associatif
        $tableauLieu = [];
        $tableauLieu['lieu'] = [];

        // On parcourt les agences
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $agen = [
                "Lieu_ID" => $Lieu_ID,
                "Lieu_Ville" => $Lieu_Ville,
                "Lieu_CP" => $Lieu_CP,
                "Lieu_Dep" => $Lieu_Dep,
                "commentaire" => $commentaire,
                "mairie" => $mairie,
                "office" => $office,
                "internet" => $internet,
                "facebook" => $facebook,
                "wikipedia" => $wikipedia,
                "logo" => $logo,
                "image1" => $image1,
                "google_map" => $google_map,
                "lat" => $lat,
                "lng" => $lng,
                "mail" => $mail,
            ];

            $tableauLieu['lieu'][] = $agen;
        }

        // On envoie le code réponse 200 OK
        http_response_code(200);

        // On encode en json et on envoie
        echo json_encode($tableauLieu);
    }

}else{
    // On gère l'erreur
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}