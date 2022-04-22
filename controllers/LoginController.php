<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController{
    public static function login(Router $router){
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // Instanciamos un usuario y borramos password2
            $usuario = new Usuario($_POST);
            unset($usuario->password2);
            // Verificamos el usuario llene correctamente los campos
            $alertas = $usuario->validarUsuario();
            if(empty($alertas)){
                // Buscamos que el usuario exista en la base de datos
                $usuario = Usuario::where('correo', $usuario->correo);
                // En caso de que no exista o no este confirmado le mandamos un mensaje
                if(!$usuario || !$usuario->confirmado){
                    Usuario::setAlerta('error', 'El usuario no exite o no esta confirmado'); 
                } else {
                    // Verificamos que la contraseña sea correcta
                    if(password_verify($_POST['password'], $usuario->password)){
                        // Inisiamos la sesion
                        session_start();
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre;
                        $_SESSION['apellido'] = $usuario->apellido;
                        $_SESSION['correo'] = $usuario->correo;
                        $_SESSION['login'] = true;

                        // Redireccionamos al usuario
                        header('location: /app');
                    } else {
                        Usuario::setAlerta('error', 'El password es incorrecto');
                    }
                }

            }
        }
        
        $alertas = Usuario::getAlertas();
        $router->render('auth/login',[
            'alertas' => $alertas,
            'titulo' => 'Login'
        ]);
    }
    public static function logout(){
        $_SESSION = [];
        header('location: /');
    }
    public static function crear(Router $router){
        $alertas = [];

        $usuario = new Usuario();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarCrearCuenta();

            if(empty($alertas)){
                // Verificar que el usuario ya exista
                $existeUsuario = Usuario::where('correo', $usuario->correo);
                if($existeUsuario){
                    Usuario::setAlerta('error', 'El usuario ya existe');
                } else {
                    // Hashear Passwird
                    $usuario->hashPassword();

                    // Eliminar el password2
                    unset($usuario->password2);

                    // Crear un token
                    $usuario->crearToken();

                    // Enviar Email
                    $mail = new Email($usuario->correo, $usuario->nombre, $usuario->token);
                    $mail->enviarConfirmacion();

                    // Guardar en la base de datos
                    $resultado = $usuario->guardar();

                    if($resultado) {
                        $usuario->nombre = '';
                        $usuario->apellido = '';
                        $usuario->correo = '';
                        Usuario::setAlerta('exito', 'Enviamos un correo para la confirmacion de la cuenta');
                    }
                }

            }
            
        }
        
        $alertas = Usuario::getAlertas();
        $router->render('auth/crear',[
            'alertas' => $alertas,
            'titulo' => 'Crear Cuenta',
            'usuario' => $usuario
        ]);
    }
    public static function confirmar(Router $router){
        $alertas = [];
        
        // Leemos el token de la url
        $token = $_GET['token'];

        // Si no tiene un token lo mandamos a la pagina principal
        if(!$token) header('location: /');

        // Buscamos al usuario por su token
        $usuario = Usuario::where('token', $token);

        // Si no se encuenta el usuario por el token le mandamos una alerta de que no es valido
        if(empty($usuario)){
            Usuario::setAlerta('error', 'El token no es valido');
        } else {
            $usuario->confirmado = 1;
            $usuario->token = '';
            unset($usuario->password2);
            $usuario->guardar();
            Usuario::setAlerta('exito', 'El usuario a sido confirmado');
        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/confirmar',[
            'alertas' => $alertas,
            'titulo' => 'Confirmar Cuenta'
        ]);
    }
    public static function olvide(Router $router){
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario = new Usuario($_POST);
            // Se verifica que llene correctamente el campo
            $usuario->validarCorreo();

            if(empty($alertas)){
                // Se busca el usuario por su correo
                $usuario = Usuario::where('correo', $usuario->correo);

                if($usuario && $usuario->confirmado){
                    // Se genera un nuevo token y se eliminar password2
                    $usuario->crearToken();
                    unset($usuario->password2);

                    // Actualizamos el usuario
                    $usuario->guardar();

                    // Enviar el email
                    $mail = new Email($usuario->correo, $usuario->nombre, $usuario->token);
                    $mail->enviarInstrucciones();

                    Usuario::setAlerta('exito','Enviamos un correo para el reestablecimiento de su password');
                } else {
                    usuario::setAlerta('error', 'El usuario no esta confirmado o no existe');
                }

            }
        }
        
        $alertas = Usuario::getAlertas();
        $router->render('auth/olvide',[
            'alertas' => $alertas,
            'titulo' => 'Olvide Password'
        ]);
    }
    public static function reestablecer(Router $router){
        $alertas = [];
        $mostrar = true;
        $token = s($_GET['token']);
        if(!$token) header('location: /');

        // Buscamos el usuario
        $usuario = Usuario::where('token', $token);
        if(empty($usuario)){
            Usuario::setAlerta('error','El token no es valido');
            $mostrar = false;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario->sincronizar($_POST);
            
            // Validar el password
            $alertas = $usuario->validarPassword();
            if(empty($alertas)){
                //Haseamos el password
                $usuario->hashPassword();
                // Eliminamos token y password2
                $usuario->token = '';
                unset($usuario->password2);
                // Guardamos en la base de datos
                $resultado = $usuario->guardar();
                if($resultado) header('location: /');
            }
        }
        
        $alertas = Usuario::getAlertas();
        $router->render('auth/reestablecer',[
            'alertas' => $alertas,
            'titulo' => 'Reestablece tu password',
            'mostrar' => $mostrar
        ]);
    }
}