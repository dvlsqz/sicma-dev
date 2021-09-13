@extends('admin.master')
@section('title','Partes del Equipo')

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
        <div class="row">
            <div class="col-md-4">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-plus-circle"></i> Agregar una Nueva Parte al Equipo <b> {{ $equipment->name }} </b> </h2>
                    </div>
                    <div class="inside">
                        {!! Form::open(['url'=>'/admin/equipment/'.$equipment->id.'/equipment_parts','files' => true,'enctype'=>'multipart/form-data']) !!}
                            <div class="row">  

                                <div class="col-md-12 ">
                                    <label for="name">Nombre de la Parte:</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                        {!! Form::text('name_part', null, ['class'=>'form-control']) !!}
                                    </div>
                                </div>

                                <div class="col-md-12 mtop16">
                                    <label for="name">Cantidad:</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                        {!! Form::number('amount_part', null, ['class'=>'form-control']) !!}
                                    </div>
                                </div>

                                <div class="col-md-12 mtop16">
                                    <label for="name">Observaciones:</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                        {!! Form::textarea('observation_part', null, ['class'=>'form-control','rows'=>'1']) !!}
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mtop16">
                                <div class="input-group">
                                    {!! Form::submit('Guardar', ['class'=>'btn btn-primary']) !!}&nbsp;
                                    <a href="{{ url()->previous() }}" class="btn btn-danger">Cancelar</a>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>

            </div>

            <div class="col-md-8">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-cogs"></i> Listado de Partes del Equipo</h2>
                    </div>
                    <div class="inside">
                        <table id="table-modules" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <td>OPCIONES</td>
                                    <td >NOMBRE</td>
                                    <td>CANTIDAD</td>  
                                    <td>OBSERVACIONES</td>                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($parts as $p)
                                    <tr>
                                        <td>
                                            @if(kvfj(Auth::user()->permissions, 'equipment_parts_delete'))
                                                <a href="{{ url('/admin/equipment/equipment_parts/'.$p->id.'/delete') }}" data-toogle="tooltrip" data-placement="top" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                            @endif
                                        </td>
                                        <td>{{ $p->name_part }}</td>
                                        <td >{{ $p->amount_part }}</td>
                                        <td>{{ $p->observation_part }}</td>
                                    </tr>
                                @endforeach
                                                            
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection