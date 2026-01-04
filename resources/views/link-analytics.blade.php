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
                        <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editLinkModal" onclick="editLink(1, 'promo-special', 'Promo Special Campaign', 'https://example.com/very-long-url-here/promo-special')">
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
                <h5 class="card-title mb-4">Top 5 Countries</h5>
                <div class="chart-container" style="height: 250px; position: relative;">
                    <canvas id="countryChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-4">Top 5 Cities</h5>
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

<!-- Click Activity Table -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-4">Recent Click Activity</h5>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Timestamp</th>
                                <th>Country</th>
                                <th>City</th>
                                <th>Device</th>
                                <th>Browser</th>
                                <th>Referrer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><small class="text-muted">2026-01-01 14:23:45</small></td>
                                <td><i class="bi bi-flag me-1"></i>Indonesia</td>
                                <td>Jakarta</td>
                                <td><i class="bi bi-phone me-1"></i>Mobile</td>
                                <td><i class="bi bi-browser-chrome text-warning me-1"></i>Chrome</td>
                                <td><small class="text-muted">Direct</small></td>
                            </tr>
                            <tr>
                                <td><small class="text-muted">2026-01-01 14:18:12</small></td>
                                <td><i class="bi bi-flag me-1"></i>Indonesia</td>
                                <td>Bandung</td>
                                <td><i class="bi bi-laptop me-1"></i>Desktop</td>
                                <td><i class="bi bi-browser-firefox text-danger me-1"></i>Firefox</td>
                                <td><small class="text-muted">google.com</small></td>
                            </tr>
                            <tr>
                                <td><small class="text-muted">2026-01-01 14:05:33</small></td>
                                <td><i class="bi bi-flag me-1"></i>Malaysia</td>
                                <td>Kuala Lumpur</td>
                                <td><i class="bi bi-tablet me-1"></i>Tablet</td>
                                <td><i class="bi bi-browser-safari text-primary me-1"></i>Safari</td>
                                <td><small class="text-muted">facebook.com</small></td>
                            </tr>
                            <tr>
                                <td><small class="text-muted">2026-01-01 13:52:18</small></td>
                                <td><i class="bi bi-flag me-1"></i>Indonesia</td>
                                <td>Surabaya</td>
                                <td><i class="bi bi-phone me-1"></i>Mobile</td>
                                <td><i class="bi bi-browser-chrome text-warning me-1"></i>Chrome</td>
                                <td><small class="text-muted">twitter.com</small></td>
                            </tr>
                            <tr>
                                <td><small class="text-muted">2026-01-01 13:41:05</small></td>
                                <td><i class="bi bi-flag me-1"></i>Singapore</td>
                                <td>Singapore</td>
                                <td><i class="bi bi-laptop me-1"></i>Desktop</td>
                                <td><i class="bi bi-browser-edge text-info me-1"></i>Edge</td>
                                <td><small class="text-muted">linkedin.com</small></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-3">
                    <button class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-clockwise me-2"></i>Load More
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
@vite('resources/js/link-analytics.js')
@endpush

<!-- Edit Link Modal -->
<div class="modal fade" id="editLinkModal" tabindex="-1" aria-labelledby="editLinkModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="editLinkModalLabel">
                    <i class="bi bi-pencil me-2"></i>
                    Edit Link
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editLinkForm" method="POST" action="{{ route('links.update', ['id' => $id]) }}">
                    @csrf
                    @method('POST')
                    <div class="mb-3">
                        <label for="editOriginalUrl" class="form-label">Original URL</label>
                        <input
                            type="url"
                            class="form-control"
                            id="editOriginalUrl"
                            name="target_url"
                            placeholder="https://example.com/very-long-url">
                    </div>
                    <div class="mb-3">
                        <label for="editLinkName" class="form-label">Link Name</label>
                        <input
                            type="text"
                            class="form-control"
                            id="editLinkName"
                            name="name"
                            placeholder="My Campaign">
                    </div>
                    <div class="mb-3">
                        <label for="editCustomAlias" class="form-label">Custom Alias</label>
                        <div class="input-group">
                            <span class="input-group-text">{{ rtrim(config('app.url'), '/') . '/' }}</span>
                            <input
                                type="text"
                                class="form-control"
                                id="editCustomAlias"
                                name="custom_alias"
                                placeholder="my-link">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <div class="form-check form-switch">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                id="editLinkStatus"
                                name="is_active"
                                checked>
                            <label class="form-check-label" for="editLinkStatus">
                                Active
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger">
                    <i class="bi bi-check-circle me-2"></i>
                    Save Changes
                </button>
            </div>
        </div>
    </div>
</div>

@endsection
