<?php

/**
 * Class registration
 * handles the user config registration
 */
class RetrieveUserConfig
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
     * @var boolean $foundRecords if found config records is true
     */
    public $foundRecords = false;

    /**
     * @var string $primeiro_nome, $nome_meio, $ultimo_nome, $crm and $titulo -> configuration data for the user
     */

    public $primeiro_nome = "";
    public $nome_meio = "";
    public $ultimo_nome = "";
    public $crm = "";
    public $titulo = "";
    public $config_pharma = 0;


    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$registration = new Registration();"
     */
    public function __construct()
    {
        
        $this->RetrieveUserConfig();
        
    }

    /**
     * handles the entire registration process. checks all error possibilities
     * and creates a new user in the database if everything is fine
     */
    private function RetrieveUserConfig()
    {
                
        // create a database connection
        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        // change character set to utf8 and check it
        if (!$this->db_connection->set_charset("utf8")) {
            $this->errors[] = $this->db_connection->error;
        }

        // if no connection errors (= working database connection)
        if (!$this->db_connection->connect_errno) {

            
            // check if user or email address already exists
            $sql = "SELECT * FROM UserConfig WHERE usuario_id = '" . $_SESSION['user_id'] . "';";
            $query_check_user_name = $this->db_connection->query($sql);

            if ($query_check_user_name->num_rows == 1) {
                $this->foundRecords = true;
                $row = $query_check_user_name->fetch_assoc();

                $this->primeiro_nome = $row['primeiro_nome'];
                $this->nome_meio = $row['nome_meio'];
                $this->ultimo_nome = $row['ultimo_nome'];
                $this->crm = $row['CRM'];
                $this->titulo = $row['titulo'] ;
                $this->config_pharma = $row['config_pharma'];
                $this->messages[] = "Dados de configuração de usuário obtidos com sucesso.";
            } else {
                $this->errors[] = "Não consegui achar dados de configuração do usuário.";
            }
        } else {
            $this->errors[] = "Desculpe, sem conexão com o banco de dados. Favor checar conexão de internet.";
        }
       
    }
}
