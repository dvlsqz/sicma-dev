@extends('admin.master')
@section('title','Ambientes')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/kardex/all') }}" class="nav-link"><i class="fas fa-database"></i> Ambientes</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                @if(kvfj(Auth::user()->permissions, 'environment_add'))
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fas fa-plus-circle"></i> Agregar Servicio General</h2>
                        </div>

                        <div class="inside">
                            {!! Form::open(['url' => '/admin/services_g/'.$servicesg->id.'/edit', 'files' => true]) !!}
                                <label for="name"> <strong>  Nombre: </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('name', $servicesg->name, ['class'=>'form-control']) !!}
                                </div>

                                <label for="nam" class="mtop16"><strong>Descripcón / Observaciones: </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::textarea('description', $servicesg->description, ['class'=>'form-control','rows'=>'4']) !!}
                                </div>

                                {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
