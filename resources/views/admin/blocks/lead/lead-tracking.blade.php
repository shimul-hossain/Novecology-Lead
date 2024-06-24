@php
    $heatings = \App\Models\CRM\HeatingMode::orderBy('order', 'asc')->get(); 
    $suppliers = \App\Models\CRM\Fournisseur::where('active', 'Oui')->where('type', 'Lead')->get();
    $campagne_types = \App\Models\CRM\Campagnetype::all();
    $bareme_travaux_tags = \App\Models\CRM\BaremeTravauxTag::orderBy('order')->get(); 
    $all_inputs = \App\Models\CRM\ProjectCustomField::all();   

    $edit_access = false;
    if($lead->lead_label == 6){
        if ($lead->sub_status  == 50 && \Auth::user()->getRoleName->category_id == 2) {
            $edit_status = true;
        }
        if(\Auth::user()->getRoleName->category_id == 3 || \Auth::user()->getRoleName->category_id == 4){
            $edit_status = true;
        } 
    }

@endphp
<div class="accordion" id="leadAccordion23">
    @if (checkAction(Auth::id(), 'collapse_lead_tracing_lead', 'view') ||checkAction(Auth::id(), 'collapse_lead_tracing_lead', 'edit') || role() == 's_admin' || $edit_access)
        <div class="card lead__card border-0">
            <div class="card-header bg-transparent border-0 p-0" id="leadCard-1">
            <h2 class="mb-0">
                <div id="tracker_collapse_btn" class="btn text-left lead__card__toggler flex-grow-1 shadow-none d-flex align-items-center w-100">
                    <span id="lead-verify" class="novecologie-icon-check lead__card__check mr-2 mr-sm-4
                    {{-- @if($lead && $lead->tracker_platform)
                    verified
                    @endif --}}
                    "></span>
                    {{ __('Lead Tracking (Form and response)') }}
                    {{-- <span class="d-block ml-auto">
                        <span class="novecologie-icon-chevron-down d-inline-block lead__card__toggler__icon"></span>
                    </span> --}}
                    <button data-tab="Lead Tracking" data-block="Lead Tracking (Form and response)" data-tab-class="lead__lead_tracking" type="button" data-toggle="collapse" data-target="#leadCardCollapse-1" aria-expanded="false" class="d-flex border-0 edit-toggler edit-toggler--lock__access {{ session('lead__lead_tracking') }} position-relative ml-auto mr-1 {{ session('lead__lead_tracking') == 'active' ? 'collapsed':'' }}">
                        <span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
                        <span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
                    </button>
                </div>
            </h2>
            </div>

            <div id="leadCardCollapse-1" class="collapse {{ session('lead__lead_tracking') == 'active' ? 'show':'' }}" aria-labelledby="leadCard-1">
            <div class="card-body row">
                <div class="col custom-space">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="__tracking__Fournisseur_de_lead">Fournisseur de lead</label>
                                <select name="__tracking__Fournisseur_de_lead" id="__tracking__Fournisseur_de_lead" class="form-control tracking_disabled">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    @foreach ($suppliers as $supplier)
                                    <option  {{ ($supplier->id == $lead->__tracking__Fournisseur_de_lead) ? 'selected':'' }} value="{{ $supplier->id }}">{{ $supplier->suplier }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="__tracking__Type_de_campagne">Type de campagne<span class="text-danger">*</span></label>
                                <select name="__tracking__Type_de_campagne" data-autre-box="compaigne__type" data-input-type="select" data-select-type="single" id="__tracking__Type_de_campagne" class="form-control tracking_disabled other_field__system">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    @foreach ($campagne_types as $campagne_type)
                                        <option  {{ ($lead->__tracking__Type_de_campagne == $campagne_type->name) ? 'selected':'' }} value="{{ $campagne_type->name }}">{{ $campagne_type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 compaigne__type" style="display: {{ $lead->__tracking__Type_de_campagne == 'Autre' ? '':'none' }}">
                            <div class="form-group">
                                <label class="form-label" for="__tracking__Type_de_campagne__a__">Merci de précisez</label>
                                <input type="text" name="__tracking__Type_de_campagne__a__" id="__tracking__Type_de_campagne__a__" class="form-control shadow-none tracking_disabled"
                                value="{{ $lead->__tracking__Type_de_campagne__a__ }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="__tracking__Nom_campagne">Nom campagne</label>
                                <input type="text" name="__tracking__Nom_campagne" id="__tracking__Nom_campagne" class="form-control shadow-none tracking_disabled" placeholder="Nom campagne"
                                value ="{{ $lead->__tracking__Nom_campagne }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="__tracking__Date_demande_lead">Date demande lead<span class="text-danger">*</span></label>
                                <input type="date" name="__tracking__Date_demande_lead" id="__tracking__Date_demande_lead"
                                @if (strtotime($lead->__tracking__Date_demande_lead))
                                    value ="{{ \Carbon\Carbon::parse($lead->__tracking__Date_demande_lead)->format('Y-m-d') }}"
                                @endif
                                 class="flatpickr flatpickr-input form-control shadow-none tracking_disabled" placeholder="{{ __('dd-mm-yyyy') }}" >
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="__tracking__Date_attribution_télécommercial">Date attribution télécommercial</label>
                                <input type="date" name="__tracking__Date_attribution_télécommercial" id="__tracking__Date_attribution_télécommercial" class="flatpickr flatpickr-input form-control shadow-none tracking_disabled"
                                @if (strtotime($lead->__tracking__Date_attribution_télécommercial))
                                    value ="{{ \Carbon\Carbon::parse($lead->__tracking__Date_attribution_télécommercial)->format('Y-m-d') }}"
                                @endif
                                 placeholder="{{ __('dd-mm-yyyy') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="__tracking__Type_de_travaux_souhaité">Type de travaux souhaité</label>
                                <select name="__tracking__Type_de_travaux_souhaité[]" id="__tracking__Type_de_travaux_souhaité" class="select2_select_option form-control tracking_disabled" multiple>
                                    @foreach ($bareme_travaux_tags as $t_travaux)
                                        <option {{ getFeature($lead->__tracking__Type_de_travaux_souhaité, $t_travaux->travaux) ? 'selected':'' }} value="{{ $t_travaux->travaux }}">{{ $t_travaux->travaux }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="__tracking__Nom_Prénom">Nom Prénom Lead<span class="text-danger">*</span></label>
                                <input type="text" name="__tracking__Nom_Prénom" id="__tracking__Nom_Prénom" class="form-control shadow-none tracking_disabled"
                                value ="{{ $lead->__tracking__Nom_Prénom }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="__tracking__Code_postal">Code postal<span class="text-danger">*</span></label>
                                <input type="number" name="__tracking__Code_postal" id="__tracking__Code_postal" class="form-control shadow-none tracking_disabled"
                                value ="{{ $lead->__tracking__Code_postal }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="__tracking__Email">Email</label>
                                <input type="email" name="__tracking__Email" id="__tracking__Email" class="form-control shadow-none tracking_disabled"
                                value="{{ $lead->__tracking__Email }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="__tracking__téléphone">Téléphone<span class="text-danger">*</span></label>
                                <input type="text" name="__tracking__téléphone" id="__tracking__téléphone" class="form-control shadow-none tracking_disabled"
                                value ="{{ $lead->__tracking__téléphone }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="__tracking__Département">Département</label>
                                <input type="text" readonly name="__tracking__Département" id="__tracking__Département" class="form-control shadow-none tracking_disabled"
                                value ="{{ getDepartment2($lead->__tracking__Code_postal) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="__tracking__Mode_de_chauffage">Mode de chauffage<span class="text-danger">*</span></label>
                                <select name="__tracking__Mode_de_chauffage" data-autre-box="heating__type_tracker" data-input-type="select" data-select-type="single" id="__tracking__Mode_de_chauffage" class="form-control other_field__system tracking_disabled">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    @foreach ($heatings as $heating)
                                        <option {{ $lead->__tracking__Mode_de_chauffage == $heating->name ? 'selected':'' }} value="{{ $heating->name }}">{{ $heating->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 heating__type_tracker" style="display: {{ $lead->__tracking__Mode_de_chauffage == 'Autre' ? '':'none' }}">
                            <div class="form-group">
                                <label class="form-label" for="__tracking__Mode_de_chauffage__a__">Merci de précisez</label>
                                <input type="text" name="__tracking__Mode_de_chauffage__a__" id="__tracking__Mode_de_chauffage__a__" class="form-control shadow-none tracking_disabled"
                                value="{{ $lead->__tracking__Mode_de_chauffage__a__ }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="__tracking__Propriétaire">Propriétaire</label>
                                <select name="__tracking__Propriétaire" id="__tracking__Propriétaire" class="form-control tracking_disabled">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    <option {{ ($lead->__tracking__Propriétaire == 'Oui') ? 'selected':'' }} value="Oui">Oui</option>
                                    <option {{ ($lead->__tracking__Propriétaire == 'Non') ? 'selected':'' }} value="Non">Non</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="__tracking__Votre_maison_ahyphenthyphenelle_plus_de_15_ans">Votre maison a-t-elle plus de 15 ans ?</label>
                                <select name="__tracking__Votre_maison_ahyphenthyphenelle_plus_de_15_ans" id="__tracking__Votre_maison_ahyphenthyphenelle_plus_de_15_ans" class="form-control tracking_disabled">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    <option {{ ($lead->__tracking__Votre_maison_ahyphenthyphenelle_plus_de_15_ans == 'Oui') ? 'selected':'' }} value="Oui">Oui</option>
                                    <option {{ ($lead->__tracking__Votre_maison_ahyphenthyphenelle_plus_de_15_ans == 'Non') ? 'selected':'' }} value="Non">Non</option>
                                </select>
                            </div>
                        </div>
                        @include('admin.custom_field_data', ['inputs' => $all_inputs->where('collapse_name', 'collapse_lead_tracing_lead'), 'custom_field_data' => $lead->lead_tracking_custom_field_data, 'class' => 'lead_tracking_custom_field', 'disabled_class' => 'tracking_disabled'])
                        @if (checkAction(Auth::id(), 'collapse_lead_tracing_lead', 'edit') || role() == 's_admin' || $edit_access)
                            <div class="col-12 text-center">
                                <button type="button" id="leadTrackValidate" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5 tracking_disabled">
                                    {{ __('Submit') }}
                                </button>
                                @if (role() == 's_admin')
                                <button type="button" data-collapse="collapse_lead_tracing_lead" data-callapse_active="lead_tracking_active" class="addCustomFieldBtn primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5 tracking_disabled">
                                    Ajouter un champ
                                </button>
                                @endif
                            </div>
                        @else
                            <div class="col-12 text-center">
                                <button type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5">
                                    <span class="novecologie-icon-lock py-1"></span>
                                </button>
                            </div>
                        @endif
                    </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
    @endif
</div>