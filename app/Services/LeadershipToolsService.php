<?php

namespace App\Services;

use App\Models\LeadershipTool;

class LeadershipToolsService
{

    public static function getToolsByType($type_id)
    {
        return LeadershipTool::active()
            ->where('type', $type_id)
            ->orderBy('pos')
            ->get();
    }

}
