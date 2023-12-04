<?= $this->extend('Layouts/index'); ?>

<?= $this->section('content'); ?>
<div>
    <canvas id="myChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const defaultTitle = 'Production Value (in Rupiah)'

    const coordinates = {
        top: 0,
        bottom: 0,
        left: 0,
        right: 0,
    }

    const productionValueData = <?= json_encode($productionValue); ?>;

    const data = {
        datasets: [{
            label: defaultTitle,
            data: productionValueData,
            backgroundColor: productionValueData.map(item => item.background_color),
            borderColor: productionValueData.map(item => item.border_color),
            borderWidth: 1
        }]
    };

    const resetButton = {
        id: 'resetButton',
        beforeDraw: (chart, args, options) => {
            if (chart.config.data.datasets[0].label !== defaultTitle) {
                const {
                    ctx,
                    chartArea: {
                        top,
                        bottom,
                        left,
                        right,
                        width,
                        height,
                    }
                } = chart;

                ctx.save();
                const text = 'Back';
                const thickBorder = 3;
                const textWidth = ctx.measureText(text).width;

                //draw background
                ctx.fillStyle = 'rgba(255,26,104,0.2)';
                ctx.fillRect((right - (textWidth + 1 + 10)), 5, textWidth + 10, 20);

                //draw text
                ctx.fillStyle = '#666';
                ctx.font = '12px Arial';
                ctx.fillText(text, (right - (textWidth + 1 + 5)), 15);

                //draw border
                ctx.lineWidth = thickBorder + 'px';
                ctx.strokeStyle = 'rgba(255,26,104,1)';
                ctx.strokeRect((right - (textWidth + 1 + 10)), 5, textWidth + 10, 20);

                coordinates.top = 5;
                coordinates.bottom = 25;
                coordinates.left = right - (textWidth + 1 + 10);
                coordinates.right = right;
                ctx.restore();
            }
        },
    }

    const config = {
        type: 'bar',
        data,
        options: {
            plugins: {
                tooltip: {
                    yAlign: 'bottom',
                }
            },
            onHover: (event, chartElement) => {
                if (myChart.config.data.datasets[0].label === defaultTitle) {
                    event.native.target.style.cursor = chartElement[0] ? 'pointer' : 'default';
                } else {
                    event.native.target.style.cursor = 'default'
                }
            },
            parsing: {
                xAxisKey: 'year',
                yAxisKey: 'total_production_value',
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
        plugins: [resetButton]
    };

    // render init block
    const ctx = document.getElementById('myChart')
    const myChart = new Chart(
        ctx,
        config
    );

    function clickHandler(click) {
        if (myChart.config.data.datasets[0].label === defaultTitle) {
            const bar = myChart.getElementsAtEventForMode(click, 'nearest', {
                intersect: true
            }, true);
            if (bar.length) {
                changeChart(bar[0].index);
            }
        }
    }

    function changeChart(clickedValue) {
        myChart.config.options.parsing.xAxisKey = 'detail.production_type_name';
        myChart.config.options.parsing.yAxisKey = 'detail.production_value';

        const backgroundColor = [];
        const borderColor = [];
        const productionValue = [];
        const Labels = productionValueData[clickedValue].detail.map(labels => {
            backgroundColor.push(productionValueData[clickedValue].background_color);
            borderColor.push(productionValueData[clickedValue].border_color);
            productionValue.push(labels.production_value);
            return labels.production_type_name;
        });

        myChart.config.data.datasets[0].data = productionValue;
        myChart.config.data.labels = Labels;
        myChart.config.data.datasets[0].backgroundColor = backgroundColor;
        myChart.config.data.datasets[0].borderColor = borderColor;
        myChart.config.data.datasets[0].label = "Production Value " + productionValueData[clickedValue].year + " (in Rupiah)";

        myChart.update();

    }

    function resetChart() {
        myChart.config.options.parsing.xAxisKey = 'year';
        myChart.config.options.parsing.yAxisKey = 'total_production_value';

        const backgroundColor = [];
        const borderColor = [];
        const totalProductionValue = [];
        const Labels = productionValueData.map(production => {
            backgroundColor.push(production.background_color);
            borderColor.push(production.border_color);
            totalProductionValue.push(production.total_production_value);
            return production.year;
        });

        myChart.config.data.datasets[0].backgroundColor = backgroundColor;
        myChart.config.data.datasets[0].borderColor = borderColor;
        myChart.config.data.labels = Labels;
        myChart.config.data.datasets[0].label = defaultTitle;
        myChart.config.data.datasets[0].data = totalProductionValue;

        myChart.update();
    }

    function mouseMoveHandler(canvas, mousemove) {
        if (myChart.config.data.datasets[0].label !== defaultTitle) {
            const x = mousemove.offsetX;
            const y = mousemove.offsetY;

            if (x > coordinates.left && x < coordinates.right && y > coordinates.top && y < coordinates.bottom) {
                canvas.style.cursor = 'pointer';
            } else {
                canvas.style.cursor = 'default';
            }
        }
    }

    function clickButtonHandler(canvas, click) {
        const x = click.offsetX;
        const y = click.offsetY;
        if (x > coordinates.left && x < coordinates.right && y > coordinates.top && y < coordinates.bottom) {
            resetChart();
        }
    }

    ctx.onclick = clickHandler;

    ctx.addEventListener('mousemove', (e) => {
        mouseMoveHandler(ctx, e);
    });

    ctx.addEventListener('click', (e) => {
        clickButtonHandler(ctx, e);
    })
</script>

<?= $this->endSection(); ?>