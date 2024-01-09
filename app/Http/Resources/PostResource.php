<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // ممكن نغير اسماء الكولمن داخل الداتا بيز يعني ماتظهرش باسماءها الحقيقيه
        return[
            'X'=>$this->id,
            'title'=>$this->title,
            'body'=>$this->body, 
        ];
    }
}
