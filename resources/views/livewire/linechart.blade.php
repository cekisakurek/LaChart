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
        type: 'bar',
        data: {
            labels: @json($labels),
            datasets: [{
                label: String("{!! $title !!}"),
                data: @json($data),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(201, 203, 207, 0.2)'
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                ],
                borderWidth: 1
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
   
    var chart = new Chart(document.getElementById('{{!! $chart_id !!}}'), bar_chart_config);

    document.addEventListener("DOMContentLoaded", function() {
        window.addEventListener('update_chart_data', event => {
            var bar_chart = Chart.getChart('{{!! $chart_id !!}}');
            bar_chart.destroy();
            var ctx = document.getElementById('bar_chart').getContext('2d');
            bar_chart = new Chart(ctx, bar_chart_config);
            var chart_data = JSON.parse(event.detail.chart_data);
            // chart.data.labels = chart_data.labels;
            bar_chart.data.datasets[0].data = chart_data.data;
            // chart.update();
            bar_chart.update('none');
        });
    });
</script>