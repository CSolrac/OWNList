<?php
require "../modelo/Lista.php";
require_once "../modelo/Bd.php";
require "../modelo/Categoria.php";

session_start();
if (empty($_SESSION['nombre'])) {
    header('Location: index.php');
}

$Titulo = "Nueva Lista";
$nombre = "";
$Crear_Editar = "CrearLista";
$TextoBoton="Crear Lista";
$lista = new Lista();
$categorias = new Categoria();
$categorias->obtenerCategorias();

$tipo = $_GET['tipo'];
$id_usu = intval($_SESSION['id']);


if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = intval($_GET['id']);
    $Crear_Editar = "EditarLista";
    $TextoBoton="Editar Lista";
    $lista->obtenerListaID($id);

    $Titulo = "Editar " . $lista->getNombre();
    $nombre = $lista->getNombre();
    $imagen = $lista->getBanner();
}

//Pido de nuevo la lista de elementos y la envio a ajax
$clase = "";
$categoria = "";
//var_dump($categorias);

if (($tipo == "99") || (isset($_GET['id']) && !empty($_GET['id']))) {

    $html = "<div id='nuevaCajaFormu' class='animate'>
    <div class='formEd'>
        <img id='xEd' class='x' onclick='CerrarCrearLista()' src='imgFront/x.png'>
        <div class=\"titlePopUp\">" . $Titulo . "</div>
        <form id='formulariolista' method='post' enctype='multipart/form-data'>
            <div class=\"backForms\">
            <div class=\"labelPopUp\">Nombre de la Lista</div>
            <input type='text' name='nombre' value='" . $nombre . "'>
            <div class=\"labelPopUp\">Categoría</div>
            <select name=\"categoria\">";

    $html .=  $categorias->mostrarCategorias($tipo)."</select>";

    $html .= "<div class=\"labelPopUp\">Banner</div>";

    if ($Crear_Editar == "EditarLista") {

        if ($imagen != "") {

            $html .= "<div class='ImagenEditar' style='background-image:url(\"" . $lista->getCarpeta() . $_SESSION['nombre'] . '/' . $imagen . "')'></div>";
        }
    }

    $html .= "<input type='file' name='banner'>
            </div>
            <input type='hidden' name='" . $Crear_Editar . "' value='" . $Crear_Editar . "'>";


    $html .= "<button type='button' class='botlog' onclick='ValidarCrearLista()'>". $TextoBoton ."</button>
        </form>
    
    </div>
    </div>";
} else {

    $lista = new Lista();
    $lista->obtenerListas($id_usu, $tipo);

    switch ($tipo) {
        case 0: {
                $categoria = 'PELICULAS';
                $clase = "'mainLista peliculasList'";
                $claseCrear = "'botonCrear peliculasCrearList'";
                break;
            }
        case 1: {
                $categoria = 'SERIES';
                $clase = "'mainLista seriesList'";
                $claseCrear = "'botonCrear seriesCrearList'";
                break;
            }
        case 2: {
                $categoria = 'LIBROS';
                $clase = "'mainLista librosList'";
                $claseCrear = "'botonCrear librosCrearList'";
                break;
            }
        case 3: {

                $categoria = 'VIDEOJUEGOS';
                $clase = "'mainLista videojuegosList'";
                $claseCrear = "'botonCrear videojuegosCrearList'";
                break;
            }
        case 4: {

                $categoria = 'COMICS / MANGAS';
                $clase = "'mainLista comicsList'";
                $claseCrear = "'botonCrear comicsCrearList'";
                break;
            }
        case 5: {
                $categoria = 'ANIMES';
                $clase = "'mainLista animesList'";
                $claseCrear = "'botonCrear animesCrearList'";
                break;
            }
    }

    $html = "<div id='nuevaCajaFormu' class='animate'>
    <div class='formEd'>
        <img id='xEd' class='x' onclick='CerrarCrearLista()' src='imgFront/x.png'>
        <div class=\"titlePopUp\">Nueva Lista " . $categoria . "</div>
        <form id='formulariolista' action='misListas.php' method='post' enctype='multipart/form-data'>
            <div class=\"backForms\">
            <div class=\"labelPopUp\">Nombre de la Lista</div>
            <input type='text' name='nombre' placeholder='Titulo'>
            <div class=\"labelPopUp\">Banner</div>
            <input type='file' name='banner'>
            <input type='hidden' name='categoria' value=" . $tipo . ">
            <input type='hidden' name='CrearLista' value='CreaLista'>
            </div>
            <button type='button' class='botlog' onclick='ValidarCrearLista()'>". $TextoBoton ."</button>
        </form>
    
    </div>
    </div>";
}

//echo($tipo." ".$id);

echo $html;
