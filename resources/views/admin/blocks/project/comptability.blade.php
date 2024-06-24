@php 
    $operations = \App\Models\CRM\WorkDone::where('project_id', $project->id)->get();   
    $addition_products = \App\Models\CRM\AdditionalProduct::where('project_id', $project->id)->orderBy('order', 'asc')->get();
    $energy_aid = \App\Models\CRM\EnergyAid::where('project_id', $project->id)->first();
    if(!$energy_aid){
        $energy_aid = \App\Models\CRM\EnergyAid::create(['project_id' => $project->id]);
    }
    $sidebar_info = \App\Models\CRM\DevisSidebar::where('project_id', $project->id)->first();
    if(!$sidebar_info){
        $sidebar_info = \App\Models\CRM\DevisSidebar::create(['project_id' => $project->id]);
    } 
    
    $primary_tax = \App\Models\CRM\ProjectTax::where('project_id', $project->id)->where('primary', 'yes')->first(); 
    $deals = \App\Models\CRM\Deal::all();
    $scales = \App\Models\CRM\Scale::where('active', 'yes')->where('deleted_status', 'no')->where('status', 'active')->get();
    $products = \App\Models\CRM\Product::latest()->get();
    $prestation_group = \App\Models\CRM\PrestationGroup::all();
@endphp
<div class="accordion" id="leadAccordion7">
    <div class="new-block">
        <div class="new-block__header new-block__header--info d-flex align-items-center">
            <h3 class="new-block__header__title">Opérations CEE / Travaux réalisés</h3>
            <div class="ml-auto">
                @if ($user_actions->where('module_name', 'collapse_comptability')->where('action_name', 'create_operation_cee')->first() || $role == 's_admin')
                    <button class="btn new-block__header__btn" data-toggle="modal" data-target="#workPerformedCreateModal">
                        <i class="bi bi-plus-lg"></i>
                    </button>
                @else
                    <button class="btn new-block__header__btn">
                        <span class="novecologie-icon-lock py-1"></span>
                    </button>
                @endif
                {{-- <button class="btn new-block__header__btn">
                    <i class="bi bi-stopwatch"></i>
                </button> --}}
            </div>
        </div>

        <div class="new-block__body">
            <div class="table-responsive">
                <table class="table table-bordered database-table">
                    <thead class="database-table__header">
                        <tr>
                            <th>Opération CEE</th>
                            <th>Détail</th>
                            <th>Produit</th>
                            <th>Quantité</th>
                            <th>P.U TTC</th>
                            <th>Total TTC</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="database-table__body">
                        {{-- @foreach ($operations as $operation)
                        <tr>
                            <td class="text-center">
                                {{ $operation->getBaremes->wording }}
                                <span class="text-success d-block">
                                   
                                </span>
                            </td>
                            <td> {{ $operation->getBaremes->description }}</td>
                            <td class="wrap">
                                {{ $operation->getProduct->designation }}
                                <span class="d-block">
                                    <strong>Installé par :</strong>
                                    <span class="text-info">{{ $operation->installer_rge }} </span>
                                </span>
                            </td>
                            <td>{{ $operation->quantity }} U</td>
                            <td>{{ $operation->unit_bonus }} €</td>
                            <td>{{ $operation->total_ttc }} €</td>
                            <td class="text-center">
                                <div class="dropdown dropdown--custom p-0 d-inline-block">
                                    <button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="-160, 5">
                                        <span class="novecologie-icon-dots-horizontal-triple"></span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown" style="">
                                        @if ($user_actions->where('module_name', 'collapse_comptability')->where('action_name', 'edit_operation_cee')->first() || $role == 's_admin')
                                            <button data-client-id="3" type="button" class="dropdown-item border-0 clientAssigneeButton" data-toggle="modal" data-target="#workPerformedCreateModalEdit{{ $operation->id }}">
                                                <i class="bi bi-arrow-repeat mr-1 mr-1"></i>
                                                Modifier
                                            </button>
                                        @else
                                            <button type="button" class="dropdown-item border-0">
                                                <span class="novecologie-icon-lock p$operationsy-1"></span> Modifier
                                            </button>
                                        @endif
                                        @if ($user_actions->where('module_name', 'collapse_comptability')->where('action_name', 'delete_operation_cee')->first() || $role == 's_admin')
                                            <button type="submit" class="dropdown-item border-0" id="customSelectDropdown" data-toggle="button" data-target="#workPerformedCreateModalDelete{{ $operation->id }}">
                                                <span class="novecologie-icon-trash mr-1"></span>
                                                effacer
                                            </button>
                                        @else
                                            <button type="button" class="dropdown-item border-0">
                                                <span class="novecologie-icon-lock py-1 mr-1"></span> effacer
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="new-block">
        <div class="new-block__header new-block__header--warning d-flex align-items-center">
            <h3 class="new-block__header__title">Prestations / produits supplémentaires</h3>
            <div class="ml-auto">
                @if ($user_actions->where('module_name', 'collapse_comptability')->where('action_name', 'delete_prestations')->first() || $role == 's_admin')
                    <button type="button" class="btn new-block__header__btn d-none" id="PrestationBulkDeleteBtn" data-toggle="modal" data-target="#PrestationsDeleteModal">
                        <i class="bi bi-trash3-fill"></i>
                    </button>
                @endif
                @if ($user_actions->where('module_name', 'collapse_comptability')->where('action_name', 'create_prestations')->first() || $role == 's_admin')
                    <button type="button" class="btn new-block__header__btn" data-toggle="modal" data-target="#PrestationsModal">
                        <i class="bi bi-plus-lg"></i>
                    </button>
                @else
                    <button type="button" class="btn new-block__header__btn">
                        <span class="novecologie-icon-lock py-1"></span>
                    </button>
                @endif
                {{-- <button class="btn new-block__header__btn">
                    <i class="bi bi-stopwatch"></i>
                </button> --}}
            </div>
        </div>

        <div class="new-block__body">
            <div class="table-responsive">
                <table class="table database-table">
                    <thead class="database-table__header">
                        <tr>
                            <th>
                                <div class="custom-control custom-checkbox">
                                    <input  type="checkbox" class="custom-control-input table-all-select-checkbox prestationAllCheckbox" id="tableAllSelectCheck">
                                    <label class="custom-control-label" for="tableAllSelectCheck"></label>
                                </div>
                            </th>
                            <th>#</th>
                            <th>Titre</th>
                            <th>PU TTC</th>
                            <th>Qté</th>
                            <th>TOTAL TTC</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="database-table__body">
                        @foreach ($addition_products as $product)
                            <tr id="hiddenRow{{ $product->id }}" class="d-none">
                                <form action="{{ route('additional.product.update2') }}" method="post">
                                    @csrf
                                    <td class="text-left">
                                        <div class="custom-control custom-checkbox">
                                            <input  type="checkbox" class="custom-control-input shadow-none table-all-select-checkbox" id="tableAllSelectCheck{{ $product->id }}" disabled>
                                            <label class="custom-control-label" for="tableAllSelectCheck{{ $product->id }}"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="number" name="order" class="form-control shadow-none  required number custom-control-pd px-0 text-center" value="{{ $product->order }}" required>
                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                    </td>
                                    <td>
                                        <input class="form-control shadow-none text-md-center type="text" name="title" value="{{ $product->title }}" required>
                                    </td>
                                    <td>
                                        <div class="input-group flex-nowrap">
                                            <input type="number" name="pu_ttc" id="pu_ttc{{ $product->id }}" data-id="{{ $product->id }}" class="form-control shadow-none product_total_count" value="{{ $product->pu_ttc }}" aria-label="Amount (to the nearest dollar)" required>
                                            <div class="input-group-append">
                                            <span class="input-group-text">€</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <input style="" name="quantity" class="form-control shadow-none product_total_count" id="quantity{{ $product->id }}" data-id="{{ $product->id }}" type="number" data-val="true" data-val-number="The field Quantite must be a number." data-val-required="Ce champ est obligatoire." value="{{ $product->quantity }}" required>
                                    </td>
                                    <td>
                                        <div class="input-group flex-nowrap">
                                            <input type="number" name="total_ttc" id="total_ttc{{ $product->id }}" class="form-control shadow-none" value="{{ $product->total_ttc }}" aria-label="Amount (to the nearest dollar)" required>
                                            <div class="input-group-append">
                                            <span class="input-group-text">€</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="submit" id="savePrestation" title="Enregistrer la modification" class="btn btn-sm btn-primary">
                                            <i class="bi bi-check"></i>
                                            </button>

                                            <button type="button" title="Annuler la modification" data-id="{{ $product->id }}" class="btn btn-sm btn-warning productModifierX">
                                                <i class="bi bi-x"></i>
                                            </button>
                                    </td>
                                </form>
                            </tr>
                            <tr  id="visibleRow{{ $product->id }}">
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input  type="checkbox" class="custom-control-input table-all-select-checkbox prestationSingleCheckbox" data-id="{{ $product->id }}" id="tableAllSelectCheck0{{ $product->id }}">
                                        <label class="custom-control-label" for="tableAllSelectCheck0{{ $product->id }}"></label>
                                    </div>
                                </td>
                                <td>{{ $product->order }}</td>
                                @if ($user_actions->where('module_name', 'collapse_comptability')->where('action_name', 'edit_prestations')->first() || $role == 's_admin')
                                <td>
                                    <a style="color:#000000; text-decoration: underline;" title="Chaudière" href="#" data-toggle="modal" data-target="#PrestationsModalEdit{{ $product->id }}">{{ $product->title }} </a>
                                </td>
                                @else
                                    <td> {{ $product->title }} </td>
                                @endif
                                <td>{{ $product->pu_ttc }} €</td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $product->total_ttc }} €</td>
                                <td class="text-center">
                                    <div class="dropdown dropdownMenuLink dropdown--custom p-0 d-inline-block">
                                        <button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="-100, 5">
                                            <span class="novecologie-icon-dots-horizontal-triple"></span>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100">
                                            @if ($user_actions->where('module_name', 'collapse_comptability')->where('action_name', 'edit_prestations')->first() || $role == 's_admin')
                                                <button data-client-id="3" data-id="{{ $product->id }}" type="button" class="dropdown-item border-0 productModifier">
                                                    <i class="bi bi-arrow-repeat mr-1"></i>
                                                    Modifier
                                                </button>
                                            @else
                                                <button type="button" class="dropdown-item border-0">
                                                    <span class="novecologie-icon-lock py-1 mr-1"></span> Modifier
                                                </button>
                                            @endif
                                            @if ($user_actions->where('module_name', 'collapse_comptability')->where('action_name', 'delete_prestations')->first() || $role == 's_admin')
                                                <button type="button" class="dropdown-item border-0" id="customSelectDropdown" data-toggle="modal" data-target="#PrestationsModalDelete{{ $product->id }}">
                                                    <span class="novecologie-icon-trash mr-1"></span>
                                                    effacer
                                                </button>
                                            @else
                                                <button type="button" class="dropdown-item border-0">
                                                    <span class="novecologie-icon-lock py-1 mr-1"></span> effacer
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        <tr style="background-color: #eb9d2d; color: white">

                            <td colspan="5">{{ $addition_products->count() }} lignes</td>
                            <td>{{ $addition_products->sum('total_ttc') }} €</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="new-block">
        <div class="new-block__header new-block__header--info d-flex align-items-center">
            <h3 class="new-block__header__title">Aides énergétiques</h3>
            <div class="ml-auto">
                {{-- <button class="btn new-block__header__btn">
                    <i class="bi bi-trash3-fill"></i>
                </button>
                <button class="btn new-block__header__btn" data-toggle="modal" data-target="#workPerformedCreateModal">
                    <i class="bi bi-plus-lg"></i>
                </button>
                <button class="btn new-block__header__btn">
                    <i class="bi bi-stopwatch"></i>
                </button> --}}
                <ul class="nav nav-pills nav-pills--horizontal" id="pills-tab" role="tablist">
                    <li class="nav-item new-block__tabs" role="presentation">
                        <a class="nav-link active" id="pills-primeCee-tab" data-toggle="pill" href="#pills-primeCee" role="tab" aria-controls="pills-primeCee" aria-selected="true">{{ __('PrimeCEE') }}</a>
                    </li>
                    <li class="nav-item new-block__tabs" role="presentation">
                        <a class="nav-link"  id="pills-Maprime-tab" data-toggle="pill" href="#pills-Maprime" role="tab" aria-controls="pills-Maprime" aria-selected="false">{{ __('MaPrimeRénov') }}</a>
                    </li>
                    <li class="nav-item new-block__tabs" role="presentation">
                        <a class="nav-link" id="pills-three-tab" data-toggle="pill" href="#pills-three" role="tab" aria-controls="pills-three" aria-selected="false">{{ __('Action Logement') }}</a>
                    </li>
                    <li class="nav-item new-block__tabs" role="presentation">
                        <a class="nav-link" id="pills-four-tab" data-toggle="pill" href="#pills-four" role="tab" aria-controls="pills-four" aria-selected="false">{{ __('Prise en charge') }}</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="new-block__body">
            <form action="{{ route('project.energy.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $energy_aid->id }}">
                <div class="database-table-wrapper bg-white">

                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-primeCee" role="tabpanel" aria-labelledby="pills-primeCee-tab">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4">
                                        <div class="check-boxes d-flex justify-content-between">
                                                <p>Prime CEE:</p>
                                            <div class="custom-control custom-switch">
                                                <input {{ ($energy_aid->prime_cee == 'yes')? 'checked':'' }} name="prime_cee" type="checkbox"  class="custom-control-input shadow-none prime_cee_button comptability_disabled" id="customSwitch1" value="yes">
                                                <label class="custom-control-label" for="customSwitch1"></label>
                                            </div>
                                        </div>
                                        <div class="bottom_part d-flex justify-content-between align-items-center">
                                            <p class="m-0" style="padding-right: 5px">Montant:</p>
                                            <div class="input-group">
                                                <input readonly type="number" value="{{ $operations->sum('total_ttc') }}" class="form-control shadow-none comptability_disabled" aria-label="Dollar amount (with dot and two decimal places)">
                                                <div class="input-group-append">
                                                <span class="input-group-text">€</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-8 {{ ($energy_aid->prime_cee == 'yes')? '':'d-none' }}" id="prime_cee_block">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <h4 style="font-weight: 600">Configuration Devis</h4>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="custom-switches d-flex justify-content-between align-items-center">
                                                    <h4 class="p-0">Mentionner les conditions</h4>
                                                    <div class="custom-control custom-switch">
                                                        <input {{ ($energy_aid->prime_devis_condition == 'yes')? 'checked':'' }} name="prime_devis_condition" type="checkbox" class="custom-control-input shadow-none comptability_disabled" id="customSwitch2"  value="yes">
                                                        <label class="custom-control-label" for="customSwitch2"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="custom-switches d-flex justify-content-between align-items-center">
                                                    <h4 class="p-0">Mentionner / Déduire la prime</h4>
                                                    <div class="custom-control custom-switch">
                                                        <input {{ ($energy_aid->prime_devis_deduct == 'yes')? 'checked':'' }} name="prime_devis_deduct" type="checkbox" class="custom-control-input shadow-none comptability_disabled" id="customSwitch3" value="yes">
                                                        <label class="custom-control-label" for="customSwitch3"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr style="width: 100%">
                                            <div class="col-lg-12">
                                                <h4 style="font-weight: 600">Configuration Facture</h4>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="custom-switches d-flex justify-content-between align-items-center">
                                                    <h4 class="p-0">Mentionner les conditions</h4>
                                                    <div class="custom-control custom-switch">
                                                        <input {{ ($energy_aid->prime_facture_condition == 'yes')? 'checked':'' }} name="prime_facture_condition"  type="checkbox" class="custom-control-input shadow-none comptability_disabled" id="customSwitch4"value="yes">
                                                        <label class="custom-control-label" for="customSwitch4"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="custom-switches d-flex justify-content-between align-items-center">
                                                    <h4 class="p-0">Mentionner / Déduire la prime</h4>
                                                    <div class="custom-control custom-switch">
                                                        <input {{ ($energy_aid->prime_facture_deduct == 'yes')? 'checked':'' }} name="prime_facture_deduct" type="checkbox" class="custom-control-input shadow-none comptability_disabled" id="customSwitch5" value="yes">
                                                        <label class="custom-control-label" for="customSwitch5"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-Maprime" role="tabpanel" aria-labelledby="pills-Maprime-tab">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4 col-md-4">
                                    <div class="check-boxes d-flex justify-content-between">
                                            <p>MaPrimeRénov':</p>
                                        <div class="custom-control custom-switch">
                                            <input {{ ($energy_aid->maprime == 'yes')? 'checked':'' }} name="maprime" type="checkbox" value="yes" class="custom-control-input shadow-none maprime_button comptability_disabled" id="customSwitch76">
                                            <label class="custom-control-label" for="customSwitch76"></label>
                                        </div>
                                    </div>
                                    <div class="bottom_part d-flex justify-content-between align-items-center">
                                        <p class="m-0" style="padding-right: 5px">Montant:</p>
                                        <div class="input-group">
                                            <input name="maprime_montant" type="text" class="form-control shadow-none comptability_disabled" aria-label="Dollar amount (with dot and two decimal places)">
                                            <div class="input-group-append">
                                            <span class="input-group-text">€</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-8 maprime_block {{ ($energy_aid->maprime == 'yes')? '':'d-none' }}">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h4 style="font-weight: 600">Configuration Devis</h4>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="custom-switches d-flex justify-content-between align-items-center">
                                                <h4 class="p-0">Mentionner les conditions</h4>
                                                <div class="custom-control custom-switch">
                                                    <input {{ ($energy_aid->maprime_devis_condition == 'yes')? 'checked':'' }} name="maprime_devis_condition" value="yes" type="checkbox" class="custom-control-input shadow-none comptability_disabled" id="customSwitch77">
                                                    <label class="custom-control-label" for="customSwitch77"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="custom-switches d-flex justify-content-between align-items-center">
                                                <h4 class="p-0">Mentionner / Déduire la prime</h4>
                                                <div class="custom-control custom-switch">
                                                    <input {{ ($energy_aid->maprime_devis_deduct == 'yes')? 'checked':'' }} name="maprime_devis_deduct" value="yes" type="checkbox" class="custom-control-input shadow-none comptability_disabled" id="customSwitch78">
                                                    <label class="custom-control-label" for="customSwitch78"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <hr style="width: 100%">
                                        <div class="col-lg-12">
                                            <h4 style="font-weight: 600">Configuration Facture</h4>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="custom-switches d-flex justify-content-between align-items-center">
                                                <h4 class="p-0">Mentionner les conditions</h4>
                                                <div class="custom-control custom-switch">
                                                    <input {{ ($energy_aid->maprime_facture_condition == 'yes')? 'checked':'' }} name="maprime_facture_condition" value="yes" type="checkbox" class="custom-control-input shadow-none comptability_disabled" id="customSwitch79">
                                                    <label class="custom-control-label" for="customSwitch79"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="custom-switches d-flex justify-content-between align-items-center">
                                                <h4 class="p-0">Mentionner / Déduire la prime</h4>
                                                <div class="custom-control custom-switch">
                                                    <input {{ ($energy_aid->maprime_facture_deduct == 'yes')? 'checked':'' }} name="maprime_facture_deduct" value="yes" type="checkbox" class="custom-control-input shadow-none comptability_disabled" id="customSwitch80">
                                                    <label class="custom-control-label" for="customSwitch80"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr style="width: 100%" class="maprime_block">
                                <div class="col-12 maprime_block {{ ($energy_aid->maprime == 'yes')? '':'d-none' }}">
                                    <div class="row">
                                        <div class="col-lg-4 d-flex justify-content-between align-items-center">
                                            <p class="m-0">Bonus sortie passoire :</p>
                                        <div class="custom-control custom-switch">
                                            <input {{ ($energy_aid->maprime_output_bonus == 'yes')? 'checked':'' }} name="maprime_output_bonus" value="yes" type="checkbox" class="custom-control-input shadow-none comptability_disabled" id="customSwitch81">
                                            <label class="custom-control-label" for="customSwitch81"></label>
                                        </div>
                                        </div>
                                    <div class="col-lg-4 d-flex justify-content-between align-items-center">
                                            <p class="m-0">Bonus BBC :</p>
                                        <div class="custom-control custom-switch">
                                            <input {{ ($energy_aid->maprime_bbc_bonus == 'yes')? 'checked':'' }} name="maprime_bbc_bonus" value="yes" type="checkbox" class="custom-control-input shadow-none comptability_disabled" id="customSwitch82">
                                            <label class="custom-control-label" for="customSwitch82"></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 d-flex justify-content-between align-items-center">
                                            <p class="m-0">Dépose d'une cuve à fioul :</p>
                                        <div class="custom-control custom-switch">
                                            <input {{ ($energy_aid->maprime_removal_oil_tank == 'yes')? 'checked':'' }} name="maprime_removal_oil_tank" value="yes" type="checkbox" class="custom-control-input shadow-none comptability_disabled" id="customSwitch83">
                                            <label class="custom-control-label" for="customSwitch83"></label>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="tab-pane fade" id="pills-three" role="tabpanel" aria-labelledby="pills-three-tab">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4 col-md-4">
                                    <div class="check-boxes d-flex justify-content-between">
                                            <p>Action Logement:</p>
                                        <div class="custom-control custom-switch">
                                            <input {{ ($energy_aid->action_logement == 'yes')? 'checked':'' }} name="action_logement" value="yes" type="checkbox" class="custom-control-input shadow-none action_logement_button comptability_disabled" id="customSwitch84">
                                            <label class="custom-control-label" for="customSwitch84"></label>
                                        </div>
                                    </div>
                                    <div class="bottom_part d-flex justify-content-between align-items-center">
                                        <p class="m-0" style="padding-right: 5px">Montant:</p>
                                        <div class="input-group">
                                            <input name="logement_montant" value="{{ $energy_aid->logement_montant }}" type="number" class="form-control shadow-none comptability_disabled" aria-label="Dollar amount (with dot and two decimal places)">
                                            <div class="input-group-append">
                                            <span class="input-group-text">€</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-8 {{ ($energy_aid->action_logement == 'yes')? '':'d-none' }}" id="action_logement_block">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h4 style="font-weight: 600">Configuration Devis</h4>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="custom-switches d-flex justify-content-between align-items-center">
                                                <h4 class="p-0">Mentionner les conditions</h4>
                                                <div class="custom-control custom-switch">
                                                    <input {{ ($energy_aid->logement_devis_condition == 'yes')? 'checked':'' }} name="logement_devis_condition" value="yes" type="checkbox" class="custom-control-input shadow-none comptability_disabled" id="customSwitch85">
                                                    <label class="custom-control-label" for="customSwitch85"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="custom-switches d-flex justify-content-between align-items-center">
                                                <h4 class="p-0">Mentionner / Déduire la prime</h4>
                                                <div class="custom-control custom-switch">
                                                    <input {{ ($energy_aid->logement_devis_deduct == 'yes')? 'checked':'' }} name="logement_devis_deduct" value="yes" type="checkbox" class="custom-control-input shadow-none comptability_disabled" id="customSwitch86">
                                                    <label class="custom-control-label" for="customSwitch86"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <hr style="width: 100%">
                                        <div class="col-lg-12">
                                            <h4 style="font-weight: 600">Configuration Facture</h4>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="custom-switches d-flex justify-content-between align-items-center">
                                                <h4 class="p-0">Mentionner les conditions</h4>
                                                <div class="custom-control custom-switch">
                                                    <input {{ ($energy_aid->logement_facture_condition == 'yes')? 'checked':'' }} name="logement_facture_condition" value="yes" type="checkbox" class="custom-control-input shadow-none comptability_disabled" id="customSwitch87">
                                                    <label class="custom-control-label" for="customSwitch87"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="custom-switches d-flex justify-content-between align-items-center">
                                                <h4 class="p-0">Mentionner / Déduire la prime</h4>
                                                <div class="custom-control custom-switch">
                                                    <input {{ ($energy_aid->logement_facture_deduct == 'yes')? 'checked':'' }} name="logement_facture_deduct" value="yes" type="checkbox" class="custom-control-input shadow-none comptability_disabled" id="customSwitch88">
                                                    <label class="custom-control-label" for="customSwitch88"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="tab-pane fade" id="pills-four" role="tabpanel" aria-labelledby="pills-four-tab">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4 col-md-4">
                                    <div class="check-boxes">
                                        <p class="form-label" for="#">Prendre en charge le reste à payer par la société :</p>
                                        <select id="charge_button" name="charge" class="select2_select_option form-control w-100 comptability_disabled">
                                            <option value="" selected>{{ __('Select') }}</option>
                                            <option {{ ($energy_aid->charge == 'Intégralement')? 'selected':'' }} >Intégralement</option>
                                            <option {{ ($energy_aid->charge == 'Partiellement')? 'selected':'' }} >Partiellement</option>
                                        </select>
                                    </div>
                                    <div class="bottom_partr">
                                        <p class="m-0 mt-2">Montant à prendre en charge :</p>
                                        <input name="charge_montant"  type="text" class="form-control shadow-none comptability_disabled" readonly value="{{ $energy_aid->charge_montant }}">
                                    </div>
                                </div>
                                <div id="charge_block" class="col-lg-8 col-md-8 {{ $energy_aid->charge? '':'d-none' }}">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h4 style="font-weight: 600">Configuration Devis</h4>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="custom-switches d-flex justify-content-between align-items-center">
                                                <h4 class="p-0">Mentionner les conditions</h4>
                                                <div class="custom-control custom-switch">
                                                    <input {{ ($energy_aid->charge_devis_condition == 'yes')? 'checked':'' }} name="charge_devis_condition" value="yes" type="checkbox" class="custom-control-input shadow-none comptability_disabled" id="customSwitch89">
                                                    <label class="custom-control-label" for="customSwitch89"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="custom-switches d-flex justify-content-between align-items-center">
                                                <h4 class="p-0">Mentionner / Déduire la prime</h4>
                                                <div class="custom-control custom-switch">
                                                    <input {{ ($energy_aid->charge_devis_deduct == 'yes')? 'checked':'' }} name="charge_devis_deduct" value="yes" type="checkbox" class="custom-control-input shadow-none comptability_disabled" id="customSwitch90">
                                                    <label class="custom-control-label" for="customSwitch90"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <hr style="width: 100%">
                                        <div class="col-lg-12">
                                            <h4 style="font-weight: 600">Configuration Facture</h4>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="custom-switches d-flex justify-content-between align-items-center">
                                                <h4 class="p-0">Mentionner les conditions</h4>
                                                <div class="custom-control custom-switch">
                                                    <input {{ ($energy_aid->charge_facture_condition == 'yes')? 'checked':'' }} name="charge_facture_condition" value="yes" type="checkbox" class="custom-control-input shadow-none comptability_disabled" id="customSwitch91">
                                                    <label class="custom-control-label" for="customSwitch91"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="custom-switches d-flex justify-content-between align-items-center">
                                                <h4 class="p-0">Mentionner / Déduire la prime</h4>
                                                <div class="custom-control custom-switch">
                                                    <input {{ ($energy_aid->charge_facture_deduct == 'yes')? 'checked':'' }} name="charge_facture_deduct" value="yes" type="checkbox" class="custom-control-input shadow-none comptability_disabled" id="customSwitch92">
                                                    <label class="custom-control-label" for="customSwitch92"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="alert_box p-3 mt-3" style="background: rgba(169, 213, 222, .4)">
                        <div class="row">
                            <div class="col-sm-12 col-lg-6 col-md-6">
                                <label for="#">Remise commerciale (sur le HT)</label>
                                <div class="input-group">
                                    <input value="{{ $energy_aid->commercial_discount }}" name="commercial_discount" type="number" class="form-control shadow-none comptability_disabled" aria-label="Dollar amount (with dot and two decimal places)">
                                    <div class="input-group-append">
                                    <span class="input-group-text">€</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6 col-md-6">
                                <label for="#">Montant de subvention APHEco :</label>
                                <div class="input-group">
                                    <input name="grant_amount" value="{{ $energy_aid->grant_amount }}" type="number" class="form-control shadow-none comptability_disabled" aria-label="Dollar amount (with dot and two decimal places)">
                                    <div class="input-group-append">
                                    <span class="input-group-text">€</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-12">
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <div class="table_btn text-right">
                                {{-- <button type="button" class="btn list-item-btn"><i class="bi bi-printer-fill"></i></button>
                                <button type="button" class="btn list-item-btn"><i class="bi bi-card-checklist"></i></button> --}}
                                <button type="button" class="btn list-item-btn"><i class="bi bi-currency-euro"></i></button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <ul class="list_start">
                                <li class="list-item">
                                    <span class="list_data">Total H.T :</span>
                                    <span class="item_details"> {{ $addition_products->sum('total_ttc') - $addition_products->sum('tva') }} €</span>
                                </li>
                                <hr class="list_divider">
                                <li class="list-item">
                                    <span class="list_data">Total TVA :</span>
                                    <span class="item_details">{{ $addition_products->sum('tva') }} €</span>
                                </li>
                                <hr class="list_divider">
                                <li class="list-item">
                                    <span class="list_data">Total T.T.C :</span>
                                    <span class="item_details item-color">{{ $addition_products->sum('total_ttc') }} €</span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list_start mobile_margin">
                                <li class="list-item">
                                    <span class="list_data">Prime CEE :</span>
                                    <span class="item_details">{{ $operations->sum('total_ttc') }} €</span>
                                </li>
                                <hr class="list_divider">
                                <li class="list-item">
                                    <span class="list_data">Prime MaPrimeRénov' :</span>
                                    <span class="item_details">0 €</span>
                                </li>
                                <hr class="list_divider">
                                <li class="list-item">
                                    <span class="list_data item-color">Reste à payer :</span>
                                    <span class="item_details item-color">{{ $addition_products->sum('total_ttc') - $operations->sum('total_ttc') }} €</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <hr class="list_divider">
                @if ($user_actions->where('module_name', 'collapse_comptability')->where('action_name', 'edit')->first() || $role == 's_admin')
                    <div class="col-lg-12">
                        <div class="list_btn text-right">
                            {{-- <button  class="btn btn-trans">Retour à la liste</button> --}}
                            <button type="submit" class="btn btn-colors">Enregistrer</button>
                        </div>
                    </div>
                @else
                    <div class="col-lg-12">
                        <div class="list_btn text-right">
                            {{-- <button  class="btn btn-trans">Retour à la liste</button> --}}
                            <button type="button" class="btn btn-colors"><span class="novecologie-icon-lock py-1"></span></button>
                        </div>
                    </div>
                @endif
            </form>

        </div>
    </div>


    {{-- <div class="card lead__card border-0">
        <div class="card-header bg-transparent border-0 p-0">
            <h2 class="mb-0">
                <button class="btn text-left lead__card__toggler flex-grow-1 shadow-none d-flex align-items-center w-100 collapseBtn" type="button" data-toggle="collapse" data-target="#leadCardCollapse-17" aria-expanded="false" aria-controls="leadCardCollapse-17">
                <span id="devis-verify" class="novecologie-icon-check lead__card__check mr-2 mr-sm-4"></span>
                    {{ __('Prestations / produits supplémentaires') }}
                    <span class="d-block ml-auto">
                        <span class="novecologie-icon-chevron-down d-inline-block lead__card__toggler__icon"></span>
                    </span>
                </button>
            </h2>
        </div>
        <div id="leadCardCollapse-17" class="collapse" data-parent="#leadAccordion7">
            <div class="card-body">
                <div class="text-right">
                    <button type="button" class="scroll-top__btn border-0 d-inline-flex align-items-center justify-content-center" data-toggle="modal" data-target="#workPerformedCreateModal">
                        <i class="bi bi-plus-lg"></i>
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table database-table">
                        <thead class="database-table__header">
                            <tr>
                                <th>
                                    <div class="custom-control custom-checkbox">
                                        <input  type="checkbox" class="custom-control-input table-all-select-checkbox" id="tableAllSelectCheck">
                                        <label class="custom-control-label" for="tableAllSelectCheck"></label>
                                    </div>
                                </th>
                                <th>#</th>
                                <th>Titre</th>
                                <th>PU TTC</th>
                                <th>Qté</th>
                                <th>TOTAL TTC</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="database-table__body">
                            <tr>
                                <td class="text-left">
                                    <div class="custom-control custom-checkbox">
                                        <input  type="checkbox" class="custom-control-input shadow-none table-all-select-checkbox" id="tableAllSelectCheck">
                                        <label class="custom-control-label" for="tableAllSelectCheck"></label>
                                    </div>
                                </td>
                                <td>
                                    <input type="text" class="form-control shadow-none  required number px-0 text-center" value="1">
                                </td>
                                <td>
                                    <input class="form-control shadow-none text-md-center type="text" value="FORFAIT FOURNITURE POMPE A CHALEUR ATLANTIC ALFEA EXCELLIA AI 14 Mono">
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input type="text"  class="form-control shadow-none" value="9000" aria-label="Amount (to the nearest dollar)">
                                        <div class="input-group-append">
                                        <span class="input-group-text">$</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <input style="" class="form-control shadow-none" type="text" data-val="true" data-val-number="The field Quantite must be a number." data-val-required="Ce champ est obligatoire." value="1">
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input type="text" class="form-control shadow-none" value="9000" aria-label="Amount (to the nearest dollar)">
                                        <div class="input-group-append">
                                        <span class="input-group-text">$</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a id="savePrestation" type="submit" title="Enregistrer la modification" href="#" class="btn btn-sm btn-primary">
                                        <i class="bi bi-check"></i>
                                        </a>

                                        <a title="Annuler la modification" type="submit" href="#"class="btn btn-sm btn-warning">
                                            <i class="bi bi-x"></i>
                                            </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input  type="checkbox" class="custom-control-input table-all-select-checkbox" id="tableAllSelectCheck">
                                        <label class="custom-control-label" for="tableAllSelectCheck"></label>
                                    </div>
                                </td>
                                <td>1</td>
                                <td>
                                    <a style="color:#000000; text-decoration: underline;" title="Chaudière" href="#">Forfait fourniture <br> d'une chaudière biomasse </a>
                                </td>
                                <td>9 915,73 €</td>
                                <td>1</td>
                                <td>9 915,73 €</td>
                                <td class="text-center">
                                    <div class="dropdown dropdown--custom p-0 d-inline-block show">
                                        <button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" data-offset="-100, 5">
                                            <span class="novecologie-icon-dots-horizontal-triple"></span>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100 show" aria-labelledby="customSelectDropdown" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-116px, -87px, 0px);" x-placement="top-start">
                                            <button data-client-id="3" type="button" class="dropdown-item border-0 clientAssigneeButton">
                                                <i class="bi bi-arrow-repeat mr-1"></i>
                                                Modifier
                                            </button>
                                            <button type="submit" class="dropdown-item border-0" id="customSelectDropdown">
                                                <span class="novecologie-icon-trash mr-1"></span>
                                                effacer
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>  --}}

    {{-- <div class="card lead__card border-0">
        <div class="card-header bg-transparent border-0 p-0">
            <h2 class="mb-0">
                <button class="btn text-left lead__card__toggler flex-grow-1 shadow-none d-flex align-items-center w-100 collapseBtn" type="button" data-toggle="collapse" data-target="#leadCardCollapse-18" aria-expanded="false" aria-controls="leadCardCollapse-18">
                <span id="devis-verify" class="novecologie-icon-check lead__card__check mr-2 mr-sm-4"></span>
                Aides énergétiques
                    <span class="d-block ml-auto">
                        <span class="novecologie-icon-chevron-down d-inline-block lead__card__toggler__icon"></span>
                    </span>
                </button>
            </h2>
        </div>

        <div id="leadCardCollapse-18" class="collapse" data-parent="#leadAccordion7">

            <div class="database-table-wrapper bg-white">
                <ul class="nav nav-pills nav-pills--horizontal p-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="pills-one-tab" data-toggle="pill" href="#pills-one" role="tab" aria-controls="pills-one" aria-selected="true">{{ __('PrimeCEE') }}</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-two-tab" data-toggle="pill" href="#pills-two" role="tab" aria-controls="pills-two" aria-selected="false">{{ __('MaPrimeRénov') }}</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-three-tab" data-toggle="pill" href="#pills-three" role="tab" aria-controls="pills-three" aria-selected="false">{{ __('Action Logement') }}</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-four-tab" data-toggle="pill" href="#pills-four" role="tab" aria-controls="pills-four" aria-selected="false">{{ __('Prise en charge') }}</a>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-one" role="tabpanel" aria-labelledby="pills-one-tab">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4 col-md-4">
                                    <div class="check-boxes d-flex justify-content-between">
                                            <p>Prime CEE:</p>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input shadow-none" id="customSwitch1">
                                            <label class="custom-control-label" for="customSwitch1"></label>
                                        </div>
                                    </div>
                                    <div class="bottom_part d-flex justify-content-between align-items-center">
                                        <p class="m-0" style="padding-right: 5px">Montant:</p>
                                        <div class="input-group">
                                            <input type="text" class="form-control shadow-none" aria-label="Dollar amount (with dot and two decimal places)">
                                            <div class="input-group-append">
                                            <span class="input-group-text">€</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-8">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h4 style="font-weight: 600">Configuration Devis</h4>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="custom-switches d-flex justify-content-between align-items-center">
                                                <h4 class="p-0">Mentionner les conditions</h4>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input shadow-none" id="customSwitch2">
                                                    <label class="custom-control-label" for="customSwitch2"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="custom-switches d-flex justify-content-between align-items-center">
                                                <h4 class="p-0">Mentionner / Déduire la prime</h4>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input shadow-none" id="customSwitch3">
                                                    <label class="custom-control-label" for="customSwitch3"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <hr style="width: 100%">
                                        <div class="col-lg-12">
                                            <h4 style="font-weight: 600">Configuration Facture</h4>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="custom-switches d-flex justify-content-between align-items-center">
                                                <h4 class="p-0">Mentionner les conditions</h4>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input shadow-none" id="customSwitch4">
                                                    <label class="custom-control-label" for="customSwitch4"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="custom-switches d-flex justify-content-between align-items-center">
                                                <h4 class="p-0">Mentionner / Déduire la prime</h4>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input shadow-none" id="customSwitch5">
                                                    <label class="custom-control-label" for="customSwitch5"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-two" role="tabpanel" aria-labelledby="pills-two-tab">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <div class="check-boxes d-flex justify-content-between">
                                        <p>MaPrimeRénov':</p>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input shadow-none" id="customSwitch76">
                                        <label class="custom-control-label" for="customSwitch76"></label>
                                    </div>
                                </div>
                                <div class="bottom_part d-flex justify-content-between align-items-center">
                                    <p class="m-0" style="padding-right: 5px">Montant:</p>
                                    <div class="input-group">
                                        <input type="text" class="form-control shadow-none" aria-label="Dollar amount (with dot and two decimal places)">
                                        <div class="input-group-append">
                                        <span class="input-group-text">€</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-8">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h4 style="font-weight: 600">Configuration Devis</h4>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="custom-switches d-flex justify-content-between align-items-center">
                                            <h4 class="p-0">Mentionner les conditions</h4>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input shadow-none" id="customSwitch77">
                                                <label class="custom-control-label" for="customSwitch77"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="custom-switches d-flex justify-content-between align-items-center">
                                            <h4 class="p-0">Mentionner / Déduire la prime</h4>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input shadow-none" id="customSwitch78">
                                                <label class="custom-control-label" for="customSwitch78"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr style="width: 100%">
                                    <div class="col-lg-12">
                                        <h4 style="font-weight: 600">Configuration Facture</h4>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="custom-switches d-flex justify-content-between align-items-center">
                                            <h4 class="p-0">Mentionner les conditions</h4>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input shadow-none" id="customSwitch79">
                                                <label class="custom-control-label" for="customSwitch79"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="custom-switches d-flex justify-content-between align-items-center">
                                            <h4 class="p-0">Mentionner / Déduire la prime</h4>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input shadow-none" id="customSwitch80">
                                                <label class="custom-control-label" for="customSwitch80"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr style="width: 100%">
                            <div class="col-lg-4 d-flex justify-content-between align-items-center">
                                    <p class="m-0">Bonus sortie passoire :</p>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input shadow-none" id="customSwitch81">
                                    <label class="custom-control-label" for="customSwitch81"></label>
                                </div>
                            </div>
                            <div class="col-lg-4 d-flex justify-content-between align-items-center">
                                    <p class="m-0">Bonus BBC :</p>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input shadow-none" id="customSwitch82">
                                    <label class="custom-control-label" for="customSwitch82"></label>
                                </div>
                            </div>
                            <div class="col-lg-4 d-flex justify-content-between align-items-center">
                                    <p class="m-0">Dépose d'une cuve à fioul :</p>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input shadow-none" id="customSwitch83">
                                    <label class="custom-control-label" for="customSwitch83"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="tab-pane fade" id="pills-three" role="tabpanel" aria-labelledby="pills-three-tab">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <div class="check-boxes d-flex justify-content-between">
                                        <p>Prime CEE:</p>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input shadow-none" id="customSwitch84">
                                        <label class="custom-control-label" for="customSwitch84"></label>
                                    </div>
                                </div>
                                <div class="bottom_part d-flex justify-content-between align-items-center">
                                    <p class="m-0" style="padding-right: 5px">Montant:</p>
                                    <div class="input-group">
                                        <input type="text" class="form-control shadow-none" aria-label="Dollar amount (with dot and two decimal places)">
                                        <div class="input-group-append">
                                        <span class="input-group-text">€</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-8">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h4 style="font-weight: 600">Configuration Devis</h4>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="custom-switches d-flex justify-content-between align-items-center">
                                            <h4 class="p-0">Mentionner les conditions</h4>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input shadow-none" id="customSwitch85">
                                                <label class="custom-control-label" for="customSwitch85"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="custom-switches d-flex justify-content-between align-items-center">
                                            <h4 class="p-0">Mentionner / Déduire la prime</h4>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input shadow-none" id="customSwitch86">
                                                <label class="custom-control-label" for="customSwitch86"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr style="width: 100%">
                                    <div class="col-lg-12">
                                        <h4 style="font-weight: 600">Configuration Facture</h4>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="custom-switches d-flex justify-content-between align-items-center">
                                            <h4 class="p-0">Mentionner les conditions</h4>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input shadow-none" id="customSwitch87">
                                                <label class="custom-control-label" for="customSwitch87"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="custom-switches d-flex justify-content-between align-items-center">
                                            <h4 class="p-0">Mentionner / Déduire la prime</h4>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input shadow-none" id="customSwitch88">
                                                <label class="custom-control-label" for="customSwitch88"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="tab-pane fade" id="pills-four" role="tabpanel" aria-labelledby="pills-four-tab">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <div class="check-boxes">
                                    <p class="form-label" for="#">Prendre en charge le reste à payer par la société :</p>
                                    <select class="select2_select_option form-control w-100">
                                        <option>Intégralement</option>
                                        <option>Partiellement</option>
                                    </select>
                                </div>
                                <div class="bottom_partr d-none">
                                    <p class="m-0 mt-2">Montant à prendre en charge :</p>
                                    <input type="text" class="form-control shadow-none" readonly value="15 737,00">
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-8 d-none">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h4 style="font-weight: 600">Configuration Devis</h4>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="custom-switches d-flex justify-content-between align-items-center">
                                            <h4 class="p-0">Mentionner les conditions</h4>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input shadow-none" id="customSwitch89">
                                                <label class="custom-control-label" for="customSwitch89"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="custom-switches d-flex justify-content-between align-items-center">
                                            <h4 class="p-0">Mentionner / Déduire la prime</h4>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input shadow-none" id="customSwitch90">
                                                <label class="custom-control-label" for="customSwitch90"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr style="width: 100%">
                                    <div class="col-lg-12">
                                        <h4 style="font-weight: 600">Configuration Facture</h4>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="custom-switches d-flex justify-content-between align-items-center">
                                            <h4 class="p-0">Mentionner les conditions</h4>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input shadow-none" id="customSwitch91">
                                                <label class="custom-control-label" for="customSwitch91"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="custom-switches d-flex justify-content-between align-items-center">
                                            <h4 class="p-0">Mentionner / Déduire la prime</h4>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input shadow-none" id="customSwitch92">
                                                <label class="custom-control-label" for="customSwitch92"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="alert_box p-3 mt-3" style="background: rgba(169, 213, 222, .4)">
                    <div class="row">
                        <div class="col-sm-12 col-lg-6 col-md-6">
                            <label for="#">Remise commerciale (sur le HT)</label>
                            <div class="input-group">
                                <input type="text" class="form-control shadow-none" aria-label="Dollar amount (with dot and two decimal places)">
                                <div class="input-group-append">
                                <span class="input-group-text">€</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6 col-md-6">
                            <label for="#">Montant de subvention APHEco :</label>
                            <div class="input-group">
                                <input type="text" class="form-control shadow-none" aria-label="Dollar amount (with dot and two decimal places)">
                                <div class="input-group-append">
                                <span class="input-group-text">€</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-12">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="table_btn text-right">
                            <button class="btn list-item-btn"><i class="bi bi-printer-fill"></i></button>
                            <button class="btn list-item-btn"><i class="bi bi-card-checklist"></i></button>
                            <button class="btn list-item-btn"><i class="bi bi-currency-euro"></i></button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <ul class="list_start">
                            <li class="list-item">
                                <span class="list_data">Total H.T :</span>
                                <span class="item_details">24 417,43 €</span>
                            </li>
                            <hr class="list_divider">
                            <li class="list-item">
                                <span class="list_data">Total TVA :</span>
                                <span class="item_details">1 342,96 €</span>
                            </li>
                            <hr class="list_divider">
                            <li class="list-item">
                                <span class="list_data">Total T.T.C :</span>
                                <span class="item_details item-color">25 760,39 €</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list_start mobile_margin">
                            <li class="list-item">
                                <span class="list_data">Prime CEE :</span>
                                <span class="item_details">24 417,43 €</span>
                            </li>
                            <hr class="list_divider">
                            <li class="list-item">
                                <span class="list_data">Prime MaPrimeRénov' :</span>
                                <span class="item_details">1 342,96 €</span>
                            </li>
                            <hr class="list_divider">
                            <li class="list-item">
                                <span class="list_data item-color">Reste à payer :</span>
                                <span class="item_details item-color">15 737,54 €</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <hr class="list_divider">
            <div class="col-lg-12">
                <div class="list_btn text-right">
                    <button class="btn btn-trans">Retour à la liste</button>
                    <button class="btn btn-colors">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>  --}}


