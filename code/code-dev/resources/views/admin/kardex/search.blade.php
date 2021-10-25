@extends('admin.master')
@section('title','Kardex Transitorio')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/kardex/all') }}" class="nav-link"><i class="fas fa-database"></i> Kardex Transitorio</a>
    </li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel shadow">

                <div class="header">
                    <h2 class="title"><i class="fas fa-database"></i> Información del Ingreso</h2>
                    <ul>
                        <li>
                            <a href="{{ url('/admin/kardex/all') }}" ><i class="fas fa-arrow-circle-left"></i> Regresar</a>
                        </li>
                    </ul>
                </div>

                <div class="inside">
                    @foreach($dab as $d)
                        <div class="row">
                            <div class="col-md-6 mtop16">
                                <label for="lastname"> <strong> Fecha de Registro:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::date('no_doc', $d->created_at , ['class'=>'form-control', 'readonly']) !!}
                                </div>
                            </div>

                            <div class="col-md-6 mtop16">
                                <label for="lastname"> <strong> Numero de DAB-75:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::number('no_doc', $d->no_doc , ['class'=>'form-control', 'readonly']) !!}
                                </div>
                            </div>

                            <div class="col-md-12 mtop16">
                                <label for="lastname"> <strong> Responsable:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('no_doc', $d->user->name.' '.$d->user->lastname , ['class'=>'form-control', 'readonly']) !!}
                                </div>
                            </div>
                        </div>

                        <?php $dab_correlativo = $d->no_doc  ?>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="row mtop16">
        <div class="col-md-12">
            <div class="panel shadow">

                <div class="header">
                    <h2 class="title"><i class="fas fa-database"></i> Detalle del Ingreso</h2>
                </div>

                <div class="inside">
                    <table id="table-modules" class="table table-bordered table-striped" style="background-color:#EDF4FB;">
                        <thead>
                            <tr>
                                <td><strong>PRODUCTO</strong></td>
                                <td><strong>CANTIDAD</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dab_det as $dt)
                                @if($dt->income->no_doc == $dab_correlativo)
                                    <tr>
                                        <td>
                                            Codigo PPR: {{ $dt->kardex->product->code_ppr }} <br>
                                            Nombre: {{ $dt->kardex->product->name }} <br>
                                            Descripcion: {{ $dt->kardex->product->description }}
                                        </td>
                                        <td>{{ $dt->amount }}</td>
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


@endsection
