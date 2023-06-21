<!DOCTYPE html>
<html>
<head>
    <title>Block de Notas</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Block de Notas</h1>
    <div class="container">
        <div class="textarea-container">
            <?php
            $folderPath = 'C:/Users/Jose/Desktop/actividad de block de notas/block de notas/';

            if (isset($_POST['content']) && isset($_POST['filename'])) {
                $content = $_POST['content'];
                $filename = $_POST['filename'];
                $filePath = $folderPath . $filename . '.txt';

                // Verificar si la carpeta existe, si no, crearla
                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true);
                }

                // Guardar el contenido en el archivo
                file_put_contents($filePath, $content);

                echo "<div class='success-message'>El archivo se ha guardado correctamente como '$filename.txt' en la carpeta 'block de notas'.</div>";
            }

            // Leer y mostrar contenido de archivo seleccionado
            if (isset($_GET['file'])) {
                $selectedFile = $_GET['file'];
                $filePath = $folderPath . $selectedFile;

                if (file_exists($filePath)) {
                    $fileContent = file_get_contents($filePath);
                    echo "<form method='POST'>";
                    echo "<textarea name='content'>$fileContent</textarea>";
                    echo "<br>";
                    echo "<div class='input-field'>";
                    echo "<label for='filename'>Nombre del archivo:</label>";
                    echo "<input type='text' name='filename' id='filename' value='$selectedFile' required>";
                    echo "</div>";
                    echo "<input class='btn-submit' type='submit' value='Guardar'>";
                    echo "</form>";
                }
            } else {
                echo "<form method='POST'>";
                echo "<textarea name='content'></textarea>";
                echo "<br>";
                echo "<div class='input-field'>";
                echo "<label for='filename'>Nombre del archivo:</label>";
                echo "<input type='text' name='filename' id='filename' required>";
                echo "</div>";
                echo "<input class='btn-submit' type='submit' value='Guardar'>";
                echo "</form>";
            }
            ?>
        </div>
        <div class="file-list-container">
            <h3>Archivos Guardados:</h3>
            <ul class="file-list">
                <?php
                $files = scandir($folderPath);
                foreach ($files as $file) {
                    if ($file != '.' && $file != '..') {
                        echo "<li class='file-list-item'><a class='file-list-link' href='?file=$file'>$file</a></li>";
                    }
                }
                ?>
            </ul>
        </div>
    </div>
</body>
</html>