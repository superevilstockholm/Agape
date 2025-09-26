<div class="modal fade" id="userEditModal" tabindex="-1" aria-labelledby="userEditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow-sm border-0 rounded-3">
            <div class="modal-header border-bottom-0 bg-success text-white rounded-top-3">
                <h5 class="modal-title fw-bold" id="userEditModalLabel">Edit User</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="editUserForm">
                    <input type="hidden" id="edit-user-id" name="id">
                    <div class="d-flex justify-content-center mb-3">
                        <div class="position-relative" style="width:200px; height:200px;">
                            <img id="edit-profile-picture-preview"
                                src="{{ asset('static/img/no_image_placeholder.png') }}" alt="Preview"
                                class="rounded-circle border shadow-sm w-100 h-100 object-fit-cover">
                            <input type="file" id="edit-profile-picture" name="profile_picture" accept="image/*"
                                class="position-absolute top-0 start-0 w-100 h-100 opacity-0 cursor-pointer">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="edit-name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="edit-name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="edit-email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-password" class="form-label">Password (optional)</label>
                        <input type="password" class="form-control" id="edit-password" name="password"
                            placeholder="Leave blank if unchanged">
                    </div>
                    <button type="submit" class="btn btn-success w-100">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
