<h1 class="form__title position-relative mb-4 text-center">{{ __('Confirmation') }}</h1>
<h4 class="text-center distribute-search__input">{{ count($main_data_json) }} Résultat trouvé, sélectionnez l'un de ceux-ci</h4> 
<div class="row">
    @foreach ($main_data_json as $item)
    <div class="col-12">
        <button type="button" class="col-12 mpr_searched_item mpr_selected_item" 
            data-project_id="{{ $project->id }}"
            data-mpr_file="{{ $item['mpr_file'] }}"
            data-deposited_work="{{ $item['deposited_work'] }}"
            data-deposit_date="{{ $item['deposit_date'] }}"
            data-address="{{ $item['address'] }}"
            data-status_1="{{ $item['status_1'] }}"
            data-status_2="{{ $item['status_2'] }}"
            data-estimated_amount="{{ $item['estimated_amount'] }}" 
            data-dismiss="modal"
            > 
            <p><strong>N° Dossier MPR :</strong> <span>{{ $item['mpr_file'] }}</span></p>
            <p class="mb-0"><strong>Statut :</strong> <span>{{ $item['status_2'] }}</span></p>
        </button>
    </div>
    @endforeach 
</div>