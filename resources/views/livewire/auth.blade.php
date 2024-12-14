<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            width: 500px;
            height: 350px;
            padding: 30px;
            background-color: rgb(240, 243, 238);
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-control {
            height: 40px;
            font-size: 16px;
        }

        .btn-block {
            height: 40px;
            font-size: 16px;
        }

        .btn-location {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="container">
        <div class="login-box">
            <div class="login-logo text-center mb-4">
                <h3>Admin</h3>
            </div>
            <div class="card">
                <div class="card-body login-card-body">
                  <div class="btn-location">
                    <p class="login-box-msg">Sign in to start your session</p>
                  </div>

                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="Email" name="email" required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Password" name="password" required>
                        </div>
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        <div class="row">
                            <div class="btn-location">
                                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
