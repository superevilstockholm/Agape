@extends('layouts.Dashboard')
@section('title', 'Dashboard - News')
@section('content')
    <div class="row mb-3 justify-content-md-between align-items-md-center">
        <div class="col-md-6 col-12">
            <h3 class="page-title mb-2 mb-md-1 fw-semibold">News Data</h3>
            <ul class="breadcrumb mb-2 mb-md-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">News</li>
            </ul>
        </div>
        <div class="col-lg-2 col-md-3 col-12">
            <div class="d-grid">
                <button class="btn btn-success h-100" data-bs-toggle="modal" data-bs-target="#newsCreateModal">
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
                    <option value="title">Title</option>
                    <option value="author">Author</option>
                    <option value="slug">Slug</option>
                    <option value="content">Content</option>
                </select>
                <label class="focus-label">Filter</label>
            </div>
        </div>
        <div class="col-sm-12 col-md-2">
            <div class="d-grid">
                <button id="searchButton" class="btn btn-success h-100">Search</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-12">
            <div class="form-group form-focus select-focus">
                <select id="limit" class="select floating">
                    <option value="10">10 items</option>
                    <option value="25">25 items</option>
                    <option value="50">50 items</option>
                    <option value="75">75 items</option>
                    <option value="100">100 items</option>
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
                            <th>Image</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="news">
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
    <!-- Modal Show News -->
    <x-news.show />
    <!-- Modal Create News -->
    <x-news.create />
    <!-- Modal Edit News -->
    <x-news.edit />
    <script>
        $(document).ready(function() {
            let editorInstance;
            ClassicEditor
                .create(document.querySelector('#news-content-editor'))
                .then(editor => editorInstance = editor);
            const newsImageInput = document.getElementById('news-image');
            const previewImage = document.getElementById('news-image-preview');
            const placeholderImage = "{{ asset('static/img/no_image_placeholder.png') }}";
            document.getElementById('newsCreateModal').addEventListener('hidden.bs.modal', function(e) {
                createNewsForm.reset();
                if (editorInstance) {
                    editorInstance.setData('');
                }
                previewImage.src = placeholderImage;
                previewImage.classList.remove('d-none');
                if (e.relatedTarget) {
                    e.relatedTarget.blur();
                }
                document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
                document.activeElement.blur();
            });
            // Index
            const tbody = $('#news');
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
            async function loadNews(page = 1, limit = 10) {
                tbody.html('<tr><td colspan="7" class="text-center">Loading...</td></tr>');
                pagination.html('');
                const search = $('#searchInput').val();
                const type = $('#filterType').val().toLowerCase();
                try {
                    let url =
                        `/api/master-data/news?limit=${limit}&type=${type}&search=${encodeURIComponent(search)}`;
                    if (limit !== 'all') url += `&page=${page}`;
                    const res = await axios.get(url, {
                        headers: {
                            'Accept': 'application/json'
                        }
                    });
                    let data = res.data.data;
                    let totalItems = (limit !== 'all') ? data.total : data.length;
                    if (limit !== 'all') data = data.data;
                    if (!data.length) {
                        tbody.html('<tr><td colspan="7" class="text-center">No news available</td></tr>');
                        return;
                    }
                    const startIndex = (limit === 'all') ? 1 : (page - 1) * parseInt(limit) + 1;
                    tbody.html(data.map((item, idx) => `
                    <tr style="height: 100px;">
                        <td>${startIndex + idx}</td>
                        <td class="p-0 m-0">
                            <img style="width: 80px; height: 80px; object-position: center;" src="${item.image_url ?? '{{ asset('static/img/no_image_placeholder.png') }}'}" class="object-fit-cover" alt="${item.title}">
                        </td>
                        <td>${item.title}</td>
                        <td>${item.user?.name}</td>
                        <td>${new Date(item.created_at).toLocaleDateString()}</td>
                        <td>${new Date(item.updated_at).toLocaleDateString()}</td>
                        <td>
                            <button class="btn btn-sm btn-info show-news text-white" data-id="${item.id}" data-bs-toggle="modal" data-bs-target="#newsShowModal">Detail</button>
                            <button class="btn btn-sm btn-warning text-white" data-id="${item.id}" data-bs-toggle="modal" data-bs-target="#newsEditModal">Edit</button>
                            <button class="btn btn-sm btn-danger text-white delete-news" data-id="${item.id}">Delete</button>
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
                                loadNews(currentPage, currentLimit);
                            }
                        });
                    }
                } catch (err) {
                    tbody.html(
                        '<tr><td colspan="7" class="text-center text-danger">Failed to display news list</td></tr>');
                    Swal.fire('Failed', err.response.data.message ?? 'Failed to display news list', 'error');
                }
            }
            $('#searchButton').on('click', function(e) {
                e.preventDefault();
                currentPage = 1;
                loadNews(currentPage, currentLimit);
            });
            loadNews(currentPage, currentLimit);
            $('#limit').on('change', function() {
                currentLimit = this.value;
                currentPage = 1;
                loadNews(currentPage, currentLimit);
            });
            // Show
            $(document).on('click', '.show-news', async function() {
                const id = $(this).data('id');
                $('#newsShowModalLabel').text('Loading...');
                $('#newsAuthor').text('');
                $('#newsCreatedAt').text('');
                $('#newsUpdatedAt').text('');
                $('#newsContent').html('<p class="text-center text-secondary">Loading content...</p>');
                $('#newsImage').attr('src', '{{ asset('static/img/no_image_placeholder.png') }}');
                try {
                    const res = await axios.get(`/api/master-data/news/${id}`, {
                        headers: {
                            'Accept': 'application/json'
                        }
                    });
                    const news = res.data.data;
                    $('#newsShowModalLabel').text(news.title);
                    $('#newsAuthor').text('Author: ' + (news.user?.name));
                    $('#newsCreatedAt').text('Created: ' + new Date(news.created_at)
                    .toLocaleDateString());
                    $('#newsUpdatedAt').text('Updated: ' + new Date(news.updated_at)
                    .toLocaleDateString());
                    $('#newsContent').html(marked.parse(news.content ?? ''));
                    $('#newsImage').attr('src', news.image_url ??
                        '{{ asset('static/img/no_image_placeholder.png') }}');
                } catch (err) {
                    $('#newsContent').html(
                        '<p class="text-danger text-center">Failed to display news details</p>');
                    Swal.fire('Failed', err.response.data.message ?? 'Failed to display news details', 'error');
                }
            });
            // Create
            async function loadUsers() {
                try {
                    const res = await axios.get('/api/master-data/users?limit=all', {
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': 'Bearer ' + getCookie('auth_token')
                        }
                    });
                    const select = document.getElementById('news-user');
                    select.innerHTML = '<option value="">-- Select Author --</option>';
                    if (res.data.status && res.data.data.length) {
                        res.data.data.forEach(user => {
                            const opt = document.createElement('option');
                            opt.value = user.id;
                            opt.textContent = user.name;
                            select.appendChild(opt);
                        });
                    }
                } catch (err) {
                    Swal.fire('Failed', err.response.data.message ?? 'Failed to load users', 'error');
                }
            }
            document.getElementById('newsCreateModal').addEventListener('shown.bs.modal', function() {
                document.getElementById('news-title').focus();
                loadUsers();
            });
            newsImageInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    previewImage.src = URL.createObjectURL(file);
                } else {
                    previewImage.src = placeholderImage;
                }
            });
            createNewsForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                try {
                    const formData = new FormData();
                    formData.append('title', document.getElementById('news-title').value);
                    formData.append('content', editorInstance.getData());
                    formData.append('image', newsImageInput.files[0]);
                    formData.append('user_id', document.getElementById('news-user').value);
                    const response = await axios.post('/api/master-data/news', formData, {
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': `Bearer ${getCookie('auth_token')}`
                        }
                    });
                    if (response.data.status === true) {
                        $('#newsCreateModal').modal('hide');
                        createNewsForm.reset();
                        editorInstance.setData('');
                        previewImage.src = placeholderImage;
                        loadNews(currentPage, currentLimit);
                        Swal.fire('Success', response.data.message ?? 'News created successfully!', 'success');
                    }
                } catch (error) {
                    Swal.fire('Failed', error.response.data.message ?? 'Failed to create news', 'error');
                }
            });
            $('.select.floating').select2({
                minimumResultsForSearch: -1,
                width: '100%'
            });
            // Edit
            let editEditorInstance;
            ClassicEditor
                .create(document.querySelector('#edit-news-content-editor'))
                .then(editor => editEditorInstance = editor);
            const editImageInput = document.getElementById('edit-news-image');
            const editPreviewImage = document.getElementById('edit-news-image-preview');
            const editPlaceholderImage = "{{ asset('static/img/no_image_placeholder.png') }}";
            document.getElementById('newsEditModal').addEventListener('hidden.bs.modal', function () {
                editNewsForm.reset();
                editPreviewImage.src = editPlaceholderImage;
                if (editEditorInstance) editEditorInstance.setData('');
            });
            editImageInput.addEventListener('change', function (e) {
                const file = e.target.files[0];
                if (file) {
                    editPreviewImage.src = URL.createObjectURL(file);
                } else {
                    editPreviewImage.src = editPlaceholderImage;
                }
            });
            $(document).on('click', 'table .btn-warning', async function () {
                const id = $(this).data('id');
                if (!id) return;
                try {
                    const res = await axios.get(`/api/master-data/news/${id}`, {
                        headers: { 'Accept': 'application/json' }
                    });
                    const news = res.data.data;
                    $('#edit-news-id').val(news.id);
                    $('#edit-news-title').val(news.title);
                    editEditorInstance.setData(news.content ?? '');
                    editPreviewImage.src = news.image_url ?? editPlaceholderImage;
                    await loadUsersEdit(news.user?.id);
                    $('#newsEditModal').modal('show');
                } catch (err) {
                    Swal.fire('Failed', err.response.data.message ?? 'Failed to load news data', 'error');
                }
            });
            async function loadUsersEdit(selectedId = null) {
                try {
                    const res = await axios.get('/api/master-data/users?limit=all', {
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': 'Bearer ' + getCookie('auth_token')
                        }
                    });
                    const select = document.getElementById('edit-news-user');
                    select.innerHTML = '<option value="">-- Select Author --</option>';
                    if (res.data.status && res.data.data.length) {
                        res.data.data.forEach(user => {
                            const opt = document.createElement('option');
                            opt.value = user.id;
                            opt.textContent = user.name;
                            if (selectedId && selectedId == user.id) opt.selected = true;
                            select.appendChild(opt);
                        });
                    }
                } catch (err) {
                    Swal.fire('Failed', err.response.data.message ?? 'Failed to load users list', 'error');
                }
            }
            editNewsForm.addEventListener('submit', async function (e) {
                e.preventDefault();
                const id = document.getElementById('edit-news-id').value;
                try {
                    const formData = new FormData();
                    formData.append('_method', 'PUT');
                    formData.append('title', document.getElementById('edit-news-title').value);
                    formData.append('content', editEditorInstance.getData());
                    formData.append('user_id', document.getElementById('edit-news-user').value);
                    if (editImageInput.files[0]) {
                        formData.append('image', editImageInput.files[0]);
                    }
                    const response = await axios.post(`/api/master-data/news/${id}`, formData, {
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': 'Bearer ' + getCookie('auth_token'),
                            'Content-Type': 'multipart/form-data'
                        }
                    });
                    if (response.data.status === true) {
                        $('#newsEditModal').modal('hide');
                        Swal.fire('Success', response.data.message ?? 'News updated successfully!', 'success');
                        loadNews(currentPage, currentLimit);
                    }
                } catch (error) {
                    Swal.fire('Failed', err.response.data.message ?? 'Failed to update news', 'error');
                }
            });
            // Delete
            $(document).on('click', '.delete-news', async function() {
                const id = $(this).data('id');
                const result = await Swal.fire({
                    title: 'Delete News',
                    text: 'Are you sure you want to delete this news?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                    reverseButtons: true
                });
                if (!result.isConfirmed) return;
                axios.delete(`/api/master-data/news/${id}`, {
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': 'Bearer ' + getCookie('auth_token')
                        }
                    })
                    .then(res => {
                        if (res.data.status) {
                            Swal.fire('Success', res.data.message ?? 'News deleted successfully', 'success');
                            loadNews(currentPage, currentLimit);
                        }
                    })
                    .catch(err => {
                        Swal.fire('Failed', err.response.data.message ?? 'Failed to delete news', 'error');
                    });
            });
        });
    </script>
    <style>
        .pagination .page-item.active .page-link {
            background-color: #699834;
            border-color: #699834;
            color: #fff;
        }
        #newsShowModal .modal-content {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
        }
        #newsShowModal .modal-body {
            background-color: #f9f9f9;
            border-radius: 0 0 10px 10px;
        }
        #newsShowModal .badge {
            font-size: 0.85rem;
            padding: 0.35em 0.65em;
        }
        #newsContent p {
            margin-bottom: 0.8rem;
        }
    </style>
@endsection
