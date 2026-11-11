<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Manajemen Venue</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; display: flex; align-items: center; justify-content: center; height: 100vh; }
        .login-card { width: 100%; max-width: 400px; }
        .topbar { background: linear-gradient(90deg, #800080, #ff00ff); }
    </style>
</head>
<body>
    <div class="card shadow-sm border-0 rounded-3 login-card">
        <div class="card-header topbar text-white text-center py-3">
            <h4 class="fw-bold m-0">LOGIN SISTEM</h4>
        </div>
        <div class="card-body p-4">
            @if($errors->any())
                <div class="alert alert-danger text-center small fw-semibold">{{ $errors->first() }}</div>
            @endif

            <form action="/login" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold small text-muted">Alamat Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Masukkan Email" required>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-semibold small text-muted">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required>
                </div>
                <button type="submit" class="btn text-white w-100 fw-bold py-2" style="background: linear-gradient(90deg, #800080, #ff00ff); border: none;">Masuk</button>
            </form>
        </div>
    </div>
</body>
</html>