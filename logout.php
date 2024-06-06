<?php
// Destruye todas las cookies relacionadas con la sesión, para evitar errores y que los elementos mostrados
// sean los correctos para el id de usuario
if (isset($_COOKIE['usuario_id'])) {
    unset($_COOKIE['usuario_id']);
    setcookie('usuario_id', '', time() - 3600, '/'); // El valor de la cookie se pierde en aproximadamente una hora
}

// Redirige al usuario a la página de inicio de sesión
header("location: http://localhost/HASHPROGRAM/index.php");
exit;
?>
