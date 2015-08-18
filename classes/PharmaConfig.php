<?php

/**
 * Class locaisConfig
 * handles the user work places registration
 */
session_start();
require_once("config/config.php");
require_once("classes/LocaisConfig.php");


class PharmaConfig extends LocaisConfig
{
    

    public function registerNewPharma($data_array)
    {

    	// escaping, additionally removing everything that could be (html/javascript-) code
        $data_array = array_map(array($this->db_connection, 'real_escape_string'), $data_array);

        $data_array['enviar_email'] = ($data_array['enviar_email'] == "true" ? 1 : 0);

        $emails_array = explode(',', $data_array['emails']);

        $emails_array = array_map('trim', $emails_array);

        $data_array['emails'] = implode(",", $emails_array);

        $false_email= false;

        foreach ($emails_array as $email) {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $false_email = true;
        }

       
        if ($false_email) {
            $this->errors[] = "Um ou mais emails não estão em um formato válido, favor tentar novamente. Não se esqueça de separar os emails por vírgulas";
        } else {
            // insert new data into noscomios table
            $sql1 = "INSERT INTO `PharmaConfig` (nome, emails) VALUES ('{$data_array['nome']}', '{$data_array['emails']}');";

            $query_insert_into_pharmaconfig = $this->db_connection->query($sql1);
            
            // if no connection errors (= working database connection)
            if (!$this->db_connection->connect_errno) {

                if ($query_insert_into_pharmaconfig) {
                    // insert new data into users_nosocomios

                    $pharma_id = $this->db_connection->insert_id;
                    $sql2 = "INSERT INTO `users_pharmas` (usuario_id, pharma_id, enviar_email) VALUES ('{$_SESSION['user_id']}','$pharma_id', '{$data_array['enviar_email']}')";

                    $query_insert_into_users_pharmaconfig = $this->db_connection->query($sql2);

                    // if user has been added successfully
                    if ($query_insert_into_users_pharmaconfig) {
                        $this->messages[] = "Seus registros foram inseridos com sucesso.";

                        $sql3 = "UPDATE `userConfig` SET `config_pharma` = '1' WHERE `id`= '{$_SESSION['user_id']}'";
                        $query_update_userConfig = $this->db_connection->query($sql3);
                    } else {
                        $this->errors[] = "Desculpe, seu registro falhou. Por favor retorne e tente novamente.";
                    }
                    
                } else {
                    $this->errors[] = "Desculpe, houve erro na inserção de dados na tabela de farmácias.";
                }
            } else {
                $this->errors[] = "Desculpe, sem conexão com o banco de dados. Favor checar conexão de internet.";
            }
        }
        
    }
    public function buscaPharma($busca_pharma) //
    {
    	$busca_pharma = $this->db_connection->real_escape_string($busca_pharma);
    	$sql = "SELECT * FROM `PharmaConfig` WHERE `nome` LIKE '%$busca_pharma%'";
    	$query_busca_local = $this->db_connection->query($sql);
    	$aviso1 = "Foram encontrados as seguintes farmácias correspondentes a palavra chave inserida:";
		$aviso2 = "Nome do Local: ";
		$row1 = "nome";
		$mensagem = "";

    	// if no connection errors (= working database connection)
        if (!$this->db_connection->connect_errno) {
        	if($query_busca_local && $query_busca_local->num_rows>=1) {

        		$mensagem .= "<div class='alert alert-success'><h4>{$aviso1}</h4></div>";

        		while ($data_row = $query_busca_local->fetch_assoc()) {
        			$mensagem .= '<div class="modalDiv">';
        			$mensagem .= "<p>$aviso2".$data_row[$row1]."</p>";
        			$mensagem .= '<button class="btn btn-warning" id="'.$data_row['id'].'">Usar esta farmácia</button>'."</p>";
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

    public function includePharma($pharma_id)  //
    {

    	// if no connection errors (= working database connection)
        if (!$this->db_connection->connect_errno) {

        	$sql2 = "SELECT * FROM `users_pharmas` WHERE `usuario_id` = '{$_SESSION['user_id']}' AND `pharma_id`= 
                		'$pharma_id'";
                $query_busca_registro_duplicado = $this->db_connection->query($sql2);
                
                if ($query_busca_registro_duplicado && $query_busca_registro_duplicado->num_rows>0) {
        		
        			$this->errors[] = "Este registro de farmácia já consta no seu banco de dados.";
        		
        		} else {


        			$query = "INSERT INTO `users_pharmas` (usuario_id, pharma_id, enviar_email) VALUES ('{$_SESSION['user_id']}','$pharma_id', '1')";
		        	$query_insert_into_users_pharmas = $this->db_connection->query($query);

		            if ($query_insert_into_users_pharmas) {
		            	// insert new data into users_nosocomios

		               	$this->messages[] = "Seus registro foi incluído com sucesso.";
		                               
		            } else {
		                $this->errors[] = "Desculpe, houve erro na inserção de dados na tabela de farmácias.";
		            }

		        }		

        } else {
            $this->errors[] = "Desculpe, sem conexão com o banco de dados. Favor checar conexão de internet.";
        }


    }
        
}
