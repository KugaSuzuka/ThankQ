<?php

namespace Tests\Feature;

use App\Models\Guest;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class GuestControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @see GuestController::show()
     */
    public function test_show()
    {
        /** @var Guest $guest */
        $guest = Guest::factory()->create([
            'name' => 'レインボーケーキ',
            'thanks_message' => 'いつもたくさん遊んでくれてありがとう！おかげで韓国旅行最高に楽しかったよ！',
        ]);
        $this->getJson('/api/guests/'.$guest->access_token)
            ->tap(function (TestResponse $response) {
                 echo __METHOD__ . '()#L' . __LINE__ . ':' . json_encode($response->json('data'), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . PHP_EOL;
            })
            ->assertOk()
            ->assertJson([
                'data' => [
                    'id' => $guest->id,
                    'name' => $guest->name,
                    'message' => $guest->thanks_message,
                    'guest_photos' => [],
                ],
            ]);
    }
}
