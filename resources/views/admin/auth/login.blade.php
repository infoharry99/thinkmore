<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - ThinkClear</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #0B131F; color: #ffffff; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px; }
        .login-card { background: #111827; border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 20px; padding: 40px; width: 100%; max-width: 420px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); }
        .brand-title { font-size: 26px; font-weight: 800; text-align: center; margin-bottom: 8px; color: #ffffff; }
        .brand-sub { color: #9CA3AF; font-size: 14px; text-align: center; margin-bottom: 32px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; font-size: 13px; font-weight: 600; margin-bottom: 8px; color: #D1D5DB; }
        input { width: 100%; padding: 14px; border-radius: 10px; border: 1px solid #374151; background: #1F2937; color: #ffffff; font-size: 15px; outline: none; }
        input:focus { border-color: #1E6146; }
        .btn-submit { width: 100%; padding: 14px; background: #1E6146; color: #ffffff; border: none; border-radius: 10px; font-weight: 700; font-size: 16px; cursor: pointer; margin-top: 10px; }
        .error-msg { background: #7F1D1D; color: #FECACA; padding: 12px; border-radius: 8px; font-size: 13px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="login-card">
        <h1 class="brand-title">ThinkClear Admin</h1>
        <p class="brand-sub">Management Portal & Foundation Analytics</p>

        @if($errors->any())
            <div class="error-msg">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" value="{{ old('email', 'admin@thinkclear.co.in') }}" required placeholder="admin@thinkclear.co.in">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required placeholder="••••••••">
            </div>

            <button type="submit" class="btn-submit">Sign In to Admin</button>
        </form>
    </div>
</body>
</html>
