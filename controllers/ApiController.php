<?php

namespace Controllers;

use Model\Producto;
use Model\Domicilio;

class ApiController{
    public static function index(){
        $servicio = Producto::all();
        echo json_encode($servicio);
    }

    public static function direccionConsulta(){
        session_start();
        $domicilio = Domicilio::where('usuarioId', $_SESSION['id']);
        echo json_encode($domicilio);
    }
}