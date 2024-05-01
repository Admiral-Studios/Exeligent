<?php

namespace App\Http\Resources;

use App\Models\User;
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
            'role_id' => User::ALL_ROLES[$this->role_id],
            'name' => $this->full_name,
            'email' => $this->email,
            'created_at' => $this->pretty_created_at,
            'plan' => $this->currentPlanPrice ? $this->currentPlan->name : '-',
            'custom_status' => $this->trashed()
                ? 'deleted'
                : ($this->activeSubscription
                        ? 'active'
                        : 'inactive')
        ];
    }
}
