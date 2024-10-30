<?php

namespace Cekisakurek\LaChart;

class ChartGrid
{
    public $display = true;
    public $drawOnChartArea = true;
    public $drawTicks = true;
    
    function __construct($display = true, $drawOnChartArea = true, $drawTicks = true) {
        $this->display = $display;
        $this->drawOnChartArea = $drawOnChartArea;
        $this->drawTicks = $drawTicks;
    }

    static function defaultGrid() {
        return new ChartGrid;
    }
}