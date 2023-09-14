<?php

$base_url = 'https://a3mop2z6.trials.alfresco.com/alfresco/api/-default-/public/alfresco/versions/1';
$username = 'ramdjibril24@gmail.com';
$password = 'J7cQPVhXBIho';

$nodeIds = [
    "c8bb482a-ff3c-4704-a3a3-de1c83ccd84c",
    "cffa62db-aa01-493d-9594-058bc058eeb1"
];

list($statusCode, $response) = createDownload($base_url, $username, $password, $nodeIds);

if ($statusCode == 202) {
    $result = json_decode($response, true);
    $downloadId = $result['entry']['id'];
    echo "Téléchargement créé avec succès, ID de téléchargement : $downloadId\n";
} else {
    echo "Erreur lors de la création du téléchargement, code d'état : $statusCode\n";
}

function createDownload($base_url, $username, $password, $nodeIds) {
    $url = $base_url . '/downloads';
    $data = json_encode(['nodeIds' => $nodeIds]);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Ajoutez cette ligne


    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data)
    ]);

    curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);

    $response = curl_exec($ch);

    if ($response === false) {
        echo 'Erreur cURL : ' . curl_error($ch) . "\n";
    }

    $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return [$statusCode, $response];
}

