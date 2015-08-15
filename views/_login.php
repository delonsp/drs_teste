<?php 
    
    $pageTitle="login";

    function customPageHeader() { ?>

    <?php }

    include_once("views/_header.php");

?>
	<div id="contact" class="contact_page">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-3">
                    <h2 class="section_header2">Login de Usuário</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-3">
                    <?php 

                        // show potential errors / feedback (from login object)
                        if (isset($login)) {
                            if ($login->errors) {
                                echo '<div class="alert alert-danger" style="text-align:center;">';
                                foreach ($login->errors as $error) {
                                    echo "<h4>$error</h4>";
                                }
                                echo '</div>';
                            }
                            if ($login->messages) {

                                echo '<div class="alert alert-info" style="text-align:center;">';
                                foreach ($login->messages as $message) {
                                    echo "<h4>$message</h4>";
                                }
                                
                                echo '</div>';   
                            }
                        }


                    ?>
                </div>
            </div>
        	<div class="row form">
             	<div class="col-md-6 col-md-offset-3">
                    <fieldset>
                        <form class="form-horizontal" method="post" name="loginform" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>">
                            <div class="form-group">
                                <label for="user_name" class="control-label col-sm-2"><?php echo WORDING_USERNAME; ?></label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control login_input" id="user_name" name="user_name" required  autofocus />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="user_password" class="control-label col-sm-2"><?php echo WORDING_PASSWORD; ?></label>
                                <div class="col-sm-4">
                                    <input type="password" class="form-control login_input" id="user_password" name="user_password" autocomplete="off" required />
                                </div>
                            </div>
                            <div class="checkbox">
                                <label class="col-sm-offset-2">
                                    <input type="checkbox" id="user_rememberme" name="user_rememberme" value="1" />
                                    <?php echo WORDING_REMEMBER_ME; ?>
                                </label>
                            </div>
                            <div class="form-group">
                                 <label for="login" class="control-label col-sm-2"></label>
                                <div class="col-sm-4">
                                    <input type="submit" value="Entrar" class="btn btn-info btn-lg btn-login" name="login"/>
                                     <a href="?password_reset" class="btn btn-danger btn-lg btn-login"><?php echo WORDING_FORGOT_MY_PASSWORD; ?></a>
                </div>
                                </div>
                            </div>
                             
                        </form>
                    </fieldset>
                   
        	</div>
    	</div>
    </div>
    <?php include_once("views/_footer.php"); ?>





<!-- <form class="form-horizontal" method="post" name="loginform" action="index.php">
                        <div class="form-group">
                            <label for="login_input_username" class="control-label col-sm-4">Usuário:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control login_input" id="login_input_username" name="user_name" id="login" required  />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="login_input_password" class="control-label col-sm-4">Senha:</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control login_input" id="login_input_password" name="user_password" autocomplete="off" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-4">
                                <input type="submit" value="Entrar" class="btn btn-info btn-lg" name="login"/>
                            </div>
                        </div>
                         
                    </form> -->



