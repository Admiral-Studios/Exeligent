<?php

namespace App\Http\Resources;

use App\Enums\ContactGoalEnum;
use App\Enums\ContactStatusEnum;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $array = $this->getAttributes();
        $array['goal_title'] = ContactGoalEnum::tryFrom($array['goal'])?->getTitle() ?? '';
        $array['status_title'] = ContactStatusEnum::tryFrom($array['status'])?->getTitle() ?? '';
        $array['contacted_at'] = $this->contacted_at ? $this->contacted_at->format('m/d/Y') : null;
        $array['contact_details'] = !empty($this->contact_details) ? $this->contact_details : null;
        $array['conversation_topic'] = !empty($this->conversation_topic) ? $this->conversation_topic : null;
        $array['advice_or_feedback'] = !empty($this->advice_or_feedback) ? $this->advice_or_feedback : null;
        $array['interests_or_hobbies'] = !empty($this->interests_or_hobbies) ? $this->interests_or_hobbies : null;

        return $array;
    }
}
