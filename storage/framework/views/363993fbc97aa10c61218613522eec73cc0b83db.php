	<!-- Footer Section -->
	<footer class="footer">
        <div class="footer__top section-gap pb-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <a class="footer__logo d-inline-block" href="<?php echo e(url('/')); ?>">
                            <img src="<?php echo e(asset('frontend_assets/images/logo/logo.png')); ?>" alt="logo" class="w-100">
                        </a>
                        <ul class="footer__block__list">
                            <li class="footer__block__list__item">
                                <span class="footer__block__list__link">
                                    <strong>RCS :</strong>  849 947 809
                                </span>
                            </li>
                            <li class="footer__block__list__item">
                                <span class="footer__block__list__link">
                                    <strong>TVA :</strong> FR74 849 947 809
                                </span>
                            </li>
                            <li class="footer__block__list__item">
                                <span class="footer__block__list__link">
                                    – 2 Rue du Prè des Aulnes 77340 Pontault-Combault
                                </span>
                            </li>
                            <li class="footer__block__list__item">
                                <span class="footer__block__list__link">
                                    – 01 87 66 57 30
                                </span>
                            </li>
                            <li class="footer__block__list__item">
                                <span class="footer__block__list__link">
                                    – support@novecology.fr SAS au capital de 10 000€
                                </span>
                            </li>
                            <li class="footer__block__list__item">
                                <span class="footer__block__list__link">
                                    - SIRET 849 947 809 00026
                                </span>
                            </li>
                            <li class="footer__block__list__item">
                                <span class="footer__block__list__link">
                                    - APE / NAF 4322B
                                </span>
                            </li>
                            <li class="footer__block__list__item">
                                <span class="footer__block__list__link">
                                    – TVA FR74 849 947 809
                                </span>
                            </li>
                            <li class="footer__block__list__item">
                                <span class="footer__block__list__link">
                                    - RGE E-E179070 Assurance de responsabilité décennale n°190671339S, souscrite auprès de MIC INSURANCE numéro ORIAS 10056191
                                </span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer__block">
                            <h3 class="footer__block__title text-uppercase"><?php echo e(getFooter()->first_column); ?></h3>
                            <ul class="footer__block__list mb-5">
                                <li class="footer__block__list__item">
                                    <a href="<?php echo e(route('frontend.society')); ?>" class="footer__block__list__link">Notre société</a>
                                </li>
                                <li class="footer__block__list__item">
                                    <a href="<?php echo e(route('frontend.ourService')); ?>" class="footer__block__list__link">Notre service</a>
                                </li>
                                <li class="footer__block__list__item">
                                    <a href="<?php echo e(route('frontend.ourContact')); ?>" class="footer__block__list__link">Nous contacter</a>
                                </li>
                                <li class="footer__block__list__item">
                                    <a href="/sitemap.xml" target="_blank" class="footer__block__list__link">Sitemap</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer__block">
                            <h3 class="footer__block__title text-uppercase"><?php echo e(getFooter()->second_column); ?></h3>
                            <ul class="footer__block__list mb-5">
                                <?php $__currentLoopData = getSolution(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                   <li class="footer__block__list__item">
                                       <a href="<?php echo e(route('ourSolution.details',$item->id)); ?>" class="footer__block__list__link"><?php echo e($item->title); ?></a>
                                   </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer__block">
                            <h3 class="footer__block__title text-uppercase"><?php echo e(getFooter()->third_column); ?></h3>
                            <ul class="footer__block__list mb-5">
                                <?php $__currentLoopData = getFooterColumn3(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <li class="footer__block__list__item">
                                    <a href="<?php echo e(route('advice.details',$item->id)); ?>" class="footer__block__list__link"><?php echo e($item->title); ?></a>
                                 </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ul class="footer__block__list">
                            <?php $__currentLoopData = getExtraPage(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="footer__block__list__item">
                                    <a href="<?php echo e(route('more.pages',$item->slug)); ?>" class="footer__block__list__link"><?php echo e($item->title); ?></a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <h3 class="footer__block__title text-uppercase">Abonnez-vous à notre newsletter</h3>
                        <form id="reset_form" class="footer__form form-inline position-relative">
                            <input id="email" name="email" class="form-control flex-grow-1 shadow-none h-100" type="email" placeholder="E-mail" required>
                            <button id="submit" class="gradient-btn--secondary position-absolute d-inline-block border-0 text-uppercase" type="submit">S'abonner</button>
                        </form>
                        <span class="text-success" id="succ"></span>
                        <span class="text-danger" id="errorResponse"></span>
                        <div class="mt-3">
                            <ul class="social-nav nav mt-3 mt-xl-0 mr-xl-auto">
                                <?php $__currentLoopData = social(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="nav-list">
                                        <a href="<?php echo e($item->link); ?>" class="social-nav__link d-inline-block">
                                            <?php echo $item->icon; ?>

                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__bottom py-3">
            <div class="container text-center">
                <p class="footer__copyright mb-0">
                    <span class="d-block"><?php echo getFooter()->copyright; ?></span>
                </p>
            </div>
        </div>
	</footer>

    

    <a href="<?php echo e(route('frontend.chatbot')); ?>" class="chat-btn">
        <img src="<?php echo e(asset('frontend_assets/images/chatbot-icon.png')); ?>" width="40" alt="chat" class="chat-btn__image" loading="lazy">
        <span class="chat-btn__card">Calculer vos aides énergétiques ?</span>
    </a>

	<!-- Cookies Section -->
	<?php if(getCookie() && getCookie()->cookie_status == 'allow'): ?>
	<?php else: ?>
		<div class="cookies position-fixed">
			<div class="cookies-content d-flex flex-wrap align-items-center w-100 h-100">
				<div class="cookies__icon d-flex align-items-center justify-content-center rounded-circle">
					<img src="<?php echo e(asset('frontend_assets/images/icons/cookie-image.png')); ?>" alt="cookies-image" class="cookies__icon__image w-100" loading="lazy">
				</div>
				<div class="cookies__main">
					<p class="cookies__text mb-0">We use cookies to make your experience better.</p>
				</div>
				<div class="cookies__button-wrapper">
					<button class="cookies__button cookies__button--allow" data-value="allow">Allow</button>
					<button class="cookies__button cookies__button--decline" data-value="decline">Decline</button>
				</div>
			</div>
		</div>
	<?php endif; ?>


	<!-- All Scripts -->
	<script src="<?php echo e(asset('frontend_assets/js/jquery-1.12.4.min.js')); ?>"></script>
	<script src="<?php echo e(asset('frontend_assets/plugins/bootstrap/js/bootstrap.min.js')); ?>" defer></script>
	<script src="<?php echo e(asset('frontend_assets/plugins/slick-slider/js/slick.js')); ?>" defer></script>
	<script src="<?php echo e(asset('frontend_assets/plugins/fontawesome/js/all.min.js')); ?>" defer></script>
	<?php echo $__env->yieldContent('plugin-js'); ?>
	<script src="<?php echo e(asset('frontend_assets/js/script.js')); ?>" defer></script>
	<script defer>
		/* Document on load functions */
		$(window).on('load', function () {
			/* Show Cookies Function */
			setTimeout(function(){
				$(".cookies").addClass("show");
			},1500);
		});

        $(window).ready(function(){
            setTimeout(function(){
				$(".chat-btn").addClass("active");
			},5000);
        })

		/* Document on Ready functions */
		$(document).ready(function(){
			/* Hide Cookies Function */
			// $(".cookies__button").on("click", function(){
			// 	setTimeout(function(){
			// 		$(".cookies").removeClass("show");
			// 	},1000);
			// });

			$(".cookies__button").on("click", function(){
				var data = $(this).attr('data-value');
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
					url :  "<?php echo e(route('cookie.store')); ?>",
					type : "POST",
					data : {
						data : data
					},
					success : function(data){
						setTimeout(function(){
							$(".cookies").removeClass("show");
						},1000)
						console.log(data);
					}
				});
			});
		});


		$(document).ready(function(){
			$('#submit').click(function(e)
			{
				e.preventDefault();
				let email= $('#email').val();

				$.ajaxSetup({
					headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});

				$.ajax({
					type: "POST",
					url: "<?php echo e(route('subscribe.store')); ?>",
					data: {
						email:email,
					},

					success: function (data) {
						$('#reset_form')[0].reset();
                        $('#errorResponse').text('');
				        $("#succ").html('Abonnez-vous avec succès !! Merci');
					},
                    error : errors => {
                        $('#succ').text('');
                        $('#errorResponse').text(errors.responseJSON.errors.email);
                    }
				});

			});
		});
	</script>
	<?php echo $__env->yieldContent('js'); ?>
	<?php echo $__env->yieldPushContent('custom-script'); ?>
	</body>

	</html>
<?php /**PATH C:\Users\user\Desktop\SoClose\V2-Novecology-Lead\resources\views/includes/frontend_footer.blade.php ENDPATH**/ ?>