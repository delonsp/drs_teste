<?php

/**
 * Class registration
 * handles the user registration
 */
class Registration
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
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$registration = new Registration();"
     */
    public function __construct()
    {
        if (isset($_POST["register"])) {
            $this->registerNewUser();
        }
    }

    /**
     * handles the entire registration process. checks all error possibilities
     * and creates a new user in the database if everything is fine
     */
    private function registerNewUser()
    {
        if($_POST['secret'] !== 'ferramentas') {
            $this->errors[] = "Palavra secreta vazia ou errada";
        } elseif (empty($_POST['user_name'])) {
            $this->errors[] = "Nome de usuário vazio";
        } elseif (empty($_POST['user_password_new']) || empty($_POST['user_password_repeat'])) {
            $this->errors[] = "Senha vazia";
        } elseif ($_POST['user_password_new'] !== $_POST['user_password_repeat']) {
            $this->errors[] = "A senha e a verificação de senha não coincidem";
        } elseif (strlen($_POST['user_password_new']) < 6) {
            $this->errors[] = "Senha tem menos de 6 caracteres";
        } elseif (strlen($_POST['user_name']) > 64 || strlen($_POST['user_name']) < 2) {
            $this->errors[] = "Nome de usuário não pode ter menos de 2 ou mais de 64 caracteres";
        } elseif (!preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name'])) {
            $this->errors[] = "Nome de usuário não está conforme o padronizado: apenas a-Z ou números são permitidos, de 2 a 64 caracteres";
        } elseif (empty($_POST['user_email'])) {
            $this->errors[] = "Email não pode ser vazio";
        } elseif (strlen($_POST['user_email']) > 64) {
            $this->errors[] = "Email não pode ser maior que 64 caracteres";
        } elseif (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "O seu email não está em um formato válido";
        } elseif (!empty($_POST['user_name'])
            && strlen($_POST['user_name']) <= 64
            && strlen($_POST['user_name']) >= 2
            && preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name'])
            && !empty($_POST['user_email'])
            && strlen($_POST['user_email']) <= 64
            && filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)
            && !empty($_POST['user_password_new'])
            && !empty($_POST['user_password_repeat'])
            && ($_POST['user_password_new'] === $_POST['user_password_repeat'])
        ) {
            // create a database connection
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            // change character set to utf8 and check it
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            // if no connection errors (= working database connection)
            if (!$this->db_connection->connect_errno) {

                // escaping, additionally removing everything that could be (html/javascript-) code
                $user_name = $this->db_connection->real_escape_string(strip_tags($_POST['user_name'], ENT_QUOTES));
                $user_email = $this->db_connection->real_escape_string(strip_tags($_POST['user_email'], ENT_QUOTES));

                $user_password = $_POST['user_password_new'];

                // crypt the user's password with PHP 5.5's password_hash() function, results in a 60 character
                // hash string. the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using
                // PHP 5.3/5.4, by the password hashing compatibility library
                $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);

                // check if user or email address already exists
                $sql = "SELECT * FROM users WHERE user_name = '" . $user_name . "' OR user_email = '" . $user_email . "';";
                $query_check_user_name = $this->db_connection->query($sql);

                if ($query_check_user_name->num_rows == 1) {
                    $this->errors[] = "Desculpe, mas este nome de usuário / email já foi usado.";
                } else {
                    // write new user's data into database
                    $sql = "INSERT INTO users (user_name, user_password_hash, user_email)
                            VALUES('" . $user_name . "', '" . $user_password_hash . "', '" . $user_email . "');";
                    $query_new_user_insert = $this->db_connection->query($sql);

                    // if user has been added successfully
                    if ($query_new_user_insert) {
                        $this->messages[] = "Sua conta foi criada com sucesso. Você pode agora efetuar login.";
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
