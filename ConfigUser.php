<?php

require_once("Create_Login.php");

// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {
    // the user is logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are logged in" view.
    // include the configs / constants for the database connection
	require_once("config/db.php");

	// load the User Config class
	require_once("classes/UserConfig.php");

	// create the UserConfig object. when this object is created, it will do all User Config stuff automatically
	// so this single line handles the entire configuration process.
	$userconfig = new UserConfig();

	// show the register view (with the registration form, and messages/errors)
	include("views/_ConfigUser.php");

} else {
    // the user is not logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are not logged in" view.
    include("views/_login.php");
}
