@extends('admin.master')
@section('title','OTs')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/ot') }}" class="nav-link"><i class="fas fa-clone"></i> OT's</a>
    </li>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="panel shadow">


            <div class="header">
                <h2 class="title"><i class="fas fa-clone"></i> Listado de Ordenes de Trabajo</h2>
                <ul>
                    @if(kvfj(Auth::user()->permissions, 'ot_add')) 
                        <li>
                            <a href="{{ url('/admin/ot/add') }}" ><i class="fas fa-plus-circle"></i> Registar</a>
                        </li>
                    @endif
                </ul>
            </div>

            <div class="inside">
                <table id="table-modules" class="table table-bordered table-striped" style="background-color:#EDF4FB;">
                    <thead>
                        <tr>
                            <td> <strong>OPCIONES </strong></td>
                            <td width="48px"> <strong>NO. OT</strong></td>
                            <td width="56px"> <strong>FECHA </strong></td>
                            <td> <strong>TRABAJO </strong></td>
                            <td width="90px"> <strong>TIPO DE TRABAJO </strong></td>
                            <td width="48px"> <strong>PRIORIDAD</strong></td>
                        </tr>
                    </thead>
                    
                        <tbody> 
                            @foreach($ots as $ot)
                                <tr>
                                    <td>
                                        <div class="opts">
                                            @if(kvfj(Auth::user()->permissions, 'ot_assignments_personal')) 
                                                <a href="{{ url('/admin/ot/'.$ot->id.'/assignments_personal') }}" data-toogle="tooltrip" data-placement="top" title="Asignar Personal"><i class="fas fa-people-arrows"></i></a>                                   
                                            @endif

                                            @if(kvfj(Auth::user()->permissions, 'ot_materials')) 
                                                <a href="{{ url('/admin/ot/'.$ot->id.'/materials') }}" data-toogle="tooltrip" data-placement="top" title="Materiales"><i class="fas fa-toolbox"></i></a>                                   
                                            @endif

                                            @if(kvfj(Auth::user()->permissions, 'ot_actions')) 
                                                <a href="{{ url('/admin/ot/'.$ot->id.'/actions') }}" data-toogle="tooltrip" data-placement="top" title="Acciones"><i class="fas fa-clipboard-list"></i></a>                                   
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{ $ot->correlative }}</td>
                                    <td>{{ $ot->date_request }}</td>
                                    <td>{{ $ot->specify_job }}</td>
                                    <td>{{ getTypeWorkOT(null, $ot->type_work) }}</td>
                                    <td>{{ getPriorityOT(null, $ot->priority) }}</td>
                                </tr>                                
                            @endforeach
                        </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection