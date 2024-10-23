<?php

namespace Cekisakurek\LaChart;

use Livewire\Component;

class CompositeChart extends Component
{
    public $chart_id = 'la-chart-composite-chart';

    private $chart_data;

    public $labels = [];

    public function mount() {}

    public function setChartData($chart_data)
    {
        $this->chart_data = $chart_data;
    }

    public function click($id)
    {
        dd($this);
    }

    public function render()
    {
        return view('lachart::livewire.compositechart', ['chart_data' => $this->chart_data]);
    }
}
