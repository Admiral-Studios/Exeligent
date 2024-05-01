<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\LeadershipTool;
use App\Models\LeadershipToolType;
use Illuminate\Http\Request;

class LeadershipToolsController extends Controller
{

    public function __construct(private LeadershipToolType $leadershipToolType)
    {
    }

    public function index(LeadershipToolType $leadershipToolType)
    {
        if (!$leadershipToolType->id) {
            $leadershipToolType = LeadershipToolType::first();
        }

        return view('user.leadership-tools.index', [
            'leadershipToolType' => $leadershipToolType,
            'types' => $this->leadershipToolType->getSortedWithTools()
        ]);
    }

    public function show(LeadershipToolType $leadershipToolType, LeadershipTool $leadershipTool)
    {
        return view('user.leadership-tools.show', [
            'leadershipTool' => $leadershipTool,
            'leadershipToolType' => $leadershipToolType,
            'types' => $this->leadershipToolType->getSortedWithTools()
        ]);
    }

}
