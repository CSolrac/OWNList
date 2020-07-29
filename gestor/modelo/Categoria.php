    <?php

    class Categoria{
    private $id;
    private $nombre;
    private $icono;
    private $lista;

     /**
     * Plataforma constructor.
     * @param $id
     * @param $nombre
     */
    public function __construct($id="", $nombre="", $lista="")
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->lista = array();
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
    public function getIcono()
    {
        return $this->icono;
    }

    /**
     * @param mixed $icono
     */
    public function setIcono($icono)
    {
        $this->icono = $icono;
    }

    /**
     * @return mixed
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
     * 
     * Obtiene el icono de una categoria mediante una select 
     * a la base de datos usando la id del la categoria
     * @param $id Es el id de la categoria
     * 
     */
    public function obtenerIcono($nombre){

        $sql = "SELECT icono FROM categorias where nombre= '".$nombre."'";
        $conexion = new Bd();
        $res = $conexion->consulta($sql);
        $icono = mysqli_fetch_array($res);

        $icon = "imgFront/".$icono['icono'];

        return $icon;
    }
    /**
     * 
     * Obtiene el nombre de una categoria mediante una selec a la base de datos
     * @param $id Es el id de la categoria
     */
    public function obtenerNombre($id){
        
        $sql = "SELECT nombre FROM categorias where id= '".$id."'";
        $conexion = new Bd();
        $res = $conexion->consulta($sql);
        $nombre = mysqli_fetch_array($res)['nombre'];

        return $nombre;
    }

    /**
     * 
     * Obtiene todas las categorias mediante una select
     * a la base de datos.
     * 
     */
    public function obtenerCategorias()
    {
        $sql = "SELECT * FROM categorias";
        $conexion = new Bd();
        $res = $conexion->consulta($sql);

        while (list($id, $nombre) = mysqli_fetch_array($res)) {
            $categoria = new Categoria($id, $nombre);
            array_push($this->lista, $categoria);
        }
    }

    /**
     * 
     * Genera un codigo Html que imprime las categorias por pantalla
     * @param $tipo Es el tipo de categoria seleccionada
     */
    public function mostrarCategorias($tipo)
    {
        $html="";
        for ($i = 0; $i < sizeof($this->lista); $i++) {
            $html .= $this->lista[$i]->imprimeOpciones($tipo);
        }
        return $html;
    }

    /**
     * 
     * Imprime las categorias de la base de datos en los options de un select.
     * @param $tipo Es el tipo de categoria seleccionada
     */
    public function imprimeOpciones($tipo)
    {
        $html ="<option ";
        if($tipo==$this->id)
        $html.="selected ";
        $html.= "value=' ".$this->id." '>".$this->nombre."</option>";

        return $html;


    }
}



?>