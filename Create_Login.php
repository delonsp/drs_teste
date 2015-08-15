<?php 

require_once("config/connectMedic.php");

// include the configs / constants for the database connection
require_once("config/config.php");

// load the login class
require_once("classes/PHPLogin.php");

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process. in consequence, you can simply ...
$login = new PHPLogin();
