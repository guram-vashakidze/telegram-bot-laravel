<?php


namespace Vashakidze\Telegram\Tests\Feature;


use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Response;
use Vashakidze\Telegram\Tests\TestCase;

class TelegramGetUpdateTest extends TestCase
{
    use WithoutMiddleware;
    use WithFaker;

    public function test_get_incorrect_webhook(): void
    {
        $this->postJson(
            route('webhook.telegram'),
            [
                'update_id' => $this->faker->randomNumber()
            ]
        )
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_get_message_updates(): void
    {

    }
}
