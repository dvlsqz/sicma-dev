@extends('admin.master')
@section('title','Servicios')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/environments/all') }}" class="nav-link"><i class="fa fa-object-group"></i> Servicios Generales</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/servicies_g/'.$environment->id.'/servicies') }}" class="nav-link"><i class="fa fa-object-group"></i> Servicios de: {{ $environment->name }}</a>
    </li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
        @if(kvfj(Auth::user()->permissions, 'service_add'))
            <div class="panel shadow">

                <div class="header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i> Agregar Servicios</h2>
                    
                </div>

                <div class="inside">
                    {!! Form::open(['url' => '/admin/services_g/services/add']) !!}
                    {!! Form::hidden('parent', $id) !!}

                        <label for="name"><strong>Nombre: </strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('name', null, ['class'=>'form-control']) !!}
                        </div>

                        <label for="price" class="mtop16"> <strong>Nivel del Edificio:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('level', null, ['class'=>'form-control']) !!}
                        </div>

                        <label for="nam" class="mtop16"><strong>Descripcón / Observaciones: </strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::textarea('description', null, ['class'=>'form-control','rows'=>'4']) !!}
                        </div>

                        <label for="nam" class="mtop16"><strong>Referencias: </strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::textarea('reference', null, ['class'=>'form-control','rows'=>'4']) !!}
                        </div>

                        {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}

                    {!! Form::close() !!}
                </div>

            </div>
        @endif
        </div>

        <div class="col-md-8">
            <div class="panel shadow">

                <div class="header">
                    <h2 class="title"><i class="fa fa-object-group"></i> Servicios de: <b>{{ $environment->name}}</b></h2>
                    
                </div>

                <div class="inside">
                    <table id="table-modules" class="table table-bordered table-striped" style="background-color:#EDF4FB;">
                        <thead>
                            <tr>
                                <td><strong>OPCIONES</strong></td>
                                <td><strong>NIVEL DEL EDIFICIO</strong></td>
                                <td><strong>NOMBRE</strong></td>
                                <td><strong>ESTADO</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($services as $service)
                                <tr>
                                    <td>
                                        <div class="opts">
                                            <!-- <a href="{{ url('/admin/coverage/'.$service->id.'/delete') }}" data-action="delete" data-path="admin/coverage" data-object="{{ $service->id }}" data-toogle="tooltrip" data-placement="top" title="Eliminar" class="btn-deleted deleted"><i class="fas fa-trash-alt"></i></a> -->
                                            
                                            @if(!is_null($service->file_path) && !is_null($service->file_name))
                                                <a href="{{ url('/uploads/services_photos/'.$service->file_path.'/'.$service->file_name) }}" target="_blank" data-toogle="tooltrip" data-placement="top" title="Ver Plano" class="edit"><i class="fas fa-image"></i></a>
                                            @endif
                                            
                                            @if(kvfj(Auth::user()->permissions, 'service_edit'))
                                                <a href="{{ url('/admin/services_g/services/'.$service->id.'/edit') }}" data-toogle="tooltrip" data-placement="top" title="Editar" class="edit"><i class="fas fa-edit"></i></a>
                                            @endif

                                            @if(kvfj(Auth::user()->permissions, 'environment_list'))
                                                <a href="{{ url('/admin/services/'.$service->id.'/environments') }}"  title="Ambientes"><i class="fas fa-stream"></i></a>
                                            @endif

                                        </div>
                                    </td>
                                    <td>{{ $service->level }}</td>
                                    <td>{{ $service->name }}</td>
                                    <td>
                                        @if($service->status == '0')
                                            <a href="#" class="btn btn-sm btn-success " ><i class="fas fa-check-circle"></i> En Funcionamiento</a>
                                        @elseif($service->status == '1')
                                            <a href="#" class="btn btn-sm btn-warning"><i class="fas fa-tools"></i> En Modificaciones / Reparaciones</a>
                                        @elseif($service->status == '2')
                                            <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-exclamation-triangle"></i> Deshabilitado</a>
                                        @endif
                                    </td>
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