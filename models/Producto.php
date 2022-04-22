<?php 

namespace Model;

class Producto extends ActiveRecord{
    protected static $tabla = 'producto';
    protected static $columnasDB = ['id','nombre','masa','precio'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->masa = $args['masa'] ?? '';
        $this->precio = $args['precio'] ?? '';
    }
}