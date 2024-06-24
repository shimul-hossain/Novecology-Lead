 @extends('layouts.master')

 {{-- Title part  --}}
@section('title')
{{ __('Map') }}
@endsection

@push('plugins-link')
<link rel="stylesheet" href="{{ asset('crm_assets/assets/plugins/leaflet-map/css/leaflet.css') }}">
<link rel="stylesheet" href="{{ asset('crm_assets/assets/plugins/leaflet-map/css/leaflet-gesture-handling.min.css') }}">
@endpush

{{-- active menu  --}}
@section('mapIndex')
    active
@endsection

@section('bodyBg')
secondary-bg    
@endsection

{{-- Main Content Part  --}}
@section('content')
		<!-- Map Section -->

      
        <section>
            <div class="container">
                <div class="row flex-lg-row-reverse">
                    <div class="col-xl-10 col-lg-9 px-lg-0">
                        <div class="map position-relative h-100">
                            <div class="map-wrapper position-relative h-100">
                                <div id="custom-map"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3">
                        <div class="filter-wrapper"> 

                            
                            <div class="filter-wrapper__body">
                                <form action="{{ route('map.filter') }}" method="get">   
                                    <div class="accordion" id="filterAccordion">
                                        <div class="card">
                                            <div class="card-header">
                                                <h2 class="mb-0">
                                                    <button class="btn btn-block text-left shadow-none" type="button" data-toggle="collapse" data-target="#collapse8" aria-expanded="
                                                    @if (request()->route()->getName() == 'map.index')
                                                    true
                                                    @else
                                                        @if (isset(request()->lead_progress)||isset(request()->lead_prevalidate)||isset(request()->lead_checked))
                                                            true
                                                        @else
                                                            false
                                                        @endif
                                                    @endif
                                                    ">
                                                        {{ __("Lead Status") }}
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="collapse8" class="collapse   
                                                @if (request()->route()->getName() == 'map.index')
                                                    show
                                                @else
                                                    @if (isset(request()->lead_progress)||isset(request()->lead_prevalidate)||isset(request()->lead_checked))
                                                        show
                                                    @endif
                                                @endif">
                                                <div class="card-body">
                                                    <div class="accordion" id="innerLeadAccordion">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h2 class="mb-0">
                                                                    <button class="btn btn-block text-left shadow-none" type="button" data-toggle="collapse" data-target="#collapse8a" aria-expanded="
                                                                    @if (request()->route()->getName() == 'map.index')
                                                                    true
                                                                    @else
                                                                        @if (isset(request()->lead_progress))
                                                                            true
                                                                        @else
                                                                            false
                                                                        @endif 
                                                                    @endif
                                                                    ">
                                                                    {{ __('In Progress') }}
                                                                    </button>
                                                                </h2>
                                                            </div>
                                                            <div id="collapse8a" class="collapse 
                                                                @if (request()->route()->getName() == 'map.index')
                                                                show
                                                                @else
                                                                    @if (isset(request()->lead_progress))
                                                                        show
                                                                    @endif
                                                                @endif">
                                                                <div class="card-body"> 
                                                                    @foreach (App\Models\CRM\LeadStatus::all() as $lead_status)
                                                                        <div class="form-group">
                                                                            <div class="custom-control custom-checkbox mb-0"> 
                                                                                @if(isset(request()->lead_progress) && in_array($lead_status->id, request()->lead_progress))
                                                                                <input type="checkbox" checked name="lead_progress[]" value="{{ $lead_status->id }}" class="custom-control-input" id="leadProgressFilter-{{ $lead_status->id }}">
                                                                                @else 
                                                                                <input type="checkbox" name="lead_progress[]" value="{{ $lead_status->id }}" class="custom-control-input" id="leadProgressFilter-{{ $lead_status->id }}">
                                                                                @endif
                                                                                <label class="custom-control-label" for="leadProgressFilter-{{ $lead_status->id }}">{{ $lead_status->status }}</label>
                                                                            </div>
                                                                        </div> 
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h2 class="mb-0">
                                                                    <button class="btn btn-block text-left shadow-none" type="button" data-toggle="collapse" data-target="#collapse8b" aria-expanded=" 
                                                                        @if (isset(request()->lead_prevalidate))
                                                                            true
                                                                        @else
                                                                            false
                                                                        @endif 
                                                                    ">
                                                                    {{ __('Pre-validate') }}
                                                                    </button>
                                                                </h2>
                                                            </div>
                                                            <div id="collapse8b" class="collapse 
                                                                    @if (isset(request()->lead_prevalidate))
                                                                        show
                                                                    @endif ">
                                                                <div class="card-body"> 
                                                                    @foreach (App\Models\CRM\LeadStatus::all() as $lead_status)
                                                                        <div class="form-group">
                                                                            <div class="custom-control custom-checkbox mb-0"> 
                                                                                @if(isset(request()->lead_prevalidate) && in_array($lead_status->id, request()->lead_prevalidate))
                                                                                <input type="checkbox" checked name="lead_prevalidate[]" value="{{ $lead_status->id }}" class="custom-control-input" id="leadPrevalidateFilter-{{ $lead_status->id }}">
                                                                                @else 
                                                                                <input type="checkbox" name="lead_prevalidate[]" value="{{ $lead_status->id }}" class="custom-control-input" id="leadPrevalidateFilter-{{ $lead_status->id }}">
                                                                                @endif
                                                                                <label class="custom-control-label" for="leadPrevalidateFilter-{{ $lead_status->id }}">{{ $lead_status->status }}</label>
                                                                            </div>
                                                                        </div> 
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h2 class="mb-0">
                                                                    <button class="btn btn-block text-left shadow-none" type="button" data-toggle="collapse" data-target="#collapse8c" aria-expanded=" 
                                                                        @if (isset(request()->lead_checked))
                                                                            true
                                                                        @else
                                                                            false
                                                                        @endif 
                                                                    ">
                                                                        {{ __('Checked') }}
                                                                    </button>
                                                                </h2>
                                                            </div>
                                                            <div id="collapse8c" class="collapse  
                                                                    @if (isset(request()->lead_checked))
                                                                        show 
                                                                    @endif">
                                                                <div class="card-body"> 
                                                                    @foreach (App\Models\CRM\LeadStatus::all() as $lead_status)
                                                                        <div class="form-group">
                                                                            <div class="custom-control custom-checkbox mb-0"> 
                                                                                @if(isset(request()->lead_checked) && in_array($lead_status->id, request()->lead_checked))
                                                                                <input type="checkbox" checked name="lead_checked[]" value="{{ $lead_status->id }}" class="custom-control-input" id="leadCheckedFilter-{{ $lead_status->id }}">
                                                                                @else 
                                                                                <input type="checkbox" name="lead_checked[]" value="{{ $lead_status->id }}" class="custom-control-input" id="leadCheckedFilter-{{ $lead_status->id }}">
                                                                                @endif
                                                                                <label class="custom-control-label" for="leadCheckedFilter-{{ $lead_status->id }}">{{ $lead_status->status }}</label>
                                                                            </div>
                                                                        </div> 
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                <h2 class="mb-0">
                                                    <button class="btn btn-block text-left shadow-none" type="button" data-toggle="collapse" data-target="#collapse7" aria-expanded="{{ request()->client_status? 'true':'false' }}">
                                                        {{ __("Client Status") }}
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="collapse7" class="collapse {{ request()->client_status? 'show':'' }}">
                                                <div class="card-body">
                                                    @foreach (\App\Models\CRM\ClientTableStatus::all() as $client_status)
                                                        <div class="form-group">
                                                            <div class="custom-control custom-checkbox mb-0"> 
                                                                @if(isset(request()->client_status) && in_array($client_status->id, request()->client_status))
                                                                <input type="checkbox" checked name="client_status[]" value="{{ $client_status->id }}" class="custom-control-input" id="clientStatusFilter-{{ $client_status->id }}">
                                                                @else 
                                                                <input type="checkbox" name="client_status[]" value="{{ $client_status->id }}" class="custom-control-input" id="clientStatusFilter-{{ $client_status->id }}">
                                                                @endif
                                                                <label class="custom-control-label" for="clientStatusFilter-{{ $client_status->id }}">{{ $client_status->status }}</label>
                                                            </div>
                                                        </div> 
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="card">
                                            <div class="card-header">
                                                <h2 class="mb-0">
                                                    <button class="btn btn-block text-left shadow-none" type="button" data-toggle="collapse" data-target="#collapse1" aria-expanded="{{ request()->projects? 'true':'false' }}">
                                                        {{ __('Project status') }}
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="collapse1" class="collapse {{ request()->projects? 'show':'' }}">
                                                <div class="card-body">
                                                    @foreach (App\Models\CRM\ProjectTableStatus::all() as $project_status)
                                                        <div class="form-group">
                                                            <div class="custom-control custom-checkbox mb-0">  
                                                                @if(isset(request()->projects) && in_array($project_status->id, request()->projects))
                                                                <input type="checkbox" checked name="projects[]" value="{{ $project_status->id }}" class="custom-control-input" id="projectFilter-{{ $project_status->id }}">
                                                                 @else 
                                                                <input type="checkbox" name="projects[]" value="{{ $project_status->id }}" class="custom-control-input" id="projectFilter-{{ $project_status->id }}">
                                                                 @endif
                                                                <label class="custom-control-label" for="projectFilter-{{ $project_status->id }}">{{ $project_status->status }}</label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    {{-- <div class="form-group">
                                                        <div class="custom-control custom-checkbox mb-0"> 
                                                            <input type="checkbox" name="projects[]" class="custom-control-input" id="projectFilter-2">
                                                            <label class="custom-control-label" for="projectFilter-2">{{ __('Prévisite réalisée') }}</label>
                                                        </div>
                                                    </div> --}}


                                                    
                                                    <div class="form-group">
                                                        <div class="custom-control custom-checkbox mb-0"> 
                                                            <input type="checkbox" @if (isset(request()->projects) && in_array('0', request()->projects))
                                                                checked
                                                            @endif name="projects[]" value="0" class="custom-control-input" id="projectFilter-00">
                                                            <label class="custom-control-label" for="projectFilter-00">{{ __('No Status') }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                <h2 class="mb-0">
                                                    <button class="btn btn-block text-left shadow-none" type="button" data-toggle="collapse" data-target="#collapse6" aria-expanded="{{ request()->status? 'true':'false' }}">
                                                        {{ __("Status Planning") }} ({{ __('Intervention') }})
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="collapse6" class="collapse {{ request()->status? 'show':'' }}">
                                                <div class="card-body">
                                                    @foreach (getProjectStatusPlanning() as $status)
                                                        <div class="form-group">
                                                            <div class="custom-control custom-checkbox mb-0"> 
                                                                @if(isset(request()->status) && in_array($status->status, request()->status))
                                                                <input type="checkbox" checked name="status[]" value="{{ $status->status }}" class="custom-control-input" id="statusFilter-{{ $status->id }}">
                                                                 @else 
                                                                <input type="checkbox" name="status[]" value="{{ $status->status }}" class="custom-control-input" id="statusFilter-{{ $status->id }}">
                                                                 @endif
                                                                <label class="custom-control-label" for="statusFilter-{{ $status->id }}">{{ $status->status }}</label>
                                                            </div>
                                                        </div>
                                                    @endforeach 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                <h2 class="mb-0">
                                                    <button class="btn btn-block text-left shadow-none" type="button" data-toggle="collapse" data-target="#collapse2" aria-expanded="{{ request()->zone? 'true':'false' }}">
                                                        {{ __("Zone") }}
                                                    </button>
                                                </h2>
                                            </div>
                                            
                                            <div id="collapse2" class="collapse {{ request()->zone? 'show':'' }}">
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-checkbox mb-0"> 
                                                            @if(isset(request()->zone) && in_array('H1', request()->zone))
                                                            <input type="checkbox" checked name="zone[]" value="H1" class="custom-control-input" id="zoneFilter-1">
                                                            @else 
                                                            <input type="checkbox" name="zone[]" value="H1" class="custom-control-input" id="zoneFilter-1">
                                                            @endif
                                                            <label class="custom-control-label" for="zoneFilter-1">H1</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="custom-control custom-checkbox mb-0"> 
                                                            @if(isset(request()->zone) && in_array('H2', request()->zone))
                                                            <input checked type="checkbox" name="zone[]" value="H2" class="custom-control-input" id="zoneFilter-2">
                                                            @else 
                                                            <input type="checkbox" name="zone[]" value="H2" class="custom-control-input" id="zoneFilter-2">
                                                            @endif
                                                            <label class="custom-control-label" for="zoneFilter-2">H2</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="custom-control custom-checkbox mb-0"> 
                                                            @if(isset(request()->zone) && in_array('H3', request()->zone))
                                                            <input type="checkbox" checked name="zone[]" value="H3" class="custom-control-input" id="zoneFilter-3">
                                                            @else
                                                            <input type="checkbox" name="zone[]" value="H3" class="custom-control-input" id="zoneFilter-3">
                                                            @endif
                                                            <label class="custom-control-label" for="zoneFilter-3">H3</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="card">
                                            <div class="card-header">
                                                <h2 class="mb-0">
                                                    <button class="btn btn-block text-left shadow-none" type="button" data-toggle="collapse" data-target="#collapse3" aria-expanded="false">
                                                        {{ __("Leads") }}
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="collapse3" class="collapse">
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-checkbox mb-0"> 
                                                            <input type="checkbox" class="custom-control-input" id="leadsFilter-1">
                                                            <label class="custom-control-label" for="leadsFilter-1">{{ __('In Progress') }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="custom-control custom-checkbox mb-0"> 
                                                            <input type="checkbox" class="custom-control-input" id="leadsFilter-2">
                                                            <label class="custom-control-label" for="leadsFilter-2">{{ __('Pre-validate') }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="custom-control custom-checkbox mb-0"> 
                                                            <input type="checkbox" class="custom-control-input" id="leadsFilter-2">
                                                            <label class="custom-control-label" for="leadsFilter-2">{{ __('Checked') }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                        <div class="card">
                                            <div class="card-header">
                                                <h2 class="mb-0">
                                                    <button class="btn btn-block text-left shadow-none" type="button" data-toggle="collapse" data-target="#collapse4" aria-expanded="{{ request()->department? 'true':'false' }}">
                                                        {{ __("Department") }}
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="collapse4" class="collapse {{ request()->department? 'show':'' }}">
                                                <div class="card-body">
                                                    @foreach (\App\Models\CRM\ZoneInfo::all() as $zone)
                                                        <div class="form-group">
                                                            <div class="custom-control custom-checkbox mb-0"> 
                                                                @if(isset(request()->department) && in_array($zone->city, request()->department))
                                                                <input type="checkbox" checked name="department[]" value="{{ $zone->city }}" class="custom-control-input" id="departmentFilter-{{ $zone->id }}">
                                                                 @else 
                                                                <input type="checkbox" name="department[]" value="{{ $zone->city }}" class="custom-control-input" id="departmentFilter-{{ $zone->id }}">
                                                                 @endif
                                                                <label class="custom-control-label" for="departmentFilter-{{ $zone->id }}">{{ $zone->city }}</label>
                                                            </div>
                                                        </div>
                                                    @endforeach 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                <h2 class="mb-0">
                                                    <button class="btn btn-block text-left shadow-none" type="button" data-toggle="collapse" data-target="#collapse5" aria-expanded="{{ request()->precariousness? 'true':'false' }}">
                                                        {{ __("Precariousness") }}
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="collapse5" class="collapse {{ request()->precariousness? 'show':'' }}">
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-checkbox mb-0"> 
                                                            @if(isset(request()->precariousness) && in_array("Classique", request()->precariousness))
                                                            <input type="checkbox" checked name="precariousness[]" value="Classique" class="custom-control-input" id="precariousnessFilter-1">
                                                             @else 
                                                            <input type="checkbox" name="precariousness[]" value="Classique" class="custom-control-input" id="precariousnessFilter-1">
                                                             @endif
                                                            <label class="custom-control-label" for="precariousnessFilter-1">Classique</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="custom-control custom-checkbox mb-0"> 
                                                            @if(isset(request()->precariousness) && in_array("Intermediaire", request()->precariousness))
                                                            <input type="checkbox" checked name="precariousness[]" value="Intermediaire" class="custom-control-input" id="precariousnessFilter-2">
                                                            @else
                                                            <input type="checkbox" name="precariousness[]" value="Intermediaire" class="custom-control-input" id="precariousnessFilter-2">
                                                            @endif
                                                            <label class="custom-control-label" for="precariousnessFilter-2">Intermediaire</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="custom-control custom-checkbox mb-0"> 
                                                            @if(isset(request()->precariousness) && in_array("Precaire", request()->precariousness))
                                                            <input type="checkbox" checked name="precariousness[]" value="Precaire" class="custom-control-input" id="precariousnessFilter-3">
                                                            @else
                                                            <input type="checkbox" name="precariousness[]" value="Precaire" class="custom-control-input" id="precariousnessFilter-3">
                                                            @endif
                                                            <label class="custom-control-label" for="precariousnessFilter-3">Precaire</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="custom-control custom-checkbox mb-0"> 
                                                            @if(isset(request()->precariousness) && in_array("Grand Precaire", request()->precariousness))
                                                            <input type="checkbox" checked name="precariousness[]" value="Grand Precaire" class="custom-control-input" id="precariousnessFilter-4">
                                                            @else
                                                            <input type="checkbox" name="precariousness[]" value="Grand Precaire" class="custom-control-input" id="precariousnessFilter-4">
                                                            @endif
                                                            <label class="custom-control-label" for="precariousnessFilter-4">Grand Precaire</label>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="card">
                                            <div class="card-header">
                                                <h2 class="mb-0">
                                                    <button class="btn btn-block text-left shadow-none" type="button" data-toggle="collapse" data-target="#collapse3" aria-expanded="{{ request()->travaux? 'true':'false' }}">
                                                        {{ __("Type of travaux") }}
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="collapse3" class="collapse {{ request()->travaux? 'show':'' }}">
                                                <div class="card-body">
                                                    {{-- @foreach (\App\Models\CRM\TravauxList::all() as $travaux)
                                                        <div class="form-group">
                                                            <div class="custom-control custom-checkbox mb-0"> 
                                                                @if(isset(request()->travaux) && in_array($travaux->travaux, request()->travaux))
                                                                <input type="checkbox" checked name="travaux[]" value="{{ $travaux->travaux }}" class="custom-control-input" id="travauxFilter-{{ $travaux->id }}">
                                                                @else 
                                                                <input type="checkbox" name="travaux[]" value="{{ $travaux->travaux }}" class="custom-control-input" id="travauxFilter-{{ $travaux->id }}">
                                                                @endif
                                                                <label class="custom-control-label" for="travauxFilter-{{ $travaux->id }}">{{ $travaux->travaux }}</label>
                                                            </div>
                                                        </div> 
                                                    @endforeach --}}
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="card">
                                            <div class="card-header">
                                                <h2 class="mb-0">
                                                    <button class="btn btn-block text-left shadow-none" type="button" data-toggle="collapse" data-target="#collapse9" aria-expanded="{{ request()->product? 'true':'false' }}">
                                                        {{ __("Products") }}
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="collapse9" class="collapse {{ request()->product? 'show':'' }}">
                                                <div class="card-body">
                                                    @foreach (getTravauxProduct() as $product)
                                                        <div class="form-group">
                                                            <div class="custom-control custom-checkbox mb-0"> 
                                                                @if(isset(request()->product) && in_array($product->product, request()->product))
                                                                <input type="checkbox" checked name="product[]" value="{{ $product->product }}" class="custom-control-input" id="productFilter-{{ $product->id }}">
                                                                @else 
                                                                <input type="checkbox" name="product[]" value="{{ $product->product }}" class="custom-control-input" id="productFilter-{{ $product->id }}">
                                                                @endif
                                                                <label class="custom-control-label" for="productFilter-{{ $product->id }}">{{ $product->product }}</label>
                                                            </div>
                                                        </div> 
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="text-center mt-2">
                                        <button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 w-100">
                                            {{ __('Submit') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- <div class="dropdown p-0 d-inline-block position-absolute">
            <button type="button" class="btn primary-btn primary-btn--primary shadow-none dropdown-toggle d-inline-flex align-items-center" id="customSelectDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="-50%, 5">
                <span class="novecologie-icon-filter dropdown-icon mr-2"></span>
                map filter
            </button>
            <div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
                <a href="{{ route('map.index', 'ALL') }}" type="button" class="dropdown-item border-0">
                    ALL
                </a>
                @foreach (getProjectStatusPlanning() as $item)
                <a href="{{ route('map.index', $item->status) }}" type="button" class="dropdown-item border-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="45.716" height="60.955" class="dropdown-item__image w-100 h-100" viewBox="0 0 45.716 60.955">
                        <path id="geo-alt-fill" d="M24.858,60.955s22.858-21.662,22.858-38.1A22.858,22.858,0,1,0,2,22.858C2,39.293,24.858,60.955,24.858,60.955Zm0-26.668A11.429,11.429,0,1,1,36.287,22.858,11.429,11.429,0,0,1,24.858,34.287Z" transform="translate(-2)" fill="{{ $item->color }}"/>
                    </svg>
                    {{ $item->status }}
                </a>
                @endforeach
            </div>
        </div> --}}
        @foreach ($projects as $project)
        @php
           $travaux = \App\Models\CRM\Work::where('project_id', $project->id)->first();

           $financement = explode(',', $travaux->financement ?? '');
        @endphp
            {{-- client status modal  --}}
            <div class="modal modal--map fade" id="projectDetails{{ $project->id }}" tabindex="-1" aria-labelledby="projectDetailsLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0">
                        <div class="modal-header border-0 pb-0">
                            <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                                <span class="novecologie-icon-close"></span>
                            </button>
                        </div>
                        <div class="modal-body pt-0">
                            <h3 class="modal--map__title text-uppercase">{{ $project->getClient->first_name }}</h3>
                            <address class="modal--map__address">
                                <svg xmlns="http://www.w3.org/2000/svg" width="45.716" height="60.955" class="modal--map__address__icon w-100 h-100" viewBox="0 0 45.716 60.955">
                                    <path id="geo-alt-fill" d="M24.858,60.955s22.858-21.662,22.858-38.1A22.858,22.858,0,1,0,2,22.858C2,39.293,24.858,60.955,24.858,60.955Zm0-26.668A11.429,11.429,0,1,1,36.287,22.858,11.429,11.429,0,0,1,24.858,34.287Z" transform="translate(-2)" fill="#4D056E"></path>
                                </svg>
                                <span>{{ $project->address }}</span>
                            </address>
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="font-weight-bold">{{ __('Travaux') }}</td>
                                        <td><span class="px-2">:</span> {{ $travaux->travaux ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">{{ __('Financement') }}</td>
                                        <td><span class="px-2">:</span> 
                                            @forelse ($financement as $item)
                                            @if ($item)
                                            <span class="badge-btn rounded-pill m-1">{{ $item }}</span>
                                            @endif
                                            @empty    
                                             {{ __('Pas de financement') }}
                                            @endforelse
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="text-center mt-4">
                                <a href="tel:+{{ $project->getClient->phone }}" class="primary-btn primary-btn--primary primary-btn--lg fix-btn-width rounded-pill d-inline-flex align-items-center justify-content-center ">Contacter</a>
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
                @if (role() == 's_admin')
                    @foreach ($users as $user)
                        [`<a href='#!' class="leaflet-popup-content-wrapper__link">{{ $user->name }}</a>`, {{ $user->lat_address }}, {{ $user->lon_address }},
                            new userMarkerIcon({iconUrl:
                                @if ($user->profile_photo) 
                                    "{{ asset('uploads/crm/profiles/'.$user->profile_photo) }}"
                                @else
                                    "{{ asset('crm_assets/assets/images/icons/user.png') }}"
                                @endif
                            }),
                        ],   
                    @endforeach
                @endif
                
                @forelse ($projects as $project) 
                [`<a  data-toggle="modal" data-target="#projectDetails{{ $project->id }}" class="leaflet-popup-content-wrapper__link" target='_blank'>{{ $project->project_name }}</a>`, {{ $project->address_lat }}, {{ $project->address_lng }},
                defaultSvgMarkerIcon("{{ getStatusColor($project->status) }}")

                ],  
                @empty
                ['No Project Found', lat, lng, defaultSvgMarkerIcon('rgba(255,0,0,0.92)')],
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
                var radius = e.accuracy / 2;

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

            @if ($filtered == 'no')
            map.on('locationfound', onLocationFound);
            @endif
            map.on('locationerror', onLocationError);

            map.locate({
                // setView: true,
                watch: true,
                maxZoom: 13,
            });
            
        })()
    };
</script>
  
@endpush