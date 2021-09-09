@extends('admin.master')
@section('title','ING-7')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/ing_7') }}" class="nav-link"><i class="fas fa-copy"></i> ING-7</a>
    </li>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="panel shadow">

        <div class="header">
                <h2 class="title"><i class="fas fa-copy"></i> ING-7</h2>
                <ul>
                    @if(kvfj(Auth::user()->permissions, 'ing7_add')) 
                        <li>
                            <a href="{{ url('/admin/ing_7/add') }}" ><i class="fas fa-plus-circle"></i> Solicitar</a>
                        </li>
                    @endif
                </ul>
            </div>

            <div class="inside">
                <table id="table-modules" class="table table-bordered table-striped" style="background-color:#EDF4FB;">
                    <thead>
                        <tr>
                            <td> <strong>OPCIONES </strong></td>
                            <td> <strong>NO. SOLICITUD</strong></td>
                            <td> <strong>DESCRIPCIÓN </strong></td>
                            <td> <strong>FECHA REGISTRO</strong></td>
                            <td> <strong>ESTADO</strong></td>
                        </tr>
                    </thead>
                    <tbody> 
                        @foreach($ings7 as $in)
                            <tr>
                                <td>
                                <div class="opts">
                                    @if(kvfj(Auth::user()->permissions, 'ing7_classification'))                                   
                                        <a href="{{ url('/admin/ing_7/'.$in->id.'/classification') }}" data-toogle="tooltrip" data-placement="top" title="Clasificacion"><i class="fas fa-clipboard-check"></i></a>
                                    @endif
                                    
                                    @if(kvfj(Auth::user()->permissions, 'ing7_assignments_areas'))
                                        <a href="{{ url('/admin/ing_7/'.$in->id.'/assignments_areas') }}" data-toogle="tooltrip" data-placement="top" title="Asignar Area de Mantenimiento"><i class="fas fa-hard-hat"></i></a>
                                    @endif

                                    @if(kvfj(Auth::user()->permissions, 'ing7_buy_hire'))
                                        <a href="{{ url('/admin/ing_7/'.$in->id.'/buy_hire') }}" data-toogle="tooltrip" data-placement="top" title="Compra y/o Contratación"><i class="fas fa-hand-holding-usd"></i></a> 
                                    @endif

                                    @if(kvfj(Auth::user()->permissions, 'ing7_assignments_personal'))    
                                        <a href="{{ url('/admin/ing_7/'.$in->id.'/assignments_personal') }}" data-toogle="tooltrip" data-placement="top" title="Asignar Personal"><i class="fas fa-people-arrows"></i></a>                                   
                                    @endif
                                    
                                    @if(kvfj(Auth::user()->permissions, 'ing7_follow'))
                                        <a href="{{ url('/admin/ing_7/'.$in->id.'/follow') }}" data-toogle="tooltrip" data-placement="top" title="Ficha de Seguimiento"><i class="fas fa-clipboard-list"></i></a>
                                    @endif
                                    
                                    @if(kvfj(Auth::user()->permissions, 'ing7_print'))
                                        <a href="{{ url('/admin/ing_7/'.$in->id.'/print') }}" target="_blank" data-toogle="tooltrip" data-placement="top" title="Imprimir"><i class="fas fa-file-pdf"></i></a>
                                    @endif

                                    @if(kvfj(Auth::user()->permissions, 'ing7_delete'))
                                        <a href="{{ url('/admin/ing_7/'.$in->id.'/delete') }}" data-toogle="tooltrip" data-placement="top" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                    @endif

                                </div>
                                </td>
                                <td>{{ $in->correlative  }}</td>
                                <td>{{ $in->description }}</td>
                                <td>{{ \Carbon\Carbon::parse($in->created_at)->format('d/m/Y') }}</td>
                                <td>{{ getTypeIng7(null, $in->status) }}</td>
                            </tr>
                            
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection