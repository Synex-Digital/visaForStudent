<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    @include('layouts.headerLink')
</head>

<body>
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-12 p-0">
                <div class="login-card login-dark">
                    <div>
                        {{-- <div><a class="logo" href="index.html"><img class="img-fluid for-light" src="../assets/images/logo/logo-1.png" alt="looginpage"><img class="img-fluid for-dark" src="../assets/images/logo/logo.png" alt="looginpage"></a></div> --}}
                        <div class="login-main">
                            <form class="theme-form" method="POST" action="{{ route('register') }}">
                                @csrf
                                <h3>Sign in to account</h3>
                                <p>Enter your email & password to login</p>

                                <div class="form-group">
                                    <label class="col-form-label">Name</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label">Email</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label">Password</label>
                                    <div class="form-input position-relative">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password" required autocomplete="current-password" placeholder="Password">
                                        {{-- <div class="show-hide"><span class="show"> </span></div> --}}
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div>
                                    <label class="col-form-label">Confirm Password</label>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                                </div>

                                <div class="form-group mb-0">
                                    <div class="text-end mt-3">
                                        <button class="btn btn-primary btn-block w-100" type="submit">Sign Up</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footerLink')
</body>

</html>
