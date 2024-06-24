<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="{{ asset('crm_assets/assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- @push('plugins-link') --}}
    <link rel="stylesheet" href="{{ asset('crm_assets/assets/plugins/leaflet-map/css/leaflet.css') }}">
    <link rel="stylesheet" href="{{ asset('crm_assets/assets/plugins/leaflet-map/css/leaflet-gesture-handling.min.css') }}">
    {{-- @endpush --}}

    <link rel="stylesheet" href="{{ asset('crm_assets/assets/css/style.css') }}">

    <style>
        @media (min-width: 768px){
            .modal-header__searchbar{
                position: absolute;
                top: 50%;
                left: 0;
                right: 0;
                transform: translateY(-50%);
                pointer-events: none;
            }
            .modal-header__searchbar .form-control{
                pointer-events: all;
            }
        }
        .modal-header__searchbar .form-control{
            max-width: 400px;
        }
        @media (min-width: 992px){
            .modal-header__searchbar .form-control{
                max-width: 500px;
            }
        }

        #parcel-map.leaflet-grab{
            cursor: pointer;
        }
        .map-parcel-card{
            z-index: 2;
            top: 10px;
            left: 55px;
            padding: 10px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0,0,0,0.4);
        }
        .map-parcel-card:not(.show){
            display: none;
        }
        .map-parcel-card__text{
            color: #212529;
            font-size: 13px;
            margin-bottom: 5px;
        }
        .map-parcel-card__text:nth-of-type(1){
            padding-right: 25px;
        }
        .map-parcel-card__text--muted{
            color: #919191;
        }
        .map-parcel-card__close-btn{
            top: 5px;
            right: 5px;
            color: red;
            display: inline-block;
            line-height: 1;
            background-color: transparent;
            border: 0;
            padding: 2px;
        }
    </style>

    <style>
        .pac-container{
            border-radius: 0.357rem;
            font-family: "Roboto", sans-serif;
            box-shadow: 0 5px 25px rgba(34, 41, 47, 0.1);
            z-index: 99999;
            box-shadow: 0 4px 24px 0 rgba(0, 0, 0, 0.24);
            background-color: #fff;
            border: 1px solid rgba(34, 41, 47, 0.05);
        }

        .pac-logo::after{
            display: none;
        }

        .pac-item {
            font-size: 14px;
            font-weight: 400;
            padding: 0.65rem 1.28rem;
            border-top: 0;
            background-color: transparent;
            cursor: pointer;
            color: #000000;
        }
        .pac-item:is(:hover, :focus, .pac-item-selected){
            color: #13438c;
            background-color: rgba(19, 67, 140, 0.07);
        }

        .pac-icon {
            background-size: 20px;
        }
        .hdpi .pac-icon{
            background-image: url("data:image/svg+xml,%3Csvg width='20' height='20' viewBox='0 0 20 20' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M10 0C5.865 0 2.5 3.38833 2.5 7.55417C2.5 13.4733 9.295 19.585 9.58417 19.8417C9.70333 19.9475 9.85167 20 10 20C10.1483 20 10.2967 19.9475 10.4158 19.8425C10.705 19.585 17.5 13.4733 17.5 7.55417C17.5 3.38833 14.135 0 10 0ZM10 11.6667C7.7025 11.6667 5.83333 9.7975 5.83333 7.5C5.83333 5.2025 7.7025 3.33333 10 3.33333C12.2975 3.33333 14.1667 5.2025 14.1667 7.5C14.1667 9.7975 12.2975 11.6667 10 11.6667Z' fill='%236E6B7B'/%3E%3C/svg%3E");
        }
        .pac-icon{
            background-image: url("data:image/svg+xml,%3Csvg width='20' height='20' viewBox='0 0 20 20' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M10 0C5.865 0 2.5 3.38833 2.5 7.55417C2.5 13.4733 9.295 19.585 9.58417 19.8417C9.70333 19.9475 9.85167 20 10 20C10.1483 20 10.2967 19.9475 10.4158 19.8425C10.705 19.585 17.5 13.4733 17.5 7.55417C17.5 3.38833 14.135 0 10 0ZM10 11.6667C7.7025 11.6667 5.83333 9.7975 5.83333 7.5C5.83333 5.2025 7.7025 3.33333 10 3.33333C12.2975 3.33333 14.1667 5.2025 14.1667 7.5C14.1667 9.7975 12.2975 11.6667 10 11.6667Z' fill='%236E6B7B'/%3E%3C/svg%3E");
        }

        .pac-icon-marker,
        .pac-item-selected .pac-icon-marker
        {
            background-position: center;
        }

        .pac-item-query,
        .pac-matched
        {
            color: #292d34;
            background-color: #ffff80;
        }

        .pac-item-query{
            font-size: 1.01em;
        }
    </style>
