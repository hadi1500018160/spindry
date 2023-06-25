<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mazer Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/auth.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <div id="auth">
        
<div class="row h-100">
    <div class="col-lg-5 col-12">
        <div id="auth-left">
            <div class="auth-logo">
                <a href="index.html"><img src="{{asset('assets/images/logo/logo.png')}}" alt="Logo"></a>
            </div>
            <h1 class="auth-title">Log Up</h1>
            <p class="auth-subtitle mb-5">Input your data to register to our website.</p>
            @if (session()->has('gagal'))
                        <div class="alert alert-warning" role="alert">
                            <i class="fa-regular fa-circle-xmark fa-beat"></i>
                            {{ session('gagal') }}
                        </div>
                    @endif

            <form action="{{url('/login')}}" method="POST">
                @csrf
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="text" class="form-control form-control-xl" @error('email') is-invalid @enderror  placeholder="Email" name="email">
                    <div class="form-control-icon">
                        <i class="bi bi-envelope"></i>
                        @error('email') <i class="fa-solid fa-triangle-exclamation fa-bounce"></i> {{$message}}
                        @enderror
                    </div>
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="password" class="form-control form-control-xl" @error('Password') is-invalid @enderror  placeholder="Password" name="password">
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                        @error('Password') <i class="fa-solid fa-triangle-exclamation fa-bounce"></i> {{$message}}
                        @enderror
                    </div>
                </div>
              
                <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Login</button>
            </form>
            <div class="text-center mt-5 text-lg fs-4">
                <p class='text-gray-600'>Already have an account? <a href="auth-login.html" class="font-bold">Log
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
