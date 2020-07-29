<?php

require_once("gestor/modelo/Bd.php");
require_once("gestor/modelo/Usuario.php");

//login
if (isset($_POST['login']) && !empty($_POST['login'])) {

    $nombre = addslashes($_POST['nombre']);

    $password = addslashes($_POST['password']);


    $usuario = new Usuario($nombre);
    if ($usuario->logearse($nombre, $password)) {
        //el usuario existe
        session_start();
        $_SESSION['id'] = $usuario->getId();
        $_SESSION['nombre'] = $usuario->getNombre();
        $_SESSION['permiso'] = $usuario->getPermiso();
        $_SESSION['bio'] = $usuario->getBio();
        $_SESSION['avatar'] = $usuario->getAvatar();
        $_SESSION['banner'] = $usuario->getBanner();
        $_SESSION['email'] = $usuario->getEmail();
        
        session_write_close();
        header('Location: home.php');
    } else {
        
    }
}

//Registro
if (isset($_POST['registro']) && !empty($_POST['registro'])) {
    $usuario = new Usuario();
    $conexion = new Bd();

    if ($conexion->todoOk($_POST['nombre'], $_POST['email'])) {
        unset($_POST['registro']);
        $usuario->registrarse($_POST);
    }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OWNList</title>
    <script type="text/javascript" src="scripts/script.js"></script>
    <link rel="stylesheet" type="text/css" href="styles/styleIndex.css">
    <link rel="shortcut icon" href="imgFront/Icono.ico" />
</head>

<body>
    <div id="registro" class="animate">
        <div class="caja_registro">
            <div class="formRegistro">
                <img class="x" onclick="CerrarRegistro()" src="imgFront/x.png">
                <div class="newUser">Crear Nuevo Usuario</div>
                <form id="formularioRegistro" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                        <div class="usernameLabel"><b>Nombre de usuario</b></div>
                        <input class="username" type="text" name="nombre" placeholder="Usuario" required>
                        <div class="usernameLabel"><b>Contraseña</b></div>
                        <input class="password" type="password" name="password" placeholder="Contraseña" required>
                        <div class="usernameLabel"><b>Email</b></div>
                        <input class="password" type="email" name="email" placeholder="Correo Electronico" required>
                    <input type="hidden" name="registro" value="registro">
                    <button type="button" class="botreg" onclick="validarRegistro()">Registrarse</button>
                </form>
            </div>
        </div>
    </div>


    <div id="container">
        <img class="logo" src="imgFront/Logo.png">
        <div id="containerLogin">
            <form id="formularioLogin" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="usernameLabel"><b>Nombre de usuario</b></div>
                <input class="username" type="text" placeholder="Nombre de usuario" name="nombre" required>
                <div class="passwordLabel"><b>Contraseña</b></div>
                <input class="password" type="password" placeholder="Contraseña" name="password" required>
                <input type="hidden" name="login" value="login">
                <button type="button" class="botlog" onclick="validarLogin()">Login</button>
            </form>
            <button  class="botreg" onclick="AbrirRegistro()">Registrate</button>
        </div>
    </div>
</body>

</html>