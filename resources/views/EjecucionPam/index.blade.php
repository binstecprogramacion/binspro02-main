

@extends('adminlte::page')



@section('title', 'EJECUCION PAM')

@section('content_header')

@php

    //color: #{{$colortext}}
    //background-color:#{{$SECT_PRINC}}

        //SECTION TITULO PRINCIPAL
        $SECT_PRINC = "012A4A";
        $SECT_PRINC_TEXT = "ffffff";

        //SECTION SECUNDARIOS
        $colortext = "274C77";
        $fondo_section = "A9D6E5";

        //BOTON CREAR
        $boton_crear = "01497C";
        $text_boton_crear = "ffffff";

        //BOTON ACTUALIZAR
        $boton_actu = "01497C";
        $text_boton_actu = "ffffff";

        //BOTON FACTURAR
        $boton_Facturar = "0f4c5c";
        $text_boton_Facturar = "ffffff";

        //BOTON NO FACTURAR
        $boton_NO_Facturar = "e5383b";
        $text_boton_NO_Facturar = "ffffff";

        //NUEVO COMENTARIO
        $NEW_bg_Comen = "0f4c5c";
        $NEWcolortext = "013A63";
        $NEWfondo_section = "89C2D9";
        
            //BOTON AÑADIR COMENTARIO
            $boton_NUE_COMEN = "012A4A";
            $TEXT_boton_NUE_COMEN = "ffffff";

        // BITACORA-TITULO
        $br_Bitacora = "013A63";
        $br_Bitacora_text = "ffffff";

        // BITACORA COMENTARIOS
        $bg_COMENT = "89C2D9";
        $bg_COMENT_text = "ffffff";

            // BITACORA ASUNTO
            $bg_ASUNTO = "2C7DA0";
            $bg_ASUNTO_text = "ffffff";

            // BITACORA DESCRIPCION
            $bg_DESCRIPCION = "A9D6E5";
            $bg_DESCRIPCION_text = "000000";

@endphp

<section class=" p-3 rounded" style="margin-bottom: 15px;margin-left: 20px;margin-right: 20px;background-color:#{{$SECT_PRINC}};">

    <div class="row align-items-center" style=" color: #{{$SECT_PRINC_TEXT}};">
        <div class="col-md-3  " >
            <div class="form-group" style="margin-bottom: 0px;">
                <h1>
                    <strong>PAM</strong> - 
                    @foreach($cuentas as $cuenta)
                    {{$cuenta->razonSocial}}
                    @endforeach
                    
                </h1>
            </div>
        </div>

        <div class="col-md-3  " >
            <div class="form-group" style="margin-bottom: 0px;">
                <h5 style="margin-bottom: 0px;">
                    @foreach($htestructuras as $htestructura)
                        @foreach($htcategorias as $htcategoria)
                            <?php if ($htcategoria->id == $htestructura->htcategorias_id) { ?>
                                {{$htcategoria->especialidad}}
                            <?php } ?>
                        @endforeach
                    @endforeach
                    
                </h5>
            </div>
        </div>

        <div class="col-md-2 ml-auto" style="margin-right: 20px;">
            <div class="form-group" style="margin-bottom: 0px;">
                <h1>
                    EJEC00{{$pam->id}}
                </h1>
            </div>
        </div>
    </div>
</section>


@stop

@section('content')



<div class="container-fluid">
    <div class="row" style="margin-bottom: 15px;margin-left: 20px;margin-right: 20px;">
        <div class="col-md-4" >

            <section class=" p-3 rounded" style="margin-bottom: 15px;margin-left: 0px;margin-right: 0px; background-color: #{{$fondo_section}};">

                <form>
                    <div class="form-group" style="color: #{{$colortext}};">
                        <div class="row">
                            <div class="col-6">
                                <label for="formGroupExampleInput">Cuenta</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" value="@foreach($cuentas as $cuenta){{$cuenta->razonSocial}}@endforeach" disabled>
                            </div>
                            <div class="col">
                                <label for="formGroupExampleInput2">Sede</label>
                                <input type="text" class="form-control" id="formGroupExampleInput2" value="@foreach($sedes as $sede){{$sede->nomSede}}@endforeach" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" style="color: #{{$colortext}};">
                      
                        @foreach($sedes as $sede)
                            @foreach($alcances as $alcance)
                                <?php if ($sede->alcances_id == $alcance->id) { ?>
                                    <?php $nomPro =$alcance->provincia ?>
                                <?php break; } ?>
                            @endforeach
                        @endforeach

                        <div class="row">
                            <div class="col">
                                <label for="formGroupExampleInput2">Provincia</label>
                                <input type="text" class="form-control" id="formGroupExampleInput2" value="{{$nomPro}}" disabled>
                            </div>

                            <div class="col">
                                <label for="formGroupExampleInput2">Direccion</label>
                                <input type="text" class="form-control" id="formGroupExampleInput2" value="@foreach($sedes as $sede){{$sede->direccion}}@endforeach" disabled>
                            </div>
                        </div>

                    </div>
                </form>

            </section>

            <section class=" p-3 rounded" style="margin-bottom: 15px;margin-left: 0px;margin-right: 0px; background-color: #{{$fondo_section}};">

                <h5 style="color: #{{$colortext}};"><strong> SOLICITUD DE SERVICIO</strong></h5> <br>

                <?php $numer = 0?>
                
                @foreach ($ejecuciones as $ejecucione)
                
                <?php if ($ejecucione->estado_ejecucion == null || $ejecucione->estado_ejecucion == "sin facturar"){ ?> 
                    <form name="ejecucionPam" action="{{route('ejecucion.update',$ejecucione)}}" method="POST" novalidate>

                        @csrf
                        @method('put')

                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-4 col-form-label" style="color: #{{$colortext}};">Estado</label>

                            <div class="col-sm-8">
                                <select class="form-control" name="estado" id="estado" >

                                    @foreach ($ejecuciones as $ejecucione)

                                        <?php if ($ejecucione->estado == null) { ?>
                                            <option value="">Seleccione proveedor</option>
                                            <option value="Realizado">Realizado</option>
                                            <option value="En Proceso">En Proceso</option>
                                            <option value="Pendiente">Pendiente</option>
                                        <?php } ?>
                                        
                                        <?php if ($ejecucione->estado == "Realizado") { ?>
                                            <option value="Realizado" selected>Realizado</option>
                                            <option value="En Proceso">En Proceso</option>
                                            <option value="Pendiente">Pendiente</option>
                                        <?php } ?> 

                                        <?php if ($ejecucione->estado == "En Proceso") { ?>
                                            <option value="Realizado">Realizado</option>
                                            <option value="En Proceso" selected>En Proceso</option>
                                            <option value="Pendiente">Pendiente</option>
                                        <?php } ?> 

                                        <?php if ($ejecucione->estado == "Pendiente") { ?>
                                            <option value="Realizado">Realizado</option>
                                            <option value="En Proceso">En Proceso</option>
                                            <option value="Pendiente" selected>Pendiente</option>
                                        <?php } ?> 
                                        
                                    @endforeach

                                </select>
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-4 col-form-label" style="color: #{{$colortext}};">Proveedor</label>

                            <div class="col-sm-8">
                                <select class="form-control" name="omologados_id" id="omologados_id" >

                                    @foreach ($ejecuciones as $ejecucione)
                                        <?php if ($ejecucione->omologados_id == null) { ?>
                                            <option value="">Seleccione proveedor</option>
                                        <?php } ?>
                                    @endforeach

                                    

                                    @foreach($omologados as $omologado)
                                        @foreach ($sedes as $sede)
                                            @foreach ($htcategorias as $htcategoria)
                                                <?php if ($htcategoria->id == $omologado->htcategorias_id && $sede->alcances_id == $omologado->alcances_id) { ?>

                                                    @foreach ($ejecuciones as $ejecucione)
                                                        <?php if ($ejecucione->omologados_id == $omologado->id ) { ?>
                                                            <option value="{{$omologado->id}}" selected>
                                                                @foreach ($proveedos as $proveedo)
                                                                    <?php if ($proveedo->id == $omologado->proveedos_id) { ?>
                                                                        {{$proveedo->razSocProv}}
                                                                    <?php } ?>
                                                                @endforeach
                                                            
                                                            </option>
                                                        <?php } else { ?>
                                                            
                                                            <option value="{{$omologado->id}}">
                                                                @foreach ($proveedos as $proveedo)
                                                                    <?php if ($proveedo->id == $omologado->proveedos_id) { ?>
                                                                        {{$proveedo->razSocProv}}
                                                                    <?php } ?>
                                                                @endforeach
                                                            </option>

                                                        <?php }?>   
                                                    @endforeach
                                                <?php } ?>
                                            @endforeach

                                            
                                        @endforeach

                                    @endforeach
                                    
                                </select>
                            </div>

                        </div>

                        <div class="form-group row" >
                            <label for="formGroupExampleInput2" class="col-sm-4 col-form-label" style="color: #{{$colortext}};">Costo</label>

                            @foreach($ejecuciones as $ejecucione)
                                <?php $costoEJE = $ejecucione->Costo ?>
                            @endforeach

                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="Costo" name="Costo" placeholder="Ingrese costo" value={{$costoEJE}}>
                            </div>

                        </div>

                        <div class="form-group row" >
                            <label for="formGroupExampleInput2" class="col-sm-4 col-form-label" style="color: #{{$colortext}};">Precio</label>

                            @foreach($ejecuciones as $ejecucione)
                                <?php $precioEJE = $ejecucione->Precio ?>
                            @endforeach

                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="Precio" name="Precio" placeholder="Ingrese precio" value={{$precioEJE}}>
                            </div>

                        </div>


                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn " style="margin-top: 15px; background-color: #{{$boton_actu}}; color: #{{$text_boton_actu}};">ACTUALIZAR</button>

                             <a href="{{route('ejecucion.cargaht',$ejecucione)}}"><button type="button" class="btn" style="margin-top: 15px; background-color: #{{$boton_Facturar}}; color: #{{$text_boton_Facturar}};"><strong>FACTURAR</strong></button></a>                                                                                            

                        </div>

                    </form> 
                <?php } ?>

                <?php if ($ejecucione->estado_ejecucion == "facturado"){ ?> 
                    
                        <form name="ejecucionPam"  novalidate>

                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-3 col-form-label" style="color: #{{$colortext}};">Estado</label>

                                <div class="col-sm-9">
                                    <select class="form-control" name="estado" id="estado" disabled>

                                        @foreach ($ejecuciones as $ejecucione)

                                            <?php if ($ejecucione->estado == null) { ?>
                                                <option value="">Seleccione proveedor</option>
                                                <option value="Realizado">Realizado</option>
                                                <option value="En Proceso">En Proceso</option>
                                                <option value="Pendiente">Pendiente</option>
                                            <?php } ?>
                                            
                                            <?php if ($ejecucione->estado == "Realizado") { ?>
                                                <option value="Realizado" selected>Realizado</option>
                                                <option value="En Proceso">En Proceso</option>
                                                <option value="Pendiente">Pendiente</option>
                                            <?php } ?> 

                                            <?php if ($ejecucione->estado == "En Proceso") { ?>
                                                <option value="Realizado">Realizado</option>
                                                <option value="En Proceso" selected>En Proceso</option>
                                                <option value="Pendiente">Pendiente</option>
                                            <?php } ?> 

                                            <?php if ($ejecucione->estado == "Pendiente") { ?>
                                                <option value="Realizado">Realizado</option>
                                                <option value="En Proceso">En Proceso</option>
                                                <option value="Pendiente" selected>Pendiente</option>
                                            <?php } ?> 
                                            
                                        @endforeach

                                    </select>
                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-3 col-form-label" style="color: #{{$colortext}};">Proveedor</label>

                                <div class="col-sm-9">
                                    <select class="form-control" name="omologados_id" id="omologados_id" disabled>

                                        @foreach ($ejecuciones as $ejecucione)
                                            <?php if ($ejecucione->omologados_id == null) { ?>
                                                <option value="">Seleccione proveedor</option>
                                            <?php } ?>
                                        @endforeach

                                        

                                        @foreach($omologados as $omologado)
                                            @foreach ($sedes as $sede)
                                                @foreach ($htcategorias as $htcategoria)
                                                    <?php if ($htcategoria->id == $omologado->htcategorias_id && $sede->alcances_id == $omologado->alcances_id) { ?>

                                                        @foreach ($ejecuciones as $ejecucione)
                                                            <?php if ($ejecucione->omologados_id == $omologado->id ) { ?>
                                                                <option value="{{$omologado->id}}" selected>
                                                                    @foreach ($proveedos as $proveedo)
                                                                        <?php if ($proveedo->id == $omologado->proveedos_id) { ?>
                                                                            {{$proveedo->razSocProv}}
                                                                        <?php } ?>
                                                                    @endforeach
                                                                
                                                                </option>
                                                            <?php } else { ?>
                                                                
                                                                <option value="{{$omologado->id}}">
                                                                    @foreach ($proveedos as $proveedo)
                                                                        <?php if ($proveedo->id == $omologado->proveedos_id) { ?>
                                                                            {{$proveedo->razSocProv}}
                                                                        <?php } ?>
                                                                    @endforeach
                                                                </option>

                                                            <?php }?>   
                                                        @endforeach
                                                    <?php } ?>
                                                @endforeach

                                                
                                            @endforeach

                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <div class="form-group row" >
                                <label for="formGroupExampleInput2" class="col-sm-3 col-form-label" style="color: #{{$colortext}};">Costo</label>

                                @foreach($ejecuciones as $ejecucione)
                                    <?php $costoEJE = $ejecucione->Costo ?>
                                @endforeach

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="Costo" name="Costo" placeholder="Ingrese costo" value={{$costoEJE}} disabled>
                                </div>

                            </div>

                            <div class="form-group row" >
                                <label for="formGroupExampleInput2" class="col-sm-3 col-form-label" style="color: #{{$colortext}};">Precio</label>

                                @foreach($ejecuciones as $ejecucione)
                                    <?php $precioEJE = $ejecucione->Precio ?>
                                @endforeach

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="Precio" name="Precio" placeholder="Ingrese precio" value={{$precioEJE}} disabled>
                                </div>

                            </div>


                            <div class="d-flex justify-content-between">

                                 <a href="{{route('ejecucion.cargaht',$ejecucione)}}" ><button type="button" class="btn" style="margin-top: 15px; background-color: #{{$boton_NO_Facturar}}; color: #{{$text_boton_NO_Facturar}};">NO FACTURAR</button></a>                                                                                            

                            </div>

                        </form> 

                <?php } ?>

                    <?php $numer++ ?>
                @endforeach

                <?php if ($numer == 0) { ?>

                    <form name="ejecucionPam" action="{{route('ejecucion.store',$pam)}}" method="POST" novalidate>

                        @csrf

                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-3 col-form-label" style="color: #{{$colortext}};">Estado</label>

                            <div class="col-sm-9">
                                <select class="form-control" name="estado" id="estado" >

                                    <option value="Realizado">Realizado</option>
                                    <option value="En Proceso">En Proceso</option>
                                    <option value="Pendiente">Pendiente</option>
                                    <option value="Cancelado">Cancelado</option>

                                </select>
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-3 col-form-label" style="color: #{{$colortext}};">Proveedor</label>

                            <div class="col-sm-9">
                                <select class="form-control" name="omologados_id" id="omologados_id" >

                                    <option value="">Seleccione proveedor</option>

                                    @foreach($omologados as $omologado)
                                        @foreach ($sedes as $sede)
                                            @foreach ($htcategorias as $htcategoria)
                                                <?php if ($htcategoria->id == $omologado->htcategorias_id && $sede->alcances_id == $omologado->alcances_id) { ?>
                                                    <option value="{{$omologado->id}}">
                                                        @foreach ($proveedos as $proveedo)
                                                            <?php if ($proveedo->id == $omologado->proveedos_id) { ?>
                                                                {{$proveedo->razSocProv}}
                                                            <?php } ?>
                                                        @endforeach
                                                    
                                                    </option>
                                                <?php } ?>
                                            @endforeach

                                            
                                        @endforeach

                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="form-group row" >
                            <label for="formGroupExampleInput2" class="col-sm-3 col-form-label" style="color: #{{$colortext}};">Costo</label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="Costo" name="Costo" placeholder="Ingrese costo" value={{$htestructuras[0]->cantidad * $htestructuras[0]->CostoUnitario}}>
                            </div>

                        </div>

                        <div class="form-group row" >
                            <label for="formGroupExampleInput2" class="col-sm-3 col-form-label" style="color: #{{$colortext}};">Precio</label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="Precio" name="Precio" placeholder="Ingrese precio" value={{$htestructuras[0]->cantidad * $htestructuras[0]->PrecioUnitario}}>
                            </div>

                        </div>


                        <div class="row">
                            <div class="col">
                                <button type="submit" class="btn" style="margin-top: 22px; background-color: #{{$boton_crear}}; color: #{{$text_boton_crear}}">CREAR</button>
                            </div>
                        </div>

                    </form>

                <?php } ?>

                

            </section>
        </div>
        <div class="col-md-8" >

                @php
                    $contador = 0;
                    foreach ($ejecuciones as $ejecuc) {
                    $contador = 1;
                    break;
                    }
                @endphp

                <?php if ($contador == 0 ) { ?>
                
                    <!-- NUEVO COMENTARIO -->
                        <div class="card card-danger direct-chat direct-chat-danger collapsed-card">
                            <div class="card-header" style="background-color: #{{$NEW_bg_Comen}}; color: #ffffff;">
    
                                <h3 class="card-title">NUEVO COMENTARIO</h3>
    
                                <div class="card-tools">
    
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>
    
                                </div>
                            </div>
                            
                            <div class="card-body" style="background-color: #{{$NEWfondo_section}}; color: #{{$NEWcolortext}};">
                                
                                <div class="direct-chat-messages" style="height: 279px;">
    
                                    <form action="{{route('pamObservacion.store',$pam)}}" method="POST" enctype="multipart/form-data" novalidate>
    
                                        @csrf
    
                                        <div class="row">
                                            <div class="col">
                                                <label for="exampleFormControlInput1">TITULO</label>
                                                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="ingrese titulo">
                                            </div>
                                            <div class="col">
                                                <label for="exampleFormControlFile1">CARGAR IMAGEN</label>
                                                <input type="file" class="form-control-file" id="imagen" name="imagen">
                                            </div>
                                        </div>
    
                                    
                                        <div class="form-group" style="border-top-width: 15px;margin-top: 15px;">
                                        <label for="exampleFormControlTextarea1">COMENTARIO</label>
                                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                                        </div>
    
                                        <div class="form-group" style="margin-bottom: 0px;" >
                                            <button type="submit" class="btn" style="background-color: #{{$boton_NUE_COMEN}}; color: #{{$TEXT_boton_NUE_COMEN}};">AÑADIR COMENTARIO</button>
                                            
                                        </div>
    
                                    </form>
    
                                </div>
                            </div>
                        </div>
                    <!-- FIN NUEVO COMENTARIO -->
    
                    <div class="card card-danger direct-chat direct-chat-danger" >
                        <div class="card-header" style="background-color: #{{$br_Bitacora}}; color: #{{$br_Bitacora_text}};">
    
                            <h3 class="card-title">BITACORA</h3>
    
                            <div class="card-tools" style="">
    
                                @php
                                    $conteoObs = 0;
                                @endphp
                                @foreach ($pamobservaciones as $pamobservacione)
                                    <?php $conteoObs++  ?>
                                @endforeach
    
                                <span data-toggle="tooltip" title="3 New Messages" class="badge badge-light">{{$conteoObs}}</span>
    
                            </div>
                        </div>
    
                        @foreach ($pamobservaciones as $pamobservacione)
                            <?php if ($pamobservacione->imagen != null) { ?>
                                <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{$pamobservacione->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            
                                            
                                
                                            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <img class="d-block w-100" src="../ImagenesObser/{{$pamobservacione->imagen}}" alt="First slide">
                                                </div>
                                                </div>
                                            </div>
                                            
                                
                                            
                                        </div>
                                        </div>
                                    </div>
                                <!-- FIN Modal -->
                            <?php } ?> 
                            
                        @endforeach
                        
    
                        <div class="card-body" style="background-color: #{{$bg_COMENT}};">
                            
                            <div class="direct-chat-messages" style="height: 462px;">
    
                                @foreach ($pamobservaciones as $pamobservacione)
                                    <div class="card bg-blue">
                                        <div class="card-header" style="background-color: #{{$bg_ASUNTO}}; color: #{{$bg_ASUNTO_text}};">
                                        
                                            <form   action="{{route('pamObservacion.destroy', $pamobservacione->id)}}" method="POST">
                                                {{$pamobservacione->titulo}}
    
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="close" data-dismiss="modal" aria-label="Close">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16" style="color: #ede0e0;">
                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                        <div class="card-body" style="background-color: #{{$bg_DESCRIPCION}}; color: #{{$bg_DESCRIPCION_text}};">
                                        <br>
    
                                        <p class="card-text " style=" padding: 20px; padding-top: 0px;">{{$pamobservacione->descripcion}}</p>
    
                                        <?php if ($pamobservacione->imagen != null) { ?>
                                            
                                            <img class="card-img-bottom" data-toggle="modal" data-target="#exampleModal{{$pamobservacione->id}}"  style="display: block; margin: auto; padding-bottom: 30px; width: 250PX;" src="../ImagenesObser/{{$pamobservacione->imagen}}" alt="sin imagen">
                                        <?php } ?>
                                    </div>
    
                                    </div>
                                        
    
                                    
                                @endforeach
    
                                
    
                            </div>
                        </div>
                    </div>
    
                <?php };?>



            @foreach ($ejecuciones as $ejecucione)
                <?php if ($ejecucione->estado_ejecucion == "facturado") { ?>

                    
            
                    <div class="card card-danger direct-chat direct-chat-danger" >
                        <div class="card-header" style="background-color: #{{$br_Bitacora}}; color: #{{$br_Bitacora_text}};">

                            <h3 class="card-title">BITACORA</h3>

                            <div class="card-tools" style="">

                                @php
                                    $conteoObs = 0;
                                @endphp
                                @foreach ($pamobservaciones as $pamobservacione)
                                    <?php $conteoObs++  ?>
                                @endforeach

                                <span data-toggle="tooltip" title="3 New Messages" class="badge badge-light">{{$conteoObs}}</span>

                            </div>
                        </div>

                        <!-- CARGAR IMAGEN EN EL MODAL -->
                            @foreach ($pamobservaciones as $pamobservacione)
                                <?php if ($pamobservacione->imagen != null) { ?>
                                    <!-- Modal -->
                                        <div class="modal fade" id="exampleModal{{$pamobservacione->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                
                                                
                                    
                                                <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                                                    <div class="carousel-inner">
                                                    <div class="carousel-item active">
                                                        <img class="d-block w-100" src="../ImagenesObser/{{$pamobservacione->imagen}}" alt="First slide">
                                                    </div>
                                                    </div>
                                                </div>
                                                
                                    
                                                
                                            </div>
                                            </div>
                                        </div>
                                    <!-- FIN Modal -->
                                <?php } ?> 
                                
                            @endforeach
                        <!-- FIN CARGAR IMAGEN EN EL MODAL -->
                        

                        <div class="card-body" style="background-color: #{{$bg_COMENT}};">
                            
                            <div class="direct-chat-messages" style="height: 525px;">

                                @foreach ($pamobservaciones as $pamobservacione)
                                    <div class="card bg-blue">
                                        <div class="card-header" style="background-color: #{{$bg_ASUNTO}}; color: #{{$bg_ASUNTO_text}};">
                                        
                                            {{$pamobservacione->titulo}}
    
                                        </div>
                                        <div class="card-body" style="background-color: #{{$bg_DESCRIPCION}}; color: #{{$bg_DESCRIPCION_text}};">
                                        <br>

                                        <p class="card-text " style=" padding: 20px; padding-top: 0px;">{{$pamobservacione->descripcion}}</p>

                                        <?php if ($pamobservacione->imagen != null) { ?>
                                            
                                            <img class="card-img-bottom" data-toggle="modal" data-target="#exampleModal{{$pamobservacione->id}}"  style="display: block; margin: auto; padding-bottom: 30px; width: 250PX;" src="../ImagenesObser/{{$pamobservacione->imagen}}" alt="sin imagen">
                                        <?php } ?>

                                        <div style="display: flex; justify-content: space-between;">

                                            <p class="font-weight-bold font-italic" style="text-align: left;padding: 20px; padding-top: 0px;margin-bottom: 0px;">{{$pamobservacione->namepersona}}</p>
                                            <p class="font-italic" style="text-align: right;padding: 20px; padding-top: 0px;margin-bottom: 0px;">{{$pamobservacione->created_at}}</p>
                                        
                                        </div>
                                    </div>

                                    </div>
                                @endforeach

                                

                            </div>
                        </div>
                    </div>

                <?php } ?>

                <?php if ($contador == 0 || $ejecucione->estado_ejecucion == null || $ejecucione->estado_ejecucion == "sin facturar") { ?>
                    
                    <!-- NUEVO COMENTARIO -->
                        <div class="card card-danger direct-chat direct-chat-danger collapsed-card">
                            <div class="card-header" style="background-color: #{{$NEW_bg_Comen}}; color: #ffffff;">

                                <h3 class="card-title">NUEVO COMENTARIO</h3>

                                <div class="card-tools">

                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>

                                </div>
                            </div>
                            
                            <div class="card-body" style="background-color: #{{$NEWfondo_section}}; color: #{{$NEWcolortext}};">
                                
                                <div class="direct-chat-messages" style="height: 279px;">

                                    <form action="{{route('pamObservacion.store',$pam)}}" method="POST" enctype="multipart/form-data" novalidate>

                                        @csrf

                                        <div class="row">
                                            <div class="col">
                                                <label for="exampleFormControlInput1">TITULO</label>
                                                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="ingrese titulo">
                                            </div>
                                            <div class="col">
                                                <label for="exampleFormControlFile1">CARGAR IMAGEN</label>
                                                <input type="file" class="form-control-file" id="imagen" name="imagen">
                                            </div>
                                        </div>

                                    
                                        <div class="form-group" style="border-top-width: 15px;margin-top: 15px;">
                                        <label for="exampleFormControlTextarea1">COMENTARIO</label>
                                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                                        </div>

                                        <div class="form-group" style="margin-bottom: 0px;" >
                                            <button type="submit" class="btn" style="background-color: #{{$boton_NUE_COMEN}}; color: #{{$TEXT_boton_NUE_COMEN}};">AÑADIR COMENTARIO</button>
                                            
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                    <!-- FIN NUEVO COMENTARIO -->

                    <div class="card card-danger direct-chat direct-chat-danger" >
                        <div class="card-header" style="background-color: #{{$br_Bitacora}}; color: #{{$br_Bitacora_text}};">

                            <h3 class="card-title">BITACORA</h3>

                            <div class="card-tools" style="">

                                @php
                                    $conteoObs = 0;
                                @endphp
                                @foreach ($pamobservaciones as $pamobservacione)
                                    <?php $conteoObs++  ?>
                                @endforeach

                                <span data-toggle="tooltip" title="3 New Messages" class="badge badge-light">{{$conteoObs}}</span>

                            </div>
                        </div>

                            <!-- Comentario: Se realiza un bucle, para recorrer todas las observaciones del pam, 
                            validando si es que la observacion contien imagen o no, de tenerlo se crea un modal
                            con la imagen que luego sera invocado lineas abajo -->

                            @foreach ($pamobservaciones as $pamobservacione)
                                <?php if ($pamobservacione->imagen != null) { ?>
                                    <!-- Modal -->
                                        <div class="modal fade" id="exampleModal{{$pamobservacione->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                
                                                
                                    
                                                <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                                                    <div class="carousel-inner">
                                                    <div class="carousel-item active">
                                                        <img class="d-block w-100" src="../ImagenesObser/{{$pamobservacione->imagen}}" alt="First slide">
                                                    </div>
                                                    </div>
                                                </div>
                                                
                                    
                                                
                                            </div>
                                            </div>
                                        </div>
                                    <!-- FIN Modal -->
                                <?php } ?> 
                                
                            @endforeach
                        

                        <div class="card-body" style="background-color: #{{$bg_COMENT}};">
                            
                            <div class="direct-chat-messages" style="height: 462px;">

                                @foreach ($pamobservaciones as $pamobservacione)
                                    <div class="card bg-blue">
                                        <div class="card-header" style="background-color: #{{$bg_ASUNTO}}; color: #{{$bg_ASUNTO_text}};">
                                        
                                            <form   action="{{route('pamObservacion.destroy', $pamobservacione->id)}}" method="POST">
                                                {{$pamobservacione->titulo}}

                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="close" data-dismiss="modal" aria-label="Close">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16" style="color: #ede0e0;">
                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                        <div class="card-body" style="background-color: #{{$bg_DESCRIPCION}}; color: #{{$bg_DESCRIPCION_text}};">
                                        <br>

                                        <p class="card-text " style=" padding: 20px; padding-top: 0px;">{{$pamobservacione->descripcion}}</p>

                                        <?php if ($pamobservacione->imagen != null) { ?>
                                            
                                            <img class="card-img-bottom" data-toggle="modal" data-target="#exampleModal{{$pamobservacione->id}}"  style="display: block; margin: auto; padding-bottom: 30px; width: 250PX;" src="../ImagenesObser/{{$pamobservacione->imagen}}" alt="sin imagen">
                                        <?php } ?>

                                        <div style="display: flex; justify-content: space-between;">

                                            <p class="font-weight-bold font-italic" style="text-align: left;padding: 20px; padding-top: 0px;margin-bottom: 0px;">{{$pamobservacione->namepersona}}</p>
                                            <p class="font-italic" style="text-align: right;padding: 20px; padding-top: 0px;margin-bottom: 0px;">{{$pamobservacione->created_at}}</p>
                                        
                                        </div>

                                    </div>

                                    </div>
                                        

                                    
                                @endforeach

                                

                            </div>
                        </div>
                    </div>

                <?php } break; ?>
                
            @endforeach
        </div>



                

    </div>
</div>





@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop