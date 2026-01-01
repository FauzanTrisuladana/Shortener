// Link Analytics Chart and Modal Script
document.addEventListener('DOMContentLoaded', function() {
    // Click Activity Chart
    const activityCtx = document.getElementById('clickActivityChart');
    if (activityCtx) {
        const weeklyData = {
            labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
            datasets: [{
                label: 'Clicks',
                data: [145, 178, 156, 201, 189, 167, 134],
                borderColor: '#667eea',
                backgroundColor: 'rgba(102, 126, 234, 0.1)',
                tension: 0.4,
                fill: true,
                borderWidth: 2
            }]
        };

        const monthlyData = {
            labels: Array.from({length: 30}, (_, i) => `${i + 1}`),
            datasets: [{
                label: 'Clicks',
                data: [89, 112, 98, 145, 178, 156, 201, 189, 167, 134, 123, 145, 167, 189, 201, 178, 156, 134, 112, 98, 89, 101, 123, 145, 167, 189, 201, 178, 156, 134],
                borderColor: '#667eea',
                backgroundColor: 'rgba(102, 126, 234, 0.1)',
                tension: 0.4,
                fill: true,
                borderWidth: 2
            }]
        };

        const allData = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Oct', 'Nov', 'Des'],
            datasets: [{
                label: 'Clicks',
                data: [1234, 1456, 1789, 2012, 2345, 2678, 2901, 3123, 2890, 2567, 2234, 3245],
                borderColor: '#667eea',
                backgroundColor: 'rgba(102, 126, 234, 0.1)',
                tension: 0.4,
                fill: true,
                borderWidth: 2
            }]
        };

        const activityChart = new Chart(activityCtx, {
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
                        padding: 12
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        }
                    }
                }
            }
        });

        // Handle time range changes
        document.querySelectorAll('input[name="timeRange"]').forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.id === 'weekly') {
                    activityChart.data = weeklyData;
                } else if (this.id === 'monthly') {
                    activityChart.data = monthlyData;
                } else if (this.id === 'all') {
                    activityChart.data = allData;
                }
                activityChart.update();
            });
        });
    }

    // Country Chart
    const countryCtx = document.getElementById('countryChart');
    if (countryCtx) {
        new Chart(countryCtx, {
            type: 'doughnut',
            data: {
                labels: ['Indonesia', 'USA', 'Malaysia', 'Singapore', 'Other'],
                datasets: [{
                    data: [1520, 891, 456, 287, 91],
                    backgroundColor: ['#667eea', '#f093fb', '#4facfe', '#43e97b', '#cccccc'],
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
                labels: ['Jakarta', 'NY', 'KL', 'SG', 'Sydney'],
                datasets: [{
                    data: [1245, 834, 429, 276, 187],
                    backgroundColor: '#667eea',
                    borderRadius: 6,
                    barThickness: 30
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0, 0, 0, 0.05)' }
                    },
                    x: {
                        grid: { display: false }
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
                    data: [1892, 1123, 230],
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
                    }
                }
            }
        });
    }
});

// Edit Link Modal Function
function editLink(id, slug, name, url) {
    document.getElementById('editLinkId').value = id;
    document.getElementById('editCustomAlias').value = slug;
    document.getElementById('editLinkName').value = name;
    document.getElementById('editOriginalUrl').value = url;
}
