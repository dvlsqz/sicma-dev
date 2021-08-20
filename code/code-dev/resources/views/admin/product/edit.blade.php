@extends('admin.master')
@section('title','Editar Inventario')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/product/all') }}" class="nav-link"><i class="fas fa-database"></i> Inventario / Bodega</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-info-circle"></i> Información Actual</h2>
                </div>

                <div class="inside">
                    {!! Form::open(['url'=> '/admin/product/'.$product->id.'/edit']) !!}
                    <div class="row">

                        <div class="col-md-6">
                            <label for="lastname"> <strong> Código Financiero/PPR: </strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::text('code_ppr', $product->code_ppr, ['class'=>'form-control']) !!}
                            </div>                            
                        </div>

                        <div class="col-md-6">
                            <label for="lastname"> <strong> Reglón Presupuestario: </strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::text('row', $product->row, ['class'=>'form-control']) !!}
                            </div>                            
                        </div>

                        <div class="col-md-12 mtop16">
                            <label for="name"> <strong>Nombre: </strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::text('name', $product->name, ['class'=>'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-6 mtop16">
                            <label for="lastname"><strong> Cantidad Disponible Inicial: </strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::number('stock', $product->stock, ['class'=>'form-control', 'min' => '0']) !!}
                            </div>
                        </div>

                        <div class="col-md-6 mtop16">
                            <label for="ibm"> <strong>Presentación: </strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::text('presentation', $product->presentation, ['class'=>'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-6 mtop16">
                            <label for="name"> <strong>Precio Unitario (Q.): </strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::number('price_unit', $product->price_unit, ['class'=>'form-control', 'min'=>'0.00', 'step'=>'0.01']) !!}
                            </div>
                        </div>                       

                        <div class="col-md-6 mtop16">
                            <label for="lastname"><strong>Tipo: </strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::select('type', getTipoBodegaArray('list', null), $product->type,['class'=>'form-select']) !!}
                            </div>
                        </div>

                        <div class="col-md-6 mtop16">
                            <label for="name"> <strong>Fecha de Producción: </strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {{ Form::date('date_prod', $product->date_prod, ['class' => 'form-control']) }}
                            </div>
                        </div>

                        <div class="col-md-6 mtop16">
                            <label for="name"><strong> Fecha de Vencimiento: </strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {{ Form::date('date_ven', $product->date_ven, ['class' => 'form-control']) }}
                            </div>
                        </div>

                        <div class="col-md-12 mtop16">
                            <label for="ibm"><strong> Descripción: </strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::textarea('description', $product->description, ['class'=>'form-control', 'rows'=>'2']) !!}
                            </div>
                        </div>
                    </div>  
                    
                    <div class="row mtop16">
                        <div class="input-group">
                            {!! Form::submit('Guardar', ['class'=>'btn btn-success']) !!}&nbsp;
                            <a href="{{ url('/admin/products/all') }}" class="btn btn-danger">Cancelar</a>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                
                        
            </div>
        </div>        
    </div>
@endsection
