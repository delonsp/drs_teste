<?php

/**
 * Class registration
 * handles the user config registration
 */
class RetrieveUserPlaces
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
     * @var array $nosocomios Collection of nosocomios_ids retrieved from User
     */
    public $nosocomios = array();
    /**
     * @var boolean $foundRecords if found config records is true
     */
    public $foundRecords = false;


    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$registration = new Registration();"
     */
    public function __construct()
    {
        
        $this->RetrieveUserPlaces();
        
    }

    /**
     * handles the entire registration process. checks all error possibilities
     * and creates a new user in the database if everything is fine
     */
    private function RetrieveUserPlaces()
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
            $sql = "SELECT `nosocomio_id` FROM users_nosocomios WHERE `usuario_id` = '" . $_SESSION['user_id'] . "';";
            $query_check_user_name = $this->db_connection->query($sql);

            if ($query_check_user_name && $query_check_user_name->num_rows >= 1) {
                $this->foundRecords = true;
                while($row = $query_check_user_name->fetch_assoc()) {

                	$this->nosocomios[] = $row['nosocomio_id'];
               
            	}
                $this->messages[] = "Dados de locais de atendimento de usuário obtidos com sucesso.";
            } else {
                $this->errors[] = "Não consegui achar dados de locais de atendimento do usuário.";
            }
        } else {
            $this->errors[] = "Desculpe, sem conexão com o banco de dados. Favor checar conexão de internet.";
        }
       
    }
}
