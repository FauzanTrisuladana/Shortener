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
            <span class="input-group-text">
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
                                <th class="border-0">Name</th>
                                <th class="border-0">Original URL</th>
                                <th class="border-0">Clicks</th>
                                <th class="border-0">Created</th>
                                <th class="border-0">Status</th>
                                <th class="border-0 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="ps-4">
                                    <a href="#" class="text-decoration-none fw-semibold">link.trisuladana.com/promo-special</a>
                                </td>
                                <td>
                                    <span class="fw-semibold">Promo Special Campaign</span>
                                </td>
                                <td>
                                    <span class="text-muted small">https://example.com/very-long-url-here/promo...</span>
                                </td>
                                <td><strong>3,245</strong></td>
                                <td><small class="text-muted">15 Des 2025</small></td>
                                <td><span class="badge bg-success">Active</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-secondary me-1" title="Edit" data-bs-toggle="modal" data-bs-target="#editLinkModal" onclick="editLink(1, 'promo-special', 'Promo Special Campaign', 'https://example.com/very-long-url-here/promo-special')">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <a href="{{ route('link.analytics', 1) }}" class="btn btn-sm btn-outline-primary me-1" title="Analytics">
                                        <i class="bi bi-bar-chart"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="ps-4">
                                    <a href="#" class="text-decoration-none fw-semibold">link.trisuladana.com/campaign-2024</a>
                                </td>
                                <td>
                                    <span class="fw-semibold">Year End Campaign</span>
                                </td>
                                <td>
                                    <span class="text-muted small">https://marketing.site/campaign-end-year-2024...</span>
                                </td>
                                <td><strong>2,891</strong></td>
                                <td><small class="text-muted">12 Des 2025</small></td>
                                <td><span class="badge bg-success">Active</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-secondary me-1" title="Edit" data-bs-toggle="modal" data-bs-target="#editLinkModal" onclick="editLink(2, 'campaign-2024', 'Year End Campaign', 'https://marketing.site/campaign-end-year-2024')">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <a href="{{ route('link.analytics', 2) }}" class="btn btn-sm btn-outline-primary me-1" title="Analytics">
                                        <i class="bi bi-bar-chart"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="ps-4">
                                    <a href="#" class="text-decoration-none fw-semibold">link.trisuladana.com/webinar-tech</a>
                                </td>
                                <td>
                                    <span class="fw-semibold">Tech Webinar 2024</span>
                                </td>
                                <td>
                                    <span class="text-muted small">https://events.com/webinar-tech-summit-2024...</span>
                                </td>
                                <td><strong>2,456</strong></td>
                                <td><small class="text-muted">10 Des 2025</small></td>
                                <td><span class="badge bg-success">Active</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-secondary me-1" title="Edit" data-bs-toggle="modal" data-bs-target="#editLinkModal" onclick="editLink(3, 'webinar-tech', 'Tech Webinar 2024', 'https://events.com/webinar-tech-summit-2024')">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <a href="{{ route('link.analytics', 3) }}" class="btn btn-sm btn-outline-primary me-1" title="Analytics">
                                        <i class="bi bi-bar-chart"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="ps-4">
                                    <a href="#" class="text-decoration-none fw-semibold">link.trisuladana.com/product-launch</a>
                                </td>
                                <td>
                                    <span class="fw-semibold">Product Launch Dec</span>
                                </td>
                                <td>
                                    <span class="text-muted small">https://shop.com/new-product-launch-december...</span>
                                </td>
                                <td><strong>1,987</strong></td>
                                <td><small class="text-muted">8 Des 2025</small></td>
                                <td><span class="badge bg-success">Active</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-secondary me-1" title="Edit" data-bs-toggle="modal" data-bs-target="#editLinkModal" onclick="editLink(4, 'product-launch', 'Product Launch Dec', 'https://shop.com/new-product-launch-december')">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <a href="{{ route('link.analytics', 4) }}" class="btn btn-sm btn-outline-primary me-1" title="Analytics">
                                        <i class="bi bi-bar-chart"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="ps-4">
                                    <a href="#" class="text-decoration-none fw-semibold">link.trisuladana.com/portfolio</a>
                                </td>
                                <td>
                                    <span class="fw-semibold">Portfolio Showcase</span>
                                </td>
                                <td>
                                    <span class="text-muted small">https://portfolio.design/showcase-works-2024...</span>
                                </td>
                                <td><strong>1,268</strong></td>
                                <td><small class="text-muted">5 Des 2025</small></td>
                                <td><span class="badge bg-success">Active</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-secondary me-1" title="Edit" data-bs-toggle="modal" data-bs-target="#editLinkModal" onclick="editLink(5, 'portfolio', 'Portfolio Showcase', 'https://portfolio.design/showcase-works-2024')">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <a href="{{ route('link.analytics', 5) }}" class="btn btn-sm btn-outline-primary me-1" title="Analytics">
                                        <i class="bi bi-bar-chart"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="ps-4">
                                    <a href="#" class="text-decoration-none fw-semibold">link.trisuladana.com/discount-week</a>
                                </td>
                                <td>
                                    <span class="fw-semibold">Discount Week Special</span>
                                </td>
                                <td>
                                    <span class="text-muted small">https://store.online/discount-week-special...</span>
                                </td>
                                <td><strong>892</strong></td>
                                <td><small class="text-muted">2 Des 2025</small></td>
                                <td><span class="badge bg-warning text-dark">Inactive</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-secondary me-1" title="Edit" data-bs-toggle="modal" data-bs-target="#editLinkModal" onclick="editLink(6, 'discount-week', 'Discount Week Special', 'https://store.online/discount-week-special')">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <a href="{{ route('link.analytics', 6) }}" class="btn btn-sm btn-outline-primary me-1" title="Analytics">
                                        <i class="bi bi-bar-chart"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
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
                        <label for="linkName" class="form-label">Link Name</label>
                        <input type="text" class="form-control" id="linkName" placeholder="My Campaign">
                    </div>
                    <div class="mb-3">
                        <label for="customAlias" class="form-label">Custom Alias (Optional)</label>
                        <div class="input-group">
                            <span class="input-group-text">link.trisuladana.com/</span>
                            <input type="text" class="form-control" id="customAlias" placeholder="my-link">
                        </div>
                        <small class="text-muted">Leave empty for random alias</small>
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
                <form id="editLinkForm">
                    <input type="hidden" id="editLinkId">
                    <div class="mb-3">
                        <label for="editOriginalUrl" class="form-label">Original URL</label>
                        <input type="url" class="form-control" id="editOriginalUrl" placeholder="https://example.com/very-long-url">
                    </div>
                    <div class="mb-3">
                        <label for="editLinkName" class="form-label">Link Name</label>
                        <input type="text" class="form-control" id="editLinkName" placeholder="My Campaign">
                    </div>
                    <div class="mb-3">
                        <label for="editCustomAlias" class="form-label">Custom Alias</label>
                        <div class="input-group">
                            <span class="input-group-text">link.trisuladana.com/</span>
                            <input type="text" class="form-control" id="editCustomAlias" placeholder="my-link">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="editLinkStatus" checked>
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

<script>
function editLink(id, slug, name, url) {
    document.getElementById('editLinkId').value = id;
    document.getElementById('editCustomAlias').value = slug;
    document.getElementById('editLinkName').value = name;
    document.getElementById('editOriginalUrl').value = url;
}
</script>
@endsection
