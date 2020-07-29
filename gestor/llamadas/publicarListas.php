<?php
require "../modelo/Lista.php";
require_once "../modelo/Bd.php";
require_once "../modelo/Categoria.php";
session_start();
if (empty($_SESSION['nombre'])) {
    header('Location: index.php');
}


$tipo = $_GET['tipo'];
$id = intval($_SESSION['id']);
$busqueda="";
$busqueda = $_GET['search'];
//Pido de nuevo la lista de elementos y la envio a ajax

$lista = new Lista();
$lista->obtenerListas($id, $tipo,$busqueda);
$clase = "";
$categoria = "";
$claseCrear = "";
$claseNombre="";
switch ($tipo) {
    case 0: {
            $categoria = 'PELICULAS';
            $clase = "'mainLista animateAppear peliculasList'";
            $claseCrear = "'botonCrear peliculasCrearList'";
            $claseNombre = "'category animateAppear peliculasListC'";
            break;
        }
    case 1: {
            $categoria = 'SERIES';
            $clase = "'mainLista animateAppear seriesList'";
            $claseCrear = "'botonCrear seriesCrearList'";
            $claseNombre = "'category animateAppear seriesListC'";
            break;
        }
    case 2: {
            $categoria = 'LIBROS';
            $clase = "'mainLista animateAppear librosList'";
            $claseCrear = "'botonCrear librosCrearList'";
            $claseNombre = "'category animateAppear librosListC'";
            break;
        }
    case 3: {
            $categoria = 'VIDEOJUEGOS';
            $clase = "'mainLista animateAppear videojuegosList'";
            $claseCrear = "'botonCrear videojuegosCrearList'";
            $claseNombre = "'category animateAppear videojuegosListC'";
            break;
        }
    case 4: {
            $categoria = 'COMICS / MANGAS';
            $clase = "'mainLista animateAppear comicsList'";
            $claseCrear = "'botonCrear comicsCrearList'";
            $claseNombre = "'category animateAppear comicsListC'";
            break;
        }
    case 5: {

            $categoria = 'ANIMES';
            $clase = "'mainLista animateAppear animesList'";
            $claseCrear = "'botonCrear animesCrearList'";
            $claseNombre = "'category animateAppear animesListC'";
            break;
        }
}
$html = "<div class=" . $clase . ">" . $categoria . "</div><div class=" . $claseCrear . " onclick='AbrirCrearLista(" . $tipo . ")'  onmouseover='colorPlus()' onmouseout='colorPlusOri()'><img class='plus' src='imgFront/plus.png'><label>NUEVA LISTA</label><label id='labelColor' class=" . $claseNombre . ">" . $categoria . "</label></div>" . $lista->mostrarListas($_SESSION['nombre']);

//echo($tipo." ".$id);

echo $html;
