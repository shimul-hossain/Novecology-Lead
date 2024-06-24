{{-- Main Layouts --}}
@extends('layouts.master')

{{-- Title part  --}}
@section('title')
 	{{ __('Calendar') }}
@endsection

@section('bodyBg')
secondary-bg
@endsection

{{-- active menu  --}}
@section('savIndex')
active
@endsection

@push('plugins-link')
<style>
    /* Style marker popup window */
    /* .gm-style .gm-style-iw-c,
    .gm-style .gm-style-iw-tc::after
    {
        color: #ffffff;
        background-color: #9e95f5;
    } */
    .gm-ui-hover-effect > span {
        background-color: #FF0708;
    }

    /* Hide google map brand content */
    .gm-style-cc,
    .gm-style-mtc,
    .gm-svpc,
    a[title="Open this area in Google Maps (opens a new window)"][aria-label="Open this area in Google Maps (opens a new window)"],
    [aria-label] > div > [alt="Google"]
    {
        display: none !important;
    }
</style>
@endpush

@push('plugins-link')
<style>
	.calendar-filters{
		padding: 10px 20px;
    	background-color: #f2f3f8;
		border: 2px solid #eaecf1;
	}
	.calendar-filters .form-label {
		font-size: 12px;
	}

	h4{
        font-size: 16px;
        font-weight: bold;
    }

	@media (min-width: 1200px){
		.sticky-section{
			position: sticky;
			top: var(--header-height);
			z-index: 3;
		}
	}
</style>
@endpush


{{-- Main Content Part  --}}
@section('content')

