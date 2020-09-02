<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdAuthor
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
        if ($request->id!==null)
        {
            $ad = \App\Ad::find($request->id);
            if ($request->user()->cannot('update',$ad))
            {
                return redirect()
                    ->route('home')
                    ->with('error','You can\'t edit this ad. Bacause you are not author');
            }
        }

        return $next($request);
    }
}
