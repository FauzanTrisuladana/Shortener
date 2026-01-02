<div class="alert-success">
    <div class="d-flex align-items-center justify-content-between mb-2">
        <strong><i class="bi bi-check-circle me-2"></i>URL berhasil diperpendek!</strong>
    </div>
    <div class="short-url-result">
        <a href="{{ $url }}" target="_blank">{{ $url }}</a>
        <button class="btn-copy" onclick="copyToClipboard('{{ $url }}')">
            <i class="bi bi-clipboard"></i> Copy
        </button>
    </div>
</div>
