<div wire:ignore>
    <div style="position: relative;">
        <canvas id="{{ $chart_id }}"></canvas>
    </div>
</div>

<script>
    new Chart(document.getElementById(String("{!! $chart_id !!}")),
        {
            data: {
                datasets: @json($chart_data)
            },
            options: {
                parsing: {
                    xAxisKey: 'x',
                    yAxisKey: 'y'
                },
                scales: {
                    x: {
                        grid: @json($x_grid),
                        ticks: {
                            callback: function(value, index, ticks) {
                                let formatterName = String("{!! $formatter_name !!}");
                                if(formatterName === 'number') {
                                    let formatted = Chart.Ticks.formatters.numeric.apply(this, [value, index, ticks]);
                                    return String("{!! $left_x_unit !!}") + formatted + String("{!! $right_x_unit !!}");
                                } else {
                                    return String("{!! $left_x_unit !!}") + this.getLabelForValue(value) + String("{!! $right_x_unit !!}");
                                }
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        position: 'left',
                        display: "{!! $show_left_axis !!}",
                        grid: @json($y_grid),
                        ticks: {
                            callback: function(value, index, ticks) {
                                let formatterName = String("{!! $formatter_name !!}");
                                if(formatterName === 'number') {
                                    let formatted = Chart.Ticks.formatters.numeric.apply(this, [value, index, ticks]);
                                    return String("{!! $left_y_unit !!}") + formatted + String("{!! $right_y_unit !!}");
                                } else {
                                    return String("{!! $left_y_unit !!}") + this.getLabelForValue(value) + String("{!! $right_y_unit !!}");
                                }
                            }
                        }
                    },
                    y1: {
                        position: 'right',
                        display: "{!! $show_right_axis !!}",
                        grid: @json($y1_grid),
                        ticks: {
                            callback: function(value, index, ticks) {
                                let formatterName = String("{!! $formatter_name !!}");
                                if(formatterName === 'number') {
                                    let formatted = Chart.Ticks.formatters.numeric.apply(this, [value, index, ticks]);
                                    return String("{!! $left_y1_unit !!}") + formatted + String("{!! $right_y1_unit !!}");
                                } else {
                                    return String("{!! $left_y1_unit !!}") + this.getLabelForValue(value) + String("{!! $right_y1_unit !!}");
                                }
                            }
                        }
                    }
                },
                onClick: (e, activeEls) => {
                    if (activeEls[0] !== undefined) {
                        let datasetIndex = activeEls[0].datasetIndex;
                        let dataIndex = activeEls[0].index;
                        let datasetLabel = e.chart.data.datasets[datasetIndex].label;
                        let value = e.chart.data.datasets[datasetIndex].data[dataIndex];
                        let label = e.chart.data.labels[dataIndex];
                        console.log("In click", datasetLabel, label, value);
                        @this.click({item: value });
                    }
                },
                plugins: {
                    customCanvasBackgroundColor: {
                        color: "{!! $canvas_background_color !!}",
                    }
                }
            },
            plugins: [
                {
                    id: 'customCanvasBackgroundColor',
                    beforeDraw: (chart, args, options) => {
                        const {ctx} = chart;
                        ctx.save();
                        ctx.globalCompositeOperation = 'destination-over';
                        ctx.fillStyle = options.color || '#99ffff';
                        ctx.fillRect(0, 0, chart.width, chart.height);
                        ctx.restore();
                    }
                }
            ],
        }
    );

    document.addEventListener("DOMContentLoaded", function() {
        window.addEventListener('update_' + "{!! $chart_id !!}" + '_data' , event => {
            console.log('Updating ' + "{!! $chart_id !!}");
            let composite_chart = Chart.getChart("{!! $chart_id !!}");
 
            let chart_data = JSON.parse(event.detail.chart_data);
            
            // composite_chart.data.labels = chart_data.labels;
            composite_chart.data.datasets = [];
            
            chart_data.forEach(function (value, i) {
                composite_chart.data.datasets.push(value);
                
            });
            console.dir(composite_chart.data.datasets);
            
            composite_chart.options.parsing.xAxisKey = 'x';
            composite_chart.options.parsing.yAxisKey = 'y';

            composite_chart.update();
        });
    });
</script>