	<!-- Advice & Grants Section -->
	<section class="advice section-gap">
	    <div class="container">
	        <div class="row">
	            <div class="col-md-8">
	                <div class="section-header text-center text-md-left">
	                    <h1 class="section-header__title section-header__title--md mb-md-5">Conseils & Subventions</h1>
	                </div>
	            </div>
	            {{-- <div class="col-md-4 text-center text-md-right mb-4 mb-md-0">
	                <a href="#!" class="primary-btn d-inline-block rounded-pill">Lire nos conseils</a>
	            </div> --}}
	        </div>
            {{-- blogs__slider--hidden-arrows --}}
	        <div class="blogs__slider row">
	            @foreach ($advices as $item)
	            <div class="blogs__slide col-lg-4 col-md-6">
	                <div class="blogs__card d-flex flex-column">
	                    <div class="blogs__card__head d-flex position-relative">
	                        <a href="{{route('advice.details',$item->id)}}" class="blogs__card__link d-block w-100">
	                            <img src="{{ asset('uploads/our_advice')}}/{{$item->thumbnail}}" alt="Thumbnail" class="blogs__card__image w-100" loading="lazy">
	                        </a>
	                        {{-- <span class="blogs__card__date position-absolute text-white font-weight-bold">{{$item->created_at->format('d/m/y')}}</span> --}}
	                        {{-- <a href="{{route('advice.details',$item->id)}}"
	                        class="tag-btn d-inline-block text-white position-absolute rounded-pill">{{$item->title}}</a>
	                        --}}
	                    </div>
	                    <div class="blogs__card__body h-100">
	                        <h3 class="blogs__card__title mb-0">
	                            <a href="{{route('advice.details',$item->id)}}" class="d-inline-block">{{$item->title}}</a>
	                        </h3>
	                    </div>
	                </div>
	            </div>
	            @endforeach
	        </div>
	    </div>
	</section>
