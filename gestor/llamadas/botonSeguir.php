<?php
require "../modelo/Usuario.php";
require_once "../modelo/Bd.php";
$conexion=new Bd();
session_start();
if (empty($_SESSION['nombre'])) {
    header('Location: index.php');
}
$id1 = $_SESSION['id'];
$id2 = $_GET['id'];
$follow=$_GET['follow'];
if($follow=="true"){
$html = "<a class='unfollowUser' onclick='seguirUser(".$id2.",false)'><img src='imgFront/star.png'><label>Siguiendo</label></a>";
$conexion->seguirUsuario($id1,$id2);
}
else{
$html = "<a class='followUser' onclick='seguirUser(".$id2.",true)'><img src='imgFront/userFollow.png'><label>Seguir</label></a>";
$conexion->desSeguirUsuario($id1,$id2);
}
echo ($html);