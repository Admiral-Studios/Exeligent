<?php

namespace App\Services;

use App\Models\Plan;

class PlanService
{

    public function getAllActive()
    {
        return Plan::active()
            ->with(['activePrices'])
            ->orderBy('pos')
            ->get();
    }

}
