@extends('adminlte::page')

@section('title', 'Cuentas')

@section('content_header')

@php
    //SECTION TITULO PRINCIPAL
        $SECT_PRINC = "274c77";
        $SECT_PRINC_TEXT = "ffffff";

    //BOTON AGREGAR CUENTA
        $BUTTON_AGRE = "007200";
        $TEXT_BUTTON_AGRE = "ffffff";
@endphp

<section class="p-3 rounded" style="margin-bottom: 15px;margin-left: 20px;margin-right: 20px;background-color:#{{$SECT_PRINC}}; color: #{{$SECT_PRINC_TEXT}}">
    <h1>CUENTAS</h1>
</section>

@stop

@section('content')


<section class=" p-3 bg-white rounded" style="margin-bottom: 15px;margin-left: 20px;margin-right: 20px;">
        
    <!-- Button trigger modal -->
    <button type="button" class="btn" data-toggle="modal" data-target="#exampleModalCenter" 
    style="margin-bottom: 10px; background-color:#{{$BUTTON_AGRE}};color: #{{$TEXT_BUTTON_AGRE}}">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
        </svg>
    </button>
    <!-- FIN Button trigger modal -->
    <div class="table-responsive">
        <table class="table">
            <thead class="table table-striped table-dark">
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Ruc</th>
                    <th scope="col">Razon Social</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Fecha Creacion</th>
                    <th scope="col">Fecha Actualizacion</th>
                    <th scope="col" >Estado</th>
                    <td scope="col" colspan="2" align="center"><strong> Accion</strong></td>
                </tr>
            </thead>
            <tbody>
                @foreach($cuentas as $cuenta)
                    <tr>
                        <th >{{$cuenta ->id}}</th>
                        <td>{{$cuenta ->ruc}}</td>
                        <td>{{$cuenta ->razonSocial}}</td>

                        @foreach ($catcuentas as $catcuenta)
                        <?php if ($catcuenta->id == $cuenta ->catcuentas_id) { ?>
                            <td>{{$catcuenta ->CatgEmpresa}}</td>
                        <?php } ?>
                        @endforeach
                        
                        <td>{{$cuenta ->created_at}}</td>
                        <td>{{$cuenta ->updated_at}}</td>

                        <!-- CONDICIONAL PARA MOSTRAR ESTADO -->
                            <?php if ($cuenta ->estado=='0') { ?>
                                <td >Inactivo</td>
                            <?php } elseif ($cuenta ->estado=='1') { ?>
                                <td>Activo</td>
                            <?php } else { ?>
                                <td>Pendiente</td>
                            <?php }?>
                        <!-- FIN CONDICIONAL  -->

                        <!-- CONDICIONAL PARA MOSTRAR BOTON ESTADO 
                            <?php  // if ($cuenta ->estado=='0' || $cuenta ->estado== null) { ?>
                                <td>
                                    <a href="#"><button type="button" class="btn btn-success" class="btn btn-success">Activar</button></a>
                                </td>
                            <?php //} else { ?>
                                <td>
                                    <a href="#"><button type="button" class="btn btn-warning" class="btn btn-success">Desactivar</button></a>
                                </td>
                            <?php// }?>
                        FIN CONDICIONAL PARA MOSTRAR BOTON ESTADO -->

                        <td align="center">
                            <a href="{{route('cuentas.show', $cuenta ->id)}}">
                                <button type="button"  class="btn btn-info" >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                    </svg>
                                </button>
                            </a>
                        </td>
                        <td align="center">
                            <form   action="{{route('cuentas.destroy', $cuenta ->id)}}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit"  class="btn btn-danger " style="text-align: right" >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{$cuentas->links()}}

    




    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalCenterTitle" 
            aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">AGREGAR NUEVA CUENTA</h5>
            
            </div>
                <div class="modal-body">
                    <form class=" needs-validation" action="{{route('cuentas.store')}}" method="POST" novalidate>

                        @csrf

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">RUC:</label>
                            <input type="number" class="form-control" id="ruc" name="ruc" required>
                            
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
                            <input type="text" class="form-control" id="razonSocial" name="razonSocial" required>
                            <div class="invalid-feedback">
                                Es necesario colocar la RAZON SOCIAL
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="exampleFormControlSelect1">CATEGORIA:</label>
                            <select class="form-control" id="catcuentas_id" name="catcuentas_id" required >
                                <option value="" selected>Seleccionar estado</option>
                                @foreach($catcuentas as $catcuenta) 
                                <option value="{{$catcuenta->id}}">{{$catcuenta->CatgEmpresa}}</option>
                                @endforeach
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
    
    
</section>



@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop