<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'prophile_photo_url' => $this->prophile_photo_url,
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'is_admin' => $this->is_admin,
            'last_message' => $this->last_message,
            'last_message_date' => $this->last_message_date
        ];
    }
}
