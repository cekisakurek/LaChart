<?php

namespace Cekisakurek\LaChart;

use Livewire\Component;

class CompositeChart extends Component
{
    public $chart_id = 'la-chart-composite-chart';

    private $chart_data;

    public function mount() {}

    public function setChartData($chart_data)
    {
        $this->chart_data = $chart_data;
    }

    public function updateChartData($new_chart_data) 
    {
        for($x = 0; $x < count($new_chart_data); $x++) {
            $prepared_data = $new_chart_data[$x]->data;
            $new_chart_data[$x]->data = array_values($prepared_data->toArray());
        }
        $this->dispatch('update_'.$this->chart_id.'_data', chart_data: json_encode($new_chart_data));
    }

    public function click($id)
    {
        dd($id);
    }

    public function render()
    {
        return view('lachart::livewire.compositechart', ['chart_data' => $this->chart_data]);
    }
}
