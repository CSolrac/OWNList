<?php

class Usuario
{
    private $id;
    private $nombre;
    private $password;
    private $bio;
    private $email;
    private $avatar;
    private $banner;
    private $permiso;
    private $tabla;
    private $carpeta;
    private $lista = array();

    /**
     * Usuario constructor.
     * @param $id
     * @param $nombre
     * @param $password
     * @param $bio
     * @param $email
     * @param $avatar
     * @param $banner
     */
    public function __construct($nombre = "", $bio = "", $avatar = "", $banner = "", $id = "")
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->bio = $bio;
        $this->avatar = $avatar;
        $this->banner = $banner;
        $this->carpeta = "Usuarios/" . $nombre . "/";
        $this->tabla = "usuarios";
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
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * @param mixed $bio
     */
    public function setBio($bio)
    {
        $this->bio = $bio;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param mixed $avatar
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }

    /**
     * @return mixed
     */
    public function getBanner()
    {

        return $this->banner;
    }

    /**
     * @param mixed $banner
     */
    public function setBanner($banner)
    {
        $this->banner = $banner;
    }

    /**
     * @return mixed $lista
     */
    public function getLista()
    {

        return $this->lista;
    }

    /**
     * @param mixed $lista
     */
    public function setLista($lista)
    {
        $this->lista = $lista;
    }

    /**
     * @return mixed
     */
    public function getPermiso()
    {
        return $this->permiso;
    }

    /**
     * @param mixed $permiso
     */

    public function setPermiso($permiso)
    {
        $this->permiso = $permiso;
    }
    /**
     * 
     * Compara el nombre y la contraseña que proporciona el usuario con los presente en la base de datos
     * en caso de encontrar una coincidenca carga los datos del usuario en la sesion aactual , en caso de que
     * no tenga imagen o banner se cargara una imagen por defecto
     * @param $nombre Es el nombre de usuario
     * @param $password Es la contraseña del usuario
     * 
     */
    public function logearse($nombre, $password)
    {
        $ok = false;
        $sql = "SELECT id, nombre, bio, email, avatar, banner, permiso FROM " . $this->tabla . " 
                WHERE nombre='" . $nombre . "' AND password='" . md5($password) . "'";

        $conexion = new Bd();
        $res = $conexion->consultaOneRow($sql);
        if ($conexion->numeroElementos() > 0) {
            $ok = true;
            $this->id = $res['id'];
            $this->nombre = $res['nombre'];
            $this->permiso = $res['permiso'];
            $this->bio = $res['bio'];

            if (strlen($res['avatar']) != 0) {
                $this->avatar = $this->carpeta . $res['avatar'];
            } else {
                $this->avatar = "imgFront/avatarDefault.png";
            }

            if (strlen($res['banner']) != 0) {
                $this->banner = $this->carpeta . $res['banner'];
            } else {
                $this->banner = "imgFront/backOWN.png";
            }


            $this->email = $res['email'];
        } else {
            $ok = false;
        }

        return $ok;
    }

    /**
     * 
     * Registra un usuario siempre y cuando el nombre y el email no esten previamente en la base de datos
     * @param $datos Es un array asociativo que contiene los datos del usuario a registrar
     */
    public function registrarse($datos)
    {


        $conexion = new Bd();


        $conexion->addBd("usuarios", $datos);
    }

