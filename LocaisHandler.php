<?php 

require_once('classes/LocaisConfig.php');
require_once('config/connectMedic.php');

function showMessages($locaisConfig) {

	$mensagens="";

	if ($locaisConfig->messages) {
		$mensagens .= implode("\n",$locaisConfig->messages);
		$div1 = '<div class="alert alert-success"><h4>';
		$div2 = '</h4></div>';
		$mensagens = $div1 . $mensagens . $div2;
	}
	if ($locaisConfig->errors) {
		$mensagens .= implode("\n", $locaisConfig->errors);
		$div1 = '<div class="alert alert-danger"><h4>';
		$div2 = '</h4></div>';
		$mensagens = $div1 . $mensagens . $div2;
	}
	return $mensagens;
}

if(!empty($_POST['end_local']) &&
        	!empty($_POST['tel_local']) &&
        	!empty($_POST['codigo_local']) &&
        	!empty($_POST['nome_local'])) 
{
	$data_array = array('nome_local' => $_POST['nome_local'],
	 					'end_local' => $_POST['end_local'],
	 					'tel_local' => $_POST['tel_local'],
	 					'codigo_local' => $_POST['codigo_local']);
	$locaisConfig = new LocaisConfig();
	$locaisConfig->registerNewLocal($data_array);
	echo showMessages($locaisConfig);

}
elseif (!empty($_POST['busca_local']))
{	
	$locaisConfig = new LocaisConfig();
	$busca = $locaisConfig->buscaLocal($_POST['busca_local']);
	if($busca) echo $busca;
	else echo showMessages($locaisConfig);
} 
elseif (!empty($_POST['no'])) 
{
	$locaisConfig = new LocaisConfig();
	$locaisConfig->includeLocal($_POST['no']);
	echo showMessages($locaisConfig);
}
else
{
	echo "Dados inválidos.";
}




 ?>