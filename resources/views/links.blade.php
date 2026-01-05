@extends('layouts.app')

@section('title', 'Links')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h1 class="h2 mb-3">Link Saya</h1>
        <p class="text-muted">Kelola semua link shortener Anda</p>
    </div>
    <div class="col-md-4 text-md-end">
        <button class="btn btn-danger btn-lg" data-bs-toggle="modal" data-bs-target="#createLinkModal">
            <i class="bi bi-plus-circle me-2"></i>
            Buat Link Baru
        </button>
    </div>
</div>

<!-- Search and Filter -->
<form method="GET" action="{{ route('links') }}" id="filterForm" class="row mb-4">
    <div class="col-md-8">
        <div class="input-group">
            <span class="input-group-text">
                <i class="bi bi-search"></i>
            </span>
            <input
                type="text"
                class="form-control border-start-0"
                name="search"
                id="searchInput"
                placeholder="Search by name, alias, or URL..."
                value="{{ request('search') }}">
            @if(request('search'))
                <a href="{{ route('links') }}" class="btn btn-outline-secondary" title="Clear search">
                    <i class="bi bi-x"></i>
                </a>
            @endif
        </div>
    </div>
    <div class="col-md-4">
        <select class="form-select" name="status" id="statusFilter">
            <option value="all" @if(!request('status') || request('status') === 'all') selected @endif>Semua Link</option>
            <option value="active" @if(request('status') === 'active') selected @endif>Aktif</option>
            <option value="inactive" @if(request('status') === 'inactive') selected @endif>Tidak Aktif</option>
        </select>
    </div>
</form>

{{-- Success Alert --}}
@if(session('success'))
    <x-alert-success :message="session('success')" />
@endif

{{-- Error Alert --}}
@if($errors->has('delete'))
    <x-alert-error :message="$errors->first('delete')" />
@endif

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
                                <th class="border-0">Nama</th>
                                <th class="border-0">URL Asli</th>
                                <th class="border-0">Klik</th>
                                <th class="border-0">Dibuat</th>
                                <th class="border-0">Status</th>
                                <th class="border-0 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($links as $link)
                            <tr>
                                <td class="ps-4">
                                    <a href="{{ url($link->new_link) }}" class="text-decoration-none fw-semibold" target="_blank">{{ url($link->new_link) }}</a>
                                </td>
                                <td>
                                    <span class="fw-semibold">{{ $link->name }}</span>
                                </td>
                                <td>
                                    <span class="text-muted small" title="{{ $link->true_link }}">{{ Str::limit($link->true_link, 50) }}</span>
                                </td>
                                <td><strong>{{ $link->visitors->count() }}</strong></td>
                                <td><small class="text-muted">{{ $link->created_at->format('d M Y') }}</small></td>
                                <td>
                                    @if($link->is_active)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-secondary m-1" title="Edit" data-bs-toggle="modal" data-bs-target="#editLinkModal{{ $link->id_link }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <a href="{{ route('links.analytics', $link->id_link) }}" class="btn btn-sm btn-outline-primary m-1" title="Analytics">
                                        <i class="bi bi-bar-chart"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger m-1" title="Delete" data-bs-toggle="modal" data-bs-target="#deleteLinkModal" data-link-id="{{ $link->id_link }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
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

