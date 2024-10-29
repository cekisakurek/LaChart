<div wire:ignore>
    <div style="position: relative; height:80vh;">
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
                    y: {
                        beginAtZero: true,
                        position: 'left'
                    },
                    y1: {
                        position: 'right'
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
                }
            }
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