</div>
<form action="{{ route('sidebar.info.update') }}" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{ $sidebar_info->id }}">
    <div class="accordion" id="accordionExample">
        {{-- <div class="card card-custom--border">
            <div class="card-header card-header_custom--color">
                <div class="collapse_btn d-flex justify-content-between align-items-center">
                    <p class="m-0 card_custom_title">Infos lead & technique</p>
                    <button type="button" class="collapse__link btn btn-link btn-custom--border shadow-none" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <i class="bi bi-list"></i>
                    </button>
                </div>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body custom-option">
                    <label for="#">Statut :<span class="text-danger">*</span></label>
                    <select class="select2_select_option form-control" name="status">
                        <optgroup label="1 LEAD">
                            <optgroup label='NOUVEAUX LEAD'>
                                <option {{ ($sidebar_info->status ==  'volvo')? 'selected':'' }} value="volvo">NOUVEAU</option>
                                <option {{ ($sidebar_info->status ==  'saab')? 'selected':'' }} value="saab">NRP</option>
                            </optgroup>
                        </optgroup>
                    </select>
                    <hr>
                    <label for="#">Type opération CEE :</label>
                    <select class="select2_select_option form-control" name="operation_type">
                        <option {{ ($sidebar_info->operation_type == 'Isolation')? 'selected':'' }} value="Isolation">Isolation</option>
                        <option {{ ($sidebar_info->operation_type == 'Chauffage')? 'selected':'' }} value="Chauffage">Chauffage</option>
                    </select>
                    <hr>
                    <label for="#">Deal :</label>
                    <select class="select2_select_option form-control" name="deal">
                        <option {{ ($sidebar_info->deal == 'Deal-VATTENFALL ENERGIE SA')? 'selected':'' }} value="Deal-VATTENFALL ENERGIE SA">Deal-VATTENFALL ENERGIE SA</option>
                        <option {{ ($sidebar_info->deal == 'Deal-VATTENFALL ENERGIE SA')? 'selected':'' }} value="Deal-VATTENFALL ENERGIE SA">Deal-VERTIGO - TOTALENERGIES</option>
                    </select>
                    <hr>
                    <label for="#">Délégataire :</label>
                    <label style="font-weight: bold" for="#">VERTIGO - TOTALENERGIES</label>
                    <hr>
                    <label for="#">Commercial Terrain :</label>
                    <select class="select2_select_option form-control" name="commercial_terrain">
                    </select>
                    <hr>
                    <label for="#">RDV planifiée le :</label>
                    <input type="date" class="form-control shadow-none" value="{{ $sidebar_info->appointment_date }}" name="appointment_date">
                    <hr>
                    <label for="#">RDV visité le :</label>
                    <input type="date" class="form-control shadow-none" value="{{ $sidebar_info->visited_date }}"  name="visited_date">
                    <hr>
                    <label for="#">Télé-opérateur :</label>
                    <select class="select2_select_option form-control" name="teleoperator">
                    </select>
                    <hr>
                    <label for="#">Commercial :</label>
                    <select class="select2_select_option form-control" name="commercial">
                    </select>
                    <hr>
                    <label for="#">Prévisiteur :</label>
                    <select class="select2_select_option form-control" name="previsitor">
                    </select>
                    <hr>
                    <label for="#">Date de prévisite :</label>
                    <input type="date" class="form-control shadow-none" value="{{ $sidebar_info->date_previsite }}"  name="date_previsite">
                    <hr>
                    <label for="#" class="text-warning">Confirmé : </label>
                    <label for="#" class="label-danger">Non confirmé</label>
                    <hr>
                    <label for="#">Pose plannifiée le :</label>
                    <input type="date" class="form-control shadow-none" value="{{ $sidebar_info->planned }}"  name="planned">
                    <hr>
                    <label for="#">Date début des travaux :</label>
                    <input type="date" class="form-control shadow-none" value="{{ $sidebar_info->start_date }}"  name="start_date">
                    <hr>
                    <label for="#">Date fin des travaux :</label>
                    <input type="date" class="form-control shadow-none" value="{{ $sidebar_info->end_date }}"  name="end_date">
                    <hr>
                    <label for="#">Source de lead :</label>
                    <select class="select2_select_option form-control" name="source">
                    </select>
                    <hr>
                    <label for="#">Campagne :</label>
                    <input type="text" class="form-control shadow-none" value="{{ $sidebar_info->campaign }}"  name="campaign">
                </div>
            </div>
        </div> --}}
        <div class="card card-custom--border">
            <div class="card-header card-header_custom--color">
                <div class="collapse_btn d-flex justify-content-between align-items-center">
                    <p class="m-0 card_custom_title">Infos techniques: Chaudière biomasse individuelle </p>
                    <button type="button" class="collapse__link btn btn-link collapsed btn-custom--border shadow-none" data-toggle="collapse" data-target="#collapse11" aria-expanded="false" aria-controls="collapse11">
                        <i class="bi bi-list"></i>
                    </button>
                </div>
            </div>

            @php
                $tax_info = $primary_tax;
            @endphp

            <div id="collapse11" class="collapse" aria-labelledby="headingThree">
                <div class="card-body custom-option">
                    <label for="#">Type énergie Chaud. si remplacée</label>
                    <select class="select2_select_option form-control comptability_disabled" name="type_energy_id">
                        <option value="" selected>{{ __('Select') }}</option>
                        @foreach (\App\Models\CRM\EnergyType::all() as $type)
                            <option {{ $sidebar_info->type_energy_id == $type->id ? 'selected':'' }} value="{{ $type->id }}">{{ $type->title }}</option>
                        @endforeach
                    </select>
                    <hr>
                    <label for="#">Marque Chaud. à remplacer :</label>
                        <input type="text" class="form-control shadow-none comptability_disabled" value="{{ $sidebar_info->volume }}" name="volume">
                    <hr>
                    <label for="#">Réference Chaud. à remplacer :</label>
                    <input type="text" class="form-control shadow-none comptability_disabled" value="{{ $sidebar_info->cost }}"  name="cost">
                </div>
            </div>
        </div>

        <div class="card card-custom--border">
            <div class="card-header card-header_custom--color">
                <div class="collapse_btn d-flex justify-content-between align-items-center">
                    <p class="m-0 card_custom_title">Information Admnistrative</p>
                    <button type="button" class="collapse__link btn btn-link collapsed btn-custom--border shadow-none" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <i class="bi bi-list"></i>
                    </button>
                </div>
            </div>

            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo">
                <div class="card-body custom-option">
                    <label for="#">Deal :</label>
                    <select class="select2_select_option form-control comptability_disabled" name="deal">
                        <option value="" selected>{{ __('Select') }}</option>
                        @foreach ($deals as $deal)
                        <option {{ ($sidebar_info->deal == $deal->id)? 'selected':'' }} value="{{ $deal->id }}">{{ $deal->name }}</option>
                        @endforeach
                    </select>
                    <hr>
                    <label for="#">Délégataire :</label>
                    <label style="font-weight: bold" for="#">{{ $sidebar_info->getDeal->delegate ?? '' }}</label>
                    <hr>
                    <label for="#">Commercial Terrain :</label>
                    <select class="select2_select_option form-control comptability_disabled" name="commercial_terrain">
                        <option value="" selected>{{ __('Select') }}</option>
                        @foreach (\App\Models\CRM\CommercialTerrain::all() as $commercial)
                            <option @if ($sidebar_info && $sidebar_info->commercial_terrain)
                                {{ ($sidebar_info->commercial_terrain ==$commercial->id)? 'selected':'' }}
                            @endif  value="{{ $commercial->id }}">{{ $commercial->name }}</option>
                        @endforeach
                    </select>
                    <hr>
                    <label for="#">Date de prévisite :</label>
                    <input type="date" class="form-control shadow-none comptability_disabled" value="{{ $sidebar_info->date_previsite }}"  name="date_previsite">
                    <hr>

                    <label for="#">N° de devis :</label>
                    <input type="text" class="form-control shadow-none comptability_disabled" value="{{ $sidebar_info->quote_number }}"  name="quote_number">
                    <hr>
                    <label for="#">Date édition devis :</label>
                    <input type="date" class="form-control shadow-none comptability_disabled" value="{{ $sidebar_info->issue_date }}"  name="issue_date">
                    <hr>
                    <label for="#">Date signature devis :</label>
                    <input type="date" class="form-control shadow-none comptability_disabled" value="{{ $sidebar_info->signed_date }}"  name="signed_date">
                    <hr>
                    <label for="#">Date Facture :</label>
                    <input type="date" class="form-control shadow-none comptability_disabled" value="{{ $sidebar_info->facture_date }}"  name="facture_date">
                    <hr>
                    <label for="#">N° de facture :</label>
                    <input type="text" class="form-control shadow-none comptability_disabled" value="{{ $sidebar_info->invoice_name }}"  name="invoice_name">

                    {{-- <label for="#">Facture rectificative :</label>
                    <select class="select2_select_option form-control"  name="amending_invoice">
                        <option {{ ($sidebar_info->amending_invoice == 'OUI')? 'selected':'' }} value="OUI">OUI</option>
                        <option {{ ($sidebar_info->amending_invoice == 'NON')? 'selected':'' }} value="NON">NON</option>
                    </select>
                    <hr> --}}
                    {{-- <label for="#">Date Edition AH :</label>
                    <input type="date" class="form-control shadow-none" value="{{ $sidebar_info->edition_date }}"  name="edition_date">
                    <hr>
                    <label for="#">Dépôt stockage :</label>
                    <select class="select2_select_option form-control" name="storage">
                    </select>
                    <hr>
                    <label for="#">Date de réception de récépissé de mairie :</label>
                    <input type="date" class="form-control shadow-none" value="{{ $sidebar_info->receipt_date }}"  name="receipt_date">
                    <hr>
                    <label for="#">Date de réception de l'accord de mairie :</label>
                    <input type="date" class="form-control shadow-none" value="{{ $sidebar_info->receipt_date_agreement }}"  name="receipt_date_agreement">
                    <hr>
                    <label for="#">AMO :</label>
                    <select class="select2_select_option form-control" name="amo">
                    </select> --}}
                </div>
            </div>
        </div>

        <div class="card card-custom--border">
            <div class="card-header card-header_custom--color">
                <div class="collapse_btn d-flex justify-content-between align-items-center">
                    <p class="m-0 card_custom_title">Infos bénéficiaire</p>
                    <button type="button" class="collapse__link btn btn-link collapsed btn-custom--border shadow-none" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <i class="bi bi-list"></i>
                    </button>
                </div>
            </div>

            @php
                $tax_info = $primary_tax;
            @endphp

            <div id="collapseThree" class="collapse" aria-labelledby="headingThree">
                <div class="card-body custom-option">
                    <label for="#">Civilité</label>
                    <select class="select2_select_option form-control comptability_disabled" name="civility">
                        <option value="" selected>{{ __('Select') }}</option>
                        @if ($sidebar_info->civility)
                            <option {{ ($sidebar_info->civility == 'mr')? 'selected':'' }} value="mr">{{ __('Mr') }}</option>
                            <option {{ ($sidebar_info->civility == 'ms')? 'selected':'' }} value="ms">{{ __('Ms') }}</option>
                            <option {{ ($sidebar_info->civility == 'mrs')? 'selected':'' }} value="mrs">{{ __('Mrs') }}</option>
                        @else
                            @if ($tax_info)
                            <option {{ ($tax_info->title == 'mr')? 'selected':'' }} value="mr">{{ __('Mr') }}</option>
                            <option {{ ($tax_info->title == 'ms')? 'selected':'' }} value="ms">{{ __('Ms') }}</option>
                            <option {{ ($tax_info->title == 'mrs')? 'selected':'' }} value="mrs">{{ __('Mrs') }}</option>
                            @endif
                        @endif
                    </select>
                    <hr>


                    <label for="#">Nom :</label>
                        @if ($sidebar_info->civility_name)
                            <input type="text" class="form-control shadow-none comptability_disabled" value="{{ $sidebar_info->civility_name }}" name="civility_name">
                        @else
                            @if ($tax_info)
                            <input type="text" class="form-control shadow-none comptability_disabled" value="{{ $tax_info->last_name }}" name="civility_name">
                            @endif
                        @endif
                    <hr>
                    <label for="#">Prénom :</label>
                    @if ($sidebar_info->civility_first_name)
                        <input type="text" class="form-control shadow-none comptability_disabled" value="{{ $sidebar_info->civility_first_name }}"  name="civility_first_name">
                    @else
                        @if ($tax_info)
                        <input type="text" class="form-control shadow-none comptability_disabled" value="{{ $tax_info->first_name }}"  name="civility_first_name">
                        @endif
                    @endif
                    <hr>
                    <label for="#">Tél mobile :</label>
                    @if ($sidebar_info->civility_mobile)
                        <input type="text" class="form-control shadow-none comptability_disabled" value="{{ $sidebar_info->civility_mobile }}"  name="civility_mobile">
                    @else
                        @if ($tax_info)
                        <input type="text" class="form-control shadow-none comptability_disabled" value="{{ $tax_info->phone }}"  name="civility_mobile">
                        @endif
                    @endif
                    <hr>
                    <label for="#">Tél fixe :</label>
                    @if ($sidebar_info->civility_fax)
                        <input type="text" class="form-control shadow-none comptability_disabled" value="{{ $sidebar_info->civility_fax }}"  name="civility_fax">
                    @else
                        @if ($tax_info)
                        <input type="text" class="form-control shadow-none comptability_disabled" value="{{ $tax_info->telephone }}"  name="civility_fax">
                        @endif
                    @endif
                    <hr>
                    @if ($tax_info && $tax_info->second_first_name)
                        <label for="#">Civilité 2</label>
                        <select class="select2_select_option form-control comptability_disabled" name="civility2">
                            <option value="" selected>{{ __('Select') }}</option>
                            @if ($sidebar_info->civility2)
                                <option {{ ($sidebar_info->civility2 == 'mr')? 'selected':'' }} value="mr">{{ __('Mr') }}</option>
                                <option {{ ($sidebar_info->civility2 == 'ms')? 'selected':'' }} value="ms">{{ __('Ms') }}</option>
                                <option {{ ($sidebar_info->civility2 == 'mrs')? 'selected':'' }} value="mrs">{{ __('Mrs') }}</option>
                            @else
                                @if ($tax_info)
                                <option {{ ($tax_info->second_title == 'mr')? 'selected':'' }} value="mr">{{ __('Mr') }}</option>
                                <option {{ ($tax_info->second_title == 'ms')? 'selected':'' }} value="ms">{{ __('Ms') }}</option>
                                <option {{ ($tax_info->second_title == 'mrs')? 'selected':'' }} value="mrs">{{ __('Mrs') }}</option>
                                @endif
                            @endif
                        </select>
                        <hr>
                        <label for="#">Nom 2:</label>
                        @if ($sidebar_info->civility_name2)
                            <input type="text" class="form-control shadow-none comptability_disabled" value="{{ $sidebar_info->civility_name2 }}" name="civility_name2" >
                        @else
                            @if ($tax_info)
                                <input type="text" class="form-control shadow-none comptability_disabled" value="{{ $tax_info->second_last_name }}" name="civility_name2" >
                            @endif
                        @endif

                        <hr>
                        <label for="#">Prénom 2:</label>
                        @if ($sidebar_info->civility_first_name2)
                        <input type="text" class="form-control shadow-none comptability_disabled" value="{{ $sidebar_info->civility_first_name2 }}"  name="civility_first_name2">
                        @else
                            @if ($tax_info)
                            <input type="text" class="form-control shadow-none comptability_disabled" value="{{ $tax_info->second_first_name }}"  name="civility_first_name2">
                            @endif
                        @endif
                        <hr>
                        <label for="#">Email :</label>
                        @if ($sidebar_info->civility_mobile2)
                            <input type="text" class="form-control shadow-none comptability_disabled" value="{{ $sidebar_info->civility_mobile2 }}"  name="civility_mobile2">
                        @else
                            @if ($tax_info)
                            <input type="text" class="form-control shadow-none comptability_disabled" value="{{ $tax_info->email }}"  name="civility_mobile2">
                            @endif
                        @endif
                        <hr>
                        <label for="#">Email 2:</label>
                        <input type="text" class="form-control shadow-none comptability_disabled" value="{{ $sidebar_info->civility_fax2 }}"  name="civility_fax2">
                        <hr>
                    @endif
                    <label for="#">Adresse :</label>
                    @if ($sidebar_info->civility_address)
                        <input type="text" class="form-control shadow-none comptability_disabled" value="{{ $sidebar_info->civility_address }}"  name="civility_address">
                    @else
                        @if ($tax_info)
                        <input type="text" class="form-control shadow-none comptability_disabled" value="{{ $tax_info->address2 }}"  name="civility_address">
                        @endif
                    @endif
                    <hr>
                    <label for="#">Complément :</label>
                    @if ($sidebar_info->civility_complement)
                        <input type="text" class="form-control shadow-none comptability_disabled" value="{{ $sidebar_info->civility_complement }}"  name="civility_complement">
                    @else
                        @if ($tax_info)
                        <input type="text" class="form-control shadow-none comptability_disabled" value="{{ $tax_info->address }}"  name="civility_address">
                        @endif
                    @endif
                    <hr>
                    <label for="#">CP / Ville :</label>
                    <input type="text" class="form-control shadow-none comptability_disabled" value="{{ $sidebar_info->civility_cp }}"  name="civility_cp">
                    <hr>
                </div>
            </div>
        </div>

        {{-- <div class="card card-custom--border">
            <div class="card-header card-header_custom--color">
                <div class="collapse_btn d-flex justify-content-between align-items-center">
                    <p class="m-0 card_custom_title">Conditions de paiement</p>
                    <button type="button" class="collapse__link btn btn-link collapsed btn-custom--border shadow-none" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        <i class="bi bi-list"></i>
                    </button>
                </div>
            </div>

            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                <div class="card-body custom-option">
                    <label for="#">Facture acquittée :</label>
                    <select class="select2_select_option form-control" name="facture_invoice">
                        <option {{ ($sidebar_info->facture_invoice == 'OUI')? 'selected':'' }} value="OUI">OUI</option>
                        <option {{ ($sidebar_info->facture_invoice == 'NON')? 'selected':'' }} value="NON">NON</option>
                    </select>
                    <hr>
                    <label for="#">Date de règlement :</label>
                    <input type="date" class="form-control shadow-none" value="{{ $sidebar_info->settlement_date }}"  name="settlement_date">
                    <hr>
                    <label for="#">Mode de règlement :</label>
                    <select class="select2_select_option form-control"  name="payment_method">
                        <option {{ ($sidebar_info->payment_method == 'Chèque')? 'selected':'' }} value="Chèque">Chèque</option>
                        <option {{ ($sidebar_info->payment_method == 'Virement')? 'selected':'' }} value="Virement">Virement</option>
                    </select>
                </div>
            </div>
        </div> --}}

        {{-- <div class="card card-custom--border">
            <div class="card-header card-header_custom--color">
                <div class="collapse_btn d-flex justify-content-between align-items-center">
                    <p class="m-0 card_custom_title">Gestion des déchets</p>
                    <button type="button" class="collapse__link btn btn-link collapsed btn-custom--border shadow-none" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        <i class="bi bi-list"></i>
                    </button>
                </div>
            </div>

            <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                <div class="card-body custom-option">
                    <label for="#">Volume des déchets :</label>
                    <div class="input-group">
                        <input type="text" class="form-control shadow-none" value="{{ $sidebar_info->volume }}"  name="volume" aria-label="Dollar amount (with dot and two decimal places)">
                        <div class="input-group-append">
                        <span class="input-group-text">m3</span>
                        </div>
                    </div>
                    <hr>
                    <label for="#">Coûts associés :</label>
                    <input type="text" class="form-control shadow-none" value="{{ $sidebar_info->cost }}"  name="cost">
                    <hr>
                    <label for="#">Point de collecte :</label>
                    <textarea cols="30" rows="1" class="form-control shadow-none" name="collection_point"> {{ $sidebar_info->collection_point }}</textarea>
                </div>
            </div>
        </div> --}}
        @if ($user_actions->where('module_name', 'collapse_comptability')->where('action_name', 'edit')->first() || $role == 's_admin')
            <div class="submit--btn">
                <button type="submit" class="secondary-btn primary-btn--md rounded-pill d-inline-flex align-items-center justify-content-center border-0 my-3 ml-4">Submit</button>
            </div>
        @else
            <div class="submit--btn">
                <button type="button" class="secondary-btn primary-btn--md rounded-pill d-inline-flex align-items-center justify-content-center border-0 my-3 ml-4"><span class="novecologie-icon-lock py-1"></span></button>
            </div>
        @endif
    </div>
