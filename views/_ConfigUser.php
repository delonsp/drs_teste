<?php
$pageTitle="Configurações de Usuário";

function customPageHeader() { ?>

<?php }

include_once("views/_header.php");

$userID = $_SESSION['user_id'];
$userEmail = $_SESSION['user_email']; 

?>
<div id="contact" class="contact_page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php include_once("CheckUserConfig.php");?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h2 class="section_header2">Configuração de Usuário</h2>
                </div>
            </div>
            
        	<div class="row form">
             	<div class="col-md-10">

             		<?php 

                        // show potential errors / feedback (from login object)
                        if (isset($userconfig)) {
                            if ($userconfig->errors) {
                                echo '<div class="alert alert-danger" style="text-align:center;">';
                                foreach ($userconfig->errors as $error) {
                                    echo "<h4>$error</h4><br/>";
                                }
                                echo '</div>';
                            }
                            if ($userconfig->messages) {
                                echo '<div class="alert alert-info" style="text-align:center;">';
                                foreach ($userconfig->messages as $message) {
                                    echo "<h4>$message</h4><br/>";
                                }
                                echo '<a href="index.php" class="btn btn-primary btn-lg">Menu principal</a>';
                                echo '</div>';
                                echo '<script type="text/javascript">

                                    $(function() {
                                        $(".form-horizontal").hide();
                                        $("a:not([href=\'index.php?logout\']").attr("href", "index.php");
                                    });


                                    </script>';
                            }
                        }


                    ?>
                    
                    <form class="form-horizontal" method="post" name="registerform" action="ConfigUser.php">
                        <div class="form-group">
                    	   	<label for="login_input_primeiro_nome" class="control-label col-sm-4">Primeiro Nome</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control login_input" id="login_input_primeiro_nome" name="primeiro_nome" required 
                                value="<?php if (isset($userconfig->primeiro_nome)) echo $userconfig->primeiro_nome; else echo "" ; ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                    	   	<label for="login_input_nome_meio" class="control-label col-sm-4">Nome do Meio</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control login_input" id="login_input_nome_meio" name="nome_meio" placeholder="opcional"
                                value="<?php if (isset($userconfig->nome_meio)) echo $userconfig->nome_meio; else echo "" ; ?>"  />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="login_input_ultimo_nome" class="control-label col-sm-4">Último Nome</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control login_input" id="login_input_ultimo_nome" name="ultimo_nome" required
                                value="<?php if (isset($userconfig->ultimo_nome)) echo $userconfig->ultimo_nome; else echo "" ; ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="login_input_crm" class="control-label col-sm-4">CRM</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control login_input" id="login_input_crm" name="crm" required
                                value="<?php if (isset($userconfig->crm)) echo $userconfig->crm; else echo "" ; ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="login_input_titulo" class="control-label col-sm-4">Título (breve descrição das suas credenciais)</label>
                            <div class="col-sm-8">
                                <textarea rows='5' cols='20' class="form-control login_input" id="login_input_titulo" name="titulo"
                                 required placeholder='Por exemplo: "Titular da Sociedade Brasileira de ..." ou "Professor Assistente da Cadeira de ..."'></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="input_config_pharma">Quero cadastrar emails de farmácias</label>
                            <div class="col-sm-8">
                                                                
                                <input type="checkbox" class="form-control" id="input_config_pharma" name="config_pharma" />
                               
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6 col-sm-offset-4">
                                <input type="submit" value="Registrar" class="btn btn-info btn-lg" name="register"/>
                                <a href="index.php" class="btn btn-primary btn-lg">Menu principal</a>
                            </div>
                        </div>
                         
                    </form>
                </div>
        	</div>
    	</div>
    </div>
  <?php include_once("views/_footer.php"); ?>
