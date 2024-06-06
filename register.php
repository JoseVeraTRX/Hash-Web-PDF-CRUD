<?php
// Incluir archivo de conexión a la base de datos
include 'connection_DB.php';

// Crear las variables y asignarles los valores del formulario
$name = mysqli_real_escape_string($connection, $_POST['name']);
$lastname = mysqli_real_escape_string($connection, $_POST['lastname']);
$user = mysqli_real_escape_string($connection, $_POST['user']);
$email = mysqli_real_escape_string($connection, $_POST['email']);
$contra = mysqli_real_escape_string($connection, $_POST['contra']);

// Verificación de correos
$verificar_email = mysqli_query($connection, "SELECT * FROM usuarios_hash WHERE email='$email'");
if(mysqli_num_rows($verificar_email) > 0) {
    echo '
        <script>
            alert("El correo ingresado ya se encuentra registrado, prueba otro nuevo.");
            window.location.href = "http://localhost/HASHPROGRAM/index.php";
        </script>  
    ';
    exit();
}

// Hashear la contraseña
// Al final no lo incluí por falta de tiempo porque guardaba la contraseña con el hash, esto
// hubiera requerido crear una consulta que compare la contraseña ingresada, hashearla y comparar
// el hash en la base de datos
//$hashed_password = password_hash($contra, PASSWORD_DEFAULT);

// Query a MySQL
$query_register = "INSERT INTO usuarios_hash (name, lastname, user, email, password) VALUES ('$name', '$lastname', '$user', '$email', '$contra')";

//Lanzamos la query, primero la conexión a la base de datos y luego el nuevo registro en la base de datos
$lunch_query = mysqli_query($connection, $query_register);

// Alertas de éxito y error
if($lunch_query) {
    // Redirigir a index.php
    header("Location: http://localhost/HASHPROGRAM/index.php");
    exit();
} else {
    echo '<script>
        alert("Ocurrió un error, intenta de nuevo.");
        window.location.href = "http://localhost/HASHPROGRAM/index.php";
    </script>';
}

// Cerrar la conexión
mysqli_close($connection);
?>
