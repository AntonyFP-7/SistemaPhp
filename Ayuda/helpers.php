<script type="text/javascript">
	//scrip para evento click en ajax
	$('#').click(function() {
		/* Act on the event */
		datos=$('#').serialize();
		$.ajax({
			type:"POST",
			data:datos,
			url:"../Procesos/",
			success:function(r){

			}
		});
	});


	//funcion para validad datos vacios
	function ValidarDatosVacios(formulario) {
		// body...
		datos=$('#'+formulario).serialize();
		d=datos.split('&');
		vacios=0;
		for (i = 0; i < d.length; i++) {
			controles=d[i].split('=');
			if (controles[1]=="A"||controles[1]=="") {
				vacios++;
			}
		}
	}
</script>