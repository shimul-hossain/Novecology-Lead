@extends('admin.settings.layout')

@section('CatalogueCollapseActive', 'true')
@section('CatalogueCollapse', 'show')
@section('CalculetteCumacActive', 'active')

@section('tab-content')
<div class="tab-pane fade show active" id="v-pills-BAR_TH_164" role="tabpanel" aria-labelledby="v-pills-BAR_TH_164-tab">
    <div class="row">
        <div class="col-12">
            <h3 class="m-3">Calculette Cumac</h3>
        </div>
        <div class="col-12" >
            <div class="table-responsive simple-bar">
                <table class="table database-table w-100 mb-0 table-bordered">
                    <thead class="database-table__header">
                        <tr>
                            <th>Mode de chauffage</th>
                            <th>CEF intial</th>
                            <th>CEF finale</th>
                            <th>Gain CEF</th>
                            <th class="text-center">{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="database-table__body">
                        @foreach ($cumac_categories as $category)
                            <tr>
                                <td colspan="100" style="background-color: #FFE598"><h3 class="text-center">{{ $category->name }}</h3></td>
                            </tr>
                            @foreach ($category->getCumac as $cumac)
                                <tr>
                                    <form action="{{ route('cumac.price.update') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $cumac->id }}">
                                        <td>{{ $cumac->mode_de_chauffage }}</td>
                                        <td><input type="number" step="any" name="cef_intial" class="form-control" value="{{ $cumac->cef_intial }}"></td>
                                        <td><input type="number" step="any" name="cef_finale" class="form-control" value="{{ $cumac->cef_finale }}"></td>
                                        <td><input type="number" step="any" disabled class="form-control" value="{{ $cumac->gain_cef }}"></td>
                                        <td class="text-center">
                                            <button class="primary-btn primary-btn--primary primary-btn--lg d-inline-flex align-items-center justify-content-center border-0 rounded">
                                                {{ __('Update') }}
                                            </button>
                                        </td>
                                    </form>
                                </tr>
                            @endforeach
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