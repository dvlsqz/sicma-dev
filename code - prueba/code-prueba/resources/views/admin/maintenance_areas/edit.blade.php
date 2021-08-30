@extends('admin.master')
@section('title','Editar Unidad')

@section('breadcrumb')
    <li class="breadcrumb-item">
    <a href="{{ url('/admin/units') }}" class="nav-link"><i class="fas fa-hospital-user"></i> Unidades</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-5">
                <div class="panel shadow">

                    <div class="header">
                        <h2 class="title"><i class="fas fa-edit"></i> Editar Unidad</h2>
                    </div>

                    <div class="inside">
                        {!! Form::open(['url' => '/admin/maintenance_area/'.$ma->id.'/edit', 'files' => true]) !!}
                            <label for="name"><strong>Nombre del Area:</strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::text('name', $ma->name, ['class'=>'form-control']) !!}
                            </div>

                            <label for="code" class="mtop16"><strong>Código del Area:</strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::text('code', $ma->code, ['class'=>'form-control']) !!}
                            </div>

                            <label for="unit_id"  class="mtop16"><strong>Unidad del Area:</strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                {!! Form::select('unit_id', $units,$ma->unit_id,['class'=>'form-select']) !!}
                            </div>
                            
                            
                            <div class="row mtop16">
                                <div class="input-group">
                                    {!! Form::submit('Guardar', ['class'=>'btn btn-success']) !!}&nbsp;
                                    <a href="{{ url('admin/maintenance_areas') }}" class="btn btn-danger">Cancelar</a>
                                </div>
                            </div>
                        {!! Form::close() !!}   
                    </div>

                </div>
            </div>
        </div>

        
    </div>

@endsection