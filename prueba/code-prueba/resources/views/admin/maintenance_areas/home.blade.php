@extends('admin.master')
@section('title','Áreas de Mantenimiento')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/maintenance_areas') }}" class="nav-link"><i class="fas fa-hard-hat"></i> Areas de Mantenimiento</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">        
        <div class="row">
            <div class="col-md-5">
                @if(kvfj(Auth::user()->permissions, 'unit_add'))
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fas fa-plus-circle"></i> Agregar Area de Mantenimiento</h2>
                        </div>

                        <div class="inside">
                            {!! Form::open(['url' => '/admin/maintenance_area/add', 'files' => true]) !!}
                                <label for="name"><strong>Nombre del Area:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('name', null, ['class'=>'form-control']) !!}
                                </div>

                                <label for="code" class="mtop16"><strong>Código del Area:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('code', null, ['class'=>'form-control']) !!}
                                </div>

                                <label for="unit_id"  class="mtop16"><strong>Unidad del Area:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                    {!! Form::select('unit_id', $units,1,['class'=>'form-select']) !!}
                                </div>
                                
                                {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}
                            {!! Form::close() !!}                            
                        </div>
                    </div>
                @endif
            </div>
            
            <div class="col-md-7">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-hard-hat"></i> Areas de Mantenimiento</a>
                    </div>

                    <div class="inside">
                        
                        <table id="table-modules" class="table table-striped table-hover mtop16">
                            <thead>
                                <tr>
                                    <td width="140px"><strong>OPCIONES</strong></td>
                                    <td><strong>NOMBRE</strong></td>
                                    <td><strong>UNIDAD</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($maintenance_areas as $ma)
                                    <tr>
                                        <td>
                                        <div class="opts">
                                            @if(kvfj(Auth::user()->permissions, 'maintenance_area_edit'))
                                                <a href="{{ url('/admin/maintenance_area/'.$ma->id.'/edit') }}" data-toogle="tooltrip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
                                            @endif
                                            @if(kvfj(Auth::user()->permissions, 'maintenance_area_delete'))
                                                <a href="{{ url('/admin/maintenance_area/'.$ma->id.'/delete') }}" data-toogle="tooltrip" data-placement="top" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                            @endif
                                        </div>
                                        </td>
                                        <td>{{ $ma->name }}</td>
                                        <td>{{ $ma->unit->name }}</td>
                                    </tr>
                                    
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center btn-paginate">
                            {!! $maintenance_areas->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
@endsection