<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <link rel="shortcut icon" href="img/favicon.ico?v=2">
	<title><?= isset($pageTitle) ? $pageTitle : "Default Title"?></title>
    <!-- Additional tags here -->
    <?php if (function_exists('customPageHeader')){
      customPageHeader();
    }?>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="css/drs.css">
    <link rel="stylesheet" type="text/css" href="css/theme.css">
    <!-- <link rel="stylesheet" type="text/css" href="css/external-pages.css">
    <link rel="stylesheet" type="text/css" href="css/animate.css"> -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic,900italic" rel="stylesheet" type='text/css'> -->
    <script src="js/jquery-1.11.3.min.js"></script>
</head>
<body>
<a href="#" class="scrolltop">
        <span>up</span>
    </a>
    <!-- begins navbar -->
	<div class="navbar navbar-inverse navbar-fixed-top">
      
        <div class="container">
            <div class="navbar-header">
        		<button type="button" class="navbar-btn navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
    	            <span class="icon-bar"></span>
    	            <span class="icon-bar"></span>
    	            <span class="icon-bar"></span>
              	</button>
              	<a class="navbar-brand scroller" href="index.php">
                    <img src="img/logo.png" alt="logo" />
                </a>
            </div>
		  	<div class="navbar-collapse collapse pull-left">
                <ul class="nav navbar-nav pull-right">
                    <?php if ($_SESSION['user_login_status'] != 1) {
                        echo '<li><a href="index.php">Login</a></li>';
                        echo '<li><a href="NovoUsuario.php">Novo usuário</a></li>';
                    } else {
                        
                    ?>
                                     
                    <li><a href="index.php?logout">Logout</a></li>
                    <li><a href="medicamentos.php">Medicamentos</a></li>
                    <li><a href="medicamentos.php?man=1">Manipulados</a></li>
                    <li><a href="SADT.php">Exames</a></li>
                    <li><a href="atestado.php">Atestados</a></li>
                    <li class="dropdown">
                        <a href="#" id="drop" class="dropdown-toggle" data-toggle="dropdown">Config <b class="caret"></b></a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="drop">
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="ConfigUser.php">Dados de Usuário</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="ConfigLocais.php">Dados de Locais de Atendimento</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="ConfigPharma.php">Dados de Farmácias</a></li>
                        </ul>

                    </li>
                    <?php } //fecha o if do menu ?>
                    
                </ul>
	        </div>
        </div>
      
    </div>
    <!-- ends navbar -->
    
