<?php 

require_once('classes/PharmaConfig.php');
require_once('config/connectMedic.php');

function showMessages($pharmaConfig) {

	$mensagens="";

	if ($pharmaConfig->messages) {
		$mensagens .= implode("\n",$pharmaConfig->messages);
		$div1 = '<div class="alert alert-success"><h4>';
		$div2 = '</h4></div>';
		$mensagens = $div1 . $mensagens . $div2;
	}
	if ($pharmaConfig->errors) {
		$mensagens .= implode("\n", $pharmaConfig->errors);
		$div1 = '<div class="alert alert-danger"><h4>';
		$div2 = '</h4></div>';
		$mensagens = $div1 . $mensagens . $div2;
	}
	return $mensagens;
}

if(!empty($_POST['nome_pharma']) &&
        	!empty($_POST['emails_pharma'])) 
{
	$data_array = array('nome' => $_POST['nome_pharma'],
	 					'emails' => $_POST['emails_pharma'],
	 					'enviar_email' => $_POST['enviar_email'] // nao vai para a tabela PharmaConfig e sim para a tabela users_pharmas
	 					);
	$pharmaConfig = new pharmaConfig();
	$pharmaConfig->registerNewPharma($data_array);
	echo showMessages($pharmaConfig);

}
elseif (!empty($_POST['busca_pharma']))
{	
	$pharmaConfig = new pharmaConfig();
	$busca = $pharmaConfig->buscaPharma($_POST['busca_pharma']);
	if($busca) echo $busca;
	else echo showMessages($pharmaConfig);
} 
elseif (!empty($_POST['no'])) 
{
	$pharmaConfig = new pharmaConfig();
	$pharmaConfig->includePharma($_POST['no']);
	echo showMessages($pharmaConfig);
}
else
{
	echo "Dados inválidos.";
}




 ?>