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
            <div class="panel shadow">

                <div class="header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i> Agregar Servicios</h2>
                    
                </div>

                <div class="inside">
                    {!! Form::open(['url' => '/admin/services_g/services/'.$services->id.'/edit']) !!}
                    {!! Form::hidden('parent', $id) !!}

                        <label for="name"><strong>Nombre: </strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('name', $services->name, ['class'=>'form-control']) !!}
                        </div>

                        <label for="price" class="mtop16"> <strong>Nivel del Edificio:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('level', $services->level, ['class'=>'form-control']) !!}
                        </div>

                        <label for="nam" class="mtop16"><strong>Descripcón / Observaciones: </strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::textarea('description', $services->description, ['class'=>'form-control','rows'=>'4']) !!}
                        </div>

                        <label for="nam" class="mtop16"><strong>Referencias: </strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::textarea('reference', $services->reference, ['class'=>'form-control','rows'=>'4']) !!}
                        </div>

                        {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}

                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>
</div>

@endsection