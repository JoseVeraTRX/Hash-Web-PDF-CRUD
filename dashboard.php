<?php
// Verifica si la cookie 'usuario_id' está presente y obtiene el ID de usuario
if (!empty($_COOKIE['usuario_id'])) {
    $usuario_id = $_COOKIE['usuario_id'];

    // Verifica la conexión a la base de datos
    include 'connection_DB.php';
    if (!$connection) {
        die("Error al conectar a la base de datos: " . mysqli_connect_error());
    }

    // Consulta los archivos asociados al ID de usuario en la base de datos
    $query = "SELECT id_pdf, fecha, descripcion, nombre FROM pedeefes WHERE usuario_id = ?";
    $stmt = $connection->prepare($query);
    if (!$stmt) {
        die("Error al preparar la consulta: " . $connection->error);
    }

    // Vincula parámetros y ejecuta la consulta
    $stmt->bind_param("i", $usuario_id);
    if (!$stmt->execute()) {
        die("Error al ejecutar la consulta: " . $stmt->error);
    }

    $result = $stmt->get_result();

    // Continuar con el procesamiento de los resultados...
} else {
    // Si la cookie 'usuario_id' no está presente, redirige al usuario a la página de inicio de sesión
    header("location: http://localhost/HASHPROGRAM/index.php");
    exit;
}
?>
<?php
include 'connection_DB.php'; // Asegúrate de que este archivo está en la misma carpeta que dashboard.php
?>
<!--HTML-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis PDFs</title>
    <link rel="stylesheet" href="../css/styledash.css">
</head>
<body>
    <!-- Botón para cerrar sesión -->
    <button id="logoutBtn" onclick="window.location.href='logout.php'">Cerrar sesión</button>
    <h1>Mis PDFs</h1>
    <!-- Botón para abrir la ventana modal -->
    <button id="openModalBtn">Subir PDF</button>

    <!-- Ventana Modal -->
    <div id="uploadModal" class="modal">
        <div class="modal-content">
            <span class="closeBtn">&times;</span>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="usuario_id" value="1"> <!-- ID del usuario, puedes obtenerlo dinámicamente -->
                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion" id="descripcion" required></textarea>
                <label for="file">Seleccionar PDF:</label>
                <input type="file" name="file" id="file" accept="application/pdf" required>
                <button type="submit">Subir PDF</button>
            </form>
        </div>
    </div>
    
    <!-- Tabla para mostrar PDFs -->
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Descripción</th>
                <th>Nombre</th>
                <th>Descargar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id_pdf']}</td>
                        <td>{$row['fecha']}</td>
                        <td>{$row['descripcion']}</td>
                        <td>{$row['nombre']}</td>
                        <td><a href='download.php?id={$row['id_pdf']}'>Descargar</a></td>
                      </tr>";
            }

            $stmt->close();
            $connection->close();
            ?>
        </tbody>
    </table>

    <script src="../../assets/js/modal.js"></script>
</body>
</html>
