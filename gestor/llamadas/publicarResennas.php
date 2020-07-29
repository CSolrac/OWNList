<?php
require_once "../modelo/Bd.php";
require_once "../modelo/Review.php";
session_start();
if (empty($_SESSION['nombre'])) {
    header('Location: index.php');
}

$id_lista=$_GET['id'];
$nomUsu = $_SESSION['nombre'];
$review = new Review();

$review->obtenerReviews($id_lista);

$html= $review->mostrarReview($nomUsu);

echo $html;
