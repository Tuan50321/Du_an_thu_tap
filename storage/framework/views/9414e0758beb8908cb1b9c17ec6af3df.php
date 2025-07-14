<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Shop Online'); ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <style>
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }

        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 80px 0;
        }

        .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .product-image {
            height: 200px;
            object-fit: cover;
        }

        .category-card {
            background: linear-gradient(45deg, #f093fb 0%, #f5576c 100%);
            color: white;
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .category-card:hover {
            transform: scale(1.05);
        }

        .footer {
            background-color: #343a40;
            color: white;
            padding: 40px 0 20px;
        }

        .social-links a {
            color: white;
            margin: 0 10px;
            font-size: 1.5rem;
        }

        .social-links a:hover {
            color: #007bff;
        }

        .banner-carousel .carousel-item {
            height: 400px;
        }

        .banner-carousel .carousel-item img {
            object-fit: cover;
            height: 100%;
        }

        .news-card {
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .news-card:hover {
            transform: translateY(-5px);
        }

        .btn-primary {
            background: linear-gradient(45deg, #667eea, #764ba2);
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, #5a6fd8, #6a4190);
        }

        .navbar .dropdown-menu {
            background-color: #012035;
        }

        .navbar .dropdown-menu .dropdown-item {
            color: #fff;
        }

        .navbar .dropdown-menu .dropdown-item:hover {
            background-color: #013a6b;
            color: #fff;
        }

        <style>.star-rating {
            direction: rtl;
            font-size: 1.5rem;
        }

        .star-rating input[type="radio"] {
            display: none;
        }

        .star-rating label {
            color: #ccc;
            cursor: pointer;
        }

        .star-rating input[type="radio"]:checked~label,
        .star-rating label:hover,
        .star-rating label:hover~label {
            color: #ffc107;
        }
    </style>

    </style>

    <?php echo $__env->yieldPushContent('styles'); ?>
    <?php echo $__env->yieldContent('styles'); ?>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg" style="background-color: #012035;">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="<?php echo e(route('client.home')); ?>">
                <img src="<?php echo e(asset('storage/logo/logo.png')); ?>" alt="Logo"
                    style="height:80px; width:auto; margin-right:18px;">
                <span style="font-weight:bold; font-size:1.3rem; color:#fff; letter-spacing:1px;">HOUSE HOLD GOOD</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?php echo e(route('client.home')); ?>">Trang chủ</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button"
                            data-bs-toggle="dropdown">
                            Danh mục
                        </a>
                        <ul class="dropdown-menu">
                            <?php $__currentLoopData = $categories ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a class="dropdown-item" href="<?php echo e(route('client.category.show', $category->slug)); ?>"><?php echo e($category->name); ?></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Sản phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?php echo e(route('client.news.index')); ?>">Tin tức</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?php echo e(route('client.contacts.index')); ?>">Liên hệ</a>
                    </li>
                </ul>

                <form class="d-flex me-3" action="<?php echo e(route('client.search')); ?>" method="GET"
                    style="max-width: 300px;">
                    <input class="form-control me-2" type="search" name="q"
                        value="<?php echo e(isset($query) ? $query : ''); ?>" placeholder="Tìm kiếm sản phẩm..."
                        aria-label="Tìm kiếm">
                    <button class="btn btn-outline-light" type="submit"><i class="fas fa-search"></i></button>
                </form>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">
                            <i class="fas fa-heart"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?php echo e(route('client.cart.index')); ?>">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="badge bg-danger cart-count">0</span>
                        </a>
                    </li>
                    <!-- Auth -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white d-flex align-items-center gap-1" href="#"
                            id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i>
                            <?php if(auth()->guard()->check()): ?>
                                <span><?php echo e(Auth::user()->name); ?></span>
                            <?php endif; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <?php if(auth()->guard()->check()): ?>
                                <!-- 👉 Mục Tài khoản -->
                                <li>
                                    <a class="dropdown-item" href="<?php echo e(route('client.profile.index')); ?>">
                                        <i class="fas fa-user-circle me-2"></i> Tài khoản
                                    </a>
                                </li>

                                <!-- 👉 Mục Đăng xuất -->
                                <li>
                                    <form action="<?php echo e(route('logout')); ?>" method="POST" class="dropdown-item m-0 p-0">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit"
                                            class="btn btn-link text-dark text-decoration-none w-100 text-start px-3 py-2">
                                            <i class="fas fa-sign-out-alt me-2 text-danger"></i> <span
                                                class="text-danger">Đăng xuất</span>
                                        </button>
                                    </form>
                                </li>
                            <?php else: ?>
                                <li><a class="dropdown-item" href="<?php echo e(route('login')); ?>">
                                        <i class="fas fa-sign-in-alt me-2"></i>Đăng nhập</a></li>
                                <li><a class="dropdown-item" href="<?php echo e(route('register')); ?>">
                                        <i class="fas fa-user-plus me-2"></i>Đăng ký</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- Footer -->
    <footer class="footer mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5>Về chúng tôi</h5>
                    <p>Householdgood - Nơi mua sắm trực tuyến uy tín, chất lượng với đa dạng sản phẩm và dịch vụ tốt
                        nhất.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-md-2 mb-4">
                    <h5>Danh mục</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-light">Điện tử</a></li>
                        <li><a href="#" class="text-light">Thời trang</a></li>
                        <li><a href="#" class="text-light">Nhà cửa</a></li>
                        <li><a href="#" class="text-light">Sức khỏe</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-4">
                    <h5>Hỗ trợ</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-light">Trung tâm trợ giúp</a></li>
                        <li><a href="#" class="text-light">Chính sách đổi trả</a></li>
                        <li><a href="#" class="text-light">Vận chuyển</a></li>
                        <li><a href="#" class="text-light">Bảo hành</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Liên hệ</h5>
                    <p><i class="fas fa-map-marker-alt me-2"></i> Trịnh Văn Bô, Quận Nam Từ Liêm, TP Hà Nội</p>
                    <p><i class="fas fa-phone me-2"></i> 0123 456 789</p>
                    <p><i class="fas fa-envelope me-2"></i> householdgood@gmail.com</p>
                </div>
            </div>
            <hr class="my-4">
            <div class="row">
                <div class="col-md-6">
                    <p>&copy; 2024 Shop Online. Tất cả quyền được bảo lưu.</p>
                </div>
                <div class="col-md-6 text-end">
                    <img src="https://via.placeholder.com/200x30/007bff/ffffff?text=Payment+Methods"
                        alt="Payment Methods" class="img-fluid">
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
    $(document).ready(function() {
        // Load số lượng giỏ hàng khi trang được load
        loadCartCount();
    });

    function loadCartCount() {
        $.ajax({
            url: '<?php echo e(route("client.cart.count")); ?>',
            method: 'GET',
            success: function(response) {
                $('.cart-count').text(response.count);
            },
            error: function() {
                console.log('Không thể load số lượng giỏ hàng');
            }
        });
    }

    function updateCartCount(count) {
        $('.cart-count').text(count);
    }
    </script>

    <?php echo $__env->yieldPushContent('scripts'); ?>

     <?php echo $__env->yieldContent('scripts'); ?>
<!-- Chatbot Toggle Button -->
<div id="chatbot-toggle" onclick="toggleChatbot()">
  <i class="fas fa-comments"></i>
  <span id="chatbot-unread" style="display:none;">0</span>
</div>

<!-- Chatbot Widget -->
<div id="chatbot-widget" style="display:none;">
  <div id="chatbot-header">
    <span><i class="fas fa-robot"></i> Hỗ trợ trực tuyến</span>
    <button id="chatbot-close" onclick="toggleChatbot()">×</button>
  </div>
  <div id="chatbot-messages"></div>
  <div id="chatbot-input">
    <input type="text" id="chatbot-text" placeholder="Nhập tin nhắn..." />
    <button id="chatbot-send"><i class="fas fa-paper-plane"></i></button>
  </div>
</div>

<!-- Âm thanh -->
<audio id="chatbot-sound" src="<?php echo e(asset('sounds/ting.mp3')); ?>" preload="auto"></audio>

<!-- CSS -->
<style>
#chatbot-toggle {
  position: fixed; bottom: 20px; right: 20px;
  background: linear-gradient(45deg, #0084ff, #006bbd);
  color: white; border-radius: 50%;
  width: 50px; height: 50px;
  font-size: 22px;
  display: flex; align-items: center; justify-content: center;
  cursor: pointer; box-shadow: 0 4px 12px rgba(0,0,0,0.3);
  z-index: 9999;
}
#chatbot-toggle:hover { filter: brightness(1.1); }
#chatbot-unread {
  position: absolute; top: 2px; right: 2px;
  background: red; color: white;
  font-size: 12px; border-radius: 50%;
  padding: 2px 5px;
}

#chatbot-widget {
  position: fixed; bottom: 80px; right: 20px;
  width: 300px; max-height: 450px;
  background: white; border-radius: 12px;
  display: flex; flex-direction: column;
  overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.2);
  font-family: 'Segoe UI', Tahoma, sans-serif;
  z-index: 9999;
}

#chatbot-header {
  background: linear-gradient(45deg, #4a76a8, #3b5998);
  color: white; padding: 10px 12px;
  font-weight: bold; display: flex;
  justify-content: space-between; align-items: center;
}

#chatbot-header i { margin-right: 6px; }

#chatbot-close {
  background: transparent; border: none;
  color: white; font-size: 20px;
  cursor: pointer;
}

