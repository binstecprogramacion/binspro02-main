@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@php
    
    //SECTION TITULO PRINCIPAL
        $SECT_PRINC = "274c77";
        $SECT_PRINC_TEXT = "ffffff";

    //BOTON CREAR
        $boton_crear = "01497C";
        $text_boton_crear = "ffffff";
@endphp

<section class="shadow p-3 rounded" style="margin-bottom: 15px;margin-left: 20px;margin-right: 20px; background-color:#{{$SECT_PRINC}};">

    <div class="row align-items-center" style=" color: #{{$SECT_PRINC_TEXT}};">
        <div class="col-md-6 ">
            <div class="form-group" style="margin-bottom: 0px;">
                <h1>HT {{$cuenta->razonSocial}}</h1>
            </div>
        </div>
        <div class="col-md-6 ml-auto">
            <div class="form-group" style="margin-bottom: 0px;text-align: RIGHT;">
                <a href="{{route('pam.index',$cuenta)}}"><button type="button" class="btn btn-outline-light">CRONOGRAMA PAM</button></a>
                <a href="{{route('cuentas.show',$cuenta)}}"><button type="button" class="btn btn-outline-light">Regresar</button></a>
            </div>
        </div>
    </div>
</section>
@stop

@section('content')

    <!-- ACORDEON COLABORADOR -->
        <div class="accordion" id="accordionExample" style="margin-bottom: 15px;margin-left: 20px;margin-right: 20px;">
            <div class="card">
                    <div class="card" id="headingTwo" style="margin-bottom: 0px;">
                        <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#colaboradores" aria-expanded="true" aria-controls="colaboradores">
                                Contingencia
                                </button>
                            </h2>
                        </div>

                        <div id="colaboradores" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">

                                <!-- *********COLABORADORES********** -->
                                <!-- INICIO SECCION DATOS DE COLABORADORES -->
                                    <section class="p-3 bg-white rounded" style="margin-bottom: 0px;margin-left: 20px;margin-right: 20px;">
                                        <div class="table-responsive">

                                            <table class="mx-auto table w-75" style="margin-bottom: 0px;">
                                                <thead class="table table-striped table-dark">
                                                    <tr>
                                                        <th scope="col">id</th>
                                                        <th scope="col">Partida</th>
                                                        <th scope="col">Categoria</th>
                                                        <th scope="col">Saldo</th>
                                                        <th colspan="2"></th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($contindiferidos as $contindiferido)
                                                        
                                                        <tr>
                                                            <th style="width:50px">{{$contindiferido->id}}</th>
                                                            <th style="width:500px">{{$contindiferido->partida}}</th>

                                                            @foreach ($catcontingencias as $catcontingencia)
                                                                <?php if ($contindiferido->catcontingencias_id== $catcontingencia->id) { ?>
                                                                    <th>{{$catcontingencia->categoriaContin}}</th>
                                                                <?php break; } ?>
                                                            @endforeach

                                                            <th style="width:120px">{{$contindiferido->Saldo}}</th>
                                                            

                                                            <td style="width:50px">
                                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editContingencia{{$contindiferido->id}}" 
                                                                    style="margin-bottom: 10px" >
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                                    </svg>
                                                                        
                                                                </button>
                                                            </td>

                                                            <!-- Modal ACTUALIZAR CONTINGENCIA-->
                                                                <div class="modal fade" id="editContingencia{{$contindiferido->id}}" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLongTitle">AGREGAR COLABORADOR</h5>
                                                                            </div>

                                                                            <div class="modal-body">
                                                                                <form class="needs-validation" action="{{route('contingencia.update',$contindiferido)}}" method="POST" novalidate>

                                                                                    @csrf
                                                                                    @method('put')
                                                                                        <div class="form-group">
                                                                                            <label for="recipient-name" class="col-form-label">NOMBRES DE PARTIDA:</label>
                                                                                            <input type="text" class="form-control" id="partida" name="partida" value="{{$contindiferido->partida}}" required>
                                                                                        </div>

                                                                                        <div class="form-group">
                                                                                            <label for="inputPassword" class="col-form-label">TIPO CONTINGENCIA</label>
                                                                                                <select class="form-control" aria-label="Default select example" id="catcontingencias_id" name="catcontingencias_id" required>
                                                                                                    
                                                                                                    @foreach ($catcontingencias as $catcontingencia)
                                                                                                        <?php if ($catcontingencia->id == $contindiferido->catcontingencias_id) { ?>
                                                                                                            <option value="{{$catcontingencia->id}}" selected>{{$catcontingencia->categoriaContin}}</option>
                                                                                                        <?php }else { ?>
                                                                                                            <option value="{{$catcontingencia->id}}">{{$catcontingencia->categoriaContin}}</option>
                                                                                                        <?php } ?>
                                                                                                    @endforeach
                                                                                                </select>
                                                                                        </div>

                                                                                        <div class="row">
                                                                                            <div class="col">
                                                                                                <label for="inputPassword" class="col-form-label">SALDO</label>
                                                                                                <input type="number" class="form-control" id="Saldo" name="Saldo" value="{{$contindiferido->Saldo}}">
                                                                                            </div>
                                                                                            <div class="col">
                                                                                                <label for="inputPassword" class="col-form-label">AÑO</label>
                                                                                                <select class="form-control" aria-label="Default select example" id="anio" name="anio" required>

                                                                                                    <?php for ($i = 20; $i < 24; $i++) { ?>
                                                                                                        <?php if ($i == $contindiferido->anio) { ?>
                                                                                                        <option value="{{$i}}" selected>20{{$i}}</option>
                                                                                                        <?php }else { ?>
                                                                                                        <option value="{{$i}}">20{{$i}}</option>
                                                                                                        <?php } ?>
                                                                                                    <?php } ?>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>

                                                                                        
                                                                                        <div class="modal-footer">
                                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                                            <button type="submit" class="btn" style="background-color: #{{$boton_crear}}; color: #{{$text_boton_crear}};">Actualizar</button>
                                                                                        </div>
                                                                                </form>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <!-- FIN Modal CREAR CONTINGENCIA-->



                                                            <td align="center" style="width:50px">
                                                                <form   action="{{route('contingencia.destroy', $contindiferido)}}" method="POST">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button type="submit"  class="btn btn-danger" >
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                                                        </svg>
                                                                    </button></a>
                                                                </form>
                                                            </td>

                                                        </tr>

                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                        
                                    </section>
                                <!-- FIN SECCION DATOS DE COLABORADORES -->


                                <!-- INICIO BOTON AÑADIR INTERLOCUTOR -->
                                    <section class="p-3 bg-white rounded" style="margin-bottom: 15px;margin-left: 20px;margin-right: 20px;">
                                        <button type="button" class="btn" data-toggle="modal" data-target="#createContingencia" 
                                        style="margin-bottom: 10px;background-color: #{{$boton_crear}}; color: #{{$text_boton_crear}};">
                                            Nueva Partida
                                        </button>
                                    </section>
                                <!-- FIN BOTON AÑADIR INTERLOCUTOR -->

                            </div>
                        </div>
                    </div>
            </div>
        </div>
    <!-- FIN ACORDEON DE COLABORADOR -->

