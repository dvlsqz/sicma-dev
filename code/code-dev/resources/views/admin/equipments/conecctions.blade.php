@extends('admin.master')
@section('title','Conexión a otros Equipos')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/equipments/all') }}" class="nav-link"><i class="fas fa-columns"></i> Equipos</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/equipments/add') }}" class="nav-link"><i class="fas fa-network-wired"></i> Conexión a otros Equipos</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-plus-circle"></i> Agregar Conexión a Equipos con <b> {{ $equipment->name }} </b> </h2>
                    </div>
                    <div class="inside">
                        {!! Form::open(['url'=>'/admin/equipment/'.$equipment->id.'/connection_to_equipment','files' => true,'enctype'=>'multipart/form-data']) !!}
                            <div class="row">

                                <div class="col-md-12 ">
                                    <label for="name"><strong>Nombre del Equipo:</strong></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                        <select name="idequipmentconecction" id="idequipmentconecction" class="form-control ">
                                            @foreach ($equipments as $e)
                                                <option value="{{$e->id}}">{{$e->code_new.' - '.$e->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12 mtop16">
                                    <label for="name"><strong>Observaciones:</strong></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                        {!! Form::textarea('observation', null, ['class'=>'form-control','rows'=>'1']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row mtop16">
                                <div class="input-group">
                                    {!! Form::submit('Guardar', ['class'=>'btn btn-primary']) !!}&nbsp;
                                    <a href="{{ url()->previous() }}" class="btn btn-danger">Cancelar</a>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>

            </div>

            <div class="col-md-8">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-cogs"></i> Listado de Equipos con los que se Conecta</h2>
                    </div>
                    <div class="inside">
                        <table id="table-modules" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <td><strong>OPCIONES</strong></td>
                                    <td><strong>NOMBRE EQUIPO</strong></td>
                                    <td><strong>OBSERVACIONES</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($conecctions as $c)
                                    <tr>
                                        <td>
                                        @if(kvfj(Auth::user()->permissions, 'equipment_conecctions_delete'))
                                            <a href="{{ url('/admin/equipment/connection_to_equipment/'.$c->id.'/delete') }}" data-toogle="tooltrip" data-placement="top" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                        @endif
                                        </td>
                                        <td>{{ $c->equipment->name }}</td>
                                        <td>{{ $c->observation }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
