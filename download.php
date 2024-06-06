<?php
// Incluir el archivo de conexión a la base de datos
include 'connection_DB.php';

// Verificar la conexión
if (!$connection) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Si, id_pdf es igual a id, dentro de la consulta, sino, id no está en base de datos
//  -----> si los id coinciden, realizar consulta y descargar, sino, archivo no encontrado


// Verificar si se ha pasado un ID válido, ya que la descarga se hace en base al id del pdf
if (isset($_GET['id'])) {
    $id_pdf = intval($_GET['id']);

    // Preparar la consulta SQL para obtener el archivo PDF
    $sql = "SELECT nombre, documento FROM pedeefes WHERE id_pdf = ?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_pdf);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Verificar el resultado y procesar el resultado de la consulta
    // Realizar la descarga si todo está ok
    if ($row = mysqli_fetch_assoc($result)) {
        // Si se encuentra un resultado, se extraen el nombre del archivo y su contenido
        $nombre = $row['nombre'];
        $documento = $row['documento'];

        // Establecer las cabeceras para la descarga del archivo
        header("Content-Type: application/pdf");
        header("Content-Disposition: attachment; filename=\"$nombre\"");
        header("Content-Length: " . strlen($documento));

        // Enviar el contenido del archivo al navegador
        echo $documento;
    } else {
        echo "Archivo no encontrado.";
    }

    mysqli_stmt_close($stmt);
} else {
    echo "ID de archivo no proporcionado.";
}

mysqli_close($connection);
?>
