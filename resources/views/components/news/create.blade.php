<div class="modal fade" id="newsCreateModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="newsCreateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow-sm border-0 rounded-3">
            <div class="modal-header bg-success text-white rounded-top-3">
                <h5 class="modal-title fw-bold" id="newsCreateModalLabel">Create News</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="createNewsForm">
                    <div class="mb-3">
                        <label for="news-image" class="form-label">Image</label>
                        <div class="position-relative d-inline-block w-100" style="height: 300px;">
                            <img id="news-image-preview" src="{{ asset('static/img/no_image_placeholder.png') }}"
                                alt="Preview" class="w-100 h-100 object-fit-cover rounded shadow-sm border">
                            <input type="file" id="news-image" name="image" accept="image/*"
                                class="position-absolute top-0 start-0 w-100 h-100 opacity-0 cursor-pointer"
                                style="cursor: pointer;" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="news-title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="news-user" class="form-label">Author</label>
                        <select id="news-user" name="user_id" class="form-select" required>
                            <option value="">-- Select Author --</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea id="news-content-editor" name="news-content"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>
