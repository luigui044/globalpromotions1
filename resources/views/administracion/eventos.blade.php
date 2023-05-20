@extends('administracion.layouts.master')
@section('styles')
    <!-- MDBootstrap Datatables  -->
<link href="{{ asset('css/addons/datatables2.min.css') }}" rel="stylesheet">
@endsection
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            @if(session('status'))
            <div class="col-md-12" id="temp">
                <div class="alert alert-success" role="alert">
                 {{ session('status') }}
                  </div>
            </div>
            @endif
            <div class="col-md-12">
                <!-- Table with panel -->
                <div class="card card-cascade narrower">

                    <!--Card image-->
                    <div
                    class=" view view-cascade gradient-card-header blue-gradient narrower py-3 mx-4 mb-3 d-flex justify-content-center align-items-center">
                    <div class="row ">
                        <div class="col-md-12 text-center">
                            <h2 class="card-header-title">
                                Eventos registrados
                            </h2>
                         
                        </div>
                    </div>
                
                   
                
               
                    </div>
                    <!--/Card image-->
                
                    <div class="px-4">
                
                    <div class="table-wrapper" id="localAsignada">
                        <!--Table-->
                        <table class="table table-hover mb-0" id="dtBasicExample">
                
                            <!--Table head-->
                            <thead>
                                <tr>
                            
                                <th class="th-lg">
                                    <a>Evento
                                    <i class="fas fa-sort ml-1"></i>
                                    </a>
                                </th>
                                <th class="th-lg">
                                    <a href="">Estado
                                    <i class="fas fa-sort ml-1"></i>
                                    </a>
                                </th>
                                <th class="th-lg">
                                    <a href="">Fecha
                                    <i class="fas fa-sort ml-1"></i>
                                    </a>
                                </th>
                                <th class="th-lg">
                                    <a href="">Acciones
                                    <i class="fas fa-sort ml-1"></i>
                                    </a>
                                </th>
                                
                                
                                </tr>
                            </thead>
                            <!--Table head-->
                
                            <!--Table body-->
                            <tbody>
                                @foreach ($listaEventos as $item)
                                    <tr>
                                        <td>{{ $item->titulo_evento }}</td>
                                        <td id='estado{{$item->id_evento}}'>
                                            @switch($item->estado_evento)
                                                @case(1)
                                                <span class="badge badge-warning">Activo sin localidad</span>
                                                    @break
                                                @case(2)
                                                <span class="badge badge-success">Activo</span>
                                                    @break
                                                @case(3)
                                                    <span class="badge badge-danger">Inactivo</span>
                                                    @break
                                                @default
                                                    
                                            @endswitch
                                        </td>
                                        <td>{{  date('d/m/Y', strtotime($item->fechas)) }}</td>
                                        <td>
                                         
                                            <a class="btn-floating btn-sm btn-info" id="asig{{ $item->id_evento }}" href=" {{ route('setLocalidad',['id'=> $item->id_evento]) }}" data-toggle="tooltip" data-placement="top"  title="Asignar localidades"><i class="fas fa-chair"></i></a>                                         
                                            <a class="btn-floating btn-sm btn-default" onclick="detaEvento({{ $item->id_evento }})" data-toggle="tooltip" data-placement="top"  title="Detalle de evento"><i class="fas fa-eye"></i></a>
                                            <a class="btn-floating btn-sm btn-success" href="{{ route('editEvento',['id'=>$item->id_evento]) }}" data-toggle="tooltip" data-placement="top"  title="Editar evento"><i class="fas fa-edit"></i></a>
                                            @if ($item->estado_evento < 3)
                                            <a class="btn-floating btn-sm btn-danger" id="desa{{ $item->id_evento }}"  onclick="desactivarEvento({{ $item->id_evento }})" data-toggle="tooltip" data-placement="top"  title="Desactivar evento"><i class="fas fa-times-circle"></i></a>
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                                
                            
                            </tbody>
                            <!--Table body-->
                        </table>
                        <!--Table-->
                    </div>
                
                    </div>
                
                </div>
                <!-- Table with panel -->
            </div>
        </div>
    </div>
@endsection
@section('modal')
    <!-- Central Modal Small -->
    <div class="modal fade" id="centralModalSm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">

    <!-- Change class .modal-sm to change the size of the modal -->
    <div class="modal-dialog modal-lg" role="document">


    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title w-100" id="myModalLabel">Detalle de evento</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        ...
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
       
        </div>
    </div>
    </div>
    </div>
    <!-- Central Modal Small -->
@endsection

@section('scripts')

<script src="{{ asset('js/addons/datatables2.min.js') }}"></script>
<script src="{{ asset('js/eventos.js') }}"></script>

@endsection