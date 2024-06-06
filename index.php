<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HASHPROGRAM</title>
    <!--Linkeamos los estilos para el css-->
    <link rel="stylesheet" href="assets/css/styles.css">

</head>
<body>
    <main>
        <div class="container__main">
            <!-- Main back container-->
            <div class="back__box">
                <!--Box to login-->
                <div class="back__boxLogin">
                    <h3>¿Ya tienes cuenta?</h3>
                    <p>Iniciar Sesión</p>
                    <button id="btn_Login">Iniciar Sesión</button>

                </div>

                <!--Box to Register-->
                <div class="back__boxRegister">
                    <h3>¿No tienes una cuenta?</h3>
                    <p>¡Regístrate!</p>
                    <button id="btn_Register">Registrarse</button>
                </div>
            </div>

            <!--Conteiner to login and Register forms-->
            <div class="container__LoginAndRegister">
           
                <!--Imagen candado-->
                <style>
                    .form_Login {
                        text-align: center; /* Para centrar el contenido del formulario */
                    }
                    .form_Login img {
                        width: 50px; /* Cambia el tamaño de la imagen */
                        display: block; /* Para que la imagen esté en una línea separada */
                        margin: 0 auto; /* Para centrar la imagen horizontalmente */
                    }
                </style>
                
                <!--Form to login-->
                <form action="assets/php/login.php" method="POST" class="form_Login">
                    <img src="assets/Resources/lockIcon.png" alt="Imagen de inicio de sesión">
                    <h2>Iniciar Sesión</h2>
                    <input type="text" placeholder="Usuario" name="usuario">
                    <input type="password" placeholder="Contraseña" name="contrasena">
                    <button>Entrar</button>                    
                </form>

                <!--Imagen candado-->
                <style>
                    .form_Register {
                        text-align: center; /* Para centrar el contenido del formulario */
                    }
                    .form_Register img {
                        width: 50px; /* Cambia el tamaño de la imagen */
                        display: block; /* Para que la imagen esté en una línea separada */
                        margin: 0 auto; /* Para centrar la imagen horizontalmente */
                    }
                </style>

                <!--Form to register-->
                <form action="assets/php/register.php" method="POST" class="form_Register">
                    <img src="assets/Resources/lockOpenIcon.png" alt="Imagen de inicio de sesión">
                    <h2>Registrarse</h2>
                    <input type="text" placeholder="Nombre" name="name">
                    <input type="text" placeholder="Apellido" name="lastname">
                    <input type="text" placeholder="Usuario" name="user">
                    <input type="text" placeholder="Correo Electrónico" name="email">
                    <input type="password" placeholder="Contraseña" name="contra">
                    <button>Registrarse</button>

                </form>
            </div>
        </div>
    </main>

    <!-- Enlace a JS-->
    <script src="assets/js/script.js"></script>    
    
</body>
</html>