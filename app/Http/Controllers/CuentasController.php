<?php

namespace App\Http\Controllers;

use App\cuentas;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\codigo_solicitud;
use App\transaccion;
use Carbon\Carbon;

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
    public function create(Request $request)
    {
    
        $cuenta = new cuentas;
        $cuenta->fk_usuario = $request->idUsuario;
        $cuenta->estado = $request->estado;
        $cuenta->password = $request->clave;
        $cuenta->nombre = $request->nombre;
        $cuenta->saldo = $request->saldo;
        $cuenta->fk_tipo_cuenta = $request->tipoCuenta;
        if($cuenta->save()){
            $resp = array(
                "success" => true,
                "mensaje" => "Se ha creado la cuenta"
            );
        }else{
            $resp = array(
                "success" => false,
                "mensaje" => "No se ha creado la cuenta"
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
        $cuentas = cuentas::join('usuarios', 'usuarios.id', '=', 'cuentas.fk_usuario')
        ->select('cuentas.*', 'usuarios.nombres as fk_usuario', 'usuarios.apellidos')
        ->get();
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
        $cuenta = cuentas::where('id', $request['cuenta'])->get();
        if (!empty($cuenta[0])) {
            $total = $cuenta[0]['saldo'] + $request['valor'];
            $resul = cuentas::where('id', $request['cuenta'])->update(['saldo' => $total]);
            $transaccion = new transaccion;
            $transaccion->monto = $request['valor'];
            $transaccion->saldo_anterior = $cuenta[0]['saldo'];
            $transaccion->saldo_Actual = $total;
            $transaccion->fk_usuario_creador = $request['creador'];
            $transaccion->fk_cuenta = $request['cuenta'];
            $transaccion->fk_tipo_transaccion = $request['transaccion'];
            $transaccion->fk_codigo = '';
            if($transaccion->save()){
                $resp = array(
                    "success" => true,
                    "mensaje" => 'Consignación exitosa.'
                );
            } else {
                $resul = cuentas::where('id', $codigo[0]['fk_cuenta'])->update(['saldo' => $cuenta[0]['saldo']]);
                $resp = array(
                    "success" => false,
                    "mensaje" => "Transaccion erronea."
                );
            }
        } else {
            $resp = array(
                "success" => false,
                "mensaje" => 'No se encontro cuenta.'
            );
        }
        return $resp;
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
        $stringCode = $stringCode . 'join("usuarios", "usuarios.id", "=", "cuentas.fk_usuario")
        ->select("cuentas.*", "usuarios.nombres as fk_usuario", "usuarios.apellidos")
        ->get();get();';
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


    public function getUserAccounts($idUsuario)
    {
        $cuentas = cuentas::where('fk_usuario', $idUsuario)->where('estado', 1)->get();
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

    public function validarTiempoCodigo($fechaCreacion, $fechaActual){
        $creacion = Carbon::createFromFormat('Y-m-d H:i:s', $fechaCreacion);
        $vence = Carbon::createFromFormat('Y-m-d H:i:s', new Carbon($fechaActual));
        $diferencia = $creacion->diffInMinutes($vence);
        return $diferencia <= 60 ? true : false;
    }

    public function retirarCuenta(Request $request, cuentas $cuentas)
    {
        $codigo = codigo_solicitud::where('codigo', $request['valor'])->where('fk_cuenta', $request['cuenta'])->get();
        error_log($codigo);
        if (!empty($codigo[0])) {
            if ($codigo[0]['estado'] === '1') {
                if ($this->validarTiempoCodigo($codigo[0]['created_at'],$request['fechaActual'])) {
                    $cuenta = cuentas::where('id', $codigo[0]['fk_cuenta'])->get();
                    $saldoNuevo = $cuenta[0]['saldo'] - $codigo[0]['saldo'];
                    if ($saldoNuevo >= 0) {
                        $resul = cuentas::where('id', $codigo[0]['fk_cuenta'])->update(['saldo' => $saldoNuevo]);
                        $transaccion = new transaccion;
                        $transaccion->monto = $codigo[0]['saldo'];
                        $transaccion->saldo_anterior = $cuenta[0]['saldo'];
                        $transaccion->saldo_Actual = $saldoNuevo;
                        $transaccion->fk_usuario_creador = $request['creador'];
                        $transaccion->fk_cuenta = $codigo[0]['fk_cuenta'];
                        $transaccion->fk_tipo_transaccion = $request['transaccion'];
                        $transaccion->fk_codigo = $codigo[0]['id'];
                        if($transaccion->save()){
                            $result = codigo_solicitud::where('id', $codigo[0]['id'])->update(['estado' => 0]);
                            $resp = array(
                                "success" => true,
                                "mensaje" => 'Retiro exitoso.'
                            );
                        } else {
                            $resul = cuentas::where('id', $codigo[0]['fk_cuenta'])->update(['saldo' => $cuenta[0]['saldo']]);
                            $resp = array(
                                "success" => false,
                                "mensaje" => "Transaccion erronea."
                            );
                        }
                    } else {
                        $resp = array(
                            "success" => false,
                            "mensaje" => 'Saldo insuficiente.'
                        );
                    }
                } else {
                    $resp = array(
                        "success" => false,
                        "mensaje" => 'El código ha expirado.'
                    );
                }
            } else {
                $resp = array(
                    "success" => false,
                    "mensaje" => 'El código ya ha sido aplicado.'
                );
            }
        } else {
            $resp = array(
                "success" => false,
                "mensaje" => 'No se encontro código.'
            );
        }
        return $resp;
    }

    public function cancelar(Request $request, cuentas $cuentas)
    {
        $result = cuentas::where('id', $request['cuenta'])->first();
        if (!empty($result)) {
            $result->estado = 0;
            $result->saldo = 0;
            if ($result->save()){
                $resp = array(
                    "success" => true,
                    "mensaje" => 'Cuenta cancelada.'
                );
            } else {
                $resp = array(
                    "success" => false,
                    "mensaje" => 'Cuenta cancelada.'
                );
            }
        } else {
            $resp = array(
                "success" => false,
                "mensaje" => 'No fue posible cancelar.'
            );
        }
        return $resp;
    }

}
