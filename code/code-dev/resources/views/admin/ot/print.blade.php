<!DOCTYPE>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OT - NO.{{ $ots->correlative }} </title>

    <body style="font-size: 14px; font-family: 'Roboto Slab', serif;">
        <SPAN style="position: absolute; top: -45 px; left: -45 px;"> </SPAN>

        <table id="table" width="100%" border="5" cellpadding="5" cellspacing="0" bordercolor="#000000">
            <tr>
                <td>
                    <div align="center">
                        <img src="{{url('/static/imagenes/Isotipo.png')}} " width="50" height="50">
                    </div>
                </td>

                <td id="negrita"  >
                    <div align="center">
                        <b>
                            HOSPITAL GENERAL QUETZALTENANGO <br>
                            SOLICITUD DE ORDEN DE TRABAJO INTERNA DE MANTENIMIENTO
                        </b>
                    </div>
                </td>

                <td id="gris"    >
                    <div align="center">
                        <b>  No. {{ $ots->correlative }} </b>
                    </div>
                </td>
            </tr>
        </table>

        <div style="border: 1px solid black; ">
            <table id="table" width="100%"  border="0" cellpadding="5">
                <tr >
                    <td id="gris"  colspan="4" style="border: 1px solid black">
                        <div align="center" >
                            <b> 1. DATOS GENERALES </b>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td id="gris" colspan="2"  style="border-right: 0px; width: 50%; " >
                        <div  >
                            <b> Área de Mantenimiento:  </b> {{ $ots->area->name}}
                            <br>
                            <b> Tipo de Trabajo: </b>  {{ getTypeWorkOT(null, $ots->type_work)}}
                        </div>
                    </td>

                    <td id="gris" colspan="2"  style="border-left:0px; width: 50%; " >
                        <div >
                            <b> Fecha de orden: </b> {{ $ots->date_request }}
                            <br>
                            <b> Prioridad: </b> {{ getPriorityOT(null, $ots->priority)}}
                        </div>
                    </td>

                </tr>

                <tr>
                    <td id="gris" colspan="4"  style="border-top:0px; width: 50%; " >
                        <div >
                            <b> Especificar el trabajo: </b> {{ $ots->specify_job }}

                        </div>
                    </td>
                </tr>



                <tr>
                    <td id="gris" colspan="2"  style="border-right: 0px; width: 50%; margin-top: 300px;" >
                        <div  align="center">
                            <b> F.______________________________ </b>
                            <br>
                            <b>   {{ $ots->user->name.' '.$ots->user->lastname }} </b>
                            <br>
                            <b> Solicitante </b>
                        </div>
                    </td>

                    <td id="gris" colspan="2"   style="border-left:0px; width: 50%; margin-top: 300px;" >
                        <div align="center" >
                            <b> F.______________________________ </b>
                            <br>
                            <b>   {{ getApprovalOT(null, $ots->idapproval) }} </b>
                            <br>
                            <b> Vo.Bo. Jefatura de Mantenimiento </b>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <br>
        <div style="border: 1px solid black; ">
            <table id="table" width="100%"  border="0" cellpadding="5">
                <tr >
                    <td id="gris"  colspan="6" style="border: 1px solid black">
                        <div align="center" >
                            <b> 2. PERSONAL A CARGO DE LA EJECUCION DEL TRABAJO </b>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td id="gris" colspan="2"  style="border-right: 0px; width: 50%; " >
                        <div  >
                            <b> Personal Interno: </b> @if(empty($ots->personal->type_personal))  @else @if($ots->personal->type_personal == "0") X @endif @endif
                        </div>
                    </td>

                    <td id="gris" colspan="2"  style="border-left:0px; width: 50%; " >
                        <div >
                            <b> Personal Contratista: </b> @if(empty($ots->personal->type_personal))  @else @if($ots->personal->type_personal == "1") X @endif @endif
                        </div>
                    </td>

                    <td id="gris" colspan="2"  style="border-top:0px; width: 50%; " >
                        <div >
                            <b> Empresa: </b>@if(empty($ots->personal->company))  @else{{ $ots->personal->company}} @endif

                        </div>
                    </td>

                </tr>

                <tr>
                    <td id="gris" colspan="2"  style="border-right: 0px; width: 50%; " >
                        <div  >
                            <b> Nombre: </b>@if(empty($ots->personal->name))  @else{{ $ots->personal->name}} @endif
                        </div>
                    </td>

                    <td id="gris" colspan="2"  style="border-right: 0px; width: 50%; " >
                        <div  >
                            <b> Área: </b>@if(empty($ots->personal->area))  @else{{ $ots->personal->area}} @endif
                        </div>
                    </td>

                    <td id="gris" colspan="2"  style="border-right: 0px; width: 50%; " >
                        <div  >
                            <b> F._________________________ </b>
                            <br>
                            <b> Personal a Cargo </b>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td id="gris" colspan="3"  style="border-right: 0px; width: 50%; " >
                        <div  >
                            <b> Fecha de atención: </b>@if(empty($ots->personal->date))  @else{{ $ots->personal->date}} @endif
                        </div>
                    </td>

                    <td id="gris" colspan="3"  style="border-right: 0px; width: 50%; " >
                        <div  >
                            <b> Hora de atención: </b>@if(empty($ots->personal->hour))  @else{{ $ots->personal->hour}} @endif
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <br>
        <div style="border: 1px solid black">
            <table id="table" width="100%"  border="0" cellpadding="5">
                <tr >
                    <td id="gris"  colspan="6" style="border: 1px solid black">
                        <div align="center" >
                            <b> 3. MATERIALES, INSUMOS Y REPUESTOS A UTILIZAR </b>
                        </div>
                    </td>
                </tr>
            </table>

            <table id="table" width="100%" border="1" cellspacing="0" cellpadding="0" style="text-align: center; font-size: 0.90em;">
                <thead>
                    <tr>
                        <td style='width: 10%;'> <b> No. </b> </td>
                        <td style='width: 10%;'> <b> Cant.  </b> </td>
                        <td style='width: 10%;'> <b> Unidad    </b> </td>
                        <td style='width: 50%;'> <b> Descripción  </b> </td>
                        <td style='width: 10%;'> <b> Precio Unitario  </b> </td>
                        <td style='width: 10%;'> <b> Precio Total  </b> </td>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                    </tr>
                    <tr>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                    </tr>
                    <tr>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                    </tr>
                    <tr>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                    </tr>
                    <tr>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                    </tr>
                    <tr>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                    </tr>
                    <tr>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                    </tr>
                    <tr>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                    </tr>
                    <tr>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                    </tr>
                    <tr>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                    </tr>
                    <tr>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                    </tr>
                    <tr>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                    </tr>
                    <tr>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                    </tr>
                    <tr>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                    </tr>
                    <tr>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                    </tr>
                    <tr>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                    </tr>


                </tbody>
            </table>
        </div>

        <div style="border: 1px solid black; display: table; margin-top:20px;">
            <div style="display: table-row; ">
                <div style="display: table-cell; border: solid; border-width: thin; padding-left: 35px; padding-right: 35px; padding-top: 10px;">  <br>     </div>
                <div style="display: table-cell; border: solid; border-width: thin; padding-left: 35px; padding-right: 35px; padding-top: 10px;">  <br>  </div>
                <div style="display: table-cell; border: solid; border-width: thin; padding-left: 35px; padding-right: 35px; padding-top: 10px;">  <br>     </div>
                <div style="display: table-cell; border: solid; border-width: thin; padding-left: 196px; padding-right: 196px; padding-top: 10px;">  <br>     </div>
                <div style="display: table-cell; border: solid; border-width: thin; padding-left: 35px; padding-right: 35px; padding-top: 10px;">  <br>  </div>
                <div style="display: table-cell; border: solid; border-width: thin; padding-left: 35px; padding-right: 35px; padding-top: 10px;">  <br>     </div>
            </div>
            <div style="display: table-row; ">
                <div style="display: table-cell; border: solid; border-width: thin; padding-left: 35px; padding-right: 35px; padding-top: 10px;">  <br>     </div>
                <div style="display: table-cell; border: solid; border-width: thin; padding-left: 35px; padding-right: 35px; padding-top: 10px;">  <br>  </div>
                <div style="display: table-cell; border: solid; border-width: thin; padding-left: 35px; padding-right: 35px; padding-top: 10px;">  <br>     </div>
                <div style="display: table-cell; border: solid; border-width: thin; padding-left: 196px; padding-right: 196px; padding-top: 10px;">  <br>     </div>
                <div style="display: table-cell; border: solid; border-width: thin; padding-left: 35px; padding-right: 35px; padding-top: 10px;">  <br>  </div>
                <div style="display: table-cell; border: solid; border-width: thin; padding-left: 35px; padding-right: 35px; padding-top: 10px;">  <br>     </div>
            </div>
            <div style="display: table-row; ">
                <div style="display: table-cell; border: solid; border-width: thin; padding-left: 35px; padding-right: 35px; padding-top: 10px;">  <br>     </div>
                <div style="display: table-cell; border: solid; border-width: thin; padding-left: 35px; padding-right: 35px; padding-top: 10px;">  <br>  </div>
                <div style="display: table-cell; border: solid; border-width: thin; padding-left: 35px; padding-right: 35px; padding-top: 10px;">  <br>     </div>
                <div style="display: table-cell; border: solid; border-width: thin; padding-left: 196px; padding-right: 196px; padding-top: 10px;">  <br>     </div>
                <div style="display: table-cell; border: solid; border-width: thin; padding-left: 35px; padding-right: 35px; padding-top: 10px;">  <br>  </div>
                <div style="display: table-cell; border: solid; border-width: thin; padding-left: 35px; padding-right: 35px; padding-top: 10px;">  <br>     </div>
            </div>
            <div style="display: table-row; ">
                <div style="display: table-cell; border: solid; border-width: thin; padding-left: 35px; padding-right: 35px; padding-top: 10px;">  <br>     </div>
                <div style="display: table-cell; border: solid; border-width: thin; padding-left: 35px; padding-right: 35px; padding-top: 10px;">  <br>  </div>
                <div style="display: table-cell; border: solid; border-width: thin; padding-left: 35px; padding-right: 35px; padding-top: 10px;">  <br>     </div>
                <div style="display: table-cell; border: solid; border-width: thin; padding-left: 196px; padding-right: 196px; padding-top: 10px;">  <br>     </div>
                <div style="display: table-cell; border: solid; border-width: thin; padding-left: 35px; padding-right: 35px; padding-top: 10px;">  <br>  </div>
                <div style="display: table-cell; border: solid; border-width: thin; padding-left: 35px; padding-right: 35px; padding-top: 10px;">  <br>     </div>
            </div>
            <div style="display: table-row; ">
                <div style="display: table-cell; border: solid; border-width: thin; padding-left: 35px; padding-right: 35px; padding-top: 10px;">  <br>     </div>
                <div style="display: table-cell; border: solid; border-width: thin; padding-left: 35px; padding-right: 35px; padding-top: 10px;">  <br>  </div>
                <div style="display: table-cell; border: solid; border-width: thin; padding-left: 35px; padding-right: 35px; padding-top: 10px;">  <br>     </div>
                <div style="display: table-cell; border: solid; border-width: thin; padding-left: 196px; padding-right: 196px; padding-top: 10px;">  <br>     </div>
                <div style="display: table-cell; border: solid; border-width: thin; padding-left: 35px; padding-right: 35px; padding-top: 10px;">  <br>  </div>
                <div style="display: table-cell; border: solid; border-width: thin; padding-left: 35px; padding-right: 35px; padding-top: 10px;">  <br>     </div>
            </div>
            <div style="display: table-row; ">
                <div style="display: table-cell; border: solid; border-width: thin; padding-left: 35px; padding-right: 35px; padding-top: 10px;">  <br>     </div>
                <div style="display: table-cell; border: solid; border-width: thin; padding-left: 35px; padding-right: 35px; padding-top: 10px;">  <br>  </div>
                <div style="display: table-cell; border: solid; border-width: thin; padding-left: 35px; padding-right: 35px; padding-top: 10px;">  <br>     </div>
                <div style="display: table-cell; border: solid; border-width: thin; padding-left: 196px; padding-right: 196px; padding-top: 10px;">  <br>     </div>
                <div style="display: table-cell; border: solid; border-width: thin; padding-left: 35px; padding-right: 35px; padding-top: 10px;">  <br>  </div>
                <div style="display: table-cell; border: solid; border-width: thin; padding-left: 35px; padding-right: 35px; padding-top: 10px;">  <br>     </div>
            </div>
            <div style="display: table-row; ">
                <div style="display: table-cell; border: solid; border-width: thin; padding-left: 35px; padding-right: 35px; padding-top: 10px;">  <br>     </div>
                <div style="display: table-cell; border: solid; border-width: thin; padding-left: 35px; padding-right: 35px; padding-top: 10px;">  <br>  </div>
                <div style="display: table-cell; border: solid; border-width: thin; padding-left: 35px; padding-right: 35px; padding-top: 10px;">  <br>     </div>
                <div style="display: table-cell; border: solid; border-width: thin; padding-left: 196px; padding-right: 196px; padding-top: 10px;">  <br>     </div>
                <div style="display: table-cell; border: solid; border-width: thin; padding-left: 35px; padding-right: 35px; padding-top: 10px;">  <br>  </div>
                <div style="display: table-cell; border: solid; border-width: thin; padding-left: 35px; padding-right: 35px; padding-top: 10px;">  <br>     </div>
            </div>
            <div style="display: table-row; ">
                <div style="display: table-cell; border: solid; border-width: thin; padding-left: 35px; padding-right: 35px; padding-top: 10px;">  <br>     </div>
                <div style="display: table-cell; border: solid; border-width: thin; padding-left: 35px; padding-right: 35px; padding-top: 10px;">  <br>  </div>
                <div style="display: table-cell; border: solid; border-width: thin; padding-left: 35px; padding-right: 35px; padding-top: 10px;">  <br>     </div>
                <div style="display: table-cell; border: solid; border-width: thin; padding-left: 196px; padding-right: 196px; padding-top: 10px;">  <br>     </div>
                <div style="display: table-cell; border: solid; border-width: thin; padding-left: 35px; padding-right: 35px; padding-top: 10px;">  <br>  </div>
                <div style="display: table-cell; border: solid; border-width: thin; padding-left: 35px; padding-right: 35px; padding-top: 10px;">  <br>     </div>
            </div>
        </div>

        <br>
        <div style="border: 1px solid black">
            <table id="table" width="100%"  border="0" cellpadding="5">
                <tr >
                    <td id="gris"  colspan="6" style="border: 1px solid black">
                        <div align="center" >
                            <b> 4. ACCIONES REALIZADAS </b>
                        </div>
                    </td>
                </tr>
            </table>

            <table id="table" width="100%" border="1" cellspacing="0" cellpadding="0" style="text-align: center; font-size: 0.90em;">
                <thead>
                    <tr>
                        <td style='width: 10%;'> <b> FECHA </b> </td>
                        <td style='width: 30%;'> <b> Descripción  </b> </td>
                        <td style='width: 10%;'> <b> Responsable  </b> </td>
                        <td style='width: 10%;'> <b> Firma  </b> </td>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                    </tr>
                    <tr>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                    </tr>
                    <tr>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                    </tr>
                    <tr>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                    </tr>
                    <tr>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                    </tr>
                    <tr>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                    </tr>
                    <tr>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                    </tr>
                    <tr>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                    </tr>
                    <tr>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                    </tr>
                    <tr>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                    </tr>
                    <tr>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                    </tr>
                    <tr>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                    </tr>
                    <tr>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                    </tr>
                    <tr>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                    </tr>
                    <tr>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                    </tr>
                    <tr>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                        <td style="height: 30px;"> <br> </td>
                    </tr>

                </tbody>
            </table>
        </div>

        <br>
        <div style="border: 1px solid black; ">
            <table id="table" width="100%"  border="0" cellpadding="5">
                <tr >
                    <td id="gris"  colspan="6" style="border: 1px solid black">
                        <div align="center" >
                            <b> 5. CIERRE DE ORDEN DE TRABAJO </b>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td id="gris" colspan="2"  style="border-right: 0px; width: 50%; " >
                        <div align="center" >
                            <b> F.______________________________ </b>
                            <br>
                            <b>   {{ $ots->user->name.' '.$ots->user->lastname}}</b>
                            <br>
                            <b> Area {{ $ots->area->name }} </b>
                        </div>
                    </td>

                    <td id="gris" colspan="2"  style="border-left:0px; width: 50%; " >
                        <div  align="center">
                            <b> F.______________________________ </b>
                            <br>
                            <b>   {{ getApprovalOT(null, $ots->idapproval) }} </b>
                            <br>
                            <b> Vo.Bo. Jefatura de Mantenimiento </b>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td id="gris" colspan="3"  style="border-right: 0px; width: 50%; " >
                        <div  >
                            <b> Fecha: </b>
                        </div>
                    </td>

                    <td id="gris" colspan="3"  style="border-right: 0px; width: 50%; " >
                        <div  >
                            <b> Hora: </b>
                        </div>
                    </td>
                </tr>

            </table>
        </div>
    </body>

</html>
