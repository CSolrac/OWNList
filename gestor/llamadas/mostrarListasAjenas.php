<?php

require "../modelo/Categoria.php";
require "../modelo/Lista.php";
require "../modelo/Usuario.php";
require_once "../modelo/Bd.php";

session_start();
if (empty($_SESSION['nombre'])) {
    header('Location: index.php');
}

$idUsu=$_GET['id'];

$lista= new Lista();
$usuario=new Usuario();

$lista->obtenerListaUsu($idUsu);

$usuario->obtenerUserID($idUsu);

$nombreUsu=$usuario->getNombre();

if($lista->mostrarListasAjenas($nombreUsu)=="")


$html="<h1 class='mensajeInfo'>Este Usuario no tiene Listas para mostrar</h1>";
else $html=$lista->mostrarListasAjenas($nombreUsu);

echo $html;