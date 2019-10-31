<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    
    public function attributes(){
        return [
            'nombre'                => 'Nombre del Cliente',
            'apellidos'             => 'Apellidos del Cliente',
            'fecha_nacimiento'      => 'Fecha de nacimiento del Cliente',
            'correo_electronico'    => 'Email del Cliente',
            'clave'                 => 'Clave de acceso del Cliente',
            'telefono'              => 'Telefono del Cliente',
            'direccion'             => 'Direccion del Cliente',
            'estado_civil'          => 'Estado civil del Cliente',
            'sueldo_anual'          => 'Sueldo anual del cliente'
        ];
        
    }
    
    
    public function messages(){
        $required = 'El campo :attribute es obligatorio';
        $min = 'La longitud minima del campo :attribute es :min';
        $max = 'La longitud maxima del campo :attribute es :max';
        return [
            'nombre.required'               => $required ,
            'nombre.max'                    => $max ,
            'apellidos.required'            => $required ,
            'apellidos.max'                 => $max ,  
            'fecha_nacimiento.required'     => $required ,
            'fecha_nacimiento.date'         => 'La fecha no está introducida con el formato correcto' ,
            'correo_electronico.required'   => $required ,
            'correo_electronico.max'        => $max ,
            'clave'                         => $required ,
            'clave.max'                     => $max ,
            'telefono.min'                  => $min ,
            'telefono.max'                  => $max ,
            'direccion.max'                 => $max ,
            'estado_civil.max'              => $max ,
            ''
            ];
    }




    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre'                => 'required    | max:50',
            'apellidos'             => 'required    | max:100',
            'fecha_nacimiento'      => 'required    | date',
            'correo_electronico'    => 'required    | max:100',
            'clave'                 => 'required    | max:100',
            'telefono'              => 'max:9       | min:9',
            'direccion'             => 'max:150',
            'estado_civil'          => 'max:20',
            'sueldo_anual'          => ''
        ];
    }
}
