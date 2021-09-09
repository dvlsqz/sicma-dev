@extends('admin.master')
@section('title','Clasificacion de ING-7')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/ing_7') }}" class="nav-link"><i class="fas fa-copy"></i> ING-7</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/ing_7/add') }}" class="nav-link"><i class="fas fa-plus-circle"></i> Solicitud de ING-7</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">

            <div class="header">
                <h2 class="title"><i class="fas fa-plus-circle"></i> Nueva Solicitud de ING-7</h2>

            </div>

            <div class="inside">
                {!! Form::open(['url'=>'/admin/ing_7/'.$ing7->id.'/buy_hire']) !!}
                    <div class="row">

                        <div class="col-md-6">
                            <label for="name" ><strong>a) Para compra de materiales:</strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::select('buy_materials', getBuyHireArray('list', null),$ing7->buy_materials,['class'=>'form-select']) !!}
                            </div>
                        </div>

                        <div class="col-md-6 ">
                            <label for="name"><strong>b) Para contratar los trabajos:</strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::select('hire_jobs', getBuyHireArray('list', null),$ing7->hire_jobs,['class'=>'form-select']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row mtop16">
                        <div class="col-md-12">
                            {!! Form::submit('Guardar', ['class'=>'btn btn-success']) !!}
                            <a href="{{ url('/admin/suppliers') }}" class="btn btn-danger">Cancelar</a>
                        </div>
                    </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection