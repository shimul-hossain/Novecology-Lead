@extends('admin.stocks.layouts')

@section('SuiviActive', 'active_sidbar') 
@push('css_style')
	 <style>
        
        .list-item{
            font-size: 20px;
            margin-bottom: 25px;
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
                    <span style="font-size: 40px">Details : Installation  
                        @if (checkAction(Auth::id(), 'stocks_installations', 'edit') || role() == 's_admin') 
                            <button type="button" class="btn shadow-none" style="font-size: 22px" data-toggle="modal" data-target="#editModal"><i class="bi bi-pencil-square"></i></button>
                        @endif
                    </span>  
                    <div class="ml-auto">
                        @if (checkAction(Auth::id(), 'stocks_installations', 'delete') || role() == 's_admin')  
                            <button type="button" class="btn shadow-none"  style="font-size: 22px"  data-toggle="modal" data-target="#deleteModal"><i class="bi bi-trash3"></i></button> 
                        @endif
                        <ul class="nav nav-pills nav-pills--horizontal d-inline-block my-3" id="pills-tab" role="tablist" style="border: 2px solid #2F528F; border-radius: 7px;"> 
                            <li class="nav-item d-inline-block" role="presentation">
                                <a class="nav-link active px-4 py-1" id="pills-two-tab" data-toggle="pill" href="#pills-two" role="tab" aria-controls="pills-two" aria-selected="true">Détails</a>
                            </li>  
                            <li class="nav-item d-inline-block" role="presentation">
                                @if (checkAction(Auth::id(), 'stocks_installations', 'activity') || role() == 's_admin') 
                                    <a class="nav-link px-4 py-1" id="pills-one-tab" data-toggle="pill" href="#pills-one" role="tab" aria-controls="pills-one" aria-selected="false">Historique</a>
                                @else
                                    <a class="nav-link px-4 py-1" style=" cursor: pointer;"> <span class="novecologie-icon-lock py-1"></span> Historique</a>
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
                                                                @if ($activity->key == 'project_id')
                                                                    Nom du chantier  
                                                                @elseif ($activity->key == 'installateur_id')
                                                                    Installateur  
                                                                @elseif ($activity->key == 'observation')
                                                                    Observations 
                                                                @else  
                                                                    {{ ucfirst($activity->key) }}
                                                                @endif
                                                            </strong>
                                                             à 
                                                             <strong>
                                                                @if ($activity->key == 'project_id')
                                                                    {{ $activity->project->Prenom.' '.$activity->project->Nom }}
                                                                @elseif ($activity->key == 'installateur_id')
                                                                    {{ $activity->installer->name ?? '' }}   
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
                        <p class="list-item">Date : {{ \Carbon\Carbon::parse($installation->date)->format('d-m-Y') }}</p> 
                        <p class="list-item">Installateur : {{ $installation->installer->name ?? '' }}</p> 
                        <p class="list-item">Nom du chantier : {{ $installation->project->Prenom.' '.$installation->project->Nom }}</p>   
                        <div style="margin: 120px 0">
                            <h2 class="text-center">Produits Installés :</h2> 
                            <div class="table-responsive">
                                <table class="table w-100 mb-0 text-center" style="border: 2px solid black !important"> 
                                    <tbody class="database-table__body database-table__body--commande"> 
                                        @foreach ($installation->products as $installation_product)
                                            <tr>
                                                <td class="table--td">
                                                    {{ $installation_product->product->reference ?? '' }}
                                                </td>
                                                <td class="table--td">
                                                    {{ $installation_product->quantity }}
                                                </td>
                                            </tr> 
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>  
                        </div>
                        <p class="list-item">Observations : {{ $installation->observation }}</p> 
                    </div>  
                </div> 
            </div> 
        </div> 
    </div>
@endsection

@section('modal-content')
    <!-- Right Aside Modal -->
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
                    <form action="{{ route('stock.installation.update') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $installation->id }}">
                        <div class="row"> 
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="#">Date : <span class="text-danger">*</span></label>
                                    <input type="date" name="date" value="{{ $installation->date }}" class="flatpickr form-control shadow-none rounded" required>
                                </div>
                            </div> 
                            <div class="col-12"> 
                                <div class="form-group">
                                    <label for="#">Nom du chantier : <span class="text-danger">*</span></label>
                                    <select class="select2_select_option form-control" name="project_id" required>
                                        <option value="" selected disabled>{{ __('Select') }}</option>
                                        @foreach ($projects as $project)
                                            <option {{ $installation->project_id == $project->id ? 'selected':'' }} value="{{ $project->id }}">{{ $project->Prenom.' '.$project->Nom }}</option>
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
                                            <option {{ $installation->installateur_id == $user->id ? 'selected':'' }} value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 my-4">
                                <h2 class="text-center">Matériel Installé :</h2> 
                                <div class="table-responsive">
                                    <table class="table w-100 mb-0 text-center" style="border: 2px solid black !important"> 
                                        <tbody class="database-table__body database-table__body--installation" id="installationTbody"> 
                                            @foreach ($installation->products as $installation_product)
                                                <tr>
                                                    <td class="select2-selection--no-border table--td" style="padding: 3px;">
                                                        <select class="select2_select_option form-control shadow-none" name="product[x--{{ $installation_product->id }}]" required>
                                                            <option value="" selected disabled>Produit</option>
                                                            @foreach ($products as $product)
                                                                <option {{ $installation_product->product_id == $product->id ? 'selected':'' }} value="{{ $product->id }}">{{ $product->reference }}</option>
                                                            @endforeach
                                                        </select>  
                                                    </td>
                                                    @if ($loop->first)
                                                        <td class="table--td" style="padding: 3px;"><input type="number" min="1" name="quantity[x--{{ $installation_product->id }}]" value="{{ $installation_product->quantity }}" class="form-control text-center shadow-none border-0 installation-product-quantity" required></td>
                                                    @else
                                                        <td class="table--td" style="padding: 3px;">
                                                            <div class="d-flex">
                                                                <input type="number" min="1" name="quantity[x--{{ $installation_product->id }}]" class="form-control text-center shadow-none border-0 installation-product-quantity" value="{{ $installation_product->quantity }}" required>
                                                                <button type="button" class="btn btn-sm btn-outline-danger installationTrRemove shadow-none"><i class="bi bi-x-lg"></i></button>
                                                            </div>
                                                        </td>
                                                    @endif
                                                </tr> 
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <button type="button" id="installationAddNew" class="secondary-btn border-0 rounded shadow-none my-3"><i class="bi bi-plus-square"></i> Ajouter un nouveau produit</button>
                                <div class="table-responsive">
                                    <table class="table w-100 mb-0 text-center" style="border: 2px solid black !important; background-color: #D9D9D9"> 
                                        <tbody class="database-table__body"> 
                                            <tr>
                                                <td class="table--td">TOTAL</td>
                                                <td class="table--td" id="totalQuantity">{{ $installation->products->sum('quantity') }}</td>
                                            </tr> 
                                        </tbody>
                                    </table>
                                </div> 
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="#">Observations :</label>
                                    <textarea name="observation" id="observation" class="form-control">{{ $installation->observation }}</textarea>
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
                    <form  action="{{ route('stock.installation.delete') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $installation->id }}">
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
            $('.installation-product-quantity').each(function(){
                totalQuantity += +$(this).val();
            });

            $('#totalQuantity').text(totalQuantity);
        }
        $(document).ready(function(){
            let counter = 1;
            $('#installationAddNew').on('click', function(){
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
                            <input type="number" min="1" name="quantity[n--${counter}]" class="form-control text-center shadow-none border-0 installation-product-quantity" required>
                            <button type="button" class="btn btn-sm btn-outline-danger installationTrRemove shadow-none"><i class="bi bi-x-lg"></i></button>
                        </div>
                    </td>
                </tr>
                `;
                $('#installationTbody').append($data); 
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

            $('body').on('click', '.installationTrRemove', function(){
                $(this).closest('tr').slideUp(function(){
                    $(this).remove();
                    totalQuantity();
                });
            });

            $("body").on('input', '.installation-product-quantity', function(){
                totalQuantity()
            }); 
        });

    </script>
@endpush