#chatbot-messages {
  flex: 1; padding: 10px;
  overflow-y: auto; display: flex;
  flex-direction: column; background: #f0f2f5;
}

.chat-msg {
  max-width: 75%; padding: 8px 12px;
  margin: 4px 0; border-radius: 18px;
  font-size: 14px; line-height: 1.4;
  word-wrap: break-word;
}

.user-msg {
  align-self: flex-end; background: #0084ff;
  color: white; border-bottom-right-radius: 4px;
}

.bot-msg {
  align-self: flex-start; background: white;
  color: #333; border: 1px solid #ddd;
  border-bottom-left-radius: 4px;
}

#chatbot-input {
  display: flex; border-top: 1px solid #ddd;
  padding: 6px; background: #fff;
}

#chatbot-text {
  flex: 1; border: none; border-radius: 20px;
  padding: 6px 12px; outline: none;
  background: #f0f2f5; margin-right: 6px;
  font-size: 14px;
}

#chatbot-send {
  border: none; background: #0084ff;
  color: white; border-radius: 50px;
  padding: 6px 12px; font-size: 14px;
  cursor: pointer; transition: background 0.3s;
}
#chatbot-send:hover { background: #006bbd; }
</style>

<!-- JS -->
<script>
let unreadCount = 0;
let userInteracted = false;

