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
                <h5 class="card-title mb-4">Personal Information</h5>
                <form>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstName" value="Fauzan">
                        </div>
                        <div class="col-md-6">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastName" value="Trisuladana">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" value="fauzan@example.com">
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="phone" placeholder="+62 xxx xxxx xxxx">
                    </div>

                    <div class="mb-3">
                        <label for="bio" class="form-label">Bio</label>
                        <textarea class="form-control" id="bio" rows="3" placeholder="Tell us about yourself..."></textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-check-circle me-2"></i>
                            Save Changes
                        </button>
                        <button type="reset" class="btn btn-light">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Change Password Card -->
        <div class="card border-0 shadow-sm mt-4">
            <div class="card-body p-4">
                <h5 class="card-title mb-4">Change Password</h5>
                <form>
                    <div class="mb-3">
                        <label for="currentPassword" class="form-label">Current Password</label>
                        <input type="password" class="form-control" id="currentPassword">
                    </div>

                    <div class="mb-3">
                        <label for="newPassword" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="newPassword">
                    </div>

                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="confirmPassword">
                    </div>

                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-shield-lock me-2"></i>
                        Update Password
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
                <p class="text-muted mb-3">Free User</p>
                <button class="btn btn-outline-danger btn-sm w-100">
                    <i class="bi bi-camera me-2"></i>
                    Change Photo
                </button>
            </div>
        </div>

        <!-- Danger Zone Card -->
        <div class="card border-danger shadow-sm">
            <div class="card-body p-4">
                <h6 class="card-title text-danger mb-3">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    Danger Zone
                </h6>
                <p class="small text-muted mb-3">Permanently delete your account and all of your data.</p>
                <button class="btn btn-outline-danger btn-sm w-100">
                    Delete Account
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
