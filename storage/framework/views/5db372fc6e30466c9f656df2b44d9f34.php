<?php $__env->startSection('title', 'Liên hệ - HOUSE HOLD GOOD'); ?>

<?php $__env->startSection('content'); ?>
    <style>
        .contact-wrapper {
            display: flex;
            flex-wrap: wrap;
            background-color: #fdfdfd;
            padding: 50px 20px;
            gap: 40px;
            justify-content: center;
        }

        .contact-info {
            flex: 1;
            min-width: 300px;
            max-width: 400px;
            background-color: #1e293b;
            color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .contact-info h2 {
            font-size: 24px;
            margin-bottom: 20px;
            border-bottom: 2px solid #4ade80;
            padding-bottom: 10px;
        }

        .info-item {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .info-item i {
            font-size: 18px;
            color: #4ade80;
            margin-right: 12px;
        }

        .contact-form {
            flex: 1;
            min-width: 300px;
            max-width: 600px;
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .contact-form h2 {
            font-size: 24px;
            margin-bottom: 25px;
            color: #111827;
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        .contact-form input:focus,
        .contact-form textarea:focus {
            outline: none;
            border-color: #4ade80;
        }

        .contact-form button {
            width: 100%;
            padding: 12px;
            background-color: #10b981;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .contact-form button:hover {
            background-color: #059669;
        }

        .alert {
            padding: 12px;
            border-radius: 6px;
            font-size: 15px;
            margin-bottom: 20px;
        }

        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
        }

        .alert-danger {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .map-container {
            padding: 30px 20px;
        }

        .map-container iframe {
            width: 100%;
            height: 400px;
            border: 0;
            border-radius: 12px;
        }
    </style>

    <div class="contact-wrapper">
        <!-- Thông tin liên hệ -->
        <div class="contact-info">
            <h2>Thông tin liên hệ</h2>
            <div class="info-item">
                <i class="fas fa-map-marker-alt"></i>
                <span>Trinh Văn Bô, Quận Nam Từ Liêm, Hà Nội</span>
            </div>
            <div class="info-item">
                <i class="fas fa-phone-alt"></i>
                <span><a href="tel:19006750" style="color: #fff;">19006750</a></span>
            </div>
            <div class="info-item">
                <i class="fas fa-envelope"></i>
                <span><a href="mailto:HOUSEHOLDGOOD@gmail.com" style="color: #fff;">HOUSEHOLDGOOD@gmail.com</a></span>
            </div>
        </div>

        <!-- Form liên hệ -->
        <div class="contact-form">
            <h2>Gửi tin nhắn cho chúng tôi</h2>

            <?php if(session('success')): ?>
                <div class="alert alert-success"><?php echo e(session('success')); ?></div>
            <?php endif; ?>

            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul style="padding-left: 20px; margin: 0;">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?php echo e(route('client.contacts.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="text" name="name" placeholder="Họ và tên" value="<?php echo e(old('name')); ?>" required>
                <input type="email" name="email" placeholder="Email" value="<?php echo e(old('email')); ?>" required>
                <input type="text" name="phone" placeholder="Số điện thoại" value="<?php echo e(old('phone')); ?>" required>
                <input type="text" name="subject" placeholder="Tiêu đề" value="<?php echo e(old('subject')); ?>" required>
                <textarea name="message" rows="5" placeholder="Nội dung" required><?php echo e(old('message')); ?></textarea>
                <button type="submit">Gửi liên hệ</button>
            </form>
        </div>
    </div>

    <!-- Google Map (Bootstrap version) -->
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10">
                <div class="ratio ratio-16x9 shadow rounded overflow-hidden">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.8696332824456!2d105.74354717695266!3d21.037901680613814!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313454962c0b6523%3A0x5c76c67564d9d1b9!2zUC4gVHLhu4tuaCBWxINuIELDtCwgSMOgIE7hu5lpLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1751276539822!5m2!1svi!2s"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Du_an_thu_tap\Du_an_thu_tap\resources\views/client/contacts/formcontact.blade.php ENDPATH**/ ?>