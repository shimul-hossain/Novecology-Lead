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
        @if ($login_user_role != 'sales_manager' && $login_user_role != 'sales_manager_externe' &&  $login_user_role != 'telecommercial' && $login_user_role != 'telecommercial_externe' && $login_user_role != 'study_manager' && $login_user_role != 'manager' && $login_user_role != 'adv' && $login_user_role != 'assistant_adv' && $login_user_role != 's_admin' && $login_user_role != 'manager_direction' && $login_user_role != 'Gestionnaire' && $login_user_role != 'adv_copy_1693686130' && $login_user_role != 'Referent_Technique')
            <div class="min-vh-100 d-flex align-items-center justify-content-center">
                <h1 class="mt-5 text-center">Bonjour <span style="color: #3C78D8;">{{ Auth::user()->first_name }} {{ Auth::user()->name }}</span></h1>
            </div>
        @else
            <h1 class="mt-5">Bonjour <span style="color: #3C78D8;">{{ Auth::user()->first_name }} {{ Auth::user()->name }}</span></h1>
            <div class="row match-height">
                @if ($login_user_role == 's_admin' || $login_user_role == 'manager_direction')
                    <div class="col-12">
                        <div class="w-100">
                            <div class="d-lg-flex flex-wrap align-items-center">
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
                                                <button type="button" id="filterButton" class="primary-btn primary-btn--primary border-0 rounded px-4">Filtrer</button>
                                                <div class="d-none" id="clearFilter">
                                                    {{-- <button type="button" id="filterButtonClear" class="secondary-btn border-0">Reinitialiser</button> --}}
                                                    <a href="{{ route('dashboard.analytic') }}" class="d-inline-block secondary-btn border-0">Reinitialiser</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if ($login_user_role != 'adv' && $login_user_role != 'adv_copy_1693686130' && $login_user_role != 'assistant_adv' && $login_user_role != 'Referent_Technique')
                    <div class="col-12">
                        {{-- style="display: {{ checkAnalyticTogger('main_dashboard')? '':'none' }}" --}}
                        <div class="analytic-wrapper w-100">
                            <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-sm-2 row-cols-1" id="analyticWrap">
                                @include('admin.analytic_stats--static')
                            </div>
                        </div>
                    </div>
                @endif
                @if ($login_user_role != 'adv_copy_1693686130')
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
                    @if ($login_user_role != 'Referent_Technique')
                        <div class="col-xl-4 col-lg-6">
                            <div class="dashboard-card">
                                <div class="dashboard-card__header d-flex justify-content-between">
                                    <h3 class="dashboard-card__header__title dashboard-card__header__title--lg my-0">Mes tâches</h3>
                                    <div>
                                        <button type="button" class="btn btn-warning text-white shadow-none" data-toggle="modal" data-target="#newTaskModal">
                                            <i class="bi bi-plus-square"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="overflow-hidden">
                                    <div class="dashboard-card__body simple-bar h-100">
                                        <ul class="dashboard-list">
                                            @forelse (Auth::user()->getTasks as $task)
                                                <li class="dashboard-list__item">
                                                    <div class="media media--success">
                                                        <div class="media-body align-items-center d-flex">
                                                            <div>
                                                                <h3 class="media-body__title font-weight-normal">{{ $task->getProject ? ($task->getProject->Prenom.' '.$task->getProject->Nom): ''  }}</h3>
                                                                <p class="media-body__sub-title d-flex">
                                                                    {{ $task->description }}
                                                                </p>
                                                            </div>
                                                            <button type="button" title="{{ $task->status }}" class="btn {{ $task->status == 'Terminé' ? 'text-success': 'text-warning'  }} rounded-circle shadow-none ml-auto p-0" data-id="{{ $task->id }}" style="font-size: 30px; line-height: 0;">
                                                            {{-- <button type="button" title="{{ $task->status }}" class="btn {{ $task->status == 'Terminé' ? 'text-success': 'text-warning'  }} rounded-circle shadow-none ml-auto p-0 taskEditBtn" data-id="{{ $task->id }}" style="font-size: 30px; line-height: 0;"> --}}
                                                                @if ($task->status == 'Terminé')
                                                                    <i class="bi bi-check-circle"></i>
                                                                @else
                                                                    <i class="bi bi-clock"></i>
                                                                @endif
                                                            </button>
                                                        </div>
                                                    </div>
                                                </li>
                                                @empty
                                                    <li class="dashboard-list__item text-center ">
                                                        <h3>Pas de tâche trouvé</h3>
                                                    </li>
                                            @endforelse
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6">
                            <div class="dashboard-card">
                                <div class="dashboard-card__header d-flex">
                                    <div class="text-center pr-3 mr-3 border-right">
                                        <span class="text-uppercase">{{ \Carbon\Carbon::today()->locale(app()->getLocale())->translatedFormat('l') }}</span>
                                        <h3 class="font-weight-bold mb-0">{{ \Carbon\Carbon::today()->format('d') }}</h3>
                                    </div>
                                    <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                        <h3 class="dashboard-card__header__title dashboard-card__header__title--lg my-0">Mes événements</h3>
                                        <button type="button" class="btn btn-warning text-white shadow-none" data-toggle="modal" data-target="#newEventModal">
                                            <i class="bi bi-plus-square"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="overflow-hidden">
                                    <div class="dashboard-card__body simple-bar h-100">
                                        <ul class="dashboard-list">
                                            @forelse (Auth::user()->createdEvent()->whereDate('date', \Carbon\Carbon::today())->get() as $event)
                                                <li class="dashboard-list__item">
                                                    <div class="media media--success">
                                                        <div class="media-body align-items-center d-flex">
                                                            <div>
                                                                @if ($event->project_id)
                                                                    @if ($event->type == 'Prospect')
                                                                        @if ($event->getLead)
                                                                            <h3 class="media-body__title font-weight-normal">{{ $event->getLead->Prenom.' '.$event->getLead->Nom  }}</h3>
                                                                        @else
                                                                            <h3 class="media-body__title font-weight-normal">{{ $event->title  }}</h3>
                                                                        @endif
                                                                    @elseif($event->type == 'Chantier')
                                                                        @if ($event->getProject)
                                                                            <h3 class="media-body__title font-weight-normal">{{ $event->getProject->Prenom.' '.$event->getProject->Nom  }}</h3>
                                                                        @else
                                                                            <h3 class="media-body__title font-weight-normal">{{ $event->title  }}</h3>
                                                                        @endif
                                                                    @endif
                                                                @else
                                                                    <h3 class="media-body__title font-weight-normal">{{ $event->title  }}</h3>
                                                                @endif
                                                                <p class="media-body__sub-title d-flex">
                                                                    {{ $event->description }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                @empty
                                                    <li class="dashboard-list__item text-center ">
                                                        <h3>Pas d'événement aujourd'hui</h3>
                                                    </li>
                                            @endforelse
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
                @if ($login_user_role != 'assistant_adv' && $login_user_role != 'Referent_Technique')
                    <div class="{{ $login_user_role == 'adv_copy_1693686130' ? 'col-12':'col-xl-8' }}">
                        <div class="w-100">
                            <ul class="nav nav-pills nav-pills--horizontal p-1 bg-white rounded mb-2">
                                @if ($login_user_role != 'adv' &&  $login_user_role != 'adv_copy_1693686130')
                                    <li class="nav-item" role="presentation">
                                        <a href="#!" data-value="individual" class="nav-link statsTab active">Statistique individuelle</a>
                                    </li>
                                @endif
                                @if ($login_user_role == 's_admin' || $login_user_role == 'manager_direction' || $login_user_role == 'sales_manager' || $login_user_role == 'sales_manager_externe')
                                    <li class="nav-item" role="presentation">
                                        <a href="#!" data-value="regie" class="nav-link statsTab">Statistique des équipes</a>
                                    </li>
                                @endif
                                @if ($login_user_role == 's_admin' || $login_user_role == 'manager_direction')
                                    <li class="nav-item" role="presentation">
                                        <a href="#!" data-value="gestionnaire" class="nav-link statsTab">Statistique des gestionnaires</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a href="#!" data-value="lead-stats" class="nav-link statsTab">Statistique des leads </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a href="#!" data-value="statut" class="nav-link statsTab">Statistique des statuts</a>
                                    </li>
                                @endif
                                @if ($login_user_role == 'adv' || $login_user_role == 'adv_copy_1693686130')
                                    <li class="nav-item" role="presentation">
                                        <a href="#!" data-value="statut" class="nav-link statsTab active">Statistique des statuts</a>
                                    </li> 
                                @endif
                            </ul>
                            <div class="loader-parent loading">
                                <div class="row match-height" id="tabStatsWrap"> 
                                    <div class="col-12">
                                        <div class="dashboard-card">
                                            <div class="dashboard-card__header">
                                                <h3 class="dashboard-card__header__title dashboard-card__header__title--lg my-0">LEAD</h3>
                                            </div>
                                            <div class="overflow-hidden h-100">
                                                <div class="dashboard-card__body p-0 simple-bar h-100">
                                                    <table class="table table--dashboard no-wrap">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>CLASSEMENT</th>
                                                                <th>Nouveau</th>
                                                                <th>En Cours</th>
                                                                <th>NRP</th>
                                                                <th>Validation</th>
                                                                <th>Converti</th>
                                                                <th>KO</th>
                                                                <th>Statistiques</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>#</td>
                                                                <td>CLASSEMENT</td>
                                                                <td>Nouveau</td>
                                                                <td>En Cours</td>
                                                                <td>NRP</td>
                                                                <td>Validation</td>
                                                                <td>Converti</td>
                                                                <td>KO</td>
                                                                <td>Statistiques</td>
                                                            </tr>
                                                            <tr>
                                                                <td>#</td>
                                                                <td>CLASSEMENT</td>
                                                                <td>Nouveau</td>
                                                                <td>En Cours</td>
                                                                <td>NRP</td>
                                                                <td>Validation</td>
                                                                <td>Converti</td>
                                                                <td>KO</td>
                                                                <td>Statistiques</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="dashboard-card">
                                            <div class="dashboard-card__header">
                                                <h3 class="dashboard-card__header__title dashboard-card__header__title--lg my-0">CHANTIER</h3>
                                            </div>
                                            <div class="overflow-hidden h-100">
                                                <div class="dashboard-card__body p-0 simple-bar h-100">
                                                    <table class="table table--dashboard no-wrap">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>CLASSEMENT</th>
                                                                <th>En Cours</th>
                                                                <th>Prévisite Réalisé</th>
                                                                <th>Déposé</th>
                                                                <th>Financement Accepté</th>
                                                                <th>Installé</th>
                                                                <th>KO</th>
                                                                <th>Statistiques</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody> 
                                                            <tr>
                                                                <td>#</td>
                                                                <td>CLASSEMENT</td>
                                                                <td>Nouveau</td>
                                                                <td>En Cours</td>
                                                                <td>NRP</td>
                                                                <td>Validation</td>
                                                                <td>Converti</td>
                                                                <td>KO</td>
                                                                <td>Statistiques</td>
                                                            </tr> 
                                                            <tr>
                                                                <td>#</td>
                                                                <td>CLASSEMENT</td>
                                                                <td>Nouveau</td>
                                                                <td>En Cours</td>
                                                                <td>NRP</td>
                                                                <td>Validation</td>
                                                                <td>Converti</td>
                                                                <td>KO</td>
                                                                <td>Statistiques</td>
                                                            </tr> 
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                                <div class="loader-element">
                                    <svg class="preloader__icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
                                        <path class="preloader__icon__path" fill="currentColor" d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                                        <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 50 50" to="360 50 50" repeatCount="indefinite"></animateTransform>
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($login_user_role != 'adv_copy_1693686130')
                        <div class="col-xl-4 col-lg-6">
                            <div class="dashboard-card">
                                <div class="dashboard-card__header d-flex">
                                    <h3 class="dashboard-card__header__title dashboard-card__header__title--lg my-0">Rappeler</h3>
                                    <div class="dropdown dropdown--custom ml-auto">
                                        <button id="rapplerListLabel" class="btn btn-sm shadow-none dropdown-toggle" style="border:1px solid black" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                                                    <div class="media media--success"  style="cursor: pointer" data-target="#rapplerStatusAddModal{{ $rappler->id }}">
                                                        <div class="media-body align-items-center d-flex justify-content-between">
                                                            <div>
                                                                <h3 class="media-body__title font-weight-normal">{{ $rappler->Prenom .' '. $rappler->Nom }}</h3>
                                                                <p class="media-body__sub-title d-flex">
                                                                    {{ $rappler->callbackUser->name ?? ''  }}
                                                                </p>
                                                            </div>
                                                            <span>{{ \Carbon\Carbon::parse($rappler->callback_time)->format('d/m/Y') }} à {{ \Carbon\Carbon::parse($rappler->callback_time)->format('H:i') }}</span>
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
                    @endif
                @else
                    @if ($login_user_role != 'adv_copy_1693686130' && $login_user_role != 'Referent_Technique')
                        <div class="col-xl-4 col-lg-6">
                            <div class="dashboard-card">
                                <div class="dashboard-card__header d-flex">
                                    <h3 class="dashboard-card__header__title dashboard-card__header__title--lg my-0">Rappeler</h3>
                                    <div class="dropdown dropdown--custom ml-auto">
                                        <button id="rapplerListLabel" class="btn btn-sm shadow-none dropdown-toggle" style="border:1px solid black" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                                                    <div class="media media--success"  style="cursor: pointer" data-target="#rapplerStatusAddModal{{ $rappler->id }}">
                                                        <div class="media-body align-items-center d-flex justify-content-between">
                                                            <div>
                                                                <h3 class="media-body__title font-weight-normal">{{ $rappler->Prenom .' '. $rappler->Nom }}</h3>
                                                                <p class="media-body__sub-title d-flex">
                                                                    {{ $rappler->callbackUser->name ?? ''  }}
                                                                </p>
                                                            </div>
                                                            <span>{{ \Carbon\Carbon::parse($rappler->callback_time)->format('d/m/Y') }} à {{ \Carbon\Carbon::parse($rappler->callback_time)->format('H:i') }}</span>
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
                    @endif
                @endif
                @if ($login_user_role == 's_admin' || $login_user_role == 'manager_direction')
                    <div class="col-12">
                        <div class="dashboard-card dashboard-card--min">
                            <div class="dashboard-card__header">
                                <h3 class="dashboard-card__header__title dashboard-card__header__title--lg my-0">{{ __('Ringover Logs') }}</h3>
                            </div>
                            <div class="overflow-hidden h-100">
                                {{-- <div class="loader-parent2 loading"> --}}
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
                                            <tbody id="ringOverTableWrap"> 
                                            </tbody>
                                        </table>
                                    </div>
                                    {{-- <div class="loader-element">
                                        <svg class="preloader__icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
                                            <path class="preloader__icon__path" fill="currentColor" d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                                            <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 50 50" to="360 50 50" repeatCount="indefinite"></animateTransform>
                                            </path>
                                        </svg>
                                    </div>
                                </div> --}}
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
                                <h3 class="dashboard-card__header__title">Dernier prospect</h3>
                                <div class="dropdown dropdown--custom ml-auto">
                                    <button id="leadListLabelText" class="btn btn-sm shadow-none text-black dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                                    <h3 class="dashboard-card__header__title dashboard-card__header__title--lg" id="lastThreeMonthLeadCount">{{ $lastThreeMonthleadCount }}</h3>
                                </div>
                                <h3 class="dashboard-card__header__title mt-2">{{ __('Leads Overview') }}</h3>
                            </div>
                            <div class="dashboard-card__body">
                                <div id="overviewChart"></div>
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
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @endif
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
                <h1 class="form__title text-center position-relative mb-3">Ajouter une note personnelle</h1>
                <form action="{{ route('personal.note.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="#">Note *</label>
                        <textarea name="note" class="shadow-none form-control" rows="6" required></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="primary-btn btn-success primary-btn--md rounded border-0 mx-1">
                            {{ __('Submit') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal modal--aside fade" id="newTaskModal" tabindex="-1" aria-labelledby="mnewTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                    <span class="novecologie-icon-close"></span>
                </button>
            </div>
            <div class="modal-body pt-0">
                <h1 class="form__title position-relative text-center mb-3">Ajouter une tâche</h1>
                <form action="{{ route('new.task.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Type</label>
                        <select name="task_type" class="select2_select_option form-control w-100 taskTypeChange" id="taskTypeChange0" data-id="0" required>
                            <option value="" selected>{{ __('Select') }}</option>
                            <option value="Prospect">Prospect</option>
                            <option value="Chantier">Chantier</option>
                        </select>
                    </div>
                    <div class="form-group"  id="typeChangeWrap0">
                        
                    </div>
                    <div id="projectChangeWrap0">
                        <div class="form-group">
                            <label class="form-label">Département</label>
                            <input type="text" disabled class="form-control shadow-none px-3">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Travaux</label>
                            <select disabled class="select2_select_option shadow-none form-control">
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">TAG</label>
                            <select disabled class="select2_select_option shadow-none form-control">
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="shadow-none form-control" placeholder="Écrivez votre description" rows="5">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Statut</label>
                        <select name="status" id="" class="select2_select_option form-control w-100">
                            <option {{ old('status') == 'Terminé' ? 'selected' : '' }} value="Terminé">Terminé</option>
                            <option {{ old('status') ? (old('status') == 'En traitement' ? 'selected' : '') : 'selected' }} selected value="En traitement">En traitement</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="primary-btn btn-success primary-btn--md rounded border-0 mx-1">
                            {{ __('Submit') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal modal--aside fade rightAsideModal" id="newEventModal" tabindex="-1" aria-labelledby="rightAsideModalLabel" aria-hidden="true">
	<div class="modal-dialog m-0 h-100 bg-white">
		<div class="modal-content simple-bar border-0 h-100 rounded-0">
			<div class="modal-header border-0 pb-0">
				<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
					<span class="novecologie-icon-close"></span>
				</button>
			</div>
			<div class="modal-body">
				<div class="d-flex flex-column align-items-center mb-2">
					<h1 id="addEventheader" class="form__title position-relative text-center mb-3">{{ __('Add Event') }}</h1>
				</div>
				<form action="{{ route('new.event.store') }}" class="form" id="addEventForm" method="POST">
					@csrf
					<div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">Type</label>
                                <select name="event_type" class="select2_select_option form-control w-100 eventTypeChange" id="eventTypeChange" required>
                                    <option value="" selected>{{ __('Select') }}</option>
                                    <option value="Prospect">Prospect</option>
                                    <option value="Chantier">Chantier</option>
                                </select>
                            </div>
                        </div>
						<div class="col-12">
							<div class="form-group" id="eventTypeChangeWrap">
								{{-- <label class="form-label" for="clientSelect">Client</label>
								<select class="select2_select_option shadow-none form-control" id="clientSelect" name="project_id">
									<option value="" selected>Sélectionnez</option>
									@foreach ($totalProjects as $project)
										<option {{ old('project_id') == $project->id ? 'selected':'' }} value="{{ $project->id }}">{{ $project->Prenom.' '.$project->Nom }} - {{ $project->ProjectTravauxTags()->count() > 0 ? implode(', ', $project->ProjectTravauxTags->pluck('tag')->toArray()) : '' }} - {{ $project->Code_Postal }}</option>
									@endforeach
								</select> --}}
							</div>
							@error('project_id')
							<span class="alert text-danger">{{ $message }} **</span>
							@enderror
						</div>
						<div class="col-12" id="evnetClientWrap">
                            <div class="form-group">
                                <label class="form-label">Département</label>
                                <input type="text" disabled class="form-control shadow-none px-3">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Travaux</label>
                                <select disabled class="select2_select_option shadow-none form-control">

                                </select>
                            </div>
                        </div>
						<div class="col-12">
							<div class="form-group">
								<label class="form-label" for="startDate">Date <span class="text-danger">*</span></label>
								<input type="date" name="date" value="{{ \Carbon\Carbon::today() }}" id="startDate" class="flatpickr form-control shadow-none bg-transparent" required>
							</div>
							<span class="alert text-danger d-none" id="dateError"><span>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label class="form-label" for="time">Horaire</label>
								<select name="time" id="time" class="select2_select_option form-control w-100">
									@foreach ($min_30_interval as $key => $hour)
										<option {{ old('time') == $key ? 'selected': ''}} value="{{ $key }}">{{ $hour }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label class="form-label" for="title">Titre</label>
								<input type="text" id="title" name="title" value="{{ old('title') }}" class="form-control shadow-none">
							</div>
							<span class="alert text-danger d-none" id="titleError"></span>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label class="form-label" for="description">{{ __('Description') }}</label>
								<textarea type="text" id="description" name="description" class="form-control shadow-none">{{ old('description') }}</textarea>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label class="form-label" for="guest">Invités</label>
								<input type="text" id="guest" name="guest" value="{{ old('guest') }}" class="form-control shadow-none">
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label class="form-label" for="location">Lieu</label>
								<textarea type="text" id="location" name="location" class="form-control shadow-none">{{ old('location') }}</textarea>
							</div>
						</div>
						<div class="col-12 text-center">
							<button type="submit" class="secondary-btn primary-btn--md border-0 mb-2">{{ __('Submit') }}</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div id="rapplerModal">

</div>
<div id="taskEditModal">
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
                data: @json($leads)
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var clientChart = new ApexCharts(document.querySelector("#clientsChart"), clientsChartOptions);
        clientChart.render();
        var projectsChart = new ApexCharts(document.querySelector("#projectsChart"), projectsChartOptions);
        projectsChart.render();
        var leadChart = new ApexCharts(document.querySelector("#productsChart"), productsChartOptions);
        leadChart.render();
        var leadClientChart = new ApexCharts(document.querySelector("#revenueChart"), leadClientChartOptions);
        leadClientChart.render();
        var leadOverviewChart = new ApexCharts(document.querySelector("#overviewChart"), overviewChartOptions);
        leadOverviewChart.render();
        $.ajax({
            url : "{{ route('topbar.stats') }}",
            method : 'post',
            success: function (response) {
                $('#analyticWrap').html(response);
            },
        });

        $.ajax({
            type : "post",
            url  : "{{ route('initial.render') }}",
            data : {
                value : 'individual'
            },
            success: function (response) {
                // tab stats
                $("#tabStatsWrap").html(response.tab_stats_view);
                $('.loader-parent').removeClass('loading');
                $('.simple-bar').each((index, element) => new SimpleBar(element, { autoHide: true }));

                // topbar stats
                // $('#analyticWrap').html(response.top_bar_stats_view);

                // ringover 
                $('#ringOverTableWrap').html(response.ring_over_view);

                // chart stats
                $("#projectCount").text(response.projectCount);
                projectsChart.updateSeries([{
                    data: response.projects,
                }]);

                $("#leadCount").text(response.leadCount); 
                leadChart.updateSeries([{
                    data: response.leads,
                }]);

                $("#clientCount").text(response.clientCount);
                clientChart.updateSeries([{
                    data: response.clients,
                }]);

                $("#leadListRender").html(response.leadList);

                $("#leadClientCount").text(response.lead_percentage + ' %');
                ApexCharts.exec("leadClientChart", "updateOptions", {
                    series: [
                        {
                            data: response.leads,
                        },
                        {
                            data: response.clients,
                        }
                    ]
                });
                
                $("#lastThreeMonthLeadCount").text(response.lastThreeMonthleadCount)
                leadOverviewChart.updateSeries([{
                    data: response.lastThreeMonthlead,
                }]);
            },
        });

        // $.ajax({
        //     url : "{{ route('chart.tab.stats') }}",
        //     method : 'post',
        //     data : {
        //         value : 'individual',
        //     },
        //     success: function (response) {
        //         $("#tabStatsWrap").html(response);
        //         $('.loader-parent').removeClass('loading');
        //         $('.simple-bar').each((index, element) => new SimpleBar(element, { autoHide: true }));
        //     },
        // });
        // $.ajax({
        //     url : "{{ route('topbar.stats') }}",
        //     method : 'post',
        //     success: function (response) {
        //         $('#analyticWrap').html(response);
        //     },
        // });

        // eachApexChartsCallFunction("#overviewChart", overviewChartOptions);




        // $.ajax({
        //     url : "{{ route('chart.stats') }}",
        //     method : 'post',
        //     success: function (response) {

        //         $("#projectCount").text(response.projectCount);
        //         projectsChart.updateSeries([{
        //             data: response.projects,
        //         }]);

        //         $("#leadCount").text(response.leadCount); 
        //         leadChart.updateSeries([{
        //             data: response.leads,
        //         }]);

        //         $("#clientCount").text(response.clientCount);
        //         clientChart.updateSeries([{
        //             data: response.clients,
        //         }]);

        //         $("#leadListRender").html(response.leadList);

        //         $("#leadClientCount").text(response.lead_percentage + ' %');
        //         ApexCharts.exec("leadClientChart", "updateOptions", {
        //             series: [
        //                 {
        //                     data: response.leads,
        //                 },
        //                 {
        //                     data: response.clients,
        //                 }
        //             ]
        //         });
                
        //         $("#lastThreeMonthLeadCount").text(response.lastThreeMonthleadCount)
        //         leadOverviewChart.updateSeries([{
        //             data: response.lastThreeMonthlead,
        //         }]);
        //     },
        // });

        // $.ajax({
        //     url : "{{ route('ringover.history') }}",
        //     method : 'post',
        //     success: function (response) {
        //         $('#ringOverTableWrap').html(response);
        //     },
        // });


        $(document).on('click', '.statsTab', function(e){
            if(!$(this).hasClass('active')){
                $('.loader-parent').addClass('loading');
                $('.statsTab').removeClass('active');
                $(this).addClass('active');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url : "{{ route('chart.tab.stats') }}",
                    method : 'post',
                    data : {
                        value : $(this).attr('data-value'),
                    },
                    success: function (response) {
                        $("#tabStatsWrap").html(response);
                        $('.loader-parent').removeClass('loading');
                        $('.simple-bar').each((index, element) => new SimpleBar(element, { autoHide: true }));
                    },
                });
            }
        })



        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('body').on('click', '.taskEditBtn', function(){ 
            let task_id = $(this).data('id');
            $.ajax({
                url : "{{ route('task.edit.modal') }}",
                method : 'post',
                data : {
                    id : task_id,
                },
                success: function (response) {
                    $("#projectCount").html(response);
                    $('#newTaskEditModal').modal('show');
                },
            });
        });

        $('body').on('click', '.project_chart', function(e){
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
        $('body').on('click', '.client_chart', function(e){
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
        $('body').on('click', '.lead_chart', function(e){
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
        $('body').on('click', '.lead_list', function(e){
            e.preventDefault();
            var label = $(this).text();
            $.ajax({
            url : "{{ route('lead.filter.list') }}",
                method : 'post',
                data : {
                    value : $(this).attr('data-value'),
                },
                success: function (response) {
                    $("#leadListLabelText").text(label);
                    $("#leadListRender").html(response);
                },
            });
        });
        $('body').on('click', '.lead_client_state', function(e){
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

        $('body').on('click', '.rappel_list', function(e){
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

        $('body').on('click','.lead_stats_change',function(){

            let value = $(this).data('value');

            $.ajax({
                url : "{{ route('dashboard.stats.type.change') }}",
                type: "POST",
                data: {value},
                success : response => {
                    if(response!='ongoing'){
                        $('#leadListLabel').text(value);
                        $('#leadStatsTable').html(response.lead_stats);
                        $('#chantierStatsTable').html(response.chantier_stats);
                    }
                }
            });

        });

        $('body').on('change', '.taskTypeChange',function(){

            let type = $(this).val();
            let id = $(this).data('id');
            $.ajax({
                url : "{{ route('new.task.type.change') }}",
                method : 'post',
                data : {type, id},
                success: function (response) {
                    console.log(response);
                    $('#typeChangeWrap'+id).html(response);
                    $('.select2_select_option').select2();
                    $('.select2_select_option').each(function(){
                        $(this).select2({
                            dropdownParent: $(this).parent(),
                            templateSelection : function (tag, container){
                                var $option = $('.select2_select_option option[value="'+tag.id+'"]');
                                if ($option.attr('disabled')){
                                $(container).addClass('removed-remove-btn');
                                }
                                return tag.text;
                            },
                        })
                    })
                },
            });
        });

        $('body').on('change', '.eventTypeChange',function(){
            let type = $(this).val(); 
            $.ajax({
                url : "{{ route('new.event.type.change') }}",
                method : 'post',
                data : {type},
                success: function (response) {
                    console.log(response);
                    $('#eventTypeChangeWrap').html(response);
                    $('.select2_select_option').select2();
                    $('.select2_select_option').each(function(){
                        $(this).select2({
                            dropdownParent: $(this).parent(),
                            templateSelection : function (tag, container){
                                var $option = $('.select2_select_option option[value="'+tag.id+'"]');
                                if ($option.attr('disabled')){
                                $(container).addClass('removed-remove-btn');
                                }
                                return tag.text;
                            },
                        })
                    })
                },
            });
        });

        $('body').on('change', '.projectChange',function(){

            let id = $(this).val();
            let data_id = $(this).data('id');
            let type = $("#taskTypeChange"+data_id).val();

            $.ajax({
                url : "{{ route('new.task.project.change') }}",
                method : 'post',
                data : {id, type},
                success: function (response) {
                    $('#projectChangeWrap'+data_id).html(response);
                    $('.select2_select_option').select2();
                    $('.select2_select_option').each(function(){
                        $(this).select2({
                            dropdownParent: $(this).parent(),
                            templateSelection : function (tag, container){
                                var $option = $('.select2_select_option option[value="'+tag.id+'"]');
                                if ($option.attr('disabled')){
                                $(container).addClass('removed-remove-btn');
                                }
                                return tag.text;
                            },
                        })
                    })
                },
            });
        });

        $('#addEventForm').on('submit', function(e){
            e.preventDefault();
            if(!$('#startDate').val()){
                $('#dateError').removeClass('d-none');
                $('#dateError').text('La date est requise');
                $('#startDate').focus();
            }else if(!$('#clientSelect').val() && !$('#title').val()){
                $('#titleError').removeClass('d-none');
                $('#titleError').text('Le titre est requis');
                $('#title').focus();
            }else{
                $('#addEventForm')[0].submit();
            }
        });

        $('body').on('change','#clientSelect',function(e){
            var id = $(this).val();
            var type = $("#eventTypeChange").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url:"{{ route('event.project.change') }}",
                data: {id, type},

                success: function(data){
                    $('#evnetClientWrap').html(data);
                    $('.select2_select_option').select2();
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
