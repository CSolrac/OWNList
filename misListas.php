<?php
require("gestor/modelo/Bd.php");
require("gestor/modelo/Categoria.php");
require("gestor/modelo/Lista.php");
require("gestor/modelo/ValidarImagen.php");
session_start();
if (empty($_SESSION['nombre'])) {
    header('Location: index.php');
}

$nCategoria=99;
$busqueda="";
$lista = new Lista();
if (isset($_POST['CrearLista']) && !empty($_POST['CrearLista'])) {
    unset($_POST['CrearLista']);
    $_POST['id_usu'] = $_SESSION['id'];
  $lista->insertarLista($_POST, $_SESSION['nombre'], $_FILES['banner']);
  $nCategoria = $_POST['categoria'];
   header("Location: misListas.php?c=".$nCategoria." ");
}

$categorias = new Categoria();

$categorias->obtenerCategorias();
if (isset($_POST['buscar']) && !empty($_POST['buscar'])) {
    $busqueda=$_POST['buscar'];
    echo($busqueda);
}
if (isset($_GET['c'])) {
    if ($_GET['c'] >= 0 && $_GET['c'] <= 5)
        $nCategoria = intval($_GET['c']);
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Listas</title>
    <script type="text/javascript" src="scripts/script.js"></script>
    <script type="text/javascript" src="gestor/scripts/scripts.js"></script>
    <link rel="stylesheet" type="text/css" href="styles/styleHome.css">
    <link rel="shortcut icon" href="imgFront/Icono.ico">
</head>

<body onload="thisLink(1), buscarlista(<?php echo ($nCategoria) ?>), selectCategoria(<?php echo ($nCategoria) ?>), social()">
<div id="container">
        <div class="main">
            <section>
                <div id="contenido" class="animateAppear">
                    <div id="misListas">

                        <label>MIS LISTAS</label>

                        <div class="categories">

                            <div class="categoria peliculas" onclick="buscarlista(0,'<?php echo ($busqueda)?>'), selectCategoria(0)" onmouseover="categoriaSelect(0)" onmouseout="categoriaDevolverColor(0)">

                                <label>PELICULAS</label>
                                <div><img src="imgFront/peliculas.png"></div>

                            </div>

                            <div class="categoria series" onclick="buscarlista(1,'<?php echo ($busqueda)?>'), selectCategoria(1)" onmouseover="categoriaSelect(1)" onmouseout="categoriaDevolverColor(1)">

                                <label>SERIES</label>
                                <div><img src="imgFront/series.png"></div>

                            </div>

                            <div class="categoria libros" onclick="buscarlista(2,'<?php echo ($busqueda)?>'), selectCategoria(2)" onmouseover="categoriaSelect(2)" onmouseout="categoriaDevolverColor(2)">

                                <label>LIBROS</label>
                                <div><img src="imgFront/libros.png"></div>

                            </div>

                            <div class="categoria videojuegos" onclick="buscarlista(3,'<?php echo ($busqueda)?>'), selectCategoria(3)" onmouseover="categoriaSelect(3)" onmouseout="categoriaDevolverColor(3)">

                                <label>VIDEOJUEGOS</label>
                                <div><img src="imgFront/juegos.png"></div>

                            </div>

                            <div class="categoria comics" onclick="buscarlista(4,'<?php echo ($busqueda)?>'), selectCategoria(4)" onmouseover="categoriaSelect(4)" onmouseout="categoriaDevolverColor(4)">

                                <label>COMICS</label>
                                <label>MANGAS</label>
                                <div><img src="imgFront/comics.png"></div>

                            </div>

                            <div class="categoria animes" onclick="buscarlista(5,'<?php echo ($busqueda)?>'), selectCategoria(5)" onmouseover="categoriaSelect(5)" onmouseout="categoriaDevolverColor(5)">

                                <label>ANIMES</label>
                                <div><img src="imgFront/animes.png"></div>

                            </div>
                        </div>
                    </div>

                    <div id="listasActual">

                        <div class="botonCrear" onclick='AbrirCrearLista(99)' onmouseover="colorPlusBasic()" onmouseout="colorPlusOriBasic()"><img class="plus" src='imgFront/plus.png'><label>NUEVA LISTA</label></div>

                    </div>
                    <!--<form id="Buscador"  action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                        <input name="buscar"  type="text" placeholder="Buscar" aria-label="Search">
                    </form>-->
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