// Dashboard page JavaScript - Chart.js integration

document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('clickActivityChart');

    if (!ctx) return; // Exit if chart element not found

    // Sample data
    const weeklyData = {
        labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
        datasets: [
            {
                label: 'Total Clicks',
                data: [245, 312, 289, 376, 423, 398, 287],
                borderColor: '#667eea',
                backgroundColor: 'rgba(102, 126, 234, 0.1)',
                tension: 0.4,
                fill: true,
                borderWidth: 2
            },
            {
                label: 'Unique Visitors',
                data: [198, 267, 234, 298, 356, 321, 249],
                borderColor: '#f093fb',
                backgroundColor: 'rgba(240, 147, 251, 0.1)',
                tension: 0.4,
                fill: true,
                borderWidth: 2
            }
        ]
    };

    const monthlyData = {
        labels: Array.from({length: 30}, (_, i) => `${i + 1}`),
        datasets: [
            {
                label: 'Total Clicks',
                data: [234, 267, 312, 289, 345, 398, 423, 387, 456, 489, 512, 478, 445, 498, 523, 567, 534, 489, 512, 545, 578, 601, 567, 534, 489, 456, 423, 398, 367, 334],
                borderColor: '#667eea',
                backgroundColor: 'rgba(102, 126, 234, 0.1)',
                tension: 0.4,
                fill: true,
                borderWidth: 2
            },
            {
                label: 'Unique Visitors',
                data: [189, 223, 267, 234, 289, 334, 356, 323, 378, 412, 434, 398, 367, 412, 445, 478, 445, 412, 434, 467, 489, 512, 478, 445, 412, 378, 356, 334, 312, 289],
                borderColor: '#f093fb',
                backgroundColor: 'rgba(240, 147, 251, 0.1)',
                tension: 0.4,
                fill: true,
                borderWidth: 2
            }
        ]
    };

    const yearlyData = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Oct', 'Nov', 'Des'],
        datasets: [
            {
                label: 'Total Clicks',
                data: [4234, 5123, 6789, 7234, 8456, 9123, 10234, 11456, 9876, 8765, 7654, 8234],
                borderColor: '#667eea',
                backgroundColor: 'rgba(102, 126, 234, 0.1)',
                tension: 0.4,
                fill: true,
                borderWidth: 2
            },
            {
                label: 'Unique Visitors',
                data: [3456, 4234, 5678, 6123, 7234, 7890, 8456, 9123, 8234, 7345, 6456, 6890],
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
        data: weeklyData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
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
        console.log(radio.id);
        radio.addEventListener('change', function() {
            if (this.id === 'weekly') {
                chart.data = weeklyData;
            } else if (this.id === 'monthly') {
                chart.data = monthlyData;
            } else if (this.id === 'yearly') {
                chart.data = yearlyData;
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
