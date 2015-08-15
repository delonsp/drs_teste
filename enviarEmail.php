<?php

session_start();

require("libraries/class.phpmailer.php");

$pageTitle="envio de email";

function customPageHeader() { ?>

<?php }

$user_lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        // if translation file for the detected language doesn't exist, we use default english file
        require_once(__DIR__ .'/translations/' . (file_exists(__DIR__ .'/translations/' . $user_lang . '.php') ? $user_lang : 'en') . '.php');

include_once("views/_header.php");

?>

<div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2" style="text-align:center;">

<?php


if(isset($_POST['receitas2']) && !empty($_POST['receitas2'])) {
	
	$caught = false;
	
	$mail = new PHPMailer(true);

	try {

		$mail->CharSet="UTF-8";

		$mail->IsSMTP();                                      // Set mailer to use SMTP
		$mail->Host     = "srv58.hosting24.com";
		$mail->Port     = 465;
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'alain_urologista@drsolutionapp.info';                            // SMTP username
		$mail->Password = 'pto2phil';                           // SMTP password
		$mail->SMTPSecure = 'ssl';                            // Enable encryption, 'ssl' also accepted
		
		
		$mail->From = $_SESSION['user_email'];
		$mail->FromName = $_SESSION['primeiro_nome']." ".$_SESSION['nome_meio']." ".$_SESSION['ultimo_nome'];


		for ($i=0; $i < sizeof($_SESSION['array_pharmas']); $i++) { 
			$n = strval($i+1);

			if ($_POST['pharma_email_'.$n] == "on") {
				
				$array_emails = explode(",", $_SESSION['array_pharmas'][$i]['emails']);
				
				foreach ($array_emails as $email) {
					
					$mail->AddBCC("$email");
				}

			}
		}

		if ($_POST['pharma_email_mim'] == "on") {
			$mail->AddAddress($_SESSION['user_email']);

		}


		$mail->AddReplyTo($_SESSION['user_email'], 'reply');
		$texto = nl2br($_POST['receitas2']);
		
		
		$mail->WordWrap = 50;      
		$mail->IsHTML(true);                                  // Set email format to HTML
		
		$mail->Subject = 'Receita de Paciente @receitas_enviadas';
		$mail->Body    =  "<!DOCTYPE html>
			<html lang='pt-br'>
			    <head>
				<meta charset=\"utf-8\">
				<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
				<title>Receita manipulada</title>
		
			    </head>
			    <body>
			    {$texto}
			    
			    </body>
		    </html>";

	    $mail->Send();

	}
	catch (phpmailerException $e) {


	  if (strpos($e->ErrorMessage(),'You must provide at least one recipient email address.') ) {
	  	
	  	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=medicamentos.php">';
  
	  } else {
	  	  echo "<div class='alert alert-danger'>";
		  echo "Mensagem não enviada<br>";
		  echo "Favor checar sua conexão de Internet.<br>";
		  echo "Mensagem de erro: " . $e->ErrorMessage();
		  echo "<br><br><button class='btn btn-danger' title='Reenviar' alt='Reenviar' onclick='location.reload(true);'>Reenviar email</button>"; 
		  echo "<br><br><a href='medicamentos.php' class='btn btn-success' title='Retornar' alt='Retornar'>Retornar</a>"; 
		  echo "</div>";
		  
	  }

	  $caught = true;
	  
	}
	
   
	if(!$caught) {

	  echo "<div class='alert alert-success'>";
		
	  echo "Mensagem enviada com sucesso<br>";
	 
	  echo "<br><a href='medicamentos.php' class='btn btn-success' title='Retornar' alt='Retornar'>Retornar</a>"; 
	  echo "</div>";
	 
	  
	} 
} else {
	  echo "<div class='alert alert-danger'>";
		
	  echo "Ocorreu um erro desconhecido.<br>";
	  echo "Favor tentar novamente.<br>";
	  
	  
	  echo "<br><br><a href='medicamentos.php' class='btn btn-danger' title='Retornar' alt='Retornar'>Retornar</a>"; 
	  echo "</div>";
	
}
?>
</div></div></div>

<?

include_once('views/_footer.php');
