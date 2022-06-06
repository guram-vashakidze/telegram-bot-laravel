<?php


namespace Vashakidze\Telegram\Tests\Unit;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use Vashakidze\Telegram\Http\Middleware\TelegramWebhookMiddleware;
use Vashakidze\Telegram\Tests\TestCase;

/**
 * Class TelegramWebhookMiddlewareTest
 * @package Vashakidze\Telegram\Tests\Unit
 */
class TelegramWebhookMiddlewareTest extends TestCase
{
    /**
     * @test
     */
    public function test_with_token(): void
    {
        $token = Str::random(30);

        Config::set('telegram.webhook.token', $token);

        $request = new Request();

        $request->merge(
            [
                'token' => $token
            ]
        );

        $response = $this->handleMiddleware($request);

        $this->assertEquals(Response::HTTP_OK, $response->status());
    }

    /**
     * @test
     */
    public function test_with_incorrect_token(): void
    {
        Config::set('telegram.webhook.token', Str::random(30));

        $request = new Request();

        $request->merge(
            [
                'token' => Str::random(30)
            ]
        );

        $response = $this->handleMiddleware($request);

        $this->assertEquals(Response::HTTP_FORBIDDEN, $response->status());
    }

    /**
     * @test
     */
    public function test_without_token(): void
    {
        Config::set('telegram.webhook.token');

        $response = $this->handleMiddleware(new Request());

        $this->assertEquals(Response::HTTP_OK, $response->status());
    }

    private function handleMiddleware(Request $request): Response
    {
        return (new TelegramWebhookMiddleware())->handle(
            $request,
            function ($next)
            {
                return new Response();
            }
        );
    }
}
