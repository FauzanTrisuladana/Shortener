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
        <a href="{{ route('links', ['newopened' => 1]) }}" class="text-decoration-none">
            <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; cursor:pointer;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="card-title mb-2">
                                <i class="bi bi-link-45deg me-2"></i>
                                Buat Link Baru
                            </h5>
                            <p class="card-text mb-0 opacity-75">Buat link pendek baru</p>
                        </div>
                        <i class="bi bi-arrow-right-circle fs-1"></i>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-6 mb-3">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white;">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="card-title mb-2">
                            <i class="bi bi-question-circle me-2"></i>
                            Bantuan & Dukungan
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
                        <p class="text-muted mb-1">Pengunjung</p>
                        <h2 class="mb-0">{{ number_format($totalVisitors) }}</h2>
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
                        <p class="text-muted mb-1">Pengunjung Unik</p>
                        <h2 class="mb-0">{{ number_format($uniqueVisitors) }}</h2>
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
                    <h5 class="mb-0">Aktivitas Klik</h5>
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
        }
    };
</script>
@vite('resources/js/dashboard.js')
@endpush
@endsection
