<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(to right, #74ebd5, #9face6);
            min-height: 100vh;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #4A90E2;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-md-5">
            <div class="card p-4">
                <h3 class="text-center mb-4 text-primary">Đăng ký tài khoản</h3>

                <?php if($errors->any()): ?>
                    <div class="alert alert-danger text-center">
                        <?php echo e($errors->first()); ?>

                    </div>
                <?php endif; ?>

                <form action="<?php echo e(route('register')); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <div class="mb-3">
                        <label for="name" class="form-label">Họ tên</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Nhập họ tên">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-envelope"></i></span>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Nhập email">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-lock"></i></span>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Nhập mật khẩu">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Xác nhận mật khẩu</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-lock-fill"></i></span>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Nhập lại mật khẩu">
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Đăng ký</button>
                    </div>

                    <div class="text-center mt-3">
                        <a href="<?php echo e(route('login')); ?>" class="text-decoration-none">Đã có tài khoản? Đăng nhập</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH D:\laragon\www\Du_an_thu_tap\Du_an_thu_tap\resources\views/auth/register.blade.php ENDPATH**/ ?>