<?php
// Importe le fichier 'functions.php' qui contient les fonctions pour interagir avec l'API Alfresco
require_once 'functions.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alfresco File Upload</title>
    <link rel="stylesheet" href="styles.css"> <!-- Lien vers la feuille de style CSS -->
</head>
<body>
<div class="container">
    <h1>Upload a File to Alfresco</h1>
    <!-- Formulaire pour sélectionner et télécharger un fichier -->
    <form onsubmit="event.preventDefault(); uploadFile();">
        <label for="file">Choisir le fich:</label>
        <input type="file" name="file" id="file" required>
        <br><br>
        <input type="submit" value="Upload">
    </form>

    <h2>Files in Alfresco</h2>
    <!-- Zone d'affichage de la liste des fichiers -->
    <div id="file-list">
        <?php
        // Récupère la liste des fichiers à l'aide de la fonction 'getFiles()'
        $files = getFiles();
        if (isset($files['error'])) {
            echo "<span class='error'>Error: {$files['error']}</span>";
        } else {
            echo '<ul>';
            // Affiche chaque fichier et les boutons d'actions associés
            foreach ($files as $entry) {
                $file = $entry['entry'];
                echo "<li>";
                echo "<span class='filename'>{$file['name']}</span>";
                // Bouton pour télécharger le fichier
                echo '<button onclick="downloadFile(\'' . htmlspecialchars($file['id']) . '\', \'' . htmlspecialchars($file['name']) . '\')">Télécharger</button>';
                // Bouton pour renommer le fichier
                echo "<button onclick=\"renameFile('{$file['id']}', '{$file['name']}')\">Rename</button>";
                // Bouton pour supprimer le fichier
                echo "<button onclick=\"deleteFile('{$file['id']}')\">Delete</button>";
                echo "</li>";
            }
            echo '</ul>';
        }
        ?>
    </div>
</div>
<!-- Importe le fichier 'scripts.js' contenant les fonctions JavaScript utilisées -->
<script src="scripts.js"></script>
</body>
</html>