<section class="shadow p-3 bg-white rounded" style="margin-bottom: 15px;margin-left: 20px;margin-right: 20px;">
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createHTEstructura" style="margin-bottom: 10px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
          </svg>
          
    </button>

    <div class="table-responsive">
        <table class="table">
            <thead class="table table-striped table-dark">
                <tr>
                    <th scope="col">Especialidad</th>
                    <th scope="col">Frecuencia</th>
                    <th scope="col">##</th>
                    <th scope="col">Costo Unitario</th>
                    <th scope="col">Costo Mensual</th>
                    <th scope="col">Costo anual</th>
                    <th scope="col">Costo anual RE</th>
                    <th scope="col">Precio Unitario</th>
                    <th scope="col">Precio Mensual</th>
                    <th scope="col">Precio anual</th>
                    <th scope="col">Precio anual RE</th>
                    <td scope="col" colspan="3" align="center">Accion</td>
                </tr>
            </thead>
            <tbody>
                @foreach($htestructuras as $htestructura)
                
                    <tr>
                        @foreach($htcategorias as $htcategoria)
                            <?php if ($htestructura->htcategorias_id == $htcategoria->id) { ?>
                                <th >{{$htcategoria->especialidad}}</th>
                            <?php } ?>
                        @endforeach
                        
                        <td>{{$htestructura->frecuencia}}</td>
                        <td>{{$htestructura->numfrecuencia}}</td>
                        <td>{{$htestructura->CostoUnitario}}</td>
                        <td>{{$htestructura->CostoMensual}}</td>
                        <td>{{$htestructura->CostoAnual}}</td>
                        <td>{{$htestructura->CostoAnualRestante}}</td>
                        <td>{{$htestructura->PrecioUnitario}}</td>
                        <td>{{$htestructura->PrecioMensual}}</td>
                        <td>{{$htestructura->PrecioAnual}}</td>
                        <td>{{$htestructura->PrecioAnualRestante}}</td>

                        <td align="center">
                            <a href="{{route('pam.show', $htestructura ->id)}}">
                                <button type="button"  class="btn btn-info" >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                    </svg>
                                </button></a>
                        </td>

                        <td >
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editHTEstructura{{$htestructura->id}}" 
                                style="margin-bottom: 10px" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                </svg>
                                    
                            </button>

                            <!-- MODAL EDITAR PROVEEDOR -->
                                <div class="modal fade bd-example-modal-lg" id="editHTEstructura{{$htestructura->id}}" data-backdrop="static" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle"> NUEVO </h5>
                                            </div>
                                            <div class="modal-body" >
                                                <form class="needs-validation" action="{{route('htestructuras.update',$htestructura)}}" method="POST" novalidate>

                                                    @csrf
                                                    @method('put')
                                                    <!-- COLUMNA 1-->
                                                        <div class="row">
                                                            <div class="col-md-7 ml-auto">
                                                                <div class="form-group">
                                                                    <label for="recipient-name" class="col-form-label">ESPECIALIDAD:</label>
                                                                    <select class="form-control" aria-label="Default select example" id="htcategorias_id" name="htcategorias_id"  required>
                                                                        <?php if ($htestructura->htcategorias_id == null) { ?>
                                                                            <option value="" selected>Seleccione</option>
                                                                        <?php } ?>

                                                                        @foreach($htcategorias as $htcategoria)
                                                                            <?php if ($htestructura->htcategorias_id == $htcategoria->id) { ?>
                                                                            <option value="{{$htcategoria->id}}" selected>{{$htcategoria->especialidad}}</option>
                                                                            <?php } else { ?>
                                                                                <option value="{{$htcategoria->id}}">{{$htcategoria->especialidad}}</option>
                                                                            <?php }?>
                                                                        @endforeach
                                                                    </select>
                                                                    
                                                                    <div class="invalid-feedback">
                                                                        Es necesario seleccionar la ESPECIALIDAD
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 ml-auto">
                                                                <div class="form-group">
                                                                    <label for="recipient-name" class="col-form-label">AÑO:</label>
                                                                    <select class="form-control" aria-label="Default select example" id="anio" name="anio" required>

                                                                        <?php if ($htestructura->anio == null) { ?>
                                                                            <option value="" selected>Seleccione</option>
                                                                            <option value="2020">2020</option>
                                                                            <option value="2021">2021</option>
                                                                            <option value="2022">2022</option>
                                                                            <option value="2023">2023</option>
                                                                            <option value="2024">2024</option>
                                                                            <option value="2025">2025</option>
                                                                        <?php } ?>

                                                                        <?php if ($htestructura->anio == "2020") { ?>
                                                                            <option value="2020" selected>2020</option>
                                                                            <option value="2021">2021</option>
                                                                            <option value="2022">2022</option>
                                                                            <option value="2023">2023</option>
                                                                            <option value="2024">2024</option>
                                                                            <option value="2025">2025</option>
                                                                        <?php } ?>

                                                                        <?php if ($htestructura->anio == "2021") { ?>
                                                                            <option value="2020" >2020</option>
                                                                            <option value="2021" selected>2021</option>
                                                                            <option value="2022">2022</option>
                                                                            <option value="2023">2023</option>
                                                                            <option value="2024">2024</option>
                                                                            <option value="2025">2025</option>
                                                                        <?php } ?>

                                                                        <?php if ($htestructura->anio == "2022") { ?>
                                                                            <option value="2020">2020</option>
                                                                            <option value="2021">2021</option>
                                                                            <option value="2022" selected>2022</option>
                                                                            <option value="2023">2023</option>
                                                                            <option value="2024">2024</option>
                                                                            <option value="2025">2025</option>
                                                                        <?php } ?>

                                                                        <?php if ($htestructura->anio == "2023") { ?>
                                                                            <option value="2020">2020</option>
                                                                            <option value="2021">2021</option>
                                                                            <option value="2022">2022</option>
                                                                            <option value="2023" selected>2023</option>
                                                                            <option value="2024">2024</option>
                                                                            <option value="2025">2025</option>
                                                                        <?php } ?>

                                                                        <?php if ($htestructura->anio == "2024") { ?>
                                                                            <option value="2020">2020</option>
                                                                            <option value="2021">2021</option>
                                                                            <option value="2022">2022</option>
                                                                            <option value="2023">2023</option>
                                                                            <option value="2024" selected>2024</option>
                                                                            <option value="2025">2025</option>
                                                                        <?php } ?>

                                                                        <?php if ($htestructura->anio == "2025") { ?>
                                                                            <option value="2020">2020</option>
                                                                            <option value="2021">2021</option>
                                                                            <option value="2022">2022</option>
                                                                            <option value="2023">2023</option>
                                                                            <option value="2024">2024</option>
                                                                            <option value="2025" selected>2025</option>
                                                                        <?php } ?>

                                                                        
                                                
                                                                    </select>
                                                                    <div class="invalid-feedback">
                                                                        Es necesario seleccionar el AÑO
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-2 ml-auto">
                                                                <div class="form-group">
                                                                    <label for="recipient-name" class="col-form-label">CANTIDAD:</label>
                                                                    <input type="text" class="form-control" id="cantidad" name="cantidad" value="{{$htestructura -> cantidad}}" required>
                                                                    
                                                                    <div class="invalid-feedback">
                                                                        Es necesario colocar la CANTIDAD
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <!-- FIN COLUMNA 1-->
                                                        
                                                    <!-- COLUMNA 2-->
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="recipient-name" class="col-form-label">FRECUENCIA:</label>
                                                                    <select class="form-control" aria-label="Default select example" id="frecuencia" name="frecuencia" required>

                                                                        <?php if ($htestructura->frecuencia == null) { ?>
                                                                            <option value="" selected>Seleccione</option>
                                                                            <option value="Mensual" >Mensual</option>
                                                                            <option value="Bimestral">Bimestral</option>
                                                                            <option value="Cuatrimestral">Cuatrimestral</option>
                                                                            <option value="Semestral">Semestral</option>
                                                                            <option value="Anual">Anual</option>
                                                                        <?php } ?>

                                                                        <?php if ($htestructura->frecuencia == "Mensual") { ?>
                                                                            <option value="Mensual" selected>Mensual</option>
                                                                            <option value="Bimestral">Bimestral</option>
                                                                            <option value="Cuatrimestral">Cuatrimestral</option>
                                                                            <option value="Semestral">Semestral</option>
                                                                            <option value="Anual">Anual</option>
                                                                        <?php } ?>

                                                                        <?php if ($htestructura->frecuencia == "Bimestral") { ?>
                                                                            <option value="Mensual" >Mensual</option>
                                                                            <option value="Bimestral" selected>Bimestral</option>
                                                                            <option value="Cuatrimestral">Cuatrimestral</option>
                                                                            <option value="Semestral">Semestral</option>
                                                                            <option value="Anual">Anual</option>
                                                                        <?php } ?>

                                                                        <?php if ($htestructura->frecuencia == "Cuatrimestral") { ?>
                                                                            <option value="Mensual" >Mensual</option>
                                                                            <option value="Bimestral">Bimestral</option>
                                                                            <option value="Cuatrimestral" selected>Cuatrimestral</option>
                                                                            <option value="Semestral">Semestral</option>
                                                                            <option value="Anual">Anual</option>
                                                                        <?php } ?>

                                                                        <?php if ($htestructura->frecuencia == "Semestral") { ?>
                                                                            <option value="Mensual" >Mensual</option>
                                                                            <option value="Bimestral">Bimestral</option>
                                                                            <option value="Cuatrimestral">Cuatrimestral</option>
                                                                            <option value="Semestral" selected>Semestral</option>
                                                                            <option value="Anual">Anual</option>
                                                                        <?php } ?>

                                                                        <?php if ($htestructura->frecuencia == "Anual") { ?>
                                                                            <option value="Mensual" >Mensual</option>
                                                                            <option value="Bimestral">Bimestral</option>
                                                                            <option value="Cuatrimestral">Cuatrimestral</option>
                                                                            <option value="Semestral">Semestral</option>
                                                                            <option value="Anual" selected>Anual</option>
                                                                        <?php } ?>
                                                                
                                                
                                                                    </select>
                                                                    
                                                                    <div class="invalid-feedback">
                                                                        Es necesario colocar la FRECUENCIA
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="recipient-name" class="col-form-label">NUMERO</label>
                                                                    <select class="form-control" aria-label="Default select example" id="numfrecuencia" name="numfrecuencia" required>
                                                                            
                                                                        <?php if ($htestructura->numfrecuencia == null) { ?>
                                                                            <option value="" selected>Seleccione</option>
                                                                            <option value="12">12</option>
                                                                            <option value="6">06</option>
                                                                            <option value="3">03</option>
                                                                            <option value="2">02</option>
                                                                            <option value="1">01</option>
                                                                        <?php } ?>

                                                                        <?php if ($htestructura->numfrecuencia == 12) { ?>
                                                                            <option value="12" selected>12</option>
                                                                            <option value="6">06</option>
                                                                            <option value="3">03</option>
                                                                            <option value="2">02</option>
                                                                            <option value="1">01</option>
                                                                        <?php } ?>


                                                                        <?php if ($htestructura->numfrecuencia == 6) { ?>
                                                                            <option value="12">12</option>
                                                                            <option value="6" selected>06</option>
                                                                            <option value="3">03</option>
                                                                            <option value="2">02</option>
                                                                            <option value="1">01</option>
                                                                        <?php } ?>

                                                                        <?php if ($htestructura->numfrecuencia == 3) { ?>
                                                                            <option value="12">12</option>
                                                                            <option value="6">06</option>
                                                                            <option value="3" selected>03</option>
                                                                            <option value="2">02</option>
                                                                            <option value="1">01</option>
                                                                        <?php } ?>

                                                                        <?php if ($htestructura->numfrecuencia == 2) { ?>
                                                                            <option value="12">12</option>
                                                                            <option value="6">06</option>
                                                                            <option value="3">03</option>
                                                                            <option value="2" selected>02</option>
                                                                            <option value="1">01</option>
                                                                        <?php } ?>

                                                                        <?php if ($htestructura->numfrecuencia == 1) { ?>
                                                                            <option value="12">12</option>
                                                                            <option value="6">06</option>
                                                                            <option value="3">03</option>
                                                                            <option value="2" >02</option>
                                                                            <option value="1" selected>01</option>
                                                                        <?php } ?>

                                                                    </select>
                                                                    <div class="invalid-feedback">
                                                                        Es necesario colocar el NUMERO DE MESES
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <!--FIN COLUMNA 3-->
                                                    
                                                    

                                                    <!-- COLUMNA 1-->
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <div class="form-group">
                                                                    <label for="recipient-name" class="col-form-label">COSTO UNITARIO:</label>
                                                                    <input type="text" class="form-control" id="CostoUnitario" name="CostoUnitario" value="{{$htestructura -> CostoUnitario}}" required>
                                                                    
                                                                    <div class="invalid-feedback">
                                                                        Es necesario colocar el COSTO UNITARIO
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5 ">
                                                                <div class="form-group">
                                                                    <label for="recipient-name" class="col-form-label">PRECIO UNITARIO:</label>
                                                                    <input type="text" class="form-control" id="PrecioUnitario" name="PrecioUnitario" value="{{$htestructura -> PrecioUnitario}}" required>
                                                                    
                                                                    <div class="invalid-feedback">
                                                                        Es necesario colocar el PRECIO UNITARIO
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <!-- FIN COLUMNA 1-->

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                                    </div>
                                                    
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- FIN MODAL EDITAR ESPECIALIDAD -->

                        </td>

                        <td align="center">
                            <form   action="{{route('htestructuras.destroy',$htestructura)}}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit"  class="btn btn-danger" >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                    </svg>
                                </button></a>
                            </form>
                        </td>
                    
                @endforeach

        </table>
    </div>

    {{$htestructuras->links()}}

