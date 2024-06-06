<?php
// Incluye el archivo de conexión a la base de datos
include 'connection_DB.php';

$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

// Realiza la consulta para validar el inicio de sesión
$validar_login = mysqli_query($connection, "SELECT id FROM usuarios_hash WHERE user='$usuario' 
and password= '$contrasena'");

if (mysqli_num_rows($validar_login) > 0)
{   
    // Obtiene el ID de usuario de la consulta
    $row = mysqli_fetch_assoc($validar_login);
    $usuario_id = $row['id'];

    // Crea una cookie para almacenar el ID de usuario
    // Necesitaba encontrar cómo tener la id del usuario debido a la necesidad de mostrar de manera personalizada
    // en relación a cada usuario, ya que es de uso personal
    setcookie("usuario_id", $usuario_id, time() + (86400 * 30), "/"); // Validez de la cookie por 30 días

    // Redirige al usuario al dashboard
    header("location: http://localhost/HASHPROGRAM/assets/php/dashboard.php");
    exit;
} else {
    echo '
        <script>
            alert("El usuario y/o contraseña ingresados no son correctos.");
            window.location.href = "http://localhost/HASHPROGRAM/index.php";
        </script>  
    ';
    exit;
}
?>
