@foreach ($leadList as $lead) 
    @if (role() == 's_admin' || $lead->lead_telecommercial == Auth::id())
        <li class="dashboard-list__item">
            <div class="media  
            media--success  ">
                <div class="media-header rounded">
                    <i class="bi bi-bar-chart"></i>
                </div>
                <div class="media-body align-items-center">
                    <h4 class="media-body__title font-weight-normal">{{ $lead->Prenom??__('Not Provided') }}</h4>
                    <p class="media-body__sub-title d-flex">
                        {{ $lead->getStatus->status ?? '' }} 
                            <a href="{{ route('leads.index',[$lead->company_id ,$lead->id]) }}" data-toggle="tooltip" data-placement="top" title="View"  class=" text-success font-weight-bold ml-auto"><i class="bi bi-eye"></i></a> 
                        
                    </p>
                </div>
            </div>
        </li> 
    @endif
@endforeach