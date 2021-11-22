@extends('admin.master')
@section('title','Kardex Transitorio')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/product/0') }}" class="nav-link"><i class="fas fa-database"></i> Inventario / Bodega</a>
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
                            <a href="{{ url('/admin/products/home/0') }}" ><i class="fas fa-arrow-circle-left"></i> Regresar</a>
                        </li>
                    </ul>
                </div>

                <div class="inside">
                    @foreach($inc as $i)
                        <div class="row">
                            <div class="col-md-6 mtop16">
                                <label for="lastname"> <strong> Fecha de Registro:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::date('no_doc', $i->created_at , ['class'=>'form-control', 'readonly']) !!}
                                </div>
                            </div>

                            <div class="col-md-6 mtop16">
                                <label for="lastname"> <strong> Proveedor:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('no_doc', $i->supplier->name , ['class'=>'form-control', 'readonly']) !!}
                                </div>
                            </div>

                            <div class="col-md-6 mtop16">
                                <label for="lastname"> <strong> Tipo de Documento:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('no_doc',getIngresoBodegaArray(null,$i->type_doc), ['class'=>'form-control', 'readonly']) !!}
                                </div>
                            </div>

                            <div class="col-md-6 mtop16">
                                <label for="lastname"> <strong> Serie de Documento:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('no_doc',$i->serie_doc, ['class'=>'form-control', 'readonly']) !!}
                                </div>
                            </div>

                            <div class="col-md-6 mtop16">
                                <label for="lastname"> <strong> No. Documento:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('no_doc',$i->no_doc, ['class'=>'form-control', 'readonly']) !!}
                                </div>
                            </div>

                            <div class="col-md-6 mtop16">
                                <label for="lastname"> <strong> No. SIAF:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('no_doc',$i->no_siaf, ['class'=>'form-control', 'readonly']) !!}
                                </div>
                            </div>

                            <div class="col-md-6 mtop16">
                                <label for="lastname"> <strong> No. Orden de Compra:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('no_doc',$i->no_oc, ['class'=>'form-control', 'readonly']) !!}
                                </div>
                            </div>
                        </div>

                        <?php $inc_correlativo = $i->no_doc  ?>
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
                            @foreach($inc_det as $it)
                                @if($it->income->no_doc == $inc_correlativo)
                                    <tr>
                                        <td>
                                            Codigo PPR: {{ $it->product->code_ppr }} <br>
                                            Nombre: {{ $it->product->name }} <br>
                                            Descripcion: {{ $it->product->description }}
                                        </td>
                                        <td>{{ $it->amount }}</td>
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
