<html>
    <head>
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <style>
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
            <h1>Formulario de creación de Cliente</h1>
            @error('general')
                <div class="alert alert-danger" role="alert">
                        {{$message}}
                </div>
            @enderror
            <form action="{{url('cliente')}}" method="post">
        
                @csrf
                
                <input name = "nombre"              class="form-control"    type="text"    placeholder="nombre del cliente"         
                value="{{old('nombre')}}" required>
                @error('nombre')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <br>
                
                <input name = "apellidos"           class="form-control"    type="text"    placeholder="apellidos del cliente"    
                value="{{old('apellidos')}}" required>
                @error('apellidos')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <br>
                
                <input name = "fecha_nacimiento"    class="form-control"    type="date"    placeholder="fecha de nacimiento del cliente"  
                value="{{old('fecha_nacimiento')}}" required>
                @error('fecha_nacimiento')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <br>
                
                <input name = "correo_electronico"  class="form-control"    type="email"   placeholder="email"  
                value="{{old('correo_electronico')}}" required>
                @error('correo_electronico')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <br>
                
                <input name = "clave"               class="form-control"    type="password" placeholder="Contraseña del cliente"   
                value="{{old('clave')}}" required>
                @error('clave')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <br>
                
                <input name = "telefono"            class="form-control"    type="number"   placeholder="telefono" 
                value="{{old('telefono')}}">
                @error('telefono')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <br>
                
                <input name = "direccion"            class="form-control"    type="text"    placeholder="direccion" 
                value="{{old('direccion')}}">
                @error('direccion')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <br>
                
                <input name = "estado_civil"         class="form-control"    type="text"    placeholder="estado_civil" 
                value="{{old('estado_civil')}}">
                @error('estado_civil')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <br>
                
                <input name = "sueldo_anual"         class="form-control"    type="text"    placeholder="sueldo_anual" 
                value="{{old('sueldo_anual')}}">
                @error('sueldo_anual')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <br>
                
                <input type="submit" class="btn btn-success col-md-12" value="CrearCliente"></input>
            
            </form>
            <br>
            <br>
            <form action="{{url('cliente')}}" method="GET">
                <input type="submit" class="btn btn-info col-md-12" value="Volver a inicio"></input>
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