<?php

class Bd
{

    private $server = "localhost";  //proyectointegrador.vl21361.dinaserver.com         //localhost

    private $usuario = "root";      //usspintbd5                                        //root

    private $pass = ""; //Pi_ddbb5

    private $basedatos = "ownlist"; //epsilon                                           //ownlist
    /**
     * @var 
     */
    private $conexion;

    private $resultado;

    /**
     * Bd constructor.
     */
    public function __construct()
    {
        $this->conexion = new mysqli($this->server, $this->usuario, $this->pass, $this->basedatos);
        $this->conexion->select_db($this->basedatos);
        $this->conexion->query("SET NAMES 'utf8'");
    }

    /**
     * La funcion addBD añade elementos a la base de datos mediante
     * una insert de sql
     * @param $tabla Es la tabla a la que referenciamos en la base de datos
     * @param $datos Es el array asociativo que contiene la informacion que va a ser insertada en la base de datos
     */
    public function addBd($tabla, $datos)
    {
        $claves  = array();
        $valores = array();

        //Recojemos todas las claves y valores insertandolas en los arraylist de claves y valores
        foreach ($datos as $clave => $valor) {

            $claves[] .= $clave;

            if ($clave == "password")
                $valores[] .= "'" . md5($valor) . "'";
            else
                $valores[] .= "'" . $valor . "'";
        }

        //$valores[1] = "'".md5($valores[1])."'";

        //Sentencia Sql de la insercion de datos.
        $sql = "INSERT INTO " . $tabla . " (" . implode(',', $claves) . ") VALUES  (" . implode(',', $valores) . ")";


        $this->resultado =   $this->conexion->query($sql);
        $res = $this->resultado;
        //echo ($sql);
        return $res;
    }

    /**
     * La funcion addBD añade elementos a la base de datos mediante
     * una insert de sql, esta adaptada para poder insertar imagenes de las reviews y listas 
     * @param $tabla Es la tabla a la que referenciamos en la base de datos
     * @param $datos Es el array asociativo que contiene la informacion que va a ser insertada en la base de datos
     *@param $foto Es la imagen que va a ser añadida
     *@param $carpeta Es la ruta donde va a estar ubicada
     */
    public function addReviewLista($tabla, $datos, $foto, $carpeta)
    {
        $claves = array();
        $valores = array();

        //Recojemos todas las claves y valores insertandolas en los arraylist de claves y valores
        foreach ($datos as $clave => $valor) {

            $claves[] = $clave;
            $valores[] = "'" . $valor . "'";
        }

        if (strlen($foto['name']) > 0) {
            $ruta = subirFoto($foto, $carpeta);
            if ($tabla == "listas")
                $claves[] = "banner";
            else
                $claves[] = "imagen";
            $valores[] = "'" . $ruta . "'";
        }

        //Sentencia Sql de la insercion de datos.
        $sql = "INSERT INTO " . $tabla . " (" . implode(',', $claves) . ") VALUES  (" . implode(',', $valores) . ")";
        $this->resultado = $this->conexion->query($sql);
        $res = $this->resultado;
        //echo ($sql);
        return $res;
    }

    /**
     * 
     * Esta funcion comprueba la disponibilidad de el nombre y del email introducido en el formulario de registro
     * @param $campo Es el campo de la base de datos de donde sacaremos la disponibilidad
     *  
     */
    public function disponibilidad($campo, $dato)
    {
        $ok = false;

        $sql = "SELECT id FROM usuarios where " . $campo . " = '" . $dato . "'";
        $this->resultado = $this->conexion->query($sql);
        $res = $this->resultado;
        if ($res != "") {
            if ($res->num_rows == 0)
                $ok = true;
        }

        return $ok;
    }


    public function numeroElementos()
    {
        $num = $this->resultado->num_rows;
        return $num;
    }

    /**
     * 
     *    Esta funcion comprueba si existe algun usuario en la base de datos
     *    el email y el nombre coincide con los que el usuario ha introducido en el formulario de registro
     *    @param $nombre Es el nombre del usuario
     *    @param $email Es el email del email
     */
    public function todoOk($nombre, $email)
    {

        $ok = true;

        if (!($this->disponibilidad("nombre", $nombre))) {
            $ok = false;
            echo ("Ese nombre de usuario ya existe");
        }

        if (!($this->disponibilidad("email", $email))) {
            $ok = false;
            echo ("Ya existe un usuario con ese email");
        }

        return $ok;
    }
    /**
     * 
     * Realiza una consuta a la base de datos y devuelve el resultado
     * @param $consulta Es la sentencia sql
     */
    public function consulta($consulta)
    {

        // echo $consulta;

        $this->resultado =   $this->conexion->query($consulta);
        $res = $this->resultado;

        return $res;
    }
    /**
     * 
     * Realiza una consuta a la base de datos y devuelve el resultado en forma de array asociativo
     * @param $consulta Es la sentencia sql
     */
    public function consultaOneRow($consulta)
    {

        //echo $consulta;

        $this->resultado =   $this->conexion->query($consulta);
        $res = mysqli_fetch_assoc($this->resultado);

        return $res;
    }
    /**
     * 
     * Actualiza un elemento concreto de la base de datos mediante una update 
     * @param $tabla Es la tabla de la base de datos a la que se hace referencia en el update
     * @param $datos Es un array asociativo que contiene los datos del elemento que se va a actualizar
     * @param $nombre Es el nombre del usuario
     * @param $imagen Es la imagen que se va a actualizar en caso de que exista
     * @param $carpeta Es la ruta donde se va a guardar la imagen
     * 
     * 
     */
    public function updateBd($tabla, $datos, $datoCond, $imagen, $banner, $carpeta)
    {
        $sentencias = array();
        $condicional = "";
        if ($tabla == "usuarios")
            $condicional = "nombre";
        else
            $condicional = "id";

        if ($imagen != ""){
            
            if (is_dir($carpeta) === false) {
                mkdir($carpeta);
            }
        
            if ($imagen['name'] != "") {

                $ruta = subirFoto($imagen, $carpeta);
                if ($tabla == "usuarios")
                    $sentencias[] = "avatar='" . $ruta . "'";
                else
                    $sentencias[] = "imagen='" . $ruta . "'";
            }
            
        }
        
        if ($banner['name'] != "") {
            $ruta = subirFoto($banner, $carpeta);
            $sentencias[] = "banner='" . $ruta . "'";
        }

        //Recojemos todas las claves y valores insertandolas en los arraylist de claves y valores
        foreach ($datos as $campo => $valor) {
            $sentencias[] = $campo . "='" . addslashes($valor) . "'";
            //UPDATE tabla SET nombreCampo = 'valor1', nombreCampo='valor'....
        }

        $campos = implode(",", $sentencias);

        //Sentencia Sql de la insercion de datos.
        $sql = " UPDATE " . $tabla . " SET " . $campos . " WHERE " . $condicional . "= '" . $datoCond . "'";
        $this->resultado = $this->conexion->query($sql);
        $res = $this->resultado;

        return $res;
    }
    /**
     * 
     * 
     * Borra el archivo local de una imagen de la base de datos, 
     * se usa principalmente para limpiar las carpetas de imagenes en desuso
     * @param $id Es el id de la foto
     * @param $tabla Es el nombre de la tabla a la que se hace referencia en la sentencia sql
     * @param $imagen Es la imagen que va a ser eliminada
     * 
     * 
     */
    public function borrarFoto($id, $tabla, $nombre, $imagen)
    {

        $sql = "select " . $imagen . " from " . $tabla . " WHERE id = " . $id;
        //echo($sql);
        $this->resultado = $this->conexion->query($sql);

        if ($this->numeroElementos() > 0) {
            $res = mysqli_fetch_assoc($this->resultado);
            if ($tabla == "review")
                $rutaAborrar = "../../Usuarios/" . $nombre . "/" . $res[$imagen];
            else
                $rutaAborrar = "Usuarios/" . $nombre . "/" . $res[$imagen];
            if ($res[$imagen] != "")
                if (file_exists($rutaAborrar)) {
                    if (!unlink($rutaAborrar)) {
                        echo ("Error de escritura en el servidor, contacte con su administrador por mail.");
                    }
                }
        }
    }
    /**
     * 
     * Inserta los valores correspondientes a los dos usuarios en la tabla de social
     * para que proceda el seguimiento de usuarios mediante una insert de sql
     * @param $id Es el id del primer usuario
     * @param $id2 Es el id del segundo usuario
     */
    public function seguirUsuario($id, $id2)
    {
        $sql = "INSERT INTO social(id_usu1, id_usu2) VALUES (" . $id . ", " . $id2 . ")";


        $this->resultado =   $this->conexion->query($sql);
    }
/**
 * 
 * Borra los valores correspondientes a la relaccion de seguimiento de un usuario hacia otro de manera
 * unidireccional.
 * @param $id Es el id del primer usuario
 * @param $id2 Es el id del segundo usuario
 */
    public function desSeguirUsuario($id, $id2)
    {
        $sql = "DELETE FROM social WHERE id_usu1=" . $id . " AND id_usu2=" . $id2;


        $this->resultado =   $this->conexion->query($sql);
    }
/**
 * 
 * Comprueba si un usuario sigue a otro, esto devuelve un resultado que variara el boton de "siguiendo" o "seguir"
 * @param $id Es el id del primer usuario
 * @param $id2 Es el id del segundo usuario
 */
    public function comprobarSeguir($id, $id2)
    {
        $res = false;
        $sql = "SELECT * FROM social WHERE id_usu1=" . $id . " AND id_usu2=" . $id2;

        $this->resultado =   $this->conexion->query($sql);
        if ($this->resultado != "") {
            if ($this->resultado->num_rows > 0)
                $res = true;
        }
        return $res;
    }

/**
 * 
 * Añade un like a una publicacion, este metodo junto con el de Unaddlike estan diseñados para que solo se pueda dar un like
 * a una publicacion por usuario, es decir un usuario no puede darle muchas likes a una misma publicacion
 * 
 */
    public function addLike($idRev)
    {
        $idUsu = $_SESSION['id'];
        $sql = "INSERT INTO likes(id_usu, id_review) VALUES (" . $idUsu . ", " . $idRev . ")";
        $this->conexion->query($sql);
        $sql= "UPDATE review SET likes = (SELECT COUNT(*) FROM likes WHERE id_review=review.id) where id=".$idRev;
        $this->conexion->query($sql);
    }

    /**
     * 
     * Elimina un like de una publicacion mediante un delete de sql.
     * @param $idRev Es el id de la review.$_COOKIE
     */
    public function UnaddLike($idRev){
        $idUsu = $_SESSION['id'];
        $sql = "DELETE FROM likes WHERE id_usu=".$idUsu." AND id_review=".$idRev;
        $this->conexion->query($sql);
        $sql= "UPDATE review SET likes = (SELECT COUNT(*) FROM likes WHERE id_review=review.id) where id=".$idRev;
        $this->conexion->query($sql);
    }
/**
 * 
 * Obtiene las variables necesarias de la base de datos para formar el recuadro social de ownlist
 * idRev: ID DE LA REVIEW
        *    nomRev: NOMBRE DE LA REVIEW
         *   imgRev: IMAGEN DE LA REVIEW
        *    idLis: ID DE LA LISTA
        *    nomLis: NOMBRE DE LA LISTA
        *    imgCat: IMAGEN DE LA CATEGORIA
        *    idUsu2: ID DEL USUARIO POSEEDOR DE LA LISTA
        *    nomUsu2: NOMBRE DEL USUARIO POSEEDOR DE LA LISTA
        *    imgUsu2: IMAGEN DEL USUARIO POSEEDOR DE LA LISTA
*@param $idUsu Id del usuario
 */
    public function obtenerSocial($idUsu)
    {
        $sql = "select review.id, review.nombre, review.imagen, listas.id, listas.nombre, categorias.icono, usuarios.id, usuarios.nombre, usuarios.avatar from review inner join listas inner join usuarios inner join social inner join categorias on listas.id=review.id_lista and listas.categoria=categorias.id and listas.id_usu=social.id_usu2 and social.id_usu2=usuarios.id where social.id_usu1 = " . $idUsu . " and listas.privacidad=0 order by review.fecha desc LIMIT 3";
        $html = "";
        /*
            idRev: ID DE LA REVIEW
            nomRev: NOMBRE DE LA REVIEW
            imgRev: IMAGEN DE LA REVIEW
            idLis: ID DE LA LISTA
            nomLis: NOMBRE DE LA LISTA
            imgCat: IMAGEN DE LA CATEGORIA
            idUsu2: ID DEL USUARIO POSEEDOR DE LA LISTA
            nomUsu2: NOMBRE DEL USUARIO POSEEDOR DE LA LISTA
            imgUsu2: IMAGEN DEL USUARIO POSEEDOR DE LA LISTA
    */
        $res = $this->consulta($sql);

        while (list($idRev, $nomRev, $imgRev, $idLis, $nomLis, $imgCat, $idUsu2, $nomUsu2, $imgUsu2) = mysqli_fetch_array($res)) {

            if (strlen($imgUsu2) == 0) {

                $imagen = "style='background-image:url(\"imgFront/backOWN.png\")';";

            } else {
    
                $imagen = "style='background-image:url(\"Usuarios/" . $nomUsu2 . "/" . $imgUsu2 . "\")')";
            }

            if (strlen($imgCat) == 0) {

                $imagenCat = "style='background-image:url(\"imgFront/backOWN.png\")';";

            } else {
    
                $imagenCat = "style='background-image:url(\"imgFront/" . $imgCat . "\")')";
            }

            if (strlen($imgRev) == 0) {

                $imagenRev = "style='background-image:url(\"imgFront/backOWN.png\")';";

            } else {
    
                $imagenRev = "style='background-image:url(\"Usuarios/" . $nomUsu2 . "/" . $imgRev . "\")')";
            }

            $html .= "<div class='socialUser' onclick=\"(location.href='perfilUsuarios.php?id=".$idUsu2."')\">

                        <div class='socialPerfilUser'>
                        
                            <div class='socialAvatar' ".$imagen."></div>

                            <div class='socialUserName'>".$nomUsu2."</div>
                        
                        </div>

                        <div class='socialListUser'>
                        
                            <div class='socialImgCat' ".$imagenCat."></div>
                        
                            <div class='socialNomList'>".$nomLis."</div>

                        
                        </div>
            
                        <div class='socialResUser'>

                            <div class='resSocial'>
                            
                                <div class='socialImgRev' ".$imagenRev."></div>

                                <div class='socialNomRev'>".$nomRev."</div>

                            </div>
                            
                        </div>
        
                </div>";
        }

        return $html;
    }
}
