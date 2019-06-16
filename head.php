<?php
session_start();
include("config/serviweb.php");
//include("config/niutec.php");
if (isset($_SESSION['registrado']) == true) {
} else {
   echo "Esta pagina es solo para usuarios registrados.<br>";
   echo "<br><a href='login.php'>Login</a>";
exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
  <meta name="author" content="Abdiel Couoh">
  <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
  <link rel="shortcut icon" href="img/favicon.png">
  <title>Sistema | Intranet - Serviclimas</title>
  <!-- Bootstrap CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- bootstrap theme -->
  <link href="css/bootstrap-theme.css" rel="stylesheet">
  <!--external css-->
  <!-- font icon -->
  <link href="css/elegant-icons-style.css" rel="stylesheet" />
  <link href="css/font-awesome.min.css" rel="stylesheet" />
  <!-- Custom styles -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet" />

  <!-- CSS Alertfy-->
  <script type="text/javascript" src="css/alertify/lib/alertify.js"></script>
	<link rel="stylesheet" href="css/alertify/themes/alertify.core.css" />
	<link rel="stylesheet" href="css/alertify/themes/alertify.default.css" />
	
	<!-- Script -->
   <script>
      function logout()
      {
        alertify.confirm("<p>¿En realidad desea salir del sistema?<br><br><b>ENTER</b> y <b>ESC</b> corresponden a <b>Aceptar</b> o <b>Cancelar</b></p>", function (e) {
        if (e) {
        var Archivo = "action/logout.php";
        location=[Archivo];
        return true;
        } else { 
        return false;
        }
        }); 
        return false
      }
   </script>
   
</head>

<body>
  <!-- container section start -->
  <section id="container" class="">
    <!--header start-->
    <header class="header dark-bg">
      <div class="toggle-nav">
      <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
      </div>
      <!--logo start-->
      <a href="index.php" class="logo">Servi <span class="lite">Climas</span></a>
      <!--logo end-->
      <div class="top-nav notification-row">
        <!-- notificatoin dropdown start-->
        <ul class="nav pull-right top-menu">
          <!-- user login dropdown start-->
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
              <?php
                $IMAGEN = $_SESSION['ides'];
                echo $IMAGEN." ";

                if ( file_exists("img/empleados/$IMAGEN.jpg") ) {
                   echo "<span class='profile-ava'>";
                   echo "<img src='img/empleados/$IMAGEN' height='40' width='40' /> ";
                   echo "</span>";
                } else {
                   echo "<span class='profile-ava'>";
                   echo "<img alt='' src='img/avatar.jpg'>";// possibly display a placeholder image?
                   echo "</span>";
                }
              ?>

              <span class="username"> <?php echo $_SESSION['username']; ?></span>
              <b class="caret"></b>
              
            </a>
            <ul class="dropdown-menu extended logout">
              <div class="log-arrow-up"></div>
              <li class="eborder-top">
                <a href="#"><i class="icon_profile"></i> Cambiar Usuario</a>
              </li>
              <li>
                <a href="#"><i class="icon_drive_alt"></i> Base pruebas</a>
              </li>
              <li>
                <a onclick="return logout();"><i class="icon_key_alt"></i> Cerrar Sesión</a>
              </li>
            </ul>
          </li>
          <!-- user login dropdown end -->
        </ul>
        <!-- notificatoin dropdown end-->
      </div>
    </header>
    <!--header end-->