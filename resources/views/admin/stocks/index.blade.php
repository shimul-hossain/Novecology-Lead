@extends('admin.stocks.layouts')

@section('DashboardActive', 'active_sidbar') 
@push('css_style')
	 <style>
         
	 </style>
@endpush
@php
    $separator_status = false;
@endphp
@section('tab-content')
    @if (checkAction(Auth::id(), 'stocks', 'dashboard') || role() == 's_admin')
        <div class="tab-pane fade show active" id="v-pills-documentControl" role="tabpanel" aria-labelledby="v-pills-documentControl-tab"> 
            <div class="row"> 
                <div class="col-12" >
                    <div class="table-responsive simple-bar">
                        <table class="table w-100 mb-0 text-center">
                            <thead class="database-table__header">
                                <tr class="w-100">
                                    <td style="background-color: #2F5597; border: 2px solid white !important; width:40%" class="text-white text-center ">Produit</td>
                                    <td style="background-color: #2F5597; border: 2px solid white !important; width:20%" class="text-white text-center ">ETAT</td>
                                    <td style="background-color: #2F5597; border: 2px solid white !important; width:20%" class="text-white text-center  ">Stock Minimum</td>
                                    <td style="width: 20%"></td>
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
                                            <td colspan="4">
                                                <hr style="border-top: 8px solid #4472C2;"> 
                                            </td>
                                        </tr>
                                        @php    
                                            $separator_status = true;
                                        @endphp
                                    @endif
                                    <tr> 
                                        <td class="text-center">{{ $product['reference'] }}</td>
                                        <td class="text-center">{{ $product['etat'] }}</td>
                                        <td class="text-center">{{ $product['stock_minimum'] }}</td>
                                        <td class="text-center">
                                            @if ($product['etat'] <= $product['stock_intermediate'])
                                                @if ($product['etat'] <= $product['stock_minimum'])
                                                    <i class="bi bi-exclamation-triangle-fill text-danger"></i>
                                                @elseif ($product['etat'] <= $product['stock_intermediate'])
                                                    <i class="bi bi-exclamation-triangle-fill text-warning"></i>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> 
        </div>
    @else
        <div class="tab-pane fade show active" style="min-height: 100vh;" id="v-pills-documentControl" role="tabpanel" aria-labelledby="v-pills-documentControl-tab"> 
            <div class="row">
                <div class="col-12"> 
                    <h3 class="mt-5 text-center">Accès Refusé</h3>
                </div>
            </div> 
        </div>
    @endif
@endsection

@section('modal-content')
 
@endsection