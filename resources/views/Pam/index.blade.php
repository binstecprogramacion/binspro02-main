@extends('adminlte::page')

@section('title', 'PAM '.$cuenta->razonSocial)

@section('content_header')

@php
    
    //SECTION TITULO PRINCIPAL
        $SECT_PRINC = "274c77";
        $SECT_PRINC_TEXT = "ffffff";
@endphp

<section class="shadow p-3 rounded" style="margin-bottom: 15px;margin-left: 20px;margin-right: 20px;background-color:#{{$SECT_PRINC}};">

    <div class="row align-items-center" style=" color: #{{$SECT_PRINC_TEXT}};">
        <div class="col-md-6" >
            <div class="form-group" style="margin-bottom: 0px;">
                <h1>
                    <strong>PAM</strong> - {{$cuenta->razonSocial}}
                </h1>
            </div>
        </div>

        <div class="col-md-6 ml-auto">
            <div class="form-group" style="margin-bottom: 0px;text-align: RIGHT;">
                <button type="button" class="btn btn-outline-light" data-toggle="modal" data-target="#exampleModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"></path>
                    </svg>
                </button>
                <a href="{{route('htestructuras.index',$cuenta)}}"><button type="button" class="btn btn-outline-light">Regresar</button></a>
            </div>
        </div>
    </div>
</section>


@stop

@section('content')

