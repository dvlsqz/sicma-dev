@extends('admin.master')
@section('title','Servicios')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/environments/all') }}" class="nav-link"><i class="fa fa-object-group"></i> Servicios Generales</a>
    </li>

@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="panel shadow">

                <div class="header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i> Agregar Asignación de Area</h2>
                </div>

                <div class="inside">
                    {!! Form::open(['url' => '/admin/ing_7/'.$ing7->id.'/assignments_areas']) !!}
                        {!! Form::hidden('iding7', $ing7->id) !!}

                        <label for="idsupplier"><strong>Área:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                            <select name="idmaintenancearea" id="idsupplier" style="width: 88%" >
                                @foreach ($maintenance_areas as $ma)
                                    <option value=""></option>
                                    <option value="{{$ma->id}}">{{$ma->code.' - '.$ma->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}

                    {!! Form::close() !!}
                </div>

            </div>
        </div>

        <div class="col-md-8">
            <div class="panel shadow">

                <div class="header">
                    <h2 class="title"><i class="fa fa-object-group"></i> Areas Asignadas A: <b>ING-7 NO. {{ $ing7->correlative }}</b> </h2>
                </div>

                <div class="inside">
                    <table id="table-modules" class="table table-bordered table-striped" style="background-color:#EDF4FB;">
                        <thead>
                            <tr>
                                <td><strong>OPCIONES</strong></td>
                                <td><strong>Area de Mantenimiento</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($iaa as $ia)
                                <tr>
                                    <td>
                                        <div class="opts">
                                            @if(kvfj(Auth::user()->permissions, 'ing7_assignments_areas_delete'))
                                                <a href="#" data-toogle="tooltrip" data-action="assignments_areas_delete" data-path="admin/ing_7" data-object="{{ $ia->id }}" class="btn-deleted" data-placement="top" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{ $ia->area->code.' - '.$ia->area->name }}</td>

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
