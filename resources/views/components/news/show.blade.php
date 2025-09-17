<div class="modal fade" id="newsShowModal" tabindex="-1" aria-labelledby="newsShowModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow-sm border-0 rounded-3">
            <div class="modal-header bg-success text-white rounded-top-3">
                <h5 class="modal-title fw-bold" id="newsShowModalLabel">Loading...</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="text-center mb-3">
                    <img id="newsImage" src="{{ asset('static/img/no_image_placeholder.png') }}" alt="News Image"
                        class="img-fluid w-100 object-fit-cover rounded shadow-sm"
                        style="max-height:300px; object-position: center;">
                </div>
                <div class="mb-3">
                    <span class="badge bg-primary me-2" id="newsAuthor"></span>
                    <span class="badge bg-secondary" id="newsCreatedAt"></span>
                    <span class="badge bg-secondary" id="newsUpdatedAt"></span>
                </div>
                <hr>
                <div id="newsContent" class="fs-6 text-muted"></div>
            </div>
        </div>
    </div>
</div>
