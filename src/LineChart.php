<?php

namespace Cekisakurek\LaChart;

use Livewire\Component;

class LineChart extends Component
{
    public $labels = [];

    public $data = [];

    public $title = 'title';

    public $chart_id = 'la-chart-line-chart';

    public $chart_type = 'bar';

    public $background_colors = [
        'rgba(255, 99, 132, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(255, 205, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(201, 203, 207, 0.2)',
    ];

    public $border_colors = [
        'rgb(255, 99, 132)',
        'rgb(255, 159, 64)',
        'rgb(255, 205, 86)',
        'rgb(75, 192, 192)',
        'rgb(54, 162, 235)',
        'rgb(153, 102, 255)',
        'rgb(201, 203, 207)',
    ];

    public $border_width = 1.0;

    public function mount() {}

    public function click($id)
    {
        dd($this);
    }

    public function render()
    {
        return view('lachart::livewire.linechart');
    }
}
