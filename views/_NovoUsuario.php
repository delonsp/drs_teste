<?php 

    $pageTitle="Novo Usuário";

    function customPageHeader() { ?>

    <?php }

    include_once("header.php");

    
?>
<script src="js/jquery-1.11.3.min.js"></script>
<div id="contact" class="contact_page">
        <div class="container">
            <h2 class="section_header2">Novo Usuário</h2>
        	<div class="row form">
             	<div class="col-md-6">
                    <?php 

						// show potential errors / feedback (from registration object)
							if (isset($registration)) {
							    if ($registration->errors) {
							    	echo '<div class="alert alert-danger" style="text-align:center;">';
							        foreach ($registration->errors as $error) {
							            echo "<h4>$error</h4><br/>";
							        }
							        echo '</div>';
							    }
							    if ($registration->messages) {
							    	echo '<div class="alert alert-info" style="text-align:center;">';
							        foreach ($registration->messages as $message) {
							            echo "<h4>$message</h4><br/>";
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
                    <form class="form-horizontal" method="post" name="registerform" action="NovoUsuario.php">
                        <div class="form-group">
                    	   	<label for="login_input_username" class="control-label col-sm-4">Nome de usuário (apenas letras e números, 2 a 64 caracteres)</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control login_input" id="login_input_username" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required  />
                            </div>
                        </div>
                        <div class="form-group">
                    	   	<label for="login_input_email" class="control-label col-sm-4">Email</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control login_input" id="login_input_email" name="user_email" required  />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="login_input_password_new" class="control-label col-sm-4">Senha (mínimo de 6 caracteres)</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control login_input" id="login_input_password_new" name="user_password_new"  pattern=".{6,}" autocomplete="off" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="login_input_password_repeat" class="control-label col-sm-4">Repetir Senha</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control login_input" id="login_input_password_repeat" name="user_password_repeat"  pattern=".{6,}" autocomplete="off" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="login_input_secret" class="control-label col-sm-4">Palavra Secreta</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control login_input" id="login_input_secret" name="secret" autocomplete="off" required />
                            </div>
                            <div class="col-sm-8">
                            	<p>Se não souber a palavra secreta por favor mandar email para alain@drsolution.com.br solicitando a mesma.</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-8">
                                <input type="submit" value="Registrar" class="btn btn-info btn-lg" name="register"/>
                            </div>
                        </div>
                         
                    </form>
                </div>
        	</div>
    	</div>
    </div>
    <?php include_once('footer.php'); ?>
