	<!-- Work Process Section -->
	<section class="process section-gap">
	    <div class="container">
	        <div class="row">
	            {{-- <div class="section-header text-center col-12">
	                 <h1 class="section-header__title section-header__title--lg mb-4">
	                    Vos travaux <strong>clé en main</strong>
	                    <small class="section-header__title__small d-block">AVEC</small>
	                </h1>
	                <a href="{{ url('/') }}" class="d-inline-block mb-3">
	                    <img src="{{asset('uploads/logo') }}/{{ logo()->image2}}" alt="logo" class="img-fluid">
	                </a>
	            </div> --}}

	            @foreach (workWith() as $item)
	            <div class="col-lg-4 mt-4">
	                <div class="process__block text-center">
	                    <div
	                        class="process__block__circle rounded-circle d-inline-flex align-items-center justify-content-center mb-3">
	                        <img class="rounded-circle" src="{{ asset('uploads/workwith')}}/{{ $item->image }}" alt="icon" width="70" loading="lazy">
	                    </div>
	                    <h2 class="process__block__title mb-4">
	                        <strong class="d-block">{{ $item->title }}</strong>
	                    </h2>
	                    <p class="process__block__text">{{ $item->details }}</p>
	                </div>
	            </div>
	            @endforeach
	        </div>
	    </div>
	</section>
