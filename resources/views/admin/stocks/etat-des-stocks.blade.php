@extends('admin.stocks.layouts')

@section('EtatActive', 'active_sidbar') 
@push('css_style')
	 <style>
         
	 </style>
@endpush
@php
    $separator_status = false;
@endphp
@section('tab-content')
    <div class="tab-pane fade show active" id="v-pills-documentControl" role="tabpanel" aria-labelledby="v-pills-documentControl-tab"> 
        <div class="row"> 
            <div class="col-12">
                <form class="bg-white px-3 pt-3 border rounded-lg" action="{{ route('stock.etat.des.stocks.filter') }}">
                    <div class="row"> 
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Produit</label>
                                <select class="select2_select_option shadow-none form-control" id="product_id" name="product_id">
                                    <option value="" selected>Sélectionnez</option> 
                                    @foreach ($all_products as $product)
                                        <option {{ request()->product_id == $product->id ? 'selected':'' }} value="{{ $product->id }}">{{ $product->reference }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> 
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Entrepôt</label>
                                <select name="entrepot_id" id="entrepot_id" class="select2_select_option custom-select shadow-none form-control">
                                    <option value="" selected>Sélectionnez</option>
                                    @foreach ($entrepots as $entrepot)
                                        <option {{ request()->entrepot_id == $entrepot->id ? 'selected':'' }} value="{{ $entrepot->id }}">{{ $entrepot->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> 
                        <div class="col-12 ml-auto mt-3 d-flex align-items-center justify-content-end">
                            <div class="form-group">
                                <button type="submit" class="ticket-main__chat-card__send-btn">
                                    Valider
                                </button>
                                @if (\Request::route()->getName() == 'stock.etat.des.stocks.filter')
                                    <a href="{{ route('stock.etat.des.stocks') }}" class="btn btn-sm btn-outline-danger" name="clear" type="submit"><i class="bi bi-x-lg"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12 mt-4">
                <div class="table-responsive simple-bar">
                    <table class="table w-100 mb-0 text-center">
                        <thead class="database-table__header">
                            <tr>
                                <td class="text-white" style="background-color: #2F5597; border: 2px solid white !important; width: 20%">Produit</td>
                                <td class="text-white" style="background-color: #2F5597; border: 2px solid white !important; width: 20%">Entrée</td>
                                <td class="text-white" style="background-color: #2F5597; border: 2px solid white !important; width: 20%">Sortie</td>
                                <td class="text-white" style="background-color: #2F5597; border: 2px solid white !important; width: 20%">ETAT</td>
                                <td class="text-white" style="background-color: #2F5597; border: 2px solid white !important; width: 20%">Détails</td>
                            </tr>
                        </thead>
                        <tbody class="database-table__body"> 
                            @foreach ($products as $product)
                                @if ($loop->first && $product['etat'] < 1)
                                    @php    
                                        $separator_status = true;
                                    @endphp
                                @endif
                                @if (!$separator_status && $product['etat'] < 1)
                                    <tr>
                                        <td colspan="5">
                                            <hr style="border-top: 8px solid #4472C2;"> 
                                        </td>
                                    </tr>
                                    @php    
                                        $separator_status = true;
                                    @endphp
                                @endif
                                <tr> 
                                    <td class="text-center">{{ $product['reference'] }}</td> 
                                    <td class="text-center">{{ $product['entree'] }}</td>
                                    <td class="text-center">{{ $product['sortie'] }}</td>
                                    <td class="text-center">{{ $product['etat'] }}</td>  
                                    <td class="text-center">
                                        <a href="{{ route('stock.etat.des.stocks.details', $product['id']) }}" class="primary-btn primary-btn--blue w-auto d-inline-flex justify-content-center align-items-center rounded px-4">
                                            {{ __('Update') }}
                                        </a>
                                    </td> 
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> 
    </div>
@endsection

@section('modal-content')
 
@endsection