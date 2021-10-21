@extends('admin.master')
@section('title','OT - Personal')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/ot') }}" class="nav-link"><i class="fas fa-clone"></i> OT's</a>
    </li>

@endsection

@section('content')
<div class="container-fluid">
        <div class="panel shadow">

            <div class="header">
                <h2 class="title"><i class="fas fa-plus-circle"></i> Asignacion de Personal a Cargo de OT No. {{ $ot->correlative }}</h2>

            </div>

            <div class="inside">
                {!! Form::open(['url'=>'/admin/ot/'.$ot->id.'/assignments_personal']) !!}
                    <div class="row">

                        <div class="col-md-6">
                            <label for="lastname" ><strong>Tipo de Personal a Cargo:</strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::select('type_personal', getTypePersonalOT('list', null),0,['class'=>'form-select', 'id' => 'idtype']) !!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="lastname"> <strong> Empresa: </strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::text('company', null, ['class'=>'form-control', 'id' => 'empresa', 'disabled']) !!}
                            </div>
                        </div>

                        <div class="col-md-6 mtop16">
                            <label for="lastname"> <strong> Nombre: </strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::text('name', null, ['class'=>'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-6 mtop16">
                            <label for="lastname"> <strong> Área: </strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::text('area', null, ['class'=>'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-6 mtop16">
                            <label for="price"> <strong>Fecha de Atención:</strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::date('date', new \DateTime(), ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-6 mtop16">
                            <label for="lastname" ><strong>Hora de Atención:</strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {{ Form::time('hour', Carbon\Carbon::now()->format('H:i'), ['class'=>'form-input']) }}
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

<script>
    var modal = document.getElementById('modelId');

    $(document).ready(function(){
        var typepersonal = document.getElementById('idtype');
        var empresa = document.getElementById('empresa');

        $('#idtype').click(function(){

            if(typepersonal.value == 1){
                empresa.disabled = false;
            }

            if(typepersonal.value == 0){
                empresa.disabled = true;
            }
        });
    });




</script>

@endsection
