<div class="modal fade" id="userShowModal" tabindex="-1" aria-labelledby="userShowModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-3">
            <div class="modal-header bg-success text-white rounded-top-3">
                <h5 class="modal-title fw-bold" id="userShowModalLabel">
                    <i class="bi bi-person-circle me-2"></i> Detail User
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <img id="show-profile-picture"
                        class="rounded-circle border border-2 border-light shadow"
                        src="{{ asset('static/img/no_image_placeholder.png') }}"
                        alt="User Profile Picture"
                        style="width: 200px; height: 200px; object-fit: cover;">
                    <h5 id="show-name" class="mt-3 mb-0 fw-semibold text-dark">-</h5>
                    <small id="show-email" class="text-muted">-</small>
                </div>
                <div class="list-group list-group-flush">
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="fw-semibold"><i class="bi bi-calendar-event me-2 text-success"></i>Created At</span>
                        <span id="show-created-at" class="text-muted">-</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="fw-semibold"><i class="bi bi-clock-history me-2 text-success"></i>Updated At</span>
                        <span id="show-updated-at" class="text-muted">-</span>
                    </div>
                </div>
                <div id="user-detail-loading" class="text-center d-none mt-4">
                    <div class="spinner-border text-success" role="status"></div>
                    <p class="mt-2">Loading user detail...</p>
                </div>
                <div id="user-detail-error" class="alert alert-danger d-none mt-3">
                    Gagal memuat detail user.
                </div>
            </div>
        </div>
    </div>
</div>
