<?php
    //$projects =mysqli_query($con, "select * from project");
    //$priorities =mysqli_query($con, "select * from priority");
    //$statuses =mysqli_query($con, "select * from status");
    $kinds =sqlsrv_query($link, "select Py_Cve_Proyecto, Py_Descripcion, Py_Cliente, ISNULL(Cl_Cve_Cliente,'') as Cl_Cve_Cliente, ISNULL(Cl_Descripcion,'') as Cl_Descripcion from proyecto p left join cliente c on Py_cliente=Cl_Cve_Cliente where p.Es_Cve_Estado='AC' order by Py_Descripcion") or die( print_r( sqlsrv_errors(), true));
    //$categories =mysqli_query($con, "select * from category");
?>
<script>
    function proyecto(){
        var pro = document.add.kind_id.value;
        var result = pro.split("///");
        
        document.add.proyec.value=result[0];
        document.add.title.value=result[1];
    }
</script>

    <div> <!-- Modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg-add"><i class="fa fa-plus-circle"></i> Nueva Acta</button>
    </div>
    <div class="modal fade bs-example-modal-lg-add" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Nueva Acta</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="add" name="add">
                        <div id="result"></div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Proyecto
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="kind_id" onchange="proyecto();" required>
                                     <option selected="" value="">-- Selecciona --</option>                                    
                                      <?php while ($row = sqlsrv_fetch_array($kinds, SQLSRV_FETCH_ASSOC)) { ?>
                                        <option value="<?php echo $row['Py_Descripcion']."///".$row['Cl_Descripcion']; ?>"><?php echo htmlentities($row['Py_Descripcion']); ?></option>
                                      <?php } ?>
                                </select>
                                <input type="text" name="proyec" class="form-control" placeholder="" style="visibility:hidden" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Cliente</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" name="title" class="form-control" placeholder="" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Parte Obra</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" name="parteobra" class="form-control" placeholder="" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Hora Entrega</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="time" name="entrega" class="form-control" placeholder="" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Residente
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" name="residente" class="form-control" placeholder="" value="ING. ALEX ALFONSO AKÉ CAB" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Puesto
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" name="puestores" class="form-control" placeholder="" value="RESIDENTE DE INSTALACIONES">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Empresa
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" name="empresares" class="form-control" placeholder="" value="NIUTEC S.A. DE C.V." >
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Contratista
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" name="contratista" class="form-control" placeholder="" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Puesto
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" name="puestoc" class="form-control" placeholder="" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Empresa
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" name="empresac" class="form-control" placeholder="" >
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Recibe
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" name="recibe" class="form-control" placeholder="" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Puesto
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" name="puestor" class="form-control" placeholder="" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Empresa
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" name="empresar" class="form-control" placeholder="" >
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Descripción <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <textarea name="description" class="form-control col-md-7 col-xs-12"  placeholder="Descripción"></textarea>
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