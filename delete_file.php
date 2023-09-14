<?php
// Inclut le fichier 'config.php', qui contient probablement des définitions de constantes ou des valeurs de configuration
include_once 'config.php';

// Définit le type de contenu de la réponse HTTP en 'application/json'
header('Content-Type: application/json');

// Récupère la valeur de 'nodeId' du corps de la requête POST. Si elle n'existe pas, défini 'nodeId' sur null
$nodeId = $_POST['nodeId'] ?? null;

// Si 'nodeId' est défini (c'est-à-dire, pas null)
if ($nodeId) {
    // Construit l'URL pour accéder à la ressource à supprimer
    $url = "{$apiUrl}/{$nodeId}";

    // Initialise une nouvelle session cURL
    $ch = curl_init();
    // Définit l'URL où envoyer la requête
    curl_setopt($ch, CURLOPT_URL, $url);
    // Définit les identifiants à utiliser pour l'authentification
    curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
    // Définit le type de requête comme DELETE
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    // Désactive la vérification SSL
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // Définit l'option pour retourner le résultat de la requête comme une chaîne
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // Désactive l'inclusion des en-têtes HTTP dans la réponse
    curl_setopt($ch, CURLOPT_HEADER, false);

    // Exécute la requête et stocke la réponse
    $response = curl_exec($ch);
    // Récupère le code de statut HTTP de la réponse
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    // Si le code de statut est 204 (No Content), la suppression a réussi
    if ($httpCode == 204) {
        // Envoie une réponse JSON avec un message de succès
        echo json_encode(['message' => 'Fichier supprimé avec succès']);
    } else {
        // Sinon, envoie une réponse JSON avec un message d'erreur
        echo json_encode(['error' => 'Erreur durant la suppression']);
    }

    // Ferme la session cURL
    curl_close($ch);
} else {
    // Si 'nodeId' n'est pas défini, envoie une réponse JSON avec un message d'erreur
    echo json_encode(['error' => 'Missing nodeId']);
}
?>
