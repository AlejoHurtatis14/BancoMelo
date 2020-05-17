<?php

namespace App\Http\Controllers;

use App\codigo_solicitud;
use Illuminate\Http\Request;

class CodigoSolicitudController extends Controller
{

    /* public function __constructor()
    {
        $this->middleware('cors');
    } */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function create(Request $request)
    {
        $codigo = new codigo_solicitud;
        $codigo->saldo = $request->saldo;
        $codigo->codigo = $request->codigo;
        $codigo->estado = $request->estado;
        $codigo->fk_cuenta = $request->fk_cuenta;

        if($codigo->save()){
            $resp = array(
                "success" => true,
                "mensaje" => "Se ha creado el usuario"
            );
        }else{

            $resp = array(
                "success" => false,
                "mensaje" => "No se ha creado el usuario"
            );
        }

        return $resp;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\codigo_solicitud  $codigo_solicitud
     * @return \Illuminate\Http\Response
     */
    public function show(codigo_solicitud $codigo_solicitud)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\codigo_solicitud  $codigo_solicitud
     * @return \Illuminate\Http\Response
     */
    public function edit(codigo_solicitud $codigo_solicitud)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\codigo_solicitud  $codigo_solicitud
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, codigo_solicitud $codigo_solicitud)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\codigo_solicitud  $codigo_solicitud
     * @return \Illuminate\Http\Response
     */
    public function destroy(codigo_solicitud $codigo_solicitud)
    {
        //
    }
}
