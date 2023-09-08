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
    <h1>REQUERIMIENTOS</h1>
</section>


@stop

@section('content')

<section class="shadow p-3 rounded" style="margin-bottom: 15px;margin-left: 20px;margin-right: 20px;">

            
                <div class="table-responsive">
                    <table class="table">
                        <thead class="table table-striped table-dark">
                            <tr>
                                <th scope="col">Ticket</th>
                                <th scope="col">Cuenta</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Fecha Creacion</th>
                                <th scope="col">Ultima Actualizacion</th>
                                <td scope="col" colspan="2" align="center">Accion</td>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($requerimientos as $requerimiento)
                                <tr>
                                    <th >REQ000{{$requerimiento ->id}}</th>

                                    @foreach ($cuentas as $cuenta)
                                        <?php if ($requerimiento ->cuentas_id == $cuenta->id) { ?>
                                            <td >{{$cuenta ->razonSocial}}</td>
                                        <?php break; } ?>
                                    @endforeach

                                    <td >{{$requerimiento ->estado}}</td>
                                    <td >{{$requerimiento ->created_at}}</td>
                                    <td >{{$requerimiento ->updated_at}}</td>

                                    <td align="center">
                                        <a href="{{route('requerimiento.ejecucionReq', $requerimiento)}}" target="_blank">
                                            <button type="button"  class="btn btn-info" >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                                </svg>
                                            </button></a>
                                    </td>

                                    <td align="center">
                                        <form   action="{{route('requerimiento.destroy', $requerimiento)}}" method="POST">
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
                {{$requerimientos->links()}}


</section>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop