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
        $contestants = Contest::withCount('candidates')->get();
        return view('livewire.dashboard-component');
    }
}
