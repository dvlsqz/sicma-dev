<!DOCTYPE>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">  
    <title>ING-7 - NO.{{ $ings7->correlative }} </title>
    
    <body>
        <br><br>

        <div style="float: left;"> 
            <img src="{{ url('img/Isotipo.png') }}" alt="" width="80px" height="80px">    
        </div>

        <div style="text-align: center;">
            <span><strong> INSTITUTO GUATEMALTECO DE SEGURIDAD SOCIAL </strong> </span> <br> 
            <span><strong> SOLICITUD DE TRABAJO </strong> </span>      
        </div>

        <div style="float: right; margin-top: 0;">
            <span><strong> ING-7 </strong> </span>        
        </div>

        <br><br>

        <div style="float: right;">
            <strong> NUMERO: </strong> <span >{{ $ings7->correlative }} </span> <br>
            <strong> DEPENDENCIA: </strong> <span >{{ $ings7->service->name }} </span> <br>
            <strong> CLAVE ADMINISTRATIVA: </strong> <span > {{ $ings7->administrative_key }} </span> <br>
            <strong> FECHA: </strong> <span >{{ \Carbon\Carbon::parse($ings7->created_at)->format('d/m/Y')}}  </span> 
        </div>

        <br><br><br><br>

        <div style="float: left;">
            <span><strong> Señor: </strong> @if( $ings7->managed == '0' ) Ing. Jahen Figueroa @elseif( $ings7->managed == '1' ) Ing. Sergio Martinez @else Ing. Gabriel Fuentes @endif </span> <br>
            <span>Jefe de la División de Mantenimiento </span> <br>
            <span>Edificio </span> <br><br>
            <span>Señor Jefe:  </span> <br>
            <span>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                Atentamente solicito se efectué lo siguiente:  
            </span> 
        </div>

        <br><br><br><br><br><br><br>
        
        <div style="border: 1px solid black">
            <table id="table" width="100%"  border="0" cellpadding="5" >
                <tr>
                    <td id="gris" colspan="5" style='border-bottom:none;'> 
                        <div align="left"> 
                            <small> <b> TIPO DE TRABAJO: </b> </small> 
                        </div>
                    </td>
                </tr>

                <tr>
                    <td colspan="5" style="float: center;">
                        @foreach(TipoTrabajosMantto() as $key => $value)
                            
                            @foreach($value['keys'] as $k => $v)
                                <div class="form-check"  >
                                    <input class="form-check-input" type="checkbox" value="true" id="flexCheckDefault" name="{{ $k }}" @if(kvfj($ings7->type_work, $k)) checked @endif>
                                    <label class="form-check-label"  for="flexCheckDefault">
                                        {{ $v }}
                                    </label>
                                </div>
                            @endforeach
                                    
                        @endforeach
                    </td>
                </tr> 
            </table>
        </div>
            
        <div style="border: 1px solid black">  
            <table id="table" width="100%" border="0"  >
                <thead>
                <tr>
                    <td id="gris" colspan="5" > 
                        <div align="left"> 
                            <small> <b> AREA: </b> </small>
                        </div>
                    </td>
                </tr> 
                </thead>
                
                
                <tbody style=""> 
                    @foreach(areasMantto() as $key => $value)                
                        @foreach($value['keys'] as $k => $v)
                        
                        <tr  style="">
                            <td rowspan="4" height="5">
                                <div class="form-check " style="  display:inline-block; float: left; position:relative;   width: 90%;  font-size: 0.91em;  " >                         
                                    <input style=" display: flex; float: left;  " class="form-check-input" type="checkbox" value="true" id="flexCheckDefault" name="{{ $k }}" @if(kvfj($ings7->area_work, $k)) checked @endif>
                                    <label class="form-check-label"  for="flexCheckDefault" style="padding: 0px 0px 0px 20px;">
                                        {{ $v }}
                                    </label>                             
                                </div>
                            </td>
                        </tr>   
                        
                        @endforeach                        
                    @endforeach            
                </tbody>      
                
            </table>
        </div>

        <div style="border: 1px solid black">
            <table id="table" width="100%" border="0" cellpadding="5" >
                <tr>
                    <td id="gris" colspan="5"> 
                        <div align="left"> 
                            <small> <b> CUENTA CON REGLÓN PRESUPUESTARIO: </b> </small>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td colspan="5">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span> SI</span>
                        <span> NO</span>
                    </td>
                </tr> 

                <tr>
                    <td colspan="5">
                        <span> a) Para compra de materiales</span>
                        <input class="form-check-input" type="checkbox" value="true" id="flexCheckDefault" name="" @if($ings7->buy_materials == "1") checked @endif> 
                        <input class="form-check-input" type="checkbox" value="true" id="flexCheckDefault" name="" @if($ings7->buy_materials == "2") checked @endif>
                    </td>
                </tr> 

                <tr>
                    <td colspan="5">
                        <span> b) Para contratar los trabajos</span>
                        <input class="form-check-input" type="checkbox" value="true" id="flexCheckDefault" name="" @if($ings7->hire_jobs == "1") checked @endif> 
                        <input class="form-check-input" type="checkbox" value="true" id="flexCheckDefault" name="" @if($ings7->hire_jobs == "2") checked @endif>
                    </td>
                </tr> 
            </table>
        </div>

        <div style="border: none;">
            <table id="table" width="100%" border="0" cellpadding="5">
                <tr>
                    <td id="gris" colspan="5"> 
                        <div align="left"> 
                            <small> <b> DESCRIPCIÓN DEL TRABAJO SOLICITADO: </b> <small>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td colspan="5">
                        {{ $ings7->description }}
                    </td>
                </tr> 
            </table>
        </div>
        <br>

        <div style="float: left;">
            <small><strong> Anexo: 01 hoja ING-7 </strong></small>  
        </div>

        <br><br><br>

        <table id="table" width="100%" style="text-align: center;">

            <tr>
                <td colspan="2" style="float: left;">
                    F) <span style="border-bottom:1pt solid black;">  {{ $ings7->user->name.' '.$ings7->user->lastname}} </span> <br>
                    <span><strong> SOLICITANTE </strong><br></span>   
                </td>

                <td colspan="2" style="float: right;">
                    F) <span> _____________________  </span> <br>
                    <span><strong> JEFE DE DEPENDENCIA </strong><br>  </span>   
                </td>
            </tr>              

        </table>

        <br><br>

        <div style="text-align: center;">
            <small><strong> FICHA DE SEGUIMIENTO </strong></small>  
        </div>

        <br>
        


        <table id="table" width="100%" border="1" cellspacing="0" cellpadding="0" style="text-align: center; font-size: 0.90em;">
            <thead>
                <tr>
                    <td style='width: 10%;'> <b> FECHA  </b> </td>
                    <td style='width: 30%;'> <b> ACCION TOMADA  </b> </td>
                    <td style='width: 10%;'> <b> RESPONSABLE    </b> </td>
                    <td style='width: 10%;'> <b> FIRMA Y SELLO  </b> </td>
                </tr>  
            </thead>  
            
            <tbody>   
                <tr>
                    <td> <br> </td>
                    <td> <br> </td>
                    <td> <br> </td>
                    <td> <br> </td>
                </tr>  
                <tr>
                    <td> <br> </td>
                    <td> <br> </td>
                    <td> <br> </td>
                    <td> <br> </td>
                </tr> 
                <tr>
                    <td> <br> </td>
                    <td> <br> </td>
                    <td> <br> </td>
                    <td> <br> </td>
                </tr> 
                <tr>
                    <td> <br> </td>
                    <td> <br> </td>
                    <td> <br> </td>
                    <td> <br> </td>
                </tr> 
                <tr>
                    <td> <br> </td>
                    <td> <br> </td>
                    <td> <br> </td>
                    <td> <br> </td>
                </tr>  
                <tr>
                    <td> <br> </td>
                    <td> <br> </td>
                    <td> <br> </td>
                    <td> <br> </td>
                </tr> 
                <tr>
                    <td> <br> </td>
                    <td> <br> </td>
                    <td> <br> </td>
                    <td> <br> </td>
                </tr>            
                
            </tbody>
        </table>

        <div style="text-align: left; font-size: 0.600em;">
            <small><strong> TALLERES IGSS </strong></small>  
        </div>
        


        


    </body>

</html>