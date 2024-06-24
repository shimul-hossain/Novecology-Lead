{{-- Main Layouts --}}
@extends('layouts.master')

{{-- Title part  --}}
@section('title')
    Note de dimensionnement
@endsection

{{-- active menu  --}}
@section('calculatteDepertidionIndex')
active
@endsection
@push('css')
    <style>

        .btn-pdf{
            font-size: 25px;
            border: 1px solid black;
            display: inline-flex;
            padding: 5px;
            border-radius: 4px;
            align-items: center;
            justify-content: center;
            position: relative;
            width: 34px;
            height: 40px;
        }

        .btn-pdf *{
            line-height: 0
        }
        .select2--danger .select2-container--default .select2-selection--multiple,
        .select2--danger .select2-container--default .select2-selection--single,
        .datepicker-input,
        .bg--warning{
            background-color: #f8c9cd;
        }
        .select2--danger .select2-container--default .select2-selection--multiple,
        .select2--danger .select2-container--default .select2-selection--single
        {
            /* border-color: #000; */
            border-color: transparent;
        }

        .table--logement thead th,
        .table thead th
        {
            border-bottom: 1px solid #000000;
        }

        .table--logement,
        .table--logement th,
        .table--logement td,
        .table-bordered,
        .table-bordered td,
        .table-bordered th
        {
            border: 1px solid #000000;
        }

        .table--logement th,
        .table--logement td
        {
            padding: 5px;
        }

        .table--logement thead th{
            background-color: #fce5cd;
            font-style: italic;
        }

        .table--logement thead th,
        .table--logement tbody td:last-child,
        .table-bordered thead th,
        .table-bordered tbody td
        {
            text-align: center;
            vertical-align: middle;
        }

        .table-bordered tbody td:first-child{
            font-weight: 700;
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
            <form class="row justify-content-center" method="get" action="{{ route('depertidion.pdf') }}" target="_blank">
                <div class="col-lg-8">
                    <div class="card shadow border-0">
                        <div class="card-header row">
                            <div class="col-2"></div>
                            <div class="col-8">
                                <h3 class="card-title text-center text-white mb-0 py-2" style="background-color: #086FC6">NOTE DE DIMENSIONNEMENT</h3>
                            </div>
                            <div class="col-2 text-right">
                                <button type="submit" class="btn-pdf shadow-none"><i class="bi bi-file-earmark-pdf"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <h2 >Date</h2>
                                    </div>
                                    <div class="col-md-6">
                                        <input id="date" type="date" class="flatpickr form-control shadow-none bg-transparent"placeholder="dd/mm/yyyy">
                                    </div>
                                </div>
                            </div> 
                            <h2 >Bénéficiaire</h2> 
                            <div class="form-group">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <p class="mb-md-0">Nom</p>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="Nom" class="form-control shadow-none bg--warning">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <p class="mb-md-0">Adresse</p>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="Adresse" class="form-control shadow-none bg--warning">
                                    </div>
                                </div>
                            </div>
                            <h2 >Caractéristique de logement</h2> 
                            <div class="form-group">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <p class="mb-md-0">Émetteur de chauffage</p>
                                    </div>
                                    <div class="col-md-6 select2--danger">
                                        <select data-placeholder="{{ __('Select') }}" class="select2_select_option custom-select shadow-none form-control" multiple>
                                             <option value="Radiateur Acier">Radiateur Acier</option>
                                             <option value="Radiateur fonte">Radiateur fonte</option>
                                             <option value="Radiateur aluminium">Radiateur aluminium</option>
                                             <option value="Plancher">Plancher</option>
                                             <option value="chauffant">chauffant</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <p class="mb-md-0">M2 superficie à chauffer</p>
                                    </div>
                                    <div class="col-md-6 select2--danger">
                                        <select id="M2SuperficieChauffer" name="M2_superficie_à_chauffer" class="select2_select_option custom-select shadow-none form-control">
                                            @for ($i = 0; $i < 1001; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <p class="mb-md-0">Hauteur sous plafond</p>
                                    </div>
                                    <div class="col-md-6 select2--danger">
                                        <select id="HauteurSousPlafond" name="Hauteur_sous_plafond" class="select2_select_option custom-select shadow-none form-control">
                                            @for ($i = 0; $i < 20.1; $i+= .1)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <p class="mb-md-0">Volume à chauffer <br>
                                        <small><em> Surface chauffée x Hauteur sous plafond
                                        </em></small></p>
                                </div>
                                <div class="col-md-6">
                                    <input id="VOLUME_EN_M3" type="number" name="Volume_à_chauffer" value="0" class="form-control shadow-none" readonly>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="bg-dark pb-1"></div> --}}
                        <h2 class="ml-3">Coefficient global de déperdition </h2> 
                        <div class="card-body">
                            <div class="table-responsive mb-4">
                                <table class="table table--logement">
                                    <thead>
                                        <tr>
                                            <th>Type de logement</th>
                                            <th>Coefficient d'isolation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Construction ancienne et sans isolation</td>
                                            <td>1,9</td>
                                        </tr>
                                        <tr>
                                            <td>Construction ancienne et très mal isolée</td>
                                            <td>1,7</td>
                                        </tr>
                                        <tr>
                                            <td>Maison ancienne avant 1960 avec mur épais et mal ou pas isolée</td>
                                            <td>1,5</td>
                                        </tr>
                                        <tr>
                                            <td>Construction ancienne et isolée</td>
                                            <td>1,4</td>
                                        </tr>
                                        <tr>
                                            <td>Construction mal isolée et après 1980</td>
                                            <td>1,3</td>
                                        </tr>
                                        <tr>
                                            <td>Construction isolée et après 1980</td>
                                            <td>1,2</td>
                                        </tr>
                                        <tr>
                                            <td>Construction isolée et après 1990</td>
                                            <td>1,1</td>
                                        </tr>
                                        <tr>
                                            <td>Maison RT 2000 <br>pour les habitations "RT2000" réalisées entre 2001 et 2006</td>
                                            <td>0,9</td>
                                        </tr>
                                        <tr>
                                            <td>Maison RT 2005 <br>pour les habitations "RT2005" réalisées entre 2007 et 2012</td>
                                            <td>0,8</td>
                                        </tr>
                                        <tr>
                                            <td>Maison RT 2012 <br>pour les habitations "RT2012" réalisées après 2012</td>
                                            <td>0,4</td>
                                        </tr>
                                        <tr>
                                            <td>Maison BioClimatique avec une isolation</td>
                                            <td>0,3</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <p class="mb-md-0">Coefficient</p>
                                </div>
                                <div class="col-md-6 select2--danger">
                                    <select id="COEFFICIENT_DISOLATION" name="Coefficient" class="select2_select_option custom-select shadow-none form-control">
                                        @php
                                            $data = [0.3, 0.4, 0.8, 0.9, 1.1, 1.2, 1.3, 1.4, 1.5, 1.7, 1.9];
                                        @endphp
                                        @for ($i = 0; $i < count($data); $i ++)
                                            <option value="{{ $data[$i] }}">{{ $data[$i] }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="bg-dark pb-1"></div> --}}
                        <h2 class="ml-3">Zone climatique</h2> 
                        <div class="card-body">
                            <div class="text-center">
                                <img src="{{ asset('dashboard_assets/images/carte-temperature-de-base.png') }}" loading="lazy" alt="map" class="img-fluid user-select-none">
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">Altitude</th>
                                            <th colspan="9">Zones</th>
                                        </tr>
                                        <tr>
                                            <th>A</th>
                                            <th>B</th>
                                            <th>C</th>
                                            <th>D</th>
                                            <th>E</th>
                                            <th>F</th>
                                            <th>G</th>
                                            <th>H</th>
                                            <th>I</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>0 à 200m</td>
                                            <td>-2</td>
                                            <td>-4</td>
                                            <td>-5</td>
                                            <td>-7</td>
                                            <td>-8</td>
                                            <td>-9</td>
                                            <td>-10</td>
                                            <td>-12</td>
                                            <td>-15</td>
                                        </tr>
                                        <tr>
                                            <td>201 à 400m</td>
                                            <td>-4</td>
                                            <td>-5</td>
                                            <td>-6</td>
                                            <td>-8</td>
                                            <td>-9</td>
                                            <td>-10</td>
                                            <td>-11</td>
                                            <td>-13</td>
                                            <td>-15</td>
                                        </tr>
                                        <tr>
                                            <td>401 à 600m</td>
                                            <td>-6</td>
                                            <td>-6</td>
                                            <td>-7</td>
                                            <td>-9</td>
                                            <td>-11</td>
                                            <td>-11</td>
                                            <td>-13</td>
                                            <td>-15</td>
                                            <td>-19</td>
                                        </tr>
                                        <tr>
                                            <td>601 à 800m</td>
                                            <td>-8</td>
                                            <td>-7</td>
                                            <td>-8</td>
                                            <td>-11</td>
                                            <td>-13</td>
                                            <td>-12</td>
                                            <td>-14</td>
                                            <td>-17</td>
                                            <td>-21</td>
                                        </tr>
                                        <tr>
                                            <td>801 à 1000m</td>
                                            <td>-10</td>
                                            <td>-8</td>
                                            <td>-9</td>
                                            <td>-13</td>
                                            <td>-15</td>
                                            <td>-13</td>
                                            <td>-17</td>
                                            <td>-19</td>
                                            <td>-23</td>
                                        </tr>
                                        <tr>
                                            <td>1001 à 1200m</td>
                                            <td>-12</td>
                                            <td>-9</td>
                                            <td>-10</td>
                                            <td>-14</td>
                                            <td>-17</td>
                                            <td></td>
                                            <td>-19</td>
                                            <td>-21</td>
                                            <td>-24</td>
                                        </tr>
                                        <tr>
                                            <td>1201 à 1400m</td>
                                            <td>-14</td>
                                            <td>-10</td>
                                            <td>-11</td>
                                            <td>-15</td>
                                            <td>-19</td>
                                            <td></td>
                                            <td>-21</td>
                                            <td>-23</td>
                                            <td>-25</td>
                                        </tr>
                                        <tr>
                                            <td>1401 à 1600m</td>
                                            <td>-16</td>
                                            <td></td>
                                            <td>-12</td>
                                            <td></td>
                                            <td>-21</td>
                                            <td></td>
                                            <td>-23</td>
                                            <td>-24</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>1601 à 1800m</td>
                                            <td>-18</td>
                                            <td></td>
                                            <td>-13</td>
                                            <td></td>
                                            <td>-23</td>
                                            <td></td>
                                            <td>-24</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>1801 à 2000m</td>
                                            <td>-20</td>
                                            <td></td>
                                            <td>-14</td>
                                            <td></td>
                                            <td>-25</td>
                                            <td></td>
                                            <td>-25</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>2001 à 2200m</td>
                                            <td></td>
                                            <td></td>
                                            <td>-15</td>
                                            <td></td>
                                            <td>-27</td>
                                            <td></td>
                                            <td>-29</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <p class="mb-md-0">Zone</p>
                                    </div>
                                    <div class="col-md-6 select2--danger">
                                        <select name="Zone" class="select2_select_option custom-select shadow-none form-control">
                                            <option value="" selected disabled>{{ __('Select') }}</option>
                                            <option value="Zone A">Zone A</option>
                                            <option value="Zone B">Zone B</option>
                                            <option value="Zone C">Zone C</option>
                                            <option value="Zone D">Zone D</option>
                                            <option value="Zone E">Zone E</option>
                                            <option value="Zone F">Zone F</option>
                                            <option value="Zone G">Zone G</option>
                                            <option value="Zone H">Zone H</option>
                                            <option value="Zone I">Zone I</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <p class="mb-md-0">Altitude</p>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="number" name="Altitude" step="any" value="0" class="form-control shadow-none bg--warning">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <p class="mb-md-0">Température extérieure de base</p>
                                    </div>
                                    <div class="col-md-6 select2--danger">
                                        <select id="TemperatureDeReference" name="Température_extérieure_de_base" class="select2_select_option custom-select shadow-none form-control">
                                            @for ($i = 0; $i > -51; $i--)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <p class="mb-md-0">Température ambiante souhaitée</p>
                                    </div>
                                    <div class="col-md-6 select2--danger">
                                        <select id="TemperatureSouhaité" name="Température_ambiante_souhaitée" class="select2_select_option custom-select shadow-none form-control">
                                            @for ($i=17; $i<24; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <p class="mb-md-0">Ecart température.</p>
                                </div>
                                <div class="col-md-6">
                                    <input id="DELTA_TEMPERATURE" name="Ecart_température" type="number" value="17" class="form-control shadow-none" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="bg-dark pb-1"></div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row align-items-center">
                                    <div class="col-sm-6">
                                        <h2 class="mb-md-0">RESULTAT</h2>
                                    </div>
                                    <div class="col-sm-6">
                                        <h2 class="mb-0 text-danger" id="finalResult"></h2>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                               <p class="text-danger mb-0">SELON LES INFORMATIONS RENSEIGNÉS, LA DÉPERDITION DU LOGEMENT EST ESTIMÉ À <span id="result"></span></p>
                            </div>
                            <div class="form-group">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <p class="mb-md-0">80 % de Puissance</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="mb-0" id="resultWith80">0</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <p class="mb-md-0">100 % de Puissance</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-0" id="resultWith100">0</p>
                                    <input type="hidden" name="resultWith100Input" id="resultWith100Input" value="0">
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
        function result(){
            let value1 = $('#VOLUME_EN_M3').val()
            let value2 = $('#DELTA_TEMPERATURE').val()
            let value3 = $('#COEFFICIENT_DISOLATION').val();
            let result = (+value1)*(+value2)*(+value3);
            let result80 = +result * 0.8;
            $('#result').text(formatCurrency(result) + ' kW');
            $('#finalResult').text(formatCurrency(result) + ' kW');
            $('#resultWith80').text(formatCurrency(result80));
            $('#resultWith100').text(formatCurrency(result));
            $('#resultWith100Input').val(formatCurrency(result));
        }
        $('#M2SuperficieChauffer, #HauteurSousPlafond').change(function(){
           let value1 =  $("#M2SuperficieChauffer").val();
           let value2 =  $("#HauteurSousPlafond").val();
           $('#VOLUME_EN_M3').val((+value1)*(+value2))
           result();
        });
        $('#TemperatureDeReference, #TemperatureSouhaité').change(function(){
           let value1 =  $("#TemperatureDeReference").val();
           let value2 =  $("#TemperatureSouhaité").val();
           $('#DELTA_TEMPERATURE').val(Math.abs((+value1)-(+value2)))
           result();
        });
        $('#COEFFICIENT_DISOLATION').change(function(){
           result();
        });


	});
</script>
@endpush
