<?php

require "../modelo/Bd.php";
require "../modelo/Categoria.php";
require "../modelo/Lista.php";

require "../modelo/Usuario.php";

session_start();
if (empty($_SESSION['nombre'])) {
    header('Location: index.php');
}

$permisos = $_SESSION['permiso'];

$id = $_GET['id'];//Id del usuario que visitamos

$usuario = new Usuario();

$usuario->obtenerUserID($id);

$nombreUsu=$usuario->getNombre();

$html = $usuario->imprimeUsuario($nombreUsu);

if($permisos==79){
    $html .= "<div class='eliminarUserAdmin' onclick='eliminarUserAd(".$id.")'><label>Eliminar Usuario</label><img src='imgFront/delete.png'></div>";
}

echo($html);