<?php
// include_once("connectMedic.php");


$pageTitle="Novo Exame";

function customPageHeader() { ?>

<?php }

include_once("header.php");
    
?>        
    <h2 class="section_header2">Introduzir/Editar Exames</h2>
    <div id="novo_exame" class="config_page">
        <div class="container">
            <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="myModalLabel">Exames achados</h3>
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
        	
            <div class="row form">
                <div class="col-offset-md-2 center" id="firstFormRow">
                    
                    <form class="form-inline" method="post" action="" id="form1">
                         <div class="form-group">
                            <label for="exame">Exame:</label>
                                                              
                        	<input type="text" class="form-control" id="exame" size="30" name="exame" placeholder="palavra chave p.ex - creatinina"/>
                              
                         </div>
                        
                        
                        <div class="form-group">
                            
                            <input type="submit" id="envioBtn" value="enviar" class="btn btn-success" />
                             
                        </div>
                        
                        
                    </form>
                    <div class="form-inline">
                        <div class="form-group">
                            <input type="submit" id="salvarDireto" name="salvarDireto" value="Salvar Direto Novo Exame" class="btn btn-primary btn-sm" />
                        </div>

                    </div>
                    
                </div>
                <div class="col-md-6 hidden" id="secondFormRow">
                    <form class="form-horizontal" method="post" action="" id="form2">
                         <div class="form-group">
                            <label class="control-label col-sm-4" for="nomeDoExame">Nome(s) do(s) Exame(s):</label>
                            <div class="col-sm-8">
                                                                
                                <input type="text" class="form-control" id="nomeDoExame" size="30" name="nomeDoExame" placeholder="obrigatório"/>
                               
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="descricao">Descricao:</label>
                            <div class="col-sm-8">
                                <textarea rows='10' cols='50' class="form-control" id="descricao" size="100" name="descricao"></textarea>
                            </div>
                        </div>
                        <input type="hidden" id="usuario_id" name="usuario_id">                        
                        <div class="form-group">
                            <label class="control-label col-sm-4"></label>
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
    <script type="text/javascript" src="js/drs3.js"></script>
   <?php include_once('footer.php'); ?>


 
  