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
                    <h2 class="title"><i class="fas fa-plus-circle"></i> Agregar Asignación de Personal</h2>
                </div>

                <div class="inside">
                    {!! Form::open(['url' => '/admin/ing_7/'.$ing7->id.'/assignments_personal']) !!}
                        {!! Form::hidden('iding7', $ing7->id) !!}

                        <label for="idsupplier"><strong>Personal:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                            <select name="iduser" id="idsupplier" style="width: 88%" >
                                @foreach ($users as $u)
                                    <option value=""></option>
                                    <option value="{{$u->id}}">{{$u->ibm.' - '.$u->name.' '.$u->lastname}}</option>
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
                    <h2 class="title"><i class="fa fa-object-group"></i> Personal Asignado A: <b>ING-7 NO. {{ $ing7->correlative }}</b> </h2>
                </div>

                <div class="inside">
                    <table id="table-modules" class="table table-bordered table-striped" style="background-color:#EDF4FB;">
                        <thead>
                            <tr>
                                <td><strong>OPCIONES</strong></td>
                                <td><strong>IBM - NOMBRE COMPLETO</strong></td>
                                <td><strong>AREA</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($iap as $ip)
                                <tr>
                                    <td>
                                        <div class="opts">
                                            @if(kvfj(Auth::user()->permissions, 'environment_list'))
                                                <a href="{{ url('/admin/services/'.$ip->id.'/environments') }}"  title="Ambientes"><i class="fas fa-stream"></i></a>
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{ $ip->user->ibm.' - '.$ip->user->name.' '.$ip->user->lastname }}</td>
                                    <td>{{ $ip->user->area->code.' - '.$ip->user->area->name }}</td>
                                    
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