<!DOCTYPE>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> </title>

    <style>

        table {
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 5px;
        }
    </style>

    <body style="font-size: 14px; font-family: 'Roboto Slab', serif;">
        <div style="float: left; margin-top: -25px;"" >
            <img src="{{ url('img/Isotipo.png') }}" alt="" width="80px" height="80px">
        </div>

        <div style="text-align: center; margin-top: 16;">
            <span><strong> SOLICITUD DE DIETAS DIARIAS </strong> </span>
        </div>

        <div style="float: right; margin-top: -25px;">
            <span><strong> SPS-184 </strong> </span>
        </div>

        <br><br>

        <div style="float: left; margin-top: 25px; margin-left: -80px; width:150px;height:25px;" >
            Tiempo de Alimentacion: <input type="text" style="border:1px solid #000000;width:150px;height:25px;">
        </div>

        <div style="float: right; margin-top: 25px; margin-right: 50px; width:150px;height:25px;">
            Fecha: <input type="text" style="border:1px solid #000000;width:150px;height:25px;">
        </div>

        <table width="100%"  style=" margin-top:65px;" >
            <TR>
                <TH  style="width: 50px;" >Servicio</TH>
                <TD colspan="1" style="width: 25px;"></TD>
                <TH  style="width: 50px;" ALIGN="center">Nombre Jefe</TH>
                <TD colspan="1" style="width: 75px;"></TD>
                <TH  style="width: 50px;">Firma</TH>
                <TD colspan="1" style="width: 75px;"></TD>
            </TR>

            <tr>
                <th colspan="2"> Tipo de Dietas</th>
                <th colspan="2"> Numero de las Camas</th>
                <th colspan="1"> Total</th>
                <th colspan="1"> </th>
            </tr>

            <TR>
                <TH ROWSPAN="4" style="width: 150px;">LIQUIDAS</TH>
                <TH ROWSPAN="2" style="width: 150px;">Claros</TH>
                <TD colspan="2"  style="width: 100px;"></TD>
                <TD ROWSPAN="2" colspan="2" ALIGN="center" style="width: 10px;"></TD>
            </TR>

            <TR>
                <TD colspan="2"></TD>
            </TR>

            <TR>
                <TH ROWSPAN="2">Complementos</TH>
                <TD colspan="2"></TD>
                <TD ROWSPAN="2" colspan="2" ALIGN="center"></TD>
            </TR>

            <TR>
                <TD colspan="2"></TD>
            </TR>

            <TR>
                <TH ROWSPAN="3" colspan="2" ALIGN="center">Blanda</TH>
                <TD colspan="2"></TD>
                <TD ROWSPAN="3" colspan="2"></TD>

            </TR>

            <TR>
                <TD colspan="2"></TD>
            </TR>

            <TR>
                <TD colspan="2"></TD>
            </TR>

            <TR>
                <TH ROWSPAN="2" colspan="2" ALIGN="center">Papilla (licuada/puré)</TH>
                <TD colspan="2"></TD>
                <TD ROWSPAN="2" colspan="2"></TD>

            </TR>

            <TR>
                <TD colspan="2"></TD>
            </TR>

            <TR>
                <TH ROWSPAN="2" colspan="2" ALIGN="center">Picada</TH>
                <TD colspan="2"></TD>
                <TD ROWSPAN="2" colspan="2"></TD>

            </TR>

            <TR>
                <TD colspan="2"></TD>
            </TR>

            <TR>
                <TH ROWSPAN="2" colspan="2" ALIGN="center">Hipograsa</TH>
                <TD colspan="2"></TD>
                <TD ROWSPAN="2" colspan="2"></TD>

            </TR>

            <TR>
                <TD colspan="2"></TD>
            </TR>

            <TR>
                <TH ROWSPAN="2" colspan="2" ALIGN="center">Hiposódica</TH>
                <TD colspan="2"></TD>
                <TD ROWSPAN="2" colspan="2"></TD>

            </TR>

            <TR>
                <TD colspan="2"></TD>
            </TR>


            <TR>
                <TH ROWSPAN="4">DIABETICA</TH>
                <TH> 1,500 Calorias</TH>
                <TD colspan="2"></TD>
                <TD ROWSPAN="4" colspan="2" ALIGN="center"></TD>
            </TR>

            <TR>
                <TH> 1,800 Calorias</TH>
                <TD colspan="2"></TD>
            </TR>

            <TR>
                <TH> 2,0000 Calorias</TH>
                <TD colspan="2"></TD>
            </TR>

            <TR>
                <TH> 2,200 Calorias</TH>
                <TD colspan="2"></TD>
            </TR>

            <TR>
                <TH ROWSPAN="5" colspan="2" ALIGN="center">Libre</TH>
                <TD colspan="2"></TD>
                <TD ROWSPAN="5" colspan="2"></TD>

            </TR>

            <TR>
                <TD colspan="2"></TD>
            </TR>

            <TR>
                <TD colspan="2"></TD>
            </TR>

            <TR>
                <TD colspan="2"></TD>
            </TR>

            <TR>
                <TD colspan="2"></TD>
            </TR>


            <TR>
                <TH ROWSPAN="9">PEDIATRICAS</TH>
                <TH ROWSPAN="3">06 a 09 meses (papilla)</TH>
                <TD colspan="2"></TD>
                <TD ROWSPAN="3" colspan="2" ALIGN="center"></TD>
            </TR>

            <TR>
                <TD colspan="2"></TD>
            </TR>

            <TR>
                <TD colspan="2"></TD>
            </TR>

            <TR>
                <TH ROWSPAN="3">09 a 12 meses (picada)</TH>
                <TD colspan="2"></TD>
                <TD ROWSPAN="3" colspan="2" ALIGN="center"></TD>
            </TR>

            <TR>
                <TD colspan="2"></TD>
            </TR>

            <TR>
                <TD colspan="2"></TD>
            </TR>

            <TR>
                <TH ROWSPAN="3">01 a 07 años (libre)</TH>
                <TD colspan="2"></TD>
                <TD ROWSPAN="3" colspan="2" ALIGN="center"></TD>
            </TR>

            <TR>
                <TD colspan="2"></TD>
            </TR>

            <TR>
                <TD colspan="2"></TD>
            </TR>

            <TR>
                <TH ROWSPAN="3" colspan="2" ALIGN="center">Dietas calculadas por Nutrición</TH>
                <TD colspan="2"></TD>
                <TD ROWSPAN="3" colspan="2"></TD>

            </TR>

            <TR>
                <TD colspan="2"></TD>
            </TR>

            <TR>
                <TD colspan="2"></TD>
            </TR>

            <TR>
                <TH ROWSPAN="3" colspan="2" ALIGN="center">OTRAS (Especificar)</TH>
                <TD colspan="2"></TD>
                <TD ROWSPAN="3" colspan="2"></TD>

            </TR>

            <TR>
                <TD colspan="2"></TD>
            </TR>

            <TR>
                <TD colspan="2"></TD>
            </TR>

            <TR>
                <TH ROWSPAN="1" colspan="2" ALIGN="center">NPO</TH>
                <TD colspan="2"></TD>
                <TD ROWSPAN="1" colspan="2"></TD>
            </TR>



        </TABLE>





    </body>
</html>

