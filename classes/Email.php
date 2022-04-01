<?php

namespace Classes;
use PHPMailer\PHPMailer\PHPMailer;


class Email{

    protected $email;
    protected $nombre;
    protected $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion(){
        // Crear el objeto email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'f59d58a5be7236';
        $mail->Password = 'ee2554c91daff1';

        $mail->setFrom('cuentas@uptask.com');
        $mail->addAddress('cuentas@uptask.com', 'uptask.com');
        $mail->Subject = 'Confirmar tu cuenta';
        
        $mail->isHTML(true);
        $mail -> charSet = "UTF-8"; 
        $contenido = '<html>';
        $contenido .= '<p><strong>Hola ' . $this->nombre . '</strong> Has creado tu cuenta en UpTask, solo debes confirmarla presionando el siguiente enlace</p>';
        $contenido .= '<p>Preciona Aqui: <a href="http://localhost:3000/confirmar?token=' . $this->token . '">Confirmar Cuenta</a></p>';
        $contenido .= '<p>Si tu no solicitaste esta cuenta puedes ignorar el mensaje</p>';
        $contenido .= '</html>';

        $mail->Body = $contenido;
        // Enviar email
        $mail->send();
    }

    public function enviarInstrucciones(){
        // Crear el objeto email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'f59d58a5be7236';
        $mail->Password = 'ee2554c91daff1';

        $mail->setFrom('cuentas@uptask.com');
        $mail->addAddress('cuentas@uptask.com', 'uptask.com');
        $mail->Subject = 'Reestablece tu password';

        $mail->isHTML(true);
        $mail->Charser = 'UTF-8';
        $contenido = '<html>';
        $contenido .= '<p><strong>Hola ' . $this->nombre . '</strong> Has solicitado el reestablecimiento de tu password en UpTask, sigue el siguiente enlace</p>';
        $contenido .= '<p>Preciona Aqui: <a href="http://localhost:3000/reestablecer?token=' . $this->token . '">Reestablecer Tu Password</a></p>';
        $contenido .= '<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje</p>';
        $contenido .= '</html>';

        $mail->Body = $contenido;
        // Enviar email
        $mail->send();
    }
}