<!-- Create Link Modal -->
<div class="modal fade" id="createLinkModal" tabindex="-1" aria-labelledby="createLinkModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="createLinkModalLabel">
                    <i class="bi bi-link-45deg me-2"></i>
                    Buat Link Baru
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createLinkForm" method="POST" action="{{ route('links.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="originalUrl" class="form-label">Original URL</label>
                        <input
                            type="url"
                            class="form-control"
                            id="originalUrl"
                            name="target_url"
                            placeholder="https://example.com/very-long-url"
                            value="{{ old('target_url') }}"
                            required>
                        <x-alert-input-error field="target_url" errorBag="new" />
                    </div>
                    <div class="mb-3">
                        <label for="linkName" class="form-label">Nama Link</label>
                        <input
                            type="text"
                            class="form-control"
                            id="linkName"
                            name="name"
                            placeholder="My Campaign"
                            value="{{ old('name') }}"
                            required>
                        <x-alert-input-error field="name" errorBag="new" />
                    </div>
                    <div class="mb-3">
                        <label for="customAlias" class="form-label">Alias Kustom (Opsional)</label>
                        <div class="input-group">
                            <span class="input-group-text">{{ rtrim(config('app.url'), '/') . '/' }}</span>
                            <input
                                type="text"
                                class="form-control"
                                id="customAlias"
                                name="custom_alias"
                                placeholder="my-link"
                                value="{{ old('custom_alias') }}"
                                required>
                        </div>
                        <x-alert-input-error field="custom_alias" errorBag="new" />
                        <small class="text-muted">Kosongkan untuk alias acak</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <div class="form-check form-switch">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                id="createLinkStatus"
                                name="is_active"
                                value="1"
                                {{ $errors->hasBag('new') ? old('is_active') ? 'checked' : '' : 'checked' }}>
                            <label class="form-check-label" for="createLinkStatus">
                                Aktif
                            </label>
                        </div>
                        <x-alert-input-error field="is_active" errorBag="new" />
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="createLinkForm" class="btn btn-danger">
                    <i class="bi bi-check-circle me-2"></i>
                    Buat Link
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Link Modal -->
@foreach ($links as $link)
<div class="modal fade" id="editLinkModal{{ $link->id_link }}" tabindex="-1" aria-labelledby="editLinkModalLabel{{ $link->id_link }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="editLinkModalLabel{{ $link->id_link }}">
                    <i class="bi bi-pencil me-2"></i>
                    Edit Link
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editLinkForm{{ $link->id_link }}" method="POST" action="{{ route('links.update', ['id' => $link->id_link]) }}">
                    @csrf
                    @method('POST')
                    <div class="mb-3">
                        <label for="editOriginalUrl{{ $link->id_link }}" class="form-label">Original URL</label>
                        <input
                            type="url"
                            class="form-control"
                            id="editOriginalUrl{{ $link->id_link }}"
                            name="target_url"
                            value="{{ $link->true_link }}"
                            placeholder="https://example.com/very-long-url">
                        @if (session('id')==$link->id_link && $errors->edit->has('target_url'))
                            <x-alert-input-error field="target_url" errorBag="edit" />
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="editLinkName{{ $link->id_link }}" class="form-label">Nama Link</label>
                        <input
                            type="text"
                            class="form-control"
                            id="editLinkName{{ $link->id_link }}"
                            name="name"
                            value="{{ $link->name }}"
                            placeholder="My Campaign">
                        @if (session('id')==$link->id_link && $errors->edit->has('name'))
                            <x-alert-input-error field="name" errorBag="edit" />
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="editCustomAlias{{ $link->id_link }}" class="form-label">Alias Kustom</label>
                        <div class="input-group">
                            <span class="input-group-text">{{ rtrim(config('app.url'), '/') . '/' }}</span>
                            <input
                                type="text"
                                class="form-control"
                                id="editCustomAlias{{ $link->id_link }}"
                                name="custom_alias"
                                value="{{ $link->new_link }}"
                                placeholder="my-link">
                        </div>
                        @if (session('id')==$link->id_link && $errors->edit->has('custom_alias'))
                            <x-alert-input-error field="custom_alias" errorBag="edit" />
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <div class="form-check form-switch">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                id="editLinkStatus{{ $link->id_link }}"
                                name="is_active"
                                value="1"
                                {{ $link->is_active ? 'checked' : '' }}>
                            <label class="form-check-label" for="editLinkStatus{{ $link->id_link }}">
                                Active
                            </label>
                        </div>
                        @if (session('id')==$link->id_link && $errors->edit->has('is_active'))
                            <x-alert-input-error field="is_active" errorBag="edit" />
                        @endif
                    </div>
                </form>
                @if (session('id')==$link->id_link && $errors->edit->has('form'))
                    <x-alert-error :message="$errors->edit->first('form')" />
                @endif
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="editLinkForm{{ $link->id_link }}" class="btn btn-danger">
                    <i class="bi bi-check-circle me-2"></i>
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </div>
</div>
@endforeach

<x-delete-account-modal
    :modalId="'deleteLinkModal'"
    :title="'Hapus Link Secara Permanen'"
    :message="'Tindakan ini tidak dapat dibatalkan. Link dan semua data analitik akan dihapus secara permanen.'"
    :formId="'deleteLinkForm'"
    :formAction="'#'"
    :buttonId="'deleteLinkBtn'"
    :buttonText="'Hapus Link Selamanya'"
    :checkboxId="'confirmDeleteLink'"
    :confirmText="'Saya mengerti dan ingin menghapus link ini secara permanen'"
    :requireConfirm="true"
    :method="'DELETE'"
/>

@push('scripts')
@vite('resources/js/links.js')
<script>
    // Auto-open modal if there are errors
    document.addEventListener('DOMContentLoaded', function() {
        @if($errors->hasBag('new') || isset($newopened))
            var createModal = new bootstrap.Modal(document.getElementById('createLinkModal'));
            createModal.show();
        @endif

        @if($errors->hasBag('edit') && session('id'))
            var editModalId = 'editLinkModal{{ session("id") }}';
            var editModalElement = document.getElementById(editModalId);
            if (editModalElement) {
                var editModal = new bootstrap.Modal(editModalElement);
                editModal.show();
            }
        @endif

        // Real-time filter on status change
        const statusFilter = document.getElementById('statusFilter');
        const searchInput = document.getElementById('searchInput');
        const filterForm = document.getElementById('filterForm');

        // Submit form on filter change
        if (statusFilter) {
            statusFilter.addEventListener('change', function() {
                filterForm.submit();
            });
        }

        // Real-time search with debounce
        let searchTimeout;
        if (searchInput) {
            searchInput.addEventListener('keyup', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    filterForm.submit();
                }, 500);
            });
        }

        // Handle delete link modal
        const deleteLinkModal = document.getElementById('deleteLinkModal');
        const deleteLinkForm = document.getElementById('deleteLinkForm');
        const deleteButtons = document.querySelectorAll('[data-bs-target="#deleteLinkModal"]');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const linkId = this.dataset.linkId;
                const formAction = "{{ route('links.destroy', ':ID') }}".replace(':ID', linkId);
                deleteLinkForm.action = formAction;
            });
        });

        // Reset delete link modal when closed
        if (deleteLinkModal) {
            deleteLinkModal.addEventListener('hidden.bs.modal', function() {
                const checkbox = document.getElementById('confirmDeleteLink');
                const btn = document.getElementById('deleteLinkBtn');
                if (checkbox) checkbox.checked = false;
                if (btn) btn.disabled = true;
            });
        }
    });
</script>
@endpush
@endsection
