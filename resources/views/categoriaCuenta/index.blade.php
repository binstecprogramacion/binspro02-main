@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<section class="shadow p-3 bg-white rounded" style="margin-bottom: 15px;margin-left: 20px;margin-right: 20px;">
    <h1><strong>CATEGORIA CUENTAS</strong> </h1>
</section>
@stop

@section('content')



<section class="shadow p-3 bg-white rounded" style="margin-bottom: 15px;margin-left: 20px;margin-right: 20px;">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createCategoriaDocumentacion" 
        style="margin-bottom: 10px;">
            NUEVO
    </button>

    <!-- Tabla listar CATEGORIA CUENTAS -->
    <table class="table">
        <thead class="table table-striped table-dark">
            <tr>
                <th scope="col">id</th>
                <th scope="col">Categoria</th>
                <th scope="col">created_at</th>
                <th scope="col">updated_at	</th>
                <td scope="col" colspan="2" align="center">Accion</td>
            </tr>
        </thead>
        <tbody>
            @foreach($catcuentas as $catcuenta)
            
                <tr>
                    <th >{{$catcuenta->id}}</th>
                    <td>{{$catcuenta->CatgEmpresa}}</td>
                    <td>{{$catcuenta->created_at}}</td>
                    <td>{{$catcuenta->updated_at}}</td>

                    <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editCatCuenta{{$catcuenta->CatgEmpresa}}" 
                            style="margin-bottom: 10px;" >
                                Editar
                        </button>
                    </td>

                    <!-- MODAL EDITAR ESPECIALIDAD -->
                        <div class="modal fade" id="editCatCuenta{{$catcuenta->CatgEmpresa}}" tabindex="-1" role="dialog" data-bs-backdrop="static" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle"> EDITAR </h5>
                                    </div>
                                    <div class="modal-body">
                                        <form class="row needs-validation" action="{{route('catcuentas.update',$catcuenta)}}" method="POST" novalidate >

                                            @csrf
                                            @method('put')

                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">CATEGORIA:</label>
                                                <input type="text" class="form-control" id="CatgEmpresa" name="CatgEmpresa" value="{{$catcuenta->CatgEmpresa}}" required>
                                                
                                                <div class="invalid-feedback">
                                                    Es necesario colocar la CATEGORIA
                                                </div>
                                            </div>
                        
                        
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-primary">Actualizar</button>
                                            </div>

                                            
                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- FIN MODAL EDITAR ESPECIALIDAD -->

                    <td align="center">
                        <form   action="{{route('catcuentas.destroy',$catcuenta)}}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit"  class="btn btn-danger" >Eliminar</button></a>
                        </form>
                    </td>
                </tr>

                

            @endforeach
        </tbody>
    </table>
    {{$catcuentas->links()}}
</section>



<!-- 
**********************
        MODALS
**********************
-->

<!-- MODAL CREAR PROVEEDOR -->
<div class="modal fade" id="createCategoriaDocumentacion" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><strong>NUEVO</strong>  </h5>
            </div>
            <div class="modal-body">
                <form class=" needs-validation" action="{{route('catcuentas.store')}}" method="POST" novalidate>
                    @csrf

                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">CATEGORIA:</label>
                        <input type="text" class="form-control" id="CatgEmpresa" name="CatgEmpresa" required>
                        
                        <div class="invalid-feedback">
                            Es necesario colocar la CATEGORIA
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