</section>

<!-- MODAL CREAR NUEVA PARTIDA -->
    <div class="modal fade bd-example-modal-lg" id="createHTEstructura" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"> NUEVO </h5>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" action="{{route('htestructuras.store',$cuenta)}}" method="POST" novalidate>

                        @csrf
                        <!-- COLUMNA 1-->
                            <div class="row">

                                <div class="col-md-7 ml-auto">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">ESPECIALIDAD:</label>
                                        <select class="form-control" aria-label="Default select example" id="htcategorias_id" name="htcategorias_id" required>
                                            <option value="" selected>Seleccione</option>
                                            @foreach($htcategorias as $htcategoria)
                                                <option value="{{$htcategoria->id}}">{{$htcategoria->especialidad}}</option>
                                            @endforeach
                    
                                        </select>
                                        
                                        <div class="invalid-feedback">
                                            Es necesario seleccionar la ESPECIALIDAD
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 ml-auto">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">AÑO:</label>
                                        <select class="form-control" aria-label="Default select example" id="anio" name="anio" required>
                                                
                                            <option value="" selected>Seleccione</option>
                                            <option value="2020">2020</option>
                                            <option value="2021">2021</option>
                                            <option value="2022">2022</option>
                                            <option value="2023">2023</option>
                                            <option value="2024">2024</option>
                                            <option value="2025">2025</option>
                    
                                        </select>
                                        <div class="invalid-feedback">
                                            Es necesario seleccionar el AÑO
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2 ml-auto">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">CANTIDAD:</label>
                                        <input type="text" class="form-control" id="cantidad" name="cantidad" required>
                                        
                                        <div class="invalid-feedback">
                                            Es necesario colocar la CANTIDAD
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- FIN COLUMNA 1-->
                            
                        <!-- COLUMNA 2-->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">FRECUENCIA:</label>
                                        <select class="form-control" aria-label="Default select example" id="frecuencia" name="frecuencia" required>
                                                
                                            <option value="" selected>Seleccione</option>
                                            <option value="Mensual">Mensual</option>
                                            <option value="Bimestral">Bimestral</option>
                                            <option value="Cuatrimestral">Cuatrimestral</option>
                                            <option value="Semestral">Semestral</option>
                                            <option value="Anual">Anual</option>
                    
                                        </select>
                                        
                                        <div class="invalid-feedback">
                                            Es necesario colocar la FRECUENCIA
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">NUMERO</label>
                                        <select class="form-control" aria-label="Default select example" id="numfrecuencia" name="numfrecuencia" required>
                                                
                                            <option value="" selected>Seleccione</option>
                                            <option value="12">12</option>
                                            <option value="6">06</option>
                                            <option value="3">03</option>
                                            <option value="2">02</option>
                                            <option value="1">01</option>
                    
                                        </select>
                                        <div class="invalid-feedback">
                                            Es necesario colocar el NUMERO DE MESES
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!--FIN COLUMNA 3-->
                        
                        

                        <!-- COLUMNA 1-->
                            <div class="row">
                                <div class="col-md-4 ">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">COSTO UNITARIO:</label>
                                        <input type="text" class="form-control" id="CostoUnitario" name="CostoUnitario" required>
                                        
                                        <div class="invalid-feedback">
                                            Es necesario colocar el COSTO UNITARIO
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 ">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">PRECIO UNITARIO:</label>
                                        <input type="text" class="form-control" id="PrecioUnitario" name="PrecioUnitario" required>
                                        
                                        <div class="invalid-feedback">
                                            Es necesario colocar el PRECIO UNITARIO
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- FIN COLUMNA 1-->

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Agregar</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- FIN MODAL CREAR NUEVA PARTIDA -->