    /**
     * 
     * Lanza un update a la base de datos que modifica el perfil del usuario, y aplica los 
     * cambios en tiempo real
     * @param $datos Es un array asociativo que contiene los nuevos datos del usuario
     * @param $avatar Es la imagen de avatar del usuario
     * @param $banner Es la imagen de banner del usuario
     * 
     */
    public function editarPerfil($datos, $avatar, $banner)
    {

        $conexion =  new Bd();
        $id = $_SESSION['id'];
        if ($banner['name'] != "")
            $conexion->borrarFoto($id, $this->tabla, $this->nombre, "banner");
        if ($avatar['name'] != "")
            $conexion->borrarFoto($id, $this->tabla, $this->nombre, "avatar");
        $conexion->updateBd("usuarios", $datos, $this->nombre, $avatar, $banner, $this->carpeta);

        $sql = "SELECT bio, avatar, banner FROM " . $this->tabla . " 
                WHERE nombre='" . $this->nombre . "'";

        $res = $conexion->consultaOneRow($sql);
        if ($conexion->numeroElementos() > 0) {
            $this->bio = $res['bio'];
            if ($res['avatar'] != "")
                $this->avatar = $this->carpeta . $res['avatar'];
            else
                $this->avatar = "imgFront/avatarDefault.png";
            if ($res['banner'] != "")
                $this->banner = $this->carpeta . $res['banner'];
            else
                $this->banner = "imgFront/backOWN.png";
        }
    }
/**
 * 
 * Consiste en una select que busca coincidencias de usuarios en la base de datos
 * @param $busqueda Es la palabra que va buscar el buscador mediante la select 
 */
    public function buscarUsuario($busqueda = "")
    {
        $sql = "select usuarios.id, usuarios.nombre, usuarios.bio, usuarios.avatar, usuarios.banner FROM " . $this->tabla . " where nombre like '%" . $busqueda . "%'";
        $conexion = new Bd();
        $res = $conexion->consulta($sql);


        while (list($id, $nombre, $bio, $avatar, $banner) = mysqli_fetch_array($res)) {
            $usuario = new Usuario($nombre, $bio, $avatar, $banner, $id);
            array_push($this->lista, $usuario);
        }
    }
/**
 * 
 * Muestra el codigo generado por la funcion imprimeUsuario tantas veces como el numero que marque la longitud del array de la lista.
 * 
 */
    public function mostrarUsuarios()
    {

        $html = "";
        for ($i = 0; $i < sizeof($this->lista); $i++) {
            $html .= $this->lista[$i]->imprimeUsuario($this->lista[$i]->nombre);
        }
        $html .= "";
        return $html;
    }
/**
 * 
 * Muestra el codigo generado por la funcion imprimeUsuario tantas veces como el numero que marque la longitud del array de la lista.
 * Tiene la peculiridad de mostrar opciones que solo el administrador puede ver.
 */
    public function mostrarUsuariosAd()
    {

        $html = "";
        for ($i = 0; $i < sizeof($this->lista); $i++) {
            $html .= $this->lista[$i]->imprimeUsuario($this->lista[$i]->nombre);
            $idAdmin = $_SESSION['id'];

            if($idAdmin != $this->lista[$i]->id){

                $html .= "<div class='eliminarUserAdmin' onclick='eliminarUserAd(".$this->lista[$i]->id.")'><label>Eliminar Usuario</label><img src='imgFront/delete.png'></div>";
            
            }
        }
        $html .= "";
        return $html;
    }
/**
 * 
 * Muestra el contenido del perfil del usuario generado por codigo html haciendo referencia al objeto usuario con los datos del usuario cargados en el 
 * @param $nombreUsu Es el nombre del usuario
 */
    public function imprimeUsuario($nombreUsu)
    {

            if (strlen($this->banner) == 0) {

            $fondo = "style='background-image:url(\"imgFront/backOWN.png\")';";
        } else {

            $fondo = "style='background-image:url(\"" . $this->carpeta . $this->banner . "\")'";
        }

        if (strlen($this->avatar) == 0) {

            $avatar = "style='background-image:url(\"imgFront/avatarDefault.png\")';";
        } else {

            $avatar = "style='background-image:url(\"" . $this->carpeta . $this->avatar . "\")'";
        }


        $html = "<div class='containerUsers'>

                <div class='contenidoUsers' onclick=(location.href='";
        if ($this->id == $_SESSION['id']) $html .= "home.php";
        else $html .= "perfilUsuarios.php?id=" . $this->id;
        $html .= "') class='animateAppear'>

                    <div class='banner' " . $fondo . ">

                        <div class='infoUsu'>

                            <label class='username'>" . $nombreUsu . "</label>

                            <label class='bio'>" . $this->getBio() . "</label>

                        </div>

                        <div class='avatar' " . $avatar . "></div>

                    </div>

                </div>";

        return $html;
    }
    /**
     * 
     * Obtiene los datos de un usuario de la base de datos  mediante una select a la base de datos usando el id del usuario
     * @param $id Es el id del usuario
     */
    public function obtenerUserID($id)
    {
        $sql = "select usuarios.id,usuarios.bio, usuarios.nombre, usuarios.banner, usuarios.avatar FROM usuarios where usuarios.id= " . $id;
        $conexion = new Bd();
        $res = $conexion->consultaOneRow($sql);
        if ($conexion->numeroElementos() > 0) {
            $this->id = $res['id'];
            $this->nombre = $res['nombre'];
            $this->avatar = $res['avatar'];
            $this->banner = $res['banner'];
            $this->bio = $res['bio'];
            $this->carpeta = "Usuarios/" . $this->nombre . "/";
        }
    }
/**
 * 
 * Elimina un usuario de la base de datos mediante un delete 
 * @param $id Es el id del usuario
 */
    public function eliminarUsuario($id){
        $sql = "DELETE FROM usuarios where id= ".$id;
        $conexion = new Bd();
        $res = $conexion->consulta($sql);
    }


}
