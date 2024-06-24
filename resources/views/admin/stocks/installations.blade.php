@extends('admin.stocks.layouts')

@section('SuiviActive', 'active_sidbar') 
@push('css_style')
    <link rel="stylesheet" href="{{ asset('crm_assets/assets/plugins/row-calendar/css/style.css') }}">
	 <style>
        .font_30{
            font-size: 30px;
        }
        .select2-selection--no-border span.select2-selection.select2-selection--single {
            outline: none;
            border: 0;
        }

       .database-table__body--installation tr td:last-child {
            padding-right: 3px !important;
        }

        .table--td{
            border: 2px solid black !important; 
            width: 50% !important;
        }
        .table-no-border td{
            border-top: 0 !important;
        }

        .database-table__body--no-border tr{
            border-bottom: 0 !important;
        }
        hr{
            border-top: 4px solid #4472C4;
            margin-bottom: 50px;
        }
	 </style>
@endpush

@section('tab-content')
    <div class="tab-pane fade show active" id="v-pills-documentControl" role="tabpanel" aria-labelledby="v-pills-documentControl-tab"> 
        <div class="row">  
            <div class="col-12  text-right"> 
                @if (checkAction(Auth::id(), 'stocks_installations', 'export') || role() == 's_admin')
                    <button type="button" class="btn btn-icon mr-2 shadow-none" data-toggle="modal" data-target="#exportModal">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve">
                            <style type="text/css">
                                .st0{fill:#2F528F;}
                            </style>
                            <polygon class="st0" points="14.18,5.16 9.82,5.16 9.82,12.88 7.42,12.88 12,17.79 16.58,12.88 14.18,12.88 "/>
                            <rect x="7.42" y="18.13" class="st0" width="9.17" height="1.08"/>
                            <g>
                                <path class="st0" d="M12,23.81c-6.51,0-11.81-5.3-11.81-11.81S5.49,0.19,12,0.19S23.81,5.49,23.81,12S18.51,23.81,12,23.81z    M12,2.19c-5.41,0-9.81,4.4-9.81,9.81c0,5.41,4.4,9.81,9.81,9.81c5.41,0,9.81-4.4,9.81-9.81C21.81,6.59,17.41,2.19,12,2.19z"/>
                            </g>
                        </svg>
                    </button>
                @endif
                <ul class="nav nav-pills nav-pills--horizontal d-inline-block my-3  mr-3" id="pills-tab" role="tablist" style="border: 2px solid #2F528F; border-radius: 7px;"> 
                    <li class="nav-item d-inline-block" role="presentation">
                        <a class="nav-link active px-4 py-1" id="pills-two-tab" data-toggle="pill" href="#pills-two" role="tab" aria-controls="pills-two" aria-selected="true">Installation</a>
                    </li>  
                    <li class="nav-item d-inline-block" role="presentation">
                        @if (checkAction(Auth::id(), 'stocks_installations', 'vehicle') || role() == 's_admin')
                            <a class="nav-link px-4 py-1" id="pills-one-tab" data-toggle="pill" href="#pills-one" role="tab" aria-controls="pills-one" aria-selected="false">Véhicule</a>
                        @else
                            <a class="nav-link px-4 py-1" style=" cursor: pointer;"> <span class="novecologie-icon-lock py-1"></span> Véhicule</a>
                        @endif
                    </li>  
                </ul>  
            </div>  
            <div class="col-12">
                <div class="tab-content" id="pills-tabContent"> 
                    <div class="tab-pane fade" id="pills-one" role="tabpanel" aria-labelledby="pills-one-tab"> 
                        <div class="text-right my-4">
                            @if (checkAction(Auth::id(), 'stocks_installations', 'create') || role() == 's_admin') 
                                <button data-toggle="modal" data-target="#addNew" type="button" class="secondary-btn border-0 rounded shadow-none mr-3"><i class="bi bi-plus-square"></i> Nouvelle Installation</button> 
                            @else
                                <button type="button" class="secondary-btn border-0 rounded shadow-none"> <span class="novecologie-icon-lock py-1"></span> Nouvelle Installation</button>
                            @endif
                        </div>
                        <div class="row p-3"> 
                            @php
                                $vehicle_counter = 0;
                            @endphp
                            @foreach ($vehicle_users as $vehicle_user)
                                @if ($vehicle_user->mouvements->where('mouvement_id', 2)->where('mouvement', 'Sortie')->first())
                                    @php
                                        $vehicle_counter = 1;
                                        $mouvement_product_arr = [];
                                        $installation_product_arr = [];
                                    @endphp
                                    <div class="col-12">
                                        <h3 class="pl-2 {{ !$loop->first ? 'mt-5':'' }}">VEHICULE : {{ $vehicle_user->name ?? '' }}</h3>
                                        <hr>
                                        <div class="table-responsive simple-bar">
                                            <table class="table database-table w-100 mb-0 text-center">
                                                <thead class="database-table__header">
                                                    <tr>
                                                        <td style="background-color: #2F5597; border: 2px solid white !important" class="text-white text-center">Produit</td>
                                                        <td style="background-color: #2F5597; border: 2px solid white !important" class="text-white text-center">Matériel pris</td> 
                                                        <td style="background-color: #2F5597; border: 2px solid white !important" class="text-white text-center">Matériel installé</td> 
                                                        <td style="background-color: #2F5597; border: 2px solid white !important" class="text-white text-center">ETAT</td>  
                                                    </tr>
                                                </thead>
                                                <tbody class="database-table__body database-table__body--no-border"> 
                                                    @foreach ($vehicle_user->mouvements->where('mouvement_id', 2)->where('mouvement', 'Sortie') as $user_mouvement)
                                                        @foreach ($user_mouvement->products as $m_product)
                                                            @if (!in_array($m_product->product_id, $mouvement_product_arr))
                                                                @php
                                                                    $mouvement_product_arr[] = $m_product->product_id; 
                                                                @endphp
                                                                <tr>    
                                                                    <td class="text-center">{{ $m_product->product->reference ?? '' }}</td> 
                                                                    <td class="text-center">{{ $m_product->allMouvementProduct->whereIn('mouvement_id', $vehicle_user->mouvements->where('mouvement_id', 2)->where('mouvement', 'Sortie')->pluck('id')->toArray())->sum('quantity') }}</td>
                                                                    <td class="text-center">{{ \App\Models\CRM\StockInstallationProduct::whereIn('installation_id', $vehicle_user->stockInstallations->pluck('id')->toArray())->where('product_id', $m_product->product_id)->sum('quantity') }}</td>
                                                                    <td class="text-center">{{ $m_product->allMouvementProduct->whereIn('mouvement_id', $vehicle_user->mouvements->where('mouvement_id', 2)->where('mouvement', 'Sortie')->pluck('id')->toArray())->sum('quantity') - \App\Models\CRM\StockInstallationProduct::whereIn('installation_id', $vehicle_user->stockInstallations->pluck('id')->toArray())->where('product_id', $m_product->product_id)->sum('quantity') - $m_product->allMouvementProduct->whereIn('mouvement_id', $vehicle_user->mouvements->where('mouvement_id', 3)->where('mouvement', 'Entrée')->pluck('id')->toArray())->sum('quantity') }}</td>

                                                                </tr> 
                                                                {{-- <tr>    
                                                                    <td class="text-center">{{ $user_mouvement->product->reference ?? '' }}</td>
                                                                    <td class="text-center">{{ $vehicle_user->mouvements->where('mouvement_id', 2)->where('mouvement', 'Sortie')->where('product_id', $user_mouvement->product_id)->sum('quantity') }}</td>
                                                                    <td class="text-center">{{ \App\Models\CRM\StockInstallationProduct::whereIn('installation_id', $vehicle_user->stockInstallations->pluck('id')->toArray())->where('product_id', $user_mouvement->product_id)->sum('quantity') }}</td>
                                                                    <td class="text-center">{{ $vehicle_user->mouvements->where('mouvement_id', 2)->where('mouvement', 'Sortie')->where('product_id', $user_mouvement->product_id)->sum('quantity') - \App\Models\CRM\StockInstallationProduct::whereIn('installation_id', $vehicle_user->stockInstallations->pluck('id')->toArray())->where('product_id', $user_mouvement->product_id)->sum('quantity') - $vehicle_user->mouvements->where('mouvement_id', 3)->where('mouvement', 'Entrée')->where('product_id', $user_mouvement->product_id)->sum('quantity') }}</td>

                                                                </tr>  --}}
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                    @foreach (\App\Models\CRM\StockInstallationProduct::whereIn('installation_id', $vehicle_user->stockInstallations->pluck('id')->toArray())->whereNotIn('product_id', $mouvement_product_arr)->get() as $user_installation)
                                                        @if (!in_array($user_installation->product_id, $installation_product_arr))
                                                            @php
                                                                $installation_product_arr[] = $user_installation->product_id; 
                                                            @endphp
                                                            <tr>    
                                                                <td class="text-center">{{ $user_installation->product->reference ?? '' }}</td>
                                                                <td class="text-center">0</td>
                                                                <td class="text-center">{{ \App\Models\CRM\StockInstallationProduct::whereIn('installation_id', $vehicle_user->stockInstallations->pluck('id')->toArray())->where('product_id', $user_installation->product_id)->sum('quantity') }}</td>
                                                                <td class="text-center">{{ - \App\Models\CRM\StockInstallationProduct::whereIn('installation_id', $vehicle_user->stockInstallations->pluck('id')->toArray())->where('product_id', $user_installation->product_id)->sum('quantity') }}</td>
                                                            </tr> 
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @elseif ($vehicle_user->stockInstallations->count() > 0)
                                    @php
                                        $vehicle_counter = 1;
                                        $installation_product_arr = [];
                                    @endphp
                                    <div class="col-12">
                                        <h3 class="pl-2 {{ !$loop->first ? 'mt-5':'' }}">VEHICULE : {{ $vehicle_user->name ?? '' }}</h3>
                                        <hr>
                                        <div class="table-responsive simple-bar">
                                            <table class="table database-table w-100 mb-0 text-center">
                                                <thead class="database-table__header">
                                                    <tr>
                                                        <td style="background-color: #2F5597; border: 2px solid white !important" class="text-white text-center">Produit</td>
                                                        <td style="background-color: #2F5597; border: 2px solid white !important" class="text-white text-center">Matériel pris</td> 
                                                        <td style="background-color: #2F5597; border: 2px solid white !important" class="text-white text-center">Matériel installé</td> 
                                                        <td style="background-color: #2F5597; border: 2px solid white !important" class="text-white text-center">ETAT</td>  
                                                    </tr>
                                                </thead>
                                                <tbody class="database-table__body database-table__body--no-border"> 
                                                    @foreach (\App\Models\CRM\StockInstallationProduct::whereIn('installation_id', $vehicle_user->stockInstallations->pluck('id')->toArray())->get() as $user_installation)
                                                        @if (!in_array($user_installation->product_id, $installation_product_arr))
                                                            @php
                                                                $installation_product_arr[] = $user_installation->product_id; 
                                                            @endphp
                                                            <tr>    
                                                                <td class="text-center">{{ $user_installation->product->reference ?? '' }}</td>

                                                                <td class="text-center">0</td>

                                                                <td class="text-center">{{ \App\Models\CRM\StockInstallationProduct::whereIn('installation_id', $vehicle_user->stockInstallations->pluck('id')->toArray())->where('product_id', $user_installation->product_id)->sum('quantity') }}</td>

                                                                <td class="text-center">{{ - \App\Models\CRM\StockInstallationProduct::whereIn('installation_id', $vehicle_user->stockInstallations->pluck('id')->toArray())->where('product_id', $user_installation->product_id)->sum('quantity') }}</td>
                                                            </tr> 
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            @if (!$vehicle_counter)
                                <div class="col-12">
                                    <h1 class="text-center py-3">No record found</h1>
                                </div>  
                            @endif
                            {{-- @php
                                $mouvement_user_arr = [];
                            @endphp
                            @forelse ($mouvements as $mouvement)
                                @if (!in_array($mouvement->user_id, $mouvement_user_arr))
                                    @php
                                        $mouvement_user_arr[] = $mouvement->user_id;
                                        $mouvement_product_arr = [];
                                    @endphp
                                    <div class="col-12">
                                        <h3 class="pl-2 {{ !$loop->first ? 'mt-5':'' }}">VEHICULE : {{ $mouvement->user->name ?? '' }}</h3>
                                        <hr>
                                        <div class="table-responsive simple-bar">
                                            <table class="table database-table w-100 mb-0 text-center">
                                                <thead class="database-table__header">
                                                    <tr>
                                                        <td style="background-color: #2F5597; border: 2px solid white !important" class="text-white text-center">Produit</td>
                                                        <td style="background-color: #2F5597; border: 2px solid white !important" class="text-white text-center">Matériel pris</td> 
                                                        <td style="background-color: #2F5597; border: 2px solid white !important" class="text-white text-center">Matériel installé</td> 
                                                        <td style="background-color: #2F5597; border: 2px solid white !important" class="text-white text-center">ETAT</td>  
                                                    </tr>
                                                </thead>
                                                <tbody class="database-table__body database-table__body--no-border"> 
                                                    @foreach ($mouvement->user->mouvements as $user_mouvement)
                                                        @if (!in_array($user_mouvement->product_id, $mouvement_product_arr))
                                                            @php
                                                                $mouvement_product_arr[] = $user_mouvement->product_id; 
                                                            @endphp
                                                            <tr>    
                                                                <td class="text-center">{{ $user_mouvement->product->reference ?? '' }}</td>

                                                                <td class="text-center">{{ $mouvement->user->mouvements->where('product_id', $user_mouvement->product_id)->sum('quantity') }}</td>

                                                                <td class="text-center">{{ \App\Models\CRM\StockInstallationProduct::whereIn('installation_id', $mouvement->user->stockInstallations->pluck('id')->toArray())->where('product_id', $user_mouvement->product_id)->sum('quantity') }}</td>

                                                                <td class="text-center">{{ $mouvement->user->mouvements->where('product_id', $user_mouvement->product_id)->sum('quantity') - \App\Models\CRM\StockInstallationProduct::whereIn('installation_id', $mouvement->user->stockInstallations->pluck('id')->toArray())->where('product_id', $user_mouvement->product_id)->sum('quantity') - $mouvement->user->mouvements->where('mouvement_id', 3)->where('mouvement', 'Entrée')->where('product_id', $user_mouvement->product_id)->sum('quantity') }}</td>

                                                            </tr> 
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endif
                            @empty
                                    <div class="col-12">
                                        <h1 class="text-center py-3">No record found</h1>
                                    </div>
                            @endforelse --}}
                        </div>
                    </div> 
                    <div class="tab-pane fade show active" id="pills-two" role="tabpanel" aria-labelledby="pills-two-tab">  
                        <div class="row">
                            <div class="col-12">
                                @if (checkAction(Auth::id(), 'stocks_installations', 'filter') || role() == 's_admin')
                                    <form class="bg-white px-3 pt-3 border rounded-lg" action="{{ route('stock.installations.filter') }}">
                                        <div class="row"> 
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Installateur</label>
                                                    <select class="select2_select_option shadow-none form-control" id="intaller" name="intaller">
                                                        <option value="" selected>Sélectionnez</option> 
                                                        @foreach ($users as $user)
                                                            <option {{ request()->intaller == $user->id ? 'selected':'' }} value="{{ $user->id }}">{{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div> 
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Client</label>
                                                    <select name="client" id="client" class="select2_select_option custom-select shadow-none form-control">
                                                        <option value="" selected>Sélectionnez</option>
                                                        @foreach ($projects as $project)
                                                            <option {{ request()->client == $project->id ? 'selected':'' }} value="{{$project->id }}">{{ $project->Prenom.' '.$project->Nom }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div> 
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Matériel Installé</label>
                                                    <select class="select2_select_option shadow-none form-control" id="material_installe" name="material_installe">
                                                        <option value="" selected>Sélectionnez</option> 
                                                        @foreach ($products as $product)
                                                            <option {{ request()->material_installe == $product->id ? 'selected':'' }} value="{{ $product->id }}">{{ $product->reference }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div> 
                                            <div class="col-md-6 d-flex align-items-center justify-content-center"> 
                                                <div class="calendar-wrapper">
                                                    <div class="calendar-header">
                                                        <div class="calendar-header__top justify-content-center py-2">
                                                            <button type="button" class="calendar-header__top__btn filterDateChangeArray" data-type="left" data-start-date="{{ $week_start }}">
                                                                <i class="bi bi-chevron-left"></i>
                                                            </button>
                                                            <h3 class="calendar-header__top__title mx-3" id="mapDateFilterWrap">
                                                                <label class="label-flatpickr"> <span id="filterDateRangeLabel">{{ \Carbon\Carbon::parse($week_start)->locale(app()->getLocale())->translatedFormat('d F') }} - {{ \Carbon\Carbon::parse($week_end)->locale(app()->getLocale())->translatedFormat('d F') }}</span>
                                                                    <div class="label-flatpickr__container">
                                                                        <div class="form-group">
                                                                            <input type="date" name="custom_filter_date" id="filterDate" value="{{ \Carbon\Carbon::parse($week_start)->format('Y-m-d') }}" class="flatpickr">
                                                                        </div>
                                                                    </div>
                                                                </label>
                                                            </h3>
                                                            <button type="button" class="calendar-header__top__btn filterDateChangeArray" data-type="right" data-start-date="{{ $week_start }}">
                                                                <i class="bi bi-chevron-right"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div> 
                                            <div class="col-12 ml-auto mt-3">
                                                <div class="form-group d-flex align-items-center justify-content-end">
                                                    @if (\Request::route()->getName() == 'stock.installations.filter')
                                                        <a href="{{ route('stock.installations') }}" class="btn btn-sm btn-outline-danger" name="clear" type="submit"><i class="bi bi-x-lg"></i></a>
                                                    @endif
                                                    <button type="submit" class="ticket-main__chat-card__send-btn mx-2">
                                                        Valider
                                                    </button> 
                                                    @if (checkAction(Auth::id(), 'stocks_installations', 'create') || role() == 's_admin') 
                                                        <button data-toggle="modal" data-target="#addNew" type="button" class="secondary-btn border-0 rounded shadow-none"><i class="bi bi-plus-square"></i> Nouvelle Installation</button> 
                                                    @else
                                                        <button type="button" class="secondary-btn border-0 rounded shadow-none  ml-2"> <span class="novecologie-icon-lock py-1"></span> Nouvelle Installation</button>
                                                    @endif 
                                                </div> 
                                            </div>
                                        </div>
                                    </form>
                                @else
                                    <div class="text-right my-4">
                                        @if (checkAction(Auth::id(), 'stocks_installations', 'create') || role() == 's_admin') 
                                            <button data-toggle="modal" data-target="#addNew" type="button" class="secondary-btn border-0 rounded shadow-none mr-3"><i class="bi bi-plus-square"></i> Nouvelle Installation</button> 
                                        @else
                                            <button type="button" class="secondary-btn border-0 rounded shadow-none"> <span class="novecologie-icon-lock py-1"></span> Nouvelle Installation</button>
                                        @endif
                                    </div>
                                @endif
                            </div> 
                            <div class="col-12">
                                <div class="table-responsive simple-bar">
                                    <table class="table table-no-border w-100 mb-0 text-center">
                                        <thead class="database-table__header">
                                            <tr>
                                                <td style="background-color: #2F5597; border: 2px solid white !important; border-left: 0 !important;" class="text-white text-center">Date </td>
                                                <td style="background-color: #2F5597; border: 2px solid white !important;" class="text-white text-center">Installateur </td>
                                                <td style="background-color: #2F5597; border: 2px solid white !important;" class="text-white text-center">Client </td>
                                                <td style="background-color: #2F5597; border: 2px solid white !important; width: 30%" class="text-white text-center">Matériel Installé : </td>
                                                <td style="background-color: #2F5597; border: 2px solid white !important;" class="text-white text-center">Quantité </td>
                                                <td style="background-color: #2F5597; border: 2px solid white !important;" class="text-white text-center">Détails </td>  
                                            </tr>
                                        </thead>
                                        <tbody class="database-table__body"> 
                                            @forelse ($installations as $installation)
                                                @foreach ($installation->products as $product_key => $product)
                                                    <tr  
                                                    style="
                                                    border-left: 3px solid black;
                                                    border-right: 3px solid black;
                                                        @if($loop->first)
                                                            border-top: 3px solid black;
                                                        @else
                                                            border-top: 0 !important;
                                                        @endif
                                                        @if($loop->last)
                                                            border-bottom: 3px solid black;
                                                        @else
                                                            border-bottom:0 !important;
                                                        @endif
                                                    "
                                                    > 
                                                        @if ($product_key == 0)
                                                            <td class="text-center">{{ \Carbon\Carbon::parse($installation->date)->format('d-m-Y') }}</td>
                                                            <td class="text-center">{{ $installation->installer->name ?? '' }}</td>
                                                            <td class="text-center">{{ $installation->project->Prenom ?? '' }} {{ $installation->project->Nom ?? '' }}</td>
                                                        @else
                                                            <td colspan="3"></td>
                                                        @endif
                                                        <td class="text-center"> 
                                                            {{ $product->product->reference ?? '' }}
                                                        </td> 
                                                        <td class="text-center">
                                                            {{ $product->quantity }} 
                                                        </td> 
                                                        @if ($product_key == 0)
                                                            <td class="text-center">
                                                                <a href="{{ route('stock.installation.details', $installation->id) }}" class="primary-btn primary-btn--blue w-auto d-inline-flex justify-content-center align-items-center rounded px-4">
                                                                    {{ __('Update') }}
                                                                </a>
                                                            </td>
                                                        @else
                                                            <td colspan="1"></td>
                                                        @endif
                                                    </tr> 
                                                    {{-- {{ $product->product->reference ?? '' }} --}}
                                                @endforeach
                                            @empty
                                                <tr class="border-0">
                                                    <td colspan="12">
                                                        <h1 class="text-center py-3">No record found</h1>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div> 
                        </div>  
                    </div>  
                </div> 
            </div>
        </div> 
    </div>
@endsection

@section('modal-content')
    <div class="modal modal--aside fade rightAsideModal" id="addNew" tabindex="-1" aria-labelledby="addNewLabel" aria-hidden="true">
        <div class="modal-dialog m-0 h-100 bg-white">
            <div class="modal-content border-0 h-100 rounded-0 simple-bar">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
                        <span class="novecologie-icon-close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="database-table-wrapper"> 
                        <h1 class="modal-title text-center mb-3">Nouvelle Installation</h1>
                        {{-- <div class="d-flex align-items-center">
                            <div class="ml-auto">
                                <ul class="nav nav-pills nav-pills--horizontal d-inline-block my-3" id="addnew-pills-tab" role="tablist" style="border: 2px solid #2F528F; border-radius: 7px;"> 
                                    <li class="nav-item d-inline-block" role="presentation">
                                        <a class="nav-link active px-4 py-1" id="addnew-pills-two-tab" data-toggle="pill" href="#addnew-pills-two" role="tab" aria-controls="addnew-pills-two" aria-selected="true">Détails</a>
                                    </li>  
                                    <li class="nav-item d-inline-block" role="presentation">
                                        <a class="nav-link px-4 py-1" id="addnew-pills-one-tab" data-toggle="pill" href="#addnew-pills-one" role="tab" aria-controls="addnew-pills-one" aria-selected="false">Historique</a>
                                    </li>  
                                </ul> 
                            </div>
                        </div> --}}
                        <form action="{{ route('stock.installation.create') }}" class="form" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row"> 
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="#">Date : <span class="text-danger">*</span></label>
                                        <input type="date" name="date" value="{{ \Carbon\Carbon::today() }}" class="flatpickr form-control shadow-none rounded" required>
                                    </div>
                                </div> 
                                <div class="col-12"> 
                                    <div class="form-group">
                                        <label for="#">Nom du chantier : <span class="text-danger">*</span></label>
                                        <select class="select2_select_option form-control" name="project_id" required>
                                            <option value="" selected disabled>{{ __('Select') }}</option>
                                            @foreach ($projects as $project)
                                                <option value="{{$project->id }}">{{ $project->Prenom.' '.$project->Nom }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12"> 
                                    <div class="form-group">
                                        <label for="#">Installateur : <span class="text-danger">*</span></label>
                                        <select class="select2_select_option form-control" name="installateur_id" required>
                                            <option value="" selected disabled>{{ __('Select') }}</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 my-4">
                                    <h2 class="text-center">Matériel Installé :</h2> 
                                    <div class="table-responsive">
                                        <table class="table w-100 mb-0 text-center" style="border: 2px solid black !important"> 
                                            <tbody class="database-table__body database-table__body--installation" id="installationTbody"> 
                                                <tr>
                                                    <td class="select2-selection--no-border table--td" style="padding: 3px;">
                                                        <select class="select2_select_option form-control shadow-none" name="product[]" required>
                                                            <option value="" selected disabled>Produit</option>
                                                            @foreach ($products as $product)
                                                                <option value="{{ $product->id }}">{{ $product->reference }}</option>
                                                            @endforeach
                                                        </select>  
                                                    </td>
                                                    <td class="table--td" style="padding: 3px;"><input type="number" min="1" name="quantity[]" class="form-control text-center shadow-none border-0 installation-product-quantity" required></td>
                                                </tr> 
                                            </tbody>
                                        </table>
                                    </div>
                                    <button type="button" id="installationAddNew" class="secondary-btn border-0 rounded shadow-none my-3"><i class="bi bi-plus-square"></i> Ajouter un nouveau produit</button>
                                    <div class="table-responsive">
                                        <table class="table w-100 mb-0 text-center" style="border: 2px solid black !important; background-color: #D9D9D9"> 
                                            <tbody class="database-table__body"> 
                                                <tr>
                                                    <td class="table--td">TOTAL</td>
                                                    <td class="table--td" id="totalQuantity">0</td>
                                                </tr> 
                                            </tbody>
                                        </table>
                                    </div> 
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="#">Observations :</label>
                                        <textarea name="observation" id="observation" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group text-center">
                                        <button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill border-0 my-5">
                                            {{ __('Submit') }}
                                        </button>
                                    </div> 
                                </div>
                            </div>
                            {{-- <div class="tab-content" id="addnew-pills-tabContent"> 
                                <div class="tab-pane fade" id="addnew-pills-one" role="tabpanel" aria-labelledby="addnew-pills-one-tab"> 
                                    <div class="row"> 
                                    </div>
                                </div> 
                                <div class="tab-pane fade show active" id="addnew-pills-two" role="tabpanel" aria-labelledby="addnew-pills-two-tab">  
                                     
                                </div>  
                            </div> --}}
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal--aside fade rightAsideModal" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
        <div class="modal-dialog m-0 h-100 bg-white">
            <div class="modal-content border-0 h-100 rounded-0 simple-bar">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
                        <span class="novecologie-icon-close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="database-table-wrapper"> 
                        <h1 class="modal-title text-center mb-3">Export Installation</h1> 
                        <form action="{{ route('stock.installations.export') }}" class="form" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row"> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="#">Date Du:</label>
                                        <input type="date" name="from" class="flatpickr form-control shadow-none rounded">
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="#">Date Au:</label>
                                        <input type="date" name="to" class="flatpickr form-control shadow-none rounded">
                                    </div>
                                </div> 
                                <div class="col-12"> 
                                    <div class="form-group">
                                        <label for="#">Installateur :</label>
                                        <select class="select2_select_option form-control" name="installateur_id">
                                            <option value="" selected disabled>{{ __('Select') }}</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12"> 
                                    <div class="form-group">
                                        <label for="#">Client :</label>
                                        <select class="select2_select_option form-control" name="project_id">
                                            <option value="" selected disabled>{{ __('Select') }}</option>
                                            @foreach ($projects as $project)
                                                <option value="{{$project->id }}">{{ $project->Prenom.' '.$project->Nom }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> 
                                <div class="col-12"> 
                                    <div class="form-group">
                                        <label for="#">Matériel Installé :</label>
                                        <select class="select2_select_option form-control" name="product_id">
                                            <option value="" selected disabled>{{ __('Select') }}</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->reference }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>  
                                <div class="col-12">
                                    <div class="form-group text-center">
                                        <button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill border-0 my-5">
                                            Télécharger
                                        </button>
                                    </div> 
                                </div>
                            </div> 
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>
@endsection

@push('stockJs')
    <script>
        function totalQuantity(){
            let totalQuantity = 0;
            $('.installation-product-quantity').each(function(){
                totalQuantity += +$(this).val();
            });

            $('#totalQuantity').text(totalQuantity);
        }
        $(document).ready(function(){
            $('#installationAddNew').on('click', function(){
                const $data = `
                <tr>
                    <td class="select2-selection--no-border table--td" style="padding: 3px;">
                        <select class="select2_select_option form-control shadow-none" name="product[]" required>
                            <option value="" selected disabled>Produit</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->reference }}</option>
                            @endforeach
                        </select>  
                    </td>
                    <td class="table--td" style="padding: 3px;">
                        <div class="d-flex">
                            <input type="number" min="1" name="quantity[]" class="form-control text-center shadow-none border-0 installation-product-quantity" required>
                            <button type="button" class="btn btn-sm btn-outline-danger installationTrRemove shadow-none"><i class="bi bi-x-lg"></i></button>
                        </div>
                    </td>
                </tr>
                `;
                $('#installationTbody').append($data); 
                
                $('.select2_select_option').select2();
                $('.select2_select_option').select2({
                    templateSelection : function (tag, container){
                        var $option = $('.select2_select_option option[value="'+tag.id+'"]');
                        if ($option.attr('disabled')){
                        $(container).addClass('removed-remove-btn');
                        }
                        return tag.text;
                    },
                })
            });  

            $('body').on('click', '.installationTrRemove', function(){
                $(this).closest('tr').slideUp(function(){
                    $(this).remove();
                    totalQuantity();
                });
            });

            $("body").on('input', '.installation-product-quantity', function(){
                totalQuantity()
            }); 

            $('body').on('click', '.filterDateChangeArray', function(){ 
                let type = $(this).data('type');
                let start_date = $(this).attr('data-start-date'); 
                $.ajax({
                    type : "POST",
                    url  : "{{ route('map.date.change') }}",
                    data : {type, start_date},
                    success : response => {
                        $("#mapDateFilterWrap").html(response.view);
                        $('.filterDateChangeArray').attr('data-start-date', response.date); 
                        $('input[type=date]').wrap('<div class="datepicker-input"></div>');
                        document.querySelectorAll('input[type=date]').forEach(e => {
                            flatpickr(e, {
                                minDate: e.getAttribute('min'),
                                maxDate: e.getAttribute('max'),
                                defaultDate: e.getAttribute('value'),
                                altFormat: 'j F Y',
                                dateFormat: 'Y-m-d',
                                allowInput: true,
                                altInput: true,
                                locale: "fr",
                                onReady: (selectedDates, dateStr, instance) => {
                                    const mainInputDataId = instance.input.dataset.id;
                                    const altInput = instance.input.parentElement?.querySelector(".input");
                                    altInput.setAttribute("onkeypress", "return false");
                                    altInput.setAttribute("onpaste", "return false");
                                    altInput.setAttribute("autocomplete", "off");
                                    altInput.setAttribute("id", mainInputDataId);
                                },
                            });
                        });
                    }
                })

            });
            $('body').on('change', '#filterDate', function(){ 
                $.ajax({
                    type : "POST",
                    url  : "{{ route('map.date.change2') }}",
                    data : {date:$(this).val()},
                    success : response => {
                        $("#filterDateRangeLabel").text(response.label);
                        $('.filterDateChangeArray').attr('data-start-date', response.date); 
                    }
                })
            });
        });

    </script>
@endpush