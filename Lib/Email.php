<?php

    namespace Lib;

    use PHPMailer\PHPMailer\PHPMailer;

    class Email{

        public $email;

        public $token;

        public function __construct($email, $token){
            $this->email = $email;
            $this->token = $token;

        }

        public function enviarConfirmacion(){

            // Creamos una instancia.
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail -> Username = '6b69d139bcd617';
            $mail -> Password = '9d08fb588e79a0';

            $mail->setFrom('perrobuenpito@gmail.com');
            $mail->addAddress($this -> email); //Aqui nuestro dominio.
            $mail->Subject = 'Confirma tu Cuenta';

            //Ponemos el HTML.
            $mail->isHTML(TRUE);
            $mail->CharSet = 'UTF-8';

            $contenido = '<html>';
            $contenido .= "<p><strong>Hola " . $this->email . "</strong>Has creado tu cuenta en Buenyantar.com, solo debes confirmarla presionando el siguiente enlace</p>";
            $contenido .= "<p>Presiona aquí: <a href='http://localhost/proyecto-cursos/public/confirmar-cuenta/". $this->token . "'>Confirmar Cuenta</a></p>";
            $contenido .= "<p>Si tu no solicitaste este cambio, puedes ignorar el mensaje.</p>";
            $contenido .= '</html>';
            $mail->Body = $contenido;

            // Enviar el mail.
            $mail->send();

        }

        public function enviarInstrucciones(){

        }
    }

?>
