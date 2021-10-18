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

        <!-- Modal -->
        <div class="modal" id="modelId" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:#256B92; color:#fff; text-align:center;">
                        <h5 class="modal-title">Proceso de la Solicitud</h5>
                    </div>

                    {!! Form::open(['url'=>'/admin/ing_7/accept_reject']) !!}
                        <div class="modal-body">

                            {!! Form::hidden('iding7', null, ['class'=>'form-control', 'id'=> 'iding7']) !!}

                            <div class="col-md-12">
                                <label for="name"> <strong>Seleccione una Acción: </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::select('status', getTypeIngPersonal('list', null),0,['class'=>'form-select']) !!}
                                </div>
                            </div>

                            <div class="col-md-12 mtop16">
                                <div class="form-group">
                                    <label for="no_doc"> <strong> Observación / Comentario: </strong></label>
                                    {!! Form::textarea('comment', null, ['class'=>'form-control', 'id'=> 'particulo', 'rows'=>'3']) !!}
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" id="bt_closeModal" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit"  class="btn btn-primary">Agregar</button>
                        </div>
                    </form>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        <div class="header">
                <h2 class="title"><i class="fas fa-copy"></i> Listado de ING-7</h2>
                <ul>
                    <li>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle"
                                    data-toggle="dropdown">
                                    <i class="fas fa-filter"></i>  Filtrar <span class="caret"></span>
                            </button>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{url('/admin/ing_7/trash')}}">Anulados</a></li>
                                <li><a href="{{url('/admin/ing_7/1')}}"> Solicitados</a></li>
                            </ul>
                        </div>
                    </li>
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
                            <td> <strong>FECHA REGISTRO</strong></td>
                            <td> <strong>DESCRIPCIÓN </strong></td>
                            <td> <strong>SERVICIO Y SOLICITANTE</strong></td>
                            <td> <strong>ESTADO</strong></td>
                        </tr>
                    </thead>
                    @if(Auth::user()->role == "2")
                        <tbody>
                            @foreach($ings7aa as $ia)
                                @foreach($ings7 as $in)
                                    @if($ia->iding7 == $in->id)
                                        <tr>
                                            <td>
                                                <div class="opts">

                                                    @if(kvfj(Auth::user()->permissions, 'ing7_assignments_personal'))
                                                        @if($in->status != '100' && $in->status != '110' && $in->status != '9' && $in->status != '7')
                                                            <a href="{{ url('/admin/ing_7/'.$in->id.'/assignments_personal') }}" data-toogle="tooltrip" data-placement="top" title="Asignar Personal"><i class="fas fa-people-arrows"></i></a>
                                                        @endif
                                                    @endif

                                                    @if(kvfj(Auth::user()->permissions, 'ing7_an_audit'))
                                                        @if($in->status == '4' && $in->status != '100' && $in->status != '110')
                                                            <a href="#" data-action="an_audit" data-path="admin/ing_7" data-object="{{ $in->id }}" class="btn-deleted" data-toogle="tooltrip" data-placement="top" title="En Revision"><i class="fas fa-search"></i></a>
                                                        @endif
                                                    @endif

                                                    @if(kvfj(Auth::user()->permissions, 'ing7_accept_reject'))
                                                        @if($in->status == '5' && $in->status != '100' && $in->status != '110')
                                                            <a href="#" data-action="accept_reject" data-path="admin/ing_7" data-object="{{ $in->id }}" class="btn-deleted" data-toogle="tooltrip" data-placement="top" title="Recepcionar/Rechazar"><i class="fas fa-exchange-alt"></i></a>
                                                        @endif
                                                    @endif

                                                    @if(kvfj(Auth::user()->permissions, 'ing7_in_action'))
                                                        @if($in->status == '6' && $in->status != '100' && $in->status != '110')
                                                            <a href="#" data-action="in_action" data-path="admin/ing_7" data-object="{{ $in->id }}" class="btn-deleted" data-toogle="tooltrip" data-placement="top" title="En Ejecucion"><i class="fas fa-tools"></i></a>
                                                        @endif
                                                    @endif

                                                    @if(kvfj(Auth::user()->permissions, 'ing7_follow'))
                                                        @if($in->status == '8' && $in->status != '100' && $in->status != '110')
                                                            <a href="{{ url('/admin/ing_7/'.$in->id.'/follow') }}" data-toogle="tooltrip" data-placement="top" title="Ficha de Seguimiento"><i class="fas fa-clipboard-list"></i></a>
                                                        @endif
                                                    @endif

                                                    @if(kvfj(Auth::user()->permissions, 'ing7_finish'))
                                                        @if($in->status == '8' && $in->status != '100' && $in->status != '110')
                                                            <a href="#" data-action="finish" data-path="admin/ing_7" data-object="{{ $in->id }}" class="btn-deleted" data-toogle="tooltrip" data-placement="top" title="Cerrar / Terminar"><i class="fas fa-sign-out-alt"></i></a>
                                                        @endif
                                                    @endif

                                                    @if(kvfj(Auth::user()->permissions, 'ing7_materials'))
                                                        <a href="{{ url('/admin/ing_7/'.$in->id.'/materials') }}" data-toogle="tooltrip" data-placement="top" title="Listado de Materiales"><i class="fas fa-cubes"></i></a>
                                                    @endif

                                                    @if(kvfj(Auth::user()->permissions, 'ing7_record'))
                                                        <a href="{{ url('/admin/ing_7/'.$in->id.'/record') }}" data-toogle="tooltrip" data-placement="top" title="Historial de Seguimiento"><i class="fas fa-history"></i></a>
                                                    @endif

                                                </div>
                                            </td>
                                            <td>{{ $in->correlative  }}</td>
                                            <td>{{ \Carbon\Carbon::parse($in->created_at)->format('d/m/Y') }}</td>
                                            <td>{{ $in->description }}</td>
                                            <td>
                                                {{ $in->service->name }}<br>
                                                {{ $in->user->name.' '.$in->user->lastname }}
                                            </td>
                                            <td>{{ getTypeIng7(null, $in->status) }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        </tbody>
                    @else
                        <tbody>
                            @foreach($ings7 as $in)
                                <tr>
                                    <td>
                                        <div class="opts">
                                            @if(kvfj(Auth::user()->permissions, 'ing7_receive_reject'))
                                                @if($in->status == '1' && $in->status != '100' && $in->status != '110')
                                                    <a href="#" data-action="receive_reject" data-path="admin/ing_7" data-object="{{ $in->id }}" class="btn-deleted" data-toogle="tooltrip" data-placement="top" title="Recepcionar/Rechazar"><i class="fas fa-exchange-alt"></i></a>
                                                @endif
                                            @endif

                                            <!--@if(kvfj(Auth::user()->permissions, 'ing7_classification'))
                                                <a href="{{ url('/admin/ing_7/'.$in->id.'/classification') }}" data-toogle="tooltrip" data-placement="top" title="Clasificacion"><i class="fas fa-clipboard-check"></i></a>
                                            @endif-->

                                            <!--@if(kvfj(Auth::user()->permissions, 'ing7_buy_hire'))
                                                <a href="{{ url('/admin/ing_7/'.$in->id.'/buy_hire') }}" data-toogle="tooltrip" data-placement="top" title="Compra y/o Contratación"><i class="fas fa-hand-holding-usd"></i></a>
                                            @endif-->

                                            @if(kvfj(Auth::user()->permissions, 'ing7_assignments_areas'))
                                                @if($in->status != '100' && $in->status != '110' && $in->status != '9' && $in->status != '7')
                                                    <a href="{{ url('/admin/ing_7/'.$in->id.'/assignments_areas') }}" data-toogle="tooltrip" data-placement="top" title="Asignar Area de Mantenimiento"><i class="fas fa-hard-hat"></i></a>
                                                @endif
                                            @endif

                                            @if(kvfj(Auth::user()->permissions, 'ing7_assignments_personal'))
                                                @if($in->status != '100' && $in->status != '110' && $in->status != '9' && $in->status != '7')
                                                    <a href="{{ url('/admin/ing_7/'.$in->id.'/assignments_personal') }}" data-toogle="tooltrip" data-placement="top" title="Asignar Personal"><i class="fas fa-people-arrows"></i></a>
                                                @endif
                                            @endif

                                            @if(kvfj(Auth::user()->permissions, 'ing7_an_audit'))
                                                @if($in->print == '4' && $in->status != '100' && $in->status != '110')
                                                    <a href="#" data-action="an_audit" data-path="admin/ing_7" data-object="{{ $in->id }}" class="btn-deleted" data-toogle="tooltrip" data-placement="top" title="En Revision"><i class="fas fa-search"></i></a>
                                                @endif
                                            @endif

                                            @if(kvfj(Auth::user()->permissions, 'ing7_print'))
                                                @if($in->print == '0' && $in->status != '100' && $in->status != '110')
                                                    <a href="{{ url('/admin/ing_7/'.$in->id.'/print') }}" target="_blank" data-toogle="tooltrip" data-placement="top" title="Imprimir"><i class="fas fa-file-pdf"></i></a>
                                                @endif
                                            @endif

                                            @if(kvfj(Auth::user()->permissions, 'ing7_delete'))
                                                @if($in->print == '0' && $in->status != '100' && $in->status != '110')
                                                    <a href="#" data-toogle="tooltrip" data-action="delete" data-path="admin/ing_7" data-object="{{ $in->id }}" class="btn-deleted" data-placement="top" title="Anular"><i class="fas fa-trash-alt"></i></a>
                                                @endif
                                            @endif

                                            @if(kvfj(Auth::user()->permissions, 'ing7_record'))
                                                <a href="{{ url('/admin/ing_7/'.$in->id.'/record') }}" data-toogle="tooltrip" data-placement="top" title="Historial de Seguimiento"><i class="fas fa-history"></i></a>
                                            @endif

                                        </div>
                                    </td>
                                    <td>{{ $in->correlative  }}</td>
                                    <td>{{ \Carbon\Carbon::parse($in->created_at)->format('d/m/Y') }}</td>
                                    <td>{{ $in->description }}</td>
                                    <td>
                                        {{ $in->service->name }}<br>
                                        {{ $in->user->name.' '.$in->user->lastname }}
                                    </td>
                                    <td>{{ getTypeIng7(null, $in->status) }}</td>
                                </tr>

                            @endforeach
                        </tbody>
                    @endif
                </table>
            </div>
        </div>
    </div>

    <script>
        var modal = document.getElementById('modelId');

        $(document).ready(function(){
            $('#bt_add').click(function(){
                agregar();
            });

            $('#bt_search').click(function(){
                $('#modelId').modal("show");

                var iding7 = this.getAttribute('data-object');
                $("#iding7").val(iding7);
            });

            $('#bt_closeModal').click(function(){
                $('#modelId').modal("hide");
            });
        });


    </script>


@endsection
