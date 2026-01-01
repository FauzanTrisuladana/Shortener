@extends('layouts.app')

@section('title', 'Analytics')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h1 class="h2 mb-3">Analytics</h1>
        <p class="text-muted">Monitor performa link shortener Anda</p>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="text-muted mb-0">Total Clicks</h6>
                    <i class="bi bi-mouse text-primary fs-4"></i>
                </div>
                <h2 class="mb-0">12,847</h2>
                <small class="text-success">
                    <i class="bi bi-arrow-up"></i> 18.2% dari minggu lalu
                </small>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="text-muted mb-0">Total Links</h6>
                    <i class="bi bi-link-45deg text-success fs-4"></i>
                </div>
                <h2 class="mb-0">24</h2>
                <small class="text-muted">
                    Link aktif
                </small>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="text-muted mb-0">Click Rate</h6>
                    <i class="bi bi-graph-up text-warning fs-4"></i>
                </div>
                <h2 class="mb-0">67.4%</h2>
                <small class="text-muted">
                    Rata-rata
                </small>
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

<!-- Geographic Analytics -->
<div class="row mb-4">
    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-4">Top 5 Countries</h5>
                <div class="chart-container" style="height: 300px; position: relative;">
                    <canvas id="countryChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-4">Top 5 Cities</h5>
                <div class="chart-container" style="height: 300px; position: relative;">
                    <canvas id="cityChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-4">Devices</h5>
                <div class="chart-container" style="height: 300px; position: relative;">
                    <canvas id="deviceChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Top Links Table -->
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-4">Top Performing Links</h5>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Link</th>
                                <th>Clicks</th>
                                <th>Created</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-link-45deg text-primary me-2"></i>
                                        <div>
                                            <a href="#" class="text-decoration-none">link.trisuladana.com/promo-special</a>
                                            <br>
                                            <small class="text-muted">https://example.com/very-long-url...</small>
                                        </div>
                                    </div>
                                </td>
                                <td><strong>3,245</strong></td>
                                <td>15 Des 2025</td>
                                <td><span class="badge bg-success">Active</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-link-45deg text-primary me-2"></i>
                                        <div>
                                            <a href="#" class="text-decoration-none">link.trisuladana.com/campaign-2024</a>
                                            <br>
                                            <small class="text-muted">https://marketing.site/campaign...</small>
                                        </div>
                                    </div>
                                </td>
                                <td><strong>2,891</strong></td>
                                <td>12 Des 2025</td>
                                <td><span class="badge bg-success">Active</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-link-45deg text-primary me-2"></i>
                                        <div>
                                            <a href="#" class="text-decoration-none">link.trisuladana.com/webinar-tech</a>
                                            <br>
                                            <small class="text-muted">https://events.com/webinar-tech...</small>
                                        </div>
                                    </div>
                                </td>
                                <td><strong>2,456</strong></td>
                                <td>10 Des 2025</td>
                                <td><span class="badge bg-success">Active</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-link-45deg text-primary me-2"></i>
                                        <div>
                                            <a href="#" class="text-decoration-none">link.trisuladana.com/product-launch</a>
                                            <br>
                                            <small class="text-muted">https://shop.com/new-product...</small>
                                        </div>
                                    </div>
                                </td>
                                <td><strong>1,987</strong></td>
                                <td>8 Des 2025</td>
                                <td><span class="badge bg-success">Active</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-link-45deg text-primary me-2"></i>
                                        <div>
                                            <a href="#" class="text-decoration-none">link.trisuladana.com/portfolio</a>
                                            <br>
                                            <small class="text-muted">https://portfolio.design/showcase...</small>
                                        </div>
                                    </div>
                                </td>
                                <td><strong>1,268</strong></td>
                                <td>5 Des 2025</td>
                                <td><span class="badge bg-success">Active</span></td>
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
@vite(['resources/js/dashboard.js', 'resources/js/analytics.js'])
@endpush
@endsection
