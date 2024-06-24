{{-- Main Layouts --}}
@extends('layouts.master')

{{-- Title part  --}}
@section('title')
 	{{ __('Dashboard Analytic') }}
@endsection

@section('bodyBg')
secondary-bg
@endsection




{{-- active menu --}}
@section('homeIndex')
active
@endsection

@push('plugins-link')
	<link rel="stylesheet" href="{{ asset('crm_assets/assets/plugins/apexchart/css/apexcharts.min.css') }}">
    <style>
        .table {
            font-size: 14px;
        }
        .form-control {
            border-color: #dddddd;
        }
        .analytic-collapse-list .analytic-collapse-item:last-child{
            margin-bottom: 0;
        }
    </style>
@endpush


{{-- Main Content Part --}}
@section('content')
<section class="dashboard py-4">
    <div class="container">
        <div class="row match-height">
            {{-- <div class="col-12 d-flex flex-wrap py-3">
                <h1 class="dashboard-title mb-0">{{ __('Dashboard Analytics') }}</h1>
                <div class="dropdown dropdown--custom dropdown--dashboard-filter ml-auto">
                    <button class="primary-btn primary-btn--primary border-0 rounded px-4 dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ __('Company Filter') }}
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        @foreach ($company as $item)
                        @php
                            $exists = \App\Models\CRM\CompanyFilter::where('user_id', Auth::id())->where('company_id', $item->id)->exists();
                        @endphp
                        @if ($exists)
                        <a class="dropdown-item" href="javascript:void(0)"><span class="dropdown-item__icon"><i class="bi bi-check2"></i></span> {{ $item->company_name }}</a>
                        @else
                        <a class="dropdown-item" href="{{ route('filter.company', $item->id) }}"> {{ $item->company_name }}</a>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div> --}}
            <div class="col-12">
                <div class="w-100">
                    <div class="d-lg-flex flex-wrap align-items-center">
                        {{-- <button type="button" class="btn btn-outline-primary shadow-none analytic-toggler" data-module="main_dashboard" data-status="{{ checkAnalyticTogger('main_dashboard')? 'hide':'show' }}">
                            @if(checkAnalyticTogger('main_dashboard'))
                                <i class="bi bi-eye-slash"></i>
                            @else
                                <i class="bi bi-eye"></i>
                            @endif
                        </button> --}}
                        <h1 class="dashboard-title mb-0 mr-auto">{{ __('Dashboard Analytics') }}</h1>
                        <div>
                            <div class="row">
                                <div class="col-lg">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('Start Date') }}</label>
                                        <input type="date" id="start_date" class="flatpickr flatpickr-input form-control shadow-none bg-white" placeholder="Date Mois, Année" required>
                                    </div>
                                </div>
                                <div class="col-lg">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('End Date') }}</label>
                                        <input type="date" id="end_date" class="flatpickr flatpickr-input form-control shadow-none bg-white" placeholder="Date Mois, Année" required>
                                    </div>
                                </div>
                                <div class="col-sm-auto mt-auto">
                                    <div class="form-group button-group-spacing d-flex flex-wrap">
                                        <button type="button" id="filterButton" class="primary-btn primary-btn--primary border-0 rounded px-4">{{ __('Filter') }}</button>
                                        <div class="d-none" id="clearFilter">
                                            <button type="button" id="filterButtonClear" class="secondary-btn border-0"> Annuler filtre</button>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-sm-auto mt-auto d-none" id="clearFilter">
                                    <div class="form-group">
                                    </div>
                                </div> --}}
                                <div class="col-sm-auto mt-auto">
                                    <div class="form-group button-group-spacing d-flex">
                                        <div class="dropdown dropdown--custom dropdown--dashboard-filter">
                                            <button class="primary-btn primary-btn--primary border-0 rounded px-4 dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Filtre entreprise
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                @foreach ($company as $item)
                                                @php
                                                    $exists = \App\Models\CRM\CompanyFilter::where('user_id', Auth::id())->where('company_id', $item->id)->exists();
                                                @endphp
                                                @if ($exists)
                                                <a class="dropdown-item" href="javascript:void(0)"><span class="dropdown-item__icon"><i class="bi bi-check2"></i></span> {{ $item->company_name }}</a>
                                                @else
                                                <a class="dropdown-item" href="{{ route('filter.company', $item->id) }}"> {{ $item->company_name }}</a>
                                                @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                {{-- style="display: {{ checkAnalyticTogger('main_dashboard')? '':'none' }}" --}}
                <div class="analytic-wrapper w-100">
                    <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-sm-2 row-cols-1" id="analyticWrap">
                        @include('admin.analytic_stats')
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="dashboard-card">
                    <div class="dashboard-card__header d-flex justify-content-between">
                        <h3 class="dashboard-card__header__title dashboard-card__header__title--lg my-0">Note Personnelle</h3>
                        <div>
                            <button type="button" class="btn btn-warning text-white shadow-none" data-toggle="modal" data-target="#personalNoteModal">
                                <i class="bi bi-plus-square"></i>
                            </button>
                        </div>
                    </div>
                    <div class="overflow-hidden">
                        <div class="dashboard-card__body simple-bar h-100">
                            <ul class="dashboard-list">
                                @forelse (Auth::user()->getNotes as $note)
                                    <li class="dashboard-list__item">
                                        <div class="media media--success">
                                            <div class="media-body align-items-center d-flex">
                                                <div>
                                                    <h4 class="media-body__title font-weight-normal">{{ $note->note }}</h4>
                                                    <p class="media-body__sub-title d-flex">
                                                        <span class="badge--custom border-0" style="color: #8ED8B6">
                                                            {{ \Carbon\Carbon::parse($note->created_at)->diffForHumans() }}
                                                        </span>
                                                    </p>
                                                </div>
                                                <button type="button" data-toggle="modal" data-target="#noteDeleteModal{{ $note->id }}" title="Supprimer"  class="btn btn-outline-danger shadow-none ml-auto"><i class="bi bi-trash"></i></button>
                                            </div>
                                        </div>
                                    </li>
                                    @push('all_modals')
                                        <div class="modal modal--aside fade" id="noteDeleteModal{{ $note->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content border-0">
                                                    <div class="modal-header border-0 pb-0">
                                                        <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                                                            <span class="novecologie-icon-close"></span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-center pt-0">
                                                        <h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
                                                        <span>{{ __('Are You Sure To Delete this') }} ?</span>
                                                        <form action="{{ route('personal.note.delete') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $note->id }}">
                                                            <div class="d-flex justify-content-center">
                                                                <button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
                                                                    Annuler
                                                                </button>
                                                                <button type="submit" class="primary-btn btn-danger primary-btn--md rounded border-0 my-3 mx-1">
                                                                    Confirmer
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endpush
                                    @empty
                                        <li class="dashboard-list__item text-center">
                                            <h3>Aucune donnée trouvée</h3>
                                        </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="dashboard-card dashboard-card--min">
                    <div class="dashboard-card__header">
                        <h3 class="dashboard-card__header__title dashboard-card__header__title--lg my-0">{{ __('Ringover Logs') }}</h3>
                    </div>
                    <div class="overflow-hidden h-100">
                        <div class="dashboard-card__body p-0 simple-bar h-100">
                            <table class="table table--dashboard no-wrap">
                                <thead>
                                    <tr>
                                        <th>{{ __('Last State') }}</th>
                                        <th>{{ __('From') }}</th>
                                        <th>{{ __('IVR') }}</th>
                                        <th>{{ __('To') }}</th>
                                        <th>{{ __('Details') }}</th>
                                        <th>{{ __('Record') }}</th>
                                        <th>{{ __('Voicemail') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse(getCalls() as $calls)
                                    <tr>
                                        <td class="align-middle">
                                            <p class="ringover-call-last_state">
                                                @if ($calls['last_state'] == 'ANSWERED')
                                                    A RÉPONDU
                                                @elseif ($calls['last_state'] == 'MISSED')
                                                    MANQUÉE
                                                @elseif ($calls['last_state'] == 'FAILED')
                                                    ÉCHOUÉ
                                                @elseif ($calls['last_state'] == 'VOICEMAIL')
                                                    MESSAGERIE VOCALE
                                                @else
                                                    {{ $calls['last_state'] }}
                                                @endif
                                        </p>
                                        </td>
                                        <td>
                                            @if ($calls['user'] && $calls['user']['picture'])
                                                <div class="ringover-call-user">
                                                    {{-- <div class="ringover-call-user__avatar">
                                                        <img src="{{ $calls['user']['picture'] }}" alt="user" width="50" height="50" class="ringover-call-user__avatar__image" loading="lazy">
                                                    </div> --}}
                                                    <div class="ringover-call-user__details">
                                                        <p class="ringover-call-user__details__name">{{ $calls['user']['firstname'] }} {{ $calls['user']['lastname'] }}</p>
                                                        <span class="ringover-call-user__details__number">{{ $calls['to_number'] }}</span>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="ringover-call-user">
                                                    {{-- <div class="ringover-call-user__avatar">
                                                        <img src="https://ui-avatars.com/api/?name=U&background=DDDDDD&size=60" alt="user" width="50" height="50" class="ringover-call-user__avatar__image" loading="lazy">
                                                    </div> --}}
                                                    <div class="ringover-call-user__details">
                                                        <p class="ringover-call-user__details__name">{{ __('Unknown') }}</p>
                                                        <span class="ringover-call-user__details__number">{{ $calls['to_number'] }}</span>
                                                    </div>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            @if ($calls['ivr'] && $calls['ivr']['name'])
                                                <span class="badge--custom" style="color: #{{ $calls['ivr']['color'] }}">{{ $calls['ivr']['name'] }}</span>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            @if ($calls['last_state'] == 'ANSWERED')
                                            <p class="ringover-call-status ringover-call-status--answered">
                                                <svg class="ringover-call-status__icon" width="1em" height="1em" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1.99187 10.009C-0.453221 7.56394 -0.668368 3.98806 1.46344 1.26612L1.60416 1.0918L3.88653 3.37416L3.81272 3.47881C2.77341 5.00185 3.14654 6.66814 4.23964 7.76123C5.32024 8.84183 6.96098 9.21885 8.46976 8.22329L8.62674 8.11436L10.9091 10.3967L10.6996 10.5647L10.6634 10.5927C7.95055 12.6654 4.41563 12.4328 1.99187 10.009Z" fill="#28C76F"/>
                                                    <path d="M6.68359 5.33637L11.3071 0.712891" stroke="#28C76F" stroke-width="1.09091"/>
                                                    <path d="M10.5403 5.33617H6.68652V1.48242" stroke="#28C76F" stroke-width="1.09091"/>
                                                </svg>
                                                <span class="ringover-call-status__number">{{ $calls['from_number'] }}</span>
                                            </p>
                                            @elseif ($calls['last_state'] == 'VOICEMAIL')
                                            <p class="ringover-call-status ringover-call-status--voicemail">
                                                <svg class="ringover-call-status__icon" width="1em" height="1em" viewBox="0 0 29 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M26.9278 6.94286C26.9302 6.29302 26.8037 5.64915 26.5558 5.04848C26.3078 4.44781 25.9432 3.90225 25.4831 3.44335C25.023 2.98445 24.4765 2.6213 23.8751 2.37491C23.2738 2.12851 22.6296 2.00376 21.9798 2.00786C21.3299 2.00468 20.6858 2.13038 20.0847 2.37769C19.4837 2.62499 18.9377 2.989 18.4782 3.44866C18.0187 3.90832 17.6549 4.45452 17.4079 5.05565C17.1608 5.65679 17.0354 6.30094 17.0388 6.95086C17.0332 7.60488 17.1581 8.25346 17.4061 8.85862C17.6542 9.46379 18.0205 10.0134 18.4836 10.4753C18.9467 10.9371 19.4973 11.302 20.1031 11.5485C20.7089 11.795 21.3578 11.9182 22.0118 11.9109C22.6617 11.9108 23.3052 11.7818 23.905 11.5315C24.5048 11.2811 25.049 10.9144 25.5061 10.4524C25.9633 9.99038 26.3243 9.44234 26.5683 8.83995C26.8124 8.23756 26.9345 7.59277 26.9278 6.94286M6.92379 11.9129C8.23653 11.9169 9.49735 11.4005 10.4302 10.4769C11.363 9.55322 11.8918 8.29757 11.9008 6.98486C11.9168 4.26086 9.70979 2.02986 6.97479 2.00786C6.32491 2.0002 5.67993 2.12115 5.07697 2.36374C4.47401 2.60632 3.92498 2.96576 3.46148 3.42136C2.99798 3.87696 2.62915 4.41974 2.37624 5.01844C2.12332 5.61713 1.99131 6.25994 1.9878 6.90986C1.9698 9.68886 4.15379 11.9009 6.92379 11.9109M11.8688 11.8859H17.0348C16.7988 11.5879 16.6038 11.3539 16.4218 11.1089C14.6758 8.76586 14.5798 5.61986 16.1758 3.15186C17.7348 0.742862 20.7098 -0.465138 23.5138 0.173862C26.3278 0.816862 28.4788 3.16586 28.8638 6.01886C29.1039 7.77472 28.663 9.55591 27.6316 10.997C26.6001 12.4381 25.0563 13.4299 23.3168 13.7689C22.8183 13.8664 22.3117 13.9166 21.8038 13.9189C16.8448 13.9289 11.8858 13.9359 6.9268 13.9199C3.50979 13.9099 1.0038 11.5079 0.264795 8.87986C-0.815205 5.03386 1.50979 1.07086 5.39479 0.175862C9.22079 -0.705138 13.0628 1.81486 13.7638 5.70086C14.1538 7.86286 13.5988 9.79686 12.2038 11.4899L11.8688 11.8859" fill="url(#call_voivemail_gradient)"/>
                                                    <defs>
                                                        <linearGradient id="call_voivemail_gradient" x1="-2.73322e-08" y1="5.35012" x2="24.7467" y2="17.264" gradientUnits="userSpaceOnUse">
                                                            <stop stop-color="#FFC54F"/>
                                                            <stop offset="1" stop-color="#FF9B4A"/>
                                                        </linearGradient>
                                                    </defs>
                                                </svg>
                                                <span class="ringover-call-status__number">{{ $calls['from_number'] }}</span>
                                            </p>
                                            @elseif ($calls['last_state'] == 'CANCELLED')
                                            <p class="ringover-call-status ringover-call-status--cancelled">
                                                <svg class="ringover-call-status__icon" width="1em" height="1em" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.65176 18.0416C-0.830904 13.5589 -1.22534 7.00318 2.68297 2.01295L2.94097 1.69336L7.12531 5.8777L6.98999 6.06955C5.08459 8.86179 5.76866 11.9167 7.77267 13.9207C9.75377 15.9018 12.7618 16.593 15.5279 14.7677L15.8157 14.5681L20 18.7524L19.616 19.0602L19.5495 19.1117C14.576 22.9115 8.09533 22.4852 3.65176 18.0416V18.0416Z" fill="currentColor"/>
                                                    <path d="M12.2539 9.47637L20.7303 1" stroke="currentColor" stroke-width="2"/>
                                                    <path d="M20.7305 9.47637L12.2541 1" stroke="currentColor" stroke-width="2"/>
                                                </svg>
                                                <span class="ringover-call-status__number">{{ $calls['from_number'] }}</span>
                                            </p>
                                            @elseif ($calls['last_state'] == 'FAILED')
                                            <p class="ringover-call-status ringover-call-status--failed">
                                                <svg class="ringover-call-status__icon" width="1em" height="1em" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.65176 18.0416C-0.830904 13.5589 -1.22534 7.00318 2.68297 2.01295L2.94097 1.69336L7.12531 5.8777L6.98999 6.06955C5.08459 8.86179 5.76866 11.9167 7.77267 13.9207C9.75377 15.9018 12.7618 16.593 15.5279 14.7677L15.8157 14.5681L20 18.7524L19.616 19.0602L19.5495 19.1117C14.576 22.9115 8.09533 22.4852 3.65176 18.0416V18.0416Z" fill="currentColor"/>
                                                    <path d="M12.2539 9.47637L20.7303 1" stroke="currentColor" stroke-width="2"/>
                                                    <path d="M20.7305 9.47637L12.2541 1" stroke="currentColor" stroke-width="2"/>
                                                </svg>
                                                <span class="ringover-call-status__number">{{ $calls['from_number'] }}</span>
                                            </p>
                                            @elseif ($calls['last_state'] == 'MISSED')
                                            <p class="ringover-call-status ringover-call-status--missed">
                                                <svg class="ringover-call-status__icon" width="1em" height="1em" viewBox="0 0 24 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M10.6992 6.85648V1H16.4284" stroke="#F04E4F" stroke-width="2"/>
                                                    <path d="M10.6992 1L16.9201 7.38889L23.1701 1" stroke="#F04E4F" stroke-width="2"/>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.65176 17.3482C-0.830904 12.8656 -1.22534 6.30982 2.68297 1.31959L2.94097 1L7.12531 5.18434L6.98999 5.37619C5.08459 8.16843 5.76866 11.2233 7.77267 13.2273C9.69874 15.1534 12.5955 15.8602 15.2969 14.2207L15.582 14.0381L15.8157 13.8747L20 18.059L19.5495 18.4183C14.576 22.2182 8.09533 21.7918 3.65176 17.3482Z" fill="url(#call_missed_gradient)"/>
                                                    <defs>
                                                        <linearGradient id="call_missed_gradient" x1="20" y1="21" x2="0" y2="1" gradientUnits="userSpaceOnUse">
                                                            <stop stop-color="#FF8888"/>
                                                            <stop offset="1" stop-color="#F05F5F"/>
                                                        </linearGradient>
                                                    </defs>
                                                </svg>
                                                <span class="ringover-call-status__number">{{ $calls['from_number'] }}</span>
                                            </p>
                                            @elseif ($calls['last_state'] == 'QUEUE_TIMEOUT')
                                            <p class="ringover-call-status ringover-call-status--timeout">
                                                <svg class="ringover-call-status__icon" width="1em" height="1em" viewBox="0 0 21 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.65176 19.3482C-0.830904 14.8656 -1.22534 8.30982 2.68297 3.31959L2.94097 3L7.12531 7.18434L6.98999 7.37619C5.08459 10.1684 5.76866 13.2233 7.77267 15.2273C9.69874 17.1534 12.5955 17.8602 15.2969 16.2207L15.582 16.0381L15.8157 15.8747L20 20.059L19.5495 20.4183C14.576 24.2182 8.09533 23.7918 3.65176 19.3482Z" fill="url(#call_timeout_gradient)"/>
                                                    <path d="M15.7788 3.65456V2.77522C15.7788 2.63584 15.6648 2.5218 15.5254 2.5218H14.641V1.93135C14.641 1.46507 15.0186 1.08495 15.4848 1.08495H15.6622C16.1285 1.08495 16.5061 1.46507 16.5061 1.93135C16.5061 2.2912 16.648 2.63077 16.9014 2.88672C17.1574 3.14266 17.4969 3.28204 17.8593 3.28204H17.9683C18.7133 3.28204 19.3215 2.67638 19.3215 1.93135C19.3215 1.79197 19.2075 1.67794 19.0681 1.67794C18.9287 1.67794 18.8147 1.79197 18.8147 1.93135C18.8147 2.39763 18.4346 2.77522 17.9683 2.77522H17.8593C17.6338 2.77522 17.4209 2.68652 17.2613 2.52687C17.1016 2.36722 17.0129 2.15689 17.0129 1.93135C17.0129 1.18632 16.4073 0.578125 15.6622 0.578125H15.4848C14.7398 0.578125 14.1341 1.18632 14.1341 1.93135V2.5218H13.2548C13.1154 2.5218 13.0014 2.63584 13.0014 2.77522V3.65456C10.67 4.27289 9 6.42943 9 8.85966C9 11.8322 11.4176 14.2498 14.3901 14.2498C17.3626 14.2498 19.7802 11.8322 19.7802 8.85966C19.7802 6.42943 18.1102 4.27289 15.7788 3.65456ZM14.3901 13.7429C11.6988 13.7429 9.50683 11.5534 9.50683 8.85966C9.50683 6.59668 11.1059 4.59472 13.3106 4.10057C13.4271 4.07269 13.5082 3.97133 13.5082 3.85222V3.02863H15.272V3.85222C15.272 3.97133 15.3531 4.07269 15.4696 4.10057C17.6743 4.59472 19.2734 6.59668 19.2734 8.85966C19.2734 11.5534 17.0813 13.7429 14.3901 13.7429V13.7429Z" fill="#F04E4F"/>
                                                    <path d="M14.3904 4.61133C12.0463 4.61133 10.1406 6.51953 10.1406 8.86106C10.1406 11.2051 12.0463 13.1108 14.3904 13.1108C16.7344 13.1108 18.6401 11.2051 18.6401 8.86106C18.6401 6.51953 16.7344 4.61133 14.3904 4.61133V4.61133ZM11.1061 9.05366H10.6779C10.574 9.05366 10.4878 8.9675 10.4878 8.8636C10.4878 8.7597 10.574 8.67354 10.6779 8.67354H11.1061C11.21 8.67354 11.2962 8.7597 11.2962 8.8636C11.2962 8.9675 11.21 9.05366 11.1061 9.05366ZM14.1978 5.14856C14.1978 5.04466 14.2839 4.9585 14.3878 4.9585C14.4943 4.9585 14.5779 5.04466 14.5779 5.14856V5.57683C14.5779 5.68073 14.4943 5.76689 14.3878 5.76689C14.2839 5.76689 14.1978 5.68073 14.1978 5.57683V5.14856ZM11.6282 6.10393C11.7042 6.02791 11.8233 6.02791 11.8968 6.10393L12.2009 6.40549C12.2744 6.47898 12.2744 6.60062 12.2009 6.67411C12.1629 6.71212 12.1147 6.72986 12.0666 6.72986C12.0159 6.72986 11.9677 6.71212 11.9323 6.67411L11.6282 6.37255C11.5547 6.29906 11.5547 6.17742 11.6282 6.10393V6.10393ZM12.2034 11.3192L11.9018 11.6233C11.8638 11.6587 11.8157 11.679 11.7675 11.679C11.7169 11.679 11.6687 11.6587 11.6332 11.6233C11.5572 11.5472 11.5572 11.4281 11.6332 11.3546L11.9348 11.0506C12.0083 10.9771 12.1299 10.9771 12.2034 11.0506C12.2769 11.1266 12.2769 11.2457 12.2034 11.3192V11.3192ZM14.583 12.5736C14.583 12.68 14.4968 12.7636 14.3929 12.7636C14.2865 12.7636 14.2028 12.68 14.2028 12.5736V12.1453C14.2028 12.0414 14.2865 11.9552 14.3929 11.9552C14.4968 11.9552 14.583 12.0414 14.583 12.1453V12.5736ZM14.3904 9.75815C14.2358 9.75815 14.0913 9.71507 13.9646 9.64664L13.0599 10.5488C13.0118 10.5995 12.9459 10.6223 12.8826 10.6223C12.8167 10.6223 12.7533 10.5995 12.7026 10.5488C12.6038 10.45 12.6038 10.2903 12.7026 10.1915L13.6048 9.2868C13.5364 9.16009 13.4933 9.01565 13.4933 8.86106C13.4933 8.4556 13.767 8.11603 14.1369 8.00453V6.50179C14.1369 6.36241 14.251 6.24838 14.3904 6.24838C14.5297 6.24838 14.6438 6.36241 14.6438 6.50179V8.00453C15.0138 8.11603 15.2874 8.4556 15.2874 8.86106C15.2874 9.35522 14.8845 9.75815 14.3904 9.75815V9.75815ZM16.5773 6.40296L16.8789 6.1014C16.9549 6.02537 17.074 6.02537 17.1475 6.1014C17.2235 6.17489 17.2235 6.29399 17.1475 6.37001L16.8459 6.67158C16.8079 6.70959 16.7598 6.72733 16.7116 6.72733C16.6635 6.72733 16.6153 6.70959 16.5773 6.67158C16.5038 6.59809 16.5038 6.47645 16.5773 6.40296ZM17.1526 11.6182C17.1146 11.6562 17.0664 11.6739 17.0183 11.6739C16.9676 11.6739 16.9194 11.6562 16.8839 11.6182L16.5798 11.3166C16.5064 11.2431 16.5064 11.1215 16.5798 11.048C16.6559 10.9745 16.775 10.9745 16.8485 11.048L17.1526 11.3496C17.2261 11.4256 17.2261 11.5447 17.1526 11.6182ZM18.1029 9.04859H17.6746C17.5707 9.04859 17.4845 8.96496 17.4845 8.85853C17.4845 8.75463 17.5707 8.66847 17.6746 8.66847H18.1029C18.2068 8.66847 18.2929 8.75463 18.2929 8.85853C18.2929 8.96496 18.2068 9.04859 18.1029 9.04859Z" fill="#F04E4F"/>
                                                    <path d="M14.7805 8.85901C14.7805 9.07441 14.6057 9.24926 14.3903 9.24926C14.1749 9.24926 14 9.07441 14 8.85901C14 8.64361 14.1749 8.46875 14.3903 8.46875C14.6057 8.46875 14.7805 8.64361 14.7805 8.85901Z" fill="#F04E4F"/>
                                                    <path d="M19.0659 1.2397C19.2061 1.2397 19.3193 1.12642 19.3193 0.986283V0.253413C19.3193 0.113276 19.2061 0 19.0659 0C18.9258 0 18.8125 0.113276 18.8125 0.253413V0.986537C18.8125 1.12642 18.9258 1.2397 19.0659 1.2397Z" fill="#F04E4F"/>
                                                    <path d="M18.2217 1.44136C18.2711 1.49077 18.336 1.51561 18.4009 1.51561C18.4657 1.51561 18.5306 1.49077 18.58 1.44136C18.6791 1.34227 18.6791 1.18212 18.58 1.08303L18.0615 0.564548C17.9625 0.465463 17.8023 0.465463 17.7032 0.564548C17.6041 0.663632 17.6041 0.823789 17.7032 0.922874L18.2217 1.44136Z" fill="#F04E4F"/>
                                                    <path d="M19.917 2.42002C19.8179 2.32093 19.6578 2.32093 19.5587 2.42002C19.4596 2.5191 19.4596 2.67926 19.5587 2.77834L20.0769 3.29657C20.1263 3.34599 20.1912 3.37082 20.2561 3.37082C20.321 3.37082 20.3858 3.34599 20.4352 3.29657C20.5343 3.19749 20.5343 3.03733 20.4352 2.93825L19.917 2.42002Z" fill="#F04E4F"/>
                                                    <path d="M20.7443 1.67773H20.0112C19.8711 1.67773 19.7578 1.79101 19.7578 1.93115C19.7578 2.07128 19.8711 2.18456 20.0112 2.18456H20.7443C20.8845 2.18456 20.9978 2.07128 20.9978 1.93115C20.9978 1.79101 20.8845 1.67773 20.7443 1.67773Z" fill="#F04E4F"/>
                                                    <path d="M19.7379 1.51561C19.8027 1.51561 19.8676 1.49077 19.917 1.44136L20.4352 0.922874C20.5343 0.823789 20.5343 0.663632 20.4352 0.564548C20.3362 0.465463 20.176 0.465463 20.0769 0.564548L19.5587 1.08303C19.4596 1.18212 19.4596 1.34227 19.5587 1.44136C19.6081 1.49077 19.673 1.51561 19.7379 1.51561Z" fill="#F04E4F"/>
                                                    <defs>
                                                        <linearGradient id="call_timeout_gradient" x1="20" y1="23" x2="0" y2="3" gradientUnits="userSpaceOnUse">
                                                            <stop stop-color="#FF8888"/>
                                                            <stop offset="1" stop-color="#F05F5F"/>
                                                        </linearGradient>
                                                    </defs>
                                                </svg>
                                                <span class="ringover-call-status__number">{{ $calls['from_number'] }}</span>
                                            </p>
                                            @elseif ($calls['last_state'] == 'OUTGOING')
                                            <p class="ringover-call-status ringover-call-status--outgoing">
                                                <svg class="ringover-call-status__icon" width="1em" height="1em" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M20.7029 1.00195L12.5977 9.10616" stroke="#4990E2" stroke-width="2"/>
                                                    <path d="M13.8633 1H20.7054V7.84211" stroke="#4990E2" stroke-width="2"/>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.65176 18.3482C-0.830904 13.8656 -1.22534 7.30982 2.68297 2.31959L2.94097 2L7.12531 6.18434L6.98999 6.37619C5.08459 9.16843 5.76866 12.2233 7.77267 14.2273C9.75377 16.2084 12.7618 16.8996 15.5279 15.0744L15.8157 14.8747L20 19.059L19.616 19.3669L19.5495 19.4183C14.576 23.2182 8.09533 22.7918 3.65176 18.3482V18.3482Z" fill="url(#call_outgoing_gradient)"/>
                                                    <defs>
                                                        <linearGradient id="call_outgoing_gradient" x1="20" y1="22" x2="0" y2="2" gradientUnits="userSpaceOnUse">
                                                            <stop stop-color="#72BBF1"/>
                                                            <stop offset="1" stop-color="#4B90E2"/>
                                                        </linearGradient>
                                                    </defs>
                                                </svg>
                                                <span class="ringover-call-status__number">{{ $calls['from_number'] }}</span>
                                            </p>
                                            @else
                                            <p class="ringover-call-status ringover-call-status--outgoing">
                                                <svg class="ringover-call-status__icon" width="1em" height="1em" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M20.7029 1.00195L12.5977 9.10616" stroke="#4990E2" stroke-width="2"/>
                                                    <path d="M13.8633 1H20.7054V7.84211" stroke="#4990E2" stroke-width="2"/>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.65176 18.3482C-0.830904 13.8656 -1.22534 7.30982 2.68297 2.31959L2.94097 2L7.12531 6.18434L6.98999 6.37619C5.08459 9.16843 5.76866 12.2233 7.77267 14.2273C9.75377 16.2084 12.7618 16.8996 15.5279 15.0744L15.8157 14.8747L20 19.059L19.616 19.3669L19.5495 19.4183C14.576 23.2182 8.09533 22.7918 3.65176 18.3482V18.3482Z" fill="url(#call_outgoing_gradient)"/>
                                                    <defs>
                                                        <linearGradient id="call_outgoing_gradient" x1="20" y1="22" x2="0" y2="2" gradientUnits="userSpaceOnUse">
                                                            <stop stop-color="#72BBF1"/>
                                                            <stop offset="1" stop-color="#4B90E2"/>
                                                        </linearGradient>
                                                    </defs>
                                                </svg>
                                                <span class="ringover-call-status__number">{{ $calls['from_number'] }}</span>
                                            </p>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="ringover-call-details">
                                                <p class="ringover-call-details__time">{{ \Carbon\Carbon::parse($calls['end_time'])->format('d M Y - h:i A') ?? 'Not answered' }}</p>
                                                <span class="ringover-call-details__duration ringover-call-details__duration--muted">
                                                    <i class="bi bi-hourglass-split"></i>
                                                    <span class="ringover-call-details__duration__text">{{ seconds2human($calls['incall_duration']) }}</span>
                                                </span>
                                                <span class="ringover-call-details__duration ringover-call-details__duration--highlight">
                                                    <svg width="1em" height="1em" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M3.65176 17.0416C-0.830904 12.5589 -1.22534 6.00318 2.68297 1.01295L2.94097 0.693359L7.12531 4.8777L6.98999 5.06955C5.08459 7.86179 5.76866 10.9167 7.77267 12.9207C9.75377 14.9018 12.7618 15.593 15.5279 13.7677L15.8157 13.5681L20 17.7524L19.616 18.0602L19.5495 18.1117C14.576 21.9115 8.09533 21.4852 3.65176 17.0416V17.0416Z" fill="url(#call_single_gradient)"/>
                                                        <defs>
                                                            <linearGradient id="call_single_gradient" x1="1.5308" y1="2.84983" x2="20" y2="20.6934" gradientUnits="userSpaceOnUse">
                                                                <stop stop-color="#40E0CF"/>
                                                                <stop offset="1" stop-color="#36CDCF"/>
                                                            </linearGradient>
                                                        </defs>
                                                    </svg>
                                                    <span class="ringover-call-details__duration__text">{{ seconds2human($calls['total_duration']) }}</span>
                                                </span>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            @if ($calls['record'])
                                                <div class="ringover-call-audio-wrapper">
                                                    <div class="ringover-call-btn-wrapper">
                                                        <button type="button" class="ringover-call-btn ringover-call-btn--record" data-audio-play>
                                                            <svg class="ringover-call-btn__icon" width="1em" height="1em" viewBox="0 0 20 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M20 16.1401C20 15.5151 19.5221 15.0371 18.8971 15.0371C18.2721 15.0371 17.7941 15.5151 17.7941 16.1401C17.7941 20.4415 14.3015 23.9342 10 23.9342C5.69853 23.9342 2.20588 20.4415 2.20588 16.1401C2.20588 15.5151 1.72794 15.0371 1.10294 15.0371C0.477941 15.0371 0 15.5151 0 16.1401C0 21.2503 3.82353 25.5518 8.89706 26.1033V29.0445H4.88971C4.26471 29.0445 3.78677 29.5224 3.78677 30.1474C3.78677 30.7724 4.26471 31.2503 4.88971 31.2503H15.1103C15.7353 31.2503 16.2132 30.7724 16.2132 30.1474C16.2132 29.5224 15.7353 29.0445 15.1103 29.0445H11.1029V26.1033C16.1765 25.5518 20 21.2503 20 16.1401Z" fill="currentColor"/>
                                                                <path d="M9.99908 0C6.61673 0 3.85938 2.75735 3.85938 6.13971V16.1029C3.85938 19.5221 6.61673 22.2426 9.99908 22.2794C13.3814 22.2794 16.1388 19.5221 16.1388 16.1397V6.13971C16.1388 2.75735 13.3814 0 9.99908 0Z" fill="currentColor"/>
                                                            </svg>
                                                        </button>
                                                        <button type="button" class="ringover-call-btn ringover-call-btn--stop" data-audio-stop>
                                                            <svg class="ringover-call-btn__icon" width="1em" height="1em" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                                                <path d="M5 3.5h6A1.5 1.5 0 0 1 12.5 5v6a1.5 1.5 0 0 1-1.5 1.5H5A1.5 1.5 0 0 1 3.5 11V5A1.5 1.5 0 0 1 5 3.5z"/>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <audio class="ringover-call-audio" controls preload="none">
                                                        <source src="{{ $calls['record'] }}" type="audio/mpeg">
                                                    </audio>
                                                    <span class="ringover-call-duration"></span>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            @if ($calls['voicemail'])
                                                <div class="ringover-call-audio-wrapper">
                                                    <div class="ringover-call-btn-wrapper">
                                                        <button type="button" class="ringover-call-btn ringover-call-btn--voicemail" data-audio-play>
                                                            <svg class="ringover-call-btn__icon" width="1em" height="1em" viewBox="0 0 29 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M12.0102 15.2345C9.2422 12.7528 8.6172 10.2712 8.4762 9.27689C8.4368 9.00197 8.54232 8.72626 8.7617 8.53096L11.0017 6.52358C11.3312 6.22834 11.3897 5.76822 11.1427 5.41409L7.5762 0.448991C7.30296 0.0568611 6.74192 -0.0846625 6.2807 0.122198L0.555198 2.53975C0.182227 2.7044 -0.0371492 3.05968 0.0051975 3.43047C0.305197 5.98565 1.5477 12.2669 8.4327 18.4401C15.3177 24.6133 22.3227 25.7268 25.1742 25.9958C25.5878 26.0337 25.984 25.8371 26.1677 25.5027L28.8642 20.3695C29.0941 19.9569 28.9373 19.4552 28.5017 19.2098L22.9637 16.0131C22.5689 15.7915 22.0557 15.8435 21.7262 16.1386L19.4872 18.1469C19.2694 18.3436 18.9618 18.4382 18.6552 18.4029C17.5462 18.2765 14.7782 17.7161 12.0102 15.2345V15.2345Z" fill="currentColor"/>
                                                                <path d="M21.5 0C17.358 0 14 2.60897 14 5.82759C14.0068 7.00854 14.4558 8.15324 15.275 9.07803L14.5 12.5517L18.432 11.1414C19.4102 11.482 20.4506 11.6562 21.5 11.6552C25.642 11.6552 29 9.04621 29 5.82759C29 2.60897 25.642 0 21.5 0ZM17.5 6.72414C16.9477 6.72414 16.5 6.32274 16.5 5.82759C16.5 5.33243 16.9477 4.93103 17.5 4.93103C18.0523 4.93103 18.5 5.33243 18.5 5.82759C18.5 6.32274 18.0523 6.72414 17.5 6.72414ZM21.5 6.72414C20.9477 6.72414 20.5 6.32274 20.5 5.82759C20.5 5.33243 20.9477 4.93103 21.5 4.93103C22.0523 4.93103 22.5 5.33243 22.5 5.82759C22.5 6.32274 22.0523 6.72414 21.5 6.72414ZM25.5 6.72414C24.9477 6.72414 24.5 6.32274 24.5 5.82759C24.5 5.33243 24.9477 4.93103 25.5 4.93103C26.0523 4.93103 26.5 5.33243 26.5 5.82759C26.5 6.32274 26.0523 6.72414 25.5 6.72414Z" fill="currentColor"/>
                                                            </svg>
                                                        </button>
                                                        <button type="button" class="ringover-call-btn ringover-call-btn--stop" data-audio-stop>
                                                            <svg class="ringover-call-btn__icon" width="1em" height="1em" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                                                <path d="M5 3.5h6A1.5 1.5 0 0 1 12.5 5v6a1.5 1.5 0 0 1-1.5 1.5H5A1.5 1.5 0 0 1 3.5 11V5A1.5 1.5 0 0 1 5 3.5z"/>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <audio class="ringover-call-audio" controls preload="none">
                                                        <source src="{{ $calls['voicemail'] }}" type="audio/mpeg">
                                                    </audio>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="9000">
                                            <h2 class="text-center py-3">{{ __('No results found.') }}</h2>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="dashboard-card">
                    <div class="dashboard-card__header d-flex">
                        <div>
                            <div class="dashboard-card__header__icon dashboard-card__header__icon--danger">
                                <i class="bi bi-bar-chart-steps"></i>
                            </div>
                            <h3 id="leadCount" class="dashboard-card__header__title dashboard-card__header__title--lg">{{ $leadCount }}</h3>
                            {{-- <p class="dashboard-card__header__text">{{ __('Leads') }}</p> --}}
                        </div>
                        <h3 class="dashboard-card__header__title mt-2">{{ __('Leads') }}</h3>
                        <div class="dropdown dropdown--custom ml-auto">
                            <button  id="lead_chart_label" class="btn btn-sm shadow-none text-black dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ __('Last 30 Days') }}
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item lead_chart" data-value="7" href="#">{{ __('Last 7 Days') }}</a>
                                <a class="dropdown-item lead_chart" data-value="this" href="#">{{ __('Last 30 Days') }}</a>
                                <a class="dropdown-item lead_chart" data-value="last" href="#">{{ __('Last Month') }}</a>
                                <a class="dropdown-item lead_chart" data-value="year" href="#">{{ __('Last Year') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="dashboard-card__body p-0">
                        <div id="productsChart"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="dashboard-card">
                    <div class="dashboard-card__header d-flex">
                        <div>
                            <div class="dashboard-card__header__icon dashboard-card__header__icon--info">
                                <i class="bi bi-people"></i>
                            </div>
                            <h3 id="clientCount" class="dashboard-card__header__title dashboard-card__header__title--lg">{{ $clientCount }}</h3>
                            {{-- <p class="dashboard-card__header__text">{{ __('Clients') }}</p> --}}
                        </div>
                        <h3 class="dashboard-card__header__title mt-2">{{ __('Clients') }}</h3>
                        <div class="dropdown dropdown--custom ml-auto">
                            <button id="client_chart_label" class="btn btn-sm shadow-none text-black dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ __('Last 30 Days') }}
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item client_chart" data-value="7" href="#">{{ __('Last 7 Days') }}</a>
                                <a class="dropdown-item client_chart" data-value="this" href="#">{{ __('Last 30 Days') }}</a>
                                <a class="dropdown-item client_chart" data-value="last" href="#">{{ __('Last Month') }}</a>
                                <a class="dropdown-item client_chart" data-value="year" href="#">{{ __('Last Year') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="dashboard-card__body p-0">
                        <div id="clientsChart"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="dashboard-card">
                    <div class="dashboard-card__header d-flex">
                        <div>
                            <div class="dashboard-card__header__icon dashboard-card__header__icon--success">
                                <i class="bi bi-bar-chart"></i>
                            </div>
                            <h3 id="projectCount" class="dashboard-card__header__title dashboard-card__header__title--lg">{{ $projectCount }}</h3>
                            {{-- <p class="dashboard-card__header__text">{{ __('Projects') }}</p> --}}
                        </div>
                        <h3 class="dashboard-card__header__title mt-2">Chantiers</h3>
                        <div class="dropdown dropdown--custom ml-auto">
                            <button id="project_chart_label" class="btn btn-sm shadow-none text-black dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ __('Last 30 Days') }}
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item project_chart" data-value="7" href="#">{{ __('Last 7 Days') }}</a>
                                <a class="dropdown-item project_chart" data-value="this" href="#">{{ __('Last 30 Days') }}</a>
                                <a class="dropdown-item project_chart" data-value="last" href="#">{{ __('Last Month') }}</a>
                                <a class="dropdown-item project_chart" data-value="year" href="#">{{ __('Last Year') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="dashboard-card__body p-0">
                        <div id="projectsChart"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-lg-6">
                <div class="dashboard-card">
                    <div class="dashboard-card__header d-flex">
                        <div>
                            <div class="dashboard-card__header__icon dashboard-card__header__icon--warning">
                                <i class="bi bi-building"></i>
                            </div>
                            <h3 id="leadClientCount" class="dashboard-card__header__title dashboard-card__header__title--lg">{{ $lead_percentage }} %</h3>
                            {{-- <p class="dashboard-card__header__text">{{ __('Lead-Client') }}</p> --}}
                        </div>
                        <h3 class="dashboard-card__header__title mt-2">{{ __('Lead-Client State') }}</h3>
                        <div class="dropdown dropdown--custom ml-auto">
                            <button id="lead_client_label" class="btn btn-sm shadow-none text-black dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ __('Last 30 Days') }}
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item lead_client_state" data-value="7" href="#">{{ __('Last 7 Days') }}</a>
                                <a class="dropdown-item lead_client_state" data-value="this" href="#">{{ __('Last 30 Days') }}</a>
                                <a class="dropdown-item lead_client_state" data-value="last" href="#">{{ __('Last Month') }}</a>
                                <a class="dropdown-item lead_client_state" data-value="year" href="#">{{ __('Last Year') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="dashboard-card__body px-2">
                        <div id="revenueChart"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="dashboard-card">
                    <div class="dashboard-card__header d-flex">
                        <h3 class="dashboard-card__header__title">{{ __('Latest Lead') }}</h3>
                        <div class="dropdown dropdown--custom ml-auto">
                            <button id="leadListLabel" class="btn btn-sm shadow-none text-black dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ __('Last 7 Days') }}
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item lead_list" data-value="7days" href="#">{{ __('Last 7 Days') }}</a>
                                <a class="dropdown-item lead_list" data-value="today" href="#">{{ __('Today') }}</a>
                                <a class="dropdown-item lead_list" data-value="yesterday" href="#">{{ __('Yesterday') }}</a>
                                <a class="dropdown-item lead_list" data-value="week" href="#">{{ __('Last Week') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-hidden">
                        <div class="dashboard-card__body simple-bar h-100">
                            <ul class="dashboard-list" id="leadListRender">
                               @include('admin.lead_list')
                                {{-- <li class="dashboard-list__item">
                                    <div class="media media--danger">
                                        <div class="media-header rounded">
                                            <i class="bi bi-bar-chart"></i>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-body__title font-weight-normal">Lozère</h4>
                                            <p class="media-body__sub-title d-flex">
                                                H2
                                                <span class="text-danger font-weight-bold ml-auto">- $1000</span>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li class="dashboard-list__item">
                                    <div class="media media--warning">
                                        <div class="media-header rounded">
                                            <i class="bi bi-bar-chart"></i>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-body__title font-weight-normal">Lozère</h4>
                                            <p class="media-body__sub-title d-flex">
                                                H4
                                                <span class="text-success font-weight-bold ml-auto">+ $1500</span>
                                            </p>
                                        </div>
                                    </div>
                                </li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="dashboard-card">
                    <div class="dashboard-card__header d-flex">
                        <div>
                            <div class="dashboard-card__header__icon">
                                <i class="bi bi-bar-chart-steps"></i>
                            </div>
                            <h3 class="dashboard-card__header__title dashboard-card__header__title--lg">{{ $lastThreeMonthleadCount }}</h3>
                            {{-- <p class="dashboard-card__header__text">{{ __('Leads') }}</p> --}}
                        </div>
                        <h3 class="dashboard-card__header__title mt-2">{{ __('Leads Overview') }}</h3>
                        {{-- <div class="dropdown dropdown--custom ml-auto">
                            <button class="btn btn-sm shadow-none dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ __('Last 7 Days') }}
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#">{{ __('Last 30 Days') }}</a>
                                <a class="dropdown-item" href="#">{{ __('Last Month') }}</a>
                                <a class="dropdown-item" href="#">{{ __('Last Year') }}</a>
                            </div>
                        </div> --}}
                    </div>
                    <div class="dashboard-card__body">
                        <div id="overviewChart"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="dashboard-card">
                    <div class="dashboard-card__header d-flex">
                        <h3 class="dashboard-card__header__title dashboard-card__header__title--lg my-0">Fournisseur de lead</h3>
                    </div>
                    <div class="overflow-hidden">
                        <div class="dashboard-card__body simple-bar h-100">
                            <ul class="dashboard-list">
                                @foreach ($suppliers as $supplier)
                                    <li class="dashboard-list__item">
                                        <div class="media media--warning align-items-center">
                                            <div class="media-header rounded">
                                                @if ($supplier->logo)
                                                    <img  loading="lazy"  height="40" src="{{ asset('uploads/fournesser') }}/{{ $supplier->logo }}" alt="">
                                                @else
                                                    <svg fill="#000000" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="35px" height="35px"><path d="M 31.494141 5.1503906 L 5.9277344 7.0019531 A 1.0001 1.0001 0 0 0 5.9042969 7.0039062 A 1.0001 1.0001 0 0 0 5.8652344 7.0097656 A 1.0001 1.0001 0 0 0 5.7929688 7.0214844 A 1.0001 1.0001 0 0 0 5.7636719 7.0292969 A 1.0001 1.0001 0 0 0 5.7304688 7.0371094 A 1.0001 1.0001 0 0 0 5.6582031 7.0605469 A 1.0001 1.0001 0 0 0 5.6113281 7.0800781 A 1.0001 1.0001 0 0 0 5.5839844 7.0917969 A 1.0001 1.0001 0 0 0 5.4335938 7.1777344 A 1.0001 1.0001 0 0 0 5.4082031 7.1933594 A 1.0001 1.0001 0 0 0 5.3476562 7.2421875 A 1.0001 1.0001 0 0 0 5.3359375 7.2539062 A 1.0001 1.0001 0 0 0 5.2871094 7.2988281 A 1.0001 1.0001 0 0 0 5.2578125 7.3320312 A 1.0001 1.0001 0 0 0 5.2148438 7.3828125 A 1.0001 1.0001 0 0 0 5.1992188 7.4023438 A 1.0001 1.0001 0 0 0 5.15625 7.4648438 A 1.0001 1.0001 0 0 0 5.1445312 7.484375 A 1.0001 1.0001 0 0 0 5.1074219 7.5488281 A 1.0001 1.0001 0 0 0 5.09375 7.5761719 A 1.0001 1.0001 0 0 0 5.0644531 7.6484375 A 1.0001 1.0001 0 0 0 5.0605469 7.65625 A 1.0001 1.0001 0 0 0 5.015625 7.8300781 A 1.0001 1.0001 0 0 0 5.0097656 7.8613281 A 1.0001 1.0001 0 0 0 5.0019531 7.9414062 A 1.0001 1.0001 0 0 0 5.0019531 7.9453125 A 1.0001 1.0001 0 0 0 5 8 L 5 33.738281 C 5 34.76391 5.3151542 35.766862 5.9042969 36.607422 A 1.0001 1.0001 0 0 0 5.953125 36.671875 L 12.126953 44.101562 A 1.0001 1.0001 0 0 0 12.359375 44.382812 L 12.75 44.851562 A 1.0006635 1.0006635 0 0 0 12.917969 45.011719 C 13.50508 45.581386 14.317167 45.917563 15.193359 45.861328 L 42.193359 44.119141 C 43.762433 44.017718 45 42.697027 45 41.125 L 45 15.132812 C 45 14.209354 44.565523 13.390672 43.904297 12.839844 A 1.0008168 1.0008168 0 0 0 43.748047 12.695312 L 43.263672 12.337891 A 1.0001 1.0001 0 0 0 43.0625 12.189453 L 34.824219 6.1132812 C 33.865071 5.4054876 32.682705 5.0641541 31.494141 5.1503906 z M 31.638672 7.1445312 C 32.352108 7.0927682 33.061867 7.29845 33.636719 7.7226562 L 39.767578 12.246094 L 14.742188 13.884766 C 13.880567 13.941006 13.037689 13.622196 12.425781 13.011719 L 12.423828 13.011719 L 8.2539062 8.8398438 L 31.638672 7.1445312 z M 7 10.414062 L 11.011719 14.425781 L 12 15.414062 L 12 40.818359 L 7.5390625 35.449219 C 7.1899317 34.947488 7 34.351269 7 33.738281 L 7 10.414062 z M 41.935547 14.134766 C 42.526748 14.096822 43 14.54116 43 15.132812 L 43 41.125 C 43 41.660973 42.59938 42.08847 42.064453 42.123047 L 15.064453 43.865234 C 14.770856 43.884078 14.506356 43.783483 14.314453 43.605469 A 1.0006635 1.0006635 0 0 0 14.3125 43.603516 C 14.3125 43.603516 14.310547 43.601562 14.310547 43.601562 C 14.306465 43.597733 14.304796 43.59179 14.300781 43.587891 A 1.0006635 1.0006635 0 0 0 14.289062 43.572266 C 14.112238 43.393435 14 43.149431 14 42.867188 L 14 16.875 C 14 16.337536 14.39999 15.911571 14.935547 15.876953 L 41.935547 14.134766 z M 38.496094 19 L 33.421875 19.28125 C 32.647875 19.36125 31.746094 19.938 31.746094 20.875 L 33.996094 21.0625 L 33.996094 31.753906 L 26.214844 19.751953 L 20.382812 20.080078 C 19.291812 20.160078 18.994141 20.970953 18.994141 22.001953 L 21.244141 22.001953 L 21.244141 37.566406 C 21.244141 37.566406 20.191844 37.850406 19.839844 37.941406 C 19.091844 38.134406 18.994141 38.784906 18.994141 39.253906 C 18.994141 39.253906 22.746656 39.065547 24.472656 38.935547 C 26.431656 38.785547 26.496094 37.472656 26.496094 37.472656 L 24.246094 37.003906 L 24.246094 25.470703 C 24.246094 25.470703 29.965844 34.660328 31.714844 37.361328 C 32.537844 38.630328 33.152375 38.878906 34.234375 38.878906 C 35.122375 38.878906 35.962141 38.616594 36.994141 38.058594 L 36.994141 20.697266 C 36.994141 20.697266 37.184203 20.687141 37.783203 20.494141 C 38.466203 20.273141 38.496094 19.656 38.496094 19 z"/></svg>
                                                @endif
                                            </div>
                                            <div class="media-body d-flex justify-content-between">
                                                <h4 class="media-body__title font-weight-normal">{{ $supplier->suplier }} ({{ $supplier->getLead()->where('lead_label', 2)->count() }})</h4>
                                                <span>{{ ($supplier->getLead()->where('lead_label', 2)->count() > 0 && $new_lead_count > 0) ? number_format((($supplier->getLead()->where('lead_label', 2)->count() / $new_lead_count) * 100), 2) : 0  }} %</span>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-xl-4 col-lg-6">
                <div class="dashboard-card">
                    <div class="dashboard-card__header d-flex">
                        <h3 class="dashboard-card__header__title dashboard-card__header__title--lg my-0">{{ __('Notion List') }}</h3>
                        <a href="{{ route('notion.index') }}" class="btn btn-sm shadow-none text-black ml-auto">
                            Voir tous
                        </a>
                    </div>
                    <div class="overflow-hidden">
                        <div class="dashboard-card__body simple-bar h-100">
                            <ul class="dashboard-list">
                                @foreach ($notions as $notion)
                                    <li class="dashboard-list__item">
                                        <div class="media media--warning">
                                            <div class="media-header rounded">
                                                <svg fill="#000000" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="35px" height="35px"><path d="M 31.494141 5.1503906 L 5.9277344 7.0019531 A 1.0001 1.0001 0 0 0 5.9042969 7.0039062 A 1.0001 1.0001 0 0 0 5.8652344 7.0097656 A 1.0001 1.0001 0 0 0 5.7929688 7.0214844 A 1.0001 1.0001 0 0 0 5.7636719 7.0292969 A 1.0001 1.0001 0 0 0 5.7304688 7.0371094 A 1.0001 1.0001 0 0 0 5.6582031 7.0605469 A 1.0001 1.0001 0 0 0 5.6113281 7.0800781 A 1.0001 1.0001 0 0 0 5.5839844 7.0917969 A 1.0001 1.0001 0 0 0 5.4335938 7.1777344 A 1.0001 1.0001 0 0 0 5.4082031 7.1933594 A 1.0001 1.0001 0 0 0 5.3476562 7.2421875 A 1.0001 1.0001 0 0 0 5.3359375 7.2539062 A 1.0001 1.0001 0 0 0 5.2871094 7.2988281 A 1.0001 1.0001 0 0 0 5.2578125 7.3320312 A 1.0001 1.0001 0 0 0 5.2148438 7.3828125 A 1.0001 1.0001 0 0 0 5.1992188 7.4023438 A 1.0001 1.0001 0 0 0 5.15625 7.4648438 A 1.0001 1.0001 0 0 0 5.1445312 7.484375 A 1.0001 1.0001 0 0 0 5.1074219 7.5488281 A 1.0001 1.0001 0 0 0 5.09375 7.5761719 A 1.0001 1.0001 0 0 0 5.0644531 7.6484375 A 1.0001 1.0001 0 0 0 5.0605469 7.65625 A 1.0001 1.0001 0 0 0 5.015625 7.8300781 A 1.0001 1.0001 0 0 0 5.0097656 7.8613281 A 1.0001 1.0001 0 0 0 5.0019531 7.9414062 A 1.0001 1.0001 0 0 0 5.0019531 7.9453125 A 1.0001 1.0001 0 0 0 5 8 L 5 33.738281 C 5 34.76391 5.3151542 35.766862 5.9042969 36.607422 A 1.0001 1.0001 0 0 0 5.953125 36.671875 L 12.126953 44.101562 A 1.0001 1.0001 0 0 0 12.359375 44.382812 L 12.75 44.851562 A 1.0006635 1.0006635 0 0 0 12.917969 45.011719 C 13.50508 45.581386 14.317167 45.917563 15.193359 45.861328 L 42.193359 44.119141 C 43.762433 44.017718 45 42.697027 45 41.125 L 45 15.132812 C 45 14.209354 44.565523 13.390672 43.904297 12.839844 A 1.0008168 1.0008168 0 0 0 43.748047 12.695312 L 43.263672 12.337891 A 1.0001 1.0001 0 0 0 43.0625 12.189453 L 34.824219 6.1132812 C 33.865071 5.4054876 32.682705 5.0641541 31.494141 5.1503906 z M 31.638672 7.1445312 C 32.352108 7.0927682 33.061867 7.29845 33.636719 7.7226562 L 39.767578 12.246094 L 14.742188 13.884766 C 13.880567 13.941006 13.037689 13.622196 12.425781 13.011719 L 12.423828 13.011719 L 8.2539062 8.8398438 L 31.638672 7.1445312 z M 7 10.414062 L 11.011719 14.425781 L 12 15.414062 L 12 40.818359 L 7.5390625 35.449219 C 7.1899317 34.947488 7 34.351269 7 33.738281 L 7 10.414062 z M 41.935547 14.134766 C 42.526748 14.096822 43 14.54116 43 15.132812 L 43 41.125 C 43 41.660973 42.59938 42.08847 42.064453 42.123047 L 15.064453 43.865234 C 14.770856 43.884078 14.506356 43.783483 14.314453 43.605469 A 1.0006635 1.0006635 0 0 0 14.3125 43.603516 C 14.3125 43.603516 14.310547 43.601562 14.310547 43.601562 C 14.306465 43.597733 14.304796 43.59179 14.300781 43.587891 A 1.0006635 1.0006635 0 0 0 14.289062 43.572266 C 14.112238 43.393435 14 43.149431 14 42.867188 L 14 16.875 C 14 16.337536 14.39999 15.911571 14.935547 15.876953 L 41.935547 14.134766 z M 38.496094 19 L 33.421875 19.28125 C 32.647875 19.36125 31.746094 19.938 31.746094 20.875 L 33.996094 21.0625 L 33.996094 31.753906 L 26.214844 19.751953 L 20.382812 20.080078 C 19.291812 20.160078 18.994141 20.970953 18.994141 22.001953 L 21.244141 22.001953 L 21.244141 37.566406 C 21.244141 37.566406 20.191844 37.850406 19.839844 37.941406 C 19.091844 38.134406 18.994141 38.784906 18.994141 39.253906 C 18.994141 39.253906 22.746656 39.065547 24.472656 38.935547 C 26.431656 38.785547 26.496094 37.472656 26.496094 37.472656 L 24.246094 37.003906 L 24.246094 25.470703 C 24.246094 25.470703 29.965844 34.660328 31.714844 37.361328 C 32.537844 38.630328 33.152375 38.878906 34.234375 38.878906 C 35.122375 38.878906 35.962141 38.616594 36.994141 38.058594 L 36.994141 20.697266 C 36.994141 20.697266 37.184203 20.687141 37.783203 20.494141 C 38.466203 20.273141 38.496094 19.656 38.496094 19 z"/></svg>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-body__title font-weight-normal"><a href="{{ route('notion.details', $notion->id) }}">{{ $notion->title }}</a></h4>
                                                <p class="media-body__sub-title d-flex">
                                                    {{ $notion->createdBy->name }}
                                                    <span class="text-black ml-auto">{{ \Carbon\Carbon::parse($notion->created_at)->diffForHumans() }}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="col-xl-4 col-lg-6">
                <div class="dashboard-card">
                    <div class="dashboard-card__header d-flex">
                        <h3 class="dashboard-card__header__title dashboard-card__header__title--lg my-0">Rappeler</h3>
                        <div class="dropdown dropdown--custom ml-auto">
                            <button id="rapplerListLabel" class="btn btn-sm shadow-none dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Prospect
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item rappel_list" data-value="lead" href="#">Prospects</a>
                                <a class="dropdown-item rappel_list" data-value="client" href="#">Clients</a>
                                <a class="dropdown-item rappel_list" data-value="project" href="#">Chantiers</a>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-hidden">
                        <div class="dashboard-card__body simple-bar h-100">
                            <ul class="dashboard-list" id="rapplerListRender">
                                @forelse ($lead_rapplers as $rappler)
                                    <li class="dashboard-list__item">
                                        <div class="media media--warning">
                                            <div class="media-body">
                                                <div class="row" style="cursor: pointer" data-toggle="modal" data-target="#rapplerStatusAddModal{{ $rappler->id }}">
                                                    <div class="col-md-3">
                                                        <span>{{ $rappler->Prenom .' '. $rappler->Nom }}</span>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <span>{{ $rappler->callbackUser->name ?? ''  }}</span>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <span>{{ $rappler->phone }}</span>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <span>{{ \Carbon\Carbon::parse($rappler->callback_time)->format('d/m/Y') }} à {{ \Carbon\Carbon::parse($rappler->callback_time)->format('H:i') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @push('all_modals')
                                        <div class="modal modal--aside fade" id="rapplerStatusAddModal{{ $rappler->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content border-0">
                                                    <div class="modal-header border-0 pb-0">
                                                        <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                                                            <span class="novecologie-icon-close"></span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-center pt-0">
                                                        <h1 class="form__title position-relative mb-4">Rappel type</h1>
                                                        <form action="{{ route('rappler.type.change') }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="feature_id" value="{{ $rappler->id }}">
                                                            <input type="hidden" name="type" value="lead">
                                                            <input type="hidden" name="expired_date" value="{{ $rappler->callback_time }}">
                                                            <input type="hidden" name="callback_user_id" value="{{ $rappler->callback_user_id }}">
                                                            <div class="form-group">
                                                                <label for="#">Sélectionner une type</label>
                                                                <select class="shadow-none form-control" name="status" required>
                                                                    <option value="" selected>{{ __('Select') }}</option>
                                                                    <option value="Réalisé">Réalisé</option>
                                                                    <option value="Reporté">Reporté</option>
                                                                    <option value="Annulé">Annulé</option>
                                                                </select>
                                                            </div>
                                                            <div class="d-flex justify-content-center">
                                                                <button type="submit" class="primary-btn btn-success primary-btn--md rounded border-0 my-3 mx-1">
                                                                    {{ __('Submit') }}
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endpush
                                    @empty
                                        <li class="dashboard-list__item text-center">
                                            <h3>Aucune donnée trouvée</h3>
                                        </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="dashboard-card dashboard-card--min">
                    <div class="dashboard-card__header">
                        <h3 class="dashboard-card__header__title dashboard-card__header__title--lg my-0">Chantiers Details</h3>
                    </div>
                    <div class="overflow-hidden h-100">
                        <div class="dashboard-card__body p-0 simple-bar h-100">
                            <table class="table table--dashboard no-wrap">
                                <thead>
                                    <tr>
                                        <th>{{ __('Sl') }}</th>
                                        <th>{{ __('Project Name') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th>{{ __('Phone') }}</th>
                                        <th>{{ __('Postal Code') }}</th>
                                        <th>{{ __('Status') }}</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($projectList as $project)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $project->Prenom }}</td>
                                            <td>{{ $project->Email??__('Not Provided') }}</td>
                                            <td>{{ $project->phone??__('Not Provided') }}</td>
                                            <td>{{ $project->Code_Postal??__('Not Provided') }}</td>
                                            <td>{{ $project->projectStatus ? $project->projectStatus->status : 'status unknown' }}</td>
                                            {{-- <td>{{ $project->getStatus->status ?? __('No Status') }}</td>  --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal modal--aside fade" id="personalNoteModal" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                    <span class="novecologie-icon-close"></span>
                </button>
            </div>
            <div class="modal-body pt-0">
                <h1 class="form__title position-relative mb-4">Ajouter une note personnelle</h1>
                <form action="{{ route('personal.note.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="#">Note *</label>
                        <textarea name="note" class="shadow-none form-control" required></textarea>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="primary-btn btn-success primary-btn--md rounded border-0 my-3 mx-1">
                            {{ __('Submit') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="rapplerModal">

</div>
@endsection

@push('plugins-script')
<script src="{{ asset('crm_assets/assets/plugins/apexchart/js/apexcharts.min.js') }}"></script>
@endpush

@push('js')
<script>
    function eachApexChartsCallFunction(selector, option){
        return new ApexCharts(document.querySelector(selector), option).render();
    };

    let colorWarning = "#FF9F43";
    let colorDanger = "#EA5455";
    let colorSuccess = "#28C76F";
    let colorInfo = "#00CFE8";
    let colorPurple = "#7367F0";

    let commonChartOptions = {
        legend: {
            position: 'top',
            showForSingleSeries: true,
            horizontalAlign: 'left',
            floating: true,
        },
        grid: {
            // show: false,
            padding: {
                top: 0,
                bottom: 0,
                left: 0,
                right: 0
            },
            // xaxis: {
            //     lines: {
            //         show: false
            //     },
            //     tick: {
            //         show: false
            //     },
            // },
            // yaxis: {
            //     lines: {
            //         show: false
            //     },
            //     tick: {
            //         show: false
            //     },
            // },
        },
        // tooltip: {
        //     enabled: false,
        //     x: {
        //         show: false,
        //     },
        // },
        dataLabels: {
            enabled: false,
        },
    };

    let clientsChartOptions = {
        series: [
            {
                name: 'Clients',
                data: @json($clients),
            }
        ],
        labels: @json($days),
        chart: {
            type: 'area',
            height: 250,
            parentHeightOffset: 0,
            offsetY: 5,
            toolbar: {
                show: false,
            },
            sparkline: {
                enabled: false,
            },
        },
        colors: [colorInfo],
        fill: {
          opacity: 1,
          type: 'solid'
        },
        stroke: {
            curve: 'straight'
        },
        xaxis: {
            floating: true,
            labels: {
                show: false,
            },
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false,
            },
            tooltip: {
                enabled: false,
            },
        },
        yaxis: {
            show: false,
            labels: {
                formatter: (value)=> value + " Converted"
            },
        },
        ...commonChartOptions,
    };

    let productsChartOptions = {
        series: [
            {
                name: 'Prospects',
                data: @json($leads)
            }
        ],
        labels: @json($days),
        chart: {
            type: 'area',
            height: 250,
            parentHeightOffset: 0,
            offsetY: 5,
            toolbar: {
                show: false,
            },
            sparkline: {
                enabled: false,
            },
        },
        colors: [colorDanger],
        // fill: {
        //     gradient: {
        //         enabled: true,
        //         opacityFrom: 0.55,
        //         opacityTo: 0.25,
        //     },
        // },
        fill: {
          opacity: 1,
          type: 'solid'
        },
        stroke: {
            curve: 'straight'
        },
        xaxis: {
            floating: true,
            labels: {
                show: false,
            },
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false,
            },
            tooltip: {
                enabled: false,
            },
        },
        yaxis: {
            show: false,
            labels: {
                formatter: (value)=> value + " Unit"
            },
        },
        ...commonChartOptions,
    };

    let leadClientChartOptions = {
        series: [
            {
                name: 'Prospects',
                data: @json($leadsWithConvert)
            },
            {
                name: ' Clients',
                data: @json($clients)
            }
        ],
        labels: @json($days),
        chart: {
            id: 'leadClientChart',
            type: 'bar',
            height: 300,
            parentHeightOffset: 0,
            offsetY: 5,
            toolbar: {
                show: false,
            },
            sparkline: {
                enabled: false,
            },
        },
        plotOptions: {
          bar: {
            horizontal: false,
            endingShape: 'rounded',
            columnWidth: '80%',
          }
        },
        colors: ["#7367F0", colorWarning],
        stroke: {
            curve: 'smooth'
        },
        legend: {
            position: 'top',
            showForSingleSeries: true,
            horizontalAlign: 'left',
        },
        dataLabels: {
            enabled: false,
        },
        xaxis: {
            // categories: @json($daysNumber),
            labels: {
                show: false,
            },
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false,
            },
            tooltip: {
                enabled: false,
            },
        },
        yaxis: {
            // categories: [
            //     '5000', '4000', '6000', '3000', '7000', '2000', '8000', '1000', '9000', '1500', '1200', '1900'
            // ],
            labels: {
                formatter: (value)=> value + ""
            },
        },
        grid: {
            // show: false,
            padding: {
                top: 0,
                bottom: 0,
                left: 0,
                right: 0
            },
        },
        // tooltip: {
        //     x: {
        //         show: false,
        //     },
        // },
    };

    let projectsChartOptions = {
        series: [
            {
                name: 'Chantiers',
                data: @json($projects),
            }
        ],
        labels: @json($days),
        chart: {
            type: 'bar',
            height: 250,
            parentHeightOffset: 0,
            offsetY: 5,
            toolbar: {
                show: false,
            },
            sparkline: {
                enabled: false,
            },
        },
        plotOptions: {
            bar: {
                borderRadius: 3,
            }
        },
        colors: [colorSuccess],
        stroke: {
            curve: 'smooth'
        },
        xaxis: {
            floating: true,
            labels: {
                show: false,
            },
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false,
            },
            tooltip: {
                enabled: false,
            },
        },
        yaxis: {
            show: false,
            labels: {
                formatter: (value)=> value + ""
            },
        },
       ...commonChartOptions,
    };

    let overviewChartOptions = {
        series: [{
            name: '{{ __('Leads Overview') }}',
            data: @json($lastThreeMonthlead),
        }],
        xaxis: {
          categories: @json($lastThreeMonth),
        },
        plotOptions: {
          bar: {
            borderRadius: 4,
            horizontal: true,
          }
        },
        chart: {
            height: 300,
            type: 'bar',
            parentHeightOffset: 0,
            offsetY: 5,
            toolbar: {
                show: false,
            },
            sparkline: {
                enabled: false,
            },
        },
        legend: {
            show: true,
            position: 'bottom',
            showForSingleSeries: true,
            horizontalAlign: 'center',
        },
        stroke: {
            lineCap: "round",
        },
        colors: ['#7367F0'],
        ...commonChartOptions,
    };

    $(document).ready(function () {
        // eachApexChartsCallFunction("#clientsChart", clientsChartOptions);
        // eachApexChartsCallFunction("#productsChart", productsChartOptions);
        // eachApexChartsCallFunction("#revenueChart", revenueChartOptions);
        eachApexChartsCallFunction("#overviewChart", overviewChartOptions);

        var clientChart = new ApexCharts(document.querySelector("#clientsChart"), clientsChartOptions);
        clientChart.render();
        var projectsChart = new ApexCharts(document.querySelector("#projectsChart"), projectsChartOptions);
        projectsChart.render();
        var leadChart = new ApexCharts(document.querySelector("#productsChart"), productsChartOptions);
        leadChart.render();
        var leadClientChart = new ApexCharts(document.querySelector("#revenueChart"), leadClientChartOptions);
        leadClientChart.render();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('.project_chart').click(function(e){
            e.preventDefault();
            var label = $(this).text();
            $.ajax({
                url : "{{ route('chart.project.filter') }}",
                method : 'post',
                data : {
                    value : $(this).attr('data-value'),
                },
                success: function (response) {
                    console.log(label);
                    $("#project_chart_label").text(label);
                    $("#projectCount").text(response.count);
                    projectsChart.updateSeries([{
                        data: response.data,
                    }]);
                },
            });
        });
        $('.client_chart').click(function(e){
            e.preventDefault();
            var label = $(this).text();
            $.ajax({
                url : "{{ route('chart.client.filter') }}",
                method : 'post',
                data : {
                    value : $(this).attr('data-value'),
                },
                success: function (response) {
                    $("#client_chart_label").text(label);
                    $("#clientCount").text(response.count);
                    clientChart.updateSeries([{
                        data: response.data,
                    }]);
                },
            });
        });
        $('.lead_chart').click(function(e){
            e.preventDefault();
            var label = $(this).text();
            $.ajax({
                url : "{{ route('chart.lead.filter') }}",
                method : 'post',
                data : {
                    value : $(this).attr('data-value'),
                },
                success: function (response) {
                    console.log(label);
                    $("#lead_chart_label").text(label);
                    $("#leadCount").text(response.count);

                    leadChart.updateSeries([{
                        data: response.data,
                    }]);
                },
            });
        });
        $('.lead_list').click(function(e){
            e.preventDefault();
            var label = $(this).text();
            $.ajax({
            url : "{{ route('lead.filter.list') }}",
                method : 'post',
                data : {
                    value : $(this).attr('data-value'),
                },
                success: function (response) {
                    $("#leadListLabel").text(label);
                    $("#leadListRender").html(response);
                },
            });
        });
        $('.rappel_list').click(function(e){
            e.preventDefault();
            var label = $(this).text();
            $.ajax({
                url : "{{ route('rappler.filter.list') }}",
                method : 'post',
                data : {
                    value : $(this).attr('data-value'),
                },
                success: function (response) {
                    $("#rapplerListLabel").text(label);
                    $("#rapplerListRender").html(response.data);
                    $("#rapplerModal").html(response.modal);
                },
            });
        });
        $('.lead_client_state').click(function(e){
            e.preventDefault();
            var label = $(this).text();
            $.ajax({
                url : "{{ route('lead.client.filter') }}",
                method : 'post',
                data : {
                    value : $(this).attr('data-value'),
                },
                success: function (response) {
                    $("#lead_client_label").text(label);
                    $("#leadClientCount").text(response.percentage + ' %');
                    ApexCharts.exec("leadClientChart", "updateOptions", {
                        series: [
                            {
                                data: response.lead,
                            },
                            {
                                data: response.client,
                            }
                        ],
                        xaxis: {
                            categories: response.label,
                        }
                    });
                },
            });
        });

        $('#filterButton').click(function(e){
            e.preventDefault();
            var from = $('#start_date').val();
            var to = $('#end_date').val();
            if(from){
                $.ajax({
                    url : "{{ route('dashboard.filter') }}",
                    method : 'post',
                    data : {
                        from : from,
                        to : to,
                    },
                    success: function (response) {
                       $('#analyticWrap').html(response);
                       $('#clearFilter').removeClass('d-none');
                    },
                });
            }else{
                $('#errorMessage').text("{{ __('please select start date first') }}");
				$('.toast.toast--error').toast('show');
            }
        });

        $('#filterButtonClear').click(function(e){
            e.preventDefault();
            $('#start_date').val('');
            $('#end_date').val('');
            $.ajax({
                url : "{{ route('dashboard.filter.clear') }}",
                method : 'post',
                success: function (response) {
                    $('#analyticWrap').html(response);
                    $('#clearFilter').addClass('d-none');
                    $('input[type=date]').wrap('<div class="datepicker-input"></div>');
                    document.querySelectorAll('input[type=date]').forEach(e => {
                        flatpickr(e, {
                            minDate: e.getAttribute('min'),
                            maxDate: e.getAttribute('max'),
                            defaultDate: e.getAttribute('value'),
                            altFormat: 'j F Y',
                            dateFormat: 'Y-m-d',
                            allowInput: true,
                            altInput: true,
                            locale: "fr",
                            onReady: (selectedDates, dateStr, instance) => {
                                const mainInputDataId = instance.input.dataset.id;
                                const altInput = instance.input.parentElement?.querySelector(".input");
                                altInput.setAttribute("onkeypress", "return false");
                                altInput.setAttribute("onpaste", "return false");
                                altInput.setAttribute("autocomplete", "off");
                                altInput.setAttribute("id", mainInputDataId);
                            },
                        });
                    });
                },
            });
        });

        /* Analytic Cards Toggler Function */
        $(".analytic-toggler").on("click", function(){
            let status = $(this).data('status');
            let module = $(this).data('module');
            $(".analytic-wrapper").slideToggle();
            if(status == 'hide'){
                $(this).data('status', 'show');
                $(this).html('<i class="bi bi-eye"></i>')
            }else{
                $(this).data('status', 'hide');
                $(this).html('<i class="bi bi-eye-slash"></i>')
            }
            $.ajax({
                type : "POST",
                url  : "{{ route('analytic.toggler.update') }}",
                data : {status, module},
                success: (response)=>{
                    console.log(response);
                },
                error : (error)=> {
                    console.log(error);
                }

            });
        });

        $("[data-audio-play]").on("click", function(){
            let currentAudioParentElement = $(this).closest(".ringover-call-btn-wrapper")
            let currentAudioElement = $(this).closest(".ringover-call-audio-wrapper").find(".ringover-call-audio")
            $(".ringover-call-btn-wrapper").removeClass("playing")
            $(".ringover-call-audio").each((index, item)=>{
                item.pause()
                item.currentTime = 0;
            })
            currentAudioElement.get(0).play()
            currentAudioParentElement.addClass("playing")
            currentAudioElement.on("ended", ()=>{
                currentAudioParentElement.removeClass("playing")
            })
        })

        $("[data-audio-stop]").on("click", function(){
            let currentAudioParentElement = $(this).closest(".ringover-call-btn-wrapper")
            let currentAudioElement = $(this).closest(".ringover-call-audio-wrapper").find(".ringover-call-audio")
            currentAudioElement.get(0).pause()
            currentAudioElement.get(0).currentTime = 0;
            currentAudioParentElement.removeClass("playing")

            // $(".ringover-call-btn-wrapper").removeClass("playing")
            // $(".ringover-call-audio").each((index, item)=>{
            // })
            // currentAudioElement.get(0).play()
            // currentAudioParentElement.addClass("playing")
            // currentAudioElement.on("ended", ()=>{
            //     currentAudioParentElement.removeClass("playing")
            // })
        })

    });
</script>
@endpush
