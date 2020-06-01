<?php 
require_once "../../Clases/conexion.php";
require_once "../../Clases/clientes.php";
require_once "../../Clases/articulos.php";
$obj= new clientes();
$obj1= new articulos();
$lista=$obj->MostrarClientes();
$lista1=$obj1->MostrarArticulos();



?>
<h4>Vender Productos</h4>
<div class="row">
	<div class="col-sm-4">
		<form id="frm_ventaProductos" >
			<label>Selecciona un Cliente</label>
			<select id="cmb_cliente" class="form-control input-sm" name="cmb_cliente">
				<option value="A">Seleccionar</option>
				<option value="0">Sin Cliente</option>				
				<?php 
				$var=0;
				$longitud=sizeof($lista);
				while ($var < $longitud) {
					# code... 
					if ($lista[$var][0]!=0) {
						# code...

						?>
						<option value="<?php  echo $lista[$var][0] ?>"><?php echo $lista[$var][1]. " ".$lista[$var][2]; ?></option>

						<?php 
					}
					$var++;
				}
				?>
			</select>

			<label>Productos</label>
			<select id="cmb_producto" class="form-control input-sm" name="cmb_producto">
				<option value="A">Seleccionar</option>
				<?php 
				$var=0;
				$longitud=sizeof($lista1);
				while ($var < $longitud) {
					?>
					<option value="<?php echo $lista1[$var][6] ?>"> <?php echo $lista1[$var][0] ; ?></option>
					<?php 
					$var++;
				}
				?>
			</select>
			<label>Descripcion</label>
			<textarea readonly="" class="form-control input-sm" id="descripcion" name="descripcion"></textarea>
			<label>Cantidad</label>
			<input readonly=""  type="number" class="form-control input-sm" id="cantidad" name="cantidad">
			<label>Precio</label>
			<input readonly=""  type="number" class="form-control input-sm" id="precio" name="precio">
			<p></p>
			<span id="btn_registrarVenta" class="btn btn-primary">Registrar</span>
			<span id="btn_vaciar" class=" btn btn-danger">Vaciar Tabla</span>

		</form>
	</div>
	<div class="col-sm-3">
		<div id="imgproducto"></div>
		
	</div>
	<br>
	<div class="col-sm-4">
		<div id="tablaVentasTemp"></div>
	</div>

</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('#tablaVentasTemp').load("Ventas/tablaVentasTemp.php");

		$('#cmb_producto').change(function() {
			/* change se una para cuando se hace un cabio en la selccion del combo  se ejecute unas intrucciones */

			$.ajax({
				url: '../Procesos/Ventas/llenarFormularioProducto.php',
				type: 'POST',
				data:'idproducto=' + $('#cmb_producto').val() ,
				success: function(r){
					//alert(r);
					$datos=jQuery.parseJSON(r);
					$ruta="../Archivos/"+$datos['ruta'] ;
                    //console.log($ruta);
                    $('#descripcion').val($datos['descripcion']);
                    $('#cantidad').val($datos['cantidad']);
                    $('#precio').val($datos['precio']);
                    $('#imgproducto').prepend('<img class="img-thumbnail" id="imgp" src="'+$ruta+ '"/>');


                }
            });			
			


		});

		$('#btn_registrarVenta').click(function(event) {
			/* Act on the event */
			vacios=ValidarFormularioVacio('frm_ventaProductos');

			if (vacios > 0) {
				alertify.alert("Debes llenar todos los campos");

				return false;
			}
			datos=$('#frm_ventaProductos').serialize();
			$.ajax({
				url: '../Procesos/Ventas/agregarProductoTemporal.php',
				type: 'POST',
				data: datos,
				success:function(r){

					//$('#frm_ventaProductos')[0].reset();
					$('#tablaVentasTemp').load("Ventas/tablaVentasTemp.php");


					//alert(r);
				}
			});
			
			
		});
		$('#btn_vaciar').click(function(event) {
			/* Act on the event */
			$.ajax({
				url: '../Procesos/Ventas/vaciarTablaTemp.php',
				success:function(r){

					$('#tablaVentasTemp').load("Ventas/tablaVentasTemp.php");
				}
			});
			
			
		});
		
	});

</script>
<script type="text/javascript">
	function QuitarProducto(index){
		$.ajax({
			url: '../Procesos/Ventas/quitarProducto.php',
			type: 'POST',
			data: 'index='+index,
			success:function(r){
				$('#tablaVentasTemp').load("Ventas/tablaVentasTemp.php");
				alertify.success("producto eliminado");

			}
		});
		
		
	}
	function CrearVenta(){
		$.ajax({
			url: '../Procesos/Ventas/crearVenta.php',
			success:function(r){
				//alert(r);
				if (r>0) {
					$('#tablaVentasTemp').load("Ventas/tablaVentasTemp.php");
					$('#ventaProductos').load("Ventas/ventaProductos.php");
					//$('#frm_ventaProductos')[0].reset();	NO FUNCIONO EL RESET EN LOS COMBO				
					alertify.alert("vanta creada con exito, consulte la informacion de esta venta en ventas echas");

				}else if (r==0) {
					$('#tablaVentasTemp').load("Ventas/tablaVentasTemp.php");

					alertify.alert("no hya lista de venta");
				}else{
					alertify.error("no se peudo crear la venta");
				}

			}
		});

		
	}
	

</script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#cmb_cliente').select2();
		$('#cmb_producto').select2();
	});
</script>