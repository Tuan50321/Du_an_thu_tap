<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Trang chủ</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="min-h-screen flex flex-col bg-gray-50 text-gray-800">

  <!-- Header -->
  <header class="bg-white shadow">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
      <a href="/" class="text-2xl font-bold text-blue-600">MyShop</a>

      <nav class="space-x-6">
        <a href="/" class="text-gray-700 hover:text-blue-600">Trang chủ</a>
        <a href="/product" class="text-gray-700 hover:text-blue-600">Sản phẩm</a>
        <a href="/about" class="text-gray-700 hover:text-blue-600">Giới thiệu</a>
        <a href="/contact" class="text-gray-700 hover:text-blue-600">Liên hệ</a>
      </nav>

      <!-- Auth -->
      <div>
        <?php if(auth()->guard()->check()): ?>
          <!-- Dropdown menu bằng click -->
          <div x-data="{ open: false }" class="relative">
            <button @click="open = !open" class="flex items-center space-x-2 hover:text-blue-600 focus:outline-none">
              <span><?php echo e(Auth::user()->name); ?></span>
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </button>

            <div x-show="open" @click.outside="open = false"
                 class="absolute right-0 mt-2 w-40 bg-white border rounded shadow-md z-10">
              <form action="<?php echo e(route('logout')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">Đăng xuất</button>
              </form>
            </div>
          </div>
        <?php else: ?>
          <a href="<?php echo e(route('login')); ?>" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Đăng nhập</a>
        <?php endif; ?>
      </div>
    </div>
  </header>

  <!-- Nội dung -->
  <main class="flex-grow">
    <!-- Banner -->
    <section class="bg-blue-100 py-16 text-center">
      <h1 class="text-4xl font-bold mb-2">Chào mừng bạn đến với MyShop</h1>
      <p class="text-gray-700 text-lg">Khám phá các sản phẩm chất lượng với giá hợp lý</p>
    </section>

    <!-- Nội dung khác -->
    <section class="container mx-auto px-4 py-12">
      <?php echo $__env->yieldContent('content'); ?>
    </section>
  </main>

  <!-- Footer cố định dưới -->
  <footer class="bg-gray-800 text-white py-6 text-center">
    <p>&copy; 2025 MyShop. All rights reserved.</p>
  </footer>

  

</body>
</html>
<?php /**PATH C:\laragon\www\Du_an_thu_tap\resources\views/client/layouts/app.blade.php ENDPATH**/ ?>