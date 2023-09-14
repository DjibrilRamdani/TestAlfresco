<?php
require_once 'config.php';

header("Content-Type: application/octet-stream");

$nodeId = $_GET['nodeId'] ?? null;
$fileName = $_GET['fileName'] ?? null;

if ($nodeId && $fileName) {
    $url = "{$apiUrl}/nodes/{$nodeId}/content?attachment=true";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($httpCode == 200) {
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        echo $response;
    } else {
        echo "Error: Failed to download the file.";
    }

    curl_close($ch);
} else {
    echo "Erreur : nodeId ou fileName ne sont pas définies ";
}
?>
