<!-- Upload Photo Modal -->
<div class="modal fade" id="uploadPhotoModal" tabindex="-1" aria-labelledby="uploadPhotoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="uploadPhotoModalLabel">
                    <i class="bi bi-camera me-2"></i>
                    Ubah Foto Profil
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="uploadPhotoForm" method="POST" action="{{ route('profile.upload-photo') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="profilePhoto" class="form-label">Pilih Foto</label>
                        <input type="file" class="form-control @error('profile_image') is-invalid @enderror" id="profilePhoto" name="profile_image" accept="image/*" required>
                        <small class="text-muted d-block mt-2">Format: JPG, PNG, GIF (Maksimal 2MB)</small>
                        <x-alert-input-error field="profile_image" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Preview</label>
                        <div class="text-center" id="photoPreview">
                            <p class="text-muted">Pilih foto untuk melihat preview</p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="uploadPhotoForm" class="btn btn-danger">
                    <i class="bi bi-cloud-upload me-2"></i>
                    Upload Foto
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const profilePhotoInput = document.getElementById('profilePhoto');
        const photoPreview = document.getElementById('photoPreview');

        profilePhotoInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    photoPreview.innerHTML = `<img src="${e.target.result}" alt="Preview" class="rounded" style="max-width: 200px; max-height: 200px; object-fit: cover;">`;
                };
                reader.readAsDataURL(file);
            }
        });

        // Reset preview when modal is closed
        const modal = document.getElementById('uploadPhotoModal');
        if (modal) {
            modal.addEventListener('hidden.bs.modal', function() {
                profilePhotoInput.value = '';
                photoPreview.innerHTML = '<p class="text-muted">Pilih foto untuk melihat preview</p>';
            });
        }
    });
</script>
