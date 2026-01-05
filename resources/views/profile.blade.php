@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h1 class="h2 mb-3">Profile Settings</h1>
        <p class="text-muted">Kelola informasi profil Anda</p>
    </div>
</div>

{{-- Success Alert --}}
@if(session('success'))
    <x-alert-success :message="session('success')" />
@endif

{{-- Error Alert --}}
@if($errors->has('form'))
    <x-alert-error :message="$errors->first('form')" />
@endif

{{-- Error Alert --}}
@if($errors->has('confirm'))
    <x-alert-error :message="$errors->first('confirm')" />
@endif

<div class="row">
    <!-- Profile Information Card -->
    <div class="col-md-8 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h5 class="card-title mb-4">Informasi Pribadi</h5>
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ auth()->user()->name }}">
                        <x-alert-input-error field="name" />
                    </div>

                    @if(!auth()->user()->provider || auth()->user()->provider !== 'google')
                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ auth()->user()->email }}">
                            <x-alert-input-error field="email" />
                        </div>
                    @else
                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email (terhubung dengan Google)</label>
                            <input type="email" class="form-control" id="email" value="{{ auth()->user()->email }}" readonly style="cursor: not-allowed;">
                        </div>
                    @endif

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
                <h5 class="card-title mb-4">{{ auth()->user()->password ? 'Ubah Kata Sandi' : 'Atur Kata Sandi' }}</h5>
                <form method="POST" action="{{ route('profile.update-password') }}">
                    @csrf
                    @if(auth()->user()->password)
                        <div class="mb-3">
                            <label for="currentPassword" class="form-label">Kata Sandi Saat Ini</label>
                            <input type="password" class="form-control @error('currentPassword') is-invalid @enderror" id="currentPassword" name="currentPassword">
                            <x-alert-input-error field="currentPassword" />
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="newPassword" class="form-label">Kata Sandi Baru</label>
                        <input type="password" class="form-control @error('newPassword') is-invalid @enderror" id="newPassword" name="newPassword">
                        <x-alert-input-error field="newPassword" />
                    </div>

                    <div class="mb-3">
                        <label for="newPassword_confirmation" class="form-label">Konfirmasi Kata Sandi Baru</label>
                        <input type="password" class="form-control @error('newPassword_confirmation') is-invalid @enderror" id="newPassword_confirmation" name="newPassword_confirmation">
                        <x-alert-input-error field="newPassword_confirmation" />
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
                @if(auth()->user()->profile_image ?? false)
                    @if(Str::startsWith(auth()->user()->profile_image, ['http://', 'https://']))
                        <img src="{{ auth()->user()->profile_image }}" alt="Avatar" class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">
                    @else
                        <img src="{{ asset(auth()->user()->profile_image) }}" alt="Avatar" class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">
                    @endif
                @else
                    <div class="bg-danger text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 100px; height: 100px; font-size: 48px;">
                        {{ strtoupper(collect(explode(' ', auth()->user()->name))->map(fn($n) => substr($n,0,1))->join('')) }}
                    </div>
                @endif
                <h5 class="mb-1">{{ auth()->user()->name }}</h5>
                <button class="btn btn-outline-danger btn-sm w-100" data-bs-toggle="modal" data-bs-target="#uploadPhotoModal">
                    <i class="bi bi-camera me-2"></i>
                    Ubah Foto
                </button>
            </div>
        </div>

        <!-- Google Account Connection Card -->
        @if(!auth()->user()->provider || auth()->user()->provider !== 'google')
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <h6 class="card-title mb-3">
                    <i class="bi bi-google me-2"></i>
                    Hubungkan Google
                </h6>
                <p class="small text-muted mb-3">Hubungkan akun Anda dengan Google untuk login yang lebih mudah.</p>
                <a href="{{ route('auth.google') }}" class="btn btn-outline-danger btn-sm w-100">
                    <i class="bi bi-google me-2"></i>
                    Hubungkan dengan Google
                </a>
                <div class="text-muted small mt-2">*pastikan alamat email yang digunakan sama</div>
            </div>
        </div>
        @endif

        <!-- Danger Zone Card -->
        <div class="card border-danger shadow-sm">
            <div class="card-body m-4">
                <h6 class="card-title text-danger mb-3">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    Zona Berbahaya
                </h6>
                <p class="small text-muted mb-3">Hapus akun Anda secara permanen beserta semua data Anda.</p>
                <button class="btn btn-outline-danger btn-sm w-100" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                    Hapus Akun
                </button>
            </div>
        </div>
    </div>
</div>

<x-delete-account-modal
    :modalId="'deleteAccountModal'"
    :title="'Hapus Akun Secara Permanen'"
    :message="'Tindakan ini tidak dapat dibatalkan. Akun dan semua data Anda akan dihapus secara permanen.'"
    :formId="'deleteAccountForm'"
    :formAction="route('profile.delete')"
    :buttonId="'deleteAccountBtn'"
    :buttonText="'Hapus Akun Selamanya'"
    :checkboxId="'confirmDelete'"
    :confirmText="'Saya mengerti dan ingin menghapus akun saya secara permanen'"
    :requireConfirm="true"
    :method="'POST'"
/>

<x-upload-photo-modal />
@endsection