<section class="shadow p-4 rounded  " style="margin-bottom: 15px;margin-left: 20px;margin-right: 20px;">

    @foreach($sedes as $sede)
        @foreach($pams as $pamv)
            <?php if ($pamv->sedes_id == $sede->id) { ?>
            
                <div id="accordion{{$sede->id}}">
                    <div class="card">
                        <div class="card-header" id="headingOne{{$sede->id}}">
                            <h5 class="mb-0">
                                <button class="btn btn-link text-blue btn-block text-left collapsed"  data-toggle="collapse" data-target="#pamSede{{$sede->id}}" aria-expanded="true" aria-controls="pamSede{{$sede->id}}">
                                    Sede:<strong> {{$sede->nomSede}}
                                    </strong> 
                                </button>
                            </h5>
                        </div>
                    
                        <div id="pamSede{{$sede->id}}" class="collapse" aria-labelledby="headingOne{{$sede->id}}" data-parent="#accordion{{$sede->id}}">
                            <div class="card-body">
                                <table class="table table-striped ">
                                    <thead>
                                        <tr class="table-success">
                                            <th class="bg-success" scope="col">ESPECIALIDAD</th>
                                            <th scope="col">ENE</th>
                                            <th scope="col">FEB</th>
                                            <th scope="col">MAR</th>
                                            <th scope="col">ABR</th>
                                            <th scope="col">MAY</th>
                                            <th scope="col">JUN</th>
                                            <th scope="col">JUL</th>
                                            <th scope="col">AGO</th>
                                            <th scope="col">SEP</th>
                                            <th scope="col">OCT</th>
                                            <th scope="col">NOV</th>
                                            <th scope="col">DIC</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($htestructuras as $htestructura)
                                            @foreach($pams as $pam)
                                                <?php if ($pam->sedes_id == $sede->id && $pam->htestructuras_id == $htestructura->id) { ?>
                                                    
                                                    <tr>

                                                        <td scope="col">
                                                            @foreach($htcategorias as $htcategoria)
                                                                <?php if ($htcategoria->id == $htestructura->htcategorias_id) { ?>
                                                                {{$htcategoria->especialidad}}
                                                                <?php } ?>
                                                            @endforeach
                                                        </td>

                                                        <?php for ($i=1; $i < 13; $i++) { ?>

                                                            <td scope="col">


                                                                @foreach($pams as $pamm)
                                                                    <?php if ($pamm->sedes_id ==  $sede->id && $pamm->htestructuras_id == $htestructura->id) { ?>
                                                                        <?php if ($pamm->mes == $i ) { ?>

                                                                            <?php if ($pamm->estado == "Programado") { ?>
                                                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal{{$pamm->id}}{{$pamm->mes}}">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-check" viewBox="0 0 16 16">
                                                                                        <path d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                                                                                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                                                                                    </svg>
                                                                                </button>
                                                                            <?php } ?>

                                                                            <?php if ($pamm->estado == "Cancelado") { ?>
                                                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$pamm->id}}{{$pamm->mes}}">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                                                    </svg> 
                                                                                </button>
                                                                            <?php } ?>

                                                                            <?php if ($pamm->estado == "Realizado") { ?>
                                                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal{{$pamm->id}}{{$pamm->mes}}">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                                                                                        <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"></path>
                                                                                    </svg>  
                                                                                </button>
                                                                            <?php } ?>

                                                                            <?php if ($pamm->estado == "Reprogramado") { ?>
                                                                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal{{$pamm->id}}{{$pamm->mes}}">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-x" viewBox="0 0 16 16">
                                                                                        <path d="M6.146 7.146a.5.5 0 0 1 .708 0L8 8.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 9l1.147 1.146a.5.5 0 0 1-.708.708L8 9.707l-1.146 1.147a.5.5 0 0 1-.708-.708L7.293 9 6.146 7.854a.5.5 0 0 1 0-.708z"/>
                                                                                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                                                                                    </svg> 
                                                                                </button>
                                                                            <?php } ?>

                                                                            <!-- Modal -->
                                                                                <div class="modal fade " id="exampleModal{{$pamm->id}}{{$pamm->mes}}" tabindex="-1" aria-labelledby="exampleModalLabel" data-backdrop="static" aria-hidden="true">
                                                                                    <div class="modal-dialog">
                                                                                        <div class="modal-content ">
                                                                                            <div class="modal-header">
                                                                                                <h5 class="modal-title" id="staticBackdropLabel">Editar PAM : {{$sede->nomSede}}</h5>
                                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                <span aria-hidden="true">&times;</span>
                                                                                                </button>
                                                                                            </div>

                                                                                            <div class="modal-body">

                                                                                                <div class="modal-footer" style="padding: 0px; border-top-width: 0px;">

                                                                                                    <a href="{{route('ejecucion.index',$pamm)}}" target="_blank"><button type="button" class="btn btn-outline-info">VER</button></a>
                                                                                                    
                                                                                                    <form   action="{{route('pam.delite', $pamm)}}" method="POST">
                                                                                                        @csrf
                                                                                                        @method('delete')
                                                                                                        <button type="submit"  class="btn btn-danger " style="text-align: right" >
                                                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                                                                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                                                                                            </svg>
                                                                                                        </button></a>
                                                                                                    </form>
                                                                                                </div>

                                                                                                <form class=" needs-validation" action="{{route('pam.edit', $pamm)}}" method="POST" novalidate>

                                                                                                    @csrf
                                                                                                    @method('put')
                                                                            
                                                                                                    <div class="form-group">
                                                                                                        <label for="recipient-name" class="col-form-label">MES:</label>
                                                                                                        <select class="form-control" aria-label="Default select example" id="mes" name="mes" required>

                                                                                                            <?php if ($pamm->mes == null) { ?>
                                                                                                                <option value="" selected>Seleccione</option>
                                                                                                                <option value="Enero">Enero</option>
                                                                                                                <option value="Febrero">Febrero</option>
                                                                                                                <option value="Marzo">Marzo</option>
                                                                                                                <option value="Abril">Abril</option>
                                                                                                                <option value="Mayo">Mayo</option>
                                                                                                                <option value="Junio">Junio</option>
                                                                                                                <option value="Julio">Julio</option>
                                                                                                                <option value="Agosto">Agosto</option>
                                                                                                                <option value="Septiembre">Septiembre</option>
                                                                                                                <option value="Octubre">Octubre</option>
                                                                                                                <option value="Noviembre">Noviembre</option>
                                                                                                                <option value="Diciembre">Diciembre</option>
                                                                                                            <?php } ?>

                                                                                                            @foreach($meses as $mes)
                                                                                                            <?php if ($mes->id == $pamm->mes) { ?>
                                                                                                                <option value={{$mes->id}} selected>{{$mes->nomb_mes}}</option>
                                                                                                            <?php }else { ?>
                                                                                                                <option value={{$mes->id}}>{{$mes->nomb_mes}}</option>
                                                                                                            <?php } ?>

                                                                                                            @endforeach

                                                                                                            

                                                                                                            
                                                                                    
                                                                                                        </select>
                                                                                                    </div>
                                                                            
                                                                                                    <div class="form-group">
                                                                                                        <label for="recipient-name" class="col-form-label">ESTADO:</label>
                                                                                                        <select class="form-control" aria-label="Default select example" id="estado" name="estado" required>

                                                                                                            <?php if ($pamm->estado == null) { ?>
                                                                                                                <option value="" selected>Seleccione</option>
                                                                                                                <option value="Programado">Programado</option>
                                                                                                                <option value="Cancelado">Cancelado</option>
                                                                                                                <option value="Realizado">Realizado</option>
                                                                                                                <option value="Reprogramado">Reprogramado</option>
                                                                                                            <?php } ?>

                                                                                                            <?php if ($pamm->estado == "Programado") { ?>
                                                                                                                <option value="Programado" selected>Programado</option>
                                                                                                                <option value="Cancelado">Cancelado</option>
                                                                                                                <option value="Realizado">Realizado</option>
                                                                                                                <option value="Reprogramado">Reprogramado</option>
                                                                                                            <?php } ?>

                                                                                                            <?php if ($pamm->estado == "Cancelado") { ?>
                                                                                                                <option value="Programado" >Programado</option>
                                                                                                                <option value="Cancelado" selected>Cancelado</option>
                                                                                                                <option value="Realizado">Realizado</option>
                                                                                                                <option value="Reprogramado">Reprogramado</option>
                                                                                                            <?php } ?>

                                                                                                            <?php if ($pamm->estado == "Realizado") { ?>
                                                                                                                <option value="Programado" >Programado</option>
                                                                                                                <option value="Cancelado" >Cancelado</option>
                                                                                                                <option value="Realizado" selected>Realizado</option>
                                                                                                                <option value="Reprogramado">Reprogramado</option>
                                                                                                            <?php } ?>

                                                                                                            <?php if ($pamm->estado == "Reprogramado") { ?>
                                                                                                                <option value="Programado" >Programado</option>
                                                                                                                <option value="Cancelado" >Cancelado</option>
                                                                                                                <option value="Realizado">Realizado</option>
                                                                                                                <option value="Reprogramado" selected>Reprogramado</option>
                                                                                                            <?php } ?>
                                                                                    
                                                                                                        </select>
                                                                                                    </div>
                                                                            
                                                                                                    <div class="modal-footer">
                                                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                                                                                    </div>
                                                                                                </form>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            <!-- Fin Modal -->

                                                                            <?php break;}?>
                                                                    <?php }?>
                                                                @endforeach
                                                            
                                                            
                                                            </td>
                                                            
                                                        <?php } ?>
                                                        
                                                        
                                                    </tr>

                                                <?php break;} ?>
                                            @endforeach

                                        @endforeach
                                    </tbody>

                                </table>


                            </div>
                        </div>
                    </div>
                </div>

            <?php break; } ?>
        @endforeach

    @endforeach

    {{$sedes->links()}}


