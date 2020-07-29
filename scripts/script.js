ng = 99;
nc = 99;
n = 99;

function AbrirRegistro() {
    var registro=document.getElementById("registro");
    registro.style.display = "block";
}

function CerrarRegistro() {
    var registro=document.getElementById("registro");
    registro.style.display = "none";
}

function CerrarEditPerfil() {
    var registro=document.getElementById("backEd");
    registro.style.display = "none";
}



function changeColor(n){
    var iconos = document.getElementsByClassName("iconitos");
    
    iconos[n].style.filter = "invert(96%) sepia(0%) saturate(0%) hue-rotate(64deg) brightness(1000%) contrast(101%)";

}

function devolverColor(n){
    var iconos = document.getElementsByClassName("iconitos");
    
    if(n != ng){

        iconos[n].style.filter = "initial";
        
    }
     
}

function colorPlus() {

    var plus = document.getElementsByClassName("plus");

    var labelColor = document.getElementById("labelColor");

    plus[0].style.filter = "invert(96%) sepia(0%) saturate(0%) hue-rotate(64deg) brightness(1000%) contrast(101%)";

    labelColor.classList.add("newColor");


}

function colorPlusBasic() {

    var plus = document.getElementsByClassName("plus");

    plus[0].style.filter = "invert(96%) sepia(0%) saturate(0%) hue-rotate(64deg) brightness(1000%) contrast(101%)";

}

function colorPlusOri() {

    var plus = document.getElementsByClassName("plus");

    var labelColor = document.getElementById("labelColor");

    plus[0].style.filter = "initial";

    labelColor.classList.remove("newColor");

}

function colorPlusOriBasic() {

    var plus = document.getElementsByClassName("plus");

    plus[0].style.filter = "initial";

}

function colorPlusEnt() {

    var plusEnt = document.getElementsByClassName("plusEnt");

    plusEnt[0].style.filter = "invert(96%) sepia(0%) saturate(0%) hue-rotate(64deg) brightness(1000%) contrast(101%)";


}

function colorPlusEntOri() {

    var plusEnt = document.getElementsByClassName("plusEnt");

    plusEnt[0].style.filter = "initial";

}

function thisLink(n) {

    ng = n;

    let iconos = document.getElementsByClassName("iconitos");
    let boton = document.getElementsByClassName("botimg");
    let label = document.getElementsByClassName("boton");

    boton[n].style.background = "#1669ab";
    iconos[n].style.filter = "invert(96%) sepia(0%) saturate(0%) hue-rotate(64deg) brightness(1000%) contrast(101%)";
    label[n].style.color = "#ffffff";

}

function selectCategoria(n){

    var categorias = document.getElementsByClassName("categoria");
    
    nc = n;

    categoriaDevolverColor(n);

    switch (n) {
        case 0:
        {
            for(var i = 0; i<categorias.length; i++){
                if(n != i){
                 categorias[i].style.background = "#1669ab";
                }
            }
            categorias[0].style.background = "rgb(125, 132, 255)";
            break;
        }
        case 1:
        {
           
            for(var i = 0; i<categorias.length; i++){
                if(n != i){
                    categorias[i].style.background = "#1669ab";
                }
            }
            categorias[1].style.background = "rgb(255, 125, 125)";
            break;
        }
        case 2:
        {
            for(var i = 0; i<categorias.length; i++){
                if(n != i){
                    categorias[i].style.background = "#1669ab";
                }
            }
            categorias[2].style.background = "rgb(118, 202, 135)";
            break;
        }
        case 3:
        {
            for(var i = 0; i<categorias.length; i++){
                if(n != i){
                    categorias[i].style.background = "#1669ab";
                }
            }
            categorias[3].style.background = "rgb(255, 182, 122)";
            break;
        }
        case 4:
        {
            for(var i = 0; i<categorias.length; i++){
                if(n != i){
                    categorias[i].style.background = "#1669ab";
                }
            }
            categorias[4].style.background = "rgb(102, 204, 195)";
            break;
        }
        case 5:
        {
            for(var i = 0; i<categorias.length; i++){
                if(n != i){
                    categorias[i].style.background = "#1669ab";
                }
            }
            categorias[5].style.background = "rgb(184, 120, 236)";
            break;
        }
    }

}

function categoriaSelect(n){
    
    var categorias = document.getElementsByClassName("categoria");

    switch (n) {
        case 0:
        {
            
                for(var i = 0; i<categorias.length; i++){
                    if(nc != i){
                        categorias[i].style.background = "#1669ab";
                    }
                }

            categorias[0].style.background = "rgb(125, 132, 255)";
            break;
        }
        case 1:
        {
            for(var i = 0; i<categorias.length; i++){
                if(nc != i){
                    categorias[i].style.background = "#1669ab";
                }
            }
            categorias[1].style.background = "rgb(255, 125, 125)";
            break;
        }
        case 2:
        {
            for(var i = 0; i<categorias.length; i++){
                if(nc != i){
                    categorias[i].style.background = "#1669ab";
                }
            }
            categorias[2].style.background = "rgb(118, 202, 135)";
            break;
        }
        case 3:
        {
            for(var i = 0; i<categorias.length; i++){
                if(nc != i){
                    categorias[i].style.background = "#1669ab";
                }
            }
            categorias[3].style.background = "rgb(255, 182, 122)";
            break;
        }
        case 4:
        {
            for(var i = 0; i<categorias.length; i++){
                if(nc != i){
                    categorias[i].style.background = "#1669ab";
                }
            }
            categorias[4].style.background = "rgb(102, 204, 195)";
            break;
        }
        case 5:
        {
            for(var i = 0; i<categorias.length; i++){
                if(nc != i){
                    categorias[i].style.background = "#1669ab";
                }
            }
            categorias[5].style.background = "rgb(184, 120, 236)";
            break;
        }
    }
}


function categoriaDevolverColor(n){
    
    var categorias = document.getElementsByClassName("categoria");

    for(var i = 0; i<categorias.length; i++){

        if(nc != i){
            categorias[i].style.background = "#1669ab";
        }

    }

}

//---------------POP UP LISTAS-----------------

function listasActual(){
    var listasActual = document.getElementById("listasActual");
    listasActual.style.display = 'block';
}

function CerrarListas() {
    var registro=document.getElementById("listasActual");
    registro.style.display = "none";
}

//-----------Validaciones Login--------------------------
function ResetStyles(datos) {//Pone todos los inputs en su color original para ello necesita

    for (var i = 0; i < datos.length; i++) {

        datos[i].style.borderColor = 'initial';
    }

}

function validarRegistro() {
var formularioRegistro=document.getElementById('formularioRegistro');
var datosRegistro=formularioRegistro.getElementsByTagName('input');
var todoOK=true;//Comprueba que todo el formulario este validado
var Vemail=/^(([^<>()\[\]\\.,;:\s@”]+(\.[^<>()\[\]\\.,;:\s@”]+)*)|(“.+”))@((\[[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}])|(([a-zA-Z\-0–9]+\.)+[a-zA-Z]{2,}))$/;
//var Vcontraseña=/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/;
var Vcontraseña=/^(?=.{1,15}$)[a-zA-Z0-9]/;

ResetStyles(datosRegistro);
//datos[0]=nombre,datos[1]=contraseña,datos[2]=email


// NOMBRE:no puede ser nulo, no puede tener mas de veinte caracteres y no puede contener inserciones sql
if (datosRegistro[0].value == "" ||Vcontraseña.test(datosRegistro[0].value)==false) {
    datosRegistro[0].style.border="1px solid red";
    todoOK = false;
    
}
//contraseña:no puede ser nulo,no puede tener mas de 20 caracteres 
if (datosRegistro[1].value == "" || Vcontraseña.test(datosRegistro[1].value)==false) {
    datosRegistro[1].style.border="1px solid red";
    todoOK = false;
    
}
if (datosRegistro[2].value == "" || Vemail.test(datosRegistro[2].value)==false) {
    datosRegistro[2].style.border="1px solid red";
    todoOK = false;
    
}


if(todoOK){
   formularioRegistro.submit();
}

}


function validarLogin(){
    var formularioLogin=document.getElementById('formularioLogin');
    var datos=formularioLogin.getElementsByTagName('input');
    var todoOK=true;//Comprueba quetodo el formulario este validado
  //  var Vcontraseña=/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/;
  var Vcontraseña=/^(?=.{1,15}$)[a-zA-Z0-9]/;
    ResetStyles(datos);
//datos[0]=nombre,datos[1]=contraseña



if (datos[0].value == "" || Vcontraseña.test(datos[0].value)==false) {
    datos[0].style.borderColor = 'red';
    todoOK = false;
}


//Este no puede ser nulo , no puede tener mas de 16 caracteres,la contraseña debe tener al menos 8 caracteres y no puede contener inserciones sql
if (datos[1].value==""||Vcontraseña.test(datos[1].value)==false){
    datos[1].style.borderColor = 'red';
    todoOK=false;
}

if(todoOK){
    document.getElementById('formularioLogin').submit();
}

}
//-----------------Validacion crearLista-------------------
function validateCrear() {
    document.getElementById('formulariolistaA').submit();
}

function ValidarCrearLista() {
    var formularioLista=document.getElementById('formulariolista');
    var datos=formularioLista.getElementsByTagName("input");
    var VNombre=/^(?=.{1,50}$)[a-zA-Z0-9._]/;
    ResetStyles(datos);
//datos[0]=Nombre de la lista


//NOMBRE
//console.log(datos[0]);
if (datos[0].value == "" || !(VNombre.test(datos[0].value))) {
    datos[0].style.border="1px solid red";


}else{
    document.getElementById('formulariolista').submit();


}
}


//-----------------Validacion Editar Perfil-------------------

function editarPerfil(){

    document.getElementById("backEd").style.display="block";
    document.getElementById("backEd").style.position="fixed";

}
//Validacion del formulario de editar pefil
function cambio(){


 var formulario=document.getElementById("formularioUser");
 var datos=formulario.getElementsByTagName('input')
 
 ResetStyles(datos);
 //formulario[0]=Avatar
 //formulario[1]=Banner
 //formulario[2]=Biografia
 //Tiene que cambiar o la bio o alguna de las imagens
 if(datos[2].value.length>300){
    datos[2].style.border="1px solid red";
 }else{
     
        document.getElementById("formularioUser").submit();
        parent.window.location.reload();
        document.getElementById("patata").style
     }
    
   
 
 
}
//-----------------Validacion Insertar Reseña-------------------

function validarResenna(){

    var formulario =document.getElementById('formularioResenna');
    var datos = formulario.getElementsByTagName('input');
    var VNombre=/^(?=.{1,50}$)[a-zA-Z0-9._]/;
    ResetStyles(datos);
    //datos[0]=Nombre de la reseña
    //datos[1]=Reseña
    //datos[2]=Numero de valoracion de la reseña
    
    if (datos[0].value == "" || !(VNombre.test(datos[0].value)||datos[0].value.length>40)) {
        datos[0].style.border="1px solid red";
    
    
    }else{
        document.getElementById('formularioResenna').submit();
    }

}


//----------------Pop Up Crear Lista----------------



function CerrarCrearLista(tipo){

    document.getElementById("CrearLista").style.display="none";

}



//--------------Pop up eliminar Lista

function AbrirEliminarLista(){
    document.getElementById("backEliminarLista").style.display="block";
}

function CerrarEliminarLista(){
    document.getElementById("backEliminarLista").style.display="none";
}

//--------------Pop up eliminar Resenna

function AbrirEliminarResenna(){
    document.getElementById("backEliminarResenna").style.display="block";
}

function CerrarEliminarResenna(){
    document.getElementById("backEliminarResenna").style.display="none";
}

//----------------Pop Up Crear Resenna----------------

function CerrarCrearResenna() {
    document.getElementById("CrearResenna").style.display="none";
}

//-----------------BUSQUEDA-----------------------

function submitBusqueda() {

    if(document.getElementById("buscar").value != 0){

        busquedaUsers();

    }else{
        document.getElementById("resultadoBusqueda").innerHTML = "<h1 class='mensajeInfo'>Introduce el nombre del Usuario a buscar</h1>";
    }

}

//-----------------ADMIN -> BUSQUEDA-----------------------

function submitBusquedaAdmin() {

    busquedaUsersAdmin();

}
