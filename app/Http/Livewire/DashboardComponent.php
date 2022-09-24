<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Contest;
use App\Models\Candidate;
use Asantibanez\LivewireCharts\Models\AreaChartModel;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use Asantibanez\LivewireCharts\Models\PieChartModel;


class DashboardComponent extends Component
{
    
    public function render()
    {
        $contest = Contest::where('active',1)->first();
        $generalStat =
        (new ColumnChartModel())
            ->setTitle('Voting Stats')
            ->setAnimated(true)
            ->addColumn(0, '10', '#f6ad55');
        $candidates = $contest->candidates->toArray();
        if($contest && $candidates)
        {
            $count = count($candidates);
            $generalStat =
                (new ColumnChartModel())
                    ->setTitle('Voting Stats')
                    ->setAnimated(true)
                    ->addColumn($candidates[0]['name'], '10', '#f6ad55');
        }
        
        return view('livewire.dashboard-component', compact('generalStat'));
    }
}
