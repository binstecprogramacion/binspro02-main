@extends('adminlte::page')

@section('title', $cuenta ->razonSocial)

@section('content_header')

@php
    
    //SECTION TITULO PRINCIPAL
        $SECT_PRINC = "274c77";
        $SECT_PRINC_TEXT = "ffffff";

    //BOTON CREAR
        $boton_crear = "01497C";
        $text_boton_crear = "ffffff";
@endphp

<section class="p-3 rounded" style="margin-bottom: 15px;margin-left: 20px;margin-right: 20px;background-color:#{{$SECT_PRINC}};">

    <div class="row lign-items-center" style=" color: #{{$SECT_PRINC_TEXT}};">
        <div class="col-md-6 ">
            <div class="form-group" style="margin-bottom: 0px;">
                <h1><strong> {{$cuenta ->razonSocial}}</strong></h1> 
            </div>
        </div>
        <div class="col-md-6 ml-auto">
            <div class="form-group" style="margin-bottom: 0px;text-align: RIGHT;">
                <a href="{{route('htestructuras.index',$cuenta ->id)}}"><button type="button" class="btn btn-outline-light">VER HT</button></a>
            </div>
        </div>
    </div>

</section>


@stop

@section('content')


    <!-- ACORDEON DE DOCUMENTOS -->
        <div class="accordion" id="accordionExample" style="margin-bottom: 15px;margin-left: 20px;margin-right: 20px;">
            <div class="card">

                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#DATOS_DE_CUENTA" aria-expanded="true" aria-controls="collapseOne">
                            Documentos
                        </button>
                        </h2>
                    </div>
                
                    <div id="DATOS_DE_CUENTA" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">

                            <!-- INICIO SECCION DOCUMENTACION DE LA CUENTA -->
                                @foreach($quotes as $quote)   
                                
                                        <?php if ($quote->cuenta_id = $cuenta->id) { ?>

                                            <form>
                                                <div class="form-row">
                                                    
                                                    <div class="col-3" style="padding-left: 20px;">
                                                        @foreach($documentations as $documentation)
                                                            <?php if ($documentation->id ==$quote->documentation_id) { ?>
                                                                {{$documentation->nombreCatgDoc}}
                                                            <?php } ?>
                                                        @endforeach
                                                    </div>
                                                    <div class="col-3">
                                                        {{$quote->nombreCotCon}}
                                                    </div>
                                                    <div class="col-3">
                                                        <?php if ($quote->pdfDoc == null) { ?>
                                                            Ningun docuemnto cargado
                                                        <?php }else { ?>
                                                            <a href="../Archivos/{{$quote->pdfDoc}}" target="blank_">Ver documento</a>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="col-3">
                                                        <form   action="{{route('cotizacion.destroy', $quote)}}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit"  class="btn btn-danger" >L</button></a>
                                                        
                                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#EDITCotizacionContrato{{$quote->id}}"     >
                                                            E
                                                        </button>
                                            
                                                    </form>
                                                    </div>
                                                </div>
                                            </form>
                                        
                                                

                                                            
                                                                <!-- MODAL EDITAR  DOCUMENTO COTIZACION-->
                                                                    <div class="modal fade" id="EDITCotizacionContrato{{$quote->id}}" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalCenterTitle" 
                                                                        aria-hidden="true">
                                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="exampleModalLongTitle">EDITAR DOCUMENTACION</h5>
                                                                                    </div>
                                                    
                                                                                    <div class="modal-body">
                                                                                        <form class=" needs-validation" action="{{route('cotizacion.update', $quote)}}" method="POST" enctype="multipart/form-data" novalidate>
                                                
                                                                                            @csrf
                                                                                            @method('put')
                                                    
                                                                                            <div class="form-group">
                                                                                                <label for="recipient-name" class="col-form-label">NOMBRE DEL DOCUMENTO:</label>
                                                                                                <input type="text" class="form-control" id="nombreCotCon" name="nombreCotCon" value="{{$quote->nombreCotCon}}" required>
                                                                                                <div class="invalid-feedback">
                                                                                                    Es necesario colocar el NOMBRE DEL DOCUMENTO
                                                                                                </div>
                                                                                            </div>
                                                    
                                                                                            <div class="form-group">
                                                                                                <label for="recipient-name" class="col-form-label">INGRESE DOCUEMNTO: PDF</label>
                                                                                                <input type="file" class="form-control-file" id="pdfDoc" name="pdfDoc">
                                                                                            </div>


                                                                                            <div class="form-group">
                                                                                                <label for="recipient-name" class="col-form-label">AÑO:</label>
                                                                                                <select class="form-control" aria-label="Default select example" id="anioCotCon" name="anioCotCon" required>
                                                                                                    
                                                                                                    
                                                                                                    <?php if ($quote->anioCotCon == "") { ?>
                                                                                                        <option value="" selected>SELECCIONE AÑO</option>
                                                                                                            <option value="2020">2020</option>
                                                                                                            <option value="2021">2021</option>
                                                                                                            <option value="2022">2022</option>
                                                                                                            <option value="2023">2023</option>
                                                                                                            <option value="2024">2024</option>
                                                                                                            <option value="2025">2025</option>
                                                                                                    <?php } elseif ($quote->anioCotCon == "2020") { ?>
                                                                                                        <option value="2020" selected>2020</option>
                                                                                                            <option value="2021">2021</option>
                                                                                                            <option value="2022">2022</option>
                                                                                                            <option value="2023">2023</option>
                                                                                                            <option value="2024">2024</option>
                                                                                                            <option value="2025">2025</option>
                                                                                                    <?php } elseif ($quote->anioCotCon == "2021") { ?>
                                                                                                        
                                                                                                            <option value="2020">2020</option>
                                                                                                            <option value="2021" selected>2021</option>
                                                                                                            <option value="2022">2022</option>
                                                                                                            <option value="2023">2023</option>
                                                                                                            <option value="2024">2024</option>
                                                                                                            <option value="2025">2025</option>
                                                                                                    <?php } elseif ($quote->anioCotCon == "2022") { ?>
                                                                                                        
                                                                                                            <option value="2020">2020</option>
                                                                                                            <option value="2021">2021</option>
                                                                                                            <option value="2022" selected>2022</option>
                                                                                                            <option value="2023">2023</option>
                                                                                                            <option value="2024">2024</option>
                                                                                                            <option value="2025">2025</option>
                                                                                                    <?php } elseif ($quote->anioCotCon == "2023") { ?>
                                                                                                        
                                                                                                            <option value="2020">2020</option>
                                                                                                            <option value="2021">2021</option>
                                                                                                            <option value="2022">2022</option>
                                                                                                            <option value="2023" selected>2023</option>
                                                                                                            <option value="2024">2024</option>
                                                                                                            <option value="2025">2025</option>
                                                                                                    <?php } elseif ($quote->anioCotCon == "2024") { ?>
                                                                                                        
                                                                                                            <option value="2020">2020</option>
                                                                                                            <option value="2021">2021</option>
                                                                                                            <option value="2022">2022</option>
                                                                                                            <option value="2023">2023</option>
                                                                                                            <option value="2024" selected>2024</option>
                                                                                                            <option value="2025">2025</option>
                                                                                                    <?php } elseif ($quote->anioCotCon == "2025") { ?>
                                                                                                        
                                                                                                            <option value="2020">2020</option>
                                                                                                            <option value="2021">2021</option>
                                                                                                            <option value="2022">2022</option>
                                                                                                            <option value="2023">2023</option>
                                                                                                            <option value="2024">2024</option>
                                                                                                            <option value="2025" selected>2025</option>
                                                                                                    <?php }?>

                                                                                                            
                                                                                    
                                                
                                                                                                </select>
                                                                                                <div class="invalid-feedback">
                                                                                                    Es necesario seleccionar el AÑO
                                                                                                </div>
                                                                                            </div>
                                                    
                                                                                            <!-- CONDICIONAL PARA LISTAR CATEGORIQ-->
                                                                                                <div class="form-group">
                                                                                                    <label for="recipient-name" class="col-form-label">CATEGORIA:</label>
                                                                                                    <select class="form-control" aria-label="Default select example" id="documentation_id" name="documentation_id" required>
                                                    
                                                                                                        @foreach($documentations as $documentation) 
                                                                                                            <?php if ($quote->documentation_id == $documentation->id) { ?>
                                                                                                                <option value="{{$documentation->id}}" selected>{{$documentation->nombreCatgDoc}}</option>
                                                                                                            <?php } ?>
                                                                                                        @endforeach
                                                    
                                                    
                                                                                                        @foreach($documentations as $documentation) 
                                                                                                            <?php if ($quote->documentation_id != $documentation->id) { ?>
                                                                                                                <option value="{{$documentation->id}}">{{$documentation->nombreCatgDoc}}</option>
                                                                                                            <?php } ?>
                                                                                                        @endforeach
                                                    
                                                                                                    </select>
                                                                                                    <div class="invalid-feedback">
                                                                                                        Es necesario colocar el TIPO DEL DOCUMENTO
                                                                                                    </div>
                                                                                                </div>
                                                    
                                                                                            <!-- CONDICIONAL PARA LISTAR CATEGORIQ-->
                                                    
                                                                                            <div class="modal-footer">
                                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                                                <button type="submit" class="btn btn-primary">Actualizar</button>
                                                                                            </div>
                                                                                        
                                                                                            
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                    </div>
                                                                <!-- FIN MODAL EDITAR  DOCUMENTO COTIZACION-->
                                                        

                                        <?php } ?>

                                @endforeach
                            <!-- FIN SECCION DOCUMENTACION DE LA CUENTA -->

                            <button type="button" class="btn btn-link"  data-toggle="modal" data-target="#createCotizacionContrato"  style="text-decoration:none">
                                Agregar Nuevo Documento 
                            </button>
                        </div>
                    </div>
            </div>
        </div>
    <!-- FIN ACORDEON DE DOCUMENTOS -->

            
    <!-- ACORDEON DE DATOS DE CUENTA -->
        <div class="accordion" id="accordionExample" style="margin-bottom: 15px;margin-left: 20px;margin-right: 20px;">
            <div class="card">
                    <div class="card" style="margin-bottom: 0px;">
                        <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#datos_cuenta" aria-expanded="false" aria-controls="collapseTwo">
                                Datos de Cuenta
                                </button>
                            </h2>
                        </div>

                        <div id="datos_cuenta" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">
                                    <!-- *********CUENTA / EMPRESA********** -->
                                    <!-- INICIO SECCION DATOS DE EMPRESA -->
                                        <form>
                                            <div class="row">
                                                <div class="col">
                                                <label for="exampleFormControlInput1">RUC</label>
                                                <input type="text" class="form-control"  value="{{$cuenta ->ruc}}" readonly>
                                                </div>
                                                <div class="col">
                                                    <label for="exampleFormControlSelect2">CATEGORIA</label>
                                                    @foreach ($catcuentas as $catcuenta)
                                                    <?php if ($cuenta->catcuentas_id == $catcuenta->id) { ?>
                                                        <input type="text" class="form-control" value="{{$catcuenta ->CatgEmpresa}}" readonly>
                                                    <?php }?>
                                                    @endforeach
                                                    <?php if ($cuenta->catcuentas_id == null) { ?>
                                                        <input type="text" class="form-control" value="Sin asignar" readonly>
                                                    <?php }?>
                                                    
                                                </div>
                                            </div>
                                            
                                    
                                            <div class="row">
                                                <div class="col">
                                                    <label for="exampleFormControlSelect2">Fecha Creacion</label>
                                                    <input type="text" class="form-control"  value="{{$cuenta ->created_at}}" readonly>
                                                </div>
                                                <div class="col">
                                                    <label for="exampleFormControlSelect2">Fecha Actualizacion</label>
                                                    <input type="text" class="form-control" value="{{$cuenta ->updated_at}}" readonly>
                                                </div>
                                            </div>
                                    
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">ESTADO</label>
                                    
                                                <?php if ($cuenta ->estado=='0') { ?>
                                                    <input type="text" class="form-control"  value="Inactivo" readonly>
                                                <?php } elseif ($cuenta ->estado=='1') { ?>
                                                    <input type="text" class="form-control"  value="Activo" readonly>
                                                <?php } else { ?>
                                                    <input type="text" class="form-control"  value="En Proceso de asignacion" readonly>
                                                <?php }?>
                                            </div>
                                    
                                        </form>
                                        <br>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateCuenta" style="margin-bottom: 10px;">
                                                Editar
                                        </button>
                                    <!-- FIN SECCION DATOS DE EMPRESA -->
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    <!-- FIN ACORDEON DE DATOS DE CUENTA -->


    <!-- ACORDEON DE INTERLOCUTOR -->
        <div class="accordion" id="accordionExample" style="margin-bottom: 15px;margin-left: 20px;margin-right: 20px;">
            <div class="card">
                
                    <div class="card" style="margin-bottom: 0px;">
                        <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Interlocutor
                                </button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">
                                <!-- *********INTERLOCUTORES********** -->
                                <!-- INICIO SECCION DATOS DE INTERLOCUTOR -->
                                    @foreach($interlocutors as $interlocutor)
                                        <?php if ($interlocutor ->cuenta_id == $cuenta ->id) { ?>

                                            <section class="p-3 bg-white rounded" style="margin-bottom: 15px;margin-left: 20px;margin-right: 20px;">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h3>{{$interlocutor->nombre}} {{$interlocutor->apellidos}}</h3> 
                                                    </div>

                                                    <div class="col-md-6" style="text-align: RIGHT;">
                                                        <form   action="{{route('interlocutors.destroy', $interlocutor->id)}}" method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editInterlocutor{{$interlocutor->id}}" >
                                                                Editar
                                                            </button>
                                                            <button type="submit"  class="btn btn-danger" >Eliminar</button></a>
                                                        </form>
                                                    </div>
                                                </div>
                                                <br>
                                                <form style="margin-bottom: 0px;">
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="exampleFormControlSelect2" class="col-form-label">Correo</label>
                                                            <input type="email" class="form-control" placeholder="En proceso de asignacion" value="{{$interlocutor->correo}}" readonly>
                                                        </div>
                                                        <div class="col">
                                                            <label for="exampleFormControlSelect2" class="col-form-label">Telefono</label>
                                                            <input type="text" class="form-control" placeholder="En proceso de asignacion" value="{{$interlocutor->telefono}}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="exampleFormControlSelect2">Fecha Creacion</label>
                                                            <input type="text" class="form-control" placeholder="En proceso de asignacion" value="{{$interlocutor->created_at}}" readonly>
                                                        </div>
                                                        <div class="col">
                                                            <label for="exampleFormControlSelect2">Fecha Actualizacion</label>
                                                            <input type="text" class="form-control" placeholder="En proceso de asignacion" value="{{$interlocutor->updated_at}}" readonly>
                                                        </div>
                                                    </div>

                                                    <?php if ($interlocutor->descripcion != null) { ?>
                                                        <div class="form-group">
                                                            <label for="exampleFormControlInput1">Descripcion</label>
                                                            <textarea class="form-control" id="message-text" style="height: 94px;">{{$interlocutor->descripcion}}</textarea>
                                                        </div>
                                                    <?php }?>     

                                                </form>
                                                <br>
                                                            

                                                    <!-- Modal EDITAR INTERLOCUTOR-->
                                                        <div class="modal fade" id="editInterlocutor{{$interlocutor->id}}" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" >Actualizando:</h5>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        <form class=" needs-validation" action="{{route('interlocutors.update',$interlocutor)}}" method="POST" novalidate>

                                                                            @csrf
                                                                            @method('put')

                                                                            <div class="form-group">
                                                                                <label for="recipient-name" class="col-form-label">NOMBRE:</label>
                                                                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{$interlocutor ->nombre}}" required>
                                                                                <div class="invalid-feedback">
                                                                                    Es necesario ingresar los NOMBRES
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label for="recipient-name" class="col-form-label">APELLIDO:</label>
                                                                                <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{$interlocutor ->apellidos}}" required>
                                                                                <div class="invalid-feedback">
                                                                                    Es necesario ingresar los APELLIDOS
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label for="recipient-name" class="col-form-label">CORREO:</label>
                                                                                <input type="text" class="form-control" id="correo" name="correo" value="{{$interlocutor ->correo}}" required>
                                                                                <div class="invalid-feedback">
                                                                                    Es necesario ingresar un CORREO
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label for="recipient-name" class="col-form-label">TELEFONO:</label>
                                                                                <input type="number" class="form-control" id="telefono" name="telefono" value="{{$interlocutor ->telefono}}" required>
                                                                                <div class="invalid-feedback">
                                                                                    Es necesario ingresar un TELEFONO
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label for="recipient-name" class="col-form-label">DESCRIPCION:</label>
                                                                                <textarea class="form-control" id="descripcion" name="descripcion" style="height: 94px;">{{$interlocutor->descripcion}}</textarea>
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
                                                    <!-- FIN Modal EDITAR INTERLOCUTOR-->

                                            </section>
                                        <?php } ?>
                                    @endforeach
                                <!-- FIN SECCION DATOS DE INTERLOCUTOR -->


                                <!-- INICIO BOTON AÑADIR INTERLOCUTOR -->
                                    <section class="p-3 bg-white rounded" style="margin-bottom: 15px;margin-left: 20px;margin-right: 20px;">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createInterlocutor" 
                                        style="margin-bottom: 10px;">
                                            Añadir Interlocutor
                                        </button>
                                    </section>
                                <!-- FIN BOTON AÑADIR INTERLOCUTOR -->

                            </div>
                        </div>
                    </div>

            </div>
        </div>
    <!-- FIN ACORDEON DE INTERLOCUTOR -->


    <!-- ACORDEON COLABORADOR -->
        <div class="accordion" id="accordionExample" style="margin-bottom: 15px;margin-left: 20px;margin-right: 20px;">
            <div class="card">
                    <div class="card" style="margin-bottom: 0px;">
                        <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#colaboradores" aria-expanded="false" aria-controls="collapseTwo">
                                Colaborador
                                </button>
                            </h2>
                        </div>

                        <div id="colaboradores" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">

                                <!-- *********COLABORADORES********** -->
                                <!-- INICIO SECCION DATOS DE COLABORADORES -->
                                    <section class="p-3 bg-white rounded" style="margin-bottom: 0px;margin-left: 20px;margin-right: 20px;">

                                        <table class="table" style="margin-bottom: 0px;">
                                            <thead class="table table-striped table-dark">
                                                <tr>
                                                    <th scope="col">Nombres</th>
                                                    <th scope="col">Apellidos</th>
                                                    <th scope="col">Doc_Ident</th>
                                                    <th scope="col">Telefono</th>
                                                    <th scope="col">Direccion</th>
                                                    <th scope="col">Cargo</th>
                                                    <th colspan="2"></th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($collaborators as $collaborator)

                                                    @foreach ($pirsons as $pirson)
                                                        <?php if ($collaborator->pirsons_id == $pirson->id) { ?>
                                                        
                                                        <td >{{$pirson ->nombre}}</td>
                                                        <td >{{$pirson ->apellidos}}</td>
                                                        <td >{{$pirson ->docIdentidad}}</td>
                                                        <td >{{$pirson ->telefono}}</td>
                                                        <td >{{$pirson ->direccion}}</td>  

                                                            
                                                        <?php break;} ?>
                                                    @endforeach

                                                    @foreach ($cargos as $cargo)
                                                        <?php if ($collaborator->cargos_id == $cargo->id) { ?>
                                                        
                                                            <td >{{$cargo ->cargo}}</td>

                                                        <?php break;} ?>
                                                    @endforeach

                                                        <td align="center">
                                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#updateColaborador{{$collaborator->id}}" 
                                                                style="margin-bottom: 10px" >
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                                </svg>
                                                            </button>
                                                        </td>

                                                        <!-- Modal EDITAR COLABORADOR-->
                                                            <div class="modal fade" id="updateColaborador{{$collaborator->id}}" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLongTitle">AGREGAR COLABORADOR</h5>
                                                                        </div>

                                                                        <div class="modal-body">
                                                                            <form class="needs-validation" action="{{route('colaborador.update',$collaborator)}}" method="POST" novalidate>

                                                                                @csrf
                                                                                @method('put')

                                                                                    <div class="form-group">
                                                                                        <label for="recipient-name" >USUARIO:</label>
                                                                                        <select class="form-control" aria-label="Default select example" id="pirsons_id" name="pirsons_id" required>
                                                                                                
                                                                                            

                                                                                            @foreach($pirsons as $pirson) 
                                                                                                <?php if ($collaborator->pirsons_id == $pirson->id) { ?>
                                                                                                    <option value="{{$pirson->id}}" selected>{{$pirson->docIdentidad}}-{{$pirson->nombre}}-{{$pirson->apellidos}}</option>
                                                                                                <?php }else { ?>
                                                                                                    <option value="{{$pirson->id}}">{{$pirson->docIdentidad}}-{{$pirson->nombre}}-{{$pirson->apellidos}}</option>
                                                                                                <?php } ?>
                                                                                            @endforeach

                                                                                        </select>
                                                                                    </div>

                                                                                    <div class="form-group">
                                                                                        <label for="recipient-name" >CARGO:</label>
                                                                                        <select class="form-control" aria-label="Default select example" id="cargos_id" name="cargos_id" required>
                                                                                                
                                                                                            @foreach($cargos as $cargo) 
                                                                                                <?php if ($collaborator->cargos_id == $cargo->id) { ?>
                                                                                                    <option value="{{$cargo->id}}" selected>{{$cargo->cargo}}</option>
                                                                                                <?php }else { ?>
                                                                                                    <option value="{{$cargo->id}}">{{$cargo->cargo}}</option>
                                                                                                <?php } ?>
                                                                                            @endforeach

                                                                                        </select>
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
                                                        <!-- FIN Modal CREAR COLABORADOR-->

                                                        <td align="center">
                                                            <form   action="{{route('colaborador.destroy',$collaborator)}}" method="POST">
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

                                    </section>
                                <!-- FIN SECCION DATOS DE COLABORADORES -->


                                <!-- INICIO BOTON AÑADIR INTERLOCUTOR -->
                                    <section class="p-3 bg-white rounded" style="margin-bottom: 15px;margin-left: 20px;margin-right: 20px;">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createColaborador" 
                                        style="margin-bottom: 10px;">
                                            Nuevo Colaborador
                                        </button>
                                    </section>
                                <!-- FIN BOTON AÑADIR INTERLOCUTOR -->

                            </div>
                        </div>
                    </div>
            </div>
        </div>
    <!-- FIN ACORDEON DE COLABORADOR -->



