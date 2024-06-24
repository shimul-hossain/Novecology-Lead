@extends('admin.stocks.layouts')

@section('MouvementsActive', 'active_sidbar') 
@push('css_style')
	 <style>
       
        .select2-selection--no-border span.select2-selection.select2-selection--single {
            outline: none;
            border: 0;
        }

       .database-table__body--mouvement tr td:last-child {
            padding-right: 3px !important;
        }

        .table--td{
            border: 2px solid black !important; 
            width: 50% !important;
        }

        .database-table__body--no-border tr{
            border-bottom: 0 !important;
        }

	 </style>
@endpush

@section('tab-content')
    <div class="tab-pane fade show active" id="v-pills-documentControl" role="tabpanel" aria-labelledby="v-pills-documentControl-tab"> 
        <div class="row"> 
            <div class="col-12">
                <form class="bg-white px-3 pt-3 border rounded-lg" action="{{ route('stock.mouvement.filter') }}">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Client</label>
                                <select name="client" class="select2_select_option custom-select shadow-none form-control">
                                    <option value="" selected>Sélectionnez</option>
                                    @foreach ($projects as $project)
                                        <option {{ request()->client == $project->id ? 'selected':'' }} value="{{ $project->id }}">{{ $project->Prenom.' '.$project->Nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Produit</label>
                                <select class="select2_select_option shadow-none form-control" id="produit" name="produit">
                                    <option value="" selected>Sélectionnez</option> 
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}" {{ request('produit') == $product->id ? 'selected':'' }}>{{ $product->reference }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Mouvement</label>
                                <select class="select2_select_option shadow-none form-control" name="mouvement_"> 
                                    <option value="" selected>Sélectionnez</option>
                                    <option {{ request()->mouvement_ == 'Entrée' ? 'selected':'' }} value="Entrée">Entrée</option>
                                    <option {{ request()->mouvement_ == 'Sortie' ? 'selected':'' }} value="Sortie">Sortie</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="type">Type</label>
                                <select class="select2_select_option shadow-none form-control" id="type" name="type">
                                    <option value="" selected>Sélectionnez</option> 
                                    @foreach ($types as $type)
                                        <option {{ request('type') == $type->id ? 'selected':'' }} value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select> 
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Entrepôt</label>
                                <select name="entrepot" id="entrepot" class="select2_select_option custom-select shadow-none form-control">
                                    <option value="" selected>Sélectionnez</option>
                                    @foreach ($entrepots as $entrepot)
                                    <option {{ request('entrepot') == $entrepot->id ? 'selected':'' }} value="{{ $entrepot->id }}">{{ $entrepot->name }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Enlèvement/Retour par</label>
                                <select name="enlevement" class="select2_select_option custom-select shadow-none form-control">
                                    <option value="" selected>Sélectionnez</option> 
                                    @foreach ($users as $user)
                                        <option {{ $user->id == request()->enlevement ? 'selected':'' }} value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <label class="form-label">De</label>
                                <input type="date" name="from" value="{{ request()->from }}" class="flatpickr flatpickr-input form-control shadow-none bg-white" placeholder="Date Mois, Année">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <label class="form-label">a</label>
                                <input type="date" name="to" value="{{ request()->to }}" class="flatpickr flatpickr-input form-control shadow-none bg-white" placeholder="Date Mois, Année">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Réceptionné par</label>
                                <select class="select2_select_option shadow-none form-control" name="reception">
                                    <option value="">{{ __('Select') }}</option>
                                    @foreach ($receptions as $reception)
                                        <option {{ $reception->id == request()->reception ? 'selected':'' }} value="{{ $reception->id }}">{{ $reception->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 ml-auto mt-3 d-flex align-items-center justify-content-end">
                            <div class="form-group">
                                <button type="submit" class="ticket-main__chat-card__send-btn">
                                    Valider
                                </button>
                                @if (\Request::route()->getName() == 'stock.mouvement.filter')
                                    <a href="{{ route('stock.mouvements') }}" class="btn btn-sm btn-outline-danger" name="clear" type="submit"><i class="bi bi-x-lg"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12 text-right my-4">
                @if (checkAction(Auth::id(), 'stocks_mouvements', 'create') || role() == 's_admin')
                    <button data-toggle="modal" data-target="#addNew" type="button" class="secondary-btn border-0 rounded shadow-none"><i class="bi bi-plus-square"></i> Ajouter Entrée/Sortie</button>
                @else
                    <button type="button" class="secondary-btn border-0 rounded shadow-none"> <span class="novecologie-icon-lock py-1"></span> Ajouter Entrée/Sortie</button>
                @endif
                <button data-toggle="modal" data-target="#filterModal" type="button" class="secondary-btn border-0 rounded shadow-none mx-3">+ {{ __('Add filter') }}</button>
            </div>
            <div class="col-12" >
                <div class="table-responsive simple-bar">
                    <table class="table w-100 mb-0 text-center" style="border: 2px solid black !important">
                        <thead class="database-table__header">
                            <tr>
                                @if ($header_filter->count() > 0)
                                    @foreach ($header_filter as $filter)
                                        <td  style="background-color: #2F5597; {{ $filter->getHeader->header != 'Détails' ? 'border: 2px solid black !important':'' }}; {{ $filter->getHeader->header == 'Produit' ? 'width:20%;':'' }}" class="text-white text-center">
                                            @if ($filter->getHeader->header == 'Enlèvement_Retour_par')
                                                Enlèvement/Retour par
                                            @else
                                                {{ str_replace('_', ' ', $filter->getHeader->header) }}
                                            @endif
                                        </td>
                                    @endforeach
                                @else
                                    @foreach ($headers as $header)
                                        <td  style="background-color: #2F5597; {{ $header->header != 'Détails' ? 'border: 2px solid black !important':'' }}; {{ $header->header == 'Produit' ? 'width:20%;':'' }}" class="text-white text-center">
                                            @if ($header->header == 'Enlèvement_Retour_par')
                                                Enlèvement/Retour par
                                            @else
                                                {{ str_replace('_', ' ', $header->header) }}
                                            @endif
                                        </td>
                                    @endforeach
                                @endif
                                {{-- <td style="background-color: #2F5597; border: 2px solid black !important" class="text-white text-center">PRODUIT</td>
                                <td style="background-color: #2F5597; border: 2px solid black !important" class="text-white text-center">DATE</td>
                                <td style="background-color: #2F5597; border: 2px solid black !important" class="text-white text-center">MOUVEMENT</td>
                                <td style="background-color: #07080b; border: 2px solid black !important" class="text-white text-center">TYPE</td>
                                <td style="background-color: #2F5597; border: 2px solid black !important" class="text-white text-center">ENTREPOT</td>
                                <td style="background-color: #2F5597; border: 2px solid black !important" class="text-white text-center">Quantité</td>
                                <td style="background-color: #2F5597; border: 2px solid black !important" class="text-white text-center">Enlèvement/Retour par</td>
                                <td style="background-color: #2F5597;" class="text-white text-center">Détail</td>  --}}
                            </tr>
                        </thead> 
                        <tbody class="database-table__body database-table__body--no-border"> 
                            @if ($header_filter->count() > 0)
                                @forelse ($mouvements as $mouvement)
                                    {{-- <tr class="border-0">  
                                        @foreach ($header_filter as $filter) --}}
                                            {{-- @if ($filter->getHeader->header == 'Produit')
                                                <td class="text-center" style="border: 2px solid black !important">{{ $mouvement->product->reference ?? '' }}</td>
                                            @endif
                                            @if ($filter->getHeader->header == 'Date')
                                                <td class="text-center" style="background-color: #{{ $mouvement->mouvement == 'Entrée' ? 'C5E0B4':'EDB6A7' }};">{{ \Carbon\Carbon::parse($mouvement->date)->format('d-m-Y') }}</td>
                                            @endif
                                            @if ($filter->getHeader->header == 'Mouvement')
                                                <td class="text-center" style="background-color: #{{ $mouvement->mouvement == 'Entrée' ? 'C5E0B4':'EDB6A7' }};">{{ $mouvement->mouvement }}</td>
                                            @endif
                                            @if ($filter->getHeader->header == 'Type_Mouvement')
                                                <td class="text-center" style="background-color: #{{ $mouvement->mouvement == 'Entrée' ? 'C5E0B4':'EDB6A7' }};">{{ $mouvement->natureMouvement->name ?? '' }}</td> 
                                            @endif
                                            @if ($filter->getHeader->header == 'Entrepôt')
                                                <td class="text-center" style="background-color: #{{ $mouvement->mouvement == 'Entrée' ? 'C5E0B4':'EDB6A7' }};">{{ $mouvement->entrepot->name ?? '' }}</td> 
                                            @endif
                                            @if ($filter->getHeader->header == 'Quantité')
                                                <td class="text-center" style="background-color: #{{ $mouvement->mouvement == 'Entrée' ? 'C5E0B4':'EDB6A7' }};">{{ $mouvement->products->sum('quantity') }}</td> 
                                            @endif
                                            @if ($filter->getHeader->header == 'Enlèvement_Retour_par')
                                                <td class="text-center" style="background-color: #{{ $mouvement->mouvement == 'Entrée' ? 'C5E0B4':'EDB6A7' }};">{{ $mouvement->user->name ?? '' }}</td> 
                                            @endif
                                            @if ($filter->getHeader->header == 'Détails') 
                                                <td class="text-center">
                                                    <a href="{{ route('stock.mouvement.details', $mouvement->id) }}" class="primary-btn primary-btn--blue w-auto d-inline-flex justify-content-center align-items-center rounded px-4">
                                                        {{ __('Update') }}
                                                    </a>
                                                </td> 
                                            @endif --}}
                                            @foreach ($mouvement->products as $product_key => $product)
                                                <tr class="border-0"> 
                                                    @foreach ($header_filter as $filter)
                                                        @if ($product_key == 0)  
                                                            @if ($filter->getHeader->header == 'Produit')
                                                                <td class="text-center" style="border-left: 2px solid black !important; border-right: 2px solid black !important;
                                                                    @if($loop->parent->first)
                                                                        border-top: 2px solid black;
                                                                    @else
                                                                        border-top: 0 !important;
                                                                    @endif
                                                                    @if($loop->parent->last)
                                                                        border-bottom: 2px solid black;
                                                                    @else
                                                                        border-bottom:0 !important;
                                                                    @endif
                                                                ">{{ $product->product->reference ?? '' }}</td>
                                                            @endif
                                                            @if ($filter->getHeader->header == 'Date')
                                                                <td class="text-center" style="background-color: #{{ $mouvement->mouvement == 'Entrée' ? 'C5E0B4':'EDB6A7' }};">{{ \Carbon\Carbon::parse($mouvement->date)->format('d-m-Y') }}</td>
                                                            @endif
                                                            @if ($filter->getHeader->header == 'Mouvement')
                                                                <td class="text-center" style="background-color: #{{ $mouvement->mouvement == 'Entrée' ? 'C5E0B4':'EDB6A7' }};">{{ $mouvement->mouvement }}</td>
                                                            @endif
                                                            @if ($filter->getHeader->header == 'Type_Mouvement')
                                                                <td class="text-center" style="background-color: #{{ $mouvement->mouvement == 'Entrée' ? 'C5E0B4':'EDB6A7' }};">{{ $mouvement->natureMouvement->name ?? '' }}</td> 
                                                            @endif
                                                            @if ($filter->getHeader->header == 'Entrepôt')
                                                                <td class="text-center" style="background-color: #{{ $mouvement->mouvement == 'Entrée' ? 'C5E0B4':'EDB6A7' }};">{{ $mouvement->entrepot->name ?? '' }}</td> 
                                                            @endif
                                                            @if ($filter->getHeader->header == 'Quantité')
                                                                <td class="text-center" style="background-color: #{{ $mouvement->mouvement == 'Entrée' ? 'C5E0B4':'EDB6A7' }};">{{ $product->quantity }}</td> 
                                                            @endif
                                                            @if ($filter->getHeader->header == 'Enlèvement_Retour_par')
                                                                <td class="text-center" style="background-color: #{{ $mouvement->mouvement == 'Entrée' ? 'C5E0B4':'EDB6A7' }};">{{ $mouvement->user->name ?? '' }}</td> 
                                                            @endif
                                                            @if ($filter->getHeader->header == 'Détails') 
                                                                <td class="text-center">
                                                                    <a href="{{ route('stock.mouvement.details', $mouvement->id) }}" class="primary-btn primary-btn--blue w-auto d-inline-flex justify-content-center align-items-center rounded px-4">
                                                                        {{ __('Update') }}
                                                                    </a>
                                                                </td> 
                                                            @endif
                                                        @else
                                                            @if ($filter->getHeader->header == 'Produit')
                                                                <td class="text-center" style="border-left: 2px solid black !important; border-right: 2px solid black !important;
                                                                    @if($loop->parent->first)
                                                                        border-top: 2px solid black;
                                                                    @else
                                                                        border-top: 0 !important;
                                                                    @endif
                                                                    @if($loop->parent->last)
                                                                        border-bottom: 2px solid black;
                                                                    @else
                                                                        border-bottom:0 !important;
                                                                    @endif
                                                                ">{{ $product->product->reference ?? '' }}</td>
                                                            @endif
                                                            @if ($filter->getHeader->header == 'Date')
                                                                <td class="text-center" style="background-color: #{{ $mouvement->mouvement == 'Entrée' ? 'C5E0B4':'EDB6A7' }};"></td>
                                                            @endif
                                                            @if ($filter->getHeader->header == 'Mouvement')
                                                                <td class="text-center" style="background-color: #{{ $mouvement->mouvement == 'Entrée' ? 'C5E0B4':'EDB6A7' }};"></td>
                                                            @endif
                                                            @if ($filter->getHeader->header == 'Type_Mouvement')
                                                                <td class="text-center" style="background-color: #{{ $mouvement->mouvement == 'Entrée' ? 'C5E0B4':'EDB6A7' }};"></td> 
                                                            @endif
                                                            @if ($filter->getHeader->header == 'Entrepôt')
                                                                <td class="text-center" style="background-color: #{{ $mouvement->mouvement == 'Entrée' ? 'C5E0B4':'EDB6A7' }};"></td> 
                                                            @endif
                                                            @if ($filter->getHeader->header == 'Quantité')
                                                                <td class="text-center" style="background-color: #{{ $mouvement->mouvement == 'Entrée' ? 'C5E0B4':'EDB6A7' }};">{{ $product->quantity }}</td> 
                                                            @endif 
                                                            @if ($filter->getHeader->header == 'Enlèvement_Retour_par')
                                                                <td class="text-center" style="background-color: #{{ $mouvement->mouvement == 'Entrée' ? 'C5E0B4':'EDB6A7' }};"></td> 
                                                            @endif
                                                            @if ($filter->getHeader->header == 'Détails') 
                                                                <td class="text-center"></td> 
                                                            @endif
                                                        @endif
                                                    @endforeach 
                                                </tr> 
                                            @endforeach 
                                        {{-- @endforeach   
                                    </tr> --}}
                                @empty
                                    <tr class="border-0">
                                        <td colspan="12">
                                            <h1 class="text-center py-3">No record found</h1>
                                        </td>
                                    </tr>
                                @endforelse 
                            @else
                                @forelse ($mouvements as $mouvement)
                                    @foreach ($mouvement->products as $product_key => $product)
                                        <tr class="border-0">  
                                            @if ($product_key == 0)
                                                <td class="text-center" style="border-left: 2px solid black !important; border-right: 2px solid black !important;
                                                    @if($loop->first)
                                                        border-top: 2px solid black;
                                                    @else
                                                        border-top: 0 !important;
                                                    @endif
                                                    @if($loop->last)
                                                        border-bottom: 2px solid black;
                                                    @else
                                                        border-bottom:0 !important;
                                                    @endif
                                                ">{{ $product->product->reference ?? '' }}</td>
                                                <td class="text-center" style="background-color: #{{ $mouvement->mouvement == 'Entrée' ? 'C5E0B4':'EDB6A7' }};">{{ \Carbon\Carbon::parse($mouvement->date)->format('d-m-Y') }}</td>
                                                <td class="text-center" style="background-color: #{{ $mouvement->mouvement == 'Entrée' ? 'C5E0B4':'EDB6A7' }};">{{ $mouvement->mouvement }}</td>
                                                <td class="text-center" style="background-color: #{{ $mouvement->mouvement == 'Entrée' ? 'C5E0B4':'EDB6A7' }};">{{ $mouvement->natureMouvement->name ?? '' }}</td> 
                                                <td class="text-center" style="background-color: #{{ $mouvement->mouvement == 'Entrée' ? 'C5E0B4':'EDB6A7' }};">{{ $mouvement->entrepot->name ?? '' }}</td> 
                                                <td class="text-center" style="background-color: #{{ $mouvement->mouvement == 'Entrée' ? 'C5E0B4':'EDB6A7' }};">{{ $product->quantity }}</td> 
                                                <td class="text-center" style="background-color: #{{ $mouvement->mouvement == 'Entrée' ? 'C5E0B4':'EDB6A7' }};">{{ $mouvement->user->name ?? '' }}</td> 
                                                <td class="text-center">
                                                    <a href="{{ route('stock.mouvement.details', $mouvement->id) }}" class="primary-btn primary-btn--blue w-auto d-inline-flex justify-content-center align-items-center rounded px-4">
                                                        {{ __('Update') }}
                                                    </a>
                                                </td> 
                                            @else
                                                <td class="text-center" 
                                                    style="
                                                    border-left: 2px solid black !important; border-right: 2px solid black !important;
                                                    @if($loop->first)
                                                        border-top: 2px solid black;
                                                    @else
                                                        border-top: 0 !important;
                                                    @endif
                                                    @if($loop->last)
                                                        border-bottom: 2px solid black;
                                                    @else
                                                        border-bottom:0 !important;
                                                    @endif
                                                    "
                                                >{{ $product->product->reference ?? '' }}</td>
                                                <td class="text-center" style="background-color: #{{ $mouvement->mouvement == 'Entrée' ? 'C5E0B4':'EDB6A7' }};" colspan="4"></td>
                                                <td class="text-center" style="background-color: #{{ $mouvement->mouvement == 'Entrée' ? 'C5E0B4':'EDB6A7' }};">{{ $product->quantity }}</td> 
                                                <td class="text-center" style="background-color: #{{ $mouvement->mouvement == 'Entrée' ? 'C5E0B4':'EDB6A7' }};"></td>
                                                <td class="text-center"></td>
                                            @endif
                                        </tr> 
                                    @endforeach 
                                @empty
                                    <tr class="border-0">
                                        <td colspan="12">
                                            <h1 class="text-center py-3">No record found</h1>
                                        </td>
                                    </tr>
                                @endforelse
                                {{-- <tr class="border-0"> 
                                    <td class="text-center" style="border: 2px solid black !important">PRODUIT 2</td>
                                    <td class="text-center" style="background-color: #EDB6A7;">DATE OF ENTREE</td>
                                    <td class="text-center" style="background-color: #EDB6A7;">SORTIE</td>
                                    <td class="text-center" style="background-color: #EDB6A7;">TYPE IN STOCK SETTING</td> 
                                    <td class="text-center" style="background-color: #EDB6A7;">ENTREPOT</td> 
                                    <td class="text-center" style="background-color: #EDB6A7;">QUANTITY</td> 
                                    <td class="text-center" style="background-color: #EDB6A7;">TECHNICIEN</td> 
                                    <td class="text-center">
                                        <a href="#!" class="primary-btn primary-btn--blue w-auto d-inline-flex justify-content-center align-items-center rounded px-4">
                                            {{ __('Update') }}
                                        </a>
                                    </td> 
                                </tr>    --}}
                            @endif 
                            {{--  <tr class="border-0">  
                                <td class="text-center" style="border: 2px solid black !important">PRODUIT 1</td>
                                <td class="text-center" style="background-color: #C5E0B4;">DATE OF ENTREE</td>
                                <td class="text-center" style="background-color: #C5E0B4;">ENTREE</td>
                                <td class="text-center" style="background-color: #C5E0B4;">TYPE IN STOCK SETTING</td> 
                                <td class="text-center" style="background-color: #C5E0B4;">ENTREPOT</td> 
                                <td class="text-center" style="background-color: #C5E0B4;">QUANTITY</td> 
                                <td class="text-center" style="background-color: #C5E0B4;">TECHNICIEN</td> 
                                <td class="text-center">
                                    <a href="{{ route('stock.mouvement.details', 0) }}" class="primary-btn primary-btn--blue w-auto d-inline-flex justify-content-center align-items-center rounded px-4">
                                        {{ __('Update') }}
                                    </a>
                                </td> 
                            </tr>
                            <tr class="border-0"> 
                                <td class="text-center" style="border: 2px solid black !important">PRODUIT 2</td>
                                <td class="text-center" style="background-color: #EDB6A7;">DATE OF ENTREE</td>
                                <td class="text-center" style="background-color: #EDB6A7;">SORTIE</td>
                                <td class="text-center" style="background-color: #EDB6A7;">TYPE IN STOCK SETTING</td> 
                                <td class="text-center" style="background-color: #EDB6A7;">ENTREPOT</td> 
                                <td class="text-center" style="background-color: #EDB6A7;">QUANTITY</td> 
                                <td class="text-center" style="background-color: #EDB6A7;">TECHNICIEN</td> 
                                <td class="text-center">
                                    <a href="{{ route('stock.mouvement.details', 0) }}" class="primary-btn primary-btn--blue w-auto d-inline-flex justify-content-center align-items-center rounded px-4">
                                        {{ __('Update') }}
                                    </a>
                                </td> 
                            </tr>   
                            <tr class="border-0">  
                                <td class="text-center" style="border: 2px solid black !important">PRODUIT 1</td>
                                <td class="text-center" style="background-color: #C5E0B4;">DATE OF ENTREE</td>
                                <td class="text-center" style="background-color: #C5E0B4;">ENTREE</td>
                                <td class="text-center" style="background-color: #C5E0B4;">TYPE IN STOCK SETTING</td> 
                                <td class="text-center" style="background-color: #C5E0B4;">ENTREPOT</td> 
                                <td class="text-center" style="background-color: #C5E0B4;">QUANTITY</td> 
                                <td class="text-center" style="background-color: #C5E0B4;">TECHNICIEN</td> 
                                <td class="text-center">
                                    <a href="{{ route('stock.mouvement.details', 0) }}" class="primary-btn primary-btn--blue w-auto d-inline-flex justify-content-center align-items-center rounded px-4">
                                        {{ __('Update') }}
                                    </a>
                                </td> 
                            </tr>
                            <tr class="border-0"> 
                                <td class="text-center" style="border: 2px solid black !important">PRODUIT 2</td>
                                <td class="text-center" style="background-color: #EDB6A7;">DATE OF ENTREE</td>
                                <td class="text-center" style="background-color: #EDB6A7;">SORTIE</td>
                                <td class="text-center" style="background-color: #EDB6A7;">TYPE IN STOCK SETTING</td> 
                                <td class="text-center" style="background-color: #EDB6A7;">ENTREPOT</td> 
                                <td class="text-center" style="background-color: #EDB6A7;">QUANTITY</td> 
                                <td class="text-center" style="background-color: #EDB6A7;">TECHNICIEN</td> 
                                <td class="text-center">
                                    <a href="{{ route('stock.mouvement.details', 0) }}" class="primary-btn primary-btn--blue w-auto d-inline-flex justify-content-center align-items-center rounded px-4">
                                        {{ __('Update') }}
                                    </a>
                                </td> 
                            </tr>    --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div> 
    </div>
@endsection

@section('modal-content')
    <!-- Right Aside Modal -->
    <div class="modal modal--aside fade rightAsideModal" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog m-0 h-100 bg-white">
            <div class="modal-content border-0 h-100 rounded-0 simple-bar">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
                        <span class="novecologie-icon-close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <h1 class="modal-title text-center">{{ __('Additional filters') }}</h1> 
                    <form action="{{ route('stock.mouvement.header.filter') }}" class="form" id="clientsValidateForm" method="POST">
                        @csrf 
                        <h2 class="modal-sub-title position-relative">Filtres</h2>
                        <div class="row">
                            @foreach ($headers as $key => $header) 
                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox"  class="custom-control-input" value="{{ $header->id }}" id="lead_tracking-{{ $key }}" name="header_id[]"
                                            @if ($header_filter->count() > 0)
                                                @foreach ($header_filter as $item)
                                                    @if ( $header->id == $item->header_id)
                                                        checked
                                                    @endif
                                                @endforeach
                                            @else 
                                                checked 
                                            @endif
                                        >
                                        <label class="custom-control-label" for="lead_tracking-{{ $key }}">
                                            @if ($header->header == 'Enlèvement_Retour_par')
                                                Enlèvement/Retour par
                                            @else
                                                {{ $header->header }}
                                            @endif
                                        </label>
                                    </div>
                                </div> 
                            @endforeach 
                        </div> 
                        <div class="row">
                            <div class="col text-center">
                                <button type="submit" class="secondary-btn primary-btn--md border-0 mt-4">{{ __('Filter') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
                        <h1 class="modal-title text-center mb-3">Nouvelle Entrée / Sortie</h1>
                        {{-- <div class="d-flex align-items-center">
                            <div class="ml-auto">
                                <ul class="nav nav-pills nav-pills--horizontal d-inline-block my-3" id="pills-tab" role="tablist" style="border: 2px solid #2F528F; border-radius: 7px;"> 
                                    <li class="nav-item d-inline-block" role="presentation">
                                        <a class="nav-link active px-4 py-1" id="pills-two-tab" data-toggle="pill" href="#pills-two" role="tab" aria-controls="pills-two" aria-selected="true">Détails</a>
                                    </li>  
                                    <li class="nav-item d-inline-block" role="presentation">
                                        <a class="nav-link px-4 py-1" id="pills-one-tab" data-toggle="pill" href="#pills-one" role="tab" aria-controls="pills-one" aria-selected="false">Activité</a>
                                    </li>  
                                </ul> 
                            </div>
                        </div> --}}
                        <form action="{{ route('stock.mouvement.create') }}" class="form" method="post" enctype="multipart/form-data">
                            @csrf
                            {{-- <div class="form-group">
                                <label for="#">Produit : <span class="text-danger">*</span></label>
                                <select class="select2_select_option form-control" name="product_id" required>
                                    <option value="">{{ __('Select') }}</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->reference }}</option>
                                    @endforeach
                                </select>
                            </div>  --}}
                            
                            <label class=" mt-4" for="#">Produits : <span class="text-danger">*</span></label>
                            <div class="table-responsive">
                                <table class="table w-100 mb-0 text-center" style="border: 2px solid black !important"> 
                                    <tbody class="database-table__body database-table__body--mouvement" id="mouvementTbody"> 
                                         <tr>
                                            <td class="select2-selection--no-border table--td" style="padding: 3px;">
                                                <select class="select2_select_option form-control shadow-none" name="product[]" required>
                                                    <option value="" selected disabled>Produit</option>
                                                    @foreach ($products as $product)
                                                        <option value="{{ $product->id }}">{{ $product->reference }}</option>
                                                    @endforeach
                                                </select>  
                                            </td>
                                            <td class="table--td" style="padding: 3px;"><input type="number" min="1" name="quantity[]" class="form-control text-center shadow-none border-0 mouvement-product-quantity" required></td>
                                         </tr> 
                                    </tbody>
                                </table>
                            </div>
                            <button type="button" id="mouvementAddNew" class="secondary-btn border-0 rounded shadow-none my-3"><i class="bi bi-plus-square"></i> Ajouter un nouveau produit</button>
                            <div class="table-responsive  mb-4">
                                <table class="table w-100 mb-0 text-center" style="border: 2px solid black !important; background-color: #D9D9D9"> 
                                    <tbody class="database-table__body"> 
                                         <tr>
                                            <td class="table--td">TOTAL</td>
                                            <td class="table--td" id="totalQuantity">0</td>
                                         </tr> 
                                    </tbody>
                                </table>
                            </div> 
                            {{-- <div class="form-group">
                                <label for="#">Quantité : <span class="text-danger">*</span></label> 
                                <input type="number" min="1" name="quantity" class="form-control shadow-none rounded" required>
                            </div>  --}}
                            <div class="form-group">
                                <label for="#">Mouvement : <span class="text-danger">*</span></label>
                                <select class="select2_color_option form-control" name="mouvement" required>
                                    <option value="" selected disabled>{{ __('Select') }}</option>
                                    <option data-color="#385621" data-background="#C5E0B5" value="Entrée">Entrée</option>
                                    <option data-color="#BF0000" data-background="#EBB6A6" value="Sortie">Sortie</option>
                                </select>
                            </div> 
                            <div class="form-group">
                                <label for="#">Date : <span class="text-danger">*</span></label>
                                <input type="date" name="date" value="{{ \Carbon\Carbon::today() }}" class="flatpickr form-control shadow-none rounded" required>
                            </div>
                            <div class="form-group">
                                <label for="#">Nom du chantier : <span class="text-danger">*</span></label>
                                <select class="select2_select_option form-control" name="project_id" required>
                                    <option value="">{{ __('Select') }}</option>
                                    @foreach ($projects as $project)
                                        <option value="{{$project->id }}">{{ $project->Prenom.' '.$project->Nom }}</option>
                                    @endforeach
                                </select>
                            </div> 
                            <div class="form-group">
                                <label for="#">Nature mouvement : <span class="text-danger">*</span></label>
                                <select class="select2_select_option form-control" name="mouvement_id" required>
                                    <option value="">{{ __('Select') }}</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div> 
                            <div class="form-group">
                                <label for="#">Entrepôt : <span class="text-danger">*</span></label>
                                <select class="select2_select_option form-control" name="entrepot_id" required>
                                    <option value="">{{ __('Select') }}</option>
                                    @foreach ($entrepots as $entrepot)
                                        <option value="{{ $entrepot->id }}">{{ $entrepot->name }}</option>
                                    @endforeach
                                </select>
                            </div> 
                            <div class="form-group">
                                <label for="#">Enlèvement/Retour par : <span class="text-danger">*</span></label>
                                <select class="select2_select_option form-control" name="user_id" required>
                                    <option value="">{{ __('Select') }}</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div> 
                            <div class="form-group">
                                <label for="#">Plaque immatriculation :</label>
                                <textarea name="plaque_immatriculation" id="plaque_immatriculation" class="form-control"></textarea>
                            </div> 
                            <div class="form-group">
                                <label for="#">Réception/Servi par : <span class="text-danger">*</span></label>
                                <select class="select2_select_option form-control" name="personnel_autorise_id" required>
                                    <option value="">{{ __('Select') }}</option>
                                    @foreach ($receptions as $reception)
                                        <option value="{{ $reception->id }}">{{ $reception->name }}</option>
                                    @endforeach
                                </select>
                            </div> 
                            <div class="form-group">
                                <input type="file" hidden name="bon_de_livraison"  id="BonDeLivraison">
                                <label for="#">Bon de livraison :</label>
                                <div class="d-flex align-items-center border px-2 rounded" style="background-color: #f2f2f2">
                                    <h3 class="mr-auto mb-0">
                                        <strong>Insérer le bon de livraison :</strong>
                                    </h3>
                                    <label for="BonDeLivraison" tabindex="0" class="btn p-2 shadow-none subvention_disabled mb-0" role="button"><i class="bi bi-upload px-2 py-1"></i></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="#">Observations :</label>
                                <textarea name="observation" id="observation" class="form-control"></textarea>
                            </div> 
                            <div class="form-group text-center">
                                <button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill border-0 my-5">
                                    {{ __('Submit') }}
                                </button>
                            </div> 
                            {{-- <div class="tab-content" id="pills-tabContent"> 
                                <div class="tab-pane fade" id="pills-one" role="tabpanel" aria-labelledby="pills-one-tab"> 
                                    <div class="row"> 
                                    </div>
                                </div> 
                                <div class="tab-pane fade show active" id="pills-two" role="tabpanel" aria-labelledby="pills-two-tab">  
                                    
                                </div>  
                            </div> --}}
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
            $('.mouvement-product-quantity').each(function(){
                totalQuantity += +$(this).val();
            });

            $('#totalQuantity').text(totalQuantity);
        }

        $(document).ready(function(){
            $('#mouvementAddNew').on('click', function(){
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
                            <input type="number" min="1" name="quantity[]" class="form-control text-center shadow-none border-0 mouvement-product-quantity" required>
                            <button type="button" class="btn btn-sm btn-outline-danger mouvementTrRemove shadow-none"><i class="bi bi-x-lg"></i></button>
                        </div>
                    </td>
                </tr>
                `;
                $('#mouvementTbody').append($data); 
                
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

            $('body').on('click', '.mouvementTrRemove', function(){
                $(this).closest('tr').slideUp(function(){
                    $(this).remove();
                    totalQuantity()
                });
            });

            $("body").on('input', '.mouvement-product-quantity', function(){
               totalQuantity()
            }); 
        });

    </script>
@endpush