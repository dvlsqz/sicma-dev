@extends('admin.master')
@section('title','Clasificacion de ING-7')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/ing_7') }}" class="nav-link"><i class="fas fa-copy"></i> ING-7</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/ing_7/add') }}" class="nav-link"><i class="fas fa-plus-circle"></i> Solicitud de ING-7</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="page_user">            

            <div class="row">
                <div class="col-md-6 d-flex mb16">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fas fa-info-circle"></i> Seleccione el ó los tipos de trabajo</h2>
                        </div>

                        <div class="inside">
                            <div class="mini_profile">
                                <form action="{{ url('/admin/ing_7/'.$ing7->id.'/classification_type_work') }}" method="POST">
                                @csrf

                                    <span> <strong>  </strong> </span>
                                    
                                    @foreach(TipoTrabajosMantto() as $key => $value)
                                        @foreach($value['keys'] as $k => $v)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="true" id="flexCheckDefault" name="{{$k}}" @if(kvfj($ing7->type_work, $k)) checked @endif>
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    {{ $v }}
                                                </label>
                                            </div>
                                        @endforeach
                                    @endforeach

                                        
                                    
                                    

                                    <div class="col-md-3 mtop16">
                                        {!! Form::submit('Guardar', ['class'=>'btn btn-success']) !!}                                   
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>   

                <div class="col-md-6 d-flex mb16">
                    <div class="panel shadow">

                        <div class="header">
                            <h2 class="title"><i class="fas fa-info-circle"></i> Seleccione el ó las areas de trabajo</h2>
                        </div>

                        <div class="inside">
                            <div class="mini_profile">
                                <form action="{{ url('/admin/ing_7/'.$ing7->id.'/classification_area_work') }}" method="POST">
                                @csrf

                                    <span> <strong>  </strong> </span>
                                    
                                    @foreach(areasMantto() as $key => $value)
                                        @foreach($value['keys'] as $k => $v)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="true" id="flexCheckDefault" name="{{ $k }}" @if(kvfj($ing7->area_work, $k)) checked @endif>
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    {{ $v }}
                                                </label>
                                            </div>
                                        @endforeach
                                    @endforeach  

                                    <div class="col-md-3 mtop16">
                                        {!! Form::submit('Guardar', ['class'=>'btn btn-success']) !!}                                   
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>   
    </div>
@endsection