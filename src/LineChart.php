<?php

namespace Cekisakurek\LaChart;

use Livewire\Component;

class LineChart extends Component {


    public $labels = [];
    public $data = [];
    public $title = 'title';

    public $chart_id = 'la-chart-line-chart';

    public function mount() {
    

    }

    public function click() {
        dd($this);
    }

    public function render()
    {
        return view('lachart::livewire.linechart');
    }
}
