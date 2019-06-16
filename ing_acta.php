<?php 
    include("head.php"); 
    include("sidebar.php"); 
?>
   
    <script type="text/javascript">
        /*<!--    function impresionEspecial(){
                var win = window.open("", "Titulo página", "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1200, height=800, top=0, left=0");
                var formulario = document.getElementById('imp').innerHTML;
                win.document.body.innerHTML = formulario + '<br/><hr/><br/>';
                win.print();
                win.close();
            }-->*/
        function impresionEspecial() {
          var objeto=document.getElementById('imp');  //obtenemos el objeto a imprimir
          var ventana=window.open('','_blank');  //abrimos una ventana vacía nueva
          ventana.document.write(objeto.innerHTML);  //imprimimos el HTML del objeto en la nueva ventana
          ventana.document.close();  //cerramos el documento
          ventana.print();  //imprimimos la ventana
          ventana.close();  //cerramos la ventana
        }
        </script>
      
          
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
                        include("modal/new_acta.php");
                        //include("modal/upd_ticket.php");
                        include("modal/imp_acta.php");
                    ?>
                    <header class="panel-heading" align="center">
                        <span><b>ACTAS DE ENTREGA</b></span>
                    </header>
 
                    <?php
                    $count_query   = sqlsrv_query($conn, "SELECT count(*) AS numrows FROM acta_entrega") or die( print_r( sqlsrv_errors(), true));
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
                            <th>Folio</th>
                            <th>Proyecto</th>
                            <th>Cliente</th>
                            <th>Parte Obra</th>
                            <th>Residente</th>
                            <th>Estatus</th>
                            <th>Modificar</th>
                            <th>Imprimir</th>
                          </tr>
                        </thead>

                        <tbody>
                           <?php 
                           $count_query   = sqlsrv_query($conn, "SELECT * FROM acta_entrega where estado='AC'") or die( print_r( sqlsrv_errors(), true));
                            while($row = sqlsrv_fetch_array($count_query, SQLSRV_FETCH_ASSOC))    { 
                           ?>
                              <tr>
                                <td><?php echo $row['id_acta']; ?></td>
                                <td><?php echo $row['proyecto']; ?></td>
                                <td><?php echo $row['cliente']; ?></td>
                                <td><?php echo $row['parte_obra']; ?></td>
                                <td><?php echo $row['residente']; ?></td>
                                <?php if($row['estado'] == 'AC'){ ?>
                                <td><span class="label label-success">Activo</span></td>
                                <td>
                                  <div class="btn-group">
                                    <a class="btn btn-primary" data-toggle="modal" href="#editarServicio<?php print $row['id_acta']; ?>"><i class="icon_check_alt2"></i><?php print ($row['id_acta']); ?></a>
                                  </div>
                                </td>
                                <?php } elseif ($row['estado'] == 'EP'){ ?>
                                <td><span class="label label-warning">En Proceso</span></td>
                                <td></td>
                                <?php } elseif ($row['estado'] == 'CA'){ ?>
                                <td><span class="label label-danger">Cerrado</span></td>
                                <td></td>
                                <?php } ?>
                                <td>
                                  <div class="btn-group">
                                    <a class="btn btn-primary" data-toggle="modal" href="#editarServicio<?php print $row['id_acta']; ?>"><i class="icon_check_alt2" onclick="impresionEspecial()"></i><?php print ($row['id_acta']); ?></a>
                                    <!--<input type="button" onclick="impresionEspecial()" value="Imprimir"/>-->
                                  </div>
                                </td>
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
$("#add").submit(function(event) {
  $('#save_data').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "action/addacta.php",
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
})


$( "#upd" ).submit(function( event ) {
  $('#upd_data').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "action/updacta.php",
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