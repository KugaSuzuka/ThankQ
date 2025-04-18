<?php

namespace App\Http\Resources;

use App\Models\QuizChoice;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuizChoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var QuizChoice $this */
        return [
            'id' => $this->id,
            'choice' => $this->choice_text,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
