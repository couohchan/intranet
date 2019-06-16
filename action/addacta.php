<?php	
	session_start();
	/*Inicia validacion del lado del servidor*/
	/*if (empty($_POST['title'])) {
           $errors[] = "Titulo vacío";
        } else if (empty($_POST['description'])){
			$errors[] = "Description vacío";
		} else if (
			!empty($_POST['title']) &&
			!empty($_POST['description'])
		){*/


		include "../config/serviweb.php";//Contiene funcion que conecta a la base de datos

		$title = $_POST["title"];
		$description = $_POST["description"];
        $residente = $_POST["residente"];
        $contratista = $_POST["contratista"];
        $recibe = $_POST["recibe"];
        $proyecto = $_POST["proyec"];
        $parteobra = $_POST["parteobra"];
        $entrega = $_POST["entrega"];
        $puestores = $_POST["puestores"];
        $empresares = $_POST["empresares"];
        $puestoc = $_POST["puestoc"];
        $empresac = $_POST["empresac"];
        $puestor = $_POST["puestor"];
        $empresar = $_POST["empresar"];
        $estado = "AC";
        $fcrea = date("d/m/Y");
        $hcrea = date("H:i:s");
        $fmodif = date("d/m/Y");
        $hmodif = date("H:i:s");
        
        $folio = sqlsrv_query($conn,"select id=coalesce(max(id_acta),0) from acta_entrega") or die( print_r( sqlsrv_errors(), true));
        $row = sqlsrv_fetch_array($folio);
        $numrows = $row['id'];
        $id_acta = $numrows + 1;
        

        //echo "insert into acta_entrega id_acta,proyecto,cliente,residente,contratista,recibe,descripcion,parte_obra,hora_entrega,fecha_creacion,hora_creacion,fecha_modifico,hora_modifico,estado,puestores,empresares,puestoc,empresac,puestor,empresar) value (\"$id_acta\",\"$proyecto\",\"$title\",\"$residente\",\"$contratista\",\"$recibe\",\"$description\",\"$parteobra\",\"$entrega\",\"$fcrea\",\"$hcrea\",\"\",\"\",\"$estado\",\"$puestores\",\"$empresares\",\"$puestoc\",\"$empresac\",\"$puestor\",\"$empresar\")";

		$sql="insert into acta_entrega (id_acta,proyecto,cliente,residente,contratista,recibe,descripcion,parte_obra,hora_entrega,fecha_creacion,hora_creacion,fecha_modifico,hora_modifico,estado,puestores,empresares,puestoc,empresac,puestor,empresar) values ('$id_acta','$proyecto','$title','$residente','$contratista','$recibe','$description','$parteobra','$entrega','$fcrea','$hcrea','$fmodif','$hmodif','$estado','$puestores','$empresares','$puestoc','$empresac','$puestor','$empresar')";

		$query_new_insert = sqlsrv_query($conn,$sql);
			if ($query_new_insert){
				$messages[] = "Tu acta ha sido ingresado satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".die( print_r( sqlsrv_errors(), true));
			}
		/*} else {
			$errors []= "Error desconocido.";
		}*/
		
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