    <?php
// include_once("connectMedic.php");

include_once("debugger/ChromePHP.php");

$pageTitle="Menu";

function customPageHeader() { ?>

<?php }

include_once("header.php");

?>
  

    <div id="myLinks">


        <div class="container">
        
            <h2 class="section_header">
                
            </h2>

            <div class="row">
                <div class="col-md-12">
                    <?php include_once("CheckUserConfig.php");?>
                </div>
            </div>
           
            <div class="links">
                <div class="row">
                    <div class="col-md-12">
                         <a href="medicamentos.php" class="linksDRS" >Medicamentos</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                    
                        <a href="medicamentos.php?man=1" class="linksDRS" >Medicamentos Manipulados</a>
                    
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                   
                        <a href="SADT.php" class="linksDRS" >Guias de exames SADT</a>
                    
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                    
                        <a href="atestado.php" class="linksDRS" >Atestados</a>
                    </div>
                </div>
            </div>
            
         </div>
    </div>
<?php include_once("footer.php"); ?>