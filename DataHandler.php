<?php 
require_once('classes/DataTasks.php');
require_once('config/connectMedic.php');

function showMessages($dataTask) {

	$mensagens="";

	if ($dataTask->messages) {
		$mensagens .= implode("\n",$dataTask->messages);
		$div1 = '<div class="alert alert-success"><h4>';
		$div2 = '</h4></div>';
		$mensagens = $div1 . $mensagens . $div2;
	}
	if ($dataTask->errors) {
		$mensagens .= implode("\n", $dataTask->errors);
		$div1 = '<div class="alert alert-danger"><h4>';
		$div2 = '</h4></div>';
		$mensagens = $div1 . $mensagens . $div2;
	}
	return $mensagens;
}

if (isset($_POST['no']) && !empty($_POST['no']) &&
	isset($_POST['tabela']) && !empty($_POST['tabela']))
{
	$id = $_POST['no'];
	$tabela = $_POST['tabela'];

	$dataTask = new DataTasks();

	// retorna um JSON 
	if ($json = $dataTask->capturaDados($id, $tabela)) echo $json;
	else echo showMessages($dataTask); 

}

// nomeDaReceita:Teste300
// nomeDaDoenca:Teste300
// textoReceita:Teste
// man:0

elseif (isset($_POST['nomeDaReceita']) && !empty($_POST['nomeDaReceita']) &&
    isset($_POST['nomeDaDoenca']) && !empty($_POST['nomeDaDoenca']) &&
    isset($_POST['textoReceita']) && !empty($_POST['textoReceita']) &&
    isset($_POST['man']) && !isset($_POST['no'])) 
{


	$dataTask = new DataTasks();
	$data_array = array("$doencaDB" => $_POST['nomeDaDoenca'],
    				"$man" => $_POST['man'],
    				"$nomeDaReceitaDB" => $_POST['nomeDaReceita'],
    				"$descricaoDB" => $_POST['textoReceita']
    				);
	 // insere dados e mensagens vão para as propriedades de classe
	$dataTask->insereDados($data_array, $tabelaReceitas);
	echo showMessages($dataTask);

}

elseif (isset($_POST['nomeDoExame']) && !empty($_POST['nomeDoExame']) &&
            isset($_POST['descricao']) && !empty($_POST['descricao']) 
			&& !isset($_POST['no']) )
{


	$dataTask = new DataTasks();

	$data_array = array("$nomeDB" => $_POST['nomeDoExame'],
                   "$descricaoDB" => $_POST['descricao']  );

	// insere dados e mensagens vão para as propriedades de classe
	$dataTask->insereDados($data_array, $tabelaExames);
	echo showMessages($dataTask);


}


elseif( isset($_POST['nomeDaReceita']) && !empty($_POST['nomeDaReceita']) &&
    isset($_POST['nomeDaDoenca']) && !empty($_POST['nomeDaDoenca']) &&
    isset($_POST['textoReceita']) && !empty($_POST['textoReceita']) &&
    isset($_POST['usuario_id']) && !empty($_POST['usuario_id']) &&
    isset($_POST['man']) &&
    isset($_POST['no']) && !empty($_POST['no'])) 
{

	$dataTask = new DataTasks();

	$id = $_POST['no'];
	
	$data_array = ["nomeDaReceita" => $_POST['nomeDaReceita'],
					"doenca" => $_POST['nomeDaDoenca'],
					"descricao" => $_POST['textoReceita'],
					"man" => $_POST['man'] ];
	$usuario_id = $_POST['usuario_id'];

    // atualiza dados e mensagens vão para as propriedades de classe
    $dataTask->atualizaDados($id, $usuario_id, $data_array, $tabelaReceitas);
    echo showMessages($dataTask);

}

elseif (isset($_POST['nomeDoExame']) && !empty($_POST['nomeDoExame']) &&
            isset($_POST['descricao']) && !empty($_POST['descricao']) &&
            isset($_POST['no']) && !empty($_POST['no']))
{

	$dataTask = new DataTasks();

	$id = $_POST['no'];

	$data_array = ["nome" => $_POST['nomeDoExame'],
					"descricao" => $_POST['descricao'] ];
	$usuario_id = $_POST['usuario_id'];
					

	// atualiza dados e mensagens vão para as propriedades de classe
	$dataTask->atualizaDados($id, $usuario_id, $data_array, $tabelaExames);
	echo showMessages($dataTask);

}

elseif(isset($_POST['principio']) && !empty($_POST['principio'])) 
{
	$dataTask = new DataTasks();

	$tabela = $tabelaReceitas;

	$data_array = array('principio' => $_POST['principio'], 'man' => $_POST['man'] );

	if ($data = $dataTask->pesquisaDados($tabela, $data_array)) echo $data;
	else echo showMessages($dataTask);
	
}

elseif( isset($_POST['exame']) && !empty($_POST['exame']) )
{

	$dataTask = new DataTasks();

	$tabela = $tabelaExames;

	$data_array = array('exame' => $_POST['exame'] );

	if ($data = $dataTask->pesquisaDados($tabela, $data_array)) echo $data;
	else echo showMessages($dataTask);
}

else

{
	echo "<div class='alert alert-danger'>Dados inválidos. Favor tentar novamente</div>";
	//.print_r([$_POST]);

}

