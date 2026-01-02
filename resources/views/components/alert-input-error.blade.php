@if ($errors->has($field))
    <small class="d-block text-danger mt-1" style="font-size: 0.85rem;">
        <i class="bi bi-exclamation-circle me-1"></i>
        {{ $errors->first($field) }}
    </small>
@endif
