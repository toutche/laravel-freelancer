<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use App\Models\Site\User\UserComplemented;

use Closure;

class CheckUserComplementedPerfil
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
        if ( !Auth::check() )
            return redirect('/login');

        $user_complemented = UserComplemented::select('status')->where('user_id', Auth::id())->first();

        if($user_complemented->status == 1) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
