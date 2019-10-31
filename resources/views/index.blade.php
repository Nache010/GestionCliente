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
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="panel panel-primary filterable">
                    <div class="panel-heading">
                        <h3 class="panel-title">Clientes</h3>
                        <div class="pull-right">
                            <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                        </div>
                    </div>
                    @isset($mensaje)
                        <div class="alert alert-success" role="alert">
                              {{$mensaje}}
                        </div>
                    @endisset
                    @error('general')
                        <div class="alert alert-danger" role="alert">
                                {{$message}}
                        </div>
                    @enderror
                    <table class="table">
                        <thead>
                            <tr class="filters">
                                <th><input type="text" class="form-control" placeholder="#" disabled></th>
                                <th><input type="text" class="form-control" placeholder="Nombre" disabled></th>
                                <th><input type="text" class="form-control" placeholder="Apellidos" disabled></th>
                                <th><input type="text" class="form-control" placeholder="Fecha nacimiento" disabled></th>
                                <th><input type="text" class="form-control" placeholder="Correo Electronico" disabled></th>
                                <th><input type="text" class="form-control" placeholder="Telefono" disabled></th>
                                <th><input type="text" class="form-control" placeholder="Direccion" disabled></th>
                                <th colspan="3" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clientes as $cliente)
                            <tr>
                                <td>{{$cliente->id}}</td>
                                <td>{{$cliente->nombre}}</td>
                                <td>{{$cliente->apellidos}}</td>
                                <td>{{$cliente->fecha_nacimiento}}</td>
                                <td>{{$cliente->correo_electronico}}</td>
                                <td>{{$cliente->telefono}}</td>
                                <td>{{$cliente->direccion}}</td>
                                <td>
                                    <form action="{{url('cliente/'.$cliente->id)}}" method="GET">
                                        <input type="submit" class="btn btn-primary" value="Ver Cliente"></input>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{url('cliente/'.$cliente->id.'/edit')}}" method="GET">
                                        <input type="submit" class="btn btn-warning" value="Editar Cliente"></input>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{url('cliente/'.$cliente->id)}}" class="destroy" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" class="btn btn-danger" value="Eliminar Cliente"></input>
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <form action="{{url('cliente/create')}}" method="GET">
                <input type="submit" class="btn btn-success col-md-12" value="Crear nuevo cliente"></input>
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
    <script src="{{url('assets/js/main.js')}}"></script>
</html>