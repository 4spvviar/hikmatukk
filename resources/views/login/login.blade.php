<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login Admin Sekolah</title>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}" />
    <style>
        body {
            margin: 0;
            height: 100vh;
            background: linear-gradient(135deg, #0d47a1 0%, #25fc66 100%);
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-container {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            padding: 40px 30px;
            width: 350px;
            text-align: center;
        }
        .login-container img {
            display: block;
            margin: 0 auto 20px auto;
            width: 120px;
            height: 120px;
            border-radius: 50%;
        }
        .login-container h2 {
            margin-bottom: 30px;
            font-weight: 700;
        }
        .form-control {
            border-radius: 30px;
            background: rgba(255, 255, 255, 0.15);
            border: none;
            color: white;
            padding-left: 45px;
            height: 45px;
            box-shadow: none;
        }
        .form-control::placeholder {
            color:#e0e0e0;
        }
        .input-icon {
            position: relative;
        }
        .input-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: white;
            font-size: 18px;
        }
        .form-check-label {
            color: white;
            user-select: none;
        }
        .form-check-input {
            background-color: white;
            border-radius: 3px;
            margin-top: 0.3rem;
            margin-right: 0.5rem;
            cursor: pointer;
        }
        .forgot-link {
            color: white;
            text-decoration: underline;
            cursor: pointer;
            font-size: 0.9rem;
        }
        .btn-login {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            color: white;
            border-radius: 30px;
            font-weight: 600;
            padding: 10px 0;
            margin-top: 20px;
            width: 100%;
            border: none;
            transition: background 0.3s ease;
        }
        .btn-login:hover {
            opacity: 0.9;
        }

    </style>
</head>
<body>
    <div class="login-container">
        <img src="{{ asset('assets/foto/mts tercinta.png') }}" alt="Login Image" />
        <h2>Login</h2>
        <form action="{{ route('auth') }}" method="POST">
            @csrf
            <div class="mb-3 input-icon">
                <i class="fa-solid fa-user"></i>
                <input
                    type="text"
                    class="form-control"
                    id="username"
                    name="username"
                    placeholder="Username"
                    required
                />
            </div>
            <div class="mb-3 input-icon">
                <i class="fa-solid fa-lock"></i>
                <input
                    type="password"
                    class="form-control"
                    id="password"
                    name="password"
                    placeholder="Password"
                    required
                />
            </div>
            <button type="submit" class="btn btn-login">Login</button>
            <a href="" class="forgot-link">Kembali Ke Beranda</a>
        </form>
    </div>

    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/fontawesome/js/fontawesome.js') }}"></script>
</body>
</html>
