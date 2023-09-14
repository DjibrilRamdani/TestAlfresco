<?php
require_once 'config.php';

$nodeId = $_POST['nodeId'] ?? null;
$newName = $_POST['newName'] ?? null;

if ($nodeId && $newName) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "{$apiUrl}/nodes/{$nodeId}");
    curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['name' => $newName]));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json"
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($httpCode == 200) {
        echo json_encode(['message' => 'File renamed successfully']);
    } else {
        echo json_encode(['error' => 'Failed to rename the file']);
    }

    curl_close($ch);
} else {
    echo json_encode(['error' => 'Missing nodeId or newName']);
}
?>
