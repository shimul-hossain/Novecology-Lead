{{-- Main Layouts --}}
@extends('layouts.master')

{{-- Title part  --}}
@section('title')
    Calculette Cumac
@endsection

{{-- active menu  --}}
@section('calculatteDepertidionIndex')
active
@endsection

@push('css')
    <style>
        .select2--danger .select2-container--default .select2-selection--single,
        .select2--danger .form-control
        {
            background-color: #f8c9cd;
        }

        .select2--danger .select2-container--default .select2-selection--multiple,
        .select2--danger .select2-container--default .select2-selection--single,
        .select2--danger .form-control
        {
            border-color: #f8c9cd;
        }

        .select2--danger .form-control{
            color: #000000;
        }

        .font-0{
            font-size: 0;
        }

        .text-transparent{
            color: transparent;
        }

        .excel-table-wrapper{
            position: relative;
        }

        .excel-table-checkbox{
            position: absolute;
            opacity: 0;
        }

        .excel-table-label{
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #ffffff;
            border-radius: 3px;
            width: 18px;
            height: 18px;
            margin-bottom: 0;
            cursor: pointer;
            transform: translateY(3px);
        }

        .excel-table-checkbox:checked ~ .excel-table-checkbox-container .excel-table-label{
            background-color: #ffffff;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23000000' class='bi bi-check2' viewBox='0 0 16 16'%3E%3Cpath d='M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z'/%3E%3C/svg%3E");
            background-size: contain;
        }

        .excel-table__header-col{
            padding-right: 0;
            padding-left: 0;
        }

        .excel-table__header{
            color: #ffffff;
            background-color: #dc3545;
            padding: 6px 15px;
        }

        .excel-table__body{
            padding: 5px 15px;
        }

        .excel-table__body strong{
            transform: translateY(6px);
            display: inline-block;
        }

        .excel-table-checkbox:checked ~ .excel-table-checkbox-container .excel-table__header{
            background-color: #28a745;
        }

        .excel-table-toggle-text__after,
        .excel-table-checkbox:checked ~ .excel-table-checkbox-container .excel-table-toggle-text__before
        {
            display: none;
        }

        .excel-table-checkbox:checked ~ .excel-table-checkbox-container .excel-table-toggle-text__after{
            display: unset;
        }

        .card-title{
            font-family: "SF Pro Display Bold", sans-serif;
        }
    </style>
@endpush



