<?php

namespace App\Http\Controllers;

use App\cuentas;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CuentasController extends Controller
{
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
    public function create()
    {
        //
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
    * @OA\Get(
    *      path="/api/cuentas/listar",
    *      operationId="show",
    *      tags={"Projects"},
    *      summary="Get list of projects",
    *      description="Listar cuentas.",
    *      @OA\Parameter(
    *         name="authorization",
    *         in="header",
    *         description="Header de autorización.",
    *         required=false,
    *         @OA\Schema(
    *             type="string"
    *         )
    *      ),
    *      @OA\Response(
    *          response=200,
    *          description="Operación correcta."
    *       ),
    *       @OA\Response(response=400, description="Bad request"),
    *       security={
    *           {"api_key_security_example": {}}
    *       }
    *     )
    */
    public function show(cuentas $cuentas)
    {
        $cuentas = cuentas::where('estado', 1)->orWhere('estado', 0)->get();
        if (empty($cuentas)) {
            $resp = array(
                "success" => false,
                "mensaje" => "No hay cuentas"
            );
        } else {
            $resp = array(
                "success" => true,
                "mensaje" => $cuentas
            );
        }
        return $resp;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\cuentas  $cuentas
     * @return \Illuminate\Http\Response
     */
    public function edit(cuentas $cuentas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\cuentas  $cuentas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cuentas $cuentas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\cuentas  $cuentas
     * @return \Illuminate\Http\Response
     */
    public function destroy(cuentas $cuentas)
    {
        //
    }

    /**
    * @OA\Get(
    *      path="/api/cuentas/filter",
    *      operationId="filter",
    *      tags={"Projects"},
    *      summary="Get list of projects",
    *      description="Listar cuentas.",
    *      @OA\Parameter(
    *         name="authorization",
    *         in="header",
    *         description="Header de autorización.",
    *         required=false,
    *         @OA\Schema(
    *             type="string"
    *         )
    *      ),
    *      @OA\Parameter(
    *         name="nombre",
    *         in="query",
    *         description="Nombre de la cuenta.",
    *         required=true,
    *         @OA\Schema(
    *             type="string",
    *         )
    *      ),
    *      @OA\Parameter(
    *         name="estado",
    *         in="query",
    *         description="Estado de la cuenta.",
    *         required=true,
    *         @OA\Schema(
    *             type="string",
    *         )
    *      ),
    *      @OA\Parameter(
    *         name="saldo",
    *         in="query",
    *         description="Saldo actual en tarjeta.",
    *         required=false,
    *         @OA\Schema(
    *             type="string",
    *         )
    *      ),
    *      @OA\Response(
    *          response=200,
    *          description="Operación correcta."
    *       ),
    *       @OA\Response(response=400, description="Bad request"),
    *       security={
    *           {"api_key_security_example": {}}
    *       }
    *     )
    */
    public function filter(Request $request)
    {
        $properties = ['nombre', 'estado', 'saldo'];
        $stringCode = 'use App\cuentas; return cuentas::';
        for ($i = 0; $i < 3 ; $i++) { 
            if ($request[$properties[$i]]) {
                $stringCode = $stringCode . "where('" .  $request[$properties[$i]][0] . "','" . $request[$properties[$i]][1] . "','" . $request[$properties[$i]][2] . "')->";
            }
        }
        $stringCode = $stringCode . 'get();';
        $cuentas = eval($stringCode);
        if (empty($cuentas)) {
            $resp = array(
                "success" => false,
                "mensaje" => "No hay cuentas"
            );
        } else {
            $resp = array(
                "success" => true,
                "mensaje" => $cuentas
            );
        }
        return $resp;
    }

    /**
    * @OA\Get(
    *      path="/api/cuentas/listar-estadistica",
    *      operationId="listarEstadistica",
    *      tags={"Projects"},
    *      summary="Get list of projects",
    *      description="Listar movimientos para la estadistica.",
    *      @OA\Parameter(
    *         name="authorization",
    *         in="header",
    *         description="Header de autorización.",
    *         required=false,
    *         @OA\Schema(
    *             type="string"
    *         )
    *      ),
    *      @OA\Response(
    *          response=200,
    *          description="Operación correcta."
    *       ),
    *       @OA\Response(response=400, description="Bad request"),
    *       security={
    *           {"api_key_security_example": {}}
    *       }
    *     )
    */
    public function listarEstadistica()
    {
        $cuentas = cuentas::select('created_at')->get();
        if (empty($cuentas)) {
            $resp = array(
                "success" => false,
                "mensaje" => "No hay cuentas"
            );
        } else {
            $resp = array(
                "success" => true,
                "mensaje" => $cuentas
            );
        }
        return $resp;
    }

}
