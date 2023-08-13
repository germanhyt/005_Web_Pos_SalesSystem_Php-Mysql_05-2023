<?php
class ProductosModel extends Mysql{

    public $id, $codigo, $nombre, $cantidad, $precio,$categoria;
    public function __construct()
    {
        parent::__construct();
    }

    public function selectProductos()
    {
        $sql = "SELECT * FROM productos WHERE estado = 1";
        $res = $this->select_all($sql);
        return $res;
    }

    public function getCategorias(){
        $sql="SELECT * FROM categorias WHERE estado = 1";
        $res=$this->select_all($sql);
        return $res;
    }

    public function selectProductosInactivos()
    {
        $sql = "SELECT * FROM productos WHERE estado = 0";
        $res = $this->select_all($sql);
        return $res;
    }

    public function insertarProductos(String $codigo, string $nombre,string $categoria, string $precio )
    {
        $return = "";
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->categoria=$categoria;
        $sql = "SELECT * FROM productos WHERE codigo = '{$this->codigo}'";
        $result = $this->select_all($sql);
        if (empty($result)) {
            $query = "INSERT INTO productos(codigo, nombre, categoria, precio) VALUES (?,?,?,?)";
            $data = array($this->codigo, $this->nombre,$this->categoria, $this->precio);
            $resul = $this->insert($query, $data);
            $return = $resul;
        }else {
            $return = "existe";
        }
        return $return;
    }

    public function editarProductos(int $id)
    {
        $this->id = $id;
        $sql = "SELECT * FROM productos WHERE id = '{$this->id}'";
        $res = $this->select($sql);
        if (empty($res)) {
            $res = 0;
        }
        return $res;
    }
    
    public function actualizarProductos(String $codigo, string $nombre,string $categoria, string $cantidad, string $precio, int $id)
    {
        $return = "";
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->categoria=$categoria;
        $this->cantidad = $cantidad;
        $this->precio = $precio;
        $this->id = $id;
        $query = "UPDATE productos SET codigo=?, nombre=?, categoria=?, cantidad=?, precio=? WHERE id=?";
        $data = array($this->codigo, $this->nombre, $this->categoria, $this->cantidad, $this->precio, $this->id);
        $resul = $this->update($query, $data);
        $return = $resul;
        return $return;
    }
    public function eliminarProductos(int $id)
    {
        $return = "";
        $this->id = $id;
        $query = "UPDATE productos SET estado = 0 WHERE id=?";
        $data = array($this->id);
        $resul = $this->update($query, $data);
        $return = $resul;
        return $return;
    }
    public function reingresarProductos(int $id)
    {
        $return = "";
        $this->id = $id;
        $query = "UPDATE productos SET estado = 1 WHERE id=?";
        $data = array($this->id);
        $resul = $this->update($query, $data);
        $return = $resul;
        return $return;
    }
}
?>