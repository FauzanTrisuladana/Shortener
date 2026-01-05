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
    <div class="col-md-3 mb-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="text-muted mb-0">Total Clicks</h6>
                    <i class="bi bi-mouse text-primary fs-4"></i>
                </div>
                <h2 class="mb-0">{{ $totalVisitors }}</h2>
                <small class="text-success">
                    <i class="bi bi-arrow-up"></i> {{ $percentageChange }}% dari minggu lalu
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
                <h2 class="mb-0">{{ number_format($uniqueVisitors) }}</h2>
                <small class="text-muted">
                    @php
                        $percentage = $totalVisitors > 0 ? ($uniqueVisitors / $totalVisitors * 100) : 0;
                    @endphp
                    {{ number_format($percentage, 1) }}% dari total
                </small>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="text-muted mb-0">Total Links</h6>
                    <i class="bi bi-link-45deg text-success fs-4"></i>
                </div>
                <h2 class="mb-0">{{ $totalActiveLinks }}</h2>
                <small class="text-muted">
                    Link aktif
                </small>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="text-muted mb-0">Click Rate</h6>
                    <i class="bi bi-graph-up text-warning fs-4"></i>
                </div>
                <h2 class="mb-0">{{ $clickRate }} X</h2>
                <small class="text-muted">
                    Per link rata-rata
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
                        <input type="radio" class="btn-check" name="timeRange" id="sevenDays" autocomplete="off" checked>
                        <label class="btn btn-outline-secondary btn-sm" for="sevenDays">7 Hari</label>

                        <input type="radio" class="btn-check" name="timeRange" id="thirtyDays" autocomplete="off">
                        <label class="btn btn-outline-secondary btn-sm" for="thirtyDays">30 Hari</label>

                        <input type="radio" class="btn-check" name="timeRange" id="allTime" autocomplete="off">
                        <label class="btn btn-outline-secondary btn-sm" for="allTime">Semua</label>
                    </div>
                </div>
                <div class="chart-container" style="height: 300px; position: relative;">
                    <canvas id="clickActivityChart"></canvas>
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
                            @forelse ($links as $link)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-link-45deg text-primary me-2"></i>
                                            <div>
                                                <a href="{{ url($link->new_link) }}" class="text-decoration-none">{{ url($link->new_link) }}</a>
                                                <br>
                                                <small class="text-muted">{{ Str::limit($link->true_link, 50) }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td><strong>{{ $link->visitors->count() }}</strong></td>
                                    <td>{{ $link->created_at->format('d M Y') }}</td>
                                    <td>
                                        @if($link->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <i class="bi bi-link-45deg fs-1 d-block mb-2"></i>
                                    Belum ada link. Buat link pertama Anda!
                                </td>
                            </tr>
                            @endforelse
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
    window.chartData = {
        sevenDays: {
            labels: @json($chart7Labels),
            data: @json($chart7Data),
            uniqueData: @json($chart7UniqueData)
        },
        thirtyDays: {
            labels: @json($chart30Labels),
            data: @json($chart30Data),
            uniqueData: @json($chart30UniqueData)
        },
        allTime: {
            labels: @json($chartAllLabels),
            data: @json($chartAllData),
            uniqueData: @json($chartAllUniqueData)
        },
        topcountries: @json($top5sCountries),
        topcities: @json($top5sCities),
        topdevices: @json($devices)
    };
</script>
@vite(['resources/js/dashboard.js', 'resources/js/analytics.js'])
@endpush
@endsection
