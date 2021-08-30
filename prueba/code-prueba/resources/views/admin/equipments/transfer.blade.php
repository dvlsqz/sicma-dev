@extends('admin.master')
@section('title','Partes del Equipo')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/equipments/all') }}" class="nav-link"><i class="fas fa-columns"></i> Equipos</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/equipments/add') }}" class="nav-link"><i class="fas fa-plus-circle"></i> Agregar</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-plus-circle"></i> Agregar un nuevo movimiento del equipo: <b> {{ $equipment->name }} </b> </h2>
                    </div>
                    <div class="inside">
                        {!! Form::open(['url'=>'/admin/equipment/'.$equipment->id.'/transfer','files' => true,'enctype'=>'multipart/form-data']) !!}
                            <div class="row">  

                                <div class="col-md-12 ">
                                    <label for="name" class="mtop16"><strong>Fecha de Movimiento ó Traslado:</strong></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                        {!! Form::date('date', null, ['class'=>'form-control']) !!}
                                    </div>
                                </div>

                                <div class="col-md-12 mtop16">
                                    <label for="category"><strong>Servicio General:</strong></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                        {!! Form::select('servicegeneral', $servicegeneral,0,['class'=>'form-select', 'id' => 'servicegeneral']) !!}
                                        {!! Form::hidden('servicegeneral_actual', 0, ['id' => 'servicegeneral_actual']) !!}
                                    </div>
                                </div>

                                <div class="col-md-12 mtop16">
                                    <label for="category" class="mtop16"><strong>Servicio:</strong></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                        {!! Form::select('service', [], null,['class'=>'form-select', 'id' => 'service']) !!}
                                        {!! Form::hidden('service_actual', 0, ['id' => 'service_actual']) !!}
                                    </div>
                                </div>

                                <div class="col-md-12 mtop16">
                                    <label for="category" class="mtop16"><strong>Ambiente:</strong></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                        {!! Form::select('environment', [], null,['class'=>'form-select', 'id' => 'environment']) !!}
                                    </div>
                                </div>

                                <div class="col-md-12 mtop16">
                                    <label for="name"><strong>Motivo del Movimiento ó Traslado:</strong></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                        {!! Form::textarea('reason', null, ['class'=>'form-control','rows'=>'2']) !!}
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
                        <h2 class="title"><i class="fas fa-cogs"></i> Listado de Partes del Equipo</h2>
                    </div>
                    <div class="inside">
                        <table id="table-modules" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <td><strong>OPCIONES</strong></td>
                                    <td><strong>FECHA</strong></td>
                                    <td><strong>AMBIENTE</strong></td>  
                                    <td><strong>MOTIVO</strong></td>                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transfers as $t)
                                    <tr>
                                        <td>
                                            <a href="{{ url('/admin/equipment/'.$t->id.'/transfer/delete') }}" data-toogle="tooltrip" data-placement="top" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                        <td>{{ $t->date }}</td>
                                        <td >{{ $t->idservicegeneral.'/'.$t->idservice.'/'.$t->idenvironment}}</td>
                                        <td>{{ $t->reason }}</td>
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