<?php

namespace Cekisakurek\LaChart;

class ChartLayout
{

    public $padding;

    function __construct(ChartPadding $padding = new ChartPadding(0,0,0,0)) {
        $this->padding = $padding;

    }

}

class ChartPadding {
    public $left;
    public $right;
    public $top;
    public $bottom;

    function __construct($left, $right, $top, $bottom) {
        $this->left = $left;
        $this->right = $right;
        $this->top = $top;
        $this->bottom =$bottom;
    }
}