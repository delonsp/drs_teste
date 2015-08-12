<?php
// include_once("connectMedic.php");


$pageTitle="Nova Receita";

function customPageHeader() { 

}

include_once("header.php");


if (isset($_GET['man']) && $_GET['man']==1) {
    $m = 1;
    echo '<h2 class="section_header2">Introduzir/Editar Medicamentos Manipulados</h2>';

} else {
    $m = 0;
    echo '<h2 class="section_header2">Introduzir/Editar Medicamentos Comuns</h2>';
}

echo "<script>var m=$m</script>";

?>
    <div id="nova_receita" class="config_page">
        <div class="container">
        	<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="myModalLabel">Medicamentos achados</h3>
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
                            <label for="principio">Princípio ativo:</label>                       
                            	<input type="text" class="form-control" id="principio" name="principio" placeholder="p. ex: diclofenaco"/>
                        </div>
                        
                        
                        <div class="form-group">
                            <input type="submit" id="envioBtn" value="Enviar" class="btn btn-info btn-sm" />
                        </div>
                        
                    </form>
                    <div class="form-inline">
                        <div class="form-group">
                            <!-- <label for="salvarDireto">Salvar direto sem pesquisa</label> -->
                            <input type="submit" id="salvarDireto" name="salvarDireto" value="Salvar Direto Novo Medicamento" class="btn btn-primary btn-sm" />
                        </div>
                        
                    </div>

                </div>
                <div class="col-md-6 hidden" id="secondFormRow">
                    <form class="form-horizontal" method="post" action="" id="form2">
                         <div class="form-group">
                            <label class="control-label col-sm-4" for="nomeDaDoenca">Nome da Doença:</label>
                            <div class="col-sm-8">
                                                                
                                <input type="text" class="form-control" id="nomeDaDoenca" size="30" name="nomeDaDoenca" placeholder="obrigatório"/>
                               
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="nomeDaReceita">Nome da Receita:</label>
                            <div class="col-sm-8">
                                                                
                                <input type="text" class="form-control" id="nomeDaReceita" size="30" name="nomeDaReceita" placeholder="obrigatório"/>
                               
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="textoReceita">Texto da Receita:</label>
                            <div class="col-sm-8">
                                <textarea rows='20' cols='50' class="form-control" id="textoReceita" size="100" name="textoReceita"></textarea>
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
    
    <script src="js/drs2.js"></script>
    <?php include_once('footer.php'); ?>


 
  