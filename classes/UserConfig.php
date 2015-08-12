<?php

/**
 * Class registration
 * handles the user config registration
 */
class UserConfig
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
    /**
     * @var string $primeiro_nome, $nome_do_meio, $ultimo_nome, $titulo
     */
    public $primeiro_nome ="";
    public $nome_meio="";
    public $ultimo_nome="";
    public $titulo="";
    public $crm="";
    public $config_pharma=0;


    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$registration = new Registration();"
     */
    public function __construct()
    {
        if (isset($_POST["register"])) {
            $this->configUser();
        }
    }

    /**
     * handles the entire configuration process. checks all error possibilities
     * and creates a new user configuration in the database if everything is fine
     */
    private function configUser()
    {
        if (empty($_POST['primeiro_nome'])) {
            $this->errors[] = "Primeiro Nome Vazio";
        } elseif (empty($_POST['ultimo_nome'])) {
            $this->errors[] = "Último nome vazio";
        } elseif (empty($_POST['titulo'])) {
            $this->errors[] = "Não especificou título ou credenciais";
        } elseif (empty($_POST['crm'])) {
            $this->errors[] = "Não especificou CRM";
        } elseif (!empty($_POST['primeiro_nome'])
            && !empty($_POST['ultimo_nome'])
            && !empty($_POST['titulo'])
            && !empty($_POST['crm']))
        {
            // create a database connection
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            // change character set to utf8 and check it
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            // if no connection errors (= working database connection)
            if (!$this->db_connection->connect_errno) {

                // escaping, additionally removing everything that could be (html/javascript-) code
                $this->primeiro_nome = $this->db_connection->real_escape_string(strip_tags($_POST['primeiro_nome'], ENT_QUOTES));
               
                    $this->nome_meio = $this->db_connection->real_escape_string(strip_tags($_POST['nome_meio'], ENT_QUOTES));
                
                   
                $this->ultimo_nome = $this->db_connection->real_escape_string(strip_tags($_POST['ultimo_nome'], ENT_QUOTES));
                $this->titulo = $this->db_connection->real_escape_string(strip_tags($_POST['titulo'], ENT_QUOTES));
                $this->crm = $this->db_connection->real_escape_string(strip_tags($_POST['crm'], ENT_QUOTES));

                $this->config_pharma = (isset($_POST['config_pharma']) ? $_POST['config_pharma'] : 0 );
                $this->config_pharma = ($_POST['config_pharma'] == "on" ? 1 : 0 );  

                // check if user or email address already exists
                $sql = "SELECT * FROM UserConfig WHERE usuario_id = '" . $_SESSION['user_id'] . "';";
                $query_check_user_name = $this->db_connection->query($sql);

                if ($query_check_user_name->num_rows == 1) {

                    
                    // update no banco de dados

                    $sql = "UPDATE UserConfig SET primeiro_nome = '". $this->primeiro_nome ."', nome_meio = '" .
                                     $this->nome_meio . "', ultimo_nome = '" . $this->ultimo_nome . "', titulo = '".
                                     $this->titulo ."', crm = '" . $this->crm . "', config_pharma = '" . $this->config_pharma .
                                      "' WHERE usuario_id = " .
                                     $_SESSION['user_id'] .";";
                    $query_user_config_update = $this->db_connection->query($sql);

                    // if user has been updated successfully
                    if ($query_user_config_update) {
                        $this->titulo = $_POST['titulo'];
                        $_SESSION['primeiro_nome'] = $this->primeiro_nome;
                        $_SESSION['nome_meio'] = $this->nome_meio;
                        $_SESSION['ultimo_nome'] = $this->ultimo_nome;
                        $_SESSION['crm'] = $this->crm;
                        $_SESSION['titulo'] = $this->titulo;
                        $_SESSION['config_pharma'] = $this->config_pharma;
                        $this->messages[] = "Configuração de usuário atualizada com sucesso";
                    } else {
                        $this->errors[] = "Desculpe, sua atualização falhou. Por favor retorne e tente novamente.";
                    }   

                } else {
                    // write new user's data into database
                    $sql = "INSERT INTO UserConfig (primeiro_nome, nome_meio, ultimo_nome, crm, titulo, config_pharma, usuario_id)
                            VALUES('" . $this->primeiro_nome . "', '" . $this->nome_meio . "', '" . $this->ultimo_nome .  "', '" .
                                    $this->crm . "', '" . $this->titulo . "', '" . $this->config_pharma . "', '" . $_SESSION['user_id'] . "');";
                    $query_user_config_insert = $this->db_connection->query($sql);

                    // if user has been added successfully
                    if ($query_user_config_insert) {
                        $this->titulo = $_POST['titulo'];
                        $_SESSION['primeiro_nome'] = $this->primeiro_nome;
                        $_SESSION['nome_meio'] = $this->nome_meio;
                        $_SESSION['ultimo_nome'] = $this->ultimo_nome;
                        $_SESSION['crm'] = $this->crm;
                        $_SESSION['titulo'] = $this->titulo;
                        $_SESSION['config_pharma'] = $this->config_pharma;
                        $this->messages[] = "Configuração de usuário criada com sucesso";
                    } else {
                        $this->errors[] = "Desculpe, seu registro falhou. Por favor retorne e tente novamente.";
                    }
                }
            } else {
                $this->errors[] = "Desculpe, sem conexão com o banco de dados. Favor checar conexão de internet.";
            }
        } else {
            $this->errors[] = "Aconteceu um erro desconhecido";
        }
    }
}
