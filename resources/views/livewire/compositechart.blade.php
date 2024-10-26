<div wire:ignore>
    <div style="position: relative; height:80vh;">
        <canvas id="{{ $chart_id }}"></canvas>
    </div>
</div>

<script>

    new Chart(document.getElementById(String("{!! $chart_id !!}")),
        {
            data: {
                datasets: @json($chart_data),
                labels: @json($this->labels)
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
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
                        @this.click({label: label });
                    }
                }
            }
        }
    );

    document.addEventListener("DOMContentLoaded", function() {
        window.addEventListener('update_' + "{!! $chart_id !!}" + '_data' , event => {
            console.log('Updating' + 'update_' + "{!! $chart_id !!}" + '_data');
            let composite_chart = Chart.getChart("{!! $chart_id !!}");
            // composite_chart.destroy();
            // let ctx = document.getElementById("{!! $chart_id !!}").getContext('2d');
            // composite_chart = new Chart(ctx, composite_chart_config);

            let chart_data = JSON.parse(event.detail.chart_data);
            composite_chart.data.labels = chart_data.labels;
            composite_chart.data.datasets = [];
            
            chart_data.dataset.forEach(function (value, i) {
                composite_chart.data.datasets.push(value);
            });
            
            // chart.update();
            composite_chart.update();
        });
    });
</script>