<?php
require_once("gestor/modelo/Usuario.php");
require_once("gestor/modelo/Bd.php");
require_once("gestor/modelo/ValidarImagen.php");

if (isset($_POST['SubmitPerfil']) && !empty($_POST['SubmitPerfil'])) {
    unset($_POST['SubmitPerfil']);
    $usuario = new Usuario($_SESSION['nombre']);
    $usuario->editarPerfil($_POST, $_FILES['avatar'], $_FILES['banner']);
    $_SESSION['bio'] = $usuario->getBio();
    $_SESSION['avatar'] = $usuario->getAvatar();
    $_SESSION['banner'] = $usuario->getBanner();
    header("Refresh:0");
    
}

$permisos = $_SESSION['permiso'];

$ideUsu = $_SESSION['id'];

$html = "";

if($permisos == 79){

    $html = "<div class=\"botimg\" onmouseover=\"changeColor(3)\" onmouseout=\"devolverColor(3)\" onclick=\"location.href='administracion.php';\">
    <img class=\"iconitos\" src=\"imgFront/logoBot.png\">
    <div class=\"boton\">Administración</div>
    </div>";

}

?>
<aside>

    <img src="imgFront/Logo.png">
    <div class="menu">

        <div class="botimg" onmouseover="changeColor(0)" onmouseout="devolverColor(0)" onclick="location.href='index.php'">
            <img class="iconitos" src="imgFront/home.png">
            <div class="boton">Inicio</div>
        </div>

        <div class="botimg" onmouseover="changeColor(1)" onmouseout="devolverColor(1)" onclick="location.href='misListas.php'">
            <img class="iconitos" src="imgFront/list.png">
            <div class="boton">Mis Listas</div>
        </div>

        <div class="botimg" onmouseover="changeColor(2)" onmouseout="devolverColor(2)" onclick="location.href='buscarUsuarios.php';">
            <img class="iconitos" src="imgFront/buscarUser.png">
            <div class="boton">Buscar Usuario</div>
        </div>

        <div id="bota"><?php echo ($html) ?></div>

    </div>

    <div class="usuario">

        <div class="imgHeader" style="background-image:url('<?php echo $_SESSION['avatar'] ?>" );)>

        </div>

        <div class="datosUser">
            <label class="fontUser" onclick="editarPerfil()"><?php echo $_SESSION['nombre'] ?></label>
            <label id="cerrarSesion" class="fontUser" onclick="location.href='logout.php';">Cerrar Sesión</label>
        </div>

    </div>
</aside>

<div id="backEd">
    <div id="EditPerfil" class="animate">
        <div class="formEd">
            <div class="titlePopUp">Personalizar Perfil</div>
            <img id="xEd" class="x" onclick="CerrarEditPerfil()" src="imgFront/x.png">
            <form id="formularioUser" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
                
                <div class="backForms">
                <div class="labelPopUp">Cambiar Avatar</div>
                <input name="avatar" type="file">
                <div class="labelPopUp">Cambiar Banner</div>
                <input name="banner" type="file">
                <div class="labelPopUp">Biografia</div>
                <input name="bio" type="text" value="<?php echo $_SESSION['bio'] ?>">
                <input type="hidden" name="SubmitPerfil" value="Submit">
                </div>
                <button type="button" class="botlog" onclick="cambio()"> Actualizar Perfil </button>
            </form>
        </div>
    </div>
</div>