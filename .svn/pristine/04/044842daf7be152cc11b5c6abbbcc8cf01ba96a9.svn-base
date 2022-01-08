<?php


namespace App\Http\Middleware;
use Closure;
class CorsPassport
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
       
        // $response->header('Access-Control-Allow-Methods*');
        //  $response->header('Access-Control-Allow-Headers: *');
        //  $response->header('Access-Control-Allow-Origin', '*');

        // header('Access-Control-Allow-Origin: *');
        // header('Access-Control-Allow-Methods: *');
        // header('Access-Control-Allow-Headers: *');

        return $response;
    }
}
