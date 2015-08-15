<?php 

    $pageTitle="Reconfiguração de Senha";

    function customPageHeader() { ?>

    <?php }

    include_once("views/_header.php");

    
?>
<script src="js/jquery-1.11.3.min.js"></script>
<div id="password_reset" class="contact_page">
        <div class="container">
            <h2 class="section_header2">Esqueci a senha</h2>
        	<div class="row form">
             	<div class="col-md-6 col-md-offset-3">
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
                                echo '<script type="text/javascript">

                                    $(function() {
                                        $(".form-horizontal").hide();
                                        $("a:not([href=\'index.php\']").hide();
                                    });


                                    </script>';   
                            }
                        }

                    ?>
                </div>
            </div>
             <div class="row">
            	<div class="col-md-6 col-md-offset-3">
            		<fieldset>
					<legend><?php echo WORDING_FORGOT_MY_PASSWORD; ?></legend>
						<form method="post" action="?password_reset">
							<label for="user_name"><?php echo WORDING_REQUEST_PASSWORD_RESET; ?></label>
							<input id="user_name" type="text" name="user_name" required autofocus />
							<input type="submit" name="request_password_reset" value="<?php echo WORDING_RESET_PASSWORD; ?>" />
						</form>
					</fieldset><br/>
					<a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>"><?php echo WORDING_BACK_TO_LOGIN; ?></a>
            	</div>
        	 </div>
    	</div>
</div>
<?php include_once("views/_footer.php"); ?>


