<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkflowsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'status' => $this->status,
            'phase_id' => $this->phase_id,

        ];
    }
}
