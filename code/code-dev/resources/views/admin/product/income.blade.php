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

                    <div class="row">
                        <div class="col-md-5 mtop16">
                            <div class="form">
                                <label> <strong> Articulo </strong></label>
                                <select name="pidarticulo" id="pidarticulo" class="form-control" >
                                    @foreach($products as $p)
                                        <option></option>
                                        <option value="{{$p->id}}">{{'ppr: '.$p->code_ppr.' - '.$p->name.' - '.$p->description}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-5 mtop16">
                            <div class="form-group">
                                <label for="cantidad"> <strong> Cantidad </strong></label>
                                <input type="number" name="pcantidad" id="pcantidad" class="form-control" placeholder="Cantidad">
                            </div>
                        </div>

                        <div class="col-md-2 mtop16">
                        <div class="form-group">
                            <button type="button" id="bt_add" class="btn btn-primary">
                                Agregar
                            </button>
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
                            <button class="btn btn-primary" type="submit"> Guardar </button>
                            <button class="btn btn-danger" type="reset"> Cancelar </button>
                        </div>
                    </div>


                {!!Form::close()!!}
            </div>
        </div>
    </div>

        

    <script> 
        $(document).ready(function(){
            $('#bt_add').click(function(){
            agregar();
            });
        });


        var cont=0;
        total=0;
        subtotal=[];
        $("#guardar").hide();

        function agregar(){
            idarticulo=$("#pidarticulo").val();
            articulo=$("#pidarticulo option:selected").text();
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