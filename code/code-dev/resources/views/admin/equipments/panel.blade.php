@extends('admin.master')
@section('title','Panel Equipo')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/equipments/all') }}" class="nav-link"><i class="fas fa-columns"></i> Equipos</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/equipment/'.$equipment->id.'/edit') }}" class="nav-link"><i class="fas fa-plus-circle"></i> Panel del Equipo: <b> {{ $equipment->name }} </b></a>
    </li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="page_user">
        <div class="row ">
            <div class="col-md-2 d-flex mb16">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-info-circle"></i> Código QR</h2>
                    </div>

                    <div class="inside">
                        <div class="mini_profile">

                            <div class="info">
                                <div class="input-group" style="align-items: center;">
                                    {!! QrCode::size(125)->generate('http://10.11.0.30:8500/admin/equipment/'.$equipment->id.'/edit'); !!}
                                </div>
                                <br><a href="{{ url('/admin/equipment/'.$equipment->id.'/print_label') }}" target="_blank"  title="Imprimir Etiqueta" class="btn btn-outline-primary"><i class="fas fa-print"></i> Imprimir</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-10 d-flex mb16">
                <div class="panel shadow ">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-info-circle"></i> Información</h2>
                    </div>

                    <div class="inside">
                        <div class="mini_profile">

                            <div class="info">
                                <div class="row">
                                    <div class="col-md-4">
                                        <span class="title"><i class="fas fa-arrow-right"></i> No. Bien:</span>
                                        <span class="text"> {{ $equipment->no_bien }} </span>
                                    </div>

                                    <div class="col-md-4">
                                        <span class="title"><i class="fas fa-arrow-right"></i> Código:</span>
                                        <span class="text"> {{ $equipment->code_new }} </span>
                                    </div>

                                    <div class="col-md-4">
                                        <span class="title"><i class="fas fa-arrow-right"></i> Nombre:</span>
                                        <span class="text"> {{ $equipment->name }} </span>
                                    </div>

                                    <div class="col-md-4">
                                        <span class="title"><i class="fas fa-arrow-right"></i> Marca:</span>
                                        <span class="text"> {{ $equipment->brand }} </span>
                                    </div>

                                    <div class="col-md-4">
                                        <span class="title"><i class="fas fa-arrow-right"></i> Modelo:</span>
                                        <span class="text"> {{ $equipment->model }} </span>
                                    </div>

                                    <div class="col-md-4">
                                        <span class="title"><i class="fas fa-arrow-right"></i> Serie:</span>
                                        <span class="text"> {{ $equipment->serie }} </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mtop16">
            <div class="col-md-2 d-flex mb16">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-info-circle"></i> Acciones</h2>
                    </div>

                    <div class="inside">
                        <div class="mini_profile">

                            <div class="info">
                                <a href="{{ url('/admin/equipment/'.$equipment->id.'/edit') }}" target="_blank"  title="Editar" class="btn btn-outline-warning"><i class="fas fa-edit"></i> Editar Información</a>
                                <a href="{{ url('/admin/equipment/'.$equipment->id.'/data_sheet') }}" target="_blank"  title="Ficha Tecnica" class="btn btn-outline-secondary"><i class="fas fa-file-invoice"></i> Generar Ficha Tecnica</a>
                                <a href="{{ url('/admin/equipment/'.$equipment->id.'/data_sheet') }}" target="_blank"  title="Ficha Tecnica" class="btn btn-outline-dark"><i class="fas fa-tools"></i> Planificar Mantenimiento</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5 d-flex mb16">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-info-circle"></i> Partes del Equipo</h2>
                    </div>

                    <div class="inside">
                        <table class="table table-bordered table-striped" >
                            <thead>
                                <tr>
                                    <td><strong>Cantidad</strong></td>
                                    <td><strong>Nombre</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($parts as $p)
                                    <tr>
                                        <td>{{ $p->amount_part }}</td>
                                        <td>{{ $p->name_part }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-5 d-flex mb16">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-info-circle"></i> Conexiones a Otros Equipos</h2>
                    </div>

                    <div class="inside">
                        <table class="table table-bordered table-striped" >
                            <thead>
                                <tr>
                                    <td><strong>Cantidad</strong></td>
                                    <td><strong>Nombre</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($conecctions as $conecction)
                                    <td>{{ $conecction->equipment->name }}</td>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mtop16">
            <div class="col-md-2 d-flex mb16">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-info-circle"></i> Acciones</h2>
                    </div>

                    <div class="inside">
                        <div class="mini_profile">

                            <div class="info">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-10 d-flex mb16">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-info-circle"></i> Historial de Movimientos</h2>
                    </div>

                    <div class="inside">
                        <table class="table table-bordered table-striped" >
                            <thead>
                                <tr>
                                    <td><strong>Fecha</strong></td>
                                    <td><strong>Ambiente</strong></td>
                                    <td><strong>Motivo</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transfers as $t)
                                    <tr>
                                        <td >{{ $t->date }}</td>
                                        <td colspan="2">
                                            Servicio General: {{ $t->servicegeneral->name}} <br>
                                            Servicio: {{ $t->service->level.' - '.$t->service->name }} <br>
                                            Ambiente: {{ $t->environment->code.' - '.$t->environment->name}}
                                        </td>
                                        <td> {{ $t->reason }} </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mtop16">
            <div class="col-md-12 d-flex mb16">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-info-circle"></i> Mantenimientos Realizados</h2>
                    </div>

                    <div class="inside">

                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
@endsection
