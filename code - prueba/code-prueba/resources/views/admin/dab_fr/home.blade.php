@extends('admin.master')
@section('title','DAB-75 F.R.')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/dab_75_fr/add') }}" class="nav-link"><i class="fas fa-file-signature"></i> DAB-75 para Fondo Rotativo</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">

        <div class="header">
                <h2 class="title"><i class="fas fa-file-signature"></i> Control de DAB-75 para Fondo Rotativo </h2>
                <ul>
                    @if(kvfj(Auth::user()->permissions, 'dabs_add'))
                        <li>
                            <a href="{{ url('/admin/dab_75_fr/add') }}" ><i class="fas fa-plus-circle"></i> Agregar</a>
                        </li>
                    @endif
                </ul>
            </div>

            <div class="inside">
                <table id="table-modules" class="table table-bordered " >
                    <thead>
                        <tr>
                            <td>OPCIONES</td>
                            <td>NUMERO DAB-75</td>
                            <td>FECHA</td>
                            <td>AREA</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dabs as $dab)
                            <tr>
                                <td>
                                    <div class="opts">
                                        @if(kvfj(Auth::user()->permissions, 'dabs_show'))
                                            <a href="{{ url('/admin/dab_75_fr/'.$dab->id.'/show') }}"  title="Ver"><i class="fa fa-eye"></i></a>
                                        @endif
                                        <!--@if(kvfj(Auth::user()->permissions, 'dabs_delete'))
                                            <a href="{{ url('/admin/dab_75_fr/'.$dab->id.'/revoke') }}"  title="Anular"><i class="fas fa-times-circle"></i></a>
                                        @endif-->
                                    </div>
                                </td>
                                <td>{{$dab->no_doc}}</td>
                                <td>{{$dab->created_at}}</td>
                                <td>{{$dab->area->name}}</td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection