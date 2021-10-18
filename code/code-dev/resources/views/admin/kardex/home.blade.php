<?php
    use \App\Http\Controllers\Admin\KardexController;
?>
@extends('admin.master')
@section('title','Kardex Transitorio')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/kardex/all') }}" class="nav-link"><i class="fas fa-database"></i> Kardex Transitorio</a>
    </li>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#256B92; color:#fff; text-align:center;">
                    <h5 class="modal-title">Detalle de Ingreso</h5>
                </div>

                <div class="modal-body">
                    {{-- @foreach($incomes_details_kardex as $item)
                        @if($loop->first)
                            {{ $item->income->type_doc }}
                        @endif

                    @endforeach --}}

                    <table class="table table-bordered table-striped" style="background-color:#EDF4FB; font-size: 1em;">
                        <thead>
                            <tr>
                                <td><strong>DESCRIPCION</strong></td>
                                <td><strong>CANTIDAD</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($incomes_details_kardex as $idk)
                                <tr>
                                    <td>
                                        {{ 'Codigo PPR: '.$idk->kardex->product->code_ppr}} <br>
                                        {{ 'Nombre: '.$idk->kardex->product->name }} <br>
                                        {{ 'Descripcion: '.$idk->kardex->product->description}}
                                    </td>
                                    <td>{{ $idk->amount }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

                <div class="modal-footer">
                    <button type="button" id="bt_closeModal" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="panel shadow">

                <div class="header">
                    <h2 class="title"><i class="fas fa-filter"></i> Ingresos</h2>
                </div>

                <div class="list-group">
                    @foreach($incomes_kardex as $idp)
                        <a href="#" id="bt_search" data-object="{{ $idp->id }}" class="list-group-item list-group-item-action" aria-current="true">
                            <i class="fas fa-chevron-right"></i> {{ getFormaKardexIncomeArray(null,$idp->type_doc) }} No. {{ $idp->no_doc }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="panel shadow">

                <div class="header">
                    <h2 class="title"><i class="fas fa-database"></i> Kardex Transitorio</h2>
                    <ul>
                        @if(kvfj(Auth::user()->permissions, 'kardex_add'))
                            <li>
                                <a href="{{ url('/admin/kardex/add') }}" ><i class="fas fa-plus-circle"></i> Agregar</a>
                            </li>
                        @endif
                        @if(kvfj(Auth::user()->permissions, 'kardex_income'))
                            <li>
                                <a href="{{ url('/admin/kardex/income/add') }}" ><i class="fas fa-plus-circle"></i> Ingresos</a>
                            </li>
                        @endif
                        @if(kvfj(Auth::user()->permissions, 'kardex_egress'))
                            <li>
                                <a href="{{ url('/admin/kardex/egress/add') }}" ><i class="fas fa-times-circle"></i> Egresos</a>
                            </li>
                        @endif
                        <li>
                            <a href="{{ url('/admin/dab_75_fr') }}" ><i class="fas fa-file-signature"></i> DAB-75 F.R.</a>
                        </li>
                    </ul>
                </div>

                <div class="inside">
                    <table id="table-modules" class="table table-bordered table-striped" style="background-color:#EDF4FB;">
                        <thead>
                            <tr>
                                <td> <strong> OPCIONES</strong></td>
                                <td><strong>CÓDIGO PPR</strong></td>
                                <td><strong>NOMBRE, DESCRIPCION Y OBSERVACIONES </strong></td>
                                <td><strong>PRESENTACIÓN</strong></td>
                                <td><strong>CANTIDAD DISPONIBLE</strong></td>
                                <td><strong>PRECIO UNITARIO</strong></td>
                                @if(Auth::user()->role == "0") <td><strong>AREA</strong></td> @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kardex as $kardex)
                                <tr>
                                    <td>
                                        <div class="opts">
                                            @if(kvfj(Auth::user()->permissions, 'kardex_edit'))
                                                <a href="{{ url('/admin/kardex/'.$kardex->id.'/edit') }}"  title="Editar"><i class="fas fa-edit"></i></a>
                                            @endif

                                            <a href="{{ url('/admin/kardex/'.$kardex->id.'/record') }}"  title="Historial de Movimientos"><i class="fas fa-history"></i></a>

                                        </div>
                                    </td>
                                    <td>{{$kardex->product->code_ppr}}</td>
                                    <td>{{$kardex->product->name.' / '.$kardex->product->description.' / Obs: '.$kardex->observations}}</td>
                                    <td>{{$kardex->product->presentation}}</td>
                                    <td>{{$kardex->stock}}</td>
                                    <td>{{'Q.'.$kardex->product->price_unit}}</td>
                                    @if(Auth::user()->role == "0") <td>{{$kardex->area->name}}</td> @endif
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var modal = document.getElementById('modelId');

    $(document).ready(function(){
        $('#bt_search').click(function(){

            $('#modelId').modal("show");
        });

        $('#bt_closeModal').click(function(){
            $('#modelId').modal("hide");
        });
    });


</script>

@endsection
