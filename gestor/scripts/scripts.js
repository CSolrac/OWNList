//Mostrar las listas con la funcion ajax---------------------------------

function ajax() {
    try {
        req = new XMLHttpRequest();
    } catch(err1) {
        try {
            req = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (err2) {
            try {
                req = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (err3) {
                req = false;
            }
        }
    }
    return req;
}

//Listar Listas con ajax
var mostrar = new ajax();
function buscarlista(tipo,busqueda="") {

    if(tipo!=99){
        var myurl = 'gestor/llamadas/publicarListas.php';
        myRand = parseInt(Math.random() * 999999999999999);
        modurl = myurl + '?rand=' + myRand + '&tipo=' + tipo +'&search='+busqueda;
        mostrar.open("GET", modurl, true);
        mostrar.onreadystatechange = buscarlistaResponse;
        mostrar.send(null);
    }

}

function buscarlistaResponse() {

    if (mostrar.readyState == 4) {
        if(mostrar.status == 200) {

            var lista = mostrar.responseText;

            document.getElementById('listasActual').innerHTML =  lista;
        }
    }
}

//Borrar las listas sin ajax ajax---------------------------------

function borrarLista() {

      document.getElementById('BorrarLista').submit(); 

}

//pop up crear listas ajax---------------------------------

var popCrear = new ajax();
function AbrirCrearLista(tipo, id="") {

    document.getElementById("CrearLista").style.display="block";

    var myurl = 'gestor/llamadas/nuevaLista.php';
        myRand = parseInt(Math.random() * 999999999999999);
        modurl = myurl + '?rand=' + myRand + '&tipo=' + tipo+'&id='+id;
        popCrear.open("GET", modurl, true);
        popCrear.onreadystatechange = AbrirCrearListaReponse;
        popCrear.send(null);

}

function AbrirCrearListaReponse() {

    if (popCrear.readyState == 4) {
        if(popCrear.status == 200) {

            var lista = popCrear.responseText;

            document.getElementById('CrearLista').innerHTML =  lista;
        }
    }
}
//--------------POP UP CREAR RESEÑAS AJAX---------------------------------
var popCrearResenna = new ajax();
function AbrirCrearRessena() {

    document.getElementById("CrearResenna").style.display="block";

    var myurl = 'gestor/llamadas/nuevaResenna.php';
        myRand = parseInt(Math.random() * 999999999999999);
        modurl = myurl + '?rand=' + myRand;
        popCrearResenna.open("GET", modurl, true);
        popCrearResenna.onreadystatechange = AbrirCrearResennaReponse;
        popCrearResenna.send(null);
       
}

function AbrirCrearResennaReponse() {

    if (popCrearResenna.readyState == 4) {
        if(popCrearResenna.status == 200) {

            var lista = popCrearResenna.responseText;

            document.getElementById('CrearResenna').innerHTML =  lista;
            
        }
    }
}

//--------------POP UP MOSTRAR RESEÑAS AJAX---------------------------------
var MostrarResennasAjax = new ajax();
function MostrarResennas(id) {
    var myurl = 'gestor/llamadas/publicarResennas.php';
        myRand = parseInt(Math.random() * 999999999999999);
        modurl = myurl + '?rand=' + myRand+'&id='+id;
        MostrarResennasAjax.open("GET", modurl, true);
        MostrarResennasAjax.onreadystatechange = MostrarResennasResponse;
        MostrarResennasAjax.send(null);
}

function MostrarResennasResponse() {
    if (MostrarResennasAjax.readyState == 4) {
        if(MostrarResennasAjax.status == 200) {

            var lista = MostrarResennasAjax.responseText;

            document.getElementById('reseñaslmao').innerHTML =  lista;
            
        }
    }
}

//-----------------------------BORRAR RESEÑAS CON AJAX----------------------
var borrarRe= new ajax();
function BorrarReview(id,id_lista) {

    var myurl = 'gestor/llamadas/borrarResenna.php';
        myRand = parseInt(Math.random() * 999999999999999);
        modurl = myurl + '?rand=' + myRand +'&id='+id+'&id_lista='+id_lista;
        borrarRe.open("GET", modurl, true);
        borrarRe.onreadystatechange = BorrarReviewReponse;
        borrarRe.send(null);

}

function BorrarReviewReponse() {

    if (borrarRe.readyState == 4) {
        if(borrarRe.status == 200) {

            var reviews = borrarRe.responseText;

            document.getElementById('reseñaslmao').innerHTML =  reviews;
        }
    }
}

//-----------------------------EXPANDIR RESEÑAS CON AJAX----------------------
var ampRe= new ajax();

function AmpliarReview(id, nombre, edit=true) {
    idResennaAmpliar = id;
    var myurl = 'gestor/llamadas/ampliarResenna.php';
        myRand = parseInt(Math.random() * 999999999999999);
        modurl = myurl + '?rand=' + myRand +'&id='+id+'&edit='+edit+'&nombre='+nombre;
        ampRe.open("GET", modurl, true);
        ampRe.onreadystatechange = AmpliarReviewReponse;
        ampRe.send(null);
}

function AmpliarReviewReponse() {

    if (ampRe.readyState == 4) {
        if(ampRe.status == 200) {

            var reviews = ampRe.responseText;

            document.getElementById("resenna"+idResennaAmpliar).innerHTML =  reviews;
        }
    }
}

//-----------------------------MINIMIZAR RESEÑAS CON AJAX----------------------
var minRe= new ajax();

function MinimizarReview(id, nombre, edit) {

    idResennaAmpliar = id;
    var myurl = 'gestor/llamadas/minimizarResenna.php';
        myRand = parseInt(Math.random() * 999999999999999);
        modurl = myurl + '?rand=' + myRand +'&id='+id+'&edit='+edit+'&nombre='+nombre;
        minRe.open("GET", modurl, true);
        minRe.onreadystatechange = MinimizarReviewReponse;
        minRe.send(null);
}

function MinimizarReviewReponse() {

    if (minRe.readyState == 4) {
        if(minRe.status == 200) {

            var reviews = minRe.responseText;

            document.getElementById("resenna"+idResennaAmpliar).innerHTML =  reviews;
        }
    }
}

//----------------------BUSQUEDA CON AJAX--------------------

var busUsu= new ajax();

function busquedaUsers() {

    var busqueda = document.getElementById("buscar").value;

    var myurl = 'gestor/llamadas/busquedaDeUsuarios.php';
        myRand = parseInt(Math.random() * 999999999999999);
        modurl = myurl + '?rand=' + myRand +'&busqueda='+busqueda;
        busUsu.open("GET", modurl, true);
        busUsu.onreadystatechange = busquedaUsersReponse;
        busUsu.send(null);
}

function busquedaUsersReponse() {

    if (busUsu.readyState == 4) {
        if(busUsu.status == 200) {

            var busqueda = busUsu.responseText;

            document.getElementById("resultadoBusqueda").innerHTML =  busqueda;
        }
    }
}

//----------------------ADMIN -> BUSQUEDA CON AJAX--------------------

var busUsuAd= new ajax();

function busquedaUsersAdmin() {

    var busqueda = document.getElementById("buscarAd").value;

    var myurl = 'gestor/llamadas/busquedaDeUsuariosAdmin.php';
        myRand = parseInt(Math.random() * 999999999999999);
        modurl = myurl + '?rand=' + myRand +'&busqueda='+busqueda;
        busUsuAd.open("GET", modurl, true);
        busUsuAd.onreadystatechange = busquedaUsersAdminReponse;
        busUsuAd.send(null);
}

function busquedaUsersAdminReponse() {

    if (busUsuAd.readyState == 4) {
        if(busUsuAd.status == 200) {

            var busqueda = busUsuAd.responseText;

            document.getElementById("resultadoBusquedaAdmin").innerHTML =  busqueda;
        }
    }
}

//------------------MOSTRAR CRONOLOGIA CON AJAX--------------------

var crono= new ajax();

function mostrarCrono(id) {

    var myurl = 'gestor/llamadas/cronologia.php';
        myRand = parseInt(Math.random() * 999999999999999);
        modurl = myurl + '?rand=' + myRand +'&id='+id;
        crono.open("GET", modurl, true);
        crono.onreadystatechange = mostrarCronoResponse;
        crono.send(null);
}

function mostrarCronoResponse() {

    if (crono.readyState == 4) {
        if(crono.status == 200) {

            var cronologia = crono.responseText;

            document.getElementById("cronologia").innerHTML =  cronologia;
        }
    }
    
}

//------------------MOSTRAR PERFIL USER CON AJAX--------------------

var PerfilUser= new ajax();

function mostrarPerfilUser(id) {

    var myurl = 'gestor/llamadas/perfilUsuario.php';
        myRand = parseInt(Math.random() * 999999999999999);
        modurl = myurl + '?rand=' + myRand +'&id='+id;
        PerfilUser.open("GET", modurl, true);
        PerfilUser.onreadystatechange = mostrarPerfilUserResponse;
        PerfilUser.send(null);
}

function mostrarPerfilUserResponse() {

    if (PerfilUser.readyState == 4) {
        if(PerfilUser.status == 200) {

            var perfilUsuario = PerfilUser.responseText;

            document.getElementById("perfilUsuario").innerHTML =  perfilUsuario;
        }
    }
    
}
//------------------LISTAS AJENAS  CON AJAX--------------------
var ListasUser= new ajax();

function mostrarListasAjenas(id) {

    var myurl = 'gestor/llamadas/mostrarListasAjenas.php';
        myRand = parseInt(Math.random() * 999999999999999);
        modurl = myurl + '?rand=' + myRand +'&id='+id;
        ListasUser.open("GET", modurl, true);
        ListasUser.onreadystatechange = mostrarListasAjenasResponse;
        ListasUser.send(null);
}

function mostrarListasAjenasResponse() {

    if (ListasUser.readyState == 4) {
        if(ListasUser.status == 200) {

            var listasAgenas = ListasUser.responseText;

            document.getElementById("listasPerfilUsuario").innerHTML =  listasAgenas;
        }
    }
    
}
//------------------LISTAS AJENAS CON REVIEWS CON AJAX--------------------
var ListasRUser= new ajax();

function mostrarListasReviewAjenas(id,idUsu) {
    

    var myurl = 'gestor/llamadas/mostrarListasReviewsAjenas.php';
        myRand = parseInt(Math.random() * 999999999999999);
        modurl = myurl + '?rand=' + myRand +'&id='+id+'&idUsu='+idUsu;
        ListasRUser.open("GET", modurl, true);
        ListasRUser.onreadystatechange = mostrarListasReviewAjenasResponse;
        ListasRUser.send(null);
}

function mostrarListasReviewAjenasResponse() {

    if (ListasRUser.readyState == 4) {
        if(ListasRUser.status == 200) {

            var listasReviewAjenas = ListasRUser.responseText;

            document.getElementById("listasPerfilUsuario").innerHTML =  listasReviewAjenas;
        }
    }
    
}

//-----------------------FOLLOW/UNFOLLOW---------------------------

var followUser= new ajax();

function seguirUser(id, follow) {

    var myurl = 'gestor/llamadas/botonSeguir.php';
        myRand = parseInt(Math.random() * 999999999999999);
        modurl = myurl + '?rand=' + myRand +'&id='+id+'&follow='+follow;
        followUser.open("GET", modurl, true);
        followUser.onreadystatechange = seguirUserResponse;
        followUser.send(null);
}

function seguirUserResponse() {

    if (followUser.readyState == 4) {
        if(followUser.status == 200) {

            var follow = followUser.responseText;
            document.getElementById("followUserID").innerHTML =  follow;
        }
    }
    
}

//---------------------LOCK/UNLOCK LISTA------------------------------

var lockLista= new ajax();

function lockingLista(id) {

    idCandado = id;

    var myurl = 'gestor/llamadas/botonLockLista.php';
    myRand = parseInt(Math.random() * 999999999999999);
    modurl = myurl + '?rand=' + myRand +'&id='+id;
    lockLista.open("GET", modurl, true);
    lockLista.onreadystatechange = lockingListaResponse;
    lockLista.send(null);
}

function lockingListaResponse() {

    if (lockLista.readyState == 4) {
        if(lockLista.status == 200) {

            var lock = lockLista.responseText;
            document.getElementById("lockIcon"+idCandado).innerHTML =  lock;
        }
    }

}

//---------------------------------LIKE/UNLIKE------------------------------------//


var likeAjax= new ajax();

function darLike(id) {

    idLike = id;

    var myurl = 'gestor/llamadas/botonLike.php';
    myRand = parseInt(Math.random() * 999999999999999);
    modurl = myurl + '?rand=' + myRand +'&id='+id;
    likeAjax.open("GET", modurl, true);
    likeAjax.onreadystatechange = darLikeResponse;
    likeAjax.send(null);
}

function darLikeResponse() {

    if (likeAjax.readyState == 4) {
        if(likeAjax.status == 200) {

            var like = likeAjax.responseText;
            document.getElementById("likeIcon"+idLike).innerHTML =  like;
        }
    }

}
//------------------------------LLAMADA SOCIAL------------------------------------//


var socials= new ajax();

function social() {

   

    var myurl = 'gestor/llamadas/mostrarSocial.php';
    myRand = parseInt(Math.random() * 999999999999999);
    modurl = myurl + '?rand=' + myRand ;
    socials.open("GET", modurl, true);
    socials.onreadystatechange =socialResponse;
    socials.send(null);
}

function socialResponse() {

    if (socials.readyState == 4) {
        if(socials.status == 200) {

            var socialismo = socials.responseText;
            document.getElementById("contenidoSocial").innerHTML =  socialismo;
        }
    }

}