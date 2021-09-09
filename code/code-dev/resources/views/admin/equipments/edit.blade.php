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
                        <label for="lastname"><strong> Área Encargada: </strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            <select name="idmaintenancearea" id="idmaintenancearea" class="form-select select2" searchable="Search here..">
                                @foreach ($maintenance_areas as $ma)
                                    <option value="{{$ma->id}}">{{$ma->code.' - '.$ma->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <label for="name" class="mtop16"><strong> No. Bien: </strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('no_bien', $equipment->no_bien, ['class'=>'form-control']) !!}
                        </div>

                        <label for="name" class="mtop16"><strong> Nombre: </strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('name', $equipment->name, ['class'=>'form-control']) !!}
                        </div>

                        <label for="name" class="mtop16"><strong> Marca: </strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('brand', $equipment->brand, ['class'=>'form-control']) !!}
                        </div>

                        <label for="lastname" class="mtop16"><strong> Modelo: </strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('model', $equipment->model, ['class'=>'form-control']) !!}
                        </div>

                        <label for="ibm" class="mtop16"><strong> Serie: </strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('serie', $equipment->serie, ['class'=>'form-control']) !!}
                        </div>

                        @if(Auth::user()->role == '0' || Auth::user()->idmaintenancearea == '8')
                            <label for="ibm" class="mtop16"><strong>Tipo: </strong></label>
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
                        <label for="name"><strong> Garantía (Meses): </strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::number('year_warranty', $equipment->year_warranty, ['class'=>'form-control','placeholder'=>'Ingrese la cantidad en meses']) !!}
                        </div>

                        <label for="name" class="mtop16"><strong> Fecha de Instalación o Entrega: </strong></label>
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
                        <label for="category"><strong> Servicio General: </strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                            {!! Form::text('servicegeneral', $equipment->servicegeneral->name, ['class'=>'form-control']) !!}
                        </div>

                        <label for="category" class="mtop16"><strong> Servicio: </strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                            {!! Form::text('servicegeneral', $equipment->service->level.' - '.$equipment->service->name, ['class'=>'form-control']) !!}
                        </div>

                        <label for="category" class="mtop16"><strong> Ambiente: </strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                            {!! Form::textarea('servicegeneral', $equipment->environment->code.' - '.$equipment->environment->name, ['class'=>'form-control', 'rows'=>'2']) !!}
                        </div>

                        <label for="lastname" class="mtop16"><strong> Persona Responsable en el Servicio ó Ubicación: </strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('model', null, ['class'=>'form-control']) !!}
                        </div>

                        <label for="name" class="mtop16"><strong>Frencuencia de Uso:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::select('frequency', getFrecuenciasUsosArray('list', null),$equipment->frequency,['class'=>'form-select']) !!}
                        </div>

                        <label for="lastname" class="mtop16"><strong> ¿Cuenta con personal capacitado el servicio?: </strong></label>
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
                        <label for="lastname"><strong> ¿Cuenta con un código anterior el equipo?: </strong></label>
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

                        <label for="name" class="mtop16"><strong> Codigo QR Actual: </strong></label>
                        <div class="input-group">
                            {!! QrCode::size(75)->generate('http://10.11.0.30:8500/admin/equipment/'.$equipment->id.'/edit'); !!}
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
                        <label for="ibm"><strong> Características: </strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::textarea('features', $equipment->features, ['class'=>'form-control', 'rows'=>'4']) !!}
                        </div>

                        <label for="ibm" class="mtop16"><strong> Observaciones: </strong></label>
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
