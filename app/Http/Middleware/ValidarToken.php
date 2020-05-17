<?php

namespace App\Http\Middleware;
use Closure;
use App\Helpers\JwtLogin;
use Illuminate\Http\JsonResponse;

class ValidarToken
{
    /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
    $token = $request->header('Authorization', null);
    $tiempoToken = $request->header('tokenTime', null);
    if ($token != null){
      if(time() < $tiempoToken){
        $jwt = new JwtLogin();
        $tokenValido = $jwt->verificarToken($token);
        if ($tokenValido == true){
          return $next($request);
        } else {
          $mensaje = 'Token es invalido';
        }
      } else {
        $mensaje = 'Sesión expirada';
      }      
    } else {
      $mensaje = 'No hay token para validar.';
    }
    return new JsonResponse(array(
      'success' => false,
      'token' => true,
      'msj' => $mensaje
    ), 200);
  }

}
