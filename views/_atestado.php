<?php
// include_once("connectMedic.php");


$pageTitle="atestado";

function customPageHeader() { ?>

<?php }

include_once("header.php");

$soler = "Clinica Medica Soler. Av. Satélite 84, São Mateus, São Paulo, SP | tel (11) 2014-4599";

$local = (isset($_SESSION['local']) ? $_SESSION['local'] : null );

$nome = (isset($_SESSION['nome']) ? $_SESSION['nome'] : null );

?>
    
	<div id="contact" class="contact_page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="section_header2">Atestado Médico</h2>
                </div>
            </div>
        	<div class="row form">
             	<div class="col-md-10">
                    <form class="form-horizontal" method="post" action="imprimirAtestado.php" id="form">
                    	<div class="form-group">
                            <label class="control-label col-sm-4" for="nomeDoPaciente">Nome do Paciente:</label>
                            <div class="col-sm-8">
                                <?php if ($nome) { ?>
                                    <input type="text" class="form-control" id="nomeDoPaciente" value="<?php echo $nome ?>" size="30" name="nomeDoPaciente" >
                                <?php } else { ?>
                                    <input type="text" class="form-control" id="nomeDoPaciente" esize="30" name="nomeDoPaciente" >
                                <?php } ?>
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="cid">CID:</label>
                            <div class="col-sm-8">
                                <input type="text" value="N20.0" class="form-control" id="cid" size="5" name="cid" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="nomeClinica">Clinica:</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="nomeClinica" name="nomeClinica" size="5" >
                                <?php
                                $con = connect();
                				
								$name = mysqli_query($con, "SELECT  `$localDB` FROM  $tabelaTISS ORDER BY `$localDB`") or die(mysqli_error($con));
								while ($name_row = mysqli_fetch_assoc($name)) {
									
									$selectItem = nl2br($name_row[$localDB]);
						
									if ($name_row[$localDB] == $local) {
                                        echo "<option value='".$selectItem."' selected>".$selectItem."</option>";
                                    }
                                    else {
                                        echo "<option value='".$selectItem."'>".$selectItem."</option>";
                                    }
								} 
							
								?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="tipoAtestado">Tipo:</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="tipoAtestado" name="tipoAtestado" size="5" size="2" >
                                    <option value="Retornar ao trabalho.">horas</option>
                                    <option value="Acompanhante">acompanhante</option>
                                    <option value="Permanecer em repouso o resto do dia">do dia</option>
                                    <option value="Vários dias">Vários dias</option>
                                    <option value="Atestado de Academia">Atestado de Academia</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="horaDeChegada">Hora de chegada:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="horaDeChegada" name="horaDeChegada">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="adiciona">Minutos a mais:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="adiciona" name="adiciona" >
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8">
                              <input type='submit' class='btn btn-info btn-lg' value='enviar' />
                            </div>
                        </div>
                        
                    </form>
                </div>
        	</div>
    	</div>
    </div>
    <?php include_once("footer.php"); ?>

 