<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="post" enctype="multipart/form-data">
        <label>Upload File</label>
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload File" name="submit">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $uploadedFile = $_FILES['fileToUpload'];
        if (isset($uploadedFile)) {
            echo "File Name: " . htmlspecialchars($uploadedFile['name']) . "<br>";
            echo "File Size: " . htmlspecialchars($uploadedFile['size'] / 1024 / 1024) . " MB<br>";
            echo "File Type: " . htmlspecialchars($uploadedFile['type']) . "<br>";
        } else {
            echo "Error: " . $_FILES['fileToUpload']['error'];
        }
        if (file_exists("img/" . $uploadedFile['name'])) {
            echo "Sorry, file already exists.";
        } elseif ($uploadedFile['size'] / 1024 / 1024 > 1) {
            echo "Sorry, your file is too large.";
        } elseif ($uploadedFile['type'] == "application/pdf" || $uploadedFile['type'] == "image/jpeg") {
            move_uploaded_file($uploadedFile['tmp_name'], "img/" . $uploadedFile['name']);
            echo "Uploaded success.";
        } else {
            echo "Sorry, only PDF and JPG files are allowed.";
        }
    }
    ?>
</body>

</html>