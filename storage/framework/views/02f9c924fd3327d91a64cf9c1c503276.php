<?php $__env->startSection('title', 'Giỏ hàng'); ?>

<?php $__env->startSection('content'); ?>
<section class="tp-cart-area">
    <div class="container">
        <div class="row">
            <?php if($cartItems && $cartItems->count()): ?>
            <div class="col-lg-8 mb-4 mb-lg-0">
                <div class="cart-header-row">
                    <div class="header-item"></div>
                    <div class="header-item">Ảnh</div>
                    <div class="header-item">Tên sản phẩm</div>
                    <div class="header-item">Giá</div>
                    <div class="header-item">Số lượng</div>
                    <div class="header-item">Tổng tiền</div>
                    <div class="header-item">Xóa</div>
                </div>

                <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="cart-item-card" data-cart-item-id="<?php echo e($item->id); ?>" data-product-id="<?php echo e($item->product->id); ?>">
                    <div class="cart-item-select">
                        <input type="checkbox" class="cart-item-checkbox" checked>
                    </div>
                    <div class="cart-item-image">
                        <img src="<?php echo e($item->product->thumbnail_url); ?>" alt="<?php echo e($item->product->name); ?>">
                    </div>
                    <div class="cart-item-info">
                        <h3><?php echo e($item->product->name); ?></h3>
                        <div class="stock-info <?php echo e($item->low_stock ? 'low-stock' : ''); ?>">
                            Số lượng tồn: <?php echo e($item->product->stock); ?>

                            <?php if($item->low_stock): ?>
                                <span class="low-stock-badge">(Sắp hết hàng)</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="cart-item-price price-single" data-price="<?php echo e($item->price); ?>"><?php echo e(number_format($item->price, 0, ',', '.')); ?>đ</div>
                    <div class="cart-item-quantity">
                        <div class="quantity-controls">
                            <button class="btn-quantity" data-action="decrease">-</button>
                            <input type="number" class="quantity-input" value="<?php echo e($item->quantity); ?>" min="1">
                            <button class="btn-quantity" data-action="increase">+</button>
                        </div>
                    </div>
                    <div class="cart-item-total" data-total="<?php echo e($item->price * $item->quantity); ?>"><?php echo e(number_format($item->price * $item->quantity, 0, ',', '.')); ?>đ</div>
                    <div class="cart-item-remove">
                        <form action="<?php echo e(route('client.cart.remove', $item->id)); ?>" method="POST" class="remove-form">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn-remove">Xóa</button>
                        </form>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <div class="cart-actions mt-4">
                    <form action="<?php echo e(route('client.cart.clear')); ?>" method="POST" class="clear-cart-form">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa toàn bộ giỏ hàng?')">Xóa toàn bộ giỏ hàng</button>
                    </form>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="cart-summary">
                    <h3>Tóm tắt giỏ hàng</h3>
                    <div class="summary-item">
                        <span>Tổng tiền:</span>
                        <span id="cart-total">0đ</span>
                    </div>
                    <div class="summary-item">
                        <span>Phí vận chuyển:</span>
                        <span>0đ</span>
                    </div>
                    <div class="summary-item total">
                        <span>Tổng cộng:</span>
                        <span id="cart-grand-total">0đ</span>
                    </div>
                    <a href="<?php echo e(route('client.checkout')); ?>" class="btn btn-primary btn-block">Tiến hành thanh toán</a>
                </div>
            </div>
            <?php endif; ?>
            <?php if(!$cartItems || !$cartItems->count()): ?>
            <div class="col-12">
                <div class="empty-cart">
                    <h3>Giỏ hàng trống</h3>
                    <p>Bạn chưa có sản phẩm nào trong giỏ hàng.</p>
                    <a href="<?php echo e(route('client.home')); ?>" class="btn btn-primary">Tiếp tục mua sắm</a>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<style>
    .tp-cart-area {
        padding: 2rem 0;
    }

    .cart-header-row {
        display: grid;
        grid-template-columns: 40px 100px 2fr 1fr 1fr 1fr 60px;
        gap: 1rem;
        margin-bottom: 1rem;
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 8px;
    }

    .header-item {
        text-align: center;
        font-weight: 600;
        color: #6c757d;
    }

    .cart-item-card {
        display: grid;
        grid-template-columns: 40px 100px 2fr 1fr 1fr 1fr 60px;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1rem;
        padding: 1rem;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .cart-item-image img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 4px;
    }

    .cart-item-info h3 {
        margin: 0;
        font-size: 1rem;
    }

    .quantity-controls {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .quantity-input {
        width: 40px;
        height: 30px;
        text-align: center;
        border: 1px solid #ced4da;
        border-radius: 4px;
        padding: 0;
        font-size: 14px;
        color: #495057;
    }

    .btn-quantity {
        width: 30px;
        height: 30px;
        background: #f8f9fa;
        border: 1px solid #ced4da;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
        color: #495057;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-quantity:hover {
        background: #e9ecef;
    }

    .btn-quantity:active {
        background: #dcdcdc;
    }

    .cart-item-total {
        text-align: center;
        font-size: 1rem;
        color: #212529;
        margin: 0;
        padding: 0.5rem;
    }

    .cart-item-remove {
        text-align: center;
    }

    .btn-remove {
        width: 100%;
        padding: 0.25rem;
        background: #dc3545;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .cart-summary {
        background: white;
        padding: 1.5rem;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .summary-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1rem;
    }

    .summary-item.total {
        font-weight: 600;
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid #dee2e6;
    }

    .btn-primary {
        width: 100%;
        padding: 0.75rem;
        background: #0d6efd;
        border: none;
        border-radius: 4px;
        color: white;
        font-weight: 600;
    }

    .empty-cart {
        text-align: center;
        padding: 3rem;
    }

    .empty-cart h3 {
        margin-bottom: 1rem;
        color: #212529;
    }

    .empty-cart p {
        color: #6c757d;
        margin-bottom: 2rem;
    }

    .toast {
        position: fixed;
        top: 1rem;
        right: 1rem;
        padding: 0.5rem;
        border-radius: 4px;
        font-size: 14px;
        color: white;
        display: none;
    }

    .toast-success {
        background: #2ecc71;
    }

    .toast-error {
        background: #e74c3c;
    }

    .low-stock-badge {
        color: #dc3545;
        font-size: 12px;
        margin-left: 4px;
    }

    .cart-item-select {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .cart-item-checkbox {
        width: 20px;
        height: 20px;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tính tổng tiền ban đầu
    updateCartTotal();

    // Xử lý checkbox
    document.querySelectorAll('.cart-item-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            updateCartTotal();
        });
    });

    // Xử lý tăng giảm số lượng
    document.querySelectorAll('.btn-quantity').forEach(button => {
        button.addEventListener('click', function() {
            const action = this.dataset.action;
            const itemCard = this.closest('.cart-item-card');
            const quantityInput = itemCard.querySelector('.quantity-input');
            const currentQuantity = parseInt(quantityInput.value);
            let newQuantity = currentQuantity;

            if (action === 'increase') {
                newQuantity = currentQuantity + 1;
            } else if (action === 'decrease') {
                newQuantity = Math.max(1, currentQuantity - 1);
            }

            // Cập nhật input
            quantityInput.value = newQuantity;

            // Lấy giá và tính tổng mới
            const price = parseFloat(itemCard.querySelector('.cart-item-price').dataset.price);
            const newTotal = price * newQuantity;

            // Cập nhật tổng tiền của item
            itemCard.querySelector('.cart-item-total').textContent = `${newTotal.toLocaleString()}đ`;
            itemCard.querySelector('.cart-item-total').dataset.total = newTotal;

            // Gọi API cập nhật giỏ hàng
            fetch(`/cart/${itemCard.dataset.cartItemId}/update`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    quantity: newQuantity
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    updateCartTotal();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Nếu có lỗi, khôi phục giá trị cũ
                quantityInput.value = currentQuantity;
                updateCartTotal();
            });
        });
    });

    // Xử lý thay đổi trực tiếp input
    document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('change', function() {
            const itemCard = this.closest('.cart-item-card');
            const quantity = parseInt(this.value);
            const currentQuantity = parseInt(this.value);

            if (isNaN(quantity) || quantity < 1) {
                this.value = itemCard.querySelector('.quantity-input').value;
                return;
            }

            // Lấy giá và tính tổng mới
            const price = parseFloat(itemCard.querySelector('.cart-item-price').dataset.price);
            const newTotal = price * quantity;

            // Cập nhật tổng tiền của item
            itemCard.querySelector('.cart-item-total').textContent = `${newTotal.toLocaleString()}đ`;
            itemCard.querySelector('.cart-item-total').dataset.total = newTotal;

            // Gọi API cập nhật giỏ hàng
            fetch(`/cart/${itemCard.dataset.cartItemId}/update`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    quantity: quantity
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    updateCartTotal();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Nếu có lỗi, khôi phục giá trị cũ
                this.value = currentQuantity;
                updateCartTotal();
            });
        });
    });

    // Hàm cập nhật tổng giỏ hàng
    function updateCartTotal() {
        const cartItems = document.querySelectorAll('.cart-item-card');
        let total = 0;
        cartItems.forEach(item => {
            const checkbox = item.querySelector('.cart-item-checkbox');
            const totalElement = item.querySelector('.cart-item-total');
            if (checkbox.checked && totalElement && totalElement.dataset.total) {
                total += parseFloat(totalElement.dataset.total);
            }
        });

        // Cập nhật tổng tiền
        document.getElementById('cart-total').textContent = `${total.toLocaleString()}đ`;
        document.getElementById('cart-grand-total').textContent = `${total.toLocaleString()}đ`;
    }
});
</script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Xử lý form xóa
    document.querySelectorAll('.remove-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault(); // Ngăn chặn submit mặc định

            if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) {
                // Lấy ID của item cần xóa
                const itemId = this.closest('.cart-item-card').dataset.cartItemId;

                // Gọi API xóa
                fetch(`/cart/${itemId}/remove`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Xóa item khỏi DOM
                        this.closest('.cart-item-card').remove();
                        // Cập nhật tổng tiền
                        updateCartTotal();
                        // Hiển thị thông báo thành công
                        alert('Đã xóa sản phẩm khỏi giỏ hàng!');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Có lỗi khi xóa sản phẩm. Vui lòng thử lại.');
                });
            }
        });
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Du_an_thu_tap\resources\views/client/cart/index.blade.php ENDPATH**/ ?>