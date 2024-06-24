<div class="modal fade" id="locationParcelModal" tabindex="-1" aria-labelledby="locationParcelModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="position-relative">
                <div class="modal-header align-items-center">
                    <h3 class="modal-title" id="locationParcelModalLabel"></h3>
                    {{-- <h3 class="modal-title" id="locationParcelModalLabel">Select your location</h3> --}}
                    <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-header__searchbar px-3 py-2">
                    <input type="text" name="google_address" id="parcelle_google_address" class="form-control shadow-none mx-auto">
                </div>
            </div>
            <div class="modal-body p-0">
                <div class="map position-relative h-100">
                    <div class="map-parcel-card position-absolute">
                        <button type="button" aria-label="Close parcel card" class="map-parcel-card__close-btn position-absolute">
                            <i class="bi bi-x-lg"></i>
                        </button>
                        <p class="map-parcel-card__text map-parcel-card__text--muted"><span id="parcelleLat"></span>, <span id="parcelleLng"></span></p>
                        <p class="map-parcel-card__text"><strong id="parcelleLocationName"></strong></p>
                        <p class="map-parcel-card__text" id="parcelleDepArrNomCom">36000 Châteauroux</p>
                        <p class="map-parcel-card__text">Parcelle : <span id="parcelleCode"></span></p>
                        {{-- <p class="map-parcel-card__text map-parcel-card__text--muted mb-0">Altitude : <span id="parcelleAltitude">0 m</span></p> --}}
                    </div>
                    <div class="map-wrapper position-relative h-100">
                        <div id="parcel-map" class="h-100"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer py-1">
                <button type="button" class="btn btn-primary d-none" id="parcelNumberCopyButton">Obtenir parcelle cadastrale</button>
            </div>
        </div>
    </div>
</div>