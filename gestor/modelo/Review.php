<?php
class Review
{

    private $id;
    private $id_lista;
    private $nombre;
    private $resenna;
    private $imagen;
    private $valoracion;
    private $likes;
    private $fecha;
    private $tabla;
    private $carpeta;
    private $lista = array();
    /**
     * review constructor.
     * @param $id
     * @param $id_lista
     * @param $nombre
     * @param $resenna
     * @param $imagen
     * @param $valoracion
     * @param $fecha
     * @param $likes
     */
    public function __construct($id_lista = "", $nombre = "", $resenna = "", $imagen = "", $valoracion = "", $fecha = "", $likes = "", $id = "")
    {
        $this->id = $id;
        $this->id_lista = $id_lista;
        $this->nombre = $nombre;
        $this->resenna = $resenna;
        $this->imagen = $imagen;
        $this->valoracion = $valoracion;
        $this->fecha = $fecha;
        $this->likes = $likes;
        $this->tabla = "review";
        $this->carpeta = "Usuarios/";
    }

    /**
     * Método para construir un objeto Review con los datos correspondientes con la base de datos
     *
     * @param $id ID de la review en la base de datos
     * @param $id_usu ID del usuario creador de la review
     * @param $nombre Nombre de la review
     * @param $resenna Reseña de la review
     * @param $imagen Imagen de la review
     * @param $valoracion Valoracion de la review
     * @param $fecha Fecha de la review
     * @param $likes Likes de la review
     */
    private function llenarDeBd($id, $id_lista, $nombre, $resenna, $imagen, $valoracion, $fecha, $likes)
    {
        $this->id = $id;
        $this->id_lista = $id_lista;
        $this->nombre = $nombre;
        $this->resenna = $resenna;
        $this->imagen = $imagen;
        $this->valoracion = $valoracion;
        $this->fecha = $fecha;
        $this->likes = $likes;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getIdLista()
    {
        return $this->id_lista;
    }

    /**
     * @param mixed $id_lista
     */
    public function setIdLisat($id_lista)
    {
        $this->id_lista = $id_lista;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getResenna()
    {
        return $this->resenna;
    }

    /**
     * @param mixed $resenna
     */
    public function setResenna($resenna)
    {
        $this->resenna = $resenna;
    }

    /**
     * @return mixed
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * @param mixed $imagen
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

    /**
     * @return mixed
     */
    public function getValoracion()
    {
        return $this->valoracion;
    }

    /**
     * @param mixed $valoracion
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }
    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param mixed $valoracion
     */
    public function setValoracion($valoracion)
    {
        $this->valoracion = $valoracion;
    }

    /**
     * @param mixed $valoracion
     */
    public function setLikes($likes)
    {
        $this->likes = $likes;
    }
    /**
     * @return mixed
     */
    public function getLikes()
    {
        return $this->likes;
    }
    /**
     * 
     * Inserta una nueva review en la base de datos 
     * @param $datos Datos de la revie en forma de array asociativo
     * @param $nombre Es el nombre de usuario
     * @param $imagenReview Es la imagen asociada a la review
     * 
     */
    public function InsertarReview($datos, $nombre, $imagenReview)
    {
        $carpeta = $this->carpeta . "/" . $nombre;
        $conexion = new Bd();
        $conexion->addReviewLista($this->tabla, $datos, $imagenReview, $carpeta);
    }

    /**
     * Método para obtener una review determinado de la base de datos a través de su ID
     * @param $id ID de la lista a consultar
     */
    public function getById($id)
    {
        $sql = "SELECT * from " . $this->tabla . " WHERE id=" . $id;

        $conexion = new Bd();

        $res = $conexion->consulta($sql);

        list($id, $id_lista, $nombre, $resenna, $imagen, $valoracion, $fecha, $likes) = mysqli_fetch_array($res);

        $this->llenarDeBd($id, $id_lista, $nombre, $resenna, $imagen, $valoracion, $fecha, $likes);
    }

    /**
     * 
     * Obtiene las reviews de la base de datos mediante una select 
     * teninedo en cuenta su id de la lista
     * @param $id Es el id del usuario
     * @param $categoria  Es el nombre de la categoria
     * 
     */
    public function obtenerReviews($id_lista, $busqueda = "")
    {
        $sql = "select id, nombre, resenna, imagen, valoracion, likes, fecha from review where id_lista=" . $id_lista . " AND nombre like '%" . $busqueda . "%' ORDER BY id DESC";
        $conexion = new Bd();
        $res = $conexion->consulta($sql);


        while (list($id, $nombre, $resenna, $imagen, $valoracion, $fecha, $likes) = mysqli_fetch_array($res)) {
            $review = new Review($id_lista, $nombre, $resenna, $imagen, $valoracion, $likes, $fecha, $id);
            array_push($this->lista, $review);
        }
    }
    /**
     * 
     * Borra una review de la base de datos mediante una sentencia delete usando el id
     * @param $id Es el id de la review
     * @param $nombre Es el nombre de usuario
     * 
     */
    public function borrarReview($id, $nombre)
    {
        $conexion = new Bd();

        $conexion->borrarFoto($id, $this->tabla, $nombre, "imagen");
        $sql = "Delete from " . $this->tabla . " where id=" . $id;
        $conexion->consulta($sql);
    }
    /**
     * 
     * Genera una cadena de caracteres que devuelve un html con las listas de un usuario
     * @param $nombreUsu Es el nombre de usuario
     * 
     */
    public function mostrarReview($nombreUsu)
    {
        //var_dump($this->lista);
        $html = "";
        for ($i = 0; $i < sizeof($this->lista); $i++) {
            $html .= $this->lista[$i]->imprimeReview($nombreUsu);
        }
        $html .= "";
        return $html;
    }

    /**
     * 
     * Genera el codigo html correspondiente al div que contiene la informacion de la lista que se
     * muestra por pantalla, esta funcion tambien contiene la ruta de una imagen por defecto en caso de que
     * no se haya introducido una imagen
     * @param $nombreUsu Es el nombre de usuario
     */
    public function imprimeReview($nombreUsu)
    {

        if (strlen($this->imagen) == 0) {

            $fondo = "style='background-image:url(\"imgFront/backOWN.png\")';";
        } else {

            $fondo = "style='background-image:url(\"" . $this->carpeta . $nombreUsu . "/" . $this->imagen . "\")')";
        }


        $html = "<div id='resenna" . $this->id . "' class='ListaResenna animateAppear'>

        <div class='listaResennaInt'>
        <div " . $fondo . " class='imageResenna'></div>
         
        <!--<button onclick='borrarLista(" . $this->id . ",1)'>Borrar</button>-->
        <div class='textResenna'>
        <label class='nombreResenna'>" . $this->nombre . "</label>
        
        <!--<label class='nombreCategoria'>" . $this->resenna . "</label>-->
        </div>";
        $like = $this->liked($this->id);

        if ($like == 1) {
            $corazon = "<div class='columnLike' id='likeIcon" . $this->id . "'><img class='imgResLike' onclick='darLike(" . $this->id . ")' src='imgFront/likeOn.png'><div class='numLikes'>" . $this->likes . "</div></div>";
        } else {
            $corazon = "<div class='columnLike' id='likeIcon" . $this->id . "'><img class='imgResUnLike' onclick='darLike(" . $this->id . ")' src='imgFront/likeOn.png'><div class='numUnLikes'>" . $this->likes . "</div></div>";
        }
       
        $html .= $corazon;
        $html .= "<div class='imgRes'><img onclick='AmpliarReview(" . $this->id . ",\"" . $nombreUsu . "\",true)' src='imgFront/arrowDownC.png'></div>
        </div>
        </div>";

        return $html;
    }
/**
 * 
 *  Obtiene los likes que tiene una review mediante una select a la base de datos
 * @param $idRev Es el id de la review.
 */
    public function obtenerLikes($idRev)
    {
        $sql = "SELECT likes from " . $this->tabla . " WHERE id=" . $idRev;
        $conexion = new Bd();

        $this->likes = $conexion->consultaOneRow($sql)['likes'];
    }

    /**
    * 
    * Obtiene una comprobacion de la base de datos que devuelve un booleano que indica si la review tiene el like de el usuario marcado o no
    * @param $idRev Es el id de la review.
    */
    public function liked($idRev)
    {
        $conexion = new Bd();
        $idUsu = $_SESSION['id'];
        $res = false;
        $sql = "SELECT * FROM likes WHERE id_usu=" . $idUsu . " AND id_review=" . $idRev;

        $resultado = $conexion->consulta($sql);
        if ($resultado != "") {
            if ($resultado->num_rows > 0)
                $res = true;
        }
        return $res;
    }
    /**
     * 
     * La funcion obtiene las reviews de las listas por usuario haciendo referencia tambien a la lista a la que pertenencen.
     * @param $idUsu Corresponde al id del usuario.
     * 
     */
    public function obtenerCronologia($idUsu)
    {
        $sql = "select review.id, review.id_lista, review.nombre, review.resenna, review.imagen, review.valoracion, review.fecha, review.likes from review inner join listas on review.id_lista=listas.id where listas.id_usu =" . $idUsu . " order by review.fecha desc limit 3";
        $conexion = new Bd();
        $res = $conexion->consulta($sql);
        while (list($id, $id_lista, $nombre, $resenna, $imagen, $valoracion, $fecha, $likes) = mysqli_fetch_array($res)) {
            $review = new Review($id_lista, $nombre, $resenna, $imagen, $valoracion, $fecha, $likes, $id);
            array_push($this->lista, $review);
        }
    }
    /**
     * 
     * Genera el codigo html correspondiente al div que contiene la informacion de la lista que se
     * muestra por pantalla, esta funcion tambien contiene la ruta de una imagen por defecto en caso de que
     * no se haya introducido una imagen
     * @param $nombreUsu Es el nombre de usuario
     */
    public function imprimeReviewCronologia($nombreUsu)
    {

        if (strlen($this->imagen) == 0) {

            $fondo = "style='background-image:url(\"imgFront/backOWN.png\")';";
        } else {

            $fondo = "style='background-image:url(\"" . $this->carpeta . $nombreUsu . "/" . $this->imagen . "\")')";
        }


        $html = "<div id='resenna" . $this->id . "' class='ListaResenna animateAppear'>

        <div class='listaResennaInt'>
        <div " . $fondo . " class='imageResenna'></div>
         
        <!--<button onclick='borrarLista(" . $this->id . ",1)'>Borrar</button>-->
        <div class='textResenna'>
        <label class='nombreResenna'>" . $this->nombre . "</label>
        
        <!--<label class='nombreCategoria'>" . $this->resenna . "</label>-->
        
        </div>";
        $like = $this->liked($this->id);

        if ($like == 1) {
            $corazon = "<div class='columnLike' id='likeIcon" . $this->id . "'><img class='imgResLike' onclick='darLike(" . $this->id . ")' src='imgFront/likeOn.png'><div class='numLikes'>" . $this->likes . "</div></div>";
        } else {
            $corazon = "<div class='columnLike' id='likeIcon" . $this->id . "'><img class='imgResUnLike' onclick='darLike(" . $this->id . ")' src='imgFront/likeOn.png'><div class='numUnLikes'>" . $this->likes . "</div></div>";
        }
        $html .= $corazon;

        $html .= "<div class='imgRes'><img onclick='AmpliarReview(" . $this->id . ",\"" . $nombreUsu . "\",false)' src='imgFront/arrowDownC.png'></div>
        </div>
        </div>";

        return $html;
    }
    /**
     * 
     * Llama a las funciones de imprimirListaCronologia e imprimeReviewCronologia  las veces equivalentes a el tamaño del array de las  listas que contienen la cronologia
     * @param $nombreUsu Es el nombre del ususario, se usa principalmente 
     */
    public function mostrarCronologia($nombreUsu)
    {
        $lista = new Lista();
        $html = "";
        for ($i = 0; $i < sizeof($this->lista); $i++) {
            $lista->obtenerListaID($this->lista[$i]->id_lista);
            $html .= $lista->imprimeListaCronologia($nombreUsu);
            $html .= "<div id='containerEntradas'>";
            $html .= $this->lista[$i]->imprimeReviewCronologia($nombreUsu);
            $html .= "</div>";
        }
        $html .= "";
        return $html;
    }

    /**
     * 
     * Borra las fotos de todas las reviews de una lista, este metodo se usa principalmente cuando se borra una lista y es necesaria la eliminacion de 
     * todas sus reviews 
     *  @param $idList Es el id de la lista seleccionada
     * @param $nombre Es el nombre de usuario
     */
    public function borrarFotos($idLis, $nombre)
    {
        $conexion = new Bd();
        $this->obtenerReviews($idLis);
        foreach ($this->lista as $valor) {
            $conexion->borrarFoto($valor->id, $this->tabla, $nombre, "imagen");
        }
    }
    /**
     * 
     * Genera el codigo html correspondiente al div que contiene la informacion de la lista que se
     * muestra por pantalla, esta funcion tambien contiene la ruta de una imagen por defecto en caso de que
     * no se haya introducido una imagen
     * @param $nombreUsu Es el nombre de usuario
     */
    public function imprimeReviewAjena($nombreUsu)
    {

        if (strlen($this->imagen) == 0) {

            $fondo = "style='background-image:url(\"imgFront/backOWN.png\")';";
        } else {

            $fondo = "style='background-image:url(\"" . $this->carpeta . $nombreUsu . "/" . $this->imagen . "\")')";
        }


        $html = "<div id='resenna" . $this->id . "' class='ListaResenna animateAppear'>

        <div class='listaResennaInt'>
        <div " . $fondo . " class='imageResenna'></div>
         
        <!--<button onclick='borrarLista(" . $this->id . ",1)'>Borrar</button>-->
        <div class='textResenna'>
        <label class='nombreResenna'>" . $this->nombre . "</label>
        
        <!--<label class='nombreCategoria'>" . $this->resenna . "</label>-->
        
        </div>";

        $like = $this->liked($this->id);

        if ($like == 1) {
            $corazon = "<div class='columnLike' id='likeIcon" . $this->id . "'><img class='imgResLike' onclick='darLike(" . $this->id . ")' src='imgFront/likeOn.png'><div class='numLikes'>" . $this->likes . "</div></div>";
        } else {
            $corazon = "<div class='columnLike' id='likeIcon" . $this->id . "'><img class='imgResUnLike' onclick='darLike(" . $this->id . ")' src='imgFront/likeOn.png'><div class='numUnLikes'>" . $this->likes . "</div></div>";
        }
        $html .= $corazon;

        $html .= "<div class='imgRes'><img onclick='AmpliarReview(" . $this->id . ",\"" . $nombreUsu . "\",false)' src='imgFront/arrowDownC.png'></div>
        </div>
        </div>";

        return $html;
    }
    /**
     * 
     * Genera una cadena de caracteres que devuelve un html con las listas de un usuario
     * @param $nombreUsu Es el nombre de usuario
     * 
     */
    public function mostrarReviewAjena($nombreUsu)
    {
        //var_dump($this->lista);
        $html = "";

        $html .= "<div id='containerEntradas'>";
        $html .= "<div id='reseñaslmao'>";
        for ($i = 0; $i < sizeof($this->lista); $i++) {
            $html .= $this->lista[$i]->imprimeReviewAjena($nombreUsu);
        }
        $html .= "</div></div>";

        $html .= "";
        return $html;
    }
    /**
     * 
     * LLama a la funcion de la base de datos que añade un like a una review
     * @param $id  es el id de la review que va a ser modificada
     */
    public function like($id)
    {
        $conexion = new Bd();
        $conexion->addLike($id);
    }
    /**
     * 
     * LLama a la funcion de la base de datos que le quita el like a una review
     * @param $id es el id de la review que va a ser modificada
     */
    public function unlike($id)
    {
        $conexion = new Bd();
        $conexion->unAddLike($id);
    }
}
