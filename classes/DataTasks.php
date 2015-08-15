<?php 

/**
 * Class DataTasks
 * handles data manipulation
 */


require_once("config/db.php");
session_start();

class DataTasks 
{

	/**
     * @var object $db_connection The database connection
     */
    private $db_connection = null;
    /**
     * @var array $errors Collection of error messages
     */
    public $errors = array();
    /**
     * @var array $messages Collection of success / neutral messages
     */
    public $messages = array();
    // Nomes dos campos das tabelas
    private $nomeDaReceitaDB="nomeDaReceita";
    private $descricaoDB = "descricao";
    private $no = "id";
    private $localDB="local";
    private $logoDB="logo";
    private $nomeDB = "nome";
    private $doencaDB = "doenca";
    private $man = "man";
    private $usuarioID = "usuario_id";
    private $userEmail = "user_email";
    private $userPass = "user_password";
    private $usuario = "user_name";
    private $global = "global";

    // Nomes das tabelas
    private $tabelaTISS = "nosocomios";
    private $tabelaReceitas = "medicamentos";
    private $tabelaExames = "exames";
    private $tabelaLogos = "logosConvenios";

    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * 
     */
    public function __construct()
    {
        $this->db_connect();
    }

    private function db_connect() {

    	$this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        // change character set to utf8 and check it
        if (!$this->db_connection->set_charset("utf8")) {
            $this->errors[] = $this->db_connection->error;
        }

        
    }

    public function atualizaDados($id, $usuario_id, $data_array, $tabela) {

    	$data_array = array_map(array($this->db_connection, 'real_escape_string'), $data_array);

        $atualiza = "";

        $numItems = count($data_array);
        $i = 0;
        foreach($data_array as $key=>$value) {
          if(++$i === $numItems) {
            $atualiza .= "`$key` = '$value'";
          } else {
            $atualiza .= "`$key` = '$value',";
          }
        }

        if ($usuario_id == '1') {
            $query="INSERT INTO $tabela SET $atualiza , `usuario_id` = '{$_SESSION['user_id']}'";
        } else {
            $query="UPDATE `$tabela` SET $atualiza WHERE `{$this->no}`='$id' LIMIT 1";
        }
        
    	if (!$this->db_connection->connect_errno) {

    		if($this->db_connection->query($query)) {

                $this->messages[] = "Dados atualizados no banco de dados com sucesso.<br>";
                if ($usuario_id == '1') {
                    $this->messages[] = "O registro original não foi modificado, por ser um registro global (acessível a todos os usuários do sistema). Porém foi feita uma
                    cópia do registro com as suas modificações no seu banco de dados particular.";
                }

    		} else {

    			$this->errors[] = "Ocorreu o erro abaixo na atualização dos dados. Favor tentar novamente.";
		      
		        $this->errors[] = $this->db_connection->error;
    		}
    	} else {
    		$this->errors[] = "Desculpe, sem conexão com o banco de dados. Favor checar conexão de internet..";
        	
    	}
    	

    }

    public function capturaDados($id, $tabela) {


    	$id = $this->db_connection->real_escape_string($id);
    	$tabela = $this->db_connection->real_escape_string($tabela);

    	$query = "SELECT  * FROM  `$tabela` WHERE `{$this->no}`='$id'";

    	// if no connection errors (= working database connection)
        if (!$this->db_connection->connect_errno) {

        	$data_retrieve = $this->db_connection->query($query);
        	if ($data_retrieve && $data_retrieve->num_rows == 1) {
        		$result_row = $data_retrieve->fetch_assoc();
        		return json_encode($result_row);
        	} else {
        		$this->errors[] = "Desculpe, não achei registros no banco de dados.";
                return null;
        	}

        } else {
        	$this->errors[] = "Desculpe, sem conexão com o banco de dados. Favor checar conexão de internet.";
        	return null;
        }

    }

    public function pesquisaDados($tabela, $data_array) {

    	$data_array = array_map(array($this->db_connection, 'real_escape_string'), $data_array);

		$mensagem="";

    	if ($tabela == $this->tabelaReceitas) {
    		$query = "SELECT * FROM `$tabela` WHERE `{$this->man}` ='{$data_array['man']}'
                        AND (`{$this->descricaoDB}` LIKE '%{$data_array['principio']}%' 
    					OR `{$this->nomeDaReceitaDB}` LIKE '%{$data_array['principio']}%')
    					ORDER BY `{$this->nomeDaReceitaDB}`;";
			$aviso1 = "Foram encontradas as seguintes receitas cuja composição inclui o mesmo principio ativo:";
			$aviso2 = "Nome da Receita:";
			$row1 = "nomeDaReceita";
			$row2 = "descricao";

    	} else {
    		$query = "SELECT * FROM `$tabela` WHERE `{$this->descricaoDB}` LIKE '%{$data_array['exame']}%' 
    					OR `{$this->nomeDB}` LIKE '%{$data_array['exame']}%' 
                        ORDER BY `{$this->nomeDB}` ";
			$aviso1 = "Foram encontradas os seguintes exames que incluem a palavra chave inserida:";
			$aviso2 = "Nome do Exame:";
			$row1 = "nome";
			$row2 = "descricao";

    	}

    	// if no connection errors (= working database connection)
        if (!$this->db_connection->connect_errno) {

        	$data_retrieve = $this->db_connection->query($query);
        	if ($data_retrieve && $data_retrieve->num_rows >= 1) {

        		$mensagem .= "<div class='alert alert-success'><h4>{$aviso1}</h4></div>";

        		while ($data_row = $data_retrieve->fetch_assoc()) {
        			$mensagem .= '<div class="modalDiv">';
                    if ($data_row['usuario_id'] == '1') {
                        $mensagem .= "<span style='color:red;'>(registro global)</span>";
                    }
        			$mensagem .= "<p>$aviso2".$data_row[$row1]."</p>";
        			$mensagem .= "<p>Descricao: "."<pre>".$data_row[$row2]."</pre>";
                    if ($data_row['usuario_id'] == '1') {
                        $mensagem .= '<button class="btn btn-info btn-lg" id="'.$data_row['id'].'">Fazer Cópia</button>'."</p>";
                    } else {
                        $mensagem .= '<button class="btn btn-warning btn-lg" id="'.$data_row['id'].'">Editar</button>'."</p>";
                    }
        			
        			$mensagem .= "</div><hr/>";
        		}
        		return $mensagem;

        	} else {
        		$this->errors[] = "Desculpe, não achei registros no banco de dados.";
        		return null;
        	}

        } else {
        	$this->errors[] = "Desculpe, sem conexão com o banco de dados. Favor checar conexão de internet.";
        	return null;
        }
  	
    }

    public function insereDados($data_array, $tabela) {

    	$data_array = array_map(array($this->db_connection, 'real_escape_string'), $data_array);
        $data_array['usuario_id'] = $_SESSION['user_id'];

    	$fields_sql = '`'.implode('`, `', array_keys($data_array)).'`';
	    $values_sql = '\''.implode('\', \'', $data_array).'\'';
	    

	    $query = "INSERT INTO `$tabela` ($fields_sql) VALUES ($values_sql)";

      
    	// if no connection errors (= working database connection)
        if (!$this->db_connection->connect_errno) {

        	if ($this->db_connection->query($query)) {
		    	$this->messages[] = "Dados inseridos no banco de dados com sucesso.";
		    } else {
		        
		        $this->errors[] = "Ocorreu o erro abaixo na inserção dos dados. Favor tentar novamente.";
		      
		        $this->errors[] = $this->db_connection->error;
		    }

        } else {
        	$this->errors[] = "Desculpe, sem conexão com o banco de dados. Favor checar conexão de internet.";
        }
    }




}
