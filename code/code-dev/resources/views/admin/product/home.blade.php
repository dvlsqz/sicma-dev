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
                                    <i class="fas fa-filter"></i> Filtrar <span class="caret"></span>
                            </button>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{url('/admin/product/0')}}"><i class="fas fa-filter"></i> Insumos</a></li>
                                <li><a href="{{url('/admin/product/1')}}"><i class="fas fa-filter"></i> Herramientas</a></li>
                                <li><a href="{{url('/admin/product/2')}}"><i class="fas fa-filter"></i> Repuestos</a></li>
                                <li><a href="{{url('/admin/products/all')}}"><i class="fas fa-filter"></i> Todos</a></li>
                            </ul>
                        </div>
                    </li>
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
                <table class="table table-bordered table-striped " id="yajra-datatable">
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

                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <script type="text/javascript">
        $(function () { 
            var table = $('#yajra-datatable').DataTable({
                language: {"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"},
                processing: true,
                serverSide: true,
                paging: true,
                ajax: "{{ route('products_index') }}"
                columns: [
                    {data: 'row', name: 'row'}            
                ]
            });
        });
    </script>
    

    
@endsection
    

