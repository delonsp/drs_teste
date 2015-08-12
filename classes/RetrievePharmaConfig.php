<?php

/**
 * Class registration
 * handles the user config registration
 */
class RetrievePharmaConfig
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
     * @var array $array_pharmas Two dimensions array with pharmacies configuration for a particular user
     */
    public $array_pharmas = array();

    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$registration = new Registration();"
     */
    public function __construct()
    {
        
        $this->RetrievePharmaConfig();
        
    }

    /**
     * handles the entire registration process. checks all error possibilities
     * and creates a new user in the database if everything is fine
     */
    private function RetrievePharmaConfig()
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
            $sql = "SELECT * FROM users_pharmas WHERE usuario_id = '" . $_SESSION['user_id'] . "';";
            $query_check_pharma_config = $this->db_connection->query($sql);

            if ($query_check_pharma_config->num_rows >= 1) {
                $this->foundRecords = true;


                while($row = $query_check_pharma_config->fetch_assoc()) {

                    $sql2 = "SELECT * FROM pharmaConfig WHERE id = '{$row['pharma_id']}'";
                    $query_check_pharma_config2 = $this->db_connection->query($sql2);
                    $row2 = $query_check_pharma_config2->fetch_assoc();  

                	$this->array_pharmas[] = array("id"=>$row['pharma_id'], "nome"=>$row2['nome'], "emails"=>$row2['emails'],
                        "enviar_email"=>$row['enviar_email']);
                	

                }

                
                $this->messages[] = "Dados de configuração de farmácias obtidos com sucesso.";
            } else {
                // search the DB to see if user doesn't want to configure pharmacies
                $this->errors[] = "Não consegui achar dados de configuração de farmácias.";
            }
        } else {
            $this->errors[] = "Desculpe, sem conexão com o banco de dados. Favor checar conexão de internet.";
        }
       
    }
}
