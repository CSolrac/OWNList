<?php

require "../modelo/Review.php";
require_once "../modelo/Bd.php";

$review = new Review();

session_start();
if (empty($_SESSION['nombre'])) {
    header('Location: index.php');
}

$idRev = $_GET['id'];
$like = $review->liked($idRev);

if($like!=1){
$review->like($idRev);
$review->obtenerLikes($idRev);
$html = "<img class='imgResLike' onclick='darLike(". $idRev .")' src='imgFront/likeOn.png'><div class='numLikes'>".$review->getLikes()."</div>";

}
else{
$review->unlike($idRev);
$review->obtenerLikes($idRev);
$html = "<img class='imgResUnLike' onclick='darLike(". $idRev .")' src='imgFront/likeOn.png'><div class='numUnLikes'>".$review->getLikes()."</div>";

}
echo ($html);
