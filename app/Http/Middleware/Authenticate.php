<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Exceptions\HttpResponseException;

class Authenticate extends Middleware
{
    /**
     * Get the path the admin should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if($request->is('api/*'))
        {
            throw new HttpResponseException(response()->error(['failure_reason'=>'Необходим акутальный ключ доступа'], 'Unauthorized Request', 401));
        }

        if (!$request->expectsJson()) {
            session()->flash('error', 'Для доступа необходимо войти в аккаунт!');
            return route('index');
        }
    }
}
