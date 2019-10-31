<html>
    <head>
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <style>
            body{
                font-family: "Montserrat";
            }
            .filterable {
                margin-top: 15px;
                width: 50%;
                margin-left: 25%;
            }
            .filterable .panel-heading .pull-right {
                margin-top: -20px;
            }
            .filterable .filters input[disabled] {
                background-color: transparent;
                border: none;
                cursor: auto;
                box-shadow: none;
                padding: 0;
                height: auto;
            }
            .filterable .filters input[disabled]::-webkit-input-placeholder {
                color: #333;
            }
            .filterable .filters input[disabled]::-moz-placeholder {
                color: #333;
            }
            .filterable .filters input[disabled]:-ms-input-placeholder {
                color: #333;
            }
            .vuelta{
                width: 50%;
                margin-left: 25%;
            }
            .nacho{
                box-sizing:border-box;
                margin-left: 30px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="panel panel-primary filterable">
                    <div class="panel-heading">
                        <h3 class="panel-title">Cliente {{$cliente->nombre}}</h3>
                    </div>
                    <table class="table table-striped">
                        <tr>
                            <th class="nacho">#</th>
                            <td>{{$cliente->id}}</td>
                        </tr>
                        <tr>
                            <th class="nacho">nombre</th>
                            <td>{{$cliente->nombre}}</td>
                        </tr>
                        <tr>
                            <th class="nacho">apellidos</th>
                            <td>{{$cliente->apellidos}}</td>
                        </tr>
                        <tr>
                            <th class="nacho">fecha nacimiento</th>
                            <td>{{$cliente->fecha_nacimiento}}</td>
                        </tr>
                        <tr>
                            <th class="nacho">correo electronico</th>
                            <td>{{$cliente->correo_electronico}}</td>
                        </tr>
                        <tr>
                            <th class="nacho">telefono</th>
                            <td>{{$cliente->telefono}}</td>
                        </tr>
                        <tr>
                            <th class="nacho">direccion</th>
                            <td>{{$cliente->direccion}}</td>
                        </tr>
                        <tr>
                            <th class="nacho">estado civil</th>
                            <td>{{$cliente->estado_civil}}</td>
                        </tr>
                        <tr>
                            <th class="nacho">sueldo anual</th>
                            <td>{{$cliente->sueldo_anual}}</td>
                        </tr>
                        <tr>
                            <th class="nacho">Clave privada</th>
                            <td>{{$cliente->clave}}</td>
                        </tr>
                        <tr>
                            <th class="nacho">IP privada</th>
                            <td>{{$cliente->ip}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <form action="{{url('cliente')}}" method="GET">
                <input type="submit" class="btn btn-dark col-md-12 vuelta" value="Volver"></input>
            </form>
        </div>
        
    </body>
    <script>
        $(document).ready(function(){
            $('.filterable .btn-filter').click(function(){
                var $panel = $(this).parents('.filterable'),
                $filters = $panel.find('.filters input'),
                $tbody = $panel.find('.table tbody');
                if ($filters.prop('disabled') == true) {
                    $filters.prop('disabled', false);
                    $filters.first().focus();
                } else {
                    $filters.val('').prop('disabled', true);
                    $tbody.find('.no-result').remove();
                    $tbody.find('tr').show();
                }
            });
        
            $('.filterable .filters input').keyup(function(e){
                /* Ignore tab key */
                var code = e.keyCode || e.which;
                if (code == '9') return;
                /* Useful DOM data and selectors */
                var $input = $(this),
                inputContent = $input.val().toLowerCase(),
                $panel = $input.parents('.filterable'),
                column = $panel.find('.filters th').index($input.parents('th')),
                $table = $panel.find('.table'),
                $rows = $table.find('tbody tr');
                /* Dirtiest filter function ever ;) */
                var $filteredRows = $rows.filter(function(){
                    var value = $(this).find('td').eq(column).text().toLowerCase();
                    return value.indexOf(inputContent) === -1;
                });
                /* Clean previous no-result if exist */
                $table.find('tbody .no-result').remove();
                /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
                $rows.show();
                $filteredRows.hide();
                /* Prepend no-result row if all rows are filtered */
                if ($filteredRows.length === $rows.length) {
                    $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
                }
            });
});
    </script>
</html>