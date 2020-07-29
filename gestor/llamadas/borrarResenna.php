<?php
require "../modelo/Review.php";
require "../modelo/Lista.php";
require "../modelo/Usuario.php";
require_once "../modelo/Bd.php";

session_start();
if (empty($_SESSION['nombre'])) {
    header('Location: index.php');
}
$lista = new Lista();
$review = new Review();
$usuario = new Usuario();

$idRev = intval($_GET['id']);
$id_lista = intval($_GET['id_lista']);
$idUsu = ($_SESSION['id']);
$idCreador = $lista->obtenerIDAutor($id_lista);
$usuario->obtenerUserID($idCreador);
if ($idCreador == $idUsu||$_SESSION['permiso']==79) {
    //borro el elemento de la BD y su foto
    $review->borrarReview($idRev, $_SESSION['nombre']);
}
    //obtiene las reviews de una lista 
    $review->obtenerReviews($id_lista);

    $html = $review->mostrarReview($usuario->getNombre());
echo $html;
