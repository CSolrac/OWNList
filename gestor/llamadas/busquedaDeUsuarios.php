
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

if($busqueda == ""){

    $html = "<h1 class='mensajeInfo'>Introduce el nombre del Usuario a buscar</h1>";

}else{

    $usuario= new Usuario();
    $usuario->buscarUsuario($busqueda);

    if($usuario->getLista() != null){
        $html = $usuario->mostrarUsuarios();
    }else{
        $html ="<h1 class='mensajeInfo'><div>¡Vaya!</div> No hemos encontrado a nadie con ese nombre, <div>prueba con uno diferente</div></h1>";
    }

}

echo($html);

