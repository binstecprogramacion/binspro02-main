@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@php
    //SECTION TITULO PRINCIPAL
        $SECT_PRINC = "274c77";
        $SECT_PRINC_TEXT = "ffffff";

    //BOTON AGREGAR CUENTA
        $BUTTON_AGRE = "007200";
        $TEXT_BUTTON_AGRE = "ffffff";

    //SECTION SECUNDARIOS
        $colortext = "274C77";
        $fondo_section = "A9D6E5";

    //BOTON CREAR
        $boton_crear = "01497C";
        $text_boton_crear = "ffffff";



@endphp



<section class="p-3 rounded" style="margin-bottom: 15px;margin-left: 20px;margin-right: 20px;background-color:#{{$SECT_PRINC}}; color: #{{$SECT_PRINC_TEXT}}">
  <h1 style="text-align: center;">REGISTRA TU REQUERIMIENTO</h1>
</section>

@stop   

@section('content')



<div class="mx-auto p-3 w-75" style="width: 200px; margin-bottom: 15px;margin-left: 20px;margin-right: 20px;">

	

	<section class="shadow p-3 rounded" >


		<form class=" needs-validation" action="{{route('requerimiento.store')}}" enctype="multipart/form-data" method="POST">
			@csrf

			<div class="form-group">
				<label for="inputAddress">TITULO</label>
				<input type="text" class="form-control form-control-lg" style="border-radius: 10px;" id="titulo" name="titulo" placeholder="Ingrese un titulo">
			</div>

			

			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="inputEmail4">CUENTA</label>

					<select class="form-control form-control-lg" style="border-radius: 10px;" aria-label="Default select example" id="cuentas_id" name="cuentas_id" required>
						<option value="" selected>Seleccione Cuenta</option>
						
					</select>
				</div>

				<div class="form-group col-md-6">
					<label for="inputPassword4" >SEDE</label>
					<select id="sedes_id" name="sedes_id" style="border-radius: 10px;" class="form-control form-control-lg">
						<option value="" selected>Seleccione Sede</option>
					</select>
				</div>
			</div>

				<script>

					ListaCuentas = [];
					ListaCuentas = JSON.parse('<?php echo json_encode($cuentas); ?>');

					ListaSedes = [];
					ListaSedes = JSON.parse('<?php echo json_encode($sedes); ?>');

					const combobox = document.getElementById("cuentas_id");
					
					ListaCuentas.forEach(function(opcion) {
					const option = document.createElement("option");
					option.value = opcion.id;
					option.text = opcion.razonSocial;
					combobox.appendChild(option);
					});

					const cuentas_id = document.getElementById("cuentas_id");
					const sedes_id = document.getElementById("sedes_id");


					cuentas_id.addEventListener("change", function() {
						const valorSeleccionado = this.value;
						let opcionesFiltradas = [];

						var numeroSelec = parseInt(valorSeleccionado);
						
						const comboboxSede = document.getElementById("sedes_id");

						ListaSedes.forEach(function(sedes) {
						
						if (numeroSelec === sedes.cuenta_id) {
							opcionesFiltradas.push(sedes);
						};

						});

						comboboxSede.innerHTML = "";

						

						opcionesFiltradas.forEach(function(opcion) {
								const option = document.createElement("option");
								option.value = opcion.id;
								option.text = opcion.nomSede;
								comboboxSede.appendChild(option);

						});

						
					});

				</script>
			
			
			<div class="form-group">
				<label for="inputAddress2">DESCRIPCION</label>
				<textarea class="form-control" style="border-radius: 10px;" id="exampleFormControlTextarea1" id="descripcion" name="descripcion" rows="4"></textarea>
			</div>



			

			<div class="input-group" style="margin-bottom: 20px;">
				<div class="input-group-prepend">
				<span class="input-group-text" id="inputGroupFileAddon01">Subir evidencia</span>
				</div>
				<div class="custom-file">
				<input type="file" class="custom-file-input " id="imagen" name="imagen"
					aria-describedby="inputGroupFileAddon01">
				<label class="custom-file-label" for="inputGroupFile01">Seleccione imagen</label>
				</div>
			</div>

			

			  <script>
				// JavaScript para previsualizar el nombre del archivo seleccionado
				var input = document.getElementById("imagen");
				var label = document.querySelector(".custom-file-label");
				input.addEventListener("change", function(e) {
				  var fileName = e.target.files[0].name;
				  label.textContent = fileName;
				});
			  </script>

			



			<button type="submit" class="btn" style="border-radius: 10px;background-color: #{{$boton_crear}}; color: #{{$text_boton_crear}};">CREAR TICKET</button>
		</form>


	</section>

</div>






@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop