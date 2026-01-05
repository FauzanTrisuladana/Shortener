// Analytics Charts Script
document.addEventListener('DOMContentLoaded', function() {
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
