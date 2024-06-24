@extends('admin.stocks.layouts')

@section('CommandesActive', 'active_sidbar') 
@push('css_style')
	 <style>
        .font_30{
            font-size: 30px;
        }
        .select2-selection--no-border span.select2-selection.select2-selection--single {
            outline: none;
            border: 0;
        }

       .database-table__body--commande tr td:last-child {
            padding-right: 3px !important;
        }

        .table--td{
            border: 2px solid black !important; 
            width: 50% !important;
        }

	 </style>
@endpush

@section('tab-content')
    <div class="tab-pane fade show active" id="v-pills-documentControl" role="tabpanel" aria-labelledby="v-pills-documentControl-tab"> 
        <div class="row"> 
            <div class="col-12">
                <form class="bg-white px-3 pt-3 border rounded-lg" action="{{ route('stock.commande.filter') }}">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Fournisseur</label>
                                <select class="select2_select_option shadow-none form-control" name="fournisseur_"> 
                                    <option value="" selected>Sélectionnez</option>
                                    @foreach ($fournisseurs as $fournisseur)
                                        <option {{ request()->fournisseur_ == $fournisseur->id ? 'selected':'' }} value="{{ $fournisseur->id }}">{{ $fournisseur->name }}</option>
                                    @endforeach 
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="statut">Statut </label>
                                <select class="select2_select_option shadow-none form-control" id="statut" name="statut">
                                    <option value="" selected>Sélectionnez</option> 
                                    @foreach ($statuts as $statut)
                                        <option value="{{ $statut->id }}" {{request()->statut == $statut->id ? 'selected':'' }}>{{ $statut->name }}</option>
                                    @endforeach
                                </select> 
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Référence commande</label>
                                <input type="text" name="reference_commande" value="{{ request()->reference_commande }}" class="form-control shadow-none">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Type de livraison</label>
                                <select name="type_de_livraison" class="select2_select_option custom-select shadow-none form-control">
                                    <option value="" selected>Sélectionnez</option> 
                                    @foreach ($livraisons as $livraison)
                                        <option {{ request()->type_de_livraison == $livraison->id ? 'selected':'' }} value="{{ $livraison->id }}">{{ $livraison->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Enlèvement par</label>
                                <select name="enlevement_par" class="select2_select_option custom-select shadow-none form-control">
                                    <option value="" selected>Sélectionnez</option> 
                                    @foreach ($receptions as $reception)
                                        <option {{ request()->enlevement_par == $reception->id ? 'selected':'' }} value="{{ $reception->id }}">{{ $reception->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Reçu par </label>
                                <select name="recu_par" class="select2_select_option custom-select shadow-none form-control">
                                    <option value="" selected>Sélectionnez</option> 
                                    @foreach ($receptions as $reception)
                                        <option {{ request()->recu_par == $reception->id ? 'selected':'' }} value="{{ $reception->id }}">{{ $reception->name }}</option>
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
                        <div class="col-lg-3 col-md-6 ml-auto mt-3 d-flex align-items-center justify-content-end">
                            <div class="form-group">
                                <button type="submit" class="ticket-main__chat-card__send-btn">
                                    Valider
                                </button>
                                @if (\Request::route()->getName() == 'stock.commande.filter')
                                    <a href="{{ route('stock.commandes') }}" class="btn btn-sm btn-outline-danger" name="clear" type="submit"><i class="bi bi-x-lg"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12 text-right my-4">
                @if (checkAction(Auth::id(), 'stocks_commandes', 'create') || role() == 's_admin')
                    <button data-toggle="modal" data-target="#addNew" type="button" class="secondary-btn border-0 rounded shadow-none mr-3"><i class="bi bi-plus-square"></i> Ajouter Commande</button>
                @else
                    <button type="button" class="secondary-btn border-0 rounded shadow-none"> <span class="novecologie-icon-lock py-1"></span> Ajouter Commande</button>
                @endif
                {{-- <button data-toggle="modal" data-target="#filterModal" type="button" class="secondary-btn border-0 rounded shadow-none mx-3">+ {{ __('Add filter') }}</button> --}}
            </div>
            <div class="col-12" >
                <div class="table-responsive simple-bar">
                    <table class="table database-table w-100 mb-0 text-center">
                        <thead class="database-table__header">
                            <tr>
                                <td style="background-color: #2F5597; border: 2px solid white !important" class="text-white text-center">Numéro commande</td>
                                <td style="background-color: #2F5597; border: 2px solid white !important" class="text-white text-center">Fournisseur</td> 
                                <td style="background-color: #2F5597; border: 2px solid white !important" class="text-white text-center">STATUT</td> 
                                <td style="background-color: #2F5597; border: 2px solid white !important" class="text-white text-center">Bon de Commande</td> 
                                <td style="background-color: #2F5597; border: 2px solid white !important" class="text-white text-center">Bon de Livraison</td>  
                                <td style="background-color: #2F5597; border: 2px solid white !important" class="text-white text-center">Détails</td>
                            </tr>
                        </thead>
                        <tbody class="database-table__body"> 
                            @forelse ($commandes as $commande)
                                <tr> 
                                    <td class="text-center">COMMANDE {{ $commande->id }}</td>
                                    <td class="text-center">{{ $commande->fournisseur->name ?? '' }}</td>
                                    <td class="text-center">
                                        <button style="background-color: {{ $commande->statut->background_color }}; color: {{ $commande->statut->text_color }};" type="button" data-commande-id="{{ $commande->id }}" data-statut-id="{{ $commande->statut_id }}" class="primary-btn rounded-pill border-0 py-1 px-4 statutUpdateBtn">
                                            {{ $commande->statut->name ?? '' }}
                                        </button>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('stock.commande.pdf', $commande->id) }}" target="_blank" class="btn shadow-none font_30">
                                            <i class="bi bi-file-earmark-pdf"></i>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        @if ($commande->bon_de_livraison)
                                            <a href="{{ asset('uploads/stock') }}/{{ $commande->bon_de_livraison }}" target="_blank" class="btn shadow-none font_30">
                                                <i class="bi bi-file-earmark-pdf"></i>
                                            </a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('stock.commande.details', $commande->id) }}" class="primary-btn primary-btn--blue w-auto d-inline-flex justify-content-center align-items-center rounded px-4">
                                            {{ __('Update') }}
                                        </a>
                                    </td> 
                                </tr> 
                            @empty
                                <tr>
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
@endsection

