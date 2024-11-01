<?php

namespace Cekisakurek\LaChart;

use Illuminate\Support\Collection;
use Livewire\Component;

class CompositeChart extends Component
{
    public $chart_id = 'la-chart-composite-chart';

    private $chart_data;

    public $show_right_axis = false;

    public $show_left_axis = true;

    public $canvas_background_color = 'rgba(255, 255, 255, 1.0)';

    public $formatter_name = 'default';

    public $left_x_unit = '';

    public $right_x_unit = '';

    public $left_y_unit = '';

    public $right_y_unit = '';

    public $left_y1_unit = '';

    public $right_y1_unit = '';

    private $x_grid;

    private $y_grid;

    private $y1_grid;

    public function mount()
    {
        $this->x_grid = ChartGrid::defaultGrid();
        $this->y_grid = ChartGrid::defaultGrid();
        $this->y1_grid = ChartGrid::defaultGrid();
    }

    public function setChartData($chart_data)
    {
        $this->chart_data = $chart_data;
    }

    public function updateChartData($new_chart_data)
    {
        for ($x = 0; $x < count($new_chart_data); $x++) {
            $prepared_data = $new_chart_data[$x]->data;
            if ($prepared_data instanceof Collection) {
                $new_chart_data[$x]->data = array_values($prepared_data->toArray());
            } else {
                $new_chart_data[$x]->data = array_values($prepared_data);
            }
        }
        $this->dispatch('update_'.$this->chart_id.'_data', chart_data: json_encode($new_chart_data));
    }

    public function click($id)
    {
        dd($id);
    }

    public function render()
    {
        return view('lachart::livewire.compositechart', [
            'chart_data' => $this->chart_data,
            'x_grid' => $this->x_grid,
            'y_grid' => $this->y_grid,
            'y1_grid' => $this->y1_grid,
        ]);
    }
}
