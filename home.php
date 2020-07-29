<?php
require("gestor/modelo/Bd.php");
require("gestor/modelo/Categoria.php");
require("gestor/modelo/Lista.php");
require("gestor/modelo/Review.php");
require("gestor/modelo/Usuario.php");
session_start();
if (empty($_SESSION['nombre'])) {
    header('Location: login.php');
}
$idUsu = $_SESSION['id'];
$nomUsu = $_SESSION['nombre'];

$review = new Review();

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OWNList</title>
    <script type="text/javascript" src="scripts/script.js"></script>
    <script type="text/javascript" src="gestor/scripts/scripts.js"></script>
    <link rel="stylesheet" type="text/css" href="styles/styleHome.css">
    <link rel="shortcut icon" href="imgFront/Icono.ico" />
</head>

<body onload="thisLink(0), mostrarCrono(<?php echo($idUsu)?>), social() ">

    <div id="container">
        <div class="main">
            <section>

                <div id="contenido" class="animateAppear">

                    <div class="banner" id="patata" style="background-image:url('<?php echo $_SESSION['banner'] ?>" );)>
                        <img src="imgFront/gear.png" onclick="editarPerfil()">

                        <!--<div class="transBox"></div>-->

                        <div class="infoUsu">

                            <label class="username"><?php echo $_SESSION['nombre'] ?></label>

                            <label class="bio"><?php echo $_SESSION['bio'] ?></label>

                        </div>

                        <div class="avatar" style="background-image:url('<?php echo $_SESSION['avatar'] ?>" );)></div>

                    </div>

                    <div class="recuadroTit" >Tus Entradas más recientes </div>

                    <div id="cronologia"></div>
                </div>

                <?php
                include("includes/social.php");
                ?>
            </section>
            <?php
            include("includes/aside.php");
            ?>
        </div>
    </div>

    </div>

</body>