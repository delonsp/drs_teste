<?php 
session_start();
$_SESSION['cidade'] = (isset($_POST['city']) ? $_POST['city'] : "unknown"); 