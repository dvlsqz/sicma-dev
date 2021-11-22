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
                <td id="gris" colspan="2" style="background-color: #256B92; color:white;">
                    <div align="center">
                        <b> FICHA TÉCNICA </b>
                    </div>
                </td>

                <td id="negrita" rowspan="3" colspan="2" >
                    <div align="center">
                        <b>   INSTITUTO GUATEMALTECO DE <BR> SEGURIDAD SOCIAL (IGSS)    </b>
                    </div>
                </td>

                <!--<td rowspan="3" >
                    <div align="center">
                        <img src="#" width="70" height="70">
                    </div>
                </td>-->
            </tr>

            <tr>
                <td id="gris"  colspan="1" >
                    <div align="center">
                        <b>  Codigo del Equipo <br><small>Anterio / Nuevo</small> </b>
                    </div>
                </td>

                <td id="gris"  colspan="1" >
                    <div align="center">
                        <b>  Número de Bien<br> </b>
                    </div>
                </td>

                <!--<td id="negrita" rowspan="3" colspan="2">
                    <div align="center">
                        <b>   INSTITUTO GUATEMALTECO DE <BR> SEGURIDAD SOCIAL (IGSS)    </b>
                    </div>
                </td>-->


            </tr>

            <tr>
                <td id="neg" colspan="1">  <div align="center"> {{ $equipment->code_old === NULL ? "SN ".' / '.$equipment->code_new : $equipment->code_old.' / '.$equipment->code_new }} </div></td>
                <td id="neg" colspan="1">  <div align="center">  </div></td>
            </tr>

            <tr >
                <td id="gris" colspan="4" style="background-color: #256B92; color:white;" >
                    <div align="center" >
                        <b> IDENTIFICACIÓN </b>
                    </div>
                </td>
            </tr>

            <tr>
                <td > <b> Equipo: </b>  {{ $equipment->name }}  <br> </td>
                <td > <b> Marca:<br> </b> {{ $equipment->brand }}  </td>
                <td > <b> Modelo: <br> </b> {{ $equipment->model }}  </td>
                <td > <b> No. de serie: <br> </b> {{ $equipment->serie }}  </td>
            </tr>

            @if( $equipment->idmaintenancearea == '8' || $equipment->idmaintenancearea == '9' )
                <tr>
                    <td > <b> Capacidad: </b>  {{ $equipment->capacity }}  <br> </td>
                    <td > <b> Tipo:<br> </b> {{ $equipment->type }}  </td>
                    <td colspan="2"> <b> Número Estación/Equipo: <br> </b> {{ $equipment->num_station }}  </td>
                </tr>
            @endif

            <tr>
                <td  colspan="4">   <b> Estado:  </b> {{ getStatusEquipment(null, $equipment->status)  }} </td>
            </tr>

            <tr>
                <td  colspan="4">   <b> Nivel Critico:  </b> {{ getLevelEquipment(null, $equipment->critical_level) }} </td>
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
                <td id="gris" colspan="4" style="background-color: #256B92; color:white;">
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
                <td  colspan="2">   <b> Usuario responsable:    </b> {{ $equipment->person_in_charge }} </td>
            </tr>

            <tr>
                <td  colspan="2">   <b> Frecuencia de uso:  </b> {{ getFrecuenciasUsosArray(null, $equipment->frequency) }} </td>
                <td  colspan="2">   <b> ¿Cuenta con personal capacitado para su uso?: </b> {{ getTrainedStaff(null, $equipment->trained_staff) }}   </td>
            </tr>

            <tr>
                <td id="gris" colspan="4" style="background-color: #256B92; color:white;">
                    <div align="center">
                        <b> INFORMACIÓN TÉCNICA </b>
                    </div>
                </td>
            </tr>

            <tr>
            <td colspan="4" >
                    {{ $equipment->description }}
                </td>

            </tr>

            <tr>
                <td id="gris" colspan="4" style="background-color: #256B92; color:white;">
                    <div align="center">
                        <b>   CARACTERISTICAS ESPECIALES </b>
                    </div>
                </td>
            </tr>

            <tr>
                <td colspan="4" >
                    {{ $equipment->features }}
                </td>

            </tr>

            <tr>
                <td id="gris" colspan="4" style="background-color: #256B92; color:white;">
                    <div align="center">
                        <b> INFORMACIÓN DEL PROVEEDOR Y TECNICA </b>
                    </div>
                </td>
            </tr>

            <tr>
                <td  colspan="2"> <strong>  Proveedor:  </strong> @if(empty($equipment->sup->name))  @else {{ $equipment->sup->name }} @endif</div></td>
                <td  colspan="2"> <div align="center"> <strong> MANUALES DEL EQUIPO </div></td>
            </tr>

            <tr>
                <td  colspan="2"><strong>  Nit: </strong> @if(empty($equipment->sup->nit))  @else {{ $equipment->sup->nit }} @endif </td>
                <td colspan="2" rowspan="4">
                    <div id="neg" >
                        @foreach($files as $f)
                        <strong>{{  getTypeFilesArray(null, $f->type_manual).': ' }} </strong> {{$f->file_name}}<br>
                        @endforeach
                    </div>
                </td>
            </tr>

            <tr>
                <td  colspan="2"> <strong> Nombre de Contacto: @if(empty($equipment->sup->name_contact))  @else {{ $equipment->sup->name_contact }} @endif</strong></td>
            </tr>

            <tr>
                <td  colspan="2">  <strong>Telefono: </strong> @if(empty($equipment->sup->phone))  @else {{ $equipment->sup->phone }} @endif</td>
            </tr>

            <tr>
                <td  colspan="2"> <strong> Correo Electronico:  </strong> @if(empty($equipment->sup->email))  @else {{ $equipment->sup->email }} @endif</td>
            </tr>

            <!--<tr>
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
            </tr>-->

            <tr>
                <td id="gris" colspan="4" style="background-color: #256B92; color:white;">
                    <div align="center">
                        <b> Historial de Movimientos del Equipo </b>
                    </div>
                </td>
            </tr>

            <tr>
                <td > <b> Fecha: <br>  </b>    </td>
                <td  colspan="2"> <b> Ambiente:<br> </b>   </td>
                <td> <b> Motivo: <br> </b>  </td>
            </tr>

            @foreach($transfers as $t)
                <tr>
                    <td >{{ $t->date }}</td>
                    <td colspan="2">
                        Servicio General: {{ $t->servicegeneral->name}} <br>
                        Servicio: {{ $t->service->level.' - '.$t->service->name }} <br>
                        Ambiente: {{ $t->environment->code.' - '.$t->environment->name}}
                    </td>
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
