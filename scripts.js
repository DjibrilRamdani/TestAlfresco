function renameFile(nodeId, oldName) {
    var newName = prompt("Entrez un nom pour ce fichier ", oldName);
    if (newName === null || newName === oldName) {
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'rename_file.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            location.reload();
        }
    }
    xhr.send('nodeId=' + encodeURIComponent(nodeId) + '&newName=' + encodeURIComponent(newName));
}

function deleteFile(nodeId) {
    if (!confirm("Voulez vous vraiment supprimer ce fichier ?")) {
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'delete_file.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            location.reload();
        }
    }
    xhr.send('nodeId=' + encodeURIComponent(nodeId));
}


function uploadFile() {
    var fileInput = document.getElementById('file');
    var formData = new FormData();
    formData.append('file', fileInput.files[0]);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'upload.php', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.hasOwnProperty('error')) {
                alert('Error: ' + response.error);
            } else {
                alert('File uploaded successfully');
                location.reload();
            }
        }
    };
    xhr.send(formData);
}



function downloadFile(nodeId, fileName) {
    const downloadUrl = `download.php?nodeId=${encodeURIComponent(nodeId)}&fileName=${encodeURIComponent(fileName)}`;
    window.location.href = downloadUrl;
}