<!-- *********SEDES********** -->
<!-- INICIO SECCION DATOS DE SEDES -->
    <section class="shadow p-3 bg-white rounded" style="margin-bottom: 15px;margin-left: 20px;margin-right: 20px;">
        <h3>Sedes</h3> 
        <br>
        <div class="table-responsive">
            <table class="table">
                <thead class="table table-striped table-dark">
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Nombre Sede</th>
                        <th scope="col">Direccion</th>
                        <th scope="col">M<sup>2</sup></th>
                        <th scope="col">Fecha Creacion</th>
                        <th scope="col">Fecha Actualizacion</th>
                        <th colspan="2"></th>
                        
                    </tr>
                </thead>
                <tbody>
                    
                        
                    @foreach($sedes as $sede)

                    <?php if ($sede ->cuenta_id == $cuenta ->id) { ?>
                        
                        <tr>
                            <td >{{$sede ->id}}</td>
                            <td style="width:250px">{{$sede ->nomSede}}</td>
                            <td style="width:250px">{{$sede ->direccion}}</td>
                            <td style="width:10px">{{$sede ->metraje}}</td>
                            <td >{{$sede ->created_at}}</td>
                            <td >{{$sede ->updated_at}}</td>

                            
                            <td style="width:50px">
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editSede-{{$sede ->id}}" >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                    </svg>
                                </button>

                            </td>
                            
                                    <!-- Modal EDITAR SEDE-->
                                        <div class="modal fade" id="editSede-{{$sede->id}}" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" >Actualizando Sede: {{$sede ->nomSede}}</h5>
                                                        </div>
                                                        <div class="modal-body" style="padding-top: 0px;">
                                                            <form class=" needs-validation" action="{{route('sedes.update',$sede)}}" method="POST" novalidate>

                                                                @csrf
                                                                @method('put')

                                                                <div class="form-group">
                                                                    <label for="recipient-name" class="col-form-label">NOMBRE SEDE:</label>
                                                                    <input type="text" class="form-control" id="nomSede" name="nomSede" value="{{$sede ->nomSede}}" required>
                                                                    <div class="invalid-feedback">
                                                                        Es necesario ingresar NOMBRE DE LA SEDE
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="exampleFormControlSelect1">PROVINCIA:</label>
                                                                    <select class="form-control" id="alcances_id" name="alcances_id" required >

                                                                        <?php if ($sede ->alcances_id == null) { ?>
                                                                            <option value="" selected>Seleccionar provincia</option>
                                                                            @foreach($alcances as $alcance) 
                                                                                <option value="{{$alcance->id}}">{{$alcance->id}}-{{$alcance->provincia}}</option>
                                                                            @endforeach
                                                                        <?php }?>

                                                                            @foreach($alcances as $alcance) 
                                                                                <?php if ($sede ->alcances_id == $alcance->id) { ?>
                                                                                    <option value="{{$alcance->id}}" selected>{{$alcance->provincia}}</option>
                                                                                <?php } else {?>
                                                                                    <option value="{{$alcance->id}}">{{$alcance->id}}-{{$alcance->provincia}}</option>
                                                                                <?php }?>
                                                                            @endforeach

                                                                        
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="recipient-name" class="col-form-label">DIRECCION:</label>
                                                                    <input type="text" class="form-control" id="direccion" name="direccion" value="{{$sede ->direccion}}" required>
                                                                    <div class="invalid-feedback">
                                                                        Es necesario ingresar la DIRECCION
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="recipient-name" class="col-form-label">METRAJE:</label>
                                                                    <input type="number" class="form-control" id="metraje" name="metraje" value="{{$sede ->metraje}}" required>
                                                                    <div class="invalid-feedback">
                                                                        Es necesario ingresar la DIRECCION
                                                                    </div>
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
                                    <!-- FIN Modal EDITAR SEDE-->

                            <td style="width:50px">
                                <form   action="{{route('sedes.destroy', $sede->id)}}" method="POST">
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

                    <?php } ?>
                            

                        
                    @endforeach

                </tbody>
            </table>
        </div>

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createSede" 
                    style="margin-bottom: 10px;">
                        Añadir Sede
        </button>
    </section>
