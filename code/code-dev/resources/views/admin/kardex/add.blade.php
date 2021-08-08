@extends('admin.master')
@section('title','Agregar')
<script src="{{ asset('js/jQuery-2.1.4.min.js') }}" type="text/javascript"></script>

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/kardex/all') }}" class="nav-link"><i class="fas fa-database"></i> Kardex Transitorio</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/kardex/add') }}" class="nav-link"><i class="fas fa-plus-circle"></i> Agregar</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">

            <div class="header">
                <h2 class="title"><i class="fas fa-plus-circle"></i> Agregar</h2>

            </div>

            <div class="inside">
                {!! Form::open(['url'=>'/admin/kardex/add']) !!}
                    <div class="row">

                        <div class="col-md-12">

                            <label for="idInsumo">Insumo</label>
                            <select data-live-search="true" name="idproduct" id="idproduct" style="width: 100%;" >
                                @foreach($products as $p)
                                    <option></option>
                                    <option value="{{$p->id}}">{{'ppr: '.$p->code_ppr.' - '.$p->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 mtop16">
                            <label for="lastname">Área:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                <select name="idmaintenancearea" id="idmaintenancearea" class="form-control ">
                                    @foreach ($maintenance_areas as $ma)                                        
                                        <option value="{{$ma->id}}">{{$ma->code.' - '.$ma->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> 

                        <div class="col-md-4 mtop16">
                            <label for="ibm">Código Interno Mantenimiento:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::text('code_mantto_int', null, ['class'=>'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-4 mtop16">
                            <label for="lastname">Existencia:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::number('stock', 0, ['class'=>'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-12 mtop16">
                            <label for="ibm">Observaciones:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::textarea('observations', null, ['class'=>'form-control', 'rows'=>'2']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row mtop16">
                        <div class="input-group">
                            {!! Form::submit('Guardar', ['class'=>'btn btn-success']) !!}&nbsp;
                            <a href="{{ url('admin/kardex/all') }}" class="btn btn-danger">Cancelar</a>
                        </div>
                    </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>


@endsection
