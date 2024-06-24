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
<link rel="stylesheet" href="{{ asset('crm_assets/assets/plugins/leaflet-map/css/leaflet.css') }}">
<link rel="stylesheet" href="{{ asset('crm_assets/assets/plugins/leaflet-map/css/leaflet-gesture-handling.min.css') }}">
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
							<a href="{{ Route('calendar.index') }}" class="btn btn-outline-secondary">
								<i class="bi bi-calendar2-week"></i>
							</a>
							<a href="{{ Route('calendar.weeks') }}" class="btn btn-outline-secondary">
								<i class="bi bi-card-list"></i>
							</a>
							<a href="{{ Route('planning.map') }}" class="btn btn-outline-secondary active">
								<i class="bi bi-geo-alt"></i>
							</a>
						</div>
					</div>
					<div class="calendar-filters">
						<form action="{{ route('calendar.map.filter') }}" method="get">
							<div class="row row-cols-xl-6 row-cols-lg-3 row-cols-sm-2 row-cols-1 align-items-end">
								<div class="col">
									<div class="form-group">
										<label for="from" class="form-label">{{ __('From') }}</label>
										<input id="from" name="from" value="{{ request()->from ? request()->from:''  }}" type="date" class="flatpickr flatpickr-input form-control shadow-none bg-white" placeholder="jj-mm-aaaa">
									</div>
								</div>
								<div class="col">
									<div class="form-group">
										<label for="to" class="form-label">{{ __('To') }}</label>
										<input id="to" name="to" value="{{ request()->to ? request()->to:''  }}" type="date" class="flatpickr flatpickr-input form-control shadow-none bg-white" placeholder="jj-mm-aaaa">
									</div>
								</div>
								<div class="col">
									<div class="form-group">
										<label for="event_id_filter" class="form-label">{{ __('Event') }}</label> 
										<input type="hidden" name="client_id" value="{{ $client ? $client->id:0 }}">
										<select id="event_id_filter" name="event_id" class="select2_select_option custom-select shadow-none form-control">
											<option value="" selected>{{ __('Select') }}</option>
											@foreach ($all_event as $a_event)
												<option {{ request()->event_id ? (request()->event_id == $a_event->id ? 'selected':''):''  }} value="{{ $a_event->id }}">{{ $a_event->title }}</option>
											@endforeach 
										</select>
									</div>
								</div>  
								<div class="col">
									<div class="form-group">
										<label for="event_client_filter" class="form-label">{{ __('Client') }}</label>
										<select id="event_client_filter" name="event_client" class="select2_select_option custom-select shadow-none form-control">
											<option value="" selected>{{ __('Select') }}</option> 
											@foreach ($clients as $c_item) 
												<option {{ request()->event_client ? (request()->event_client == $c_item->id ? 'selected':''):''  }} value="{{ $c_item->id }}">{{ $c_item->first_name }}</option> 
											@endforeach 
										</select>
									</div>
								</div>
								<div class="col">
									<div class="form-group">
										<label for="event_project_filter" class="form-label">{{ __('Project') }}</label>
										<select id="event_project_filter" name="event_project" class="select2_select_option custom-select shadow-none form-control">
											<option value="" selected>{{ __('Select') }}</option>
											@foreach ($projects as $p_item)
												<option {{ request()->event_project ? (request()->event_project == $p_item->id ? 'selected':''):''  }} value="{{ $p_item->id }}">{{ $p_item->project_name }}</option>
											@endforeach  
										</select>
									</div>
								</div>
								<div class="col d-flex">
									<div class="form-group">
										<button class="secondary-btn border-0 mr-1" name="submit" type="submit">{{ __('Submit') }}</button>
									</div>
									@if (request()->from || request()->to || request()->event_id || request()->event_client || request()->event_project)
										<div class="form-group">
											<a href="{{ route('planning.map') }}" class="btn btn-outline-danger" name="clear" type="submit"><i class="bi bi-x-lg"></i></a>
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

@foreach ($events as $event)  
	{{-- client status modal  --}}
	<div class="modal modal--map fade" id="eventDetails{{ $event->id }}" tabindex="-1" aria-labelledby="eventDetailsLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content border-0">
				<div class="modal-header border-0 pb-0">
					<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
						<span class="novecologie-icon-close"></span>
					</button>
				</div>
				<div class="modal-body pt-0">
					<h3 class="modal--map__title text-uppercase">{{ $event->getClient->first_name ?? ''}}</h3>
					<address class="modal--map__address">
						<svg xmlns="http://www.w3.org/2000/svg" width="45.716" height="60.955" class="modal--map__address__icon w-100 h-100" viewBox="0 0 45.716 60.955">
							<path id="geo-alt-fill" d="M24.858,60.955s22.858-21.662,22.858-38.1A22.858,22.858,0,1,0,2,22.858C2,39.293,24.858,60.955,24.858,60.955Zm0-26.668A11.429,11.429,0,1,1,36.287,22.858,11.429,11.429,0,0,1,24.858,34.287Z" transform="translate(-2)" fill="{{ $event->getCategory->color }}"></path>
						</svg>
						<span>{{ $event->location }}</span>
					</address>
					<table>
						<tbody>
							<tr>
								<td class="font-weight-bold">{{ __('Title') }}</td>
								<td><span class="px-2">:</span>{{ $event->title }}</td>
							</tr>
							<tr>
								<td class="font-weight-bold">{{ __('Project') }}</td>
								<td><span class="px-2">:</span>{{ $event->getProject->project_name ?? '' }}</td>
							</tr>
							<tr>
								<td class="font-weight-bold">{{ __('Start Date') }}</td>
								<td><span class="px-2">:</span>  
									 {{ \Carbon\Carbon::parse($event->start_date)->format('Y-m-d') }} 
								</td>
							</tr>
							<tr>
								<td class="font-weight-bold">{{ __('End Date') }}</td>
								<td><span class="px-2">:</span>  
									 {{ \Carbon\Carbon::parse($event->end_date)->format('Y-m-d') }} 
								</td>
							</tr>
						</tbody>
					</table>
					<div class="text-center mt-4">
						<a href="tel:+{{ $event->getClient->phone ?? '' }}" class="primary-btn primary-btn--primary primary-btn--lg fix-btn-width rounded-pill d-inline-flex align-items-center justify-content-center ">Contacter</a>
					</div>
				</div>
			</div>
		</div>
	</div>
