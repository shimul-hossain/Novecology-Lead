{{-- Title part  --}}
@section('title')
 {{ __('Home') }}
@endsection

@push('plugins-link')
<link rel="stylesheet" href="{{ asset('crm_assets/assets/plugins/leaflet-map/css/geocoder.css') }}">
@endpush

@include('includes.crm.header')
{{-- @include('includes.crm.navbar') --}}

		<header class="header w-100 position-fixed bg-white">
			<nav class="navbar navbar-expand-xxl">
				<div class="container">
					<a class="navbar-brand brand-logo d-block custom-focus py-0" href="{{ route('dashboard.analytic') }}">
						<img  loading="lazy"  src="https://novecology.fr/frontend_assets/images/logo/logo.png" alt="logo">
					</a>

					<div class="navbar-account ml-auto">
						<ul class="navbar-account__nav nav align-items-center text-center">
							{{-- @include('includes.crm.language-switcher') --}}
							<li class="nav-item dropdown">
								<a class="navbar-account__link dropdown-toggle d-flex align-items-center" href="/me/" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    @if ($user->profile_photo)
									<img  loading="lazy"  src="{{ asset('uploads/crm/profiles') }}/{{ $user->profile_photo }}" alt="user image" class="navbar-account__user--avator rounded-circle"> 
                                    @else
									<img  loading="lazy"  src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="user image" class="navbar-account__user--avator rounded-circle">
                                    @endif
									<p class="navbar-account__user--name mb-0">{{ $user->name }}</p>
									<span class="novecologie-icon-chevron-down dropdown-icon"></span>
								</a> 
                                <div class="dropdown-menu bg-white border-0 dropdown-menu-right" aria-labelledby="navbarDropdown">
									 
									<a class="dropdown-item" href="{{ route('profile.index') }}">
                                        <span class="novecologie-icon-user dropdown-menu__icon mr-2"></span>
                                        {{ __('Profile') }}
                                    </a> 
									@if(getRegisterPage()) 
										<a class="dropdown-item" href="{{ route(getRegisterPage()->route) }}">
											<span class="novecologie-icon-user-plus dropdown-menu__icon mr-2"></span>
											{{ getRegisterPage()->name }}
										</a>  
									@endif  
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <a onclick="event.preventDefault();this.closest('form').submit();" class="dropdown-item" href="#">
                                            <span class="novecologie-icon-log-out dropdown-menu__icon mr-2"></span>
                                            {{ __('Log Out') }}
                                        </a>
                                    </form>
                                </div>
							</li>
						</ul>
					</div>
				</div>
			</nav>
		</header>

		<!-- Banner Section -->
		<section class="banner section-gap position-relative">
			<div class="container">
				{{-- <a href="./sign-in.html" class="back-btn d-inline-block p-2"><span class="novecologie-icon-arrow-left"></span></a> --}}
				<div class="row justify-content-center">
					<div class="col-lg-7">
						<div  id="banner__card__slider" class="banner__card d-flex align-items-center position-relative bg-white px-lg-5">
							<div class="banner__card__slide banner__card__slide--one w-100 text-center flex-shrink-0">
								<form action="#" class="form mx-auto text-center" id="company-find-form">
									<div class="banner__card__user-avatar rounded-circle overflow-hidden mx-auto">
									  @if ($user->profile_photo)
										<img  loading="lazy"  src="{{ asset('uploads/crm/profiles') }}/{{ $user->profile_photo }}" alt="User Image" class="w-100 h-100">   
										@else 
										<img  loading="lazy"  src="{{ asset('crm_assets/assets/images/user/user-image.png') }}" alt="User Image" class="w-100 h-100">
										@endif
									</div>
								  
									<h1 class="form__title position-relative text-center my-4">
										<span class="form__title__inner font-weight-light">{{ __('Hello') }}</span> {{ $user->name }}
									</h1>
									<p class="form__text mb-4">{{ __('Welcome') }} @isset($message) {{ $message }} @endisset, {{ __('please choose a company') }} 
									<div class="form-group d-flex flex-column align-items-center position-relative">
										<input type="search" name="search" class="form-control form-control--filled shadow-none rounded-pill" id="search" placeholder="{{ __('Find a company') }}">
									</div>
									<div class="form-btn__wrapper d-flex flex-wrap align-items-center justify-content-center mt-4">
										@if(getCreateCompany()) 
											<div class="text-center w-100">
												<button type="button" id="bannerSliderToggler" class="primary-btn primary-btn--black primary-btn--lg fix-btn-width rounded-pill d-inline-flex align-items-center justify-content-center border-0">
													{{ getCreateCompany()->name }}
													<span class="novecologie-icon-arrow-right ml-3"></span>
												</button>
											</div>
										@endif    
										<div id="firstLink" class="form-btn__wrapper d-flex flex-wrap align-items-center justify-content-center w-100">
											@include('includes.crm.company-list')  
										</div>
											
									</div>
	
									<div id="loadMoreBtnDiv" class="mt-3 text-center w-100 @if ($totalCompany->count() < 10)
										d-none
									@endif">
										<a href="#" id="loadMoreBtn" class="secondary-btn primary-btn--lg fix-btn-width rounded-pill d-inline-flex align-items-center justify-content-center border-0 d-block">
										{{ __('Load More') }}
										<span class="novecologie-icon-arrow-right ml-3"></span>
										</a>  
									</div>  
									<p id="noresult" class="text-center mt-3"></p>
								</form>
							</div>
							<div class="banner__card__slide banner__card__slide--two w-100 bg-white px-lg-5 flex-shrink-0">
								<button type="button" id="bannerSliderBack" class="next-btn d-inline-block rounded border-0">
									<span class="novecologie-icon-chevron-left"></span>
								</button>
								<h1 class="form__title position-relative text-center my-sm-4">{{ __('Start a new business') }}</h1>
								<form action="{{ route('company.add') }}" class="form" method="POST" id="addCompanyForm">
									@csrf
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="company_name" class="form-label">{{ __('Company Name') }} <span class="text-danger">*</span></label>
												<input type="text" id="company_name" name="company_name" class="form-control shadow-none px-3">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="company_title" class="form-label">{{ __('Company Title') }} <span class="text-danger">*</span></label>
												<input type="text" id="company_title" name="company_title" class="form-control shadow-none px-3">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="company_email" class="form-label">{{ __('Company Email') }} <span class="text-danger">*</span></label>
												<input type="email" id="company_email" name="company_email" class="form-control shadow-none px-3">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="company_phone" class="form-label">{{ __('Company Phone') }} <span class="text-danger">*</span></label>
												<input type="number" id="company_phone" name="company_phone" class="form-control shadow-none px-3">
											</div>
										</div>
										<div class="col-12">
											<div class="form-group">
												<label for="company_address" class="form-label">{{ __('Company Address') }} <span class="text-danger">*</span></label>
												<div id="geocoder"></div>
												<input type="hidden" name="setAddressLatValue" id="setAddressLatValue" placeholder="Address Lat Value">
												<input type="hidden" name="setAddressLngValue" id="setAddressLngValue" placeholder="Address Lng Value">
												<input type="hidden" name="setAddressName" id="setAddressName" placeholder="Address Name">
											</div>
										</div>
										<div class="col-12 text-center mt-3">
											<button id="newCompanyForm" type="submit" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2">{{ __('Start') }}</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section> 
		 
  <!-- Modal -->
  {{-- <div class="modal fade startNewLeadModal" id="startNewLeadModal" tabindex="-1" aria-labelledby="startNewLeadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="startNewLeadModalLabel">{{ __('Start a new business') }}</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('company.add') }}" class="form" method="POST" id="addCompanyForm">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <input type="text" id="company_name" name="company_name" class="form-control shadow-none" placeholder="{{ __('Company Name') }}">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <input type="text" id="company_title" name="company_title" class="form-control shadow-none" placeholder="{{ __('Company Title in English') }}">
                        </div>
                    </div> 
                    <div class="col-12">
                        <div class="form-group">
                            <input type="email" id="company_email" name="company_email" class="form-control shadow-none" placeholder="{{ __('Company Email') }}">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <input type="text" id="company_phone" name="company_phone" class="form-control shadow-none" placeholder="{{ __('Company Phone') }} ">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <input type="text" id="company_address" name="company_address" class="form-control shadow-none" placeholder="{{ __('Company Address') }}">
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button id="newCompanyForm" type="submit" data-toggle="collapse" data-target="#leadCardCollapse-2" aria-expanded="false" aria-controls="leadCardCollapse-2" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0">
                            {{ __('Start') }} <span class="novecologie-icon-arrow-right ml-3"></span>
                        </button>
                    </div>
                </div>
            </form>
        </div> 
      </div>
    </div>
  </div>  --}}
