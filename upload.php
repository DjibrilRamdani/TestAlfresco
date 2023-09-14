<?php
require_once 'config.php';

if (isset($_FILES['file'])) {
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "{$apiUrl}/nodes/-root-/children?autoRename=true");
    curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, file_get_contents($fileTmpName));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/octet-stream",
        "Content-Disposition: attachment; filename=\"$fileName\""
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($httpCode == 201) {
        echo json_encode(['message' => 'File uploaded successfully']);
    } else {
        echo json_encode(['error' => 'Failed to upload the file']);
    }

    curl_close($ch);
} else {
    echo json_encode(['error' => 'No file was sent']);
}
?>
