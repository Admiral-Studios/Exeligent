<?php

namespace App\Widgets\Admin;

use App\Models\Subscription;
use Arrilot\Widgets\AbstractWidget;
use Carbon\Carbon;

class ChurnRate extends AbstractWidget
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
            'attributes'    => 'class="col-lg-4 col-md-6 col-12"',
        ];
    }

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $period = $this->config['period'] ?? 'month';

        if ($period == 'month') {
            $current_period = (object) [
                'start' => Carbon::now()->subMonth(),
                'end' => Carbon::now()
            ];
            $previous_period = (object) [
                'start' => Carbon::now()->subMonths(2),
                'end' => Carbon::now()->subMonth()
            ];
        } elseif ($period == 'quarter') {
            $current_period = (object) [
                'start' => Carbon::now()->subQuarter(),
                'end' => Carbon::now()
            ];
            $previous_period = (object) [
                'start' => Carbon::now()->subQuarters(2),
                'end' => Carbon::now()->subQuarter()
            ];
        } elseif ($period == 'year') {
            $current_period = (object) [
                'start' => Carbon::now()->subYear(),
                'end' => Carbon::now()
            ];
            $previous_period = (object) [
                'start' => Carbon::now()->subYears(2),
                'end' => Carbon::now()->subYear()
            ];
        }


        $last_period_count = Subscription::where(function ($query) use ($current_period) {
                $query->where('created_at', '<', $current_period->start)
                    ->orWhereBetween('created_at', [$current_period->start, $current_period->end]);
            })
            ->where(function ($query) use ($current_period) {
                $query->whereBetween('ends_at', [$current_period->start, $current_period->end])
                    ->orWhereNull('ends_at');
            })
            ->count();

        $previous_period_count = Subscription::where(function ($query) use ($previous_period) {
                $query->where('created_at', '<', $previous_period->start)
                    ->orWhereBetween('created_at', [$previous_period->start, $previous_period->end]);
            })->where(function ($query) use ($previous_period) {
                $query->whereBetween('ends_at', [$previous_period->start, $previous_period->end])
                    ->orWhereNull('ends_at');
            })
            ->count();

        if (($previous_period_count - $last_period_count) === 0 || $previous_period_count === 0)
            $chart_data = -round($last_period_count * 100, 1);
        else
            $chart_data = round(($previous_period_count - $last_period_count) / $previous_period_count * 100, 1);

        return view('widgets.admin.churn_rate', [
            'config' => $this->config,
            'periods' => self::ALL_PERIODS,
            'last_count' => $last_period_count,
            'previous_count' => $previous_period_count,
            'chart_data' => $chart_data,
            'widget_id' => 3, // INDEX ON DASHBOARD PAGE | USES FOR AJAX RELOAD
            'widget_name' => 'Admin\\\ChurnRate'
        ]);
    }
}
