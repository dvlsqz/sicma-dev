@extends('admin.master')
@section('title','Servicios')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/environments/all') }}" class="nav-link"><i class="fa fa-object-group"></i> Servicios Generales</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/servicies_g/'.$service->id.'/servicies') }}" class="nav-link"><i class="fa fa-object-group"></i> Ambientes de: {{ $service->name }}</a>
    </li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="panel shadow">

                <div class="header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i> Agregar Ambiente</h2>
                </div>

                <div class="inside">
                    {!! Form::open(['url' => '/admin/services/environments/add']) !!}
                    {!! Form::hidden('parent', $id) !!}
                        <label for="price"> <strong>Codigo:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('code', null, ['class'=>'form-control']) !!}
                        </div>

                        <label for="name" class="mtop16"><strong>Nombre:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('name', null, ['class'=>'form-control']) !!}
                        </div>

                        <label for="price" class="mtop16"><strong> Medidas (mts<sup>2</sup>):</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('measures', null, ['class'=>'form-control']) !!}
                        </div>                        

                        <label for="nam" class="mtop16"><strong>Descripcón / Observaciones: </strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::textarea('description', null, ['class'=>'form-control','rows'=>'4']) !!}
                        </div>

                        <label for="nam" class="mtop16"><strong>Referencias:</strong> </label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::textarea('reference', null, ['class'=>'form-control','rows'=>'4']) !!}
                        </div>

                        {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}

                    {!! Form::close() !!}
                </div>

            </div>
        </div>

        <div class="col-md-9">
            <div class="panel shadow">

                <div class="header">
                    <h2 class="title"><i class="fas fa-shipping-fast"></i> Ambientes del servicio: <b>{{ $service->name }}</b></h2>
                </div>

                <div class="inside">
                    <table id="table-modules" class="table table-bordered table-striped" style="background-color:#EDF4FB;">
                        <thead>
                            <tr>
                                <td><strong>OPCIONES</strong></td>
                                <td><strong>CODIGO</strong></td>
                                <td><strong>NOMBRE</strong></td>
                                <td><strong>ESTADO</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($environments as $environment)
                                <tr>
                                    <td>
                                        <div class="opts">
                                            <a href="{{ url('/admin/coverage/'.$environment->id.'/delete') }}" data-action="delete" data-path="admin/coverage" data-object="{{ $environment->id }}" data-toogle="tooltrip" data-placement="top" title="Eliminar" class="btn-deleted deleted"><i class="fas fa-trash-alt"></i></a>
                                            <a href="{{ url('/admin/coverage/city/'.$environment->id.'/edit') }}" data-toogle="tooltrip" data-placement="top" title="Editar" class="edit"><i class="fas fa-edit"></i></a>
                                        </div>
                                    </td>
                                    <td>{{ $environment->code }}</td>
                                    <td>{{ $environment->name }}</td>
                                    <td>
                                        @if($environment->status == '0')
                                            <a href="#" class="btn btn-sm btn-success " ><i class="fas fa-check-circle"></i> En Funcionamiento</a>
                                        @elseif($environment->status == '1')
                                            <a href="#" class="btn btn-sm btn-warning"><i class="fas fa-tools"></i> En Modificaciones / Reparaciones</a>
                                        @elseif($environment->status == '2')
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