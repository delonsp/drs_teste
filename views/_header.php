<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <link rel="shortcut icon" href="img/favicon.ico?v=2">
	<title><?= isset($pageTitle) ? $pageTitle : "DRS Tools"?></title>
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
    <link rel="stylesheet" type="text/css" href="css/bootstrap-select.css">
    <!-- <link rel="stylesheet" type="text/css" href="css/external-pages.css">
    <link rel="stylesheet" type="text/css" href="css/animate.css"> -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic,900italic" rel="stylesheet" type='text/css'> -->
    <script src="js/jquery-1.11.3.min.js"></script>
    <style type="text/css">


	.btn-login {
		margin-top: 20px;
		line-height: 16px;
		width: 240px;
	}


	fieldset input[type=text], fieldset input[type=password], fieldset input[type=email] {
		margin-bottom: 15px;
		padding: 4px;
		font-size: 13px;
		line-height: 16px;
		width: 240px;
		border: 1px solid #ccc;
		border-radius: 3px;
	}
	

	.checkbox {
		padding-left: 50px;
		margin-top: 10px;
	}

    .blue {
        color: blue;
    }
	</style>
</head>
<body>
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
                    <?php if ($_SESSION['user_logged_in'] != 1) {
                        echo '<li><a href="index.php">Login</a></li>';
                        echo '<li><a href="index.php?register">Novo usuário</a></li>';
                    } else {
                        
                    ?>
                                     
                    <li><a href="index.php?logout">Logout</a></li>
                    <li><a href="medicamentos.php">Medicamentos</a></li>
                    <li><a href="medicamentos.php?man=1">Manipulados</a></li>
                    <li><a href="SADT.php">Exames</a></li>
                    <li><a href="atestado.php">Atestados</a></li>
                    <li class="dropdown">
                        <a href="#" id="drop" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Config <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="ConfigUser.php">Dados de Usuário</a></li>
                            <li><a href="ConfigLocais.php">Dados de Locais de Atendimento</a></li>
                            <li><a href="ConfigPharma.php">Dados de Farmácias</a></li>
                        </ul>

                    </li>
                    <?php } //fecha o if do menu ?>
                    
                </ul>
	        </div>
        </div>
      
    </div>
    <!-- ends navbar -->
    <div class="row">
        <div class="col-md-3 col-sm-4 col-xs-8" id="logged-in-as">
            <?php echo ($_SESSION['user_name']  ? '<div class="alert alert-warning" role="alert">
  <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span> ' . WORDING_YOU_ARE_LOGGED_IN_AS .
  "<b>" . $_SESSION['user_name']. "</b>" . '</div>' : '' ); ?>
        </div>
    </div>
  



