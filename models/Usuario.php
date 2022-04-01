<?php

namespace Model;

class Usuario extends ActiveRecord{
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id','nombre','apellido','correo','password','confirmado','token','admin'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->correo = $args['correo'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password2 = $args['password2'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
        $this->token = $args['token'] ?? '';
        $this->admin = $args['admin'] ?? 0;
    }

    public function validarCrearCuenta(){
        if(!$this->nombre){
            self::$alertas['error'][] = 'El nombre es Obligatrio';   
        }
        if(!$this->apellido){
            self::$alertas['error'][] = 'El apellido es Obligatrio';   
        }
        if(!$this->correo){
            self::$alertas['error'][] = 'El correo es Obligatrio';   
        }
        if(!filter_var($this->correo, FILTER_VALIDATE_EMAIL)){
            self::$alertas['error'][] = 'El correo no es valido';
        }
        if(!$this->password){
            self::$alertas['error'][] = 'El password es Obligatrio';   
        }
        if(strlen($this->password) < 6){
            self::$alertas['error'][] = 'El password debe contener almenos 6 caracteres';   
        }
        if($this->password !== $this->password2){
            self::$alertas['error'][] = 'Los passwords no son iguales';   
        }
        return self::$alertas;
    }
    public function validarCorreo(){
        if(!$this->correo){
            self::$alertas['error'][] = 'El correo es Obligatrio';   
        }
        if(!filter_var($this->correo, FILTER_VALIDATE_EMAIL)){
            self::$alertas['error'][] = 'El correo no es valido';
        }
        return self::$alertas;
    }
    public function validarPassword(){
        if(!$this->password){
            self::$alertas['error'][] = 'El password es Obligatrio';   
        }
        if(strlen($this->password) < 6){
            self::$alertas['error'][] = 'El password debe contener almenos 6 caracteres';   
        }
        if($this->password !== $this->password2){
            self::$alertas['error'][] = 'Los passwords no son iguales';   
        }
        return self::$alertas;
    }
    public function hashPassword(){
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }
    public function crearToken(){
        $this->token = md5(uniqid());
    }
}