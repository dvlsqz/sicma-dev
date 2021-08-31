@extends('admin.master')
@section('title','Agregar Equipo')

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
        {!! Form::open(['url'=>'/admin/equipment/add']) !!}
        <div class="row">
            <div class="col-md-4 d-flex">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-cogs"></i> Información Basica</h2>
                    </div>

                    <div class="inside">
                        <label for="idsupplier"><strong>Área:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                            <select name="idsupplier" id="idsupplier" style="width: 88%" >
                                @foreach ($maintenance_areas as $ma)
                                    <option value=""></option>
                                    <option value="{{$ma->id}}">{{$ma->code.' - '.$ma->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <label for="name" class="mtop16"><strong>No. Bien:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('no_bien', null, ['class'=>'form-control']) !!}
                        </div>

                        <label for="name" class="mtop16"><strong>Nombre:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('name', null, ['class'=>'form-control']) !!}
                        </div>

                        <label for="name" class="mtop16"><strong>Marca:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('brand', null, ['class'=>'form-control']) !!}
                        </div>

                        <label for="lastname" class="mtop16"><strong>Modelo:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('model', null, ['class'=>'form-control']) !!}
                        </div>

                        <label for="ibm" class="mtop16"><strong>Serie:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('serie', null, ['class'=>'form-control']) !!}
                        </div>

                        <label for="ibm" class="mtop16"><strong>Nivel Critico:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::select('critico', getLevelEquipment('list', null),0,['class'=>'form-select']) !!}
                        </div>

                        @if(Auth::user()->role == '0' || Auth::user()->idmaintenancearea == '8')
                            <label for="ibm" class="mtop16"><strong>Tipo:</strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::text('type', null, ['class'=>'form-control']) !!}
                            </div>

                            <label for="ibm" class="mtop16"><strong>Capacidad:</strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::text('capacity', null, ['class'=>'form-control']) !!}
                            </div>

                            <label for="ibm" class="mtop16"><strong>Número de Equipo/Estación:</strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::text('num_station', null, ['class'=>'form-control']) !!}
                            </div>
                        @endif
                    </div>

                </div>
            </div>

            <div class="col-md-4 d-flex">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-cogs"></i> Informacion del Proveedor</h2>
                    </div>

                    <div class="inside">
                        <label for="idsupplier"><strong>Proveedor:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                            <select name="idproveedor" id="idproduct" style="width: 88%;">
                                @foreach ($suppliers as $s)                                    
                                    <option></option>
                                    <option value="{{$s->id}}">{{$s->nit.' / '.$s->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <label for="name" class="mtop16"> <strong>Garantía (Meses):</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::number('year_warranty', null, ['class'=>'form-control','placeholder'=>'Ingrese la cantidad en meses']) !!}
                        </div>

                        <label for="name" class="mtop16"><strong>Fecha de Instalación o Entrega:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::date('date_instalaction', null, ['class'=>'form-control']) !!}
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-4 d-flex">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-map-marker-alt"></i> Ubicación del Equipo</h2>
                    </div>

                    <div class="inside">
                        <label for="category"><strong>Servicio General:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                            {!! Form::select('servicegeneral', $servicegeneral,0,['class'=>'form-select', 'id' => 'servicegeneral']) !!}
                            {!! Form::hidden('servicegeneral_actual', 0, ['id' => 'servicegeneral_actual']) !!}
                        </div>

                        <label for="category" class="mtop16"><strong>Servicio:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                            {!! Form::select('service', [], null,['class'=>'form-select', 'id' => 'service']) !!}
                            {!! Form::hidden('service_actual', 0, ['id' => 'service_actual']) !!}
                        </div>

                        <label for="category" class="mtop16"><strong>Ambiente:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                            {!! Form::select('environment', [], null,['class'=>'form-select', 'id' => 'environment']) !!}
                        </div>

                        <label for="lastname" class="mtop16"><strong>Persona Responable en el Servicio ó Ubicación:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('model', null, ['class'=>'form-control']) !!}
                        </div>

                        <label for="name" class="mtop16"><strong>Frencuencia de Uso (Días):</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::number('frequency', null, ['class'=>'form-control']) !!}
                        </div>

                        <label for="lastname" class="mtop16"><strong>¿Cuenta con personal capacitado el servicio?:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            <select name="idmaintenancearea" id="idmaintenancearea" class="form-select select2" searchable="Search here..">
                                <option value="0">No</option>
                                <option value="0">Si</option>
                            </select>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="row mtop16">
            <div class="col-md-4 d-flex">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-qrcode"></i> Datos para Codificación</h2>
                    </div>

                    <div class="inside">
                        <label for="lastname"><strong>¿Cuenta con un código anterior el equipo?:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('code_old', null, ['class'=>'form-control']) !!}
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-8 d-flex">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-wallet"></i> Información Extra</h2>
                    </div>

                    <div class="inside">               
                        <label for="ibm"><strong>Características:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::textarea('features', null, ['class'=>'form-control', 'rows'=>'4']) !!}
                        </div>

                        <label for="ibm" class="mtop16"><strong>Observaciones:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::textarea('description', null, ['class'=>'form-control', 'rows'=>'4']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mtop16">
            <div class="col-md-12">
                <div class="panel shadow">
                    <div class="inside">
                        {!! Form::submit('Guardar', ['class'=>'btn btn-success']) !!}
                    </div>
                </div>                    
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
