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
                            <td><strong> OPCIONES </strong></td>
                            <td><strong> CODIGO </strong></td>
                            <td><strong> NOMBRE </strong></td>
                            <td><strong> MARCA / MODELO / SERIE </strong></td>
                            <td><strong> ESTADO </strong></td>
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

                                        @if(kvfj(Auth::user()->permissions, 'equipment_file'))
                                            <a href="{{ url('/admin/equipment/'.$eq->id.'/files') }}"  title="Carga y Visualización de Archivos"><i class="fas fa-upload"></i></a>
                                        @endif

                                        @if(kvfj(Auth::user()->permissions, 'equipment_data_sheet'))
                                            <a href="{{ url('/admin/equipment/'.$eq->id.'/data_sheet') }}" target="_blank"  title="Ficha Tecnica"><i class="fas fa-file-invoice"></i></a>
                                        @endif

                                        @if(kvfj(Auth::user()->permissions, 'equipment_parts'))
                                            <a href="{{ url('/admin/equipment/'.$eq->id.'/equipment_parts') }}"  title="Partes del Equipo"><i class="fas fa-cogs"></i></a>
                                        @endif

                                        @if(kvfj(Auth::user()->permissions, 'equipment_conecctions'))
                                            <a href="{{ url('/admin/equipment/'.$eq->id.'/connection_to_equipment') }}"  title="Conexión a otros Equipos"><i class="fas fa-project-diagram"></i></a>
                                        @endif

                                        @if(kvfj(Auth::user()->permissions, 'equipment_transfer'))
                                            <a href="{{ url('/admin/equipment/'.$eq->id.'/transfer') }}"  title="Traslado de Ambiente"><i class="fas fa-people-carry"></i></a>
                                        @endif

                                        @if(kvfj(Auth::user()->permissions, 'equipment_change_status'))
                                            <a href="#" data-action="change_status" data-path="admin/equipment" data-object="{{ $eq->id }}" class="btn-deleted" data-toogle="tooltrip" data-placement="top" title="Cambio de Estado"><i class="fas fa-toggle-on"></i></a>
                                        @endif
                                    </div>
                                </td>
                                <td>{{$eq->code_new}}</td>
                                <td>{{$eq->name}}</td>
                                <td>{{$eq->brand.' / '.$eq->model.' / '.$eq->serie }}</td>
                                <td>
                                    <p @if($eq->status == "0") style="background-color:#668C4A; color: white; text-align: center; border-radius: 2px; " @elseif($eq->status == "1") style="background-color:#FFF447; color: black; text-align: center; border-radius: 2px; " @elseif($eq->status == "2") style="background-color:#D94C1A; color: white; text-align: center; border-radius: 2px; " @else style="background-color:#3D3D3D; color: white; text-align: center; border-radius: 2px;" @endif > {{ getStatusEquipment(null, $eq->status) }} </p>

                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection
