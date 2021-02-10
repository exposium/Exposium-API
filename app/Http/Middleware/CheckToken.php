<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use phpDocumentor\Reflection\Types\Integer;

class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('token');
        $sum = 0;
        $numberLowerCase = 0;
        $numberUpperCase = 0;

        for ($i = 0; $i < strlen($token); $i++) {
            $char = $token[$i];
            if (is_numeric($char)) {
                $sum += (int)$token[$i];
            } elseif (ctype_lower($char)){
                $numberLowerCase++;
            } else {
                $numberUpperCase++;
            }
        }

        if ($this->validToken($sum, $numberLowerCase, $numberUpperCase)) return $next($request);
        return Redirect('api/tokenError');
    }

    private function validToken(int $sum, int $numberLowerCase, int $numberUpperCase)
    {
        return $sum == 30 && $numberUpperCase == 5 && $numberLowerCase == 5;
    }
}
