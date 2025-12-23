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
                <h2 class="mb-0">0</h2>
                <small class="text-success">
                    <i class="bi bi-arrow-up"></i> 0% dari minggu lalu
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
                <h2 class="mb-0">0</h2>
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
                <h2 class="mb-0">0%</h2>
                <small class="text-muted">
                    Rata-rata
                </small>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="text-muted mb-0">QR Scans</h6>
                    <i class="bi bi-qr-code text-danger fs-4"></i>
                </div>
                <h2 class="mb-0">0</h2>
                <small class="text-muted">
                    Total scan
                </small>
            </div>
        </div>
    </div>
</div>

<!-- Chart Section -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-4">Click Activity</h5>
                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 300px;">
                    <div class="text-center">
                        <i class="bi bi-bar-chart fs-1 text-muted mb-3"></i>
                        <p class="text-muted">Belum ada data untuk ditampilkan</p>
                    </div>
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
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                    Belum ada link
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
