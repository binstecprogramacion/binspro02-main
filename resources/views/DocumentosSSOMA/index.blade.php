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



<section class="p-3 rounded" style="margin-bottom: 15px;margin-left: 20px;margin-right: 20px;background-color:#{{$SECT_PRINC}};">

    <div class="row lign-items-center" style=" color: #{{$SECT_PRINC_TEXT}};">
        <div class="col-md-6 ">
            <div class="form-group" style="margin-bottom: 0px;">
                <h1>DOCUMENTACION <strong>SSOMA</strong></h1>
            </div>
        </div>
        <div class="col-md-6 ml-auto">
            <div class="form-group" style="margin-bottom: 0px;text-align: RIGHT;">
                <button type="button" class="btn btn-outline-light" data-toggle="modal" data-target="#nuevodocumento">NUEVO</button>
            </div>
        </div>
    </div>

</section>

@stop

@section('content')

    <section class="shadow p-3 rounded" style="margin-bottom: 15px;margin-left: 20px;margin-right: 20px;">


    <div class="row">

        @foreach ($documentssomas as $documentssoma)

            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h4><strong>{{$documentssoma->nombre}}</strong></h4>
                        <h6 style="color: rgb(255, 153, 0)" data-toggle="modal" data-target="#nuevodocumento{{$documentssoma->id}}">EDITAR</h6>
                        <p class="card-text" style="margin-top: 20px;">{{$documentssoma->descripcion}}</p>



                                        <a href="../public/ArchivosSSOMA/{{$documentssoma->pdf}}" target="blank_"><button type="button" class="btn btn-secondary float-right" style="margin-top: 15px; background-color: #{{$boton_crear}}; color: #{{$text_boton_crear}};"><strong>VER DOCUMENTO</strong></button></a>                                                                                            
                                
                                        <a href="{{route('DocSsoma.destroy',$documentssoma)}}"><button type="button" class="btn" style="margin-top: 15px; background-color: #ff0202; color: #fff;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                            </svg>
                                        </button></a>  


                    </div>
                </div>

            </div>

            <!-- MODAL REGISTRAR NUEVO DOCUMENTO COTIZACION-->
                <div class="modal fade" id="nuevodocumento{{$documentssoma->id}}" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">AGREGAR NUEVA DOCUMENTACION</h5>
                            </div>

                            <div class="modal-body">
                                <form class="needs-validation" action="{{route('DocSsoma.store')}}" method="POST" enctype="multipart/form-data"  novalidate>

                                    @csrf

                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">NOMBRE DEL DOCUMENTO:</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputAddress2">DESCRIPCION</label>
                                        <textarea class="form-control" style="border-radius: 10px;" id="descripcion" id="descripcion" name="descripcion" rows="4"></textarea>
                                    </div>
                                    

                                    <div class="input-group" style="margin-bottom: 20px;">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupFileAddon02">Subir evidencia</span>
                                        </div>
                                        <div class="custom-file">
                                        <input type="file" class="custom-file-input " id="apdf" name="apdf"
                                            aria-describedby="inputGroupFileAddon02">
                                        <label class="custom-file-label" for="inputGroupFile02">Seleccione imagen</label>
                                        </div>
                                    </div>
                        
                                    
                        
                                    

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary">Añadir</button>
                                    </div>
                                
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- FIN MODAL REGISTRAR NUEVO DOCUMENTO COTIZACION-->

        @endforeach

    </div>

</section>



<!-- MODAL REGISTRAR NUEVO DOCUMENTO COTIZACION-->
    <div class="modal fade" id="nuevodocumento" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">AGREGAR NUEVA DOCUMENTACION</h5>
                </div>

                <div class="modal-body">
                    <form class="needs-validation" action="{{route('DocSsoma.store')}}" method="POST" enctype="multipart/form-data"  novalidate>

                        @csrf

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">NOMBRE DEL DOCUMENTO:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>

                        <div class="form-group">
                            <label for="inputAddress2">DESCRIPCION</label>
                            <textarea class="form-control" style="border-radius: 10px;" id="descripcion" id="descripcion" name="descripcion" rows="4"></textarea>
                        </div>
                        

                        <div class="input-group" style="margin-bottom: 20px;">
                            <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Subir evidencia</span>
                            </div>
                            <div class="custom-file">
                            <input type="file" class="custom-file-input " id="pdf" name="pdf"
                                aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Seleccione imagen</label>
                            </div>
                        </div>
            
                        
            
                        <script>
                            // JavaScript para previsualizar el nombre del archivo seleccionado
                            var input = document.getElementById("pdf");
                            var label = document.querySelector(".custom-file-label");
                            input.addEventListener("change", function(e) {
                            var fileName = e.target.files[0].name;
                            label.textContent = fileName;
                            });
                        </script>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Añadir</button>
                        </div>
                    
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- FIN MODAL REGISTRAR NUEVO DOCUMENTO COTIZACION-->

    
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop