@extends('admin.master')
@section('title','Editar Equipo')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/equipments/all') }}" class="nav-link"><i class="fas fa-columns"></i> Equipos</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/equipment/'.$equipment->id.'/edit') }}" class="nav-link"><i class="fas fa-plus-circle"></i> Editar Equipo: <b> {{ $equipment->name }} </b></a>
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
                        <label for="lastname">Área Encargada:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            <select name="idmaintenancearea" id="idmaintenancearea" class="form-select select2" searchable="Search here..">
                                @foreach ($maintenance_areas as $ma)
                                    <option value="{{$ma->id}}">{{$ma->code.' - '.$ma->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <label for="name" class="mtop16">No. Bien:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('no_bien', $equipment->no_bien, ['class'=>'form-control']) !!}
                        </div>

                        <label for="name" class="mtop16">Nombre:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('name', $equipment->name, ['class'=>'form-control']) !!}
                        </div>

                        <label for="name" class="mtop16">Marca:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('brand', $equipment->brand, ['class'=>'form-control']) !!}
                        </div>

                        <label for="lastname" class="mtop16">Modelo:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('model', $equipment->model, ['class'=>'form-control']) !!}
                        </div>

                        <label for="ibm" class="mtop16">Serie:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('serie', $equipment->serie, ['class'=>'form-control']) !!}
                        </div>

                        @if(Auth::user()->role == '0' && Auth::user()->role == '8')
                            <label for="ibm" class="mtop16"><strong>Tipo:</strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::text('type', $equipment->type, ['class'=>'form-control']) !!}
                            </div>

                            <label for="ibm" class="mtop16"><strong>Capacidad:</strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::text('capacity', $equipment->capacity, ['class'=>'form-control']) !!}
                            </div>

                            <label for="ibm" class="mtop16"><strong>Número de Equipo/Estación:</strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::text('num_station', $equipment->num_station, ['class'=>'form-control']) !!}
                            </div>
                        @endif
                    </div>

                </div>
            </div>

            <div class="col-md-4 d-flex">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-cogs"></i> Informacion Basica</h2>
                    </div>

                    <div class="inside">
                        <label for="name">Garantía (Meses):</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::number('year_warranty', $equipment->year_warranty, ['class'=>'form-control','placeholder'=>'Ingrese la cantidad en meses']) !!}
                        </div>

                        <label for="name" class="mtop16">Fecha de Instalación o Entrega:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::date('date_instalaction', $equipment->date_instalaction, ['class'=>'form-control']) !!}
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
                        <label for="category">Servicio General:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                            
                        </div>

                        <label for="category" class="mtop16">Servicio:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                            
                        </div>

                        <label for="category" class="mtop16">Ambiente:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                            
                        </div>

                        <label for="lastname" class="mtop16">Persona Responable en el Servicio ó Ubicación:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('model', null, ['class'=>'form-control']) !!}
                        </div>

                        <label for="name" class="mtop16">Frencuencia de Uso (Días):</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::number('frequency', null, ['class'=>'form-control']) !!}
                        </div>

                        <label for="lastname" class="mtop16">¿Cuenta con personal capacitado el servicio?:</label>
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
                        <label for="lastname">¿Cuenta con un código anterior el equipo?:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('code_old', $equipment->code_old, ['class'=>'form-control']) !!}
                        </div>

                        <!--<label for="ibm" class="mtop16">Nuevo Código del Equipo:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('code', $equipment->new, ['class'=>'form-control']) !!} 
                            <a href="#" class="btn btn-sm btn-primary " ><i class="fas fa-qrcode"></i> Generar Codigo</a>
                        </div>-->

                        <label for="name" class="mtop16">Codigo QR Actual:</label>
                        <div class="input-group">
                            {!! QrCode::size(75)->generate('http://sicma.igss/admin/equipment/'.$equipment->id.'/edit'); !!}
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
                        <label for="ibm">Características:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::textarea('features', $equipment->features, ['class'=>'form-control', 'rows'=>'4']) !!}
                        </div>

                        <label for="ibm" class="mtop16">Observaciones:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::textarea('description', $equipment->description, ['class'=>'form-control', 'rows'=>'4']) !!}
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
