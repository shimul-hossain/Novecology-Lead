@extends('admin.stocks.layouts')

@section('MouvementsActive', 'active_sidbar') 
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
                    <span style="font-size: 40px">Détail du mouvement 
                        @if (checkAction(Auth::id(), 'stocks_mouvements', 'edit') || role() == 's_admin')
                            <button type="button" class="btn shadow-none" style="font-size: 22px" data-toggle="modal" data-target="#editModal"><i class="bi bi-pencil-square"></i></button>
                        @endif
                    </span>  
                    <div class="ml-auto">
                        @if (checkAction(Auth::id(), 'stocks_mouvements', 'delete') || role() == 's_admin')
                            <button type="button" class="btn shadow-none"  style="font-size: 22px"  data-toggle="modal" data-target="#deleteModal"><i class="bi bi-trash3"></i></button> 
                        @endif
                        <ul class="nav nav-pills nav-pills--horizontal d-inline-block my-3" id="pills-tab" role="tablist" style="border: 2px solid #2F528F; border-radius: 7px;"> 
                            <li class="nav-item d-inline-block" role="presentation">
                                <a class="nav-link active px-4 py-1" id="pills-two-tab" data-toggle="pill" href="#pills-two" role="tab" aria-controls="pills-two" aria-selected="true">Détails</a>
                            </li>  
                            <li class="nav-item d-inline-block" role="presentation">
                                @if (checkAction(Auth::id(), 'stocks_mouvements', 'activity') || role() == 's_admin')
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
                                                                @if ($activity->key == 'product_id')
                                                                    Produit 
                                                                @elseif ($activity->key == 'project_id')
                                                                    Nom du chantier
                                                                @elseif ($activity->key == 'mouvement_id')
                                                                    Type mouvement
                                                                @elseif ($activity->key == 'entrepot_id')
                                                                    Entrepôt 
                                                                @elseif ($activity->key == 'user_id')
                                                                    Enlèvement/Retour par  
                                                                @elseif ($activity->key == 'plaque_immatriculation')
                                                                    Plaque immatriculation 
                                                                @elseif ($activity->key == 'personnel_autorise_id')
                                                                    Réception/Servi par
                                                                @elseif ($activity->key == 'observation')
                                                                    Observations 
                                                                @else
                                                                    {{ ucfirst($activity->key) }}
                                                                @endif
                                                            </strong>
                                                             à 
                                                             <strong>
                                                                @if ($activity->key == 'product_id')
                                                                    {{ $activity->product->reference ?? '' }} 
                                                                @elseif ($activity->key == 'project_id')
                                                                    {{ $activity->project->Prenom.' '.$activity->project->Nom }}
                                                                @elseif ($activity->key == 'mouvement_id')
                                                                    {{ $activity->mouvement->name ?? '' }} 
                                                                @elseif ($activity->key == 'entrepot_id')
                                                                    {{ $activity->entrepot->name ?? '' }} 
                                                                @elseif ($activity->key == 'user_id')
                                                                    {{ $activity->installer->name ?? '' }} 
                                                                @elseif ($activity->key == 'personnel_autorise_id')
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
                                                                <form action="{{ route('stock.log.delete') }}" method="POST">
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
                        <div class="d-flex align-items-center">
                            {{-- <p class="list-item mt-3">Produit : {{ $mouvement->product->reference ?? '' }}</p>  --}}
                            <a href="{{ route('stock.mouvement.pdf', $mouvement->id) }}" target="_blank" class="btn-pdf shadow-none ml-auto font_30"><i class="bi bi-file-earmark-pdf"></i></a> 
                        </div>
                        {{-- <p class="list-item">Quantité : {{ $mouvement->quantity }}</p>  --}}
                        <div style="margin: 80px 0">
                            <h2 class="text-center">Produit</h2> 
                            <div class="table-responsive">
                                <table class="table w-100 mb-0 text-center" style="border: 2px solid black !important"> 
                                    <tbody class="database-table__body database-table__body--mouvement"> 
                                        @foreach ($mouvement->products as $mouvement_product)
                                            <tr>
                                                <td class="table--td">
                                                    {{ $mouvement_product->product->reference ?? '' }}
                                                </td>
                                                <td class="table--td">
                                                    {{ $mouvement_product->quantity }}
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
                                            <td class="table--td">{{ $mouvement->products->sum('quantity') }}</td>
                                         </tr> 
                                    </tbody>
                                </table>
                            </div> 
                        </div> 
                        <p class="list-item d-flex align-items-center">Mouvement : 
                            @if ($mouvement->mouvement)
                                @if ($mouvement->mouvement == 'Entrée')
                                    <span class="stock-entree__badge px-4 mr-3">Entrée</span>
                                @else
                                    <span class="stock-sortie__badge px-4">Sortie</span>
                                @endif
                            @endif
                            @if ($mouvement->bon_de_livraison)
                                <span class="ml-auto">Bon de livraison </span> :  
                                <a href="{{ asset('uploads/stock') }}/{{ $mouvement->bon_de_livraison }}" target="_blank" class="btn shadow-none p-0 m-0">
                                    <i class="bi bi-file-earmark-pdf font_30"></i>
                                </a>
                            @endif
                        </p>
                        <p class="list-item">Date : {{ \Carbon\Carbon::parse($mouvement->date)->format('d-m-Y') }}</p> 
                        <p class="list-item">Nom du chantier : {{ $mouvement->project->Prenom.' '.$mouvement->project->Nom }}</p> 
                        <p class="list-item">Type mouvement : {{ $mouvement->natureMouvement->name ?? '' }}</p> 
                        <p class="list-item">Entrepôt : {{ $mouvement->entrepot->name ?? '' }}</p> 
                        <p class="list-item">Enlèvement/Retour par : {{ $mouvement->user->name ?? '' }}</p> 
                        <p class="list-item">Plaque immatriculation : {{ $mouvement->plaque_immatriculation }}</p> 
                        <p class="list-item">Réception/Servi par : {{ $mouvement->reception->name ?? '' }}</p> 
                        <p class="list-item">Observations : {{ $mouvement->observation }}</p> 
                    </div>  
                </div> 
            </div> 
        </div> 
    </div>
