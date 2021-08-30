@extends('admin.master')
@section('title','Agregar')
<script src="{{ asset('js/jQuery-2.1.4.min.js') }}" type="text/javascript"></script>

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/kardex/all') }}" class="nav-link"><i class="fas fa-database"></i> Kardex Transitorio</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/kardex/add') }}" class="nav-link"><i class="fas fa-plus-circle"></i> Agregar</a>
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
                            <h5 class="modal-title">Agregar Producto/Insumo al Detalle</h5>
                        </div>
                        
                        <div class="modal-body">

                            <div class="col-md-12">
                                <label for="name"> <strong>Ingrese Código PPR para Buscar: </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('code_ppr', null, ['class'=>'form-control', 'id'=> 'code_ppr']) !!}
                                    <button type="button" id="btn_add_product_search" class="btn btn-warning">
                                        <i class="fas fa-search"></i> Buscar
                                    </button>
                                </div>
                            </div>

                                                            

                            {!! Form::hidden('pidarticulo', null, ['class'=>'form-control', 'id'=> 'pidarticulo', 'placeholder' => 'Cantidad' ]) !!}
                                

                            <div class="col-md-12 mtop16">
                                <div class="form-group">
                                    <label for="no_doc"> <strong> Nombre: </strong></label>
                                    {!! Form::textarea('particulo', null, ['class'=>'form-control', 'id'=> 'particulo', 'rows'=>'3']) !!}
                                </div>
                            </div>

                            <div class="col-md-12 mtop16">
                                <div class="form-group">
                                    <label for="no_doc"> <strong> Descripción: </strong></label>
                                    {!! Form::textarea('description', null, ['class'=>'form-control','id'=>'description', 'rows'=>'3']) !!}
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" id="bt_closeModal" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" id="bt_add" class="btn btn-primary">Agregar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="header">
                <h2 class="title"><i class="fas fa-plus-circle"></i> Agregar</h2>

            </div>

            <div class="inside">
                {!! Form::open(['url'=>'/admin/kardex/add']) !!}
                    <div class="row ">

                        <div class="col-md-6">
                            <div class="input-group">
                                
                                <button type="button" id="bt_search" class="btn btn-info">
                                    Buscar Producto
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mtop16">

                        {!! Form::hidden('idproduct', null, ['class'=>'form-control', 'id'=> 'idproduct']) !!}

                        <div class="col-md-6 ">
                            <label for="ibm"><strong> Nombre del Producto: </strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::textarea('nombrep', null, ['class'=>'form-control', 'id'=> 'nombrep', 'rows'=>'2', 'readonly']) !!}
                            </div>
                        </div>

                        <div class="col-md-6 ">
                            <label for="ibm"><strong> Descripción del Producto: </strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::textarea('descriptionp', null, ['class'=>'form-control','id'=>'descriptionp', 'rows'=>'2', 'readonly']) !!}
                            </div>
                        </div>

                        <div class="col-md-4 mtop16">
                            <label for="lastname"><strong> Área: </strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                <select name="idmaintenancearea" id="idmaintenancearea" class="form-control ">
                                    @foreach ($maintenance_areas as $ma)                                        
                                        <option value="{{$ma->id}}">{{$ma->code.' - '.$ma->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> 

                        <div class="col-md-4 mtop16">
                            <label for="ibm"><strong> Código Interno Mantenimiento: </strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::text('code_mantto_int', null, ['class'=>'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-4 mtop16">
                            <label for="lastname"><strong> Existencia: </strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::number('stock', 0, ['class'=>'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-12 mtop16">
                            <label for="ibm"><strong> Observaciones: </strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::textarea('observations', null, ['class'=>'form-control', 'rows'=>'2']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row mtop16">
                        <div class="input-group">
                            {!! Form::submit('Guardar', ['class'=>'btn btn-success']) !!}&nbsp;
                            <a href="{{ url('admin/kardex/all') }}" class="btn btn-danger">Cancelar</a>
                        </div>
                    </div>

                {!! Form::close() !!}
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
            });

            $('#bt_closeModal').click(function(){
                $('#modelId').modal("hide");
            });
        });

        function agregar(){
            idarticulo=$("#pidarticulo").val();
            articulo=$("#particulo").val();
            description=$("#description").val();

            $("#idproduct").val(idarticulo);
            $("#nombrep").val(articulo);
            $("#descriptionp").val(description);

            $('#modelId').modal("hide");
            limpiar();
        }

        function limpiar(){
            $("#code_ppr").val("");
            $("#pidarticulo").val("");
            $("#particulo").val("");
            $("#description").val("");
        }
        

    </script>


@endsection
