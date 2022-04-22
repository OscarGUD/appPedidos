<?php 

namespace Controllers;

use Model\ActiveRecord;
use Model\Domicilio;
use Model\Usuario;
use MVC\Router;

class AppController extends ActiveRecord{
    public static function app(Router $router){
        session_start();
        isAuth();

        $router->render('app/app',[
            'titulo' => 'Crea tu pedido',
            'nombre' => $_SESSION['nombre'],
            'apellido' => $_SESSION['apellido']
        ]);
    }
    public static function direccion(Router $router){
        // Varibles y inicio de sesion
        session_start();
        $alertas = [];
        $mostrar = true;
        isAuth();

        // Verificasion si no tiene un domicilio agregado
        $domicilio = Domicilio::where('usuarioId', $_SESSION['id']);
        if($domicilio){
            Domicilio::setAlerta('exito','Usted ya cuenta con una direccion agregada');
            $mostrar = false;
        }
         
        $domicilio = new Domicilio();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // Sincronizamos para experienza de usuario y validamos el formulario
            $domicilio->sincronizar($_POST);
            $alertas = $domicilio->validarDomicilio();

            if(empty($alertas)){
                $domicilio->usuarioId = $_SESSION['id'];
                $resultado = $domicilio->guardar();   
                if($resultado){
                    header("Location: /direccion");
                }
            }
        }

        $alertas = Domicilio::getAlertas();
        $router->render('app/direccion',[
            'titulo' => 'Agrega tu Direccion',
            'domicilio' => $domicilio,
            'alertas' => $alertas,
            'mostrar' => $mostrar,
            'nombre' => $_SESSION['nombre'],
            'apellido' => $_SESSION['apellido']
        ]);
    }
    public static function editar_direccion(Router $router){
        // Iniciamos variable sy funciones
        session_start();
        isAuth();
        $mostrar = true;
        $alertas = [];

        // Buscamos la direccions y verificamos que exista la direccion
        $domicilio = Domicilio::where('usuarioId', $_SESSION['id']);
        if(!$domicilio){
            Domicilio::setAlerta('error', 'Usted no cuenta con una direccion agregada');
            $mostrar = false;
        } else {
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                // Sincronizamos y validamos formulario
                $domicilio->sincronizar($_POST);
                $alertas = $domicilio->validarDomicilio();

                if(empty($alertas)){
                    $resultado = $domicilio->guardar();
                    if($resultado){
                        Domicilio::setAlerta('exito', 'Actualizado correctamente');
                    }
                }
            }
        }

        $alertas = Domicilio::getAlertas();
        $router->render('app/editar-direccion',[
            'titulo' => 'Editar Direccion',
            'domicilio' => $domicilio,
            'mostrar' => $mostrar,
            'alertas' => $alertas
        ]);
    }
    public static function perfil(Router $router){
        // Variables y session
        session_start();
        isAuth();
        $alertas = [];

        // Buscamos el usuario para mostrarlo en el formulario
        $usuario = Usuario::find($_SESSION['id']);
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // Se sincroniza y se verifica que no esten vacios los campos
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarPerfil();

            if(empty($alertas)){    
                // Se verifica que el correo de cambio no este en uso
                $existeUsuario = Usuario::where('correo', $usuario->correo);

                if($existeUsuario && $existeUsuario->id !== $usuario->id){
                    // Mnesaje de que el correo ya esta en uso
                    Usuario::setAlerta('error', 'El correo ya esta en uso');
                } else {
                    $usuario->guardar();

                    Usuario::setAlerta('exito', 'Cambios actualizados correctamente');

                    $_SESSION['nombre'] = $usuario->nombre;
                }
            }
        }

        $alertas = Usuario::getAlertas();
        $router->render('app/perfil', [
            'usuario' => $usuario,
            'titulo' => 'Perfil',
            'alertas' => $alertas
        ]);
    }
    public static function cambiar_password(Router $router){
        // Funciones y Variables
        session_start();
        isAuth();
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario = Usuario::find($_SESSION['id']);

            // Sincronizar con los datos del usuario
            $usuario->sincronizar($_POST);
            
            $alertas = $usuario->nuevo_password();  
            
            if(empty($alertas)){
                $resultado = $usuario->comprobar_password();

                if($resultado){
                    $usuario->password = $usuario->password_nuevo;

                    // Eliminamos propiedades No necesarios
                    unset($usuario->password_actual);
                    unset($usuario->password_nuevo);

                    // Hasheamos el password
                    $usuario->hashPassword();

                    // Actualizar
                    $resultado = $usuario->guardar();

                    if($resultado){
                        Usuario::setAlerta('exito', 'Password actualizado correctemente');
                    } 
                } else {
                    Usuario::setAlerta('error', 'Password incorrecto');
                }
            } 
        }
        $alertas = Usuario::getAlertas();
        $router->render('app/cambiar-password',[
            'titulo' => 'Cambiar Password',
            'alertas' => $alertas
        ]);
    }
}