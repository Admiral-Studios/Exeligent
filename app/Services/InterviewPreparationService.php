<?php

namespace App\Services;

use App\Models\InterviewPreparationTab;

class InterviewPreparationService
{

    public function getAll()
    {
        return InterviewPreparationTab::active()
            ->with('paragraphs')
            ->orderBy('pos')
            ->get();
    }

}
