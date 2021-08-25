@extends('admin.master')
@section('title','Agregar')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/kardex/all') }}" class="nav-link"><i class="fas fa-server"></i> Kardex</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/kardex/income/add') }}" class="nav-link"><i class="fas fa-plus-circle"></i> Agregar Ingreso</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">

            <div class="header">
                <h2 class="title"><i class="fas fa-plus-circle"></i> Registrar Ingreso</h2>
            </div>

            <div class="inside">
                {!!Form::open(array('url'=>'/admin/kardex/income/add','method'=>'POST', 'autocomplete'=>'off'))!!}
                {{Form::token()}}

                <div class="row">
                    <div class="col-md-12">
                        <label for="idsupplier"><strong> Área: </strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                            <select name="idsupplier" id="idsupplier" style="width: 96%" >
                                @foreach ($maintenance_areas as $ma)
                                    <option value=""></option>
                                    <option value="{{$ma->id}}">{{$ma->code.' - '.$ma->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6 mtop16">
                        <label for="type_doc"><strong> Tipo de Documento: </strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                            {!! Form::select('type_doc', getFormaKardexIncomeArray('list',null), null,['class'=>'form-select']) !!}
                        </div>
                    </div>

                    <div class="col-md-6 mtop16">
                        <label for="name"><strong> Numero de Documento: </strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('no_doc', null, ['class'=>'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-md-6 mtop16">
                        <label for="name"><strong> IBM Responsable: </strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('ibm-accountable', null, ['class'=>'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-md-6 mtop16">
                        <label for="name"><strong> Responsable: </strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('accountable', null, ['class'=>'form-control']) !!}
                        </div>
                    </div>                    
                </div>
                
                    <div class="row">
                        <div class="col-md-6 mtop16">
                            <div class="form">
                                <label><strong> Articulo: </strong></label>
                                <select name="pidarticulo" id="pidarticulo" class="form-select">
                                    @foreach($kardex as $k)
                                        <option value=""></option>
                                        <option value="{{$k->id}}">{{'ppr: '.$k->product->code_ppr.' - '.$k->product->name.' - '.$k->product->description}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-5 mtop16">
                            <div class="form-group">
                                <label for="cantidad"><strong> Cantidad: </strong></label>
                                <input type="number" name="pcantidad" id="pcantidad" class="form-control" placeholder="Cantidad">
                            </div>
                        </div>

                        <div class="col-md-1 mtop16">
                        <div class="form-group">
                            <button type="button" id="bt_add" class="btn btn-primary">
                                Agregar
                            </button>
                        </div>
                    </div>

                    <div class="card-body table-responsive">
                        <table id="detalles" class= "table table-striped table-bordered table-condensed table-hover">
                            <thead style="background-color: #c3f3ea">
                                <th><strong> ELIMINAR </strong></th>
                                <th><strong> PRODUCTO </strong></th>
                                <th><strong> CANTIDAD </strong></th>
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