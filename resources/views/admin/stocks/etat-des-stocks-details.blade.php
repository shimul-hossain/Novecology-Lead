@extends('admin.stocks.layouts')

@section('EtatActive', 'active_sidbar') 
@push('css_style')
	 <style>
         
	 </style>
@endpush

@section('tab-content')
    <div class="tab-pane fade show active" id="v-pills-documentControl" role="tabpanel" aria-labelledby="v-pills-documentControl-tab"> 
        <div class="row"> 
            <div class="col-12" >
                <div class="table-responsive simple-bar">
                    <table class="table w-100 mb-0 text-center" style="border: 2px solid black !important">
                        <thead class="database-table__header">
                            <tr> 
                                <td style="background-color: #2F5597; border: 2px solid black !important; width: 20%" class="text-white text-center">Produit</td>
                                <td style="background-color: #2F5597; border: 2px solid black !important" class="text-white text-center">Date</td>
                                <td style="background-color: #2F5597; border: 2px solid black !important" class="text-white text-center">Mouvement</td>
                                <td style="background-color: #2F5597; border: 2px solid black !important" class="text-white text-center">Type</td>
                                <td style="background-color: #2F5597; border: 2px solid black !important" class="text-white text-center">Entrepôt</td>
                                <td style="background-color: #2F5597; border: 2px solid black !important" class="text-white text-center">Quantité</td>
                                <td style="background-color: #2F5597; border: 2px solid black !important" class="text-white text-center">Enlevé par</td> 
                            </tr>
                        </thead> 
                        <tbody class="database-table__body"> 
                            @forelse ($mouvements as $mouvement)
                                <tr class="border-0">  
                                    <td class="text-center" style="border: 2px solid black !important">{{ $product->reference ?? '' }}</td>
                                    <td class="text-center" style="background-color: #{{ $mouvement->mouvement == 'Entrée' ? 'C5E0B4':'EDB6A7' }};">{{ \Carbon\Carbon::parse($mouvement->date)->format('d-m-Y') }}</td>
                                    <td class="text-center" style="background-color: #{{ $mouvement->mouvement == 'Entrée' ? 'C5E0B4':'EDB6A7' }};">{{ $mouvement->mouvement }}</td>
                                    <td class="text-center" style="background-color: #{{ $mouvement->mouvement == 'Entrée' ? 'C5E0B4':'EDB6A7' }};">{{ $mouvement->natureMouvement->name ?? '' }}</td> 
                                    <td class="text-center" style="background-color: #{{ $mouvement->mouvement == 'Entrée' ? 'C5E0B4':'EDB6A7' }};">{{ $mouvement->entrepot->name ?? '' }}</td> 
                                    <td class="text-center" style="background-color: #{{ $mouvement->mouvement == 'Entrée' ? 'C5E0B4':'EDB6A7' }};">{{ $mouvement->products->where('product_id', $product->id)->sum('quantity') }}</td> 
                                    <td class="text-center" style="background-color: #{{ $mouvement->mouvement == 'Entrée' ? 'C5E0B4':'EDB6A7' }};">{{ $mouvement->user->name ?? '' }}</td>  
                                </tr>
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
@endsection

@section('modal-content')
 
@endsection