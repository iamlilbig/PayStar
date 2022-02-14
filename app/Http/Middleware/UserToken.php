<?php

namespace App\Http\Middleware;

use App\Exceptions\v1\ForbiddenException;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserToken
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     * @throws ForbiddenException
     */
    public function handle(Request $request, Closure $next)
    {
        if($user = User::query()->where('token', $request->header()['token'][0])->first()){
            $user_id = $user->id;
            Auth::loginUsingId($user_id);
            return $next($request);
        }
        throw new ForbiddenException();

    }
}
