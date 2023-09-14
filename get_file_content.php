<?php

if (!isset($_GET['nodeId'])) {
    echo "Error: Missing nodeId parameter.";
    exit;
}

$nodeId = $_GET['nodeId'];
$url = "https://a3mop2z6.trials.alfresco.com/alfresco/api/-default-/public/alfresco/versions/1/nodes/{$nodeId}/content";
$username = "ramdjibril24@gmail.com";
$password = "J7cQPVhXBIho";

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_USERPWD, "$username:$password");
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($curl);

if(curl_errno($curl)) {
    echo "Error: " . curl_error($curl);
} else {
    echo $response;
}

curl_close($curl);

?>
