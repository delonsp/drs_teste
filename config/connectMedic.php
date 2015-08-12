<?php




// Nomes dos campos das tabelas
$nomeDaReceitaDB="nomeDaReceita";
$descricaoDB = "descricao";
$no = "id";
$localDB="local";
$logoDB="logo";
$nomeDB = "nome";
$doencaDB = "doenca";
$man = "man";
$usuarioID = "usuario_id";
$userEmail = "user_email";
$userPass = "user_password";
$usuario = "user_name";
$global = "global";

// Nomes das tabelas
$tabelaTISS = "nosocomios";
$tabelaReceitas = "medicamentos";
$tabelaExames = "exames";
$tabelaLogos = "logosConvenios";
//$tabelaUser = 'user_system';



function connect() {
	$DB = "drsoluti2";
	
	$con=mysqli_connect('localhost','not_root','not_root',$DB) or die(mysqli_connect_error());	
	mysqli_set_charset($con,'utf8');
	return $con;
}

function my_mysqli_result($res, $row, $field=0) { 
    $res->data_seek($row); 
    $datarow = $res->fetch_array(); 
    return $datarow[$field]; 
} 


function justTheName($aString) {
 $bArray = explode(".", $aString);
 $bString = $bArray[0];
 return $bString;
}


