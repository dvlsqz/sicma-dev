<?php
    use \App\Http\Controllers\Admin\StoreController;
?>
@extends('admin.master')
@section('title','Proveedores')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/suppliers') }}" class="nav-link"><i class="fas fa-users"></i> Proveedores</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">

        <div class="header">
                <h2 class="title"><i class="fas fa-users"></i> Proveedores</h2>
                <ul>
                    @if(kvfj(Auth::user()->permissions, 'supplier_add'))
                        <li>
                            <a href="{{ url('/admin/supplier/add') }}" ><i class="fas fa-plus-circle"></i> Agregar</a>
                        </li>
                    @endif
                </ul>
            </div>

            <div class="inside">
                <table id="table-modules" class="table table-bordered table-striped" style="background-color:#EDF4FB;">
                    <thead>
                        <tr>
                            <td> <strong>OPCIONES </strong></td>
                            <td> <strong>NOMBRE / NIT</strong></td>
                            <td> <strong>CONTACTO </strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($suppliers as $s)
                            <tr>
                                <td>
                                    <div class="opts">
                                        @if(kvfj(Auth::user()->permissions, 'supplier_edit'))
                                            <a href="{{ url('/admin/supplier/'.$s->id.'/edit') }}"  title="Editar"><i class="fa fa-eye"></i></a>
                                        @endif
                                    </div>
                                </td>
                                <td>{{$s->name.' / '.$s->nit}}</td>
                                <td>{{$s->name_contact.' / '.$s->phone.' / '.$s->email}}</td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