</section>


<!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir Nuevo</h1>
                </div>

                <div class="modal-body">
                    <form class=" needs-validation" action="{{route('pam.create', $cuenta)}}" method="POST" novalidate>

                        @csrf

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">SEDE:</label>
                            <select class="form-control" aria-label="Default select example" id="sedes_id" name="sedes_id" required>
                                    
                                <option value="" selected>Seleccione</option>
                                @foreach($sedesTo as $sedesTos)
                                <option value={{$sedesTos->id}}>{{$sedesTos->nomSede}}</option>
                                @endforeach
        
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">ESPECIALIDAD:</label>
                            <select class="form-control" aria-label="Default select example" id="htestructuras_id" name="htestructuras_id" required>
                                    
                                <option value="" selected>Seleccione</option>

                                @foreach($htestructuras as $htestructura)
                                    @foreach($htcategorias as $htcategoria)
                                        <?php if ($htcategoria->id == $htestructura->htcategorias_id) { ?>
                                            <option value={{$htestructura->id}}>{{$htcategoria->especialidad}}</option>
                                        <?php } ?>
                                    @endforeach
                                @endforeach
        
                            </select>
                        </div>
                        

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">MES:</label>
                            <select class="form-control" aria-label="Default select example" id="mes" name="mes" required>
                                    
                                <option value="" selected>Seleccione</option>

                                @foreach($meses as $mes)
                                        <option value={{$mes->id}}>{{$mes->nomb_mes}}</option>
                                @endforeach
        
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">ESTADO:</label>
                            <select class="form-control" aria-label="Default select example" id="estado" name="estado" required>
                                    
                                <option value="" selected>Seleccione</option>
                                <option value="Programado">Programado</option>
                                <option value="Cancelado">Cancelado</option>
                                <option value="Realizado">Realizado</option>
                                <option value="Reprogramado">Reprogramado</option>
        
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- Fin Modal -->


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop