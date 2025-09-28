<div class="modal fade" id="userCreateModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="userCreateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow-sm border-0 rounded-3">
            <div class="modal-header border-bottom-0 bg-success text-white rounded-top-3">
                <h5 class="modal-title fw-bold" id="userCreateModalLabel">Create User</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="createUserForm" enctype="multipart/form-data">
                    <div class="mb-4 text-center">
                        <div class="position-relative d-inline-block" style="width:200px; height:200px;">
                            <img id="profile-picture-preview"
                                src="{{ asset('static/img/no_image_placeholder.png') }}"
                                alt="Preview"
                                class="rounded-circle border shadow-sm object-fit-cover"
                                style="width:200px; height:200px; object-position:center;">
                            <input type="file" id="profile-picture" name="profile_picture" accept="image/*"
                                class="position-absolute top-0 start-0 w-100 h-100 opacity-0"
                                style="cursor:pointer; border-radius:50%;">
                        </div>
                        <p class="mt-2 text-muted small">Click image to upload</p>
                    </div>
                    <div class="mb-3">
                        <label for="user-name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="user-name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="user-email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="user-email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="user-password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="user-password" name="password" required minlength="8" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>