@endsection

@section('modal-content')

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
                    <form action="{{ route('stock.mouvement.update') }}" method="post" enctype="multipart/form-data">  
                        @csrf
                        <input type="hidden" name="id" value="{{ $mouvement->id }}">
                        {{-- <div class="form-group">
                            <label for="#">Produit : <span class="text-danger">*</span></label>
                            <select class="select2_select_option form-control" name="product_id" required>
                                <option value="">{{ __('Select') }}</option>
                                @foreach ($products as $product)
                                    <option {{ $mouvement->product_id == $product->id ? 'selected':'' }} value="{{ $product->id }}">{{ $product->reference }}</option>
                                @endforeach
                            </select>
                        </div>  --}}    
                        <label class=" mt-4" for="#">Produits : <span class="text-danger">*</span></label>
                        <div class="table-responsive">
                            <table class="table w-100 mb-0 text-center" style="border: 2px solid black !important"> 
                                <tbody class="database-table__body database-table__body--mouvement" id="mouvementTbody"> 
                                    @foreach ($mouvement->products as $mouvement_product) 
                                        <tr>
                                            <td class="select2-selection--no-border table--td" style="padding: 3px;">
                                                <select class="select2_select_option form-control shadow-none" name="product[x--{{ $mouvement_product->id }}]" required>
                                                    <option value="" selected disabled>Produit</option>
                                                    @foreach ($products as $product)
                                                        <option {{ $mouvement_product->product_id == $product->id ? 'selected':'' }} value="{{ $product->id }}">{{ $product->reference }}</option>
                                                    @endforeach
                                                </select>  
                                            </td>
                                            @if ($loop->first)
                                                <td class="table--td" style="padding: 3px;"><input type="number" min="1" name="quantity[x--{{ $mouvement_product->id }}]" class="form-control text-center shadow-none border-0 mouvement-product-quantity" value="{{ $mouvement_product->quantity }}" required></td>
                                            @else
                                                <td class="table--td" style="padding: 3px;">
                                                    <div class="d-flex">
                                                        <input type="number" min="1" name="quantity[x--{{ $mouvement_product->id }}]" class="form-control text-center shadow-none border-0 mouvement-product-quantity" value="{{ $mouvement_product->quantity }}" required>
                                                        <button type="button" class="btn btn-sm btn-outline-danger mouvementTrRemove shadow-none"><i class="bi bi-x-lg"></i></button>
                                                    </div>
                                                </td>
                                            @endif
                                        </tr> 
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <button type="button" id="mouvementAddNew" class="secondary-btn border-0 rounded shadow-none my-3"><i class="bi bi-plus-square"></i> Ajouter un nouveau produit</button>
                        <div class="table-responsive mb-4">
                            <table class="table w-100 mb-0 text-center" style="border: 2px solid black !important; background-color: #D9D9D9"> 
                                <tbody class="database-table__body"> 
                                        <tr>
                                        <td class="table--td">TOTAL</td>
                                        <td class="table--td" id="totalQuantity">{{ $mouvement->products->sum('quantity') }}</td>
                                        </tr> 
                                </tbody>
                            </table>
                        </div>  
                        {{-- <div class="form-group">
                            <label for="#">Quantité : <span class="text-danger">*</span></label> 
                            <input type="number" min="1" name="quantity" value="{{ $mouvement->quantity }}" class="form-control shadow-none rounded" required>
                        </div>  --}}
                        <div class="form-group">
                            <label for="#">Mouvement : <span class="text-danger">*</span></label>
                            <select class="select2_color_option form-control" name="mouvement" required>
                                <option value="" selected disabled>{{ __('Select') }}</option>
                                <option {{ $mouvement->mouvement == 'Entrée' ? 'selected':'' }} data-color="#385621" data-background="#C5E0B5" value="Entrée">Entrée</option>
                                <option {{ $mouvement->mouvement == 'Sortie' ? 'selected':'' }} data-color="#BF0000" data-background="#EBB6A6" value="Sortie">Sortie</option>
                            </select>
                        </div> 
                        <div class="form-group">
                            <label for="#">Date : <span class="text-danger">*</span></label>
                            <input type="date" name="date" value="{{ $mouvement->date ?? \Carbon\Carbon::today() }}" class="flatpickr form-control shadow-none rounded" required>
                        </div>
                        <div class="form-group">
                            <label for="#">Nom du chantier : <span class="text-danger">*</span></label>
                            <select class="select2_select_option form-control" name="project_id" required>
                                <option value="">{{ __('Select') }}</option>
                                @foreach ($projects as $project)
                                    <option {{ $mouvement->project_id == $project->id ? 'selected':'' }} value="{{$project->id }}">{{ $project->Prenom.' '.$project->Nom }}</option>
                                @endforeach
                            </select>
                        </div> 
                        <div class="form-group">
                            <label for="#">Nature mouvement : <span class="text-danger">*</span></label>
                            <select class="select2_select_option form-control" name="mouvement_id" required>
                                <option value="">{{ __('Select') }}</option>
                                @foreach ($types as $type)
                                    <option {{ $mouvement->mouvement_id == $type->id ? 'selected':'' }} value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div> 
                        <div class="form-group">
                            <label for="#">Entrepôt : <span class="text-danger">*</span></label>
                            <select class="select2_select_option form-control" name="entrepot_id" required>
                                <option value="">{{ __('Select') }}</option>
                                @foreach ($entrepots as $entrepot)
                                    <option {{ $mouvement->entrepot_id == $entrepot->id ? 'selected':'' }} value="{{ $entrepot->id }}">{{ $entrepot->name }}</option>
                                @endforeach
                            </select>
                        </div> 
                        <div class="form-group">
                            <label for="#">Enlèvement/Retour par : <span class="text-danger">*</span></label>
                            <select class="select2_select_option form-control" name="user_id" required>
                                <option value="">{{ __('Select') }}</option>
                                @foreach ($users as $user)
                                    <option {{ $mouvement->user_id == $user->id ? 'selected':'' }} value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div> 
                        <div class="form-group">
                            <label for="#">Plaque immatriculation :</label>
                            <textarea name="plaque_immatriculation" id="plaque_immatriculation" class="form-control">{{ $mouvement->plaque_immatriculation }}</textarea>
                        </div> 
                        <div class="form-group">
                            <label for="#">Réception/Servi par : <span class="text-danger">*</span></label>
                            <select class="select2_select_option form-control" name="personnel_autorise_id" required>
                                <option value="">{{ __('Select') }}</option>
                                @foreach ($receptions as $reception)
                                    <option {{ $mouvement->personnel_autorise_id == $reception->id ? 'selected':'' }} value="{{ $reception->id }}">{{ $reception->name }}</option>
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
                            <textarea name="observation" id="observation" class="form-control">{{ $mouvement->observation }}</textarea>
                        </div> 
                        <div class="form-group text-center">
                            <button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill border-0 my-5">
                                {{ __('Submit') }}
                            </button>
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
                    <form  action="{{ route('stock.mouvement.delete') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $mouvement->id }}">
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
            $('.mouvement-product-quantity').each(function(){
                console.log($(this).val());
                totalQuantity += +$(this).val();
            });

            $('#totalQuantity').text(totalQuantity);
        }

        $(document).ready(function(){
            let counter = 1;
            $('#mouvementAddNew').on('click', function(){
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
                            <input type="number" min="1" name="quantity[n--${counter}]" class="form-control text-center shadow-none border-0 mouvement-product-quantity" required>
                            <button type="button" class="btn btn-sm btn-outline-danger mouvementTrRemove shadow-none"><i class="bi bi-x-lg"></i></button>
                        </div>
                    </td>
                </tr>
                `;
                $('#mouvementTbody').append($data); 
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