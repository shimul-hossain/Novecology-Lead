
<?php $__env->startSection('content'); ?>


<?php echo $__env->make('includes.inner_page_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Sub Banner Section -->
<section class="sub-banner">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="section-header text-center">
					<h1 class="section-header__title section-header__title--lg">
						<strong class="font-weight-bold d-block">404</strong>
						Page Not Found
					</h1>
				</div>
			</div>
		</div>
	</div>
</section>

<?php echo $__env->make('includes.footer_contact', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\user\Desktop\SoClose\V2-Novecology-Lead\resources\views/errors/404.blade.php ENDPATH**/ ?>