<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Mazer Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/auth.css') }}">
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="#"><img src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo"></a>
                    </div>
                    <h1 class="auth-title">Sign Up</h1>
                    <p class="auth-subtitle mb-5">Input your data to register to our website.</p>

                    <form action="{{ url('/register') }}" method="POST">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text"
                                class="form-control form-control-xl @error('email') is-invalid @enderror"
                                placeholder="Email" name="email" value="{{ old('email') }}">
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                            {{-- ini untuk alert validation --}}
                            <div class="invalid-feedback">
                                @error('email')
                                    <i class="fa-solid fa-triangle-exclamation fa-bounce"></i> {{ $message }}
                                @enderror
                            </div>
                            {{-- ini akhir alert validation --}}
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text"
                                class="form-control form-control-xl @error('username') is-invalid @enderror"
                                placeholder="Username" name="username" value="{{ old('username') }}">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                            {{-- ini untuk alert validation --}}
                            <div class="invalid-feedback">
                                @error('username')
                                    <i class="fa-solid fa-triangle-exclamation fa-bounce"></i> {{ $message }}
                                @enderror
                            </div>
                            {{-- ini akhir alert validation --}}
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text"
                                class="form-control form-control-xl @error('telephone') is-invalid @enderror"
                                placeholder="Telephone" name="telephone" value="{{ old('telephone') }}">
                            <div class="form-control-icon">
                                <i class="bi bi-phone"></i>
                            </div>
                            {{-- ini untuk alert validation --}}
                            <div class="invalid-feedback">
                                @error('telephone')
                                    <i class="fa-solid fa-triangle-exclamation fa-bounce"></i> {{ $message }}
                                @enderror
                            </div>
                            {{-- ini akhir alert validation --}}
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text"
                                class="form-control form-control-xl @error('address') is-invalid @enderror"
                                placeholder="Address" name="address" value="{{ old('address') }}">
                            <div class="form-control-icon">
                                <i class="bi bi-house"></i>
                            </div>
                            {{-- ini untuk alert validation --}}
                            <div class="invalid-feedback">
                                @error('address')
                                    <i class="fa-solid fa-triangle-exclamation fa-bounce"></i> {{ $message }}
                                @enderror
                            </div>
                            {{-- ini akhir alert validation --}}
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <select class="form-control form-control-xl @error('role') is-invalid @enderror"
                                placeholder="Role" name="role">
                                <option value="">Choose One</option>
                                <option>Admin</option>
                                <option>User</option>
                            </select>
                            <div class="form-control-icon">
                                <i class="bi bi-key"></i>
                            </div>
                            {{-- ini untuk alert validation --}}
                            <div class="invalid-feedback">
                                @error('role')
                                    <i class="fa-solid fa-triangle-exclamation fa-bounce"></i> {{ $message }}
                                @enderror
                            </div>
                            {{-- ini akhir alert validation --}}
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password"
                                class="form-control form-control-xl @error('password') is-invalid @enderror"
                                placeholder="Password" name="password" value="{{ old('password') }}">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            {{-- ini untuk alert validation --}}
                            <div class="invalid-feedback">
                                @error('password')
                                    <i class="fa-solid fa-triangle-exclamation fa-bounce"></i> {{ $message }}
                                @enderror
                            </div>
                            {{-- ini akhir alert validation --}}
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password"
                                class="form-control form-control-xl @error('confirm_password') is-invalid @enderror"
                                placeholder="Confirm Password" name="confirm_password"
                                value="{{ old('confirm_password') }}">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            {{-- ini untuk alert validation --}}
                            <div class="invalid-feedback">
                                @error('confirm_password')
                                    <i class="fa-solid fa-triangle-exclamation fa-bounce"></i> {{ $message }}
                                @enderror
                            </div>
                            {{-- ini akhir alert validation --}}
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Sign Up</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class='text-gray-600'>Already have an account? <a href="{{ url('/login') }}" class="font-bold">Log
                                in</a>.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>
</body>

</html>