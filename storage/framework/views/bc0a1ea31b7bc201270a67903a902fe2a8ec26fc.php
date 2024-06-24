<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Site Meta Data -->
    <meta name="description" content="Novecology is a dashboard website">
    <meta name="keywords" content="dashboard, Novecology">
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
	<!-- Site Title -->
	<title> Sign-in | <?php echo e(config('app.name')); ?></title>
	<!-- Favicon Link -->
	<link rel="icon" type="image/png" sizes="512x512" href="<?php echo e(asset('uploads/favicon')); ?>/<?php echo e(favicon()->image); ?>">
	<link rel="icon" type="image/png" sizes="192x192" href="<?php echo e(asset('uploads/favicon')); ?>/<?php echo e(favicon()->image); ?>">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(asset('uploads/favicon')); ?>/<?php echo e(favicon()->image); ?>">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('uploads/favicon')); ?>/<?php echo e(favicon()->image); ?>">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('uploads/favicon')); ?>/<?php echo e(favicon()->image); ?>">
	<link rel="icon" type="image/x-icon" href="<?php echo e(asset('uploads/favicon')); ?>/<?php echo e(favicon()->image); ?>">
	<!-- All CSS -->
	<link rel="stylesheet" href="<?php echo e(asset('crm_assets/assets/plugins/bootstrap/css/bootstrap.min.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('crm_assets/assets/plugins/fontawesome/css/all.min.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('crm_assets/assets/plugins/nice-select/css/nice-select.min.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('crm_assets/assets/plugins/select2/css/select2.min.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('crm_assets/assets/plugins/flatpickr/css/flatpickr.min.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('crm_assets/assets/plugins/simplebar/css/simplebar.css')); ?>">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
	<?php echo $__env->yieldPushContent('plugins-link'); ?>
	
	<link rel="stylesheet" href="<?php echo e(asset('crm_assets/assets/css/style.css')); ?>">
    <?php echo $__env->yieldContent('internal-css'); ?>
</head>
<body class="<?php echo $__env->yieldContent('bodyBg'); ?>">
	<!-- Preloader Section -->
	<div class="preloader position-fixed w-100 h-100">
		<div class="preloader__wrapper d-flex align-items-center justify-content-center w-100 h-100">
			<svg class="preloader__icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
				<path class="preloader__icon__path" fill="currentColor" d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
				<animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 50 50" to="360 50 50" repeatCount="indefinite" />
				</path>
			</svg>
		</div>
	</div>
	<main class="page-wrapper">
		<!-- Header Section -->
    <?php echo $__env->yieldContent('login'); ?>

<?php echo $__env->make('includes.crm.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\Users\user\Desktop\SoClose\V2-Novecology-Lead\resources\views/includes/crm/login-header.blade.php ENDPATH**/ ?>