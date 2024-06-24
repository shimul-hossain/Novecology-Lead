{{-- Main Layouts --}}
@extends('layouts.master')

{{-- Title part  --}}
@section('title')
    Template Email
@endsection

@section('bodyBg', 'secondary-bg')

{{-- active menu  --}}
@section('calculatteDepertidionIndex')
active
@endsection

{{-- Main Content Part  --}}
@section('content')
    <section class="pt-2">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-between py-2">
                <h1 class="my-2">Email template list</h1>
                <button type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0" data-toggle="modal" data-target="#createTemplate">
                    <i class="bi bi-plus-lg mr-1"></i>
                    Créer
                </button>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="bg-white shadow-sm rounded">
                        <div class="table-responsive simple-bar">
                            <table class="table database-table w-100 mb-0">
                                <thead class="database-table__header">
                                    <tr>
                                        <th>Sl.</th>
                                        <th>Title.</th>
                                        <th>Object</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="database-table__body">
                                    @foreach ($templates as $template)
                                        <tr>
                                            <td>
                                                {{ $loop->index+1 }}
                                            </td>
                                            <td>
                                                {{ $template->name }}
                                            </td>
                                            <td>
                                                {{ $template->object }}
                                            </td>
                                            <td>
                                                <div class="dropdown dropdown--custom p-0 d-inline-block">
                                                    <button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class="novecologie-icon-dots-horizontal-triple"></span>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
                                                        <a href="{{ route('admin.email.template.edit', $template->id) }}" class="dropdown-item border-0">
                                                            <span class="novecologie-icon-edit mr-1"></span>
                                                            Éditer
                                                        </a>
                                                        <a href="{{ route('admin.email.template.delete', $template->id) }}" class="dropdown-item border-0">
                                                            <span class="novecologie-icon-trash mr-1"></span>
                                                            Supprimer
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="createTemplate" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title">Créer email template</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.email.template.store') }}"  method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Template Name <span class="text-danger">*</span></label>
                                <input class="form-control shadow-none" type="text" name="name">
                                @error('name')
                                <div class="text-danger invalid-feedback d-block">{{ $message }}</div>
                                @enderror  
                            </div>
                            <div class="form-group">
                                <label class="form-label">Object <span class="text-danger">*</span></label>
                                <input class="form-control shadow-none" type="text" name="object">
                                @error('object')
                                <div class="text-danger invalid-feedback d-block">{{ $message }}</div>
                                @enderror  
                            </div>
                            <div class="form-group">
                                <button type="button" data-value="{id_prospect}" class="special_text btn btn-sm btn-primary mb-1">ID prospect</button>
                                <button type="button" data-value="{id_chantier}" class="special_text btn btn-sm btn-primary mb-1">ID chantier</button>
                                <button type="button" data-value="{titre}" class="special_text btn btn-sm btn-primary mb-1">Titre</button>
                                <button type="button" data-value="{nom_client}" class="special_text btn btn-sm btn-primary mb-1">Nom Client</button>
                                <button type="button" data-value="{prénom_client}" class="special_text btn btn-sm btn-primary mb-1">Prénom Client</button>
                                <button type="button" data-value="{email_client}" class="special_text btn btn-sm btn-primary mb-1">Email client</button>
                                <button type="button" data-value="{téléphone_client}" class="special_text btn btn-sm btn-primary mb-1">Téléphone client</button>
                                <button type="button" data-value="{adresse_des_travaux}" class="special_text btn btn-sm btn-primary mb-1">Adresse des travaux</button>
                                <button type="button" data-value="{code_postale_des_travaux}" class="special_text btn btn-sm btn-primary mb-1">Code postale des travaux</button>
                                <button type="button" data-value="{ville_des_travaux}" class="special_text btn btn-sm btn-primary mb-1">Ville des travaux</button>
                                <button type="button" data-value="{projet_travaux}" class="special_text btn btn-sm btn-primary mb-1">Projet travaux</button>
                                <button type="button" data-value="{statut_projet}" class="special_text btn btn-sm btn-primary mb-1">Statut Projet</button>
                                <button type="button" data-value="{faisabilité_du_projet}" class="special_text btn btn-sm btn-primary mb-1">Faisabilité du projet</button>
                                <button type="button" data-value="{gestionnaire_prénom_professionnel}" class="special_text btn btn-sm btn-primary mb-1">Gestionnaire – Prénom professionnel</button>
                                <button type="button" data-value="{gestionnaire_email_professionnel}" class="special_text btn btn-sm btn-primary mb-1">Gestionnaire – Email professionnel</button>
                                <button type="button" data-value="{gestionnaire_téléphone_professionnel}" class="special_text btn btn-sm btn-primary mb-1">Gestionnaire – Téléphone professionnel</button>
                                <button type="button" data-value="{télécommercial_prénom_professionnel}" class="special_text btn btn-sm btn-primary mb-1">Télécommercial – Prénom professionnel</button>
                                <button type="button" data-value="{télécommercial_email_professionnel}" class="special_text btn btn-sm btn-primary mb-1">Télécommercial – Email professionnel</button>
                                <button type="button" data-value="{télécommercial_téléphone_professionnel}" class="special_text btn btn-sm btn-primary mb-1">Télécommercial – Téléphone professionnel</button>
                                <button type="button" data-value="{résponsable_commercial_prénom_professionnel}" class="special_text btn btn-sm btn-primary mb-1">Résponsable commercial – Prénom professionnel</button>
                                <button type="button" data-value="{résponsable_commercial_email_professionnel}" class="special_text btn btn-sm btn-primary mb-1">Résponsable commercial – Email professionnel</button>
                                <button type="button" data-value="{résponsable_commercial_réléphone_professionnel}" class="special_text btn btn-sm btn-primary mb-1">Résponsable commercial – Téléphone professionnel</button>
                                <button type="button" data-value="{prévisiteur_technico-commercial_prénom_professionnel}" class="special_text btn btn-sm btn-primary mb-1">Prévisiteur Technico-commercial – Prénom professionnel</button>
                                <button type="button" data-value="{prévisiteur_technico-commercial_email_professionnel}" class="special_text btn btn-sm btn-primary mb-1">Prévisiteur Technico-commercial – Email professionnel</button>
                                <button type="button" data-value="{prévisiteur_technico-commercial_téléphone_professionnel}" class="special_text btn btn-sm btn-primary mb-1">Prévisiteur Technico-commercial – Téléphone professionnel</button>
                                <button type="button" data-value="{chargé_d_etude_prénom_professionnel}" class="special_text btn btn-sm btn-primary mb-1">Chargé d’Etude – Prénom professionnel</button>
                                <button type="button" data-value="{chargé_d_etude_email_professionnel}" class="special_text btn btn-sm btn-primary mb-1">Chargé d’Etude – Email professionnel</button>
                                <button type="button" data-value="{chargé_d_etude_téléphone_professionnel}" class="special_text btn btn-sm btn-primary mb-1">Chargé d’Etude – Téléphone professionnel</button>
                                <button type="button" data-value="{prévisite_technico-commercial_date_intervention}" class="special_text btn btn-sm btn-primary mb-1">Prévisite Technico-Commercial - Date intervention</button>
                                <button type="button" data-value="{prévisite_technico-commercial_horaire_intervention}" class="special_text btn btn-sm btn-primary mb-1">Prévisite Technico-Commercial - Horaire intervention</button>
                                <button type="button" data-value="{installation_date_intervention}" class="special_text btn btn-sm btn-primary mb-1">Installation - Date intervention</button>
                                <button type="button" data-value="{installation_horaire_intervention}" class="special_text btn btn-sm btn-primary mb-1">Installation - Horaire intervention</button>
                                <button type="button" data-value="{SAV_date_intervention}" class="special_text btn btn-sm btn-primary mb-1">SAV - Date intervention</button>
                                <button type="button" data-value="{SAV_horaire_intervention}" class="special_text btn btn-sm btn-primary mb-1">SAV - Horaire intervention</button>
                                <button type="button" data-value="{etude_date_intervention}" class="special_text btn btn-sm btn-primary mb-1">Etude - Date intervention</button>
                                <button type="button" data-value="{etude_horaire_intervention}" class="special_text btn btn-sm btn-primary mb-1">Etude - Horaire intervention</button>
                                <button type="button" data-value="{cofrac_date_de_contrôle}" class="special_text btn btn-sm btn-primary mb-1">Cofrac - Date de contrôle</button>
                                <button type="button" data-value="{cofrac_horaire_intervention}" class="special_text btn btn-sm btn-primary mb-1">Cofrac - Horaire intervention</button>
                                <button type="button" data-value="{regie}" class="special_text btn btn-sm btn-primary mb-1">Regie</button>
                                <button type="button" data-value="{raison}" class="special_text btn btn-sm btn-primary mb-1">Raison</button>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Template Body <span class="text-danger">*</span></label>
                                <textarea class="form-control shadow-none" id="email_body" rows="10" name="body"></textarea>
                                @error('body')
                                <div class="text-danger invalid-feedback d-block">{{ $message }}</div>
                                @enderror  
                            </div>
                            <div class="form-group">
                                <label for="file" class="form-label d-block">File</label>
                                <div class="input-group mb-3"> 
                                    <div class="custom-file">
                                        <input type="file" name="file" class="custom-file-input" id="file">
                                        <label class="custom-file-label" for="file">Ajouter file</label>
                                    </div>
                                </div>
                                @error('photo')
                                    <div class="text-danger invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0">Save</button>
                        </form>
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
        @if ($errors->has('name') || $errors->has('object') || $errors->has('body'))
            $('#createTemplate').modal('show');
        @endif
        $('body').on('click', '.special_text', function(){
            $('#email_body').val($('#email_body').val()+$(this).data('value'));
            $("#email_body").focus()    
        });
	});
</script>
@endpush
