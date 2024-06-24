@php 
    $administrarif_role_id  = \App\Models\CRM\Role::where('category_id', 3)->pluck('id');
    $suvbention_gestionnaires = \App\Models\User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', $administrarif_role_id)->get();
    $statut_maprimerenovs = \App\Models\CRM\StatutMaprimerenov::orderBy('order', 'asc')->get();
    $mandataire_maprimerenovs = \App\Models\CRM\Agent::all();
    $reject_reasons = \App\Models\CRM\RejectReason::all();
    $all_inputs = \App\Models\CRM\ProjectCustomField::all();  
    $bareme_travaux_tags = \App\Models\CRM\BaremeTravauxTag::orderBy('order')->get(); 
    $users = \App\Models\User::where('deleted_status', 'no')->where('status', 'active')->get();
@endphp
<div class="accordion" id="leadAccordion5">
    @if ($user_actions->where('module_name', 'collapse_compte')->where('action_name', 'view')->first() ||$user_actions->where('module_name', 'collapse_compte')->where('action_name', 'edit')->first() || $role == 's_admin')
        <div class="card lead__card border-0">
            <div class="card-header bg-transparent border-0 p-0" id="leadCard-14">
            <h2 class="mb-0">
                <div class="btn text-left lead__card__toggler flex-grow-1 shadow-none d-flex align-items-center w-100 collapseBtn">
                <span id="compte-verify" class="novecologie-icon-check lead__card__check mr-2 mr-sm-4 "></span>
                Compte
                {{-- <span class="d-block ml-auto">
                    <span class="novecologie-icon-chevron-down d-inline-block lead__card__toggler__icon"></span>
                </span> --}}
                <button data-tab="Section MAPRIMERENOV" data-block="Compte" data-tab-class="compte__part" type="button" data-toggle="collapse" data-target="#leadCardCollapse-compte" aria-expanded="false" class="d-flex border-0 edit-toggler edit-toggler--lock__access {{ session('compte__part') }} position-relative ml-auto mr-1 {{ session('compte__part') == 'active' ? 'collapsed':'' }}">
                    <span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
                    <span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
                </button>
                </div>
            </h2>
            </div>
            <div id="leadCardCollapse-compte" class="collapse {{ session('compte__part') == 'active' ? 'show':'' }}" aria-labelledby="leadCard-14">
                <div class="card-body row">
                    <div class="col custom-space">
                        <div class="row">
                            <div class="col-12 d-flex align-items-center justify-content-between">
                                <h4 style="text-decoration: underline; font-weight: bolder">Compte Email</h4>
                                <select name="compte_email_status" id="compte_email_status" data-autre-box="CompteEmailWrap" class="other_field__system2 custom-select shadow-none compte_disabled w-auto">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    <option {{ $project->compte_email_status == 'Oui' ? 'selected':'' }} value="Oui">Oui</option>
                                    <option {{ $project->compte_email_status == 'Non' ? 'selected':'' }} value="Non">Non</option>
                                </select>
                            </div>
                            <div class="col-12 CompteEmailWrap" style="display: {{ $project->compte_email_status == 'Oui' ? '':'none' }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="email_email">Email <span class="text-danger">*</span></label>
                                            <input type="email" name="email_email"  id="email_email" value="{{ $project->Compte_email }}" class="form-control shadow-none compte_disabled">
                                            <input type="hidden" id="account_id" value="{{ $project->id }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="password_email">Mots de passe <span class="text-danger">*</span></label>
                                            <input type="text" name="password_email"  id="password_email" value="{{ $project->Compte_Mots_de_passe }}" class="form-control shadow-none compte_disabled">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="account_created_on">Compte crée le : <span class="text-danger">*</span></label>
                                            <input type="date" name="account_created_on" min="{{ \Carbon\Carbon::today()->format('Y-m-d') }}" id="account_created_on"
                                            @if (strtotime($project->Compte_crée_le))
                                                value="{{ $project->Compte_crée_le }}" 
                                            @endif
                                             class="flatpickr form-control compte_disabled shadow-none bg-transparent " placeholder="dd/mm/yyyy">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="account_created_by">Compte crée par : <span class="text-danger">*</span></label>
                                            <select name="account_created_by" id="account_created_by" class="select2_select_option form-control compte_disabled w-100">
                                                <option value="" selected>{{ __('Select') }}</option>
                                            @foreach ($suvbention_gestionnaires as $user)
                                                <option {{ $user->id == $project->Compte_crée_par ? 'selected':'' }} value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 my-3 d-flex align-items-center justify-content-between">
                                <h4 style="text-decoration: underline; font-weight: bolder"> Compte email de récupération</h4>
                                <select name="compte_email_recovery_status" id="compte_email_recovery_status" data-autre-box="CompteEmailRecoveryWrap" class="other_field__system2 custom-select shadow-none compte_disabled w-auto">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    <option {{ $project->compte_email_recovery_status == 'Oui' ? 'selected':'' }} value="Oui">Oui</option>
                                    <option {{ $project->compte_email_recovery_status == 'Non' ? 'selected':'' }} value="Non">Non</option>
                                </select>
                            </div>
                            <div class="col-12 CompteEmailRecoveryWrap" style="display: {{ $project->compte_email_recovery_status == 'Oui' ? '':'none' }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="Compte_Email_de_récupération_email">Email <span class="text-danger">*</span></label>
                                            <input type="email" name="Compte_Email_de_récupération_email"  id="Compte_Email_de_récupération_email" value="{{ $project->Compte_Email_de_récupération_email }}" class="form-control shadow-none compte_disabled">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="Compte_Email_de_récupération_Mots_de_passe">Mots de passe <span class="text-danger">*</span></label>
                                            <input type="text" name="Compte_Email_de_récupération_Mots_de_passe"  id="Compte_Email_de_récupération_Mots_de_passe" value="{{ $project->Compte_Email_de_récupération_Mots_de_passe }}" class="form-control shadow-none compte_disabled">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="Compte_Email_de_récupération_crée_le">Compte crée le : <span class="text-danger">*</span></label>
                                            <input type="date" name="Compte_Email_de_récupération_crée_le" min="{{ \Carbon\Carbon::today()->format('Y-m-d') }}" id="Compte_Email_de_récupération_crée_le" 
                                            @if (strtotime($project->Compte_Email_de_récupération_crée_le))
                                                value="{{ $project->Compte_Email_de_récupération_crée_le }}" 
                                            @endif
                                             class="flatpickr form-control compte_disabled shadow-none bg-transparent " placeholder="dd/mm/yyyy">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="Compte_Email_de_récupération_crée_par">Compte crée par : <span class="text-danger">*</span></label>
                                            <select name="Compte_Email_de_récupération_crée_par" id="Compte_Email_de_récupération_crée_par" class="select2_select_option form-control compte_disabled w-100">
                                                <option value="" selected>{{ __('Select') }}</option>
                                            @foreach ($suvbention_gestionnaires as $user)
                                                <option {{ $user->id == $project->Compte_Email_de_récupération_crée_par ? 'selected':'' }} value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 my-3 d-flex align-items-center justify-content-between">
                                <h4 style="text-decoration: underline; font-weight: bolder">Téléphone de récupération <span class="text-danger">*</span></h4>
                                <select name="Téléphone_de_récupération" id="Téléphone_de_récupération" data-autre-box="Téléphone_de_récupération__autre" class="other_field__system2 custom-select shadow-none compte_disabled w-auto">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    <option {{ $project->Téléphone_de_récupération == 'Oui' ? 'selected':'' }} value="Oui">Oui</option>
                                    <option {{ $project->Téléphone_de_récupération == 'Non' ? 'selected':'' }} value="Non">Non</option>
                                </select>
                            </div>
                            <div class="col-12 Téléphone_de_récupération__autre" style="display:{{ $project->Téléphone_de_récupération == 'Oui' ? '':'none' }}">
                                <input type="text" id="Téléphone_de_récupération_Téléphone" name="Téléphone_de_récupération_Téléphone" value="{{ $project->Téléphone_de_récupération_Téléphone }}" class="form-control compte_disabled shadow-none">
                            </div>
                            {{-- <div class="col-12 mt-4">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span class="mb-0 mr-2">Téléphone de récupération</span>
                                            <label class="switch-checkbox">
                                                <input type="checkbox" data-autre-box="Téléphone_de_récupération__autre" class="switch-checkbox__input compte_disabled other_field__system" {{ $project->Téléphone_de_récupération == 'yes' ? 'checked':'' }} name="Téléphone_de_récupération" id="Téléphone_de_récupération">
                                                <span class="switch-checkbox__label"></span>
                                            </label>
                                        </div>
                                    </div>

                                </div>
                            </div> --}}
                            <div class="col-12 my-3 d-flex align-items-center justify-content-between">
                                <h4 style="text-decoration: underline; font-weight: bolder">Email de transfert <span class="text-danger">*</span></h4>
                                <select name="Email_de_transfert" id="Email_de_transfert" data-autre-box="Email_de_transfert__autre" class="other_field__system2 custom-select shadow-none compte_disabled w-auto">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    <option {{ $project->Email_de_transfert == 'Oui' ? 'selected':'' }} value="Oui">Oui</option>
                                    <option {{ $project->Email_de_transfert == 'Non' ? 'selected':'' }} value="Non">Non</option>
                                </select>
                            </div>
                            <div class="col-12 Email_de_transfert__autre" style="display: {{ $project->Email_de_transfert == 'yes' ? '':'none' }}">
                                <input type="text" id="Email_de_transfert_Email" name="Email_de_transfert_Email" value="{{ $project->Email_de_transfert_Email }}" class="form-control compte_disabled shadow-none">
                            </div>
                            {{-- <div class="col-12 mt-4">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span class="mb-0 mr-2">Email de transfert</span>
                                            <label class="switch-checkbox">
                                                <input type="checkbox" data-autre-box="Email_de_transfert__autre" class="switch-checkbox__input compte_disabled other_field__system" {{ $project->Email_de_transfert == 'yes' ? 'checked':'' }} name="Email_de_transfert" id="Email_de_transfert">
                                                <span class="switch-checkbox__label"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-12 my-3">
                                <h3>WEBMAIL:</h3>
                                <div class="d-flex flex-wrap mt-3" style="gap: 30px">
                                    <a target="_blank" href="https://mail.ionos.fr/">
                                        <img  loading="lazy"  height="45" src="{{ asset('crm_assets/assets/images/IONOS.png') }}" alt="">
                                    </a>
                                    <a target="_blank" href="https://www.ovhcloud.com/fr/mail/">
                                        <img  loading="lazy"  height="50" src="{{ asset('crm_assets/assets/images/OVH.png') }}" alt="">
                                    </a>
                                    <a target="_blank" href="https://www.laposte.net/accueil">
                                        <img  loading="lazy"  height="50" src="{{ asset('crm_assets/assets/images/laposte.png') }}" alt="">
                                    </a>
                                    <a target="_blank" href="https://login.live.com/login.srf?wa=wsignin1.0&rpsnv=13 &ct=1677979607&rver-7.0.6737.0&wp=MBI_SSL&wrepl y=https%3a%2f%2foutlook.live.com%2fowa%2f%3fRpsC srfState%3d1007db29-afcb-ad9c-6b61-b3710f50f2e7&id =292841&aadredir=1&CBCXT=out&lw=1&fl=dob%2cfina me%2cwld&cobrandid=90015">
                                        <img  loading="lazy"  height="50" src="{{ asset('crm_assets/assets/images/microsoft-outlook.png') }}" alt="">
                                    </a>
                                    <a target="_blank" href="https://login.yahoo.com/?.src=ym&l ang=fr-FR&done=https%3A%2F%2 Ffr.mail.yahoo.com%2F%3Fguce_r eferrer%3DaHR0cHM6Ly93d3cuZ2 9vZ2xlLmNvbS8%26guce_referrer _sig%3DAQAAAHBPyj3rVN-d1hK WOWMQeOOHLRjeXQ6G1LZeodA YOndrDdwhKLTI5fYXZ-6YnLTE-Cg UccU-ktWankAQxmOroSulx4XSMZ eZPntXW06WozrD8pqewcUuAoAY arBq6YVuC21s3KUsgj55Q5eMtFU ChS-m5v18lbE1IcBt-7mvM4ng">
                                        <img  loading="lazy"  height="50" src="{{ asset('crm_assets/assets/images/Yahoo.png') }}" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-12 my-3 d-flex align-items-center justify-content-between">
                                <h4 style="text-decoration: underline; font-weight: bolder"> Compte MaPrimeRénov</h4>
                                <select name="compte_MaPrimeRénov_status" id="compte_MaPrimeRénov_status" data-autre-box="CompteMaPrimeRénovWrap" class="other_field__system2 custom-select shadow-none compte_disabled w-auto">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    <option {{ $project->compte_MaPrimeRénov_status == 'Oui' ? 'selected':'' }} value="Oui">Oui</option>
                                    <option {{ $project->compte_MaPrimeRénov_status == 'Non' ? 'selected':'' }} value="Non">Non</option>
                                </select>
                            </div>
                            <div class="col-12 CompteMaPrimeRénovWrap" style="display: {{ $project->compte_MaPrimeRénov_status == 'Oui' ? '':'none' }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="email_mpr">Email <span class="text-danger">*</span></label>
                                            <input type="email" name="email_mpr"  id="email_mpr"  value="{{ $project->Compte_MaPrimeRenov_email }}" class="form-control shadow-none compte_disabled">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="password_mpr">Mots de passe<span class="text-danger">*</span></label>
                                            <input type="text" name="password_mpr"  id="password_mpr" value="{{ $project->Compte_MaPrimeRenov_Mots_de_passe }}" class="form-control shadow-none compte_disabled">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="account_email_created_on">Compte crée le : <span class="text-danger">*</span></label>
                                            <input type="date" name="account_email_created_on" min="{{ \Carbon\Carbon::today()->format('Y-m-d') }}"
                                            id="account_email_created_on"
                                             @if (strtotime($project->Compte_MaPrimeRenov_Compte_crée_le))
                                                value="{{ $project->Compte_MaPrimeRenov_Compte_crée_le }}" 
                                            @endif
                                              class="flatpickr form-control compte_disabled shadow-none bg-transparent " placeholder="dd/mm/yyyy">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="account_email_created_by">Compte crée par : <span class="text-danger">*</span></label>
                                            <select name="account_email_created_by" id="account_email_created_by" class="select2_select_option form-control compte_disabled w-100">
                                                <option value="" selected>{{ __('Select') }}</option>
                                                @foreach ($suvbention_gestionnaires as $user)
                                                    <option {{ $user->id == $project->Compte_MaPrimeRenov_Compte_crée_par ? 'selected':'' }} value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="col-12">
                                <div class="form-group">
                                    <div class="d-flex align-items-center">
                                        <h4 class="mb-0 mr-2">Compte inscrit sur Thunderbird</h4>
                                        <label class="switch-checkbox">
                                            <input type="checkbox" value="yes" id="thunderbir_status" class="switch-checkbox__input compte_disabled" {{ $project->Compte_inscrit_sur_Thunderbird == 'yes'? 'checked':'' }}>
                                            <span class="switch-checkbox__label"></span>
                                        </label>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="compte_observations">Observations</label>
                                    <textarea  name="compte_observations"  id="compte_observations" class="form-control shadow-none compte_disabled"> {{ $project->Compte_Observations }}</textarea>
                                </div>
                            </div>
                            @include('admin.custom_field_data', ['inputs' => $all_inputs->where('collapse_name', 'compte__collapse'), 'custom_field_data' => $project->campte_custom_field_data, 'class' => 'campte__custom_field', 'disabled_class' => 'compte_disabled'])
                            @if ($user_actions->where('module_name', 'collapse_compte')->where('action_name', 'edit')->first() || $role == 's_admin')
                                <div class="col-12 text-center ">
                                    <button id="compteValidate"
                                    type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5 compte_disabled">
                                        {{ __('Submit') }}
                                    </button>
                                    @if ($role == 's_admin')
                                        <button type="button" data-collapse="compte__collapse" data-callapse_active="maprimerenov_active" class="addCustomFieldBtn primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5 compte_disabled">
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
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if ($user_actions->where('module_name', 'montant_disponible')->where('action_name', 'view')->first() ||$user_actions->where('module_name', 'montant_disponible')->where('action_name', 'edit')->first() || $role == 's_admin')
        <div class="card lead__card border-0">
            <div class="card-header bg-transparent border-0 p-0" id="montant_disponible-14">
            <h2 class="mb-0">
                <div class="btn text-left lead__card__toggler flex-grow-1 shadow-none d-flex align-items-center w-100 collapseBtn">
                <span class="novecologie-icon-check lead__card__check mr-2 mr-sm-4 "></span>
                Montant Disponible
                {{-- <span class="d-block ml-auto">
                    <span class="novecologie-icon-chevron-down d-inline-block lead__card__toggler__icon"></span>
                </span> --}}
                <button data-tab="Section MAPRIMERENOV" data-block="Montant Disponible" data-tab-class="montant_disponible__part" type="button" data-toggle="collapse" data-target="#leadCardCollapse-montant_disponible" aria-expanded="false" class="d-flex border-0 edit-toggler edit-toggler--lock__access {{ session('montant_disponible__part') }} position-relative ml-auto mr-1 {{ session('montant_disponible__part') == 'active' ? 'collapsed':'' }}">
                    <span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
                    <span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
                </button>
                </div>
            </h2>
            </div>
            <div id="leadCardCollapse-montant_disponible" class="collapse {{ session('montant_disponible__part') == 'active' ? 'show':'' }}" aria-labelledby="montant_disponible-14">
                <div class="card-body row">
                    <div class="col custom-space">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="Montant_Disponible">Montant Disponible:</label>
                                    <input type="text" readonly name="Montant_Disponible"  id="Montant_Disponible"
                                    @if ($project->Statut_1_hyphen_MyMPR == 'Demande de solde' && $project->Statut_2_hyphen_MyMPR == 'Acceptée pour paiement')
                                    value="{{ $project->Montant_subvention_prévisionnel_hyphen_MyMPR ? EuroFormat(20000 - $project->Montant_subvention_prévisionnel_hyphen_MyMPR) : '' }}"
                                    @endif
                                    class="form-control shadow-none">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if ($user_actions->where('module_name', 'collapse_subvention')->where('action_name', 'view')->first() ||$user_actions->where('module_name', 'collapse_subvention')->where('action_name', 'edit')->first() || $role == 's_admin')
    <div class="card lead__card border-0">
        <div class="card-header bg-transparent border-0 p-0" id="leadCard-14">
            <h2 class="mb-0">
                <div class="btn text-left lead__card__toggler flex-grow-1 shadow-none d-flex align-items-center w-100 collapseBtn">
                    <span id="subvention_information-verify" class="novecologie-icon-check lead__card__check mr-2 mr-sm-4"></span>
                    {{ __('Subvention') }}
                        @if ($user_actions->where('module_name', 'collapse_subvention')->where('action_name', 'create')->first() || $role == 's_admin')
                            <a href="javascript:void(0)" id="createSubventionButton" class="primary-btn primary-btn--primary primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0 ml-auto">Nouvelle subvention</a>
                        @endif
                        <button data-tab="Section MAPRIMERENOV" data-block="Subvention" data-tab-class="subvention__part" type="button" data-toggle="collapse" data-target="#leadCardCollapse-14" aria-expanded="false" class="d-flex border-0 edit-toggler edit-toggler--lock__access {{ session('subvention__part') }} position-relative ml-1 {{ session('subvention__part') == 'active' ? 'collapsed':'' }}">
                            <span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
                            <span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
                        </button>
                </div>
            </h2>
        </div>
        <div id="leadCardCollapse-14" class="collapse {{ session('subvention__part') == 'active' ? 'show':'' }}" aria-labelledby="leadCard-14">
            <div class="card-body px-0 pb-0">
                <div class="accordion" id="subventionInnerAccordionParent">
                    @foreach ($project->getSubventions as $subvention)
                    <div class="card lead__card border-bottom" style="border-color: black !important;">
                        <div class="card-header bg-transparent border-0 p-0" id="leadCard-14">
                            <h2 class="mb-0">
                                @if ($user_actions->where('module_name', 'collapse_subvention')->where('action_name', 'delete')->first() || $role == 's_admin')
                                    <button type="button" class="btn btn-icon shadow-none top-right subventionDeleteButton" data-id="{{ $subvention->id }}"><i class="bi bi-trash3"></i></button>
                                @endif
                                <div class="btn text-left lead__card__toggler flex-grow-1 shadow-none d-flex align-items-xl-center w-100 collapseBtn">
                                    <div class="lead__card__toggler__content w-100">
                                        <h3 class="lead__card__toggler__content__heading">subvention {{ $project->getSubventions->count() - $loop->index }}</h3>
                                        <div class="lead__card__toggler__content__row">
                                            <div class="row">
                                                <div class="col-xl-4">
                                                    <p class="lead__card__toggler__content__row__text">
                                                        <strong class="lead__card__toggler__content__row__title">Numéro de dossier :</strong>
                                                        <span class="text-dark">{{ $subvention->numero_de_dossier }}</span>
                                                    </p>
                                                </div>
                                                <div class="col-xl-4">
                                                    <p class="lead__card__toggler__content__row__text">
                                                        <strong class="lead__card__toggler__content__row__title">Statut MPR - Subvention {{ $project->getSubventions->count() - $loop->index }}: </strong>
                                                        <span class="text-dark">{{ $subvention->subvention_status }}</span>
                                                    </p>
                                                </div>
                                                <div class="col-xl-4">
                                                    <p class="lead__card__toggler__content__row__text">
                                                        <strong class="lead__card__toggler__content__row__title">Date mise à jour :</strong>
                                                        <span class="text-dark">
                                                            @if ($subvention->date_mise && strtotime($subvention->date_mise))
                                                            {{ \Carbon\Carbon::parse($subvention->date_mise)->format('d-m-Y') }}
                                                            @endif
                                                        </span>
                                                    </p>
                                                </div>
                                                <div class="col-xl-4">
                                                    <p class="lead__card__toggler__content__row__text">
                                                        <strong class="lead__card__toggler__content__row__title">Mandataire:</strong>
                                                        <span class="text-dark">{{ $subvention->mandataire }}</span>
                                                    </p>
                                                </div>
                                                <div class="col-xl-4">
                                                    <p class="lead__card__toggler__content__row__text">
                                                        <strong class="lead__card__toggler__content__row__title">Travaux déposer:</strong>
                                                        @foreach ($subvention->travaux as $travaux)
                                                            <span class="text-dark">{{ $travaux->travaux ?? '' }} {{ $loop->last ? "":", " }}</span>
                                                        @endforeach
                                                    </p>
                                                </div>
                                                <div class="col-xl-4">
                                                    <p class="lead__card__toggler__content__row__text">
                                                        <strong class="lead__card__toggler__content__row__title">Montant subvention prévisionnelle:</strong>
                                                        <span class="text-dark">{{ EuroFormat($subvention->subvention_provisional) }}</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button data-tab="Section MAPRIMERENOV" data-block="Subvention {{ $project->getSubventions->count() - $loop->index }}" data-tab-class="subvention__part{{ $project->getSubventions->count() - $loop->index }}" type="button" data-toggle="collapse" data-target="#subventionInnerCardCollapse-{{ $subvention->id }}" aria-expanded="false" class="d-flex border-0 edit-toggler edit-toggler--lock__access {{ session('subvention__part'.($project->getSubventions->count() - $loop->index)) }} position-relative ml-1 {{ session('subvention__part'.($project->getSubventions->count() - $loop->index)) == 'active' ? 'collapsed':'' }}">
                                        <span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
                                        <span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
                                    </button>
                                </div>
                            </h2>
                        </div>
                        <div id="subventionInnerCardCollapse-{{ $subvention->id }}" class="collapse {{ session('subvention__part'.($project->getSubventions->count() - $loop->index)) == 'active' ? 'show':'' }}">
                            <div class="card-body">
                                <form action="{{ route('subvention.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="numero_de_dossier{{ $subvention->id }}">Numéro de dossier</label>
                                                <input type="text" name="numero_de_dossier" id="numero_de_dossier{{ $subvention->id }}" value="{{ $subvention->numero_de_dossier }}" class="form-control subvention_disabled shadow-none">
                                                <input type="hidden" name="project_id" value="{{ $project->id }}">
                                                <input type="hidden" name="subvention_id" value="{{ $subvention->id }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="subvention_status{{ $subvention->id }}">Statut MPR - Subvention {{ $project->getSubventions->count() - $loop->index }}</label>
                                                <select name="subvention_status" id="subvention_status{{ $subvention->id }}" class="select2_select_option form-control w-100 subvention_disabled">
                                                    <option value="" selected>{{ __("Select") }}</option>
                                                    @foreach ($statut_maprimerenovs as $statut_maprimerenov)
                                                        <option {{ ($subvention->subvention_status == $statut_maprimerenov->name)? 'selected':'' }} value="{{ $statut_maprimerenov->name }}">{{ $statut_maprimerenov->name }}</option>
                                                    @endforeach
                                                </select>   
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="date_mise{{ $subvention->id }}">Date mise à jour</label>
                                                <input type="date" name="date_mise" id="date_mise{{ $subvention->id }}" value="{{ $subvention->date_mise }}" class="flatpickr form-control subvention_disabled shadow-none bg-transparent " placeholder="dd/mm/yyyy">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="travaux_deposer{{ $subvention->id }}">Travaux déposés</label>
                                                <select name="travaux_deposer[]" id="travaux_deposer{{ $subvention->id }}" class="select2_select_option form-control w-100 subvention_disabled" multiple>
                                                    @foreach ($bareme_travaux_tags as $travaux)
                                                        <option {{ $subvention->travaux->where('id', $travaux->id)->first() ? 'selected':'' }} value="{{ $travaux->id }}">{{ $travaux->travaux }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="date_de_depot{{ $subvention->id }}">Date de dépôt</label>
                                                <input type="date" name="date_de_depot" id="date_de_depot{{ $subvention->id }}" value="{{ $subvention->date_de_depot }}" class="flatpickr form-control subvention_disabled shadow-none bg-transparent " placeholder="dd/mm/yyyy">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="subvention_provisional{{ $subvention->id }}">Montant subvention prévisionnelle</label>
                                                <input type="hidden" value="{{ $subvention->subvention_provisional }}" name="subvention_provisional" id="subvention_provisional{{ $subvention->id }}" class="montant_value">
                                                <input type="text" class="form-control shadow-none montant_format subvention_disabled" value="{{ EuroFormat($subvention->subvention_provisional) }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="mandataire{{ $subvention->id }}">Mandataire MaPrimeRénov</label>
                                                <select name="mandataire" id="mandataire{{ $subvention->id }}" class="select2_select_option form-control subvention_disabled w-100">
                                                    <option value="" selected>{{ __('Select') }}</option>
                                                    @foreach ($mandataire_maprimerenovs as $mandataire_maprimerenov)
                                                        <option {{ $subvention->mandataire == $mandataire_maprimerenov->company_name ? 'selected':'' }} value="{{ $mandataire_maprimerenov->company_name }}">{{ $mandataire_maprimerenov->company_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="mondat_depot{{ $subvention->id }}">Type de mandat MPR</label>
                                                <select name="mondat_depot" id="mondat_depot{{ $subvention->id }}" class="select2_select_option form-control w-100 subvention_disabled">
                                                    <option value="" selected>{{ __('Select') }}</option>
                                                    <option {{ ($subvention->mondat_depot == 'Admnistratif')? 'selected':'' }} value="Admnistratif">Admnistratif</option>
                                                    <option {{ ($subvention->mondat_depot == 'Financier')? 'selected':'' }} value="Financier">Financier</option>
                                                    <option {{ ($subvention->mondat_depot == 'Mixte')? 'selected':'' }} value="Mixte">Mixte</option>
                                                    <option {{ ($subvention->mondat_depot == 'Dépôt en nom propre')? 'selected':'' }} value="Dépôt en nom propre">Dépôt en nom propre</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="gestionnaire_depot{{ $subvention->id }}">Gestionnaire</label>
                                                <select name="gestionnaire_depot" id="gestionnaire_depot{{ $subvention->id }}" class="select2_select_option form-control w-100 subvention_disabled">
                                                    <option value="" selected>{{ __('Select') }}</option>
                                                    @foreach ($suvbention_gestionnaires as $suvbention_gestionnaire)
                                                    <option {{ ($subvention->gestionnaire_depot == $suvbention_gestionnaire->id)? 'selected':'' }} value="{{ $suvbention_gestionnaire->id }}">{{ $suvbention_gestionnaire->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group flex-grow-1">
                                                <label class="form-label" for="numero_de_devis">Numéro de devis</label>
                                                <input type="text" name="numero_de_devis" id="numero_de_devis" value="{{ $subvention->numero_de_devis }}" class="form-control subvention_disabled shadow-none">
                                            </div>
                                        </div>
                                        <div class="col-12 my-3">
                                            @push('all_forms')
                                                <form action="{{ route('subvention.file.update') }}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="id"  value="{{ $subvention->id }}">
                                                    <input type="file" hidden name="file"  id="subventionfile{{ $subvention->id }}" onchange="this.closest('form').submit()">
                                                </form>
                                            @endpush
                                            <div class="d-flex align-items-center border px-2 rounded" style="background-color: #f2f2f2">
                                                <h3 class="mr-auto mb-0">
                                                    @if ($subvention->file)
                                                        {{ $subvention->file_name ?? $subvention->file }}
                                                    @else
                                                        <strong>Insérer le devis:</strong>
                                                    @endif
                                                </h3>
                                                <label for="subventionfile{{ $subvention->id }}" tabindex="0" class="btn p-2 shadow-none subvention_disabled mb-0" role="button"><i class="bi bi-upload px-2 py-1"></i></label>
                                                @if ($subvention->file)
                                                    <a href="{{ asset('uploads/subventions') }}/{{ $subvention->file }}" target="_blank" class="btn p-2 shadow-none">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ asset('uploads/subventions') }}/{{ $subvention->file }}" download="{{ $subvention->file_name ?? $subvention->file }}" class=" btn p-2 shadow-none">
                                                        <i class="bi bi-download"></i>
                                                    </a>
                                                    <div class="dropdown dropdown--custom p-0 d-inline-block">
                                                        <button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle p-2" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <span class="novecologie-icon-dots-horizontal-triple"></span>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
                                                            <button  type="button" class="dropdown-item border-0" data-toggle="modal" data-target="#subventionFileEdit{{ $subvention->id }}">
                                                                Editer
                                                            </button>
                                                            <button type="button" class="dropdown-item border-0" data-toggle="modal" data-target="#subventionFileDelete{{ $subvention->id }}">
                                                                Supprimer
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="Consentement_reçu_le{{ $subvention->id }}">Consentement reçu le</label>
                                                <input type="date" name="Consentement_reçu_le" id="Consentement_reçu_le{{ $subvention->id }}" value="{{ $subvention->Consentement_reçu_le }}" class="flatpickr form-control subvention_disabled shadow-none bg-transparent " placeholder="dd/mm/yyyy">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="Consentement_répondu_le{{ $subvention->id }}">Consentement répondu le</label>
                                                <input type="date" name="Consentement_répondu_le" id="Consentement_répondu_le{{ $subvention->id }}" value="{{ $subvention->Consentement_répondu_le }}" class="flatpickr form-control subvention_disabled shadow-none bg-transparent " placeholder="dd/mm/yyyy">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="Consentement_répondu_par{{ $subvention->id }}">Consentement répondu par</label>
                                                <select name="Consentement_répondu_par" id="Consentement_répondu_par{{ $subvention->id }}" class="select2_select_option form-control w-100 subvention_disabled">
                                                    <option value="" selected>{{ __('Select') }}</option>
                                                    @foreach ($users as $user)
                                                    <option {{ ($subvention->Consentement_répondu_par == $user->id)? 'selected':'' }} value="{{ $user->id }}">{{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <label class="form-label" for="Statut_subvention{{ $subvention->id }}">Statut subvention</label>
                                                </div>
                                                <select name="Statut_subvention" id="Statut_subvention{{ $subvention->id }}"  class="select2_color_option custom-select shadow-none form-control subvention_disabled Statut_subvention__input" data-id="{{ $subvention->id }}">
                                                    <option value=" " selected>{{ __('Select') }}</option>
                                                    <option data-color="#000000" data-background="#93C47D" {{ $subvention->Statut_subvention == 'Accordé' ? 'selected':'' }} value="Accordé">Accordé</option>
                                                    <option data-color="#000000" data-background="#EA9999" {{ $subvention->Statut_subvention == 'Refusé' ? 'selected':'' }} value="Refusé">Refusé</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 StatutSubventionYesWrap{{ $subvention->id }}" style="display: {{ ($subvention->Statut_subvention == 'Accordé') ? '':'none' }}">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="subvention_accorde_le">Subvention accordé le</label>
                                                        <input type="date" name="subvention_accorde_le" id="subvention_accorde_le" value="{{ $subvention->subvention_accorde_le }}" class="flatpickr form-control subvention_disabled shadow-none bg-transparent" placeholder="dd/mm/yyyy">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="montant_subvention_accorde">Montant subvention accordé</label>
                                                        <input type="hidden" value="{{ $subvention->montant_subvention_accorde }}" name="montant_subvention_accorde" id="montant_subvention_accorde{{ $subvention->id }}" class="montant_value">
                                                        <input type="text" class="form-control shadow-none montant_format subvention_disabled" value="{{ EuroFormat($subvention->montant_subvention_accorde) }}">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="notification_doctroi{{ $subvention->id }}">Lettre de notification d’octroi</label>
                                                        <select name="notification_doctroi" id="notification_doctroi{{ $subvention->id }}" class="select2_color_option form-control subvention_disabled w-100">
                                                            <option value=" " selected>{{ __('Select') }}</option>
                                                            <option data-color="#000000" data-background="#93C47D" {{ $subvention->notification_doctroi == 'Oui' ? 'selected':'' }} value="Oui">Oui</option>
                                                            <option data-color="#000000" data-background="#EA9999" {{ $subvention->notification_doctroi == 'Non' ? 'selected':'' }} value="Non">Non</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12  my-3">
                                                    @push('all_forms')
                                                        <form action="{{ route('subvention.file2.update') }}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="id"  value="{{ $subvention->id }}">
                                                            <input type="file" hidden name="Statut_subvention_yes_file"  id="StatutSubventionYesFile{{ $subvention->id }}" onchange="this.closest('form').submit()">
                                                        </form>
                                                    @endpush
                                                    <div class="d-flex align-items-center border px-2 rounded" style="background-color: #f2f2f2">
                                                        <h3 class="mr-auto mb-0">
                                                            @if ($subvention->Statut_subvention_yes_file)
                                                                {{ $subvention->Statut_subvention_yes_file_name ?? $subvention->Statut_subvention_yes_file }}
                                                            @else
                                                                <strong>Insérer la lettre de notification d’octroi:</strong>
                                                            @endif
                                                        </h3>
                                                        <label for="StatutSubventionYesFile{{ $subvention->id }}" tabindex="0" class="btn p-2 shadow-none subvention_disabled mb-0" role="button"><i class="bi bi-upload px-2 py-1"></i></label>
                                                        @if ($subvention->Statut_subvention_yes_file)
                                                            <a href="{{ asset('uploads/subventions') }}/{{ $subvention->Statut_subvention_yes_file }}" target="_blank" class="btn p-2 shadow-none">
                                                                <i class="bi bi-eye"></i>
                                                            </a>
                                                            <a href="{{ asset('uploads/subventions') }}/{{ $subvention->Statut_subvention_yes_file }}" download="{{ $subvention->Statut_subvention_yes_file_name ?? $subvention->Statut_subvention_yes_file }}" class=" btn p-2 shadow-none">
                                                                <i class="bi bi-download"></i>
                                                            </a>
                                                            <div class="dropdown dropdown--custom p-0 d-inline-block">
                                                                <button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle p-2" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <span class="novecologie-icon-dots-horizontal-triple"></span>
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
                                                                    <button  type="button" class="dropdown-item border-0" data-toggle="modal" data-target="#subventionFile2Edit{{ $subvention->id }}">
                                                                        Editer
                                                                    </button>
                                                                    <button type="button" class="dropdown-item border-0" data-toggle="modal" data-target="#subventionFile2Delete{{ $subvention->id }}">
                                                                        Supprimer
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Date_forclusion">Date forclusion</label>
                                                        <input type="date" name="Date_forclusion" id="Date_forclusion" value="{{ $subvention->Date_forclusion }}" class="flatpickr form-control subvention_disabled shadow-none bg-transparent" placeholder="dd/mm/yyyy">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 StatutSubventionNoWrap{{ $subvention->id }}" style="display: {{ ($subvention->Statut_subvention == 'Refusé') ? '':'none' }}">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="subvention_rejetee_le{{ $subvention->id }}">Subvention rejetée le</label>
                                                        <input type="date" name="subvention_rejetee_le" id="subvention_rejetee_le{{ $subvention->id }}" value="{{ $subvention->subvention_rejetee_le }}" class="flatpickr form-control subvention_disabled shadow-none bg-transparent">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Motif_rejet{{ $subvention->id }}">Motif rejet</label>
                                                        <select name="Motif_rejet" id="Motif_rejet{{ $subvention->id }}" class="select2_select_option form-control subvention_disabled w-100">
                                                            <option value="" selected>{{ __('Select') }}</option>
                                                            @foreach ($reject_reasons as $reject_reason)
                                                                <option {{ $subvention->Motif_rejet == $reject_reason->name ? 'selected':'' }} value="{{ $reject_reason->name }}">{{ $reject_reason->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Notification_de_rejet">Notification de rejet</label>
                                                        <select name="Notification_de_rejet" id="Notification_de_rejet" class="select2_select_option form-control subvention_disabled w-100">
                                                            <option value="" selected>{{ __('Select') }}</option>
                                                            <option {{ $subvention->Notification_de_rejet == 'Oui' ? 'selected':'' }} value="Oui">Oui</option>
                                                            <option {{ $subvention->Notification_de_rejet == 'Non' ? 'selected':'' }} value="Non">Non</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 my-3">
                                                    @push('all_forms')
                                                        <form action="{{ route('subvention.file3.update') }}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="id"  value="{{ $subvention->id }}">
                                                            <input type="file" hidden name="Statut_subvention_no_file"  id="StatutSubventionNoFile{{ $subvention->id }}" onchange="this.closest('form').submit()">
                                                        </form>
                                                    @endpush
                                                    <div class="d-flex align-items-center border px-2 rounded" style="background-color: #f2f2f2">
                                                        <h3 class="mr-auto mb-0">
                                                            @if ($subvention->Statut_subvention_no_file)
                                                                {{ $subvention->Statut_subvention_no_file_name ?? $subvention->Statut_subvention_no_file }}
                                                            @else
                                                                <strong>Insérer la lettre de notification de rejet:</strong>
                                                            @endif
                                                            </h3>
                                                        <label for="StatutSubventionNoFile{{ $subvention->id }}" tabindex="0" class="btn p-2 shadow-none subvention_disabled mb-0" role="button"><i class="bi bi-upload px-2 py-1"></i></label>
                                                        @if ($subvention->Statut_subvention_no_file)
                                                            <a href="{{ asset('uploads/subventions') }}/{{ $subvention->Statut_subvention_no_file }}" target="_blank" class="btn p-2 shadow-none">
                                                                <i class="bi bi-eye"></i>
                                                            </a>
                                                            <a href="{{ asset('uploads/subventions') }}/{{ $subvention->Statut_subvention_no_file }}" download="{{ $subvention->Statut_subvention_no_file_name ?? $subvention->Statut_subvention_no_file }}" class=" btn p-2 shadow-none">
                                                                <i class="bi bi-download"></i>
                                                            </a>
                                                            <div class="dropdown dropdown--custom p-0 d-inline-block">
                                                                <button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle p-2" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <span class="novecologie-icon-dots-horizontal-triple"></span>
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
                                                                    <button  type="button" class="dropdown-item border-0" data-toggle="modal" data-target="#subventionFile3Edit{{ $subvention->id }}">
                                                                        Editer
                                                                    </button>
                                                                    <button type="button" class="dropdown-item border-0" data-toggle="modal" data-target="#subventionFile3Delete{{ $subvention->id }}">
                                                                        Supprimer
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <div class="col-lg-4 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="subvention_accorde">Subvention accordé</label>
                                                <select name="subvention_accorde" id="subvention_accorde" class="select2_select_option form-control subvention_disabled w-100">
                                                    <option {{ ($subvention->subvention_accorde == 'oui')? 'selected':'' }} value="oui">Oui</option>
                                                    <option {{ ($subvention->subvention_accorde == 'Non')? 'selected':'' }} value="Non">Non</option>
                                                </select>
                                            </div>
                                        </div>  --}}
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="observationsSubvention{{ $subvention->id }}">Observations</label>
                                                <textarea name="observations" class="form-control subvention_disabled shadow-none" id="observationsSubvention{{ $subvention->id }}">{{ $subvention->observations }}</textarea>
                                            </div>
                                        </div>
                                        @include('admin.custom_field_data2', ['inputs' => $all_inputs->where('collapse_name', "collapse__subvention"), 'custom_field_data' => $subvention->custom_field_data, 'disabled_class' => 'subvention_disabled'])
                                        @if ($user_actions->where('module_name', 'collapse_subvention')->where('action_name', 'edit')->first() || $role == 's_admin')
                                            <div class="col-12 text-center">
                                                <div class="form-group">
                                                    <button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5">Enregistrer</button>
                                                    @if ($role == 's_admin')
                                                        <button type="button" data-collapse="collapse__subvention" data-callapse_active="maprimerenov_active" class="addCustomFieldBtn primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5 subvention_disabled">
                                                            Ajouter un champ
                                                        </button>
                                                    @endif
                                                </div>
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
                    @push('all_modals')
                        <div class="modal modal--aside fade" id="subventionFileEdit{{ $subvention->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0">
                                    <div class="modal-header border-0 pb-0">
                                        <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                                            <span class="novecologie-icon-close"></span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-center pt-0">
                                        <h1 class="form__title position-relative mb-4">Mettre à jour le nom du fichier </h1>
                                        <form action="{{ route('subvention.file.name.edit') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $subvention->id }}">
                                            <div class="form-group text-left">
                                                <label for="#">Nom de fichier</label>
                                                <input type="text" name="name" value="{{ $subvention->file_name ?? $subvention->file }}" class="form-control shadow-none">
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <button type="submit" class="primary-btn btn-success primary-btn--md rounded border-0 my-3 mx-1">
                                                    {{ __('Submit') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal modal--aside fade" id="subventionFileDelete{{ $subvention->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0">
                                    <div class="modal-header border-0 pb-0">
                                        <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                                            <span class="novecologie-icon-close"></span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-center pt-0">
                                        <h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
                                        <span>{{ __('Are You Sure To Delete this') }} ??</span>
                                        <form action="{{ route('subvention.file.delete') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $subvention->id }}">
                                            <div class="d-flex justify-content-center">
                                                <button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
                                                    Annuler
                                                </button>
                                                <button type="submit" class="primary-btn btn-danger primary-btn--md rounded border-0 my-3 mx-1">
                                                    Supprimer
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal modal--aside fade" id="subventionFile2Edit{{ $subvention->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0">
                                    <div class="modal-header border-0 pb-0">
                                        <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                                            <span class="novecologie-icon-close"></span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-center pt-0">
                                        <h1 class="form__title position-relative mb-4">Mettre à jour le nom du fichier </h1>
                                        <form action="{{ route('subvention.file2.name.edit') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $subvention->id }}">
                                            <div class="form-group text-left">
                                                <label for="#">Nom de fichier</label>
                                                <input type="text" name="name" value="{{ $subvention->Statut_subvention_yes_file_name ?? $subvention->Statut_subvention_yes_file }}" class="form-control shadow-none">
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <button type="submit" class="primary-btn btn-success primary-btn--md rounded border-0 my-3 mx-1">
                                                    {{ __('Submit') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal modal--aside fade" id="subventionFile2Delete{{ $subvention->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0">
                                    <div class="modal-header border-0 pb-0">
                                        <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                                            <span class="novecologie-icon-close"></span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-center pt-0">
                                        <h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
                                        <span>{{ __('Are You Sure To Delete this') }} ??</span>
                                        <form action="{{ route('subvention.file2.delete') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $subvention->id }}">
                                            <div class="d-flex justify-content-center">
                                                <button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
                                                    Annuler
                                                </button>
                                                <button type="submit" class="primary-btn btn-danger primary-btn--md rounded border-0 my-3 mx-1">
                                                    Supprimer
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal modal--aside fade" id="subventionFile3Edit{{ $subvention->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0">
                                    <div class="modal-header border-0 pb-0">
                                        <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                                            <span class="novecologie-icon-close"></span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-center pt-0">
                                        <h1 class="form__title position-relative mb-4">Mettre à jour le nom du fichier </h1>
                                        <form action="{{ route('subvention.file3.name.edit') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $subvention->id }}">
                                            <div class="form-group text-left">
                                                <label for="#">Nom de fichier</label>
                                                <input type="text" name="name" value="{{ $subvention->Statut_subvention_no_file_name ?? $subvention->Statut_subvention_no_file }}" class="form-control shadow-none">
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <button type="submit" class="primary-btn btn-success primary-btn--md rounded border-0 my-3 mx-1">
                                                    {{ __('Submit') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal modal--aside fade" id="subventionFile3Delete{{ $subvention->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0">
                                    <div class="modal-header border-0 pb-0">
                                        <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                                            <span class="novecologie-icon-close"></span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-center pt-0">
                                        <h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
                                        <span>{{ __('Are You Sure To Delete this') }} ??</span>
                                        <form action="{{ route('subvention.file3.delete') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $subvention->id }}">
                                            <div class="d-flex justify-content-center">
                                                <button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
                                                    Annuler
                                                </button>
                                                <button type="submit" class="primary-btn btn-danger primary-btn--md rounded border-0 my-3 mx-1">
                                                    Supprimer
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endpush
                    @endforeach
                </div>
            </div>
        </div>
    </div>
     @endif
     @if ($user_actions->where('module_name', 'collapse_suivi_mpr')->where('action_name', 'view')->first() ||$user_actions->where('module_name', 'collapse_suivi_mpr')->where('action_name', 'edit')->first() || $role == 's_admin')
    <div class="card lead__card border-0">
        <div class="card-header bg-transparent border-0 p-0" id="leadCard-13">
        <h2 class="mb-0">
            <div class="btn text-left lead__card__toggler flex-grow-1 shadow-none d-flex align-items-center w-100 collapseBtn">
            <span id="information-verify" class="novecologie-icon-check lead__card__check mr-2 mr-sm-4"></span>
            MyPrimeMPR
                <button data-tab="Section MAPRIMERENOV" data-block="Suivi MPR" data-tab-class="suivi_mpr__part" type="button" data-toggle="collapse" data-target="#leadCardCollapse-13" aria-expanded="false" class="d-flex border-0 edit-toggler edit-toggler--lock__access {{ session('suivi_mpr__part') }} position-relative ml-auto mr-1 {{ session('suivi_mpr__part') == 'active' ? 'collapsed':'' }}">
                    <span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
                    <span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
                </button>
            </div>
        </h2>
        </div>
        <div id="leadCardCollapse-13" class="collapse {{ session('suivi_mpr__part') == 'active' ? 'show':'' }}" aria-labelledby="leadCard-13">
        <div class="card-body row">
            <div class="col custom-space">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                {{-- <form action="{{ route('information.scrap') }}" method="POST">
                                @csrf --}}
                                    <div class="row align-items-end">
                                        {{-- <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="form-label" for="name">{{ __('Email') }} <span class="text-danger">*</span></label>
                                                <input type="text" name="email" id="user_name"  class="form-control shadow-none information_disabled">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="form-label" for="birth_date">{{ __('Password') }} <span class="text-danger">*</span></label>
                                                <input type="password" name="password" id="user_password" class="form-control shadow-none information_disabled">
                                            </div>
                                        </div> --}}
                                        <div class="col-12">
                                            {{-- <div class="lead__card__loader-wrapper-2 d-none">
                                                <div class="lead__card__loader">
                                                    <svg class="lead__card__loader__icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
                                                        <path class="lead__card__loader__icon__path" fill="inherit" d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                                                        <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 50 50" to="360 50 50" repeatCount="indefinite" />
                                                        </path>
                                                    </svg>
                                                </div>
                                            </div> --}}
                                            @if ($user_actions->where('module_name', 'collapse_suivi_mpr')->where('action_name', 'edit')->first() || $role == 's_admin')
                                                <div class="form-group lead__card__btn-wrapper-2 text-center">
                                                    {{-- <button type="submit" class="primary-btn primary-btn--blue w-auto d-inline-flex justify-content-center align-items-center rounded px-4">validate</button> --}}
                                                    <span id="informationUpdateLoader" class="d-none"><svg class="lead__card__loader__icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
                                                        <path class="lead__card__loader__icon__path" fill="inherit" d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                                                        <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 50 50" to="360 50 50" repeatCount="indefinite" />
                                                        </path>
                                                    </svg></span>
                                                    <button type="button" class="primary-btn primary-btn--blue w-auto justify-content-center border-0 align-items-center rounded px-4" id="informationUpdateButton">MyPrimeMPR</button>

                                                    <button type="button" class="primary-btn primary-btn--blue w-auto justify-content-center border-0 align-items-center rounded px-4">Date MAJ : <span id="mprUpdatedAt">
                                                        @if ($project->mpr_updated_at)
                                                            {{ \Carbon\Carbon::parse($project->mpr_updated_at)->format('d/m/Y, H:i') }}
                                                        @endif
                                                        </span> </button>
                                                    <span id="informationValidateLoader" class="d-none"><svg class="lead__card__loader__icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
                                                        <path class="lead__card__loader__icon__path" fill="inherit" d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                                                        <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 50 50" to="360 50 50" repeatCount="indefinite" />
                                                        </path>
                                                    </svg></span>
                                                    <button type="button" class="primary-btn primary-btn--blue w-auto justify-content-center border-0 align-items-center rounded px-4" id="informationValidateBtn">Selectionner dossier </button>
                                                </div>
                                            @else
                                                <div class="form-group">
                                                    <button type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5">
                                                        <span class="novecologie-icon-lock py-1"></span> Selectionner dossier
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                {{-- </form> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="deposit_date">Date de dépôt MyMPR</label>
                            <input type="text" name="deposit_date" id="deposit_date" value="{{ $project->Date_de_dépôt_MyMPR }}" class="form-control shadow-none information_disabled">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="mpr_file">N° Dossier MPR - MyMPR</label>
                            <input type="text" name="mpr_file" id="mpr_file" value="{{ $project->N_Dossier_MPR_hyphen_MyMPR }}"  class="form-control shadow-none information_disabled">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="estimated_amount">Montant subvention prévisionnel - MyMPR</label>
                            <input type="hidden" value="{{ $project->Montant_subvention_prévisionnel_hyphen_MyMPR }}" name="estimated_amount" id="estimated_amount" class="montant_value">
                            <input type="text" class="form-control shadow-none montant_format information_disabled" id="estimated_amount_formated" value="{{ EuroFormat($project->Montant_subvention_prévisionnel_hyphen_MyMPR) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="deposited_work">Travaux deposés - MyMPR</label>
                            <input name="deposited_work" id="deposited_work"  value="{{ $project->Travaux_deposés_hyphen_MyMPR }}" class="shadow-none form-control information_disabled">

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="status_1">Statut 1 - MyMPR</label>
                            <input type="text" name="status_1" id="status_1" value="{{ $project->Statut_1_hyphen_MyMPR }}" class="form-control shadow-none information_disabled">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="status_2">Statut 2 - MyMPR</label>
                            <input type="text" name="status_2" id="status_2" value="{{ $project->Statut_2_hyphen_MyMPR }}" class="form-control shadow-none information_disabled">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="addresss">Adresse - MyMPR</label>
                            <input type="text" name="address" id="addresss" value="{{ $project->Adresse_hyphen_MyMPR }}" class="form-control shadow-none information_disabled">
                        </div>
                    </div>
                    @include('admin.custom_field_data', ['inputs' => $all_inputs->where('collapse_name', 'myprimempr__collapse'), 'custom_field_data' => $project->myprimempr_custom_field_data, 'class' => 'myprimempr__custom_field', 'disabled_class' => 'information_disabled'])
                    @if ($user_actions->where('module_name', 'collapse_suivi_mpr')->where('action_name', 'edit')->first() || $role == 's_admin')
                        <div class="col-12 text-center ">
                            <button id="informationValidate"
                            type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5 information_disabled">
                                {{ __('Submit') }}
                            </button>
                            @if ($role == 's_admin')
                                <button type="button" data-collapse="myprimempr__collapse" data-callapse_active="maprimerenov_active" class="addCustomFieldBtn primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5 information_disabled">
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
            </div>
        </div>
        </div>
    </div>
     @endif
</div>


{{-- Subvention create modal --}}
<div class="modal modal--aside fade" id="subventionCreateModal" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                    <span class="novecologie-icon-close"></span>
                </button>
            </div>
            <div class="modal-body text-center pt-0">
                <h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
                <span>Etes-vous sûr de vouloir créer une nouvelle subvention ?</span>
                <form action="{{ route('project.subvention.create') }}" method="POST">
                    @csrf
                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                    <div class="d-flex justify-content-center">
                        <button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
                            {{ ('Non') }}
                        </button>
                        <button type="submit" class="primary-btn btn-success primary-btn--md rounded border-0 my-3 mx-1">
                            {{ __('Oui') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Mpr Select Modal create modal --}}
<div class="modal modal--aside fade" id="mprSelectModal" tabindex="-1" aria-labelledby="mprSelectModalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                    <span class="novecologie-icon-close"></span>
                </button>
            </div>
            <div class="modal-body pt-0" id="mprModalBody">

            </div>
        </div>
    </div>
</div>


{{--  Subvention Delete Modal  --}}
<div class="modal modal--aside fade" id="SubventionDeleteButton" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                    <span class="novecologie-icon-close"></span>
                </button>
            </div>
            <div class="modal-body text-center pt-0">
                <h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
                <span>{{ __('Are You Sure To Delete this') }}?</span>
                <form action="{{ route('project.subvention.delete') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="subvention_deleted_id">
                    <div class="d-flex justify-content-center">
                        <button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
                            Annuler
                        </button>
                        <button type="submit" class="primary-btn btn-danger primary-btn--md rounded border-0 my-3 mx-1">
                            Confirmer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>