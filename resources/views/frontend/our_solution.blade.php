@extends('layouts.frontend')

@section('ourSolutions')
active
@endsection

@section('content')
    @include('includes.inner_page_menu')
	<!-- Advice & Grants Section -->
	<section class="advice section-gap">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section-header text-center">
						<h1 class="section-header__title section-header__title--md font-weight-bold mb-5">Nos services pour les particuliers</h1>
					</div>
				</div>
			</div>
			<div class="blogs__container row">
                @foreach ( $ourSolution_particular as $item)
				<div class="blogs__slide col-lg-4 col-md-6">
					<div class="blogs__card blogs__card--highlight d-flex flex-column h-100">
						<div class="blogs__card__head position-relative">
							<a href="{{route('ourSolution.details',$item->id)}}" class="blogs__card__link d-block">
								<img src="{{ asset('uploads/our_solution')}}/{{$item->image}}" alt="blogs image" class="blogs__card__image w-100" loading="lazy">
							</a>
							<a href="{{route('ourSolution.details',$item->id)}}" class="tag-btn d-inline-block text-white position-absolute rounded-pill">Services pour particuliers</a>
						</div>
						<div class="blogs__card__body h-100">
							<h3 class="blogs__card__title mb-0">
								<a href="{{route('ourSolution.details',$item->id)}}" class="d-inline-block">{{$item->title}}</a>
							</h3>
						</div>
					</div>
				</div>
                @endforeach
			</div>
			<div class="row mt-5">
				<div class="col-12">
					<div class="section-header text-center">
						<h2 class="section-header__title section-header__title--md font-weight-bold mb-5">Nos services pour les professionnels</h2>
					</div>
				</div>
			</div>
			<div class="blogs__container row">
				@foreach ( $ourSolution_professional as $item)
				<div class="blogs__slide col-lg-4 col-md-6">
					<div class="blogs__card blogs__card--highlight d-flex flex-column h-100">
						<div class="blogs__card__head position-relative">
							<a href="{{route('ourSolution.details',$item->id)}}" class="blogs__card__link d-block">
								<img src="{{ asset('uploads/our_solution')}}/{{$item->image}}" alt="blogs image" class="blogs__card__image w-100" loading="lazy">
							</a>
							<a href="{{route('ourSolution.details',$item->id)}}" class="tag-btn d-inline-block text-white position-absolute rounded-pill {{ $loop->iteration % 2 ? '' : 'gradient-btn--secondary' }}">Services pour professionnels</a>
						</div>
						<div class="blogs__card__body h-100">
							<h3 class="blogs__card__title mb-0">
								<a href="{{route('ourSolution.details',$item->id)}}" class="d-inline-block">{{$item->title}}</a>
							</h3>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</section>

    @include('includes.footer_contact')
    @include('includes.simulate_project_modal')
    @include('includes.contact_modal')
@endsection
