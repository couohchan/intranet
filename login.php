<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="Abdiel">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Intranet - Serviclimas</title>

    <!-- Bootstrap CSS -->    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="css/elegant-icons-style.css" rel="stylesheet" />
    <link href="css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />
    <!-- CSS Alertfy-->
    <script type="text/javascript" src="alertify/lib/alertify.js"></script>
	<link rel="stylesheet" href="alertify/themes/alertify.core.css" />
	<link rel="stylesheet" href="alertify/themes/alertify.default.css" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <script>
			function error(){
				alertify.error("Usuario o Constraseña incorrecto/a."); 
				return false; 
			}
    </script>
</head>

  <body class="login-img3-body">
    <?php
    session_start();
    
    //Función verificar_login()
    //Vamos a crear una función llamada verificar_login, esta se encargara de hacer una
    //consulta a la base de datos para saber si el usuario ingresado es correcto o no.
    function verificar_login($user,$password,&$result)
        {  
            //$serverName = "covi-pc"; //serverName\instanceName
            $serverName = "SKYNET\INTRANET";
            //$serverName = "servconta\compac";
            $datos = "serviweb";

            $connectionInfo = array( "Database"=>"$datos", "UID"=>"sa", "PWD"=>"covi", "CharacterSet" => "utf-8");
            //$connectionInfo = array( "Database"=>"$datos", "UID"=>"sa", "PWD"=>"compac", "CharacterSet" => "utf-8");
            $conn = sqlsrv_connect( $serverName, $connectionInfo);
            if( $conn ) {
                 //echo "Conexión establecida a $datos";
            }else{
            //echo "Conexión no se pudo establecer.<br />";
            die( print_r( sqlsrv_errors(), true));
            }
        
            $sql = "select * from EMPLEADOS WHERE usuario = '$user' and clave = '$password' and status=1";
            $rec = sqlsrv_query($conn, $sql) or die( print_r( sqlsrv_errors(), true));
            $count = 0;
            while($row = sqlsrv_fetch_object($rec)) 
            {
                $count++;
                $result = $row;
            }
            if($count == 1)
            {
                return 1;
            }
            else
            {
                return 0;
            }
        }

    //Luego haremos una serie de condicionales que identificaran el momento en el boton de login es presionado y cuando
    //este sea presionado llamaremos a la función verificar_login() pasandole los parámetros ingresados:

    if(!isset($_SESSION['userid'])) //es para saber si existe o no ya la variable de sesión que se va a crear cuando el usuario se logee
    {
        if(isset($_POST['login'])) //Si la primera condición no pasa, haremos otra preguntando si el boton de login fue presionado
        {
            if(verificar_login($_POST['user'],$_POST['password'],$result) == 1) //Si el boton fue presionado llamamos a la función verificar_login() dentro de otra condición preguntando si resulta verdadero y le pasamos los valores ingresados como parámetros.
            {
                $_SESSION['registrado']="si";
                $_SESSION['username'] = $result->nombre.' '.$result->apellido_p.' '.$result->apellido_m; //Si el login fue correcto, registramos la variable de sesión y al mismo tiempo refrescamos la pagina index.php.
                $_SESSION['ides'] = $result->idempleado;
                $_SESSION['nivelus'] = $result->nivel;
               
                header("location:index.php");
            }
            else //Si la variable de sesión ‘userid’ ya existe, que muestre el mensaje de saludo.
            {
               // echo '<div class="error">Su usuario es incorrecto, intente nuevamente. </div>'; //Si la función verificar_login() no pasa, que se muestre un mensaje de error.
               echo "<script>";
               echo "error();";
               echo "</script>";
            }
        }
?>

    <div class="container">
      <form class="login-form" action="login.php" method="post">        
        <div class="login-wrap">
            <p class="login-img"><i class="icon_lock_alt"></i></p>
            <div class="input-group">
              <span class="input-group-addon"><i class="icon_profile"></i></span>
              <input type="text" class="form-control" name="user" placeholder="Usuario" onkeyup="this.value=this.value.toUpperCase();" autofocus>
            </div>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                <input type="password" class="form-control" name="password" placeholder="Contraseña">
            </div>
            <button class="btn btn-primary btn-lg btn-block" type="submit" name="login" >Iniciar Sesión</button>
        </div>
      </form>
    </div>
    
    <?php } ?>
        
    <!-- javascripts -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- nice scroll -->
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <!-- gritter -->
   
    <!-- custom gritter script for this page only-->
    <script src="js/gritter.js" type="text/javascript"></script>
    <!--custome script for all page-->
    <script src="js/scripts.js"></script>
        
  </body>
</html>