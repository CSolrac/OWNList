<?php
require "gestor/modelo/Lista.php";
require "gestor/modelo/Bd.php";
require "gestor/modelo/Categoria.php";
require "gestor/modelo/Review.php";
require("gestor/modelo/ValidarImagen.php");
session_start();
if (empty($_SESSION['nombre'])) {
    header('Location: login.php');
}

$lista = new Lista();
$review = new Review();
$id_usu = $_SESSION['id'];
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $nombreUsu = $_SESSION['nombre'];
    $id = intval($_GET['id']);
    $lista->getById($id);
    $categoria = intval($lista->getCategoria());
}

if (isset($_POST['EditarLista']) && !empty($_POST['EditarLista'])) {
    unset($_POST['EditarLista']);
    $lista->actualizarLista($_POST, $id, $_SESSION['nombre'], $_FILES['banner']);
}
if (isset($_POST['BorrarLista']) && !empty($_POST['BorrarLista'])) {
    unset($_POST['BorrarLista']);
    $lista->borrarLista($id, $nombreUsu);
    
}
if (isset($_POST['InserResenna']) && !empty($_POST['InserResenna'])) {
    unset($_POST['InserResenna']);
    $_POST['id_lista'] = $id;
    $review->InsertarReview($_POST, $nombreUsu, $_FILES['imagen']);
    header("Location: mostrarLista.php?id=". $id);
}

if (!($lista->comprobarUsuario($id, $id_usu))) {
    header("Location: misListas.php?c=" . $categoria);
}


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

<body onload="thisLink(1), MostrarResennas(<?php echo($id)?>), social()">

    <div id="container">
        <div class="main">
            <section>

                <div id="contenido" class="animateAppear">

                    <div class="contenidoLista">

                        <div class="botonesCabecera">

                            <a class="back" href="misListas.php?c=<?php echo ($categoria); ?>"><img src="imgFront/back.png"><label>Atrás</label></a>

                            <a class="editLista" onclick='AbrirCrearLista(<?php echo ($categoria) ?>,<?php echo ($id) ?>)'><img src="imgFront/edit.png"><label>Editar Lista</label></a>
                            <a class="deleteLista" onclick="AbrirEliminarLista()"><img src="imgFront/delete.png"><label>Eliminar Lista</label></a>

                        </div>

                        <?php echo ($lista->imprimeLista($_SESSION['nombre'])) ?>

                        <div id="containerEntradas">

                            <div class="crearEntrada" onclick="AbrirCrearRessena()" onmouseover="colorPlusEnt()" onmouseout="colorPlusEntOri()"><img class="plusEnt" src="imgFront/plus.png"><label>NUEVA ENTRADA</label></div>

                            <div id="reseñaslmao">

                            </div>

                        </div>

                    </div>

                    <div id="eliminarLista">

                        <div id="backEliminarLista">

                            <div class="confirmacionEliminarLista animate">

                                <label>¿Desea eliminar esta Lista?</label>
                                <form id="BorrarLista" action="" method="post">
                                    <div class="opcionesEliminar">
                                        <input type="hidden" name="BorrarLista" value="BorrarLista">
                                        <a class="yes" onclick="borrarLista()"><label>SI</label><img src="imgFront/yes.png"></a><a class="no" onclick="CerrarEliminarLista()"><label>NO</label><img src="imgFront/no.png"></a>
                                    </div>
                                </form>
                            </div>

                        </div>

                    </div>

                    <div id="eliminarLista">

                        <div id="backEliminarResenna">

                            <div class="confirmacionEliminarLista animate">

                                <label>¿Desea eliminar esta Entrada?</label>
                                <form id="BorrarLista" action="" method="post">
                                    <div class="opcionesEliminar">
                                        <input type="hidden" name="BorrarLista" value="BorrarLista">
                                        <a class="yes" onclick="BorrarReview()"><label>SI</label><img src="imgFront/yes.png"></a><a class="no" onclick="CerrarEliminarResenna()"><label>NO</label><img src="imgFront/no.png"></a>
                                    </div>
                                </form>
                            </div>

                        </div>

                    </div>

                </div>

                <div id="CrearLista"></div>
                <div id="CrearResenna"></div>

                <?php
                include("includes/social.php");
                ?>

            </section>

            <?php
            include("includes/aside.php");
            ?>

        </div>

    </div>

</body>