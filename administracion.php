<?php

require("gestor/modelo/Bd.php");
require("gestor/modelo/Usuario.php");

session_start();
if (empty($_SESSION['nombre'])) {
    header('Location: login.php');
}

$permisos = $_SESSION['permiso'];

if($permisos != 79){

    header('Location: home.php');

}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Usuario</title>
    <script type="text/javascript" src="scripts/script.js"></script>
    <script type="text/javascript" src="gestor/scripts/scripts.js"></script>
    <link rel="stylesheet" type="text/css" href="styles/styleHome.css">
    <link rel="shortcut icon" href="imgFront/Icono.ico">
</head>

<body onload="thisLink(3), social()">
<div id="container">
    <div class="main">
        <section>

            <div id="contenido" class="animateAppear">

                <div id="buscarUsers">

                    <label>ADMINISTRACIÓN</label>

                    <div class="simpleButton"><label>Gestión de Usuarios</label><img src="imgFront/usersAd.png"></div>

                    <div class="buscarBox">
                        <div class="busqueda">
                            <div id="formBuscar">
                                <input class="buscar" type="search" id="buscarAd" name="buscar" placeholder="Nombre del Usuario">
                                <button class="botBusqueda" type="button" value="Buscar" onclick="submitBusquedaAdmin()">Buscar</button>
                            </div>
                        </div>
                    </div>
                    
                    <div id="resultadoBusquedaAdmin"></div>
                
                </div>
                

            </div>
            
            <?php
            include("includes/social.php");
            ?>

        </section>

        <?php
        include("includes/aside.php");
        ?>

    </div>

    <div id="CrearLista"></div>

</div>
</body>

</html>