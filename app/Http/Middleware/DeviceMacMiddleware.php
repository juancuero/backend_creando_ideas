<?php

namespace App\Http\Middleware;

use App\Models\Device;
use Closure;
use Illuminate\Http\Request;

class DeviceMacMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Obtener el valor de la variable $mac del header de la petición
        $mac = $request->header('device-mac');

        // Buscar el dispositivo correspondiente en la base de datos
        $device = Device::where('mac', $mac)->first();

        // Si el dispositivo no existe, retornar una respuesta de error
       
        if (!$device) {
            return response()->json(['error' => 'Dispositivo no autorizado'], 401);
        }
       

        // Si el dispositivo exist
        return $next($request);
    }
}
