<?php

class Lista
{
    private $id;
    private $id_usu;
    private $categoria;
    private $nombre;
    private $banner;
    private $privacidad;
    private $carpeta;
    private $tabla;
    private $lista = array();

    /**
     * Lista constructor.
     * @param $id
     * @param $id_usu
     * @param $categoria
     * @param $nombre
     * @param $banner
     * @param $privacidad
     * @param $lista
     * 
     */
    public function __construct($id_usu = "", $nombre = "", $categoria = "", $banner = "", $privacidad = "", $id = "")
    {
        $this->id = $id;
        $this->id_usu = $id_usu;
        $this->categoria = $categoria;
        $this->nombre = $nombre;
        $this->banner = $banner;
        $this->privacidad = $privacidad;
        $this->tabla = "listas";
        $this->carpeta = "Usuarios/";
    }

    /**
     * Método para construir un objeto Lista con los datos correspondientes con la base de datos
     *
     * @param $id ID de la lista en la base de datos
     * @param $id_usu ID del usuario creador de la lista
     * @param $categoria Categoria de la lista
     * @param $nombre Nombre de la lista
     */
    private function llenarDeBd($id, $id_usu, $categoria, $nombre, $privacidad)
    {
        $this->id = $id;
        $this->id_usu = $id_usu;
        $this->categoria = $categoria;
        $this->nombre = $nombre;
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
    public function getIdUsu()
    {
        return $this->id_usu;
    }

    /**
     * @param mixed $id_usu
     */
    public function setIdUsu($id_usu)
    {
        $this->id_usu = $id_usu;
    }

    /**
     * @return mixed
     */
    public function getIdTipo()
    {
        return $this->id_tipo;
    }

    /**
     * @param mixed $id_tipo
     */
    public function setIdTipo($id_tipo)
    {
        $this->id_tipo = $id_tipo;
    }

    /**
     * @return mixed
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * @param mixed $categoria
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
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
    public function getBanner()
    {
        return $this->banner;
    }

    /**
     * @param mixed $carpeta
     */
    public function setBanner($banner)
    {
        $this->banner = $banner;
    }
    public function getCarpeta()
    {
        return $this->carpeta;
    }

    /**
     * @param mixed $carpeta
     */
    public function setCarpeta($carpeta)
    {
        $this->carpeta = $carpeta;
    }

    /**
     * 
     * Inserta una nueva lista en la base de datos.
     * @param $datos Es un array con los datos de la lista
     * @param $nombreUsu Es el nombre del usuario
     * @param $foto Es la foto que se asigna a la lista
     * 
     */
    public function insertarLista($datos, $nombreUsu, $foto)
    {
        $ruta = $this->carpeta . "/" . $nombreUsu;
        $conexion = new Bd();
        $conexion->addReviewLista($this->tabla, $datos, $foto, $ruta);
    }

    /**
     * 
     * Actualiza una lista mediante una update a la base de datos
     * @param $datos Es un array con los datos de la lista
     * @param $id Es la id de la lista
     * @param $nombreUsu Es el nombre del usuario
     * @param $banner Es la foto que se asigna al banner de la lista
     */
    public function ActualizarLista($datos, $id, $nombreUsu, $banner)
    {
        $carpeta = $this->carpeta . "/" . $nombreUsu;
        $conexion =  new Bd();
        if ($banner['name'] != "")
            $conexion->borrarFoto($id, $this->tabla, $nombreUsu, "banner");
        $conexion->updateBd($this->tabla, $datos, $id, "", $banner, $carpeta);
    }




    /**
     * 
     * Obtiene las listas de la base de datos mediante una select 
     * teninedo en cuenta su id y su categoria
     * @param $id Es el id del usuario
     * @param $categoria  Es el nombre de la categoria
     * 
     */
    public function obtenerListas($id_usu, $categoria, $busqueda = "")
    {
        $sql = "select listas.id, listas.nombre, categorias.nombre, listas.banner, listas.privacidad FROM listas left join categorias on listas.categoria=categorias.id where listas.id_usu= " . $id_usu . " AND listas.categoria= " . $categoria . " AND listas.nombre like '%" . $busqueda . "%' ORDER BY id DESC";
        $conexion = new Bd();
        $res = $conexion->consulta($sql);


        while (list($id, $nombre, $categoria, $banner, $privacidad) = mysqli_fetch_array($res)) {
            $lista = new Lista($id_usu, $nombre, $categoria, $banner, $privacidad, $id);
            array_push($this->lista, $lista);
        }
    }

    /**
     * 
     * Obtiene UNA lista por ID de la base de datos 
     * @param $id Es el id de la lista
     * 
     */
    public function obtenerListaID($id)
    {
        $sql = "select listas.id, listas.nombre, categorias.nombre as categoria, listas.banner, listas.privacidad FROM listas left join categorias on listas.categoria=categorias.id where listas.id= " . $id;
        $conexion = new Bd();
        $res = $conexion->consultaOneRow($sql);
        if ($conexion->numeroElementos() > 0) {
            $this->id = $res['id'];
            $this->nombre = $res['nombre'];
            $this->categoria = $res['categoria'];
            $this->banner = $res['banner'];
            $this->privacidad = $res['privacidad'];
        }
    }
    /**
     * 
     * Obtiene las listas por id del usuario
     * 
     */
    public function obtenerListaUsu($idUsu)
    {

        $sql = "select listas.id, listas.nombre, categorias.nombre as categoria, listas.banner, listas.privacidad FROM listas left join categorias on listas.categoria=categorias.id where listas.id_usu= " . $idUsu;
        $conexion = new Bd();
        $res = $conexion->consulta($sql);

        while (list($id, $nombre, $categoria, $banner, $privacidad) = mysqli_fetch_array($res)) {
            $lista = new Lista($idUsu, $nombre, $categoria, $banner, $privacidad, $id);
            array_push($this->lista, $lista);
        }
    }

    /**
     * 
     * Borra una lista de la base de datos mediante una sentencia delete usando el id
     * @param $id Es el id de la lista
     * @param $nombre Es el nombre de usuario
     * 
     */
    public function borrarLista($id, $nombre)
    {
        $conexion = new Bd();
        $review = new Review();
        $review->borrarFotos($id, $nombre);
        $conexion->borrarFoto($id, $this->tabla, $nombre, "banner");
        $sql = "Delete from " . $this->tabla . " where id=" . $id;
        $conexion->consulta($sql);
    }

    /**
     * 
     * Comprueba que la lista pertenece al usuario, para que esta condicion se cumpla id e id_usu deben coincidir
     * en caso de que coincidan retornara un valor positivo
     * @param $id Es el id de la lista
     * @param $id_usu Es el id del usuario
     * 
     */
    public function comprobarUsuario($id, $id_usu)
    {
        $ok = false;
        $sql = "select listas.id_usu, listas.nombre, categorias.nombre, listas.banner FROM listas left join categorias on listas.categoria=categorias.id where listas.id= " . $id;

        $conexion = new Bd();
        $res = $conexion->consulta($sql);

        list($id, $nombre, $categoria, $banner) = mysqli_fetch_array($res);
        if ($conexion->numeroElementos() > 0 && $id_usu == $id) {
            $ok = true;
            $this->id_usu = $id_usu;
            $this->nombre = $nombre;
            $this->categoria = $categoria;
            $this->banner = $banner;
        } else {
            $ok = false;
        }

        return $ok;
    }

    /**
     * 
     * Método para obtener una lista determinado de la base de datos a través de su ID.
     * @param $id ID de la lista a consultar
     */
    public function getById($id)
    {

        $sql = "SELECT * from " . $this->tabla . " WHERE id=" . $id;

        $conexion = new Bd();
        $res = $conexion->consulta($sql);

        list($id, $id_usu, $categoria, $nombre, $banner, $privacidad) = mysqli_fetch_array($res);

        $this->id = $id;
        $this->categoria = $categoria;
        $this->id_usu = $id_usu;
        $this->nombre = $nombre;
        $this->banner = $banner;
        $this->privacidad = $privacidad;
    }

    /**
     * 
     * Genera una cadena de caracteres que devuelve un html con las listas de un usuario
     * @param $nombreUsu Es el nombre de usuario
     * 
     */
    public function mostrarListas($nombreUsu)
    {
        //var_dump($this->lista);
        $html = "";
        for ($i = 0; $i < sizeof($this->lista); $i++) {
            $html .= $this->lista[$i]->imprimeLista($nombreUsu);
        }
        $html .= "";
        return $html;
    }
    /**
     * 
     * obtiene el id del autor de una lista mediante una select de la base de datos
     * @param $id Es el id de la lista
     */
    public function obtenerIDAutor($id)
    {
        $sql = "SELECT id_usu FROM listas where id=".$id;
        $conexion = new Bd();
        $res = $conexion->consultaOneRow($sql)['id_usu'];
        return $res;
    }
    /**
     * 
     * Genera una cadena de caracteres que devuelve un html con las listas de un usuario(ajeno para los otros perfiles)
     * @param $nombreUsu Es el nombre de usuario
     * 
     */
    public function mostrarListasAjenas($nombreUsu)
    {
        //var_dump($this->lista);
        $html = "";
        for ($i = 0; $i < sizeof($this->lista); $i++) {

            $permisos = $_SESSION['permiso'];

            if ($permisos == 79) {
                $privacidad = 0;
            } else {
                $privacidad = $this->lista[$i]->locked($this->lista[$i]->id);
            }

            if ($privacidad != 1)
                $html .= $this->lista[$i]->imprimeListaAjena($nombreUsu);
        }
        $html .= "";
        return $html;
    }
    /**
     * 
     * Genera el codigo html correspondiente al div que contiene la informacion de la lista que se
     * muestra por pantalla, esta funcion tambien contiene la ruta de una imagen por defecto en caso de que
     * no se haya introducido una imagen(usuario ajeno)
     * @param $nombreUsu Es el nombre de usuario
     */
    public function imprimeListaAjena($nombreUsu)
    {

        $cat = new Categoria();

        $iconoCategoria = $cat->obtenerIcono($this->categoria);

        if (strlen($this->banner) == 0) {

            $fondo = "style='background-image:url(\"imgFront/backOWN.png\")';";
        } else {

            $fondo = "style='background-image:url(\"" . $this->carpeta . $nombreUsu . "/" . $this->banner . "\")')";
        }


        $html = "<div onclick=(mostrarListasReviewAjenas(" . $this->id . "," . $this->id_usu . ")) " . $fondo . "   class='Lista animateAppear'>
        <div class='textLista'>
        <img src='" . $iconoCategoria . "'>
        <div class='textList'>
        <label class='nombreLista'>" . $this->nombre . "</label>
        <label class='nombreCategoria'>" . $this->categoria . "</label>
        </div>
        
        </div>
        </div>";

        return $html;
    }

    /**
     * 
     * Genera el codigo html correspondiente al div que contiene la informacion de la lista que se
     * muestra por pantalla, esta funcion tambien contiene la ruta de una imagen por defecto en caso de que
     * no se haya introducido una imagen
     * @param $nombreUsu Es el nombre de usuario
     * 
     */
    public function imprimeLista($nombreUsu)
    {

        $cat = new Categoria();

        $iconoCategoria = $cat->obtenerIcono($this->categoria);

        if (strlen($this->banner) == 0) {

            $fondo = "style='background-image:url(\"imgFront/backOWN.png\")';";
        } else {

            $fondo = "style='background-image:url(\"" . $this->carpeta . $nombreUsu . "/" . $this->banner . "\")')";
        }

        $lock = $this->locked($this->id);

        if ($lock == 1) {
            $candado = "<img class='imagenLock' onclick='lockingLista(" . $this->id . ")' src='imgFront/iconLock.png'>";
        } else {
            $candado = "<img class='imagenUnLock' onclick='lockingLista(" . $this->id . ")' src='imgFront/iconUnLock.png'>";
        }

        $html = "<div id='lockIcon" . $this->id . "' class='lockIcon'>" . $candado . "</div>
        <div onclick=(location.href='mostrarLista.php?id=" . $this->id . "') " . $fondo . "   class='Lista animateAppear'>
        
        <div class='textLista'>
        <img src='" . $iconoCategoria . "'>
        <div class='textList'>
        <label class='nombreLista'>" . $this->nombre . "</label>
        <label class='nombreCategoria'>" . $this->categoria . "</label>
        </div>
        
        </div>
        </div>";

        return $html;
    }
    /**
     * 
     * Genera el codigo html que imprime las listas que ha obtenido la select de las ultimas publicaciones
     * que ha hecho el usuario.
     * @param $nombreUsu Es el nombre de usuario, se usa principalmente para completar la ruta donde se guardan las imagenes de las listas y las reviews
     */
    public function imprimeListaCronologia($nombreUsu)
    {

        $cat = new Categoria();
        $iconoCategoria = $cat->obtenerIcono($this->categoria);
        if (strlen($this->banner) == 0) {

            $fondo = "style='background-image:url(\"imgFront/backOWN.png\")';";
        } else {

            $fondo = "style='background-image:url(\"" . $this->carpeta . $nombreUsu . "/" . $this->banner . "\")')";
        }


        $html = "<div onclick=(location.href='mostrarLista.php?id=" . $this->id . "') " . $fondo . "   class='Lista animateAppear'>
        <div class='textLista'>
        <img src='" . $iconoCategoria . "'>
        <div class='textList'>
        <label class='nombreLista'>" . $this->nombre . "</label>
        <label class='nombreCategoria'>" . $this->categoria . "</label>
        </div>
        
        </div>
        </div>";

        return $html;
    }

/**
 * 
 * Cambia la privacidad de una lista mediante una update a la base de datos y la establece como privada
 * @param $id  Es la id de la lista a la que se le va a cambiar la privacidad
 */
    public function ListaPrivada($id)
    {
        $sql = "UPDATE listas set privacidad= 1 where id= " . $id;
        $conexion = new Bd();
        $res = $conexion->consulta($sql);
    }
/**
 * 
 * Cambia la privacidad de una lista mediante una update a la base de datos y la establece como privada
 * @param $id  Es la id de la lista a la que se le va a cambiar la privacidad
 */
    public function ListaPublica($id)
    {
        $sql = "UPDATE listas set privacidad= 0 where id= " . $id;
        $conexion = new Bd();
        $res = $conexion->consulta($sql);
    }

/**
 * 
 * Lanza una select a la base de datos y devuelve una confirmacion para saber si la lista seleccionada es privada o no
 * @param $id Es la id de la lista cuya privacidad va a ser revisada.
 */
    public function locked($id)
    {

        $sql = "SELECT privacidad FROM listas WHERE id=" . $id;

        $conexion = new Bd();

        $res = $conexion->consulta($sql);

        $privacidad = mysqli_fetch_array($res)['privacidad'];

        return $privacidad;
    }
}
