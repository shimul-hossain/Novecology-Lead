@extends('admin.settings.layout')

@section('CatalogueCollapseActive', 'true')
@section('CatalogueCollapse', 'show')
@section('BARTH164TabActive', 'active')

@section('tab-content')
<div class="tab-pane fade show active" id="v-pills-BAR_TH_164" role="tabpanel" aria-labelledby="v-pills-BAR_TH_164-tab">
    <div class="row">
        <div class="col-12">
            <h3 class="m-3">BAR TH 164</h3>
        </div>
        <div class="col-12" >
            <div class="table-responsive simple-bar">
                <table class="table database-table w-100 mb-0 table-bordered">
                    <thead class="database-table__header">
                        <tr>
                            <th>{{ __('Serial') }}</th>
                            <th>Nom</th>
                            <th>price</th>
                            <th class="text-center">{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    @php
                        $color_item = [
                            '2' => '#e1c3c3;',
                            '3' => '#e1c3c3;',
                            '4' => '#e1c3c3;',
                            '5' => '#e1c3c3;',
                            '6' => '#e1c3c3;',
                            '7' => '#e1c3c3;',
                            '8' => '#e1c3c3;',
                            '9' => '#e1c3c3;',
                            '10' => '#e1c3c3;',
                            '11' => '#e1c3c3;',
                            'AIRWELL-2' => '#cadcf7',
                            'AIRWELL-3' => '#cadcf7',
                            'AIRWELL-4' => '#cadcf7',
                            'AIRWELL-5' => '#cadcf7',
                            'AIRWELL-6' => '#cadcf7',
                            'AIRWELL-7' => '#cadcf7',
                            'AIRWELL-8' => '#cadcf7',
                            'AIRWELL-9' => '#cadcf7',
                            'AIRWELL-10' => '#cadcf7',
                            'AIRWELL-11' => '#cadcf7',
                        ];
                    @endphp
                    <tbody class="database-table__body">
                        @foreach ($barth_prices as $barth_price)
                            <tr style="background-color:{{ $barth_price->type == 'multiple' ? $color_item[$barth_price->slug]:'' }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $barth_price->name }}</td>
                                <form action="{{ route('barth.price.update') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $barth_price->id }}">
                                    <td><input type="number" step="any" name="price" class="form-control" value="{{ $barth_price->price }}"></td>
                                    <td class="text-center">
                                        <button class="primary-btn primary-btn--primary primary-btn--lg d-inline-flex align-items-center justify-content-center border-0 rounded">
                                            {{ __('Update') }}
                                        </button>
                                    </td>
                                </form>
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