@include('includes.crm.footer-contact')

@push('plugins-script')
<script src="{{ asset('crm_assets/assets/plugins/leaflet-map/js/mapbox-gl.js') }}"></script>
<script src="{{ asset('crm_assets/assets/plugins/leaflet-map/js/mapbox-gl-geocoder.min.js') }}"></script>
@endpush

@include('includes.crm.footer')
 <script>
	    // btn.hide();
		$('#loadMoreBtn').click(function(e){
			e.preventDefault();
			var btn = $('#firstLink a.companyBtn');
			var btnLenght = btn.length;
			var count = "{{ $totalCompany->count() }}";
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			}); 
			$.ajax({
				type: "POST", 
				url: "{{ route('company.loadmore') }}",
				data: {
					length:btnLenght,
				}, 
				success:function(data){
					$('#firstLink').html(data.response);  

					if(count <= data.current_count) 
					{ 
						$("#loadMoreBtnDiv").addClass('d-none'); 
						$("#noresult").html("{{ __('No more company to show....') }}");
					} 
				} 
			}); 
		}); 
		// form card toggler
		$("#bannerSliderToggler").on("click", function(){
			$("#banner__card__slider").addClass("active");
		});
		$("#bannerSliderBack").on("click", function(){
			$("#banner__card__slider").removeClass("active");
		});
		(function(){
			mapboxgl.accessToken = 'pk.eyJ1IjoiZGV2ZWxvcGVyLXphaGlkIiwiYSI6ImNreDY3Ym93aDBuOXEycHF1Mjc2N3cxY2wifQ.9EyRPzKr0dB9bWghzGNK-g';
				const geocoder = new MapboxGeocoder({
				accessToken: mapboxgl.accessToken,
				types: 'country,region,place,postcode,locality,neighborhood'
			});
			geocoder.addTo('#geocoder');
			geocoder.on('result', function(e) {
				$('#setAddressLatValue').val(e.result.center[1]);
				$('#setAddressLngValue').val(e.result.center[0]);
				$('#setAddressName').val(e.result.text);
			});
			geocoder.on('clear', function() {
				$('#setAddressLatValue').val("");
				$('#setAddressLngValue').val("");
				$('#setAddressName').val("");
			});
		})();
		$(document).ready(function(){
			$(".mapboxgl-ctrl-geocoder").addClass("dropdown");
			$(".mapboxgl-ctrl-geocoder--input").addClass("dropdown-toggle");
			$(".mapboxgl-ctrl-geocoder--input").attr({
				id: "company_address",
				name: "company_address",
				autocomplete: "off",
				"data-toggle":"dropdown",
				"aria-haspopup":"true",
				"aria-expanded":"false",
				"data-offset":"0, 10"
			});
			$(".mapboxgl-ctrl-geocoder--input").keydown(function(){
				$(this).dropdown('show');
			});
			$(".mapboxgl-ctrl-geocoder--input").blur(function(){
				$(this).dropdown('hide');
			});
			$(".mapboxgl-ctrl-geocoder .suggestions-wrapper .suggestions").addClass("dropdown-menu");
			$(".mapboxgl-ctrl-geocoder .suggestions-wrapper .suggestions").attr("aria-labelledby","company_address");
		});

		$(document).ready(function(){
			// search company 
			$('#search').on("input", function(){
				var search = $(this).val();
				if(search == ''){
					$('#firstLink').html('')
				
				}
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});

				$.ajax({
					type: "POST", 
					url: "{{ route('company.search') }}",
					data: {
						search:search
					}, 
					success:function(data){
						$('#firstLink').html(data.response); 
						$("#loadMoreBtnDiv").addClass('d-none'); 
					} 
				});
			});
			//  validate company form 
			$('#newCompanyForm').click(function(e){

				e.preventDefault();
					var name = $('#company_name');
					var title = $('#company_title');
					var title_fr = $('#company_title_fr');
					var email = $('#company_email');
					var phone = $('#company_phone');
					var address = $('#company_address');
					var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;


					if(name.val() == ''){
						$('#errorMessage').text("{{ __('Name Field is Required') }}");
						$('.toast.toast--error').toast('show');
						name.focus();
					}
					else if(title.val() == ''){
						$('#errorMessage').text("{{ __('Title Field is Required') }}");
						$('.toast.toast--error').toast('show');
						title.focus();
					}
					else if(title_fr.val() == ''){
						$('#errorMessage').text("{{ __('Title Field is Required') }}");
						$('.toast.toast--error').toast('show');
						title_fr.focus();
					}
					else if(email.val() == ''){
						$('#errorMessage').text("{{ __('Email Field is Required') }}");
						$('.toast.toast--error').toast('show');
						email.focus();
					}
					else if(!regex.test(email.val())){
						$('#errorMessage').text("{{ __('Email Must be Validate') }}");
						$('.toast.toast--error').toast('show');
						email.focus();
					} 
				
					else if(phone.val() == ''){
						$('#errorMessage').text("{{ __('Phone Field is Required') }}");
						$('.toast.toast--error').toast('show');
						phone.focus();
					}
				
					else if(address.val() == ''){
						$('#errorMessage').text("{{ __('Address Field is Required') }}");
						$('.toast.toast--error').toast('show');
						address.focus();
					}
					else{
						$('#addCompanyForm').submit();
					}
				

			});
		}); 
 </script>



