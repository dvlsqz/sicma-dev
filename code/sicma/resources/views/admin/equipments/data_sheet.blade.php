<!DOCTYPE>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">  
    <title>Ficha Técnia - {{ $equipment->code_new }} </title>
	<link type="text/css" rel="stylesheet" href="estilos.css" />

    <body>
        <SPAN style="position: absolute; top: -45 px; left: -45 px;"> </SPAN>

        <table id="table" width="100%" border="5" cellpadding="5" cellspacing="0" bordercolor="#000000">
            <tr>
                <td id="gris" colspan="3"> 	
                    <div align="center"> 
                        <b> FICHA TÉCNICA </b>
                    </div>  
                </td>

                <td rowspan="3" >
                    <div align="center">
                        <img src="{{url('/static/imagenes/igss.png')}}" width="70" height="70">  
                    </div>
                </td>
            </tr>

            <tr>
                <td id="gris"> 
                    <div align="center"> 
                        <b>  Codigo del Equipo <br><small>Anterio / Nuevo</small> </b>
                    </div>
                </td>

                <td id="gris" > 
                    <div align="center"> 
                        <b> QR </b>
                    </div>
                </td>

                <td id="negrita" rowspan="2" > 
                    <div align="center"> 
                        <b>   INSTITUTO GUATEMALTECO DE <BR> SEGURIDAD SOCIAL (IGSS)    </b>
                    </div>
                </td>
            </tr> 

            <tr>
                <td id="neg">  <div align="center"> {{ $equipment->code_old === NULL ? "SN ".' / '.$equipment->code_new : $equipment->code_old.' / '.$equipment->code_new }} </div></td>
                <td id="neg"> <div align="center"> <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(75)->generate('http://www.sicma.igss/admin/equipment/'.$equipment->id.'/data_sheet')) !!} "> </div></td>
            </tr>

            <tr>
                <td id="gris" colspan="4"> 
                    <div align="center"> 
                        <b> IDENTIFICACIÓN </b>
                    </div>
                </td>
            </tr>

            <tr>
                <td > <b> Equipo/Instalación: </b>  {{ $equipment->name }}  <br> </td>
                <td > <b> Marca:<br> </b> {{ $equipment->brand }}  </td>
                <td > <b> Modelo: <br> </b> {{ $equipment->model }}  </td>
                <td > <b> No. de serie: <br> </b> {{ $equipment->serie }}  </td>
            </tr>

            <tr>
                <td colspan="4">    <b> Descripción del Equipo: </b>  </td>
            </tr>

            <tr>
                <td  colspan="4">   <b> Nivel Critico:  </b> </td>
            </tr>

            <tr>
                <td  colspan="4">   <b> Partes de Equipo:   </b> 
                    @foreach($parts as $part) 
                        {{ $part->amount_part.' '.$part->name_part.', ' }} 
                    @endforeach   
                </td>
            </tr>

            

            <tr>
                <td  colspan="4">   <b> Conexión a otros Equipos:   </b> 
                    @foreach($conecctions as $conecction) 
                        {{ $conecction->equipment->name.', ' }} 
                    @endforeach 
                </td>
            </tr>

            <tr>
                <td id="gris" colspan="4"> 
                    <div align="center"> 
                        <b> LOCALIZACIÓN Y FRECUENCIA DE USO </b>
                    </div>
                </td>
            </tr>

            <tr>
                <td  colspan="2">   <b> Servicio General:   </b>    {{ $equipment->servicegeneral->name }}  </td>
                <td  colspan="2">   <b> Servicio:   </b>    {{ $equipment->service->level.' - '.$equipment->service->name }}   </td>
            </tr>

            <tr>
                <td  colspan="2">   <b> Ambiente:   </b>    {{ $equipment->environment->code.' - '.$equipment->environment->name }} </td>
                <td  colspan="2">   <b> Usuario responsable:    </b> </td>
            </tr>

            <tr>
                <td  colspan="2">   <b> Frecuencia de uso:  </b> </td>
                <td  colspan="2">   <b> ¿Cuenta con personal capacitado para su uso?:   </b> </td>
            </tr>

            <tr>
                <td id="gris" colspan="4"> 
                    <div align="center"> 
                        <b> INFORMACIÓN TÉCNICA </b>
                    </div>
                </td>
            </tr>

            <tr>
                <td colspan="4" >   </td>
                
            </tr>

            <tr>
                <td id="gris" colspan="4"> 
                    <div align="center"> 
                        <b>   CARACTERISTICAS ESPECIALES </b> 
                    </div>
                </td>
            </tr>

            <tr>
                <td colspan="4" >   </td>
                
            </tr>

            <tr>
                <td id="gris" colspan="4"> 
                    <div align="center"> 
                        <b> INFORMACIÓN DEL PROVEEDOR Y TECNICA </b>
                    </div>
                </td>
            </tr>

            <tr>
                <td  colspan="2"> <strong>  Proveedor:  </strong> {{ $equipment->sup->name }}</div></td>
                <td  colspan="2"> <div align="center"> <strong> MANUALES DEL EQUIPO </div></td>
            </tr>

            <tr>
                <td  colspan="2"><strong>  Nit: </strong>{{ $equipment->sup->nit }}</td>
                <td colspan="2" rowspan="4">                    
                    <div id="neg" >	
                        @foreach($files as $f)
                        <strong>{{  getTypeFilesArray(null, $f->type_manual).': ' }} </strong> {{$f->file_name}}<br>
                        @endforeach  
                    </div>	
                </td>
            </tr>

            <tr>
                <td  colspan="2"> <strong> Nombre de Contacto: {{ $equipment->sup->name_contact }}</strong></td>
            </tr>

            <tr>
                <td  colspan="2">  <strong>Telefono: </strong> {{ $equipment->sup->phone }}</td>
            </tr>

            <tr>
                <td  colspan="2"> <strong> Correo Electronico:  </strong> {{ $equipment->sup->email }}</td>
            </tr>

            <tr>
                <td id="gris" colspan="4"> 
                    <div align="center"> 
                        <b> FOTOS DEL EQUIPO </b>
                    </div>
                </td>
            </tr>

            <tr>
                <td  colspan="4"> 
                    <div style="overflow: hidden; position: relative; display: inline-block;"> 
                        @foreach($gallery as $img)
                            <div class="tumb" >
                                <a href="#" data-toogle="tooltrip" data-placement="top" title="Eliminar">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                                <img src="{{ url('/uploads/photos/'.$img->file_path.'/t_'.$img->file_name) }}" alt="" width="60px" height="60px">
                            </div>
                        @endforeach
                    </div>
                </td>
            </tr>

            <tr>
                <td id="gris" colspan="4"> 
                    <div align="center"> 
                        <b> Historial de Movimientos del Equipo </b>
                    </div>
                </td>
            </tr>

            <tr>
                <td> <b> Fecha: <br>  </b>    </td>
                <td  colspan="2"> <b> Ambiente:<br> </b>   </td>
                <td> <b> Motivo: <br> </b>  </td>
            </tr>

            @foreach($transfers as $t)            
                <tr>                    
                    <td>{{ $t->date }}</td>
                    <td colspan="2"> {{ $t->servicegeneral->name.' / '.$t->service->level.' - '.$t->service->name.' / '.$t->environment->code.' - '.$t->environment->name}}  </td>
                    <td> {{ $t->reason }} </td>                    
                </tr>
            @endforeach

            

            <!--<tr>
                <td id="gris" colspan="4"> 
                    <div align="center"> 
                      <b> REPUESTOS EN ALMACÉN </b> 
                    </div>
                </td>
            </tr>


            <tr>
                <td  colspan="2">  Repuesto:  </td>
                <td  colspan="2">  No. de parte: </td>
            </tr>-->

        </table>


    </body>

</html>