<?php 
ob_start();
session_start();
require_once 'config.php'; 
?>
<?php 
	if( !empty( $_POST )){
		try {
			$user_obj = new Cl_User();
			$data = $user_obj->login( $_POST );
			if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']){
				header('Location: home.php');
			}
		} catch (Exception $e) {
			$error = $e->getMessage();
		}
	}
	//print_r($_SESSION);
	if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']){
		header('Location: home.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Página de inicio de sesión</title>
    <link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
    
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
    <link href="css/stylish-portfolio.css" rel="stylesheet" type="text/css"/>
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    
    <div>
        <title>Dai Credit</title>
        <img src="" style="" class="img-responsive img-rounded" alt=""/>
    </div>
    
  </head>
  <body>
        <header id="top" class="header">
            <div class="container">
		<div class="login-form">
			<?php require_once 'templates/message.php';?>
			<div class="form-header">
				<i class="fa fa-user"></i>
                                <h2>Eranova Web App</h2>
                                <small>Vendemos <strong>con estilo</strong>.</small>
			</div>
			<form id="login-form" method="post" class="form-signin" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<input name="rut" id="rut" type="rut" class="form-control" placeholder="Rut" autofocus> 
				<input name="password" id="password" type="password" class="form-control" placeholder="Contraseña"> 
				<button class="btn btn-block bt-login" type="submit" id="submit_btn" data-loading-text="Iniciando....">Iniciar sesión</button>
			</form>
			<div class="form-footer">
				<div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
					<i class="fa fa-lock"></i>
					<a href="forget_password.php"> Olvidó su contraseña? </a>
					
                                    </div>
				</div>
			</div>
		</div>
	</div>
        </header>

	<!-- /container -->
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/login.js"></script>
  </body>
</html>
<?php ob_end_flush(); ?>
