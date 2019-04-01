<?php
if(isset($_POST['email'])) {

    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "garciaporto@gmail.com";
    $email_subject = "Contacto WEB";

    function died($error) {
        // your error code can go here
        echo "Sentimos informarte que hemos encontrado un error en el formulario que enviaste. ";
        echo "Los errores se muestran a continuación.<br /><br />";
        echo $error."<br /><br />";
        echo "Por favor, corrige el error.<br /><br />";
        die();
    }


    // validation expected data exists
    if(!isset($_POST['name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['message'])) {
        died('Sentimos informarte que hemos encontrado un error en el formulario que enviaste.');
    }

    $Name = $_POST['name']; // required
    $email_from = $_POST['email']; // required
    $Message = $_POST['message']; // required


    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'La dirección de correo introducida no es válida.<br />';
  }

    $string_exp = "/^[A-Za-z .'-]+$/";

  if(!preg_match($string_exp,$Name)) {
    $error_message .= 'El nombre introducido no es válido.<br />';
  }

  if(strlen($Message) < 2) {
    $error_message .= 'El mensaje enviado no es válido.<br />';
  }

  if(strlen($error_message) > 0) {
    died($error_message);
  }

    $email_message = "Detalles a continuación.\n\n";


    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }


    $email_message .= "Nombre: ".clean_string($Name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Mensaje: ".clean_string($Message)."\n";

// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);
?>

<!-- include your own success html here -->

<?php

}
?>