<!-- FIN SECCION DATOS DE INTERLOCUTOR -->








<!-- Modal EDITAR CUENTA-->
    <div class="modal fade" id="updateCuenta" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Actualizando: {{$cuenta ->razonSocial}}</h5>

                </div>
                    <div class="modal-body">
                        <form class="needs-validation" action="{{route('cuentas.update',$cuenta)}}" method="POST" novalidate>

                            @csrf
                            @method('put')

                            

                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">RUC:</label>
                                <input type="number" class="form-control" min="1" max="999999999999" id="ruc" name="ruc" value="{{$cuenta ->ruc}}" required>
                                <div class="invalid-feedback">
                                    Es necesario colocar el RUC
                                </div>
                            </div>

                            <!-- VALIDACION PARA INGRESO DE 11 DIGITOS -->
                                <script language="JavaScript">
                                    var input=  document.getElementById('ruc');
                                    input.addEventListener('input',function(){
                                    if (this.value.length > 11) 
                                        this.value = this.value.slice(0,11); 
                                    })
                                </script>
                            <!-- FIN VALIDACION PARA INGRESO DE 11 DIGITOS -->

                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">RAZON SOCIAL:</label>
                                <input type="text" class="form-control" id="razonSocial" name="razonSocial" value="{{$cuenta ->razonSocial}}" required>
                                <div class="invalid-feedback">
                                    Es necesario colocar la RAZON SOCIAL
                                </div>
                            </div>

                            
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">ESTADO:</label>
                                <select class="form-control" aria-label="Default select example" id="estado" name="estado" required>

                                    <!-- CONDICIONAL PARA MOSTRAR ESTADO -->
                                        <?php if ($cuenta ->estado=='0') { ?>
                                            <option value="0" selected>Inactivo</option>
                                            <option value="1">Activo</option>
                                        <?php } elseif ($cuenta ->estado=='1') { ?>
                                            <option value="1" selected>Activo</option>
                                            <option value="0">Inactivo</option>
                                        <?php } else { ?>
                                            <option value="" selected>Seleccionar estado</option>
                                            <option value="1">Activo</option>
                                            <option value="0">Inactivo</option>
                                        <?php }?>
                                    <!-- FIN CONDICIONAL  -->

                                </select>
                                <div class="invalid-feedback">
                                    Es necesario seleccionar un ESTADO
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">CATEGORIA:</label>
                                <select class="form-control" aria-label="Default select example" id="catcuentas_id" name="catcuentas_id" required>

                                        <?php if ($cuenta->catcuentas_id == null) { ?>
                                            <option value="" selected>Seleccionar Categoria</option>
                                        <?php }?>

                                    @foreach($catcuentas as $catcuenta) 
                                        <?php if ($cuenta->catcuentas_id == $catcuenta->id) { ?>
                                            <option value="{{$catcuenta->id}}" selected>{{$catcuenta->CatgEmpresa}}</option>
                                        <?php }else { ?>
                                            <option value="{{$catcuenta->id}}">{{$catcuenta->CatgEmpresa}}</option>
                                        <?php } ?>
                                    @endforeach

                                </select>
                                <div class="invalid-feedback">
                                    Es necesario seleccionar un ESTADO
                                </div>
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
<!-- FIN Modal EDITAR CUENTA-->


