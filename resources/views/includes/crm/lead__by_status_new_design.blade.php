 @php
     $x_code= 'empty';
 @endphp

@if ($filter_status->count() + $customFilterStatus->count() == 0)
    @forelse ($leads as $lead)
            @if ($x_code != substr($lead->postal_code, 0,2))
                <tr>
                    <td colspan="500" class="text-white" style="background-color: #000">{{ $lead->postal_code ? getDepartment3($lead->postal_code).' '.substr($lead->postal_code, 0,2) : __('No Department') }}</td>
                </tr>
            @endif
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"name="checkedLead[]" value="{{ $lead->id }}" class="custom-control-input table-select-checkbox lead_checkbox_item" data-id="{{ $lead->id }}"  id="tableThreeRowSelectCheck-{{ $lead->id }}">
                            <label class="custom-control-label" for="tableThreeRowSelectCheck-{{ $lead->id }}"></label>
                        </div>
                    </td>

                    <td>{{ $lead->id }}</td>
                    <td>{{ $lead->first_name??__('Not Provided') }}</td>
                    <td>{{ $lead->phone??__('Not Provided') }}</td>
                    <td>{{ $lead->email??__('Not Provided') }}</td>
                    <td>{{ $lead->postal_code??__('Not Provided') }}</td>
                    <td>{{ $lead->heating_type??__('Not Provided') }}</td>
                    {{-- @if() --}}
                    @isset($company_name)
                    <td>{{ $lead->company_name }}</td>
                    @endisset
                    <td class="text-left">
                        {{-- <button data-toggle="modal" tyle="background-color:{{ $lead->getSubStatus ? $lead->getSubStatus->background_color : '#8e27b3' }} ; color: {{ $lead->getSubStatus ? $lead->getSubStatus->text_color : '#fff' }}" data-target="#leadSubStatusChangeModal{{ $lead->id }}" type="button" class=" primary-btn  primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0">
                            {{ $lead->getSubStatus ? $lead->getSubStatus->name : (($lead->user_status == 2) ? 'Nouvelle demande': 'Pas de sous statut') }}
                        </button> --}}
                        <button data-toggle="modal" tyle="background-color:{{ $lead->getSubStatus ? $lead->getSubStatus->background_color : '#8e27b3' }} ; color: {{ $lead->getSubStatus ? $lead->getSubStatus->text_color : '#fff' }}" data-target="#leadSubStatusChangeModal{{ $lead->id }}" type="button" class=" badge--custom">
                            {{ $lead->getSubStatus ? $lead->getSubStatus->name : (($lead->user_status == 2) ? 'Nouvelle demande': 'Pas de sous statut') }}
                        </button>
                    </td>
                    <td>
                        <div class="avatar-group d-flex">
                            @if (getLeadAssignee($lead->id)->count() > 3)
                                @foreach(getLeadAssignee($lead->id) as $item)
                                <a href="#!" class="avatar-group__image-wrapper rounded-circle overflow-hidden" data-toggle="tooltip" data-placement="top" title="{{ getAssigneePhoto($item->user_id)->name }}">
                                    @if (getAssigneePhoto($item->user_id)->profile_photo)
                                    <img src="{{ asset('uploads/crm/profiles') }}/{{ getAssigneePhoto($item->user_id)->profile_photo }}" alt="{{ getAssigneePhoto($item->user_id)->name }}" class="avatar-group__image w-100 h-100">
                                    @else
                                    <img src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="avatar image" class="avatar-group__image w-100 h-100">
                                    @endif
                                </a>
                                @if ($loop->iteration > 3)
                                    @if (getLeadAssignee($lead->id)->count() > 4)
                                    <a href="#!" class="avatar-group__more">+{{ getLeadAssignee($lead->id)->count() - 4 }} {{ __('more') }}</a>
                                    @endif
                                    @break
                                @endif
                                @endforeach
                            @else
                                @forelse (getLeadAssignee($lead->id) as $item)
                                <a href="#!" class="avatar-group__image-wrapper rounded-circle overflow-hidden" data-toggle="tooltip" data-placement="top" title="{{ getAssigneePhoto($item->user_id)->name }}">
                                    @if (getAssigneePhoto($item->user_id)->profile_photo)
                                    <img src="{{ asset('uploads/crm/profiles') }}/{{ getAssigneePhoto($item->user_id)->profile_photo }}" alt="{{ getAssigneePhoto($item->user_id)->name }}" class="avatar-group__image w-100 h-100">
                                    @else
                                    <img src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="avatar image" class="avatar-group__image w-100 h-100">
                                    @endif
                                </a>
                                @empty
                                {{ __('No assignee') }}
                                @endforelse
                            @endif
                        </div>
                    </td>
                    <td class="text-center">
                        @if ($lead->user_status == 6)
                            @if (role() == 'manager' || role() == 's_admin')
                                <button type="button" class="next-btn border-0 d-inline-flex justify-content-center align-items-center rounded-circle" data-target="#lead_status__change{{ $lead->id }}" data-toggle="modal"><span class="novecologie-icon-chevron-right"></span></button>
                            @else
                                <button type="button" class="next-btn border-0 d-inline-flex justify-content-center align-items-center rounded-circle" data-toggle="tooltip" data-placement="top" title="Ce prospect est validé"><span class="novecologie-icon-chevron-right"></span></button>
                            @endif
                        @else
                            <button type="button" class="next-btn border-0 d-inline-flex justify-content-center align-items-center rounded-circle" data-target="#lead_status__change{{ $lead->id }}" data-toggle="modal"><span class="novecologie-icon-chevron-right"></span></button>
						@endif
                        {{-- <button type="button" class="btn p-1 shadow-none" data-target="#lead_status__change{{ $lead->id }}" data-toggle="modal"><img style="max-height: 25px" src="{{ asset('crm_assets/assets/images/icons/right-arrow.png') }}" alt="icon"></button> --}}

                        {{-- <button type="button" class="btn p-1 shadow-none"><img style="max-height: 30px" src="{{ asset('crm_assets/assets/images/icons/maprimerenov-logo.png') }}" alt="icon"></button> --}}
                    </td>
                    <td>
                        <div class="d-flex align-items-center justify-content-end action-btns-wrapper">
                            @if (checkAction(Auth::id(), 'lead', 'edit') || role() == 's_admin')
                                <a href="{{ route('leads.index',[$lead->company_id ,$lead->id]) }}" class="primary-btn primary-btn--blue w-auto d-inline-flex justify-content-center align-items-center rounded px-4">
                                    {{ __('Update') }}
                                </a>
                            @endif
                        </div>
                    </td>
                </tr>
        @php
            $x_code = substr($lead->postal_code, 0,2);
        @endphp

        @push('all_modals')
            <div class="modal modal--aside fade" id="leadSubStatusChangeModal{{ $lead->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0">
                        <div class="modal-header border-0 pb-0">
                            <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                                <span class="novecologie-icon-close"></span>
                            </button>
                        </div>
                        <div class="modal-body text-center pt-0">
                            <h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
                            <form action="{{ route('lead.status.change') }}" method="POST" class="status_change__modal">
                                @csrf
                                <input type="hidden" name="id" value="{{ $lead->id }}">
                                <input type="hidden" name="status" value="{{ $lead->user_status }}">
                                <div class="status_change__input text-left">
                                    <div class="form-group text-left mt-3">
                                        <label class="form-label" for="lead_staus_news{{ $lead->id }}">Merci de renseigner le nouveau statut de votre prospect</label>
                                        <select name="sub_status" id="lead_staus_news{{ $lead->id }}" class="select2_select_option custom-select shadow-none form-control">
                                            <option value="" selected>{{ __('Select') }}</option>
                                            @foreach ($lead_sub_status as $sub_status)
                                                <option {{ $lead->sub_status == $sub_status->id ? 'selected':'' }} value="{{ $sub_status->id }}">{{ $sub_status->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if ($lead->user_status == 5)
                                        <div class="form-group">
                                            <label class="form-label" for="dead-reason">Raisons <span class="text-danger">*</span></label>
                                            <textarea rows="3" name="dead_reason"  id="dead-reason" class="form-control shadow-none" required>{{ $lead->comment }}</textarea>
                                        </div>
                                    @endif
                                </div>
                                <button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-2">
                                    {{ __('Submit') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal modal--aside fade" id="lead_status__change{{ $lead->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0">
                        <div class="modal-header border-0 pb-0">
                            <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                                <span class="novecologie-icon-close"></span>
                            </button>
                        </div>
                        <div class="modal-body text-center pt-0">
                            <h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
                            <span>Confirmer le nouvelle etiquette de votre prospect</span>
                            <form action="{{ route('lead.status.change') }}" method="POST" class="status_change__modal">
                                @csrf
                                <input type="hidden" name="id" value="{{ $lead->id }}">
                                <div class="status_change__btn_block">
                                    <div class="d-flex justify-content-center">
                                        <button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
                                            Non
                                        </button>
                                        <button type="button" class="primary-btn btn-success primary-btn--md rounded border-0 my-3 mx-1 status_change__btn">
                                            Oui
                                        </button>
                                    </div>
                                </div>
                                <div class="status_change__input text-left" style="display: none">
                                    <div class="form-group mt-3">
                                        <label class="form-label" for="lead_staus_new{{ $lead->id }}">Merci de renseigner le nouveau etiquette de votre prospect</label>
                                        <select name="status" id="lead_staus_new{{ $lead->id }}" class="select2_select_option custom-select shadow-none form-control lead_staus__change" required>
                                            <option value="" selected>{{ __('Select') }}</option>
                                            <option {{ $lead->user_status == 2 ? 'selected':'' }} value="2">Nouveau</option>
                                            <option {{ $lead->user_status == 3 ? 'selected':'' }} value="3">En cours</option>
                                            <option {{ $lead->user_status == 4 ? 'selected':'' }} value="4">NRP</option>
                                            <option {{ $lead->user_status == 5 ? 'selected':'' }} value="5">KO</option>
                                            <option {{ $lead->user_status == 6 ? 'selected':'' }} value="6">Validation</option>
                                        </select>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label class="form-label" for="lead_staus_new{{ $lead->id }}">Merci de renseigner le nouveau statut de votre prospect</label>
                                        <select name="sub_status" id="lead_staus_new{{ $lead->id }}" class="select2_select_option custom-select shadow-none form-control" required>
                                            <option value="" selected>{{ __('Select') }}</option>
                                            @foreach ($lead_sub_status as $sub_status)
                                                <option {{ $lead->sub_status == $sub_status->id ? 'selected':'' }} value="{{ $sub_status->id }}">{{ $sub_status->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group dead_reason__wrap" style="display: none">
                                        <label class="form-label" for="dead-reason{{ $lead->id }}">Raisons <span class="text-danger">*</span></label>
                                        <textarea rows="3" name="dead_reason" id="dead-reason{{ $lead->id }}" class="form-control shadow-none"></textarea>
                                    </div>
                                    <button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-2">
                                        {{ __('Submit') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endpush
    @empty
    <tr>
        <td colspan="100" class="text-center"> <h3>Aucune donnée trouvée</h3></td>
    </tr>
    @endforelse
@else
    @forelse ($leads as $lead)
            @if ($x_code != substr($lead->postal_code, 0,2))
                <tr>
                    <td colspan="500" class="text-white" style="background-color: #000">{{ $lead->postal_code ? getDepartment3($lead->postal_code). ' '.substr($lead->postal_code, 0,2) : __('No Department') }}</td>
                </tr>
            @endif
            <tr>
                <td>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="checkedLead[]"  value="{{ $lead->id }}" class="custom-control-input table-select-checkbox lead_checkbox_item"  data-id="{{ $lead->id }}" id="tableThreeRowSelectCheck-{{ $lead->id }}">
                        <label class="custom-control-label" for="tableThreeRowSelectCheck-{{ $lead->id }}"></label>
                    </div>
                </td>
                @foreach ($filter_status as $item)
                    @php
                        $header = \App\Models\CRM\LeadHeader::where('id', $item->lead_header_id)->first()->header;
                    @endphp
                    @if($header == 'ID')
                    <td>{{ $lead->id??__('Not Provided') }}</td>
                    @endif
                    @if($header == 'tracker name'||$header == 'nom du traqueur')
                    <td>{{ $lead->tracker_name??__('Not Provided') }}</td>
                    @endif
                    @if($header == 'tracker platform'||$header == 'plateforme de suivi')
                    <td>{{ $lead->tracker_platform??__('Not Provided') }}</td>
                    @endif
                    @if($header == 'tracker email'||$header == 'e-mail de suivi')
                    <td>{{ $lead->tracker_email??__('Not Provided') }}</td>
                    @endif
                    @if($header == 'tracker phone'||$header == 'téléphone traqueur')
                    <td>{{ $lead->tracker_phone??__('Not Provided') }}</td>
                    @endif
                    @if($header == 'project name'||$header == 'project name')
                    <td>{{ $lead->project_name??__('Not Provided') }}</td>
                    @endif
                    @if($header == 'first name'|$header == 'prénom' )
                    <td>{{ $lead->first_name??__('Not Provided') }}</td>
                    @endif
                    @if($header == 'last name'||$header == 'nom de famille')
                    <td>{{ $lead->last_name??__('Not Provided') }}</td>
                    @endif
                    @if($header == 'phone'||$header == 'téléphone')
                    <td>{{ $lead->phone??__('Not Provided') }}</td>
                    @endif
                    @if($header == 'email'|| $header == 'e-mail')
                    <td>{{ $lead->email??__('Not Provided') }}</td>
                    @endif
                    @if($header == 'department' || $header == 'département')
                    <td>{{ $lead->postal_code ? getDepartment3($lead->postal_code) : __('Not Provided') }}</td>
                    @endif
                    @if($header == 'precariousness' || $header == 'précarité')
                    <td>{{ $lead->precariousness??__('Not Provided') }}</td>
                    @endif
                    @if($header == 'zone'|| $header == 'zone')
                    <td>{{ $lead->zone??__('Not Provided') }}</td>
                    @endif
                    @if($header == 'postal code' || $header == 'code postal')
                    <td>{{ $lead->postal_code??__('Not Provided') }}</td>
                    @endif
                    @if($header == 'country' || $header == 'pays')
                    <td>{{ $lead->country??__('Not Provided') }}</td>
                    @endif
                    @if($header == 'city'||$header =='ville')
                    <td>{{ $lead->city??__('Not Provided') }}</td>
                    @endif
                    @if($header == 'address'||$header == 'adresse')
                    <td>{{ $lead->address??__('Not Provided') }}</td>
                    @endif
                    @if($header == 'nature occupation'|| $header == 'métier de la nature')
                    <td>{{ $lead->nature_occupation??__('Not Provided') }}</td>
                    @endif
                    @if($header == 'heating type'|| $header == 'type de chauffage')
                    <td>{{ $lead->heating_type??__('Not Provided') }}</td>
                    @endif
                    @if($header == 'electricity connection'|| $header == 'branchement électrique')
                    <td>{{ $lead->electricity_connection??__('Not Provided') }}</td>
                    @endif
                    @if($header == 'living space'||$header == 'espace vital')
                    <td>{{ $lead->living_space??__('Not Provided') }}</td>
                    @endif
                    @if($header == 'cadstrable plot'|| $header == 'parcelle cadastrable')
                    <td>{{ $lead->cadstrable_plot??__('Not Provided') }}</td>
                    @endif
                    @if($header == 'floor area'||$header =='surface de plancher')
                    <td>{{ $lead->floor_area??__('Not Provided') }}</td>
                    @endif
                    @if($header == 'house type'||$header =='type de maison')
                    <td>{{ $lead->house_type??__('Not Provided') }}</td>
                    @endif
                    @if($header == 'with basement'||$header =='avec sous-sol')
                    <td>{{ $lead->with_basement??__('Not Provided') }}</td>
                    @endif
                    @if($header == 'owner'||$header =='propriétaire')
                    <td>{{ $lead->owner??__('Not Provided') }}</td>
                    @endif
                    @if($header == 'house over 15 years'||$header =='maison de plus de 15 ans')
                    <td>{{ $lead->house_over_15_years??__('Not Provided') }}</td>
                    @endif
                    @if($header == 'date'||$header =='date')
                    <td>{{ $lead->date??__('Not Provided') }}</td>
                    @endif
                    @if($header == 'duplicate analysis'||$header =='analyse des doublons')
                    <td>{{ $lead->tracker_name??__('Not Provided') }}</td>
                    @endif
                    @if($header == 'management'||$header =='la gestion')
                    <td>{{ $lead->management??__('Not Provided') }}</td>
                    @endif
                    @if($header == 'transfer office 17'||$header =='bureau de transfert 17')
                    <td>{{ $lead->transfer_office_17??__('Not Provided') }}</td>
                    @endif
                @endforeach
                @foreach ($customFilterStatus as $item)
                    @php
                        $header_name = \App\Models\LeadCustomField::where('id', $item->header_id)->first()->name;
                    @endphp
                    <td>
                            @if(getLeadCustomInputValue($lead->id,$header_name))
                            {{ getLeadCustomInputValue($lead->id,$header_name)  }}
                            @else
                            {{ __('Not Provided') }}
                            @endif
                    </td>
                @endforeach
                @isset($company_name)
                <td>{{ $lead->company_name }}</td>
                @endisset
                <td class="text-left">
                    {{-- <button data-toggle="modal" style="background-color:{{ $lead->getSubStatus ? $lead->getSubStatus->background_color : '#8e27b3' }} ; color: {{ $lead->getSubStatus ? $lead->getSubStatus->text_color : '#fff' }}" data-target="#leadSubStatusChangeModal{{ $lead->id }}" type="button" class=" primary-btn primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0">
                        {{ $lead->getSubStatus ? $lead->getSubStatus->name : (($lead->user_status == 2) ? 'Nouvelle demande': 'Pas de sous statut') }}
                    </button> --}}
                    <button data-toggle="modal" style="color: {{ $lead->getSubStatus ? $lead->getSubStatus->text_color : '#4D056E' }}" data-target="#leadSubStatusChangeModal{{ $lead->id }}" type="button" class=" badge--custom rounded-pill">
                        {{ $lead->getSubStatus ? $lead->getSubStatus->name : (($lead->user_status == 2) ? 'Nouvelle demande': 'Pas de sous statut') }}
                    </button>
                </td>

                <td>
                    <div class="avatar-group d-flex">
                        @if (getLeadAssignee($lead->id)->count() > 3)
                            @foreach(getLeadAssignee($lead->id) as $item)
                            <a href="#!" class="avatar-group__image-wrapper rounded-circle overflow-hidden" data-toggle="tooltip" data-placement="top" title="{{ getAssigneePhoto($item->user_id)->name }}">
                                @if (getAssigneePhoto($item->user_id)->profile_photo)
                                <img src="{{ asset('uploads/crm/profiles') }}/{{ getAssigneePhoto($item->user_id)->profile_photo }}" alt="{{ getAssigneePhoto($item->user_id)->name }}" class="avatar-group__image w-100 h-100">
                                @else
                                <img src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="avatar image" class="avatar-group__image w-100 h-100">
                                @endif
                            </a>
                            @if ($loop->iteration > 3)
                                @if (getLeadAssignee($lead->id)->count() > 4)
                                <a href="#!" class="avatar-group__more">+{{ getLeadAssignee($lead->id)->count() - 4 }} {{ __('more') }}</a>
                                @endif
                                @break
                            @endif
                            @endforeach
                        @else
                            @forelse (getLeadAssignee($lead->id) as $item)
                            <a href="#!" class="avatar-group__image-wrapper rounded-circle overflow-hidden" data-toggle="tooltip" data-placement="top" title="{{ getAssigneePhoto($item->user_id)->name }}">
                                @if (getAssigneePhoto($item->user_id)->profile_photo)
                                <img src="{{ asset('uploads/crm/profiles') }}/{{ getAssigneePhoto($item->user_id)->profile_photo }}" alt="{{ getAssigneePhoto($item->user_id)->name }}" class="avatar-group__image w-100 h-100">
                                @else
                                <img src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="avatar image" class="avatar-group__image w-100 h-100">
                                @endif
                            </a>
                            @empty
                            {{ __('No assignee') }}
                            @endforelse
                        @endif
                    </div>
                </td>
                <td class="text-center">
                    @if ($lead->user_status == 6)
                        @if (role() == 'manager' || role() == 's_admin')
                            <button type="button" class="next-btn border-0 d-inline-flex justify-content-center align-items-center rounded-circle" data-target="#lead_status__change{{ $lead->id }}" data-toggle="modal"><span class="novecologie-icon-chevron-right"></span></button>
                        @else
                            <button type="button" class="next-btn border-0 d-inline-flex justify-content-center align-items-center rounded-circle" data-toggle="tooltip" data-placement="top" title="Ce prospect est validé"><span class="novecologie-icon-chevron-right"></span></button>
                        @endif
                    @else
                        <button type="button" class="next-btn border-0 d-inline-flex justify-content-center align-items-center rounded-circle" data-target="#lead_status__change{{ $lead->id }}" data-toggle="modal"><span class="novecologie-icon-chevron-right"></span></button>
                    @endif
                    {{-- <button type="button" class="btn p-1 shadow-none" data-target="#lead_status__change{{ $lead->id }}" data-toggle="modal"><img style="max-height: 25px" src="{{ asset('crm_assets/assets/images/icons/right-arrow.png') }}" alt="icon"></button> --}}
                    {{-- <button type="button" class="btn p-1 shadow-none"><img style="max-height: 30px" src="{{ asset('crm_assets/assets/images/icons/maprimerenov-logo.png') }}" alt="icon"></button> --}}
                </td>
                <td>
                    <div class="d-flex align-items-center justify-content-center action-btns-wrapper">
                        @if (checkAction(Auth::id(), 'lead', 'edit') || role() == 's_admin')
                            <a href="{{ route('leads.index',[$lead->company_id ,$lead->id]) }}" class="primary-btn primary-btn--blue w-auto d-inline-flex justify-content-center align-items-center rounded px-4">
                                {{ __('Update') }}
                            </a>
                        @endif
                    </div>
                </td>
            </tr>
        @php
            $x_code = substr($lead->postal_code, 0,2);
        @endphp
        @push('all_modals')
            <div class="modal modal--aside fade" id="leadSubStatusChangeModal{{ $lead->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0">
                        <div class="modal-header border-0 pb-0">
                            <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                                <span class="novecologie-icon-close"></span>
                            </button>
                        </div>
                        <div class="modal-body text-center pt-0">
                            <h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
                            <form action="{{ route('lead.status.change') }}" method="POST" class="status_change__modal">
                                @csrf
                                <input type="hidden" name="id" value="{{ $lead->id }}">
                                <input type="hidden" name="status" value="{{ $lead->user_status }}">
                                <div class="status_change__input text-left">
                                    <div class="form-group text-left mt-3">
                                        <label class="form-label" for="lead_staus_news{{ $lead->id }}">Merci de renseigner le nouveau statut de votre prospect</label>
                                        <select name="sub_status" id="lead_staus_news{{ $lead->id }}" class="select2_select_option custom-select shadow-none form-control">
                                            <option value="" selected>{{ __('Select') }}</option>
                                            @foreach ($lead_sub_status as $sub_status)
                                                <option {{ $lead->sub_status == $sub_status->id ? 'selected':'' }} value="{{ $sub_status->id }}">{{ $sub_status->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if ($lead->user_status == 5)
                                        <div class="form-group">
                                            <label class="form-label" for="dead-reason">Raisons <span class="text-danger">*</span></label>
                                            <textarea rows="3" name="dead_reason"  id="dead-reason" class="form-control shadow-none" required>{{ $lead->comment }}</textarea>
                                        </div>
                                    @endif
                                </div>
                                <button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-2">
                                    {{ __('Submit') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal modal--aside fade" id="lead_status__change{{ $lead->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0">
                        <div class="modal-header border-0 pb-0">
                            <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                                <span class="novecologie-icon-close"></span>
                            </button>
                        </div>
                        <div class="modal-body text-center pt-0">
                            <h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
                            <span>Confirmer le nouvelle etiquette de votre prospect</span>
                            <form action="{{ route('lead.status.change') }}" method="POST" class="status_change__modal">
                                @csrf
                                <input type="hidden" name="id" value="{{ $lead->id }}">
                                <div class="status_change__btn_block">
                                    <div class="d-flex justify-content-center">
                                        <button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
                                            Non
                                        </button>
                                        <button type="button" class="primary-btn btn-success primary-btn--md rounded border-0 my-3 mx-1 status_change__btn">
                                            Oui
                                        </button>
                                    </div>
                                </div>
                                <div class="status_change__input text-left" style="display: none">
                                    <div class="form-group mt-3">
                                        <label class="form-label" for="lead_staus_new{{ $lead->id }}">Merci de renseigner le nouveau etiquette de votre prospect</label>
                                        <select name="status" id="lead_staus_new{{ $lead->id }}" class="select2_select_option custom-select shadow-none form-control lead_staus__change" required>
                                            <option value="" selected>{{ __('Select') }}</option>
                                            <option {{ $lead->user_status == 2 ? 'selected':'' }} value="2">Nouveau</option>
                                            <option {{ $lead->user_status == 3 ? 'selected':'' }} value="3">En cours</option>
                                            <option {{ $lead->user_status == 4 ? 'selected':'' }} value="4">NRP</option>
                                            <option {{ $lead->user_status == 5 ? 'selected':'' }} value="5">KO</option>
                                            <option {{ $lead->user_status == 6 ? 'selected':'' }} value="6">Validation</option>
                                        </select>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label class="form-label" for="lead_staus_new{{ $lead->id }}">Merci de renseigner le nouveau statut de votre prospect</label>
                                        <select name="sub_status" id="lead_staus_new{{ $lead->id }}" class="select2_select_option custom-select shadow-none form-control" required>
                                            <option value="" selected>{{ __('Select') }}</option>
                                            @foreach ($lead_sub_status as $sub_status)
                                                <option {{ $lead->sub_status == $sub_status->id ? 'selected':'' }} value="{{ $sub_status->id }}">{{ $sub_status->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group dead_reason__wrap" style="display: {{ $lead->user_status == 5 ? '':'none' }}">
                                        <label class="form-label" for="dead-reason{{ $lead->id }}">Raisons <span class="text-danger">*</span></label>
                                        <textarea rows="3" name="dead_reason" id="dead-reason{{ $lead->id }}" class="form-control shadow-none"></textarea>
                                    </div>
                                    <button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-2">
                                        {{ __('Submit') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endpush
    @empty
    <tr>
        <td colspan="100" class="text-center"> <h3>Aucune donnée trouvée</h3></td>
    </tr>
    @endforelse
@endif
