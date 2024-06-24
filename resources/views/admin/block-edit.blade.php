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
               <div class="d-flex align-items-center justify-content-between">
                <h1 class="mb-3">Creer automatisations</h1>
               </div>
               <div class="form-group">   
                    <form action="{{ route('automatisation.block.update') }}"  method="POST">
                        @csrf
                            <input type="hidden" name="id" value="{{ $automatisation->id }}">
                            <div class="form-group">
                                <label for="automatisation_for">Automatisation For</label>
                                <select required name="automatisation_for" id="automatisation_for" class="form-control">
                                    <option value="">Select</option>
                                    @if($automatisation->automatisation_for == 'prospects')
                                    <option selected value="prospects">Prospects</option>
                                    <option value="chantier">Chantier</option>
                                    @elseif($automatisation->automatisation_for == 'chantier')
                                    <option selected value="chantier">Chantier</option>
                                    <option value="prospects">Prospects</option>
                                    @endif
                                    {{-- <option value="client">Client</option> --}}
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="type_de_campagne">Sélectionner un déclencheur</label>
                                <select required name="type_de_campagne" id="type_de_campagne" class="form-control">
                                    <option {{ $automatisation->type_de_campagne == 'status_change' ? 'selected':'' }} value="status_change">Changement de status</option>
                                    <option {{ $automatisation->type_de_campagne == 'status_not_change' ? 'selected':'' }} value="status_not_change">pas de changement de statut</option>
                                </select>
                            </div>
                            <div class="form-group {{ ($automatisation->automatisation_for == 'prospects') ? '' : 'd-none' }}" id="lead_status">
                                <label for="status">Choisir une condition</label>
                                <select id="disable_lead" name="status" class="form-control">
                                    {{-- <option selected value="{{ $automatisation->status }}">{{ getStatus($automatisation->id) }}</option> --}}
                                    @foreach ($main_status as $main)
                                        @if($main->id != 1)
                                            <option {{ $automatisation->status == "main_$main->id" ? 'selected' : ''}} value="main_{{ $main->id }}">{{ $main->status }}</option>
                                        @endif
                                    @endforeach
                                    @foreach ($sub_status as $sub)
                                        <option {{ $automatisation->status == "sub_$sub->id" ? 'selected' : ''}} value="sub_{{ $sub->id }}">{{ $sub->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group {{ ($automatisation->automatisation_for == 'chantier') ? '' : 'd-none' }}" id="chantier_status">
                                <label for="status">Choisir une condition</label>
                                <select id="disable_chantier" name="status" class="form-control">
                                    <option selected value="{{ $automatisation->status }}">{{ getStatus($automatisation->id) }}</option>
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
                            <div class="form-group" id="durationWrap" style="display: {{ $automatisation->type_de_campagne == 'status_not_change' ? '':'none' }}">
                                <label class="form-label">Durée</label>
                                <select id="duration" name="duration" class="form-control">
                                    <option {{ $automatisation->duration == '5' ? 'selected':'' }} value="5">5 jours</option>
                                    <option {{ $automatisation->duration == '10' ? 'selected':'' }} value="10">10 jours</option>
                                    <option {{ $automatisation->duration == '15' ? 'selected':'' }} value="15">15 jours</option>
                                    <option {{ $automatisation->duration == '25' ? 'selected':'' }} value="25">25 jours</option>
                                    <option {{ $automatisation->duration == '35' ? 'selected':'' }} value="35">35 jours</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="select_action">Sélectionner une action</label>
                                <select required  id="sending_type" name="sending_type" class="form-control">
                                    <option value="">Select</option>
                                    @if($automatisation->sending_type == 'send_email')
                                    <option selected value="send_email">Envoyer un email</option>
                                    <option value="send_sms">Envoyer un SMS</option>
                                    @elseif($automatisation->sending_type == 'send_sms')
                                    <option selected value="send_sms">Envoyer un SMS</option>
                                    <option value="send_email">Envoyer un email</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Destinataire</label>
                                <select required name="select_to" id="select_to" class="form-control">
                                    <option value="">Select</option>
                                    <option {{ $automatisation->select_to == 'Client' ? 'selected':'' }} value="Client">Client</option>
                                    <option {{ $automatisation->select_to == 'Telecommercial' ? 'selected':'' }} value="Telecommercial">Telecommercial</option>
                                    <option {{ $automatisation->select_to == 'Telecommercial - professionnel' ? 'selected':'' }} value="Telecommercial - professionnel">Telecommercial - professionnel</option>
                                    <option {{ $automatisation->select_to == 'Responsable commercial' ? 'selected':'' }} value="Responsable commercial">Responsable commercial</option>
                                    <option {{ $automatisation->select_to == 'Responsable commercial - professionnel' ? 'selected':'' }} value="Responsable commercial - professionnel">Responsable commercial - professionnel</option>
                                    <option {{ $automatisation->select_to == 'Chargé d’etude' ? 'selected':'' }} value="Chargé d’etude">Chargé d’etude</option>
                                    <option {{ $automatisation->select_to == 'Chargé d’etude - professionnel' ? 'selected':'' }} value="Chargé d’etude - professionnel">Chargé d’etude - professionnel</option>
                                    <option {{ $automatisation->select_to == 'Prévisiteur Technico-commercial' ? 'selected':'' }} value="Prévisiteur Technico-commercial">Prévisiteur Technico-commercial</option>
                                    <option {{ $automatisation->select_to == 'Prévisiteur Technico-commercial - professionnel' ? 'selected':'' }} value="Prévisiteur Technico-commercial - professionnel">Prévisiteur Technico-commercial - professionnel</option>
                                    <option {{ $automatisation->select_to == 'Gestionnaire' ? 'selected':'' }} value="Gestionnaire">Gestionnaire</option>
                                    <option {{ $automatisation->select_to == 'Gestionnaire - professionnel' ? 'selected':'' }} value="Gestionnaire - professionnel">Gestionnaire - professionnel</option>
                                    <option {{ $automatisation->select_to == 'Mail personnalisé' ? 'selected':'' }} value="Mail personnalisé">Mail personnalisé</option>
                                </select>
                            </div>
                            <div class="form-group customEmailWrap" style="display: {{ $automatisation->select_to == 'Mail personnalisé' ? '':'none' }}">
                                <label for="custom_email" class="form-label">Mail personnalisé</label>
                                <input type="email" class="form-control" {{ $automatisation->select_to == 'Mail personnalisé' ? 'required':'' }} value="{{ $automatisation->custom_email }}" id="custom_email" name="custom_email">
                            </div>
                            <div class="form-group">
                                <label class="form-label">CC</label>
                                <select name="select_to_cc" id="select_to_cc" class="form-control">
                                    <option value="">Séléctionner</option>
                                    <option {{ $automatisation->select_to_cc == 'Client' ? 'selected':'' }} value="Client">Client</option>
                                    <option {{ $automatisation->select_to_cc == 'Telecommercial' ? 'selected':'' }} value="Telecommercial">Telecommercial</option>
                                    <option {{ $automatisation->select_to_cc == 'Telecommercial - professionnel' ? 'selected':'' }} value="Telecommercial - professionnel">Telecommercial - professionnel</option>
                                    <option {{ $automatisation->select_to_cc == 'Responsable commercial' ? 'selected':'' }} value="Responsable commercial">Responsable commercial</option>
                                    <option {{ $automatisation->select_to_cc == 'Responsable commercial - professionnel' ? 'selected':'' }} value="Responsable commercial - professionnel">Responsable commercial - professionnel</option>
                                    <option {{ $automatisation->select_to_cc == 'Chargé d’etude' ? 'selected':'' }} value="Chargé d’etude">Chargé d’etude</option>
                                    <option {{ $automatisation->select_to_cc == 'Chargé d’etude - professionnel' ? 'selected':'' }} value="Chargé d’etude - professionnel">Chargé d’etude - professionnel</option>
                                    <option {{ $automatisation->select_to_cc == 'Prévisiteur Technico-commercial' ? 'selected':'' }} value="Prévisiteur Technico-commercial">Prévisiteur Technico-commercial</option>
                                    <option {{ $automatisation->select_to_cc == 'Prévisiteur Technico-commercial - professionnel' ? 'selected':'' }} value="Prévisiteur Technico-commercial - professionnel">Prévisiteur Technico-commercial - professionnel</option>
                                    <option {{ $automatisation->select_to_cc == 'Gestionnaire' ? 'selected':'' }} value="Gestionnaire">Gestionnaire</option>
                                    <option {{ $automatisation->select_to_cc == 'Gestionnaire - professionnel' ? 'selected':'' }} value="Gestionnaire - professionnel">Gestionnaire - professionnel</option>
                                    <option {{ $automatisation->select_to_cc == 'Mail personnalisé' ? 'selected':'' }} value="Mail personnalisé">Mail personnalisé</option>
                                </select>
                            </div>
                            <div class="form-group customEmailCCWrap" style="display: {{ $automatisation->select_to_cc == 'Mail personnalisé' ? '':'none' }}">
                                <label for="custom_email_cc" class="form-label">Mail personnalisé (CC)</label>
                                <input type="email" class="form-control" {{ $automatisation->select_to_cc == 'Mail personnalisé' ? 'required':'' }} value="{{ $automatisation->custom_email_cc }}" id="custom_email_cc" name="custom_email_cc">
                            </div>
                            <div class="form-group">
                                <label class="form-label">CCI</label>
                                <select name="select_to_cci" id="select_to_cci" class="form-control">
                                    <option value="">Séléctionner</option>
                                    <option {{ $automatisation->select_to_cci == 'Client' ? 'selected':'' }} value="Client">Client</option>
                                    <option {{ $automatisation->select_to_cci == 'Telecommercial' ? 'selected':'' }} value="Telecommercial">Telecommercial</option>
                                    <option {{ $automatisation->select_to_cci == 'Telecommercial - professionnel' ? 'selected':'' }} value="Telecommercial - professionnel">Telecommercial - professionnel</option>
                                    <option {{ $automatisation->select_to_cci == 'Responsable commercial' ? 'selected':'' }} value="Responsable commercial">Responsable commercial</option>
                                    <option {{ $automatisation->select_to_cci == 'Responsable commercial - professionnel' ? 'selected':'' }} value="Responsable commercial - professionnel">Responsable commercial - professionnel</option>
                                    <option {{ $automatisation->select_to_cci == 'Chargé d’etude' ? 'selected':'' }} value="Chargé d’etude">Chargé d’etude</option>
                                    <option {{ $automatisation->select_to_cci == 'Chargé d’etude - professionnel' ? 'selected':'' }} value="Chargé d’etude - professionnel">Chargé d’etude - professionnel</option>
                                    <option {{ $automatisation->select_to_cci == 'Prévisiteur Technico-commercial' ? 'selected':'' }} value="Prévisiteur Technico-commercial">Prévisiteur Technico-commercial</option>
                                    <option {{ $automatisation->select_to_cci == 'Prévisiteur Technico-commercial - professionnel' ? 'selected':'' }} value="Prévisiteur Technico-commercial - professionnel">Prévisiteur Technico-commercial - professionnel</option>
                                    <option {{ $automatisation->select_to_cci == 'Gestionnaire' ? 'selected':'' }} value="Gestionnaire">Gestionnaire</option> 
                                    <option {{ $automatisation->select_to_cci == 'Gestionnaire - professionnel' ? 'selected':'' }} value="Gestionnaire - professionnel">Gestionnaire - professionnel</option>
                                    <option {{ $automatisation->select_to_cci == 'Mail personnalisé' ? 'selected':'' }} value="Mail personnalisé">Mail personnalisé</option>
                                </select>
                            </div>
                            <div class="form-group customEmailCCIWrap" style="display: {{ $automatisation->select_to_cci == 'Mail personnalisé' ? '':'none' }}">
                                <label for="custom_email_cci" class="form-label">Mail personnalisé (CCI)</label>
                                <input type="email" class="form-control" {{ $automatisation->select_to_cci == 'Mail personnalisé' ? 'required':'' }} value="{{ $automatisation->custom_email_cci }}" id="custom_email_cci" name="custom_email_cci">
                            </div>
                            <div id="email_template" class="form-group {{ ($automatisation->sending_type == 'send_email') ? '' : 'd-none' }}">
                                <label for="email_template">
                                    Email Template
                                </label>
                                <select name="email_template" id="emailTemplateOption" class="form-control" {{ ($automatisation->sending_type == 'send_email') ? 'required' : '' }}>
                                    <option value="">Select</option>
                                    @foreach ($email_templates as $template)
                                        <option {{ ($automatisation->email_template == $template->id) ? 'selected' : '' }} value="{{ $template->id }}">{{ $template->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="sms_template" class="form-group {{ ($automatisation->sending_type == 'send_sms') ? '' : 'd-none' }}">
                                <label for="sms_template">
                                    SMS Template
                                </label>
                                <select name="sms_template" id="smsTemplateOption" class="form-control" {{ ($automatisation->sending_type == 'send_sms') ? 'required' : '' }}>
                                    <option value="">Select</option>
                                    @foreach ($sms_templates as $template)
                                        <option  {{ ($automatisation->sms_template == $template->id) ? 'selected' : '' }} value="{{ $template->id }}">{{ $template->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Récurrence</label>
                                <select name="recurrence" id="recurrence" class="form-control" {{ $automatisation->type_de_campagne != 'status_not_change' ? 'required':'' }}>
                                    <option value="">Séléctionner</option>
                                    <option {{ $automatisation->recurrence == 'Oui' ? 'selected':'' }} value="Oui">Oui</option> 
                                    <option {{ $automatisation->recurrence == 'Non' ? 'selected':'' }} value="Non">Non</option> 
                                </select>
                            </div>
                            <div class="recurrenceWrap" style="display: {{ $automatisation->recurrence == 'Oui' ? '':'none' }}">
                                <div class="form-group">
                                    <label class="form-label">Fréquence d'envoi</label>
                                    <select name="frequence" id="frequence" class="form-control recurrence-input" {{ $automatisation->recurrence == 'Oui' ? 'required':'' }}>
                                        <option value="">Séléctionner</option>
                                        @for ($i=1;$i<=20;$i++)
                                            <option {{ $automatisation->frequence == $i ? 'selected':'' }} value="{{ $i }}">{{ $i }} Jour{{ $i==1 ? '':'s' }}</option> 
                                        @endfor
                                        {{-- <option {{ $automatisation->frequence == '3' ? 'selected':'' }} value="3">3 Jours</option> 
                                        <option {{ $automatisation->frequence == '5' ? 'selected':'' }} value="5">5 Jours</option> 
                                        <option {{ $automatisation->frequence == '7' ? 'selected':'' }} value="7">7 Jours</option>  --}}
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Fin de recurrence</label>
                                    <select name="fin" id="fin" class="form-control recurrence-input" {{ $automatisation->recurrence == 'Oui' ? 'required':'' }}>
                                        <option value="">Séléctionner</option>
                                        @for ($i=2;$i<=20;$i++)
                                            <option {{ $automatisation->fin == $i ? 'selected':'' }} value="{{ $i }}">{{ $i }}</option> 
                                        @endfor
                                        {{-- <option {{ $automatisation->fin == '2' ? 'selected':'' }} value="2">2</option> 
                                        <option {{ $automatisation->fin == '3' ? 'selected':'' }} value="3">3</option> 
                                        <option {{ $automatisation->fin == '5' ? 'selected':'' }} value="5">5</option> 
                                        <option {{ $automatisation->fin == '7' ? 'selected':'' }} value="7">7</option> 
                                        <option {{ $automatisation->fin == '10' ? 'selected':'' }} value="10">10</option>  --}}
                                    </select>
                                </div>
                            </div>

                            <button class="btn btn-lg btn-success">Save</button>

                    </form>
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
            }
            else 
            {
                $("#lead_status").addClass('d-none');
                $("#chantier_status").removeClass('d-none');
                $("#disable_chantier").prop('required', true );
                $("#disable_lead").prop('required', false);
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
