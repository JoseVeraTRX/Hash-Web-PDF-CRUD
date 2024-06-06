<?php
// Incluir el archivo de conexión a la base de datos
include 'connection_DB.php'; // Asegúrate de que la ruta es correcta

// Verificar la conexión
if (!$connection) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Verificar si la cookie de usuario existe
if (!isset($_COOKIE['usuario_id'])) {
    die("Error: Usuario no identificado.");
}

$usuario_id = $_COOKIE['usuario_id']; // Obtener el ID del usuario desde la cookie

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener datos del formulario
    $descripcion = $_POST['descripcion'];
    $fecha = date('Y-m-d'); // Fecha actual

    // Manejar el archivo PDF
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        // Validar que el archivo es un PDF
        $fileType = mime_content_type($_FILES['file']['tmp_name']);
        if ($fileType == 'application/pdf') {
            // Leer el contenido del archivo
            $pdfData = file_get_contents($_FILES['file']['tmp_name']);

            // Calcular el hash del PDF
            $hashcode = hash_file('sha256', $_FILES['file']['tmp_name']);

            // Verificar si el hashcode ya existe en la tabla codhash
            $sql_check_hash = "SELECT id_pdf FROM codhash WHERE hashcode = ?";
            $stmt_check_hash = mysqli_prepare($connection, $sql_check_hash);
            mysqli_stmt_bind_param($stmt_check_hash, "s", $hashcode);
            mysqli_stmt_execute($stmt_check_hash);
            $result_check_hash = mysqli_stmt_get_result($stmt_check_hash);

            if (mysqli_num_rows($result_check_hash) > 0) {
                // El hashcode ya existe en la tabla, no se puede subir el mismo archivo para evitar fraude
                echo "No se puede subir el mismo archivo.";
                header("location: http://localhost/HASHPROGRAM/assets/php/dashboard.php");
                exit;
            } else {
                // El hashcode no existe en la tabla, continuar con la subida del archivo
                // Aunque sean archivos similares, el cambio de tan solo un digito, cambia el hashcode
                // y así se evita el fraude

                // Preparar la consulta SQL para insertar en pedeefes
                $stmt_insert_pdf = mysqli_prepare($connection, "INSERT INTO pedeefes (usuario_id, fecha, descripcion, nombre, documento) VALUES (?, ?, ?, ?, ?)");
                mysqli_stmt_bind_param($stmt_insert_pdf, "issss", $usuario_id, $fecha, $descripcion, $_FILES['file']['name'], $pdfData);

                // Ejecutar la consulta para insertar en pedeefes
                if (mysqli_stmt_execute($stmt_insert_pdf)) {
                    // Obtener el ID del PDF insertado
                    $id_pdf = mysqli_insert_id($connection);

                    // Insertar el hashcode en la tabla codhash
                    $stmt_insert_hash = mysqli_prepare($connection, "INSERT INTO codhash (id_pdf, id_hash, hashcode) VALUES (?, ?, ?)");
                    mysqli_stmt_bind_param($stmt_insert_hash, "iis", $id_pdf, $usuario_id, $hashcode);
                    mysqli_stmt_execute($stmt_insert_hash);

                    echo "El archivo PDF se ha subido exitosamente.";
                    header("location: http://localhost/HASHPROGRAM/assets/php/dashboard.php");
                } else {
                    echo "Error: " . mysqli_stmt_error($stmt_insert_pdf);
                    header("location: http://localhost/HASHPROGRAM/assets/php/dashboard.php");
                }

                mysqli_stmt_close($stmt_insert_pdf);
                mysqli_stmt_close($stmt_insert_hash);
            }

            mysqli_stmt_close($stmt_check_hash);
        } else {
            echo "Por favor, sube un archivo PDF válido.";
        }
    } else {
        echo "Error al subir el archivo.";
    }
}

mysqli_close($connection);
?>
