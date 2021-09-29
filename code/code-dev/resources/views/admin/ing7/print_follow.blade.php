<!DOCTYPE>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">  
    <title>ING-7 - NO.{{ $ings7->correlative }} </title>
    
    <body>

        <br><br><br><br> <br><br><br><br> <br><br><br><br> <br><br><br><br> 
        <br><br><br><br> <br><br><br><br> <br><br><br><br> <br><br><br><br>
        <br><br><br><br> <br><br><br><br> <br><br><br><br> <br><br>

        <div style="text-align: center;">
            <small><strong> FICHA DE SEGUIMIENTO </strong></small>  
        </div>

        <br>
        


        <table id="table" width="100%" border="1" cellspacing="0" cellpadding="0" style="text-align: center; font-size: 0.85em;">
            <thead>
                <tr>
                    <td > <b> FECHA  </b> </td>
                    <td > <b> ACCION TOMADA  </b> </td>
                    <td > <b> RESPONSABLE    </b> </td>
                    <td > <b> FIRMA Y SELLO  </b> </td>
                </tr>  
            </thead>  
            
            <tbody>
                @foreach($ings7->ings7f as $if)
                    <tr>
                        <td  > {{ $if->date }} </td>
                        <td  > {{ $if->action }} </td>
                        <td  > {{ $if->user->name.' '.$if->user->lastname }}</td>
                        <td  >  </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="text-align: left; font-size: 0.600em;">
            <small><strong> TALLERES IGSS </strong></small>  
        </div>


    </body>

</html>