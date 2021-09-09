@extends('admin.master')
@section('title','Servicios')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/environments/all') }}" class="nav-link"><i class="fa fa-object-group"></i> Servicios Generales</a>
    </li>
    
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="panel shadow">

                <div class="header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i> Agregar Registro de Seguimiento</h2>
                </div>

                <div class="inside">
                    {!! Form::open(['url' => '/admin/services/environments/add']) !!}
                        <label for="price"> <strong>Fecha de la Acción:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::date('deadline', new \DateTime(), ['class' => 'form-control']) !!}
                        </div>

                        <label for="price" class="mtop16"> <strong>Acción Tomada:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::textarea('action', null, ['class'=>'form-control', 'rows' => '4']) !!}
                        </div>

                        {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}

                    {!! Form::close() !!}
                </div>

            </div>
        </div>

        <div class="col-md-8">
            <div class="panel shadow">

                <div class="header">
                    <h2 class="title"><i class="fa fa-object-group"></i> Tabla de Ficha de Seguimiento: <b>ING-7 NO. {{ $ing7->correlative }}</b> </h2>
                </div>

                <div class="inside">
                    <table id="table-modules" class="table table-bordered table-striped" style="background-color:#EDF4FB;">
                        <thead>
                            <tr>
                                <td><strong>OPCIONES</strong></td>
                                <td><strong>FECHA</strong></td>
                                <td><strong>ACCIÓN</strong></td>
                                <td><strong>RESPONSABLE</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                                                                                
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection