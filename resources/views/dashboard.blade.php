<!DOCTYPE html>
<!--
Current Date and Time (UTC): 2025-10-15 16:13:05
Current User's Login: DavitChikobava
-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Dashboard</title>
    <style>
        .card {
            box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%);
        }
        .card .card-header {
            font-weight: 500;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
            border-color: #bac8f3;
        }
        .hover-danger:hover {
            background-color: #dc3545 !important;
            color: white !important;
            transition: all 0.3s ease;
        }
        .hover-primary:hover {
            background-color: #0d6efd !important;
            color: white !important;
            transition: all 0.3s ease;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(78, 115, 223, 0.3) !important;
        }
        .btn:active {
            transform: translateY(0);
        }
        .custom-btn {
            background: linear-gradient(45deg, #4e73df, #224abe);
            border: none;
            border-radius: 10px;
            transition: all 0.3s ease;
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">
                <span class="fw-bold text-primary">CHIKO</span>
                <span class="fw-bold text-dark">Dashboard</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center text-end">
                    <li class="nav-item mb-2 mb-lg-0">
                        <span class="nav-link d-block text-lg-start text-end">
                            Welcome, {{ auth()->user()->name }}!
                        </span>
                    </li>
                    <li class="nav-item mb-2 mb-lg-0 d-flex justify-content-end">
                        <a href="{{ route('register') }}" 
                        class="nav-link border border-primary text-primary rounded px-3 ms-2 hover-primary d-inline-block">
                            Register User
                        </a>
                    </li>
                    <li class="nav-item mb-2 mb-lg-0 d-flex justify-content-end">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" 
                                    class="nav-link border border-danger text-danger rounded px-3 ms-2 hover-danger">
                                Log out
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row g-4">
            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        Profile Information
                    </div>
                    <div class="card-body">
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                    id="name" name="name" value="{{ old('name', auth()->user()->name) }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="surname" class="form-label">Surname</label>
                                <input type="text" class="form-control @error('surname') is-invalid @enderror" 
                                    id="surname" name="surname" value="{{ old('surname', auth()->user()->surname) }}">
                                @error('surname')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                    id="phone" name="phone" value="{{ old('phone', auth()->user()->phone) }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                    id="email" name="email" value="{{ old('email', auth()->user()->email) }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-center mt-4">
                                <button type="submit" 
                                        class="btn custom-btn position-relative overflow-hidden w-50 py-2 text-white fw-semibold shadow-sm">
                                    <span class="d-flex align-items-center justify-content-center">
                                        Update Profile
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        Change Password
                    </div>
                    <div class="card-body">
                        <form action="{{ route('password.change') }}" method="POST">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="current_password" class="form-label">Current Password</label>
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                                    id="current_password" name="current_password">
                                @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                    id="password" name="password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control" 
                                    id="password_confirmation" name="password_confirmation">
                            </div>

                            <div class="d-flex justify-content-center mt-4">
                                <button type="submit" 
                                        class="btn custom-btn position-relative overflow-hidden w-50 py-2 text-white fw-semibold shadow-sm">
                                    <span class="d-flex align-items-center justify-content-center">
                                        Change Password
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>