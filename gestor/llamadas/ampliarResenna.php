<?php
require_once "../modelo/Bd.php";
require_once "../modelo/Review.php";
session_start();
if (empty($_SESSION['nombre'])) {
    header('Location: index.php');
}

$id_resenna = $_GET['id'];
$nomUsu = $_GET['nombre'];
$borrar = "";
$review = new Review();
$review->getById($id_resenna);
if ($_GET['edit'] == "true" || $_SESSION['permiso'] == 79) {
    $borrar = "<div class='positionRowMid'><div onclick='BorrarReview(" . $review->getId() . "," . $review->getIdLista() . ")<!--AbrirEliminarResenna()-->' class='botElRes'><img src='imgFront/delete.png'><label>Borrar Entrada</label></div></div>";
}

if (strlen($review->getImagen()) == 0) {

    $fondo = "style='background-image:url(\"imgFront/backOWN.png\")';";
} else {

    $fondo = "style='background-image:url(\"Usuarios/" . $nomUsu . "/" . $review->getImagen() . "\")')";
}

$html = "
        <div class='listaResennaInt'>

            <div " . $fondo . " class='imageResenna'></div>

            <div class='textResenna'>

                <div class='nombreResenna'>" . $review->getNombre() . "</div>
            
            </div>";
$like = $review->liked($id_resenna);

if ($like == 1) {
    $corazon = "<div class='columnLike' id='likeIcon" . $review->getId() . "'><img class='imgResLike' onclick='darLike(" . $review->getId() . ")' src='imgFront/likeOn.png'><div class='numLikes'>" . $review->getLikes() . "</div></div>";
} else {
    $corazon = "<div class='columnLike' id='likeIcon" . $review->getId() . "'><img class='imgResUnLike' onclick='darLike(" . $review->getId() . ")' src='imgFront/likeOn.png'><div class='numUnLikes'>" . $review->getLikes() . "</div></div>";
}
$html .= $corazon;
$html .= "<div class='imgRes'><img onclick='MinimizarReview(" . $review->getId() . ",\"" . $nomUsu . "\", " . $_GET['edit'] . ")' src='imgFront/arrowUpC.png'></div>
            
        </div>

        <div class='ampliacionRes'>
        
            <div class='resennaText'>" . $review->getResenna() . "</div>
    <div class='valorationRes'>";
switch ($review->getValoracion()) {
    case 1: {
        $html.="★☆☆☆☆";
            break;
        }
    case 2: {
        $html.="★★☆☆☆";
            break;
        }
    case 3: {
        $html.="★★★☆☆";
            break;
        }
    case 4: {
        $html.="★★★★☆";
            break;
        }
    case 5: {
        $html.="★★★★★";
            break;
        }
    default: {
        $html.="☆☆☆☆☆";
            break;
        }
}

$html .= "</div>
            $borrar
        
        </div>";

echo $html;