{{-- Main Content Part  --}}
@section('content')
		<!-- Banner Section -->
		<section class="banner section-gap position-relative">
			<div class="container">
				<div class="row justify-content-center">
                    <div class="col-xl-8">
                        <div class="card shadow border-0">
                            <div class="card-header bg-success">
                                <h3 class="card-title text-center text-white mb-0">CUMAC TH164</h3>
                            </div>
                            <div class="row justify-content-center my-3">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <div class="row align-items-center mx-1"> 
                                            <div class="col-4">
                                                <p class="mb-md-0">Client</p>
                                            </div>
                                            <div class="col-8">
                                                <input type="text" class="form-control shadow-none">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row align-items-center mx-1"> 
                                            <div class="col-4">
                                                <p class="mb-md-0">Precarité*</p>
                                            </div>
                                            <div class="col-8">
                                                <select id="precarite" class="select2_select_option custom-select shadow-none form-control input-field">
                                                    <option value="" selected disabled>{{ __('Select') }}</option>
                                                    <option value="54">Grand Precaire/Precaire</option>
                                                    <option value="46">Intermédiaire/Classique</option>
                                                </select>
                                                <div>
                                                    <span class="text-danger errorMessage d-none" id="precariteError">{{ __("This field is required") }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row align-items-center mx-1"> 
                                            <div class="col-4">
                                                <p class="mb-md-0">SHAB*</p>
                                            </div>
                                            <div class="col-8">
                                                <input type="number" step="any" id="shab" class="form-control shadow-none">
                                                <div>
                                                    <span class="text-danger errorMessage d-none" id="shabError">{{ __("This field is required") }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row align-items-center mx-1"> 
                                            <div class="col-4">
                                                <p class="mb-md-0">Projet*</p>
                                            </div>
                                            <div class="col-8">
                                                <select id="projet" class="select2_select_option custom-select shadow-none form-control input-field">
                                                    <option value="" selected>{{ __('Select') }}</option>
                                                    @foreach ($categories as $category)
                                                        @if ($category->id == 2 || $category->id == 4)
                                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                        @endif
                                                    @endforeach 
                                                </select>
                                                <div>
                                                    <span class="text-danger errorMessage d-none" id="projetError">{{ __("This field is required") }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row align-items-center mx-1"> 
                                            <div class="col-4">
                                                <p class="mb-md-0">Mode de chauffage*</p>
                                            </div>
                                            <div class="col-8">
                                                <select class="select2_select_option custom-select shadow-none form-control input-field" id="mode_de_chauffage">
                                                    <option value="" selected>{{ __('Select') }}</option> 
                                                </select>
                                                <div>
                                                    <span class="text-danger errorMessage d-none" id="mode_de_chauffageError">{{ __("This field is required") }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row align-items-center mx-1"> 
                                            <div class="col-4">
                                                <p class="mb-md-0">Cumac</p>
                                            </div>
                                            <div class="col-8">
                                                <input type="text" disabled id="result" class="form-control shadow-none">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row align-items-center mx-1"> 
                                            <div class="col-4">
                                                <p class="mb-md-0">VT</p>
                                            </div>
                                            <div class="col-8">
                                                <textarea class="form-control shadow-none" rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group text-right mr-3">
                                        <button type="button" id="getResult" class="btn btn-primary shadow-none">{{ __('Submit') }}</button>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
			</div>
		</section>
@include('includes.crm.footer-contact')

@endsection

@push('js')
<script>
    $(document).ready(function(){
        function formatCurrency(number) {
            if(number){
                // Format the number with two decimal places, a comma as the decimal point, and a space as the thousand separator
                const formattedNumber = parseFloat(number).toLocaleString('en-GB', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2,
                }).replace(/,/g, ' ').replace(/\./, ',');

                // Replace the last space character with a non-breaking space
                const lastSpacePosition = formattedNumber.lastIndexOf(' ');
                console.log(lastSpacePosition);
                const formattedNumberWithNbsp = lastSpacePosition !== -1
                    ? formattedNumber.substring(0, lastSpacePosition) + '\u00A0' + formattedNumber.substring(lastSpacePosition + 1)
                    : formattedNumber;

                // Add the Euro symbol to the formatted number
                return  formattedNumberWithNbsp;
            }else{
                return 0;
            }
        } 
        function shabRestriction() {
             let precarite = $('#precarite').val();
             let projet = $('#projet').val();
             let mode_de_chauffage = $('#mode_de_chauffage').find(':selected').attr('data-value');
             let shab = +$('#shab').val();
             if(precarite && (projet == '2' || projet == '4') && mode_de_chauffage && shab && shab > 225){
                if(precarite == '54'){
                    if(mode_de_chauffage == 'Bois' && shab > 225){
                        $('#shab').val(225);
                    }else if(mode_de_chauffage == 'Fioul' && shab > 230){
                        $('#shab').val(230);
                    }else if(mode_de_chauffage == 'GAZ' && shab > 240){
                        $('#shab').val(240);
                    }else{
                        if(projet == '4'){
                            if(mode_de_chauffage == 'GAZ A CONDENSATION/Electrique' && shab > 260){
                                $('#shab').val(260);
                            }
                        }else{
                            if((mode_de_chauffage == 'GAZ A CONDENSATION' || mode_de_chauffage == 'ELECTRIQUE')  && shab > 260){
                                $('#shab').val(260);
                            }
                        }
                    } 
                }else{
                    if(mode_de_chauffage == 'Bois' && shab > 260){
                        $('#shab').val(260);
                    }else if(mode_de_chauffage == 'Fioul' && shab > 270){
                        $('#shab').val(270);
                    }else if(mode_de_chauffage == 'GAZ' && shab > 280){
                        $('#shab').val(280);
                    }else{
                        if(projet == '4'){
                            if(mode_de_chauffage == 'GAZ A CONDENSATION/Electrique' && shab > 300){
                                $('#shab').val(300);
                            }
                        }else{
                            if((mode_de_chauffage == 'GAZ A CONDENSATION' || mode_de_chauffage == 'ELECTRIQUE') && shab > 300){
                                $('#shab').val(300);
                            }
                        }
                    }
                }
             }
        } 
        $('body').on('keyup', '#shab', function(){
            shabRestriction();
        }); 
        $('body').on('change', '#mode_de_chauffage, #precarite', function(){
            shabRestriction();
        }); 
        $('body').on('change', '#projet', function(){
            $.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});

			$.ajax({
				type: "POST",
				url: "{{ route('cumac.project.change') }}",
				data: {
					id 	: $(this).val(),
				},
				success: function (response) {
					$('#mode_de_chauffage').html(response);
                    shabRestriction();
				},
				error: function(response){
                    
				}
			});

        }); 
        $('body').on('click', '#getResult', function(){
            let precarite = $('#precarite').val();
            let shab = $('#shab').val();
            let projet = $('#projet').val();
            let mode_de_chauffage = $('#mode_de_chauffage').val(); 
            let result = 0;
            $(".errorMessage").addClass('d-none');

            if(!precarite){ 
                $('#precariteError').removeClass('d-none');
            }else if(!shab){ 
                $('#shabError').removeClass('d-none');
            }else if(!projet){ 
                $('#projetError').removeClass('d-none');
            }else if(!mode_de_chauffage){ 
                $('#mode_de_chauffageError').removeClass('d-none');
            }else{ 
                result = +precarite * +shab * +mode_de_chauffage;
                $("#result").val(formatCurrency(result));
            }


        }); 

	});

</script>
@endpush