</form>


{{-- Work Performed Create Modal --}}
<div class="modal modal--aside fade" id="workPerformedCreateModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content simple-bar border-0 h-100 rounded-0">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
                    <span class="novecologie-icon-close"></span>
                </button>
            </div>
            <div class="modal-body">
                <h1 class="modal-title text-center mb-2">{{ __('Détail du produit installé') }}</h1>
                <form action="{{ route('project.work.done') }}" class="form mx-auto needs-validation" novalidate method="POST">
                    @csrf
                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                    <div class="form-group">
                        <label class="form-label" for="travaux">{{ __('Opération') }} <span class="text-danger">*</span></label>
                        <select name="operation" class="form-control w-100" required>
                            <option value="" selected>{{ __('Select') }}</option>
                            @foreach ($scales as $baremes)
                                <optgroup label="{{ $baremes->wording }}">
                                    <option value="{{ $baremes->id }}">{{ $baremes->description }}</option>
                                </optgroup>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="travaux">{{ __('Produit :') }} <span class="text-danger">*</span></label>
                        <select name="product_id" class="select2_select_option form-control w-100" required>
                            <option value="" selected>{{ __('Select') }}</option>
                            @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->reference }} </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="travaux">{{ __('Quantité :') }} <span class="text-danger">*</span></label>
                        <input type="number" name="quantity" min="0" class="form-control shadow-none" value="1">
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="travaux">{{ __('Prestations group') }}</label>
                        <select name="prestation_group_id" class="select2_select_option form-control w-100">
                                <option value="" selected>{{ __('Select') }}</option>
                            @foreach ($prestation_group as $p_group)
                                <option value="{{ $p_group->id }}">{{ $p_group->code }} </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>

                    {{-- <div class="form-group">
                        <label class="form-label" for="travaux">{{ __('Surface chauffée :') }} <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control shadow-none" aria-label="Amount (to the nearest dollar)">
                            <div class="input-group-append">
                                <span class="input-group-text">m2</span>
                            </div>
                            </div>
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div> --}}

                    <div class="form-group">
                        <label class="form-label" for="travaux">{{ __('Prime Unitaire CEE :') }}</label>
                        <div class="input-group">
                            <input type="number" name="unit_bonus" class="form-control shadow-none" aria-label="Amount (to the nearest dollar)">
                            <div class="input-group-append">
                                <span class="input-group-text">m2</span>
                                <span class="input-group-text" data-container="body" data-toggle="popover" data-placement="bottom" title="Prime CEE / Prix" data-content="En cas de non spécification de la prime le système la calculera automatiquement."><i class="bi bi-question-circle-fill"></i></span>
                                {{-- <span>
                                    <button type="button" class="btn primary-btn--primary h-100 ml-4"><i class="bi bi-arrow-repeat"></i></button>
                                </span> --}}
                            </div>
                            </div>
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="travaux">{{ __('Installateur RGE') }} <span class="text-danger">*</span></label>
                        <select class="select2_select_option form-control w-100" name="installer_rge" required>
                            <option value="" selected>{{ __('Select') }}</option>
                            <option value="BIO SERVICES">BIO SERVICES</option>
                            <option value="NOVECOLOGY">NOVECOLOGY</option>
                        </select>
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="travaux">{{ __('Qualification :') }}</label>
                        <select class="select2_select_option form-control w-100" name="qualification">
                            <option value="" selected>{{ __('Select') }}</option>
                            <option></option>
                        </select>
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="travaux">{{ __('Date de prévisite') }} <span class="text-danger">*</span></label>
                        <input type="date" name="previsite" class="flatpickr form-control shadow-none" required>
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>

                    <div class="form-group d-flex align-items-center justify-content-end mt-4">
                        <button type="button" class="btn btn-trans border-none" data-dismiss="modal">Fermer</button>
                        <button type="submit"  class="btn btn-colors rounded border-0 ml-3">{{ __('Update') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- Prestations Modal --}}
