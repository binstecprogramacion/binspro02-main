@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

<section class="shadow p-3 bg-white rounded" style="margin-bottom: 15px;margin-left: 20px;margin-right: 20px;">
    <h1>ESPECIALIDADES</h1>
</section>

@stop

@section('content')

<section class="shadow p-3 bg-white rounded" style="margin-bottom: 15px;margin-left: 20px;margin-right: 20px;">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createEspecialidad" 
        style="margin-bottom: 10px;">
            NUEVO
    </button>

    

    <!-- Tabla listar ESPECIALIDAD -->
        <table class="table">
            <thead class="table table-striped table-dark">
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Especialidad</th>
                    <th scope="col">created_at</th>
                    <th scope="col">updated_at	</th>
                    <td scope="col" colspan="2" align="center">Accion</td>
                </tr>
            </thead>
            <tbody>
                @foreach($especialidas as $especialida)
                
                    <tr>
                        <th >{{$especialida->id}}</th>
                        <td>{{$especialida->nombreEspecialidad}}</td>
                        <td>{{$especialida->created_at}}</td>
                        <td>{{$especialida->updated_at	}}</td>

                        <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editEspecialidad{{$especialida->id}}" 
                                style="margin-bottom: 10px;" >
                                    Editar
                            </button>

                            <!-- MODAL EDITAR ESPECIALIDAD -->
                                <div class="modal fade" id="editEspecialidad{{$especialida->id}}" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle"> EDITAR </h5>
                                            </div>
                                            <div class="modal-body">
                                                <form class="needs-validation" action="{{route('especialidas.update',$especialida)}}" method="POST" novalidate >

                                                    @csrf
                                                    @method('put')

                                                    <div class="form-group" align="left">
                                                        <label for="recipient-name" class="col-form-label">ESPECIALIDAD:</label>
                                                        <input type="text" class="form-control" id="nombreEspecialidad" name="nombreEspecialidad" value="{{$especialida->nombreEspecialidad}}" required>
                                                        
                                                        <div class="invalid-feedback">
                                                            Es necesario colocar el nombre de la ESPECIALIDAD
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
                            <!-- FIN MODAL EDITAR ESPECIALIDAD -->
                        </td>
                                    

                        
                        <td align="center">
                            <form   action="{{route('especialidas.destroy', $especialida)}}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit"  class="btn btn-danger" >Eliminar</button></a>
                            </form>
                        </td>
                    </tr>

                    

                @endforeach
            </tbody>
        </table>
    <!-- FIN Tabla listar ALCANCE GEOGRAFICO -->

    {{$especialidas->links()}}


</section>



<!-- 
**********************
        MODALS
**********************
-->

<!-- MODAL CREAR ESPECIALIDAD -->
    <div class="modal fade" id="createEspecialidad" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"> NUEVO </h5>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" action="{{route('especialidas.store')}}" method="POST" novalidate>

                        @csrf
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">ESPECIALIDAD:</label>
                            <input type="text" class="form-control" id="nombreEspecialidad" name="nombreEspecialidad" required>
                            
                            <div class="invalid-feedback">
                                Es necesario colocar el nombre de la ESPECIALIDAD
                            </div>
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
<!-- FIN MODAL CREAR ESPECIALIDAD -->

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop