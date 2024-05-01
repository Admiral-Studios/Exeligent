<?php

namespace App\Widgets\Admin;

use App\Models\User;
use Arrilot\Widgets\AbstractWidget;
use Carbon\Carbon;

class Subscribers extends AbstractWidget
{

    const ALL_PERIODS = [
        'month',
        'quarter',
        'year'
    ];

    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'period' => 'month'
    ];

    public $encryptParams = false;

    public function container()
    {
        return [
            'element'       => 'div',
            'attributes'    => 'class="col-lg-4 col-sm-6 col-12"',
        ];
    }

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $period = $this->config['period'] ?? 'month';
        $now = Carbon::now();
        $total_subscribers = User::active()->whereHas('activeSubscription')->count();
        $chart_data = [];

        if ($period == 'month') {
            $ago = Carbon::now()->subDays(30);
            $addFunc = 'addDays';
            $addFuncArg = 5;
        } elseif ($period == 'quarter') {
            $ago = Carbon::now()->subQuarter();
            $addFunc = 'addDays';
            $addFuncArg = 15;
        } elseif ($period == 'year') {
            $ago = Carbon::now()->subYear();
            $addFunc = 'addMonths';
            $addFuncArg = 2;
        }

        $total_last_signups_count = User::active()
            ->whereHas('activeSubscription', function ($query) use ($ago) {
                $query->where('subscriptions.created_at', '>=', $ago->format('Y-m-d H:i:s'));
            })
            ->count();

        $last_date = clone $ago;
        $ago->$addFunc($addFuncArg);
        for (; $last_date <= $now; $ago->$addFunc($addFuncArg)) {
            $chart_data[] = User::active()
                ->whereHas('activeSubscription', function ($query) use ($last_date, $ago) {
                    $query->whereNull('ends_at')
                        ->whereBetween('subscriptions.created_at',
                        [
                            $last_date->format('Y-m-d H:i:s'),
                            $ago->format('Y-m-d H:i:s')
                        ]
                    );
                })->count();
            $last_date = clone $ago;
        }

        return view('widgets.admin.subscribers', [
            'config' => $this->config,
            'total_subscribers' => $total_subscribers,
            'new_subscribers' => $total_last_signups_count,
            'chart_data' => $chart_data,
            'periods' => self::ALL_PERIODS,
            'widget_id' => 2, // INDEX ON DASHBOARD PAGE | USES FOR AJAX RELOAD
            'widget_name' => "Admin\\\Subscribers"
        ]);
    }
}
