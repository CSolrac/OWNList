<?php
require_once "../modelo/Bd.php";
require_once "../modelo/Review.php";
session_start();
if (empty($_SESSION['nombre'])) {
    header('Location: index.php');
}

$id_resenna = $_GET['id'];
$nomUsu = $_GET['nombre'];

$review = new Review();

$review->getById($id_resenna);

if (strlen($review->getImagen()) == 0) {

    $fondo = "style='background-image:url(\"imgFront/backOWN.png\")';";
} else {

    $fondo = "style='background-image:url(\"Usuarios/" . $nomUsu . "/" . $review->getImagen() . "\")')";
}

$html = "
        <div class='listaResennaInt'>

        <div " . $fondo . " class='imageResenna'></div>

        <div class='textResenna'>

        <label class='nombreResenna'>" . $review->getNombre() . "</label>
        
        </div>";
$like = $review->liked($id_resenna);

if ($like == 1) {
    $corazon = "<div class='columnLike' id='likeIcon" . $review->getId() . "'><img class='imgResLike' onclick='darLike(" . $review->getId() . ")' src='imgFront/likeOn.png'><div class='numLikes'>" . $review->getLikes() . "</div></div>";
} else {
    $corazon = "<div class='columnLike' id='likeIcon" . $review->getId() . "'><img class='imgResUnLike' onclick='darLike(" . $review->getId() . ")' src='imgFront/likeOn.png'><div class='numUnLikes'>" . $review->getLikes() . "</div></div>";
}
$html .= $corazon;
$html .= "<div class='imgRes'><img onclick='AmpliarReview(" . $review->getId() . ",\"".$nomUsu. "\", " . $_GET['edit'] . ")' src='imgFront/arrowDownC.png'></div>
        </div>";

echo $html;
