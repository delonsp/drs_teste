<?php include_once("debugger/ChromePhp.php");
$on_off = (!isset($_POST['email_mim']) ? "off" : "on"); 
ChromePhp::Log($on_off);



 session_start();  

 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="css/medicStyle.css" type="text/css" />

<title>Receituário Médico</title>
</head>
<body>
<div class="receitaContainer">
    
    <?php

    if(isset($_POST['receitas']) && !empty($_POST['receitas'])) {
        

        $logo = "imgMedic/";
        if (!$_POST['logo2']) {
            $logo .= "medico.png";
        } else {
            $logo .= $_POST['logo2'];
        }
        $nome = strtoupper($_POST['nomeDoPaciente2']);
        $end = $_POST['endDoPaciente2'];
        $tels = $_POST['telsDoPaciente2'];        
 
        $nome_medico = $_SESSION['primeiro_nome']." ".$_SESSION['nome_meio']." ".$_SESSION['ultimo_nome']; 
        $crm = $_SESSION['crm'];
        $titulo = $_SESSION['titulo']; 
        $email_medico = $_SESSION['user_email'];
        $email_paciente = $_POST['emailDoPaciente2'];

        ?>

        <table>
            <tr><td style="align: center; text-align: center;"><img width=220 src="<?php echo $logo; ?>"/></td></tr>
            <tr><td class="htitle">Receitu&aacute;rio M&eacute;dico</td></tr>
            <tr><td></td></tr>
            <tr><td class="htitle2">Identifica&ccedil;&atilde;o do Emitente</td></tr>
            <tr><td class="tdh">
            <dl>
            <dt>Nome:</dt><dd>Dr. <?php echo htmlEntities($nome_medico); ?> - <?php echo htmlEntities($titulo); ?></dd>
            <dt>CRM-SP:</dt><dd><?php echo htmlEntities($crm); ?></dd>
            <dt>Email:</dt><dd><?php echo htmlEntities($email_medico); ?></dd>
            <dt>Endere&ccedil;o:</dt><dd><?php echo htmlEntities($_POST['nomeClinica2']); ?></dd>
            
            </dl>
            </td></tr>
            <tr><td></td></tr>
            <tr><td class="htitle2">Identifica&ccedil;&atilde;o do Paciente</td></tr>
            <tr><td class="tdh">
            <dl>
            <dt>Nome:</dt><dd><b><?php echo htmlEntities($nome); ?></b></dd>
            <dt>Endereço:</dt><dd><?php echo htmlEntities($end); ?></dd>
            <?php if (!$_POST['endDoPaciente2']) {
                echo "</br>";
            } ?>
            <dt>Email:</dt><dd><?php echo htmlEntities($email_paciente); ?></dd>
            <?php if (!$_POST['emailDoPaciente2']) {
                echo "</br>";   
            } ?>
            <dt>Telefones:</dt><dd><?php echo htmlEntities($tels); ?></dd>
            </dl>
            </td></tr>
        
        </table>

        <br/><br/>

        <?php

             $receitas_display = htmlentities($_POST['receitas']);   
             $receitas_display = nl2br(trim($receitas_display))."</br></br>";

             $receitas = nl2br(trim($_POST['receitas']))."</br></br>";

             echo $receitas_display;
             

             $receitas = "<h4>Nome do Paciente: {$nome}</h4>&#13;&#10;".
                                    "<p>tels: {$tels}&#13;&#10;<p>".
                                    "<p>Endereço: {$end}&#13;&#10&#13;&#10</p>". $receitas;
             
        ?>

        <div id="signature">
                <hr/>
                
                <?php
                date_default_timezone_set('America/Sao_Paulo');
                setlocale(LC_ALL, "pt_BR.utf-8","pt_BR", "portuguese_Brazil");
                $date_string = strftime('%d de %B de %Y');
                if($_POST['colocar_data']) {
                    echo htmlEntities("São Paulo, $date_string ");
                }
                ?>
        </div>

        <form method="post" name="form" id="form" action="enviarEmail.php" >
            <input type="hidden" id="receitas2" name="receitas2" value='<?php echo $receitas; ?>' />

            <?php 
           
            for ($i=1; $i <= sizeof($_SESSION['array_pharmas']); $i++) { 
                
                $on_off = (!isset($_POST['email_'.$i]) ? "off" : "on");

            ?>
            <input type="hidden" id="pharma_email_<?php echo $i;?>" name="pharma_email_<?php echo $i;?>" value='<?php echo $on_off; ?>'/>
           
            <?php } // closes the foreach
            $on_off = (!isset($_POST['email_mim']) ? "off" : "on"); 
            
            ?>
            <input type="hidden" id="pharma_email_mim" name="pharma_email_mim" value='<?php echo $on_off; ?>'/>
        </form>        
        
        
        <?php
            
        } else {
            die('corrupted data');  
        }
    
        ?>
        
  
</div>
<script src="js/jquery-1.11.3.min.js"></script>
<script type="text/javascript">
    $(function() {
        
        $('body').on("keypress", function(e) {            
        
            if (e.keyCode == 13) {
        
                // Cancel the default action on keypress event
                
                e.preventDefault();
                window.print(); 
                
                if ($('form').length) {
                    $('form').submit();
                } else {
                    
                    window.location="medicamentos.php";
                }
            }
        });

          $('body').on("click", function() {            
                                 
                window.print(); 
                
               if ($('form').length) {

                   $('form').submit();
                } else {
                    
                    window.location="medicamentos.php";
                }
                          
        });

         
        
        
    });
</script>
</body>
</html>