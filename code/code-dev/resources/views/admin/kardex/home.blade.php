@extends('admin.master')
@section('title','Kardex Transitorio')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/kardex/all') }}" class="nav-link"><i class="fas fa-database"></i> Kardex Transitorio</a>
    </li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="panel shadow">

        <div class="header">
            <h2 class="title"><i class="fas fa-database"></i> Kardex Transitorio</h2>
            <ul>
                <li>
                    <a href="#" id="btn_search" ><i class="fas fa-search"></i> Buscar DAB-75</a>
                </li>
                @if(kvfj(Auth::user()->permissions, 'kardex_add'))
                    <li>
                        <a href="{{ url('/admin/kardex/add') }}" ><i class="fas fa-plus-circle"></i> Agregar</a>
                    </li>
                @endif
                @if(kvfj(Auth::user()->permissions, 'kardex_income'))
                    <li>
                        <a href="{{ url('/admin/kardex/income/add') }}" ><i class="fas fa-plus-circle"></i> Ingresos</a>
                    </li>
                @endif
                @if(kvfj(Auth::user()->permissions, 'kardex_egress'))
                    <li>
                        <a href="{{ url('/admin/kardex/egress/add') }}" ><i class="fas fa-times-circle"></i> Egresos</a>
                    </li>
                @endif
                <li>
                    <a href="{{ url('/admin/dab_75_fr') }}" ><i class="fas fa-file-signature"></i> DAB-75 F.R.</a>
                </li>
            </ul>
        </div>

        <div class="inside">
            <div class="form_search" id="form_search">
                {!! Form::open(['url'=> '/admin/kardex/dab/search']) !!}
                <div class="row">
                    <div class="col-md-10">
                        {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el número de DAB-75 a Buscar', 'required']) !!}
                    </div>
                    <div class="col-md-2">
                        {!! Form::submit('Buscar', ['class'=>'btn btn-primary']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>

            <table id="table-modules" class="table table-bordered table-striped" style="background-color:#EDF4FB;">
                <thead>
                    <tr>
                        <td><strong>OPCIONES</strong></td>
                        <td><strong>CÓDIGO PPR</strong></td>
                        <td><strong>NOMBRE, DESCRIPCION Y OBSERVACIONES </strong></td>
                        <td><strong>PRESENTACIÓN</strong></td>
                        <td><strong>CANTIDAD DISPONIBLE</strong></td>
                        <td><strong>PRECIO UNITARIO</strong></td>
                        @if(Auth::user()->role == "0") <td><strong>AREA</strong></td> @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($kardex as $kardex)
                        <tr>
                            <td>
                                <div class="opts">
                                    @if(kvfj(Auth::user()->permissions, 'kardex_edit'))
                                        <a href="{{ url('/admin/kardex/'.$kardex->id.'/edit') }}"  title="Editar"><i class="fas fa-edit"></i></a>
                                    @endif

                                    <a href="{{ url('/admin/kardex/'.$kardex->id.'/record') }}"  title="Historial de Movimientos"><i class="fas fa-history"></i></a>

                                </div>
                            </td>
                            <td>{{$kardex->product->code_ppr}}</td>
                            <td>{{$kardex->product->name.' / '.$kardex->product->description.' / Obs: '.$kardex->observations}}</td>
                            <td>{{$kardex->product->presentation}}</td>
                            <td>{{$kardex->stock}}</td>
                            <td>{{'Q.'.$kardex->product->price_unit}}</td>
                            @if(Auth::user()->role == "0") <td>{{$kardex->area->name}}</td> @endif
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
