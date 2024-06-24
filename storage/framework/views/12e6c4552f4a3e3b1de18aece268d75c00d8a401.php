

<?php $__env->startSection('internal-css'); ?>
    <style>
        .btn--match-width{
            width: 100%;
            max-width: 185px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('login'); ?>


<!-- Banner Section -->

<section class="layout--row secondary-bg">
    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-lg-8 col-md-6 d-none d-md-block">
                <div class="d-flex align-items-center justify-content-center h-100">
                    <img src="<?php echo e(asset('crm_assets/assets/images/noveco-login.png')); ?>" alt="login image" draggable="false" loading="lazy" class="img-fluid">
                </div>
            </div>
            <div class="col-lg-4 col-md-6 d-flex align-items-center justify-content-center bg-white">
                <form action="<?php echo e(route('login')); ?>" class="form mx-auto needs-validation w-100 py-5" id="login-form" method="POST" novalidate>
                    <?php echo csrf_field(); ?>
                    <h1 class="form__title position-relative text-center"><?php echo e(__('Log in')); ?></h1>
                    <div class="form-group d-flex flex-column align-items-center position-relative">
                        <input type="email" name="email" class="form-control shadow-none" placeholder="<?php echo e(__('Your username')); ?>" required>
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <small class="text-danger"><?php echo e($message); ?></small>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <div class="invalid-feedback"><?php echo e(__('This field is necessary')); ?></div>
                    </div>
                    <div class="form-group d-flex flex-column align-items-center position-relative">
                        <input type="password" name="password" class="form-control form-control--password shadow-none" placeholder="<?php echo e(__('Password')); ?>" required>
                        
                        <button type="button" class="form-group__password-toggler position-absolute bg-transparent border-0">
                            <span class="password-toggler__icon novecologie-icon-eye"></span>
                        </button>
                        <div class="invalid-feedback"><?php echo e(__('This field is necessary')); ?></div>
                    </div>
                    <div class="form-group d-flex flex-column align-items-center mt-4">
                        <button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill border-0 mb-3 btn--match-width"><?php echo e(__('Log in')); ?></button>
                        <a href="<?php echo e(url('forgot-password')); ?>" class="primary-btn primary-btn--transparent primary-btn--lg rounded-pill btn--match-width"><?php echo e(__('Forgot your password')); ?></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('includes.crm.login-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\user\Desktop\SoClose\V2-Novecology-Lead\resources\views/auth/login.blade.php ENDPATH**/ ?>