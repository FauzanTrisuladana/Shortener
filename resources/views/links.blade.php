@extends('layouts.app')

@section('title', 'Links')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h1 class="h2 mb-3">My Links</h1>
        <p class="text-muted">Kelola semua link shortener Anda</p>
    </div>
    <div class="col-md-4 text-md-end">
        <button class="btn btn-danger btn-lg" data-bs-toggle="modal" data-bs-target="#createLinkModal">
            <i class="bi bi-plus-circle me-2"></i>
            Create New Link
        </button>
    </div>
</div>

<!-- Search and Filter -->
<div class="row mb-4">
    <div class="col-md-8">
        <div class="input-group">
            <span class="input-group-text bg-white">
                <i class="bi bi-search"></i>
            </span>
            <input type="text" class="form-control border-start-0" placeholder="Search links...">
        </div>
    </div>
    <div class="col-md-4">
        <select class="form-select">
            <option selected>All Links</option>
            <option value="1">Active</option>
            <option value="2">Inactive</option>
        </select>
    </div>
</div>

<!-- Links List -->
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0 ps-4">Short Link</th>
                                <th class="border-0">Original URL</th>
                                <th class="border-0">Clicks</th>
                                <th class="border-0">Created</th>
                                <th class="border-0">Status</th>
                                <th class="border-0 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="bi bi-link-45deg fs-1 d-block mb-3"></i>
                                        <h5>Belum ada link</h5>
                                        <p>Mulai dengan membuat link shortener pertama Anda</p>
                                        <button class="btn btn-danger mt-3" data-bs-toggle="modal" data-bs-target="#createLinkModal">
                                            <i class="bi bi-plus-circle me-2"></i>
                                            Create First Link
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Create Link Modal -->
<div class="modal fade" id="createLinkModal" tabindex="-1" aria-labelledby="createLinkModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="createLinkModalLabel">
                    <i class="bi bi-link-45deg me-2"></i>
                    Create New Short Link
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="originalUrl" class="form-label">Original URL</label>
                        <input type="url" class="form-control" id="originalUrl" placeholder="https://example.com/very-long-url">
                    </div>
                    <div class="mb-3">
                        <label for="customAlias" class="form-label">Custom Alias (Optional)</label>
                        <div class="input-group">
                            <span class="input-group-text">s.id/</span>
                            <input type="text" class="form-control" id="customAlias" placeholder="my-link">
                        </div>
                        <small class="text-muted">Leave empty for random alias</small>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Title (Optional)</label>
                        <input type="text" class="form-control" id="title" placeholder="My Link">
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger">
                    <i class="bi bi-check-circle me-2"></i>
                    Create Link
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
