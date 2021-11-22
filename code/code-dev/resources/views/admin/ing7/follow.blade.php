@extends('admin.master')
@section('title','Servicios')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/ing_7') }}" class="nav-link"><i class="fas fa-copy"></i> ING-7</a>
    </li>

@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="panel shadow">

                <div class="header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i> Agregar Registro de Seguimiento</h2>
                </div>

                <div class="inside">
                    {!! Form::open(['url'=>'/admin/ing_7/'.$ing7->id.'/follow','files' => true,'enctype'=>'multipart/form-data']) !!}
                        <label for="price"> <strong>Fecha de la Acción:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::date('date', new \DateTime(), ['class' => 'form-control']) !!}
                        </div>

                        <label for="price" class="mtop16"> <strong>Acción Tomada:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::textarea('action', null, ['class'=>'form-control', 'rows' => '4']) !!}
                        </div>

                        {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}

                    {!! Form::close() !!}
                </div>

            </div>
        </div>

        <div class="col-md-8">
            <div class="panel shadow">

                <div class="header">
                    <h2 class="title"><i class="fa fa-object-group"></i> Tabla de Ficha de Seguimiento: <b>ING-7 NO. {{ $ing7->correlative }}</b> </h2>
                    <ul>
                        @if(kvfj(Auth::user()->permissions, 'ing7_follow'))
                            <li>
                                <a href="{{ url('/admin/ing_7/'.$ing7->id.'/print/follow') }}" target="_blank" ><i class="fas fa-print"></i> Imprimir</a>
                            </li>
                        @endif
                    </ul>
                </div>

                <div class="inside">
                    <table id="table-modules" class="table table-bordered table-striped" style="background-color:#EDF4FB;">
                        <thead>
                            <tr>
                                <td><strong>OPCIONES</strong></td>
                                <td><strong>FECHA</strong></td>
                                <td><strong>ACCIÓN</strong></td>
                                <td><strong>RESPONSABLE</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ing7f as $in)
                                <tr>
                                    <td>
                                        <div class="opts">
                                            @if(kvfj(Auth::user()->permissions, 'ing7_follow_delete'))
                                                <a href="#" data-toogle="tooltrip" data-action="follow_delete" data-path="admin/ing_7" data-object="{{ $in->id }}" class="btn-deleted" data-placement="top" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{ $in->date }}</td>
                                    <td>{{ $in->action }}</td>
                                    <td>{{ $in->user->name.' '.$in->user->lastname }}</td>
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
