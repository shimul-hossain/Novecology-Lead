<div class="modal modal--aside fade" id="distribute-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content distribute-wrapper border-0">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-header d-block border-0 pt-0 pb-0">
                <h1 class="form__title position-relative text-center mb-4">Répartir les prospects</h1>
                <h4 class="text-muted text-center mb-3">Répartissez les prospects entre vos collaborateurs</h4>
                <div class="distribute-search mx-auto">
                    <span class="distribute-search__icon">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="search" class="distribute-search__input" placeholder="Rechercher...">
                </div>
                <div class="row py-2 text-center">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4"> 
                        <button type="submit" form="distributeForm" class="primary-btn primary-btn--success primary-btn--md rounded-pill d-inline-flex align-items-center justify-content-center border-0">
                            Valider
                        </button>
                    </div>
                    <div class="col-sm-4">
                        <p class="text-right mr-2">Leads attribué : <span id="selectedLeadDispatchCount">0</span></p>
                    </div>
                </div>
                <div class="text-center">
                    <div class="distribute-search__input py-2">Sélectionnés : <span id="selectedLeadCount"></span></div>
                </div>
            </div>
            <div class="modal-body pt-0">
                <form id="distributeForm" action="{{ route('lead.dispatcher') }}" method="post">
                    @csrf
                    <input type="hidden" name="selected_lead_id" class="bulk_selected_lead">
                    <div class="distribute-list">
                        @php
                            $nv_data = \App\Models\CRM\LeadStatus::where('status', 'Nouveau')->first();
                            $enc_data = \App\Models\CRM\LeadStatus::where('status', 'En Cours')->first();
                            $nrp_data = \App\Models\CRM\LeadStatus::where('status', 'NRP')->first();
                            $nv_id = $nv_data->id ?? '';
                            $enc_id = $enc_data->id ?? '';
                            $nrp_id = $nrp_data->id ?? '';
                        @endphp
                        @foreach ($telecommercials as $t_user)
                        <div class="distribute-list__item">
                                <div class="distribute-list__item__content">
                                    <div class="distribute-list__item__avatar">
                                        {{ nameShorter($t_user->name) }}
                                    </div>
                                    <div class="distribute-list__item__info">
                                        <div class="distribute-list__item__info__top">
                                            <h3 class="distribute-list__item__info__title">{{ $t_user->name }}</h3>
                                            <span class="distribute-list__item__info__badge">{{ $t_user->getRoleName->name ?? '' }}</span>
                                        </div>
                                        <a href="mailto:{{ $t_user->email }}" class="distribute-list__item__info__text">{{ $t_user->email }}</a>
                                    </div>
                                </div>
                                <div class="distribute-list__item__actions">
                                    <div class="distribute-list__item__actions__counters">
                                        <div class="distribute-list__item__actions__counters__item number-spinner__input--value" data-name="NV">{{ $t_user->getLeads->where('lead_label', $nv_id)->count() }}</div>
                                        <div class="distribute-list__item__actions__counters__item" data-name="EnC">{{ $t_user->getLeads->where('lead_label', $enc_id)->count() }}</div>
                                        <div class="distribute-list__item__actions__counters__item" data-name="NRP">{{ $t_user->getLeads->where('lead_label', $nrp_id)->count() }}</div>
                                    </div>
                                    <div class="number-spinner">
                                        <button type="button" class="number-spinner__btn number-spinner__btn--decrease" data-id="{{ $t_user->id }}">
                                            <i class="bi bi-dash-lg"></i>
                                        </button>
                                        <input type="number" name="lead_dispatcher_id[{{ $t_user->id }}]" class="number-spinner__input number-spinner__input__value{{ $t_user->id }} text-center" value="0" readonly>
                                        <input type="hidden" class="assignedLead{{ $t_user->id }}" value="{{ $t_user->getLeads->where('lead_label', $nv_id)->count() + $t_user->getLeads->where('lead_label', $enc_id)->count() + $t_user->getLeads->where('lead_label', $nrp_id)->count() }}">
                                        <button type="button" class="number-spinner__btn number-spinner__btn--increase" data-id="{{ $t_user->id }}">
                                            <i class="bi bi-plus-lg"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>