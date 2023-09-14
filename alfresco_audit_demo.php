<?php
$base_url = 'https://a3mop2z6.trials.alfresco.com/alfresco/api/-default-/public/alfresco/versions/1';
$username = 'ramdjibril24@gmail.com';
$password = 'J7cQPVhXBIho';



function list_audit_applications($base_url, $username, $password, $skip_count = 0, $max_items = 100) {
    $url = $base_url . '/audit-applications';
    $params = array('skipCount' => $skip_count, 'maxItems' => $max_items);
    $url .= '?' . http_build_query($params);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Ajoutez cette ligne

    $result = curl_exec($ch);

    // Vérifiez s'il y a des erreurs
    if (curl_errno($ch)) {
        echo 'Erreur cURL : ' . curl_error($ch);
    }

    curl_close($ch);

    return json_decode($result, true);
}


$audit_applications = list_audit_applications($base_url, $username, $password);
echo json_encode($audit_applications, JSON_PRETTY_PRINT);

?>