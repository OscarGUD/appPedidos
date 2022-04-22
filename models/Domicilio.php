<?php

namespace Model;

class Domicilio extends ActiveRecord{
    protected static $tabla = 'domicilio';
    protected static $columnasDB = ['id', 'colonia', 'calle', 'telefono','interior', 'exterior', 'usuarioId'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->colonia = $args['colonia'] ?? '';
        $this->calle = $args['calle'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->interior = $args['interior'] ?? '';
        $this->exterior = $args['exterior'] ?? '';
        $this->usuarioId = $args['usuarioId'] ?? '';
    }

    public function validarDomicilio(){
        if(!$this->colonia){
            self::$alertas['error'][] = 'La colonia es obligatoria';
        }
        if(!$this->calle){
            self::$alertas['error'][] = 'La calle es obligatoria';
        }
        if(!$this->telefono){
            self::$alertas['error'][] = 'El telefono es obligatoria';
        }
        if(!is_numeric($this->telefono)){
            self::$alertas['error'][] = 'El telefono no es valido';
        }
        if(!$this->interior && !$this->exterior){
            self::$alertas['error'][] = 'Minimo coloca un numero de casa';
        }
        return self::$alertas;
    }
}