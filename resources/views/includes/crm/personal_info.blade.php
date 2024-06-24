<div class="card-body row">
    <div class="col custom-space">
        @if ($primary_tax)
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="f__title">{{ __('Title') }} <span class="text-danger">*</span></label>
                                <select name="title" id="f__title" class="form-control custom-select shadow-none personal_info_disabled info_title primary_tax_title" required>
                                    <option value="">{{ __('Select') }}</option>
                                    <option {{ $primary_tax->title ? ($primary_tax->title == 'Mr' ? 'selected':''):($data->Titre == 'Mr' ? 'selected':'') }} value="Mr">{{ __('Mr') }}</option>
                                    <option {{ $primary_tax->title ? ($primary_tax->title == 'Mme' ? 'selected':''):($data->Titre == 'Mme' ? 'selected':'') }} value="Mme">{{ __('Mme') }}</option>
                                    <option {{ $primary_tax->title ? ($primary_tax->title == 'Mlle' ? 'selected':''):($data->Titre == 'Mlle' ? 'selected':'') }} value="Mlle">{{ __('Mlle') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="f__first_name">{{ __('Prenom') }} <span class="text-danger">*</span></label>
                                <input type="text" name="first_name" id="f__first_name" class="form-control shadow-none personal_info_disabled info_first_name" value="{{ $primary_tax->first_name ?? $data->Prenom }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="f__last_name">{{ __('Nom') }} <span class="text-danger">*</span></label>
                                <input type="text" name="last_name" id="f__last_name" class="form-control shadow-none personal_info_disabled info_last_name" value="{{ $primary_tax->last_name ?? $data->Nom }}" required>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($primary_tax->Existe_déclarant == 'Oui')
                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="f__second_title">{{ __('Title') }} 2 <span class="text-danger">*</span></label>
                                    <select name="second_title" id="f__second_title" class="form-control custom-select shadow-none personal_info_disabled info_title">
                                        <option value="">{{ __('Select') }}</option>
                                        <option @if ($primary_tax->second_title =='Mr')
                                        selected
                                        @endif value="Mr">{{ __('Mr') }}</option>
                                        <option @if ($primary_tax->second_title =='Mme')
                                        selected
                                        @endif value="Mme">{{ __('Mme') }}</option>
                                        <option @if ($primary_tax->second_title =='Mlle')
                                        selected
                                        @endif value="Mlle">{{ __('Mlle') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="f__second_first_name">{{ __('Prenom 2') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="second_first_name" id="f__second_first_name" class="form-control shadow-none personal_info_disabled" value="{{ $primary_tax->second_first_name }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="f__second_last_name">{{ __('Nom 2') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="second_last_name" id="f__second_last_name" class="form-control shadow-none personal_info_disabled" value="{{ $primary_tax->second_last_name }}">
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="f__address2">{{ __('Adresse') }}  <span class="text-danger">*</span></label>
                        <input type="text" name="address2" id="f__address2" class="form-control shadow-none personal_info_disabled" value="{{ $primary_tax->address2 ?? $data->Adresse }}">
                        {{-- <div class="d-flex align-item-center justify-content-end">
                            <button type="button" data-input-id="f__address2" class="border-0 edit-toggler position-absolute ml-auto mt-1 mr-1
                            @if(role() == 'manager' || role() == 's_admin' || role() == 'manager_direction')
                                informations_personal
                            @endif
                            ">
                                <span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
                                <span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
                            </button>
                        </div> --}}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="f__address1">Complément adresse </label>
                        <input type="text" name="address" id="f__address1" class="form-control shadow-none personal_info_disabled" value="{{ $primary_tax->address ?? $data->Complément_adresse }}">
                        {{-- <div class="d-flex align-item-center justify-content-end">
                            <button type="button" data-input-id="f__address1" class="border-0 edit-toggler position-absolute ml-auto mt-1 mr-1
                            @if(role() == 'manager' || role() == 's_admin' || role() == 'manager_direction')
                                informations_personal
                            @endif
                            ">
                                <span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
                                <span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
                            </button>
                        </div> --}}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="f__postal_code">{{ __('Code Postal') }}  <span class="text-danger">*</span></label>
                        <input type="number" name="postal_code" id="f__postal_code" class="form-control shadow-none personal_info_disabled" value="{{ $primary_tax->postal_code ?? $data->Code_Postal }}">
                        {{-- <div class="d-flex align-item-center justify-content-end">
                            <button type="button" data-input-id="f__postal_code" class="border-0 edit-toggler position-absolute ml-auto mt-1 mr-1
                            @if(role() == 'manager' || role() == 's_admin' || role() == 'manager_direction')
                                informations_personal
                            @endif
                            ">
                                <span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
                                <span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
                            </button>
                        </div> --}}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="f__city">{{ __('City') }}  <span class="text-danger">*</span></label>
                        <input type="text" name="city" id="f__city" class="form-control shadow-none personal_info_disabled" required value="{{ $primary_tax->city ?? $data->Ville }}">
                        {{-- <div class="d-flex align-item-center justify-content-end">
                            <button type="button" data-input-id="f__city" class="border-0 edit-toggler position-absolute ml-auto mt-1 mr-1
                            @if(role() == 'manager' || role() == 's_admin' || role() == 'manager_direction')
                                informations_personal
                            @endif
                            ">
                                <span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
                                <span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
                            </button>
                        </div> --}}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="f__department">Département</label>
                        <input type="text" name="department" id="f__department" class="form-control shadow-none personal_info_disabled" readonly value="{{ $primary_tax->postal_code ? getDepartment2($primary_tax->postal_code) : getDepartment2($data->Code_Postal) }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="google_address">Google Adresse</label>
                    <div class="form-group d-flex flex-column align-items-center position-relative">
                        <input type="text" name="google_address" id="google_address" class="form-control shadow-none personal_info_disabled" value="{{ $primary_tax->google_address }}">
                    </div>
                </div>
                <div class="col-12">
                    <div class="my-3 d-flex align-items-center">
                        <span class="mb-0 mr-2">L'adresse fiscale et l'adresse des travaux sont elle les même ?</span>
                        <label class="switch-checkbox">
                            <input type="checkbox" id="same_as_work_address" {{ ($primary_tax->same_as_work_address == 'yes')? 'checked':'' }} class="switch-checkbox__input personal_info_disabled">
                            <span class="switch-checkbox__label"></span>
                        </label>
                    </div>
                </div>
                <div class="col-12" id="same_as_work_address_wrap" style="display: {{ ($primary_tax->same_as_work_address == 'yes')? 'none':'' }}">
                    <div class="row">
                        <div class="col-md-6">
                            {{-- <label class="form-label" for="f__Adresse_Travaux">Adresse Travaux</label>
                            <div class="form-group d-flex flex-column align-items-center position-relative">
                                <input type="text" name="Adresse_Travaux" id="f__Adresse_Travaux" class="form-control shadow-none personal_info_disabled" value="{{ $primary_tax->Adresse_Travaux }}">
                            </div> --}}
                            <div class="form-group">
                                <label class="form-label" for="f__Adresse_Travaux" class="form-label">Adresse Travaux  <span class="text-danger">*</span></label>
                                <input type="search" id="f__Adresse_Travaux" name="Adresse_Travaux" value="{{ $primary_tax->Adresse_Travaux }}" class="googleSearchInput form-control shadow-none personal_info_disabled">
                                {{-- <div class="d-flex align-item-center justify-content-end">
                                    <button type="button" data-input-id="f__Adresse_Travaux" class="border-0 edit-toggler position-absolute ml-auto mt-1 mr-1
                                    @if(role() == 'manager' || role() == 's_admin' || role() == 'manager_direction')
                                        informations_personal
                                    @endif
                                    ">
                                        <span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
                                        <span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
                                    </button>
                                </div> --}}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="f__Complément_adresse_Travaux">Complément adresse Travaux </label>
                            <div class="form-group">
                                <input type="text" name="Complément_adresse_Travaux" id="f__Complément_adresse_Travaux" class="form-control shadow-none personal_info_disabled" value="{{ $primary_tax->Complément_adresse_Travaux }}">
                                {{-- <div class="d-flex align-item-center justify-content-end">
                                    <button type="button" data-input-id="f__Complément_adresse_Travaux" class="border-0 edit-toggler position-absolute ml-auto mt-1 mr-1
                                    @if(role() == 'manager' || role() == 's_admin' || role() == 'manager_direction')
                                        informations_personal
                                    @endif
                                    ">
                                        <span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
                                        <span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
                                    </button>
                                </div> --}}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="f__Code_postal_Travaux">Code postal Travaux  <span class="text-danger">*</span></label>
                                <input type="number" name="Code_postal_Travaux" id="f__Code_postal_Travaux" class="form-control shadow-none personal_info_disabled" value="{{ $primary_tax->Code_postal_Travaux }}">
                                {{-- <div class="d-flex align-item-center justify-content-end">
                                    <button type="button" data-input-id="f__Code_postal_Travaux" class="border-0 edit-toggler position-absolute ml-auto mt-1 mr-1
                                    @if(role() == 'manager' || role() == 's_admin' || role() == 'manager_direction')
                                        informations_personal
                                    @endif
                                    ">
                                        <span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
                                        <span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
                                    </button>
                                </div> --}}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="f__Ville_Travaux">Ville Travaux</label>
                                <input type="text" name="Ville_Travaux" id="f__Ville_Travaux" class="form-control shadow-none personal_info_disabled" required value="{{ $primary_tax->Ville_Travaux }}">
                                {{-- <div class="d-flex align-item-center justify-content-end">
                                    <button type="button" data-input-id="f__Ville_Travaux" class="border-0 edit-toggler position-absolute ml-auto mt-1 mr-1
                                    @if(role() == 'manager' || role() == 's_admin' || role() == 'manager_direction')
                                        informations_personal
                                    @endif
                                    ">
                                        <span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
                                        <span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
                                    </button>
                                </div> --}}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="f__Departement_Travaux">Departement Travaux</label>
                                <input type="text" name="Departement_Travaux" id="f__Departement_Travaux" class="form-control shadow-none personal_info_disabled" readonly value="{{ getDepartment2($primary_tax->Code_postal_Travaux) }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <label class="form-label" for="f__email">{{ __('Email') }} <span class="text-danger">*</span></label>
                    <div class="form-group d-flex flex-column align-items-center position-relative">
                        <input type="email" name="email" id="f__email" class="form-control shadow-none personal_info_disabled" value="{{ $primary_tax->email ?? $data->Email }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="f__phone">{{ __('N° Mobile') }} <span class="text-danger">*</span> </label>
                    <div class="form-group d-flex flex-column align-items-center position-relative">
                        {{-- <span class="novecologie-icon-phone form-group__icon position-absolute"></span> --}}
                        <input type="number" name="phone" id="f__phone" class="form-control shadow-none personal_info_disabled" value="{{ $primary_tax->phone ?? $data->phone }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="f__home_telephone">{{ __('N° Fixe') }}</label>
                    <div class="form-group d-flex flex-column align-items-center position-relative">
                        {{-- <span class="novecologie-icon-phone form-group__icon position-absolute"></span> --}}
                        <input type="number" name="home_telephone" id="f__home_telephone" class="form-control shadow-none personal_info_disabled" value="{{ $primary_tax->telephone ?? $data->fixed_number }}">
                    </div>
                </div>

                <div class="col-12">
                    <label class="form-label" for="f__observation">Observations</label>
                    <div class="form-group d-flex flex-column align-items-center position-relative">
                        <textarea  name="observation" id="f__observation" class="form-control shadow-none personal_info_disabled">{{ $primary_tax->observations ?? $data->Observations }}</textarea>
                    </div>
                </div>
                {{-- @include('admin.custom_field_data', ['inputs' => \App\Models\CRM\ProjectCustomField::where('collapse_name', 'collapse__personal_information')->get(), 'custom_field_data' => $primary_tax->getLead->personal_info_custom_field_data, 'class' => 'personal_info_custom_field', 'disabled_class' => 'personal_info_disabled']) --}}
                @if ($type == 'lead_collapse_personal_information')
                    @include('admin.custom_field_data', ['inputs' => \App\Models\CRM\ProjectCustomField::where('collapse_name', 'collapse__personal_information')->get(), 'custom_field_data' => $primary_tax->getLead->personal_info_custom_field_data, 'class' => 'personal_info_custom_field', 'disabled_class' => 'personal_info_disabled'])
                @elseif($type == 'client_collapse_personal_information')
                    @include('admin.custom_field_data', ['inputs' => \App\Models\CRM\ProjectCustomField::where('collapse_name', 'collapse__personal_information')->get(), 'custom_field_data' => $primary_tax->getClient->personal_info_custom_field_data, 'class' => 'personal_info_custom_field', 'disabled_class' => 'personal_info_disabled'])
                @elseif($type == 'collapse_personal_information')
                    @include('admin.custom_field_data', ['inputs' => \App\Models\CRM\ProjectCustomField::where('collapse_name', 'collapse__personal_information')->get(), 'custom_field_data' => $primary_tax->getProject->personal_info_custom_field_data, 'class' => 'personal_info_custom_field', 'disabled_class' => 'personal_info_disabled'])
                @endif
                <div class="col-12 mt-3">
                    <a target="_blank" id="googleMapImage" href="https://www.google.com/maps?q={{ urlencode($primary_tax->google_address) }}">
                        <img  loading="lazy"  height="80" src="{{ asset('crm_assets/assets/images/Google-Maps-Logo-Transparent 1.png') }}" alt="">
                    </a>
                    <a target="_blank" href="https://www.geoportail.gouv.fr/" class="mx-5">
                        <img  loading="lazy"  width="150" src="{{ asset('crm_assets/assets/images/geo-logo.png') }}" alt="">
                    </a>
                    <a target="_blank" href="https://cadastre.gouv.fr/scpc/accueil.do">
                        <img  loading="lazy"  height="80" src="{{ asset('crm_assets/assets/images/cadastre-gouv-logo.png') }}" alt="">
                    </a>
                </div>

                {{-- <div class="col-4">
                    <label class="form-label" for="pays">{{ __('Revenu fiscal de référence') }}</label>
                    <div class="form-group d-flex flex-column align-items-center position-relative">
                        <input type="number" name="pays" id="pays{{ $primary_tax->id }}" class="form-control shadow-none personal_info_disabled" value="{{ $primary_tax->pays }}">
                    </div>
                </div> --}}
                @if (checkAction(Auth::id(), $type, 'edit') || role() == 's_admin')
                    <div class="col-12 text-center mb-3">
                        <button id="infoValidate" data-tax-id="{{ $primary_tax->id }}" type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5 infoValidateBtn personal_info_disabled">
                            Valider
                        </button>
                        @if (role() == 's_admin')
                            <button type="button" data-collapse="collapse__personal_information" data-callapse_active="client_active" class="addCustomFieldBtn primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5 personal_info_disabled">
                                Ajouter un champ
                            </button>
                        @endif
                    </div>
                @else
                    <div class="col-12 text-center mb-3">
                        <button type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5">
                            <span class="novecologie-icon-lock py-1"></span>
                        </button>
                    </div>
                @endif
            </div>
        @endif
    </div>
</div>

 