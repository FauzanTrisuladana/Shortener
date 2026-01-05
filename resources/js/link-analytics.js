// Link Analytics Chart and Modal Script
document.addEventListener('DOMContentLoaded', function() {
    // Click Activity Chart
    const activityCtx = document.getElementById('clickActivityChart');
    if (activityCtx) {
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

        const chart = new Chart(activityCtx, config);

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
    }

    // Country Chart
    const countryCtx = document.getElementById('countryChart');
    if (countryCtx) {
        if (!window.chartData.topcountries || window.chartData.topcountries.length === 0) {
            const parent = countryCtx.parentElement;
            parent.innerHTML = '<div style="display: flex; align-items: center; justify-content: center; height: 300px; color: #999; font-size: 14px;"><i class="bi bi-inbox" style="font-size: 32px; margin-right: 10px;"></i><span>Belum ada data tersedia</span></div>';
            console.warn('Belum ada Data negara tersedia');
        } else {
            new Chart(countryCtx, {
                type: 'doughnut',
                data: {
                    labels: window.chartData.topcountries.map(item => item.country),
                    datasets: [{
                        data: window.chartData.topcountries.map(item => item.count),
                        backgroundColor: [
                            '#667eea',
                            '#f093fb',
                            '#4facfe',
                            '#43e97b',
                            '#fa709a'
                        ],
                        borderWidth: 0
                    }]
                },
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
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            padding: 12,
                            callbacks: {
                                label: function(context) {
                                    return context.label + ': ' + context.parsed.toLocaleString() + ' visitors';
                                }
                            }
                        }
                    }
                }
            });
        }
    }

    // City Chart
    const cityCtx = document.getElementById('cityChart');
    if (cityCtx) {
        if (!window.chartData.topcities || window.chartData.topcities.length === 0) {
            const parent = cityCtx.parentElement;
            parent.innerHTML = '<div style="display: flex; align-items: center; justify-content: center; height: 300px; color: #999; font-size: 14px;"><i class="bi bi-inbox" style="font-size: 32px; margin-right: 10px;"></i><span>Belum ada data tersedia</span></div>';
            console.warn('Belum ada Data kota tersedia');
        } else {
            new Chart(cityCtx, {
                type: 'bar',
                data: {
                    labels: window.chartData.topcities.map(item => item.city),
                    datasets: [{
                        label: 'Visitors',
                        data: window.chartData.topcities.map(item => item.count),
                        backgroundColor: '#667eea',
                        borderRadius: 8,
                        barThickness: 40
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            padding: 12
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
                    }
                }
            });
        }
    }

    // Device Chart
    const deviceCtx = document.getElementById('deviceChart');
    if (deviceCtx) {
        if (!window.chartData.topdevices || window.chartData.topdevices.length === 0) {
            const parent = deviceCtx.parentElement;
            parent.innerHTML = '<div style="display: flex; align-items: center; justify-content: center; height: 300px; color: #999; font-size: 14px;"><i class="bi bi-inbox" style="font-size: 32px; margin-right: 10px;"></i><span>Belum ada data tersedia</span></div>';
            console.warn('Belum ada Data perangkat tersedia');
        } else {
            new Chart(deviceCtx, {
                type: 'pie',
                data: {
                    labels: window.chartData.topdevices.map(item => item.device),
                    datasets: [{
                        data: window.chartData.topdevices.map(item => item.count),
                        backgroundColor: ['#667eea', '#f093fb', '#4facfe'],
                        borderWidth: 0
                    }]
                },
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
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            padding: 12,
                            callbacks: {
                                label: function(context) {
                                    return context.label + ': ' + context.parsed.toLocaleString() + ' visitors';
                                }
                            }
                        }
                    }
                }
            });
        }
    }
});

// Edit Link Modal Function
function editLink(id, slug, name, url) {
    document.getElementById('editLinkId').value = id;
    document.getElementById('editCustomAlias').value = slug;
    document.getElementById('editLinkName').value = name;
    document.getElementById('editOriginalUrl').value = url;
}