document.addEventListener('DOMContentLoaded', () => {
  document.getElementById('chatbot-widget').style.display = 'none';
});

document.getElementById('chatbot-send').addEventListener('click', () => {
  userInteracted = true;
  sendChat();
});
document.getElementById('chatbot-text').addEventListener('keydown', e => {
  if (e.key === 'Enter') {
    userInteracted = true;
    sendChat();
  }
});

function toggleChatbot() {
  const widget = document.getElementById('chatbot-widget');
  const toggle = document.getElementById('chatbot-toggle');
  const unread = document.getElementById('chatbot-unread');
  if (widget.style.display === 'none' || widget.style.display === '') {
    widget.style.display = 'flex';
    toggle.style.display = 'none';
    unreadCount = 0;
    unread.style.display = 'none';
  } else {
    widget.style.display = 'none';
    toggle.style.display = 'flex';
  }
}

async function sendChat() {
  const input = document.getElementById('chatbot-text');
  const msg = input.value.trim();
  if (!msg) return;
  addMessage('user', msg);
  input.value = '';

  try {
    const res = await fetch('/chatbot/send', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' },
      body: JSON.stringify({ message: msg })
    });
    const data = await res.json();
    addMessage('bot', data.reply);
    if (userInteracted) {
      document.getElementById('chatbot-sound').play().catch(e => console.log('Play sound error:', e));
    }
  } catch {
    addMessage('bot', 'Xin lỗi, có lỗi xảy ra.');
  }
}

function addMessage(who, text) {
  const div = document.createElement('div');
  div.className = 'chat-msg ' + (who === 'user' ? 'user-msg' : 'bot-msg');
  div.textContent = text;
  document.getElementById('chatbot-messages').appendChild(div);
  div.scrollIntoView({ behavior: 'smooth' });

  // Nếu bot trả lời và widget đang ẩn, tăng số chưa đọc
  if (who === 'bot' && document.getElementById('chatbot-widget').style.display === 'none') {
    unreadCount++;
    const unread = document.getElementById('chatbot-unread');
    unread.textContent = unreadCount;
    unread.style.display = 'block';
  }
}
</script>
</body>

</html>
<?php /**PATH D:\laragon\www\Du_an_thu_tap\resources\views/client/layouts/app.blade.php ENDPATH**/ ?>