<?php 
require_once('classes/RetrieveUserConfig.php');   
require_once('classes/RetrieveUserPlaces.php');
require_once('classes/RetrievePharmaConfig.php');

$retrieveUserConfig = new RetrieveUserConfig();
$retrieveUserPlaces = new RetrieveUserPlaces();
$retrievePharmaConfig = new RetrievePharmaConfig();


if (!isset($_SESSION['primeiro_nome']) ||
    !isset($_SESSION['ultimo_nome']) ||
    !isset($_SESSION['crm']) ||
    !isset($_SESSION['titulo'])) {

    $_SESSION['primeiro_nome'] = $retrieveUserConfig->primeiro_nome;     
    $_SESSION['nome_meio'] = $retrieveUserConfig->nome_meio;
    $_SESSION['ultimo_nome'] =  $retrieveUserConfig->ultimo_nome;
    $_SESSION['crm'] = $retrieveUserConfig->crm;
    $_SESSION['titulo'] = $retrieveUserConfig->titulo;
    $_SESSION['config_pharma'] = $retrieveUserConfig->config_pharma;
}

if (!isset($_SESSION['locais'])) 
{

    $_SESSION['locais'] = $retrieveUserPlaces->nosocomios;
}
if (!isset($_SESSION['array_pharmas'])) 
{
    $_SESSION['array_pharmas'] = $retrievePharmaConfig->array_pharmas;
}
 
    include_once("debugger/ChromePhp.php");
    ChromePhp::log($_SESSION['array_pharmas']);
    ChromePhp::log($_SESSION['config_pharma']);



        
        if ((!$retrieveUserConfig->messages || !$retrieveUserPlaces->messages || 
            (!$retrievePharmaConfig->messages && $retrieveUserConfig->config_pharma))
            && $pageTitle == "Menu" ) {
            if ($retrieveUserConfig->messages) {
                echo '<div class="alert alert-info" style="text-align:center;">';
                foreach ($retrieveUserConfig->messages as $message) {
                    echo "<h4>$message</h4>";
                }
                echo '</div>';
            } 
            if ($retrieveUserPlaces->messages) {
                echo '<div class="alert alert-info" style="text-align:center;">';
                foreach ($retrieveUserPlaces->messages as $message) {
                    echo "<h4>$message</h4>";
                }
                echo '</div>';
            }
            if ($retrievePharmaConfig->messages) {
                echo '<div class="alert alert-info" style="text-align:center;">';
                foreach ($retrievePharmaConfig->messages as $message) {
                    echo "<h4>$message</h4>";
                }
                echo '</div>';
            }
            
        }
        if (($retrieveUserConfig->errors || $retrieveUserPlaces->errors || $retrievePharmaConfig->errors)
            && $pageTitle == "Menu") {
            if ($retrieveUserConfig->errors) {
                echo '<div class="alert alert-danger" style="text-align:center;">';
                foreach ($retrieveUserConfig->errors as $error) {
                    echo "<h4>$error</h4>";
                }
                if (!$retrieveUserConfig->foundRecords) {
                    echo '<a class="btn btn-warning" href="ConfigUser.php">Configurar dados de usuário</a>';
                }
                echo '</div>';
            }
            if ($retrieveUserPlaces->errors) {
                echo '<div class="alert alert-danger" style="text-align:center;">';
                foreach ($retrieveUserPlaces->errors as $error) {
                    echo "<h4>$error</h4>";
                }
                if (!$retrieveUserPlaces->foundRecords) {
                    echo '<a class="btn btn-warning" href="ConfigLocais.php">Configurar locais de atendimento</a>';
                }
                echo '</div>';
            }
            if ($retrievePharmaConfig->errors && $retrieveUserConfig->config_pharma) {
                echo '<div class="alert alert-danger" style="text-align:center;">';
                foreach ($retrievePharmaConfig->errors as $error) {
                    echo "<h4>$error</h4>";
                }
                if (!$retrievePharmaConfig->foundRecords) {
                    echo '<a class="btn btn-warning" href="ConfigPharma.php">Configurar Farmácias</a>';
                    echo '<a class="btn btn-primary" id="noconfig" style="margin-left:10px;" href="#">Não quero configurar Farmácias</a>';
                }
                echo '</div>';
            }
        }

        if ((!$retrieveUserConfig->messages || !$retrieveUserPlaces->messages || 
            (!$retrievePharmaConfig->messages && $retrieveUserConfig->config_pharma)) ||
            ($retrieveUserConfig->errors || $retrieveUserPlaces->errors || ($retrievePharmaConfig->errors 
                && $retrieveUserConfig->config_pharma))) {
            
            echo '<script type="text/javascript">

                $(function() {
                    $(".links").hide();
                    
                    $("a:not([href=\'index.php?logout\'],[href=\'index.php\'],#drop,[href*=Config])").hide();
                });


                </script>';
            
        }

    
    

    

 