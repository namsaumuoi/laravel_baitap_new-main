<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAge
{
    public function handle(Request $request, Closure $next)
    {
        $age = $request->session()->get('age');

        if (!is_numeric($age) || intval($age) < 18) {
            $message = 'Không được phép truy cập';

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json(['message' => $message], 403);
            }

            $accept = $request->header('Accept', '');
            if (strpos($accept, 'text/plain') !== false) {
                return response($message, 403)->header('Content-Type', 'text/plain');
            }

            return response()->view('age.denied', ['message' => $message], 403);
        }

        return $next($request);
    }
}