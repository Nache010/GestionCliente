<?php

namespace App\Http\Controllers;

use App\Cliente;
use Illuminate\Http\Request;
use App\Http\Requests\ClienteRequest;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        
        $op = $request->session()->get('op');
        if($op != null){
            
            $mensajes = [
            'store'     => 'El cliente ha sido creado con exito' ,
            'update'    => 'El cliente ha sido actualizado con exito',
            'destroy'   => 'El cliente ha sido borrado con exito',
            ];
            $clientes = Cliente::all();               
            return view('index')->with(['clientes' => $clientes , 'mensaje' => $mensajes[$op]]);
            
        } else {
            $clientes = Cliente::all();               
            return view('index')->with(['clientes' => $clientes]);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClienteRequest $request){
        $input = $request->validated();
        $vehiculo = new Cliente($input);
        $vehiculo->ip = $request->ip();
        try{
            $result = $vehiculo->save();
        }catch(\Exception $e){
            $error = [
                'general' => $e->getMessage(),
            ];
            
            return redirect(route('cliente.create'))->withErrors($error)->withInput();
        }
        
        
        return redirect(route('cliente.index'))->with(['op'=>'store']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        return view('show')->with(['cliente'=>$cliente]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        return view('edit')->with(['cliente' => $cliente]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(ClienteRequest $request, Cliente $cliente) {
        $input = $request->validated();
        try{
            $cliente->update($input);
        }catch(\Exception $e){
            $error = [
                'general' => $e->getMessage(),
            ];
            return redirect('cliente/'.$cliente->id.'/edit')->withErrors($error)->withInput();
        }
        
        return redirect(route('cliente.index'))->with(['op'=>'update']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente){
        try{
            $cliente->delete();
        } catch(\Exception $e){
            $error=['general'=>'Error borrando el Cliente'];
            return redirect(route('cliente.index'))->withErrors($error);
        }
        return redirect(route('cliente.index'))->with(['op'=>'destroy']);

    }
}
