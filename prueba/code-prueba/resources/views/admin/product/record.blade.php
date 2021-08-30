@extends('admin.master')
@section('title','Historial de Movimientos')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/product/all') }}" class="nav-link"><i class="fas fa-database"></i> Inventario / Bodega</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="page_user">
            <div class="row">

                <div class="col-md-12">
                    <div class="card card-success card-tabs">
                        <div class="card-header p-0 pt-1 border-bottom-0">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item"><a class="nav-link active" href="#Incomes" id="custom-tabs-three-incomes-tab" data-toggle="pill"  role="tab" aria-controls="custom-tabs-three-incomes" aria-selected="true"><i class="fas fa-list-alt"></i> Historial de Ingresos</a></li>
                                <li class="nav-item"><a class="nav-link" href="#Egress" id="custom-tabs-three-egress-tab" data-toggle="pill"  role="tab" aria-controls="custom-tabs-three-egress" aria-selected="false"><i class="fas fa-list-alt"></i> Historial de Egresos</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="tab-incomes-egress">
                                <div class="tab-pane fade show active" id="Incomes" role="tabpanel" aria-labelledby="custom-tabs-three-incomes-tab">
                                    <div class="panel shadow">
                                        <div class="inside">
                                            <table id="table-modules" class="table table-bordered table-striped" style="background-color:#EDF4FB;">
                                                <thead>
                                                    <tr>
                                                        <td><strong>FECHA</strong></td>
                                                        <td><strong>PROVEEDOR</strong></td>
                                                        <td><strong>DOCUMENTO</strong></td>
                                                        <td><strong>CANTIDAD</strong></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($incomes_details_products as $idp)
                                                        @if($idp->idproduct == $idproduct)
                                                            <tr>
                                                                <td>{{$idp->income->created_at}}</td>
                                                                <td>{{$idp->income->supplier->name}}</td>
                                                                <td>{{getIngresoBodegaArray(null,$idp->income->type_doc).' Serie. '.$idp->income->serie_doc.' No. '.$idp->income->no_doc}}</td>
                                                                <td>{{$idp->amount}}</td>
                                                            </tr>
                                                        @endif 
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="Egress" role="tabpanel" aria-labelledby="custom-tabs-three-egress-tab">
                                    <div class="panel shadow">
                                        <div class="inside">
                                            <table id="table-modules1" class="table table-bordered table-striped" style="background-color:#EDF4FB;">
                                                <thead>
                                                    <tr>
                                                        <td> <strong> FECHA</strong></td>
                                                        <td><strong>SERVICIO</strong></td>
                                                        <td><strong>DOCUMENTO</strong></td>
                                                        <td><strong>CANTIDAD</strong></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($egress_details_products as $edp)
                                                        @if($edp->idproduct == $idproduct)
                                                            <tr>
                                                                <td>{{$edp->egress->created_at}}</td>
                                                                <td>{{$edp->egress->ma->name}}</td>
                                                                <td>{{getEgresoBodegaArray(null,$edp->egress->type_doc).' NO. '.$edp->egress->no_doc}}</td>
                                                                <td>{{$edp->amount}}</td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
