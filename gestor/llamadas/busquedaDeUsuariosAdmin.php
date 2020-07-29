
<?php
require "../modelo/Usuario.php";
require_once "../modelo/Bd.php";


session_start();
if (empty($_SESSION['nombre'])) {
    header('Location: index.php');
}

$busqueda= $_GET['busqueda'];
//Consigo los usuarios que coincidan con la palabara clave de la busqueda

$busqueda = preg_replace("#[^0-9a-z]#i","",$busqueda);


    $usuario= new Usuario();
    $usuario->buscarUsuario($busqueda);

    if($usuario->getLista() != null){
        $html = $usuario->mostrarUsuariosAd();
    }else{
        $html ="<h1 class='mensajeInfo'>No existen Usuarios con ese nombre</h1>";
    }


echo($html);

