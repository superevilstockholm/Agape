@extends('layouts.Dashboard')
@section('title', 'Dashboard - Users')
@section('content')
    <div class="row mb-3 justify-content-md-between align-items-md-center">
        <div class="col-md-6 col-12">
            <h3 class="page-title mb-2 mb-md-1 fw-semibold">Users Data</h3>
            <ul class="breadcrumb mb-2 mb-md-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Users</li>
            </ul>
        </div>
        <div class="col-lg-2 col-md-3 col-12">
            <div class="d-grid">
                <button class="btn btn-success h-100" data-bs-toggle="modal" data-bs-target="#userCreateModal">
                    Create</button>
            </div>
        </div>
    </div>
    <div class="row filter-row">
        <div class="col-sm-6 col-md-5">
            <div class="form-group form-focus">
                <input class="form-control floating" type="text" id="searchInput">
                <label class="focus-label">Search</label>
            </div>
        </div>
        <div class="col-sm-6 col-md-5">
            <div class="form-group form-focus select-focus">
                <select id="filterType" class="select floating">
                    <option value="name">Name</option>
                    <option value="email">Email</option>
                </select>
                <label class="focus-label">Filter</label>
            </div>
        </div>
        <div class="col-sm-12 col-md-2">
            <div class="d-grid">
                <button id="searchButton" class="btn btn-success h-100"> Search</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-12">
            <div class="form-group form-focus select-focus">
                <select id="limit" class="select floating">
                    <option value="10">10 data</option>
                    <option value="25">25 data</option>
                    <option value="50">50 data</option>
                    <option value="75">75 data</option>
                    <option value="100">100 data</option>
                    <option value="all">All</option>
                </select>
                <label for="limit" class="focus-label">Show</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped custom-table mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Profile Picture</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="users">
                        <tr>
                            <td colspan="7" class="text-center">Loading...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <nav>
                <ul class="pagination justify-content-center mt-3" id="pagination"></ul>
            </nav>
        </div>
    </div>
    {{-- Modal Show User --}}
    @include('components.users.show')
    {{-- Modal Create User --}}
    @include('components.users.create')
    {{-- Modal Edit User --}}
    @include('components.users.edit')
    <script>
        $(document).ready(function() {
            const tbody = $('#users');
            const pagination = $('#pagination');
            const limitSelect = $('#limit');
            let currentPage = 1;
            let currentLimit = limitSelect.val();
            function renderPagination(current, last) {
                const delta = 2;
                let range = [],
                    pages = [],
                    l;
                for (let i = 1; i <= last; i++) {
                    if (i === 1 || i === last || (i >= current - delta && i <= current + delta)) {
                        range.push(i);
                    }
                }
                for (let i of range) {
                    if (l) {
                        if (i - l === 2) pages.push(l + 1);
                        else if (i - l !== 1) pages.push('...');
                    }
                    pages.push(i);
                    l = i;
                }
                let html = `<li class="page-item ${current === 1 ? 'disabled' : ''}">
                    <a class="page-link" href="#" data-page="${current-1}">Previous</a>
                </li>`;
                for (let p of pages) {
                    if (p === '...') html += `<li class="page-item disabled"><span class="page-link">…</span></li>`;
                    else html += `<li class="page-item ${p === current ? 'active' : ''}">
                        <a class="page-link" href="#" data-page="${p}">${p}</a>
                     </li>`;
                }
                html += `<li class="page-item ${current === last ? 'disabled' : ''}">
                <a class="page-link" href="#" data-page="${current+1}">Next</a>
             </li>`;
                return html;
            }
            async function loadUsers(page = 1, limit = 10) {
                tbody.html('<tr><td colspan="7" class="text-center">Loading...</td></tr>');
                pagination.html('');
                const search = $('#searchInput').val();
                const type = $('#filterType').val().toLowerCase();
                try {
                    let url =
                        `/api/master-data/users?limit=${limit}&type=${type}&search=${encodeURIComponent(search)}`;
                    if (limit !== 'all') url += `&page=${page}`;
                    const res = await axios.get(url, {
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': `Bearer ${getCookie('auth_token')}`
                        }
                    });
                    let data = res.data.data;
                    let totalItems = (limit !== 'all') ? data.total : data.length;
                    if (limit !== 'all') data = data.data;
                    if (!data.length) {
                        tbody.html('<tr><td colspan="7" class="text-center">Tidak ada user</td></tr>');
                        return;
                    }
                    const startIndex = (limit === 'all') ? 1 : (page - 1) * parseInt(limit) + 1;
                    tbody.html(data.map((item, idx) => `
                    <tr style="height: 100px;">
                        <td>${startIndex + idx}</td>
                        <td class="p-0 m-0">
                            <img style="width: 80px; height: 80px; object-position: center;" src="${item.url_profile_picture ?? '{{ asset('static/img/no_image_placeholder.png') }}'}" class="object-fit-cover" alt="${item.name} profile picture">
                        </td>
                        <td>${item.name}</td>
                        <td>${item.email}</td>
                        <td>${new Date(item.created_at).toLocaleDateString()}</td>
                        <td>${new Date(item.updated_at).toLocaleDateString()}</td>
                        <td>
                            <button class="btn btn-sm btn-info show-users text-white" data-id="${item.id}" data-bs-toggle="modal" data-bs-target="#userShowModal">Detail</button>
                            <button class="btn btn-sm btn-warning edit-users text-white" data-id="${item.id}" data-bs-toggle="modal" data-bs-target="#userEditModal">Edit</button>
                            <button class="btn btn-sm btn-danger text-white delete-users" data-id="${item.id}">Delete</button>
                        </td>
                    </tr>
                `).join(''));
                    if (limit !== 'all') {
                        const lastPage = res.data.data.last_page;
                        pagination.html(renderPagination(page, lastPage));
                        $('#pagination a.page-link').off('click').on('click', function(e) {
                            e.preventDefault();
                            const newPage = parseInt($(this).data('page'));
                            if (newPage > 0 && newPage <= lastPage) {
                                currentPage = newPage;
                                loadUsers(currentPage, currentLimit);
                            }
                        });
                    }
                } catch (err) {
                    tbody.html(
                        '<tr><td colspan="7" class="text-center text-danger">Gagal memuat data</td></tr>');
                    console.error(err);
                }
            }
            $('#searchButton').on('click', function(e) {
                e.preventDefault();
                currentPage = 1;
                loadUsers(currentPage, currentLimit);
            });
            loadUsers(currentPage, currentLimit);
            $('#limit').on('change', function() {
                currentLimit = this.value;
                currentPage = 1;
                loadUsers(currentPage, currentLimit);
            });
            // Show
            $(document).on('click', '.show-users', async function () {
                const id = $(this).data('id');
                $('#user-detail-content').addClass('d-none');
                $('#user-detail-error').addClass('d-none');
                $('#user-detail-loading').removeClass('d-none');
                try {
                    const res = await axios.get(`/api/master-data/users/${id}`, {
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': `Bearer ${getCookie('auth_token')}`
                        }
                    });
                    const user = res.data.data;
                    $('#show-profile-picture').attr(
                        'src',
                        user.url_profile_picture ?? "{{ asset('static/img/no_image_placeholder.png') }}"
                    );
                    $('#show-name').text(user.name ?? '-');
                    $('#show-email').text(user.email ?? '-');
                    $('#show-created-at').text(new Date(user.created_at).toLocaleString());
                    $('#show-updated-at').text(new Date(user.updated_at).toLocaleString());
                    $('#user-detail-loading').addClass('d-none');
                    $('#user-detail-content').removeClass('d-none');
                } catch (err) {
                    console.error(err);
                    $('#user-detail-loading').addClass('d-none');
                    $('#user-detail-error').removeClass('d-none');
                }
            });
            // Create
            $('#profile-picture').on('change', function (e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        $('#profile-picture-preview').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(file);
                } else {
                    $('#profile-picture-preview').attr('src', "{{ asset('static/img/no_image_placeholder.png') }}");
                }
            });
            $('#createUserForm').on('submit', async function (e) {
                e.preventDefault();
                try {
                    let form = $(this)[0];
                    let formData = new FormData(form);
                    await axios.post('/api/master-data/users', formData, {
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': 'Bearer ' + getCookie('auth_token'),
                            'Content-Type': 'multipart/form-data'
                        }
                    });
                    Swal.fire({
                        icon: 'success',
                        title: 'User Created!',
                        text: 'User berhasil ditambahkan.',
                        timer: 1500,
                        showConfirmButton: false
                    });
                    $('#createUserForm')[0].reset();
                    $('#profile-picture-preview').attr('src', "{{ asset('static/img/no_image_placeholder.png') }}");
                    $('#userCreateModal').modal('hide');
                    await loadUsers(currentPage, currentLimit);
                } catch (err) {
                    console.error(err);
                    let message = 'Terjadi kesalahan.';
                    if (err.response && err.response.data && err.response.data.message) {
                        message = err.response.data.message;
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: message
                    });
                }
            });
            // Edit
            $(document).on('click', '.edit-users', async function () {
                const id = $(this).data('id');
                try {
                    const res = await axios.get(`/api/master-data/users/${id}`, {
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': `Bearer ${getCookie('auth_token')}`
                        }
                    });
                    const user = res.data.data;
                    $('#edit-user-id').val(user.id);
                    $('#edit-name').val(user.name);
                    $('#edit-email').val(user.email);
                    $('#edit-password').val('');
                    $('#edit-profile-picture-preview').attr('src', user.url_profile_picture ?? "{{ asset('static/img/no_image_placeholder.png') }}");
                    $('#userEditModal').modal('show');
                } catch (err) {
                    console.error(err);
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Tidak dapat memuat data user.'
                    });
                }
            });
            $('#edit-profile-picture').on('change', function (e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        $('#edit-profile-picture-preview').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            });
            $('#editUserForm').on('submit', async function (e) {
                e.preventDefault();
                const id = $('#edit-user-id').val();
                let formData = new FormData(this);
                try {
                    await axios.post(`/api/master-data/users/${id}?_method=PUT`, formData, {
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': 'Bearer ' + getCookie('auth_token'),
                            'Content-Type': 'multipart/form-data'
                        }
                    });
                    Swal.fire({
                        icon: 'success',
                        title: 'User Updated!',
                        text: 'User berhasil diperbarui.',
                        timer: 1500,
                        showConfirmButton: false
                    });
                    $('#userEditModal').modal('hide');
                    loadUsers(currentPage, currentLimit);
                } catch (err) {
                    let message = 'Terjadi kesalahan.';
                    if (err.response?.data?.message) {
                        message = err.response.data.message;
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: message
                    });
                }
            });
            // Delete
            $(document).on('click', '.delete-users', async function () {
                const id = $(this).data('id');
                const result = await Swal.fire({
                    title: 'Apakah kamu yakin?',
                    text: "User akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                });
                if (result.isConfirmed) {
                    try {
                        await axios.delete(`/api/master-data/users/${id}`, {
                            headers: {
                                'Accept': 'application/json',
                                'Authorization': `Bearer ${getCookie('auth_token')}`
                            }
                        });
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'User berhasil dihapus.',
                            timer: 1500,
                            showConfirmButton: false
                        });
                        await loadUsers(currentPage, currentLimit);
                    } catch (err) {
                        console.error(err);
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan saat menghapus user.'
                        });
                    }
                }
            });
        });
    </script>
    <style>
        .pagination .page-item.active .page-link {
            background-color: #699834;
            border-color: #699834;
            color: #fff;
        }
    </style>
@endsection
