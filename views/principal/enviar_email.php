<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/OAuthTokenProvider.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
//Load Composer's autoloader
//require './vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'perrobuenpito@gmail.com';                     //SMTP username
    $mail->Password   = '';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('perrobuenpito@gmail.com', 'TIENDA');
    $mail->addAddress($email);     //Add a recipient
    $mail->addAddress('perrobuenpito@gmail.com');
    foreach($productos as $producto){
        if(isset($_SESSION['carrito'][$producto['id']]))
                $mensaje2 .= "<br> Nombre del producto: ".$producto['nombre']."<br> Unidades: ". $_SESSION['carrito'][$producto['id']]."<br>";
    }
        
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'PEDIDO NUMERO: '.$n_pedido;
    $mail->Body    = "Gracias por confiar en nosotros! <br> Estimado ".$_SESSION['nombre']."<br>"." El precio Total es de ".$precio_total."€ <br> El pedido que se ha realizado se ha enviado a la siguiente dirección: ".$datos['direccion']."<br> En la provincia de ".$datos['provincia']."(".$datos['localidad'].")<br> Gracias".$mensaje2;
    
    $mail->send();
    //echo 'El mensaje se envió correctamente al siguiente email: '.$email;
} catch (Exception $e) {
    echo "Error al enviar el mensaje: {$mail->ErrorInfo}";
}

