<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SMDHC | Login</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ URL::to('/') }}/assets/adminlte/css/all.min.css">
    {{-- <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css"> --}}
    <link rel="stylesheet" href="{{ URL::to('/') }}/vendor/flasher/flasher.min.css">
    <link rel="stylesheet" href="{{ URL::to('/') }}/assets/adminlte/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="" class="h1"><b>SMDHC</b></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                @error('fails')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <form action="{{ URL::to('/') }}/login/prosesLogin" method="post">
                    @csrf <!-- {{ csrf_field() }} -->
                    <div class="input-group mb-3">
                        <input type="text" name="username"
                            class="form-control  {{ $errors->has('username') ? 'is-invalid' : '' }}"
                            placeholder="Username">
                        <div class="input-group-append">
                            <div class="input-group-text bg-primary" style="">
                                <span class="fas fa-user-lock"></span>
                            </div>
                        </div>
                        <div class="invalid-feedback">{{ $errors->first('username') }}</div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" id="pass"
                            class="form-control  {{ $errors->has('password') ? 'is-invalid' : '' }}"
                            placeholder="Password">
                        <div class="input-group-append">
                            <a class="btn btn-primary">
                                <span class="fas fa-eye-slash" id="iconPass"></span>
                            </a>
                        </div>
                        @error('passwords')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-8">
                        </div>
                        <div class="col-lg-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>

                    </div>
                </form>
                {{-- <p class="mb-1">
                    <a href="forgot-password.html">I forgot my password</a>
                </p>
                <p class="mb-0">
                    <a href="register.html" class="text-center">Register a new membership</a>
                </p> --}}
            </div>
        </div>
    </div>
    <script src="{{ URL::to('/') }}/assets/adminlte/js/jquery.min.js"></script>
    <script src="{{ URL::to('/') }}/assets/adminlte/js/bootstrap.bundle.min.js"></script>
    <script src="{{ URL::to('/') }}/assets/adminlte/js/adminlte.min.js"></script>
    <script>
        $(document).ready(function() {
            @if (session('status'))
                flasher.error('{{ session('status') }}');
            @endif
        })
        document.getElementById('iconPass').onclick = () => {
            let element = document.getElementById('iconPass');
            let pass = document.getElementById('pass');
            if (pass.type === "password") {
                pass.type = "text";
                element.classList.remove("fa-eye-slash")
                element.classList.add('fa-eye')
            } else {
                pass.type = "password";
                element.classList.remove("fa-eye")
                element.classList.add('fa-eye-slash')
            }
        }
    </script>
</body>

</html>
