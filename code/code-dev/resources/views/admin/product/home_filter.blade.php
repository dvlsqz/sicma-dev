@extends('admin.master')
@section('title','Inventario / Bodega')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/product/1') }}" class="nav-link"><i class="fas fa-database"></i> Inventario / Bodega</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">

        <div class="header">
                <h2 class="title"><i class="fas fa-database"></i> Inventario / Bodega</h2>
                <ul>
                    <li>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle"
                                    data-toggle="dropdown">
                                    <i class="fas fa-filter"></i>  Filtrar <span class="caret"></span>
                            </button>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{url('/admin/product/0')}}">Insumos</a></li>
                                <li><a href="{{url('/admin/product/1')}}"> Herramientas</a></li>
                                <li><a href="{{url('/admin/product/2')}}"> Repuestos</a></li>
                                <li><a href="{{url('/admin/product/3')}}"> Sin Código PPR</a></li>
                                <li><a href="{{url('/admin/product/4')}}"> Con Disponibilidad</a></li>
                                <li><a href="{{url('/admin/products/home/0')}}"> Todos</a></li>
                            </ul>
                        </div>
                    </li>

                    @include('admin.product.renglones')

                    @if(kvfj(Auth::user()->permissions, 'product_add'))
                        <li>
                            <a href="{{ url('/admin/product/add') }}" ><i class="fas fa-plus-circle"></i> Agregar</a>
                        </li>
                    @endif
                    @if(kvfj(Auth::user()->permissions, 'product_income'))
                        <li>
                            <a href="{{ url('/admin/product/income/add') }}" ><i class="fas fa-plus-circle"></i> Ingresos</a>
                        </li>
                    @endif
                    @if(kvfj(Auth::user()->permissions, 'product_egress'))
                        <li>
                            <a href="{{ url('/admin/product/egress/add') }}" ><i class="fas fa-times-circle"></i> Egresos</a>
                        </li>
                    @endif
                    @if(kvfj(Auth::user()->permissions, 'suppliers'))
                        <li>
                            <a href="{{ url('/admin/suppliers') }}"><i class="fas fa-users"></i> Proveedores</a>
                        </li>
                    @endif
                </ul>
            </div>

            <div class="inside">
                <table id="table-modules" class="table table-bordered table-striped" style="background-color:#EDF4FB;">
                    <thead>
                        <tr>
                            <td width="24px"><strong>OPCIONES</strong></td>
                            <td width="120px"><strong>REGLÓN y CODIGO PPR</strong></td>
                            <td><strong>NOMBRE y DESCRIPCION</strong></td>
                            <td><strong>PRESENTACIÓN</strong></td>
                            <td width="120px"><strong>CANTIDAD DISPONIBLE</strong></td>
                            <td width="120px"><strong>PRECIO UNITARIO</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($product as $p)
                            <tr>
                                <td>
                                    <div class="opts">
                                        @if(kvfj(Auth::user()->permissions, 'product_edit'))
                                            <a href="{{ url('/admin/product/'.$p->id.'/edit') }}"  title="Editar"><i class="fas fa-edit"></i></a>
                                        @endif

                                        <a href="{{ url('/admin/product/'.$p->id.'/record') }}"  title="Historial de Movimientos"><i class="fas fa-history"></i></a>
                                    </div>
                                </td>
                                <td>{{$p->row.' / '.$p->code_ppr}}</td>
                                <td>{{$p->name.' / '.$p->description}}</td>
                                <td>{{$p->presentation}}</td>
                                <td>{{$p->stock}}</td>
                                <td>{{'Q.'.$p->price_unit}}</td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>

        </div>
    </div>
    
@endsection
