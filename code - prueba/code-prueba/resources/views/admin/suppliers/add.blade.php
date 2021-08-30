@extends('admin.master')
@section('title','Agregar')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/suppliers') }}" class="nav-link"><i class="fas fa-users"></i> Lista de Proveedores</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/supplier/add') }}" class="nav-link"><i class="fas fa-plus-circle"></i> Agregar Proveedor</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">

            <div class="header">
                <h2 class="title"><i class="fas fa-plus-circle"></i> Agregar</h2>

            </div>

            <div class="inside">
                {!! Form::open(['url'=>'/admin/supplier/add']) !!}
                    <div class="row">

                        <div class="col-md-6">
                            <label for="name"> <strong> Nombre de Empresa/Negocio/Proveedor: </strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::text('name', null, ['class'=>'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="name"> <strong> NIT: </strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::text('nit', null, ['class'=>'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="name" class="mtop16"> <strong> Nombre del Contacto: </strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::text('name_contact', null, ['class'=>'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="lastname" class="mtop16"> <strong>Telefono del Contacto: </strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::number('phone', null, ['class'=>'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="lastname" class="mtop16"> <strong>Correo Electronico del Contacto: </strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::email('email', null, ['class'=>'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row mtop16">
                        <div class="col-md-12">
                            {!! Form::submit('Guardar', ['class'=>'btn btn-success']) !!}
                            <a href="{{ url('/admin/suppliers') }}" class="btn btn-danger">Cancelar</a>
                        </div>
                    </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
