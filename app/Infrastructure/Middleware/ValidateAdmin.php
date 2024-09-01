<?php

namespace App\Infrastructure\Middleware;

use App\Infrastructure\Models\User;
use App\Support\Core\CustomException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class ValidateAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     * @throws Throwable
     */
    public function handle(Request $request, Closure $next): Response
    {
        /**
         * @var User $user
         */
        $user = Auth::user();

        if (!$user->isAdmin())
        {
            new CustomException('У вас нет прав доступа, запросите у администратора');
        }

        return $next($request);
    }
}