</head>
<body>
    <section class="py-5">
        <div class="container">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#locationParcelModal">
                Launch demo modal
            </button>
        </div>
    </section>

    <div class="modal fade" id="locationParcelModal" tabindex="-1" aria-labelledby="locationParcelModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="position-relative">
                    <div class="modal-header align-items-center">
                        <h3 class="modal-title" id="locationParcelModalLabel">Select your location</h3>
                        <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-header__searchbar px-3 py-2">
                        <input type="text" name="google_address" id="google_address" class="form-control shadow-none mx-auto">
                    </div>
                </div>
                <div class="modal-body p-0">
                    <div class="map position-relative h-100">
                        <div class="map-parcel-card position-absolute">
                            <button type="button" aria-label="Close parcel card" class="map-parcel-card__close-btn position-absolute">
                                <i class="bi bi-x-lg"></i>
                            </button>
                            <p class="map-parcel-card__text map-parcel-card__text--muted"><span id="parcelleLat"></span>, <span id="parcelleLng"></span></p>
                            <p class="map-parcel-card__text"><strong id="parcelleLocationName">Location Name</strong></p>
                            <p class="map-parcel-card__text" id="parcelleDepArrNomCom">36000 Châteauroux</p>
                            <p class="map-parcel-card__text">Parcelle : <span id="parcelleCode"></span></p>
                            <p class="map-parcel-card__text map-parcel-card__text--muted mb-0">Altitude : <span id="parcelleAltitude">0 m</span></p>
                        </div>
                        <div class="map-wrapper position-relative h-100">
                            <div id="parcel-map" class="h-100"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer py-1">
                    <button type="button" class="btn btn-primary">Copy Parcel Number</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('crm_assets/assets/js/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('crm_assets/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    {{-- @push('plugins-script') --}}
    <script async src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyDgjBuD_z2DYaMscUhT16yzCve_7n1CQ_E"></script>
    <script src="{{ asset('crm_assets/assets/plugins/leaflet-map/js/leaflet.js') }}"></script>
    <script src="{{ asset('crm_assets/assets/plugins/leaflet-map/js/leaflet-gesture-handling.min.js') }}"></script>
    {{-- @endpush --}}

    <script src="{{ asset('crm_assets/assets/js/script.js') }}"></script>

    {{-- @push('js') --}}
    <script>
        window.addEventListener("load", function(){
            googleSearchInitialize()
        })

        $mapParcelCard = $('.map-parcel-card');
        const mapId = 'parcel-map';
        let defaultMarkerColor = "#13438c";
        let marker = null;
        let lat = 46.2276;
        let lng = 2.2137;
        let mapOptions = {
            center: [lat, lng],
            zoom: 13,
            minZoom: 5,
            attributionControl: false,
            gestureHandling: true
        };
        let mapImageUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
        let ParcellLayer = L.tileLayer('https://wxs.ign.fr/{ignApiKey}/geoportail/wmts?&REQUEST=GetTile&SERVICE=WMTS&VERSION=1.0.0&TILEMATRIXSET=PM&LAYER={ignLayer}&STYLE={style}&FORMAT={format}&TILECOL={x}&TILEROW={y}&TILEMATRIX={z}',
        {
            ignApiKey: 'choisirgeoportail',
            ignLayer: 'CADASTRALPARCELS.PARCELLAIRE_EXPRESS',
            style: 'PCI vecteur',
            format: 'image/png',
            service: 'WMTS',
            maxZoom: 19
        });
        let defaultSvgMarkerIcon = (colorCode)=>{
            return L.divIcon({
                html: `
                    <svg xmlns="http://www.w3.org/2000/svg" width="45.716" height="60.955" class="w-100 h-100" viewBox="0 0 45.716 60.955">
                        <path id="geo-alt-fill" d="M24.858,60.955s22.858-21.662,22.858-38.1A22.858,22.858,0,1,0,2,22.858C2,39.293,24.858,60.955,24.858,60.955Zm0-26.668A11.429,11.429,0,1,1,36.287,22.858,11.429,11.429,0,0,1,24.858,34.287Z" transform="translate(-2)" fill="${colorCode}"/>
                    </svg>
                `,
                iconSize: [26, 35],
                iconAnchor: [13, 35],
                // popupAnchor: [-13, -35],
            });
        };

        let map = L.map(mapId, mapOptions);
        L.tileLayer(mapImageUrl).addTo(map);
        L.layerGroup().addLayer(ParcellLayer).addTo(map);

        marker = L.marker([lat, lng], {icon: defaultSvgMarkerIcon(defaultMarkerColor)}).addTo(map);
        map.panTo(L.latLng(lat, lng));

        const addNewMarker = async (currentLat, currentLng)=>{
            if(marker !== null){
                map.removeLayer(marker);
                $mapParcelCard.removeClass('show');
            }
            marker = L.marker([currentLat, currentLng], {icon: defaultSvgMarkerIcon(defaultMarkerColor)}).addTo(map);
            map.panTo(L.latLng(currentLat, currentLng));
            const parcelleDataURL = `https://apicarto.ign.fr/api/cadastre/parcelle?geom={"type":"Point","coordinates":[${currentLng},${currentLat}]}`;
            try {
                const response = await fetch(parcelleDataURL);
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                const parcelleData = await response.json();
                const parcelleDataFeaturesProperties = parcelleData.features[0].properties;

                $('#parcelleLat').html(currentLat);
                $('#parcelleLng').html(currentLng);
                $('#parcelleDepArrNomCom').html(parcelleDataFeaturesProperties.code_dep+parcelleDataFeaturesProperties.code_arr+ ' ' +parcelleDataFeaturesProperties.nom_com);
                $('#parcelleCode').html(parcelleDataFeaturesProperties.com_abs+"/"+parcelleDataFeaturesProperties.section+"/"+parcelleDataFeaturesProperties.numero);

                $mapParcelCard.addClass('show');
            }catch (error){
                $('#parcelleLat').html(currentLat);
                $('#parcelleLng').html(currentLng);
                $('#parcelleDepArrNomCom').html("Not Found");
                $('#parcelleCode').html("Not Found");
                $mapParcelCard.addClass('show');
                console.error('Error fetching parcel data:', error.message);
            }
        };

        map.on('click', (event)=> {
            let currentLat = event.latlng.lat;
            let currentLng = event.latlng.lng;

            addNewMarker(currentLat, currentLng)
        });

        $('#locationParcelModal').on('shown.bs.modal', function(){
            map.invalidateSize();
        });

        $('.map-parcel-card__close-btn').on('click', function(){
            $mapParcelCard.removeClass('show');
        });

        function googleSearchInitialize() {
            let addressInputElement = document.getElementById('google_address');
            let autocomplete = new google.maps.places.Autocomplete(addressInputElement);
            autocomplete.setTypes(['geocode']);
            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                let place = autocomplete.getPlace();
                if (!place.geometry) {
                    return;
                }
                let currentFormattedAddress = '';
                let currentLat = place.geometry.location.lat();
                let currentLng = place.geometry.location.lng();
                if (place.formatted_address) {
                    currentFormattedAddress = place.formatted_address;
                }
                addNewMarker(currentLat, currentLng)
            });
        }
    </script>

    {{-- @endpush --}}
</body>
</html>
