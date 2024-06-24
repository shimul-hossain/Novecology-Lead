{{-- Main Layouts --}}
@extends('layouts.master')

{{-- Title part  --}}
@section('title')
    Calculette BAR TH 164
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
                                <h3 class="card-title text-center text-white mb-0">SIMULATEUR BAR TH 164 - RÉNOVATION PERFORMANTE D'UNE MAISON INDIVIDUELLE</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row align-items-center">
                                        <div class="col-12 mb-3">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="mb-md-0">Simulation CUMAC</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="mb-md-0"><a href="http://simulation.globalenr.com/" target="_blank">Simulez votre CUMAC pour votre chantier</a></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="mb-md-0">CUMAC</p>
                                        </div>
                                        <div class="col-md-6 select2--danger">
                                            <input type="number" value="0" id="cumac" class="form-control shadow-none">
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <p class="mb-md-0">Montant Aides CEE</p>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" value="0" id="MontantAidesCEE" class="form-control shadow-none" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-dark pb-1"></div>
                            <div class="excel-table-wrapper">
                                <input type="checkbox" class="excel-table-checkbox" data-price-type="single" data-rules-type="1" data-price="{{ $prices->where('slug', 'PAC_AIR_EAU_LG')->first()->price }}" id="excel-table-1-checkbox">
                                <div class="container-fluid excel-table-checkbox-container">
                                    <div class="excel-table row">
                                        <div class="col-md-1 excel-table__header-col">
                                            <div class="excel-table__header">
                                                <label class="excel-table-label" for="excel-table-1-checkbox"></label>
                                            </div>
                                        </div>
                                        <div class="col-md excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong>PAC AIR EAU LG</strong>
                                            </div>
                                            <div class="excel-table__body">
                                                <strong>Quantité</strong>
                                            </div>
                                        </div>
                                        <div class="col-lg excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong class="excel-table-toggle-text">
                                                    <span class="excel-table-toggle-text__before">Faux</span>
                                                    <span class="excel-table-toggle-text__after">Vrai</span>
                                                </strong>
                                            </div>
                                            <div class="excel-table__body select2--danger">
                                                <select class="select2_select_option custom-select shadow-none form-control input-field">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong class="text-transparent user-select-none">.</strong>
                                            </div>
                                            <div class="excel-table__body"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="excel-table-wrapper">
                                <input type="checkbox" class="excel-table-checkbox" data-price-type="single" data-rules-type="1" data-price="{{ $prices->where('slug', 'CHAUDIÈRE_À_GRANULÉS_-_22kW')->first()->price }}" id="excel-table-11-checkbox">
                                <div class="container-fluid excel-table-checkbox-container">
                                    <div class="excel-table row">
                                        <div class="col-md-1 excel-table__header-col">
                                            <div class="excel-table__header">
                                                <label class="excel-table-label" for="excel-table-11-checkbox"></label>
                                            </div>
                                        </div>
                                        <div class="col-md excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong>CHAUDIÈRE À GRANULÉS - 22kW</strong>
                                            </div>
                                            <div class="excel-table__body">
                                                <strong>Quantité</strong>
                                            </div>
                                        </div>
                                        <div class="col-lg excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong class="excel-table-toggle-text">
                                                    <span class="excel-table-toggle-text__before">Faux</span>
                                                    <span class="excel-table-toggle-text__after">Vrai</span>
                                                </strong>
                                            </div>
                                            <div class="excel-table__body select2--danger">
                                                <select class="select2_select_option custom-select shadow-none form-control input-field">
                                                    <option value="1">1</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong class="text-transparent user-select-none">.</strong>
                                            </div>
                                            <div class="excel-table__body"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="excel-table-wrapper">
                                <input type="checkbox" class="excel-table-checkbox" data-price-type="single" data-price="{{ $prices->where('slug', 'Ballon_Thermodynamique')->first()->price }}" id="excel-table-2-checkbox">
                                <div class="container-fluid excel-table-checkbox-container">
                                    <div class="excel-table row">
                                        <div class="col-md-1 excel-table__header-col">
                                            <div class="excel-table__header">
                                                <label class="excel-table-label" for="excel-table-2-checkbox"></label>
                                            </div>
                                        </div>
                                        <div class="col-md excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong>Ballon Thermodynamique</strong>
                                            </div>
                                            <div class="excel-table__body">
                                                <strong>Quantité</strong>
                                            </div>
                                        </div>
                                        <div class="col-lg excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong class="excel-table-toggle-text">
                                                    <span class="excel-table-toggle-text__before">Faux</span>
                                                    <span class="excel-table-toggle-text__after">Vrai</span>
                                                </strong>
                                            </div>
                                            <div class="excel-table__body select2--danger">
                                                <select class="select2_select_option custom-select shadow-none form-control input-field">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong class="text-transparent user-select-none">.</strong>
                                            </div>
                                            <div class="excel-table__body"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="excel-table-wrapper">
                                <input type="checkbox" class="excel-table-checkbox" data-rules-type="2" data-price-type="multiple" data-price="000" id="excel-table-3-checkbox">
                                <div class="container-fluid excel-table-checkbox-container">
                                    <div class="excel-table row">
                                        <div class="col-md-1 excel-table__header-col">
                                            <div class="excel-table__header">
                                                <label class="excel-table-label" for="excel-table-3-checkbox"></label>
                                            </div>
                                        </div>
                                        <div class="col-md excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong>PAC AIR AIR DAIKIN</strong>
                                            </div>
                                            <div class="excel-table__body">
                                                <strong>Quantité SPLIT</strong>
                                            </div>
                                        </div>
                                        <div class="col-lg excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong class="excel-table-toggle-text">
                                                    <span class="excel-table-toggle-text__before">Faux</span>
                                                    <span class="excel-table-toggle-text__after">Vrai</span>
                                                </strong>
                                            </div>
                                            <div class="excel-table__body select2--danger">
                                                <select class="select2_select_option custom-select shadow-none form-control input-field">
                                                    @for ($i = 2; $i < 12; $i++)
                                                        <option {{ $i == 5 ? 'selected':'' }} value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong class="text-transparent user-select-none">.</strong>
                                            </div>
                                            <div class="excel-table__body"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="excel-table-wrapper">
                                <input type="checkbox" class="excel-table-checkbox" data-price-type="single" data-price="{{ $prices->where('slug', 'POELE_A_GRANULES_8kW')->first()->price }}" id="excel-table-4-checkbox">
                                <div class="container-fluid excel-table-checkbox-container">
                                    <div class="excel-table row">
                                        <div class="col-md-1 excel-table__header-col">
                                            <div class="excel-table__header">
                                                <label class="excel-table-label" for="excel-table-4-checkbox"></label>
                                            </div>
                                        </div>
                                        <div class="col-md excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong>POELE A GRANULES 8kW</strong>
                                            </div>
                                            <div class="excel-table__body">
                                                <strong>Quantité</strong>
                                            </div>
                                        </div>
                                        <div class="col-lg excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong class="excel-table-toggle-text">
                                                    <span class="excel-table-toggle-text__before">Faux</span>
                                                    <span class="excel-table-toggle-text__after">Vrai</span>
                                                </strong>
                                            </div>
                                            <div class="excel-table__body select2--danger">
                                                <select class="select2_select_option custom-select shadow-none form-control input-field">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong class="text-transparent user-select-none">.</strong>
                                            </div>
                                            <div class="excel-table__body"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="excel-table-wrapper">
                                <input type="checkbox" class="excel-table-checkbox" data-rules-type="2" data-price-type="multiple" data-price="000" id="excel-table-17-checkbox">
                                <div class="container-fluid excel-table-checkbox-container">
                                    <div class="excel-table row">
                                        <div class="col-md-1 excel-table__header-col">
                                            <div class="excel-table__header">
                                                <label class="excel-table-label" for="excel-table-17-checkbox"></label>
                                            </div>
                                        </div>
                                        <div class="col-md excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong>PAC AIR AIR AIRWELL</strong>
                                            </div>
                                            <div class="excel-table__body">
                                                <strong>Quantité SPLIT</strong>
                                            </div>
                                        </div>
                                        <div class="col-lg excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong class="excel-table-toggle-text">
                                                    <span class="excel-table-toggle-text__before">Faux</span>
                                                    <span class="excel-table-toggle-text__after">Vrai</span>
                                                </strong>
                                            </div>
                                            <div class="excel-table__body select2--danger">
                                                <select class="select2_select_option custom-select shadow-none form-control input-field">
                                                    @for ($i = 2; $i < 12; $i++)
                                                        <option {{ $i == 5 ? 'selected':'' }} value="AIRWELL-{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong class="text-transparent user-select-none">.</strong>
                                            </div>
                                            <div class="excel-table__body"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="excel-table-wrapper">
                                <input type="checkbox" class="excel-table-checkbox" data-price-type="single" data-price="{{ $prices->where('slug', 'ITE')->first()->price }}" id="excel-table-5-checkbox">
                                <div class="container-fluid excel-table-checkbox-container">
                                    <div class="excel-table row">
                                        <div class="col-md-1 excel-table__header-col">
                                            <div class="excel-table__header">
                                                <label class="excel-table-label" for="excel-table-5-checkbox"></label>
                                            </div>
                                        </div>
                                        <div class="col-md excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong>ITE</strong>
                                            </div>
                                            <div class="excel-table__body">
                                                <strong>Surface en m2</strong>
                                            </div>
                                        </div>
                                        <div class="col-lg excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong class="excel-table-toggle-text">
                                                    <span class="excel-table-toggle-text__before">Faux</span>
                                                    <span class="excel-table-toggle-text__after">Vrai</span>
                                                </strong>
                                            </div>
                                            <div class="excel-table__body select2--danger">
                                                <input type="hidden" value="90" class="input-field">
                                                <input type="text" class="form-control shadow-none inputField" value="90 m2">
                                            </div>
                                        </div>
                                        <div class="col-lg-2 excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong class="text-transparent user-select-none">.</strong>
                                            </div>
                                        </div>
                                        <div class="col-12 my-2">
                                            <span> Si les travaux couvre au moins 75 % de la surface totale, la surface total doit être au minimum de : <span class="parcentValue">120,00</span> m2</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="excel-table-wrapper">
                                <input type="checkbox" class="excel-table-checkbox" data-price-type="single" data-price="{{ $prices->where('slug', '101_Comble_Deroule_ou_Soufflage')->first()->price }}" id="excel-table-6-checkbox">
                                <div class="container-fluid excel-table-checkbox-container">
                                    <div class="excel-table row">
                                        <div class="col-md-1 excel-table__header-col">
                                            <div class="excel-table__header">
                                                <label class="excel-table-label" for="excel-table-6-checkbox"></label>
                                            </div>
                                        </div>
                                        <div class="col-md excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong>101 : Comble Deroule ou Soufflage</strong>
                                            </div>
                                            <div class="excel-table__body">
                                                <strong>Surface en m2</strong>
                                            </div>
                                        </div>
                                        <div class="col-lg excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong class="excel-table-toggle-text">
                                                    <span class="excel-table-toggle-text__before">Faux</span>
                                                    <span class="excel-table-toggle-text__after">Vrai</span>
                                                </strong>
                                            </div>
                                            <div class="excel-table__body select2--danger">
                                                <input type="hidden" value="70" class="input-field">
                                                <input type="text" class="form-control shadow-none inputField" value="70 m2">
                                            </div>
                                        </div>
                                        <div class="col-lg-2 excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong class="text-transparent user-select-none">.</strong>
                                            </div>
                                        </div>
                                        <div class="col-12 my-2">
                                            <span>Si les travaux couvre au moins 75 % de la surface totale, la surface total doit être au minimum de : <span class="parcentValue">93,33</span> m2</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="excel-table-wrapper">
                                <input type="checkbox" class="excel-table-checkbox" data-price-type="single" data-price="{{ $prices->where('slug', '101_Rampant_Tetris')->first()->price }}" id="excel-table-7-checkbox">
                                <div class="container-fluid excel-table-checkbox-container">
                                    <div class="excel-table row">
                                        <div class="col-md-1 excel-table__header-col">
                                            <div class="excel-table__header">
                                                <label class="excel-table-label" for="excel-table-7-checkbox"></label>
                                            </div>
                                        </div>
                                        <div class="col-md excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong>101 : Rampant Tetris</strong>
                                            </div>
                                            <div class="excel-table__body">
                                                <strong>Surface en m2</strong>
                                            </div>
                                        </div>
                                        <div class="col-lg excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong class="excel-table-toggle-text">
                                                    <span class="excel-table-toggle-text__before">Faux</span>
                                                    <span class="excel-table-toggle-text__after">Vrai</span>
                                                </strong>
                                            </div>
                                            <div class="excel-table__body select2--danger">
                                                <input type="hidden" value="50" class="input-field">
                                                <input type="text" class="form-control shadow-none inputField" value="50 m2">
                                            </div>
                                        </div>
                                        <div class="col-lg-2 excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong class="text-transparent user-select-none">.</strong>
                                            </div>
                                        </div>
                                        <div class="col-12 my-2">
                                            <span>Si les travaux couvre au moins 75 % de la surface totale, la surface total doit être au minimum de : <span class="parcentValue">66,67</span> m2</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="excel-table-wrapper">
                                <input type="checkbox" class="excel-table-checkbox" data-price-type="single" data-price="{{ $prices->where('slug', '101_Deroule_Placo')->first()->price }}" id="excel-table-8-checkbox">
                                <div class="container-fluid excel-table-checkbox-container">
                                    <div class="excel-table row">
                                        <div class="col-md-1 excel-table__header-col">
                                            <div class="excel-table__header">
                                                <label class="excel-table-label" for="excel-table-8-checkbox"></label>
                                            </div>
                                        </div>
                                        <div class="col-md excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong>101 : Deroule + Placo</strong>
                                            </div>
                                            <div class="excel-table__body">
                                                <strong>Surface en m2</strong>
                                            </div>
                                        </div>
                                        <div class="col-lg excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong class="excel-table-toggle-text">
                                                    <span class="excel-table-toggle-text__before">Faux</span>
                                                    <span class="excel-table-toggle-text__after">Vrai</span>
                                                </strong>
                                            </div>
                                            <div class="excel-table__body select2--danger">
                                                <input type="hidden" value="100" class="input-field">
                                                <input type="text" class="form-control shadow-none inputField" value="100 m2">
                                            </div>
                                        </div>
                                        <div class="col-lg-2 excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong class="text-transparent user-select-none">.</strong>
                                            </div>
                                        </div>
                                        <div class="col-12 my-2">
                                            <span>Si les travaux couvre au moins 75 % de la surface totale, la surface total doit être au minimum de : <span class="parcentValue">133,33</span> m2</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="excel-table-wrapper">
                                <input type="checkbox" class="excel-table-checkbox" data-price-type="single" data-price="{{ $prices->where('slug', '102_Murs_par_intérieur')->first()->price }}" id="excel-table-12-checkbox">
                                <div class="container-fluid excel-table-checkbox-container">
                                    <div class="excel-table row">
                                        <div class="col-md-1 excel-table__header-col">
                                            <div class="excel-table__header">
                                                <label class="excel-table-label" for="excel-table-12-checkbox"></label>
                                            </div>
                                        </div>
                                        <div class="col-md excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong>102 : Murs par l'intérieur</strong>
                                            </div>
                                            <div class="excel-table__body">
                                                <strong>Surface en m2</strong>
                                            </div>
                                        </div>
                                        <div class="col-lg excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong class="excel-table-toggle-text">
                                                    <span class="excel-table-toggle-text__before">Faux</span>
                                                    <span class="excel-table-toggle-text__after">Vrai</span>
                                                </strong>
                                            </div>
                                            <div class="excel-table__body select2--danger">
                                                <input type="hidden" value="100" class="input-field">
                                                <input type="text" class="form-control shadow-none inputField" value="100 m2">
                                            </div>
                                        </div>
                                        <div class="col-lg-2 excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong class="text-transparent user-select-none">.</strong>
                                            </div>
                                        </div>
                                        <div class="col-12 my-2">
                                            <span>Si les travaux couvre au moins 75 % de la surface totale, la surface total doit être au minimum de : <span class="parcentValue">133,33</span> m2</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="excel-table-wrapper">
                                <input type="checkbox" class="excel-table-checkbox" data-price-type="single" data-price="{{ $prices->where('slug', '103_Polystyrene')->first()->price }}" id="excel-table-9-checkbox">
                                <div class="container-fluid excel-table-checkbox-container">
                                    <div class="excel-table row">
                                        <div class="col-md-1 excel-table__header-col">
                                            <div class="excel-table__header">
                                                <label class="excel-table-label" for="excel-table-9-checkbox"></label>
                                            </div>
                                        </div>
                                        <div class="col-md excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong>103 : Polystyrene</strong>
                                            </div>
                                            <div class="excel-table__body">
                                                <strong>Surface en m2</strong>
                                            </div>
                                        </div>
                                        <div class="col-lg excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong class="excel-table-toggle-text">
                                                    <span class="excel-table-toggle-text__before">Faux</span>
                                                    <span class="excel-table-toggle-text__after">Vrai</span>
                                                </strong>
                                            </div>
                                            <div class="excel-table__body select2--danger">
                                                <input type="hidden" value="70" class="input-field">
                                                <input type="text" class="form-control shadow-none inputField" value="70 m2">
                                            </div>
                                        </div>
                                        <div class="col-lg-2 excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong class="text-transparent user-select-none">.</strong>
                                            </div>
                                        </div>
                                        <div class="col-12 my-2">
                                            <span>Si les travaux couvre au moins 75 % de la surface totale, la surface total doit être au minimum de : <span class="parcentValue">93,33</span> m2</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="excel-table-wrapper">
                                <input type="checkbox" class="excel-table-checkbox" data-price-type="single" data-price="{{ $prices->where('slug', '103_Tetris')->first()->price }}" id="excel-table-10-checkbox">
                                <div class="container-fluid excel-table-checkbox-container">
                                    <div class="excel-table row">
                                        <div class="col-md-1 excel-table__header-col">
                                            <div class="excel-table__header">
                                                <label class="excel-table-label" for="excel-table-10-checkbox"></label>
                                            </div>
                                        </div>
                                        <div class="col-md excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong>103 : Tetris</strong>
                                            </div>
                                            <div class="excel-table__body">
                                                <strong>Surface en m2</strong>
                                            </div>
                                        </div>
                                        <div class="col-lg excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong class="excel-table-toggle-text">
                                                    <span class="excel-table-toggle-text__before">Faux</span>
                                                    <span class="excel-table-toggle-text__after">Vrai</span>
                                                </strong>
                                            </div>
                                            <div class="excel-table__body select2--danger">
                                                <input type="hidden" value="100" class="input-field">
                                                <input type="text" class="form-control shadow-none inputField" value="100 m2">
                                            </div>
                                        </div>
                                        <div class="col-lg-2 excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong class="text-transparent user-select-none">.</strong>
                                            </div>
                                        </div>
                                        <div class="col-12 my-2">
                                            <span>Si les travaux couvre au moins 75 % de la surface totale, la surface total doit être au minimum de : <span class="parcentValue">133,33</span> m2</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="excel-table-wrapper">
                                <input type="checkbox" class="excel-table-checkbox" data-price-type="single" data-price="{{ $prices->where('slug', 'Forfait_Gond')->first()->price }}" id="excel-table-13-checkbox">
                                <div class="container-fluid excel-table-checkbox-container">
                                    <div class="excel-table row">
                                        <div class="col-md-1 excel-table__header-col">
                                            <div class="excel-table__header">
                                                <label class="excel-table-label" for="excel-table-13-checkbox"></label>
                                            </div>
                                        </div>
                                        <div class="col-md excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong>Forfait Gond</strong>
                                            </div>
                                            <div class="excel-table__body">
                                                <strong>Nombre</strong>
                                            </div>
                                        </div>
                                        <div class="col-lg excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong class="excel-table-toggle-text">
                                                    <span class="excel-table-toggle-text__before">Faux</span>
                                                    <span class="excel-table-toggle-text__after">Vrai</span>
                                                </strong>
                                            </div>
                                            <div class="excel-table__body select2--danger">
                                                <input type="hidden" value="100" class="input-field">
                                                <input type="text" class="form-control shadow-none inputField" data-input-type="number" value="100">
                                            </div>
                                        </div>
                                        <div class="col-lg-2 excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong class="text-transparent user-select-none">.</strong>
                                            </div>
                                        </div>
                                        <div class="col-12 my-2">
                                            <span>Si les travaux couvre au moins 75 % de la surface totale, la surface total doit être au minimum de : <span class="parcentValue">133,33</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="excel-table-wrapper">
                                <input type="checkbox" class="excel-table-checkbox" data-price-type="single" data-price="{{ $prices->where('slug', 'Forfait_Zone_ITE_hors_zone_CEE')->first()->price }}" id="excel-table-14-checkbox">
                                <div class="container-fluid excel-table-checkbox-container">
                                    <div class="excel-table row">
                                        <div class="col-md-1 excel-table__header-col">
                                            <div class="excel-table__header">
                                                <label class="excel-table-label" for="excel-table-14-checkbox"></label>
                                            </div>
                                        </div>
                                        <div class="col-md excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong>Forfait Zone ITE hors zone CEE</strong>
                                            </div>
                                            <div class="excel-table__body">
                                                <strong>Surface en m2</strong>
                                            </div>
                                        </div>
                                        <div class="col-lg excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong class="excel-table-toggle-text">
                                                    <span class="excel-table-toggle-text__before">Faux</span>
                                                    <span class="excel-table-toggle-text__after">Vrai</span>
                                                </strong>
                                            </div>
                                            <div class="excel-table__body select2--danger">
                                                <input type="hidden" value="100" class="input-field">
                                                <input type="text" class="form-control shadow-none inputField" value="100 m2">
                                            </div>
                                        </div>
                                        <div class="col-lg-2 excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong class="text-transparent user-select-none">.</strong>
                                            </div>
                                        </div>
                                        <div class="col-12 my-2">
                                            <span>Si les travaux couvre au moins 75 % de la surface totale, la surface total doit être au minimum de : <span class="parcentValue">133,33</span> m2</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="excel-table-wrapper">
                                <input type="checkbox" class="excel-table-checkbox" data-price-type="single" data-price="{{ $prices->where('slug', 'Forfait_Crepris_hors_zone_CEE')->first()->price }}" id="excel-table-15-checkbox">
                                <div class="container-fluid excel-table-checkbox-container">
                                    <div class="excel-table row">
                                        <div class="col-md-1 excel-table__header-col">
                                            <div class="excel-table__header">
                                                <label class="excel-table-label" for="excel-table-15-checkbox"></label>
                                            </div>
                                        </div>
                                        <div class="col-md excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong>Forfait Crepris hors zone CEE</strong>
                                            </div>
                                            <div class="excel-table__body">
                                                <strong>Surface en m2</strong>
                                            </div>
                                        </div>
                                        <div class="col-lg excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong class="excel-table-toggle-text">
                                                    <span class="excel-table-toggle-text__before">Faux</span>
                                                    <span class="excel-table-toggle-text__after">Vrai</span>
                                                </strong>
                                            </div>
                                            <div class="excel-table__body select2--danger">
                                                <input type="hidden" value="100" class="input-field">
                                                <input type="text" class="form-control shadow-none inputField" value="100 m2">
                                            </div>
                                        </div>
                                        <div class="col-lg-2 excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong class="text-transparent user-select-none">.</strong>
                                            </div>
                                        </div>
                                        <div class="col-12 my-2">
                                            <span>Si les travaux couvre au moins 75 % de la surface totale, la surface total doit être au minimum de : <span class="parcentValue">133,33</span> m2</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="excel-table-wrapper">
                                <input type="checkbox" class="excel-table-checkbox" data-price-type="single" data-price="{{ $prices->where('slug', 'Forfait_raccordement_eau')->first()->price }}" id="excel-table-16-checkbox">
                                <div class="container-fluid excel-table-checkbox-container">
                                    <div class="excel-table row">
                                        <div class="col-md-1 excel-table__header-col">
                                            <div class="excel-table__header">
                                                <label class="excel-table-label" for="excel-table-16-checkbox"></label>
                                            </div>
                                        </div>
                                        <div class="col-md excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong>Forfait raccordement eau</strong>
                                            </div>
                                            <div class="excel-table__body">
                                                <strong>Nombre</strong>
                                            </div>
                                        </div>
                                        <div class="col-lg excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong class="excel-table-toggle-text">
                                                    <span class="excel-table-toggle-text__before">Faux</span>
                                                    <span class="excel-table-toggle-text__after">Vrai</span>
                                                </strong>
                                            </div>
                                            <div class="excel-table__body select2--danger">
                                                <select class="select2_select_option custom-select shadow-none form-control input-field">
                                                    <option value="1">1</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 excel-table__header-col">
                                            <div class="excel-table__header">
                                                <strong class="text-transparent user-select-none">.</strong>
                                            </div>
                                            <div class="excel-table__body"></div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="bg-dark pb-1"></div>
                            <div class="container-fluid py-3">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-lg">
                                        <p>Resultat simulation financière</p>
                                        <p>Montant du Reste à Charge</p>
                                    </div>
                                    <div class="col-lg">
                                        <input type="text" id="finalResult" class="form-control shadow-none mb-1" readonly>
                                        <input type="text" id="montantDuReste" class="form-control shadow-none" readonly>
                                    </div>
                                    <div class="col-lg-2"></div>
                                </div>
                            </div>
                            @if (Auth::user()->role == 's_admin' || Auth::user()->bar_th_164 == 'Oui')
                                <div class="container-fluid py-3">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-lg">
                                            <p>BUDGET CHANTIER</p>
                                            <p>COUT TOTAL CHANTIER</p>
                                        </div>
                                        <div class="col-lg">
                                            <input type="text" id="BUDGET_CHANTIER" class="form-control shadow-none mb-1" readonly>
                                            <input type="text" id="COUT_TOTAL_CHANTIER" class="form-control shadow-none" readonly>
                                        </div>
                                        <div class="col-lg-2"></div>
                                    </div>
                                </div>
                            @else
                                <input type="hidden" value="0" id="BUDGET_CHANTIER">
                                <input type="hidden" value="0" id="COUT_TOTAL_CHANTIER">
                            @endif

                            <input type="hidden" value="{{ $prices->where('slug', 'Valeur_GIGA')->first()->price }}" id="Valeur_GIGA">
                            <input type="hidden" value="0" id="CEE_HT">
                            <input type="hidden" value="{{ $prices->where('slug', 'ACQUISITION')->first()->price }}" id="ACQUISITION">
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
                // console.log(lastSpacePosition);
                const formattedNumberWithNbsp = lastSpacePosition !== -1
                    ? formattedNumber.substring(0, lastSpacePosition) + '\u00A0' + formattedNumber.substring(lastSpacePosition + 1)
                    : formattedNumber;

                // Add the Euro symbol to the formatted number
                return  formattedNumberWithNbsp;
            }else{
                return 0;
            }
        }

        function cumacCalculate(){
            let value = $('#cumac').val();
            let rate = 1.055;
            $('.excel-table-checkbox').each(function(){
                if($(this).is(':checked')){
                    if($(this).attr('data-rules-type') && $(this).attr('data-rules-type') == 2){
                        rate = 1.1;
                    }
                }
            });  

            if(value < 0){
                $('#cumac').val(0);
            }
            if(value > 30000000){
                $('#cumac').val(30000000);
            }
            value = $('#cumac').val();
            valeur = +$('#Valeur_GIGA').val();
            let result = (+value) * valeur;
            let cee_ht = (result/rate).toFixed(2);
            let acquisition = +$('#ACQUISITION').val();;
            let budget_chantier = cee_ht - acquisition;
            $("#CEE_HT").val(cee_ht);
            $("#BUDGET_CHANTIER").val(budget_chantier);
            $("#MontantAidesCEE").val(formatCurrency(result)+' €');
            getResult();
        }
        
        function getResult(){

            let multiple_price = {
                @foreach ($prices->where('type', 'multiple') as $price)
                "{{ $price->slug }}": "{{ $price->price }}",
                @endforeach
            };
            

            let result = 0;
            $('.excel-table-checkbox').each(function(){
                if($(this).is(':checked')){
                    if($(this).data('price-type') == 'single'){
                        let price = $(this).data('price');
                        let value = $(this).closest('.excel-table-wrapper').find('.input-field').val();

                        result += (+value) * (+price);
                    }else{
                        let value = $(this).closest('.excel-table-wrapper').find('.input-field').val();
                        let price = +multiple_price[value];
                        result += price;
                    }
                }
            });

            $('#COUT_TOTAL_CHANTIER').val(result);
            let budget_chantier = +$('#BUDGET_CHANTIER').val();
            if(budget_chantier < result){
                $("#finalResult").val('RESTE A CHARGE PAYANT');
                $("#montantDuReste").val(formatCurrency(result - budget_chantier)+' €');
            }else{
                $("#finalResult").val('Eligible 1 euro');
                $("#montantDuReste").val('1 €');
            }
        } 
        $('#cumac').on('input',function(){
            cumacCalculate();
        });
        $('.excel-table-checkbox').click(function(e){
            if($(this).is(':checked')){
                let data = $(this);
                if(data.attr('data-rules-type')){
                    $('.excel-table-checkbox').each(function(){
                        if($(this).is(':checked')){
                            if($(this).attr('data-rules-type') && $(this).attr('data-rules-type') != data.attr('data-rules-type')){
                                e.preventDefault();  
                                data.prop('checked', false);
                            }
                        }
                    }); 
                }
            }
            cumacCalculate();
            // getResult();
        });
        $('.input-field').change(function(){
            getResult();
        });
        $('.inputField').on('focus', function(){
            let hidden_input = $(this).closest('div').find('.input-field');
            $(this).val(hidden_input.val());
            $(this).attr('type', 'number');
        });
        $('.inputField').on('blur', function(){
            let changed_value = +$(this).val() / .75;
            $(this).closest('.excel-table-wrapper').find('.parcentValue').text(formatCurrency(changed_value));

            $(this).closest('div').find('.input-field').val($(this).val());
            $(this).attr('type', 'text');
            if($(this).attr('data-input-type') == 'number'){
                $(this).val($(this).val());
            }else{
                $(this).val($(this).val() + ' m2');
            }
            getResult();
        });

	});

</script>
@endpush
