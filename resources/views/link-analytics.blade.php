@extends('layouts.app')

@section('title', 'Link Analytics')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <a href="{{ route('links') }}" class="btn btn-light mb-3">
            <i class="bi bi-arrow-left me-2"></i>Back to Links
        </a>
        <h1 class="h2 mb-2">Link Analytics</h1>
        <p class="text-muted mb-3">Analisis detail untuk link tertentu</p>

        <!-- Link Info Card -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h5 class="mb-2">
                            <i class="bi bi-link-45deg text-primary me-2"></i>
                            link.trisuladana.com/<span class="text-danger">promo-special</span>
                        </h5>
                        <p class="text-muted mb-2">
                            <strong>Name:</strong> Promo Special Campaign
                        </p>
                        <p class="text-muted small mb-0">
                            <i class="bi bi-box-arrow-up-right me-1"></i>
                            Target: https://example.com/very-long-url-here/promo-special
                        </p>
                    </div>
                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                        <button class="btn btn-outline-secondary">
                            <i class="bi bi-pencil me-2"></i>Edit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="text-muted mb-0">Total Clicks</h6>
                    <i class="bi bi-mouse text-primary fs-4"></i>
                </div>
                <h2 class="mb-0">3,245</h2>
                <small class="text-success">
                    <i class="bi bi-arrow-up"></i> 12.5% minggu ini
                </small>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="text-muted mb-0">Unique Visitors</h6>
                    <i class="bi bi-person text-success fs-4"></i>
                </div>
                <h2 class="mb-0">2,891</h2>
                <small class="text-muted">
                    89.1% dari total
                </small>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="text-muted mb-0">Avg. Daily</h6>
                    <i class="bi bi-calendar-check text-warning fs-4"></i>
                </div>
                <h2 class="mb-0">108</h2>
                <small class="text-muted">
                    Per hari
                </small>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="text-muted mb-0">Peak Hour</h6>
                    <i class="bi bi-clock text-danger fs-4"></i>
                </div>
                <h2 class="mb-0">14:00</h2>
                <small class="text-muted">
                    WIB
                </small>
            </div>
        </div>
    </div>
</div>

<!-- Click Activity Chart -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0">Click Activity</h5>
                    <div class="btn-group" role="group">
                        <input type="radio" class="btn-check" name="timeRange" id="weekly" autocomplete="off" checked>
                        <label class="btn btn-outline-secondary btn-sm" for="weekly">7 Hari</label>

                        <input type="radio" class="btn-check" name="timeRange" id="monthly" autocomplete="off">
                        <label class="btn btn-outline-secondary btn-sm" for="monthly">30 Hari</label>

                        <input type="radio" class="btn-check" name="timeRange" id="all" autocomplete="off">
                        <label class="btn btn-outline-secondary btn-sm" for="all">Semua</label>
                    </div>
                </div>
                <div class="chart-container" style="height: 300px; position: relative;">
                    <canvas id="clickActivityChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Geographic & Device Analytics -->
<div class="row mb-4">
    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-4">Top Countries</h5>
                <div class="chart-container" style="height: 250px; position: relative;">
                    <canvas id="countryChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-4">Top Cities</h5>
                <div class="chart-container" style="height: 250px; position: relative;">
                    <canvas id="cityChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-4">Devices</h5>
                <div class="chart-container" style="height: 250px; position: relative;">
                    <canvas id="deviceChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Browsers -->
<div class="row mb-4">
    <div class="col-md-12 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-4">Browsers</h5>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Browser</th>
                                <th class="text-end">Clicks</th>
                                <th class="text-end">%</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><i class="bi bi-browser-chrome text-warning me-2"></i>Chrome</td>
                                <td class="text-end"><strong>1,892</strong></td>
                                <td class="text-end">58%</td>
                            </tr>
                            <tr>
                                <td><i class="bi bi-browser-safari text-primary me-2"></i>Safari</td>
                                <td class="text-end"><strong>723</strong></td>
                                <td class="text-end">22%</td>
                            </tr>
                            <tr>
                                <td><i class="bi bi-browser-firefox text-danger me-2"></i>Firefox</td>
                                <td class="text-end"><strong>423</strong></td>
                                <td class="text-end">13%</td>
                            </tr>
                            <tr>
                                <td><i class="bi bi-browser-edge text-info me-2"></i>Edge</td>
                                <td class="text-end"><strong>207</strong></td>
                                <td class="text-end">7%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
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
                            display: false
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
                            padding: 10,
                            font: { size: 11 }
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
                            padding: 10,
                            font: { size: 11 }
                        }
                    }
                }
            }
        });
    }
});
</script>
@endpush
@endsection
