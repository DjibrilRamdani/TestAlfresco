<?php
// Définition de la fonction 'getFiles()' pour récupérer la liste des fichiers stockés dans Alfresco
function getFiles() {
    // URL de l'API Alfresco pour récupérer les fichiers
    $url = "https://a3mop2z6.trials.alfresco.com/alfresco/api/-default-/public/alfresco/versions/1/nodes/-my-/children";
    // Identifiants pour accéder à l'API Alfresco
    $username = "ramdjibril24@gmail.com";
    $password = "J7cQPVhXBIho";

    // Initialisation de cURL pour effectuer une requête HTTP
    $curl = curl_init();
    // Configuration de l'URL pour la requête
    curl_setopt($curl, CURLOPT_URL, $url);
    // Retourne la réponse HTTP en tant que chaîne de caractères
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    // Ajoute les identifiants à la requête pour l'authentification
    curl_setopt($curl, CURLOPT_USERPWD, "$username:$password");
    // Désactive la vérification SSL
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    // Exécute la requête et récupère la réponse HTTP
    $response = curl_exec($curl);

    // Vérifie s'il y a des erreurs lors de l'exécution de la requête
    if(curl_errno($curl)) {
        // Retourne un tableau avec une clé "error" contenant le message d'erreur
        return array("error" => curl_error($curl));
    } else {
        // Décode la réponse JSON et retourne les entrées (fichiers)
        $data = json_decode($response, true);
        return $data['list']['entries'];
    }

    // Ferme la connexion cURL
    curl_close($curl);
}
?>
