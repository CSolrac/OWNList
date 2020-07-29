<?php

require "../modelo/Categoria.php";
require "../modelo/Lista.php";
require "../modelo/Usuario.php";
require "../modelo/Review.php";
require_once "../modelo/Bd.php";

session_start();
if (empty($_SESSION['nombre'])) {
    header('Location: index.php');
}

$idlista = $_GET['id'];
$idUsu = $_GET['idUsu'];
$lista = new Lista();
$review = new Review();
$usuario = new Usuario();

//Metodos para obtener el nombre del usuario al que pertenece la lista
$usuario->obtenerUserID($idUsu);
$nombreUsu = $usuario->getNombre();
//obtiene la lista que se ha seleccionado y las reviews de esa lista
$lista->obtenerListaID($idlista);

$cat = new Categoria();

$iconoCategoria = $cat->obtenerIcono($lista->getCategoria());

if (strlen($lista->getBanner()) == 0) {

    $fondo = "style='background-image:url(\"imgFront/backOWN.png\")';";
} else {

    $fondo = "style='background-image:url(\"" . $lista->getCarpeta() . $nombreUsu . "/" . $lista->getBanner() . "\")')";
}


$html = "<div  " . $fondo . "   class='ListaAjena animateAppear'>
<div class='textLista'>
<img src='" . $iconoCategoria . "'>
<div class='textList'>
<label class='nombreLista'>" . $lista->getNombre() . "</label>
<label class='nombreCategoria'>" . $lista->getCategoria() . "</label>
</div>

</div>
</div>";


$review->obtenerReviews($idlista);
$html .= $review->mostrarReviewAjena($nombreUsu);

echo $html;
