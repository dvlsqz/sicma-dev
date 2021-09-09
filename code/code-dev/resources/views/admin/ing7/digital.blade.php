<!DOCTYPE>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">  
    <title>ING-7 - NO.{{ $ings7->correlative }} </title>
	<link type="text/css" rel="stylesheet" href="estilos.css" />

    <body>

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

    <br><br><br><br>

    <div style="float: right;">
        <strong> NUMERO: </strong> <span style="border-bottom:1pt solid black;">{{ $ings7->correlative }} </span> <br>
        <strong> DEPENDENCIA: </strong> <span style="border-bottom:1pt solid black;">{{ $ings7->service->name }} </span> <br>
        <strong> CLAVE ADMINISTRATIVA: </strong> <span style="border-bottom:1pt solid black;"> {{ $ings7->administrative_key }} </span> <br>
        <strong> FECHA: </strong> <span style="border-bottom:1pt solid black;"> {{ $ings7->created_at }} </span> 
    </div>

    <br><br><br><br>

    <div style="float: left;">
        <span><strong> Señor: </strong> {{ getEncargadosManttoArray(null, $ings7->managed) }} </span> <br>
        <span>Jefe de la División de Mantenimiento </span> <br>
        <span>Edificio </span> <br><br>
        <span>Señor Jefe:  </span> <br>
        <span>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Atentamente solicito se efectué lo siguiente:  
        </span> 
    </div>

    <br><br><br><br><br><br><br>
    
    <table id="table" width="100%" border="5" cellpadding="5" cellspacing="0" bordercolor="#000000">
        <tr>
            <td id="gris" colspan="5" style="background-color: #256B92; color:white;"> 
                <div align="center"> 
                    <b> TIPO DE TRABAJO </b>
                </div>
            </td>
        </tr>

        <tr>
            <td colspan="5">
                @foreach(TipoTrabajosMantto() as $key => $value)
                    
                    @foreach($value['keys'] as $k => $v)
                        <div class="form-check" >
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
        
        
    <table id="table" width="100%" border="5" cellpadding="5" cellspacing="0" bordercolor="#000000">
        <tr>
            <td id="gris" colspan="5" style="background-color: #256B92; color:white;"> 
                <div align="center"> 
                    <b> AREA </b>
                </div>
            </td>
        </tr>

        <tr>
            <td colspan="5">
                @foreach(areasMantto() as $key => $value)
                    
                    @foreach($value['keys'] as $k => $v)
                        <div class="form-check" >
                            <input class="form-check-input" type="checkbox" value="true" id="flexCheckDefault" name="{{ $k }}" @if(kvfj($ings7->area_work, $k)) checked @endif>
                            <label class="form-check-label"  for="flexCheckDefault">
                                {{ $v }}
                            </label>
                        </div>
                    @endforeach
                            
                @endforeach
            </td>
        </tr> 
    </table>

    <table id="table" width="100%" border="5" cellpadding="5" cellspacing="0" bordercolor="#000000">
        <tr>
            <td id="gris" colspan="5" style="background-color: #256B92; color:white;"> 
                <div align="center"> 
                    <b> CUENTA CON REGLÓN PRESUPUESTARIO </b>
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
                <input class="form-check-input" type="checkbox" value="true" id="flexCheckDefault" name="" @if($ings7->buy_materials == "0") checked @endif> 
                <input class="form-check-input" type="checkbox" value="true" id="flexCheckDefault" name="" @if($ings7->buy_materials == "1") checked @endif>
            </td>
        </tr> 

        <tr>
            <td colspan="5">
                <span> b) Para contratar los trabajos</span>
                <input class="form-check-input" type="checkbox" value="true" id="flexCheckDefault" name="" @if($ings7->buy_materials == "0") checked @endif> 
                <input class="form-check-input" type="checkbox" value="true" id="flexCheckDefault" name="" @if($ings7->buy_materials == "1") checked @endif>
            </td>
        </tr> 
    </table>

    <table id="table" width="100%" border="5" cellpadding="5" cellspacing="0" bordercolor="#000000">
        <tr>
            <td id="gris" colspan="5" style="background-color: #256B92; color:white;"> 
                <div align="center"> 
                    <b> DESCRIPCIÓN DEL TRABAJO SOLICITADO </b>
                </div>
            </td>
        </tr>

        <tr>
            <td colspan="5">
                {{ $ings7->description }}
            </td>
        </tr> 
    </table>

    <br>

    <div style="float: left;">
          <small><strong> Anexo: 01 hoja ING-7 </strong></small>  
    </div>

    <br><br><br>

    <table id="table" width="100%">

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

    <br>

    <table id="table" width="100%" border="5" cellpadding="5" cellspacing="0" bordercolor="#000000">
    
        <tr>
            <td id="gris" colspan="5" style="background-color: #256B92; color:white;"> 
                <div align="center"> 
                    <b> FICHA DE SEGUIMIENTO </b>
                </div>
            </td>
        </tr>

        <tr>
            <td colspan="1"> <b> FECHA  </b> </td>
            <td colspan="2"> <b> ACCION TOMADA  </b> </td>
            <td colspan="1"> <b> RESPONSABLE    </b> </td>
            <td colspan="1"> <b> FIRMA Y SELLO  </b> </td>
        </tr>              

    </table>


    </body>

</html>