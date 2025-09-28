@extends('layouts.base')
@section('title', 'Login - Yayasan Agape Hijau Abadi')
@section('content')
    <x-loading-overlay-component />
    <script>
        showLoading();
        document.addEventListener('DOMContentLoaded', async function() {
            const token = getCookie('auth_token');
            try {
                const response = await axios.get('/api/is-logged-in', {
                    headers: {
                        'Authorization': `Bearer ${token}`
                    }
                });
                if (response.data.status === true) {
                    window.location.href = '/dashboard';
                }
            } catch (error) {
                console.error(error);
            } finally {
                hideLoading();
            }
        });
    </script>
    <div class="container vh-100 py-0 my-0" id="login-layout">
        <div class="row w-100 h-100 p-0 m-0 align-items-center justify-content-center">
            <div class="col-lg-5 col-md-6 col-12">
                <div class="card border-0 shadow-sm py-0 my-4">
                    <div class="card-header p-0 m-0 border-0">
                        <img class="img-fluid w-100 h-100 object-fit-cover p-0 m-0 rounded-top"
                            style="max-height: 200px; object-position: center;"
                            src="https://i.pinimg.com/1200x/19/89/60/19896054fc77172c4417fe413c51c97d.jpg" alt="">
                    </div>
                    <div class="card-body border-0 px-4 py-4">
                        <h1 class="text-muted fs-4 text-center mb-4 fw-medium"><span class="text-success">Log</span> In</h1>
                        <form method="POST" id="login-form">
                            <div class="mb-3">
                                <label for="UserEmail" class="form-label text-muted" style="font-size: 0.9rem;">Email
                                    address</label>
                                <input type="email" name="email" max="255"
                                    class="form-control border-0 border-bottom rounded-0" id="UserEmail"
                                    placeholder="name@example.com" required>
                            </div>
                            <div class="mb-3">
                                <label for="UserPassword" class="form-label text-muted"
                                    style="font-size: 0.9rem;">Password</label>
                                <input type="password" name="password" min="8" max="255"
                                    class="form-control border-0 border-bottom rounded-0" id="UserPassword"
                                    placeholder="**********" required>
                            </div>
                            <button class="btn btn-success w-100" type="submit" id="login-btn">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const form = document.getElementById('login-form');
        const loginBtn = document.getElementById('login-btn');
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            loginBtn.disabled = true;
            try {
                const response = await axios.post('/api/login', {
                    email: e.target.email.value,
                    password: e.target.password.value
                });
                if (response.data.status === true) {
                    await Swal.fire({
                        title: 'Success',
                        text: response.data.message,
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    window.location.href = '/dashboard';
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: response.data.message,
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            } catch (error) {
                Swal.fire({
                    title: 'Error',
                    text: error.response.data.message ?? 'An error occurred while logging in',
                    icon: 'error',
                    showConfirmButton: true
                });
            } finally {
                loginBtn.disabled = false;
            }
        });
    </script>
@endsection
