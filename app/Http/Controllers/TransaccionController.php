<?php

namespace App\Http\Controllers;

use App\transaccion;
use Illuminate\Http\Request;

class TransaccionController extends Controller
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
    *      path="/api/movimientos/listar",
    *      operationId="show",
    *      tags={"Projects"},
    *      summary="Get list of projects",
    *      description="Listar movimientos.",
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
    public function show($cuenta)
    {
        $movimientos = transaccion::where('fk_cuenta', $cuenta)->get();
        if (empty($movimientos)) {
            $resp = array(
                "success" => false,
                "mensaje" => "No hay movimientos"
            );
        } else {
            $resp = array(
                "success" => true,
                "mensaje" => $movimientos
            );
        }
        return $resp;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\transaccion  $transaccion
     * @return \Illuminate\Http\Response
     */
    public function edit(transaccion $transaccion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\transaccion  $transaccion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, transaccion $transaccion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\transaccion  $transaccion
     * @return \Illuminate\Http\Response
     */
    public function destroy(transaccion $transaccion)
    {
        //
    }
}
