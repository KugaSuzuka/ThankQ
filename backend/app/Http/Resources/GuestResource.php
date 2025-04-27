<?php

namespace App\Http\Resources;

use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GuestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Guest $this */
        return [
            'id' => $this->id,
            'name' => $this->name,
            'messages' => [
                [
                    'name' => $this->groom->name,
                    'message' => $this->message_from_groom,
                ],
                [
                    'name' => $this->bride->name,
                    'message' => $this->message_from_bride,
                ],
            ],
            'guest_photos' => $this->guestPhotos
                ?->map(fn ($photo) => [
                    'id' => $photo->id,
                    'photo_path' => $photo->file_temporary_url,
                ])
                ->toArray(),
        ];
    }
}
