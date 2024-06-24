<!-- Header Section -->
<header class="header header--fixed w-100">
    <nav class="navbar navbar-expand-xl py-0">
        <div class="container justify-content-center justify-content-xl-between">
            <a class="navbar-brand d-inline-block" href="<?php echo e(url('/')); ?>">
                
                <img src="<?php echo e(asset('frontend_assets/images/logo/logo.png')); ?>" alt="logo" class="navbar-brand__logo w-100" loading="lazy">
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <a href="<?php echo e(url('/')); ?>" class="d-inline-block d-xl-none navbar-collapse__logo mb-4">
                    <img src="<?php echo e(asset('frontend_assets/images/logo/logo.png')); ?>" alt="logo" class="w-100" loading="lazy">
                </a>
                <ul class="navbar-nav mx-xl-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php echo $__env->yieldContent('homePage'); ?>" href="<?php echo e(url('/')); ?>">Accueil</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link <?php echo $__env->yieldContent('ourSolutions'); ?>" href="<?php echo e(route('frontend.ourSolutions')); ?>">Nos services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $__env->yieldContent('adviceGrants'); ?>" href="<?php echo e(route('frontend.adviceGrants')); ?>">Conseils & subventions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $__env->yieldContent('testimonial'); ?>" href="<?php echo e(route('frontend.testimonial')); ?>">Témoignages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $__env->yieldContent('society'); ?>" href="<?php echo e(route('frontend.society')); ?>">A propos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $__env->yieldContent('contact'); ?>" href="<?php echo e(route('frontend.ourContact')); ?>">Contact</a>
                    </li>
                </ul>
                <ul class="btn-nav nav flex-column flex-xl-row mx-xl-2 my-3 my-xl-0">
                    <li class="nav-item">
                        <a href="tel:<?php echo e(getFooter()->phone); ?>" class="gradient-btn--secondary border-0 position-relative d-inline-block rounded-pill">
                            <i class="fas fa-phone-alt"></i> <?php echo e(getFooter()->phone); ?>

                        </a>
                    </li>
                    
                </ul>
                
            </div>
        </div>
    </nav>
</header>
<button class="navbar-toggler text-uppercase d-xl-none" type="button" data-toggle="collapse"
    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
    aria-label="Toggle navigation">
    <span class="navbar-toggler__wrapper d-flex align-items-center justify-content-center w-100 h-100">
        <span
            class="navbar-toggler__icon d-flex align-items-center justify-content-center position-relative flex-shrink-0"></span>
        <span class="navbar-toggler__text pl-3">Menu</span>
    </span>
</button>
<?php /**PATH C:\Users\user\Desktop\SoClose\V2-Novecology-Lead\resources\views/includes/inner_page_menu.blade.php ENDPATH**/ ?>