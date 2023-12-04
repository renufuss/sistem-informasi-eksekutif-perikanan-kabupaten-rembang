<?= $this->extend('Layouts/index'); ?>

<?= $this->section('content'); ?>
<div>
    <canvas id="myChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const coordinates = {
        top: 0,
        bottom: 0,
        left: 0,
        right: 0,
    }

    const browserData = [{
            browser: 'Chrome',
            color: 'rgba(75, 192, 192, 1)',
            users: 150,
            marketshare: 70,
            versionData: [{
                    version: 'v5',
                    users: 10
                },
                {
                    version: 'v6',
                    users: 20
                },
                {
                    version: 'v7',
                    users: 30
                },
                {
                    version: 'v8',
                    users: 60
                },
                {
                    version: 'v9',
                    users: 20
                },
            ],
        },
        {
            browser: 'FireFox',
            color: 'rgba(255, 26, 104, 1)',
            users: 25,
            marketshare: 24,
            versionData: [{
                    version: 'V3.1',
                    users: 10
                },
                {
                    version: 'v3.2',
                    users: 10
                },
                {
                    version: 'v3.3',
                    users: 5
                },
            ],
        },
        {
            browser: 'Safari',
            color: 'rgba(54, 162, 235, 1)',
            users: 30,
            marketshare: 26,
            versionData: [{
                    version: 'Web 9',
                    users: 10
                },
                {
                    version: 'Web 10',
                    users: 10
                },
                {
                    version: 'Web 11',
                    users: 10
                },
            ],
        }
    ];

    const data = {
        datasets: [{
            label: 'Market Share',
            data: browserData,
            backgroundColor: [
                browserData[0].color,
                browserData[1].color,
                browserData[2].color
            ],
            borderColor: [
                browserData[0].color,
                browserData[1].color,
                browserData[2].color
            ],
            borderWidth: 1
        }]
    };

    const resetButton = {
        id: 'resetButton',
        beforeDraw: (chart, args, options) => {
            if (chart.config.data.datasets[0].label !== 'Market Share') {
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
                if (myChart.config.data.datasets[0].label === 'Market Share') {
                    event.native.target.style.cursor = chartElement[0] ? 'pointer' : 'default';
                } else {
                    event.native.target.style.cursor = 'default'
                }
            },
            parsing: {
                xAxisKey: 'browser',
                yAxisKey: 'marketshare',
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
        if (myChart.config.data.datasets[0].label === 'Market Share') {
            const bar = myChart.getElementsAtEventForMode(click, 'nearest', {
                intersect: true
            }, true);
            if (bar.length) {
                changeChart(bar[0].index);
            }
        }
    }

    function changeChart(clickedValue) {
        myChart.config.options.parsing.xAxisKey = 'versionData.version';
        myChart.config.options.parsing.yAxisKey = 'versionData.users';

        const vColor = [];
        const vUsers = [];
        const vLabels = browserData[clickedValue].versionData.map(labels => {
            vColor.push(browserData[clickedValue].color);
            vUsers.push(labels.users);
            return labels.version;
        });

        myChart.config.data.datasets[0].data = vUsers;
        myChart.config.data.labels = vLabels;
        myChart.config.data.datasets[0].backgroundColor = vColor;
        myChart.config.data.datasets[0].borderColor = vColor;
        myChart.config.data.datasets[0].label = browserData[clickedValue].browser;
        myChart.update();

    }

    function resetChart() {
        myChart.config.options.parsing.xAxisKey = 'browser';
        myChart.config.options.parsing.yAxisKey = 'marketshare';

        const bColor = [];
        const bMarketShare = [];
        const bLabels = browserData.map(browser => {
            bColor.push(browser.color);
            bMarketShare.push(browser.marketshare);
            return browser.browser;
        });

        myChart.config.data.datasets[0].backgroundColor = bColor;
        myChart.config.data.datasets[0].borderColor = bColor;
        myChart.config.data.labels = bLabels;
        myChart.config.data.datasets[0].label = 'Market Share';
        myChart.config.data.datasets[0].data = bMarketShare;

        myChart.update();
    }

    function mouseMoveHandler(canvas, mousemove) {
        if (myChart.config.data.datasets[0].label !== 'Market Share') {
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