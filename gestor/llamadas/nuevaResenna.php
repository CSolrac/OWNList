<?php
require "../modelo/Lista.php";
require_once "../modelo/Bd.php";
require "../modelo/Categoria.php";
require "../modelo/Review.php";

session_start();
if (empty($_SESSION['nombre'])) {
    header('Location: index.php');
}
/*<input type='number' name='valoracion' min='0' max='5'>*/ 

$html= "<div id='nuevaCajaFormu' class='animate'>
            <div class='formEd'>
            <img id='xEd' class='x' onclick='CerrarCrearResenna()' src='imgFront/x.png'>
                <div class=\"titlePopUp\">Nueva Entrada</div>
                    <form id='formularioResenna' action='' method='post' enctype='multipart/form-data'>
                        <div class=\"backForms\">
                        <div class=\"labelPopUp\">Nombre de la Entrada</div>
                            <input type='text' name='nombre' placeholder='Titulo'>
                        <div class=\"labelPopUp\">Comentario</div>
                            <input type='text' name='resenna' placeholder='Reseña'>
                        <div class=\"labelPopUp\">Valoración</div>
                            
                            <div class='rate'>
                            <input type='radio' id='star5' name='valoracion' value='5' />
                            <label for='star5' title='text'>5 stars</label>
                            <input type='radio' id='star4' name='valoracion' value='4' />
                            <label for='star4' title='text'>4 stars</label>
                            <input type='radio' id='star3' name='valoracion' value='3' />
                            <label for='star3' title='text'>3 stars</label>
                            <input type='radio' id='star2' name='valoracion' value='2' />
                            <label for='star2' title='text'>2 stars</label>
                            <input type='radio' id='star1' name='valoracion' value='1' />
                            <label for='star1' title='text'>1 star</label>
                          </div>

                        <div class=\"labelPopUp\">Imagen</div> 
                            <input type='file' name='imagen'>
                            <input type='hidden' name='InserResenna' value='InserResenna'>
                        </div>
                        <button class='botlog' type='button' onclick='validarResenna()'>Crear Entrada</button>
                    </form>
            </div>
        </div>";
echo $html;