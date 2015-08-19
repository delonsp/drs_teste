<?php
$pageTitle="medicamentos";

function customPageHeader() { ?>

<?php }

include_once("views/_header.php");

$userID = $_SESSION['user_id'];                     
                                                                                                                                                                        

?>
    
    
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php 

                    if (isset($_GET['man'])) {
                        $m = 1;
                        echo '<h2 class="section_header2">Medicamentos Manipulados</h2>';
                    } else {
                        $m = 0;
                        echo '<h2 class="section_header2">Medicamentos Comuns</h2>';
                    }


                 ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 col-md-offset-5 col-sm-6 col-sm-offset-3 col-xs-8 col-xs-offset-2" id="editBtn">
                <a href="NovaReceita.php?man=<?php echo $m; ?>" class="btn btn-success" >Inserir/Editar Receita</a>
            </div>
        </div>
        <div class="row form">
            <div class="col-md-6">
                <form class="form-horizontal" method="post" action="" id="form1">
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="listaMedic">
                            <span class="glyphicon glyphicon-globe"></span> Itens globais</label>
                        <div class="col-sm-8">
                            <select data-dropup-auto="false" 
                            multiple data-selected-text-format="count>2" id="listaMedic" class="selectpicker form-control" 
                                title='Selecione um ou mais itens' name="listaMedic[]" size="10">
                            <?php

                            $local = (isset($_POST['nomeClinica']) ? $_POST['nomeClinica'] : $_SESSION['local']);

                            $nome = (isset($_POST['nomeDoPaciente']) ? $_POST['nomeDoPaciente'] : $_SESSION['nome']);

                            $end_paciente = (isset($_POST['endDoPaciente']) ? $_POST['endDoPaciente'] : $_SESSION['end_paciente']);

                            $email_paciente = (isset($_POST['emailDoPaciente']) ? $_POST['emailDoPaciente'] : $_SESSION['email_paciente']);

                            $tels = (isset($_POST['telsDoPaciente']) ? $_POST['telsDoPaciente'] : $_SESSION['tels']);

                            $con=connect();
                            
                            $name = mysqli_query($con,"SELECT  * FROM  $tabelaReceitas WHERE `$man`=$m 
                                AND (`$usuarioID` = $userID OR `$usuarioID` = 1)  ORDER BY `$nomeDaReceitaDB`") or die(mysqli_error($con));
                            while ($name_row = mysqli_fetch_assoc($name)) {
                                
                                $selectItem = nl2br($name_row[$nomeDaReceitaDB]);
                                $selectItem2 = $selectItem;
                                $icon='';

                                if ($name_row['usuario_id'] == '1') {
                                    $selectItem .= "(g)";
                                    $icon = 'data-icon="glyphicon-globe"';
                                }
                            
                                echo "<option " .$icon. ' value="'.$selectItem.'">'.$selectItem2.'</option>';
                            } 
                            
                            ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="nomeDoPaciente">Nome do paciente:</label>
                        <div class="col-sm-8">
                                                            
                            <input type="text" class="form-control" id="nomeDoPaciente" name="nomeDoPaciente" value="<?php echo $nome; ?>"/>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="endDoPaciente">Endereço:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="endDoPaciente"  name="endDoPaciente" value="<?php echo $end_paciente; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="telsDoPaciente">Telefones:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="telsDoPaciente" name="telsDoPaciente" size="30" value="<?php echo $tels; ?>" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="emailDoPaciente">Email:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="emailDoPaciente" name="emailDoPaciente" value="<?php echo $email_paciente; ?>" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="clinica" class="control-label col-sm-4">Clínica:</label>
                        <div class="col-sm-8">
                            <select id="nomeClinica" class="selectpicker form-control" name="nomeClinica" size="5">
                            <?php
                                $con=connect();

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
                                    
                                    $selectItem = nl2br($name_row[$localDB]);
                                    $selectItem2= justTheName($selectItem);
                        
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
                <form  method="post" action="imprimirReceita.php" id="form2">
                   
                            <?php

 
                            if( isset($_POST['nomeDoPaciente']) && ! empty($_POST['nomeDoPaciente']) &&
                                
                                isset($_POST['listaMedic']) && !empty($_POST['listaMedic'])) {
                                
                            
                                setlocale(LC_ALL, "pt_BR.utf-8", "pt_BR", "portuguese");

                                $nome = strtoupper($_POST['nomeDoPaciente']);
                                
                                if($_SESSION['nome'] != $nome) $_SESSION['nome'] = $nome;

                                $end_paciente = ($_POST['endDoPaciente'] ? $_POST['endDoPaciente'] : null);
                                
                                if($_SESSION['end_paciente'] != $end_paciente) $_SESSION['end_paciente'] = $end_paciente;

                                $email_paciente = ($_POST['emailDoPaciente'] ? $_POST['emailDoPaciente'] : null);
                                
                                if($_SESSION['email_paciente'] != $email_paciente) $_SESSION['email_paciente'] = $email_paciente;

                                $tels = $_POST['telsDoPaciente'];

                                if($_SESSION['tels'] != $nome) $_SESSION['tels'] = $tels;

                                $nomeClinica = $_POST['nomeClinica'];
                                
                                if($_SESSION['local'] != $nomeClinica) $_SESSION['local'] = $nomeClinica;
                               
                                            
                                $consolidado = "";
                                
                                $listaMedic = $_POST['listaMedic'];

                                $con=connect();
                                
                                foreach($listaMedic as $remedio) {


                                    if ($strpos = strpos($remedio, "(g)")) {
                                        $usuario = 1;
                                        $remedio = substr($remedio, 0, $strpos);

                                    } else {
                                        $usuario = $userID;
                                    }

                                                                            
                                    $receita = mysqli_query($con,"SELECT `$descricaoDB` FROM  $tabelaReceitas WHERE `$nomeDaReceitaDB` = '$remedio'
                                                            AND `$usuarioID` = $usuario");
                                
                                    $consolidado .= htmlentities($receita->fetch_assoc()[$descricaoDB], ENT_COMPAT,"UTF-8");
                                    $consolidado .= "&#10;&#13;&#10;";
                                    
                                }
                            $consolidado = trim($consolidado);
                            ?>
                        <div class="form-group">
                            <label for="receitas">Editar se necessário</label>              
                            <textarea rows='17' class='form-control' cols='50' id='receitas' name='receitas'><? echo $consolidado; ?></textarea>
                             
                            <?php
                            $con=connect();

                            $logo = mysqli_query($con,"SELECT `$logoDB` FROM $tabelaTISS WHERE `$localDB` = '$nomeClinica'");
                            $logo = $logo->fetch_assoc()[$logoDB];
                                                
                            ?>
                       
                        </div>
                    <?php 

                        $pharmas = $_SESSION['array_pharmas'];

                        $i = 0;

                        foreach ($pharmas as $pharma) {
                            
                            $i++;

                            $nome_pharma = preg_replace('/\s+/', '', $pharma['nome']);

                            $checked = ($pharma['enviar_email'] == 1 ? "checked" : "");
                            
                    ?>
                    <div class="checkbox">

                        <label>
                            <input type="checkbox" <?php echo $checked; ?> id="email_<?php echo $i; ?>"  name="email_<?php echo $i;?>"  />
                            <?php echo "Email para: ".$pharma['nome']; ?>
                        </label>

                    </div>

                     <?php  } // closes the foreach ?>
                      
                    <div class="checkbox">
                       
                        <label>
                            <input type="checkbox" <?php echo $checked; ?> id="email_mim"  name="email_mim"  />
                            Email com cópia para mim
                        </label>
                        
                    </div>

                    <div class="checkbox">
                       
                        <label>
                            <input type="checkbox" checked="yes" id="colocar_data"  name="colocar_data"  />
                            Colocar Data
                        </label>
                        
                    </div>
                   

                    <input type="hidden" name="man" id="man" value="<?php echo $man; ?>" />
                    <input type="hidden" name="nomeDoPaciente2" id="nomeDoPaciente2" value="<?php echo $nome; ?>" />
                    <input type="hidden" name="nomeClinica2" id="nomeClinica2" value="<?php echo $nomeClinica; ?>" />
                    <input type="hidden" name="telsDoPaciente2" id="telsDoPaciente2" value="<?php echo $tels; ?>" />
                    <input type="hidden" name="endDoPaciente2" id="endDoPaciente2" value="<?php echo $end_paciente; ?>" />
                    <input type="hidden" name="emailDoPaciente2" id="emailDoPaciente2" value="<?php echo $email_paciente; ?>" />
                    <input type="hidden" name="logo2" id="logo2" value="<?php echo $logo; ?>" />

                    
                            
                    <input type='submit' id="form2_submit" class='btn btn-info btn-lg' value='enviar'>
                     

                    <?php  } else // closes the if(...)
                    
                        echo '<div class="alert alert-info">Não se esqueça de preencher todos os campos ao lado e clicar enviar.<br>
                        Se houver interesse em mandar email para alguma farmácia, insira também os telefones de contato.</div>';
                      
                    ?>
                    
                </form>
             </div>
        </div>
    </div>

<?php include_once('views/_footer.php'); ?>

 
  