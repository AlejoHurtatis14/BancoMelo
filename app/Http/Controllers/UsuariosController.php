<?php

namespace App\Http\Controllers;

use App\usuarios;
use Illuminate\Http\Request;
use App\Helpers\JwtLogin;

/**
 * @OA\Swagger(
 *     basePath="",
 *     schemes={"http", "https"},
 *     server=L5_SWAGGER_CONST_HOST,
 *     @OA\Info(
 *         version="1.0.0",
 *         title="Proyecto Banco WB",
 *         description="Conocer funcionamiento en peticiones http a la Api.",
 *         @OA\Contact(
 *             email="contacto@bancowb.com"
 *         ),
 *     )
 * )
 */

class UsuariosController extends Controller
{
    /**
    * @OA\Get(
    *      path="/api/login/{nroDoc}/{pass}",
    *      operationId="inicioSesion",
    *      tags={"Projects"},
    *      summary="Get list of projects",
    *      description="Iniciar sesion.",
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
    *         name="nroDoc",
    *         in="path",
    *         description="Nombre de usuario.",
    *         required=true,
    *         @OA\Schema(
    *             type="string",
    *         ),
    *      ),
    *      @OA\Parameter(
    *         name="pass",
    *         in="path",
    *         description="Contraseña.",
    *         required=true,
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
    public function inicioSesion($nroDoc, $pass){
        $usuario = usuarios::where(array(
            'usuario' => $nroDoc,
            'password' => $pass
        ))->first();
        if (is_object($usuario)){
            /* $jwt = new JwtLogin();
            $token = $jwt->generarToken($usuario->id, $usuario->usuario, $usuario->password);
            $validarToken = $jwt->verificarToken($token, true);
            return array(
                    'success' => true,
                    'token' => $token,
                    'tokenTiempo' => $validarToken,
                    'usuario' => $usuario
            ); */
            return array(
                'success' => true,
                'usuario' => $usuario
        );            
        }else {
            return array(
                'success' => false,
                'msg' => 'Datos incorrectos'
            );
        }
    }   

    public function validarToken(Request $request, $tiempoToken){
        $token = $request->header('Authorization', null);
        $tiempoToken = (int)$tiempoToken;
        
        $jwt = new JwtLogin();
        $tokenValido = $jwt->verificarToken($token);

        return $tokenValido;
        /*if ($token != null){
            if(time() < $tiempoToken){
                $jwt = new JwtLogin();
                $tokenValido = $jwt->verificarToken($token);
                if ($tokenValido == true ){
                    return array(
                        'success' => true,
                        'mensaje' => 'Token valido',
                    );
                }else{
                    return array(
                        'success' => false,
                        'mensaje' => 'Token inválido',
                    );
                }
            }else{
                return array(
                    'success' => false,
                    'mensaje' => 'Sesión expirada',
                );
            }
            
        }else{
            return array(
                'success' => false,
                'mensaje' => 'Falta el token de autorización',
            );
        }*/
    }
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
        $validarCorreo = usuarios::where('correo', $request->correo)->get();
        $validarDoc = usuarios::where('nro_documento', $request->nro_documento)->get();
        
        if($validarCorreo->isEmpty() && $validarDoc->isEmpty()){
            $usuario = new usuarios;
            $usuario->nombres = $request->nombres;
            $usuario->apellidos = $request->apellidos;
            $usuario->telefono = $request->telefono;
            $usuario->correo = $request->correo;
            $usuario->usuario = $request->usuario;
            $usuario->password = $request->password;
            $usuario->nro_documento = $request->nro_documento;
            $usuario->estado = 1;
            $usuario->usuario_creador = $request->usuario_creador;

            if($usuario->save()){
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
        }else{

            $mensaje;

            if(!$validarCorreo->isEmpty() && !$validarDoc->isEmpty()){
                $mensaje = 'Correo electronico y el documento';
            }else if(!$validarCorreo->isEmpty()){
                $mensaje = 'Correo Electronico';
            }else{
                $mensaje = 'Documento';
            }
            
            $resp =  array(
                "success" => false,
                "mensaje" => "El ".$mensaje." ya se encuentra registrado"
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
     * @param  \App\usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function show(usuarios $usuarios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function edit(usuarios $usuarios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, usuarios $usuarios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function destroy(usuarios $usuarios)
    {
        //
    }

}
