<?php
$pageTitle="Configurações de Locais de Atendimento";

function customPageHeader() { ?>

<?php }

include_once("views/_header.php");

$userID = $_SESSION['user_id'];
$userEmail = $_SESSION['user_email']; 

?>
<div id="config_locais" class="config_page">
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
                                <h3 id="myModalLabel">Locais achados</h3>
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
                    <h2 class="section_header2">Configuração de Locais de Atendimento</h2>
                </div>
            </div>
            
        	<div class="row form">
             	<div class="col-offset-md-2 center" id="firstFormRow">
                    <form class="form-inline" method="post" name="buscarForm" action="ConfigLocais.php" id="form1">
                        <div class="form-group">
                    	   	<label for="input_busca_local">Buscar Local</label>
                           
                            <input type="text" class="form-control input" id="input_busca_local" name="busca_local" required 
                            value="<?php if (isset($userconfig->busca_local)) echo $userconfig->busca_local; else echo "" ; ?>" />
                           
                        </div>
                        <div class="form-group">
                           
                            <input type="submit" value="Buscar" id="buscar_local" class="btn btn-info " name="buscar_local"/>
                            
                        </div>
                         
                    </form>
                    <div class="form-inline">
                        <div class="form-group">
                            <label for="salvarDireto">Salvar Direto sem Pesquisa</label>
                            <input type="submit" id="salvarDireto" name="salvarDireto" value="Novo Local" class="btn btn-success " />
                        </div>

                    </div>
                    <div class="form-inline">
                        <div class="form-group">
                            <a href="index.php" class="btn btn-primary ">Menu principal</a>
                        </div>

                    </div>
                    
                </div>
                <div class="col-md-10 hidden" id="secondFormRow">
                    <form class="form-horizontal" method="post" name="novoLocalForm" action="ConfigLocais.php" id="form2">
                         <div class="form-group">
                            <label class="control-label col-sm-4" for="input_nome_local">Nome do Local:</label>
                            <div class="col-sm-8">
                                                                
                                <input type="text" class="form-control" id="input_nome_local" size="30" name="nome_local" required/>
                               
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="input_end_local">Endereço:</label>
                            <div class="col-sm-8">
                                                                
                                <input type="text" class="form-control" id="input_end_local" size="100" name="end_local" required/>
                               
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="input_tel_local">Telefones:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="input_tel_local" size="30" name="tel_local" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="input_codigo_local">CNPJ ou Código para operadora:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="input_codigo_local" size="30" name="codigo_local" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            
                            <div class="col-sm-4 col-sm-offset-4">
                                <input type="submit" id="gravarBtn" value="Gravar" class="btn btn-success save-btn" />
                            
                                <input type="submit" id="cancelForm" value="Cancelar" class="btn btn-danger" />
                            </div>
                        </div>
                         
                    </form>
                </div>
        	</div>
    	</div>
    </div>
   
    <script src="js/drs4.js"></script>
   <?php include_once("views/_footer.php"); ?>