@extends('admin.master')
@section('title','Agregar')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/product/all') }}" class="nav-link"><i class="fas fa-database"></i> Inventario Bodega</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/product/add') }}" class="nav-link"><i class="fas fa-plus-circle"></i> Agregar insumo/herramienta/equipo</a>
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
                                <label for="name"> <strong>Ingrese Código PPR para Bucar: </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('code_ppr', null, ['class'=>'form-control', 'id'=> 'code_ppr']) !!}
                                    <button type="button" id="btn_income_product_search" class="btn btn-warning">
                                        <i class="fas fa-search"></i> Buscar
                                    </button>
                                </div>
                            </div>

                            
                            {!! Form::hidden('pidarticulo', null, ['class'=>'form-control', 'id'=> 'pidarticulo', 'placeholder' => 'Cantidad' ]) !!}
                                

                            <div class="col-md-12 mtop16">
                                <div class="form-group">
                                    <label for="no_doc"> <strong> Nombre: </strong></label>
                                    {!! Form::textarea('particulo', null, ['class'=>'form-control', 'id'=> 'particulo', 'rows'=>'2']) !!}
                                </div>
                            </div>

                            <div class="col-md-12 mtop16">
                                <div class="form-group">
                                    <label for="no_doc"> <strong> Descripción: </strong></label>
                                    {!! Form::textarea('description', null, ['class'=>'form-control','id'=>'description', 'rows'=>'2', 'readonly']) !!}
                                </div>
                            </div>

                            <div class="col-md-12 mtop16">
                                <div class="form-group">
                                    <label for="no_doc"> <strong>Ingrese Cantidad: </strong></label>
                                    {!! Form::text('pcantidad', null, ['class'=>'form-control', 'id'=> 'pcantidad', 'placeholder' => 'Cantidad' ]) !!}
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
                <h2 class="title"><i class="fas fa-plus-circle"></i> <strong> Registrar Ingreso </strong></h2>
            </div>

            <div class="inside">

                {!!Form::open(array('url'=>'/admin/product/income/add','method'=>'POST', 'autocomplete'=>'off'))!!}
                {{Form::token()}}

                    <div class="row">

                        <div class=" col-md-12">
                            <div class="form-group">
                                <label> <strong> Proveedor </strong></label>
                                <select name="idproveedor" id="idsupplier" style="width: 100%;">
                                    @foreach ($suppliers as $s)                                    
                                        <option></option>
                                        <option value="{{$s->id}}">{{$s->nit.' / '.$s->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 mtop16">
                            <div class="form-group">
                                <label> <strong> Tipo Comprobante </strong></label>
                                <select  name="tipo_comprobante" class="form-select">
                                    <option value="0">Factura</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 mtop16">
                            <div class="form-group">
                                <label for="no_doc"> <strong> Serie Comprobante </strong></label>
                                <input type="text" name="serie_doc" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-4 mtop16">
                            <div class="form-group">
                                <label for="no_doc"> <strong> Numero Comprobante </strong></label>
                                <input type="text" name="no_doc" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6 mtop16">
                            <div class="form-group">
                                <label> <strong> Numero de SIAF </strong></label>
                                <input type="text" name="no_siaf" class="form-control" >
                            </div>
                        </div>

                        <div class="col-md-6 mtop16">
                            <div class="form-group">
                                <label for="no_doc"> <strong> Numero de Orden de Compra </strong></label>
                                <input type="text" name="no_oc" class="form-control" >
                            </div>
                        </div>

                    </div>

                    <hr>

                    <p> <strong>Detalle del Ingreso </strong> </p>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                
                                <button type="button" id="bt_search" class="btn btn-info">
                                    Agregar Producto
                                </button>
                            </div>
                        </div>

                    </div>

                    <div class="card-body table-responsive">
                        <table id="detalles" class= "table table-striped table-bordered table-condensed table-hover">
                            <thead style="background-color: #c3f3ea">
                                <th><strong>ELIMINAR</strong></th>
                                <th><strong>PRODUCTO</strong></th>
                                <th><strong>CANTIDAD</strong></th>
                            </thead>

                            <tbody>

                            </tbody>
                        </table>
                    </div>

                    <div class=" col-md-6 " id="guardar">
                        <div class="form-group">
                            <input name="_token" value="{{ csrf_token() }}" type="hidden"></input>
                            <button class="btn btn-success" type="submit"> Guardar </button>
                            <button class="btn btn-danger" type="reset"> Cancelar </button>
                        </div>
                    </div>


                {!!Form::close()!!}
            </div>
        </div>
    </div>

        

    <script> 
        var modal = document.getElementById('modelId');
        var cont=0;
        total=0;
        subtotal=[];
        $("#guardar").hide();

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
            cantidad=$("#pcantidad").val();

            if (idarticulo!="" && cantidad!="" && cantidad>0 ){
                var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'"></td></tr>';
                cont++;
                limpiar();
                evaluar();
                $('#detalles').append(fila);
            }else{
                alert("Error al ingresar el detalle del ingreso, revise los datos del articulo")
            }
        }

        function limpiar(){
            $("#code_ppr").val("");
            $("#pidarticulo").val("");
            $("#particulo").val("");
            $("#pcantidad").val("");
        }

        function evaluar()
        {
            if (cont >0){
                $("#guardar").show();
            }else{
                $("#guardar").hide();
            }
        }

        function eliminar(index){
            $("#fila" + index).remove();
            evaluar();
        }

    </script>


@endsection