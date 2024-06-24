{{-- Main Layouts --}}
@extends('layouts.master')

{{-- Title part  --}}
@section('title')
{{ __('Automatisation') }}
@endsection

{{-- active menu  --}}
@section('automatisationIndex')
active
@endsection

@section('bodyBg', 'secondary-bg')

{{-- Main Content Part  --}}
@section('content')
		<section class="section-gap">
			<div class="container">
                <div class="col-lg-10 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="mb-3">Créer automatisations</h1>
                            <form action="{{ route('automatisation.block.store') }}" method="POST">
                                @csrf
                                    <div class="form-group">
                                        <label class="form-label">Automatisation For</label>
                                        <select required name="automatisation_for" id="automatisation_for" class="form-control">
                                            <option value="">Séléctionner</option>
                                            <option value="prospects">Prospects</option>
                                            <option value="chantier">Chantier</option>
                                            {{-- <option value="client">Client</option> --}}
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Sélectionner un déclencheur</label>
                                        <select required name="type_de_campagne" id="type_de_campagne" class="form-control">
                                            <option value="status_change">Changement de status</option>
                                            <option value="status_not_change">pas de changement de statut</option>
                                        </select>
                                    </div>
                                    <div class="form-group d-none" id="lead_status">
                                        <label class="form-label">Choisir une condition</label>
                                        <select id="disable_lead" name="status" class="form-control">
                                            <option value="">Séléctionner</option>
                                            @foreach ($main_status as $main)
                                                @if($main->id != 1)
                                                    <option value="main_{{ $main->id }}">{{ $main->status }}</option>
                                                @endif
                                            @endforeach
                                            @foreach ($sub_status as $sub)
                                                <option value="sub_{{ $sub->id }}">{{ $sub->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group d-none" id="chantier_status">
                                        <label class="form-label">Choisir une condition</label>
                                        <select id="disable_chantier" name="status" class="form-control">
                                            <option value="">Séléctionner</option>
                                            @foreach ($chantier_status as $main)
                                                @if($main->id != 1)
                                                    <option value="main_{{ $main->id }}">{{ $main->status }}</option>
                                                @endif
                                            @endforeach
                                            @foreach ($chantier_sub_status as $sub)
                                                <option value="sub_{{ $sub->id }}">{{ $sub->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group" id="durationWrap" style="display: none">
                                        <label class="form-label">Durée</label>
                                        <select id="duration" name="duration" class="form-control">
                                            <option value="5">5 jours</option>
                                            <option value="10">10 jours</option>
                                            <option value="15">15 jours</option>
                                            <option value="25">25 jours</option>
                                            <option value="35">35 jours</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Sélectionner une action</label>
                                        <select required  id="sending_type" name="sending_type" class="form-control">
                                            <option value="">Séléctionner</option>
                                            <option value="send_email">Envoyer un email</option>
                                            <option value="send_sms">Envoyer un SMS</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Destinataire</label>
                                        <select required name="select_to" id="select_to" class="form-control">
                                            <option value="">Séléctionner</option>
                                            <option value="Client">Client</option>
                                            <option value="Telecommercial">Telecommercial</option>
                                            <option value="Telecommercial - professionnel">Telecommercial - professionnel</option>
                                            <option value="Responsable commercial">Responsable commercial</option>
                                            <option value="Responsable commercial - professionnel">Responsable commercial - professionnel</option>
                                            <option value="Chargé d’etude">Chargé d’etude</option>
                                            <option value="Chargé d’etude - professionnel">Chargé d’etude - professionnel</option>
                                            <option value="Prévisiteur Technico-commercial">Prévisiteur Technico-commercial</option>
                                            <option value="Prévisiteur Technico-commercial - professionnel">Prévisiteur Technico-commercial - professionnel</option>
                                            <option value="Gestionnaire">Gestionnaire</option>
                                            <option value="Gestionnaire - professionnel">Gestionnaire - professionnel</option>
                                            <option value="Mail personnalisé">Mail personnalisé</option>
                                        </select>
                                    </div>
                                    <div class="form-group customEmailWrap" style="display: none">
                                        <label for="custom_email" class="form-label">Mail personnalisé</label>
                                        <input type="email" class="form-control" id="custom_email" name="custom_email">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">CC</label>
                                        <select name="select_to_cc" id="select_to_cc" class="form-control">
                                            <option value="">Séléctionner</option>
                                            <option value="Client">Client</option>
                                            <option value="Telecommercial">Telecommercial</option>
                                            <option value="Telecommercial - professionnel">Telecommercial - professionnel</option>
                                            <option value="Responsable commercial">Responsable commercial</option>
                                            <option value="Responsable commercial - professionnel">Responsable commercial - professionnel</option>
                                            <option value="Chargé d’etude">Chargé d’etude</option>
                                            <option value="Chargé d’etude - professionnel">Chargé d’etude - professionnel</option>
                                            <option value="Prévisiteur Technico-commercial">Prévisiteur Technico-commercial</option>
                                            <option value="Prévisiteur Technico-commercial - professionnel">Prévisiteur Technico-commercial - professionnel</option>
                                            <option value="Gestionnaire">Gestionnaire</option>
                                            <option value="Gestionnaire - professionnel">Gestionnaire - professionnel</option>
                                            <option value="Mail personnalisé">Mail personnalisé</option>
                                        </select>
                                    </div>
                                    <div class="form-group customEmailCCWrap" style="display: none">
                                        <label for="custom_email_cc" class="form-label">Mail personnalisé (CC)</label>
                                        <input type="email" class="form-control" id="custom_email_cc" name="custom_email_cc">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">CCI</label>
                                        <select name="select_to_cci" id="select_to_cci" class="form-control">
                                            <option value="">Séléctionner</option>
                                            <option value="Client">Client</option>
                                            <option value="Telecommercial">Telecommercial</option>
                                            <option value="Telecommercial - professionnel">Telecommercial - professionnel</option>
                                            <option value="Responsable commercial">Responsable commercial</option>
                                            <option value="Responsable commercial - professionnel">Responsable commercial - professionnel</option>
                                            <option value="Chargé d’etude">Chargé d’etude</option>
                                            <option value="Chargé d’etude - professionnel">Chargé d’etude - professionnel</option>
                                            <option value="Prévisiteur Technico-commercial">Prévisiteur Technico-commercial</option>
                                            <option value="Prévisiteur Technico-commercial - professionnel">Prévisiteur Technico-commercial - professionnel</option>
                                            <option value="Gestionnaire">Gestionnaire</option> 
                                            <option value="Gestionnaire - professionnel">Gestionnaire - professionnel</option>
                                            <option value="Mail personnalisé">Mail personnalisé</option>
                                        </select>
                                    </div>
                                    <div class="form-group customEmailCCIWrap" style="display: none">
                                        <label for="custom_email_cci" class="form-label">Mail personnalisé (CCI)</label>
                                        <input type="email" class="form-control" id="custom_email_cci" name="custom_email_cci">
                                    </div>
                                    <div id="email_template" class="form-group d-none">
                                        <label for="email_template">
                                            Email Template
                                        </label>
                                        <select name="email_template" id="emailTemplateOption" class="form-control">
                                            <option value="">Séléctionner</option>
                                            @foreach ($email_templates as $template)
                                                <option value="{{ $template->id }}">{{ $template->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div id="sms_template" class="form-group d-none">
                                        <label for="sms_template">
                                            SMS Template
                                        </label>
                                        <select name="sms_template" id="smsTemplateOption" class="form-control">
                                            <option value="">Séléctionner</option>
                                            @foreach ($sms_templates as $template)
                                                <option value="{{ $template->id }}">{{ $template->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Récurrence</label>
                                        <select name="recurrence" id="recurrence" class="form-control" required>
                                            <option value="">Séléctionner</option>
                                            <option value="Oui">Oui</option> 
                                            <option value="Non">Non</option> 
                                        </select>
                                    </div>
                                    <div class="recurrenceWrap" style="display: none">
                                        <div class="form-group">
                                            <label class="form-label">Fréquence d'envoi</label>
                                            <select name="frequence" id="frequence" class="form-control recurrence-input">
                                                <option value="">Séléctionner</option>
                                                @for ($i=1;$i<=20;$i++)
                                                    <option value="{{ $i }}">{{ $i }} Jour{{ $i==1 ? '':'s' }}</option> 
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Fin de recurrence</label>
                                            <select name="fin" id="fin" class="form-control recurrence-input">
                                                <option value="">Séléctionner</option>
                                                @for ($i=2;$i<=20;$i++)
                                                    <option value="{{ $i }}">{{ $i }}</option> 
                                                @endfor
                                                {{-- <option value="2">2</option> 
                                                <option value="3">3</option> 
                                                <option value="5">5</option> 
                                                <option value="7">7</option> 
                                                <option value="10">10</option>  --}}
                                            </select>
                                        </div>
                                    </div>
                                    <button class="btn btn-success">Sauvegarder</button>
                            </form>
                        </div>
                    </div>
                </div>
			</div>
		</section>
@endsection

@push('js')
<script>
	$(document).ready(function(){ 
        $('body').on('change', '#type_de_campagne', function(){
            if($(this).val() == 'status_not_change'){
                $('#durationWrap').slideDown();
                $('.recurrence-input').prop('required', false);
                $('#recurrence').prop('required', false);
            }else{
                $('#recurrence').prop('required', true);
                $('#durationWrap').slideUp();
            }
        });
        $('body').on('change', '#recurrence', function(){
            if($(this).val() == 'Oui'){
                $('.recurrenceWrap').slideDown();
                $('.recurrence-input').prop('required', true);
            }else{
                $('.recurrenceWrap').slideUp();
                $('.recurrence-input').prop('required', false);
            }
        });

        $('body').on('change', '#select_to_cc', function(){
            if($(this).val() == 'Mail personnalisé'){
                $('.customEmailCCWrap').slideDown();
                $('#custom_email_cc').prop('required', true);
            }else{
                $('.customEmailCCWrap').slideUp();
                $('#custom_email_cc').prop('required', false);
            }
        });
        $('body').on('change', '#select_to_cci', function(){
            if($(this).val() == 'Mail personnalisé'){
                $('.customEmailCCIWrap').slideDown();
                $('#custom_email_cci').prop('required', true);
            }else{
                $('.customEmailCCIWrap').slideUp();
                $('#custom_email_cci').prop('required', false);
            }
        });
        $('body').on('change', '#select_to', function(){
            if($(this).val() == 'Mail personnalisé'){
                $('.customEmailWrap').slideDown();
                $('#custom_email').prop('required', true);
            }else{
                $('.customEmailWrap').slideUp();
                $('#custom_email').prop('required', false);
            }
        });
        $("#automatisation_for").change(function(){
            if(this.value == 'prospects')
            {
               $("#lead_status").removeClass('d-none');
               $("#disable_lead").prop('required', true);
               $("#chantier_status").addClass('d-none');
               $("#disable_chantier").prop('required', false);
               $("#disable_chantier").prop('disabled', true);
               $("#disable_lead").prop('disabled', false);
            }
            else
            {
                $("#lead_status").addClass('d-none');
                $("#chantier_status").removeClass('d-none');
                $("#disable_chantier").prop('required', true );
                $("#disable_lead").prop('required', false);
                $("#disable_lead").prop('disabled', true);
                $("#disable_chantier").prop('disabled', false);
            }
        })
        $("#sending_type").change(function(){
            if(this.value == 'send_email')
            {
               $("#email_template").removeClass('d-none');
               $("#emailTemplateOption").prop('required', true);
               $("#sms_template").addClass('d-none');
               $("#smsTemplateOption").prop('required', false);
            }
            else if(this.value == 'send_sms')
            {
                $("#sms_template").removeClass('d-none');
                $("#smsTemplateOption").prop('required', true);
                $("#email_template").addClass('d-none');
                $("#emailTemplateOption").prop('required', false);
            }
            else
            {
                $("#email_template").addClass('d-none');
                $("#sms_template").addClass('d-none');
                $("#emailTemplateOption").prop('required', false);
                $("#smsTemplateOption").prop('required', false);
            }
        })

	});
</script>
@endpush
