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
            
            @this.click({id: 0 });
        }
    }
    var bar_chart_config = {
        type: String("{!! $chart_type !!}"),
        data: {
            labels: @json($labels),
            datasets: [{
                label: String("{!! $title !!}"),
                data: @json($chart_data->data),
                backgroundColor: @json($chart_data->backgroundColor),
                borderColor: @json($chart_data->borderColor),
                borderWidth: parseFloat("{!! $chart_data->borderWidth !!}")
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: false
                }
            },
            onClick: on_click_handler
        },
        plugins: [{
            id: 'text',
            beforeDraw: function(chart, a, b) {
                var width = chart.chartArea.width,
                    height = chart.chartArea.height,
                    ctx = chart.ctx;
                ctx.restore();
                var fontSize = (height / 114).toFixed(2);
                ctx.font = fontSize + "em sans-serif";
                ctx.textBaseline = "middle";
                var text = chart.data.datasets[0].data.reduce((partialSum, a) => partialSum + a, 0),
                    textX = Math.round((width - ctx.measureText(text).width) / 2),
                    textY = (height / 2) + chart.legend.height + chart.titleBlock.height;
                ctx.fillText(text, textX, textY);
                ctx.save();
            }
        }]
    };
   
    var chart_id = String("{!! $chart_id !!}");
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