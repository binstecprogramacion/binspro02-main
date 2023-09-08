@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<section class="shadow p-3 bg-white rounded" style="margin-bottom: 15px;margin-left: 20px;margin-right: 20px;">
    <h1>ESPECIALIDAD HT</h1>
</section>
@stop

@section('content')


<section class="shadow p-3 bg-white rounded" style="margin-bottom: 15px;margin-left: 20px;margin-right: 20px;">

    
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createCategoriaHT" 
        style="margin-bottom: 10px;">
            NUEVO
    </button>

    <table class="table">
        <thead class="table table-striped table-dark">
            <tr>
                <th scope="col">id</th>
                <th scope="col">Especialidad</th>
                <th scope="col">Categoria</th>
                <th scope="col">Descripcion</th>
                <th scope="col">created_at</th>
                <th scope="col">updated_at	</th>
                <td scope="col" colspan="2" align="center">Accion</td>
            </tr>
        </thead>
        <tbody>
            @foreach($htcategorias as $htcategoria)
            
                <tr>
                    <th >{{$htcategoria->id}}</th>
                    <td>{{$htcategoria->especialidad}}</td>
                    <td>{{$htcategoria->categoria}}</td>
                    <td>{{$htcategoria->descCatHT}}</td>
                    <td>{{$htcategoria->created_at}}</td>
                    <td>{{$htcategoria->updated_at}}</td>

                    <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateCategoriaHT{{$htcategoria->id}}" 
                            style="margin-bottom: 10px;" >
                                Editar
                        </button>

                    <!-- Modal de CREACION DE CATEGORIA HT -->
                        <div class="modal fade" id="updateCategoriaHT{{$htcategoria->id}}" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">AGREGAR NUEVA CATEGORIA</h5>
                                    </div>

                                    <div class="modal-body">
                                        <form class="needs-validation" action="{{route('htcategorias.update',$htcategoria)}}" method="POST" novalidate>

                                            @csrf
                                            @method('put')

                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">ESPECIALIDAD:</label>
                                                <input type="text" class="form-control" id="especialidad" name="especialidad" value="{{$htcategoria->especialidad}}" required>
                                                <div class="invalid-feedback">
                                                    Es necesario colocar la ESPECIALIDAD
                                                </div>
                                            </div>

                                            

                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">CATEGORIA:</label>

                                                <?php if ($htcategoria->categoria == null ) { ?>
                                                    <select class="form-control" aria-label="Default select example" id="categoria" name="categoria" required>
    
                                                        <option value="Seleccionar categoria" selected>Seleccionar categoria</option>
                                                        <option value="Convencional">Convencional</option>
                                                        <option value="No Convencional">No Convencional</option>
                                                    </select>
                                                <?php } ?>

                                                <?php if ($htcategoria->categoria == "Convencional" ) { ?>
                                                    <select class="form-control" aria-label="Default select example" id="categoria" name="categoria" required>
    
                                                        <option value="Convencional" selected>Convencional</option>
                                                        <option value="No Convencional">No Convencional</option>
                                                    </select>
                                                <?php } ?>

                                                <?php if ($htcategoria->categoria == "No Convencional" ) { ?>
                                                    <select class="form-control" aria-label="Default select example" id="categoria" name="categoria" required>
    
                                                        <option value="Convencional">Convencional</option>
                                                        <option value="No Convencional" selected>No Convencional</option>
                                                    </select>
                                                <?php } ?>

                                                <div class="invalid-feedback">
                                                    Es necesario colocar la CATEGORIA
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">DESCRIPCION:</label>
                                                <textarea class="form-control" id="descCatHT" name="descCatHT" style="height: 94px;" required>{{$htcategoria->descCatHT}}</textarea>
                                                <div class="invalid-feedback">
                                                    Es necesario colocar una DESCRIPCION
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
                    <!-- FIN Modal de CREACION DE CATEGORIA HT -->

                    </td>

                    

                    <td align="center">
                        <form   action="{{route('htcategorias.destroy',$htcategoria)}}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit"  class="btn btn-danger" >Eliminar</button></a>
                        </form>
                    </td>
                </tr>
            @endforeach

    </table>

    {{$htcategorias->links()}}
</section>




<!-- Modal de CREACION DE CATEGORIA HT -->
    <div class="modal fade" id="createCategoriaHT" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">AGREGAR NUEVA CATEGORIA</h5>
                </div>

                <div class="modal-body">
                    <form class="needs-validation" action="{{route('htcategorias.store')}}" method="POST" novalidate>

                        @csrf

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">ESPECIALIDAD:</label>
                            <input type="text" class="form-control" id="especialidad" name="especialidad" required>
                            <div class="invalid-feedback">
                                Es necesario colocar la ESPECIALIDAD
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">CATEGORIA:</label>
            
                            <select class="form-control" aria-label="Default select example" id="categoria" name="categoria" required>
    
                                <option value="Seleccionar categoria" selected>Seleccionar categoria</option>
                                <option value="Convencional">Convencional</option>
                                <option value="No Convencional">No Convencional</option>
                            </select>
                            <div class="invalid-feedback">
                                Es necesario colocar la CATEGORIA
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">DESCRIPCION:</label>
                            <textarea class="form-control" id="descCatHT" name="descCatHT" style="height: 94px;" required></textarea>
                            <div class="invalid-feedback">
                                Es necesario colocar una DESCRIPCION
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
<!-- FIN Modal de CREACION DE CATEGORIA HT -->


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop