@extends('adminlte::page')

@section('title', 'Dashboard')

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
        $boton_actu = "645e06";
        $text_boton_actu = "ffffff";

        //BOTON FACTURAR
        $boton_Facturar = "0f4c5c";
        $text_boton_Facturar = "ffffff";

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

<link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">


<section class=" p-3 rounded" style="margin-bottom: 15px;margin-left: 20px;margin-right: 20px;background-color:#{{$SECT_PRINC}};">

    <div class="row align-items-center" style=" color: #{{$SECT_PRINC_TEXT}};">
        <div class="col-ms-4" style="margin-left: 13px;">
            <div class="form-group" style="margin-bottom: 0px;">
                <h1><strong>{{$cuentas[0]->razonSocial}}</strong></h1>
            </div>
        </div>

        <div class="col-ms-4 ml-auto" >
            <div class="form-group" style="margin-bottom: 0px;">
                <h5 style="margin-bottom: 0px;">
                    {{$requerimiento->titulo}}
                </h5>
            </div>
        </div>

        <div class="col-ms-4 ml-auto" style="margin-right: 20px;">
            <div class="form-group" style="margin-bottom: 0px;">
                <h1>
                    REQ00{{$requerimiento->id}}
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
        

            <!-- ASIGNACION DE REQUERIMEINTO -->
                <section class="shadow p-3 rounded" style="margin-bottom: 15px;margin-left: 0px;margin-right: 0px; background-color: #{{$fondo_section}};">
                    <form id="actualizarReq" action="{{route('requerimiento.update',$requerimiento)}}" method="POST">

                        @csrf
                        @method('put')

                        <div class="form-group" style="color: #{{$colortext}};">
                            <div class="row">
                                <div class="col-12">
                                    <label for="formGroupExampleInput">SEDE</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput" value="{{$sedes[0]->nomSede}}" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="form-group" style="color: #{{$colortext}};">
                        
                            

                            <div class="row">
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                        <label class="form-check-label" for="exampleRadios1">
                                            {{$requerimiento->tipo_servicio}}
                                        </label>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios2" id="tipoarea" value="option2" checked>
                                        <label class="form-check-label" for="tipoarea">
                                            {{$requerimiento->tipo_area}}
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        

                        <div class="form-group">
                            <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Fecha creacion</div>
                            </div>
                            <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="{{$requerimiento->created_at}}" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword" class="col-form-label" style="color: #{{$colortext}};">ESPECIALIDAD</label>
                                <select class="form-control" name="htcategorias_id" id="htcategorias_id" >

                                    <?php if ($requerimiento->htcategorias_id == null ) { ?>
                                        

                                        <option value="">Seleccione especialidad</option>

                                        @foreach ($htcategorias as $htcategoria)
                                            <option value="{{$htcategoria->id}}">{{$htcategoria->especialidad}}</option>
                                            
                                        @endforeach

                                    <?php }else { ?>

                                        @foreach ($htcategorias as $htcategoria)

                                            <?php if ($requerimiento->htcategorias_id == $htcategoria->id) { ?>
                                                <option value="{{$htcategoria->id}}" selected>{{ $htcategoria->especialidad}}</option>
                                            <?php }else { ?>
                                                <option value="{{$htcategoria->id}}">{{$htcategoria->especialidad}}</option>
                                            <?php } ?>
                                        
                                            
                                        @endforeach
                                        
                                        
                                    <?php }?>

                                </select>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword" class="col-form-label" style="color: #{{$colortext}};">ASIGNADO A</label>
                                <select class="form-control" name="asignacion" id="asignacion" >

                                    <?php if ($requerimiento->asignacion == null ) { ?>

                                        <option value="">Seleccione especialidad</option>

                                            <option value="1">Tecnico</option>
                                            <option value="2">Proveedor</option>

                                    <?php }else  if ($requerimiento->asignacion == 1 ) { ?>

                                                <option value="1" selected>Tecnico</option>
                                                <option value="2">Proveedor</option>
        
                                        <?php }else if ($requerimiento->asignacion == 2 ) { ?>

                                            <option value="1">Tecnico</option>
                                            <option value="2" selected>Proveedor</option>

                                    <?php } ?>
                                </select>
                        </div>

                        <?php if ($requerimiento->asignacion == null && $requerimiento->htcategorias_id == null) { ?>
                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="btn" style="margin-top: 0px; background-color: #{{$boton_crear}}; color: #{{$text_boton_crear}}">ASIGNAR</button>
                                </div>
                            </div>
                        <?php }else { ?>

                            <div class="row">
                                <div class="col">
                                    <button  type="submit" class="btn" style="margin-top: 0px; background-color: #645e06; color: #{{$text_boton_crear}}">ACTUALIZAR</button>
                                </div>
                            </div>

                        <?php } ?>

                    </form>


                </section>
            <!-- FIN ASIGNACION DE REQUERIMEINTO -->

           
                            <!-- Comentario: "Se valida si es que el requerimiento lo 
                                atendera un proveedor o un tecnico de acuerdoa  ello se 
                                realiza un proceso definido" -->
            <?php if ($requerimiento->asignacion == 2) { ?>

                <?php $ValidaSolicReq = 0 ?>

                @foreach ($solicitudservreques as $solicitudservreque)
                    <?php $ValidaSolicReq = 1 ?>
                @endforeach

                <?php if ($ValidaSolicReq == 0) { ?>

                    <!-- SOLICITUD DE SERVICIO NUEVO -->
                        <section class=" p-3 rounded" style="margin-bottom: 15px;margin-left: 0px;margin-right: 0px; background-color: #{{$fondo_section}};">

                            <h5 style="color: #{{$colortext}};"><strong> SOLICITUD DE SERVICIO</strong></h5>
                            
                            <form action="{{route('SolicServ.store',$requerimiento)}}" method="POST">

                                @csrf

                                <div class="form-group">
                                    <label for="inputPassword" class="col-form-label" style="color: #{{$colortext}};">PROVEEDORES</label>
                                        <select class="form-control" name="omologados_id" id="omologados_id" >
                                                <option value="">Seleccione proveedor</option>
                                                @foreach ($omologadosFiltra as $omologado)
                                                    @php
                                                        $nombreProvint = "";

                                                        foreach ($proveedos as $proveedo)
                                                        {
                                                            if ($omologado->proveedos_id == $proveedo->id) {
                                                                $nombreProvid = $proveedo->razSocProv;
                                                                break;
                                                            }
                                                        }
                                                    @endphp
                                                    <option value="{{$omologado->id}}">{{$nombreProvid}}</option>
                                                    
                                                @endforeach
                                        </select>
                                </div>

                                <!-- COSTO -->
                                    <div class="input-group mb-3" >
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="border-radius: 10rem 0 0 10rem;"><strong>COSTO</strong></span>
                                        </div>

                                        <input type="number" class="form-control" style="text-align: right" id="costo" name="costo">

                                        <div class="input-group-append">
                                            <span class="input-group-text" style="border-radius: 0 10rem 10rem 0;"><strong> .00</strong></span>
                                        </div>
                                    </div>
                                <!-- FIN COSTO -->

                                <!-- PRECIO -->
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="border-radius: 10rem 0 0 10rem;"><strong>PRECIO</strong></span>
                                        </div>

                                        <input type="number" class="form-control" style="text-align: right" id="precio" name="precio">

                                        <div class="input-group-append">
                                            <span class="input-group-text" style="border-radius: 0 10rem 10rem 0;"><strong> .00</strong></span>
                                        </div>
                                    </div>
                                <!-- FIN PRECIO -->


                                <div class="form-group">
                                    <label for="inputPassword" class="col-form-label" style="color: #{{$colortext}};">CONTINGENCIA</label>
                                        <select class="form-control" name="contindiferidos_id" id="contindiferidos_id" >
                                                <option value="">Seleccione contingencia</option>
                                                @foreach ($contindiferidos as $contindiferido)
                                                    
                                                    <option value="{{$contindiferido->id}}">{{$contindiferido->partida}}</option>
                                                    
                                                @endforeach
                                        </select>
                                </div>

                                

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" style="border-radius: 10rem 0 0 10rem;">ESTADO</label>
                                    </div>
                                    <select class="custom-select" id="estado" name="estado" style="border-radius: 0 10rem 10rem 0;">
                                        <option selected></option>
                                        <option value="1">Pendiente validacion</option>
                                        <option value="2">Aprobado</option>
                                        <option value="3">Realizado</option>
                                        <option value="4">Cancelado</option>
                                    </select>
                                </div>
                                

                                <div class="row">
                                    <div class="col">
                                        <button type="submit" class="btn" style="margin-top: 0px; background-color: #{{$boton_crear}}; color: #{{$text_boton_crear}}">CREAR</button>
                                    </div>
                                </div>

                            </form>

                            

                        </section>
                    <!-- FIN SOLICITUD DE SERVICIO -->

                <?php }elseif ($ValidaSolicReq == 1) { ?>

                    <!-- SOLICITUD DE SERVICIO ACTUALIZAR -->
                        <section class=" p-3 rounded" style="margin-bottom: 15px;margin-left: 0px;margin-right: 0px; background-color: #{{$fondo_section}};">

                            <h5 style="color: #{{$colortext}};"><strong> SOLICITUD DE SERVICIO</strong></h5>
                            
                            <form action="{{route('SolicServ.update',$solicitudservreque)}}" method="POST">

                                @csrf
                                @method('put')
                                

                                <div class="form-group">
                                    <label for="inputPassword" class="col-form-label" style="color: #{{$colortext}};">PROVEEDORES</label>
                                        <select class="form-control" name="omologados_id" id="omologados_id" >
                                                @foreach ($omologadosFiltra as $omologado)
                                                    @php
                                                        $nombreProvint = "";

                                                        foreach ($proveedos as $proveedo)
                                                        {
                                                            if ($omologado->proveedos_id == $proveedo->id) {
                                                                $nombreProvid = $proveedo->razSocProv;
                                                                break;
                                                            }
                                                        }
                                                    @endphp

                                                    <?php if ($solicitudservreques[0]->omologados_id == $omologado->id) { ?>
                                                        <option value="{{$omologado->id}}" selected>{{$nombreProvid}}</option>
                                                    <?php }else { ?>
                                                        <option value="{{$omologado->id}}">{{$nombreProvid}}</option>
                                                    <?php } ?>

                                                    
                                                @endforeach
                                        </select>
                                </div>

                                <!-- COSTO -->
                                    <div class="input-group mb-3" >
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="border-radius: 10rem 0 0 10rem;"><strong>COSTO</strong></span>
                                        </div>

                                        <input type="number" class="form-control" style="text-align: right" id="costo" name="costo" value={{$solicitudservreques[0]->costo}}>

                                        <div class="input-group-append">
                                            <span class="input-group-text" style="border-radius: 0 10rem 10rem 0;"><strong> .00</strong></span>
                                        </div>
                                    </div>
                                <!-- FIN COSTO -->

                                <!-- PRECIO -->
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="border-radius: 10rem 0 0 10rem;"><strong>PRECIO</strong></span>
                                        </div>

                                        <input type="number" class="form-control" style="text-align: right" id="precio" name="precio" value={{$solicitudservreques[0]->precio}}>

                                        <div class="input-group-append">
                                            <span class="input-group-text" style="border-radius: 0 10rem 10rem 0;"><strong> .00</strong></span>
                                        </div>
                                    </div>
                                <!-- FIN PRECIO -->


                                <div class="form-group">
                                    <label for="inputPassword" class="col-form-label" style="color: #{{$colortext}};">CONTINGENCIA</label>
                                        <select class="form-control" name="contindiferidos_id" id="contindiferidos_id" >

                                                @foreach ($contindiferidos as $contindiferido)

                                                    <?php if ($solicitudservreques[0]->contindiferidos_id == $contindiferido->id) { ?>
                                                    <option value="{{$contindiferido->id}}" selected>{{$contindiferido->partida}}</option>
                                                    <?php }else { ?>
                                                    <option value="{{$contindiferido->id}}">{{$contindiferido->partida}}</option>
                                                    <?php } ?>
                                                    
                                                    
                                                @endforeach
                                        </select>
                                </div>


                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" style="border-radius: 10rem 0 0 10rem;">ESTADO</label>
                                    </div>
                                    <select class="custom-select" id="estado" name="estado" style="border-radius: 0 10rem 10rem 0;">

                                        @foreach ($estados as $estad)
                                            <?php if ($solicitudservreques[0]->estado == $estad['id']) { ?>
                                                <option value="{{$estad['id']}}" selected>{{$estad['estado']}}</option>
                                            <?php }else { ?>
                                                <option value="{{$estad['id']}}">{{$estad['estado']}}</option>
                                            <?php } ?>
                                        @endforeach

                                    </select>
                                </div>
                                
                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn" style="margin-top: 15px; background-color: #{{$boton_actu}}; color: #{{$text_boton_actu}};">ACTUALIZAR</button>
        
                                     <a href=""><button type="button" class="btn" style="margin-top: 15px; background-color: #{{$boton_Facturar}}; color: #{{$text_boton_Facturar}};"><strong>FACTURAR</strong></button></a>                                                                                            
        
                                </div>

                            </form>

                            

                        </section>
                    <!-- FIN SOLICITUD DE SERVICIO -->

                <?php } ?>

            <?php  }elseif ($requerimiento->asignacion == 1) { ?>

                <?php $ValidaSoliBiene = 0 ?>

                @foreach ($solicitubienes as $solicitubiene)
                    <?php $ValidaSoliBiene = 1 ?>
                @endforeach

                <?php if ($ValidaSoliBiene == 0) { ?>

                    <!-- COSTO Y MATERIALES -->
                        <section class=" p-3 rounded" style="margin-bottom: 15px;margin-left: 0px;margin-right: 0px; background-color: #{{$fondo_section}};">

                            <h5 style="color: #{{$colortext}};"><strong> SOLICITUD DE BIENES Y MATERIALES</strong></h5>
                                
                            <form action="{{route('SolicBienes.store',$requerimiento)}}" method="POST">

                                @csrf

                                <div class="form-group">
                                    <label for="inputPassword" class="col-form-label" style="color: #{{$colortext}};">TECNICOS</label>
                                        <select class="form-control" name="collaborators_id" id="collaborators_id" >
                                                <option value="">Seleccione proveedor</option>
                                                @foreach ($CollaboFiltra as $collaborator)
                                                    @php
                                                        $nombreColab = "";

                                                        foreach ($pirsons as $pirson)
                                                        {
                                                            if ($collaborator->pirsons_id == $pirson->id) {
                                                                $nombreColab = $pirson->nombre." " .$pirson->apellidos;
                                                                break;
                                                            }
                                                        }
                                                    @endphp
                                                    <option value="{{$collaborator->id}}">{{$nombreColab}}</option>
                                                    
                                                @endforeach
                                        </select>
                                </div>

                                <!-- COSTO -->
                                <label for="inputPassword" class="col-form-label" style="color: #{{$colortext}};">BIENES Y MATERIALES</label>

                                    <div class="input-group mb-3" >
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="border-radius: 10rem 0 0 10rem;"><strong>COSTO</strong></span>
                                        </div>

                                        <input type="number" class="form-control" style="text-align: right" id="costoMaterial" name="costoMaterial">

                                        <div class="input-group-append">
                                            <span class="input-group-text" style="border-radius: 0 10rem 10rem 0;"><strong> .00</strong></span>
                                        </div>
                                    </div>
                                <!-- FIN COSTO -->

                                <!-- PRECIO -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="border-radius: 10rem 0 0 10rem;"><strong>PRECIO</strong></span>
                                    </div>

                                    <input type="number" class="form-control" style="text-align: right" id="precio" name="precio">

                                    <div class="input-group-append">
                                        <span class="input-group-text" style="border-radius: 0 10rem 10rem 0;"><strong> .00</strong></span>
                                    </div>
                                </div>
                            <!-- FIN PRECIO -->


                                <div class="form-group">
                                    <label for="inputPassword" class="col-form-label" style="color: #{{$colortext}};">CONTINGENCIA</label>
                                        <select class="form-control" name="contindiferidos_id" id="contindiferidos_id" >
                                                <option value="">Seleccione contingencia</option>
                                                @foreach ($contindiferidos as $contindiferido)
                                                    
                                                    <option value="{{$contindiferido->id}}">{{$contindiferido->partida}}</option>
                                                    
                                                @endforeach
                                        </select>
                                </div>

                                

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" style="border-radius: 10rem 0 0 10rem;">ESTADO</label>
                                    </div>
                                    <select class="custom-select" id="estado" style="border-radius: 0 10rem 10rem 0;" name="estado">
                                        <option selected></option>
                                        <option value="1">Pendiente validacion</option>
                                        <option value="2">Aprobado</option>
                                        <option value="3">Realizado</option>
                                        <option value="4">Cancelado</option>
                                    </select>
                                </div>
                                

                                <div class="row">
                                    <div class="col">
                                        <button type="submit" class="btn" style="margin-top: 0px; background-color: #{{$boton_crear}}; color: #{{$text_boton_crear}}">CREAR</button>
                                    </div>
                                </div>

                            </form>

                        </section>
                    <!-- FIN COSTO Y MATERIALES -->

                <?php }elseif ($ValidaSoliBiene == 1) { ?>

                <!-- ACTUALIZAR COSTO Y MATERIALES -->
                    <section class=" p-3 rounded" style="margin-bottom: 15px;margin-left: 0px;margin-right: 0px; background-color: #{{$fondo_section}};">

                        <h5 style="color: #{{$colortext}};"><strong> SOLICITUD DE BIENES Y MATERIALES</strong></h5>
                            
                        <form action="{{route('SolicBienes.update',$solicitubiene)}}" method="POST">

                            @csrf
                            @method('put')

                            <div class="form-group">
                                <label for="inputPassword" class="col-form-label" style="color: #{{$colortext}};">TECNICOS</label>
                                    <select class="form-control" name="collaborators_id" id="collaborators_id" >
                                        
                                            @foreach ($CollaboFiltra as $collaborator)

                                                <!-- Comentario: se realiza un bucle para capturar el nombre del colaborador-->
                                                @php
                                                    $nombreColab = "";

                                                    foreach ($pirsons as $pirson)
                                                    {
                                                        if ($collaborator->pirsons_id == $pirson->id) {
                                                            $nombreColab = $pirson->nombre." " .$pirson->apellidos;
                                                            break;
                                                        }
                                                    }
                                                @endphp


                                                <?php if ($solicitubienes[0]->collaborators_id == $collaborator->id) { ?>
                                                    <option value="{{$collaborator->id}}" selected>{{$nombreColab}}</option>
                                                <?php }else { ?>
                                                    <option value="{{$collaborator->id}}">{{$nombreColab}}</option>
                                                <?php } ?>
                                                
                                            @endforeach
                                    </select>
                            </div>

                            <!-- COSTO -->
                                <label for="inputPassword" class="col-form-label" style="color: #{{$colortext}};">BIENES Y MATERIALES</label>

                                <div class="input-group mb-3" >
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="border-radius: 10rem 0 0 10rem;"><strong>COSTO</strong></span>
                                    </div>

                                    <input type="number" class="form-control" style="text-align: right" id="costoMaterial" name="costoMaterial" value={{$solicitubienes[0]->costoMaterial}}>

                                    <div class="input-group-append">
                                        <span class="input-group-text" style="border-radius: 0 10rem 10rem 0;"><strong> .00</strong></span>
                                    </div>
                                </div>
                            <!-- FIN COSTO -->

                            <!-- PRECIO -->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="border-radius: 10rem 0 0 10rem;"><strong>PRECIO</strong></span>
                                </div>

                                <input type="number" class="form-control" style="text-align: right" id="precio" name="precio" value={{$solicitubienes[0]->precio}}>

                                <div class="input-group-append">
                                    <span class="input-group-text" style="border-radius: 0 10rem 10rem 0;"><strong> .00</strong></span>
                                </div>
                            </div>
                        <!-- FIN PRECIO -->


                            <div class="form-group">
                                <label for="inputPassword" class="col-form-label" style="color: #{{$colortext}};">CONTINGENCIA</label>
                                    <select class="form-control" name="contindiferidos_id" id="contindiferidos_id" >
                                        @foreach ($contindiferidos as $contindiferido)

                                            <?php if ($solicitubienes[0]->contindiferidos_id == $contindiferido->id) { ?>
                                            <option value="{{$contindiferido->id}}" selected>{{$contindiferido->partida}}</option>
                                            <?php }else { ?>
                                            <option value="{{$contindiferido->id}}">{{$contindiferido->partida}}</option>
                                            <?php } ?>
                                            
                                            
                                        @endforeach
                                    </select>
                            </div>

                            

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" style="border-radius: 10rem 0 0 10rem;">ESTADO</label>
                                </div>
                                <select class="custom-select" id="estado" style="border-radius: 0 10rem 10rem 0;" name="estado">
                                    
                                    @foreach ($estados as $estad)
                                        <?php if ($solicitubienes[0]->estado == $estad['id']) { ?>
                                            <option value="{{$estad['id']}}" selected>{{$estad['estado']}}</option>
                                        <?php }else { ?>
                                            <option value="{{$estad['id']}}">{{$estad['estado']}}</option>
                                        <?php } ?>
                                    @endforeach

                                </select>
                            </div>
                            

                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn" style="margin-top: 15px; background-color: #{{$boton_actu}}; color: #{{$text_boton_actu}};">ACTUALIZAR</button>
    
                                 <a href=""><button type="button" class="btn" style="margin-top: 15px; background-color: #{{$boton_Facturar}}; color: #{{$text_boton_Facturar}};"><strong>FACTURAR</strong></button></a>                                                                                            
    
                            </div>

                        </form>

                    </section>
                <!-- FIN COSTO Y MATERIALES --> 

                <?php } ?>

            <?php } ?>

            <!-- APROVACIONES-->
                @foreach ($solicitubienes as $validBieneAprov)

                    <!-- VALIDACION APROBACION SERVICIO-->
                        <div class="card card-danger direct-chat direct-chat-danger collapsed-card">
                            <div class="card-header" style="background-color: #{{$boton_NUE_COMEN}}; color: #ffffff;">

                                <h3 class="card-title">REVICION DE APROBACION</h3>

                                <div class="card-tools">

                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>

                                </div>
                            </div>
                            
                            <div class="card-body" style="background-color: #{{$NEWfondo_section}}; color: #{{$NEWcolortext}};">
                                
                                <div class="direct-chat-messages" style="height: 245px;">

                                    
                                    

                                        <form>
                                            <div class="form-row" style="margin-bottom: 20px;margin-top: 20px;">
                                            <div class="col"  style="text-align: center;align-items: center;">
                                                <label for="exampleFormControlInput1" style="margin-top: 8px;">ADMINISTRADOR</label>
                                            </div>
                                            <div class="col" style="text-align: center;">

                                                <?php if ($validBieneAprov->AprobacionADM == null || $validBieneAprov->AprobacionADM == "pendiente") { ?>

                                                    <a href="{{route('SolicBienes.aproadmin',$validBieneAprov)}}"><button  type="button" class="btn" style="background-color: #8a8282; color: #{{$TEXT_boton_NUE_COMEN}};">PENDIENTE</button></a>
                                            
                                                <?php } ?>

                                                <?php if ($validBieneAprov->AprobacionADM == "aprobado") { ?>

                                                    <a href="{{route('SolicBienes.aproadmin',$validBieneAprov)}}"><button  type="button" class="btn" style="background-color: #176807; color: #{{$TEXT_boton_NUE_COMEN}};">APROBADO</button></a>
                                                <?php } ?>

                                            </div>
                                            </div>
                                        </form>

                                    

                                    <?php if ($validBieneAprov->costoMaterial > 200) { ?>

                                        <form>
                                            <div class="form-row" style="margin-bottom: 20px;margin-top: 20px;">
                                            <div class="col"  style="text-align: center;align-items: center;">
                                                <label for="exampleFormControlInput1">JEFE OPERACIONES</label>
                                            </div>
                                            <div class="col" style="text-align: center;">

                                                <?php if ($validBieneAprov->AprobacionJOP == null || $validBieneAprov->AprobacionJOP == "pendiente") { ?>

                                                    <a href="{{route('SolicBienes.aprojop',$validBieneAprov)}}"><button  type="button" class="btn" style="background-color: #8a8282; color: #{{$TEXT_boton_NUE_COMEN}};">PENDIENTE</button></a>
                                            
                                                <?php } ?>

                                                <?php if ($validBieneAprov->AprobacionJOP == "aprobado") { ?>

                                                    <a href="{{route('SolicBienes.aprojop',$validBieneAprov)}}"><button  type="button" class="btn" style="background-color: #176807; color: #{{$TEXT_boton_NUE_COMEN}};">APROBADO</button></a>
                                                <?php } ?>

                                            </div>
                                            </div>
                                        </form>

                                    <?php } ?>

                                    <?php if ($validBieneAprov->costoMaterial > 1000) { ?>
                                        <form>
                                            <div class="form-row" style="margin-bottom: 20px;margin-top: 20px;">
                                            <div class="col"  style="text-align: center;align-items: center;">
                                                <label for="exampleFormControlInput1">GERENTE GENERAL</label>
                                            </div>
                                            <div class="col" style="text-align: center;">

                                                <?php if ($validBieneAprov->AprobacionGG == null || $validBieneAprov->AprobacionGG == "pendiente") { ?>

                                                    <a href="{{route('SolicBienes.aprogg',$validBieneAprov)}}"><button  type="button" class="btn" style="background-color: #8a8282; color: #{{$TEXT_boton_NUE_COMEN}};">PENDIENTE</button></a>
                                            
                                                <?php } ?>

                                                <?php if ($validBieneAprov->AprobacionGG == "aprobado") { ?>

                                                    <a href="{{route('SolicBienes.aprogg',$validBieneAprov)}}"><button  type="button" class="btn" style="background-color: #176807; color: #{{$TEXT_boton_NUE_COMEN}};">APROBADO</button></a>
                                                <?php } ?>

                                            </div>
                                            </div>
                                        </form>

                                    <?php } ?>

                                </div>
                            </div>

                        </div>
                    <!-- FIN VALIDACION APROBACION SERVICIO-->

                @endforeach
            <!-- FIN APROVACIONES-->
        </div>

        <div class="col-md-8" >
            <!-- NUEVO COMENTARIO-->
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

                            <form action="{{route('Reqobservaciones.store',$requerimiento)}}" method="POST" enctype="multipart/form-data">

                                @csrf

                                <div class="row">
                                    <div class="col">
                                        <label for="exampleFormControlInput1">TITULO</label>
                                        <input type="text" class="form-control" id="titulo" name="titulo" placeholder="ingrese titulo">
                                    </div>
                                    <div class="col">
                                        <label for="exampleFormControlFile1">CARGAR IMAGEN</label>
                                        <input type="file" class="form-control-file" id="imagen" name="imagen" accept="image/*">
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
            <!-- SIN COMENTARIO-->

            <!-- BITACODA-->
                <div class="card card-danger direct-chat direct-chat-danger" >
                    <div class="card-header" style="background-color: #{{$br_Bitacora}}; color: #{{$br_Bitacora_text}};">

                        <h3 class="card-title">BITACORA</h3>

                        <div class="card-tools" style="">

                                @php
                                    $conteoObs = 0;
                                @endphp
                                @foreach ($reqobservaciones as $reqobservacione)
                                    <?php $conteoObs++  ?>
                                @endforeach

                        

                            <span data-toggle="tooltip" title="3 New Messages" class="badge badge-light">{{$conteoObs + 1}}</span>

                        </div>
                    </div>

                    <?php if ($requerimiento->imagen != null) { ?>
                        <!-- Modal -->
                            <div class="modal fade" id="imegenprincipalReq" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    
                                    
                        
                                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img class="d-block w-100" src="../ImagenesRequerimiento/{{$requerimiento->imagen}}" alt="First slide">
                                        </div>
                                        </div>
                                    </div>
                                    
                        
                                    
                                </div>
                                </div>
                            </div>
                        <!-- FIN Modal -->
                    <?php } ?> 

                    @foreach ($reqobservaciones as $reqobservacione)
                        <?php if ($reqobservacione->imagen != null) { ?>
                            <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{$reqobservacione->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        
                                        
                            
                                        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <img class="d-block w-100" src="..{{$reqobservacione->imagen}}" alt="First slide">
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
                        <div class="direct-chat-messages" style="height: 860px;">

                            <!-- COMENTARIO PRINCIPAL-->
                                <div class="card bg-blue">
                                    <div class="card-header" style="background-color: #{{$bg_ASUNTO}}; color: #{{$bg_ASUNTO_text}};">
                                            DESCRIPCION DE REQUERIMIENTO
                                    </div>
                                    <div class="card-body" style="background-color: #{{$bg_DESCRIPCION}}; color: #{{$bg_DESCRIPCION_text}};">
                                        <br>

                                        <p class="card-text " style=" padding: 20px; padding-top: 0px;">{{$requerimiento->descripcion}}</p>

                                            <?php if ($requerimiento->imagen != null) { ?>
                                                
                                                <img class="card-img-bottom" data-toggle="modal" data-target="#imegenprincipalReq"  style="display: block; margin: auto; padding-bottom: 30px; width: 250PX;" src="../ImagenesRequerimiento/{{$requerimiento->imagen}}" alt="sin imagen">
                                            
                                            <?php } ?>
                                        
                                        <div style="display: flex; justify-content: space-between;">

                                            <p class="font-weight-bold font-italic" style="text-align: left;padding: 20px; padding-top: 0px;margin-bottom: 0px;">{{$users[0]->name}}</p>
                                            <p class="font-italic" style="text-align: right;padding: 20px; padding-top: 0px;margin-bottom: 0px;">{{$requerimiento->created_at}}</p>
                                        
                                        </div>

                                    </div>
                                </div>
                            <!--FIN COMENTARIO PRINCIPAL-->

                            


                            @foreach ($reqobservaciones as $reqobservacione)
                                    <div class="card bg-blue">
                                        <div class="card-header" style="background-color: #{{$bg_ASUNTO}}; color: #{{$bg_ASUNTO_text}};">
                                        
                                            <form   action="{{route('Reqobservaciones.destroy', $reqobservacione)}}" method="POST">
                                                {{$reqobservacione->titulo}}

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

                                        <p class="card-text " style=" padding: 20px; padding-top: 0px;">{{$reqobservacione->descripcion}}</p>

                                        <?php if ($reqobservacione->imagen != null) { ?>
                                            
                                            <img class="card-img-bottom" data-toggle="modal" data-target="#exampleModal{{$reqobservacione->id}}"  style="display: block; margin: auto; padding-bottom: 30px; width: 250PX;" src="..{{$reqobservacione->imagen}}" alt="sin imagen">
                                        <?php } ?>

                                        <div style="display: flex; justify-content: space-between;">

                                            <p class="font-weight-bold font-italic" style="text-align: left;padding: 20px; padding-top: 0px;margin-bottom: 0px;">{{$reqobservacione->namepersona}}</p>
                                            <p class="font-italic" style="text-align: right;padding: 20px; padding-top: 0px;margin-bottom: 0px;">{{$reqobservacione->created_at}}</p>
                                        
                                        </div>
                                    </div>

                                    </div>
                                        

                                    
                            @endforeach






                        </div>
                    </div>
                </div>
            <!-- FIN BITACODA-->

            
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