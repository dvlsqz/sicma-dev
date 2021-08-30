@extends('admin.master')
@section('title','Informacion de Cuenta')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/user/account/info') }}" class="nav-link"><i class="fas fa-id-card"></i> Información de Cuenta</a>
    </li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-fingerprint"></i> Cambiar Contraseña</h2>
                </div>

                <div class="inside">
                    {!! Form::open(['url' => '/admin/user/account/chance/password']) !!}
                        <div class="row">
                            <div class="col-md-12">
                                <label for="name">Contraseña Actual:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::password('apassword', ['class'=>'form-control']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="row mtop16">
                            <div class="col-md-12">
                                <label for="name">Nueva Contraseña:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::password('password', ['class'=>'form-control']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="row mtop16">
                            <div class="col-md-12">
                                <label for="name">Confirmar Contraseña:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::password('cpassword', ['class'=>'form-control']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="row mtop16">
                            <div class="col-md-12">
                                {!! Form::submit('Actualizar', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-address-card"></i> Información del Usuario</h2>
                </div>
                <div class="inside">
                    {!! Form::open(['url'=>'/account/edit/info']) !!}
                        <div class="row">

                            <div class="col-md-4">
                                <label for="ibm">IBM:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('ibm', Auth::user()->ibm, ['class'=>'form-control', 'disabled']) !!}
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="name">Nombre:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('name', Auth::user()->name, ['class'=>'form-control', 'disabled']) !!}
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="lastname">Apellidos:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('lastname', Auth::user()->lastname, ['class'=>'form-control', 'disabled']) !!}
                                </div>
                            </div>


                        </div>

                        <div class="row mtop16">
                            <div class="col-md-8">
                                <label for="email">Correo Institucional:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('email', Auth::user()->email, ['class'=>'form-control', 'disabled']) !!}
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="phone">Teléfono:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::number('phone', Auth::user()->phone, ['class'=>'form-control', 'disabled']) !!}
                                </div>
                            </div>

                        </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
