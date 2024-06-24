@extends('layouts.frontend')

@section('adviceGrants')
active
@endsection


@section('content')

@include('includes.inner_page_menu')



	<!-- Sub Banner Section -->
	{{-- <section class="sub-banner pb-0">
		<div class="container">
			<div class="row">
				<div class="col-12 text-center">
					<p>Financez vos travaux d'isolation</p>
					<h1 class="sub-banner__title mb-0 font-weight-light">Conseils & subventions</h1>
				</div>
			</div>
		</div>
	</section> --}}

	<!-- Advice & Grants Section -->
	<section class="advice section-gap overflow-hidden">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<ul class="filter__nav nav justify-content-center mb-4">

                        <li class="nav-item">
							<button class="filter__nav__btn border-0 rounded-pill active" data-filter="*">All</button>
						</li>
                        @foreach ($categories as $item)
						<li class="nav-item">
							<button class="filter__nav__btn border-0 rounded-pill" data-filter=".category{{$item->id}}">{{ $item->category_name }}</button>
						</li>
                        @endforeach
					</ul>
				</div>
			</div>
			<div class="blogs__container row grid">



                @foreach ($categories as $category)
                   @foreach (adviceCategory($category->id) as $item)
                   <div class="grid-item blogs__slide col-lg-4 col-md-6 category{{$category->id}}">
                       <div class="blogs__card blogs__card--highlight d-flex flex-column h-100">
                           <div class="blogs__card__head d-flex position-relative">
                               <a href="{{route('advice.details',$item->id)}}" class="blogs__card__link d-inline-block">
                                   <img src="{{ asset('uploads/our_advice')}}/{{$item->thumbnail}}" alt="blogs image" class="blogs__card__image w-100" loading="lazy">
                               </a>
                               <span class="tag-btn d-inline-block text-white position-absolute rounded-pill">{{ $item->getCategory->category_name}}</span>
                           </div>
                           <div class="blogs__card__body h-100">
                               <h3 class="blogs__card__title mb-0">
                                   <a href="{{route('advice.details',$item->id)}}" class="d-inline-block">{{$item->title}}</a>
                               </h3>
                           </div>
                       </div>
                   </div>
                   @endforeach
                @endforeach
			</div>
		</div>
	</section>



@include('includes.footer_contact')
@include('includes.simulate_project_modal')


@include('includes.contact_modal')

@endsection

@section('js')
<script src="{{ asset('frontend_assets/plugins/isotope/js/isotope.min.js')}}"></script>

<script>

    (function ($) {
			"use strict";

			$(window).on("load", function () {
				isotopeInit();

			});

			/* Isotope Init */
			function isotopeInit() {
				$(".grid").isotope({
					itemSelector: ".grid-item",
					layoutMode: "fitRows",
					masonry: {
						isFitWidth: true
					}
				});

				// filter items on button click
				$(".filter__nav__btn").on("click", function () {
					var filterValue = $(this).attr("data-filter");
					$(".grid").isotope({ filter: filterValue });

					// Toggle active class on button click
					$(".filter__nav__btn").removeClass("active");
					$(this).addClass("active");
				});
			}

		})(jQuery);
</script>


@endsection
