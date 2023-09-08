@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<section class="shadow p-3 bg-white rounded" style="margin-bottom: 15px;margin-left: 20px;margin-right: 20px;">
    <h1>HOMOLOGADOS</h1>
</section>
@stop

@section('content')


<section class="shadow p-3 bg-white rounded" style="margin-bottom: 15px;margin-left: 20px;margin-right: 20px;">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createOmologado" 
        style="margin-bottom: 10px;">
            NUEVO
    </button>

    

    <!-- Tabla listar ESPECIALIDAD -->
        <table class="table">
            <thead class="table table-striped table-dark">
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Proveedor</th>
                    <th scope="col">Especialidad</th>
                    <th scope="col">Alcance</th>
                    <th scope="col">created_at</th>
                    <th scope="col">updated_at	</th>
                    <td scope="col" colspan="2" align="center">Accion</td>
                </tr>
            </thead>
            <tbody>
                @foreach($omologados as $omologado)
                
                    <tr>
                        <th>{{$omologado->id}}</th>

                            @foreach ($proveedos as $proveedo)

                            <?php if ($omologado->proveedos_id == $proveedo->id) { ?>
                        <td>{{$proveedo->nombProv}}</td>
                            <?php } ?>
                                
                            @endforeach
                        
                            @foreach ($htcategorias as $htcategoria)

                                <?php if ($omologado->htcategorias_id == $htcategoria->id) { ?>
                                    <td>{{$htcategoria->especialidad}}</td>
                                <?php } ?>
                                
                            @endforeach

                            @foreach ($alcances as $alcance)

                            <?php if ($omologado->alcances_id == $alcance->id) { ?>
                        <td>{{$alcance->provincia}}</td>
                            <?php } ?>
                                
                            @endforeach

                    

                        <td>{{$omologado->created_at}}</td>
                        <td>{{$omologado->updated_at	}}</td>

                        <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editOmologado{{$omologado->id}}" 
                                style="margin-bottom: 10px;" >
                                    Editar
                            </button>
                        </td>
                            <!-- MODAL EDITAR ESPECIALIDAD -->
                                <div class="modal fade" id="editOmologado{{$omologado->id}}" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle"> EDITAR </h5>
                                            </div>
                                            <div class="modal-body">
                                                <form class="row needs-validation" action="{{route('omologados.update',$omologado)}}" method="POST" novalidate >

                                                    @csrf
                                                    @method('put')

                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">PROVEEDOR:</label>
                                                        <select class="form-control" aria-label="Default select example" id="proveedos_id" name="proveedos_id" required>

                                                            @foreach($proveedos as $proveedo) 
                                                                <?php if ($omologado->proveedos_id == $proveedo->id) { ?>
                                                                    <option value="{{$proveedo->id}}" selected>{{$proveedo->nombProv}}</option>
                                                                <?php }else { ?>
                                                                    <option value="{{$proveedo->id}}">{{$proveedo->nombProv}}</option>
                                                                <?php } ?>
                                                            @endforeach

                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Es necesario colocar el PROVEEDOR
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">ESPECIALIDAD:</label>
                                                        <select class="form-control" aria-label="Default select example" id="htcategorias_id" name="htcategorias_id" required>
                                                            @foreach($htcategorias as $htcategoria) 
                                                                <?php if ($omologado->htcategorias_id == $htcategoria->id) { ?>
                                                                    <option value="{{$htcategoria->id}}" selected>{{$htcategoria->especialidad}}</option>
                                                                <?php }else { ?>
                                                                    <option value="{{$htcategoria->id}}">{{$htcategoria->especialidad}}</option>
                                                                <?php } ?>
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Es necesario colocar la ESPECIALIDAD
                                                        </div>
                                                    </div>
                            
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">ALCANCE:</label>
                                                        <select class="form-control" aria-label="Default select example" id="alcances_id" name="alcances_id" required>

                                                            @foreach($alcances as $alcance) 
                                                                <?php if ($omologado->alcances_id == $alcance->id) { ?>
                                                                    <option value="{{$alcance->id}}" selected>{{$alcance->provincia}}</option>
                                                                <?php }else { ?>
                                                                    <option value="{{$alcance->id}}">{{$alcance->provincia}}</option>
                                                                <?php } ?>
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Es necesario colocar el ALCANCE
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
                        
                                    

                        
                        <td align="center">
                            <form   action="{{route('omologados.destroy', $omologado)}}" method="POST">
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

    {{$omologados->links()}}


</section>



<!-- 
**********************
        MODALS
**********************
-->

<!-- MODAL CREAR ESPECIALIDAD -->
    <div class="modal fade" id="createOmologado" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"> NUEVO </h5>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" action="{{route('omologados.store')}}" method="POST" novalidate>

                        @csrf
                        
                        <div class="form-group">
                            <label for="recipient-name" >PROVEEDOR:</label>
                            <select class="form-control" aria-label="Default select example" id="proveedos_id" name="proveedos_id" required>
                                    
                                <option value="" selected>SELECCIONE PROVEEDOR</option>

                                @foreach ($proveedos as $proveedo)

                                    <option value={{$proveedo->id}}>{{$proveedo->nombProv}}</option>
                                        
                                @endforeach
                            </select>

                            <div class="invalid-feedback">
                                Es necesario colocar el PROVEEDOR
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name">ESPECIALIDAD:</label>
                            
                            <select class="form-control" aria-label="Default select example" id="htcategorias_id" name="htcategorias_id" required>
                                    
                                <option value="" selected>SELECCIONE ALCANCES</option>

                                @foreach ($htcategorias as $htcategoria)

                                    <option value={{$htcategoria->id}}>{{$htcategoria->especialidad}}</option>
                                        
                                @endforeach
                            </select>

                            <div class="invalid-feedback">-
                                Es necesario colocar la ESPECIALIDAD
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">ALCANCE:</label>
                            
                            <select class="form-control" aria-label="Default select example" id="alcances_id" name="alcances_id" required>
                                    
                                <option value="" selected>SELECCIONE ALCANCES</option>

                                @foreach ($alcances as $alcance)

                                    <option value={{$alcance->id}}>{{$alcance->provincia}}</option>
                                        
                                @endforeach
                            </select>

                            <div class="invalid-feedback">
                                Es necesario colocar el ALCANCE
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