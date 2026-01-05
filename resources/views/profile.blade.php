@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h1 class="h2 mb-3">Profile Settings</h1>
        <p class="text-muted">Kelola informasi profil Anda</p>
    </div>
</div>

<div class="row">
    <!-- Profile Information Card -->
    <div class="col-md-8 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h5 class="card-title mb-4">Informasi Pribadi</h5>
                <form>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" value="Fauzan Trisuladana">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Alamat Email</label>
                        <input type="email" class="form-control" id="email" value="fauzan@example.com">
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-check-circle me-2"></i>
                            Simpan Perubahan
                        </button>
                        <button type="reset" class="btn btn-light">Batal</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Change Password Card -->
        <div class="card border-0 shadow-sm mt-4">
            <div class="card-body p-4">
                <h5 class="card-title mb-4">Ubah Kata Sandi</h5>
                <form>
                    <div class="mb-3">
                        <label for="currentPassword" class="form-label">Kata Sandi Saat Ini</label>
                        <input type="password" class="form-control" id="currentPassword">
                    </div>

                    <div class="mb-3">
                        <label for="newPassword" class="form-label">Kata Sandi Baru</label>
                        <input type="password" class="form-control" id="newPassword">
                    </div>

                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Konfirmasi Kata Sandi Baru</label>
                        <input type="password" class="form-control" id="confirmPassword">
                    </div>

                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-shield-lock me-2"></i>
                        Perbarui Kata Sandi
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Sidebar Cards -->
    <div class="col-md-4">
        <!-- Profile Picture Card -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4 text-center">
                <div class="bg-danger text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 100px; height: 100px; font-size: 48px;">
                    FT
                </div>
                <h5 class="mb-1">Fauzan Trisuladana</h5>
                <button class="btn btn-outline-danger btn-sm w-100">
                    <i class="bi bi-camera me-2"></i>
                    Ubah Foto
                </button>
            </div>
        </div>

        <!-- Danger Zone Card -->
        <div class="card border-danger shadow-sm">
            <div class="card-body m-4">
                <h6 class="card-title text-danger mb-3">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    Zona Berbahaya
                </h6>
                <p class="small text-muted mb-3">Hapus akun Anda secara permanen beserta semua data Anda.</p>
                <button class="btn btn-outline-danger btn-sm w-100">
                    Hapus Akun
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
