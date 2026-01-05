// Dashboard page JavaScript - Chart.js integration

document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('clickActivityChart');

    if (!ctx) return; // Exit if chart element not found

    // Get data from backend
    const sevenDaysData = {
        labels: window.chartData.sevenDays.labels,
        datasets: [
            {
                label: 'Total Clicks',
                data: window.chartData.sevenDays.data,
                borderColor: '#667eea',
                backgroundColor: 'rgba(102, 126, 234, 0.1)',
                tension: 0.4,
                fill: true,
                borderWidth: 2
            },
            {
                label: 'Unique Visitors',
                data: window.chartData.sevenDays.uniqueData,
                borderColor: '#f093fb',
                backgroundColor: 'rgba(240, 147, 251, 0.1)',
                tension: 0.4,
                fill: true,
                borderWidth: 2
            }
        ]
    };

    const thirtyDaysData = {
        labels: window.chartData.thirtyDays.labels,
        datasets: [
            {
                label: 'Total Clicks',
                data: window.chartData.thirtyDays.data,
                borderColor: '#667eea',
                backgroundColor: 'rgba(102, 126, 234, 0.1)',
                tension: 0.4,
                fill: true,
                borderWidth: 2
            },
            {
                label: 'Unique Visitors',
                data: window.chartData.thirtyDays.uniqueData,
                borderColor: '#f093fb',
                backgroundColor: 'rgba(240, 147, 251, 0.1)',
                tension: 0.4,
                fill: true,
                borderWidth: 2
            }
        ]
    };

    const allTimeData = {
        labels: window.chartData.allTime.labels,
        datasets: [
            {
                label: 'Total Clicks',
                data: window.chartData.allTime.data,
                borderColor: '#667eea',
                backgroundColor: 'rgba(102, 126, 234, 0.1)',
                tension: 0.4,
                fill: true,
                borderWidth: 2
            },
            {
                label: 'Unique Visitors',
                data: window.chartData.allTime.uniqueData,
                borderColor: '#f093fb',
                backgroundColor: 'rgba(240, 147, 251, 0.1)',
                tension: 0.4,
                fill: true,
                borderWidth: 2
            }
        ]
    };

    const config = {
        type: 'line',
        data: sevenDaysData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 15,
                        font: {
                            size: 12
                        }
                    }
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    borderColor: 'rgba(255, 255, 255, 0.1)',
                    borderWidth: 1
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)',
                        drawBorder: false
                    },
                    ticks: {
                        color: '#6c757d',
                        font: {
                            size: 11
                        },
                        callback: function(value) {
                            if (Number.isInteger(value)) {
                                return value;
                            }
                            return '';
                        }
                    }
                },
                x: {
                    grid: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        color: '#6c757d',
                        font: {
                            size: 11
                        }
                    }
                }
            },
            interaction: {
                mode: 'nearest',
                axis: 'x',
                intersect: false
            }
        }
    };

    const chart = new Chart(ctx, config);

    // Handle time range changes
    document.querySelectorAll('input[name="timeRange"]').forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.id === 'sevenDays') {
                chart.data = sevenDaysData;
            } else if (this.id === 'thirtyDays') {
                chart.data = thirtyDaysData;
            } else if (this.id === 'allTime') {
                chart.data = allTimeData;
            }
            chart.update();
        });
    });

    // Dark mode chart colors
    const updateChartColors = () => {
        const isDarkMode = document.body.classList.contains('dark-mode');
        const gridColor = isDarkMode ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.05)';
        const tickColor = isDarkMode ? '#8a8a9a' : '#6c757d';

        chart.options.scales.y.grid.color = gridColor;
        chart.options.scales.y.ticks.color = tickColor;
        chart.options.scales.x.ticks.color = tickColor;
        chart.update();
    };

    // Update on dark mode toggle
    const darkModeToggle = document.getElementById('darkModeToggle');
    if (darkModeToggle) {
        darkModeToggle.addEventListener('click', () => {
            setTimeout(updateChartColors, 100);
        });
    }

    // Initial update
    updateChartColors();
});
