<?php

namespace Cekisakurek\LaChart;

use Livewire\Component;

class DoughnutChart extends Component {


    public $chart_id = 'la-chart-doughnut-chart';
    private $chart_data;
    public $labels = [];
    public $chart_type = 'doughnut';
    public $title;

    public function mount() {

    }

    public function setChartData($chart_data) {
        $this->chart_data = $chart_data;
    }

    public function click($id) {
        dd($this);
    }

    public function render()
    {
        return view('lachart::livewire.doughnutchart', ['chart_data' => $this->chart_data]);
    }
}


