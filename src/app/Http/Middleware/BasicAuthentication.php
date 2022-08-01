<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class BasicAuthentication
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
        
        $user = User::find($request->post('id'));
        if($user->session_code == $request->post('session_code'))
        {
            // valid code: issue new code
            $user->session_code = bin2hex(random_bytes(21));
            $user->save();
        } else {
            // invalid code: tell them to gtfo
            return response('Not Authorized', 401);
        }
        return $next($request);
    }
}
