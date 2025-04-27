<?php

namespace Tests\Feature;

use App\Models\Guest;
use App\Models\GuestPhoto;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Storage;
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
        // resources/sample-images/sample_photoをminioにアップロード
        Storage::disk('s3')
            ->put(
                'guest_photos/sample_photo.png',
                file_get_contents(resource_path('sample-images/sample_photo.png'))
            );
        /** @var Guest $guest */
        $guest = Guest::factory()
            ->has(GuestPhoto::factory([
                'photo_path' => 'guest_photos/sample_photo.png',
            ])
            )
            ->create([
                'name' => 'レインボーケーキ',
                'message_from_groom' => 'いつもたくさん遊んでくれてありがとう！おかげで韓国旅行最高に楽しかったよ！',
                'message_from_bride' => '今度またサウナに行こう！',
            ]);
        // 新郎新婦を作成する
        User::factory()
            ->count(2)
            ->sequence(
                [
                    'name' => '新郎',
                    'role' => 'groom',
                ],
                [
                    'name' => '新婦',
                    'role' => 'bride',
                ])
            ->create([
                'wedding_id' => $guest->wedding_id,
            ]);
        $this->getJson('/api/guests/'.$guest->access_token)
            ->tap(function (TestResponse $response) {
                echo __METHOD__.'()#L'.__LINE__.':'.json_encode($response->json('data'), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE).PHP_EOL;
            })
            ->assertOk()
            ->assertJson([
                'data' => [
                    'id' => $guest->id,
                    'name' => $guest->name,
                    'messages' => [
                        [
                            'name' => '新郎',
                            'message' => $guest->message_from_groom,
                        ],
                        [
                            'name' => '新婦',
                            'message' => $guest->message_from_bride,
                        ],
                    ],
                    'guest_photos' => [
                        [
                            'id' => $guest->guestPhotos[0]->id,
                            'photo_path' => $guest->guestPhotos[0]->file_temporary_url,
                        ],
                    ],
                ],
            ]);
    }
}