<!-- Modal CREAR SEDE-->
    <div class="modal fade" id="createSede" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">AGREGAR NUEVA SEDE</h5>
                </div>

                <div class="modal-body">
                    <form class=" needs-validation" action="{{route('sedes.store',$cuenta)}}" method="POST" novalidate>

                        @csrf

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">NOMBRE SEDE:</label>
                            <input type="text" class="form-control" id="nomSede" name="nomSede" required>
                            <div class="invalid-feedback">
                                Es necesario ingresar NOMBRE DE LA SEDE
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect1">PROVINCIA:</label>
                            <select class="form-control" id="alcances_id" name="alcances_id" required >
                                <option value="" selected>Seleccionar provincia</option>
                                @foreach($alcances as $alcance) 
                                <option value="{{$alcance->id}}">{{$alcance->id}}-{{$alcance->provincia}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">DIRECCION:</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" required>
                            <div class="invalid-feedback">
                                Es necesario ingresar la DIRECCION
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">METRAJE:</label>
                            <input type="number" class="form-control" id="metraje" name="metraje" >
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
<!-- FIN Modal CREAR SEDE-->


<!-- Modal CREAR INTERLOCUTOR-->
    <div class="modal fade" id="createInterlocutor" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">AGREGAR NUEVO INTERLOCUTOR</h5>
                </div>

                <div class="modal-body">
                    <form class=" needs-validation" action="{{route('interlocutors.store',$cuenta)}}" method="POST" novalidate>

                        @csrf

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">NOMBRES:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                            <div class="invalid-feedback">
                                Es necesario ingresar los NOMBRES
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">APELLIDOS:</label>
                            <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                            <div class="invalid-feedback">
                                Es necesario ingresar los APELLIDOS
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">CORREO:</label>
                            <input type="text" class="form-control" id="correo" name="correo" required>
                            <div class="invalid-feedback">
                                Es necesario ingresar un CORREO
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">TELEFONO:</label>
                            <input type="number" class="form-control" id="telefono" name="telefono" required>
                            <div class="invalid-feedback">
                                Es necesario ingresar un TELEFONO
                            </div>
                        </div>

                        <!-- VALIDACION PARA INGRESO DE 11 DIGITOS -->
                            <script language="JavaScript">
                                var input=  document.getElementById('telefono');
                                input.addEventListener('input',function(){
                                if (this.value.length > 9) 
                                    this.value = this.value.slice(0,9); 
                                })
                            </script>
                        <!-- FIN VALIDACION PARA INGRESO DE 11 DIGITOS -->

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">DESCRIPCION:</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" style="height: 94px;"></textarea>
                            
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
<!-- FIN Modal CREAR INTERLOCUTOR-->

<!-- MODAL REGISTRAR NUEVO DOCUMENTO COTIZACION-->
    <div class="modal fade" id="createCotizacionContrato" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">AGREGAR NUEVA DOCUMENTACION</h5>
                </div>

                <div class="modal-body">
                    <form class="needs-validation" action="{{route('cotizacion.store',$cuenta)}}" method="POST" enctype="multipart/form-data" novalidate>

                        @csrf

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">NOMBRE DEL DOCUMENTO:</label>
                            <input type="text" class="form-control" id="nombreCotCon" name="nombreCotCon" required>
                            <div class="invalid-feedback">
                                Es necesario colocar el NOMBRE DEL DOCUMENTO
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="">INGRESE DOCUEMNTO: PDF</label>
                            <input type="file" class="form-control" id="pdfDoc" name="pdfDoc" required>
                            <div class="invalid-feedback">
                                Es necesario cargar un DOCUMENTO
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">AÑO:</label>
                            <select class="form-control" aria-label="Default select example" id="anioCotCon" name="anioCotCon" required>
                                    
                                        <option value="" selected>SELECCIONE AÑO</option>
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

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">CATEGORIA:</label>
                            <select class="form-control" aria-label="Default select example" id="documentation_id" name="documentation_id" required>

                                <option value="" selected>Seleccionar estado</option>
                                @foreach($documentations as $documentation) 
                                <option value="{{$documentation->id}}">{{$documentation->nombreCatgDoc}}</option>
                                @endforeach

                            </select>

                            <div class="invalid-feedback">
                                Es necesario seleccionar una CATEGORIA
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


<!-- Modal CREAR COLABORADOR-->
    <div class="modal fade" id="createColaborador" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">AGREGAR COLABORADOR</h5>
                </div>

                <div class="modal-body">
                    <form class="needs-validation" action="{{route('colaborador.store',$cuenta)}}" method="POST" novalidate>

                        @csrf
                            
                            <div class="form-group">
                                <label for="recipient-name" >USUARIO:</label>
                                <select class="form-control" aria-label="Default select example" id="pirsons_id" name="pirsons_id" required>
                                        
                                    <option value="" selected>SELECCIONE USUARIO</option>

                                    @foreach ($pirsons as $pirson)

                                        <option value={{$pirson->id}}>{{$pirson->docIdentidad}}-{{$pirson->nombre}}-{{$pirson->apellidos}}</option>
                                            
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="recipient-name" >CARGO:</label>
                                <select class="form-control" aria-label="Default select example" id="cargos_id" name="cargos_id" required>
                                        
                                    <option value="" selected>SELECCIONE CARGO</option>

                                    @foreach ($cargos as $cargo)

                                        <option value={{$cargo->id}}>{{$cargo->cargo}}</option>
                                            
                                    @endforeach
                                </select>
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
<!-- FIN Modal CREAR COLABORADOR-->


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop