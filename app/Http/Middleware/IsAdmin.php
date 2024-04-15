<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->is_admin !== config('constants.user_roles.admin')) {
            // 管理者でない場合、ログイン画面にリダイレクトし、エラーメッセージを返す
            return redirect('/home')->with('error', '管理者でログインしてください。');
        }

        return $next($request);
    }
}
