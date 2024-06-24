@extends('admin.stocks.layouts')

@section('CommandesActive', 'active_sidbar') 
@push('css_style')
	 <style>
        .font_30{
            font-size: 30px;
        }
        .list-item{
            font-size: 20px;
            margin-bottom: 25px;
        }
        .stock-entree__badge{
            font-size: 20px; 
            border-radius: 5px; 
            color: #385723;
            background-color: #C5E0B4;
        }
        .stock-sortie__badge{
            font-size: 20px; 
            border-radius: 5px; 
            color: #C00000;
            background-color: #EDB6A7;
        }
        .table--td{
            border: 2px solid black !important; 
            width: 50% !important;
        }
	 </style>
@endpush

@section('tab-content')
    <div class="tab-pane fade show active" id="v-pills-documentControl" role="tabpanel" aria-labelledby="v-pills-documentControl-tab"> 
        <div class="row m-0 p-4"> 
            <div class="col-12">
                <div class="d-sm-flex align-items-center mb-4">
                    <span style="font-size: 40px">Commande {{ $commande->id }} : Détail
                        @if (checkAction(Auth::id(), 'stocks_commandes', 'edit') || role() == 's_admin')
                            <button class="btn shadow-none" style="font-size: 22px" data-toggle="modal" data-target="#editModal"><i class="bi bi-pencil-square"></i></button> 
                        @endif
                    </span>    
                    <div class="ml-auto">
                        @if (checkAction(Auth::id(), 'stocks_commandes', 'delete') || role() == 's_admin')
                            <button type="button" class="btn shadow-none ml-auto"  style="font-size: 22px"  data-toggle="modal" data-target="#deleteModal"><i class="bi bi-trash3"></i></button>
                        @endif
                        <ul class="nav nav-pills nav-pills--horizontal d-inline-block my-3" id="pills-tab" role="tablist" style="border: 2px solid #2F528F; border-radius: 7px;"> 
                            <li class="nav-item d-inline-block" role="presentation">
                                <a class="nav-link active px-4 py-1" id="pills-two-tab" data-toggle="pill" href="#pills-two" role="tab" aria-controls="pills-two" aria-selected="true">Détails</a>
                            </li>  
                            <li class="nav-item d-inline-block" role="presentation">
                                @if (checkAction(Auth::id(), 'stocks_commandes', 'activity') || role() == 's_admin')
                                    <a class="nav-link px-4 py-1" id="pills-one-tab" data-toggle="pill" href="#pills-one" role="tab" aria-controls="pills-one" aria-selected="false">Activité</a>
                                @else
                                    <a class="nav-link px-4 py-1" style=" cursor: pointer;"> <span class="novecologie-icon-lock py-1"></span> Activité</a>
                                @endif
                            </li>  
                        </ul> 
                    </div>
                </div>
                <div class="tab-content" id="pills-tabContent"> 
                    <div class="tab-pane fade" id="pills-one" role="tabpanel" aria-labelledby="pills-one-tab"> 
                        <div class="table-responsive database-table-wrapper--custom simple-bar">
                            <table class="table database-table w-100 mb-0" id="dataTables">
                                <thead class="database-table__header">
                                    <tr>
                                        <th class="text-left">
                                            {{ __('Détails') }}
                                        </th>
                                        <th>
                                        {{ __('Action') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="database-table__body" id="activity_log_wrap">
                                    @forelse ($activities as $activity) 
                                        <tr> 
                                            <td style="white-space: inherit;">  
                                                <div class="d-sm-flex align-items-center">
                                                    <a href="#!" class="avatar-group__image-wrapper d-inline-block flex-shrink-0 rounded-circle overflow-hidden mr-2 mb-2 mb-sm-0" style="width: 45px; height: 45px;" data-toggle="tooltip" data-placement="top" title="{{ getAssigneePhoto($activity->user_id)->name }}">
                                                        @if($activity->getUser->profile_photo)  
                                                        <img  loading="lazy"  src="{{ asset('uploads/crm/profiles') }}/{{ $activity->getUser->profile_photo }}" alt="avatar image" class="avatar-group__image w-100 h-100"> 
                                                        @else
                                                        <img  loading="lazy"  src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="avatar image" class="avatar-group__image w-100 h-100"> 
                                                        @endif
                                                    </a>
                                                    <div> 
                                                        <p class="mb-1">
                                                            {{ $activity->getUser->name }} mis à jour <strong> 
                                                                @if ($activity->key == 'statut_id')
                                                                    Statut 
                                                                @elseif ($activity->key == 'date')
                                                                    Date de commande
                                                                @elseif ($activity->key == 'reference_commande')
                                                                    Référence commande 
                                                                @elseif ($activity->key == 'fournisseur_id')
                                                                    Fournisseur  
                                                                @elseif ($activity->key == 'type_de_livraison_id')
                                                                    Type de livraison
                                                                @elseif ($activity->key == 'enlevement_par_id')
                                                                    Enlèvement par
                                                                @elseif ($activity->key == 'recu_par_id')
                                                                    Reçu par
                                                                @elseif ($activity->key == 'observation')
                                                                    Observations 
                                                                @else 
                                                                    {{ ucfirst($activity->key) }}
                                                                @endif
                                                            </strong>
                                                             à 
                                                             <strong>
                                                                @if ($activity->key == 'statut_id')
                                                                    {{ $activity->commandeStatut->name ?? '' }}  
                                                                @elseif ($activity->key == 'fournisseur_id')
                                                                    {{ $activity->fournisseur->name ?? '' }}  
                                                                @elseif ($activity->key == 'type_de_livraison_id')
                                                                    {{ $activity->typeDeLivraison->name ?? '' }}  
                                                                @elseif ($activity->key == 'enlevement_par_id')
                                                                    {{ $activity->personnelAutorise->name ?? '' }}  
                                                                @elseif ($activity->key == 'recu_par_id')
                                                                    {{ $activity->personnelAutorise->name ?? '' }} 
                                                                @elseif($activity->key == 'date')
                                                                    {{ \Carbon\Carbon::parse($activity->value)->format('d-m-Y') }}
                                                                @else 
                                                                    {{ $activity->value }}
                                                                @endif
                                                            </strong>
                                                        </p>
                                                        <small>{{ \Carbon\Carbon::parse($activity->created_at)->format('d-m-Y, h:i a') }}</small>
                                                    </div>
                                                </div> 
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center justify-content-around">
                                                    <div class="dropdown dropdown--custom p-0 d-inline-block">
                                                        <button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <span class="novecologie-icon-dots-horizontal-triple"></span>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
                                                            @if (role() == 's_admin')
                                                                <form action="{{ route('client.log.delete') }}" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="id" value="{{ $activity->id }}">
                                                                    <button type="submit" class="dropdown-item border-0">
                                                                        <span class="novecologie-icon-trash mr-1"></span>
                                                                        {{ __('Remove') }}
                                                                    </button> 
                                                                </form> 
                                                            @else
                                                                <div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
                                                                    <button type="button" class="dropdown-item border-0" data-toggle="tooltip" data-placement="top" title="Seulement Admin">
                                                                        <span class="novecologie-icon-lock py-1"></span>
                                                                        {{ __('Remove') }}
                                                                    </button>  
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr> 
                                    @empty
                                        <tr>
                                            <td colspan="2">
                                                <h3 class="text-center my-5">No record found</h3>
                                            </td>
                                        </tr>
                                    @endforelse 
                                </tbody>
                            </table>
                        </div>
                    </div> 
                    <div class="tab-pane fade show active" id="pills-two" role="tabpanel" aria-labelledby="pills-two-tab">  
                        <p>Statut :  
                            <button data-toggle="modal" data-target="#statusChangeModal" style="background-color:{{ $commande->statut->background_color }}; color: {{ $commande->statut->text_color }};" type="button" class="primary-btn rounded-pill border-0 py-1 px-4">
                                {{ $commande->statut->name ?? '' }}
                            </button>
                        </p>
                        <p class="d-flex align-items-center">Date de commande : {{ \Carbon\Carbon::parse($commande->date)->format('d-m-Y') }} <span class="ml-auto">Bon de commande</span> :  
                            <a href="{{ route('stock.commande.pdf', $commande->id) }}" target="_blank" class="btn shadow-none p-0 m-0">
                                <i class="bi bi-file-earmark-pdf font_30"></i>
                            </a>
                        </p>
                        <p class="d-flex align-items-center">Référence commande : {{ $commande->reference_commande }}    
                            @if ($commande->bon_de_livraison)
                                <span class="ml-auto">Bon de livraison </span> :  
                                <a href="{{ asset('uploads/stock') }}/{{ $commande->bon_de_livraison }}" target="_blank" class="btn shadow-none p-0 m-0">
                                    <i class="bi bi-file-earmark-pdf font_30"></i>
                                </a>
                            @endif
                        </p> 
                        <p>Fournisseur : {{ $commande->fournisseur->name ?? '' }}</p>
                        <p>Type de livraison : {{ $commande->typeDeLivraison->name ?? '' }}</p>
                        <p>Enlèvement par : {{ $commande->enlevementPar->name ?? '' }}</p>
                        <p>Reçu par : {{ $commande->recuPar->name ?? '' }}</p>
        
                        <div style="margin: 120px 0">
                            <h2 class="text-center">Commande</h2> 
                            <div class="table-responsive">
                                <table class="table w-100 mb-0 text-center" style="border: 2px solid black !important"> 
                                    <tbody class="database-table__body database-table__body--commande"> 
                                        @foreach ($commande->products as $commande_product)
                                            <tr>
                                                <td class="table--td">
                                                    {{ $commande_product->product->reference ?? '' }}
                                                </td>
                                                <td class="table--td">
                                                    {{ $commande_product->quantity }}
                                                </td>
                                            </tr> 
                                        @endforeach
                                    </tbody>
                                </table>
                            </div> 
                            <div class="table-responsive mt-5">
                                <table class="table w-100 mb-0 text-center" style="border: 2px solid black !important; background-color: #D9D9D9"> 
                                    <tbody class="database-table__body"> 
                                         <tr>
                                            <td class="table--td">TOTAL</td>
                                            <td class="table--td">{{ $commande->products->sum('quantity') }}</td>
                                         </tr> 
                                    </tbody>
                                </table>
                            </div> 
                        </div> 
                        <p>Observations : {{ $commande->observation }}</p> 
                    </div>  
                </div>  
            </div> 
        </div> 
    </div>
@endsection

@section('modal-content')
    <!-- Right Aside Modal -->
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
                        <input type="hidden" name="id" value="{{ $commande->id }}"> 
                        <div class="form-group text-left mt-3">
                            <label class="form-label" for="statut_id">Merci de renseigner le nouveau statut de votre commande</label>
                            <select name="statut_id" id="statut_id" class="select2_select_option custom-select shadow-none form-control">
                                <option value="" selected>{{ __('Select') }}</option> 
                                @foreach ($statuts as $statut)
                                    <option value="{{ $statut->id }}" {{ $commande->statut_id == $statut->id ? 'selected':'' }}>{{ $statut->name }}</option>
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
    <div class="modal modal--aside fade rightAsideModal" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog m-0 h-100 bg-white">
            <div class="modal-content border-0 h-100 rounded-0 simple-bar">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
                        <span class="novecologie-icon-close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <h1 class="modal-title text-center">Modifier</h1> 
                    <form action="{{ route('stock.commande.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $commande->id }}">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="#">Numéro de commande : <strong> Commande {{ $commande->id }} </strong> </label> 
                                </div> 
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="#">Statut : <span class="text-danger">*</span></label>
                                    <select class="select2_select_option form-control" name="statut_id" required>
                                        <option value="" selected disabled>{{ __('Select') }}</option>
                                        @foreach ($statuts as $statut)
                                            <option {{ $commande->statut_id == $statut->id ? 'selected':'' }} value="{{ $statut->id }}">{{ $statut->name }}</option>
                                        @endforeach
                                    </select>
                                </div>  
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="#">Date de commande : <span class="text-danger">*</span></label>
                                    <input type="date" name="date" value="{{ $commande->date ?? \Carbon\Carbon::today() }}" class="flatpickr form-control shadow-none rounded" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="#">Référence commande  :</label>
                                    <textarea name="reference_commande" id="reference_commande" class="form-control">{{ $commande->reference_commande }}</textarea>
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
                                            <option {{ $commande->fournisseur_id == $fournisseur->id ? 'selected':'' }} value="{{ $fournisseur->id }}">{{ $fournisseur->name }}</option>
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
                                            <option {{ $commande->type_de_livraison_id == $livraison->id ? 'selected':'' }} value="{{ $livraison->id }}">{{ $livraison->name }}</option>
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
                                            <option {{ $commande->enlevement_par_id == $reception->id ? 'selected':'' }} value="{{ $reception->id }}">{{ $reception->name }}</option>
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
                                            <option {{ $commande->recu_par_id == $reception->id ? 'selected':'' }} value="{{ $reception->id }}">{{ $reception->name }}</option>
                                        @endforeach
                                    </select>
                                </div>  
                            </div>
                            <div class="col-12 my-4">
                                <h2 class="text-center">Commande</h2> 
                                <div class="table-responsive">
                                    <table class="table w-100 mb-0 text-center" style="border: 2px solid black !important"> 
                                        <tbody class="database-table__body database-table__body--commande" id="commandeTbody"> 
                                            @foreach ($commande->products as $commande_product) 
                                                <tr>
                                                    <td class="select2-selection--no-border table--td" style="padding: 3px;">
                                                        <select class="select2_select_option form-control shadow-none" name="product[x--{{ $commande_product->id }}]" required>
                                                            <option value="" selected disabled>Produit</option>
                                                            @foreach ($products as $product)
                                                                <option {{ $commande_product->product_id == $product->id ? 'selected':'' }} value="{{ $product->id }}">{{ $product->reference }}</option>
                                                            @endforeach
                                                        </select>  
                                                    </td>
                                                    @if ($loop->first)
                                                        <td class="table--td" style="padding: 3px;"><input type="number" min="1" name="quantity[x--{{ $commande_product->id }}]" class="form-control text-center shadow-none border-0 commande-product-quantity" value="{{ $commande_product->quantity }}" required></td>
                                                    @else
                                                        <td class="table--td" style="padding: 3px;">
                                                            <div class="d-flex">
                                                                <input type="number" min="1" name="quantity[x--{{ $commande_product->id }}]" class="form-control text-center shadow-none border-0 commande-product-quantity" value="{{ $commande_product->quantity }}" required>
                                                                <button type="button" class="btn btn-sm btn-outline-danger commandeTrRemove shadow-none"><i class="bi bi-x-lg"></i></button>
                                                            </div>
                                                        </td>
                                                    @endif
                                                 </tr> 
                                            @endforeach 
                                        </tbody>
                                    </table>
                                </div>
                                <button type="button" id="commandeAddNew" class="secondary-btn border-0 rounded shadow-none my-3"><i class="bi bi-plus-square"></i> Ajouter un nouveau produit</button>
                                <div class="table-responsive">
                                    <table class="table w-100 mb-0 text-center" style="border: 2px solid black !important; background-color: #D9D9D9"> 
                                        <tbody class="database-table__body"> 
                                             <tr>
                                                <td class="table--td">TOTAL</td>
                                                <td class="table--td" id="totalQuantity">{{ $commande->products->sum('quantity') }}</td>
                                             </tr> 
                                        </tbody>
                                    </table>
                                </div> 
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="#">Observations :</label>
                                    <textarea name="observation" id="observation" class="form-control">{{ $commande->observation }}</textarea>
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
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal modal--aside fade" id="deleteModal" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
                    <form  action="{{ route('stock.commande.delete') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $commande->id }}">
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
@endsection

@push('stockJs')
    <script>
         function totalQuantity(){
            let totalQuantity = 0;
            $('.commande-product-quantity').each(function(){
                console.log($(this).val());
                totalQuantity += +$(this).val();
            });

            $('#totalQuantity').text(totalQuantity);
        }

        $(document).ready(function(){
            let counter = 1;
            $('#commandeAddNew').on('click', function(){
                const $data = `
                <tr>
                    <td class="select2-selection--no-border table--td" style="padding: 3px;">
                        <select class="select2_select_option form-control shadow-none" name="product[n--${counter}]" required>
                            <option value="" selected disabled>Produit</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->reference }}</option>
                            @endforeach
                        </select>  
                    </td>
                    <td class="table--td" style="padding: 3px;">
                        <div class="d-flex">
                            <input type="number" min="1" name="quantity[n--${counter}]" class="form-control text-center shadow-none border-0 commande-product-quantity" required>
                            <button type="button" class="btn btn-sm btn-outline-danger commandeTrRemove shadow-none"><i class="bi bi-x-lg"></i></button>
                        </div>
                    </td>
                </tr>
                `;
                $('#commandeTbody').append($data); 
                counter++;
                
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
        });

    </script>
@endpush