<div class="modal modal--aside fade" id="PrestationsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content simple-bar border-0 h-100 rounded-0">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
                    <span class="novecologie-icon-close"></span>
                </button>
            </div>
            <div class="modal-body">
                <h1 class="modal-title text-center mb-2">{{ __('Détail de la prestation') }}</h1>
                <form action="{{ route('additional.prodcut.add') }}" class="form mx-auto needs-validation" novalidate method="POST">
                    @csrf
                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                    <div class="header_form p-0">
                        <div class="row">
                            {{-- <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label" for="prestation">{{ __('Type de prestation :') }}</label>
                                    <select name="prestation_type" class="select2_select_option form-control w-100">
                                        <option value="Automatique ou Manuelle">Automatique ou Manuelle</option>
                                        <option value="Automatique seulement">Automatique seulement</option>
                                        <option value="Manuelle seulement">Manuelle seulement</option>
                                    </select>
                                    <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                                </div>
                            </div> --}}

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="prestation">{{ __('Opération CEE :') }}</label>
                                    <select name="operation_cee" class="select2_select_option form-control w-100">
                                        <option value="" selected>{{ __('Select') }}</option>
                                        @foreach ($scales as $baremes)
                                            <option value="{{ $baremes->id }}">{{ $baremes->wording }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="form-label" for="prestation">{{ __('Prestations :') }}</label>
                                    <select name="prestation_id" id="prestationDropdown" class="select2_select_option form-control w-100">
                                        <option value="" selected>{{ __('Select') }}</option>
                                        @foreach (\App\Models\CRM\Benefit::all() as $presta)
                                        <option value="{{ $presta->id }}">{{ $presta->title }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="w-100 m-1">
                    <div class="form-group">
                        <label class="form-label" for="travaux">{{ __("Lier à l'opération CEE :") }}</label>
                        <select name="linked_operation" class="select2_select_option form-control w-100" required>
                            <option value="" selected>{{ __('Select') }}</option>
                            {{-- @foreach ($operations as $operation)
                                <option value="{{ $operation->id }}">{{ $operation->getBaremes->wording }} : {{ $operation->getBaremes->description }}</option>
                            @endforeach --}}
                        </select>
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                    <hr class="w-100 m-1">
                    <div id="prestationBlock">
                        <div class="form-group">
                            <label class="form-label" for="titre">{{ __('Titre :') }} <span class="text-danger">**</span></label>
                            <input type="text" id="titre" name="title" class="form-control shadow-none">
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <hr class="w-100 m-1">
                        <div class="form-group">
                            <label class="form-label" for="des">{{ __('Description :') }} <span class="text-danger">**</span></label>
                            <textarea id="des" id="description" name="description" class="text-area shadow-none form-control"></textarea>
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <hr class="w-100 m-1">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label for="#" class="form-label">Ordre :</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                    <button class="btn btn-outline-secondary shadow-none position_decrease" data-id="0" type="button" id="button-addon1">-</button>
                                    </div>
                                    <input type="number"  class="form-control shadow-none" id="position0" name="order" value="1" min="0" aria-label="Example text with button addon" aria-describedby="button-addon1">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary shadow-none position_increase" data-id="0" type="button" id="button-addon2">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="w-100 m-1">
                        <div class="row align-items-center">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label" for="pu_ttc0">{{ __('P.U TTC :') }} <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="number" name="pu_ttc" id="pu_ttc0" data-id="0" class="form-control shadow-none product_total_count" aria-label="Amount (to the nearest dollar)">
                                        <div class="input-group-append">
                                        <span class="input-group-text">€</span>
                                        </div>
                                    </div>
                                    <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label" for="travaux">{{ __('Taux appliqué :') }} <span class="text-danger">*</span></label>
                                    <select class="select2_select_option form-control w-100" name="tax" required>
                                        <option value="" selected>{{ __('Select') }}</option>
                                        <option value="0">Non spécifiée</option>
                                        <option value="5.5">Taux réduit à 5,5 %</option>
                                        <option value="20">Taux normal à 20 %</option>
                                    </select>
                                    <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                                </div>
                            </div>
                            <hr class="w-100 m-1">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label" for="quantity0">{{ __('Quantité :') }} <span class="text-danger">*</span></label>
                                    <input type="number" name="quantity"  id="quantity0" data-id="0" class="form-control shadow-none product_total_count" required>
                                    <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label" for="travaux">{{ __('Unité :') }} <span class="text-danger">*</span></label>
                                    <select name="unit" class="select2_select_option form-control w-100" required>
                                        <option value="" selected>{{ __('Select') }}</option>
                                        <option value="m²">m²</option>
                                        <option value="m³">m³</option>
                                        <option value="ml">ml</option>
                                        <option value="litre">litre</option>
                                        <option value="heure">heure</option>
                                        <option value="jour">jour</option>
                                    </select>
                                    <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                                </div>
                            </div>
                            <hr class="w-100 m-1">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label" for="total_ttc0">{{ __('Total T.T.C :') }}</label>
                                    <div class="input-group">
                                        <input type="number" name="total_ttc" id="total_ttc0" value="0.00" class="form-control shadow-none" aria-label="Amount (to the nearest dollar)">
                                        <div class="input-group-append">
                                        <span class="input-group-text">€</span>
                                        </div>
                                    </div>
                                    <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="switches d-flex align-items-center">
                                    <label for="priceDesabled" class="form-label m-0 mr-5">Afficher les prix :</label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="view_price" class="custom-control-input" id="priceDesabled">
                                        <label class="custom-control-label" for="priceDesabled"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="w-100 m-1">
                        <div class="form-group d-flex align-items-center justify-content-between mt-4">
                            <p class="m-0"><span class="text-danger">(**)</span>L'un des deux champs est obligatoire</p>
                            <div class="submit__btn">
                                <button type="button" data-dismiss="modal" class="btn btn-trans border-none">Fermer</button>
                                <button type="submit"  class="btn btn-colors btn-res rounded border-0 md-ml-3 md-mt-2">{{ __('Create') }}</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Prestation Bulk Delete Modal  --}}
<div class="modal modal--aside fade" id="PrestationsDeleteModal" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                    <span class="novecologie-icon-close"></span>
                </button>
            </div>
            <div class="modal-body text-center pt-0">
                <h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
                <span>{{ __('Are You Sure To Delete this') }} ?</span>
                <form action="{{ route('additional.product.bulk.delete') }}" method="POST">
                    @csrf
                    <input type="hidden" name="ids" class="prestationBulkIds">
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