@section('modal-content')
    <!-- Right Aside Modal -->
    {{-- <div class="modal modal--aside fade rightAsideModal" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog m-0 h-100 bg-white">
            <div class="modal-content border-0 h-100 rounded-0 simple-bar">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
                        <span class="novecologie-icon-close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <h1 class="modal-title text-center">{{ __('Additional filters') }}</h1> 
                    <form action="{{ route('stock.commande.header.filter') }}" class="form" id="clientsValidateForm" method="POST">
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
                                            {{ str_replace('_', ' ', $header->header) }}
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
    </div> --}}
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
                        <h1 class="modal-title text-center mb-3">Nouvelle Commande</h1>
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
                        <form action="{{ route('stock.commande.create') }}" class="form" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="#">Numéro de commande :
                                            <strong>
                                                @if ($commandes->count() > 0)
                                                    Commande {{ $commandes->first()->id + 1 }}
                                                @else
                                                    Commande 1
                                                @endif
                                            </strong>
                                        </label> 
                                    </div> 
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="#">Statut : <span class="text-danger">*</span></label>
                                        <select class="select2_select_option form-control" name="statut_id" required>
                                            <option value="" selected disabled>{{ __('Select') }}</option>
                                            @foreach ($statuts as $statut)
                                                <option value="{{ $statut->id }}">{{ $statut->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>  
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="#">Date de commande : <span class="text-danger">*</span></label>
                                        <input type="date" name="date" value="{{ \Carbon\Carbon::today() }}" class="flatpickr form-control shadow-none rounded" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="#">Référence commande  :</label>
                                        <textarea name="reference_commande" id="reference_commande" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
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
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="#">Fournisseur : <span class="text-danger">*</span></label>
                                        <select class="select2_select_option form-control" name="fournisseur_id" required>
                                            <option value="" selected disabled>{{ __('Select') }}</option>
                                            @foreach ($fournisseurs as $fournisseur)
                                                <option value="{{ $fournisseur->id }}">{{ $fournisseur->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>  
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="#">Type de livraison : <span class="text-danger">*</span></label>
                                        <select class="select2_select_option form-control" name="type_de_livraison_id" required>
                                            <option value="" selected disabled>{{ __('Select') }}</option>
                                            @foreach ($livraisons as $livraison)
                                                <option value="{{ $livraison->id }}">{{ $livraison->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>  
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="#">Enlèvement par : <span class="text-danger">*</span></label>
                                        <select class="select2_select_option form-control" name="enlevement_par_id" required>
                                            <option value="" selected disabled>{{ __('Select') }}</option>
                                            @foreach ($receptions as $reception)
                                                <option value="{{ $reception->id }}">{{ $reception->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>  
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="#">Reçu par : <span class="text-danger">*</span></label>
                                        <select class="select2_select_option form-control" name="recu_par_id" required>
                                            <option value="" selected disabled>{{ __('Select') }}</option>
                                            @foreach ($receptions as $reception)
                                                <option value="{{ $reception->id }}">{{ $reception->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>  
                                </div>
                                <div class="col-12 my-4">
                                    <h2 class="text-center">Commande</h2> 
                                    <div class="table-responsive">
                                        <table class="table w-100 mb-0 text-center" style="border: 2px solid black !important"> 
                                            <tbody class="database-table__body database-table__body--commande" id="commandeTbody"> 
                                                 <tr>
                                                    <td class="select2-selection--no-border table--td" style="padding: 3px;">
                                                        <select class="select2_select_option form-control shadow-none" name="product[]" required>
                                                            <option value="" selected disabled>Produit</option>
                                                            @foreach ($products as $product)
                                                                <option value="{{ $product->id }}">{{ $product->reference }}</option>
                                                            @endforeach
                                                        </select>  
                                                    </td>
                                                    <td class="table--td" style="padding: 3px;"><input type="number" min="1" name="quantity[]" class="form-control text-center shadow-none border-0 commande-product-quantity" required></td>
                                                 </tr> 
                                            </tbody>
                                        </table>
                                    </div>
                                    <button type="button" id="commandeAddNew" class="secondary-btn border-0 rounded shadow-none my-3"><i class="bi bi-plus-square"></i> Ajouter un nouveau produit</button>
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

    <div class="modal modal--aside fade" id="statusChangeModal" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                        <span class="novecologie-icon-close"></span>
                    </button>
                </div>
                <div class="modal-body text-center pt-0">
                    <h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
                    <form action="{{ route('stock.commande.status.change') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="commande_id"> 
                        <div class="form-group text-left mt-3">
                            <label class="form-label" for="statut_id">Merci de renseigner le nouveau statut de votre commande</label>
                            <select name="statut_id" id="statut_id" class="select2_select_option custom-select shadow-none form-control">
                                <option value="" selected>{{ __('Select') }}</option> 
                                @foreach ($statuts as $statut)
                                    <option value="{{ $statut->id }}">{{ $statut->name }}</option>
                                @endforeach
                            </select>
                        </div>  
                        <button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-2">
                            {{ __('Submit') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('stockJs')
    <script>
         function totalQuantity(){
            let totalQuantity = 0;
            $('.commande-product-quantity').each(function(){
                totalQuantity += +$(this).val();
            });

            $('#totalQuantity').text(totalQuantity);
        }

        $(document).ready(function(){
            $('#commandeAddNew').on('click', function(){
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
                            <input type="number" min="1" name="quantity[]" class="form-control text-center shadow-none border-0 commande-product-quantity" required>
                            <button type="button" class="btn btn-sm btn-outline-danger commandeTrRemove shadow-none"><i class="bi bi-x-lg"></i></button>
                        </div>
                    </td>
                </tr>
                `;
                $('#commandeTbody').append($data); 
                
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

            $('body').on('click', '.commandeTrRemove', function(){
                $(this).closest('tr').slideUp(function(){
                    $(this).remove();
                    totalQuantity()
                });
            });

            $("body").on('input', '.commande-product-quantity', function(){
               totalQuantity()
            });

            $('body').on('click', '.statutUpdateBtn', function(){
                let commande = $(this).data('commande-id');
                let statut = $(this).data('statut-id'); 
                $("#statut_id").val(statut);
                $('#commande_id').val(commande);
                
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

                $("#statusChangeModal").modal('show');
            });
        });

    </script>
@endpush