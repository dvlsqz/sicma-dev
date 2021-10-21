@extends('admin.master')
@section('title','Clasificacion de ING-7')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/ot') }}" class="nav-link"><i class="fas fa-copy"></i> ING-7</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-copy"></i> Listado de Documentos Subidos </h2>
                    </div>
                    <div class="inside">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <td> <strong> OPCION</strong> </td>
                                    <td colspan="2"><strong> DOCUMENTO PDF</strong> </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($files as $f)
                                    <tr>
                                        <td>
                                            <a href="{{ url('/admin/ot/'.$ot->id.'/delete') }}" data-toogle="tooltrip" data-placement="top" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                            <a href="{{ url('/uploads/files/'.$f->file_path.'/'.$f->file_name) }} " target="_blank" data-toogle="tooltrip" data-placement="top" title="Abrir en Pestaña"><i class="fas fa-file-pdf"></i></a>
                                        </td>
                                        <td colspan="2">
                                            <embed width="100%" height="250" src="{{ asset('/uploads/files/'.$f->file_path.'/'.$f->file_name) }}" />
                                         </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="panel shadow mtop16">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-images"></i> Galeria de Fotos </h2>
                    </div>
                    <div class="inside product_gallery">
                    <div class="tumbs col-md-4">
                        @foreach($gallery as $img)
                            <div class="tumb">
                                <a href="#" data-toogle="tooltrip" data-placement="top" title="Eliminar">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                                <img src="{{ url('/uploads/photos/'.$img->file_path.'/t_'.$img->file_name) }}" alt="">
                            </div>
                        @endforeach
                    </div>
                    </div>
                </div>
            </div>


            <div class="col-md-4">

                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-file-upload"></i> Carga de Archivos de la OT</h2>
                    </div>
                    <div class="inside">
                        {!! Form::open(['url'=>'/admin/ot/'.$ot->id.'/files/upload/file','files' => true,'enctype'=>'multipart/form-data']) !!}
                            <div class="row">

                                <div class="col-md-12 ">
                                    <label for="ibm"><strong> Seleccionar Archivo: </strong> </label><br>
                                    <div class="input-group">
                                    {!! Form::file('file_name', ['required' ]) !!}
                                    </div>
                                </div>

                                <div class="col-md-12 mtop16">
                                    <label for="name"><strong> Descripción:</strong> </label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                        {!! Form::textarea('description', null, ['class'=>'form-control','rows'=>'2']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row mtop16">
                                <div class="input-group">
                                    {!! Form::submit('Guardar', ['class'=>'btn btn-primary']) !!}&nbsp;
                                    <a href="{{ url()->previous() }}" class="btn btn-danger">Cancelar</a>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>

                <div class="panel shadow mtop16">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-upload"></i> Carga de Fotos de la OT </h2>
                    </div>
                    <div class="inside">
                        {!! Form::open(['url'=>'/admin/ot/'.$ot->id.'/files/upload/image', 'files' => true]) !!}
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="name"><strong> Seleccionar Archivo:</strong> </label>
                                    <div class="input-group">
                                    {!! Form::file('file_image', ['accept' => 'image/*',  'required' ]) !!}
                                    </div>
                                </div>

                                <div class="col-md-12 mtop16">
                                    <label for="ibm"><strong> Descripción:</strong> </label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                        {!! Form::textarea('description', null, ['class'=>'form-control','rows'=>'2']) !!}
                                    </div>
                                </div>
                            </div>


                            <div class="row mtop16">
                                <div class="input-group">
                                    {!! Form::submit('Guardar', ['class'=>'btn btn-primary']) !!} &nbsp;
                                    <a href="{{ url()->previous() }}" class="btn btn-danger">Cancelar</a>
                                </div>
                            </div>

                        {!! Form::close() !!}
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
