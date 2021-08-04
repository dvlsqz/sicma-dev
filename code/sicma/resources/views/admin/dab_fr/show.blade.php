@extends('admin.master')
@section('title','Informacion y Detalles DAB-75')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/kardex/all') }}" class="nav-link"><i class="fas fa-server"></i> DAB-75 Fondo Rotativo</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/kardex/income/add') }}" class="nav-link"><i class="fas fa-plus-circle"></i> Vista de Detalles de DAB-75</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">

            <div class="header">
                <h2 class="title"><i class="fas fa-clipboard-list"></i> Detalle de DAB-75</h2>
            </div>

            <div class="inside">

                <div class="row">
                    <div class="col-md-12">
                        <label for="idsupplier">Área:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                            {!! Form::text('no_doc', $dabs->area->name , ['class'=>'form-control', 'readonly']) !!}
                        </div>
                    </div>

                    <div class="col-md-6 mtop16">
                        <label for="type_doc">Tipo de Documento:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                            {!! Form::text('no_doc', 'DAB-75', ['class'=>'form-control', 'readonly']) !!}
                            
                        </div>
                    </div>

                    <div class="col-md-6 mtop16">
                        <label for="name">Numero de Documento:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('no_doc', $dabs->no_doc, ['class'=>'form-control', 'readonly']) !!}
                        </div>
                    </div>

                    <div class="col-md-6 mtop16">
                        <label for="name">IBM Responsable:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('ibm_accountable', $dabs->ibm_accountable, ['class'=>'form-control', 'readonly']) !!}
                        </div>
                    </div>

                    <div class="col-md-6 mtop16">
                        <label for="name">Responsable:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('accountable', $dabs->accountable, ['class'=>'form-control', 'readonly']) !!}
                        </div>
                    </div>                    
                </div>

                <div class="row">
                    <div class="col-md-12 mtop16">
                
                        <table class="table table-striped table-hover" >
                            <thead>
                                <tr>
                                    <td>REGLON</td>
                                    <td>CODIGO PPR</td>
                                    <td>NOMBRE Y DESCRIPCION</td>
                                    <td>CANTIDAD</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($details as $d)
                                    <tr>
                                        <td>{{$d->product->row}}</td>
                                        <td>{{$d->product->code_ppr}}</td>
                                        <td>{{$d->product->name.' '.$d->product->description}}</td>
                                        <td>{{$d->amount }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection