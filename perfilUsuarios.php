<?php

require("gestor/modelo/Bd.php");
require("gestor/modelo/Usuario.php");

session_start();
if (empty($_SESSION['nombre'])) {
    header('Location: login.php');
}
$conexion = new Bd();
$id1 = $_SESSION['id'];
$id2 = $_GET['id'];
$follow = "<a class='followUser' onclick='seguirUser(" . $id2 . ",true)'><img src='imgFront/userFollow.png'><label>Seguir</label></a>";
if ($conexion->comprobarSeguir($id1, $id2) == "true") {
    $follow = "<a class='unfollowUser' onclick='seguirUser(" . $id2 . ",false)'><img src='imgFront/star.png'><label>Siguiendo</label></a>";
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

<body onload="thisLink(2), mostrarPerfilUser(<?php echo $id2 ?>),mostrarListasAjenas(<?php echo $id2 ?>), social()">
    <div id="container">
        <div class="main">
            <section>

                <div id="contenido" class="animateAppear">

                    <div class="botonesCabeceraUser">

                        <a class="back" href="buscarUsuarios.php"><img src="imgFront/back.png"><label>Atrás</label></a>
                        <div id=followUserID><?php echo ($follow) ?></div>

                    </div>

                    <div id="perfilUsuario"></div>

                    <div id="listasPerfilUsuario"></div>

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