<!-- Modal CREAR CONTINGENCIA-->
    <div class="modal fade" id="createContingencia" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">AGREGAR COLABORADOR</h5>
                </div>

                <div class="modal-body">
                    <form class="needs-validation" action="{{route('contingencia.store',$cuenta)}}" method="POST" novalidate>

                        @csrf
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">NOMBRES DE PARTIDA:</label>
                                <input type="text" class="form-control" id="partida" name="partida" required>
                            </div>

                        

                            <div class="form-group">
                                <label for="inputPassword" class="col-form-label">TIPO CONTINGENCIA</label>
                                    <select class="form-control" aria-label="Default select example" id="catcontingencias_id" name="catcontingencias_id" required>
                                        <option value="" selected>SELECCIONE USUARIO</option>
                                        @foreach ($catcontingencias as $catcontingencia)
                                            <option value="{{$catcontingencia->id}}">{{$catcontingencia->categoriaContin}}</option>
                                         @endforeach
                                    </select>
                            </div>


                            <div class="row">
                                <div class="col">
                                    <label for="inputPassword" class="col-form-label">SALDO</label>
                                    <input type="number" class="form-control" id="Saldo" name="Saldo">
                                </div>
                                <div class="col">
                                    <label for="inputPassword" class="col-form-label">AÑO</label>
                                    <select class="form-control" aria-label="Default select example" id="anio" name="anio" required>
                                        <option value="" selected>SELECCIONE USUARIO</option>

                                        <?php for ($i = 20; $i < 24; $i++) { ?>
                                            <option value="{{$i}}">20{{$i}}</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn" style="background-color: #{{$boton_crear}}; color: #{{$text_boton_crear}};">Agregar</button>
                            </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
<!-- FIN Modal CREAR CONTINGENCIA-->

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop

