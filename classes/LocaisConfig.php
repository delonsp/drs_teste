<?php

/**
 * Class locaisConfig
 * handles the user work places registration
 */

require_once("config/config.php");
session_start();

class LocaisConfig
{
    /**
     * @var object $db_connection The database connection
     */
    protected $db_connection = null;
    /**
     * @var array $errors Collection of error messages
     */
    public $errors = array();
    /**
     * @var array $messages Collection of success / neutral messages
     */
    public $messages = array();

    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$registration = new Registration();"
     */
    public function __construct()
    {
         $this->db_connect();
    }

    /**
     * handles the entire registration process. checks all error possibilities
     * and creates a new user in the database if everything is fine
     */
    
     protected function db_connect() {

    	$this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        // change character set to utf8 and check it
        if (!$this->db_connection->set_charset("utf8")) {
            $this->errors[] = $this->db_connection->error;
        }

        
    }




    public function registerNewLocal($data_array)
    {

    	// escaping, additionally removing everything that could be (html/javascript-) code
        $data_array = array_map(array($this->db_connection, 'real_escape_string'), $data_array);
       
        $consolidado = $data_array['nome_local'].". ".$data_array['end_local']." | tel: ".$data_array['tel_local'];

        // insert new data into noscomios table
        $sql1 = "INSERT INTO `nosocomios` (local, codigo) VALUES ('$consolidado', '{$data_array['codigo_local']}')";

        $query_insert_into_nosocomios = $this->db_connection->query($sql1);
        
        // if no connection errors (= working database connection)
        if (!$this->db_connection->connect_errno) {

            if ($query_insert_into_nosocomios) {
            	// insert new data into users_nosocomios

                $nosocomio_id = $this->db_connection->insert_id;
                $sql2 = "INSERT INTO `users_nosocomios` (usuario_id, nosocomio_id) VALUES ('{$_SESSION['user_id']}','$nosocomio_id')";
                $query_insert_into_users_nosocomios = $this->db_connection->query($sql2);

                // if user has been added successfully
                if ($query_insert_into_users_nosocomios) {
                    $this->messages[] = "Seus registros foram inseridos com sucesso.";
                } else {
                    $this->errors[] = "Desculpe, seu registro falhou. Por favor retorne e tente novamente.";
                    $this->errors[] = $this->db_connection->error;
                }
                
            } else {
                $this->errors[] = "Desculpe, houve erro na inserção de dados na tabela de nosocomios.";
                $this->errors[] = $this->db_connection->error;
            }
        } else {
            $this->errors[] = "Desculpe, sem conexão com o banco de dados. Favor checar conexão de internet.";
            $this->errors[] = $this->db_connection->error;
        }
    }
    public function buscaLocal($local)
    {
    	$local = $this->db_connection->real_escape_string($local);
    	$sql = "SELECT * FROM `nosocomios` WHERE `local` LIKE '%$local%'";
    	$query_busca_local = $this->db_connection->query($sql);
    	$aviso1 = "Foram encontrados os seguintes locais correspondentes a palavra chave inserida:";
		$aviso2 = "Nome do Local: ";
		$row1 = "local";
		$row2 = "codigo";
		$mensagem = "";

    	// if no connection errors (= working database connection)
        if (!$this->db_connection->connect_errno) {
        	if($query_busca_local && $query_busca_local->num_rows>=1) {

        		$mensagem .= "<div class='alert alert-success'><h4>{$aviso1}</h4></div>";

        		while ($data_row = $query_busca_local->fetch_assoc()) {
        			$mensagem .= '<div class="modalDiv">';
        			$mensagem .= "<p>$aviso2".$data_row[$row1]."</p>";
        			$mensagem .= "<p>Código: ".$data_row[$row2]."</p>";
        			$mensagem .= '<button class="btn btn-warning btn-lg" id="'.$data_row['id'].'">Usar este local</button>'."</p>";
        			$mensagem .= "</div><hr/>";
        		}
        		return $mensagem;
        	} else {
        		$this->errors[] = "Desculpe, não achei nenhum registro correspondente a sua busca.";
        		return null;
        	}
        } else {
        	 $this->errors[] = "Desculpe, sem conexão com o banco de dados. Favor checar conexão de internet.";
        	 return null;
        }
    }

    public function includeLocal($nosocomio_id) 
    {

    	// if no connection errors (= working database connection)
        if (!$this->db_connection->connect_errno) {

        	$sql2 = "SELECT * FROM `users_nosocomios` WHERE `usuario_id` = '{$_SESSION['user_id']}' AND `nosocomio_id`= 
                		'$nosocomio_id'";
                $query_busca_registro_duplicado = $this->db_connection->query($sql2);
                
                if ($query_busca_registro_duplicado && $query_busca_registro_duplicado->num_rows>0) {
        		
        			$this->errors[] = "Este registro de local já consta no seu banco de dados.";
        		
        		} else {


        			$query = "INSERT INTO `users_nosocomios` (usuario_id, nosocomio_id) VALUES ('{$_SESSION['user_id']}','$nosocomio_id')";
		        	$query_insert_into_users_nosocomios = $this->db_connection->query($query);

		            if ($query_insert_into_users_nosocomios) {
		            	// insert new data into users_nosocomios

		               	$this->messages[] = "Seus registro foi incluído com sucesso.";
		                               
		            } else {
		                $this->errors[] = "Desculpe, houve erro na inserção de dados na tabela de nosocomios.";
		            }

		        }		

        } else {
            $this->errors[] = "Desculpe, sem conexão com o banco de dados. Favor checar conexão de internet.";
        }


    }
        
}
