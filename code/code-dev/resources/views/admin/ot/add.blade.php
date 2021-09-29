@extends('admin.master')
@section('title','Registro OT')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/ot') }}" class="nav-link"><i class="fas fa-clone"></i> OT's</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/ot/add') }}" class="nav-link"><i class="fas fa-plus-circle"></i> Registro de OT</a>
    </li>
@endsection

@section('content')
<div class="container-fluid">
        <div class="panel shadow">

            <div class="header">
                <h2 class="title"><i class="fas fa-plus-circle"></i> Nuevo Registro de OT</h2>

            </div>

            <div class="inside">
                {!! Form::open(['url'=>'/admin/ot/add']) !!}
                    <div class="row">                       

                        <div class="col-md-4">
                            <label for="lastname" ><strong>Encargado que Autoriza:</strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::select('idapproval', getApprovalOT('list', null),0,['class'=>'form-select']) !!}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="name" ><strong>Area de Mantenimiento:</strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                <select name="idmaintenancearea" id="idsupplier" style="width: 89%" >
                                    @foreach ($maintenance_areas as $ma)
                                        <option value=""></option>
                                        <option value="{{$ma->id}}">{{$ma->code.' - '.$ma->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="price"> <strong>Fecha de Orden:</strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::date('date_request', new \DateTime(), ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-6 mtop16">
                            <label for="lastname" class="mtop16"><strong>Tipo de Trabajo:</strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::select('type_work', getTypeWorkOT('list', null),0,['class'=>'form-select']) !!}
                            </div>
                        </div>

                        <div class="col-md-6 mtop16">
                            <label for="lastname" class="mtop16"><strong>Prioridad:</strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::select('priority', getPriorityOT('list', null),0,['class'=>'form-select']) !!}
                            </div>
                        </div>                        

                        <div class="col-md-12 mtop16">
                            <label for="name"> <strong> Especificar el Trabajo: </strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::textarea('specify_job', null, ['class'=>'form-control', 'rows' => '3']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row mtop16">
                        <div class="col-md-12">
                            {!! Form::submit('Guardar', ['class'=>'btn btn-success']) !!}
                            <a href="{{ url('/admin/ot') }}" class="btn btn-danger">Cancelar</a>
                        </div>
                    </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection