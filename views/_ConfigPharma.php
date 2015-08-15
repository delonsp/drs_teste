<?php
$pageTitle="Configurações de Farmácias";

function customPageHeader() { ?>

<?php }

include_once("views/_header.php");
//include("debugger/ChromePhp.php");


$userID = $_SESSION['user_id'];
$userEmail = $_SESSION['user_email']; 

?>
<div id="config_pharmas" class="config_page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php include_once("CheckUserConfig.php");?>
                </div>
            </div>
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 id="myModalLabel">Farmácias achadas</h3>
                    </div>
                  <div class="modal-body">
                    
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-danger" id="cancelBtn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                    <button class="btn btn-primary" id="mostraFormBtn">Salvar Novo</button>
                  </div>
                </div>
            </div>  
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2 class="section_header2">Configurações de Farmácias</h2>
            </div>
        </div>
    	<div class="row form">
         	<div class="col-offset-md-2 center" id="firstFormRow">
                <form class="form-inline" method="post" name="buscarForm" action="ConfigPharma.php" id="form1">
                    <div class="form-group">
                	   	<label for="input_busca_pharma">Buscar Farmácia</label>
                            <input type="text" class="form-control input" id="input_busca_pharma" name="busca_pharma" required 
                            value="<?php if (isset($userconfig->busca_pharma)) echo $userconfig->busca_pharma; else echo "" ; ?>" />
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Buscar" id="buscar_pharma" class="btn btn-info btn-sm" name="buscar_pharma"/>
                    </div>
                     
                </form>
                <div class="form-inline">
                    <div class="form-group">
                        <label for="salvarDireto">Salvar Direto sem Pesquisa</label>
                        <input type="submit" id="salvarDireto" name="salvarDireto" value="Nova Farmácia" class="btn btn-success btn-sm" />
                    </div>

                </div>
                <div class="form-inline">
                    <div class="form-group">
                        <a href="index.php" class="btn btn-primary btn-sm">Menu principal</a>
                    </div>

                </div>
            </div>
                <div class="col-md-6 hidden" id="secondFormRow">
                    <form class="form-horizontal" method="post" name="novaPharmaForm" action="ConfigPharma.php" id="form2">
                         <div class="form-group">
                            <label class="control-label col-sm-4" for="input_nome_pharma">Nome da Farmácia:</label>
                            <div class="col-sm-8">
                                                                
                                <input type="text" class="form-control" id="input_nome_pharma" size="30" name="nome_pharma" required/>
                               
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="input_emails_pharma">Emails:</label>
                            <div class="col-sm-8">
                                                                
                                <textarea class="form-control" id="input_emails_pharma" rows="10" cols="4" name="emails_pharma"
                                placeholder="Colocar um ou mais emails e separar cada um por vírgulas." required></textarea>
                               
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="input_enviar_email_pharma">Enviar Email por padrão</label>
                            <div class="col-sm-8">
                                                                
                                <input type="checkbox" class="form-control" id="input_enviar_email_pharma" name="enviar_email_pharma" />
                               
                            </div>
                        </div>
                        <div class="form-group">
                            
                            <div class="col-sm-8">
                                <input type="submit" id="gravarBtn" value="Gravar" class="btn btn-success save-btn" />
                            
                                <input type="submit" id="cancelForm" value="Cancelar" class="btn btn-danger" />
                            </div>
                        </div>
                         
                    </form>
                </div>
        	</div>
    	</div>
    </div>
   
    <script src="js/drs5.js"></script>
   <?php include_once("views/_footer.php"); ?>