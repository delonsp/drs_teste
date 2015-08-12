<?php 
    
    $pageTitle="login";

    function customPageHeader() { ?>

    <?php }

    include_once("header.php");

?>
	<div id="contact" class="contact_page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="section_header2">Login de Usuário</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-md-offset4">
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
             	<div class="col-md-6">
                    <form class="form-horizontal" method="post" name="loginform" action="index.php">
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
                         
                    </form>
                </div>
        	</div>
    	</div>
    </div>
    <?php include_once("footer.php"); ?>


