@extends('admin.master')
@section('title','ING-7')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/ing_7') }}" class="nav-link"><i class="fas fa-copy"></i> ING-7</a>
    </li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="panel shadow">

        <div class="header">
            <h2 class="title"><i class="fas fa-clipboard-list"></i> Listado de Materiales Usados en ING-7 No. {{$ing7->correlative}}  </h2>
            <ul>


            </ul>
        </div>

        <div class="inside">

            <table id="table-modules" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <td><strong> FECHA DE EGRESO </strong></td>
                        <td><strong> DESCRIPCION </strong></td>
                        <td><strong> UNIDAD </strong></td>
                        <td><strong> CANTIDAD </strong></td>
                        <td><strong> PRECIO UNITARIO  </strong></td>
                        <td><strong> SUBTOTAL  </strong></td>
                    </tr>
                </thead>
                <tbody>
                    <?php $sum_tot_Price = 0 ?>
                    @foreach($egress as $e)
                        @if($e->egress->iding7 == $ing7->id)
                            <tr>
                                <td> {{ \Carbon\Carbon::parse($e->egress->created_at)->format('d/m/Y') }}</td>
                                <td>
                                    {{ 'Codigo PPR: '.$e->kardex->product->code_ppr}} <br>
                                    {{ 'Nombre: '.$e->kardex->product->name }} <br>
                                    {{ 'Descripcion: '.$e->kardex->product->description}}
                                </td>
                                <td>{{ $e->kardex->product->presentation }}</td>
                                <td>{{ $e->amount }}</td>
                                <td>{{ number($e->kardex->product->price_unit) }}</td>
                                <td>{{ number($e->kardex->product->price_unit * $e->amount) }}</td>
                            </tr>
                            <?php $sum_tot_Price += $e->kardex->product->price_unit * $e->amount ?>
                        @endif
                    @endforeach
                    <tr>
                        <td colspan="4"></td>
                        <td><strong>TOTAL GASTADO: </strong></td>
                        <td><strong>{{ number($sum_tot_Price)}} </strong> </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection
