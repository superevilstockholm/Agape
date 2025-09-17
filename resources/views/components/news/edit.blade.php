<div class="modal fade" id="newsEditModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="newsEditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow-sm border-0 rounded-3">
            <div class="modal-header bg-success text-white rounded-top-3">
                <h5 class="modal-title fw-bold" id="newsEditModalLabel">Edit News</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="editNewsForm">
                    <input type="hidden" id="edit-news-id">
                    <div class="mb-3">
                        <label for="edit-news-image" class="form-label">Image</label>
                        <div class="position-relative d-inline-block w-100" style="height: 300px;">
                            <img id="edit-news-image-preview" src="{{ asset('static/img/no_image_placeholder.png') }}"
                                alt="Preview" class="w-100 h-100 object-fit-cover rounded shadow-sm border">
                            <input type="file" id="edit-news-image" name="image" accept="image/*"
                                class="position-absolute top-0 start-0 w-100 h-100 opacity-0 cursor-pointer">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="edit-news-title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="edit-news-title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-news-user" class="form-label">Author</label>
                        <select id="edit-news-user" name="user_id" class="form-select" required>
                            <option value="">-- Select Author --</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit-news-content" class="form-label">Content</label>
                        <textarea id="edit-news-content-editor" name="content"></textarea>
                    </div>
                    <button type="submit" class="btn btn-warning text-white">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
