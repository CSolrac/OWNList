<?php
require "../modelo/Lista.php";
require_once "../modelo/Bd.php";
session_start();
if (empty($_SESSION['nombre'])) {
    header('Location: index.php');
}

$id = intval($_GET['id']);
$categoria=($_GET['categoria']);
$nombreUsu=($_SESSION['nombre']);
//borro el elemento de la BD y su foro
$lista = new lista();
$lista->borrarLista($id,$nombreUsu);



