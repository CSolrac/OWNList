<?php
require_once "../modelo/Bd.php";


session_start();
if (empty($_SESSION['nombre'])) {
    header('Location: index.php');
}
$conexion = new Bd();

$id = $_SESSION['id'];

$contenido = $conexion->obtenerSocial($id);


echo $contenido;
?>