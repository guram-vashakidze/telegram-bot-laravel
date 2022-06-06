<?php

namespace Vashakidze\Telegram\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TelegramWebhookMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        $primaryToken = config('telegram.webhook.token');

        if (empty($primaryToken)) {
            return $next($request);
        }

        $token = $request->query('token');

        if (empty($token) || $token !== config('telegram.webhook.token')) {
            return new Response(status: Response::HTTP_FORBIDDEN);
        }
        return $next($request);
    }
}
