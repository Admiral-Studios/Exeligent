<?php

namespace App\Widgets\Admin;

use App\Models\User;
use Arrilot\Widgets\AbstractWidget;
use Carbon\Carbon;

class Customers extends AbstractWidget
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
        $total_users = User::count();
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

        $total_last_signups_count = User::where('created_at', '>=', $ago->format('Y-m-d H:i:s'))->count();

        $last_date = clone $ago;
        $ago->$addFunc($addFuncArg);
        for (; $last_date <= $now; $ago->$addFunc($addFuncArg)) {
            $chart_data[] = User::whereBetween(
                'created_at',
                [
                    $last_date->format('Y-m-d H:i:s'),
                    $ago->format('Y-m-d H:i:s')
                ])->count();
            $last_date = clone $ago;
        }

        return view('widgets.admin.customers', [
            'config' => $this->config,
            'total_users' => $total_users,
            'new_users' => $total_last_signups_count,
            'chart_data' => $chart_data,
            'periods' => self::ALL_PERIODS,
            'widget_id' => 1, // INDEX ON DASHBOARD PAGE | USES FOR AJAX RELOAD
            'widget_name' => "Admin\\\Customers"
        ]);
    }
}
