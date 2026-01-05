// Analytics Charts Script
document.addEventListener('DOMContentLoaded', function() {
    // Country Chart
    const countryCtx = document.getElementById('countryChart');
    if (countryCtx) {
        new Chart(countryCtx, {
            type: 'doughnut',
            data: {
                labels: topcountries.map(item => item.country),
                datasets: [{
                    data: topcountries.map(item => item.count),
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

    // City Chart
    const cityCtx = document.getElementById('cityChart');
    if (cityCtx) {
        new Chart(cityCtx, {
            type: 'bar',
            data: {
                labels: ['Jakarta', 'New York', 'Kuala Lumpur', 'Singapore', 'Sydney'],
                datasets: [{
                    label: 'Visitors',
                    data: [3245, 2134, 1289, 876, 543],
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

    // Device Chart
    const deviceCtx = document.getElementById('deviceChart');
    if (deviceCtx) {
        new Chart(deviceCtx, {
            type: 'pie',
            data: {
                labels: ['Mobile', 'Desktop', 'Tablet'],
                datasets: [{
                    data: [6234, 5123, 1490],
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
});