<!-- Banner Section -->
<section class="py-4 position-relative">
	<div class="container">
		<div class="row bg-white pb-3 rounded-lg shadow-sm">
			<div class="col-12">
				<div class="sticky-section bg-white pt-3">
					<div class="planing-navigation text-center mb-2">
						<div class="btn-group">
							<a href="{{ route('calendar.index') }}" class="btn btn-outline-secondary">
								<svg width="1.3em" height="1.3em" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M14.3848 8.90625C13.7655 8.92224 13.177 9.17948 12.7446 9.62314C12.3123 10.0668 12.0703 10.6618 12.0703 11.2813C12.0703 11.9007 12.3123 12.4957 12.7446 12.9394C13.177 13.383 13.7655 13.6403 14.3848 13.6563C15.0041 13.6403 15.5926 13.383 16.0249 12.9394C16.4573 12.4957 16.6992 11.9007 16.6992 11.2813C16.6992 10.6618 16.4573 10.0668 16.0249 9.62314C15.5926 9.17948 15.0041 8.92224 14.3848 8.90625ZM14.3848 10.0938C14.5408 10.0938 14.6952 10.1246 14.8393 10.1843C14.9834 10.2441 15.1144 10.3316 15.2246 10.442C15.3349 10.5523 15.4224 10.6833 15.482 10.8274C15.5417 10.9716 15.5723 11.126 15.5723 11.282C15.5722 11.438 15.5414 11.5925 15.4817 11.7366C15.422 11.8807 15.3344 12.0116 15.2241 12.1219C15.1137 12.2322 14.9827 12.3196 14.8386 12.3793C14.6945 12.4389 14.54 12.4696 14.384 12.4695C14.0689 12.4694 13.7668 12.3442 13.5441 12.1213C13.3214 11.8985 13.1964 11.5963 13.1965 11.2813C13.1966 10.9662 13.3218 10.6641 13.5447 10.4414C13.7675 10.2187 14.0697 10.0936 14.3848 10.0938Z" fill="currentColor"/>
									<path d="M12.1326 18.0111C13.3359 18.0111 15.4362 18.0111 16.6395 18.0008C16.8606 17.9999 17.0783 17.9458 17.274 17.8429C17.4697 17.74 17.6378 17.5915 17.7638 17.4098C17.8899 17.2282 17.9704 17.0188 17.9983 16.7995C18.0263 16.5802 18.0009 16.3573 17.9244 16.1499C17.6629 15.4201 17.1824 14.789 16.5485 14.3427C15.9147 13.8965 15.1585 13.657 14.3833 13.6569C13.6076 13.6585 12.8512 13.8981 12.2161 14.3434C11.581 14.7886 11.0978 15.4181 10.8319 16.1467C10.7547 16.3562 10.7293 16.5812 10.7578 16.8026C10.7863 17.024 10.8679 17.2353 10.9956 17.4184C11.1234 17.6014 11.2935 17.751 11.4914 17.8542C11.6894 17.9574 11.9093 18.0112 12.1326 18.0111ZM12.1326 16.8236C12.1006 16.8236 12.0683 16.816 12.0399 16.8012C12.0116 16.7865 11.9872 16.7651 11.9689 16.7389C11.9507 16.7126 11.939 16.6824 11.935 16.6507C11.9309 16.619 11.9346 16.5867 11.9457 16.5568L11.9465 16.556C12.1287 16.0556 12.46 15.6231 12.8958 15.3171C13.3316 15.011 13.8508 14.846 14.3833 14.8444C15.5011 14.8444 16.4527 15.5585 16.8082 16.5544L16.8097 16.5607C16.8204 16.589 16.8239 16.6194 16.8201 16.6494C16.8162 16.6793 16.8051 16.7079 16.7876 16.7325C16.7705 16.7575 16.7475 16.7778 16.7208 16.7919C16.694 16.806 16.6642 16.8133 16.634 16.8133H16.6292C15.4283 16.8236 13.3327 16.8236 12.1326 16.8236ZM16.4258 7.12565V5.14648C16.4258 4.35912 16.113 3.60401 15.5563 3.04726C14.9995 2.49051 14.2444 2.17773 13.457 2.17773H3.95703C3.16967 2.17773 2.41456 2.49051 1.85781 3.04726C1.30106 3.60401 0.988281 4.35912 0.988281 5.14648V14.6465C0.988281 15.4338 1.30106 16.189 1.85781 16.7457C2.41456 17.3025 3.16967 17.6152 3.95703 17.6152H8.70703C8.8645 17.6152 9.01553 17.5527 9.12688 17.4413C9.23823 17.33 9.30078 17.179 9.30078 17.0215C9.30078 16.864 9.23823 16.713 9.12688 16.6016C9.01553 16.4903 8.8645 16.4277 8.70703 16.4277H3.95703C3.48461 16.4277 3.03155 16.2401 2.6975 15.906C2.36345 15.572 2.17578 15.1189 2.17578 14.6465V5.14648C2.17578 4.67407 2.36345 4.221 2.6975 3.88695C3.03155 3.5529 3.48461 3.36523 3.95703 3.36523H13.457C13.9294 3.36523 14.3825 3.5529 14.7166 3.88695C15.0506 4.221 15.2383 4.67407 15.2383 5.14648V7.12565C15.2383 7.28312 15.3008 7.43415 15.4122 7.5455C15.5235 7.65685 15.6746 7.7194 15.832 7.7194C15.9895 7.7194 16.1405 7.65685 16.2519 7.5455C16.3632 7.43415 16.4258 7.28312 16.4258 7.12565Z" fill="currentColor"/>
									<path d="M4.75 1.58398V3.95898C4.75 4.11646 4.81256 4.26748 4.92391 4.37883C5.03526 4.49018 5.18628 4.55273 5.34375 4.55273C5.50122 4.55273 5.65225 4.49018 5.7636 4.37883C5.87494 4.26748 5.9375 4.11646 5.9375 3.95898V1.58398C5.9375 1.42651 5.87494 1.27549 5.7636 1.16414C5.65225 1.05279 5.50122 0.990234 5.34375 0.990234C5.18628 0.990234 5.03526 1.05279 4.92391 1.16414C4.81256 1.27549 4.75 1.42651 4.75 1.58398ZM11.4792 1.58398V3.95898C11.4792 4.11646 11.5417 4.26748 11.6531 4.37883C11.7644 4.49018 11.9154 4.55273 12.0729 4.55273C12.2304 4.55273 12.3814 4.49018 12.4928 4.37883C12.6041 4.26748 12.6667 4.11646 12.6667 3.95898V1.58398C12.6667 1.42651 12.6041 1.27549 12.4928 1.16414C12.3814 1.05279 12.2304 0.990234 12.0729 0.990234C11.9154 0.990234 11.7644 1.05279 11.6531 1.16414C11.5417 1.27549 11.4792 1.42651 11.4792 1.58398ZM4.75 8.51107H7.20417C7.36164 8.51107 7.51266 8.44851 7.62401 8.33716C7.73536 8.22581 7.79792 8.07479 7.79792 7.91732C7.79792 7.75985 7.73536 7.60882 7.62401 7.49747C7.51266 7.38612 7.36164 7.32357 7.20417 7.32357H4.75C4.59253 7.32357 4.44151 7.38612 4.33016 7.49747C4.21881 7.60882 4.15625 7.75985 4.15625 7.91732C4.15625 8.07479 4.21881 8.22581 4.33016 8.33716C4.44151 8.44851 4.59253 8.51107 4.75 8.51107ZM4.75 11.6777H8.70833C8.86581 11.6777 9.01683 11.6152 9.12818 11.5038C9.23953 11.3925 9.30208 11.2415 9.30208 11.084C9.30208 10.9265 9.23953 10.7755 9.12818 10.6641C9.01683 10.5528 8.86581 10.4902 8.70833 10.4902H4.75C4.59253 10.4902 4.44151 10.5528 4.33016 10.6641C4.21881 10.7755 4.15625 10.9265 4.15625 11.084C4.15625 11.2415 4.21881 11.3925 4.33016 11.5038C4.44151 11.6152 4.59253 11.6777 4.75 11.6777Z" fill="currentColor"/>
								</svg>
							</a>
							<a href="{{ route('planning.index') }}" class="btn btn-outline-secondary">
								<i class="bi bi-calendar2-week"></i>
							</a>
							<a href="{{ route('planning.weeks.view') }}" class="btn btn-outline-secondary">
								<i class="bi bi-card-list"></i>
							</a>
							@if (role() != 'telecommercial' && role() != 'telecommercial_externe' && role() != 'sales_manager' && role() != 'sales_manager_externe' && role() != 'installer' && role() != 'energy_auditor')
								<a href="{{ route('planning.map.view') }}" class="btn btn-outline-secondary active">
									<i class="bi bi-geo-alt"></i>
								</a>
                        	@endif
						</div>
					</div>
					<div class="calendar-filters">
						<form action="{{ route('planning.map.menu.filter') }}" method="get">
							<div class="row row-cols-xl-6 row-cols-lg-3 row-cols-sm-2 row-cols-1 align-items-end">
								<div class="col">
									<div class="form-group">
										<label for="form_date" class="form-label">Date Intervention De</label>
										<input id="form_date" name="form_date" value="{{ request()->form_date }}" type="date" class="flatpickr flatpickr-input form-control shadow-none bg-white" placeholder="jj-mm-aaaa">
									</div>
								</div>
								<div class="col">
									<div class="form-group">
										<label for="to_date" class="form-label">Date Intervention a</label>
										<input id="to_date" name="to_date" value="{{ request()->to_date }}" type="date" class="flatpickr flatpickr-input form-control shadow-none bg-white" placeholder="jj-mm-aaaa">
									</div>
								</div>
								{{-- <div class="col">
									<div class="form-group">
										<label for="intervention_client" class="form-label">Client</label>
										<select id="intervention_client" name="client" class="select2_select_option custom-select shadow-none form-control">
											<option value="" selected>{{ __('Select') }}</option>
											@foreach ($projects as $project)
												<option {{ request()->client == $project['id'] ? 'selected':'' }} value="{{ $project['id'] }}">{{ $project['Nom'].' '.$project['Prenom'].'-'.$project['tag'].'-'.$project['Code_Postal'] }}</option>
											@endforeach
										</select>
									</div>
								</div> --}}
								{{-- <div class="col">
									<div class="form-group">
										<label for="code_postal" class="form-label">Code postal</label>
										<input id="code_postal" name="code_postal" value="{{ request()->code_postal }}" type="text" class="form-control shadow-none bg-white">
									</div>
								</div> --}}
								<div class="col">
									<div class="form-group">
										<label class="form-label">Type d’intervention</label>
										<select  name="intervention_type" class="select2_select_option custom-select shadow-none form-control">
											<option value="" selected>{{ __('Select') }}</option>
											<option {{ request()->intervention_type == 'Etude' ? 'selected':'' }} value="Etude">Etude</option>
											<option {{ request()->intervention_type == 'Pré-Visite Technico-Commercial' ? 'selected':'' }} value="Pré-Visite Technico-Commercial">Pré-Visite Technico-Commercial</option>
											<option {{ request()->intervention_type == 'Contre Visite Technique' ? 'selected':'' }} value="Contre Visite Technique">Contre Visite Technique</option>
											<option {{ request()->intervention_type == 'Installation' ? 'selected':'' }} value="Installation">Installation</option>
											<option {{ request()->intervention_type == 'SAV' ? 'selected':'' }} value="SAV">SAV</option>
											<option {{ request()->intervention_type == 'Prévisite virtuelle' ? 'selected':'' }} value="Prévisite virtuelle">Prévisite virtuelle</option>
											<option {{ request()->intervention_type == 'Déplacement' ? 'selected':'' }} value="Déplacement">Déplacement</option>
											<option {{ request()->intervention_type == 'DPE' ? 'selected':'' }} value="DPE">DPE</option>
										</select>
									</div>
								</div>
								<div class="col">
									<div class="form-group">
										<label class="form-label">Travaux</label>
										<select name="travaux" class="select2_select_option custom-select shadow-none form-control">
											<option value="" selected>{{ __('Select') }}</option>
											@foreach ($bareme_travaux_tags as $travaux)
												<option {{ request()->travaux == $travaux->id ? 'selected':'' }} value="{{ $travaux->id }}">{{ $travaux->travaux }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col">
									<div class="form-group">
										<label  class="form-label">Statut planning</label>
										<select name="statut_planning" class="select2_select_option custom-select shadow-none form-control">
											<option value="" selected>{{ __('Select') }}</option>
											@foreach ($status_planning as $item)
												<option {{ request()->statut_planning == $item->name ? 'selected':'' }} value="{{ $item->name }}">{{ $item->name }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col">
									<div class="form-group">
										<label class="form-label">Profil</label>
										<select name="role" id="roleFilter" class="select2_select_option custom-select shadow-none form-control">
											<option value="" selected>{{ __('Select') }}</option>
											@foreach ($filter_role as $role)
												@if ($all_access)
													@if ((role() == 'Referent_Technique' && ($role->id != 4 && $role->id != 9)) || (role() == 'Logistique' && $role->id != 2))
														@continue
													@endif
													<option {{ request()->role == $role->id ? 'selected':'' }} value="{{ $role->id }}">{{ $role->name }}</option>
												@else
													@if (role() == $role->value)
														<option {{ request()->role == $role->id ? 'selected':'' }} value="{{ $role->id }}">{{ $role->name }}</option>
													@endif
												@endif
											@endforeach
										</select>
									</div>
								</div>
								<div class="col">
									<div class="form-group">
										<label class="form-label">Utilisateur</label>
										<select name="user_id" id="filterUserList" class="select2_select_option custom-select shadow-none form-control">
											<option value="" selected>{{ __('Select') }}</option>
											@if (request()->role)
												@if ($all_access)
													@if (role() == 'team_leader')
														@foreach ($users->where('role_id', request()->role)->where('team_leader', Auth::id()) as $user)
															<option {{ request()->user_id == $user->id ? 'selected':'' }}  value="{{ $user->id }}">{{ $user->name }}</option>
														@endforeach
													@else
														@foreach ($users->where('role_id', request()->role) as $user)
															<option {{ request()->user_id == $user->id ? 'selected':'' }}  value="{{ $user->id }}">{{ $user->name }}</option>
														@endforeach
													@endif
												@else
													@foreach ($users->where('id', Auth::id()) as $user)
														<option {{ request()->user_id == $user->id ? 'selected':'' }}  value="{{ $user->id }}">{{ $user->name }}</option>
													@endforeach
												@endif
											@endif
										</select>
									</div>
								</div>
								<div class="col d-flex">
									<div class="form-group">
										<button class="secondary-btn border-0 mr-1" type="submit">{{ __('Submit') }}</button>
									</div>
									@if (\Request::route()->getName() == 'planning.map.menu.filter')
										<div class="form-group">
											<a href="{{ route('planning.map.view') }}" class="btn btn-outline-danger" name="clear" type="submit"><i class="bi bi-x-lg"></i></a>
										</div>
									@endif
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="map position-relative">
					<div class="map-wrapper position-relative h-100">
						<div id="custom-map"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<div id="renderModal">
</div>

@endsection

@push('plugins-script')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgjBuD_z2DYaMscUhT16yzCve_7n1CQ_E&callback=initMap" defer></script>
@endpush

@push('js')
<script>
    /* Leaflet Map Init function */
	$(document).ready(function(){
		let rendaring = false;
		$('body').on('click', '.planningInterventionEdit', function(){
            if(!rendaring){
                rendaring = true;
                let id = $(this).data('id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type : "POST",
                    url  : "{{ route('planning.intervention.modal.render2') }}",
                    data : {id},
                    success : response => {
                        $("#renderModal").html(response);
                        $("#planningInterventionEdit").modal('show');
                        rendaring = false;
                        $('.select2_select_option').each(function(){
                            $(this).select2({
                                dropdownParent: $(this).parent(),
                                templateSelection : function (tag, container){
                                    var $option = $('.select2_select_option option[value="'+tag.id+'"]');
                                    if ($option.attr('disabled')){
                                    $(container).addClass('removed-remove-btn');
                                    }
                                    return tag.text;
                                },
                            })
                        })
                        $('input[type=date]').wrap('<div class="datepicker-input"></div>');
                        document.querySelectorAll('input[type=date]').forEach(e => {
                            flatpickr(e, {
                                minDate: e.getAttribute('min'),
                                maxDate: e.getAttribute('max'),
                                defaultDate: e.getAttribute('value'),
                                altFormat: 'j F Y',
                                dateFormat: 'Y-m-d',
                                allowInput: true,
                                altInput: true,
                                locale: "fr",
                                onReady: (selectedDates, dateStr, instance) => {
                                    const mainInputDataId = instance.input.dataset.id;
                                    const altInput = instance.input.parentElement?.querySelector(".input");
                                    altInput.setAttribute("onkeypress", "return false");
                                    altInput.setAttribute("onpaste", "return false");
                                    altInput.setAttribute("autocomplete", "off");
                                    altInput.setAttribute("id", mainInputDataId);
                                },
                            });
                        });
                        var select2_with_color = $(".select2_color_option");
                        if(select2_with_color.length){
                            function renderCustomResultTemplat(option) {
                                if (!option.id) {
                                    return option.text;
                                }

                                let $returnTemplate = `
                                <div class="px-3 py-2" style="color: ${$(option.element).data('color')}; background-color: ${$(option.element).data('background')}">
                                    ${option.text}
                                </div>
                                `

                                return $returnTemplate;
                            }

                            function renderCustomSelectionTemplat(option) {
                                if (option.id === '') {
                                    let $returnTemplate = `<div class="px-3 h-100">${option.text}</div>`
                                    return $returnTemplate;
                                }

                                if (!option.id) {
                                    return option.text;
                                }

                                let $returnTemplate = `
                                <div class="px-3 h-100" style="color: ${$(option.element).data('color')}; background-color: ${$(option.element).data('background')}">
                                    ${option.text}
                                </div>
                                `

                                return $returnTemplate;
                            }

                            select2_with_color.each(function(){
                                $(this).wrap('<div class="position-relative select2_color_option-parent"></div>').select2({
                                    width: '100%',
                                    dropdownParent: $(this).parent(),
                                    templateResult: renderCustomResultTemplat,
                                    templateSelection: renderCustomSelectionTemplat,
                                    escapeMarkup: function (es) {
                                        return es;
                                    }
                                });

                            });
                        }
                        $('.intervention_disabled').prop('disabled', true);

						const isMobile = () => /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
                        if(isMobile()){
                            $('.waze-mobile-button').removeClass('d-none');
                        }

                    },error : errors => {
                        rendaring = false;
                    }
                });
            }
		});

		$('body').on('change', '#roleFilter', function(){
			let role_id = $(this).val();
			$.ajax({
				type : "POST",
				url  : "{{ route('planning.filter.role.change2') }}",
				data : {role_id},
				success : response => {
					$('#filterUserList').html(response)
				}
			})
		});

		$('body').on('change','.other_field__system2', function(){
			let autre_box = $(this).data('autre-box');
            if($(this).val() == 'Oui'){
                $('.'+autre_box).slideDown();
            }else{
                $('.'+autre_box).slideUp();
            }
		});
	});
</script>


<script defer>
    let currentInfoWindow;
    let map;
    let defaultLat = 46.2276;
    let defaultLng = 2.2137;

    // Function to create a custom icon with a specified color
    function createCustomIcon(colorCode) {
        return {
            url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent('<svg xmlns="http://www.w3.org/2000/svg" width="45.716" height="60.955" viewBox="0 0 45.716 60.955"><path id="geo-alt-fill" d="M24.858,60.955s22.858-21.662,22.858-38.1A22.858,22.858,0,1,0,2,22.858C2,39.293,24.858,60.955,24.858,60.955Zm0-26.668A11.429,11.429,0,1,1,36.287,22.858,11.429,11.429,0,0,1,24.858,34.287Z" transform="translate(-2)" fill="' + colorCode + '"/></svg>'),
            scaledSize: new google.maps.Size(26, 35),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(22.858, 60.955)
        }
    };

    // Initialize the map
    function initMap() {
        // Specify the coordinates for the map center
        let mapCenter = { lat: defaultLat, lng: defaultLng };

        // Create a new map instance
        map = new google.maps.Map(document.getElementById('custom-map'), {
            zoom: 5,
            center: mapCenter
        });

        let allLocations = [
            @forelse ($interventions as $intervention)
                @if ($intervention->getProject->latitude)
                    {
                        position: { lat: {{ $intervention->getProject->latitude }}, lng: {{ $intervention->getProject->longitude }} },
                        icon: createCustomIcon("{{ $intervention->getStatusPlanning ? $intervention->getStatusPlanning->background_color : '#ff0000'  }}"),
                        content:
                        `
                        <div class="text-left">
                            <table>
                                <tbody>
                                    <tr>
                                        <th>Nom </th>
                                        <td>: {{ $intervention->getProject->Nom }}</td>
                                    </tr>
                                    <tr>
                                        <th>Prenom </th>
                                        <td>: {{ $intervention->getProject->Prenom }}</td>
                                    </tr>
                                    <tr>
                                        <th>Département </th>
                                        <td>:
                                            @if ($intervention->getProject->same_as_work_address == 'no')
                                                {{ getDepartment($intervention->getProject->Code_postal_Travaux) }}
                                            @else
                                                {{ getDepartment($intervention->getProject->Code_Postal) }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Date intervention  &nbsp;</th>
                                        <td>:
                                            @if ($intervention->Date_intervention && strtotime($intervention->Date_intervention))
                                                {{ \Carbon\Carbon::parse($intervention->Date_intervention)->locale(app()->getLocale())->translatedFormat('d-m-Y') }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Assigné à </th>
                                        <td>: {{ $intervention->getUser->name ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Téléphone </th>
                                        <td>: {{ $intervention->getProject->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-center">
                                            <button type="button" data-dismiss="modal" class="primary-btn primary-btn--primary primary-btn--lg fix-btn-width rounded-pill border-0 d-inline-flex align-items-center justify-content-center mt-3 planningInterventionEdit"data-id="{{ $intervention->id }}" >Détails</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        `
                    },
                @endif
            @empty
                {
                    position: { lat: defaultLat, lng: defaultLng },
                    icon: createCustomIcon('rgba(255,0,0,0.92)'),
                    content: 'No Item Found'
                }
            @endforelse
        ];

        allLocations.forEach(function(markerData) {
            let marker = new google.maps.Marker({
                position: markerData.position,
                map: map,
                title: 'Custom Marker',
                icon: markerData.icon
            });

            let infowindow = new google.maps.InfoWindow({
                content: markerData.content
            });

            marker.addListener('click', function() {
                // Close the currently open info window
                if (currentInfoWindow) {
                    currentInfoWindow.close();
                }

                // Open the clicked marker's info window
                infowindow.open(map, marker);

                // Set the currently open info window
                currentInfoWindow = infowindow;
            });
        });

        map.addListener('click', function() {
            if (currentInfoWindow) {
                currentInfoWindow.close();
            }
        });
    };
</script>
@endpush
