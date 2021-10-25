<!DOCTYPE>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Etiqueta - {{ $equipment->code_new }} </title>
	<link type="text/css" rel="stylesheet" href="estilos.css" />

    <body style="text-align: center;">
        <strong> Equipo </strong> <br>
        {{ $equipment->name }} <br>
        <strong> Codigo </strong> <br>
        {{ $equipment->code_new }} <br><br>
        <div class="input-group">
            <img src="data:image/png;base64, {{ base64_encode( QrCode::size(125)->generate('http://10.11.0.30:8500/admin/equipment/'.$equipment->id.'/edit')) }} ">
        </div>
    </body>

</html>
