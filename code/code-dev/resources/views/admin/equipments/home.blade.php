@extends('admin.master')
@section('title','Equipos')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/equipments/all') }}" class="nav-link"><i class="fas fa-industry"></i> Equipos</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">

        <div class="header">
                <h2 class="title"><i class="fas fa-database"></i> Equipos </h2>
                <ul>
                    <li>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle"
                                    data-toggle="dropdown">
                                    <i class="fas fa-filter"></i> Filtrar <span class="caret"></span>
                            </button>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{url('/admin/equipments/0')}}"><i class="fas fa-filter"></i> Inactivos</a></li>
                                <li><a href="{{url('/admin/equipments/1')}}"><i class="fas fa-filter"></i> Activos</a></li>
                                <li><a href="{{url('/admin/equipments/all')}}"><i class="fas fa-filter"></i> Todos</a></li>
                            </ul>
                        </div>
                    </li>
                    @if(kvfj(Auth::user()->permissions, 'equipment_add'))
                        <li>
                            <a href="{{ url('/admin/equipment/add') }}" ><i class="fas fa-plus-circle"></i> Agregar</a>
                        </li>
                    @endif
                </ul>
            </div>

            <div class="inside">
                <table id="table-modules" class="table table-bordered table-striped" style="background-color:#EDF4FB;">
                    <thead>
                        <tr>
                            <td>OPCIONES</td>
                            <td>CODIGO ANTERIOR / NUEVO</td>
                            <td>NOMBRE</td>
                            <td>MARCA / MODELO / SERIE</td>
                            <td>ESTADO</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($equipment as $eq)
                            <tr>
                                <td>
                                    <div class="opts">
                                        @if(kvfj(Auth::user()->permissions, 'equipment_edit'))
                                            <a href="{{ url('/admin/equipment/'.$eq->id.'/edit') }}"  title="Editar"><i class="fas fa-edit"></i></a>
                                        @endif

                                        <a href="{{ url('/admin/equipment/'.$eq->id.'/files') }}"  title="Visualización y Carga de Archivos"><i class="fas fa-file-upload"></i></a>
                                        <a href="{{ url('/admin/equipment/'.$eq->id.'/data_sheet') }}" target="_blank"  title="Ficha Tecnica"><i class="fas fa-file-invoice"></i></a> 
                                        <a href="{{ url('/admin/equipment/'.$eq->id.'/equipment_parts') }}"  title="Partes del Equipo"><i class="fas fa-cogs"></i></a>
                                        <a href="{{ url('/admin/equipment/'.$eq->id.'/connection_to_equipment') }}"  title="Conexión a otros Equipos"><i class="fas fa-project-diagram"></i></a>
                                        <a href="{{ url('/admin/equipment/'.$eq->id.'/transfer') }}"  title="Traslado de Ambiente"><i class="fas fa-people-carry"></i></a>
                                    </div>
                                </td>
                                <td>{{$eq->code_old.' / '.$eq->code_new}}</td>
                                <td>{{$eq->name}}</td>
                                <td>{{$eq->brand.' / '.$eq->model.' / '.$eq->serie }}</td>
                                <td> 
                                    @if($eq->status == '0')
                                        <a href="#" class="btn btn-sm btn-success " ><i class="fas fa-check-circle"></i> Funcionamiento Optimo</a>
                                    @elseif($eq->status == '1')
                                        <a href="#" class="btn btn-sm btn-warning"><i class="fas fa-tools"></i> En Reparacion</a>
                                    @elseif($eq->status == '2')
                                        <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-exclamation-triangle"></i> Dañado</a>
                                    @elseif($eq->status == '3')
                                        <a href="#" class="btn btn-sm btn-dark"><i class="fas fa-times-circle"></i> Dado de Baja</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection
