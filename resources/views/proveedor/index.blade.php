@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<section class="shadow p-3 bg-white rounded" style="margin-bottom: 15px;margin-left: 20px;margin-right: 20px;">
    <h1>PROVEEDORES</h1>
</section>
@stop

@section('content')

<section class="shadow p-3 bg-white rounded" style="margin-bottom: 15px;margin-left: 20px;margin-right: 20px;">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createProveedor" 
        style="margin-bottom: 10px;">
            NUEVO
    </button>

    

    <!-- Tabla listar ESPECIALIDAD -->
        <table class="table">
            <thead class="table table-striped table-dark">
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Ruc</th>
                    <th scope="col">Razon social</th>
                    <th scope="col">Nombre Contacto</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Correo</th>
                    <th scope="col">created_at</th>
                    <th scope="col">updated_at	</th>
                    <td scope="col" colspan="2" align="center">Accion</td>
                </tr>
            </thead>
            <tbody>
                @foreach($proveedos as $proveedo)
                
                    <tr>
                        <th >{{$proveedo->id}}</th>
                        <td>{{$proveedo->rucProv}}</td>
                        <td>{{$proveedo->razSocProv}}</td>
                        <td>{{$proveedo->nombProv}}</td>
                        <td>{{$proveedo->celularProv}}</td>
                        <td>{{$proveedo->correoProv}}</td>
                        <td>{{$proveedo->created_at}}</td>
                        <td>{{$proveedo->updated_at	}}</td>

                        <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editProveedor{{$proveedo->id}}" 
                                style="margin-bottom: 10px;" >
                                    Editar
                            </button>
                        </td>
                            <!-- MODAL EDITAR ESPECIALIDAD -->
                                <div class="modal fade" id="editProveedor{{$proveedo->id}}" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle"> EDITAR </h5>
                                            </div>
                                            <div class="modal-body">
                                                <form class="row needs-validation" action="{{route('proveedos.update',$proveedo)}}" method="POST" novalidate >

                                                    @csrf
                                                    @method('put')

                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">RUC:</label>
                                                        <input type="text" class="form-control" id="rucProv" name="rucProv" value="{{$proveedo->rucProv}}" required>
                                                        
                                                        <div class="invalid-feedback">
                                                            Es necesario colocar el RUC
                                                        </div>
                                                    </div>
                            
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">RAZON SOCIAL:</label>
                                                        <input type="text" class="form-control" id="razSocProv" name="razSocProv" value="{{$proveedo->razSocProv}}" required>
                                                        
                                                        <div class="invalid-feedback">
                                                            Es necesario colocar la RAZON SOCIAL
                                                        </div>
                                                    </div>
                            
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">NOMBRE DE CONTACTO:</label>
                                                        <input type="text" class="form-control" id="nombProv" name="nombProv" value="{{$proveedo->nombProv}}" required>
                                                        
                                                        <div class="invalid-feedback">
                                                            Es necesario colocar el NOMBRE DE CONTACTO
                                                        </div>
                                                    </div>
                            
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">CELULAR:</label>
                                                        <input type="number" class="form-control" id="celularProv" name="celularProv" value="{{$proveedo->celularProv}}" required>
                                                        
                                                        <div class="invalid-feedback">
                                                            Es necesario colocar el CELULAR
                                                        </div>

                                                        <!-- VALIDACION PARA INGRESO DE 11 DIGITOS -->
                                                            <script language="JavaScript">
                                                                var input=  document.getElementById('celularProv');
                                                                input.addEventListener('input',function(){
                                                                if (this.value.length > 9) 
                                                                    this.value = this.value.slice(0,9); 
                                                                })
                                                            </script>
                                                        <!-- FIN VALIDACION PARA INGRESO DE 11 DIGITOS -->
                                                        
                                                    </div>
                            
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">CORREO:</label>
                                                        <input type="email" class="form-control" id="correoProv" name="correoProv" value="{{$proveedo->correoProv}}" required>
                                                        
                                                        <div class="invalid-feedback">
                                                            Es necesario colocar el un CORREO
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
                            <!-- FIN MODAL EDITAR ESPECIALIDAD -->
                        
                                    

                        
                        <td align="center">
                            <form   action="{{route('proveedos.destroy', $proveedo)}}" method="POST">
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

    {{$proveedos->links()}}


</section>



<!-- 
**********************
        MODALS
**********************
-->

<!-- MODAL CREAR ESPECIALIDAD -->
    <div class="modal fade" id="createProveedor" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"> NUEVO </h5>
                </div>
                <div class="modal-body">
                    <form class=" " action="{{route('proveedos.store')}}" method="POST"  novalidate>

                        @csrf
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">RUC:</label>
                            <input type="text" class="form-control @error('rucProv') is-invalid @enderror" id="rucProv" name="rucProv" value="{{old('rucProv')}}" >
                        
                        @error('rucProv')
                            <span class="invalid-feedback">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">RAZON SOCIAL:</label>
                            <input type="text" class="form-control" id="razSocProv" name="razSocProv" >
                            
                            
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">NOMBRE DE CONTACTO:</label>
                            <input type="text" class="form-control" id="nombProv" name="nombProv" >
                            
                            
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">CELULAR:</label>
                            <input type="number" class="form-control" id="celularProv" name="celularProv" >
                            
                            
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">CORREO:</label>
                            <input type="email" class="form-control" id="correoProv" name="correoProv" >
                            
                            
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