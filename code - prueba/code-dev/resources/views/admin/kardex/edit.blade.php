<?php
    use \App\Http\Controllers\Admin\KardexController;
?>
@extends('admin.master')
@section('title','Editar Kardex')

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
                        <h2 class="title"><i class="fas fa-info-circle"></i> Información Actual</h2>
                    </div>

                    <div class="inside">
                        {!! Form::open(['url'=> '/admin/kardex/'.$kardex->id.'/edit']) !!}
                        <div class="row">
                            <div class="col-md-6">
                                <label for="lastname"> <strong> Código Interno: </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('id_mantenimiento', $kardex->code_mantto_int , ['class'=>'form-control' , 'readonly']) !!}
                                </div>                            
                            </div>

                            <div class="col-md-6">
                                <label for="lastname"> <strong> Nombre: </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('name', $kardex->product->name , ['class'=>'form-control', 'readonly']) !!}
                                </div>                                 
                            </div>

                            <div class="col-md-6 mtop16">
                                <label for="lastname"> <strong> Tipo: </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('type', getTipoBodegaArray(null, $kardex->product->type) , ['class'=>'form-control', 'readonly']) !!}
                                </div> 
                            </div>

                            <div class="col-md-6 mtop16">
                                <label for="lastname"> <strong>  Presentación:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('presentation', $kardex->product->presentation , ['class'=>'form-control', 'readonly']) !!}
                                </div>
                            </div>

                            <div class="col-md-6 mtop16">
                                <label for="lastname"> <strong>  Fecha de Produccion:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::date('date', $kardex->product->date_prod , ['class'=>'form-control', 'readonly']) !!}
                                </div>
                            </div>

                            <div class="col-md-6 mtop16">
                                <label for="lastname"> <strong>  Fecha de Vencimiento:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::date('date', $kardex->product->date_ven , ['class'=>'form-control', 'readonly']) !!}
                                </div>
                            </div>

                            <div class="col-md-4 mtop16">
                                <label for="lastname"> <strong>  Cantidad Disponible:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('stock_min', $kardex->stock , ['class'=>'form-control', 'readonly']) !!}
                                </div>                                
                            </div>

                            <div class="col-md-4 mtop16">
                                <label for="lastname"> <strong>  Precio Unitario (Q):</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('price_unit', $kardex->product->price_unit , ['class'=>'form-control', 'readonly']) !!}
                                </div>
                            </div>

                            <div class="col-md-4 mtop16">
                                <label for="lastname"> <strong>  Precio Total (Q):</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('price_unit', $kardex->product->price_unit * $kardex->stock , ['class'=>'form-control', 'readonly']) !!}
                                </div>
                            </div>

                            <div class="col-md-12 mtop16">
                                <label for="lastname"> <strong>  Descripción:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::textarea('description', $kardex->product->description , ['class'=>'form-control','rows'=>'2', 'readonly']) !!}
                                </div>                                 
                            </div>

                            <div class="col-md-12 mtop16">
                                <label for="lastname"> <strong>  Observaciones:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::textarea('observations', $kardex->observations , ['class'=>'form-control','rows'=>'2']) !!}
                                </div>                                
                            </div>

                            <div class="row mtop16">
                                <div class="input-group">
                                    {!! Form::submit('Guardar', ['class'=>'btn btn-success']) !!}&nbsp;
                                    <a href="{{ url('admin/kardex/all') }}" class="btn btn-danger">Cancelar</a>
                                </div>
                            </div>

                        </div>
                        {!! Form::close() !!}
                            
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
