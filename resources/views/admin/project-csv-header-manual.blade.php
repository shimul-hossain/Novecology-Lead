<h3 class="mb-2 font-weight-bold">Nom du fichier: {{ $original_file_name }}</h3>
<div class="accordion" id="LeadImportAccordian">
    <div class="card">
      <div class="card-header">
        <h2 class="mb-0">
          <button class="btn btn-block text-left shadow-none text-primary collapse-arrow" type="button" data-toggle="collapse" data-target="#lead_tracking" aria-expanded="true">
            {{ __('Lead Tracking (Form and response)') }}
          </button>
        </h2>
      </div>

      <div id="lead_tracking" class="collapse show" data-parent="#LeadImportAccordian">
        <div class="card-body">
            <div class="database-table-wrapper bg-white">
                <div class="table-responsive simple-bar">
                    <table class="table w-100 mb-0 table-bordered">
                        <thead class="database-table__header">
                            <tr>
                                <th>
                                    Champs CRM
                                </th>
                                <th>
                                    Champs Excel
                                </th>
                                <th>
                                    Exemple
                                </th>
                            </tr>
                        </thead>
                        <tbody class="database-table__body">
                            <tr>
                                <td>
                                     NOM
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select name="Nom" class="leadImportSelectChange form-control shadow-none select2">
                                            <option value="">{{ __('Select') }}</option>
                                            @foreach ($headings as $heading_key => $lead_tracking_header)
                                                @if ($lead_tracking_header)
                                                    <option data-key-value="{{ $heading_key }}" value="{{ $lead_tracking_header }}">{{ str_replace('_', ' ', $lead_tracking_header) }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select class="leadImportSelectExample form-control shadow-none select2 border-0" style="-webkit-appearance: none" readonly disabled>
                                            <option value=""></option>
                                            @foreach ($second_headings as $key => $second_heading)
                                                @if ($second_heading) 
                                                    <option value="{{ $key }}">{{ $second_heading }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                     PRENOM 
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select name="Prenom" class="leadImportSelectChange form-control shadow-none select2">
                                            <option value="">{{ __('Select') }}</option>
                                            @foreach ($headings as $heading_key => $lead_tracking_header)
                                                @if ($lead_tracking_header)
                                                    <option data-key-value="{{ $heading_key }}" value="{{ $lead_tracking_header }}">{{ str_replace('_', ' ', $lead_tracking_header) }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select class="leadImportSelectExample form-control shadow-none select2 border-0" style="-webkit-appearance: none" readonly disabled>
                                            <option value=""></option>
                                            @foreach ($second_headings as $key => $second_heading)
                                                @if ($second_heading) 
                                                    <option value="{{ $key }}">{{ $second_heading }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div> 
                                </td>
                            </tr> 
                            <tr>
                                <td>
                                    PRIX DE VENTE TTC 
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select name="Prix_de_vente_ttc" class="leadImportSelectChange form-control shadow-none select2">
                                            <option value="">{{ __('Select') }}</option>
                                            @foreach ($headings as $heading_key => $lead_tracking_header)
                                                @if ($lead_tracking_header)
                                                    <option data-key-value="{{ $heading_key }}" value="{{ $lead_tracking_header }}">{{ str_replace('_', ' ', $lead_tracking_header) }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select class="leadImportSelectExample form-control shadow-none select2 border-0" style="-webkit-appearance: none" readonly disabled>
                                            <option value=""></option>
                                            @foreach ($second_headings as $key => $second_heading)
                                                @if ($second_heading) 
                                                    <option value="{{ $key }}">{{ $second_heading }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    MPR OUI /NON
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select name="Mpr_status" class="leadImportSelectChange form-control shadow-none select2">
                                            <option value="">{{ __('Select') }}</option>
                                            @foreach ($headings as $heading_key => $lead_tracking_header)
                                                @if ($lead_tracking_header)
                                                    <option data-key-value="{{ $heading_key }}" value="{{ $lead_tracking_header }}">{{ str_replace('_', ' ', $lead_tracking_header) }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select class="leadImportSelectExample form-control shadow-none select2 border-0" style="-webkit-appearance: none" readonly disabled>
                                            <option value=""></option>
                                            @foreach ($second_headings as $key => $second_heading)
                                                @if ($second_heading) 
                                                    <option value="{{ $key }}">{{ $second_heading }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    MANDATAIRE ADMNISTRATIF
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select name="MANDATAIRE_ADMNISTRATIF" class="leadImportSelectChange form-control shadow-none select2">
                                            <option value="">{{ __('Select') }}</option>
                                            @foreach ($headings as $heading_key => $lead_tracking_header)
                                                @if ($lead_tracking_header)
                                                    <option data-key-value="{{ $heading_key }}" value="{{ $lead_tracking_header }}">{{ str_replace('_', ' ', $lead_tracking_header) }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select class="leadImportSelectExample form-control shadow-none select2 border-0" style="-webkit-appearance: none" readonly disabled>
                                            <option value=""></option>
                                            @foreach ($second_headings as $key => $second_heading)
                                                @if ($second_heading) 
                                                    <option value="{{ $key }}">{{ $second_heading }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    MONTANT MPR
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select name="MONTANT_MPR" class="leadImportSelectChange form-control shadow-none select2">
                                            <option value="">{{ __('Select') }}</option>
                                            @foreach ($headings as $heading_key => $lead_tracking_header)
                                                @if ($lead_tracking_header)
                                                    <option data-key-value="{{ $heading_key }}" value="{{ $lead_tracking_header }}">{{ str_replace('_', ' ', $lead_tracking_header) }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select class="leadImportSelectExample form-control shadow-none select2 border-0" style="-webkit-appearance: none" readonly disabled>
                                            <option value=""></option>
                                            @foreach ($second_headings as $key => $second_heading)
                                                @if ($second_heading) 
                                                    <option value="{{ $key }}">{{ $second_heading }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    STATUT MPR
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select name="STATUT_MPR" class="leadImportSelectChange form-control shadow-none select2">
                                            <option value="">{{ __('Select') }}</option>
                                            @foreach ($headings as $heading_key => $lead_tracking_header)
                                                @if ($lead_tracking_header)
                                                    <option data-key-value="{{ $heading_key }}" value="{{ $lead_tracking_header }}">{{ str_replace('_', ' ', $lead_tracking_header) }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select class="leadImportSelectExample form-control shadow-none select2 border-0" style="-webkit-appearance: none" readonly disabled>
                                            <option value=""></option>
                                            @foreach ($second_headings as $key => $second_heading)
                                                @if ($second_heading) 
                                                    <option value="{{ $key }}">{{ $second_heading }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Montant C.E.E
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select name="Montant_CEE" class="leadImportSelectChange form-control shadow-none select2">
                                            <option value="">{{ __('Select') }}</option>
                                            @foreach ($headings as $heading_key => $lead_tracking_header)
                                                @if ($lead_tracking_header)
                                                    <option data-key-value="{{ $heading_key }}" value="{{ $lead_tracking_header }}">{{ str_replace('_', ' ', $lead_tracking_header) }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select class="leadImportSelectExample form-control shadow-none select2 border-0" style="-webkit-appearance: none" readonly disabled>
                                            <option value=""></option>
                                            @foreach ($second_headings as $key => $second_heading)
                                                @if ($second_heading) 
                                                    <option value="{{ $key }}">{{ $second_heading }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Montant FINANCEMENT
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select name="Montant_FINANCEMENT" class="leadImportSelectChange form-control shadow-none select2">
                                            <option value="">{{ __('Select') }}</option>
                                            @foreach ($headings as $heading_key => $lead_tracking_header)
                                                @if ($lead_tracking_header)
                                                    <option data-key-value="{{ $heading_key }}" value="{{ $lead_tracking_header }}">{{ str_replace('_', ' ', $lead_tracking_header) }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select class="leadImportSelectExample form-control shadow-none select2 border-0" style="-webkit-appearance: none" readonly disabled>
                                            <option value=""></option>
                                            @foreach ($second_headings as $key => $second_heading)
                                                @if ($second_heading) 
                                                    <option value="{{ $key }}">{{ $second_heading }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Statut FINANCEUR
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select name="Statut_FINANCEUR" class="leadImportSelectChange form-control shadow-none select2">
                                            <option value="">{{ __('Select') }}</option>
                                            @foreach ($headings as $heading_key => $lead_tracking_header)
                                                @if ($lead_tracking_header)
                                                    <option data-key-value="{{ $heading_key }}" value="{{ $lead_tracking_header }}">{{ str_replace('_', ' ', $lead_tracking_header) }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select class="leadImportSelectExample form-control shadow-none select2 border-0" style="-webkit-appearance: none" readonly disabled>
                                            <option value=""></option>
                                            @foreach ($second_headings as $key => $second_heading)
                                                @if ($second_heading) 
                                                    <option value="{{ $key }}">{{ $second_heading }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Organisme FINANCEMENT
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select name="Organisme_FINANCEMENT" class="leadImportSelectChange form-control shadow-none select2">
                                            <option value="">{{ __('Select') }}</option>
                                            @foreach ($headings as $heading_key => $lead_tracking_header)
                                                @if ($lead_tracking_header)
                                                    <option data-key-value="{{ $heading_key }}" value="{{ $lead_tracking_header }}">{{ str_replace('_', ' ', $lead_tracking_header) }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select class="leadImportSelectExample form-control shadow-none select2 border-0" style="-webkit-appearance: none" readonly disabled>
                                            <option value=""></option>
                                            @foreach ($second_headings as $key => $second_heading)
                                                @if ($second_heading) 
                                                    <option value="{{ $key }}">{{ $second_heading }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Date installation
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select name="Date_installation" class="leadImportSelectChange form-control shadow-none select2">
                                            <option value="">{{ __('Select') }}</option>
                                            @foreach ($headings as $heading_key => $lead_tracking_header)
                                                @if ($lead_tracking_header)
                                                    <option data-key-value="{{ $heading_key }}" value="{{ $lead_tracking_header }}">{{ str_replace('_', ' ', $lead_tracking_header) }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select class="leadImportSelectExample form-control shadow-none select2 border-0" style="-webkit-appearance: none" readonly disabled>
                                            <option value=""></option>
                                            @foreach ($second_headings as $key => $second_heading)
                                                @if ($second_heading) 
                                                    <option value="{{ $key }}">{{ $second_heading }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    COMMENTAIRES INSTALLATION
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select name="COMMENTAIRES_INSTALLATION" class="leadImportSelectChange form-control shadow-none select2">
                                            <option value="">{{ __('Select') }}</option>
                                            @foreach ($headings as $heading_key => $lead_tracking_header)
                                                @if ($lead_tracking_header)
                                                    <option data-key-value="{{ $heading_key }}" value="{{ $lead_tracking_header }}">{{ str_replace('_', ' ', $lead_tracking_header) }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select class="leadImportSelectExample form-control shadow-none select2 border-0" style="-webkit-appearance: none" readonly disabled>
                                            <option value=""></option>
                                            @foreach ($second_headings as $key => $second_heading)
                                                @if ($second_heading) 
                                                    <option value="{{ $key }}">{{ $second_heading }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    SITUATION
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select name="SITUATION" class="leadImportSelectChange form-control shadow-none select2">
                                            <option value="">{{ __('Select') }}</option>
                                            @foreach ($headings as $heading_key => $lead_tracking_header)
                                                @if ($lead_tracking_header)
                                                    <option data-key-value="{{ $heading_key }}" value="{{ $lead_tracking_header }}">{{ str_replace('_', ' ', $lead_tracking_header) }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select class="leadImportSelectExample form-control shadow-none select2 border-0" style="-webkit-appearance: none" readonly disabled>
                                            <option value=""></option>
                                            @foreach ($second_headings as $key => $second_heading)
                                                @if ($second_heading) 
                                                    <option value="{{ $key }}">{{ $second_heading }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    AVIS FISCAL
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select name="AVIS_FISCAL" class="leadImportSelectChange form-control shadow-none select2">
                                            <option value="">{{ __('Select') }}</option>
                                            @foreach ($headings as $heading_key => $lead_tracking_header)
                                                @if ($lead_tracking_header)
                                                    <option data-key-value="{{ $heading_key }}" value="{{ $lead_tracking_header }}">{{ str_replace('_', ' ', $lead_tracking_header) }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select class="leadImportSelectExample form-control shadow-none select2 border-0" style="-webkit-appearance: none" readonly disabled>
                                            <option value=""></option>
                                            @foreach ($second_headings as $key => $second_heading)
                                                @if ($second_heading) 
                                                    <option value="{{ $key }}">{{ $second_heading }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    REFERENCE AVIS
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select name="REFERENCE_AVIS" class="leadImportSelectChange form-control shadow-none select2">
                                            <option value="">{{ __('Select') }}</option>
                                            @foreach ($headings as $heading_key => $lead_tracking_header)
                                                @if ($lead_tracking_header)
                                                    <option data-key-value="{{ $heading_key }}" value="{{ $lead_tracking_header }}">{{ str_replace('_', ' ', $lead_tracking_header) }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select class="leadImportSelectExample form-control shadow-none select2 border-0" style="-webkit-appearance: none" readonly disabled>
                                            <option value=""></option>
                                            @foreach ($second_headings as $key => $second_heading)
                                                @if ($second_heading) 
                                                    <option value="{{ $key }}">{{ $second_heading }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    ADRESSE INSTALLATION
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select name="ADRESSE_INSTALLATION" class="leadImportSelectChange form-control shadow-none select2">
                                            <option value="">{{ __('Select') }}</option>
                                            @foreach ($headings as $heading_key => $lead_tracking_header)
                                                @if ($lead_tracking_header)
                                                    <option data-key-value="{{ $heading_key }}" value="{{ $lead_tracking_header }}">{{ str_replace('_', ' ', $lead_tracking_header) }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select class="leadImportSelectExample form-control shadow-none select2 border-0" style="-webkit-appearance: none" readonly disabled>
                                            <option value=""></option>
                                            @foreach ($second_headings as $key => $second_heading)
                                                @if ($second_heading) 
                                                    <option value="{{ $key }}">{{ $second_heading }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    VILLE
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select name="VILLE" class="leadImportSelectChange form-control shadow-none select2">
                                            <option value="">{{ __('Select') }}</option>
                                            @foreach ($headings as $heading_key => $lead_tracking_header)
                                                @if ($lead_tracking_header)
                                                    <option data-key-value="{{ $heading_key }}" value="{{ $lead_tracking_header }}">{{ str_replace('_', ' ', $lead_tracking_header) }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select class="leadImportSelectExample form-control shadow-none select2 border-0" style="-webkit-appearance: none" readonly disabled>
                                            <option value=""></option>
                                            @foreach ($second_headings as $key => $second_heading)
                                                @if ($second_heading) 
                                                    <option value="{{ $key }}">{{ $second_heading }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    CP
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select name="CP" class="leadImportSelectChange form-control shadow-none select2">
                                            <option value="">{{ __('Select') }}</option>
                                            @foreach ($headings as $heading_key => $lead_tracking_header)
                                                @if ($lead_tracking_header)
                                                    <option data-key-value="{{ $heading_key }}" value="{{ $lead_tracking_header }}">{{ str_replace('_', ' ', $lead_tracking_header) }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select class="leadImportSelectExample form-control shadow-none select2 border-0" style="-webkit-appearance: none" readonly disabled>
                                            <option value=""></option>
                                            @foreach ($second_headings as $key => $second_heading)
                                                @if ($second_heading) 
                                                    <option value="{{ $key }}">{{ $second_heading }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    TEL
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select name="TEL" class="leadImportSelectChange form-control shadow-none select2">
                                            <option value="">{{ __('Select') }}</option>
                                            @foreach ($headings as $heading_key => $lead_tracking_header)
                                                @if ($lead_tracking_header)
                                                    <option data-key-value="{{ $heading_key }}" value="{{ $lead_tracking_header }}">{{ str_replace('_', ' ', $lead_tracking_header) }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select class="leadImportSelectExample form-control shadow-none select2 border-0" style="-webkit-appearance: none" readonly disabled>
                                            <option value=""></option>
                                            @foreach ($second_headings as $key => $second_heading)
                                                @if ($second_heading) 
                                                    <option value="{{ $key }}">{{ $second_heading }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    EMAIL CLIENT
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select name="EMAIL_CLIENT" class="leadImportSelectChange form-control shadow-none select2">
                                            <option value="">{{ __('Select') }}</option>
                                            @foreach ($headings as $heading_key => $lead_tracking_header)
                                                @if ($lead_tracking_header)
                                                    <option data-key-value="{{ $heading_key }}" value="{{ $lead_tracking_header }}">{{ str_replace('_', ' ', $lead_tracking_header) }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select class="leadImportSelectExample form-control shadow-none select2 border-0" style="-webkit-appearance: none" readonly disabled>
                                            <option value=""></option>
                                            @foreach ($second_headings as $key => $second_heading)
                                                @if ($second_heading) 
                                                    <option value="{{ $key }}">{{ $second_heading }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    MDP MPR
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select name="MDP_MPR" class="leadImportSelectChange form-control shadow-none select2">
                                            <option value="">{{ __('Select') }}</option>
                                            @foreach ($headings as $heading_key => $lead_tracking_header)
                                                @if ($lead_tracking_header)
                                                    <option data-key-value="{{ $heading_key }}" value="{{ $lead_tracking_header }}">{{ str_replace('_', ' ', $lead_tracking_header) }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select class="leadImportSelectExample form-control shadow-none select2 border-0" style="-webkit-appearance: none" readonly disabled>
                                            <option value=""></option>
                                            @foreach ($second_headings as $key => $second_heading)
                                                @if ($second_heading) 
                                                    <option value="{{ $key }}">{{ $second_heading }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    SUPERFICIE INTÉRIEURE CHAUFFÉE
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select name="SUPERFICIE_INTÉRIEURE_CHAUFFÉE" class="leadImportSelectChange form-control shadow-none select2">
                                            <option value="">{{ __('Select') }}</option>
                                            @foreach ($headings as $heading_key => $lead_tracking_header)
                                                @if ($lead_tracking_header)
                                                    <option data-key-value="{{ $heading_key }}" value="{{ $lead_tracking_header }}">{{ str_replace('_', ' ', $lead_tracking_header) }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select class="leadImportSelectExample form-control shadow-none select2 border-0" style="-webkit-appearance: none" readonly disabled>
                                            <option value=""></option>
                                            @foreach ($second_headings as $key => $second_heading)
                                                @if ($second_heading) 
                                                    <option value="{{ $key }}">{{ $second_heading }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    PROPRIETAIRE / LOCATAIRE
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select name="PROPRIETAIRE_LOCATAIRE" class="leadImportSelectChange form-control shadow-none select2">
                                            <option value="">{{ __('Select') }}</option>
                                            @foreach ($headings as $heading_key => $lead_tracking_header)
                                                @if ($lead_tracking_header)
                                                    <option data-key-value="{{ $heading_key }}" value="{{ $lead_tracking_header }}">{{ str_replace('_', ' ', $lead_tracking_header) }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select class="leadImportSelectExample form-control shadow-none select2 border-0" style="-webkit-appearance: none" readonly disabled>
                                            <option value=""></option>
                                            @foreach ($second_headings as $key => $second_heading)
                                                @if ($second_heading) 
                                                    <option value="{{ $key }}">{{ $second_heading }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    TYPE DE CHAUFFAGE + NBRE DE RADIATEURS
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select name="TYPE_DE_CHAUFFAGE" class="leadImportSelectChange form-control shadow-none select2">
                                            <option value="">{{ __('Select') }}</option>
                                            @foreach ($headings as $heading_key => $lead_tracking_header)
                                                @if ($lead_tracking_header)
                                                    <option data-key-value="{{ $heading_key }}" value="{{ $lead_tracking_header }}">{{ str_replace('_', ' ', $lead_tracking_header) }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select class="leadImportSelectExample form-control shadow-none select2 border-0" style="-webkit-appearance: none" readonly disabled>
                                            <option value=""></option>
                                            @foreach ($second_headings as $key => $second_heading)
                                                @if ($second_heading) 
                                                    <option value="{{ $key }}">{{ $second_heading }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div> 
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      </div>
    </div> 
</div>

<div class="form-group text-left mt-3">
    <label class="form-label" for="">Etiquette <span class="text-danger">*</span></label>
    <select name="selected_label" data-id="import" class="select2_select_option custom-select shadow-none form-control project_staus__change" required>
        <option value="" selected>{{ __('Select') }}</option>
        @foreach ($labels as $label)
            <option value="{{ $label->id }}">{{ $label->status }}</option>
        @endforeach
    </select>
</div> 