@endforeach
@endsection

@push('plugins-script')
<script src="{{ asset('crm_assets/assets/plugins/leaflet-map/js/leaflet.js') }}"></script>
<script src="{{ asset('crm_assets/assets/plugins/leaflet-map/js/leaflet-gesture-handling.min.js') }}"></script>
@endpush

@push('js')
<script>
    /* Leaflet Map Init function */
    const mapContainer = document.getElementById('custom-map')
    if(mapContainer) {
        (function(){
            let defaultColor = "#6c418e";
            let defaultLocationName = "France";
            let lat = 46.2276;
            let lng = 2.2137;
            // let mapImageUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
            let mapImageUrl = 'https://cartodb-basemaps-{s}.global.ssl.fastly.net/light_all/{z}/{x}/{y}.png';

            let defaultSvgMarkerIcon = function(colorCode){
                return L.divIcon({
                    html: `
                        <svg xmlns="http://www.w3.org/2000/svg" width="45.716" height="60.955" class="w-100 h-100" viewBox="0 0 45.716 60.955">
                            <path id="geo-alt-fill" d="M24.858,60.955s22.858-21.662,22.858-38.1A22.858,22.858,0,1,0,2,22.858C2,39.293,24.858,60.955,24.858,60.955Zm0-26.668A11.429,11.429,0,1,1,36.287,22.858,11.429,11.429,0,0,1,24.858,34.287Z" transform="translate(-2)" fill="${colorCode}"/>
                        </svg>
                    `,
                    iconSize: [26, 35],
                    iconAnchor: [26, 37],
                    popupAnchor: [-13, -35],
                });
            };

            let userMarkerIcon = L.Icon.extend({
					options: {
						iconSize: [37, 37],
						iconAnchor: [37, 39],
						popupAnchor: [-18.5, -37],
                        className: "user-marker-icon"
					}
			});
            let mainMarkerIcon = L.icon({
                iconSize: [40, 40],
                iconAnchor: [20, 20],
                popupAnchor: [-20, -40],
                iconUrl: "{{ asset('crm_assets/assets/images/map/markers/marker-icon-main.svg') }}",
                shadowUrl: "",
            });
            let defaultMarkerIcon = L.icon({
                iconSize: [26, 35],
                iconAnchor: [26, 37],
                popupAnchor: [-13, -35],
                iconUrl: "{{ asset('crm_assets/assets/images/map/markers/marker-icon-new.svg') }}",
            });
            
            var allLocations = [
				@forelse ($events as $event) 
                [`<a  data-toggle="modal" data-target="#eventDetails{{ $event->id }}" class="leaflet-popup-content-wrapper__link" target='_blank'>{{ $event->title }}</a>`, {{ $event->address_lat }}, {{ $event->address_lon }},
                defaultSvgMarkerIcon("{{ $event->getCategory->color }}")
                ],  
                @empty
				[
					`<a href='#!' class="leaflet-popup-content-wrapper__link">Nam Dice</a>`,
					lat,
					lng,
					new userMarkerIcon({iconUrl: "{{ asset('crm_assets/assets/images/icons/user.png') }}"}),
				],
                @endforelse 
				
           ];
    
            let map = L.map('custom-map', {
                center: [lat, lng],
                zoom: 13,
                minZoom: 5,
                attributionControl: false,
				gestureHandling: true
            });
            
            L.tileLayer(mapImageUrl).addTo(map);

            for (var i = 0; i < allLocations.length; i++) {
               marker = new L.marker([allLocations[i][1], allLocations[i][2]], {icon: allLocations[i][3]})
                   .bindPopup(allLocations[i][0])
                   .addTo(map);
               map.panTo(L.latLng(allLocations[i][1], allLocations[i][2]));
            };
    
            var circles;
            var main_marker;

            function onLocationFound(e) {
                var radius = e.accuracy / 5;

                if (!map.hasLayer(circles) && !map.hasLayer(main_marker)) {
                    map.panTo(L.latLng(e.latlng));
                }

                if (map.hasLayer(circles) && map.hasLayer(main_marker)) {
                    map.removeLayer(circles);
                    map.removeLayer(main_marker);
                }
                

                main_marker = new L.marker(e.latlng, {icon: mainMarkerIcon, riseOnHover: true}).addTo(map);
                circles = new L.circle(e.latlng, radius, {fillColor: '#000000', fillOpacity: 0.14 , stroke: false }).addTo(map);
                circles.bindPopup("You are within " + radius + " meters from this point");

                map.addLayer(main_marker);
                map.addLayer(circles);
            };
           
            function onLocationError() {
                // $('.toast.toast--error').toast('show');
                L.marker([lat, lng], {icon: defaultSvgMarkerIcon(defaultColor)}).addTo(map)
                    .bindPopup('Default Location <br>' + defaultLocationName)
                    .openPopup();

                map.panTo(L.latLng(lat, lng));
            };

			// map.on('locationfound', onLocationFound);
            // map.on('locationerror', onLocationError);

            map.locate({
                // setView: true,
                // watch: true,
                maxZoom: 13,
            });
            
        })()
    };
</script>
@endpush