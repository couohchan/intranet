<?php	
  session_start();

  include "../config/serviweb.php";//Contiene funcion que conecta a la base de datos

  $folio = $_POST["title"];
  $descripcion = $_POST["description"];
  //$category_id = $_POST["category_id"];
  $asistencia = $_POST["project_id"];
  //$priority_id = $_POST["priority_id"];
  //$user_id = $_SESSION["user_id"];
  //$status_id = $_POST["status_id"];
  $solicitante = $_POST["kind_id"];
  //$adjunto = $_POST["adjunto"];
  //$created_at="NOW()";

  if (isset($_FILES["file"]))
  {
      $file = $_FILES["file"];
      $name = $file["name"];
      $type = $file["type"];
      $tmp_n = $file["tmp_name"];
      $size = $file["size"];
      $folder = "../img/adjuntos/";

      if ($type != 'image/jpg' && $type != 'image/jpeg' && $type != 'image/png' && $type != 'image/gif')
      {
        echo "Error, el archivo no es una imagen"; 
      }
      else if ($size > 1024*1024)
      {
        echo "Error, el tamaño máximo permitido es un 1MB";
      }
      else
      {
         $src = $folder.$name;
         @move_uploaded_file($tmp_n, $src);
      }
  }

  $user_id=$_SESSION['ides'];

  $info = sqlsrv_query($conn,"select idempleado=coalesce(idempleado,''),nomcompleto=(nombre+' '+apellido_p+' '+apellido_m),nomarea=coalesce(nomarea,''),jefe=(select nombre+' '+apellido_p+' '+apellido_m from empleados E where E.idempleado= D.jefearea) from empleados E inner join deptoarea D on E.area=D.iddepto where E.status=1 and idempleado=$solicitante") or die (print_r(sqlsrv_errors(),true));
  $row = sqlsrv_fetch_array($info);
  $nombre = $row['nomcompleto'];
  $depto = $row['nomarea'];
  $jefe = $row['jefe'];
  //id_ticket,idempleado,nombre,depto,jefe,servicio,descripcion,adjunto,estado,finicial,ffinal,hinicial,hfinal,comentarios,fcreacion,hcreacion,fmodificacion,hmodificacion,modifico

  //echo "insert into ticket (id_ticket,idempleado,nombre,depto,jefe,servicio,descripcion,adjunto,estado,finicial,ffinal,hinicial,hfinal,comentarios,fcreacion,hcreacion,fmodificacion,hmodificacion,modifico,creador) value (\"$folio\",\"$solicitante\",\"$nombre\",\"$depto\",\"$jefe\",\"$asistencia\",\"$descripcion\",\"$name\",\"AC\",\" \",\" \",\" \",\" \",\" \",\" \",\" \",\" \",\" \",\" \",\"$user_id\")";

  $sql="insert into ticket (id_ticket,idempleado,nombre,depto,jefe,servicio,descripcion,adjunto,estado,finicial,ffinal,hinicial,hfinal,comentarios,fcreacion,hcreacion,fmodificacion,hmodificacion,modifico,creador) values ('$folio','$solicitante','$nombre','$depto','$jefe','$asistencia','$descripcion','$name','AC',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ','$user_id')";

  $query_new_insert = sqlsrv_query($conn,$sql);
      if ($query_new_insert){
          $messages[] = "Tu ticket ha sido ingresado satisfactoriamente.";
      } else{
          $errors []= "Lo siento algo ha salido mal intenta nuevamente.".die( print_r( sqlsrv_errors(), true));
      }

  if (isset($errors)){

      ?>
  <div class="alert alert-danger" role="alert">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Error!</strong>
  <?php
                  foreach ($errors as $error) {
                          echo $error;
                      }
                  ?>
  </div>
  <?php
      }
      if (isset($messages)){

          ?>
  <div class="alert alert-success" role="alert">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>¡Bien hecho!</strong>
  <?php
                      foreach ($messages as $message) {
                              echo $message;
                          }
                      ?>
  </div>
  <?php
      }
?>