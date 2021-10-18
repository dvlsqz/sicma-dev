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
                            <td width="48px"> <strong>ESTADO</strong></td>
                        </tr>
                    </thead>

                        <tbody>
                            @foreach($ots as $ot)
                                <tr>
                                    <td>
                                        <div class="opts">
                                            @if(kvfj(Auth::user()->permissions, 'ot_authorize_reject'))
                                                @if($ot->status == '0')
                                                    <a href="#" data-action="authorize_reject" data-path="admin/ot" data-object="{{ $ot->id }}" class="btn-deleted" data-toogle="tooltrip" data-placement="top" title="Autorizar/Rechazar"><i class="fas fa-exchange-alt"></i></a>
                                                @endif
                                            @endif

                                            @if(kvfj(Auth::user()->permissions, 'ot_print'))
                                                <a href="{{ url('/admin/ot/'.$ot->id.'/print') }}" target="_blank" data-toogle="tooltrip" data-placement="top" title="Imprimir"><i class="fas fa-file-pdf"></i></a>
                                            @endif

                                            @if(kvfj(Auth::user()->permissions, 'ot_assignments_personal'))
                                                @if($ot->status == '1')
                                                    <a href="{{ url('/admin/ot/'.$ot->id.'/assignments_personal') }}" data-toogle="tooltrip" data-placement="top" title="Asignar Personal"><i class="fas fa-people-arrows"></i></a>
                                                @endif
                                            @endif

                                            @if(kvfj(Auth::user()->permissions, 'ot_materials'))
                                                @if($ot->status == '1')
                                                    <a href="{{ url('/admin/ot/'.$ot->id.'/materials') }}" data-toogle="tooltrip" data-placement="top" title="Listado de Materiales"><i class="fas fa-cubes"></i></a>
                                                @endif
                                            @endif

                                            @if(kvfj(Auth::user()->permissions, 'ot_actions'))
                                                @if($ot->status == '2')
                                                    <a href="{{ url('/admin/ot/'.$ot->id.'/actions') }}" data-toogle="tooltrip" data-placement="top" title="Acciones"><i class="fas fa-clipboard-list"></i></a>
                                                @endif
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{ $ot->correlative }}</td>
                                    <td>{{ $ot->date_request }}</td>
                                    <td>{{ $ot->specify_job }}</td>
                                    <td>{{ getTypeWorkOT(null, $ot->type_work) }}</td>
                                    <td>{{ getPriorityOT(null, $ot->priority) }}</td>
                                    <td>{{ getStatusOT(null, $ot->status) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection
