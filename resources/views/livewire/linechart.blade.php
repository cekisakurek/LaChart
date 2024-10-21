<div>
    <canvas id="{{ $chart_id }}"></canvas>
</div>

<script>
    var on_click_handler = (e, activeEls) => {
        if (activeEls[0] !== undefined) {

            let datasetIndex = activeEls[0].datasetIndex;
            let dataIndex = activeEls[0].index;
            let datasetLabel = e.chart.data.datasets[datasetIndex].label;
            let value = e.chart.data.datasets[datasetIndex].data[dataIndex];
            let label = e.chart.data.labels[dataIndex];
            console.log("In click", datasetLabel, label, value);
            $wire.dispatch('click', {id: 0 })
        }
    }
    var bar_chart_config = {
        type: String("{!! $chart_type !!}"),
        data: {
            labels: @json($labels),
            datasets: [{
                label: String("{!! $title !!}"),
                data: @json($data),
                backgroundColor: @json($background_colors),
                borderColor: @json($border_colors),
                borderWidth: parseFloat("{!! $border_width !!}")
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            onClick: on_click_handler
        }
    };
   
    let chart_id = String("{!! $chart_id !!}");
    var chart = new Chart(document.getElementById(chart_id), bar_chart_config);

    document.addEventListener("DOMContentLoaded", function() {
        window.addEventListener('update_' + chart_id + '_data' , event => {
            var bar_chart = Chart.getChart(chart_id);
            bar_chart.destroy();
            var ctx = document.getElementById(chart_id).getContext('2d');
            bar_chart = new Chart(ctx, bar_chart_config);
            var chart_data = JSON.parse(event.detail.chart_data);
            // chart.data.labels = chart_data.labels;
            bar_chart.data.datasets[0].data = chart_data.data;
            // chart.update();
            bar_chart.update('none');
        });
    });
</script>