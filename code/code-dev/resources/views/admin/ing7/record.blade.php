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
                <h2 class="title"><i class="fas fa-clipboard-list"></i> Seguimiento de ING-7 No. {{$ing7->ing->correlative}} </h2>
                <ul>
                    
                    
                </ul>
            </div>

            <div class="inside">
                
                <table id="table-modules" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <td>ACCION</td>
                            <td>FECHA Y HORA</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bitacoras as $b)
                            <tr>
                                <td>{{$b->action}}</td>
                                <td>{{$b->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection