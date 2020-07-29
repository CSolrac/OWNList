
<?php
require "../modelo/Categoria.php";
require "../modelo/Lista.php";
require "../modelo/Review.php";
require_once "../modelo/Bd.php";


session_start();
if (empty($_SESSION['nombre'])) {
    header('Location: index.php');
}

$nomUsu=$_SESSION['nombre'];
$idUsu=$_GET['id'];

$review= new Review();
//Obtengo la cronologia del usuario
$review->obtenerCronologia($idUsu);

$cronologia=$review->mostrarCronologia($nomUsu);

if ($cronologia != "") echo ($cronologia);
else echo ("<h1 class='mensajeInfo'>Aun no tienes Entradas en ninguna Lista <div>¡Ve a 'Mis Listas' y comienza a crearlas!</div></h1>");