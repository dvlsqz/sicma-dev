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
                @if(kvfj(Auth::user()->permissions, 'serviceg_add'))
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fas fa-plus-circle"></i> Agregar Servicio General</h2>
                        </div>

                        <div class="inside">
                            {!! Form::open(['url' => '/admin/services_g/add', 'files' => true]) !!}
                                <label for="name"> <strong>  Nombre: </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('name', null, ['class'=>'form-control']) !!}
                                </div>

                                <label for="nam" class="mtop16"><strong>Descripcón / Observaciones: </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::textarea('description', null, ['class'=>'form-control','rows'=>'4']) !!}
                                </div>

                                {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-md-8">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-database"></i> Servicios Generales </h2>
                        
                    </div>

                    <div class="inside">
                        <table id="table-modules" class="table table-bordered table-striped" style="background-color:#EDF4FB;">
                            <thead>
                                <tr>
                                    <td><strong>OPCIONES</strong></td>
                                    <td><strong>NOMBRE</strong></td>
                                    <td><strong>ESTADO</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($environment as $env)
                                    <tr>
                                        <td>
                                            <div class="opts">
                                                @if(!is_null($env->file_path) && !is_null($env->file_name))
                                                    <a href="{{ url('/uploads/services_photos/'.$env->file_path.'/'.$env->file_name) }}" target="_blank" title="Ver Plano General"><i class="fas fa-image"></i> </a>
                                                @endif

                                                @if(kvfj(Auth::user()->permissions, 'serviceg_edit'))
                                                    <a href="{{ url('/admin/services_g/'.$env->id.'/edit') }}"  title="Editar"><i class="fas fa-edit"></i></a>
                                                @endif                                             
                                                
                                                @if(kvfj(Auth::user()->permissions, 'service_list'))
                                                    <a href="{{ url('/admin/services_g/'.$env->id.'/services') }}"  title="Servicios"><i class="fas fa-list-ul"></i></a>
                                                @endif  

                                            </div>
                                        </td>
                                        <td>{{$env->name}}</td>
                                        <td>
                                            @if($env->status == '0')
                                                <a href="#" class="btn btn-sm btn-success " ><i class="fas fa-check-circle"></i> En Funcionamiento</a>
                                            @elseif($env->status == '1')
                                                <a href="#" class="btn btn-sm btn-warning"><i class="fas fa-tools"></i> En Modificaciones / Reparaciones</a>
                                            @elseif($env->status == '2')
                                                <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-exclamation-triangle"></i> Deshabilitado</a>
                                            @endif
                                        </td>
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
