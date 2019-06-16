<?php 
    include("head.php"); 
    include("sidebar.php"); 
?>   
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i> BIENVENIDO </li>
              <li><i class="icon_profile"></i><?php echo $_SESSION['ides']; ?></li>
              <li><i class="fa fa-user-md"></i><?php echo $_SESSION['username']; ?></li>
              <li><i class="icon_cogs"></i><?php echo $_SESSION['nivelus']; ?></li>
            </ol>
          </div>
        </div>
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                   <!--<a class='btn btn-primary' data-toggle='modal' href='#myModal'><i class="icon_plus_alt2"></i> Nueva Solicitud</a>-->
                   <?php
                        include("modal/new_ticket.php");
                        //include("modal/upd_ticket.php");
                    ?>
                    <header class="panel-heading" align="center">
                        <span>SOLICITUD DE SERVICIOS</span><?php echo"&nbsp &nbsp &nbsp"; ?>
                    </header>
 
                    <?php
                    $count_query   = sqlsrv_query($conn, "SELECT count(*) AS numrows FROM ticket") or die( print_r( sqlsrv_errors(), true));
                    $row= sqlsrv_fetch_array($count_query);
                    $numrows = $row['numrows'];
                    if ($numrows==0){ ?>

                    <div class="alert alert-warning alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <strong>Aviso!</strong> No hay datos para mostrar!
                    </div>

                    <?php }else { ?>
                    <table class="table table-striped table-advance table-hover">
                        <thead>
                          <tr>
                            <th># Servicio</th>
                            <th>Fecha solicitud</th>
                            <th>Solicitó</th>
                            <th>Tipo Servicio</th>
                            <th>Comentarios</th>
                            <th>Adjuntos</th>
                            <th>Estatus</th>
                            <th>Modificar</th>
                          </tr>
                        </thead>

                        <tbody>
                           <?php 
                           $count_query  = sqlsrv_query($conn, "SELECT * FROM ticket") or die( print_r( sqlsrv_errors(), true));
                            while($row = sqlsrv_fetch_array($count_query, SQLSRV_FETCH_ASSOC))    { 
                           ?>
                              <tr>
                                <td><?php print $row['id_ticket']; ?></td>
                                <td><?php print $row['fcreacion'];  ?></td>
                                <td><?php print $row['nombre'];  ?></td>
                                <td><?php print $row['servicio'];  ?></td>
                                <td><?php print $row['descripcion'];  ?></td>
                                <td><a target="_blank" href="img/adjuntos/<?php print $row['adjunto']; ?>"><?php print $row['adjunto']; ?></a></td>
                                <?php if($row['estado'] == 'AC'){ ?>
                                <td><span class="label label-success">Activo</span></td>
                                <td>
                                  <div class="btn-group">
                                    <!--<a class="btn btn-primary" data-toggle="modal" href="#editarServicio<?php print $rt->fields['folio']; ?>"><i class="icon_check_alt2"></i><?php print ($rt->fields['folio']); ?></a>-->
                                  </div>
                                </td>
                                <?php } elseif ($row['estado'] == 'EP'){ ?>
                                <td><span class="label label-warning">En Proceso</span></td>
                                <td></td>
                                <?php } elseif ($row['estado'] == 'CA'){ ?>
                                <td><span class="label label-danger">Cerrado</span></td>
                                <td></td>
                                <?php } ?>
                              </tr>

                           <?php }} ?>
                        </tbody>                
                    </table>
                </section>
            </div>
        </div>
        <!-- page end-->

      </section>
    </section>
    <!--main content end-->
    
  <?php include("footer.php");  ?>
  
 <script>
/*$("#add").submit(function(event) {
  $('#save_data').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "action/addticket.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#result").html("Mensaje: Cargando...");
              },
            success: function(datos){
            $("#result").html(datos);
            $('#save_data').attr("disabled", false);
            load(1);
          }
    });
  event.preventDefault();
})*/
   
$("#add").submit(function(event) {
  var formData = new FormData($("#add")[0]);
     $.ajax({
            type: "POST",
            url: "action/addticket.php",
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function(objeto){
                $("#result").html("Mensaje: Cargando...");
              },
            success: function(datos){
            $("#result").html(datos);
            $('#save_data').attr("disabled", false);
            load(1);
          }
    });
  event.preventDefault();
})


$( "#upd" ).submit(function( event ) {
  $('#upd_data').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "action/updticket.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#result2").html("Mensaje: Cargando...");
              },
            success: function(datos){
            $("#result2").html(datos);
            $('#upd_data').attr("disabled", false);
            load(1);
          }
    });
  event.preventDefault();
})

    function obtener_datos(id){
        var description = $("#description"+id).val();
        var title = $("#title"+id).val();
        var kind_id = $("#kind_id"+id).val();
        var project_id = $("#project_id"+id).val();
        var category_id = $("#category_id"+id).val();
        var priority_id = $("#priority_id"+id).val();
        var status_id = $("#status_id"+id).val();
            $("#mod_id").val(id);
            $("#mod_title").val(title);
            $("#mod_description").val(description);
            $("#mod_kind_id").val(kind_id);
            $("#mod_project_id").val(project_id);
            $("#mod_category_id").val(category_id);
            $("#mod_priority_id").val(priority_id);
            $("#mod_status_id").val(status_id);
        }

</script>