<?php
    /*$projects =mysqli_query($con, "select * from project");
    $priorities =mysqli_query($con, "select * from priority");
    $statuses =mysqli_query($con, "select * from status");
    $kinds =mysqli_query($con, "select * from kind");
    $categories =mysqli_query($con, "select * from category");*/
    $empleado =sqlsrv_query($conn, "select * from empleados where status='1' order by nombre asc") or die( print_r( sqlsrv_errors(), true));
?>

    <div> <!-- Modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg-add"><i class="fa fa-plus-circle"></i> Agregar Asistencia</button>
    </div>
    <div class="modal fade bs-example-modal-lg-add" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Agregar Asistencia</h4>
                </div>
                <div class="modal-body"> 
                    <form class="form-horizontal form-label-left input_mask" method="post" id="add" name="add" enctype="multipart/form-data">
                        <div id="result"></div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Folio
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <?php
                                $folio = sqlsrv_query($conn,"select id=coalesce(max(id_ticket),0) from ticket") or die (print_r(sqlsrv_errors(),true));
                                $row = sqlsrv_fetch_array($folio);
                                $numrows = $row['id'];
                                $id_ticket=$numrows + 1;
                                ?>
                               <input type="text" name="title" class="form-control" value="<?php echo $id_ticket; ?>" readonly="readonly">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Solicitante<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                               <select class="form-control" name="kind_id" onchange="proyecto();">
                                     <option selected="" value="">-- Selecciona --</option>                                      
                                      <?php while ($row = sqlsrv_fetch_array($empleado, SQLSRV_FETCH_ASSOC)) { ?>
                                        <option value="<?php echo $row['idempleado']; ?>"><?php echo htmlentities($row['nombre'].' '.$row['apellido_p'].' '.$row['apellido_m']); ?></option>
                                      <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Asistencia a solicitar
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="project_id" >
                                   <option selected="" value="">-- Selecciona --</option>
                                    <option value="ERP">ERP (Atención a usuario)</option>
                                    <option value="REPORTEADOR">Reporteador</option>
                                    <option value="INTRANET">Intranet Módulo(s)</option>
                                    <option value="IMPRESORA">Impresora</option>
                                    <option value="INTERNET">Internet</option>
                                    <option value="PC">PC Escritorio</option>
                                    <option value="LAPTOP">Laptop</option>
                                    <option value="CORREO">Correo</option>
                                    <option value="OFFICE">Paquetería Office</option>
                                    <option value="RELOJ CHECADOR">Reloj Checador (Dispositivo)</option>
                                    <option value="SISTEMA CHECADOR">Sistema Checador (Aplicación/Software)</option>
                                    <option value="TELEFONÍA">Línea(s) Teléfonica(s)</option>
                                    <option value="ANTIVIRUS">Antivirus</option>
                                    <option value="OTROS">Otros servicios</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Descripción asistencia <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <textarea name="description" class="form-control col-md-7 col-xs-12"  placeholder="Descripción"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Adjuntar archivo
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="file" name="file" class="form-control" placeholder="" >
                            </div>
                        </div>
                    
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                              <button id="save_data" type="submit" class="btn btn-success">Guardar</button>
                            </div>
                        </div>    
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div> <!-- /Modal -->