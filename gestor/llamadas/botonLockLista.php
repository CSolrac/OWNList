<?php

require "../modelo/Lista.php";
require_once "../modelo/Bd.php";

$lista = new Lista();

session_start();
if (empty($_SESSION['nombre'])) {
    header('Location: index.php');
}

$idLista = $_GET['id'];

$lock = $lista->locked($idLista);

if($lock!=1){
$html = "<img class='imagenLock' onclick='lockingLista(".$idLista.", false)' src='imgFront/iconLock.png'>";
$lista->ListaPrivada($idLista);
}
else{
$html = "<img class='imagenUnLock' onclick='lockingLista(".$idLista.", true)' src='imgFront/iconUnLock.png'>";
$lista->ListaPublica($idLista);
}
echo ($html);
