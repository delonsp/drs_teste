<?php
$pageTitle="SADT";

function customPageHeader() { ?>

<?php }

include_once("views/_header.php");

$userID = $_SESSION['user_id'];
$userEmail = $_SESSION['user_email'];


?>        

    <div class="container">
        <div class="row">
            <div class="col-md12">
                <h2 class="section_header2">Exames SADT/TISS</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 col-md-offset-5 col-sm-6 col-sm-offset-3 col-xs-8 col-xs-offset-2" id="editBtn">
               
                <a href="novoExame.php" class="btn btn-success" >Inserir/Editar Exame</a>
            </div>
        </div>
        <br/>
    	<div class="row form">
        
        	<div class="col-md-6">
                <form id="form1" class="form-horizontal" method="post" action="">
                    <div class="form-group"> 
                    
                        <label class="control-label col-sm-4" for="listaExames">Selecione:
                            Aperte CTRL para selecionar mais de um item</label>
                        <div class="col-sm-8">
                            <select multiple id="listaExames" class="form-control" name="listaExames[]" size="5">
                    
                            <?php
                            

                            $soler = "Clinica Medica Soler. Av. Satélite 84, São Mateus, São Paulo, SP | tel (11) 2014-4599";
                            $intermedica = "intermedica";

                            if(isset($_SESSION['local'])) {
                                $local = mysql_real_escape_string($_SESSION['local']);
                            } else {
                                $local = $soler;
                            }

                            if(isset($_SESSION['nome'])) {
                                $nome = mysql_real_escape_string($_SESSION['nome']);
                            } else {
                                $nome = NULL;
                            }

                            if(isset($_SESSION['convenio'])) {
                                $convenio = mysql_real_escape_string($_SESSION['convenio']);
                            } else {
                                $convenio = $intermedica;
                            }

                             //continua daqui
                            $con = connect();                  
                            $name = mysqli_query($con,"SELECT  `$nomeDB` FROM  `$tabelaExames` WHERE `$usuarioID` = $userID OR `$usuarioID` = 1
                                                        ORDER BY `$nomeDB`") or die(mysqli_error($con));
                            while ($name_row = mysqli_fetch_assoc($name)) {
                                
                                $selectItem = nl2br($name_row[$nomeDB]);
                            
                                echo "<option value='".$selectItem."'>".$selectItem."</option>";
                            } 
                            
                            ?>
                    
                    
                         </select>
                        </div> <!-- fecha controls select exames-->
                    </div> <!-- fecha form-group select exames -->
                    <div class="form-group">
                        <label for="nomeDoPaciente" class="control-label col-sm-4">Nome do Paciente:</label>
                        <div class="col-sm-8">
                            
                            <?php if ($nome) {

                            ?> 
                            
                            <input type="text" class="form-control" id="nomeDoPaciente" size="30" name="nomeDoPaciente" value="<?php echo $nome; ?>"/>

                            <?php } else { ?>

                            <input type="text" class="form-control" id="nomeDoPaciente" size="30" name="nomeDoPaciente" placeholder="obrigatório"/>

                            <?php  } ?>
                        </div><!-- fecha controls text nomeDoPaciente-->
                     </div><!-- fecha form-group text nomeDoPaciente-->
                    <div class="form-group">
                        <label for="nomeConvenio" class="control-label col-sm-4">Convenio:</label>
                        <div class="col-sm-8">
                            <select id="nomeConvenio" class="form-control" name="nomeConvenio" size="5">
                                <?php
                                    $con = connect();
                                    $tabela ='logosConvenios';
                                    $name = mysqli_query($con, "SELECT  `nome` FROM  $tabela ORDER BY `nome`") or die(mysqli_error($con));
                                    while ($name_row = mysqli_fetch_assoc($name)) {
                                        
                                        $selectItem = nl2br($name_row['nome']);
                            
                                        if ($name_row['nome'] == $convenio) {
                                            echo "<option value='".$selectItem."' selected>".$selectItem."</option>";
                                        }
                                        else {
                                            echo "<option value='".$selectItem."'>".$selectItem."</option>";
                                        }
                                    } 
                                
                                ?>
                                </select>
                        </div><!-- fecha controls select convenio-->
                    </div><!-- fecha form-group select convenio-->
                    <div class="form-group">
                        <label for="cid" class="control-label col-sm-4">CID:</label>
                        <div class="col-sm-8">
                            <input type="text" value="N20.0" class="form-control" id="cid" size="5" name="cid" /><br/>
                        </div><!-- fecha controls input cid-->
                    </div><!-- fecha form-group input cid-->
                    <div class="form-group">
                        <label for="clinica" class="control-label col-sm-4">Clínica:</label>
                        <div class="col-sm-8">
                            <select id="nomeClinica" size="5" class="form-control" name="nomeClinica" >
                            <?php
                    
                                $query = "SELECT nosocomios.local
                                            from nosocomios
                                            INNER JOIN users_nosocomios
                                            on users_nosocomios.nosocomio_id = nosocomios.id
                                            INNER JOIN users
                                            on users.user_id = users_nosocomios.usuario_id
                                            where user_id=$userID
                                            ORDER BY `$localDB`";
                               
                                $name = mysqli_query($con,$query) or die(mysqli_error($con));
                                while ($name_row = mysqli_fetch_assoc($name)) {
                                    
                                    $selectItem = nl2br($name_row['local']);
									$selectItem2 = justTheName($selectItem);
                        
                                    if ($name_row['local'] == $local) {
                                        echo "<option value='".$selectItem."' selected>".$selectItem2."</option>";
                                    }
                                    else {
                                        echo "<option value='".$selectItem."'>".$selectItem2."</option>";
                                    }
                                } 
                            
                            ?>
                        </div><!-- fecha controls select clinica-->
                    </div><!-- fecha form-group select clinica-->
                    
                    <div class="form-group">
                        <div class="col-sm-8">
                        	<input type="submit" id="enviarBtn" value="enviar" class="btn btn-success btn-lg" />
                        </div>
                    </div>
                </form>
			</div>     

            <div class="col-md-1"></div>
            <div class="col-md-5">
                <form id="form2" class="form-horizontal" action="guiaTISS.php" method="post" >
                
                    <?php
                 
                        if(	isset($_POST['nomeDoPaciente']) && !empty($_POST['nomeDoPaciente']) &&
                            isset($_POST['nomeConvenio']) && !empty($_POST['nomeConvenio']) &&
                            isset($_POST['listaExames']) && !empty($_POST['listaExames']) &&
                            isset($_POST['nomeClinica']) && !empty($_POST['nomeClinica'])) {
                            
                            $nomeClinica = $_POST['nomeClinica'];
                            $nome = $_POST['nomeDoPaciente'];
                            $nomeConvenio = $_POST['nomeConvenio'];

                            if($_SESSION['local'] != $nomeClinica) $_SESSION['local'] = $nomeClinica;
                            if($_SESSION['nome'] != $nome) $_SESSION['nome'] = $nome;
                            if($_SESSION['convenio'] != $nomeConvenio) $_SESSION['convenio'] = $nomeConvenio;
                            

                            $cid = $_POST['cid'];
                     ?>
                        <input type="hidden" id="nomeDoPaciente2" size="30" name="nomeDoPaciente2"
                        value="<?php echo $nome ?>" />
                     
                        <input type="hidden" id="nomeConvenio2" name="nomeConvenio2" value="<?php echo ($nomeConvenio) ?>">
                        
                        <?php             
                        $imgQuery = mysqli_query($con,"SELECT descricao FROM  $tabelaLogos WHERE nome = '$nomeConvenio' ORDER BY `descricao`");
                        $imgConvenio = htmlentities($imgQuery->fetch_assoc()['descricao'], ENT_COMPAT,"UTF-8");
                        
                        $clinicaQuery = mysqli_query($con, "SELECT `codigo` FROM  $tabelaTISS WHERE `local` = '$nomeClinica'");
                        $codigoConvenio = htmlentities($clinicaQuery->fetch_assoc()['codigo'], ENT_COMPAT,"UTF-8");
                        ?>
                        <input type="hidden" id="imgConvenio" name="imgConvenio" value="<?php echo $imgConvenio ?>">
                        <input type="hidden" id="cid2" name="cid2" value="<?php echo $cid ?>">
                        <input type="hidden" id="nomeClinica2" name="nomeClinica2" value="<?php echo (justTheName($nomeClinica)) ?>">
                        <input type="hidden" id="codigoConvenio2" name="codigoConvenio2" value="<?php echo $codigoConvenio ?>">
                        
                    <div class="form-group">
                    <div class="col-sm-8"
                    	<p>Nome: <?php echo $nome;  ?></p>
                        <p>Convênio: <?php echo $nomeConvenio ?></p>
                        <p>CID: <?php echo $cid?></p>
                    </div>
                    </div>
                                               
                    <div class="form-group">

                        <?php
                            $listaExames = $_POST['listaExames'];
                            $consolidado =''; $i=0;
                            $con = connect();
                            
                            foreach($listaExames as $exames) {
                                $i++; 
                                $examesQuery = mysqli_query($con, "SELECT `descricao` FROM  `$tabelaExames` WHERE nome = '$exames'
                                                            AND (`$usuarioID` = $userID OR `$usuarioID` = 1) ORDER BY `descricao`");
                                $consolidado .= htmlentities($examesQuery->fetch_assoc()['descricao'], ENT_COMPAT,"UTF-8");
                                $consolidado .= ($i < count($listaExames))  ? "&#13;&#10;" : "";
                                
                            }
                        ?> 

                            <label for="receitas">Editar se necessário</label>              
                            <textarea rows='14' class='form-control' cols='50' id='receitas' name='exames'><? echo $consolidado; ?>
                            </textarea>                  
                            <br>
                            
                            <input type='submit' class='btn btn-info btn-lg' value='enviar'>
                            
                   
                        
                    </div>
                  <? } // closes the if
                        else echo '<div class="alert alert-info">Não se esqueça de preencher todos os campos ao lado e clicar enviar.<br>
                        Você terá chance de editar a lista de exames em uma caixa abaixo antes de imprimir.</div>';
                   ?>
                </form>
            </div>
        
        </div>
    </div>
    
	<?php include_once("views/_footer.php"); ?>


