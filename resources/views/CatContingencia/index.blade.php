@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    @php
        //SECTION TITULO PRINCIPAL
            $SECT_PRINC = "274c77";
            $SECT_PRINC_TEXT = "ffffff";

        //BOTON AGREGAR CUENTA
            $BUTTON_AGRE = "007200";
            $TEXT_BUTTON_AGRE = "ffffff";

        //SECTION SECUNDARIOS
            $colortext = "274C77";
            $fondo_section = "A9D6E5";

        //BOTON CREAR
            $boton_crear = "01497C";
            $text_boton_crear = "ffffff";

    @endphp

    <section class="p-3 rounded" style="margin-bottom: 15px;margin-left: 20px;margin-right: 20px;background-color:#{{$SECT_PRINC}}; color: #{{$SECT_PRINC_TEXT}}">
        <h1>CATEGORIA CONTINGENCIA</h1>
    </section>

@stop

@section('content')


<section class=" p-3 bg-white rounded" style="margin-bottom: 15px;margin-left: 20px;margin-right: 20px;">

    
    <div class="row">
        <div class="col-md-4">

            <section class="shadow p-3 rounded" style="margin-bottom: 15px;margin-left: 20px;margin-right: 20px;">

                <h4 style="color: #{{$colortext}};"><strong>Nueva Categoria</strong></h4>
                <br>

                <form class=" needs-validation" action="{{route('catContinge.store')}}" method="POST" novalidate>

                    @csrf

                    <div class="form-group" style="color: #{{$colortext}};">
                        <label for="recipient-name" class="col-form-label">CATEGORIA:</label>
                        <input type="text" class="form-control" id="categoriaContin" name="categoriaContin" required>
                    </div>

                    <div class="form-group" style="color: #{{$colortext}};">
                        <label for="recipient-name" class="col-form-label">DESCRIPCION:</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="5"></textarea>
                    </div>



                    <div class="modal-footer">
                        <button type="submit" class="btn" style="background-color: #{{$boton_crear}}; color: #{{$text_boton_crear}};">Agregar</button>
                    </div>
                    
                </form>

            </section>

        </div>

        <div class="col-md-8" >

            <section class="shadow p-3 bg-white rounded" style="margin-bottom: 15px;margin-left: 20px;margin-right: 20px; ">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="table table-striped table-dark">
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Cargo</th>
                                <th scope="col">Descripcion</th>
                                <td scope="col" colspan="2" align="center"><strong> Accion</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($catcontingencias as $catcontingencia)
                                <tr>
                                    <td>{{$catcontingencia ->id}}</td>
                                    <td>{{$catcontingencia ->categoriaContin}}</td>
                                    <td>{{$catcontingencia ->descripcion}}</td>
                                    


                                    <td align="center">
                                            <button type="button"  class="btn btn-warning" data-toggle="modal" data-target="#editCateg{{$catcontingencia ->id}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                </svg>
                                            </button>
                                    </td>

                                    <!-- MODAL EDITAR ESPECIALIDAD -->
                                        <div class="modal fade" id="editCateg{{$catcontingencia ->id}}" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle" style="color: #{{$colortext}};"><strong>EDITAR</strong></h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="row needs-validation" action="{{route('catContinge.update',$catcontingencia)}}" method="POST" novalidate >

                                                            @csrf
                                                            @method('put')

                                                            <div class="form-group" style="color: #{{$colortext}};">
                                                                <label for="recipient-name" class="col-form-label">CARGO:</label>
                                                                <input type="text" class="form-control" id="categoriaContin" name="categoriaContin" value="{{$catcontingencia->categoriaContin}}" required>
                                                            </div>
                                        
                                                            <div class="form-group" style="color: #{{$colortext}};">
                                                                <label for="recipient-name" class="col-form-label">DESCRIPCION:</label>
                                                                <textarea class="form-control" id="descripcion" name="descripcion" rows="5">{{$catcontingencia->descripcion}}</textarea>
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
                                    <!-- FIN MODAL EDITAR ESPECIALIDAD -->

                                    <td align="center">
                                        <form   action="{{route('catContinge.destroy',$catcontingencia)}}" method="POST">
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

                {{$catcontingencias->links()}}

            </section>  

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