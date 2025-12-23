@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h1 class="h2 mb-3">Dashboard</h1>
    </div>
</div>

<!-- Quick Access Cards -->
<div class="row mb-4">
    <div class="col-md-6 mb-3">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="card-title mb-2">
                            <i class="bi bi-link-45deg me-2"></i>
                            Short new Link
                        </h5>
                        <p class="card-text mb-0 opacity-75">Buat link pendek baru</p>
                    </div>
                    <i class="bi bi-arrow-right-circle fs-1"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white;">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="card-title mb-2">
                            <i class="bi bi-question-circle me-2"></i>
                            Help & Support
                        </h5>
                        <p class="card-text mb-0 opacity-75">Butuh bantuan?</p>
                    </div>
                    <i class="bi bi-arrow-right-circle fs-1"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Analytics Section -->
<div class="row mb-4">
    <div class="col-12 mb-3">
        <h4>Analytics</h4>
    </div>

    <div class="col-md-6 mb-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted mb-1">Visitors</p>
                        <h2 class="mb-0">2,847</h2>
                    </div>
                    <div class="bg-danger bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <i class="bi bi-people-fill text-danger fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted mb-1">Unique Visitor</p>
                        <h2 class="mb-0">1,923</h2>
                    </div>
                    <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <i class="bi bi-person-fill text-primary fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart Section -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0">Click Activity</h5>
                    <div class="btn-group" role="group">
                        <input type="radio" class="btn-check" name="timeRange" id="weekly" autocomplete="off" checked>
                        <label class="btn btn-outline-secondary btn-sm" for="weekly">Mingguan</label>

                        <input type="radio" class="btn-check" name="timeRange" id="monthly" autocomplete="off">
                        <label class="btn btn-outline-secondary btn-sm" for="monthly">Bulanan</label>

                        <input type="radio" class="btn-check" name="timeRange" id="yearly" autocomplete="off">
                        <label class="btn btn-outline-secondary btn-sm" for="yearly">Tahunan</label>
                    </div>
                </div>
                <div class="chart-container" style="height: 300px; position: relative;">
                    <canvas id="clickActivityChart"></canvas>
                </div>
                <div class="chart-legend mt-3 d-flex justify-content-center gap-4">
                    <div class="d-flex align-items-center">
                        <div style="width: 20px; height: 3px; background: #667eea; margin-right: 8px;"></div>
                        <span class="text-muted small">Total Clicks</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <div style="width: 20px; height: 3px; background: #f093fb; margin-right: 8px;"></div>
                        <span class="text-muted small">Unique Visitors</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Analytics Summary -->
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-2 text-center mb-3 mb-md-0">
                        <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 120px; height: 120px;">
                            <i class="bi bi-graph-up text-primary" style="font-size: 48px;"></i>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <h4 class="mb-2">Analisis Performa Link</h4>
                        <p class="text-muted mb-3">Lihat statistik lengkap, demografi pengunjung, dan performa setiap link Anda</p>
                    </div>
                    <div class="col-md-3 text-md-end">
                        <a href="{{ route('analytics') }}" class="btn btn-primary btn-lg w-100">
                            <i class="bi bi-bar-chart me-2"></i>
                            Lihat Analisis Lengkap
                        </a>
                        <small class="d-block mt-2 text-muted">Data real-time</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('clickActivityChart');

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
</script>
@endsection
