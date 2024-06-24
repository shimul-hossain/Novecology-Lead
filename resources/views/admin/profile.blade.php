{{-- Main Layouts --}}
@extends('layouts.master')

{{-- Title part  --}}
@section('title')
 	{{ __('Profile') }}
@endsection

@section('bodyBg')
secondary-bg
@endsection
@push('css')
	 <style>
		 @media (min-width: 992px) {
			#v-pills-tab {
				min-width: 315px;
			}
		}
	 </style>
@endpush

{{-- active menu  --}}
@section('settingsIndex')
active
@endsection

{{-- Main Content Part  --}}
@section('content')
		<!-- Settings Section -->
		<section class="settings section-gap position-relative">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-xl-auto col-lg-4 mb-4 mb-lg-0">
						<div class="nav flex-column nav-pills parent-nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
							<a class="profile-nav-link-header nav-link" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="false">
								<span class="novecologie-icon-user mr-2"></span>
								{{ __('General Information') }}
							</a>
							<a class="profile-nav-link-header nav-link" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2" role="tab" aria-controls="v-pills-2" aria-selected="false">
								<span class="novecologie-icon-lock mr-2"></span>
								{{ __('Change Password') }}
							</a>
							@foreach (checkMenuAccess() as $key =>$menu)
								@if ($menu->route == 'role.index' || $menu->route == 'superadmin.dashboard')
									@if(role() == 's_admin')
										<a class="profile-nav-link-header nav-link" @if ($menu->route == 'superadmin.dashboard')
											target="_blank"
										@endif  href="{{ route($menu->route) }}" aria-selected="false">
											<span class="{{ ($menu->route == 'role.index') ? 'novecologie-icon-user-plus' : 'novecologie-icon-settings' }} mr-2"></span>
											{{ $menu->name }}
										</a>
									@else
										<a class="profile-nav-link-header nav-link" @if ($menu->route == 'superadmin.dashboard')
											target="_blank"
										@endif  href="{{ route($menu->getNavigation->route) }}" aria-selected="false">
											<span class="{{ ($menu->getNavigation->route == 'role.index') ? 'novecologie-icon-user-plus' : 'novecologie-icon-settings' }} mr-2"></span>
											{{ $menu->getNavigation->name }}
										</a>
									@endif
								@endif
							@endforeach
							@if (checkAction(Auth::id(), 'user', 'view') || role() == 's_admin')
								<a class="profile-nav-link-header nav-link " href="{{ route('user.all') }}">
									<span class="novecologie-icon-users mr-2"></span>
									{{ __('Users') }}
								</a>
							@endif
							@if (\App\Models\CRM\Permission::where('user_id', Auth::id())->where('name', 'admin.email.templete')->exists() || role() == 's_admin')
								<a class="profile-nav-link-header nav-link " href="{{ route('admin.email.templete') }}">
									<span class="novecologie-icon-users mr-2"></span>
									Email template
								</a> 
                            @endif
                            @if (\App\Models\CRM\Permission::where('user_id', Auth::id())->where('name', 'admin.sms.templete')->exists() || role() == 's_admin')
								<a class="profile-nav-link-header nav-link " href="{{ route('admin.sms.templete') }}">
									<span class="novecologie-icon-users mr-2"></span>
									SMS template
								</a>
                            @endif
							<button type="button" class="profile-nav-header" data-toggle="collapse" data-target="#generalSettingsCollapse" aria-expanded="false">
								<i class="bi bi-folder nav-link__icon mr-2"></i>
								<span class="nav-link__text">Paramètres généraux</span>
							</button>
							<div id="generalSettingsCollapse" class="collapse">
								<div class="nav flex-column nav-pills p-0" role="tablist" aria-orientation="vertical">
									@if (checkAction(Auth::id(), 'general__setting', 'regie') || role() == 's_admin')
										<a class="nav-link" id="v-pills-regie-tab" data-toggle="pill" href="#v-pills-regie" role="tab" aria-controls="v-pills-regie" aria-selected="false">
											<i class="bi bi-person-rolodex mr-2"></i>
											{{ __('Regie') }}
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'question') || role() == 's_admin')
										<a class="nav-link" id="v-pills-3-tab" data-toggle="pill" href="#v-pills-3" role="tab" aria-controls="v-pills-3" aria-selected="false">
											<span class="novecologie-icon-bell mr-2"></span>
											Prescription chantier
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'controle_des_documents') || role() == 's_admin')
										<a class="nav-link" id="v-pills-documentControl-tab" data-toggle="pill" href="#v-pills-documentControl" role="tab" aria-controls="v-pills-documentControl" aria-selected="false">
											<i class="bi bi-dpad mr-2"></i>
											Contrôle des Documents
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'banque') || role() == 's_admin')
										<a class="nav-link" id="v-pills-banque-tab" data-toggle="pill" href="#v-pills-banque" role="tab" aria-controls="v-pills-banque" aria-selected="false">
											<i class="bi bi-bank mr-2"></i>
											Banque
										</a>
									@endif
									{{-- @if (checkAction(Auth::id(), 'general__setting', 'bureau_etude') || role() == 's_admin')
										<a class="nav-link" id="v-pills-office-tab" data-toggle="pill" href="#v-pills-office" role="tab" aria-controls="v-pills-office" aria-selected="false">
											<i class="bi bi-filetype-woff mr-2"></i>
											Bureau étude
										</a>
									@endif --}}
									@if (checkAction(Auth::id(), 'general__setting', 'status_audit') || role() == 's_admin')
										<a class="nav-link" id="v-pills-status_audit-tab" data-toggle="pill" href="#v-pills-status_audit" role="tab" aria-controls="v-pills-status_audit" aria-selected="false">
											<i class="bi bi-distribute-horizontal mr-2"></i>
											Statut audit
										</a>
									@endif


									@if (checkAction(Auth::id(), 'general__setting', 'resultat_du_rapport') || role() == 's_admin')
										<a class="nav-link" id="v-pills-report_result-tab" data-toggle="pill" href="#v-pills-report_result" role="tab" aria-controls="v-pills-report_result" aria-selected="false">
											<i class="bi bi-balloon mr-2"></i>
											Résultat du rapport audit
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'commercial_terrain') || role() == 's_admin')
										<a class="nav-link" id="v-pills-commercial-tab" data-toggle="pill" href="#v-pills-commercial" role="tab" aria-controls="v-pills-commercial" aria-selected="false">
											<i class="bi bi-motherboard mr-2"></i>
											Commercial Terrain
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'bureaux_de_controle') || role() == 's_admin')
										<a class="nav-link" id="v-pills-13-tab" data-toggle="pill" href="#v-pills-13" role="tab" aria-controls="v-pills-13" aria-selected="false">
											<i class="bi bi-lamp mr-2"></i>
											Bureau de contrôle
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'status_du_probleme_ticket') || role() == 's_admin')
										<a class="nav-link" id="v-pills-ticket_problem_status-tab" data-toggle="pill" href="#v-pills-ticket_problem_status" role="tab" aria-controls="v-pills-ticket_problem_status" aria-selected="false">
											<i class="bi bi-flower3 mr-2"></i>
											Type de problème
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'type_energie_chaud') || role() == 's_admin')
										<a class="nav-link" id="v-pills-energy_type-tab" data-toggle="pill" href="#v-pills-energy_type" role="tab" aria-controls="v-pills-energy_type" aria-selected="false">
											<i class="bi bi-easel mr-2"></i>
											Type énergie Chaud.
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'prestations_group') || role() == 's_admin')
										<a class="nav-link" id="v-pills-prestation_group-tab" data-toggle="pill" href="#v-pills-prestation_group" role="tab" aria-controls="v-pills-prestation_group" aria-selected="false">
											<i class="bi bi-dropbox mr-2"></i>
											{{ __('Prestations group') }}
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'comment_category') || role() == 's_admin')
										<a class="nav-link" id="v-pills-comment_category-tab" data-toggle="pill" href="#v-pills-comment_category" role="tab" aria-controls="v-pills-comment_category" aria-selected="false">
											<i class="bi bi-chat mr-2"></i>
											{{ __('Comment Category') }}
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'quality_control') || role() == 's_admin')
									<a class="nav-link" id="v-pills-quality_control-tab" data-toggle="pill" href="#v-pills-quality_control" role="tab" aria-controls="v-pills-quality_control" aria-selected="false">
										<i class="bi bi-alt mr-2"></i>
										Contrôle Qualité
									</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'notion_category') || role() == 's_admin')
									<a class="nav-link" id="v-pills-notion_category-tab" data-toggle="pill" href="#v-pills-notion_category" role="tab" aria-controls="v-pills-notion_category" aria-selected="false">
										<i class="bi bi-clipboard-data mr-2"></i>
										Notion Catégorie
									</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'notion_sub_category') || role() == 's_admin')
									<a class="nav-link" id="v-pills-notion_sub_category-tab" data-toggle="pill" href="#v-pills-notion_sub_category" role="tab" aria-controls="v-pills-notion_sub_category" aria-selected="false">
										<i class="bi bi-hypnotize mr-2"></i>
										Notion Sous Catégorie
									</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'lead_sub_status') || role() == 's_admin')
										<a class="nav-link" id="v-pills-lead_sub_status-tab" data-toggle="pill" href="#v-pills-lead_sub_status" role="tab" aria-controls="v-pills-lead_sub_status" aria-selected="false">
											<i class="bi bi-award-fill mr-2"></i>
											Sous statut prospect
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'heating_mode') || role() == 's_admin')
										<a class="nav-link" id="v-pills-heating_mode-tab" data-toggle="pill" href="#v-pills-heating_mode" role="tab" aria-controls="v-pills-heating_mode" aria-selected="false">
											<i class="bi bi-border-right mr-2"></i>
											Mode de chauffage
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'campagne_type') || role() == 's_admin')
										<a class="nav-link" id="v-pills-campagne_type-tab" data-toggle="pill" href="#v-pills-campagne_type" role="tab" aria-controls="v-pills-campagne_type" aria-selected="false">
											<i class="bi bi-bar-chart-steps mr-2"></i>
											Type de campagne
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'project_sub_status') || role() == 's_admin')
										<a class="nav-link" id="v-pills-project_sub_status-tab" data-toggle="pill" href="#v-pills-project_sub_status" role="tab" aria-controls="v-pills-project_sub_status" aria-selected="false">
											<i class="bi bi-bicycle  mr-2"></i>
											Sous statut chantier
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'status_planning_intervention') || role() == 's_admin')
										<a class="nav-link" id="v-pills-status_planning_intervention-tab" data-toggle="pill" href="#v-pills-status_planning_intervention" role="tab" aria-controls="v-pills-status_planning_intervention" aria-selected="false">
											<i class="bi bi-book mr-2"></i>
											Statut planning intervention
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'project_ko_reason') || role() == 's_admin')
										<a class="nav-link" id="v-pills-project_ko_reason-tab" data-toggle="pill" href="#v-pills-project_ko_reason" role="tab" aria-controls="v-pills-project_ko_reason" aria-selected="false">
											<i class="bi bi-basket3 mr-2"></i>
											Chantiers KO - Raisons
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'project_reflection_reason') || role() == 's_admin')
										<a class="nav-link" id="v-pills-project_reflection_reason-tab" data-toggle="pill" href="#v-pills-project_reflection_reason" role="tab" aria-controls="v-pills-project_reflection_reason" aria-selected="false">
											<i class="bi bi-border-style mr-2"></i>
											Chantiers Reflexion - Raisons
										</a>
									@endif

									@if (checkAction(Auth::id(), 'general__setting', 'project_control_photo') || role() == 's_admin')
										<a class="nav-link" id="v-pills-project_control_photo-tab" data-toggle="pill" href="#v-pills-project_control_photo" role="tab" aria-controls="v-pills-project_control_photo" aria-selected="false">
											<i class="bi bi-circle-square mr-2"></i>
											Contrôle conformité photo chantier
										</a>
									@endif

									@if (checkAction(Auth::id(), 'general__setting', 'statut_maprimerenov') || role() == 's_admin')
										<a class="nav-link" id="v-pills-statut_maprimerenov-tab" data-toggle="pill" href="#v-pills-statut_maprimerenov" role="tab" aria-controls="v-pills-statut_maprimerenov" aria-selected="false">
											<i class="bi bi-hdd mr-2"></i>
											Statut MaPrimeRénov
										</a>
									@endif

									@if (checkAction(Auth::id(), 'general__setting', 'mandataire_anah') || role() == 's_admin')
										<a class="nav-link" id="v-pills-10-tab" data-toggle="pill" href="#v-pills-10" role="tab" aria-controls="v-pills-10" aria-selected="false">
											<i class="bi bi-journal-code mr-2"></i>
											Mandataire ANAH
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'installateurs_rge') || role() == 's_admin')
										<a class="nav-link" id="v-pills-8-tab" data-toggle="pill" href="#v-pills-8" role="tab" aria-controls="v-pills-8" aria-selected="false">
											<i class="bi bi-layers mr-2"></i>
											Entreprise de travaux
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'reject_reason') || role() == 's_admin')
										<a class="nav-link" id="v-pills-reject_reason-tab" data-toggle="pill" href="#v-pills-reject_reason" role="tab" aria-controls="v-pills-reject_reason" aria-selected="false">
											<i class="bi bi-battery mr-2"></i>
											Motif rejet
										</a>
									@endif
									@if (role() == 's_admin')
										<a class="nav-link" id="v-pills-color_user-tab" data-toggle="pill" href="#v-pills-color_user" role="tab" aria-controls="v-pills-color_user" aria-selected="false">
											<i class="bi bi-rainbow mr-2"></i>
											Paramètres de couleur utilisateur
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'type_fournisseur') || role() == 's_admin')
										<a class="nav-link" id="v-pills-type_fournisseur-tab" data-toggle="pill" href="#v-pills-type_fournisseur" role="tab" aria-controls="v-pills-type_fournisseur" aria-selected="false">
											<i class="bi bi-badge-vo mr-2"></i>
											Type de fournisseur
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'technical_referee') || role() == 's_admin')
										<a class="nav-link" id="v-pills-technical_referee-tab" data-toggle="pill" href="#v-pills-technical_referee" role="tab" aria-controls="v-pills-technical_referee" aria-selected="false">
											<i class="bi bi-alt mr-2"></i>
											Réfèrent technique
										</a>
									@endif
								</div>
							</div>

							<button type="button" class="profile-nav-header" data-toggle="collapse" data-target="#ceeCollapse" aria-expanded="false">
								<i class="bi bi-folder nav-link__icon mr-2"></i>
								<span class="nav-link__text">Opérations CEE</span>
							</button>
							<div id="ceeCollapse" class="collapse">
								<div class="nav flex-column nav-pills p-0" role="tablist" aria-orientation="vertical">
									@if (checkAction(Auth::id(), 'general__setting', 'baremes') || role() == 's_admin')
										<a class="nav-link" id="v-pills-5-tab" data-toggle="pill" href="#v-pills-5" role="tab" aria-controls="v-pills-5" aria-selected="false">
											<span class="novecologie-icon-star mr-2"></span>
											Barèmes/Travaux/Tag
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'delegataires') || role() == 's_admin')
										<a class="nav-link" id="v-pills-6-tab" data-toggle="pill" href="#v-pills-6" role="tab" aria-controls="v-pills-6" aria-selected="false">
											<i class="bi bi-optical-audio mr-2"></i>
											{{ __('Délégataires') }}
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'deals_tarifs') || role() == 's_admin')
										<a class="nav-link" id="v-pills-7-tab" data-toggle="pill" href="#v-pills-7" role="tab" aria-controls="v-pills-7" aria-selected="false">
											<i class="bi bi-peace mr-2"></i>
											{{ __('Deals / Tarifs') }}
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'amo') || role() == 's_admin')
										<a class="nav-link" id="v-pills-9-tab" data-toggle="pill" href="#v-pills-9" role="tab" aria-controls="v-pills-9" aria-selected="false">
											<i class="bi bi-mailbox mr-2"></i>
											{{ __('AMO') }}
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'auditeur_energetique') || role() == 's_admin')
										<a class="nav-link" id="v-pills-11-tab" data-toggle="pill" href="#v-pills-11" role="tab" aria-controls="v-pills-11" aria-selected="false">
											<i class="bi bi-hdd-rack mr-2"></i>
											{{ __('Auditeur énergétique') }}
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'zones_d_intervention') || role() == 's_admin')
										<a class="nav-link" id="v-pills-12-tab" data-toggle="pill" href="#v-pills-12" role="tab" aria-controls="v-pills-12" aria-selected="false">
											<i class="bi bi-diamond mr-2"></i>
											Zones d'intervention
										</a>
									@endif
								</div>
							</div>
							<button type="button" class="profile-nav-header" data-toggle="collapse" data-target="#catalogueCollapse" aria-expanded="false">
								<i class="bi bi-folder nav-link__icon mr-2"></i>
								<span class="nav-link__text">Catalogue</span>
							</button>
							<div id="catalogueCollapse" class="collapse">
								<div class="nav flex-column nav-pills p-0" role="tablist" aria-orientation="vertical">
									@if (checkAction(Auth::id(), 'general__setting', 'marques') || role() == 's_admin')
										<a class="nav-link" id="v-pills-14-tab" data-toggle="pill" href="#v-pills-14" role="tab" aria-controls="v-pills-14" aria-selected="false">
											<i class="bi bi-nut mr-2"></i>
											{{ __('Marques') }}
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'prestations') || role() == 's_admin')
										<a class="nav-link" id="v-pills-15-tab" data-toggle="pill" href="#v-pills-15" role="tab" aria-controls="v-pills-15" aria-selected="false">
											<i class="bi bi-puzzle mr-2"></i>
											{{ __('Prestations') }}
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'fournisseurs') || role() == 's_admin')
										<a class="nav-link" id="v-pills-16-tab" data-toggle="pill" href="#v-pills-16" role="tab" aria-controls="v-pills-16" aria-selected="false">
											<i class="bi bi-snow  mr-2"></i>
											{{ __('Fournisseurs') }}
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'societe_client') || role() == 's_admin')
										<a class="nav-link" id="v-pills-17-tab" data-toggle="pill" href="#v-pills-17" role="tab" aria-controls="v-pills-17" aria-selected="false">
											<i class="bi bi-building mr-2"></i>
											{{ __('Societé client') }}
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'produits') || role() == 's_admin')
										<a class="nav-link" id="v-pills-18-tab" data-toggle="pill" href="#v-pills-18" role="tab" aria-controls="v-pills-18" aria-selected="false">
											<i class="bi bi-file-earmark-text"></i>
											{{ __('Produits') }}
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'produits_categorie') || role() == 's_admin')
										<a class="nav-link" id="v-pills-19-tab" data-toggle="pill" href="#v-pills-19" role="tab" aria-controls="v-pills-19" aria-selected="false">
											<i class="bi bi-card-list"></i>
											{{ __('Produits Catégorie') }}
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'produits_sous_categorie') || role() == 's_admin')
										<a class="nav-link" id="v-pills-20-tab" data-toggle="pill" href="#v-pills-20" role="tab" aria-controls="v-pills-20" aria-selected="false">
											<i class="bi bi-clipboard-minus"></i>
											{{ __('Produits Sous-Catégorie') }}
										</a>
									@endif
									@if (role() == 's_admin')
										<a class="nav-link" id="v-pills-BAR_TH_164-tab" data-toggle="pill" href="#v-pills-BAR_TH_164" role="tab" aria-controls="v-pills-BAR_TH_164" aria-selected="false">
											<i class="bi bi-fullscreen-exit"></i>
											BAR TH 164
										</a>
									@endif
								</div>
							</div>

							{{-- @if (role() == 's_admin')
								@foreach (checkMenuAccess() as $key => $item)
								@if($item->index == 0 || $item->index == 5)
								<a class="nav-link"  href="{{ route($item->route) }}" role="tab" aria-controls="v-pills-3" aria-selected="false">
									<span class="{{ ($item->index == 5) ? 'novecologie-icon-user-plus' : 'novecologie-icon-settings' }} mr-2"></span>
									{{ $item->name }}
									</a>
								@endif
								@endforeach
								<a class="nav-link " href="{{ route('user.all') }}">
								  <span class="novecologie-icon-user mr-2"></span>
								  {{ __('Users') }}
								</a>
							@endif --}}
						</div>
					</div>
					<div class="col-xl-8 col-lg-8">
						<div class="tab-content bg-white" id="v-pills-tabContent">
							<div class="tab-pane fade" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-1-tab">
								<form action="{{ route('update.profile') }}" method="POST" class="setting-form" id="generalInfoForm1" enctype="multipart/form-data">
									@csrf
									<div class="row">
										<div class="col-12 d-flex mb-3">
											<div class="setting-form__user-avatar flex-shrink-0 overflow-hidden mr-3">
												@if ($user->profile_photo)
												<img  loading="lazy"   src="{{ asset('uploads/crm/profiles') }}/{{ $user->profile_photo }}" alt="avatar image" class="setting-form__user-avatar__image w-100 h-100 rounded-circle">
												@else
												<img  loading="lazy"   src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="avatar image" class="setting-form__user-avatar__image w-100 h-100 rounded-circle">
												@endif

												<input type="file" name="image" id="setting-form__user-avatarInput" class="d-none">
											</div>
											<div>
												<label for="setting-form__user-avatarInput" class="secondary-btn secondary-btn--primary mr-2" tabindex="0" role="button">{{ __('Upload Image') }}</label>
												{{-- <button type="reset" class="outline-btn outline-btn--sm">Reset</button> --}}
												<p class="mb-0">
                                                    <small>{{ __('Allowed JPG, JPEG or PNG. Max size of 800kB') }}</small>
                                                </p>
												@error('image')
													<span class="text-danger alert">{{ $message }}**</span>
												@enderror
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="userName" class="form-label">{{ __('Username') }} <span class="text-danger">*</span></label>
												<input type="text" name="userName" id="userName" value="{{ $user->username }}" class="form-control shadow-none px-3" placeholder="johndoe">
												<input type="hidden" value="{{ $user->id }}" name="id">
												@error('userName')
													<span class="text-danger alert">{{ $message }}**</span>
												@enderror
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="name" class="form-label">{{ __('Name') }} <span class="text-danger">*</span></label>
												<input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control shadow-none px-3" placeholder="John Doe">
												@error('name')
													<span class="text-danger alert">{{ $message }}**</span>
												@enderror
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="email" class="form-label">{{ __('E-mail') }} <span class="text-danger">*</span></label>
												<input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control shadow-none px-3" placeholder="example@example.com">
												@error('email')
													<span class="text-danger alert">{{ $message }}**</span>
												@enderror
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="company" class="form-label">{{ __('Company') }}</label>
												<input type="text" name="company" value="{{ $user->company }}" id="company" class="form-control shadow-none px-3" placeholder="{{ __('Company Name') }}">
												@error('company')
													<span class="text-danger alert">{{ $message }}**</span>
												@enderror
											</div>
										</div>
										<div class="col-12 mt-3">
											<button type="submit" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2">{{ __('Save changes') }}</button>
											{{-- <button type="reset" class="outline-btn mb-2">Reset</button> --}}
										</div>
									</div>
								</form>
							</div>
							<div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-2-tab">
								<form  class="setting-form" id="generalInfoForm2">
									<input type="hidden" id="user_id" value="{{ $user->id }}" name="id">
									<div id="alertMessage" class="alert d-none"></div>
									<div class="row">
										<div class="col-md-6">
											<label for="oldPassword" class="form-label">{{ __('Old Password') }} <span class="text-danger">*</span></label>
											<div class="form-group d-flex flex-column align-items-start position-relative">
												{{-- <span class="novecologie-icon-lock form-group__icon position-absolute"></span> --}}
												<input type="password" id="oldPassword" name="oldPassword" class="form-control form-control--password shadow-none" placeholder="{{ __('Old Password') }}">
												<button type="button" class="form-group__password-toggler position-absolute bg-transparent border-0 custom-focus">
													<span class="password-toggler__icon novecologie-icon-eye"></span>
												</button>
												<span id="oldPasswordError" class="text-danger alert p-0 m-0"></span>
											</div>
										</div>
										<div class="col-md-6">
										</div>
										<div class="col-md-6">
											<label for="newPassword" class="form-label">{{ __('New Password') }} <span class="text-danger">*</span></label>
											<div class="form-group d-flex flex-column align-items-start position-relative">
												{{-- <span class="novecologie-icon-lock form-group__icon position-absolute"></span> --}}
												<input type="password" id="newPassword" name="newPassword" class="form-control form-control--password shadow-none" placeholder="{{ __('New Password') }}">
												<button type="button" class="form-group__password-toggler position-absolute bg-transparent border-0 custom-focus">
													<span class="password-toggler__icon novecologie-icon-eye"></span>
												</button>
												<span id="newPasswordError" class="text-danger alert p-0 m-0"></span>
											</div>
										</div>
										<div class="col-md-6">
											<label for="retypePassword" class="form-label">{{ __('Retype New Password') }} <span class="text-danger">*</span></label>
											<div class="form-group d-flex flex-column align-items-start position-relative">
												{{-- <span class="novecologie-icon-lock form-group__icon position-absolute"></span> --}}
												<input type="password" id="retypePassword" name="ConfirmNewPassword" class="form-control form-control--password shadow-none" placeholder="{{ __('New Password') }}">
												<button type="button" class="form-group__password-toggler position-absolute bg-transparent border-0 custom-focus">
													<span class="password-toggler__icon novecologie-icon-eye"></span>
												</button>
												<span id="ConfirmPasswordError" class="text-danger alert p-0 m-0"></span>
											</div>
										</div>
										<div class="col-12 mt-3">
											<button id="passwordChangeBtn" type="submit" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2">{{ __('Save changes') }}</button>
											<button type="reset" class="outline-btn mb-2">{{ __('Reset') }}</button>
										</div>
									</div>
								</form>
							</div>
							<div class="tab-pane fade" id="v-pills-regie" role="tabpanel" aria-labelledby="v-pills-regie-tab">
								<div class="setting-form">
									<div class="row">
										<div class="col-12">
											<h3 class="mb-4">{{ __('Add New Regie') }}</h3>
											<form action="{{ route('user.regie.add') }}" method="POST" id="generalInfoFormRegie">
												@csrf
												<div class="form-group">
													<label class="form-label" for="regie_name">{{ __('Regie Name') }} <span class="text-danger">*</span></label>
													<input type="text" name="regie_name" id="regie_name" class="form-control shadow-none">
													<input type="hidden" name="regie_id" id="regie_id" value="0" class="form-control shadow-none">
												</div>
												<div class="form-group">
													<label class="form-label" for="responsable_commercial">Responsable Commercial <span class="text-danger">*</span></label>
													<select name="responsable_commercial" id="responsable_commercial"  class="select2_select_option custom-select shadow-none form-control">
														<option value="" selected>{{ __('Select') }}</option>
														@foreach ($responsable_commercials as $r_commercial)
															<option value="{{ $r_commercial->id }}">{{ $r_commercial->name }}</option>
														@endforeach
													</select>
												</div>
											</form>
										</div>
										<div class="col-12 mt-3">
											@if (checkAction(Auth::id(), 'general__setting-regie', 'create') || role() == 's_admin')
												<button type="button" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2" id="regie_form_submit">{{ __('Save changes') }}</button>
											@else
												<button type="button" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Save changes') }}</button>
											@endif
										</div>
										<div class="col-12">
											<div class="table-responsive simple-bar">
												<table class="table database-table w-100 mb-0">
													<thead class="database-table__header">
														<tr>
															<th>{{ __('Serial') }}</th>
															<th>{{ __('Name') }}</th>
															<th>Responsable Commercial</th>
															<th class="text-center">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body">
														@forelse ($regies as $regie)
														<tr>
															<td>{{ $loop->iteration }}</td>
															<td>{{ $regie->name }}</td>
															<td>{{ $regie->getUser->name ?? '' }}</td>
															<td class="text-center">
																<div class="dropdown dropdown--custom p-0 d-inline-block">
																	<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																		<span class="novecologie-icon-dots-horizontal-triple"></span>
																	</button>
																	<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																		@if (checkAction(Auth::id(), 'general__setting-regie', 'edit') || role() == 's_admin')
																			<button  type="button" class="dropdown-item border-0 regie_edit_button" data-responsable_commercial="{{ $regie->team_leader_id }}" data-id="{{ $regie->id }}" data-name="{{ $regie->name }}">
																				<span class="novecologie-icon-edit mr-1"></span>
																				{{ __('Edit') }}
																			</button>
																		@else
																		<button  type="button" class="dropdown-item border-0">
																			<span class="novecologie-icon-lock py-1"></span> {{ __('Edit') }}
																		</button>
																		@endif
																		@if (checkAction(Auth::id(), 'general__setting-regie', 'delete') || role() == 's_admin')
																			<form action="{{ route('user.regie.destroy') }}" method="post">
																				@csrf
																				<input type="hidden" name="id" value="{{ $regie->id }}">
																				<button type="submit" class="dropdown-item border-0">
																					<span class="novecologie-icon-trash mr-1"></span>
																						Supprimer
																				</button>
																			</form>
																		@else
																			<button type="button" class="dropdown-item border-0">
																				<span class="novecologie-icon-lock py-1"></span> Supprimer
																			</button>
																		@endif
																	</div>
																</div>
															</td>
														</tr>
														@empty
														<tr>
															<td  class="text-center" colspan="5">{{ __('No Question Found') }}</td>
														</tr>
														@endforelse
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="v-pills-3" role="tabpanel" aria-labelledby="v-pills-3-tab">
								<form action="{{ route('travaux.question.add') }}" class="setting-form" id="generalInfoForm3" method="POST">
									@csrf
									<div class="row">
										<div class="col-12">
											<h3 class="mb-4">Prescription chantier</h3>
											<div class="form-group">
												<div class="d-flex align-items-center justify-content-between">
													<label class="form-label" for="travaux">{{ __('Select Barèmes') }} <span class="text-danger">*</span></label>
													@if (checkAction(Auth::id(), 'general__setting-baremes', 'create') || role() == 's_admin')
														<button type="button" class="secondary-btn border-0 mb-1" data-toggle="modal" data-target="#travauxModal">+ {{ __('Add new') }}</button>
													@else
														<button type="button" class="secondary-btn border-0 mb-1"><span class="novecologie-icon-lock py-1"></span> {{ __('Add new') }}</button>
													@endif
												</div>
												<select name="travaux" id="travaux"  class="select2_select_option custom-select shadow-none form-control">
													<option value="" selected>{{ __('Select') }}</option>
													@foreach ($bareme_travaux_tags->where('rank', 1) as $baremes)
														<option value="{{ $baremes->id }}">{{ $baremes->bareme }}-{{ $baremes->bareme_description }}</option>
													@endforeach
												</select>
											</div>
											<div id="addMoreQuestion">
												<div class="form-group">
													<label class="form-label" for="label_title">{{ __('Question') }} <span class="text-danger">*</span></label>
													<input type="text" name="label_title[]" id="label_title" class="form-control shadow-none question_title">
												</div>
												<div class="form-group">
													<label class="form-label" for="input_type">{{ __('Select Input Type') }} <span class="text-danger">*</span></label>
													<select name="input_type[]" id="input_type"  class="select2_select_option custom-select shadow-none form-control">
														<option value="text">{{ __('Text') }}</option>
														<option value="number">{{ __('Number') }}</option>
														<option value="email">{{ __('Email') }}</option>
														<option value="radio">{{ __('Radio') }}</option>
														<option value="checkbox">{{ __('Checkbox') }}</option>
														<option value="select">{{ __('Dropdown') }}</option>
														<option value="textarea">{{ __('Textarea') }}</option>
													</select>
												</div>
												<div class="form-group">
													<label class="form-label" for="required_optional">{{ __('Required/Optional') }} <span class="text-danger">*</span></label>
													<select name="required_optional[]" id="required_optional"  class="select2_select_option custom-select shadow-none form-control">
														<option value="no">{{ __('Optional') }}</option>
														<option value="yes">{{ __('Required') }}</option>
													</select>
												</div>
												<div class="form-group">
													<label class="form-label" for="options">{{ __('Options') }}</label>
													<textarea name="options[]" id="options" class="form-control shadow-none" placeholder="{{ __('Enter Options. Each option seperate with comma ,') }}"></textarea>
												</div>
												<div class="form-group">
													<label class="form-label" for="order">{{ __('Order') }}</label>
													<input type="number" name="order[]" id="order" class="form-control shadow-none">
												</div>
											</div>
										</div>
										<div class="col-12 mt-3">
											@if (checkAction(Auth::id(), 'general__setting-question', 'create') || role() == 's_admin')
												<button type="button" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2" id="question_submit_btn">{{ __('Save changes') }}</button>
												<button type="button" class="secondary-btn secondary-btn--cuccess border-0 mb-2 mr-2" id="add_more_question_btn">{{ __('Add More') }}</button>
											@else
											<button type="button" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Save changes') }}</button>
											@endif
										</div>
										<div class="col-12">
											<div class="table-responsive simple-bar" id="question_inputs">

											</div>
										</div>
									</div>
								</form>
							</div>

							<div class="tab-pane fade" id="v-pills-product" role="tabpanel" aria-labelledby="v-pills-product-tab">
								<form action="{{ route('travaux.product.create') }}" class="setting-form" id="generalInfoFormproduct" method="POST">
									@csrf
									<div class="row">
										<div class="col-12">
											<h3 class="mb-4">{{ __('Create Produits') }}</h3>
											<div class="form-group">
												<label class="form-label" for="xtravaux_product_Status">{{ __('Produits') }} <span class="text-danger">*</span></label>
												<input type="text" id="xtravaux_product_Status" name="product" class="form-control shadow-none rounded" placeholder="{{ __('Enter Produit') }}" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
											<div class="form-group">
												<div class="d-flex align-items-center justify-content-between">
												<label class="form-label" for="travaux2">{{ __('Travaux') }} <span class="text-danger">*</span></label>
												<button type="button" class="secondary-btn border-0 mb-1" data-toggle="modal" data-target="#travauxModal2">+ {{ __('Add new') }}</button>
												</div>
												<select name="travaux" id="travaux2"  class="select2_select_option custom-select shadow-none form-control" required>
													@foreach ($travaux_list as $travaux)
														<option value="{{ $travaux->travaux }}">{{ $travaux->travaux }}</option>
													@endforeach
												</select>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
										</div>
										<div class="col-12 mt-3">
											<button type="submit" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2">{{ __('Save changes') }}</button>
										</div>
										<div class="col-12" >
											<div class="table-responsive simple-bar" id="all_products">
											<table class="table database-table w-100 mb-0">
												<thead class="database-table__header">
													<tr>
														<th>{{ __('Serial') }}</th>
														<th>{{ __('Travaux') }}</th>
														<th>{{ __('Produits') }}</th>
														<th class="text-center">{{ __('Action') }}</th>
													</tr>
												</thead>
												<tbody class="database-table__body">
													@foreach (getTravauxProduct() as $item)
														<tr>
															<td>{{ $loop->iteration }}</td>
															<td id="project_travaux{{ $item->id }}">{{ $item->travaux }}</td>
															<td id="travaux_product{{ $item->id }}">{{ $item->product }}</td>
															<td class="text-center">
																<div class="dropdown dropdown--custom p-0 d-inline-block">
																	<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																		<span class="novecologie-icon-dots-horizontal-triple"></span>
																	</button>
																	<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																		{{-- <button data-id="{{ $item->id }}" data-status="{{ $item->status }}" type="button" class="dropdown-item border-0 editProjectStatus">
																			<span class="novecologie-icon-edit mr-1"></span>
																			{{ __('Edit') }}
																		</button>  --}}
																		<form action="{{ route('travaux.product.delete') }}" method="POST">
																			@csrf
																			<input type="hidden" name="id" value="{{ $item->id }}">
																			<button type="submit" class="dropdown-item border-0">
																				<span class="novecologie-icon-trash mr-1"></span>
																					Supprimer
																			</button>
																		</form>
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
								</form>
							</div>
							<div class="tab-pane fade" id="v-pills-documentControl" role="tabpanel" aria-labelledby="v-pills-documentControl-tab">
								<form action="{{ route('document.control.create') }}" class="setting-form" id="generalInfoFormtravaux" method="POST">
									@csrf
									<div class="row">
										<div class="col-12">
											<h3 class="mb-4">Contrôle des Documents</h3>
											<div class="form-group">
												<label class="form-label" for="controlDocument">Nom<span class="text-danger">*</span></label>
												<input type="text" id="controlDocument" name="name" class="form-control shadow-none rounded" placeholder="Contrôle des Documents" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
											<div class="form-group">
												<label class="form-label" for="controlDocumentOrder">Order</label>
												<input type="number" id="controlDocumentOrder" name="order" class="form-control shadow-none rounded" placeholder="order">
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
										</div>
										<div class="col-12 mt-3">
											@if (checkAction(Auth::id(), 'general__setting-controle_des_documents', 'create') || role() == 's_admin')
												<button type="submit" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2">{{ __('Create') }}</button>
											@else
												<button type="button" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Create') }}</button>
											@endif
										</div>
										<div class="col-12" >
											<div class="table-responsive simple-bar">
												<table class="table database-table w-100 mb-0">
													<thead class="database-table__header">
														<tr>
															<th>{{ __('Serial') }}</th>
															<th>Nom</th>
															<th>Order</th>
															<th class="text-center">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body">
														@foreach ($document_controls as $control)
															<tr>
																<td>{{ $loop->iteration }}</td>
																<td id="project_control{{ $control->id }}">{{ $control->name }}</td>
																<td>{{ $control->order }}</td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if (checkAction(Auth::id(), 'general__setting-controle_des_documents', 'edit') || role() == 's_admin')
																				<button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#control_edit{{ $control->id }}">
																					<span class="novecologie-icon-edit mr-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@else
																				<button  type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span> {{ __('Edit') }}
																				</button>
																			@endif
																			@if (checkAction(Auth::id(), 'general__setting-controle_des_documents', 'delete') || role() == 's_admin')
																				<button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#control_delete{{ $control->id }}">
																					<span class="novecologie-icon-trash mr-1"></span>
																						Supprimer
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>  Supprimer
																				</button>
																			@endif
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
								</form>
							</div>
							<div class="tab-pane fade" id="v-pills-banque" role="tabpanel" aria-labelledby="v-pills-banque-tab">
								<form action="{{ route('banque.create') }}" class="setting-form" id="generalInfoFormtravaux" method="POST">
									@csrf
									<div class="row">
										<div class="col-12">
											<h3 class="mb-4">Banque</h3>
											<div class="form-group">
												<label class="form-label" for="banque">Nom<span class="text-danger">*</span></label>
												<input type="text" id="banque" name="name" class="form-control shadow-none rounded" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
										</div>
										<div class="col-12 mt-3">
											@if (checkAction(Auth::id(), 'general__setting-banque', 'create') || role() == 's_admin')
												<button type="submit" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2">{{ __('Create') }}</button>
											@else
												<button type="button" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Create') }}</button>
											@endif
										</div>
										<div class="col-12" >
											<div class="table-responsive simple-bar">
												<table class="table database-table w-100 mb-0">
													<thead class="database-table__header">
														<tr>
															<th>{{ __('Serial') }}</th>
															<th>Nom</th>
															<th class="text-center">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body">
														@foreach ($banques as $banque)
															<tr>
																<td>{{ $loop->iteration }}</td>
																<td>{{ $banque->name }}</td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if (checkAction(Auth::id(), 'general__setting-banque', 'edit') || role() == 's_admin')
																				<button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#banque_edit{{ $banque->id }}">
																					<span class="novecologie-icon-edit mr-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@endif
																			@if (checkAction(Auth::id(), 'general__setting-banque', 'delete') || role() == 's_admin')
																				<button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#banque_delete{{ $banque->id }}">
																					<span class="novecologie-icon-trash mr-1"></span>
																						Supprimer
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																						Supprimer
																				</button>
																			@endif
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
								</form>
							</div>
							<div class="tab-pane fade" id="v-pills-status_audit" role="tabpanel" aria-labelledby="v-pills-status_audit-tab">
								<form action="{{ route('audit.status.create') }}" class="setting-form" id="generalInfoFormtravaux" method="POST">
									@csrf
									<div class="row">
										<div class="col-12">
											<h3 class="mb-4">Statut audit</h3>
											<div class="form-group">
												<label class="form-label" for="status_audit">Nom<span class="text-danger">*</span></label>
												<input type="text" id="status_audit" name="name" class="form-control shadow-none rounded" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
											<div class="form-group">
												<label class="form-label" for="text_color_audit">Couleur du texte<span class="text-danger">*</span></label>
												<input type="color" id="text_color_audit" name="text_color" class="form-control shadow-none rounded" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
											<div class="form-group">
												<label class="form-label" for="background_color_audit">Couleur de l'arrière plan<span class="text-danger">*</span></label>
												<input type="color" id="background_color_audit" name="background_color" value="#ffffff" class="form-control shadow-none rounded" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
										</div>
										<div class="col-12 mt-3">
											@if (checkAction(Auth::id(), 'general__setting-status_audit', 'create') || role() == 's_admin')
												<button type="submit" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2">{{ __('Create') }}</button>
											@else
												<button type="button" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Create') }}</button>
											@endif
										</div>
										<div class="col-12" >
											<div class="table-responsive simple-bar">
												<table class="table database-table w-100 mb-0">
													<thead class="database-table__header">
														<tr>
															<th>{{ __('Serial') }}</th>
															<th>Nom</th>
															<th class="text-center">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body">
														@foreach ($all_audit_status as $status_audit)
															<tr>
																<td>{{ $loop->iteration }}</td>
																<td>{{ $status_audit->name }}</td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if (checkAction(Auth::id(), 'general__setting-status_audit', 'edit') || role() == 's_admin')
																				<button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#status_audit_edit{{ $status_audit->id }}">
																					<span class="novecologie-icon-edit mr-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@else
																				<button  type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@endif
																			@if (checkAction(Auth::id(), 'general__setting-status_audit', 'delete') || role() == 's_admin')
																				<button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#status_audit_delete{{ $status_audit->id }}">
																					<span class="novecologie-icon-trash mr-1"></span>
																						Supprimer
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																						Supprimer
																				</button>
																			@endif
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
								</form>
							</div>
							<div class="tab-pane fade" id="v-pills-status_report_audit" role="tabpanel" aria-labelledby="v-pills-status_report_audit-tab">
								<form action="{{ route('audit.report.status.create') }}" class="setting-form" id="generalInfoFormtravaux" method="POST">
									@csrf
									<div class="row">
										<div class="col-12">
											<h3 class="mb-4">Statut rapport audit</h3>
											<div class="form-group">
												<label class="form-label" for="status_report_audit">Nom<span class="text-danger">*</span></label>
												<input type="text" id="status_report_audit" name="name" class="form-control shadow-none rounded" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
										</div>
										<div class="col-12 mt-3">
											@if (checkAction(Auth::id(), 'general__setting-status_rapport_audit', 'create') || role() == 's_admin')
												<button type="submit" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2">{{ __('Create') }}</button>
											@else
												<button type="button" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Create') }}</button>
											@endif
										</div>
										<div class="col-12" >
											<div class="table-responsive simple-bar">
												<table class="table database-table w-100 mb-0">
													<thead class="database-table__header">
														<tr>
															<th>{{ __('Serial') }}</th>
															<th>Nom</th>
															<th class="text-center">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body">
														@foreach (\App\Models\CRM\AuditReportStatus::all() as $status_report)
															<tr>
																<td>{{ $loop->iteration }}</td>
																<td>{{ $status_report->name }}</td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if (checkAction(Auth::id(), 'general__setting-status_rapport_audit', 'edit') || role() == 's_admin')
																				<button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#status_report_edit{{ $status_report->id }}">
																					<span class="novecologie-icon-edit mr-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@else
																				<button  type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@endif
																			@if (checkAction(Auth::id(), 'general__setting-status_rapport_audit', 'delete') || role() == 's_admin')
																				<button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#status_report_delete{{ $status_report->id }}">
																					<span class="novecologie-icon-trash mr-1"></span>
																						Supprimer
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																						Supprimer
																				</button>
																			@endif
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
								</form>
							</div>

							<div class="tab-pane fade" id="v-pills-report_result" role="tabpanel" aria-labelledby="v-pills-report_result-tab">
								<form action="{{ route('report.result.create') }}" class="setting-form" id="generalInfoFormtravaux" method="POST">
									@csrf
									<div class="row">
										<div class="col-12">
											<h3 class="mb-4">Résultat du rapport audit</h3>
											<div class="form-group">
												<label class="form-label" for="report_result">Nom<span class="text-danger">*</span></label>
												<input type="text" id="report_result" name="name" class="form-control shadow-none rounded" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
										</div>
										<div class="col-12 mt-3">
											@if (checkAction(Auth::id(), 'general__setting-resultat_du_rapport', 'create') || role() == 's_admin')
											<button type="submit" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2">{{ __('Create') }}</button>
											@else
											<button type="button" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Create') }}</button>
											@endif
										</div>
										<div class="col-12" >
											<div class="table-responsive simple-bar">
												<table class="table database-table w-100 mb-0">
													<thead class="database-table__header">
														<tr>
															<th>{{ __('Serial') }}</th>
															<th>Nom</th>
															<th class="text-center">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body">
														@foreach ($all_report_result as $report_result)
															<tr>
																<td>{{ $loop->iteration }}</td>
																<td>{{ $report_result->name }}</td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if (checkAction(Auth::id(), 'general__setting-resultat_du_rapport', 'edit') || role() == 's_admin')
																				<button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#report_result_edit{{ $report_result->id }}">
																					<span class="novecologie-icon-edit mr-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@else
																				<button  type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@endif
																			@if (checkAction(Auth::id(), 'general__setting-resultat_du_rapport', 'delete') || role() == 's_admin')
																				<button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#report_result_delete{{ $report_result->id }}">
																					<span class="novecologie-icon-trash mr-1"></span>
																						Supprimer
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																						Supprimer
																				</button>
																			@endif
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
								</form>
							</div>
							<div class="tab-pane fade" id="v-pills-commercial" role="tabpanel" aria-labelledby="v-pills-commercial-tab">
								<form action="{{ route('commercial.terrain.create') }}" class="setting-form" id="generalInfoFormtravaux" method="POST">
									@csrf
									<div class="row">
										<div class="col-12">
											<h3 class="mb-4">Commercial Terrain</h3>
											<div class="form-group">
												<label class="form-label" for="commercial">Nom<span class="text-danger">*</span></label>
												<input type="text" id="commercial" name="name" class="form-control shadow-none rounded" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
										</div>
										<div class="col-12 mt-3">
											@if (checkAction(Auth::id(), 'general__setting-commercial_terrain', 'create') || role() == 's_admin')
												<button type="submit" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2">{{ __('Create') }}</button>
											@else
												<button type="button" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Create') }}</button>
											@endif
										</div>
										<div class="col-12" >
											<div class="table-responsive simple-bar">
												<table class="table database-table w-100 mb-0">
													<thead class="database-table__header">
														<tr>
															<th>{{ __('Serial') }}</th>
															<th>Nom</th>
															<th class="text-center">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body">
														@foreach ($commercial_terrain as $commercial)
															<tr>
																<td>{{ $loop->iteration }}</td>
																<td>{{ $commercial->name }}</td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if (checkAction(Auth::id(), 'general__setting-commercial_terrain', 'edit') || role() == 's_admin')
																				<button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#commercial_edit{{ $commercial->id }}">
																					<span class="novecologie-icon-edit mr-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@else
																				<button  type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@endif
																			@if (checkAction(Auth::id(), 'general__setting-commercial_terrain', 'delete') || role() == 's_admin')
																				<button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#commercial_delete{{ $commercial->id }}">
																					<span class="novecologie-icon-trash mr-1"></span>
																						Supprimer
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																						Supprimer
																				</button>
																			@endif
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
								</form>
							</div>
							{{-- <div class="tab-pane fade" id="v-pills-status_planning_study" role="tabpanel" aria-labelledby="v-pills-status_planning_study-tab">
								<form action="{{ route('status.study.create') }}" class="setting-form" id="generalInfoFormtravaux" method="POST">
									@csrf
									<div class="row">
										<div class="col-12">
											<h3 class="mb-4">Statut Planning Etude</h3>
											<div class="form-group">
												<label class="form-label" for="status_planning_study">Nom<span class="text-danger">*</span></label>
												<input type="text" id="status_planning_study" name="name" class="form-control shadow-none rounded" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
										</div>
										<div class="col-12 mt-3">
											@if (checkAction(Auth::id(), 'general__setting-status_planning_etude', 'create') || role() == 's_admin')
												<button type="submit" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2">{{ __('Create') }}</button>
											@else
												<button type="button" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Create') }}</button>
											@endif
										</div>
										<div class="col-12" >
											<div class="table-responsive simple-bar">
												<table class="table database-table w-100 mb-0">
													<thead class="database-table__header">
														<tr>
															<th>{{ __('Serial') }}</th>
															<th>Nom</th>
															<th class="text-center">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body">
														@foreach ($all_status_planning_study as $status_planning_study)
															<tr>
																<td>{{ $loop->iteration }}</td>
																<td>{{ $status_planning_study->name }}</td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if (checkAction(Auth::id(), 'general__setting-status_planning_etude', 'edit') || role() == 's_admin')
																			<button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#status_planning_study_edit{{ $status_planning_study->id }}">
																				<span class="novecologie-icon-edit mr-1"></span>
																				{{ __('Edit') }}
																			</button>
																			@else
																				<button  type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@endif
																			@if (checkAction(Auth::id(), 'general__setting-status_planning_etude', 'delete') || role() == 's_admin')
																				<button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#status_planning_study_delete{{ $status_planning_study->id }}">
																					<span class="novecologie-icon-trash mr-1"></span>
																						Supprimer
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																						Supprimer
																				</button>
																			@endif
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
								</form>
							</div> --}}
							{{-- <div class="tab-pane fade" id="v-pills-technician_study" role="tabpanel" aria-labelledby="v-pills-technician_study-tab">
								<form action="{{ route('technician.study.create') }}" class="setting-form" id="generalInfoFormtravaux" method="POST">
									@csrf
									<div class="row">
										<div class="col-12">
											<h3 class="mb-4">Technicien Etude</h3>
											<div class="form-group">
												<label class="form-label" for="technician_study">Nom<span class="text-danger">*</span></label>
												<input type="text" id="technician_study" name="name" class="form-control shadow-none rounded" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
										</div>
										<div class="col-12 mt-3">
											@if (checkAction(Auth::id(), 'general__setting-technicien_etude', 'create') || role() == 's_admin')
												<button type="submit" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2">{{ __('Create') }}</button>
											@else
												<button type="button" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Create') }}</button>
											@endif
										</div>
										<div class="col-12" >
											<div class="table-responsive simple-bar">
												<table class="table database-table w-100 mb-0">
													<thead class="database-table__header">
														<tr>
															<th>{{ __('Serial') }}</th>
															<th>Nom</th>
															<th class="text-center">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body">
														@foreach (\App\Models\CRM\TechnicianStudy::all() as $technician_study)
															<tr>
																<td>{{ $loop->iteration }}</td>
																<td>{{ $technician_study->name }}</td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if (checkAction(Auth::id(), 'general__setting-technicien_etude', 'edit') || role() == 's_admin')
																				<button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#technician_study_edit{{ $technician_study->id }}">
																					<span class="novecologie-icon-edit mr-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@else
																				<button  type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@endif
																			@if (checkAction(Auth::id(), 'general__setting-technicien_etude', 'delete') || role() == 's_admin')
																				<button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#technician_study_delete{{ $technician_study->id }}">
																					<span class="novecologie-icon-trash mr-1"></span>
																						Supprimer
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																						Supprimer
																				</button>
																			@endif
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
								</form>
							</div> --}}

							<div class="tab-pane fade" id="v-pills-technical_referee" role="tabpanel" aria-labelledby="v-pills-technical_referee-tab">
								<form action="{{ route('technical.referee.create') }}" class="setting-form" id="generalInfoFormtravaux" method="POST">
									@csrf
									<div class="row">
										<div class="col-12">
											<h3 class="mb-4">Réfèrent technique </h3>
											<div class="form-group">
												<label class="form-label" for="technical_referee">Nom<span class="text-danger">*</span></label>
												<input type="text" id="technical_referee" name="name" class="form-control shadow-none rounded" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
										</div>
										<div class="col-12 mt-3">
											@if (checkAction(Auth::id(), 'general__setting-referent_technique', 'create') || role() == 's_admin')
												<button type="submit" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2">{{ __('Create') }}</button>
											@else
												<button type="button" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Create') }}</button>
											@endif
										</div>
										<div class="col-12" >
											<div class="table-responsive simple-bar">
												<table class="table database-table w-100 mb-0">
													<thead class="database-table__header">
														<tr>
															<th>{{ __('Serial') }}</th>
															<th>Nom</th>
															<th class="text-center">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body">
														@foreach ($technical_referees as $technical_referee)
															<tr>
																<td>{{ $loop->iteration }}</td>
																<td>{{ $technical_referee->name }}</td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if (checkAction(Auth::id(), 'general__setting-referent_technique', 'edit') || role() == 's_admin')
																				<button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#technical_referee_edit{{ $technical_referee->id }}">
																					<span class="novecologie-icon-edit mr-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@else
																				<button  type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@endif
																			@if (checkAction(Auth::id(), 'general__setting-referent_technique', 'delete') || role() == 's_admin')
																				<button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#technical_referee_delete{{ $technical_referee->id }}">
																					<span class="novecologie-icon-trash mr-1"></span>
																						Supprimer
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																						Supprimer
																				</button>
																			@endif
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
								</form>
							</div>
							{{-- <div class="tab-pane fade" id="v-pills-status_feasibility_study" role="tabpanel" aria-labelledby="v-pills-status_feasibility_study-tab">
								<form action="{{ route('feasibility.study.create') }}" class="setting-form" id="generalInfoFormtravaux" method="POST">
									@csrf
									<div class="row">
										<div class="col-12">
											<h3 class="mb-4">Statut Faisabilité Etude </h3>
											<div class="form-group">
												<label class="form-label" for="status_feasibility_study">Nom<span class="text-danger">*</span></label>
												<input type="text" id="status_feasibility_study" name="name" class="form-control shadow-none rounded" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
										</div>
										<div class="col-12 mt-3">
											@if (checkAction(Auth::id(), 'general__setting-status_faisabilite_etude', 'create') || role() == 's_admin')
												<button type="submit" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2">{{ __('Create') }}</button>
											@else
												<button type="button" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Create') }}</button>
											@endif
										</div>
										<div class="col-12" >
											<div class="table-responsive simple-bar">
												<table class="table database-table w-100 mb-0">
													<thead class="database-table__header">
														<tr>
															<th>{{ __('Serial') }}</th>
															<th>Nom</th>
															<th class="text-center">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body">
														@foreach (\App\Models\CRM\StatusFeasibilityStudy::all() as $status_feasibility_study)
															<tr>
																<td>{{ $loop->iteration }}</td>
																<td>{{ $status_feasibility_study->name }}</td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if (checkAction(Auth::id(), 'general__setting-status_faisabilite_etude', 'edit') || role() == 's_admin')
																				<button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#status_feasibility_study_edit{{ $status_feasibility_study->id }}">
																					<span class="novecologie-icon-edit mr-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@else
																				<button  type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@endif
																			@if (checkAction(Auth::id(), 'general__setting-status_faisabilite_etude', 'delete') || role() == 's_admin')
																				<button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#status_feasibility_study_delete{{ $status_feasibility_study->id }}">
																					<span class="novecologie-icon-trash mr-1"></span>
																					Supprimer
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																						Supprimer
																				</button>
																			@endif
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
								</form>
							</div> --}}
							{{-- <div class="tab-pane fade" id="v-pills-status_planning_previsite" role="tabpanel" aria-labelledby="v-pills-status_planning_previsite-tab">
								<form action="{{ route('status.previsite.create') }}" class="setting-form" id="generalInfoFormtravaux" method="POST">
									@csrf
									<div class="row">
										<div class="col-12">
											<h3 class="mb-4">Statut Planning previsite</h3>
											<div class="form-group">
												<label class="form-label" for="status_planning_previsite">Nom<span class="text-danger">*</span></label>
												<input type="text" id="status_planning_previsite" name="name" class="form-control shadow-none rounded" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
										</div>
										<div class="col-12 mt-3">
											@if (checkAction(Auth::id(), 'general__setting-status_planning_previsite', 'create') || role() == 's_admin')
												<button type="submit" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2">{{ __('Create') }}</button>
											@else
												<button type="button" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Create') }}</button>
											@endif
										</div>
										<div class="col-12" >
											<div class="table-responsive simple-bar">
												<table class="table database-table w-100 mb-0">
													<thead class="database-table__header">
														<tr>
															<th>{{ __('Serial') }}</th>
															<th>Nom</th>
															<th class="text-center">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body">
														@foreach (\App\Models\CRM\StatusPlanningPrevisite::all() as $status_planning_previsite)
															<tr>
																<td>{{ $loop->iteration }}</td>
																<td>{{ $status_planning_previsite->name }}</td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if (checkAction(Auth::id(), 'general__setting-status_planning_previsite', 'edit') || role() == 's_admin')
																				<button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#status_planning_previsite_edit{{ $status_planning_previsite->id }}">
																					<span class="novecologie-icon-edit mr-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@else
																				<button  type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@endif
																			@if (checkAction(Auth::id(), 'general__setting-status_planning_previsite', 'delete') || role() == 's_admin')
																				<button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#status_planning_previsite_delete{{ $status_planning_previsite->id }}">
																					<span class="novecologie-icon-trash mr-1"></span>
																						Supprimer
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																						Supprimer
																				</button>
																			@endif
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
								</form>
							</div> --}}
							{{-- <div class="tab-pane fade" id="v-pills-technician_previsite" role="tabpanel" aria-labelledby="v-pills-technician_previsite-tab">
								<form action="{{ route('technician.previsite.create') }}" class="setting-form" id="generalInfoFormtravaux" method="POST">
									@csrf
									<div class="row">
										<div class="col-12">
											<h3 class="mb-4">Technicien previsite</h3>
											<div class="form-group">
												<label class="form-label" for="technician_previsite">Nom<span class="text-danger">*</span></label>
												<input type="text" id="technician_previsite" name="name" class="form-control shadow-none rounded" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
										</div>
										<div class="col-12 mt-3">
											@if (checkAction(Auth::id(), 'general__setting-technicien_previsite', 'create') || role() == 's_admin')
												<button type="submit" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2">{{ __('Create') }}</button>
											@else
												<button type="button" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2"><span class="novecologie-icon-lock py-1"></span>  {{ __('Create') }}</button>
											@endif
										</div>
										<div class="col-12" >
											<div class="table-responsive simple-bar">
												<table class="table database-table w-100 mb-0">
													<thead class="database-table__header">
														<tr>
															<th>{{ __('Serial') }}</th>
															<th>Nom</th>
															<th class="text-center">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body">
														@foreach (\App\Models\CRM\TechnicianPrevisite::all() as $technician_previsite)
															<tr>
																<td>{{ $loop->iteration }}</td>
																<td>{{ $technician_previsite->name }}</td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if (checkAction(Auth::id(), 'general__setting-technicien_previsite', 'edit') || role() == 's_admin')
																				<button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#technician_previsite_edit{{ $technician_previsite->id }}">
																					<span class="novecologie-icon-edit mr-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@else
																				<button  type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@endif
																			@if (checkAction(Auth::id(), 'general__setting-technicien_previsite', 'delete') || role() == 's_admin')
																				<button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#technician_previsite_delete{{ $technician_previsite->id }}">
																					<span class="novecologie-icon-trash mr-1"></span>
																						Supprimer
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																						Supprimer
																				</button>
																			@endif
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
								</form>
							</div> --}}
							{{-- <div class="tab-pane fade" id="v-pills-status_previsite" role="tabpanel" aria-labelledby="v-pills-status_previsite-tab">
								<form action="{{ route('previsite.status.create') }}" class="setting-form" id="generalInfoFormtravaux" method="POST">
									@csrf
									<div class="row">
										<div class="col-12">
											<h3 class="mb-4">Statut Prévisite</h3>
											<div class="form-group">
												<label class="form-label" for="status_previsite">Nom<span class="text-danger">*</span></label>
												<input type="text" id="status_previsite" name="name" class="form-control shadow-none rounded" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
										</div>
										<div class="col-12 mt-3">
											@if (checkAction(Auth::id(), 'general__setting-status_previsite', 'create') || role() == 's_admin')
												<button type="submit" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2">{{ __('Create') }}</button>
											@else
												<button type="button" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Create') }}</button>
											@endif
										</div>
										<div class="col-12" >
											<div class="table-responsive simple-bar">
												<table class="table database-table w-100 mb-0">
													<thead class="database-table__header">
														<tr>
															<th>{{ __('Serial') }}</th>
															<th>Nom</th>
															<th class="text-center">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body">
														@foreach (\App\Models\CRM\StatusPrevisite::all() as $status_previsite)
															<tr>
																<td>{{ $loop->iteration }}</td>
																<td>{{ $status_previsite->name }}</td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if (checkAction(Auth::id(), 'general__setting-status_previsite', 'edit') || role() == 's_admin')
																				<button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#status_previsite_edit{{ $status_previsite->id }}">
																					<span class="novecologie-icon-edit mr-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@else
																				<button  type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@endif
																			@if (checkAction(Auth::id(), 'general__setting-status_previsite', 'delete') || role() == 's_admin')
																				<button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#status_previsite_delete{{ $status_previsite->id }}">
																					<span class="novecologie-icon-trash mr-1"></span>
																						Supprimer
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																						Supprimer
																				</button>
																			@endif
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
								</form>
							</div>  --}}
							{{-- <div class="tab-pane fade" id="v-pills-status_feasibility_previsite" role="tabpanel" aria-labelledby="v-pills-status_feasibility_previsite-tab">
								<form action="{{ route('feasibility.previsite.create') }}" class="setting-form" id="generalInfoFormtravaux" method="POST">
									@csrf
									<div class="row">
										<div class="col-12">
											<h3 class="mb-4">Statut Faisabilité Prévisite</h3>
											<div class="form-group">
												<label class="form-label" for="status_feasibility_previsite">Nom<span class="text-danger">*</span></label>
												<input type="text" id="status_feasibility_previsite" name="name" class="form-control shadow-none rounded" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
										</div>
										<div class="col-12 mt-3">
											@if (checkAction(Auth::id(), 'general__setting-status_faisabilite_previsite', 'create') || role() == 's_admin')
												<button type="submit" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2">{{ __('Create') }}</button>
											@else
												<button type="button" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Create') }}</button>
											@endif
										</div>
										<div class="col-12" >
											<div class="table-responsive simple-bar">
												<table class="table database-table w-100 mb-0">
													<thead class="database-table__header">
														<tr>
															<th>{{ __('Serial') }}</th>
															<th>Nom</th>
															<th class="text-center">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body">
														@foreach (\App\Models\CRM\StatusFeasibilityPrevisite::all() as $status_feasibility_previsite)
															<tr>
																<td>{{ $loop->iteration }}</td>
																<td>{{ $status_feasibility_previsite->name }}</td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if (checkAction(Auth::id(), 'general__setting-status_faisabilite_previsite', 'edit') || role() == 's_admin')
																				<button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#status_feasibility_previsite_edit{{ $status_feasibility_previsite->id }}">
																					<span class="novecologie-icon-edit mr-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@else
																				<button  type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@endif
																			@if (checkAction(Auth::id(), 'general__setting-status_faisabilite_previsite', 'delete') || role() == 's_admin')
																				<button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#status_feasibility_previsite_delete{{ $status_feasibility_previsite->id }}">
																					<span class="novecologie-icon-trash mr-1"></span>
																						Supprimer
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																						Supprimer
																				</button>
																			@endif
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
								</form>
							</div>  --}}
							{{-- <div class="tab-pane fade" id="v-pills-status_planning_counter" role="tabpanel" aria-labelledby="v-pills-status_planning_counter-tab">
								<form action="{{ route('status.planning.counter.visit.create') }}" class="setting-form" id="generalInfoFormtravaux" method="POST">
									@csrf
									<div class="row">
										<div class="col-12">
											<h3 class="mb-4">Statut Planning Contre Visite</h3>
											<div class="form-group">
												<label class="form-label" for="status_planning_counter">Nom<span class="text-danger">*</span></label>
												<input type="text" id="status_planning_counter" name="name" class="form-control shadow-none rounded" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
										</div>
										<div class="col-12 mt-3">
											@if (checkAction(Auth::id(), 'general__setting-status_planning_contre_visit', 'create') || role() == 's_admin')
												<button type="submit" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2">{{ __('Create') }}</button>
											@else
												<button type="button" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Create') }}</button>
											@endif
										</div>
										<div class="col-12" >
											<div class="table-responsive simple-bar">
												<table class="table database-table w-100 mb-0">
													<thead class="database-table__header">
														<tr>
															<th>{{ __('Serial') }}</th>
															<th>Nom</th>
															<th class="text-center">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body">
														@foreach (\App\Models\CRM\StatusPlanningCounterVisit::all() as $status_planning_counter)
															<tr>
																<td>{{ $loop->iteration }}</td>
																<td>{{ $status_planning_counter->name }}</td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if (checkAction(Auth::id(), 'general__setting-status_planning_contre_visit', 'edit') || role() == 's_admin')
																				<button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#status_planning_counter_edit{{ $status_planning_counter->id }}">
																					<span class="novecologie-icon-edit mr-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@else
																				<button  type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@endif
																			@if (checkAction(Auth::id(), 'general__setting-status_planning_contre_visit', 'delete') || role() == 's_admin')
																				<button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#status_planning_counter_delete{{ $status_planning_counter->id }}">
																					<span class="novecologie-icon-trash mr-1"></span>
																						Supprimer
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																						Supprimer
																				</button>
																			@endif
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
								</form>
							</div>  --}}
							{{-- <div class="tab-pane fade" id="v-pills-technician_planning_counter" role="tabpanel" aria-labelledby="v-pills-technician_planning_counter-tab">
								<form action="{{ route('technician.counter.visit.create') }}" class="setting-form" id="generalInfoFormtravaux" method="POST">
									@csrf
									<div class="row">
										<div class="col-12">
											<h3 class="mb-4">Technicien Contre visite </h3>
											<div class="form-group">
												<label class="form-label" for="technician_planning_counter">Nom<span class="text-danger">*</span></label>
												<input type="text" id="technician_planning_counter" name="name" class="form-control shadow-none rounded" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
										</div>
										<div class="col-12 mt-3">
											@if (checkAction(Auth::id(), 'general__setting-technicien_contre_visite', 'create') || role() == 's_admin')
												<button type="submit" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2">{{ __('Create') }}</button>
											@else
												<button type="button" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Create') }}</button>
											@endif
										</div>
										<div class="col-12" >
											<div class="table-responsive simple-bar">
												<table class="table database-table w-100 mb-0">
													<thead class="database-table__header">
														<tr>
															<th>{{ __('Serial') }}</th>
															<th>Nom</th>
															<th class="text-center">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body">
														@foreach (\App\Models\CRM\TechnicianCounterVisit::all() as $technician_planning_counter)
															<tr>
																<td>{{ $loop->iteration }}</td>
																<td>{{ $technician_planning_counter->name }}</td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if (checkAction(Auth::id(), 'general__setting-technicien_contre_visite', 'edit') || role() == 's_admin')
																				<button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#technician_planning_counter_edit{{ $technician_planning_counter->id }}">
																					<span class="novecologie-icon-edit mr-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@else
																				<button  type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@endif
																			@if (checkAction(Auth::id(), 'general__setting-technicien_contre_visite', 'delete') || role() == 's_admin')
																				<button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#technician_planning_counter_delete{{ $technician_planning_counter->id }}">
																					<span class="novecologie-icon-trash mr-1"></span>
																						Supprimer
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																						Supprimer
																				</button>
																			@endif
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
								</form>
							</div>  --}}
							{{-- <div class="tab-pane fade" id="v-pills-status_counter" role="tabpanel" aria-labelledby="v-pills-status_counter-tab">
								<form action="{{ route('status.counter.visit.create') }}" class="setting-form" id="generalInfoFormtravaux" method="POST">
									@csrf
									<div class="row">
										<div class="col-12">
											<h3 class="mb-4">Statut Contre visite </h3>
											<div class="form-group">
												<label class="form-label" for="status_counter">Nom<span class="text-danger">*</span></label>
												<input type="text" id="status_counter" name="name" class="form-control shadow-none rounded" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
										</div>
										<div class="col-12 mt-3">
											@if (checkAction(Auth::id(), 'general__setting-status_contre_visite', 'create') || role() == 's_admin')
												<button type="submit" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2">{{ __('Create') }}</button>
											@else
												<button type="button" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Create') }}</button>
											@endif
										</div>
										<div class="col-12" >
											<div class="table-responsive simple-bar">
												<table class="table database-table w-100 mb-0">
													<thead class="database-table__header">
														<tr>
															<th>{{ __('Serial') }}</th>
															<th>Nom</th>
															<th class="text-center">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body">
														@foreach (\App\Models\CRM\StatusCounterVisit::all() as $status_counter)
															<tr>
																<td>{{ $loop->iteration }}</td>
																<td>{{ $status_counter->name }}</td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if (checkAction(Auth::id(), 'general__setting-status_contre_visite', 'edit') || role() == 's_admin')
																				<button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#status_counter_edit{{ $status_counter->id }}">
																					<span class="novecologie-icon-edit mr-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@else
																				<button  type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@endif
																			@if (checkAction(Auth::id(), 'general__setting-status_contre_visite', 'delete') || role() == 's_admin')
																				<button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#status_counter_delete{{ $status_counter->id }}">
																					<span class="novecologie-icon-trash mr-1"></span>
																						Supprimer
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																						Supprimer
																				</button>
																			@endif
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
								</form>
							</div>  --}}
							{{-- <div class="tab-pane fade" id="v-pills-status_feasibility_counter" role="tabpanel" aria-labelledby="v-pills-status_feasibility_counter-tab">
								<form action="{{ route('status.feasibility.counter.visit.create') }}" class="setting-form" id="generalInfoFormtravaux" method="POST">
									@csrf
									<div class="row">
										<div class="col-12">
											<h3 class="mb-4">Statut Faisabilité contre visite </h3>
											<div class="form-group">
												<label class="form-label" for="status_feasibility_counter">Nom<span class="text-danger">*</span></label>
												<input type="text" id="status_feasibility_counter" name="name" class="form-control shadow-none rounded" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
										</div>
										<div class="col-12 mt-3">
											@if (checkAction(Auth::id(), 'general__setting-status_faisabilite_contre_visite', 'create') || role() == 's_admin')
											<button type="submit" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2">{{ __('Create') }}</button>
											@else
											<button type="button" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Create') }}</button>
											@endif
										</div>
										<div class="col-12" >
											<div class="table-responsive simple-bar">
												<table class="table database-table w-100 mb-0">
													<thead class="database-table__header">
														<tr>
															<th>{{ __('Serial') }}</th>
															<th>Nom</th>
															<th class="text-center">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body">
														@foreach (\App\Models\CRM\StatusFeasibilityCounterVisit::all() as $status_feasibility_counter)
															<tr>
																<td>{{ $loop->iteration }}</td>
																<td>{{ $status_feasibility_counter->name }}</td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if (checkAction(Auth::id(), 'general__setting-status_faisabilite_contre_visite', 'edit') || role() == 's_admin')
																				<button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#status_feasibility_counter_edit{{ $status_feasibility_counter->id }}">
																					<span class="novecologie-icon-edit mr-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@else
																				<button  type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@endif
																			@if (checkAction(Auth::id(), 'general__setting-status_faisabilite_contre_visite', 'delete') || role() == 's_admin')
																				<button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#status_feasibility_counter_delete{{ $status_feasibility_counter->id }}">
																					<span class="novecologie-icon-trash mr-1"></span>
																						Supprimer
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																						Supprimer
																				</button>
																			@endif
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
								</form>
							</div>  --}}
							{{-- <div class="tab-pane fade" id="v-pills-status_planning_installation" role="tabpanel" aria-labelledby="v-pills-status_planning_installation-tab">
								<form action="{{ route('status.planning.installation.create') }}" class="setting-form" id="generalInfoFormtravaux" method="POST">
									@csrf
									<div class="row">
										<div class="col-12">
											<h3 class="mb-4">Statut Planning Installation </h3>
											<div class="form-group">
												<label class="form-label" for="status_planning_installation">Nom<span class="text-danger">*</span></label>
												<input type="text" id="status_planning_installation" name="name" class="form-control shadow-none rounded" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
										</div>
										<div class="col-12 mt-3">
											@if (checkAction(Auth::id(), 'general__setting-status_planning_installation', 'create') || role() == 's_admin')
												<button type="submit" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2">{{ __('Create') }}</button>
											@else
												<button type="button" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Create') }}</button>
											@endif
										</div>
										<div class="col-12" >
											<div class="table-responsive simple-bar">
												<table class="table database-table w-100 mb-0">
													<thead class="database-table__header">
														<tr>
															<th>{{ __('Serial') }}</th>
															<th>Nom</th>
															<th class="text-center">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body">
														@foreach (\App\Models\CRM\StatusPlanningInstallation::all() as $status_planning_installation)
															<tr>
																<td>{{ $loop->iteration }}</td>
																<td>{{ $status_planning_installation->name }}</td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if (checkAction(Auth::id(), 'general__setting-status_planning_installation', 'edit') || role() == 's_admin')
																				<button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#status_planning_installation_edit{{ $status_planning_installation->id }}">
																					<span class="novecologie-icon-edit mr-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@else
																				<button  type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@endif
																			@if (checkAction(Auth::id(), 'general__setting-status_planning_installation', 'delete') || role() == 's_admin')
																				<button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#status_planning_installation_delete{{ $status_planning_installation->id }}">
																					<span class="novecologie-icon-trash mr-1"></span>
																						Supprimer
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																						Supprimer
																				</button>
																			@endif
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
								</form>
							</div>  --}}
							{{-- <div class="tab-pane fade" id="v-pills-status_planning_sav" role="tabpanel" aria-labelledby="v-pills-status_planning_sav-tab">
								<form action="{{ route('status.planning.sav.create') }}" class="setting-form" id="generalInfoFormtravaux" method="POST">
									@csrf
									<div class="row">
										<div class="col-12">
											<h3 class="mb-4">Statut Planning SAV </h3>
											<div class="form-group">
												<label class="form-label" for="status_planning_sav">Nom<span class="text-danger">*</span></label>
												<input type="text" id="status_planning_sav" name="name" class="form-control shadow-none rounded" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
										</div>
										<div class="col-12 mt-3">
											@if (checkAction(Auth::id(), 'general__setting-status_planning_sav', 'create') || role() == 's_admin')
												<button type="submit" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2">{{ __('Create') }}</button>
											@else
												<button type="button" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Create') }}</button>
											@endif
										</div>
										<div class="col-12" >
											<div class="table-responsive simple-bar">
												<table class="table database-table w-100 mb-0">
													<thead class="database-table__header">
														<tr>
															<th>{{ __('Serial') }}</th>
															<th>Nom</th>
															<th class="text-center">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body">
														@foreach (\App\Models\CRM\StatusPlanningSav::all() as $status_planning_sav)
															<tr>
																<td>{{ $loop->iteration }}</td>
																<td>{{ $status_planning_sav->name }}</td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if (checkAction(Auth::id(), 'general__setting-status_planning_sav', 'edit') || role() == 's_admin')
																				<button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#status_planning_sav_edit{{ $status_planning_sav->id }}">
																					<span class="novecologie-icon-edit mr-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@else
																				<button  type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@endif
																			@if (checkAction(Auth::id(), 'general__setting-status_planning_sav', 'delete') || role() == 's_admin')
																				<button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#status_planning_sav_delete{{ $status_planning_sav->id }}">
																					<span class="novecologie-icon-trash mr-1"></span>
																						Supprimer
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																						Supprimer
																				</button>
																			@endif
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
								</form>
							</div>  --}}
							{{-- <div class="tab-pane fade" id="v-pills-technician_sav" role="tabpanel" aria-labelledby="v-pills-technician_sav-tab">
								<form action="{{ route('technician.sav.create') }}" class="setting-form" id="generalInfoFormtravaux" method="POST">
									@csrf
									<div class="row">
										<div class="col-12">
											<h3 class="mb-4">Technicien SAV </h3>
											<div class="form-group">
												<label class="form-label" for="technician_sav">Nom<span class="text-danger">*</span></label>
												<input type="text" id="technician_sav" name="name" class="form-control shadow-none rounded" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
										</div>
										<div class="col-12 mt-3">
											@if (checkAction(Auth::id(), 'general__setting-techninien_sav', 'create') || role() == 's_admin')
												<button type="submit" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2">{{ __('Create') }}</button>
											@else
												<button type="button" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Create') }}</button>
											@endif
										</div>
										<div class="col-12" >
											<div class="table-responsive simple-bar">
												<table class="table database-table w-100 mb-0">
													<thead class="database-table__header">
														<tr>
															<th>{{ __('Serial') }}</th>
															<th>Nom</th>
															<th class="text-center">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body">
														@foreach (\App\Models\CRM\TechnicianSav::all() as $technician_sav)
															<tr>
																<td>{{ $loop->iteration }}</td>
																<td>{{ $technician_sav->name }}</td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if (checkAction(Auth::id(), 'general__setting-techninien_sav', 'edit') || role() == 's_admin')
																				<button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#technician_sav_edit{{ $technician_sav->id }}">
																					<span class="novecologie-icon-edit mr-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@else
																				<button  type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@endif
																			@if (checkAction(Auth::id(), 'general__setting-techninien_sav', 'delete') || role() == 's_admin')
																				<button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#technician_sav_delete{{ $technician_sav->id }}">
																					<span class="novecologie-icon-trash mr-1"></span>
																						Supprimer
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																						Supprimer
																				</button>
																			@endif
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
								</form>
							</div>  --}}
							{{-- <div class="tab-pane fade" id="v-pills-status_resolution_sav" role="tabpanel" aria-labelledby="v-pills-status_resolution_sav-tab">
								<form action="{{ route('status.resolution.sav.create') }}" class="setting-form" id="generalInfoFormtravaux" method="POST">
									@csrf
									<div class="row">
										<div class="col-12">
											<h3 class="mb-4">Statut Resolution SAV</h3>
											<div class="form-group">
												<label class="form-label" for="status_resolution_sav">Nom<span class="text-danger">*</span></label>
												<input type="text" id="status_resolution_sav" name="name" class="form-control shadow-none rounded" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
										</div>
										<div class="col-12 mt-3">
											@if (checkAction(Auth::id(), 'general__setting-status_resolution_sav', 'create') || role() == 's_admin')
												<button type="submit" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2">{{ __('Create') }}</button>
											@else
												<button type="button" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Create') }}</button>
											@endif
										</div>
										<div class="col-12" >
											<div class="table-responsive simple-bar">
												<table class="table database-table w-100 mb-0">
													<thead class="database-table__header">
														<tr>
															<th>{{ __('Serial') }}</th>
															<th>Nom</th>
															<th class="text-center">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body">
														@foreach (\App\Models\CRM\StatusResolutionSav::all() as $status_resolution_sav)
															<tr>
																<td>{{ $loop->iteration }}</td>
																<td>{{ $status_resolution_sav->name }}</td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if (checkAction(Auth::id(), 'general__setting-status_resolution_sav', 'edit') || role() == 's_admin')
																				<button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#status_resolution_sav_edit{{ $status_resolution_sav->id }}">
																					<span class="novecologie-icon-edit mr-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@else
																				<button  type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@endif
																			@if (checkAction(Auth::id(), 'general__setting-status_resolution_sav', 'delete') || role() == 's_admin')
																				<button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#status_resolution_sav_delete{{ $status_resolution_sav->id }}">
																					<span class="novecologie-icon-trash mr-1"></span>
																						Supprimer
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																						Supprimer
																				</button>
																			@endif
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
								</form>
							</div>  --}}
							{{-- <div class="tab-pane fade" id="v-pills-status_planning_deplacement" role="tabpanel" aria-labelledby="v-pills-status_planning_deplacement-tab">
								<form action="{{ route('status.planning.deplacement.create') }}" class="setting-form" id="generalInfoFormtravaux" method="POST">
									@csrf
									<div class="row">
										<div class="col-12">
											<h3 class="mb-4">Statut Planning Deplacement</h3>
											<div class="form-group">
												<label class="form-label" for="status_planning_deplacement">Nom<span class="text-danger">*</span></label>
												<input type="text" id="status_planning_deplacement" name="name" class="form-control shadow-none rounded" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
										</div>
										<div class="col-12 mt-3">
											@if (checkAction(Auth::id(), 'general__setting-status_planning_deplacement', 'create') || role() == 's_admin')
												<button type="submit" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2">{{ __('Create') }}</button>
											@else
												<button type="button" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Create') }}</button>
											@endif
										</div>
										<div class="col-12" >
											<div class="table-responsive simple-bar">
												<table class="table database-table w-100 mb-0">
													<thead class="database-table__header">
														<tr>
															<th>{{ __('Serial') }}</th>
															<th>Nom</th>
															<th class="text-center">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body">
														@foreach (\App\Models\CRM\StatusPlanningDeplacement::all() as $status_planning_deplacement)
															<tr>
																<td>{{ $loop->iteration }}</td>
																<td>{{ $status_planning_deplacement->name }}</td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if (checkAction(Auth::id(), 'general__setting-status_planning_deplacement', 'edit') || role() == 's_admin')
																				<button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#status_planning_deplacement_edit{{ $status_planning_deplacement->id }}">
																					<span class="novecologie-icon-edit mr-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@else
																				<button  type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@endif
																			@if (checkAction(Auth::id(), 'general__setting-status_planning_deplacement', 'delete') || role() == 's_admin')
																				<button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#status_planning_deplacement_delete{{ $status_planning_deplacement->id }}">
																					<span class="novecologie-icon-trash mr-1"></span>
																						Supprimer
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																						Supprimer
																				</button>
																			@endif
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
								</form>
							</div>  --}}
							<div class="tab-pane fade" id="v-pills-ticket_problem_status" role="tabpanel" aria-labelledby="v-pills-ticket_problem_status-tab">
								<form action="{{ route('ticket.problem.create') }}" class="setting-form" id="generalInfoFormtravaux" method="POST">
									@csrf
									<div class="row">
										<div class="col-12">
											<h3 class="mb-4">Type de problème</h3>
											<div class="form-group">
												<label class="form-label" for="probleme">probleme<span class="text-danger">*</span></label>
												<input type="text" id="probleme" name="name" class="form-control shadow-none rounded" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
											<div class="form-group">
												<label class="form-label" for="deadline">Echeance resolution ticket<span class="text-danger">*</span></label>
												<div class="input-group">
													<input type="number" id="deadline" name="deadline" class="form-control shadow-none rounded" required>
													<div class="input-group-append">
													  <span class="input-group-text">jours</span>
													</div>
												</div>
											</div>
											<div class="form-group">
												<label class="form-label" for="ticketType"> Type de ticket <span class="text-danger">*</span></label>
												<select class="custom-select shadow-none form-control" id="ticketType" name="ticket_type" required>
													<option value="Administratif">Administratif</option>
													<option value="Technique">Technique</option>
													<option value="Financier">Financier</option>
												</select>
												<div class="invalid-feedback">{{ __('This field in necessary') }}</div>
											</div>
										</div>
										<div class="col-12 mt-3">
											@if (checkAction(Auth::id(), 'general__setting-status_du_probleme_ticket', 'create') || role() == 's_admin')
												<button type="submit" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2">{{ __('Create') }}</button>
											@else
												<button type="button" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Create') }}</button>
											@endif
										</div>
										<div class="col-12" >
											<div class="table-responsive simple-bar">
												<table class="table database-table w-100 mb-0">
													<thead class="database-table__header">
														<tr>
															<th>{{ __('Serial') }}</th>
															<th>Probleme</th>
															<th>Echeance Resolution Ticket</th>
															<th>Type</th>
															<th class="text-center">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body">
														@foreach (\App\Models\CRM\TicketProblemStatus::all() as $ticket_problem_status)
															<tr>
																<td>{{ $loop->iteration }}</td>
																<td>{{ $ticket_problem_status->name }}</td>
																<td>{{ $ticket_problem_status->deadline }}</td>
																<td>{{ $ticket_problem_status->ticket_type }}</td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if (checkAction(Auth::id(), 'general__setting-status_du_probleme_ticket', 'edit') || role() == 's_admin')
																				<button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#ticket_problem_status_edit{{ $ticket_problem_status->id }}">
																					<span class="novecologie-icon-edit mr-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@else
																				<button  type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@endif
																			@if (checkAction(Auth::id(), 'general__setting-status_du_probleme_ticket', 'delete') || role() == 's_admin')
																				<button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#ticket_problem_status_delete{{ $ticket_problem_status->id }}">
																					<span class="novecologie-icon-trash mr-1"></span>
																						Supprimer
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																						Supprimer
																				</button>
																			@endif
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
								</form>
							</div>
							<div class="tab-pane fade" id="v-pills-energy_type" role="tabpanel" aria-labelledby="v-pills-energy_type-tab">
								<form action="{{ route('energy.type.create') }}" class="setting-form" id="generalInfoFormtravaux" method="POST">
									@csrf
									<div class="row">
										<div class="col-12">
											<h3 class="mb-4">Type énergie Chaud.</h3>
											<div class="form-group">
												<label class="form-label" for="title1">Titre<span class="text-danger">*</span></label>
												<input type="text" id="title1" name="title" class="form-control shadow-none rounded" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
											<div class="form-group">
												<label class="form-label" for="devis_text">Texte de Devis<span class="text-danger">*</span></label>
												<textarea id="devis_text" name="devis_text" class="form-control shadow-none rounded" required></textarea>
											</div>
										</div>
										<div class="col-12 mt-3">
											@if (checkAction(Auth::id(), 'general__setting-type_energie_chaud', 'create') || role() == 's_admin')
												<button type="submit" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2">{{ __('Create') }}</button>
											@else
												<button type="button" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2"> <span class="novecologie-icon-lock py-1"></span> {{ __('Create') }}</button>
											@endif
										</div>
										<div class="col-12" >
											<div class="table-responsive simple-bar">
												<table class="table database-table w-100 mb-0">
													<thead class="database-table__header">
														<tr>
															<th>{{ __('Serial') }}</th>
															<th>Titre</th>
															<th>Texte de Devis</th>
															<th class="text-center">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body">
														@foreach (\App\Models\CRM\EnergyType::all() as $energy_type)
															<tr>
																<td>{{ $loop->iteration }}</td>
																<td>{{ $energy_type->title }}</td>
																<td>{{ $energy_type->devis_text }}</td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if (checkAction(Auth::id(), 'general__setting-type_energie_chaud', 'edit') || role() == 's_admin')
																				<button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#energy_type_edit{{ $energy_type->id }}">
																					<span class="novecologie-icon-edit mr-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@else
																				<button  type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@endif
																			@if (checkAction(Auth::id(), 'general__setting-type_energie_chaud', 'delete') || role() == 's_admin')
																				<button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#energy_type_delete{{ $energy_type->id }}">
																					<span class="novecologie-icon-trash mr-1"></span>
																						Supprimer
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																						Supprimer
																				</button>
																			@endif
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
								</form>
							</div>
							<div class="tab-pane fade" id="v-pills-prestation_group" role="tabpanel" aria-labelledby="v-pills-prestation_group-tab">
								<form action="{{ route('prestation.group.create') }}" class="setting-form" id="generalInfoFormtravaux" method="POST">
									@csrf
									<div class="row">
										<div class="col-12">
											<h3 class="mb-4">{{ __('Prestations group') }}</h3>
											<div class="form-group">
												<label class="form-label" for="prestation_code">Code<span class="text-danger">*</span></label>
												<input type="text" id="prestation_code" name="code" value="{{ old('code') }}" class="form-control shadow-none rounded" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
											<div class="form-group">
												<label class="form-label" for="prestation_product_id"> Produits :</label>
												<select name="product_id" id="prestation_product_id"  class="select2_select_option custom-select shadow-none form-control" required>
													  @foreach ($products as $product)
														  <option value="{{ $product->id }}">{{ $product->reference }}</option>
													  @endforeach
												</select>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
											<div id="prestationGroupItem">
												<div class="gruop_item">
													<div class="form-group">
														<label class="form-label" for="prestation_id"> Prestation : <span class="text-danger">*</span></label>
														<select name="prestation_id[]" id="prestation_id"  class="select2_select_option custom-select shadow-none form-control prestationChange" required>
															@foreach ($benefits as $prestation)
																<option data-price="{{ $prestation->price }}" data-quantity="{{ $prestation->quantity }}" data-tax="{{ $prestation->tax }}" value="{{ $prestation->id }}">{{ $prestation->alias }}</option>
															@endforeach
														</select>
														<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
													</div>
													<div class="form-group">
														<label class="form-label" for="prestation_price">Prix de vente<span class="text-danger">*</span></label>
														<input type="number" step="any" id="prestation_price" name="price[]" class="form-control shadow-none rounded prestation_price" required>
														<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
													</div>
													<div class="form-group">
														<label class="form-label" for="prestation_quantity">Quantité<span class="text-danger">*</span></label>
														<input type="number" id="prestation_quantity" name="quantity[]" class="form-control shadow-none rounded prestation_quantity" required>
														<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
													</div>
													<div class="form-group">
														<label class="form-label" for="prestation_tax">Taux TVA</label>
														<select id="prestation_tax" name="tax[]"class="select2_select_option form-control rounded prestation_tax">
															<option value="0">Non spécifiée</option>
															<option value="5.5">Taux réduit à 5,5 %</option>
															<option value="20">Taux normal à 20 %</option>
														</select>
														<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-12 mt-3">
											@if (checkAction(Auth::id(), 'general__setting-prestations_group', 'create') || role() == 's_admin')
											<button type="submit" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2">{{ __('Create') }}</button>
											<button type="button" class="secondary-btn secondary-btn--cuccess border-0 mb-2 mr-2" id="add_more_prestation_btn">{{ __('Add More') }}</button>
											@else
											<button type="button" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Create') }}</button>
											@endif
										</div>
										<div class="col-12" >
											<div class="table-responsive simple-bar">
												<table class="table database-table w-100 mb-0">
													<thead class="database-table__header">
														<tr>
															<th>{{ __('Serial') }}</th>
															<th>Code</th>
															<th>Produits</th>
															<th class="text-center">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body">
														@foreach (\App\Models\CRM\PrestationGroup::all() as $prestation_group)
															<tr>
																<td>{{ $loop->iteration }}</td>
																<td>{{ $prestation_group->code }}</td>
																<td>{{ $prestation_group->getProduct->reference ?? '' }}</td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			<button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#prestation_group_items{{ $prestation_group->id }}">
																				<span class="novecologie-icon-eye mr-1"></span>
																				{{ __('View items') }}
																			</button>
																			@if (checkAction(Auth::id(), 'general__setting-prestations_group', 'edit') || role() == 's_admin')
																				<button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#prestation_group_edit{{ $prestation_group->id }}">
																					<span class="novecologie-icon-edit mr-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@else
																				<button  type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@endif
																			@if (checkAction(Auth::id(), 'general__setting-prestations_group', 'delete') || role() == 's_admin')
																				<button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#prestation_group_delete{{ $prestation_group->id }}">
																					<span class="novecologie-icon-trash mr-1"></span>
																						Supprimer
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																						Supprimer
																				</button>
																			@endif
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
								</form>
							</div>
							<div class="tab-pane fade" id="v-pills-comment_category" role="tabpanel" aria-labelledby="v-pills-comment_category-tab">
								<form action="{{ route('comment.category.add') }}" class="setting-form" id="generalInfoFormtravaux" method="POST">
									@csrf
									<div class="row">
										<div class="col-12">
											<h3 class="mb-4">{{ __('Comment Category') }}</h3>
											<div class="form-group">
												<label class="form-label" for="category_name">{{ __('Name') }} <span class="text-danger">*</span></label>
												<input type="text" id="category_name" name="name" class="form-control shadow-none rounded" placeholder="{{ __('Enter Category Name') }}" required>
												<input type="hidden" id="comment_category_id" name="id" value="0">
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
											<div class="form-group">
												<label class="form-label" for="comment_category_assignee">{{ __('Assignee') }} <span class="text-danger">*</span></label>
												<select name="comment_category_assignee[]" id="comment_category_assignee"  class="select2_select_option custom-select shadow-none form-control" multiple>
													@foreach ($users as $usr)
														<option value="{{ $usr->id }}">{{ $usr->name }}</option>
													@endforeach
												</select>
											</div>

											<div class="form-group">
												<label class="form-label" for="background_color">{{ __('Background Color') }} <span class="text-danger">*</span></label>
												<input type="color" id="background_color" name="background_color" class="form-control shadow-none rounded" placeholder="{{ __('Enter Background Color') }}" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
										</div>
										<div class="col-12 mt-3">
											@if (checkAction(Auth::id(), 'general__setting-comment_category', 'create') || role() == 's_admin')
												<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Submit') }}</button>
											@else
												<button type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">
													<span class="novecologie-icon-lock py-1"></span>
													{{ __('Submit') }}
												</button>
											@endif
										</div>
										<div class="col-12" >
											<div class="table-responsive simple-bar">
												<table class="table database-table w-100 mb-0">
													<thead class="database-table__header">
														<tr>
															<th>{{ __('Serial') }}</th>
															<th>{{ __('Name') }}</th>
															<th>{{ __('Assignee') }}</th>
															<th>{{ __('Background Color') }}</th>
															<th class="text-center">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body">
														@foreach ($comment_categories as $comment_category)
															<tr>
																<td>{{ $loop->iteration }}</td>
																<td>{{ $comment_category->name }}</td>
																<td>
																	<div class="avatar-group d-flex">
																		@if ($comment_category->assignee->count() > 3)
																			@foreach($comment_category->assignee as $assigne_item)
																			<a href="#!" class="avatar-group__image-wrapper rounded-circle overflow-hidden" data-toggle="tooltip" data-placement="top" title="{{ $assigne_item->name }}">
																				@if ($assigne_item->profile_photo)
																				<img  loading="lazy"  src="{{ asset('uploads/crm/profiles') }}/{{ $assigne_item->profile_photo }}" alt="{{ $assigne_item->name }}" class="avatar-group__image w-100 h-100">
																				@else
																				<img  loading="lazy"  src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="avatar image" class="avatar-group__image w-100 h-100">
																				@endif
																			</a>
																			@if ($loop->iteration > 3)
																				@if ($comment_category->assignee->count() > 4)
																				<a href="#!" class="avatar-group__more">+{{ $comment_category->assignee->count() - 4 }} {{ __('more') }}</a>
																				@endif
																				@break
																			@endif
																			@endforeach
																		@else
																			@forelse ($comment_category->assignee as $assignee_item)
																			<a href="#!" class="avatar-group__image-wrapper rounded-circle overflow-hidden" data-toggle="tooltip" data-placement="top" title="{{ $assignee_item->name }}">
																				@if ($assignee_item->profile_photo)
																				<img  loading="lazy"  src="{{ asset('uploads/crm/profiles') }}/{{ $assignee_item->profile_photo }}" alt="{{ $assignee_item->name }}" class="avatar-group__image w-100 h-100">
																				@else
																				<img  loading="lazy"  src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="avatar image" class="avatar-group__image w-100 h-100">
																				@endif
																			</a>
																			@empty
																			{{ __('No assignee') }}
																			@endforelse
																		@endif
																	</div>
																</td>
																<td style="background-color: {{ $comment_category->background_color }}"></td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if (checkAction(Auth::id(), 'general__setting-comment_category', 'edit') || role() == 's_admin')
																				<button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#comment_category_edit{{ $comment_category->id }}">
																					<span class="novecologie-icon-edit mr-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@else
																				<button  type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@endif
																			@if (checkAction(Auth::id(), 'general__setting-comment_category', 'delete') || role() == 's_admin')
																				<button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#comment_category_delete{{ $comment_category->id }}">
																					<span class="novecologie-icon-trash mr-1"></span>
																						Supprimer
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																						Supprimer
																				</button>
																			@endif
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
								</form>
							</div>
							<div class="tab-pane fade" id="v-pills-quality_control" role="tabpanel" aria-labelledby="v-pills-quality_control-tab">
								<form action="{{ route('quality.control.create') }}" class="setting-form" id="qualityControlTypeForm" method="POST">
									@csrf
									<div class="row">
										<div class="col-12">
											<h3 class="mb-4">Contrôle Qualité</h3>
											<div class="form-group">
												<label class="form-label" for="quality_controle_name">Contrôle Qualité <span class="text-danger">*</span></label>
												<input type="text" id="quality_controle_name" name="name" class="form-control shadow-none rounded" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
											<div id="addMoreQuestion__qc">
												{{-- <div class="form-group">
													<label class="form-label" for="label_title__qc">{{ __('Question') }} <span class="text-danger">*</span></label>
													<input type="text" name="label_title[]" id="label_title__qc" class="form-control shadow-none qc_question_title">
												</div>
												<div class="form-group">
													<label class="form-label" for="input_type__qc">{{ __('Select Input Type') }} <span class="text-danger">*</span></label>
													<select name="input_type[]" id="input_type__qc"  class="select2_select_option custom-select shadow-none form-control">
														<option value="text">{{ __('Text') }}</option>
														<option value="number">{{ __('Number') }}</option>
														<option value="email">{{ __('Email') }}</option>
														<option value="radio">{{ __('Radio') }}</option>
														<option value="checkbox">{{ __('Checkbox') }}</option>
														<option value="select">{{ __('Dropdown') }}</option>
														<option value="textarea">{{ __('Textarea') }}</option>
													</select>
												</div>
												<div class="form-group">
													<label class="form-label" for="required_optional__qc">{{ __('Required/Optional') }} <span class="text-danger">*</span></label>
													<select name="required_optional[]" id="required_optional__qc"  class="select2_select_option custom-select shadow-none form-control">
														<option value="no">{{ __('Optional') }}</option>
														<option value="yes">{{ __('Required') }}</option>
													</select>
												</div>
												<div class="form-group">
													<label class="form-label" for="options__qc">{{ __('Options') }}</label>
													<textarea name="options[]" id="options__qc" class="form-control shadow-none" placeholder="{{ __('Enter Options. Each option seperate with comma ,') }}"></textarea>
												</div> --}}
											</div>
										</div>
										<div class="col-12 mt-3">
											@if (checkAction(Auth::id(), 'general__setting-quality_control', 'create') || role() == 's_admin')
												<button type="button" id="qualityControlBtn" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2">{{ __('Submit') }}</button>
												<button type="button" class="secondary-btn secondary-btn--cuccess border-0 mb-2 mr-2" id="add_more_question_btn__qc">nouvelle question</button>
												<button id="add_more_header" type="button" class="secondary-btn secondary-btn--cuccess border-0 mb-2 mr-2">
													<span class="mr-2"></span>
													+ {{ __('Add Headers') }}
												</button>
											@else
												<button type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Submit') }}</button>
											@endif
										</div>
										<div class="col-12" >
											<div class="table-responsive">
												<table class="table database-table w-100 mb-0">
													<thead class="database-table__header">
														<tr>
															<th>{{ __('Serial') }}</th>
															<th>Contrôle Qualité</th>
															<th class="text-center">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body">
														@foreach ($quality_controls as $quality_control)
															<tr>
																<td>{{ $loop->iteration }}</td>
																<td>{{ $quality_control->name }}</td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-boundary="viewport">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if (checkAction(Auth::id(), 'general__setting-quality_control', 'edit') || role() == 's_admin')
																				<button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#quality_control_edit{{ $quality_control->id }}">
																					<span class="novecologie-icon-edit mr-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@else
																				<button  type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@endif
																			@if (checkAction(Auth::id(), 'general__setting-quality_control', 'view') || role() == 's_admin')
																				<button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#quality_control_view{{ $quality_control->id }}">
																					<span class="novecologie-icon-eye mr-1"></span>
																					{{ __('View') }}
																				</button>
																			@else
																				<button  type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('View') }}
																				</button>
																			@endif
																			@if (checkAction(Auth::id(), 'general__setting-quality_control', 'delete') || role() == 's_admin')
																				<button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#quality_control_delete{{ $quality_control->id }}">
																					<span class="novecologie-icon-trash mr-1"></span>
																						Supprimer
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																						Supprimer
																				</button>
																			@endif

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
								</form>
							</div>
							<div class="tab-pane fade" id="v-pills-notion_category" role="tabpanel" aria-labelledby="v-pills-notion_category-tab">
								<form action="{{ route('notion.category.create') }}" class="setting-form" method="POST">
									@csrf
									<div class="row">
										<div class="col-12">
											<h3 class="mb-4">Notion Catégorie</h3>
											<div class="form-group">
												<label class="form-label" for="notion_categorye_name">Nom<span class="text-danger">*</span></label>
												<input type="text" id="notion_categorye_name" name="name" class="form-control shadow-none rounded" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
											<div class="form-group">
												<label class="form-label" for="notion_categorys_order">Order</label>
												<input type="number" id="notion_categorys_order" name="order" class="form-control shadow-none rounded">
											</div>
										</div>
										<div class="col-12 mt-3">
											@if (checkAction(Auth::id(), 'general__setting-notion_category', 'create') || role() == 's_admin')
												<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2">{{ __('Submit') }}</button>
											@else
												<button type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Submit') }}</button>
											@endif
										</div>
										<div class="col-12" >
											<div class="table-responsive">
												<table class="table database-table w-100 mb-0">
													<thead class="database-table__header">
														<tr>
															<th>{{ __('Serial') }}</th>
															<th>Nom</th>
															<th>Order</th>
															<th class="text-center">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body">
														@foreach ($notion_categories as $notion_category)
															<tr>
																<td>{{ $loop->iteration }}</td>
																<td>{{ $notion_category->name }}</td>
																<td>{{ $notion_category->order }}</td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-boundary="viewport">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if (checkAction(Auth::id(), 'general__setting-notion_category', 'edit') || role() == 's_admin')
																				<button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#notion_category_edit{{ $notion_category->id }}">
																					<span class="novecologie-icon-edit mr-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@else
																				<button  type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@endif
																			@if (checkAction(Auth::id(), 'general__setting-notion_category', 'delete') || role() == 's_admin')
																				<button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#notion_category_delete{{ $notion_category->id }}">
																					<span class="novecologie-icon-trash mr-1"></span>
																						Supprimer
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																						Supprimer
																				</button>
																			@endif

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
								</form>
							</div>
							<div class="tab-pane fade" id="v-pills-notion_sub_category" role="tabpanel" aria-labelledby="v-pills-notion_sub_category-tab">
								<form action="{{ route('notion.subcategory.create') }}" class="setting-form" method="POST">
									@csrf
									<div class="row">
										<div class="col-12">
											<h3 class="mb-4">Notion Sous Catégorie</h3>
											<div class="form-group">
												<label class="form-label" for="notion_sub_categorye_name">Nom<span class="text-danger">*</span></label>
												<input type="text" id="notion_sub_categorye_name" name="name" class="form-control shadow-none rounded" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
										</div>
										<div class="col-12">
											<div class="form-group">
												<label class="form-label" for="notion_sub_categorye_category_id">Catégorie<span class="text-danger">*</span></label>
												<select name="category" id="notion_sub_categorye_category_id"  class="select2_select_option custom-select shadow-none form-control" required>
													<option value="" selected>{{ __('Select') }}</option>
													@foreach ($notion_categories as $category)
														<option value="{{ $category->id }}">{{ $category->name }}</option>
													@endforeach
												</select>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
										</div>
										<div class="col-12">
											<div class="form-group">
												<label class="form-label" for="notion_sub_categorye_order">Order</label>
												<input type="number" id="notion_sub_categorye_order" name="order" class="form-control shadow-none rounded">
											</div>
										</div>
										<div class="col-12 mt-3">
											@if (checkAction(Auth::id(), 'general__setting-notion_sub_category', 'create') || role() == 's_admin')
												<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2">{{ __('Submit') }}</button>
											@else
												<button type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Submit') }}</button>
											@endif
										</div>
										<div class="col-12" >
											<div class="table-responsive">
												<table class="table database-table w-100 mb-0">
													<thead class="database-table__header">
														<tr>
															<th>{{ __('Serial') }}</th>
															<th>Nom</th>
															<th>Catégorie</th>
															<th>Order</th>
															<th class="text-center">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body">
														@foreach ($notion_subcategories as $notion_sub_category)
															<tr>
																<td>{{ $loop->iteration }}</td>
																<td>{{ $notion_sub_category->name }}</td>
																<td>{{ $notion_sub_category->getCategory->name ?? '' }}</td>
																<td>{{ $notion_sub_category->order }}</td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-boundary="viewport">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if (checkAction(Auth::id(), 'general__setting-notion_sub_category', 'edit') || role() == 's_admin')
																				<button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#notion_sub_category_edit{{ $notion_sub_category->id }}">
																					<span class="novecologie-icon-edit mr-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@else
																				<button  type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@endif
																			@if (checkAction(Auth::id(), 'general__setting-notion_sub_category', 'delete') || role() == 's_admin')
																				<button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#notion_sub_category_delete{{ $notion_sub_category->id }}">
																					<span class="novecologie-icon-trash mr-1"></span>
																						Supprimer
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																						Supprimer
																				</button>
																			@endif

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
								</form>
							</div>
							<div class="tab-pane fade" id="v-pills-lead_sub_status" role="tabpanel" aria-labelledby="v-pills-lead_sub_status-tab">
								<form action="{{ route('lead.sub-status.create') }}" class="setting-form" method="POST">
									@csrf
									<div class="row">
										<div class="col-12">
											<h3 class="mb-4">Sous statut prospect</h3>
											<div class="form-group">
												<label class="form-label" for="lead_sub_statuse_name">Nom<span class="text-danger">*</span></label>
												<input type="text" id="lead_sub_statuse_name" name="name" class="form-control shadow-none rounded" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
											<div class="form-group">
												<label class="form-label" for="lead_sub_statuse_background_color">Couleur de fond<span class="text-danger">*</span></label>
												<input type="color" id="lead_sub_statuse_background_color" name="background_color" class="form-control shadow-none rounded" value="#8e27b3" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
											<div class="form-group">
												<label class="form-label" for="lead_sub_statuse_text_color">Couleur du texte<span class="text-danger">*</span></label>
												<input type="color" id="lead_sub_statuse_text_color" name="text_color" class="form-control shadow-none rounded" value="#ffffff" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
											<div class="form-group">
												<label class="form-label" for="lead_sub_statuse_order">Order</label>
												<input type="number" id="lead_sub_statuse_order" name="order" class="form-control shadow-none rounded" value="#ffffff">
											</div>
										</div>
										<div class="col-12 mt-3">
											@if (checkAction(Auth::id(), 'general__setting-lead_sub_status', 'create') || role() == 's_admin')
												<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2">{{ __('Submit') }}</button>
											@else
												<button type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Submit') }}</button>
											@endif
										</div>
										<div class="col-12" >
											<div class="table-responsive">
												<table class="table database-table w-100 mb-0">
													<thead class="database-table__header">
														<tr>
															<th>{{ __('Serial') }}</th>
															<th>Nom</th>
															<th>Prévisualisation</th>
															<th>Order</th>
															<th class="text-center">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body">
														@foreach ($lead_sub_statuses as $lead_sub_status)
															<tr>
																<td>{{ $loop->iteration }}</td>
																<td>{{ $lead_sub_status->name }}</td>
																<td><span class="rounded-pill" style="background-color: {{ $lead_sub_status->background_color }}; color: {{ $lead_sub_status->text_color }} ; padding:10px 30px"> {{ $lead_sub_status->name }}</span></td>
																<td>{{ $lead_sub_status->order }}</td>
																<td>
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-boundary="viewport">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if ($lead_sub_status->id == 5)
																				<button  type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					Non modifiable
																				</button>
																			@else
																				@if (checkAction(Auth::id(), 'general__setting-lead_sub_status', 'edit') || role() == 's_admin')
																					<button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#lead_sub_status_edit{{ $lead_sub_status->id }}">
																						<span class="novecologie-icon-edit mr-1"></span>
																						{{ __('Edit') }}
																					</button>
																				@else
																					<button  type="button" class="dropdown-item border-0">
																						<span class="novecologie-icon-lock py-1"></span>
																						{{ __('Edit') }}
																					</button>
																				@endif
																				@if (checkAction(Auth::id(), 'general__setting-lead_sub_status', 'delete') || role() == 's_admin')
																					<button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#lead_sub_status_delete{{ $lead_sub_status->id }}">
																						<span class="novecologie-icon-trash mr-1"></span>
																							Supprimer
																					</button>
																				@else
																					<button type="button" class="dropdown-item border-0">
																						<span class="novecologie-icon-lock py-1"></span>
																							Supprimer
																					</button>
																				@endif
																			@endif

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
								</form>
							</div>
							<div class="tab-pane fade" id="v-pills-project_sub_status" role="tabpanel" aria-labelledby="v-pills-project_sub_status-tab">
								<form action="{{ route('project.sub-status.create') }}" class="setting-form" method="POST">
									@csrf
									<div class="row">
										<div class="col-12">
											<h3 class="mb-4">Sous statut chantier</h3>
											<div class="form-group">
												<label class="form-label" for="project_sub_statuse_name">Nom<span class="text-danger">*</span></label>
												<input type="text" id="project_sub_statuse_name" name="name" class="form-control shadow-none rounded" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
											<div class="form-group">
												<label class="form-label" for="project_sub_statuse_background_color">Couleur de fond<span class="text-danger">*</span></label>
												<input type="color" id="project_sub_statuse_background_color" name="background_color" class="form-control shadow-none rounded" value="#8e27b3" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
											<div class="form-group">
												<label class="form-label" for="project_sub_statuse_text_color">Couleur du texte<span class="text-danger">*</span></label>
												<input type="color" id="project_sub_statuse_text_color" name="text_color" class="form-control shadow-none rounded" value="#ffffff" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
											<div class="form-group">
												<label class="form-label" for="project_sub_statuse_order">Order</label>
												<input type="number" id="project_sub_statuse_order" name="order" class="form-control shadow-none rounded">
											</div>
										</div>
										<div class="col-12 mt-3">
											@if (checkAction(Auth::id(), 'general__setting-project_sub_status', 'create') || role() == 's_admin')
												<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2">{{ __('Submit') }}</button>
											@else
												<button type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Submit') }}</button>
											@endif
										</div>
										<div class="col-12" >
											<div class="table-responsive">
												<table class="table database-table w-100 mb-0">
													<thead class="database-table__header">
														<tr>
															<th>{{ __('Serial') }}</th>
															<th>Nom</th>
															<th>Prévisualisation</th>
															<th>Order</th>
															<th class="text-center">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body">
														@foreach ($project_sub_statuses as $project_sub_status)
															<tr>
																<td>{{ $loop->iteration }}</td>
																<td>{{ $project_sub_status->name }}</td>
																<td><span class="rounded-pill" style="background-color: {{ $project_sub_status->background_color }}; color: {{ $project_sub_status->text_color }} ; padding:10px 30px"> {{ $project_sub_status->name }}</span></td>
																<td>{{ $project_sub_status->order }}</td>
																<td>
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-boundary="viewport">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if ($project_sub_status->id == 5)
																				<button  type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					Non modifiable
																				</button>
																			@else
																				@if (checkAction(Auth::id(), 'general__setting-project_sub_status', 'edit') || role() == 's_admin')
																					<button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#project_sub_status_edit{{ $project_sub_status->id }}">
																						<span class="novecologie-icon-edit mr-1"></span>
																						{{ __('Edit') }}
																					</button>
																				@else
																					<button  type="button" class="dropdown-item border-0">
																						<span class="novecologie-icon-lock py-1"></span>
																						{{ __('Edit') }}
																					</button>
																				@endif
																				@if (checkAction(Auth::id(), 'general__setting-project_sub_status', 'delete') || role() == 's_admin')
																					<button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#project_sub_status_delete{{ $project_sub_status->id }}">
																						<span class="novecologie-icon-trash mr-1"></span>
																							Supprimer
																					</button>
																				@else
																					<button type="button" class="dropdown-item border-0">
																						<span class="novecologie-icon-lock py-1"></span>
																							Supprimer
																					</button>
																				@endif
																			@endif

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
								</form>
							</div>
							<div class="tab-pane fade" id="v-pills-status_planning_intervention" role="tabpanel" aria-labelledby="v-pills-status_planning_intervention-tab">
								<form action="{{ route('status.planning.intervention.create') }}" class="setting-form" method="POST">
									@csrf
									<div class="row">
										<div class="col-12">
											<h3 class="mb-4">Statut planning intervention</h3>
											<div class="form-group">
												<label class="form-label" for="status_planning_interventione_name">Nom<span class="text-danger">*</span></label>
												<input type="text" id="status_planning_interventione_name" name="name" class="form-control shadow-none rounded" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
											<div class="form-group">
												<label class="form-label" for="status_planning_interventione_color">Color<span class="text-danger">*</span></label>
												<input type="color" id="status_planning_interventione_color" name="color" value="#000000" class="form-control shadow-none rounded" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
											<div class="form-group">
												<label class="form-label" for="status_planning_interventione_background">Background Color<span class="text-danger">*</span></label>
												<input type="color" id="status_planning_interventione_background" value="#ffffff" name="background_color" class="form-control shadow-none rounded" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
										</div>
										<div class="col-12 mt-3">
											@if (checkAction(Auth::id(), 'general__setting-status_planning_intervention', 'create') || role() == 's_admin')
												<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2">{{ __('Submit') }}</button>
											@else
												<button type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Submit') }}</button>
											@endif
										</div>
										<div class="col-12" >
											<div class="table-responsive">
												<table class="table database-table w-100 mb-0">
													<thead class="database-table__header">
														<tr>
															<th>{{ __('Serial') }}</th>
															<th>Nom</th>
															<th class="text-center">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body">
														@foreach ($status_interventions as $status_planning_intervention)
															<tr>
																<td>{{ $loop->iteration }}</td>
																<td style="color: {{ $status_planning_intervention->color }};background-color: {{ $status_planning_intervention->background_color }}">
																	{{ $status_planning_intervention->name }}</td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-boundary="viewport">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if (checkAction(Auth::id(), 'general__setting-status_planning_intervention', 'edit') || role() == 's_admin')
																				<button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#status_planning_intervention_edit{{ $status_planning_intervention->id }}">
																					<span class="novecologie-icon-edit mr-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@else
																				<button  type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@endif
																			@if (checkAction(Auth::id(), 'general__setting-status_planning_intervention', 'delete') || role() == 's_admin')
																				<button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#status_planning_intervention_delete{{ $status_planning_intervention->id }}">
																					<span class="novecologie-icon-trash mr-1"></span>
																						Supprimer
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																						Supprimer
																				</button>
																			@endif

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
								</form>
							</div>
							<div class="tab-pane fade" id="v-pills-project_ko_reason" role="tabpanel" aria-labelledby="v-pills-project_ko_reason-tab">
								<form action="{{ route('project.ko.reason.create') }}" class="setting-form" method="POST">
									@csrf
									<div class="row">
										<div class="col-12">
											<h3 class="mb-4">Chantiers KO - Raisons</h3>
											<div class="form-group">
												<label class="form-label" for="project_ko_reasone_name">Nom<span class="text-danger">*</span></label>
												<input type="text" id="project_ko_reasone_name" name="name" class="form-control shadow-none rounded" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
										</div>
										<div class="col-12 mt-3">
											@if (checkAction(Auth::id(), 'general__setting-project_ko_reason', 'create') || role() == 's_admin')
												<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2">{{ __('Submit') }}</button>
											@else
												<button type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Submit') }}</button>
											@endif
										</div>
										<div class="col-12" >
											<div class="table-responsive">
												<table class="table database-table w-100 mb-0">
													<thead class="database-table__header">
														<tr>
															<th>{{ __('Serial') }}</th>
															<th>Nom</th>
															<th class="text-center">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body">
														@foreach ($project_ko_reasons as $project_ko_reason)
															<tr>
																<td>{{ $loop->iteration }}</td>
																<td>{{ $project_ko_reason->name }}</td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-boundary="viewport">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if (checkAction(Auth::id(), 'general__setting-project_ko_reason', 'edit') || role() == 's_admin')
																				<button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#project_ko_reason_edit{{ $project_ko_reason->id }}">
																					<span class="novecologie-icon-edit mr-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@else
																				<button  type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@endif
																			@if (checkAction(Auth::id(), 'general__setting-project_ko_reason', 'delete') || role() == 's_admin')
																				<button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#project_ko_reason_delete{{ $project_ko_reason->id }}">
																					<span class="novecologie-icon-trash mr-1"></span>
																						Supprimer
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																						Supprimer
																				</button>
																			@endif

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
								</form>
							</div>
							<div class="tab-pane fade" id="v-pills-project_reflection_reason" role="tabpanel" aria-labelledby="v-pills-project_reflection_reason-tab">
								<form action="{{ route('project.reflection.reason.create') }}" class="setting-form" method="POST">
									@csrf
									<div class="row">
										<div class="col-12">
											<h3 class="mb-4">Chantiers Reflexion - Raisons</h3>
											<div class="form-group">
												<label class="form-label" for="project_reflection_reasone_name">Nom<span class="text-danger">*</span></label>
												<input type="text" id="project_reflection_reasone_name" name="name" class="form-control shadow-none rounded" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
										</div>
										<div class="col-12 mt-3">
											@if (checkAction(Auth::id(), 'general__setting-project_reflection_reason', 'create') || role() == 's_admin')
												<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2">{{ __('Submit') }}</button>
											@else
												<button type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Submit') }}</button>
											@endif
										</div>
										<div class="col-12" >
											<div class="table-responsive">
												<table class="table database-table w-100 mb-0">
													<thead class="database-table__header">
														<tr>
															<th>{{ __('Serial') }}</th>
															<th>Nom</th>
															<th class="text-center">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body">
														@foreach ($project_reflection_reasons as $project_reflection_reason)
															<tr>
																<td>{{ $loop->iteration }}</td>
																<td>{{ $project_reflection_reason->name }}</td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-boundary="viewport">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if (checkAction(Auth::id(), 'general__setting-project_reflection_reason', 'edit') || role() == 's_admin')
																				<button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#project_reflection_reason_edit{{ $project_reflection_reason->id }}">
																					<span class="novecologie-icon-edit mr-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@else
																				<button  type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@endif
																			@if (checkAction(Auth::id(), 'general__setting-project_reflection_reason', 'delete') || role() == 's_admin')
																				<button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#project_reflection_reason_delete{{ $project_reflection_reason->id }}">
																					<span class="novecologie-icon-trash mr-1"></span>
																						Supprimer
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																						Supprimer
																				</button>
																			@endif

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
								</form>
							</div>
							<div class="tab-pane fade" id="v-pills-statut_maprimerenov" role="tabpanel" aria-labelledby="v-pills-statut_maprimerenov-tab">
								<form action="{{ route('statut.maprimerenov.create') }}" class="setting-form" method="POST">
									@csrf
									<div class="row">
										<div class="col-12">
											<h3 class="mb-4">Statut MaPrimeRénov</h3>
											<div class="form-group">
												<label class="form-label" for="statut_maprimerenove_name">Nom<span class="text-danger">*</span></label>
												<input type="text" id="statut_maprimerenove_name" name="name" class="form-control shadow-none rounded" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
											<div class="form-group">
												<label class="form-label" for="statut_maprimerenove_order">Order</label>
												<input type="number" id="statut_maprimerenove_order" name="order" class="form-control shadow-none rounded">
											</div>
										</div>
										<div class="col-12 mt-3">
											@if (checkAction(Auth::id(), 'general__setting-statut_maprimerenov', 'create') || role() == 's_admin')
												<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2">{{ __('Submit') }}</button>
											@else
												<button type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Submit') }}</button>
											@endif
										</div>
										<div class="col-12" >
											<div class="table-responsive">
												<table class="table database-table w-100 mb-0">
													<thead class="database-table__header">
														<tr>
															<th>{{ __('Serial') }}</th>
															<th>Nom</th>
															<th>Order</th>
															<th class="text-center">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body">
														@foreach ($statut_maprimerenovs as $statut_maprimerenov)
															<tr>
																<td>{{ $loop->iteration }}</td>
																<td>{{ $statut_maprimerenov->name }}</td>
																<td>{{ $statut_maprimerenov->order }}</td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-boundary="viewport">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if (checkAction(Auth::id(), 'general__setting-statut_maprimerenov', 'edit') || role() == 's_admin')
																				<button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#statut_maprimerenov_edit{{ $statut_maprimerenov->id }}">
																					<span class="novecologie-icon-edit mr-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@else
																				<button  type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@endif
																			@if (checkAction(Auth::id(), 'general__setting-statut_maprimerenov', 'delete') || role() == 's_admin')
																				<button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#statut_maprimerenov_delete{{ $statut_maprimerenov->id }}">
																					<span class="novecologie-icon-trash mr-1"></span>
																						Supprimer
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																						Supprimer
																				</button>
																			@endif

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
								</form>
							</div>
							<div class="tab-pane fade" id="v-pills-reject_reason" role="tabpanel" aria-labelledby="v-pills-reject_reason-tab">
								<form action="{{ route('reject.reason.create') }}" class="setting-form" method="POST">
									@csrf
									<div class="row">
										<div class="col-12">
											<h3 class="mb-4">Motif rejet</h3>
											<div class="form-group">
												<label class="form-label" for="reject_reasone_name">Nom<span class="text-danger">*</span></label>
												<input type="text" id="reject_reasone_name" name="name" class="form-control shadow-none rounded" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
										</div>
										<div class="col-12 mt-3">
											@if (checkAction(Auth::id(), 'general__setting-reject_reason', 'create') || role() == 's_admin')
												<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2">{{ __('Submit') }}</button>
											@else
												<button type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Submit') }}</button>
											@endif
										</div>
										<div class="col-12" >
											<div class="table-responsive">
												<table class="table database-table w-100 mb-0">
													<thead class="database-table__header">
														<tr>
															<th>{{ __('Serial') }}</th>
															<th>Nom</th>
															<th class="text-center">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body">
														@foreach ($reject_reasons as $reject_reason)
															<tr>
																<td>{{ $loop->iteration }}</td>
																<td>{{ $reject_reason->name }}</td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-boundary="viewport">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if (checkAction(Auth::id(), 'general__setting-reject_reason', 'edit') || role() == 's_admin')
																				<button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#reject_reason_edit{{ $reject_reason->id }}">
																					<span class="novecologie-icon-edit mr-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@else
																				<button  type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@endif
																			@if (checkAction(Auth::id(), 'general__setting-reject_reason', 'delete') || role() == 's_admin')
																				<button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#reject_reason_delete{{ $reject_reason->id }}">
																					<span class="novecologie-icon-trash mr-1"></span>
																						Supprimer
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																						Supprimer
																				</button>
																			@endif

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
								</form>
							</div>
							<div class="tab-pane fade" id="v-pills-type_fournisseur" role="tabpanel" aria-labelledby="v-pills-type_fournisseur-tab">
								<form action="{{ route('type.fournisseur.create') }}" class="setting-form" method="POST">
									@csrf
									<div class="row">
										<div class="col-12">
											<h3 class="mb-4">Type de fournisseur</h3>
											<div class="form-group">
												<label class="form-label" for="type_fournisseure_name">Nom<span class="text-danger">*</span></label>
												<input type="text" id="type_fournisseure_name" name="name" class="form-control shadow-none rounded" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
										</div>
										<div class="col-12 mt-3">
											@if (checkAction(Auth::id(), 'general__setting-type_fournisseur', 'create') || role() == 's_admin')
												<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2">{{ __('Submit') }}</button>
											@else
												<button type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Submit') }}</button>
											@endif
										</div>
										<div class="col-12" >
											<div class="table-responsive">
												<table class="table database-table w-100 mb-0">
													<thead class="database-table__header">
														<tr>
															<th>{{ __('Serial') }}</th>
															<th>Nom</th>
															<th class="text-center">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body">
														@foreach ($type_fournisseurs as $type_fournisseur)
															<tr>
																<td>{{ $loop->iteration }}</td>
																<td>{{ $type_fournisseur->name }}</td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-boundary="viewport">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if (checkAction(Auth::id(), 'general__setting-type_fournisseur', 'edit') || role() == 's_admin')
																				<button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#type_fournisseur_edit{{ $type_fournisseur->id }}">
																					<span class="novecologie-icon-edit mr-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@else
																				<button  type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@endif
																			@if (checkAction(Auth::id(), 'general__setting-type_fournisseur', 'delete') || role() == 's_admin')
																				<button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#type_fournisseur_delete{{ $type_fournisseur->id }}">
																					<span class="novecologie-icon-trash mr-1"></span>
																						Supprimer
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																						Supprimer
																				</button>
																			@endif

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
								</form>
							</div>
							<div class="tab-pane fade" id="v-pills-color_user" role="tabpanel" aria-labelledby="v-pills-color_user-tab">
								<div class="row">
									<div class="col-12">
										<h3 class="mb-4 pt-3 pl-3">Couleur utilisateur</h3>
									</div>

									<div class="col-12" >
										<div class="table-responsive">
											<table class="table database-table w-100 mb-0">
												<thead class="database-table__header">
													<tr>
														<th>{{ __('Serial') }}</th>
														<th>{{ __("Name") }}</th>
														<th>Prévisualisation</th>
														<th class="text-center">{{ __('Action') }}</th>
													</tr>
												</thead>
												<tbody class="database-table__body">
													@foreach ($color_users as $color_user)
														<tr>
															<td>{{ $loop->iteration }}</td>
															<td>{{ $color_user->name }}</td>
															<td><span class="rounded-pill" style="background-color: {{ $color_user->background_color }}; color: {{ $color_user->color }} ; padding:10px 30px"> {{ $color_user->name }}</span></td>
															<td class="text-center">
																<div class="dropdown dropdown--custom p-0 d-inline-block">
																	<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-boundary="viewport">
																		<span class="novecologie-icon-dots-horizontal-triple"></span>
																	</button>
																	<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																		<button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#color_user_edit{{ $color_user->id }}">
																			<span class="novecologie-icon-edit mr-1"></span>
																			{{ __('Edit') }}
																		</button>
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
							<div class="tab-pane fade" id="v-pills-project_control_photo" role="tabpanel" aria-labelledby="v-pills-project_control_photo-tab">
								<form action="{{ route('project.control.photo.create') }}" class="setting-form" method="POST">
									@csrf
									<div class="row">
										<div class="col-12">
											<h3 class="mb-4">Contrôle conformité photo chantier</h3>
											<div class="form-group">
												<label class="form-label" for="project_control_photoe_name">Travaux<span class="text-danger">*</span></label>
												<select name="tag_id" id="project_control_photoe_name"  class="select2_select_option custom-select shadow-none form-control" required>
													<option value="" selected>{{ __('Select') }}</option>
													@foreach ($bareme_travaux_tags as $baremes)
														<option value="{{ $baremes->id }}">{{ $baremes->bareme }}-{{ $baremes->bareme_description }}</option>
													@endforeach
												</select>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
										</div>
										<div class="col-12">
											<div class="form-group">
												<label class="form-label" for="project_control_photoe_name">Nom<span class="text-danger">*</span></label>
												<input type="text" id="project_control_photoe_name" name="name" class="form-control shadow-none rounded" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
										</div>
										<div class="col-12 mt-3">
											@if (checkAction(Auth::id(), 'general__setting-project_control_photo', 'create') || role() == 's_admin')
												<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2">{{ __('Submit') }}</button>
											@else
												<button type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Submit') }}</button>
											@endif
										</div>
										<div class="col-12" >
											<div class="table-responsive">
												<table class="table database-table w-100 mb-0">
													<thead class="database-table__header">
														<tr>
															<th>{{ __('Serial') }}</th>
															<th>Nom</th>
															<th>Tag</th>
															<th class="text-center">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body">
														@foreach ($project_control_photos as $project_control_photo)
															<tr>
																<td>{{ $loop->iteration }}</td>
																<td>{{ $project_control_photo->name }}</td>
																<td>{{ $project_control_photo->getTag->tag ?? '' }}</td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-boundary="viewport">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if (checkAction(Auth::id(), 'general__setting-project_control_photo', 'edit') || role() == 's_admin')
																				<button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#project_control_photo_edit{{ $project_control_photo->id }}">
																					<span class="novecologie-icon-edit mr-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@else
																				<button  type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@endif
																			@if (checkAction(Auth::id(), 'general__setting-project_control_photo', 'delete') || role() == 's_admin')
																				<button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#project_control_photo_delete{{ $project_control_photo->id }}">
																					<span class="novecologie-icon-trash mr-1"></span>
																						Supprimer
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																						Supprimer
																				</button>
																			@endif

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
								</form>
							</div>
							<div class="tab-pane fade" id="v-pills-heating_mode" role="tabpanel" aria-labelledby="v-pills-heating_mode-tab">
								<form action="{{ route('heating.mode.create') }}" class="setting-form" method="POST">
									@csrf
									<div class="row">
										<div class="col-12">
											<h3 class="mb-4">Mode de chauffage</h3>
											<div class="form-group">
												<label class="form-label" for="heating_modee_name">Nom<span class="text-danger">*</span></label>
												<input type="text" id="heating_modee_name" name="name" class="form-control shadow-none rounded" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
										</div>
										<div class="col-12 mt-3">
											@if (checkAction(Auth::id(), 'general__setting-heating_mode', 'create') || role() == 's_admin')
												<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2">{{ __('Submit') }}</button>
											@else
												<button type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Submit') }}</button>
											@endif
										</div>
										<div class="col-12" >
											<div class="table-responsive">
												<table class="table database-table w-100 mb-0">
													<thead class="database-table__header">
														<tr>
															<th>{{ __('Serial') }}</th>
															<th>Nom</th>
															<th class="text-center">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body">
														@foreach ($heatings as $heating_mode)
															<tr>
																<td>{{ $loop->iteration }}</td>
																<td>{{ $heating_mode->name }}</td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-boundary="viewport">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if (checkAction(Auth::id(), 'general__setting-heating_mode', 'edit') || role() == 's_admin')
																				<button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#heating_mode_edit{{ $heating_mode->id }}">
																					<span class="novecologie-icon-edit mr-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@else
																				<button  type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@endif
																			@if (checkAction(Auth::id(), 'general__setting-heating_mode', 'delete') || role() == 's_admin')
																				<button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#heating_mode_delete{{ $heating_mode->id }}">
																					<span class="novecologie-icon-trash mr-1"></span>
																						Supprimer
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																						Supprimer
																				</button>
																			@endif

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
								</form>
							</div>
							<div class="tab-pane fade" id="v-pills-campagne_type" role="tabpanel" aria-labelledby="v-pills-campagne_type-tab">
								<form action="{{ route('campagne.type.create') }}" class="setting-form" method="POST">
									@csrf
									<div class="row">
										<div class="col-12">
											<h3 class="mb-4">Type de campagne</h3>
											<div class="form-group">
												<label class="form-label" for="campagne_typee_name">Nom<span class="text-danger">*</span></label>
												<input type="text" id="campagne_typee_name" name="name" class="form-control shadow-none rounded" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
										</div>
										<div class="col-12 mt-3">
											@if (checkAction(Auth::id(), 'general__setting-campagne_type', 'create') || role() == 's_admin')
												<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2">{{ __('Submit') }}</button>
											@else
												<button type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Submit') }}</button>
											@endif
										</div>
										<div class="col-12" >
											<div class="table-responsive">
												<table class="table database-table w-100 mb-0">
													<thead class="database-table__header">
														<tr>
															<th>{{ __('Serial') }}</th>
															<th>Nom</th>
															<th class="text-center">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body">
														@foreach ($campagnes as $campagne_type)
															<tr>
																<td>{{ $loop->iteration }}</td>
																<td>{{ $campagne_type->name }}</td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-boundary="viewport">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if (checkAction(Auth::id(), 'general__setting-campagne_type', 'edit') || role() == 's_admin')
																				<button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#campagne_type_edit{{ $campagne_type->id }}">
																					<span class="novecologie-icon-edit mr-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@else
																				<button  type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@endif
																			@if (checkAction(Auth::id(), 'general__setting-campagne_type', 'delete') || role() == 's_admin')
																				<button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#campagne_type_delete{{ $campagne_type->id }}">
																					<span class="novecologie-icon-trash mr-1"></span>
																						Supprimer
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																						Supprimer
																				</button>
																			@endif

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
								</form>
							</div>

							<div class="tab-pane fade" id="v-pills-5" role="tabpanel" aria-labelledby="v-pills-5-tab">

									<div class="row">
										<div class="col-12 d-flex align-items-center justify-content-between flex-wrap">
											<h3 class="m-2">Barèmes/Travaux/Tag</h3>
											@if (checkAction(Auth::id(), 'general__setting-baremes', 'create') || role() == 's_admin')
												<button type="button" class="secondary-btn border-0 m-2" data-toggle="modal" data-target="#BarèmesModal">+ {{ __('Add new') }}</button>
											@else
												<button type="button" class="secondary-btn border-0 m-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Add new') }}</button>
											@endif
										</div>
										<div class="col-12">
											<div class="table-responsive simple-bar">
												<table class="table database-table w-100 mb-0 table-bordered">
													<thead class="database-table__header">
														<tr>
															<th class="text-left">
																#
															</th>
															<th>Barèmes</th>
															<th>Travaux</th>
															<th>Tag</th>
															<th>Rank</th>
															<th class="text-center">{{ __('Actions') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body">
														@forelse ($bareme_travaux_tags as $barame_tag)
															<tr>
																<td>{{ $loop->iteration }}</td>
																<td>
																	{{ $barame_tag->rank == '1'? $barame_tag->bareme:"NO CEE" }}
																</td>
																<td>
																	{{ $barame_tag->travaux }}
																</td>
																<td>
																	{{ $barame_tag->tag }}
																</td>
																<td>
																	{{ $barame_tag->rank }}
																</td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if (checkAction(Auth::id(), 'general__setting-baremes', 'edit') || role() == 's_admin')
																				<button data-toggle="modal" data-target="#BarèmesTravauxTagEditModal{{ $barame_tag->id }}" type="button" class="dropdown-item border-0" data-user-id="2">
																					<span class="novecologie-icon-edit mr-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@endif
																			@if (checkAction(Auth::id(), 'general__setting-baremes', 'delete') || role() == 's_admin')
																				<button type="button" data-toggle="modal"   data-target="#BarèmesTravauxTagDeleteModal{{ $barame_tag->id }}" class="dropdown-item border-0">
																					<span class="novecologie-icon-trash mr-1"></span>
																						Supprimer
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																						Supprimer
																				</button>
																			@endif
																		</div>
																	</div>
																</td>
															</tr>
														@empty
														<tr>
															<td colspan="4" class="text-center py-5">
																<span>{{ __('No Item Found') }}</span>
															</td>
														</tr>
														@endforelse
													</tbody>
												</table>
											</div>
										</div>
									</div>
							</div>
							<div class="tab-pane fade" id="v-pills-6" role="tabpanel" aria-labelledby="v-pills-6-tab">

									<div class="row">
										<div class="col-12 d-flex align-items-center justify-content-between flex-wrap">
											<h3 class="m-2">{{ __('Délégataires') }}</h3>
											@if (checkAction(Auth::id(), 'general__setting-delegataires', 'create') || role() == 's_admin')
												<button type="button" class="secondary-btn border-0 m-2" data-toggle="modal" data-target="#DelegatesModal">+ {{ __('Add new') }}</button>
											@else
												<button type="button" class="secondary-btn border-0 m-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Add new') }}</button>
											@endif
										</div>
										<div class="col-12">
											<div class="table-responsive simple-bar">
												<table class="table database-table w-100 mb-0 table-bordered">
													<thead class="database-table__header">
														<tr>
															<th class="text-left">
																<div class="custom-control custom-checkbox">
																	<input value="1" type="checkbox" class="custom-control-input table-all-select-checkbox" id="tableAllSelectCheckss-delegte">
																	<label class="custom-control-label" for="tableAllSelectCheckss-delegte"></label>
																</div>
															</th>
															<th>{{ __('Logo') }}</th>
															<th>{{ __('Raison sociale') }}</th>
															<th>{{ __('Ratio prime bénéficiaire') }}</th>
															<th>{{ __('Ratio prime installateur') }}</th>
															<th class="text-center">{{ __('Actions') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body" style="min-height: 350px">
														@forelse ($delegates as $delegate)
															<tr>
																<td> <div class="custom-control custom-checkbox">
																	<input value="1" type="checkbox""  class="custom-control-input table-select-checkbox" id="tableRowSelectCheckDelegate-{{ $delegate->id }}">
																	<label class="custom-control-label" for="tableRowSelectCheckDelegate-{{ $delegate->id }}"></label>
																</div></td>
																<td>
																	<img  loading="lazy"  src="{{ asset('uploads/delegate') }}/{{ $delegate->logo }}" alt="" width="100" height="100">
																</td>
																<td>
																	{{ $delegate->company_name }}
																</td>
																<td>
																	{{ $delegate->bonus_ratio }}
																</td>
																<td>
																	{{ $delegate->premium_ratio }}
																</td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if (checkAction(Auth::id(), 'general__setting-delegataires', 'edit') || role() == 's_admin')
																				<button data-toggle="modal" data-target="#DelegatesModalEdit{{ $delegate->id }}" type="button" class="dropdown-item border-0" data-user-id="2">
																					<span class="novecologie-icon-edit mr-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@endif
																			@if (checkAction(Auth::id(), 'general__setting-delegataires', 'delete') || role() == 's_admin')
																				<form action="{{ route('delegate.delete') }}" method="post">
																					@csrf
																					<input type="hidden" name="id" value="{{ $delegate->id }}">
																					<button type="submit" class="dropdown-item border-0">
																						<span class="novecologie-icon-trash mr-1"></span>
																							Supprimer
																					</button>
																				</form>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																						Supprimer
																				</button>
																			@endif
																		</div>
																	</div>
																</td>
															</tr>
														@empty
														<tr>
															<td colspan="6" class="text-center py-5">
																<span>{{ __('No Item Found') }}</span>
															</td>
														</tr>
														@endforelse
													</tbody>
												</table>
											</div>
										</div>
									</div>
							</div>
							<div class="tab-pane fade" id="v-pills-7" role="tabpanel" aria-labelledby="v-pills-7-tab">

									<div class="row">
										<div class="col-12 d-flex align-items-center justify-content-between flex-wrap">
											<h3 class="m-2">{{ __('Deals / Tarifs') }}</h3>
											@if (checkAction(Auth::id(), 'general__setting-deals_tarifs', 'create') || role() == 's_admin')
												<button type="button" class="secondary-btn border-0 m-2" data-toggle="modal" data-target="#dealModal">+ {{ __('Add new') }}</button>
											@else
												<button type="button" class="secondary-btn border-0 m-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Add new') }}</button>
											@endif
										</div>
										<div class="col-12">
											<div class="table-responsive simple-bar">
												<table class="table database-table w-100 mb-0 table-bordered">
													<thead class="database-table__header">
														<tr>
															<th class="text-left">
																<div class="custom-control custom-checkbox">
																	<input value="1" type="checkbox" class="custom-control-input table-all-select-checkbox" id="tableAllSelectCheckss-deal">
																	<label class="custom-control-label" for="tableAllSelectCheckss-deal"></label>
																</div>
															</th>
															<th>{{ __('Nom') }}</th>
															<th>{{ __('Délégataire') }}</th>
															<th>{{ __('Version') }}</th>
															<th>{{ __('Volume Cumac') }}</th>
															<th>{{ __('Par défault') }}</th>
															<th>{{ __('Verrouillé') }}</th>
															<th class="text-center">{{ __('Actions') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body" style="min-height: 350px">
														@forelse ($deals as $deal)
															<tr>
																<td> <div class="custom-control custom-checkbox">
																		<input value="1" type="checkbox""  class="custom-control-input table-select-checkbox" id="tableRowSelectCheckDeal-{{ $deal->id }}">
																		<label class="custom-control-label" for="tableRowSelectCheckDeal-{{ $deal->id }}"></label>
																	</div>
																</td>
																<td>
																	{{ $deal->name }}
																</td>
																<td>
																	{{ $deal->delegate }}
																</td>
																<td>
																	{{ $deal->version }}
																</td>
																<td>
																	{{ $deal->volume }}
																</td>
																<td>
																	{{ $deal->default }}
																</td>
																<td>
																	{{ $deal->locked }}
																</td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if (checkAction(Auth::id(), 'general__setting-deals_tarifs', 'edit') || role() == 's_admin')
																				<button data-toggle="modal" data-target="#DealModalEdit{{ $deal->id }}" type="button" class="dropdown-item border-0" data-user-id="2">
																					<span class="novecologie-icon-edit mr-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@endif
																			@if (checkAction(Auth::id(), 'general__setting-deals_tarifs', 'delete') || role() == 's_admin')
																				<form action="{{ route('deal.delete') }}" method="post">
																					@csrf
																					<input type="hidden" name="id" value="{{ $deal->id }}">
																					<button type="submit" class="dropdown-item border-0">
																						<span class="novecologie-icon-trash mr-1"></span>
																							Supprimer
																					</button>
																				</form>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																						Supprimer
																				</button>
																			@endif
																		</div>
																	</div>
																</td>
															</tr>
														@empty
														<tr>
															<td colspan="8" class="text-center py-5">
																<span>{{ __('No Item Found') }}</span>
															</td>
														</tr>
														@endforelse
													</tbody>
												</table>
											</div>
										</div>
									</div>
							</div>
							<div class="tab-pane fade" id="v-pills-8" role="tabpanel" aria-labelledby="v-pills-8-tab">

									<div class="row">
										<div class="col-12 d-flex align-items-center justify-content-between flex-wrap">
											<h3 class="m-2">Entreprise de travaux</h3>
											@if (checkAction(Auth::id(), 'general__setting-installateurs_rge', 'create') || role() == 's_admin')
												<button type="button" class="secondary-btn border-0 m-2" data-toggle="modal" data-target="#installerModal">+ {{ __('Add new') }}</button>
											@else
												<button type="button" class="secondary-btn border-0 m-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Add new') }}</button>
											@endif
										</div>
										<div class="col-12">
											<div class="table-responsive simple-bar">
												<table class="table database-table w-100 mb-0 table-bordered">
													<thead class="database-table__header">
														<tr>
															<th class="text-left">
																<div class="custom-control custom-checkbox">
																	<input value="1" type="checkbox" class="custom-control-input table-all-select-checkbox" id="tableAllSelectCheckss-installer">
																	<label class="custom-control-label" for="tableAllSelectCheckss-installer"></label>
																</div>
															</th>
															<th>{{ __('Logo') }}</th>
															<th>{{ __('Raison sociale') }}</th>
															<th>{{ __('Nom') }}</th>
															<th>{{ __('Prénom') }}</th>
															<th>{{ __('Numéro SIREN') }}</th>
															<th>{{ __('Sous-traitance') }}</th>
															<th>{{ __('Par défault') }}</th>
															<th>{{ __('Activé') }}</th>
															<th class="text-center">{{ __('Actions') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body" style="min-height: 350px">
														@forelse ($installers as $installer)
															<tr>
																<td> <div class="custom-control custom-checkbox">
																		<input value="1" type="checkbox""  class="custom-control-input table-select-checkbox" id="tableRowSelectCheckInstaller-{{ $installer->id }}">
																		<label class="custom-control-label" for="tableRowSelectCheckInstaller-{{ $installer->id }}"></label>
																	</div>
																</td>
																<td>
																	<img  loading="lazy"  src="{{ asset('uploads/installer') }}/{{ $installer->logo }}" alt="" width="100" height="100">
																</td>
																<td>
																	{{ $installer->company_name }}
																</td>
																<td>
																	{{ $installer->name }}
																</td>
																<td>
																	{{ $installer->first_name }}
																</td>
																<td>
																	{{ $installer->number }}
																</td>
																<td>
																	@if ($installer->subcontact == 'Oui')
																		<span class="text-success">&check;</span>
																		@else
																		<span class="text-danger">&times;</span>
																	@endif
																</td>
																<td>
																	@if ($installer->default == 'Oui')
																		<span class="text-success">&check;</span>
																		@else
																		<span class="text-danger">&times;</span>
																	@endif
																</td>
																<td>
																	@if ($installer->active == 'Oui')
																		<span class="text-success">&check;</span>
																		@else
																		<span class="text-danger">&times;</span>
																	@endif
																</td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if (checkAction(Auth::id(), 'general__setting-installateurs_rge', 'edit') || role() == 's_admin')
																				<button data-toggle="modal" data-target="#InstallerModalEdit{{ $installer->id }}" type="button" class="dropdown-item border-0" data-user-id="2">
																					<span class="novecologie-icon-edit mr-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@endif
																			@if (checkAction(Auth::id(), 'general__setting-installateurs_rge', 'delete') || role() == 's_admin')
																				<form action="{{ route('installer.delete') }}" method="post">
																					@csrf
																					<input type="hidden" name="id" value="{{ $installer->id }}">
																					<button type="submit" class="dropdown-item border-0">
																						<span class="novecologie-icon-trash mr-1"></span>
																							Supprimer
																					</button>
																				</form>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																						Supprimer
																				</button>
																			@endif
																		</div>
																	</div>
																</td>
															</tr>
														@empty
														<tr>
															<td colspan="10" class="text-center py-5">
																<span>{{ __('No Item Found') }}</span>
															</td>
														</tr>
														@endforelse
													</tbody>
												</table>
											</div>
										</div>
									</div>
							</div>
							<div class="tab-pane fade" id="v-pills-9" role="tabpanel" aria-labelledby="v-pills-9-tab">

									<div class="row">
										<div class="col-12 d-flex align-items-center justify-content-between flex-wrap">
											<h3 class="m-2">{{ __('AMO') }}</h3>
											@if (checkAction(Auth::id(), 'general__setting-amo', 'create') || role() == 's_admin')
												<button type="button" class="secondary-btn border-0 m-2" data-toggle="modal" data-target="#AMOModal">+ {{ __('Add new') }}</button>
											@else
												<button type="button" class="secondary-btn border-0 m-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Add new') }}</button>
											@endif
										</div>
										<div class="col-12">
											<div class="table-responsive simple-bar">
												<table class="table database-table w-100 mb-0 table-bordered">
													<thead class="database-table__header">
														<tr>
															<th class="text-left">
																<div class="custom-control custom-checkbox">
																	<input value="1" type="checkbox" class="custom-control-input table-all-select-checkbox" id="tableAllSelectCheckss-amo">
																	<label class="custom-control-label" for="tableAllSelectCheckss-amo"></label>
																</div>
															</th>
															<th>{{ __('Logo') }}</th>
															<th>{{ __('Raison sociale') }}</th>
															<th>{{ __('Numéro SIREN') }}</th>
															<th>{{ __('Signataire') }}</th>
															<th>{{ __('Par défault') }}</th>
															<th>{{ __('Activé') }}</th>
															<th class="text-center">{{ __('Actions') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body" style="min-height: 350px">
														@forelse ($amos as $amo)
															<tr>
																<td> <div class="custom-control custom-checkbox">
																		<input value="1" type="checkbox""  class="custom-control-input table-select-checkbox" id="tableRowSelectCheckamo-{{ $amo->id }}">
																		<label class="custom-control-label" for="tableRowSelectCheckamo-{{ $amo->id }}"></label>
																	</div>
																</td>
																<td>
																	<img  loading="lazy"  src="{{ asset('uploads/amo') }}/{{ $amo->logo }}" alt="" width="100" height="100">
																</td>
																<td>
																	{{ $amo->company_name }}
																</td>
																<td>
																	{{ $amo->number }}
																</td>
																<td>
																	{{ $amo->signatory }}
																</td>
																<td>
																	@if ($amo->default == 'Oui')
																		<span class="text-success">&check;</span>
																		@else
																		<span class="text-danger">&times;</span>
																	@endif
																</td>
																<td>
																	@if ($amo->active == 'Oui')
																		<span class="text-success">&check;</span>
																		@else
																		<span class="text-danger">&times;</span>
																	@endif
																</td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if (checkAction(Auth::id(), 'general__setting-amo', 'edit') || role() == 's_admin')
																				<button data-toggle="modal" data-target="#AmoModalEdit{{ $amo->id }}" type="button" class="dropdown-item border-0" data-user-id="2">
																					<span class="novecologie-icon-edit mr-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0" data-user-id="2">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@endif
																			@if (checkAction(Auth::id(), 'general__setting-amo', 'delete') || role() == 's_admin')
																				<form action="{{ route('amo.delete') }}" method="post">
																					@csrf
																					<input type="hidden" name="id" value="{{ $amo->id }}">
																					<button type="submit" class="dropdown-item border-0">
																						<span class="novecologie-icon-trash mr-1"></span>
																							Supprimer
																					</button>
																				</form>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																						Supprimer
																				</button>
																			@endif
																		</div>
																	</div>
																</td>
															</tr>
														@empty
														<tr>
															<td colspan="8" class="text-center py-5">
																<span>{{ __('No Item Found') }}</span>
															</td>
														</tr>
														@endforelse
													</tbody>
												</table>
											</div>
										</div>
									</div>
							</div>
							<div class="tab-pane fade" id="v-pills-10" role="tabpanel" aria-labelledby="v-pills-10-tab">

									<div class="row">
										<div class="col-12 d-flex align-items-center justify-content-between flex-wrap">
											<h3 class="m-2">{{ __('Mandataire Anah') }}</h3>
											@if (checkAction(Auth::id(), 'general__setting-mandataire_anah', 'create') || role() == 's_admin')
												<button type="button" class="secondary-btn border-0 m-2" data-toggle="modal" data-target="#AgentModal">+ {{ __('Add new') }}</button>
											@else
												<button type="button" class="secondary-btn border-0 m-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Add new') }}</button>
											@endif
										</div>
										<div class="col-12">
											<div class="table-responsive simple-bar">
												<table class="table database-table w-100 mb-0 table-bordered">
													<thead class="database-table__header">
														<tr>
															<th class="text-left">
																<div class="custom-control custom-checkbox">
																	<input value="1" type="checkbox" class="custom-control-input table-all-select-checkbox" id="tableAllSelectCheckss-agent">
																	<label class="custom-control-label" for="tableAllSelectCheckss-agent"></label>
																</div>
															</th>
															<th>{{ __('Logo') }}</th>
															<th>{{ __('Raison sociale') }}</th>
															<th>{{ __('Numéro SIREN') }}</th>
															<th>{{ __('Signataire') }}</th>
															<th>{{ __('Par défault') }}</th>
															<th>{{ __('Activé') }}</th>
															<th class="text-center">{{ __('Actions') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body" style="min-height: 350px">
														@forelse ($agents as $agent)
															<tr>
																<td> <div class="custom-control custom-checkbox">
																		<input value="1" type="checkbox""  class="custom-control-input table-select-checkbox" id="tableRowSelectCheckagent-{{ $agent->id }}">
																		<label class="custom-control-label" for="tableRowSelectCheckagent-{{ $agent->id }}"></label>
																	</div>
																</td>
																<td>
																	<img  loading="lazy"  src="{{ asset('uploads/agent') }}/{{ $agent->logo }}" alt="" width="100" height="100">
																</td>
																<td>
																	{{ $agent->company_name }}
																</td>
																<td>
																	{{ $agent->number }}
																</td>
																<td>
																	{{ $agent->signatory }}
																</td>
																<td>
																	@if ($agent->default == 'Oui')
																		<span class="text-success">&check;</span>
																		@else
																		<span class="text-danger">&times;</span>
																	@endif
																</td>
																<td>
																	@if ($agent->active == 'Oui')
																		<span class="text-success">&check;</span>
																		@else
																		<span class="text-danger">&times;</span>
																	@endif
																</td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if (checkAction(Auth::id(), 'general__setting-mandataire_anah', 'edit') || role() == 's_admin')
																				<button data-toggle="modal" data-target="#agentModalEdit{{ $agent->id }}" type="button" class="dropdown-item border-0" data-user-id="2">
																					<span class="novecologie-icon-edit mr-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@endif
																			@if (checkAction(Auth::id(), 'general__setting-mandataire_anah', 'delete') || role() == 's_admin')
																				<form action="{{ route('agent.delete') }}" method="post">
																					@csrf
																					<input type="hidden" name="id" value="{{ $agent->id }}">
																					<button type="submit" class="dropdown-item border-0">
																						<span class="novecologie-icon-trash mr-1"></span>
																							Supprimer
																					</button>
																				</form>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																						Supprimer
																				</button>
																			@endif
																		</div>
																	</div>
																</td>
															</tr>
														@empty
														<tr>
															<td colspan="8" class="text-center py-5">
																<span>{{ __('No Item Found') }}</span>
															</td>
														</tr>
														@endforelse
													</tbody>
												</table>
											</div>
										</div>
									</div>
							</div>
							<div class="tab-pane fade" id="v-pills-11" role="tabpanel" aria-labelledby="v-pills-11-tab">

									<div class="row">
										<div class="col-12 d-flex align-items-center justify-content-between flex-wrap">
											<h3 class="m-2">{{ __('Auditeur énergétique') }}</h3>
											@if (checkAction(Auth::id(), 'general__setting-auditeur_energetique', 'create') || role() == 's_admin')
												<button type="button" class="secondary-btn border-0 m-2" data-toggle="modal" data-target="#AuditorModal">+ {{ __('Add new') }}</button>
											@else
												<button type="button" class="secondary-btn border-0 m-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Add new') }}</button>
											@endif
										</div>
										<div class="col-12">
											<div class="table-responsive simple-bar">
												<table class="table database-table w-100 mb-0 table-bordered">
													<thead class="database-table__header">
														<tr>
															<th class="text-left">
																<div class="custom-control custom-checkbox">
																	<input value="1" type="checkbox" class="custom-control-input table-all-select-checkbox" id="tableAllSelectCheckss-auditor">
																	<label class="custom-control-label" for="tableAllSelectCheckss-auditor"></label>
																</div>
															</th>
															<th>{{ __('Logo') }}</th>
															<th>{{ __('Raison sociale') }}</th>
															<th>{{ __('Numéro SIREN') }}</th>
															<th>{{ __('Signataire') }}</th>
															<th>{{ __('Activé') }}</th>
															<th class="text-center">{{ __('Actions') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body" style="min-height: 350px">
														@forelse ($auditors as $auditor)
															<tr>
																<td> <div class="custom-control custom-checkbox">
																		<input value="1" type="checkbox""  class="custom-control-input table-select-checkbox" id="tableRowSelectCheckauditor-{{ $auditor->id }}">
																		<label class="custom-control-label" for="tableRowSelectCheckauditor-{{ $auditor->id }}"></label>
																	</div>
																</td>
																<td>
																	<img  loading="lazy"  src="{{ asset('uploads/auditor') }}/{{ $auditor->logo }}" alt="" width="100" height="100">
																</td>
																<td>
																	{{ $auditor->company_name }}
																</td>
																<td>
																	{{ $auditor->number }}
																</td>
																<td>
																	{{ $auditor->signatory }}
																</td>
																<td>
																	@if ($auditor->active == 'Oui')
																		<span class="text-success">&check;</span>
																		@else
																		<span class="text-danger">&times;</span>
																	@endif
																</td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if (checkAction(Auth::id(), 'general__setting-auditeur_energetique', 'edit') || role() == 's_admin')
																				<button data-toggle="modal" data-target="#auditorModalEdit{{ $auditor->id }}" type="button" class="dropdown-item border-0" data-user-id="2">
																					<span class="novecologie-icon-edit mr-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@endif
																			@if (checkAction(Auth::id(), 'general__setting-auditeur_energetique', 'delete') || role() == 's_admin')
																				<form action="{{ route('auditor.delete') }}" method="post">
																					@csrf
																					<input type="hidden" name="id" value="{{ $auditor->id }}">
																					<button type="submit" class="dropdown-item border-0">
																						<span class="novecologie-icon-trash mr-1"></span>
																							Supprimer
																					</button>
																				</form>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																						Supprimer
																				</button>
																			@endif
																		</div>
																	</div>
																</td>
															</tr>
														@empty
														<tr>
															<td colspan="7" class="text-center py-5">
																<span>{{ __('No Item Found') }}</span>
															</td>
														</tr>
														@endforelse
													</tbody>
												</table>
											</div>
										</div>
									</div>
							</div>
							<div class="tab-pane fade" id="v-pills-12" role="tabpanel" aria-labelledby="v-pills-12-tab">

									<div class="row">
										<div class="col-12 d-flex align-items-center justify-content-between flex-wrap">
											<h3 class="m-2">
												Zones d'intervention
											</h3>
											@if (checkAction(Auth::id(), 'general__setting-zones_d_intervention', 'create') || role() == 's_admin')
												<button type="button" class="secondary-btn border-0 m-2" data-toggle="modal" data-target="#areaModal">+ {{ __('Add new') }}</button>
											@else
												<button type="button" class="secondary-btn border-0 m-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Add new') }}</button>
											@endif
										</div>
										<div class="col-12">
											<div class="table-responsive simple-bar">
												<table class="table database-table w-100 mb-0 table-bordered">
													<thead class="database-table__header">
														<tr>
															<th class="text-left">
																<div class="custom-control custom-checkbox">
																	<input value="1" type="checkbox" class="custom-control-input table-all-select-checkbox" id="tableAllSelectCheckss-area">
																	<label class="custom-control-label" for="tableAllSelectCheckss-area"></label>
																</div>
															</th>
															<th class="text-center">{{ __('Couleur') }}</th>
															<th>{{ __('Libellé') }}</th>
															<th>{{ __('Activé') }}</th>
															<th class="text-center">{{ __('Actions') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body" style="min-height: 350px">
														@forelse ($areas as $area)
															<tr>
																<td> <div class="custom-control custom-checkbox">
																		<input value="1" type="checkbox""  class="custom-control-input table-select-checkbox" id="tableRowSelectCheckarea-{{ $area->id }}">
																		<label class="custom-control-label" for="tableRowSelectCheckarea-{{ $area->id }}"></label>
																	</div>
																</td>
																<td>
																	<input type="color" value="{{ $area->color }}" data-id="{{ $area->id }}" class="form-control shadow-none border-0 areaColorChange">
																</td>
																<td>
																	{{ $area->wording }}
																</td>
																<td>
																	@if ($area->active == 'Oui')
																		<span class="text-success">&check;</span>
																		@else
																		<span class="text-danger">&times;</span>
																	@endif
																</td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if (checkAction(Auth::id(), 'general__setting-zones_d_intervention', 'edit') || role() == 's_admin')
																				<button data-toggle="modal" data-target="#areaModalEdit{{ $area->id }}" type="button" class="dropdown-item border-0" data-user-id="2">
																					<span class="novecologie-icon-edit mr-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@endif
																			@if (checkAction(Auth::id(), 'general__setting-zones_d_intervention', 'delete') || role() == 's_admin')
																				<form action="{{ route('area.delete') }}" method="post">
																					@csrf
																					<input type="hidden" name="id" value="{{ $area->id }}">
																					<button type="submit" class="dropdown-item border-0">
																						<span class="novecologie-icon-trash mr-1"></span>
																							Supprimer
																					</button>
																				</form>
																			@else
																				<button type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																						Supprimer
																				</button>
																			@endif
																		</div>
																	</div>
																</td>
															</tr>
														@empty
														<tr>
															<td colspan="5" class="text-center py-5">
																<span>{{ __('No Item Found') }}</span>
															</td>
														</tr>
														@endforelse
													</tbody>
												</table>
											</div>
										</div>
									</div>
							</div>
							<div class="tab-pane fade" id="v-pills-13" role="tabpanel" aria-labelledby="v-pills-13-tab">

								<div class="row">
									<div class="col-12 d-flex align-items-center justify-content-between flex-wrap">
										<h3 class="m-2">Bureau de contrôle</h3>
										@if (checkAction(Auth::id(), 'general__setting-bureaux_de_controle', 'create') || role() == 's_admin')
											<button type="button" class="secondary-btn border-0 m-2" data-toggle="modal" data-target="#controlModal">+ {{ __('Add new') }}</button>
										@else
											<button type="button" class="secondary-btn border-0 m-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Add new') }}</button>
										@endif
									</div>
									<div class="col-12">
										<div class="table-responsive simple-bar">
											<table class="table database-table w-100 mb-0 table-bordered">
												<thead class="database-table__header">
													<tr>
														<th class="text-left">
															<div class="custom-control custom-checkbox">
																<input value="1" type="checkbox" class="custom-control-input table-all-select-checkbox" id="tableAllSelectCheckss-control">
																<label class="custom-control-label" for="tableAllSelectCheckss-control"></label>
															</div>
														</th>
														<th>{{ __('Logo') }}</th>
														<th>{{ __('Raison sociale') }}</th>
														<th>{{ __('Numéro SIREN') }}</th>
														<th>{{ __('Nom Contact') }}</th>
														<th>{{ __('Activé') }}</th>
														<th class="text-center">{{ __('Actions') }}</th>
													</tr>
												</thead>
												<tbody class="database-table__body" style="min-height: 350px">
													@forelse ($controls as $control)
														<tr>
															<td> <div class="custom-control custom-checkbox">
																	<input value="1" type="checkbox""  class="custom-control-input table-select-checkbox" id="tableRowSelectCheckcontrol-{{ $control->id }}">
																	<label class="custom-control-label" for="tableRowSelectCheckcontrol-{{ $control->id }}"></label>
																</div>
															</td>
															<td>
																<img  loading="lazy"  src="{{ asset('uploads/control') }}/{{ $control->logo }}" alt="" width="100" height="100">
															</td>
															<td>
																{{ $control->company_name }}
															</td>
															<td>
																{{ $control->number }}
															</td>
															<td>
																{{ $control->contact_name }}
															</td>
															<td>
																@if ($control->active == 'Oui')
																	<span class="text-success">&check;</span>
																	@else
																	<span class="text-danger">&times;</span>
																@endif
															</td>
															<td class="text-center">
																<div class="dropdown dropdown--custom p-0 d-inline-block">
																	<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																		<span class="novecologie-icon-dots-horizontal-triple"></span>
																	</button>
																	<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																		@if (checkAction(Auth::id(), 'general__setting-bureaux_de_controle', 'edit') || role() == 's_admin')
																			<button data-toggle="modal" data-target="#controlModalEdit{{ $control->id }}" type="button" class="dropdown-item border-0" data-user-id="2">
																				<span class="novecologie-icon-edit mr-1"></span>
																				{{ __('Edit') }}
																			</button>
																		@else
																			<button type="button" class="dropdown-item border-0">
																				<span class="novecologie-icon-lock py-1"></span>
																				{{ __('Edit') }}
																			</button>
																		@endif
																		@if (checkAction(Auth::id(), 'general__setting-bureaux_de_controle', 'delete') || role() == 's_admin')
																			<form action="{{ route('control.delete') }}" method="post">
																				@csrf
																				<input type="hidden" name="id" value="{{ $control->id }}">
																				<button type="submit" class="dropdown-item border-0">
																					<span class="novecologie-icon-trash mr-1"></span>
																						Supprimer
																				</button>
																			</form>
																		@else
																			<button type="button" class="dropdown-item border-0">
																				<span class="novecologie-icon-lock py-1"></span>
																					Supprimer
																			</button>
																		@endif
																	</div>
																</div>
															</td>
														</tr>
													@empty
													<tr>
														<td colspan="7" class="text-center py-5">
															<span>{{ __('No Item Found') }}</span>
														</td>
													</tr>
													@endforelse
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="v-pills-14" role="tabpanel" aria-labelledby="v-pills-14-tab">

								<div class="row">
									<div class="col-12 d-flex align-items-center justify-content-between flex-wrap">
										<h3 class="m-2">
											{{ __('Marques') }}
										</h3>
										@if (checkAction(Auth::id(), 'general__setting-marques', 'create') || role() == 's_admin')
											<button type="button" class="secondary-btn border-0 m-2" data-toggle="modal" data-target="#brandModal">+ {{ __('Add new') }}</button>
										@else
											<button type="button" class="secondary-btn border-0 m-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Add new') }}</button>
										@endif
									</div>
									<div class="col-12">
										<div class="table-responsive simple-bar">
											<table class="table database-table w-100 mb-0 table-bordered">
												<thead class="database-table__header">
													<tr>
														<th class="text-left">
															<div class="custom-control custom-checkbox">
																<input value="1" type="checkbox" class="custom-control-input table-all-select-checkbox" id="tableAllSelectCheckss-brand">
																<label class="custom-control-label" for="tableAllSelectCheckss-brand"></label>
															</div>
														</th>
														<th>{{ __('Logo') }}</th>
														<th>{{ __('Description') }}</th>
														<th>{{ __('Source') }}</th>
														<th>{{ __('Activé') }}</th>
														<th class="text-center">{{ __('Actions') }}</th>
													</tr>
												</thead>
												<tbody class="database-table__body" style="min-height: 350px">
													@forelse ($brands as $brand)
														<tr>
															<td> <div class="custom-control custom-checkbox">
																	<input value="1" type="checkbox""  class="custom-control-input table-select-checkbox" id="tableRowSelectCheckbrand-{{ $brand->id }}">
																	<label class="custom-control-label" for="tableRowSelectCheckbrand-{{ $brand->id }}"></label>
																</div>
															</td>
															<td>
																@if ($brand->logo)
																<img  loading="lazy"  src="{{ asset('uploads/brand') }}/{{ $brand->logo }}" alt="" width="100" height="100">
																@endif
															</td>
															<td>
																{{ $brand->description }}
															</td>
															<td>
																{{ $brand->source }}
															</td>
															<td>
																@if ($brand->active == 'Oui')
																	<span class="text-success">&check;</span>
																	@else
																	<span class="text-danger">&times;</span>
																@endif
															</td>
															<td class="text-center">
																<div class="dropdown dropdown--custom p-0 d-inline-block">
																	<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																		<span class="novecologie-icon-dots-horizontal-triple"></span>
																	</button>
																	<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																		@if (checkAction(Auth::id(), 'general__setting-marques', 'edit') || role() == 's_admin')
																			<button data-toggle="modal" data-target="#brandModalEdit{{ $brand->id }}" type="button" class="dropdown-item border-0" data-user-id="2">
																				<span class="novecologie-icon-edit mr-1"></span>
																				{{ __('Edit') }}
																			</button>
																		@else
																			<button type="button" class="dropdown-item border-0">
																				<span class="novecologie-icon-lock py-1"></span>
																				{{ __('Edit') }}
																			</button>
																		@endif
																		@if (checkAction(Auth::id(), 'general__setting-marques', 'delete') || role() == 's_admin')
																			<form action="{{ route('brand.delete') }}" method="post">
																				@csrf
																				<input type="hidden" name="id" value="{{ $brand->id }}">
																				<button type="submit" class="dropdown-item border-0">
																					<span class="novecologie-icon-trash mr-1"></span>
																						Supprimer
																				</button>
																			</form>
																		@else
																			<button type="button" class="dropdown-item border-0">
																				<span class="novecologie-icon-lock py-1"></span>
																					Supprimer
																			</button>
																		@endif
																	</div>
																</div>
															</td>
														</tr>
													@empty
													<tr>
														<td colspan="6" class="text-center py-5">
															<span>{{ __('No Item Found') }}</span>
														</td>
													</tr>
													@endforelse
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="v-pills-15" role="tabpanel" aria-labelledby="v-pills-15-tab">

								<div class="row">
									<div class="col-12 d-flex align-items-center justify-content-between flex-wrap">
										<h3 class="m-2">
											{{ __('Prestations') }}
										</h3>
										@if (checkAction(Auth::id(), 'general__setting-prestations', 'create') || role() == 's_admin')
											<button type="button" class="secondary-btn border-0 m-2" data-toggle="modal" data-target="#benefitModal">+ {{ __('Add new') }}</button>
										@else
											<button type="button" class="secondary-btn border-0 m-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Add new') }}</button>
										@endif
									</div>
									<div class="col-12">
										<div class="table-responsive simple-bar">
											<table class="table database-table w-100 mb-0 table-bordered">
												<thead class="database-table__header">
													<tr>
														<th class="text-left">
															<div class="custom-control custom-checkbox">
																<input value="1" type="checkbox" class="custom-control-input table-all-select-checkbox" id="tableAllSelectCheckss-benefit">
																<label class="custom-control-label" for="tableAllSelectCheckss-benefit"></label>
															</div>
														</th>
														<th>{{ __('Alias') }}</th>
														<th>{{ __('Titre') }}</th>
														<th>{{ __('Designation') }}</th>
														<th>{{ __('Opérations liées') }}</th>
														<th>{{ __('Quantité') }}</th>
														<th>{{ __('Prix de vente') }}</th>
														<th>{{ __('Activé') }}</th>
														<th class="text-center">{{ __('Actions') }}</th>
													</tr>
												</thead>
												<tbody class="database-table__body" style="min-height: 350px">
													@forelse ($benefits as $benefit)
														<tr>
															<td> <div class="custom-control custom-checkbox">
																	<input value="1" type="checkbox""  class="custom-control-input table-select-checkbox" id="tableRowSelectCheckbenefit-{{ $benefit->id }}">
																	<label class="custom-control-label" for="tableRowSelectCheckbenefit-{{ $benefit->id }}"></label>
																</div>
															</td>
															<td>
																{{ $benefit->alias }}
															</td>
															<td>
																{{ $benefit->title }}
															</td>
															<td class="wrap">
																{{ $benefit->designation }}
															</td>
															<td>
																@foreach ($scales->where('active', 'yes') as $scale)
																	@if (getFeature($benefit->operation, $scale->id))
																		{{ $scale->wording }} <br>
																	@endif
																@endforeach
															</td>
															<td>
																{{ $benefit->quantity }}{{ $benefit->quantity? ',00':'0,00' }}
															</td>
															<td>
																 {{ $benefit->price }} {{ $benefit->price? ',00':'0,00' }} &euro;
															</td>
															<td>
																@if ($benefit->active == 'on')
																	<span class="text-success">&check;</span>
																	@else
																	<span class="text-danger">&times;</span>
																@endif
															</td>
															<td class="text-center">
																<div class="dropdown dropdown--custom p-0 d-inline-block">
																	<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																		<span class="novecologie-icon-dots-horizontal-triple"></span>
																	</button>
																	<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																		@if (checkAction(Auth::id(), 'general__setting-prestations', 'edit') || role() == 's_admin')
																			<button data-toggle="modal" data-target="#benefitModalEdit{{ $benefit->id }}" type="button" class="dropdown-item border-0" data-user-id="2">
																				<span class="novecologie-icon-edit mr-1"></span>
																				{{ __('Edit') }}
																			</button>
																		@else
																			<button type="button" class="dropdown-item border-0">
																				<span class="novecologie-icon-lock py-1"></span>
																				{{ __('Edit') }}
																			</button>
																		@endif
																		{{-- <form action="{{ route('benefit.delete') }}" method="post">
																			@csrf
																			<input type="hidden" name="id" value="{{ $benefit->id }}">
																			<button type="submit" class="dropdown-item border-0">
																				<span class="novecologie-icon-trash mr-1"></span>
																				Supprimer
																			</button>
																		</form> --}}
																		@if (checkAction(Auth::id(), 'general__setting-prestations', 'delete') || role() == 's_admin')
																			<button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#benefitModalDelete{{ $benefit->id }}">
																					<span class="novecologie-icon-trash mr-1"></span>
																						Supprimer
																				</button>
																		@else
																			<button type="button" class="dropdown-item border-0">
																				<span class="novecologie-icon-lock py-1"></span>
																					Supprimer
																			</button>
																		@endif
																	</div>
																</div>
															</td>
														</tr>
													@empty
													<tr>
														<td colspan="9" class="text-center py-5">
															<span>{{ __('No Item Found') }}</span>
														</td>
													</tr>
													@endforelse
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="v-pills-16" role="tabpanel" aria-labelledby="v-pills-16-tab">

								<div class="row">
									<div class="col-12 d-flex align-items-center justify-content-between flex-wrap">
										<h3 class="m-2">{{ __('Fournisseurs') }}</h3>
										@if (checkAction(Auth::id(), 'general__setting-fournisseurs', 'create') || role() == 's_admin')
											<button type="button" class="secondary-btn border-0 m-2" data-toggle="modal" data-target="#fournesserModal">+ {{ __('Add new') }}</button>
										@else
											<button type="button" class="secondary-btn border-0 m-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Add new') }}</button>
										@endif
									</div>
									<div class="col-12">
										<div class="table-responsive simple-bar">
											<table class="table database-table w-100 mb-0 table-bordered">
												<thead class="database-table__header">
													<tr>
														<th class="text-left">
															<div class="custom-control custom-checkbox">
																<input value="1" type="checkbox" class="custom-control-input table-all-select-checkbox" id="tableAllSelectCheckss-fournesser">
																<label class="custom-control-label" for="tableAllSelectCheckss-fournesser"></label>
															</div>
														</th>
														<th>{{ __('Logo') }}</th>
														<th>{{ __('Fournisseur') }}</th>
														<th>{{ __('Description') }}</th>
														<th>Type</th>
														<th>{{ __('Activé') }}</th>
														<th class="text-center">{{ __('Actions') }}</th>
													</tr>
												</thead>
												<tbody class="database-table__body" style="min-height: 350px">
													@forelse ($fournessers as $fournesser)
														<tr>
															<td> <div class="custom-control custom-checkbox">
																	<input value="1" type="checkbox""  class="custom-control-input table-select-checkbox" id="tableRowSelectCheckfournesser-{{ $fournesser->id }}">
																	<label class="custom-control-label" for="tableRowSelectCheckfournesser-{{ $fournesser->id }}"></label>
																</div>
															</td>
															<td>
																@if ($fournesser->logo)
																<img  loading="lazy"  src="{{ asset('uploads/fournesser') }}/{{ $fournesser->logo }}" alt="" width="100" height="100">
																@endif
															</td>
															<td>
																{{ $fournesser->suplier }}
															</td>
															<td>
																{{ $fournesser->description }}
															</td>
															<td>
																{{ $fournesser->type }}
															</td>

															<td>
																@if ($fournesser->active == 'Oui')
																	<span class="text-success">&check;</span>
																	@else
																	<span class="text-danger">&times;</span>
																@endif
															</td>
															<td class="text-center">
																<div class="dropdown dropdown--custom p-0 d-inline-block">
																	<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																		<span class="novecologie-icon-dots-horizontal-triple"></span>
																	</button>
																	<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																		@if (checkAction(Auth::id(), 'general__setting-fournisseurs', 'edit') || role() == 's_admin')
																			<button data-toggle="modal" data-target="#fournesserModalEdit{{ $fournesser->id }}" type="button" class="dropdown-item border-0" data-user-id="2">
																				<span class="novecologie-icon-edit mr-1"></span>
																				{{ __('Edit') }}
																			</button>
																		@else
																			<button type="button" class="dropdown-item border-0">
																				<span class="novecologie-icon-lock py-1"></span>
																				{{ __('Edit') }}
																			</button>
																		@endif
																		@if (checkAction(Auth::id(), 'general__setting-fournisseurs', 'delete') || role() == 's_admin')
																			<form action="{{ route('fournesser.delete') }}" method="post">
																				@csrf
																				<input type="hidden" name="id" value="{{ $fournesser->id }}">
																				<button type="submit" class="dropdown-item border-0">
																					<span class="novecologie-icon-trash mr-1"></span>
																						Supprimer
																				</button>
																			</form>
																		@else
																			<button type="button" class="dropdown-item border-0">
																				<span class="novecologie-icon-lock py-1"></span>
																					Supprimer
																			</button>
																		@endif
																	</div>
																</div>
															</td>
														</tr>
													@empty
													<tr>
														<td colspan="6" class="text-center py-5">
															<span>{{ __('No Item Found') }}</span>
														</td>
													</tr>
													@endforelse
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="v-pills-17" role="tabpanel" aria-labelledby="v-pills-17-tab">
								<div class="row">
									<div class="col-12 d-flex align-items-center justify-content-between flex-wrap">
										<h3 class="m-2">{{ __('Societé client') }}</h3>
										@if (checkAction(Auth::id(), 'general__setting-societe_client', 'create') || role() == 's_admin')
											<button type="button" class="secondary-btn border-0 m-2" data-toggle="modal" data-target="#client_companyModal">+ {{ __('Add new') }}</button>
										@else
											<button type="button" class="secondary-btn border-0 m-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Add new') }}</button>
										@endif
									</div>
									<div class="col-12">
										<div class="table-responsive simple-bar">
											<table class="table database-table w-100 mb-0 table-bordered">
												<thead class="database-table__header">
													<tr>
														<th class="text-left">
															<div class="custom-control custom-checkbox">
																<input value="1" type="checkbox" class="custom-control-input table-all-select-checkbox" id="tableAllSelectCheckss-client_company">
																<label class="custom-control-label" for="tableAllSelectCheckss-client_company"></label>
															</div>
														</th>
														<th>{{ __('Logo') }}</th>
														<th>{{ __('Fournisseur') }}</th>
														<th>{{ __('Description') }}</th>
														<th>{{ __('Activé') }}</th>
														<th class="text-center">{{ __('Actions') }}</th>
													</tr>
												</thead>
												<tbody class="database-table__body" style="min-height: 350px">
													@forelse ($client_companies as $client_company)
														<tr>
															<td> <div class="custom-control custom-checkbox">
																	<input value="1" type="checkbox""  class="custom-control-input table-select-checkbox" id="tableRowSelectCheckclient_company-{{ $client_company->id }}">
																	<label class="custom-control-label" for="tableRowSelectCheckclient_company-{{ $client_company->id }}"></label>
																</div>
															</td>
															<td>
																@if ($client_company->logo)
																<img  loading="lazy"  src="{{ asset('uploads/client_company') }}/{{ $client_company->logo }}" alt="" width="100" height="100">
																@endif
															</td>
															<td>
																{{ $client_company->company_name }}
															</td>
															<td>
																{{ $client_company->description }}
															</td>

															<td>
																@if ($client_company->active == 'Oui')
																	<span class="text-success">&check;</span>
																	@else
																	<span class="text-danger">&times;</span>
																@endif
															</td>
															<td class="text-center">
																<div class="dropdown dropdown--custom p-0 d-inline-block">
																	<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																		<span class="novecologie-icon-dots-horizontal-triple"></span>
																	</button>
																	<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																		@if (checkAction(Auth::id(), 'general__setting-societe_client', 'edit') || role() == 's_admin')
																			<button data-toggle="modal" data-target="#client_companyModalEdit{{ $client_company->id }}" type="button" class="dropdown-item border-0" data-user-id="2">
																				<span class="novecologie-icon-edit mr-1"></span>
																				{{ __('Edit') }}
																			</button>
																		@else
																			<button type="button" class="dropdown-item border-0">
																				<span class="novecologie-icon-lock py-1"></span>
																				{{ __('Edit') }}
																			</button>
																		@endif
																		@if (checkAction(Auth::id(), 'general__setting-societe_client', 'delete') || role() == 's_admin')
																			<form action="{{ route('client_company.delete') }}" method="post">
																				@csrf
																				<input type="hidden" name="id" value="{{ $client_company->id }}">
																				<button type="submit" class="dropdown-item border-0">
																					<span class="novecologie-icon-trash mr-1"></span>
																						Supprimer
																				</button>
																			</form>
																		@else
																			<button type="button" class="dropdown-item border-0">
																				<span class="novecologie-icon-lock py-1"></span>
																					Supprimer
																			</button>

																		@endif
																	</div>
																</div>
															</td>
														</tr>
													@empty
													<tr>
														<td colspan="6" class="text-center py-5">
															<span>{{ __('No Item Found') }}</span>
														</td>
													</tr>
													@endforelse
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="v-pills-18" role="tabpanel" aria-labelledby="v-pills-18-tab">
								<div class="row">
									<div class="col-12 d-flex align-items-center justify-content-between flex-wrap">
										<h3 class="m-2">{{ __('Produits') }}
										</h3>
										{{-- @if (role() == 's_admin')
											<form action="{{ route('product.import') }}" enctype="multipart/form-data" method="POST">
												@csrf
												<label for="importProduct">Import Produits</label>
												<input type="file" hidden name="file" id="importProduct" onchange="this.closest('form').submit()">
											</form>
										@endif --}}
										@if (checkAction(Auth::id(), 'general__setting-produits', 'create') || role() == 's_admin')
											<button type="button" class="secondary-btn border-0 m-2" data-toggle="modal" data-target="#produitsCreateModal">+ {{ __('Add new') }}</button>
										@else
											<button type="button" class="secondary-btn border-0 m-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Add new') }}</button>
										@endif
									</div>
									<div class="col-12">
										<div class="table-responsive simple-bar">
											<table class="table database-table w-100 mb-0 table-bordered">
												<thead class="database-table__header">
													<tr>
														<th class="text-left">
															<div class="custom-control custom-checkbox">
																<input value="1" type="checkbox" class="custom-control-input table-all-select-checkbox" id="tableAllSelectCheckProductd">
																<label class="custom-control-label" for="tableAllSelectCheckProductd"></label>
															</div>
														</th>
														{{-- <th>{{ __('Photo') }}</th>     --}}
														{{-- <th>{{ __('Catégorie ') }}</th> --}}
														<th>{{ __('Référence / Designation ') }}</th>
														<th class="text-center">{{ __('Marque') }}</th>
														<th class="text-center">Tags</th>
														<th class="text-center">prestation</th>
														{{-- <th>{{ __('Mode de pose') }}</th> --}}
														<th>{{ __('Activé') }}</th>
														<th>{{ __('Action') }}</th>
														{{-- <th class="text-center">{{ __('Actions') }}</th> --}}
													</tr>
												</thead>
												<tbody class="database-table__body">
													@foreach ($products as $product)
														<tr>
															<td>
																<div class="custom-control custom-checkbox">
																	<input value="1" type="checkbox""  class="custom-control-input table-select-checkbox" id="tableRowSelectCheckProducts_{{ $product->id }}">
																	<label class="custom-control-label" for="tableRowSelectCheckProducts_{{ $product->id }}"></label>
																</div>
															</td>
															{{-- <td>
																<img  loading="lazy"  src="gfdg" alt="" width="100" height="100">
															</td> --}}
															{{-- <td data-toggle="modal" data-target="#product_edit{{ $product->id }}" class="cursor-pointer">
																{{ $product->getCategory->name ?? '' }}
															</td> --}}
															<td class="wrap">
																<b>{{ $product->reference }}</b>/
																<i>{{ $product->designation }}</i>
															</td>
															<td class="text-center">
																{{ $product->getMarque->description ?? '' }}
															</td>
															<td class="text-center">
																@foreach ($product->getTags  as $tag)
																	{{ $tag->tag }} {{ $loop->last ? '':', ' }}
																@endforeach
															</td>
															<td class="text-center">
																@foreach ($product->prestations  as $prestation)
																	{{ $prestation->alias }} {{ $loop->last ? '':', ' }}
																@endforeach
															</td>
															{{-- <td class="text-center">
																{{ $product->covering_capacity }}
															</td> --}}
															{{-- <td class="text-center">
																{{ $product->installation_mode }}
															</td> --}}
															<td class="text-center">
																@if ($product->activate == 'on')
																	<span class="text-success">&check;</span>
																@else
																	<span class="text-danger">&times;</span>
																@endif
															</td>
															<td class="text-center">
																<div class="dropdown dropdown--custom p-0 d-inline-block">
																	<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																		<span class="novecologie-icon-dots-horizontal-triple"></span>
																	</button>
																	<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																		@if (checkAction(Auth::id(), 'general__setting-produits', 'edit') || role() == 's_admin')
																			<button data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#product_edit{{ $product->id }}" type="button" class="dropdown-item border-0" data-user-id="2">
																				<span class="novecologie-icon-edit mr-1"></span>
																				{{ __('Edit') }}
																			</button>
																		@else
																			<button type="button" class="dropdown-item border-0">
																				<span class="novecologie-icon-lock py-1"></span>
																				{{ __('Edit') }}
																			</button>
																		@endif
																		@if (checkAction(Auth::id(), 'general__setting-produits', 'delete') || role() == 's_admin')
																			<button data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#product_delete{{ $product->id }}" type="button" class="dropdown-item border-0" data-user-id="2">
																				<span class="novecologie-icon-trash mr-1"></span>
																				{{ __('Delete') }}
																			</button>
																		@else
																			<button type="button" class="dropdown-item border-0">
																				<span class="novecologie-icon-lock py-1"></span>
																				{{ __('Delete') }}
																			</button>
																		@endif
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

							<div class="tab-pane fade" id="v-pills-19" role="tabpanel" aria-labelledby="v-pills-19-tab">
								<form action="{{ route('category.create') }}" class="setting-form" id="generalInfoFormcategory" method="POST">
									@csrf
									<div class="row">
										<div class="col-12">
											<h3 class="mb-4">{{ __('Produits Catégorie') }}</h3>
											<div class="form-group">
												<label class="form-label" for="product_category">{{ __('Catégorie') }} <span class="text-danger">*</span></label>
												<input type="text" id="product_category" name="name" class="form-control shadow-none rounded" placeholder="{{ __('Enter Catégorie') }}" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
										</div>
										<div class="col-12 mt-3">
											@if (checkAction(Auth::id(), 'general__setting-produits_categorie', 'create') || role() == 's_admin')
												<button type="submit" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2">{{ __('Create') }}</button>
											@else
												<button type="button" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Create') }}</button>
											@endif
										</div>
										<div class="col-12" >
											<div class="table-responsive simple-bar">
												<table class="table database-table w-100 mb-0 table-bordered">
													<thead class="database-table__header">
														<tr>
															<th>{{ __('Serial') }}</th>
															<th>{{ __('Catégorie') }}</th>
															<th class="text-center">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body">
														@foreach ($categories as $item)
															<tr>
																<td>{{ $loop->iteration }}</td>
																<td id="project_category{{ $item->id }}">{{ $item->name }}</td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if (checkAction(Auth::id(), 'general__setting-produits_categorie', 'edit') || role() == 's_admin')
																				<button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#category_edit{{ $item->id }}">
																					<span class="novecologie-icon-edit mr-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@else
																				<button  type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@endif
																			{{-- <button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#category_delete{{ $item->id }}">
																				<span class="novecologie-icon-trash mr-1"></span>
																					Supprimer
																			</button>  --}}
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
								</form>
							</div>

							<div class="tab-pane fade" id="v-pills-20" role="tabpanel" aria-labelledby="v-pills-20-tab">
								<form action="{{ route('sub.category.create') }}" class="setting-form" id="generalInfoFormtravaux" method="POST">
									@csrf
									<div class="row">
										<div class="col-12">
											<h3 class="mb-4">{{ __('Produits Sous-Catégorie') }}</h3>
											<div class="form-group">
												<label class="form-label" for="subcategory">{{ __('Sous-Catégorie') }} <span class="text-danger">*</span></label>
												<input type="text" id="subcategory" name="name" class="form-control shadow-none rounded" placeholder="{{ __('Enter Sous-Catégorie') }}" required>
												<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
											</div>
										</div>
										<div class="col-12 mt-3">
											@if (checkAction(Auth::id(), 'general__setting-produits_sous_categorie', 'create') || role() == 's_admin')
												<button type="submit" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2">{{ __('Create') }}</button>
											@else
												<button type="button" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Create') }}</button>
											@endif
										</div>
										<div class="col-12" >
											<div class="table-responsive simple-bar">
												<table class="table database-table w-100 mb-0 table-bordered">
													<thead class="database-table__header">
														<tr>
															<th>{{ __('Serial') }}</th>
															<th>{{ __('Sous-Catégorie') }}</th>
															<th class="text-center">{{ __('Action') }}</th>
														</tr>
													</thead>
													<tbody class="database-table__body">
														@foreach ($subcategories as $sub_cat)
															<tr>
																<td>{{ $loop->iteration }}</td>
																<td id="sub_category{{ $sub_cat->id }}">{{ $sub_cat->name }}</td>
																<td class="text-center">
																	<div class="dropdown dropdown--custom p-0 d-inline-block">
																		<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<span class="novecologie-icon-dots-horizontal-triple"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																			@if (checkAction(Auth::id(), 'general__setting-produits_sous_categorie', 'edit') || role() == 's_admin')
																				<button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#sub_category_edit{{ $sub_cat->id }}">
																					<span class="novecologie-icon-edit mr-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@else
																				<button  type="button" class="dropdown-item border-0">
																					<span class="novecologie-icon-lock py-1"></span>
																					{{ __('Edit') }}
																				</button>
																			@endif
																			{{-- <button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#sub_category_delete{{ $sub_cat->id }}">
																				<span class="novecologie-icon-trash mr-1"></span>
																					Supprimer
																			</button>  --}}
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
								</form>
							</div>
							<div class="tab-pane fade" id="v-pills-BAR_TH_164" role="tabpanel" aria-labelledby="v-pills-BAR_TH_164-tab">
								<div class="row">
									<div class="col-12">
										<h3 class="mb-4">BAR TH 164</h3>
									</div>
									<div class="col-12" >
										<div class="table-responsive simple-bar">
											<table class="table database-table w-100 mb-0 table-bordered">
												<thead class="database-table__header">
													<tr>
														<th>{{ __('Serial') }}</th>
														<th>Nom</th>
														<th>price</th>
														<th class="text-center">{{ __('Action') }}</th>
													</tr>
												</thead>
												<tbody class="database-table__body">
													@foreach ($barth_prices as $barth_price)
														<tr>
															<td>{{ $loop->iteration }}</td>
															<td>{{ $barth_price->name }}</td>
															<form action="{{ route('barth.price.update') }}" method="POST">
																@csrf
																<input type="hidden" name="id" value="{{ $barth_price->id }}">
																<td><input type="number" step="any" name="price" class="form-control" value="{{ $barth_price->price }}"></td>
																<td class="text-center">
																	<button class="primary-btn primary-btn--primary primary-btn--lg d-inline-flex align-items-center justify-content-center border-0 rounded">
																		{{ __('Update') }}
																	</button>
																</td>
															</form>
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
				</div>
			</div>
		</section>
		<div id="questions_input_modal">

		</div>
		<div class="modal modal--aside fade leftAsideModal" id="travauxModal" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
			<div class="modal-dialog m-0 h-100 bg-white">
			<div class="modal-content simple-bar border-0 h-100 rounded-0">
				<div class="modal-header border-0">
					<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
						<span class="novecologie-icon-close"></span>
					</button>
				</div>
				<div class="modal-body">

					<h1 id="updatedtagTitle" class="modal-title text-center mb-5">{{ __('Nouvelle sous-opération') }}</h1>
					<form action="{{ route('scale.create') }}" class="form mx-auto needs-validation"  novalidate method="POST">
						@csrf
						<div class="form-group">
							<label class="form-label" for="wording">{{ __('Libellé') }} :</label>
							<input type="text" id="wording" name="wording" class="form-control shadow-none rounded" required>
							<input type="hidden" name="baremes_tab" value="1">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>

						<div class="form-group">
							<label class="form-label" for="description">{{ __('Description') }} :</label>
							<textarea  id="description" name="description" class="form-control shadow-none rounded" required></textarea>
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="kwh_cumac">Kwh Cumac :</label>
							<input type="text" id="kwh_cumac" name="kwh_cumac" class="form-control shadow-none rounded" required>
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="prime_coup">Prime Coup de pouce CEE :</label>
							<input type="text" id="prime_coup" name="prime_coup" class="form-control shadow-none rounded" required>
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="bareme_travaux"> Travaux :</label>
							<select name="travaux" id="bareme_travaux"  class="custom-select shadow-none form-control">
								<option value="" selected>{{ __('Select') }}</option>
								 @foreach ($travaux_list as $travaux)
									 <option value="{{ $travaux->id }}">{{ $travaux->travaux }}</option>
								 @endforeach
							</select>
						</div>
						<div class="form-group">
							<label class="form-label" for="barame_tag"> TAG :</label>
							<select name="tag" id="barame_tag"  class="custom-select shadow-none form-control">
								<option value="" selected>{{ __('Select') }}</option>
								@foreach ($tags as $tag)
								<option value="{{ $tag->id }}">{{ $tag->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label class="form-label" for="barame_product"> Produits :</label>
							<select name="product[]" id="barame_product"  class="select2_select_option custom-select shadow-none form-control" multiple>
								  @foreach ($products as $product)
									  <option value="{{ $product->id }}">{{ $product->reference }}</option>
								  @endforeach
							</select>
						</div>
						<div class="form-group">
							<label class="form-label" for="include_price">{{ __('Inclure le prix dans les prestations') }} :</label>
							<select name="include_price" id="include_price"  class="custom-select shadow-none form-control">
								<option value="OUI">{{ __('OUI') }}</option>
								<option selected value="NON">{{ __('NON') }}</option>
							</select>
						</div>
						<div class="form-group d-flex">
							<label class="form-label" for="activeSwitch2">{{ __('Activer') }} :</label>
							<div class="custom-control custom-switch ml-1">
								<input type="checkbox" name="active" value="yes" class="custom-control-input" id="activeSwitch2">
								<label class="custom-control-label" for="activeSwitch2"></label>
							</div>
						</div>

						<div class="form-group d-flex flex-column align-items-center mt-4">
							@if (checkAction(Auth::id(), 'general__setting-baremes', 'create') || role() == 's_admin')
								<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Create') }}</button>
							@else
								<button type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3"><span class="novecologie-icon-lock py-1"></span> {{ __('Create') }}</button>
							@endif
						</div>
					</form>
					<h1 class="modal-title text-center my-5">{{ __('All Barèmes') }}</h1>
					<div class="col-12 px-3">
						<div class="database-table-wrapper bg-white border">
							<div class="table-responsive simple-bar">
								<table class="table database-table w-100 mb-0">
									<thead class="database-table__header">
										<tr>
											<th>{{ __('Serial') }}</th>
											<th>{{ __('Libellé') }}</th>
											<th>{{ __('Activé') }}</th>
											<th class="text-center">{{ __('Action') }}</th>
										</tr>
									</thead>
									<tbody class="database-table__body">
										@foreach ($scales as $scale)
											<tr>
												<td>{{ $loop->iteration }}</td>
												<td>
													{{ $scale->wording }}
												</td>
												<td>
													@if ($scale->active == 'yes')
														<span class="text-success">&check;</span>
														@else
														<span class="text-danger">&times;</span>
													@endif

												</td>
												<td class="text-center">
													<div class="dropdown dropdown--custom p-0 d-inline-block">
														<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															<span class="novecologie-icon-dots-horizontal-triple"></span>
														</button>
														<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
															@if (checkAction(Auth::id(), 'general__setting-baremes', 'edit') || role() == 's_admin')
																<button data-dismiss="modal" aria-label="Close" data-toggle="modal"  data-toggle="modal" data-target="#BarèmesEditModal2{{ $scale->id }}" type="button" class="dropdown-item border-0" data-user-id="2">
																	<span class="novecologie-icon-edit mr-1"></span>
																	{{ __('Edit') }}
																</button>
															@else
															<button type="button" class="dropdown-item border-0">
																<span class="novecologie-icon-lock py-1"></span> {{ __('Edit') }}
															</button>
															@endif
															@if (checkAction(Auth::id(), 'general__setting-baremes', 'delete') || role() == 's_admin')
																<button data-dismiss="modal" aria-label="Close" data-toggle="modal"  data-toggle="modal" data-target="#BarèmesDeleteModal2{{ $scale->id }}" type="button" class="dropdown-item border-0" data-user-id="2">
																	<span class="novecologie-icon-trash mr-1"></span>
																	{{ __('Delete') }}
																</button>
															@else
																<button type="button" class="dropdown-item border-0">
																	<span class="novecologie-icon-lock py-1"></span>
																	{{ __('Delete') }}
																</button>
															@endif
															{{-- <form action="{{ route('scale.delete') }}" method="post">
																@csrf
																<input type="hidden" name="id" value="{{ $scale->id }}">
																<button type="submit" class="dropdown-item border-0">
																	<span class="novecologie-icon-trash mr-1"></span>
																		Supprimer
																</button>
															</form> --}}
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
			</div>
			</div>
		</div>
		<div class="modal modal--aside fade leftAsideModal" id="travauxModal2" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
			<div class="modal-dialog m-0 h-100 bg-white">
			<div class="modal-content simple-bar border-0 h-100 rounded-0">
				<div class="modal-header border-0">
					<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
						<span class="novecologie-icon-close"></span>
					</button>
				</div>
				<div class="modal-body">
					<h1 id="updatedtagTitle" class="modal-title text-center mb-5">{{ __('Travaux') }}</h1>
					<form action="{{ route('travaux.create') }}" class="form mx-auto needs-validation"  novalidate method="POST">
						@csrf
						<div class="form-group">
							<label class="form-label" for="travaux">{{ __('Travaux') }} <span class="text-danger">*</span></label>
							<input type="text" id="xtravaux_Status" name="travaux" class="form-control shadow-none rounded" placeholder="{{ __('Enter Travaux') }}" required>
							<input type="hidden" name="product_tab" value="1">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="bareme_id2">Barème :</label>
							<select id="bareme_id2" name="bareme_id" class="custom-select shadow-none form-control" required>
								<option value="">{{ __('Select') }}</option>
								@foreach ($scales as $bareme)
									@php
										$data = \App\Models\CRM\TravauxList::where('bareme_id', $bareme->id)->doesntExist();
									@endphp
									@if ($data)
										<option value="{{ $bareme->id }}">{{ $bareme->wording }}</option>
									@endif
								@endforeach
							</select>
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group d-flex flex-column align-items-center mt-4">
							@if (checkAction(Auth::id(), 'general__setting-travaux', 'create') || role() == 's_admin')
								<button type="submit" id="xtravaux_product_UpdateBtn" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Create') }}</button>
							@else
								<button type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3"><span class="novecologie-icon-lock py-1"></span> {{ __('Create') }}</button>
							@endif
						</div>
					</form>
					<h1 class="modal-title text-center my-5">{{ __('All Travaux') }}</h1>
					<div class="col-12 px-3">
						<div class="database-table-wrapper bg-white border">
							<div class="table-responsive simple-bar">
								<table class="table database-table w-100 mb-0">
									<thead class="database-table__header">
										<tr>
											<th>{{ __('Serial') }}</th>
											<th>{{ __('Travaux') }}</th>
											<th>Barème</th>
											<th class="text-center">{{ __('Action') }}</th>
										</tr>
									</thead>
									<tbody class="database-table__body">
										@foreach ($travaux_list as $item)
											<tr>
												<td>{{ $loop->iteration }}</td>
												<td>{{ $item->travaux }}</td>
												<td>{{ $item->getBareme->wording ?? '' }}</td>
												<td class="text-center">
													<div class="dropdown dropdown--custom p-0 d-inline-block">
														<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															<span class="novecologie-icon-dots-horizontal-triple"></span>
														</button>
														<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
															<button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#travaux_edit2{{ $item->id }}">
																<span class="novecologie-icon-edit mr-1"></span>
																{{ __('Edit') }}
															</button>
															<button type="submit" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#travaux_delete2{{ $item->id }}">
																<span class="novecologie-icon-trash mr-1"></span>
																	Supprimer
															</button>
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
			</div>
			</div>
		</div>



		<div class="modal modal--aside fade leftAsideModal" id="BarèmesModal" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
			<div class="modal-dialog m-0 h-100 bg-white">
			<div class="modal-content simple-bar border-0 h-100 rounded-0">
				<div class="modal-header border-0">
					<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
						<span class="novecologie-icon-close"></span>
					</button>
				</div>
				<div class="modal-body">
					<h1 id="updatedtagTitle" class="modal-title text-center mb-5">Barèmes/Travaux/Tag</h1>
					<form action="{{ route('bareme.travaux.tag.create') }}" class="form mx-auto needs-validation"  novalidate method="POST">
						@csrf
						<div class="form-group">
							<label class="form-label" for="rank">Rank</label>
							<Select id="rank" name="rank" data-id="baremesFieldBox" class="select2_select_option custom-select shadow-none form-control rankChange" required>
								<option value="1">1</option>
								<option value="2">2</option>
							</Select>
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div id="baremesFieldBox">
							<div class="form-group">
								<label class="form-label" for="bareme">Barèmes</label>
								<input type="text" id="bareme" name="bareme" class="form-control shadow-none rounded" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="bareme_description">Barèmes {{ __('Description') }}</label>
								<textarea  id="bareme_description" name="bareme_description" class="form-control shadow-none rounded" required></textarea>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="travauxx">Travaux</label>
							<input type="text" id="travauxx" name="travaux" class="form-control shadow-none rounded" required>
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="tag">Tag</label>
							<input type="text" id="tag" name="tag" class="form-control shadow-none rounded" required>
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="grand_precaire_montant_maprime_no_fioul">Grand Precaire Montant MAPRIMERENOV No Fioul €</label>
							<input type="number" step="any" value="0" id="grand_precaire_montant_maprime_no_fioul" name="grand_precaire_montant_maprime_no_fioul" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="grand_precaire_montant_maprime_fioul">Grand Precaire Montant MAPRIMERENOV Fioul €</label>
							<input type="number" step="any" value="0" id="grand_precaire_montant_maprime_fioul" name="grand_precaire_montant_maprime_fioul" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="grand_precaire_montant_cee_no_fioul">Grand Precaire Montant C.E.E No Fioul €</label>
							<input type="number" step="any" value="0" id="grand_precaire_montant_cee_no_fioul" name="grand_precaire_montant_cee_no_fioul" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="grand_precaire_montant_cee_fioul">Grand Precaire Montant C.E.E Fioul €</label>
							<input type="number" step="any" value="0" id="grand_precaire_montant_cee_fioul" name="grand_precaire_montant_cee_fioul" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="precaire_montant_maprime_no_fioul">Precaire Montant MAPRIMERENOV No Fioul €</label>
							<input type="number" step="any" value="0" id="precaire_montant_maprime_no_fioul" name="precaire_montant_maprime_no_fioul" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="precaire_montant_maprime_fioul">Precaire Montant MAPRIMERENOV Fioul €</label>
							<input type="number" step="any" value="0" id="precaire_montant_maprime_fioul" name="precaire_montant_maprime_fioul" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="precaire_montant_cee_no_fioul">Precaire Montant C.E.E No Fioul €</label>
							<input type="number" step="any" value="0" id="precaire_montant_cee_no_fioul" name="precaire_montant_cee_no_fioul" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="precaire_montant_cee_fioul">Precaire Montant C.E.E Fioul €</label>
							<input type="number" step="any" value="0" id="precaire_montant_cee_fioul" name="precaire_montant_cee_fioul" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="intermediaire_montant_maprime_no_fioul">Intermediaire Montant MAPRIMERENOV No Fioul €</label>
							<input type="number" step="any" value="0" id="intermediaire_montant_maprime_no_fioul" name="intermediaire_montant_maprime_no_fioul" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="intermediaire_montant_maprime_fioul">Intermediaire Montant MAPRIMERENOV Fioul €</label>
							<input type="number" step="any" value="0" id="intermediaire_montant_maprime_fioul" name="intermediaire_montant_maprime_fioul" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="intermediaire_montant_cee_no_fioul">Intermediaire Montant C.E.E No Fioul €</label>
							<input type="number" step="any" value="0" id="intermediaire_montant_cee_no_fioul" name="intermediaire_montant_cee_no_fioul" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="intermediaire_montant_cee_fioul">Intermediaire Montant C.E.E Fioul €</label>
							<input type="number" step="any" value="0" id="intermediaire_montant_cee_fioul" name="intermediaire_montant_cee_fioul" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="classique_montant_maprime_no_fioul">Classique Montant MAPRIMERENOV No Fioul €</label>
							<input type="number" step="any" value="0" id="classique_montant_maprime_no_fioul" name="classique_montant_maprime_no_fioul" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="classique_montant_maprime_fioul">Classique Montant MAPRIMERENOV Fioul €</label>
							<input type="number" step="any" value="0" id="classique_montant_maprime_fioul" name="classique_montant_maprime_fioul" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="classique_montant_cee_no_fioul">Classique Montant C.E.E No Fioul €</label>
							<input type="number" step="any" value="0" id="classique_montant_cee_no_fioul" name="classique_montant_cee_no_fioul" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="classique_montant_cee_fioul">Classique Montant C.E.E Fioul €</label>
							<input type="number" step="any" value="0" id="classique_montant_cee_fioul" name="classique_montant_cee_fioul" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>

						<div class="form-group d-flex flex-column align-items-center mt-4">
							<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Create') }}</button>
						</div>
					</form>
				</div>
			</div>
			</div>
		</div>
		{{-- <div class="modal modal--aside fade leftAsideModal" id="BarèmesModal" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
			<div class="modal-dialog m-0 h-100 bg-white">
			<div class="modal-content simple-bar border-0 h-100 rounded-0">
				<div class="modal-header border-0">
					<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
						<span class="novecologie-icon-close"></span>
					</button>
				</div>
				<div class="modal-body">
					<h1 id="updatedtagTitle" class="modal-title text-center mb-5">{{ __('Nouvelle sous-opération') }}</h1>
					<form action="{{ route('scale.create') }}" class="form mx-auto needs-validation"  novalidate method="POST">
						@csrf
						<div class="form-group">
							<label class="form-label" for="wording">{{ __('Libellé') }} :</label>
							<input type="text" id="wording" name="wording" class="form-control shadow-none rounded" required>
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>

						<div class="form-group">
							<label class="form-label" for="description">{{ __('Description') }} :</label>
							<textarea  id="description" name="description" class="form-control shadow-none rounded" required></textarea>
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="kwh_cumac">Kwh Cumac :</label>
							<input type="text" id="kwh_cumac" name="kwh_cumac" class="form-control shadow-none rounded" required>
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="prime_coup">Prime Coup de pouce CEE :</label>
							<input type="text" id="prime_coup" name="prime_coup" class="form-control shadow-none rounded" required>
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="bareme_travaux1"> Travaux :</label>
							<select name="travaux" id="bareme_travaux1"  class="custom-select shadow-none form-control">
								<option value="" selected>{{ __('Select') }}</option>
								 @foreach ($travaux_list as $travaux)
									 <option value="{{ $travaux->id }}">{{ $travaux->travaux }}</option>
								 @endforeach
							</select>
						</div>
						<div class="form-group">
							<label class="form-label" for="barame_tag1"> TAG :</label>
							<select name="tag" id="barame_tag1"  class="custom-select shadow-none form-control">
								<option value="" selected>{{ __('Select') }}</option>
								@foreach ($tags as $tag)
								<option value="{{ $tag->id }}">{{ $tag->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label class="form-label" for="barame_product1"> Produits :</label>
							<select name="product[]" id="barame_product1"  class="select2_select_option custom-select shadow-none form-control" multiple>
								  @foreach ($products as $product)
									  <option value="{{ $product->id }}">{{ $product->reference }}</option>
								  @endforeach
							</select>
						</div>
						<div class="form-group">
							<label class="form-label" for="include_price">{{ __('Inclure le prix dans les prestations') }} :</label>
							<select name="include_price" id="include_price"  class="custom-select shadow-none form-control">
								<option value="OUI">{{ __('OUI') }}</option>
								<option selected value="NON">{{ __('NON') }}</option>
							</select>
						</div>

						<div class="form-group d-flex">
							<label class="form-label" for="activeSwitch">{{ __('Activer') }} :</label>
							<div class="custom-control custom-switch ml-1">
								<input type="checkbox" name="active" value="yes" class="custom-control-input" id="activeSwitch">
								<label class="custom-control-label" for="activeSwitch"></label>
							</div>
						</div>

						<div class="form-group d-flex flex-column align-items-center mt-4">
							<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Create') }}</button>
						</div>
					</form>
				</div>
			</div>
			</div>
		</div> --}}
		<div class="modal modal--aside fade leftAsideModal" id="DelegatesModal" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
			<div class="modal-dialog m-0 h-100 bg-white">
			<div class="modal-content simple-bar border-0 h-100 rounded-0">
				<div class="modal-header border-0">
					<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
						<span class="novecologie-icon-close"></span>
					</button>
				</div>
				<div class="modal-body">
					<h1 id="updatedtagTitle" class="modal-title text-center mb-5">{{ __('Organisme') }}</h1>
					<form action="{{ route('delegate.create') }}" class="form mx-auto needs-validation" enctype="multipart/form-data" novalidate method="POST">
						@csrf
						<div class="form-group">
							<label class="form-label" for="logo">{{ __('Logo') }} :</label>
							<input type="file" id="logo" name="logo" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="company_name">{{ __('Raison sociale') }} :</label>
							<input type="text" id="company_name" name="company_name" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="bonus_ratio">{{ __('Ratio prime bénéficiaire') }} :</label>
							<input type="text" id="bonus_ratio" name="bonus_ratio" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="premium_ratio">{{ __('Ratio prime installateur') }} :</label>
							<input type="text" id="premium_ratio" name="premium_ratio" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>

						<div class="form-group d-flex flex-column align-items-center mt-4">
							<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Create') }}</button>
						</div>
					</form>
				</div>
			</div>
			</div>
		</div>
		<div class="modal modal--aside fade leftAsideModal" id="dealModal" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
			<div class="modal-dialog m-0 h-100 bg-white">
			<div class="modal-content simple-bar border-0 h-100 rounded-0">
				<div class="modal-header border-0">
					<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
						<span class="novecologie-icon-close"></span>
					</button>
				</div>
				<div class="modal-body">
					<h1 id="updatedtagTitle" class="modal-title text-center mb-5">{{ __('Deals') }}</h1>
					<form action="{{ route('deal.create') }}" class="form mx-auto needs-validation" enctype="multipart/form-data" novalidate method="POST">
						@csrf
						<div class="form-group">
							<label class="form-label" for="name">{{ __('Nom') }} :</label>
							<input type="text" id="name" name="name" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="delegate">{{ __('Délégataire') }} :</label>
							<input type="text" id="delegate" name="delegate" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>

						<div class="form-group">
							<label class="form-label" for="terms_and_conditions">Termes et conditions CEE :</label>
							<textarea name="terms_and_conditions" id="terms_and_conditions" class="form-control shadow-none rounded" required></textarea>
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>

						<div class="form-group">
							<label class="form-label" for="version">{{ __('Version') }} :</label>
							<input type="text" id="version" name="version" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="volume">{{ __('Volume Cumac') }} :</label>
							<input type="text" id="volume" name="volume" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="default">{{ __('Par défault') }} :</label>
							<select id="default" name="default" class="form-control shadow-none rounded">
								<option value="Oui">OUI</option>
								<option value="Non">NON</option>
							</select>
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="locked">{{ __('Verrouillé') }} :</label>
							<select id="locked" name="locked" class="form-control shadow-none rounded">
								<option value="Oui">OUI</option>
								<option value="Non">NON</option>
							</select>
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>

						<div class="form-group d-flex flex-column align-items-center mt-4">
							<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Create') }}</button>
						</div>
					</form>
				</div>
			</div>
			</div>
		</div>
		<div class="modal modal--aside fade leftAsideModal" id="installerModal" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
			<div class="modal-dialog m-0 h-100 bg-white">
			<div class="modal-content simple-bar border-0 h-100 rounded-0">
				<div class="modal-header border-0">
					<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
						<span class="novecologie-icon-close"></span>
					</button>
				</div>
				<div class="modal-body">
					<h1 id="updatedtagTitle" class="modal-title text-center mb-5">Entreprise de travaux</h1>
					<form action="{{ route('installer.create') }}" class="form mx-auto needs-validation" enctype="multipart/form-data" novalidate method="POST">
						@csrf
						<div class="form-group">
							<label class="form-label" for="logo">{{ __('Logo') }} :</label>
							<input type="file" id="logo" name="logo" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="company_name2">{{ __('Raison sociale') }} :*</label>
							<input type="text" id="company_name2" name="company_name" class="form-control shadow-none rounded" required>
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="namee">{{ __('Nom') }} :</label>
							<input type="text" id="namee" name="name" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="first_name">{{ __('Prénom') }} :*</label>
							<input type="text" id="first_name" name="first_name" class="form-control shadow-none rounded" required>
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="number">{{ __('Numéro SIREN') }} :</label>
							<input type="number" id="number" name="number" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="subcontact">{{ __('Sous-traitance') }} :</label>
							<select id="subcontact" name="subcontact" class="form-control shadow-none rounded">
								<option value="Oui">OUI</option>
								<option value="Non">NON</option>
							</select>
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="defaultt">{{ __('Par défault') }} :</label>
							<select id="defaultt" name="default" class="form-control shadow-none rounded">
								<option value="Oui">OUI</option>
								<option value="Non">NON</option>
							</select>
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="activeee">{{ __('Activé') }} :</label>
							<select id="activeee" name="active" class="form-control shadow-none rounded">
								<option value="Oui">OUI</option>
								<option value="Non">NON</option>
							</select>
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>

						<div class="form-group d-flex flex-column align-items-center mt-4">
							<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Create') }}</button>
						</div>
					</form>
				</div>
			</div>
			</div>
		</div>
		<div class="modal modal--aside fade leftAsideModal" id="AMOModal" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
			<div class="modal-dialog m-0 h-100 bg-white">
			<div class="modal-content simple-bar border-0 h-100 rounded-0">
				<div class="modal-header border-0">
					<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
						<span class="novecologie-icon-close"></span>
					</button>
				</div>
				<div class="modal-body">
					<h1 id="updatedtagTitle" class="modal-title text-center mb-5">{{ __('AMO') }}</h1>
					<form action="{{ route('amo.create') }}" class="form mx-auto needs-validation" enctype="multipart/form-data" novalidate method="POST">
						@csrf
						<div class="form-group">
							<label class="form-label" for="logo">{{ __('Logo') }} :</label>
							<input type="file" id="logo" name="logo" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="company_name3">{{ __('Raison sociale') }} :</label>
							<input type="text" id="company_name3" name="company_name" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="number">{{ __('Numéro SIREN') }} :</label>
							<input type="number" id="number" name="number" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="signatory">{{ __('Signataire') }} :</label>
							<input type="text" id="signatory" name="signatory" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="defaultt">{{ __('Par défault') }} :</label>
							<select id="defaultt" name="default" class="form-control shadow-none rounded">
								<option value="Oui">OUI</option>
								<option value="Non">NON</option>
							</select>
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="activeee">{{ __('Activé') }} :</label>
							<select id="activeee" name="active" class="form-control shadow-none rounded">
								<option value="Oui">OUI</option>
								<option value="Non">NON</option>
							</select>
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>

						<div class="form-group d-flex flex-column align-items-center mt-4">
							<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Create') }}</button>
						</div>
					</form>
				</div>
			</div>
			</div>
		</div>
		<div class="modal modal--aside fade leftAsideModal" id="AgentModal" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
			<div class="modal-dialog m-0 h-100 bg-white">
			<div class="modal-content simple-bar border-0 h-100 rounded-0">
				<div class="modal-header border-0">
					<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
						<span class="novecologie-icon-close"></span>
					</button>
				</div>
				<div class="modal-body">
					<h1 id="updatedtagTitle" class="modal-title text-center mb-5">{{ __('Mandataire Anah') }}</h1>
					<form action="{{ route('agent.create') }}" class="form mx-auto needs-validation" enctype="multipart/form-data" novalidate method="POST">
						@csrf
						<div class="form-group">
							<label class="form-label" for="logo">{{ __('Logo') }} :</label>
							<input type="file" id="logo" name="logo" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="company_name">{{ __('Raison sociale') }} :*</label>
							<input type="text" id="company_name" name="company_name" class="form-control shadow-none rounded" required>
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="number">{{ __('Numéro SIREN') }} :</label>
							<input type="number" id="number" name="number" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="signatory">{{ __('Signataire') }} :</label>
							<input type="text" id="signatory" name="signatory" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="default">{{ __('Par défault') }} :</label>
							<select id="default" name="default" class="form-control shadow-none rounded">
								<option value="Oui">OUI</option>
								<option value="Non">NON</option>
							</select>
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="active">{{ __('Activé') }} :</label>
							<select id="active" name="active" class="form-control shadow-none rounded">
								<option value="Oui">OUI</option>
								<option value="Non">NON</option>
							</select>
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>

						<div class="form-group d-flex flex-column align-items-center mt-4">
							<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Create') }}</button>
						</div>
					</form>
				</div>
			</div>
			</div>
		</div>
		<div class="modal modal--aside fade leftAsideModal" id="AuditorModal" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
			<div class="modal-dialog m-0 h-100 bg-white">
			<div class="modal-content simple-bar border-0 h-100 rounded-0">
				<div class="modal-header border-0">
					<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
						<span class="novecologie-icon-close"></span>
					</button>
				</div>
				<div class="modal-body">
					<h1 id="updatedtagTitle" class="modal-title text-center mb-5">{{ __('Prestataire énergétique') }}</h1>
					<form action="{{ route('auditor.create') }}" class="form mx-auto needs-validation" enctype="multipart/form-data" novalidate method="POST">
						@csrf
						<div class="form-group">
							<label class="form-label" for="logo">{{ __('Logo') }} :</label>
							<input type="file" id="logo" name="logo" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="company_name">{{ __('Raison sociale') }} :</label>
							<input type="text" id="company_name" name="company_name" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="number">{{ __('Numéro SIREN') }} :</label>
							<input type="number" id="number" name="number" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="signatory">{{ __('Signataire') }} :</label>
							<input type="text" id="signatory" name="signatory" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="active">{{ __('Activé') }} :</label>
							<select id="active" name="active" class="form-control shadow-none rounded">
								<option value="Oui">OUI</option>
								<option value="Non">NON</option>
							</select>
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>

						<div class="form-group d-flex flex-column align-items-center mt-4">
							<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Create') }}</button>
						</div>
					</form>
				</div>
			</div>
			</div>
		</div>
		<div class="modal modal--aside fade leftAsideModal" id="areaModal" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
			<div class="modal-dialog m-0 h-100 bg-white">
			<div class="modal-content simple-bar border-0 h-100 rounded-0">
				<div class="modal-header border-0">
					<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
						<span class="novecologie-icon-close"></span>
					</button>
				</div>
				<div class="modal-body">
					<h1 id="updatedtagTitle" class="modal-title text-center mb-5">Les zones d'intervention</h1>
					<form action="{{ route('area.create') }}" class="form mx-auto needs-validation" enctype="multipart/form-data" novalidate method="POST">
						@csrf
						<div class="form-group">
							<label class="form-label" for="color">{{ __('Couleur') }} :</label>
							<input type="color" id="color" name="color" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="wording">{{ __('Libellé') }} :</label>
							<input type="text" id="wording" name="wording" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="active">{{ __('Activé') }} :</label>
							<select id="active" name="active" class="form-control shadow-none rounded">
								<option value="Oui">OUI</option>
								<option value="Non">NON</option>
							</select>
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>

						<div class="form-group d-flex flex-column align-items-center mt-4">
							<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Create') }}</button>
						</div>
					</form>
				</div>
			</div>
			</div>
		</div>
		<div class="modal modal--aside fade leftAsideModal" id="controlModal" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
			<div class="modal-dialog m-0 h-100 bg-white">
			<div class="modal-content simple-bar border-0 h-100 rounded-0">
				<div class="modal-header border-0">
					<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
						<span class="novecologie-icon-close"></span>
					</button>
				</div>
				<div class="modal-body">
					<h1 id="updatedtagTitle" class="modal-title text-center mb-5">Bureau de contrôle</h1>
					<form action="{{ route('control.create') }}" class="form mx-auto needs-validation" enctype="multipart/form-data" novalidate method="POST">
						@csrf
						<div class="form-group">
							<label class="form-label" for="logo">{{ __('Logo') }} :</label>
							<input type="file" id="logo" name="logo" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="company_name">{{ __('Raison sociale') }} :</label>
							<input type="text" id="company_name" name="company_name" class="form-control shadow-none rounded" required>
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="number">{{ __('Numéro SIREN') }} :</label>
							<input type="number" id="number" name="number" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="contact_name">{{ __('Nom Contact') }} :</label>
							<input type="text" id="contact_name" name="contact_name" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="active">{{ __('Activé') }} :</label>
							<select id="active" name="active" class="form-control shadow-none rounded">
								<option value="Oui">OUI</option>
								<option value="Non">NON</option>
							</select>
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>

						<div class="form-group d-flex flex-column align-items-center mt-4">
							<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Create') }}</button>
						</div>
					</form>
				</div>
			</div>
			</div>
		</div>
		<div class="modal modal--aside fade leftAsideModal" id="brandModal" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
			<div class="modal-dialog m-0 h-100 bg-white">
			<div class="modal-content simple-bar border-0 h-100 rounded-0">
				<div class="modal-header border-0">
					<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
						<span class="novecologie-icon-close"></span>
					</button>
				</div>
				<div class="modal-body">
					<h1 id="updatedtagTitle" class="modal-title text-center mb-5">{{ __('Marque') }}</h1>
					<form action="{{ route('brand.create') }}" class="form mx-auto needs-validation" enctype="multipart/form-data" novalidate method="POST">
						@csrf
						<div class="form-group">
							<label class="form-label" for="logo">{{ __('Logo') }} :</label>
							<input type="file" id="logo" name="logo" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="description">{{ __('Description') }} :</label>
							<textarea id="description" name="description" class="form-control shadow-none rounded"></textarea>
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="source">{{ __('Source') }} :</label>
							<input type="text" id="source" name="source" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="active">{{ __('Activé') }} :</label>
							<select id="active" name="active" class="form-control shadow-none rounded">
								<option value="Oui">OUI</option>
								<option value="Non">NON</option>
							</select>
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>

						<div class="form-group d-flex flex-column align-items-center mt-4">
							<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Create') }}</button>
						</div>
					</form>
				</div>
			</div>
			</div>
		</div>
		<div class="modal modal--aside fade leftAsideModal" id="benefitModal" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
			<div class="modal-dialog m-0 h-100 bg-white">
			<div class="modal-content simple-bar border-0 h-100 rounded-0">
				<div class="modal-header border-0">
					<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
						<span class="novecologie-icon-close"></span>
					</button>
				</div>
				<div class="modal-body">
					<h1 id="updatedtagTitle" class="modal-title text-center mb-5">{{ __('Prestations') }}</h1>
					<form action="{{ route('benefit.create') }}" class="form mx-auto needs-validation" enctype="multipart/form-data" novalidate method="POST">
						@csrf
						<div class="row align-items-center">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="form-group">
									<label class="form-label" for="alias">{{ __('Alias') }} : <span class="text-danger">*</span></label>
									<input type="text" id="alias" name="alias" class="form-control shadow-none rounded" required>
									<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
								</div>
							</div>
							<hr class="w-100 my-1">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<label class="form-label" for="title">{{ __('Titre') }} :<span class="text-danger">**</span></label>
									<input type="text" id="title" name="title" class="form-control shadow-none rounded" required>
									<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="switches d-flex justify-content-between align-items-center">
									<label for="#" class="form-label m-0">Récupérer la référence du produit lié :</label>
									<div class="custom-control custom-switch">
										<input type="checkbox" name="reference_link" class="custom-control-input" id="titleDisabled">
										<label class="custom-control-label" for="titleDisabled"></label>
								  	</div>
								</div>
							</div>
							<hr class="w-100 my-1">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<label class="form-label" for="designation">{{ __('Designation') }} : <span class="text-danger">**</span></label>
									<textarea id="designation" name="designation" class="form-control shadow-none rounded" required></textarea>
									<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="switches d-flex justify-content-between align-items-center">
									<label for="#" class="form-label m-0">Récupérer la désignation du produit lié :</label>
									<div class="custom-control custom-switch">
										<input type="checkbox" name="designation_link" class="custom-control-input" id="designationDisabled">
										<label class="custom-control-label" for="designationDisabled"></label>
								  	</div>
								</div>
							</div>
							<hr class="w-100 my-1">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
								<p class="m-0">(<span class="text-danger">**</span>)L'un des deux champs est obligatoire</p>
							</div>
							<hr class="w-100 my-1">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<label for="#" class="form-label">Position d'affichage :</label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
									  <button class="btn btn-outline-secondary shadow-none position_decrease" data-id="0" type="button" id="button-addon1">-</button>
									</div>
									<input type="number" class="form-control shadow-none" id="position0" name="position" value="1" min="0" aria-label="Example text with button addon" aria-describedby="button-addon1">
									<div class="input-group-append">
										<button class="btn btn-outline-secondary shadow-none position_increase" data-id="0" type="button" id="button-addon2">+</button>
									  </div>
								  </div>
							</div>
							<hr class="w-100 my-1">
							<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
								<label for="#" class="form-label">Quantité :</label>
								<input type="number" name="quantity" class="form-control shadow-none rounded">
							</div>
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<label for="#" class="form-label">Unité :</label>
								<select id="active" name="unit" class="select2_select_option form-control select2-hidden-accessible rounded">
									<option value="m²">m²</option>
									<option value="m³">m³</option>
									<option value="ml">ml</option>
									<option value="litre">litre</option>
									<option value="heure">heure</option>
									<option value="jour">jour</option>
								</select>
							</div>
							<hr class="w-100">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<label for="#" class="form-label">Barèmes concernés :</label>
								<select id="operation" name="operation[]" class="select2_select_option custom-select shadow-none form-control" multiple>
									@foreach ($scales->where('active', 'yes') as $scale)
										<option value="{{ $scale->id }}">{{ $scale->wording }}-{{ $scale->description }}</option>
									@endforeach
								</select>
							</div>
							<hr class="w-100">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<label for="one">Prix de vente :</label>
								<div class="input-group">
									<input type="text" id="price" name="price" class="form-control shadow-none">
									<div class="input-group-append">
									  <span class="input-group-text">Є</span>
									</div>
								  </div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="switches d-flex justify-content-between align-items-center">
									<label for="priceDesabled" class="form-label m-0">Ou prendre le prix du produit lié :</label>
									<div class="custom-control custom-switch">
										<input type="checkbox" name="related_price" class="custom-control-input" id="priceDesabled">
										<label class="custom-control-label" for="priceDesabled"></label>
								  	</div>
								</div>
							</div>
							<hr class="w-100">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<label for="custom_label--1">Taux TVA :</label>
								<select id="tax" name="tax" class="select2_select_option form-control select2-hidden-accessible rounded">
									<option value="0">Non spécifiée</option>
									<option value="5.5">Taux réduit à 5,5 %</option>
									<option value="20">Taux normal à 20 %</option>
								</select>
							</div>
							<hr class="w-100">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
								<div class="switches d-flex justify-content-between align-items-center">
									<label for="customSwitch4" class="form-label m-0">Activer :</label>
									<div class="custom-control custom-switch">
										<input type="checkbox" name="active" class="custom-control-input" id="customSwitch4" checked>
										<label class="custom-control-label" for="customSwitch4"></label>
								  	</div>
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
								<div class="switches d-flex justify-content-between align-items-center">
									<label for="customSwitch5" class="form-label m-0">Afficher les prix :</label>
									<div class="custom-control custom-switch">
										<input type="checkbox" name="price_show" class="custom-control-input" id="customSwitch5" checked>
										<label class="custom-control-label" for="customSwitch5"></label>
								  	</div>
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
								<div class="switches d-flex justify-content-between align-items-center">
									<label for="customSwitch6" class="form-label m-0">A rappeler dynamiquement :</label>
									<div class="custom-control custom-switch">
										<input type="checkbox" name="recall" class="custom-control-input" id="customSwitch6">
										<label class="custom-control-label" for="customSwitch6"></label>
								  	</div>
								</div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
								<button class="btn submit-btn-trans shadow-none">Retour à la liste</button>
								<button type="submit" class="btn submit_btn_color shadow-none ml-3">Enregistrer</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			</div>
		</div>
		<div class="modal modal--aside fade leftAsideModal" id="fournesserModal" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
			<div class="modal-dialog m-0 h-100 bg-white">
			<div class="modal-content simple-bar border-0 h-100 rounded-0">
				<div class="modal-header border-0">
					<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
						<span class="novecologie-icon-close"></span>
					</button>
				</div>
				<div class="modal-body">
					<h1 id="updatedtagTitle" class="modal-title text-center mb-5">{{ __('Fournisseurs') }}</h1>
					<form action="{{ route('fournesser.create') }}" class="form mx-auto needs-validation" enctype="multipart/form-data" novalidate method="POST">
						@csrf
						<div class="form-group">
							<label class="form-label" for="logo">{{ __('Logo') }} :</label>
							<input type="file" id="logo" name="logo" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="suplier">{{ __('Fournisseur') }} :</label>
							<input type="text" id="suplier" name="suplier" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="description">{{ __('Description') }} :</label>
							<textarea id="description" name="description" class="form-control shadow-none rounded"></textarea>
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label">Type :</label>
							<select name="type" class="form-control shadow-none rounded">
								<option selected value="">{{ __("Select") }}</option>
								@foreach ($type_fournisseurs as $type_fournisseur)
									<option value="{{ $type_fournisseur->name }}">{{ $type_fournisseur->name }}</option>
								@endforeach
							</select>
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="active">{{ __('Activé') }} :</label>
							<select id="active" name="active" class="form-control shadow-none rounded">
								<option value="Oui">OUI</option>
								<option value="Non">NON</option>
							</select>
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group d-flex flex-column align-items-center mt-4">
							<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Create') }}</button>
						</div>
					</form>
				</div>
			</div>
			</div>
		</div>
		<div class="modal modal--aside fade leftAsideModal" id="client_companyModal" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
			<div class="modal-dialog m-0 h-100 bg-white">
			<div class="modal-content simple-bar border-0 h-100 rounded-0">
				<div class="modal-header border-0">
					<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
						<span class="novecologie-icon-close"></span>
					</button>
				</div>
				<div class="modal-body">
					<h1 id="updatedtagTitle" class="modal-title text-center mb-5">{{ __('Societé client') }}</h1>
					<form action="{{ route('client_company.create') }}" class="form mx-auto needs-validation" enctype="multipart/form-data" novalidate method="POST">
						@csrf
						<div class="form-group">
							<label class="form-label" for="logo">{{ __('Logo') }} :</label>
							<input type="file" id="logo" name="logo" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="company_name">{{ __('Raison sociale') }} :</label>
							<input type="text" id="company_name" name="company_name" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="description">{{ __('Description') }} :</label>
							<textarea id="description" name="description" class="form-control shadow-none rounded"></textarea>
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="active">{{ __('Activé') }} :</label>
							<select id="active" name="active" class="form-control shadow-none rounded">
								<option value="Oui">OUI</option>
								<option value="Non">NON</option>
							</select>
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group d-flex flex-column align-items-center mt-4">
							<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Create') }}</button>
						</div>
					</form>
				</div>
			</div>
			</div>
		</div>

		<div class="modal modal--aside fade leftAsideModal" id="produitsCreateModal" tabindex="-1" aria-labelledby="produitsCreateModalLabel" aria-hidden="true">
			<div class="modal-dialog m-0 h-100 bg-white">
			<div class="modal-content simple-bar border-0 h-100 rounded-0">
				<div class="modal-header border-0">
					<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
						<span class="novecologie-icon-close"></span>
					</button>
				</div>
				<div class="modal-body mr-2">
					<h1 class="modal-title text-center mb-5">{{ __('Nouveau Produit') }}</h1>
					<form action="{{ route('product.store') }}" class="form" method="post" enctype="multipart/form-data">
						@csrf
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6">
								<div class="form-group">
									<label for="#">Type isolant/ Produit :</label>
									<input type="text" name="product_type" class="form-control shadow-none rounded">
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6">
								<div class="form-group">
									<label for="#">Catégorie :</label>
									<select class="select2_select_option form-control" name="category_id">
										@foreach ($categories as $category)
                                        	<option value="{{ $category->id }}">{{ $category->name }}</option>
										@endforeach
                                    </select>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6">
								<div class="form-group">
									<label for="#">Marque : <span class="text-danger">*</span></label>
									<select class="select2_select_option form-control" name="marque_id" required>
										@foreach ($brands as $marque)
                                        	<option value="{{ $marque->id }}"> {{ $marque->description }} </option>
										@endforeach
                                    </select>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6">
								<div class="form-group">
									<label for="#">Sous-Catégorie :</label>
									<select class="select2_select_option form-control" name="subcategory_id">
										@foreach ($subcategories as $sub_cat)
											<option value="{{ $sub_cat->id }}">{{ $sub_cat->name }}</option>
										@endforeach
                                    </select>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6">
								<div class="form-group">
									<label for="#">Référence : <span class="text-danger">*</span></label>
									<input type="text" name="reference" class="form-control shadow-none rounded" required>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6">
								<div class="form-group">
									<label for="#">Norme  :</label>
									<input type="text" name="standard" class="form-control shadow-none rounded">
								</div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12">
								<div class="form-group">
									<label for="#">Designation :<span class="text-danger">*</span></label>
									<textarea class="form-control shadow-none rounded" name="designation" rows="3" required></textarea>
								</div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12">
								<div class="form-group">
									<label for="#">Note de dimensionnement :</label>
									<textarea class="form-control shadow-none rounded"  name="sizing_note" rows="3"></textarea>
								</div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12">
								<label for="#">Acermi :</label>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-4">
								<div class="form-group">
									<input type="text" placeholder="Référence" name="acermi_reference" class="form-control shadow-none rounded">
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-4">
								<div class="form-group">
									<input type="date" name="acermi_date" class="flatpickr form-control shadow-none rounded">
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-4">
								<div class="input-group mb-3">
									<div class="custom-file">
									  <input type="file" name="acermi_file" class="custom-file-input form-control" id="inputGroupFile02">
									  <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
									</div>
								  </div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12">
								<label for="#">Certita :</label>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-4">
								<div class="form-group">
									<input type="text" placeholder="Référence" name="certita_reference" class="form-control shadow-none rounded">
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-4">
								<div class="form-group">
									<input type="date" name="certita_date" class="flatpickr form-control shadow-none rounded">
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-4">
								<div class="input-group mb-3">
									<div class="custom-file">
									  <input type="file" name="certita_file" class="custom-file-input form-control" id="inputGroupFile03">
									  <label class="custom-file-label" for="inputGroupFile03" aria-describedby="inputGroupFileAddon02">Choose file</label>
									</div>
								  </div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12">
								<label for="#">Avis technique :</label>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-4">
								<input type="text" name="notice_reference" class="form-control shadow-none rounded" placeholder="Référence">
							</div>
							<div class="col-lg-4 col-md-4 col-sm-4">
								<input type="date" name="notice_date" class="flatpickr form-control shadow-none rounded" placeholder="Date de Validité">
							</div>
							<div class="col-lg-4 col-md-4 col-sm-4">
								<div class="input-group mb-3">
									<div class="custom-file">
									  <input type="file" name="notice_file" class="custom-file-input form-control" id="inputGroupFile04">
									  <label class="custom-file-label" for="inputGroupFile04" aria-describedby="inputGroupFileAddon02">Choose file</label>
									</div>
								  </div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12">
								<label for="#">Fiche Technique :</label>
							</div>
							<div class="col-lg-8 col-md-9 col-sm-8">
								<div class="input-group mb-3">
									<div class="custom-file">
									  <input type="file" name="data_file" class="custom-file-input form-control" id="inputGroupFile05">
									  <label class="custom-file-label" for="inputGroupFile05" aria-describedby="inputGroupFileAddon02">Choose file</label>
									</div>
								  </div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6">
								<div class="switches d-flex">
									<label for="customSwitch43">Marquage CE :</label>
									<div class="custom-control custom-switch ml-4">
										<input type="checkbox" name="ce_marking" class="custom-control-input" id="customSwitch43">
										<label class="custom-control-label" for="customSwitch43"></label>
								  	</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 .col-sm-6">
								<div class="switches d-flex">
									<label for="customSwitch44">Activer :</label>
									<div class="custom-contro2 custom-switch ml-4">
										<input type="checkbox" name="activate" class="custom-control-input" id="customSwitch44" checked>
										<label class="custom-control-label" for="customSwitch44"></label>
								  	</div>
								</div>
							</div>
						</div>
						<div class="row">
							{{-- <div class="col-lg-12 col-md-12 col-sm-12">
								<label for="#">Barèmes concernés en B2C :</label>
								<select name="baremes[]" class="select2_select_option custom-select shadow-none form-control" multiple>
									@foreach ($scales->where('active', 'yes') as $scale)
									<option value="{{ $scale->id }}">{{ $scale->wording }}</option>
									@endforeach
								</select>
							</div> --}}
							<div class="col-12">
								<label for="#">Barèmes : <span class="text-danger">*</span></label>
								<select name="tags[]" class="select2_select_option custom-select shadow-none form-control" multiple required>
									@foreach ($bareme_travaux_tags as $tag)
									<option value="{{ $tag->id }}">{{ $tag->bareme }}</option>
									@endforeach
								</select>
							</div>
							<div class="col-12">
								<label class="form-label"> Prestation :</label>
								<select name="prestation_id[]" class="select2_select_option custom-select shadow-none form-control" multiple>
									@foreach ($benefits as $prestation)
										<option value="{{ $prestation->id }}">{{ $prestation->alias }}</option>
									@endforeach
								</select>
							</div> 
							{{-- <div class="col-lg-12 col-md-12 col-sm-12">
								<label for="#">Travaux :</label>
								<select id="travaux_id11" class="cselect2_select_option custom-select shadow-none form-control" required>
									<option value="">{{ __('Select') }}</option>
									@foreach ($travaux_list as $travau)
										<option value="{{ $travau->id }}">{{ $travau->travaux }}</option>
									@endforeach
								</select>
							</div>  --}}
							<div class="col-lg-12 col-md-12 col-sm-12">
								<label for="#">Mode de Pose :</label>
								<select class="select2_select_option form-control" name="installation_mode" required>
									<option value="Soufflé">Soufflé</option>
									<option value="Deroulé">Deroulé</option>
								</select>
							</div>

							<div class="col-lg-12 col-md-12 col-sm-12">
								<label for="#">Cap. de couverture :</label>
								<div class="input-group">
									<input type="number" class="form-control" name="covering_capacity" aria-label="Dollar amount (with dot and two decimal places)">
									<div class="input-group-append">
									  <span class="input-group-text">m2</span>
									</div>
								  </div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12">
								<label for="#">Epaisseur :</label>
								<div class="input-group">
									<input type="text" class="form-control" name="thikness" aria-label="Dollar amount (with dot and two decimal places)">
									<div class="input-group-append">
									  <span class="input-group-text">mm</span>
									</div>
								  </div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12">
								<label for="#">Rés. thermique 1 :</label>
								<div class="input-group">
									<input type="text" class="form-control" name="thermal_res" aria-label="Dollar amount (with dot and two decimal places)">
									<div class="input-group-append">
									  <span class="input-group-text">m².K/W</span>
									</div>
								  </div>
							</div>

							<div class="col-lg-12 col-md-12 col-sm-12 mt-4">
								<div class="form_submit_btn text-right">
									<button class="btn submit-btn-trans shadow-none">Retour à la liste</button>
									<button type="submit" class="btn submit_btn_color shadow-none ml-3">Enregistrer</button>
								</div>
						</div>
						</div>
					</form>
				</div>
			</div>
			</div>
		</div>
		@foreach ($travaux_list as $item)
			<div class="modal modal--aside fade leftAsideModal" id="travaux_edit{{ $item->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">{{ __('Travaux') }}</h1>
						<form action="{{ route('travaux.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div class="form-group">
								<label class="form-label" for="travaux">{{ __('Travaux') }} <span class="text-danger">*</span></label>
								<input type="hidden" name="id" value="{{ $item->id }}">
								<input type="text" name="travaux" value="{{ $item->travaux }}" class="form-control shadow-none rounded" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="bareme_id{{ $item->id }}">Barème :</label>
								<select id="bareme_id{{ $item->id }}" name="bareme_id" class="custom-select shadow-none form-control" required>
									<option value="">{{ __('Select') }}</option>
									@foreach ($scales as $bareme)
										@php
											$data = \App\Models\CRM\TravauxList::where('bareme_id', $bareme->id)->doesntExist();
										@endphp
										@if ($data || $bareme->id == $item->bareme_id)
											@if($bareme->id == $item->bareme_id)
												<option selected value="{{ $bareme->id }}">{{ $bareme->wording }}</option>
											@else
												<option value="{{ $bareme->id }}">{{ $bareme->wording }}</option>
											@endif
										@endif
									@endforeach
								</select>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="travaux_delete{{ $item->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content border-0">
						<div class="modal-header border-0 pb-0">
							<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
								<span class="novecologie-icon-close"></span>
							</button>
						</div>
						<div class="modal-body text-center pt-0">
							<h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
							<span>{{ __('Deleting this trauvax will removed all the connected products and questionnaires') }}</span>
							<form action="{{ route('travaux.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $item->id }}">
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
			<div class="modal modal--aside fade leftAsideModal" id="travaux_edit2{{ $item->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">{{ __('Travaux') }}</h1>
						<form action="{{ route('travaux.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div class="form-group">
								<label class="form-label" for="travaux">{{ __('Travaux') }} <span class="text-danger">*</span></label>
								<input type="hidden" name="id" value="{{ $item->id }}">
								<input type="hidden" name="product_tab" value="1">
								<input type="text" name="travaux" value="{{ $item->travaux }}" class="form-control shadow-none rounded" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="bareme_id2{{ $item->id }}">Barème :</label>
								<select id="bareme_id2{{ $item->id }}" name="bareme_id" class="custom-select shadow-none form-control" required>
									<option value="">{{ __('Select') }}</option>
									@foreach ($scales as $bareme)
										@php
											$data = \App\Models\CRM\TravauxList::where('bareme_id', $bareme->id)->doesntExist();
										@endphp
										@if ($data || $bareme->id == $item->bareme_id)
											@if($bareme->id == $item->bareme_id)
												<option selected value="{{ $bareme->id }}">{{ $bareme->wording }}</option>
											@else
												<option value="{{ $bareme->id }}">{{ $bareme->wording }}</option>
											@endif
										@endif
									@endforeach
								</select>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade leftAsideModal" id="travaux_edit3{{ $item->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">{{ __('Travaux') }}</h1>
						<form action="{{ route('travaux.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div class="form-group">
								<label class="form-label" for="travaux">{{ __('Travaux') }} <span class="text-danger">*</span></label>
								<input type="hidden" name="id" value="{{ $item->id }}">
								<input type="hidden" name="travaux_tab" value="1">
								<input type="text" name="travaux" value="{{ $item->travaux }}" class="form-control shadow-none rounded" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="bareme_id3{{ $item->id }}">Barème :</label>
								<select id="bareme_id3{{ $item->id }}" name="bareme_id" class="custom-select shadow-none form-control" required>
									<option value="">{{ __('Select') }}</option>
									@foreach ($scales as $bareme)
										@php
											$data = \App\Models\CRM\TravauxList::where('bareme_id', $bareme->id)->doesntExist();
										@endphp
										@if ($data || $bareme->id == $item->bareme_id)
											@if($bareme->id == $item->bareme_id)
												<option selected value="{{ $bareme->id }}">{{ $bareme->wording }}</option>
											@else
												<option value="{{ $bareme->id }}">{{ $bareme->wording }}</option>
											@endif
										@endif
									@endforeach
								</select>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="travaux_delete2{{ $item->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content border-0">
						<div class="modal-header border-0 pb-0">
							<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
								<span class="novecologie-icon-close"></span>
							</button>
						</div>
						<div class="modal-body text-center pt-0">
							<h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
							<span>{{ __('Deleting this trauvax will removed all the connected products and questionnaires') }}</span>
							<form action="{{ route('travaux.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $item->id }}">
								<input type="hidden" name="product_tab" value="1">
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
			<div class="modal modal--aside fade" id="travaux_delete3{{ $item->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content border-0">
						<div class="modal-header border-0 pb-0">
							<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
								<span class="novecologie-icon-close"></span>
							</button>
						</div>
						<div class="modal-body text-center pt-0">
							<h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
							<span>{{ __('Deleting this trauvax will removed all the connected products and questionnaires') }}</span>
							<form action="{{ route('travaux.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $item->id }}">
								<input type="hidden" name="travaux_tab" value="1">
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
		@endforeach
		@foreach (\App\Models\CRM\TravauxTag::all() as $tag)
			<div class="modal modal--aside fade leftAsideModal" id="travaux_tag_edit{{ $tag->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">{{ __('Update Tag') }}</h1>
						<form action="{{ route('travaux.tag.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div class="form-group">
								<label class="form-label" for="travaux_tag{{ $tag->id }}">Tag <span class="text-danger">*</span></label>
								<input type="hidden" name="id" value="{{ $tag->id }}">
								<input type="text" id="travaux_tag{{ $tag->id }}" name="name" value="{{ $tag->name }}" class="form-control shadow-none rounded" placeholder="{{ __('Enter Tag Name') }}" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="travaux_id{{ $tag->id }}">Travaux :</label>
								<select id="travaux_id{{ $tag->id }}" name="travaux_id" class="custom-select shadow-none form-control" required>
									<option value="">{{ __('Select') }}</option>
									@foreach ($travaux_list as $travaux)
										@php
											$data = \App\Models\CRM\TravauxTag::where('travaux_id', $travaux->id)->doesntExist();
										@endphp
										@if ($data || $travaux->id == $tag->travaux_id)
											@if ($travaux->id == $tag->travaux_id)
												<option selected value="{{ $travaux->id }}">{{ $travaux->travaux }}</option>
											@else
												<option value="{{ $travaux->id }}">{{ $travaux->travaux }}</option>
											@endif
										@endif
									@endforeach
								</select>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="travaux_tag_delete{{ $tag->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
							<form action="{{ route('travaux.tag.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $tag->id }}">
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
		@endforeach
		@foreach ($document_controls as $control)
			<div class="modal modal--aside fade leftAsideModal" id="control_edit{{ $control->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">Contrôle des Documents</h1>
						<form action="{{ route('document.control.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div class="form-group">
								<label class="form-label">Nom <span class="text-danger">*</span></label>
								<input type="hidden" name="id" value="{{ $control->id }}">
								<input type="text" name="name" value="{{ $control->name }}" class="form-control shadow-none rounded" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="controlDocumentOrder{{ $control->id }}">Order</label>
								<input type="number" id="controlDocumentOrder{{ $control->id }}" name="order" value="{{ $control->order }}" class="form-control shadow-none rounded" placeholder="order">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="control_delete{{ $control->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
							<form action="{{ route('document.control.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $control->id }}">
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
		@endforeach

		@foreach ($banques as $banque)
			<div class="modal modal--aside fade leftAsideModal" id="banque_edit{{ $banque->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">Banque</h1>
						<form action="{{ route('banque.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div class="form-group">
								<label class="form-label">Nom <span class="text-danger">*</span></label>
								<input type="hidden" name="id" value="{{ $banque->id }}">
								<input type="text" name="name" value="{{ $banque->name }}" class="form-control shadow-none rounded" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="banque_delete{{ $banque->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
							<form action="{{ route('banque.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $banque->id }}">
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
		@endforeach

		@foreach ($all_audit_status as $audit_status)
			<div class="modal modal--aside fade leftAsideModal" id="status_audit_edit{{ $audit_status->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">Statut audit</h1>
						<form action="{{ route('audit.status.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div class="form-group">
								<label class="form-label">Nom <span class="text-danger">*</span></label>
								<input type="hidden" name="id" value="{{ $audit_status->id }}">
								<input type="text" name="name" value="{{ $audit_status->name }}" class="form-control shadow-none rounded" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="text_color_audit{{ $audit_status->id }}">Couleur du texte<span class="text-danger">*</span></label>
								<input type="color" id="text_color_audit{{ $audit_status->id }}" name="text_color" value="{{ $audit_status->text_color }}" class="form-control shadow-none rounded" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="background_color_audit{{ $audit_status->id }}">Couleur de l'arrière plan<span class="text-danger">*</span></label>
								<input type="color" id="background_color_audit{{ $audit_status->id }}" name="background_color" value="{{ $audit_status->background_color }}" class="form-control shadow-none rounded" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="status_audit_delete{{ $audit_status->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
							<form action="{{ route('audit.status.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $audit_status->id }}">
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
		@endforeach
		@foreach (\App\Models\CRM\AuditReportStatus::all() as $audit_report_status)
			<div class="modal modal--aside fade leftAsideModal" id="status_report_edit{{ $audit_report_status->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">Statut rapport audit</h1>
						<form action="{{ route('audit.report.status.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div class="form-group">
								<label class="form-label">Nom <span class="text-danger">*</span></label>
								<input type="hidden" name="id" value="{{ $audit_report_status->id }}">
								<input type="text" name="name" value="{{ $audit_report_status->name }}" class="form-control shadow-none rounded" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="status_report_delete{{ $audit_report_status->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
							<form action="{{ route('audit.report.status.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $audit_report_status->id }}">
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
		@endforeach

		@foreach ($all_report_result as $report_result)
			<div class="modal modal--aside fade leftAsideModal" id="report_result_edit{{ $report_result->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">Résultat du rapport audit</h1>
						<form action="{{ route('report.result.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div class="form-group">
								<label class="form-label">Nom <span class="text-danger">*</span></label>
								<input type="hidden" name="id" value="{{ $report_result->id }}">
								<input type="text" name="name" value="{{ $report_result->name }}" class="form-control shadow-none rounded" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="report_result_delete{{ $report_result->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
							<form action="{{ route('report.result.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $report_result->id }}">
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
		@endforeach
		@foreach ($commercial_terrain as $commercial)
			<div class="modal modal--aside fade leftAsideModal" id="commercial_edit{{ $commercial->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">Commercial Terrain</h1>
						<form action="{{ route('commercial.terrain.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div class="form-group">
								<label class="form-label">Nom <span class="text-danger">*</span></label>
								<input type="hidden" name="id" value="{{ $commercial->id }}">
								<input type="text" name="name" value="{{ $commercial->name }}" class="form-control shadow-none rounded" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="commercial_delete{{ $commercial->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
							<form action="{{ route('commercial.terrain.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $commercial->id }}">
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
		@endforeach
		{{-- @foreach ($all_status_planning_study as $status_planning_study)
			<div class="modal modal--aside fade leftAsideModal" id="status_planning_study_edit{{ $status_planning_study->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">Statut Planning Etude</h1>
						<form action="{{ route('status.study.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div class="form-group">
								<label class="form-label">Nom <span class="text-danger">*</span></label>
								<input type="hidden" name="id" value="{{ $status_planning_study->id }}">
								<input type="text" name="name" value="{{ $status_planning_study->name }}" class="form-control shadow-none rounded" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="status_planning_study_delete{{ $status_planning_study->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
							<form action="{{ route('status.study.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $status_planning_study->id }}">
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
		@endforeach --}}

		{{-- @foreach (\App\Models\CRM\TechnicianStudy::all() as $technician_study)
			<div class="modal modal--aside fade leftAsideModal" id="technician_study_edit{{ $technician_study->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">Technicien Etude</h1>
						<form action="{{ route('technician.study.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div class="form-group">
								<label class="form-label">Nom <span class="text-danger">*</span></label>
								<input type="hidden" name="id" value="{{ $technician_study->id }}">
								<input type="text" name="name" value="{{ $technician_study->name }}" class="form-control shadow-none rounded" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="technician_study_delete{{ $technician_study->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content border-0">
						<div class="modal-header border-0 pb-0">
							<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
								<span class="novecologie-icon-close"></span>
							</button>
						</div>
						<div class="modal-body text-center pt-0">
							<h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
							<span>{{ __('Are You Sure To Delete this') }} ??</span>
							<form action="{{ route('technician.study.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $technician_study->id }}">
								<div class="d-flex justify-content-center">
									<button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
										Annuler
									</button>
									<button type="submit" class="primary-btn btn-danger primary-btn--md rounded border-0 my-3 mx-1">
										Supprimer
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		@endforeach --}}

		@foreach ($technical_referees as $technical_referee)
			<div class="modal modal--aside fade leftAsideModal" id="technical_referee_edit{{ $technical_referee->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">Technicien Etude</h1>
						<form action="{{ route('technical.referee.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div class="form-group">
								<label class="form-label">Nom <span class="text-danger">*</span></label>
								<input type="hidden" name="id" value="{{ $technical_referee->id }}">
								<input type="text" name="name" value="{{ $technical_referee->name }}" class="form-control shadow-none rounded" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="technical_referee_delete{{ $technical_referee->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content border-0">
						<div class="modal-header border-0 pb-0">
							<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
								<span class="novecologie-icon-close"></span>
							</button>
						</div>
						<div class="modal-body text-center pt-0">
							<h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
							<span>{{ __('Are You Sure To Delete this') }} ??</span>
							<form action="{{ route('technical.referee.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $technical_referee->id }}">
								<div class="d-flex justify-content-center">
									<button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
										Annuler
									</button>
									<button type="submit" class="primary-btn btn-danger primary-btn--md rounded border-0 my-3 mx-1">
										Supprimer
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		@endforeach

		{{-- @foreach (\App\Models\CRM\StatusFeasibilityStudy::all() as $status_feasibility_study)
			<div class="modal modal--aside fade leftAsideModal" id="status_feasibility_study_edit{{ $status_feasibility_study->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">Statut Faisabilité Etude </h1>
						<form action="{{ route('feasibility.study.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div class="form-group">
								<label class="form-label">Nom <span class="text-danger">*</span></label>
								<input type="hidden" name="id" value="{{ $status_feasibility_study->id }}">
								<input type="text" name="name" value="{{ $status_feasibility_study->name }}" class="form-control shadow-none rounded" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="status_feasibility_study_delete{{ $status_feasibility_study->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content border-0">
						<div class="modal-header border-0 pb-0">
							<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
								<span class="novecologie-icon-close"></span>
							</button>
						</div>
						<div class="modal-body text-center pt-0">
							<h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
							<span>{{ __('Are You Sure To Delete this') }} ??</span>
							<form action="{{ route('feasibility.study.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $status_feasibility_study->id }}">
								<div class="d-flex justify-content-center">
									<button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
										Annuler
									</button>
									<button type="submit" class="primary-btn btn-danger primary-btn--md rounded border-0 my-3 mx-1">
										Supprimer
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		@endforeach --}}

		{{-- @foreach (\App\Models\CRM\StatusPlanningPrevisite::all() as $status_planning_previsite)
			<div class="modal modal--aside fade leftAsideModal" id="status_planning_previsite_edit{{ $status_planning_previsite->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">Statut Planning previsite </h1>
						<form action="{{ route('status.previsite.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div class="form-group">
								<label class="form-label">Nom <span class="text-danger">*</span></label>
								<input type="hidden" name="id" value="{{ $status_planning_previsite->id }}">
								<input type="text" name="name" value="{{ $status_planning_previsite->name }}" class="form-control shadow-none rounded" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="status_planning_previsite_delete{{ $status_planning_previsite->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content border-0">
						<div class="modal-header border-0 pb-0">
							<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
								<span class="novecologie-icon-close"></span>
							</button>
						</div>
						<div class="modal-body text-center pt-0">
							<h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
							<span>{{ __('Are You Sure To Delete this') }} ??</span>
							<form action="{{ route('status.previsite.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $status_planning_previsite->id }}">
								<div class="d-flex justify-content-center">
									<button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
										Annuler
									</button>
									<button type="submit" class="primary-btn btn-danger primary-btn--md rounded border-0 my-3 mx-1">
										Supprimer
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		@endforeach --}}

		{{-- @foreach (\App\Models\CRM\TechnicianPrevisite::all() as $technician_previsite)
			<div class="modal modal--aside fade leftAsideModal" id="technician_previsite_edit{{ $technician_previsite->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">Technicien previsite</h1>
						<form action="{{ route('technician.previsite.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div class="form-group">
								<label class="form-label">Nom <span class="text-danger">*</span></label>
								<input type="hidden" name="id" value="{{ $technician_previsite->id }}">
								<input type="text" name="name" value="{{ $technician_previsite->name }}" class="form-control shadow-none rounded" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="technician_previsite_delete{{ $technician_previsite->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content border-0">
						<div class="modal-header border-0 pb-0">
							<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
								<span class="novecologie-icon-close"></span>
							</button>
						</div>
						<div class="modal-body text-center pt-0">
							<h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
							<span>{{ __('Are You Sure To Delete this') }} ??</span>
							<form action="{{ route('technician.previsite.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $technician_previsite->id }}">
								<div class="d-flex justify-content-center">
									<button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
										Annuler
									</button>
									<button type="submit" class="primary-btn btn-danger primary-btn--md rounded border-0 my-3 mx-1">
										Supprimer
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		@endforeach --}}
		{{-- @foreach (\App\Models\CRM\StatusPrevisite::all() as $status_previsite)
			<div class="modal modal--aside fade leftAsideModal" id="status_previsite_edit{{ $status_previsite->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">Statut Prévisite </h1>
						<form action="{{ route('previsite.status.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div class="form-group">
								<label class="form-label">Nom <span class="text-danger">*</span></label>
								<input type="hidden" name="id" value="{{ $status_previsite->id }}">
								<input type="text" name="name" value="{{ $status_previsite->name }}" class="form-control shadow-none rounded" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="status_previsite_delete{{ $status_previsite->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content border-0">
						<div class="modal-header border-0 pb-0">
							<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
								<span class="novecologie-icon-close"></span>
							</button>
						</div>
						<div class="modal-body text-center pt-0">
							<h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
							<span>{{ __('Are You Sure To Delete this') }} ??</span>
							<form action="{{ route('previsite.status.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $status_previsite->id }}">
								<div class="d-flex justify-content-center">
									<button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
										Annuler
									</button>
									<button type="submit" class="primary-btn btn-danger primary-btn--md rounded border-0 my-3 mx-1">
										Supprimer
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		@endforeach --}}
		{{-- @foreach (\App\Models\CRM\StatusFeasibilityPrevisite::all() as $status_feasibility_previsite)
			<div class="modal modal--aside fade leftAsideModal" id="status_feasibility_previsite_edit{{ $status_feasibility_previsite->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">Statut Faisabilité Prévisite</h1>
						<form action="{{ route('feasibility.previsite.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div class="form-group">
								<label class="form-label">Nom <span class="text-danger">*</span></label>
								<input type="hidden" name="id" value="{{ $status_feasibility_previsite->id }}">
								<input type="text" name="name" value="{{ $status_feasibility_previsite->name }}" class="form-control shadow-none rounded" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="status_feasibility_previsite_delete{{ $status_feasibility_previsite->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content border-0">
						<div class="modal-header border-0 pb-0">
							<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
								<span class="novecologie-icon-close"></span>
							</button>
						</div>
						<div class="modal-body text-center pt-0">
							<h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
							<span>{{ __('Are You Sure To Delete this') }} ??</span>
							<form action="{{ route('feasibility.previsite.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $status_feasibility_previsite->id }}">
								<div class="d-flex justify-content-center">
									<button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
										Annuler
									</button>
									<button type="submit" class="primary-btn btn-danger primary-btn--md rounded border-0 my-3 mx-1">
										Supprimer
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		@endforeach --}}
		{{-- @foreach (\App\Models\CRM\StatusPlanningCounterVisit::all() as $status_planning_counter)
			<div class="modal modal--aside fade leftAsideModal" id="status_planning_counter_edit{{ $status_planning_counter->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">Statut Planning Contre Visite </h1>
						<form action="{{ route('status.planning.counter.visit.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div class="form-group">
								<label class="form-label">Nom <span class="text-danger">*</span></label>
								<input type="hidden" name="id" value="{{ $status_planning_counter->id }}">
								<input type="text" name="name" value="{{ $status_planning_counter->name }}" class="form-control shadow-none rounded" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="status_planning_counter_delete{{ $status_planning_counter->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content border-0">
						<div class="modal-header border-0 pb-0">
							<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
								<span class="novecologie-icon-close"></span>
							</button>
						</div>
						<div class="modal-body text-center pt-0">
							<h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
							<span>{{ __('Are You Sure To Delete this') }} ??</span>
							<form action="{{ route('status.planning.counter.visit.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $status_planning_counter->id }}">
								<div class="d-flex justify-content-center">
									<button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
										Annuler
									</button>
									<button type="submit" class="primary-btn btn-danger primary-btn--md rounded border-0 my-3 mx-1">
										Supprimer
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		@endforeach --}}
		{{-- @foreach (\App\Models\CRM\TechnicianCounterVisit::all() as $technician_planning_counter)
			<div class="modal modal--aside fade leftAsideModal" id="technician_planning_counter_edit{{ $technician_planning_counter->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">Technicien Contre visite </h1>
						<form action="{{ route('technician.counter.visit.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div class="form-group">
								<label class="form-label">Nom <span class="text-danger">*</span></label>
								<input type="hidden" name="id" value="{{ $technician_planning_counter->id }}">
								<input type="text" name="name" value="{{ $technician_planning_counter->name }}" class="form-control shadow-none rounded" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="technician_planning_counter_delete{{ $technician_planning_counter->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content border-0">
						<div class="modal-header border-0 pb-0">
							<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
								<span class="novecologie-icon-close"></span>
							</button>
						</div>
						<div class="modal-body text-center pt-0">
							<h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
							<span>{{ __('Are You Sure To Delete this') }} ??</span>
							<form action="{{ route('technician.counter.visit.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $technician_planning_counter->id }}">
								<div class="d-flex justify-content-center">
									<button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
										Annuler
									</button>
									<button type="submit" class="primary-btn btn-danger primary-btn--md rounded border-0 my-3 mx-1">
										Supprimer
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		@endforeach --}}

		{{-- @foreach (\App\Models\CRM\StatusCounterVisit::all() as $status_counter)
			<div class="modal modal--aside fade leftAsideModal" id="status_counter_edit{{ $status_counter->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">Statut Contre visite </h1>
						<form action="{{ route('status.counter.visit.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div class="form-group">
								<label class="form-label">Nom <span class="text-danger">*</span></label>
								<input type="hidden" name="id" value="{{ $status_counter->id }}">
								<input type="text" name="name" value="{{ $status_counter->name }}" class="form-control shadow-none rounded" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="status_counter_delete{{ $status_counter->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content border-0">
						<div class="modal-header border-0 pb-0">
							<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
								<span class="novecologie-icon-close"></span>
							</button>
						</div>
						<div class="modal-body text-center pt-0">
							<h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
							<span>{{ __('Are You Sure To Delete this') }} ??</span>
							<form action="{{ route('status.counter.visit.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $status_counter->id }}">
								<div class="d-flex justify-content-center">
									<button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
										Annuler
									</button>
									<button type="submit" class="primary-btn btn-danger primary-btn--md rounded border-0 my-3 mx-1">
										Supprimer
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		@endforeach --}}

		{{-- @foreach (\App\Models\CRM\StatusFeasibilityCounterVisit::all() as $status_feasibility_counter)
			<div class="modal modal--aside fade leftAsideModal" id="status_feasibility_counter_edit{{ $status_feasibility_counter->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">Statut Faisabilité contre visite </h1>
						<form action="{{ route('status.feasibility.counter.visit.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div class="form-group">
								<label class="form-label">Nom <span class="text-danger">*</span></label>
								<input type="hidden" name="id" value="{{ $status_feasibility_counter->id }}">
								<input type="text" name="name" value="{{ $status_feasibility_counter->name }}" class="form-control shadow-none rounded" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="status_feasibility_counter_delete{{ $status_feasibility_counter->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content border-0">
						<div class="modal-header border-0 pb-0">
							<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
								<span class="novecologie-icon-close"></span>
							</button>
						</div>
						<div class="modal-body text-center pt-0">
							<h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
							<span>{{ __('Are You Sure To Delete this') }} ??</span>
							<form action="{{ route('status.feasibility.counter.visit.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $status_feasibility_counter->id }}">
								<div class="d-flex justify-content-center">
									<button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
										Annuler
									</button>
									<button type="submit" class="primary-btn btn-danger primary-btn--md rounded border-0 my-3 mx-1">
										Supprimer
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		@endforeach --}}

		{{-- @foreach (\App\Models\CRM\StatusPlanningInstallation::all() as $status_planning_installation)
			<div class="modal modal--aside fade leftAsideModal" id="status_planning_installation_edit{{ $status_planning_installation->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">Statut Planning Installation</h1>
						<form action="{{ route('status.planning.installation.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div class="form-group">
								<label class="form-label">Nom <span class="text-danger">*</span></label>
								<input type="hidden" name="id" value="{{ $status_planning_installation->id }}">
								<input type="text" name="name" value="{{ $status_planning_installation->name }}" class="form-control shadow-none rounded" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="status_planning_installation_delete{{ $status_planning_installation->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content border-0">
						<div class="modal-header border-0 pb-0">
							<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
								<span class="novecologie-icon-close"></span>
							</button>
						</div>
						<div class="modal-body text-center pt-0">
							<h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
							<span>{{ __('Are You Sure To Delete this') }} ??</span>
							<form action="{{ route('status.planning.installation.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $status_planning_installation->id }}">
								<div class="d-flex justify-content-center">
									<button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
										Annuler
									</button>
									<button type="submit" class="primary-btn btn-danger primary-btn--md rounded border-0 my-3 mx-1">
										Supprimer
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		@endforeach --}}

		{{-- @foreach (\App\Models\CRM\StatusPlanningSav::all() as $status_planning_sav)
			<div class="modal modal--aside fade leftAsideModal" id="status_planning_sav_edit{{ $status_planning_sav->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">Statut Planning SAV </h1>
						<form action="{{ route('status.planning.sav.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div class="form-group">
								<label class="form-label">Nom <span class="text-danger">*</span></label>
								<input type="hidden" name="id" value="{{ $status_planning_sav->id }}">
								<input type="text" name="name" value="{{ $status_planning_sav->name }}" class="form-control shadow-none rounded" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="status_planning_sav_delete{{ $status_planning_sav->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content border-0">
						<div class="modal-header border-0 pb-0">
							<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
								<span class="novecologie-icon-close"></span>
							</button>
						</div>
						<div class="modal-body text-center pt-0">
							<h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
							<span>{{ __('Are You Sure To Delete this') }} ??</span>
							<form action="{{ route('status.planning.sav.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $status_planning_sav->id }}">
								<div class="d-flex justify-content-center">
									<button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
										Annuler
									</button>
									<button type="submit" class="primary-btn btn-danger primary-btn--md rounded border-0 my-3 mx-1">
										Supprimer
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		@endforeach --}}

		{{-- @foreach (\App\Models\CRM\TechnicianSav::all() as $technician_sav)
			<div class="modal modal--aside fade leftAsideModal" id="technician_sav_edit{{ $technician_sav->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">Technicien SAV</h1>
						<form action="{{ route('technician.sav.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div class="form-group">
								<label class="form-label">Nom <span class="text-danger">*</span></label>
								<input type="hidden" name="id" value="{{ $technician_sav->id }}">
								<input type="text" name="name" value="{{ $technician_sav->name }}" class="form-control shadow-none rounded" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="technician_sav_delete{{ $technician_sav->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content border-0">
						<div class="modal-header border-0 pb-0">
							<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
								<span class="novecologie-icon-close"></span>
							</button>
						</div>
						<div class="modal-body text-center pt-0">
							<h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
							<span>{{ __('Are You Sure To Delete this') }} ??</span>
							<form action="{{ route('technician.sav.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $technician_sav->id }}">
								<div class="d-flex justify-content-center">
									<button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
										Annuler
									</button>
									<button type="submit" class="primary-btn btn-danger primary-btn--md rounded border-0 my-3 mx-1">
										Supprimer
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		@endforeach --}}

		{{-- @foreach (\App\Models\CRM\StatusResolutionSav::all() as $status_resolution_sav)
			<div class="modal modal--aside fade leftAsideModal" id="status_resolution_sav_edit{{ $status_resolution_sav->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">Statut Resolution SAV</h1>
						<form action="{{ route('status.resolution.sav.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div class="form-group">
								<label class="form-label">Nom <span class="text-danger">*</span></label>
								<input type="hidden" name="id" value="{{ $status_resolution_sav->id }}">
								<input type="text" name="name" value="{{ $status_resolution_sav->name }}" class="form-control shadow-none rounded" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="status_resolution_sav_delete{{ $status_resolution_sav->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content border-0">
						<div class="modal-header border-0 pb-0">
							<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
								<span class="novecologie-icon-close"></span>
							</button>
						</div>
						<div class="modal-body text-center pt-0">
							<h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
							<span>{{ __('Are You Sure To Delete this') }} ??</span>
							<form action="{{ route('status.resolution.sav.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $status_resolution_sav->id }}">
								<div class="d-flex justify-content-center">
									<button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
										Annuler
									</button>
									<button type="submit" class="primary-btn btn-danger primary-btn--md rounded border-0 my-3 mx-1">
										Supprimer
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		@endforeach --}}
		{{-- @foreach (\App\Models\CRM\StatusPlanningDeplacement::all() as $status_planning_deplacement)
			<div class="modal modal--aside fade leftAsideModal" id="status_planning_deplacement_edit{{ $status_planning_deplacement->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">Statut Planning Deplacement</h1>
						<form action="{{ route('status.planning.deplacement.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div class="form-group">
								<label class="form-label">Nom <span class="text-danger">*</span></label>
								<input type="hidden" name="id" value="{{ $status_planning_deplacement->id }}">
								<input type="text" name="name" value="{{ $status_planning_deplacement->name }}" class="form-control shadow-none rounded" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="status_planning_deplacement_delete{{ $status_planning_deplacement->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content border-0">
						<div class="modal-header border-0 pb-0">
							<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
								<span class="novecologie-icon-close"></span>
							</button>
						</div>
						<div class="modal-body text-center pt-0">
							<h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
							<span>{{ __('Are You Sure To Delete this') }} ??</span>
							<form action="{{ route('status.planning.deplacement.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $status_planning_deplacement->id }}">
								<div class="d-flex justify-content-center">
									<button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
										Annuler
									</button>
									<button type="submit" class="primary-btn btn-danger primary-btn--md rounded border-0 my-3 mx-1">
										Supprimer
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		@endforeach --}}
		@foreach (\App\Models\CRM\TicketProblemStatus::all() as $ticket_problem_status)
			<div class="modal modal--aside fade leftAsideModal" id="ticket_problem_status_edit{{ $ticket_problem_status->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">Type de problème</h1>
						<form action="{{ route('ticket.problem.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div class="form-group">
								<label class="form-label">probleme <span class="text-danger">*</span></label>
								<input type="hidden" name="id" value="{{ $ticket_problem_status->id }}">
								<input type="text" name="name" value="{{ $ticket_problem_status->name }}" class="form-control shadow-none rounded" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label">Echeance resolution ticket<span class="text-danger">*</span></label>
								<div class="input-group">
									<input type="number" value="{{ $ticket_problem_status->deadline }}" name="deadline" class="form-control shadow-none rounded" required>
									<div class="input-group-append">
									  <span class="input-group-text">jours</span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="ticketType"> Type de ticket <span class="text-danger">*</span></label>
								<select class="custom-select shadow-none form-control" id="ticketType" name="ticket_type" required>
									<option {{ $ticket_problem_status->ticket_type == 'Administratif'? 'selected':'' }} value="Administratif">Administratif</option>
									<option {{ $ticket_problem_status->ticket_type == 'Technique'? 'selected':'' }} value="Technique">Technique</option>
									<option {{ $ticket_problem_status->ticket_type == 'Financier'? 'selected':'' }} value="Financier">Financier</option>
								</select>
								<div class="invalid-feedback">{{ __('This field in necessary') }}</div>
							</div>
							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="ticket_problem_status_delete{{ $ticket_problem_status->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
							<form action="{{ route('ticket.problem.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $ticket_problem_status->id }}">
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
		@endforeach
		@foreach (\App\Models\CRM\EnergyType::all() as $energy_type)
			<div class="modal modal--aside fade leftAsideModal" id="energy_type_edit{{ $energy_type->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">Type énergie Chaud.</h1>
						<form action="{{ route('energy.type.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div class="form-group">
								<label class="form-label" for="title1">Titre<span class="text-danger">*</span></label>
								<input type="hidden" name="id" value="{{ $energy_type->id }}">
								<input type="text" id="title1" name="title" value="{{ $energy_type->title }}" class="form-control shadow-none rounded" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="devis_text">Texte de Devis<span class="text-danger">*</span></label>
								<textarea id="devis_text" name="devis_text" class="form-control shadow-none rounded" required>{{ $energy_type->devis_text }}</textarea>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="energy_type_delete{{ $energy_type->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
							<form action="{{ route('energy.type.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $energy_type->id }}">
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
		@endforeach
		@foreach (\App\Models\CRM\PrestationGroup::all() as $prestation_group)
			<div class="modal modal--aside fade leftAsideModal" id="prestation_group_items{{ $prestation_group->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">{{ $prestation_group->code }}</h1>
						<div class="row">
							@foreach ($prestation_group->getItems as $item)
								<div class="col-md-4 mb-4">
									<div class="card">
										<div class="card-body">
											<h3 class="card-title text-primary border-bottom pb-2">{{ $item->getPrestation->alias }}</h3>
											<h4 class="card-subtitle mb-2"><strong>{{ __('Price') }}:</strong> {{ $item->price }}€</h4>
											<h4 class="card-subtitle mb-2"><strong>{{ __('Quantity') }}:</strong> {{ $item->quantity }} </h4>
											<h4 class="card-subtitle mb-2"><strong>{{ __('Tax') }}:</strong>
												@if ($item->tax == 0)
													Non spécifiée
												@elseif ($item->tax == 5.5)
													Taux réduit à 5,5 %
												@else
													Taux normal à 20 %
												@endif
											</h4>
										</div>
									</div>
								</div>
							@endforeach
						</div>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade leftAsideModal" id="prestation_group_edit{{ $prestation_group->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">{{ __('Prestations group') }}</h1>
						<form action="{{ route('prestation.group.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div class="form-group">
								<label class="form-label" for="prestation_code1{{ $prestation_group->id }}">Code<span class="text-danger">*</span></label>
								<input type="text" id="prestation_code1{{ $prestation_group->id }}" name="code" value="{{ $prestation_group->code }}" class="form-control shadow-none rounded" required>
								<input type="hidden" name="id" value="{{ $prestation_group->id }}">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="prestation_product_id{{ $prestation_group->id }}"> Produits :</label>
								<select name="product_id" id="prestation_product_id{{ $prestation_group->id }}"  class="select2_select_option custom-select shadow-none form-control" required>
									  @foreach ($products as $product)
										  <option {{ $prestation_group->product_id == $product->id ? 'selected':'' }} value="{{ $product->id }}">{{ $product->reference }}</option>
									  @endforeach
								</select>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="prestation_group_delete{{ $prestation_group->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
							<form action="{{ route('prestation.group.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $prestation_group->id }}">
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
		@endforeach
		@foreach ($comment_categories as $comment_category)
			<div class="modal modal--aside fade leftAsideModal" id="comment_category_edit{{ $comment_category->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">{{ __('Comment Category') }}</h1>
						<form action="{{ route('comment.category.add') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div class="form-group">
								<label class="form-label" for="commentCategroy{{ $comment_category->id }}">{{ __("Name") }}<span class="text-danger">*</span></label>
								<input type="text" id="commentCategroy{{ $comment_category->id }}" name="name" value="{{ $comment_category->name }}" class="form-control shadow-none rounded" required>
								<input type="hidden" name="id" value="{{ $comment_category->id }}">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="comment_category_assigne{{ $comment_category->id }}">{{ __('Assignee') }} <span class="text-danger">*</span></label>
								<select name="comment_category_assigne[]" id="comment_category_assigne{{ $comment_category->id }}"  class="select2_select_option custom-select shadow-none form-control" multiple>
									@foreach ($users as $usr)
										<option value="{{ $usr->id }}" {{ \App\Models\CRM\CommentCategoryAssign::where('comment_category_id', $comment_category->id)->where('user_id', $usr->id)->exists() ? 'selected':'' }}>{{ $usr->name }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label class="form-label" for="background_color{{ $comment_category->id }}">{{ __('Background Color') }} <span class="text-danger">*</span></label>
								<input type="color" id="background_color{{ $comment_category->id }}" name="background_color" value="{{ $comment_category->background_color }}" class="form-control shadow-none rounded" placeholder="{{ __('Enter Background Color') }}" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="comment_category_delete{{ $comment_category->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
							<form action="{{ route('comment.category.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $comment_category->id }}">
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
		@endforeach
		@foreach ($quality_controls as $quality_control)
			<div class="modal modal--aside fade leftAsideModal" id="quality_control_edit{{ $quality_control->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">Contrôle Qualité</h1>
						<form action="{{ route('quality.control.update') }}" class="form mx-auto needs-validation"  novalidate method="POST" id="qualityControleUpdateForm{{ $quality_control->id }}">
							@csrf
							<div class="form-group">
								<label class="form-label" for="quality_controls__edit{{ $quality_control->id }}">{{ __("Name") }}<span class="text-danger">*</span></label>
								<input type="text" id="quality_controls__edit{{ $quality_control->id }}" name="name" value="{{ $quality_control->name }}" class="form-control shadow-none rounded" required>
								<input type="hidden" name="id" value="{{ $quality_control->id }}">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div id="addMoreQuestion__qc__edit{{ $quality_control->id }}">
								@foreach ($quality_control->getQuestions as $qc__question)
									@if ($qc__question->type == 'question')
										<div class='new_qc__block'>
											<div class="form-group">
												<div class="d-flex align-items-center justify-content-between">
													<label class="form-label" for="label_title__qc0{{ $qc__question->id }}">{{ __('Question') }} <span class="text-danger">*</span></label>
													<button type="button" class="remove-btn d-inline-flex align-items-center justify-content-center button mb-1 remove_question_block__qc">×</button>
												</div>
												<input type="text" value="{{ $qc__question->question_title }}" name="label_title[]" id="label_title__qc0{{ $qc__question->id }}" class="form-control shadow-none qc_question_title__edit{{ $quality_control->id }}">
												<input type="hidden" name="type[]" value="question">
												<input type="hidden" name="qc_header_color[]">
												<input type="hidden" name="question_id[]" value="{{ $qc__question->id }}">
											</div>
											<div class="form-group">
												<label class="form-label" for="input_type__qc0{{ $qc__question->id }}">{{ __('Select Input Type') }} <span class="text-danger">*</span></label>
												<select name="input_type[]" id="input_type__qc0{{ $qc__question->id }}"  class="select2_select_option custom-select shadow-none form-control">
													<option {{ $qc__question->question_type == 'text' ? 'selected':'' }} value="text">{{ __('Text') }}</option>
													<option {{ $qc__question->question_type == 'number' ? 'selected':'' }} value="number">{{ __('Number') }}</option>
													<option {{ $qc__question->question_type == 'email' ? 'selected':'' }} value="email">{{ __('Email') }}</option>
													<option {{ $qc__question->question_type == 'radio' ? 'selected':'' }} value="radio">{{ __('Radio') }}</option>
													<option {{ $qc__question->question_type == 'checkbox' ? 'selected':'' }} value="checkbox">{{ __('Checkbox') }}</option>
													<option {{ $qc__question->question_type == 'select' ? 'selected':'' }} value="select">{{ __('Dropdown') }}</option>
													<option {{ $qc__question->question_type == 'textarea' ? 'selected':'' }} value="textarea">{{ __('Textarea') }}</option>
												</select>
											</div>
											<div class="form-group">
												<label class="form-label" for="required_optional__qc0{{ $qc__question->id }}">{{ __('Required/Optional') }} <span class="text-danger">*</span></label>
												<select name="required_optional[]" id="required_optional__qc0{{ $qc__question->id }}"  class="select2_select_option custom-select shadow-none form-control">
													<option {{ $qc__question->question_required == 'no' ? 'selected':'' }} value="no">{{ __('Optional') }}</option>
													<option {{ $qc__question->question_required == 'yes' ? 'selected':'' }} value="yes">{{ __('Required') }}</option>
												</select>
											</div>
											<div class="form-group">
												<label class="form-label" for="options__qc0{{ $qc__question->id }}">{{ __('Options') }}</label>
												<textarea name="options[]" id="options__qc0{{ $qc__question->id }}" class="form-control shadow-none" placeholder="{{ __('Enter Options. Each option seperate with comma ,') }}">{{ $qc__question->question_options }}</textarea>
											</div>
										</div>
									@else
										<div class="new_qc__block">
											<div class="form-group">
												<div class="d-flex align-items-center justify-content-between">
													<label class="form-label" for="qc_header0{{ $qc__question->id }}">{{ __('Header Title') }} <span class="text-danger">*</span></label>
													<button type="button" class="remove-btn d-inline-flex align-items-center justify-content-center button mb-1 remove_question_block__qc">×</button>
												</div>
												<input type="text" value="{{ $qc__question->header_title }}" name="label_title[]" id="qc_header0{{ $qc__question->id }}" class="form-control shadow-none qc_question_title" required>
												<input type="hidden" name="type[]" value="header">
												<input type="hidden" name="options[]">
												<input type="hidden" name="input_type[]">
												<input type="hidden" name="required_optional[]">
												<input type="hidden" name="question_id[]" value="{{ $qc__question->id }}">

											</div>
											<div class="form-group">
												<label class="form-label" for="qc_header_color0{{ $qc__question->id }}">{{ __('Header Background Color') }} <span class="text-danger">*</span></label>
												<input type="color" name="qc_header_color[]" id="qc_header_color0{{ $qc__question->id }}" class="form-control shadow-none" value="{{ $qc__question->header_color }}" required>
											</div>
										</div>
									@endif
								@endforeach
							</div>

							<div class="form-group mt-4">
								<button type="button"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2 qualityControlBtn__edit" data-id="{{ $quality_control->id }}" >{{ __('Update') }}</button>
								<button type="button" data-id="{{ $quality_control->id }}" class="secondary-btn secondary-btn--cuccess border-0 mb-2 mr-2 add_more_question_btn__qc__edit">nouvelle question</button>
								<button type="button" data-id="{{ $quality_control->id }}" class="secondary-btn secondary-btn--cuccess border-0 mb-2 mr-2 add_more_header__edit">
									<span class="mr-2"></span>
									+ {{ __('Add Headers') }}
								</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade leftAsideModal" id="quality_control_view{{ $quality_control->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">Contrôle Qualité</h1>
						<div class="pdf-page pdf-page--1">
							<div class="pdf-card">
								<div class="pdf-card__body">
									@foreach ($quality_control->getQuestions as $qc_question)
										@if ($qc_question->type == 'question')
											@if ($qc_question->question_type == 'textarea')
												<div class="form-group">
													<label for="qc_question_label{{ $qc_question->id }}" class="form-label"> {{ $qc_question->question_title }} {{ $qc_question->question_required == 'yes' ? '*':'' }} </label>
													<textarea name="{{ $qc_question->question_name }}" id="qc_question_label{{ $qc_question->id }}" class="form-control shadow-none cq__disabled" {{ $qc_question->question_required == 'yes' ? 'required':'' }}></textarea>
												</div>
											@elseif ($qc_question->question_type == 'select')
											<div class="form-group">
												<label for="qc_question_label{{ $qc_question->id }}" class="form-label">
													{{ $qc_question->question_title }} {{ $qc_question->question_required == 'yes' ? '*':'' }}
												</label>
												<select class="select2_select_option form-control w-100 cq__disabled" id="qc_question_label{{ $qc_question->id }}" name="{{ $qc_question->question_name }}" {{ $qc_question->question_required == 'yes' ? 'required':'' }}>
														<option value="" selected>{{ __('Select') }}</option>
														@foreach (explode(',', $qc_question->question_options) as $item)
															<option value="{{ $item }}">{{ $item }}</option>
														@endforeach
												</select>
											</div>
											@elseif ($qc_question->question_type == 'radio')
												<div class="row">
													<div class="col-12">
														<h4>  {{ $qc_question->question_title }} {{ $qc_question->question_required == 'yes' ? '*':'' }} </h4>
													</div>
													@foreach (explode(',', $qc_question->question_options) as $item)
													<div class="col-4">
														<div class="form-group">
															<div class="custom-control custom-checkbox">
																<input type="radio" name="{{ $qc_question->question_name }}" value="{{ $item }}" class="custom-control-input cq__disabled" id="{{ $loop->iteration }}qc_question_label{{ $qc_question->id }}" {{ $qc_question->question_required == 'yes' ? 'required':'' }}>
															<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
																<label class="custom-control-label" for="{{ $loop->iteration }}qc_question_label{{ $qc_question->id }}"> {{ $item }} </label>
															</div>
														</div>
													</div>
													@endforeach
												</div>
											@elseif ($qc_question->question_type == 'checkbox')
												<div class="row">
													<div class="col-12">
														<h4> {{ $qc_question->question_title }} </h4>
													</div>
													@foreach (explode(',', $qc_question->question_options) as $item)
													<div class="col-4">
														<div class="form-group required-checkbox">
															<div class="custom-control custom-checkbox">
																<input type="checkbox" name="checkboxinput_{{ $qc_question->question_name }}[]" value="{{ $item }}" class="custom-control-input cq__disabled" id="{{ $loop->iteration }}qc_question_label{{ $qc_question->id }}">
																<label class="custom-control-label" for="{{ $loop->iteration }}qc_question_label{{ $qc_question->id }}"> {{ $item }}</label>
															</div>
														</div>
													</div>
													@endforeach
												</div>
											@else
												<div class="form-group">
													<label for="qc_question_label{{ $qc_question->id }}" class="form-label">
														{{ $qc_question->question_title }} {{ $qc_question->question_required == 'yes' ? '*':'' }}
													</label>
													<input type="{{ $qc_question->question_type }}" name="{{ $qc_question->question_name }}" id="qc_question_label{{ $qc_question->id }}" class="form-control shadow-none cq__disabled">
												</div>
											@endif
										@else
											<div class="pdf-card__head" style="background-color: {{ $qc_question->header_color }}">
												<h3 class="pdf-card__head__title text-center mb-4">{{ $qc_question->header_title }}</h3>
											</div>
										@endif
									@endforeach
								</div>
							</div>
						</div>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="quality_control_delete{{ $quality_control->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
							<form action="{{ route('quality.control.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $quality_control->id }}">
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
		@endforeach
		@foreach ($notion_categories as $notion_category)
			<div class="modal modal--aside fade leftAsideModal" id="notion_category_edit{{ $notion_category->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">Notion Catégorie</h1>
						<form action="{{ route('notion.category.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div class="form-group">
								<label class="form-label" for="notion_categorys__edit{{ $notion_category->id }}">{{ __("Name") }}<span class="text-danger">*</span></label>
								<input type="text" id="notion_categorys__edit{{ $notion_category->id }}" name="name" value="{{ $notion_category->name }}" class="form-control shadow-none rounded" required>
								<input type="hidden" name="id" value="{{ $notion_category->id }}">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="notion_categorys__edit_order{{ $notion_category->id }}">Order</label>
								<input type="number" id="notion_categorys__edit_order{{ $notion_category->id }}" name="order" value="{{ $notion_category->order }}" class="form-control shadow-none rounded">
							</div>

							<div class="form-group mt-4">
								<button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="notion_category_delete{{ $notion_category->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
							<form action="{{ route('notion.category.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $notion_category->id }}">
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
		@endforeach
		@foreach ($notion_subcategories as $notion_sub_category)
			<div class="modal modal--aside fade leftAsideModal" id="notion_sub_category_edit{{ $notion_sub_category->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">Notion Sous Catégorie</h1>
						<form action="{{ route('notion.subcategory.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div class="form-group">
								<label class="form-label" for="notion_sub_categorys__edit{{ $notion_sub_category->id }}">{{ __("Name") }}<span class="text-danger">*</span></label>
								<input type="text" id="notion_sub_categorys__edit{{ $notion_sub_category->id }}" name="name" value="{{ $notion_sub_category->name }}" class="form-control shadow-none rounded" required>
								<input type="hidden" name="id" value="{{ $notion_sub_category->id }}">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="notion_sub_categorye_category_id__edit{{ $notion_sub_category->id }}">Catégorie<span class="text-danger">*</span></label>
								<select name="category" id="notion_sub_categorye_category_id__edit{{ $notion_sub_category->id }}"  class="select2_select_option custom-select shadow-none form-control" required>
									<option value="" selected>{{ __('Select') }}</option>
									@foreach ($notion_categories as $category)
										<option {{ $notion_sub_category->category_id == $category->id ? 'selected':'' }} value="{{ $category->id }}">{{ $category->name }}</option>
									@endforeach
								</select>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="notion_sub_categorye_order__edit{{ $notion_sub_category->id }}">Order</label>
								<input type="number" id="notion_sub_categorye_order__edit{{ $notion_sub_category->id }}" name="order" value="{{ $notion_sub_category->order }}" class="form-control shadow-none rounded">
							</div>

							<div class="form-group mt-4">
								<button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="notion_sub_category_delete{{ $notion_sub_category->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
							<form action="{{ route('notion.subcategory.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $notion_sub_category->id }}">
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
		@endforeach
		@foreach ($lead_sub_statuses as $lead_sub_status)
			<div class="modal modal--aside fade leftAsideModal" id="lead_sub_status_edit{{ $lead_sub_status->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">Sous statut prospect</h1>
						<form action="{{ route('lead.sub-status.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div class="form-group">
								<label class="form-label" for="lead_sub_statuss__edit{{ $lead_sub_status->id }}">{{ __("Name") }}<span class="text-danger">*</span></label>
								<input type="text" id="lead_sub_statuss__edit{{ $lead_sub_status->id }}" name="name" value="{{ $lead_sub_status->name }}" class="form-control shadow-none rounded" required>
								<input type="hidden" name="id" value="{{ $lead_sub_status->id }}">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="lead_sub_statuse_background_color{{ $lead_sub_status->id }}">Couleur de fond<span class="text-danger">*</span></label>
								<input type="color" id="lead_sub_statuse_background_color{{ $lead_sub_status->id }}" name="background_color" class="form-control shadow-none rounded" value="{{ $lead_sub_status->background_color }}" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="lead_sub_statuse_text_color{{ $lead_sub_status->id }}">Couleur du texte<span class="text-danger">*</span></label>
								<input type="color" id="lead_sub_statuse_text_color{{ $lead_sub_status->id }}" name="text_color" class="form-control shadow-none rounded" value="{{ $lead_sub_status->text_color }}" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="lead_sub_statuse_order{{ $lead_sub_status->id }}">Order</label>
								<input type="number" id="lead_sub_statuse_order{{ $lead_sub_status->id }}" name="order" value="{{ $lead_sub_status->order }}" class="form-control shadow-none rounded" value="#ffffff">
							</div>

							<div class="form-group mt-4">
								<button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="lead_sub_status_delete{{ $lead_sub_status->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
							<form action="{{ route('lead.sub-status.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $lead_sub_status->id }}">
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
		@endforeach
		@foreach ($project_sub_statuses as $project_sub_status)
			<div class="modal modal--aside fade leftAsideModal" id="project_sub_status_edit{{ $project_sub_status->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">Sous statut chantier</h1>
						<form action="{{ route('project.sub-status.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div class="form-group">
								<label class="form-label" for="project_sub_statuss__edit{{ $project_sub_status->id }}">{{ __("Name") }}<span class="text-danger">*</span></label>
								<input type="text" id="project_sub_statuss__edit{{ $project_sub_status->id }}" name="name" value="{{ $project_sub_status->name }}" class="form-control shadow-none rounded" required>
								<input type="hidden" name="id" value="{{ $project_sub_status->id }}">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="project_sub_statuse_background_color{{ $project_sub_status->id }}">Couleur de fond<span class="text-danger">*</span></label>
								<input type="color" id="project_sub_statuse_background_color{{ $project_sub_status->id }}" name="background_color" class="form-control shadow-none rounded" value="{{ $project_sub_status->background_color }}" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="project_sub_statuse_text_color{{ $project_sub_status->id }}">Couleur du texte<span class="text-danger">*</span></label>
								<input type="color" id="project_sub_statuse_text_color{{ $project_sub_status->id }}" name="text_color" class="form-control shadow-none rounded" value="{{ $project_sub_status->text_color }}" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="project_sub_statuse_order{{ $project_sub_status->id }}">Order</label>
								<input type="number" id="project_sub_statuse_order{{ $project_sub_status->id }}" name="order" value="{{ $project_sub_status->order }}" class="form-control shadow-none rounded">
							</div>
							<div class="form-group mt-4">
								<button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="project_sub_status_delete{{ $project_sub_status->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
							<form action="{{ route('project.sub-status.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $project_sub_status->id }}">
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
		@endforeach
		@foreach ($heatings as $heating_mode)
			<div class="modal modal--aside fade leftAsideModal" id="heating_mode_edit{{ $heating_mode->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">Mode de chauffage</h1>
						<form action="{{ route('heating.mode.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div class="form-group">
								<label class="form-label" for="heating_modes__edit{{ $heating_mode->id }}">{{ __("Name") }}<span class="text-danger">*</span></label>
								<input type="text" id="heating_modes__edit{{ $heating_mode->id }}" name="name" value="{{ $heating_mode->name }}" class="form-control shadow-none rounded" required>
								<input type="hidden" name="id" value="{{ $heating_mode->id }}">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>

							<div class="form-group mt-4">
								<button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="heating_mode_delete{{ $heating_mode->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
							<form action="{{ route('heating.mode.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $heating_mode->id }}">
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
		@endforeach
		@foreach ($status_interventions as $status_planning_intervention)
			<div class="modal modal--aside fade leftAsideModal" id="status_planning_intervention_edit{{ $status_planning_intervention->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">Statut planning intervention</h1>
						<form action="{{ route('status.planning.intervention.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div class="form-group">
								<label class="form-label" for="status_planning_interventions__edit{{ $status_planning_intervention->id }}">{{ __("Name") }}<span class="text-danger">*</span></label>
								<input type="text" id="status_planning_interventions__edit{{ $status_planning_intervention->id }}" name="name" value="{{ $status_planning_intervention->name }}" class="form-control shadow-none rounded" required>
								<input type="hidden" name="id" value="{{ $status_planning_intervention->id }}">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="status_planning_interventione_color">Color<span class="text-danger">*</span></label>
								<input type="color" id="status_planning_interventione_color" name="color" value="{{ $status_planning_intervention->color }}" class="form-control shadow-none rounded" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="status_planning_interventione_background">Background Color<span class="text-danger">*</span></label>
								<input type="color" id="status_planning_interventione_background" value="{{ $status_planning_intervention->background_color }}" name="background_color" class="form-control shadow-none rounded" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>

							<div class="form-group mt-4">
								<button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="status_planning_intervention_delete{{ $status_planning_intervention->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
							<form action="{{ route('status.planning.intervention.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $status_planning_intervention->id }}">
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
		@endforeach
		@foreach ($project_ko_reasons as $project_ko_reason)
			<div class="modal modal--aside fade leftAsideModal" id="project_ko_reason_edit{{ $project_ko_reason->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">Chantiers KO - Raisons</h1>
						<form action="{{ route('project.ko.reason.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div class="form-group">
								<label class="form-label" for="project_ko_reasons__edit{{ $project_ko_reason->id }}">{{ __("Name") }}<span class="text-danger">*</span></label>
								<input type="text" id="project_ko_reasons__edit{{ $project_ko_reason->id }}" name="name" value="{{ $project_ko_reason->name }}" class="form-control shadow-none rounded" required>
								<input type="hidden" name="id" value="{{ $project_ko_reason->id }}">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>

							<div class="form-group mt-4">
								<button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="project_ko_reason_delete{{ $project_ko_reason->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
							<form action="{{ route('project.ko.reason.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $project_ko_reason->id }}">
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
		@endforeach
		@foreach ($project_reflection_reasons as $project_reflection_reason)
			<div class="modal modal--aside fade leftAsideModal" id="project_reflection_reason_edit{{ $project_reflection_reason->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">Chantiers Reflexion - Raisons</h1>
						<form action="{{ route('project.reflection.reason.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div class="form-group">
								<label class="form-label" for="project_reflection_reasons__edit{{ $project_reflection_reason->id }}">{{ __("Name") }}<span class="text-danger">*</span></label>
								<input type="text" id="project_reflection_reasons__edit{{ $project_reflection_reason->id }}" name="name" value="{{ $project_reflection_reason->name }}" class="form-control shadow-none rounded" required>
								<input type="hidden" name="id" value="{{ $project_reflection_reason->id }}">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>

							<div class="form-group mt-4">
								<button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="project_reflection_reason_delete{{ $project_reflection_reason->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
							<form action="{{ route('project.reflection.reason.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $project_reflection_reason->id }}">
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
		@endforeach
		@foreach ($statut_maprimerenovs as $statut_maprimerenov)
			<div class="modal modal--aside fade leftAsideModal" id="statut_maprimerenov_edit{{ $statut_maprimerenov->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">Statut MaPrimeRénov</h1>
						<form action="{{ route('statut.maprimerenov.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div class="form-group">
								<label class="form-label" for="statut_maprimerenovs__edit{{ $statut_maprimerenov->id }}">{{ __("Name") }}<span class="text-danger">*</span></label>
								<input type="text" id="statut_maprimerenovs__edit{{ $statut_maprimerenov->id }}" name="name" value="{{ $statut_maprimerenov->name }}" class="form-control shadow-none rounded" required>
								<input type="hidden" name="id" value="{{ $statut_maprimerenov->id }}">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>

							<div class="form-group">
								<label class="form-label" for="statut_maprimerenove_order__edit{{ $statut_maprimerenov->id }}">Order</label>
								<input type="number" id="statut_maprimerenove_order__edit{{ $statut_maprimerenov->id }}" name="order" value="{{ $statut_maprimerenov->order }}" class="form-control shadow-none rounded">
							</div>

							<div class="form-group mt-4">
								<button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="statut_maprimerenov_delete{{ $statut_maprimerenov->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
							<form action="{{ route('statut.maprimerenov.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $statut_maprimerenov->id }}">
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
		@endforeach
		@foreach ($reject_reasons as $reject_reason)
			<div class="modal modal--aside fade leftAsideModal" id="reject_reason_edit{{ $reject_reason->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">Motif rejet</h1>
						<form action="{{ route('reject.reason.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div class="form-group">
								<label class="form-label" for="reject_reasons__edit{{ $reject_reason->id }}">{{ __("Name") }}<span class="text-danger">*</span></label>
								<input type="text" id="reject_reasons__edit{{ $reject_reason->id }}" name="name" value="{{ $reject_reason->name }}" class="form-control shadow-none rounded" required>
								<input type="hidden" name="id" value="{{ $reject_reason->id }}">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>

							<div class="form-group mt-4">
								<button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="reject_reason_delete{{ $reject_reason->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
							<form action="{{ route('reject.reason.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $reject_reason->id }}">
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
		@endforeach
		@foreach ($type_fournisseurs as $type_fournisseur)
			<div class="modal modal--aside fade leftAsideModal" id="type_fournisseur_edit{{ $type_fournisseur->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">Type de fournisseur</h1>
						<form action="{{ route('type.fournisseur.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div class="form-group">
								<label class="form-label" for="type_fournisseurs__edit{{ $type_fournisseur->id }}">{{ __("Name") }}<span class="text-danger">*</span></label>
								<input type="text" id="type_fournisseurs__edit{{ $type_fournisseur->id }}" name="name" value="{{ $type_fournisseur->name }}" class="form-control shadow-none rounded" required>
								<input type="hidden" name="id" value="{{ $type_fournisseur->id }}">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>

							<div class="form-group mt-4">
								<button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="type_fournisseur_delete{{ $type_fournisseur->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
							<form action="{{ route('type.fournisseur.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $type_fournisseur->id }}">
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
		@endforeach
		@foreach ($color_users as $color_user)
			<div class="modal modal--aside fade leftAsideModal" id="color_user_edit{{ $color_user->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">Couleur utilisateur : {{ $color_user->name }}</h1>
						<form action="{{ route('user.color.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div class="form-group">
								<label class="form-label" for="user_text_color{{ $color_user->id }}">Couleur du texte</label>
								<input type="color" id="user_text_color{{ $color_user->id }}" name="color" value="{{ $color_user->color }}" class="form-control shadow-none rounded">
								<input type="hidden" name="id" value="{{ $color_user->id }}">
							</div>
							<div class="form-group">
								<label class="form-label" for="user_background_color{{ $color_user->id }}">Couleur de l'arrière plan</label>
								<input type="color" id="user_background_color{{ $color_user->id }}" name="background_color" value="{{ $color_user->background_color }}" class="form-control shadow-none rounded">
							</div>

							<div class="form-group mt-4">
								<button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
		@endforeach
		@foreach ($project_control_photos as $project_control_photo)
			<div class="modal modal--aside fade leftAsideModal" id="project_control_photo_edit{{ $project_control_photo->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">Contrôle conformité photo chantier</h1>
						<form action="{{ route('project.control.photo.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div class="form-group">
								<label class="form-label" for="project_control_photoe_names{{ $project_control_photo->id }}">Travaux<span class="text-danger">*</span></label>
								<select name="tag_id" id="project_control_photoe_names{{ $project_control_photo->id }}"  class="select2_select_option custom-select shadow-none form-control">
									<option value="" selected>{{ __('Select') }}</option>
									@foreach ($bareme_travaux_tags as $baremes)
										<option {{ $project_control_photo->tag_id == $baremes->id ? 'selected':'' }} value="{{ $baremes->id }}">{{ $baremes->bareme }}-{{ $baremes->bareme_description }}</option>
									@endforeach
								</select>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="project_control_photos__edit{{ $project_control_photo->id }}">{{ __("Name") }}<span class="text-danger">*</span></label>
								<input type="text" id="project_control_photos__edit{{ $project_control_photo->id }}" name="name" value="{{ $project_control_photo->name }}" class="form-control shadow-none rounded" required>
								<input type="hidden" name="id" value="{{ $project_control_photo->id }}">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>

							<div class="form-group mt-4">
								<button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="project_control_photo_delete{{ $project_control_photo->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
							<form action="{{ route('project.control.photo.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $project_control_photo->id }}">
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
		@endforeach
		@foreach ($campagnes as $campagne_type)
			<div class="modal modal--aside fade leftAsideModal" id="campagne_type_edit{{ $campagne_type->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">Type de campagne </h1>
						<form action="{{ route('campagne.type.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div class="form-group">
								<label class="form-label" for="campagne_types__edit{{ $campagne_type->id }}">{{ __("Name") }}<span class="text-danger">*</span></label>
								<input type="text" id="campagne_types__edit{{ $campagne_type->id }}" name="name" value="{{ $campagne_type->name }}" class="form-control shadow-none rounded" required>
								<input type="hidden" name="id" value="{{ $campagne_type->id }}">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>

							<div class="form-group mt-4">
								<button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="campagne_type_delete{{ $campagne_type->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
							<form action="{{ route('campagne.type.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $campagne_type->id }}">
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
		@endforeach

		@foreach ($bareme_travaux_tags as $bareme_tag)
			<div class="modal modal--aside fade leftAsideModal" id="BarèmesTravauxTagEditModal{{ $bareme_tag->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 id="updatedtagTitle" class="modal-title text-center mb-5">Barèmes/Travaux/Tag</h1>
						<form action="{{ route('bareme.travaux.tag.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<input type="hidden" name="id" value="{{ $bareme_tag->id }}">
							<div class="form-group">
								<label class="form-label" for{{ $bareme_tag->id }}="rank">Rank</label>
								<Select id="rank{{ $bareme_tag->id }}" data-id="baremesField{{ $bareme_tag->id }}" name="rank" class="select2_select_option custom-select shadow-none form-control rankChange" required>
									<option {{ $bareme_tag->rank == '1' ? 'selected':'' }} value="1">1</option>
									<option {{ $bareme_tag->rank == '2' ? 'selected':'' }} value="2">2</option>
								</Select>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div id="baremesField{{ $bareme_tag->id }}" style="display: {{ $bareme_tag->rank == '1' ? '':'none' }}">
								<div class="form-group">
									<label class="form-label" for="bareme{{ $bareme_tag->id }}">Barèmes</label>
									<input type="text" id="bareme{{ $bareme_tag->id }}" name="bareme" value="{{ $bareme_tag->bareme }}" class="form-control shadow-none rounded" required>
									<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
								</div>
								<div class="form-group">
									<label class="form-label" for="bareme_description{{ $bareme_tag->id }}">Barèmes {{ __('Description') }}</label>
									<textarea  id="bareme_description{{ $bareme_tag->id }}" name="bareme_description" class="form-control shadow-none rounded" required>{{ $bareme_tag->bareme_description }}</textarea>
									<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
								</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="travauxx{{ $bareme_tag->id }}">Travaux</label>
								<input type="text" id="travauxx{{ $bareme_tag->id }}" name="travaux" value="{{ $bareme_tag->travaux }}" class="form-control shadow-none rounded" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="tag{{ $bareme_tag->id }}">Tag</label>
								<input type="text" id="tag{{ $bareme_tag->id }}" name="tag" value="{{ $bareme_tag->tag }}" class="form-control shadow-none rounded" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="grand_precaire_montant_maprime_no_fioul{{ $bareme_tag->id }}">Grand Precaire Montant MAPRIMERENOV No Fioul €</label>
								<input type="number" step="any" id="grand_precaire_montant_maprime_no_fioul{{ $bareme_tag->id }}" name="grand_precaire_montant_maprime_no_fioul" value="{{ $bareme_tag->grand_precaire_montant_maprime_no_fioul }}" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="grand_precaire_montant_maprime_fioul{{ $bareme_tag->id }}">Grand Precaire Montant MAPRIMERENOV Fioul €</label>
								<input type="number" step="any" id="grand_precaire_montant_maprime_fioul{{ $bareme_tag->id }}" name="grand_precaire_montant_maprime_fioul" value="{{ $bareme_tag->grand_precaire_montant_maprime_fioul }}" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="grand_precaire_montant_cee_no_fioul{{ $bareme_tag->id }}">Grand Precaire Montant C.E.E No Fioul €</label>
								<input type="number" step="any" id="grand_precaire_montant_cee_no_fioul{{ $bareme_tag->id }}" name="grand_precaire_montant_cee_no_fioul" value="{{ $bareme_tag->grand_precaire_montant_cee_no_fioul }}" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="grand_precaire_montant_cee_fioul{{ $bareme_tag->id }}">Grand Precaire Montant C.E.E Fioul €</label>
								<input type="number" step="any" id="grand_precaire_montant_cee_fioul{{ $bareme_tag->id }}" name="grand_precaire_montant_cee_fioul" value="{{ $bareme_tag->grand_precaire_montant_cee_fioul }}" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="precaire_montant_maprime_no_fioul{{ $bareme_tag->id }}">Precaire Montant MAPRIMERENOV No Fioul €</label>
								<input type="number" step="any" id="precaire_montant_maprime_no_fioul{{ $bareme_tag->id }}" name="precaire_montant_maprime_no_fioul" value="{{ $bareme_tag->precaire_montant_maprime_no_fioul }}" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="precaire_montant_maprime_fioul{{ $bareme_tag->id }}">Precaire Montant MAPRIMERENOV Fioul €</label>
								<input type="number" step="any" id="precaire_montant_maprime_fioul{{ $bareme_tag->id }}" name="precaire_montant_maprime_fioul" value="{{ $bareme_tag->precaire_montant_maprime_fioul }}" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="precaire_montant_cee_no_fioul{{ $bareme_tag->id }}">Precaire Montant C.E.E No Fioul €</label>
								<input type="number" step="any" id="precaire_montant_cee_no_fioul{{ $bareme_tag->id }}" name="precaire_montant_cee_no_fioul" value="{{ $bareme_tag->precaire_montant_cee_no_fioul }}" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="precaire_montant_cee_fioul{{ $bareme_tag->id }}">Precaire Montant C.E.E Fioul €</label>
								<input type="number" step="any" id="precaire_montant_cee_fioul{{ $bareme_tag->id }}" name="precaire_montant_cee_fioul" value="{{ $bareme_tag->precaire_montant_cee_fioul }}" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="intermediaire_montant_maprime_no_fioul{{ $bareme_tag->id }}">Intermediaire Montant MAPRIMERENOV No Fioul €</label>
								<input type="number" step="any" id="intermediaire_montant_maprime_no_fioul{{ $bareme_tag->id }}" name="intermediaire_montant_maprime_no_fioul" value="{{ $bareme_tag->intermediaire_montant_maprime_no_fioul }}" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="intermediaire_montant_maprime_fioul{{ $bareme_tag->id }}">Intermediaire Montant MAPRIMERENOV Fioul €</label>
								<input type="number" step="any" id="intermediaire_montant_maprime_fioul{{ $bareme_tag->id }}" name="intermediaire_montant_maprime_fioul" value="{{ $bareme_tag->intermediaire_montant_maprime_fioul }}" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="intermediaire_montant_cee_no_fioul{{ $bareme_tag->id }}">Intermediaire Montant C.E.E No Fioul €</label>
								<input type="number" step="any" id="intermediaire_montant_cee_no_fioul{{ $bareme_tag->id }}" name="intermediaire_montant_cee_no_fioul" value="{{ $bareme_tag->intermediaire_montant_cee_no_fioul }}" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="intermediaire_montant_cee_fioul{{ $bareme_tag->id }}">Intermediaire Montant C.E.E Fioul €</label>
								<input type="number" step="any" id="intermediaire_montant_cee_fioul{{ $bareme_tag->id }}" name="intermediaire_montant_cee_fioul" value="{{ $bareme_tag->intermediaire_montant_cee_fioul }}" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="classique_montant_maprime_no_fioul{{ $bareme_tag->id }}">Classique Montant MAPRIMERENOV No Fioul €</label>
								<input type="number" step="any" id="classique_montant_maprime_no_fioul{{ $bareme_tag->id }}" name="classique_montant_maprime_no_fioul" value="{{ $bareme_tag->classique_montant_maprime_no_fioul }}" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="classique_montant_maprime_fioul{{ $bareme_tag->id }}">Classique Montant MAPRIMERENOV Fioul €</label>
								<input type="number" step="any" id="classique_montant_maprime_fioul{{ $bareme_tag->id }}" name="classique_montant_maprime_fioul" value="{{ $bareme_tag->classique_montant_maprime_fioul }}" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="classique_montant_cee_no_fioul{{ $bareme_tag->id }}">Classique Montant C.E.E No Fioul €</label>
								<input type="number" step="any" id="classique_montant_cee_no_fioul{{ $bareme_tag->id }}" name="classique_montant_cee_no_fioul" value="{{ $bareme_tag->classique_montant_cee_no_fioul }}" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="classique_montant_cee_fioul{{ $bareme_tag->id }}">Classique Montant C.E.E Fioul €</label>
								<input type="number" step="any" id="classique_montant_cee_fioul{{ $bareme_tag->id }}" name="classique_montant_cee_fioul" value="{{ $bareme_tag->classique_montant_cee_fioul }}" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>

							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="BarèmesTravauxTagDeleteModal{{ $bareme_tag->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
							<form action="{{ route('bareme.travaux.tag.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $bareme_tag->id }}">
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
		@endforeach
		@foreach ($scales as $scale)
			<div class="modal modal--aside fade leftAsideModal" id="BarèmesEditModal{{ $scale->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 id="updatedtagTitle" class="modal-title text-center mb-5">{{ __('Nouvelle sous-opération') }}</h1>
						<form action="{{ route('scale.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<input type="hidden" name="id" value="{{ $scale->id }}">
							<div class="form-group">
								<label class="form-label" for="wording{{ $scale->id }}">{{ __('Libellé') }} :</label>
								<input type="text" id="wording{{ $scale->id }}" name="wording" class="form-control shadow-none rounded" value="{{ $scale->wording }}" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="description{{ $scale->id }}">{{ __('Description') }} :</label>
								<textarea  id="description{{ $scale->id }}" name="description" class="form-control shadow-none rounded" required>{{ $scale->description }}</textarea>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="kwh_cumac{{ $scale->id }}">Kwh Cumac :</label>
								<input type="text" id="kwh_cumac{{ $scale->id }}" value="{{ $scale->kwh_cumac }}" name="kwh_cumac" class="form-control shadow-none rounded" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="prime_coup{{ $scale->id }}">Prime Coup de pouce CEE :</label>
								<input type="text" id="prime_coup{{ $scale->id }}" value="{{ $scale->prime_coup }}" name="prime_coup" class="form-control shadow-none rounded" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="bareme_travaux1{{ $scale->id }}"> Travaux :</label>
								<select name="travaux" id="bareme_travaux1{{ $scale->id }}"  class="custom-select shadow-none form-control">
									<option value="" selected>{{ __('Select') }}</option>
									 @foreach ($travaux_list as $travaux)
										 <option {{ $scale->travaux == $travaux->id ? 'selected':'' }} value="{{ $travaux->id }}">{{ $travaux->travaux }}</option>
									 @endforeach
								</select>
							</div>
							<div class="form-group">
								<label class="form-label" for="barame_tag1{{ $scale->id }}"> TAG :</label>
								<select name="tag" id="barame_tag1{{ $scale->id }}"  class="custom-select shadow-none form-control">
									<option value="" selected>{{ __('Select') }}</option>
									@foreach ($tags as $tag)
									<option {{ $scale->tag == $tag->id ? 'selected':'' }} value="{{ $tag->id }}">{{ $tag->name }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label class="form-label" for="barame_product1{{ $scale->id }}"> Produits :</label>
								<select name="product[]" id="barame_product1{{ $scale->id }}"  class="select2_select_option custom-select shadow-none form-control" multiple>
									  @foreach ($products as $product)
										  <option {{ \App\Models\CRM\ScaleProduct::where('scale_id', $scale->id)->where('product_id', $product->id)->exists() ? 'selected':'' }} value="{{ $product->id }}">{{ $product->reference }}</option>
									  @endforeach
								</select>
							</div>
							<div class="form-group">
								<label class="form-label" for="include_price{{ $scale->id }}">{{ __('Inclure le prix dans les prestations') }} :</label>
								<select name="include_price" id="include_price{{ $scale->id }}"  class="custom-select shadow-none form-control">
									<option @if ($scale->include_price == 'OUI')
										selected
									@endif value="OUI">{{ __('OUI') }}</option>
									<option @if ($scale->include_price == 'NON')
										selected
									@endif value="NON">{{ __('NON') }}</option>
								</select>
							</div>
							{{-- <div class="form-group">
								<label class="form-label" for="services">{{ __('Prestations concernées') }} :</label>
								<select name="services" id="services"  class="select2_select_option custom-select shadow-none form-control">
									<option value="item1">item1</option>
									<option value="item2">item2</option>
									<option value="item3">item3</option>
									<option value="item4">item4</option>
									<option value="item5">item5</option>
								</select>
							</div>  --}}
							<div class="form-group d-flex">
								<label class="form-label" for="activeSwitch{{ $scale->id }}">{{ __('Activer') }} :</label>
								<div class="custom-control custom-switch ml-1">
									<input type="checkbox" name="active" value="yes" class="custom-control-input" id="activeSwitch{{ $scale->id }}" @if ($scale->active == 'yes')
									checked
								@endif>
									<label class="custom-control-label" for="activeSwitch{{ $scale->id }}"></label>
								</div>
							</div>

							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade leftAsideModal" id="BarèmesEditModal2{{ $scale->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 id="updatedtagTitle" class="modal-title text-center mb-5">{{ __('Nouvelle sous-opération') }}</h1>
						<form action="{{ route('scale.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<input type="hidden" name="id" value="{{ $scale->id }}">
							<input type="hidden" name="baremes_tab" value="1">

							<div class="form-group">
								<label class="form-label" for="wording{{ $scale->id }}">{{ __('Libellé') }} :</label>
								<input type="text" id="wording{{ $scale->id }}" name="wording" class="form-control shadow-none rounded" value="{{ $scale->wording }}">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="description{{ $scale->id }}">{{ __('Description') }} :</label>
								<textarea  id="description{{ $scale->id }}" name="description" class="form-control shadow-none rounded">{{ $scale->description }}</textarea>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="kwh_cumac{{ $scale->id }}">Kwh Cumac :</label>
								<input type="text" id="kwh_cumac{{ $scale->id }}" value="{{ $scale->kwh_cumac }}" name="kwh_cumac" class="form-control shadow-none rounded" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="prime_coup{{ $scale->id }}">Prime Coup de pouce CEE :</label>
								<input type="text" id="prime_coup{{ $scale->id }}" value="{{ $scale->prime_coup }}" name="prime_coup" class="form-control shadow-none rounded" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="bareme_travaux{{ $scale->id }}"> Travaux :</label>
								<select name="travaux" id="bareme_travaux{{ $scale->id }}"  class="custom-select shadow-none form-control">
									<option value="" selected>{{ __('Select') }}</option>
									 @foreach ($travaux_list as $travaux)
										 <option {{ $scale->travaux == $travaux->id ? 'selected':'' }} value="{{ $travaux->id }}">{{ $travaux->travaux }}</option>
									 @endforeach
								</select>
							</div>
							<div class="form-group">
								<label class="form-label" for="barame_tag{{ $scale->id }}"> TAG :</label>
								<select name="tag" id="barame_tag{{ $scale->id }}"  class="custom-select shadow-none form-control">
									<option value="" selected>{{ __('Select') }}</option>
									@foreach ($tags as $tag)
									<option {{ $scale->tag == $tag->id ? 'selected':'' }} value="{{ $tag->id }}">{{ $tag->name }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label class="form-label" for="barame_product{{ $scale->id }}"> Produits :</label>
								<select name="product[]" id="barame_product{{ $scale->id }}"  class="select2_select_option custom-select shadow-none form-control" multiple>
									  @foreach ($products as $product)
										  <option {{ \App\Models\CRM\ScaleProduct::where('scale_id', $scale->id)->where('product_id', $product->id)->exists() ? 'selected':'' }} value="{{ $product->id }}">{{ $product->reference }}</option>
									  @endforeach
								</select>
							</div>
							<div class="form-group">
								<label class="form-label" for="include_price{{ $scale->id }}">{{ __('Inclure le prix dans les prestations') }} :</label>
								<select name="include_price" id="include_price{{ $scale->id }}"  class="custom-select shadow-none form-control">
									<option @if ($scale->include_price == 'OUI')
										selected
									@endif value="OUI">{{ __('OUI') }}</option>
									<option @if ($scale->include_price == 'NON')
										selected
									@endif value="NON">{{ __('NON') }}</option>
								</select>
							</div>
							{{-- <div class="form-group">
								<label class="form-label" for="services">{{ __('Prestations concernées') }} :</label>
								<select name="services" id="services"  class="select2_select_option custom-select shadow-none form-control">
									<option value="item1">item1</option>
									<option value="item2">item2</option>
									<option value="item3">item3</option>
									<option value="item4">item4</option>
									<option value="item5">item5</option>
								</select>
							</div>  --}}
							<div class="form-group d-flex">
								<label class="form-label" for="activeSwitch2{{ $scale->id }}">{{ __('Activer') }} :</label>
								<div class="custom-control custom-switch ml-1">
									<input type="checkbox" name="active" value="yes" class="custom-control-input" id="activeSwitch2{{ $scale->id }}" @if ($scale->active == 'yes')
									checked
								@endif>
									<label class="custom-control-label" for="activeSwitch2{{ $scale->id }}"></label>
								</div>
							</div>

							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="BarèmesDeleteModal2{{ $scale->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
							<form action="{{ route('scale.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $scale->id }}">
								<input type="hidden" name="baremes_tab" value="1">
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
		@endforeach
		@foreach ($delegates as $delegate)
			<div class="modal modal--aside fade leftAsideModal" id="DelegatesModalEdit{{ $delegate->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 id="updatedtagTitle" class="modal-title text-center mb-5">{{ __('Organisme') }}</h1>
						<form action="{{ route('delegate.update') }}" class="form mx-auto needs-validation" enctype="multipart/form-data" novalidate method="POST">
							@csrf
							<div>
								<img  loading="lazy"  src="{{ asset('uploads/delegate') }}/{{ $delegate->logo }}" width="150px" alt="">
							</div>
							<div class="form-group mt-2">
								<label class="form-label" for="logo">{{ __('Logo') }} :</label>
								<input type="hidden" name="id" value="{{ $delegate->id }}">
								<input type="file" id="logo" name="logo" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="company_name">{{ __('Raison sociale') }} :</label>
								<input type="text" id="company_name" value="{{ $delegate->company_name }}" name="company_name" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="bonus_ratio">{{ __('Ratio prime bénéficiaire') }} :</label>
								<input type="text" id="bonus_ratio" value="{{ $delegate->bonus_ratio }}" name="bonus_ratio" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="premium_ratio">{{ __('Ratio prime installateur') }} :</label>
								<input type="text" id="premium_ratio" value="{{ $delegate->premium_ratio }}" name="premium_ratio" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>

							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
		@endforeach
		@foreach ($deals as $deal)
			<div class="modal modal--aside fade leftAsideModal" id="DealModalEdit{{ $deal->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 id="updatedtagTitle" class="modal-title text-center mb-5">{{ __('Deals') }}</h1>
						<form action="{{ route('deal.update') }}" class="form mx-auto needs-validation" enctype="multipart/form-data" novalidate method="POST">
							@csrf
							<div class="form-group">
								<input type="hidden" name="id" value="{{ $deal->id }}">
								<label class="form-label" for="name">{{ __('Nom') }} :</label>
								<input type="text" id="name" value="{{ $deal->name }}" name="name" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="delegate">{{ __('Délégataire') }} :</label>
								<input type="text" id="delegate" value="{{ $deal->delegate }}" name="delegate" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="terms_and_conditions">Termes et conditions CEE :</label>
								<textarea name="terms_and_conditions" id="terms_and_conditions" class="form-control shadow-none rounded" required>{{ $deal->terms_and_conditions }}</textarea>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="version">{{ __('Version') }} :</label>
								<input type="text" id="version" value="{{ $deal->version }}" name="version" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="volume">{{ __('Volume Cumac') }} :</label>
								<input type="text" id="volume" value="{{ $deal->volume }}" name="volume" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="default">{{ __('Par défault') }} :</label>
								<select id="default"  name="default" class="form-control shadow-none rounded">
									<option {{ ($deal->default == 'Oui' )? 'selected': '' }} value="Oui">OUI</option>
									<option {{ ($deal->default == 'Non' )? 'selected': '' }} value="Non">NON</option>
								</select>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="locked">{{ __('Verrouillé') }} :</label>
								<select id="locked" name="locked" class="form-control shadow-none rounded">
									<option {{ ($deal->locked == 'Oui' )? 'selected': '' }} value="Oui">OUI</option>
									<option {{ ($deal->locked == 'Non' )? 'selected': '' }} value="Non">NON</option>
								</select>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>

							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Updated') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
		@endforeach
		@foreach ($installers as $installer)
			<div class="modal modal--aside fade leftAsideModal" id="InstallerModalEdit{{ $installer->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 id="updatedtagTitle" class="modal-title text-center mb-5">Entreprise de travaux</h1>
						<form action="{{ route('installer.update') }}" class="form mx-auto needs-validation" enctype="multipart/form-data" novalidate method="POST">
							@csrf
							<div>
								<img  loading="lazy"  src="{{ asset('uploads/installer') }}/{{ $installer->logo }}" width="150px" alt="">
							</div>
							<div class="form-group">
								<input type="hidden" name="id" value="{{ $installer->id }}">
								<label class="form-label" for="logo">{{ __('Logo') }} :</label>
								<input type="file" id="logo" name="logo" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="company_name2">{{ __('Raison sociale') }} :</label>
								<input type="text" id="company_name2" value="{{ $installer->company_name }}" name="company_name" class="form-control shadow-none rounded" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="namee">{{ __('Nom') }} :</label>
								<input type="text" id="namee" value="{{ $installer->name }}" name="name" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="first_name">{{ __('Prénom') }} :</label>
								<input type="text" id="first_name" value="{{ $installer->first_name }}" name="first_name" class="form-control shadow-none rounded" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="number">{{ __('Numéro SIREN') }} :</label>
								<input type="number" id="number" value="{{ $installer->number }}" name="number" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="subcontact">{{ __('Sous-traitance') }} :</label>
								<select id="subcontact" name="subcontact" class="form-control shadow-none rounded">
									<option {{ ($installer->subcontact == 'Oui' )? 'selected': '' }} value="Oui">OUI</option>
									<option {{ ($installer->subcontact == 'Non' )? 'selected': '' }} value="Non">NON</option>
								</select>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="defaultt">{{ __('Par défault') }} :</label>
								<select id="defaultt" name="default" class="form-control shadow-none rounded">
									<option {{ ($installer->default == 'Oui' )? 'selected': '' }} value="Oui">OUI</option>
									<option {{ ($installer->default == 'Non' )? 'selected': '' }} value="Non">NON</option>
								</select>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="activeee">{{ __('Activé') }} :</label>
								<select id="activeee" name="active" class="form-control shadow-none rounded">
									<option {{ ($installer->active == 'Oui' )? 'selected': '' }} value="Oui">OUI</option>
									<option {{ ($installer->active == 'Non' )? 'selected': '' }} value="Non">NON</option>
								</select>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>

							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
		@endforeach
		@foreach ($amos as $amo)
			<div class="modal modal--aside fade leftAsideModal" id="AmoModalEdit{{ $amo->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 id="updatedtagTitle" class="modal-title text-center mb-5">{{ __('AMO') }}</h1>
						<form action="{{ route('amo.update') }}" class="form mx-auto needs-validation" enctype="multipart/form-data" novalidate method="POST">
							@csrf
							<div>
								<img  loading="lazy"  src="{{ asset('uploads/amo') }}/{{ $amo->logo }}" width="150px" alt="">
							</div>
							<div class="form-group">
								<input type="hidden" name="id" value="{{ $amo->id }}">
								<label class="form-label" for="logo">{{ __('Logo') }} :</label>
								<input type="file" id="logo" name="logo" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="company_name3">{{ __('Raison sociale') }} :</label>
								<input type="text" id="company_name3" value="{{ $amo->company_name }}" name="company_name" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="number">{{ __('Numéro SIREN') }} :</label>
								<input type="number" id="number" value="{{ $amo->number }}" name="number" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="signatory">{{ __('Signataire') }} :</label>
								<input type="text" id="signatory" value="{{ $amo->signatory }}" name="signatory" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="defaulttt">{{ __('Par défault') }} :</label>
								<select id="defaulttt" name="default" class="form-control shadow-none rounded">
									<option {{ ($amo->default == 'Oui' )? 'selected': '' }} value="Oui">OUI</option>
									<option {{ ($amo->default == 'Non' )? 'selected': '' }} value="Non">NON</option>
								</select>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="activeee">{{ __('Activé') }} :</label>
								<select id="activeee" name="active" class="form-control shadow-none rounded">
									<option {{ ($amo->active == 'Oui' )? 'selected': '' }} value="Oui">OUI</option>
									<option {{ ($amo->active == 'Non' )? 'selected': '' }} value="Non">NON</option>
								</select>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>

							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
		@endforeach
		@foreach ($agents as $agent)
			<div class="modal modal--aside fade leftAsideModal" id="agentModalEdit{{ $agent->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 id="updatedtagTitle" class="modal-title text-center mb-5">{{ __('Mandataire Anah') }}</h1>
						<form action="{{ route('agent.update') }}" class="form mx-auto needs-validation" enctype="multipart/form-data" novalidate method="POST">
							@csrf
							<div>
								<img  loading="lazy"  src="{{ asset('uploads/agent') }}/{{ $agent->logo }}" width="150px" alt="">
							</div>
							<div class="form-group">
								<input type="hidden" name="id" value="{{ $agent->id }}">
								<label class="form-label" for="logo">{{ __('Logo') }} :</label>
								<input type="file" id="logo" name="logo" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="company_name3">{{ __('Raison sociale') }} :*</label>
								<input type="text" id="company_name3" value="{{ $agent->company_name }}" name="company_name" class="form-control shadow-none rounded" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="number">{{ __('Numéro SIREN') }} :</label>
								<input type="number" id="number" value="{{ $agent->number }}" name="number" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="signatory">{{ __('Signataire') }} :</label>
								<input type="text" id="signatory" value="{{ $agent->signatory }}" name="signatory" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="defaulttt">{{ __('Par défault') }} :</label>
								<select id="defaulttt" name="default" class="form-control shadow-none rounded">
									<option {{ ($agent->default == 'Oui' )? 'selected': '' }} value="Oui">OUI</option>
									<option {{ ($agent->default == 'Non' )? 'selected': '' }} value="Non">NON</option>
								</select>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="activeee">{{ __('Activé') }} :</label>
								<select id="activeee" name="active" class="form-control shadow-none rounded">
									<option {{ ($agent->active == 'Oui' )? 'selected': '' }} value="Oui">OUI</option>
									<option {{ ($agent->active == 'Non' )? 'selected': '' }} value="Non">NON</option>
								</select>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>

							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
		@endforeach
		@foreach ($auditors as $auditor)
			<div class="modal modal--aside fade leftAsideModal" id="auditorModalEdit{{ $auditor->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 id="updatedtagTitle" class="modal-title text-center mb-5">{{ __('Prestataire énergétique') }}</h1>
						<form action="{{ route('auditor.update') }}" class="form mx-auto needs-validation" enctype="multipart/form-data" novalidate method="POST">
							@csrf
							<div>
								<img  loading="lazy"  src="{{ asset('uploads/auditor') }}/{{ $auditor->logo }}" width="150px" alt="">
							</div>
							<div class="form-group">
								<input type="hidden" name="id" value="{{ $auditor->id }}">
								<label class="form-label" for="logo">{{ __('Logo') }} :</label>
								<input type="file" id="logo" name="logo" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="company_name3">{{ __('Raison sociale') }} :</label>
								<input type="text" id="company_name3" value="{{ $auditor->company_name }}" name="company_name" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="number">{{ __('Numéro SIREN') }} :</label>
								<input type="number" id="number" value="{{ $auditor->number }}" name="number" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="signatory">{{ __('Signataire') }} :</label>
								<input type="text" id="signatory" value="{{ $auditor->signatory }}" name="signatory" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="activeee">{{ __('Activé') }} :</label>
								<select id="activeee" name="active" class="form-control shadow-none rounded">
									<option {{ ($auditor->active == 'Oui' )? 'selected': '' }} value="Oui">OUI</option>
									<option {{ ($auditor->active == 'Non' )? 'selected': '' }} value="Non">NON</option>
								</select>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>

							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
		@endforeach
		@foreach ($areas as $area)
			<div class="modal modal--aside fade leftAsideModal" id="areaModalEdit{{ $area->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 id="updatedtagTitle" class="modal-title text-center mb-5">Les zones d'intervention</h1>
						<form action="{{ route('area.update') }}" class="form mx-auto needs-validation" enctype="multipart/form-data" novalidate method="POST">
							@csrf
							<div class="form-group">
								<input type="hidden" name="id" value="{{ $area->id }}">
								<label class="form-label" for="color">{{ __('Couleur') }} :</label>
								<input type="color" id="color" value="{{ $area->color }}" name="color" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="wording">{{ __('Libellé') }} :</label>
								<input type="text" id="wording" value="{{ $area->wording }}" name="wording" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="activeee">{{ __('Activé') }} :</label>
								<select id="activeee" name="active" class="form-control shadow-none rounded">
									<option {{ ($area->active == 'Oui' )? 'selected': '' }} value="Oui">OUI</option>
									<option {{ ($area->active == 'Non' )? 'selected': '' }} value="Non">NON</option>
								</select>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>

							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
		@endforeach
		@foreach ($controls as $control)
			<div class="modal modal--aside fade leftAsideModal" id="controlModalEdit{{ $control->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 id="updatedtagTitle" class="modal-title text-center mb-5">Bureau de contrôle</h1>
						<form action="{{ route('control.update') }}" class="form mx-auto needs-validation" enctype="multipart/form-data" novalidate method="POST">
							@csrf
							<div>
								<img  loading="lazy"  src="{{ asset('uploads/control') }}/{{ $control->logo }}" width="150px" alt="">
							</div>
							<div class="form-group">
								<input type="hidden" name="id" value="{{ $control->id }}">
								<label class="form-label" for="logo">{{ __('Logo') }} :</label>
								<input type="file" id="logo" name="logo" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="company_name3">{{ __('Raison sociale') }} :</label>
								<input type="text" id="company_name3" value="{{ $control->company_name }}" name="company_name" class="form-control shadow-none rounded" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="number">{{ __('Numéro SIREN') }} :</label>
								<input type="number" id="number" value="{{ $control->number }}" name="number" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="contact_name">{{ __('Nom Contact') }} :</label>
								<input type="text" id="contact_name" value="{{ $control->contact_name }}" name="contact_name" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="activeee">{{ __('Activé') }} :</label>
								<select id="activeee" name="active" class="form-control shadow-none rounded">
									<option {{ ($control->active == 'Oui' )? 'selected': '' }} value="Oui">OUI</option>
									<option {{ ($control->active == 'Non' )? 'selected': '' }} value="Non">NON</option>
								</select>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>

							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
		@endforeach
		@foreach ($brands as $brand)
			<div class="modal modal--aside fade leftAsideModal" id="brandModalEdit{{ $brand->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 id="updatedtagTitle" class="modal-title text-center mb-5">{{ __('Marque') }}</h1>
						<form action="{{ route('brand.update') }}" class="form mx-auto needs-validation" enctype="multipart/form-data" novalidate method="POST">
							@csrf
							<div>
								<img  loading="lazy"  src="{{ asset('uploads/brand') }}/{{ $brand->logo }}" width="150px" alt="">
							</div>
							<div class="form-group mt-2">
								<input type="hidden" name="id" value="{{ $brand->id }}">
								<label class="form-label" for="logo">{{ __('Logo') }} :</label>
								<input type="file" id="logo" name="logo" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="description">{{ __('Description') }} :</label>
								<textarea id="description" name="description" class="form-control shadow-none rounded">{{ $brand->description }}</textarea>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="source">{{ __('Source') }} :</label>
								<input type="text" id="source" value="{{ $brand->source }}" name="source" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="activeee">{{ __('Activé') }} :</label>
								<select id="activeee" name="active" class="form-control shadow-none rounded">
									<option {{ ($brand->active == 'Oui' )? 'selected': '' }} value="Oui">OUI</option>
									<option {{ ($brand->active == 'Non' )? 'selected': '' }} value="Non">NON</option>
								</select>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>

							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
		@endforeach
		@foreach ($benefits as $benefit)
			<div class="modal modal--aside fade leftAsideModal" id="benefitModalEdit{{ $benefit->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 id="updatedtagTitle" class="modal-title text-center mb-5">{{ __('Prestations') }}</h1>
						<form action="{{ route('benefit.update') }}" class="form mx-auto needs-validation" enctype="multipart/form-data" novalidate method="POST">
							@csrf
							<div class="row align-items-center">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="form-group">
										<label class="form-label" for="alias">{{ __('Alias') }} : <span class="text-danger">*</span></label>
										<input type="text" id="alias" name="alias" value="{{ $benefit->alias }}" class="form-control shadow-none rounded" required>
										<input type="hidden" name="id" value="{{ $benefit->id }}">
										<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
									</div>
								</div>
								<hr class="w-100 my-1">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="form-group">
										<label class="form-label" for="title">{{ __('Titre') }} :<span class="text-danger">**</span></label>
										<input type="text" id="title{{ $benefit->id }}" {{ ($benefit->reference_link == 'on')? 'disabled':'' }} name="title" value="{{ $benefit->title }}" class="form-control shadow-none rounded" required>
										<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="switches d-flex justify-content-between align-items-center">
										<label for="#" class="form-label m-0">Récupérer la référence du produit lié :</label>
										<div class="custom-control custom-switch">
											<input type="checkbox" name="reference_link" {{ ($benefit->reference_link == 'on')? 'checked':'' }} class="custom-control-input titleDisabled"  data-id="{{ $benefit->id }}" id="customSwitch1a{{ $benefit->id }}">
											<label class="custom-control-label" for="customSwitch1a{{ $benefit->id }}"></label>
										  </div>
									</div>
								</div>
								<hr class="w-100 my-1">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="form-group">
										<label class="form-label" for="designation{{ $benefit->id }}">{{ __('Designation') }} : <span class="text-danger">**</span></label>
										<textarea id="designation{{ $benefit->id }}" {{ ($benefit->designation_link == 'on')? 'disabled':'' }} name="designation" class="form-control shadow-none rounded" required> {{ $benefit->designation }}</textarea>
										<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="switches d-flex justify-content-between align-items-center">
										<label for="#" class="form-label m-0">Récupérer la désignation du produit lié :</label>
										<div class="custom-control custom-switch">
											<input type="checkbox" name="designation_link" {{ ($benefit->designation_link == 'on')? 'checked':'' }} class="custom-control-input designationDisabled" data-id="{{ $benefit->id }}" id="customSwitch2a{{ $benefit->id }}">
											<label class="custom-control-label" for="customSwitch2a{{ $benefit->id }}"></label>
										  </div>
									</div>
								</div>
								<hr class="w-100 my-1">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
									<p class="m-0">(<span class="text-danger">**</span>)L'un des deux champs est obligatoire</p>
								</div>
								<hr class="w-100 my-1">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label for="#" class="form-label">Position d'affichage :</label>
									<div class="input-group mb-3">
										<div class="input-group-prepend">
										  <button class="btn btn-outline-secondary shadow-none position_decrease"  data-id="{{ $benefit->id }}"  type="button" id="button-addon1">-</button>
										</div>
										<input type="number" id="position{{ $benefit->id }}" class="form-control shadow-none" name="position" value="{{ $benefit->position }}" min="0" aria-label="Example text with button addon" aria-describedby="button-addon1">
										<div class="input-group-append">
											<button class="btn btn-outline-secondary shadow-none position_increase" data-id="{{ $benefit->id }}" type="button" id="button-addon2">+</button>
										  </div>
									  </div>
								</div>
								<hr class="w-100 my-1">
								<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
									<label for="#" class="form-label">Quantité :</label>
									<input type="number" name="quantity" value="{{ $benefit->quantity }}" class="form-control shadow-none rounded">
								</div>
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
									<label for="#" class="form-label">Unité :</label>
									<select id="active" name="unit" class="select2_select_option form-control select2-hidden-accessible rounded">
										<option {{ ($benefit->unit == 'm²')? 'selected':'' }} value="m²">m²</option>
										<option {{ ($benefit->unit == 'm³')? 'selected':'' }} value="m³">m³</option>
										<option {{ ($benefit->unit == 'ml')? 'selected':'' }} value="ml">ml</option>
										<option {{ ($benefit->unit == 'litre')? 'selected':'' }} value="litre">litre</option>
										<option {{ ($benefit->unit == 'heure')? 'selected':'' }} value="heure">heure</option>
										<option {{ ($benefit->unit == 'jour')? 'selected':'' }} value="jour">jour</option>
									</select>
								</div>
								<hr class="w-100">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<label for="#" class="form-label">Barèmes concernés :</label>
									<select id="" name="operation[]" class="select2_select_option custom-select shadow-none form-control" multiple>
										@foreach ($scales->where('active', 'yes') as $scale)
										@if (getFeature($benefit->operation, $scale->id))
											<option selected value="{{ $scale->id }}">{{ $scale->wording }}-{{ $scale->description }}</option>
										@else
											<option value="{{ $scale->id }}">{{ $scale->wording }}-{{ $scale->description }}</option>
										@endif
										@endforeach
									</select>
								</div>
								<hr class="w-100">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label for="one">Prix de vente :</label>
									<div class="input-group">
										<input type="text" id="price{{ $benefit->id }}" {{ ($benefit->related_price == 'on')? 'disabled':'' }} name="price" value="{{ $benefit->price }}" class="form-control shadow-none" aria-label="Dollar amount (with dot and two decimal places)">
										<div class="input-group-append">
										  <span class="input-group-text">Є</span>
										</div>
									  </div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="switches d-flex justify-content-between align-items-center">
										<label for="customSwitch3" class="form-label m-0">Ou prendre le prix du produit lié :</label>
										<div class="custom-control custom-switch">
											<input type="checkbox" name="related_price" {{ ($benefit->related_price == 'on')? 'checked':'' }} class="custom-control-input priceDesabled"  data-id="{{ $benefit->id }}" id="customSwitch3a{{ $benefit->id }}">
											<label class="custom-control-label" for="customSwitch3a{{ $benefit->id }}"></label>
										  </div>
									</div>
								</div>
								<hr class="w-100">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<label for="custom_label--1">Taux TVA :</label>
									<select id="tax{{ $benefit->id }}" name="tax" {{ ($benefit->related_price == 'on')? 'disabled':'' }} class="select2_select_option form-control select2-hidden-accessible rounded">
										<option {{ ($benefit->tax == '0')? 'selected':'' }} value="0">Non spécifiée</option>
										<option {{ ($benefit->tax == '5.5')? 'selected':'' }} value="5.5">Taux réduit à 5,5 %</option>
										<option {{ ($benefit->tax == '20')? 'selected':'' }} value="20">Taux normal à 20 %</option>
									</select>
								</div>
								<hr class="w-100">
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
									<div class="switches d-flex justify-content-between align-items-center">
										<label for="customSwitch4" class="form-label m-0">Activer :</label>
										<div class="custom-control custom-switch">
											<input type="checkbox" name="active" {{ ($benefit->active == 'on')? 'checked':'' }} class="custom-control-input" id="customSwitch4a{{ $benefit->id }}">
											<label class="custom-control-label" for="customSwitch4a{{ $benefit->id }}"></label>
										  </div>
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
									<div class="switches d-flex justify-content-between align-items-center">
										<label for="customSwitch5" class="form-label m-0">Afficher les prix :</label>
										<div class="custom-control custom-switch">
											<input type="checkbox" name="price_show" {{ ($benefit->price_show == 'on')? 'checked':'' }} class="custom-control-input" id="customSwitch5a{{ $benefit->id }}">
											<label class="custom-control-label" for="customSwitch5a{{ $benefit->id }}"></label>
										  </div>
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
									<div class="switches d-flex justify-content-between align-items-center">
										<label for="customSwitch6" class="form-label m-0">A rappeler dynamiquement :</label>
										<div class="custom-control custom-switch">
											<input type="checkbox" name="recall" {{ ($benefit->recall == 'on')? 'checked':'' }} class="custom-control-input" id="customSwitch6a{{ $benefit->id }}">
											<label class="custom-control-label" for="customSwitch6a{{ $benefit->id }}"></label>
										  </div>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
									<button class="btn submit-btn-trans shadow-none">Retour à la liste</button>
									<button type="submit" class="btn submit_btn_color shadow-none ml-3">Enregistrer</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="benefitModalDelete{{ $benefit->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
							<form action="{{ route('benefit.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $benefit->id }}">
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
		@endforeach
		@foreach ($fournessers as $fournesser)
			<div class="modal modal--aside fade leftAsideModal" id="fournesserModalEdit{{ $fournesser->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 id="updatedtagTitle" class="modal-title text-center mb-5">{{ __('Fournisseurs') }}</h1>
						<form action="{{ route('fournesser.update') }}" class="form mx-auto needs-validation" enctype="multipart/form-data" novalidate method="POST">
							@csrf
							<div>
								<img  loading="lazy"  src="{{ asset('uploads/fournesser') }}/{{ $fournesser->logo }}" width="150px" alt="">
							</div>
							<div class="form-group mt-2">
								<input type="hidden" name="id" value="{{ $fournesser->id }}">
								<label class="form-label" for="logo">{{ __('Logo') }} :</label>
								<input type="file" id="logo" name="logo" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="suplier">{{ __('Fournisseur') }} :</label>
								<input type="text" id="suplier" name="suplier" value="{{ $fournesser->suplier }}" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="description">{{ __('Description') }} :</label>
								<textarea id="description" name="description" class="form-control shadow-none rounded">{{ $fournesser->description }}</textarea>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label">Type :</label>
								<select name="type" class="form-control shadow-none rounded">
									<option selected value="">{{ __("Select") }}</option>
									@foreach ($type_fournisseurs as $type_fournisseur)
										<option {{ ($fournesser->type == $type_fournisseur->name )? 'selected': '' }} value="{{ $type_fournisseur->name }}">{{ $type_fournisseur->name }}</option>
									@endforeach
								</select>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="activeee">{{ __('Activé') }} :</label>
								<select id="activeee" name="active" class="form-control shadow-none rounded">
									<option {{ ($fournesser->active == 'Oui' )? 'selected': '' }} value="Oui">OUI</option>
									<option {{ ($fournesser->active == 'Non' )? 'selected': '' }} value="Non">NON</option>
								</select>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>

							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
		@endforeach
		@foreach ($client_companies as $client_company)
			<div class="modal modal--aside fade leftAsideModal" id="client_companyModalEdit{{ $client_company->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 id="updatedtagTitle" class="modal-title text-center mb-5">{{ __('Societé client') }}</h1>
						<form action="{{ route('client_company.update') }}" class="form mx-auto needs-validation" enctype="multipart/form-data" novalidate method="POST">
							@csrf
							<div>
								<img  loading="lazy"  src="{{ asset('uploads/client_company') }}/{{ $client_company->logo }}" width="150px" alt="">
							</div>
							<div class="form-group mt-2">
								<input type="hidden" name="id" value="{{ $client_company->id }}">
								<label class="form-label" for="logo">{{ __('Logo') }} :</label>
								<input type="file" id="logo" name="logo" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="company_name">{{ __('Raison sociale') }} :</label>
								<input type="text" id="company_name" name="company_name" value="{{ $client_company->company_name }}" class="form-control shadow-none rounded">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="description">{{ __('Description') }} :</label>
								<textarea id="description" name="description" class="form-control shadow-none rounded">{{ $client_company->description }}</textarea>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="activeee">{{ __('Activé') }} :</label>
								<select id="activeee" name="active" class="form-control shadow-none rounded">
									<option {{ ($client_company->active == 'Oui' )? 'selected': '' }} value="Oui">OUI</option>
									<option {{ ($client_company->active == 'Non' )? 'selected': '' }} value="Non">NON</option>
								</select>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>

							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
		@endforeach
		@foreach ($categories as $category)
			<div class="modal modal--aside fade leftAsideModal" id="category_edit{{ $category->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">{{ __('Produits Catégorie') }}</h1>
						<form action="{{ route('category.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div class="form-group">
								<label class="form-label" for="#">{{ __('Catégorie') }} <span class="text-danger">*</span></label>
								<input type="hidden" name="id" value="{{ $category->id }}">
								<input type="text" name="name" value="{{ $category->name }}" class="form-control shadow-none rounded" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="category_delete{{ $category->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
							<form action="{{ route('category.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $category->id }}">
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
		@endforeach
		@foreach ($subcategories as $sub_cat)
			<div class="modal modal--aside fade leftAsideModal" id="sub_category_edit{{ $sub_cat->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">{{ __('Produits Sous-Catégorie') }}</h1>
						<form action="{{ route('sub.category.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div class="form-group">
								<label class="form-label" for="#">{{ __('Sous-Catégorie') }} <span class="text-danger">*</span></label>
								<input type="hidden" name="id" value="{{ $sub_cat->id }}">
								<input type="text" name="name" value="{{ $sub_cat->name }}" class="form-control shadow-none rounded" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="sub_category_delete{{ $sub_cat->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
							<form action="{{ route('sub.category.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $sub_cat->id }}">
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
		@endforeach
		@foreach ($products as $product)
			<div class="modal modal--aside fade leftAsideModal" id="product_edit{{ $product->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center mb-5">{{ __('Produit') }}</h1>
						<form action="{{ route('product.update') }}" class="form" method="post" enctype="multipart/form-data">
							@csrf
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6">
									<div class="form-group">
										<label for="#">Type isolant/ Produit :</label>
										<input type="hidden" name="id" value="{{ $product->id }}">
										<input type="text" name="product_type" value="{{ $product->product_type }}" class="form-control shadow-none rounded">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6">
									<div class="form-group">
										<label for="#">Catégorie :</label>
										<select class="select2_select_option form-control" name="category_id">
											@foreach ($categories as $category)
												@if ($category->id == $product->category_id)
												<option selected value="{{ $category->id }}">{{ $category->name }}</option>
												@else
												<option value="{{ $category->id }}">{{ $category->name }}</option>
												@endif
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6">
									<div class="form-group">
										<label for="#">Marque : <span class="text-danger">*</span></label>
										<select class="select2_select_option form-control" name="marque_id" required>
											@foreach ($brands as $marque)
												@if ($marque->id == $product->marque_id)
												<option selected value="{{ $marque->id }}"> {{ $marque->description }} </option>
												@else
												<option value="{{ $marque->id }}"> {{ $marque->description }} </option>
												@endif
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6">
									<div class="form-group">
										<label for="#">Sous-Catégorie :</label>
										<select class="select2_select_option form-control" name="subcategory_id">
											@foreach ($subcategories as $sub_cat)
											 	@if ($product->subcategory_id == $sub_cat->id)
												<option selected value="{{ $sub_cat->id }}">{{ $sub_cat->name }}</option>
												@else
												<option value="{{ $sub_cat->id }}">{{ $sub_cat->name }}</option>
												@endif
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6">
									<div class="form-group">
										<label for="#">Référence : <span class="text-danger">*</span></label>
										<input type="text" name="reference" value="{{ $product->reference }}" class="form-control shadow-none rounded" required>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6">
									<div class="form-group">
										<label for="#">Norme  :</label>
										<input type="text" name="standard" value="{{ $product->standard }}" class="form-control shadow-none rounded">
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12">
									<div class="form-group">
										<label for="#">Designation :<span class="text-danger">*</span></label>
										<textarea class="form-control shadow-none rounded" name="designation" rows="3" required>{{ $product->designation }}</textarea>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12">
									<div class="form-group">
										<label for="#">Note de dimensionnement :</label>
										<textarea class="form-control shadow-none rounded"  name="sizing_note" rows="3">{{ $product->sizing_note }}</textarea>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12">
									<label for="#">Acermi :</label>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4">
									<div class="form-group">
										<input type="text" name="acermi_reference" value="{{ $product->acermi_reference }}" class="form-control shadow-none rounded" placeholder="Référence">
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4">
									<div class="form-group">
										<input type="date" name="acermi_date" value="{{ $product->acermi_date }}" class="flatpickr form-control shadow-none rounded">
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4">
									<div class="input-group mb-3">
										<div class="custom-file">
										  <input type="file" name="acermi_file" class="custom-file-input form-control" id="inputGroupFile02{{ $product->id }}">
										  <label class="custom-file-label" for="inputGroupFile02{{ $product->id }}" aria-describedby="inputGroupFileAddon02">Choose file</label>
										</div>
									  </div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12">
									<label for="#">Certita :</label>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4">
									<div class="form-group">
										<input type="text" name="certita_reference" value="{{ $product->certita_reference }}" class="form-control shadow-none rounded" placeholder="Référence">
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4">
									<div class="form-group">
										<input type="date" name="certita_date" value="{{ $product->certita_date }}" class="flatpickr form-control shadow-none rounded">
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4">
									<div class="input-group mb-3">
										<div class="custom-file">
										  <input type="file" name="certita_file" class="custom-file-input form-control" id="inputGroupFile03{{ $product->id }}">
										  <label class="custom-file-label" for="inputGroupFile03{{ $product->id }}" aria-describedby="inputGroupFileAddon02">Choose file</label>
										</div>
									  </div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12">
									<label for="#">Avis technique :</label>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4">
									<input type="text" name="notice_reference" value="{{ $product->notice_reference }}" class="form-control shadow-none rounded" placeholder="Référence">
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4">
									<input type="date" name="notice_date" value="{{ $product->notice_date }}" class="flatpickr form-control shadow-none rounded" placeholder="Date de Validité">
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4">
									<div class="input-group mb-3">
										<div class="custom-file">
										  <input type="file" name="notice_file" class="custom-file-input form-control" id="inputGroupFile04{{ $product->id }}">
										  <label class="custom-file-label" for="inputGroupFile04{{ $product->id }}" aria-describedby="inputGroupFileAddon02">Choose file</label>
										</div>
									  </div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12">
									<label for="#">Fiche Technique :</label>
								</div>
								<div class="col-lg-8 col-md-9 col-sm-8">
									<div class="input-group mb-3">
										<div class="custom-file">
										  <input type="file" name="data_file" class="custom-file-input form-control" id="inputGroupFile05{{ $product->id }}">
										  <label class="custom-file-label" for="inputGroupFile05{{ $product->id }}" aria-describedby="inputGroupFileAddon02">Choose file</label>
										</div>
									  </div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6">
									<div class="switches d-flex">
										<label for="customSwitch43">Marquage CE :</label>
										<div class="custom-control custom-switch ml-4">
											<input type="checkbox" name="ce_marking" {{ ($product->ce_marking == 'on')? 'checked':'' }} class="custom-control-input" id="customSwitch43{{ $product->id }}">
											<label class="custom-control-label" for="customSwitch43{{ $product->id }}"></label>
										  </div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 .col-sm-6">
									<div class="switches d-flex">
										<label for="customSwitch44">Activer :</label>
										<div class="custom-contro2 custom-switch ml-4">
											<input type="checkbox" name="activate" {{ ($product->activate == 'on')? 'checked':'' }} class="custom-control-input" id="customSwitch44{{ $product->id }}">
											<label class="custom-control-label" for="customSwitch44{{ $product->id }}"></label>
										  </div>
									</div>
								</div>
							</div>
							<div class="row">
								{{-- <div class="col-lg-12 col-md-12 col-sm-12">
									<label for="#">Barèmes concernés en B2C :</label>
									<select name="baremes[]" class="select2_select_option custom-select shadow-none form-control" multiple>
										@foreach ($scales->where('active', 'yes') as $scale)
										@if (getFeature($product->baremes, $scale->id))
										<option selected value="{{ $scale->id }}">{{ $scale->wording }}</option>
										@else
										<option value="{{ $scale->id }}">{{ $scale->wording }}</option>
										@endif
										@endforeach
									</select>
								</div> --}}
								<div class="col-12">
									<label for="#">Barèmes : <span class="text-danger">*</span></label>
									<select name="tags[]" class="select2_select_option custom-select shadow-none form-control" multiple required>
										@foreach ($bareme_travaux_tags as $tag)
											@if (\App\Models\CRM\ProductTag::where('product_id', $product->id)->where('tag_id', $tag->id)->exists())
												<option selected value="{{ $tag->id }}">{{ $tag->bareme }}</option>
											@else
												<option value="{{ $tag->id }}">{{ $tag->bareme }}</option>
											@endif
										@endforeach
									</select>
								</div>
								<div class="col-12">
									<label class="form-label"> Prestation :</label>
									<select name="prestation_id[]" class="select2_select_option custom-select shadow-none form-control" multiple>
										@foreach ($benefits as $prestation)
											<option {{ $product->prestations()->where('benefit_id', $prestation->id)->first() ? 'selected':'' }} value="{{ $prestation->id }}">{{ $prestation->alias }}</option>
										@endforeach
									</select>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12">
									<label for="#">Mode de Pose :</label>
									<select class="select2_select_option form-control" name="installation_mode" required>
										<option {{ ($product->installation_mode == 'Soufflé')? 'selected': ''  }} value="Soufflé">Soufflé</option>
										<option {{ ($product->installation_mode == 'Deroulé')? 'selected': ''  }} value="Deroulé">Deroulé</option>
									</select>
								</div>

								<div class="col-lg-12 col-md-12 col-sm-12">
									<label for="#">Cap. de couverture :</label>
									<div class="input-group">
										<input type="number" class="form-control" name="covering_capacity" value="{{ $product->covering_capacity }}" aria-label="Dollar amount (with dot and two decimal places)">
										<div class="input-group-append">
										  <span class="input-group-text">m2</span>
										</div>
									  </div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12">
									<label for="#">Epaisseur :</label>
									<div class="input-group">
										<input type="text" class="form-control" name="thikness" value="{{ $product->thikness }}" aria-label="Dollar amount (with dot and two decimal places)">
										<div class="input-group-append">
										  <span class="input-group-text">mm</span>
										</div>
									  </div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12">
									<label for="#">Rés. thermique 1 :</label>
									<div class="input-group">
										<input type="text" class="form-control" value="{{ $product->thermal_res }}" name="thermal_res" aria-label="Dollar amount (with dot and two decimal places)">
										<div class="input-group-append">
										  <span class="input-group-text">m².K/W</span>
										</div>
									  </div>
								</div>

								<div class="col-lg-12 col-md-12 col-sm-12 mt-4">
									<div class="form_submit_btn text-right">
										<button class="btn submit-btn-trans shadow-none">Retour à la liste</button>
										<button type="submit" class="btn submit_btn_color shadow-none ml-3">Enregistrer</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
			<div class="modal modal--aside fade" id="product_delete{{ $product->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
							<form action="{{ route('product.delete') }}" method="POST">
								@csrf
								<input type="hidden" name="id" value="{{ $product->id }}">
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
		@endforeach



@endsection

@push('js')
	<script>
		$(document).ready(function(){
			// $('.datatable').DataTable(); 
			$('body').on('change', '.rankChange', function(){
				if($(this).val() == 1){
					$('#'+$(this).data('id')).slideDown();
					$('#bareme').prop('required', true);
					$('#bareme_description').prop('required', true);
				}else{
					$('#'+$(this).data('id')).slideUp();
					$('#bareme').prop('required', false);
					$('#bareme_description').prop('required', false);
				}
			});


			@if (session('active_question_tab'))
				$('#v-pills-3-tab').addClass('active');
				$('#v-pills-3').addClass('show active');
				$('#v-pills-3-tab').attr('aria-selected', true);
			@elseif (session('baremes_tab_activate'))
				$('#v-pills-3-tab').addClass('active');
				$('#v-pills-3').addClass('show active');
				$('#v-pills-3-tab').attr('aria-selected', true);
			@elseif (session('scale_active'))
				$('#v-pills-5-tab').addClass('active');
				$('#v-pills-5').addClass('show active');
				$('#v-pills-5-tab').attr('aria-selected', true);
			@elseif (session('travaux_tab_active'))
				$('#v-pills-product-tab').addClass('active');
				$('#v-pills-product').addClass('show active');
				$('#v-pills-product-tab').attr('aria-selected', true);
			@elseif (session('delegate_tab_active'))
				$('#v-pills-6-tab').addClass('active');
				$('#v-pills-6').addClass('show active');
				$('#v-pills-6-tab').attr('aria-selected', true);
			@elseif (session('deal_tab_active'))
				$('#v-pills-7-tab').addClass('active');
				$('#v-pills-7').addClass('show active');
				$('#v-pills-7-tab').attr('aria-selected', true);
			@elseif (session('installer_tab_active'))
				$('#v-pills-8-tab').addClass('active');
				$('#v-pills-8').addClass('show active');
				$('#v-pills-8-tab').attr('aria-selected', true);
			@elseif (session('amo_tab_active'))
				$('#v-pills-9-tab').addClass('active');
				$('#v-pills-9').addClass('show active');
				$('#v-pills-9-tab').attr('aria-selected', true);
			@elseif (session('agent_tab_active'))
				$('#v-pills-10-tab').addClass('active');
				$('#v-pills-10').addClass('show active');
				$('#v-pills-10-tab').attr('aria-selected', true);
			@elseif (session('auditor_tab_active'))
				$('#v-pills-11-tab').addClass('active');
				$('#v-pills-11').addClass('show active');
				$('#v-pills-11-tab').attr('aria-selected', true);
			@elseif (session('area_tab_active'))
				$('#v-pills-12-tab').addClass('active');
				$('#v-pills-12').addClass('show active');
				$('#v-pills-12-tab').attr('aria-selected', true);
			@elseif (session('control_tab_active'))
				$('#v-pills-13-tab').addClass('active');
				$('#v-pills-13').addClass('show active');
				$('#v-pills-13-tab').attr('aria-selected', true);
			@elseif (session('brand_tab_active'))
				$('#v-pills-14-tab').addClass('active');
				$('#v-pills-14').addClass('show active');
				$('#v-pills-14-tab').attr('aria-selected', true);
			@elseif (session('benefit_tab_active'))
				$('#v-pills-15-tab').addClass('active');
				$('#v-pills-15').addClass('show active');
				$('#v-pills-15-tab').attr('aria-selected', true);
			@elseif (session('fournesser_tab_active'))
				$('#v-pills-16-tab').addClass('active');
				$('#v-pills-16').addClass('show active');
				$('#v-pills-16-tab').attr('aria-selected', true);
			@elseif (session('client_company_tab_active'))
				$('#v-pills-17-tab').addClass('active');
				$('#v-pills-17').addClass('show active');
				$('#v-pills-17-tab').attr('aria-selected', true);
			@elseif (session('produits_tab_active'))
				$('#v-pills-18-tab').addClass('active');
				$('#v-pills-18').addClass('show active');
				$('#v-pills-18-tab').attr('aria-selected', true);
			@elseif (session('category_tab_active'))
				$('#v-pills-19-tab').addClass('active');
				$('#v-pills-19').addClass('show active');
				$('#v-pills-19-tab').attr('aria-selected', true);
			@elseif (session('sub_category_tab_active'))
				$('#v-pills-20-tab').addClass('active');
				$('#v-pills-20').addClass('show active');
				$('#v-pills-20-tab').attr('aria-selected', true);
			@elseif (session('regie_tab_active'))
				$('#v-pills-regie-tab').addClass('active');
				$('#v-pills-regie').addClass('show active');
				$('#v-pills-regie-tab').attr('aria-selected', true);
			@elseif (session('control_active'))
				$('#v-pills-documentControl-tab').addClass('active');
				$('#v-pills-documentControl').addClass('show active');
				$('#v-pills-documentControl-tab').attr('aria-selected', true);
			@elseif (session('banque_active'))
				$('#v-pills-banque-tab').addClass('active');
				$('#v-pills-banque').addClass('show active');
				$('#v-pills-banque-tab').attr('aria-selected', true);
			@elseif (session('office_active'))
				$('#v-pills-office-tab').addClass('active');
				$('#v-pills-office').addClass('show active');
				$('#v-pills-office-tab').attr('aria-selected', true);
			@elseif (session('audit_status'))
				$('#v-pills-status_audit-tab').addClass('active');
				$('#v-pills-status_audit').addClass('show active');
				$('#v-pills-status_audit-tab').attr('aria-selected', true);
			@elseif (session('audit_report'))
				$('#v-pills-status_report_audit-tab').addClass('active');
				$('#v-pills-status_report_audit').addClass('show active');
				$('#v-pills-status_report_audit-tab').attr('aria-selected', true);
			@elseif (session('report_result'))
				$('#v-pills-report_result-tab').addClass('active');
				$('#v-pills-report_result').addClass('show active');
				$('#v-pills-report_result-tab').attr('aria-selected', true);
			@elseif (session('commercial'))
				$('#v-pills-commercial-tab').addClass('active');
				$('#v-pills-commercial').addClass('show active');
				$('#v-pills-commercial-tab').attr('aria-selected', true);
			@elseif (session('status_study'))
				$('#v-pills-status_planning_study-tab').addClass('active');
				$('#v-pills-status_planning_study').addClass('show active');
				$('#v-pills-status_planning_study-tab').attr('aria-selected', true);
			@elseif (session('technician_study'))
				$('#v-pills-technician_study-tab').addClass('active');
				$('#v-pills-technician_study').addClass('show active');
				$('#v-pills-technician_study-tab').attr('aria-selected', true);
			@elseif (session('technical_referee'))
				$('#v-pills-technical_referee-tab').addClass('active');
				$('#v-pills-technical_referee').addClass('show active');
				$('#v-pills-technical_referee-tab').attr('aria-selected', true);
			@elseif (session('status_feasibility'))
				$('#v-pills-status_feasibility_study-tab').addClass('active');
				$('#v-pills-status_feasibility_study').addClass('show active');
				$('#v-pills-status_feasibility_study-tab').attr('aria-selected', true);
			@elseif (session('status_planning_previsite'))
				$('#v-pills-status_planning_previsite-tab').addClass('active');
				$('#v-pills-status_planning_previsite').addClass('show active');
				$('#v-pills-status_planning_previsite-tab').attr('aria-selected', true);
			@elseif (session('technician_previsite'))
				$('#v-pills-technician_previsite-tab').addClass('active');
				$('#v-pills-technician_previsite').addClass('show active');
				$('#v-pills-technician_previsite-tab').attr('aria-selected', true);
			@elseif (session('status_previsite'))
				$('#v-pills-status_previsite-tab').addClass('active');
				$('#v-pills-status_previsite').addClass('show active');
				$('#v-pills-status_previsite-tab').attr('aria-selected', true);
			@elseif (session('status_feasibility_previsite'))
				$('#v-pills-status_feasibility_previsite-tab').addClass('active');
				$('#v-pills-status_feasibility_previsite').addClass('show active');
				$('#v-pills-status_feasibility_previsite-tab').attr('aria-selected', true);
			@elseif (session('status_planning_counter'))
				$('#v-pills-status_planning_counter-tab').addClass('active');
				$('#v-pills-status_planning_counter').addClass('show active');
				$('#v-pills-status_planning_counter-tab').attr('aria-selected', true);
			@elseif (session('technician_planning_counter'))
				$('#v-pills-technician_planning_counter-tab').addClass('active');
				$('#v-pills-technician_planning_counter').addClass('show active');
				$('#v-pills-technician_planning_counter-tab').attr('aria-selected', true);
			@elseif (session('status_counter'))
				$('#v-pills-status_counter-tab').addClass('active');
				$('#v-pills-status_counter').addClass('show active');
				$('#v-pills-status_counter-tab').attr('aria-selected', true);
			@elseif (session('status_feasibility_counter'))
				$('#v-pills-status_feasibility_counter-tab').addClass('active');
				$('#v-pills-status_feasibility_counter').addClass('show active');
				$('#v-pills-status_feasibility_counter-tab').attr('aria-selected', true);
			@elseif (session('status_planning_installation'))
				$('#v-pills-status_planning_installation-tab').addClass('active');
				$('#v-pills-status_planning_installation').addClass('show active');
				$('#v-pills-status_planning_installation-tab').attr('aria-selected', true);
			@elseif (session('status_planning_sav'))
				$('#v-pills-status_planning_sav-tab').addClass('active');
				$('#v-pills-status_planning_sav').addClass('show active');
				$('#v-pills-status_planning_sav-tab').attr('aria-selected', true);
			@elseif (session('technician_sav'))
				$('#v-pills-technician_sav-tab').addClass('active');
				$('#v-pills-technician_sav').addClass('show active');
				$('#v-pills-technician_sav-tab').attr('aria-selected', true);
			@elseif (session('status_resolution_sav'))
				$('#v-pills-status_resolution_sav-tab').addClass('active');
				$('#v-pills-status_resolution_sav').addClass('show active');
				$('#v-pills-status_resolution_sav-tab').attr('aria-selected', true);
			@elseif (session('status_planning_deplacement'))
				$('#v-pills-status_planning_deplacement-tab').addClass('active');
				$('#v-pills-status_planning_deplacement').addClass('show active');
				$('#v-pills-status_planning_deplacement-tab').attr('aria-selected', true);
			@elseif (session('control_office'))
				$('#v-pills-control_office-tab').addClass('active');
				$('#v-pills-control_office').addClass('show active');
				$('#v-pills-control_office-tab').attr('aria-selected', true);
			@elseif (session('inspection_status'))
				$('#v-pills-inspection_status-tab').addClass('active');
				$('#v-pills-inspection_status').addClass('show active');
				$('#v-pills-inspection_status-tab').attr('aria-selected', true);
			@elseif (session('controlled_workd'))
				$('#v-pills-controlled_workd-tab').addClass('active');
				$('#v-pills-controlled_workd').addClass('show active');
				$('#v-pills-controlled_workd-tab').attr('aria-selected', true);
			@elseif (session('compliance'))
				$('#v-pills-compliance-tab').addClass('active');
				$('#v-pills-compliance').addClass('show active');
				$('#v-pills-compliance-tab').attr('aria-selected', true);
			@elseif (session('company_commissioned'))
				$('#v-pills-company_commissioned-tab').addClass('active');
				$('#v-pills-company_commissioned').addClass('show active');
				$('#v-pills-company_commissioned-tab').attr('aria-selected', true);
			@elseif (session('commissioning_technician'))
				$('#v-pills-commissioning_technician-tab').addClass('active');
				$('#v-pills-commissioning_technician').addClass('show active');
				$('#v-pills-commissioning_technician-tab').attr('aria-selected', true);
			@elseif (session('commissioning_status'))
				$('#v-pills-commissioning_status-tab').addClass('active');
				$('#v-pills-commissioning_status').addClass('show active');
				$('#v-pills-commissioning_status-tab').attr('aria-selected', true);
			@elseif (session('status_invoice_company'))
				$('#v-pills-status_invoice_company-tab').addClass('active');
				$('#v-pills-status_invoice_company').addClass('show active');
				$('#v-pills-status_invoice_company-tab').attr('aria-selected', true);
			@elseif (session('control_office_csp'))
				$('#v-pills-control_office_csp-tab').addClass('active');
				$('#v-pills-control_office_csp').addClass('show active');
				$('#v-pills-control_office_csp-tab').attr('aria-selected', true);
			@elseif (session('material_list'))
				$('#v-pills-material_list-tab').addClass('active');
				$('#v-pills-material_list').addClass('show active');
				$('#v-pills-material_list-tab').attr('aria-selected', true);
			@elseif (session('commercial_invoice_status'))
				$('#v-pills-commercial_invoice_status-tab').addClass('active');
				$('#v-pills-commercial_invoice_status').addClass('show active');
				$('#v-pills-commercial_invoice_status-tab').attr('aria-selected', true);
			@elseif (session('invoice_commercial'))
				$('#v-pills-invoice_commercial-tab').addClass('active');
				$('#v-pills-invoice_commercial').addClass('show active');
				$('#v-pills-invoice_commercial-tab').attr('aria-selected', true);
			@elseif (session('previsiteur'))
				$('#v-pills-previsiteur-tab').addClass('active');
				$('#v-pills-previsiteur').addClass('show active');
				$('#v-pills-previsiteur-tab').attr('aria-selected', true);
			@elseif (session('ticket_problem_status'))
				$('#v-pills-ticket_problem_status-tab').addClass('active');
				$('#v-pills-ticket_problem_status').addClass('show active');
				$('#v-pills-ticket_problem_status-tab').attr('aria-selected', true);
			@elseif (session('energy_type'))
				$('#v-pills-energy_type-tab').addClass('active');
				$('#v-pills-energy_type').addClass('show active');
				$('#v-pills-energy_type-tab').attr('aria-selected', true);
			@elseif (session('prestation_group'))
				$('#v-pills-prestation_group-tab').addClass('active');
				$('#v-pills-prestation_group').addClass('show active');
				$('#v-pills-prestation_group-tab').attr('aria-selected', true);
			@elseif (session('comment_category'))
				$('#v-pills-comment_category-tab').addClass('active');
				$('#v-pills-comment_category').addClass('show active');
				$('#v-pills-comment_category-tab').attr('aria-selected', true);
			@elseif (session('quality_control'))
				$('#v-pills-quality_control-tab').addClass('active');
				$('#v-pills-quality_control').addClass('show active');
				$('#v-pills-quality_control-tab').attr('aria-selected', true);
			@elseif (session('notion_category'))
				$('#v-pills-notion_category-tab').addClass('active');
				$('#v-pills-notion_category').addClass('show active');
				$('#v-pills-notion_category-tab').attr('aria-selected', true);
			@elseif (session('lead_sub_status'))
				$('#v-pills-lead_sub_status-tab').addClass('active');
				$('#v-pills-lead_sub_status').addClass('show active');
				$('#v-pills-lead_sub_status-tab').attr('aria-selected', true);
			@elseif (session('project_sub_status'))
				$('#v-pills-project_sub_status-tab').addClass('active');
				$('#v-pills-project_sub_status').addClass('show active');
				$('#v-pills-project_sub_status-tab').attr('aria-selected', true);
			@elseif (session('heating_mode'))
				$('#v-pills-heating_mode-tab').addClass('active');
				$('#v-pills-heating_mode').addClass('show active');
				$('#v-pills-heating_mode-tab').attr('aria-selected', true);
			@elseif (session('campagne_type'))
				$('#v-pills-campagne_type-tab').addClass('active');
				$('#v-pills-campagne_type').addClass('show active');
				$('#v-pills-campagne_type-tab').attr('aria-selected', true);
			@elseif (session('status_planning_intervention'))
				$('#v-pills-status_planning_intervention-tab').addClass('active');
				$('#v-pills-status_planning_intervention').addClass('show active');
				$('#v-pills-status_planning_intervention-tab').attr('aria-selected', true);
			@elseif (session('project_ko_reason'))
				$('#v-pills-project_ko_reason-tab').addClass('active');
				$('#v-pills-project_ko_reason').addClass('show active');
				$('#v-pills-project_ko_reason-tab').attr('aria-selected', true);
			@elseif (session('project_reflection_reason'))
				$('#v-pills-project_reflection_reason-tab').addClass('active');
				$('#v-pills-project_reflection_reason').addClass('show active');
				$('#v-pills-project_reflection_reason-tab').attr('aria-selected', true);
			@elseif (session('project_control_photo'))
				$('#v-pills-project_control_photo-tab').addClass('active');
				$('#v-pills-project_control_photo').addClass('show active');
				$('#v-pills-project_control_photo-tab').attr('aria-selected', true);
			@elseif (session('statut_maprimerenov'))
				$('#v-pills-statut_maprimerenov-tab').addClass('active');
				$('#v-pills-statut_maprimerenov').addClass('show active');
				$('#v-pills-statut_maprimerenov-tab').attr('aria-selected', true);
			@elseif (session('notion_sub_category'))
				$('#v-pills-notion_sub_category-tab').addClass('active');
				$('#v-pills-notion_sub_category').addClass('show active');
				$('#v-pills-notion_sub_category-tab').attr('aria-selected', true);
			@elseif (session('Entreprise_de_travaux'))
				$('#v-pills-Entreprise_de_travaux-tab').addClass('active');
				$('#v-pills-Entreprise_de_travaux').addClass('show active');
				$('#v-pills-Entreprise_de_travaux-tab').attr('aria-selected', true);
			@elseif (session('reject_reason'))
				$('#v-pills-reject_reason-tab').addClass('active');
				$('#v-pills-reject_reason').addClass('show active');
				$('#v-pills-reject_reason-tab').attr('aria-selected', true);
			@elseif (session('type_fournisseur'))
				$('#v-pills-type_fournisseur-tab').addClass('active');
				$('#v-pills-type_fournisseur').addClass('show active');
				$('#v-pills-type_fournisseur-tab').attr('aria-selected', true);
			@elseif (session('color_user'))
				$('#v-pills-color_user-tab').addClass('active');
				$('#v-pills-color_user').addClass('show active');
				$('#v-pills-color_user-tab').attr('aria-selected', true);
			@elseif (session('BAR_TH_164'))
				$('#v-pills-BAR_TH_164-tab').addClass('active');
				$('#v-pills-BAR_TH_164').addClass('show active');
				$('#v-pills-BAR_TH_164-tab').attr('aria-selected', true);
			@else
			$('#v-pills-1-tab').addClass('active');
			$('#v-pills-1').addClass('show active');
			$('#v-pills-1-tab').attr('aria-selected', true);
			@endif


			$('#qualityControlBtn').click(function(){
				var travaux = $('#quality_controle_name').val();
				if(travaux == ''){
					$('#errorMessage').html("{{ __('This field is required') }}");
					$('.toast.toast--error').toast('show');
					$('#quality_controle_name').focus();
				}
				else{
					$('.qc_question_title').each(function(){
						if($(this).val() == ''){
							$('#errorMessage').html("{{ __('This field is required') }}");
							$('.toast.toast--error').toast('show');
							$(this).focus();
							exit();
						}
					});
					$("#qualityControlTypeForm").submit();
				}
			});

			$('.qualityControlBtn__edit').click(function(){
				let id = $(this).data('id');
				var travaux = $('#quality_controls__edit'+id).val();
				if(travaux == ''){
					$('#errorMessage').html("{{ __('This field is required') }}");
					$('.toast.toast--error').toast('show');
					$('#quality_controls__edit'+id).focus();
				}
				else{
					$('.qc_question_title__edit'+id).each(function(){
						if($(this).val() == ''){
							$('#errorMessage').html("{{ __('This field is required') }}");
							$('.toast.toast--error').toast('show');
							$(this).focus();
							exit();
						}
					});
					$("#qualityControleUpdateForm"+id).submit();
				}
			});

			$('#add_more_question_btn__qc').click(function(){
				var string = Math.random().toString(10).substring(2,12);
				var data = `<div class='new_qc__block' style='display:none'>
								<div class="form-group">
									<div class="d-flex align-items-center justify-content-between">
										<label class="form-label" for="label_title__qc${string}">{{ __('Question') }} <span class="text-danger">*</span></label>
										<button type="button" class="remove-btn d-inline-flex align-items-center justify-content-center button mb-1 remove_question_block__qc">×</button>
									</div>
									<input type="text" name="label_title[]" id="label_title__qc${string}" class="form-control shadow-none qc_question_title">
									<input type="hidden" name="type[]" value="question">
									<input type="hidden" name="qc_header_color[]">
								</div>
								<div class="form-group">
									<label class="form-label" for="input_type__qc${string}">{{ __('Select Input Type') }} <span class="text-danger">*</span></label>
									<select name="input_type[]" id="input_type__qc${string}"  class="select2_select_option custom-select shadow-none form-control">
										<option value="text">{{ __('Text') }}</option>
										<option value="number">{{ __('Number') }}</option>
										<option value="email">{{ __('Email') }}</option>
										<option value="radio">{{ __('Radio') }}</option>
										<option value="checkbox">{{ __('Checkbox') }}</option>
										<option value="select">{{ __('Dropdown') }}</option>
										<option value="textarea">{{ __('Textarea') }}</option>
									</select>
								</div>
								<div class="form-group">
									<label class="form-label" for="required_optional__qc${string}">{{ __('Required/Optional') }} <span class="text-danger">*</span></label>
									<select name="required_optional[]" id="required_optional__qc${string}"  class="select2_select_option custom-select shadow-none form-control">
										<option value="no">{{ __('Optional') }}</option>
										<option value="yes">{{ __('Required') }}</option>
									</select>
								</div>
								<div class="form-group">
									<label class="form-label" for="options__qc${string}">{{ __('Options') }}</label>
									<textarea name="options[]" id="options__qc${string}" class="form-control shadow-none" placeholder="{{ __('Enter Options. Each option seperate with comma ,') }}"></textarea>
								</div>
							</div>`;
				$('#addMoreQuestion__qc').append(data);
				$('.new_qc__block').slideDown(data);
			});
			$('#add_more_header').click(function(){
				var string = Math.random().toString(10).substring(2,12);
				var data = `<div class="new_qc__block" style="display:none">
								<div class="form-group">
									<div class="d-flex align-items-center justify-content-between">
										<label class="form-label" for="qc_header${string}">{{ __('Header Title') }} <span class="text-danger">*</span></label>
										<button type="button" class="remove-btn d-inline-flex align-items-center justify-content-center button mb-1 remove_question_block__qc">×</button>
									</div>
									<input type="text" name="label_title[]" id="qc_header${string}" class="form-control shadow-none qc_question_title" required>
									<input type="hidden" name="type[]" value="header">
									<input type="hidden" name="options[]">
									<input type="hidden" name="input_type[]">
									<input type="hidden" name="required_optional[]">

								</div>
								<div class="form-group">
									<label class="form-label" for="qc_header_color${string}">{{ __('Header Background Color') }} <span class="text-danger">*</span></label>
									<input type="color" name="qc_header_color[]" id="qc_header_color${string}" class="form-control shadow-none" required>
								</div>
							</div>`;
				$('#addMoreQuestion__qc').append(data);
				$('.new_qc__block').slideDown(data);
			});
			$('.add_more_question_btn__qc__edit').click(function(){
				let id = $(this).data('id');
				var string = Math.random().toString(10).substring(2,12);
				var data = `<div class='new_qc__block' style='display:none'>
								<div class="form-group">
									<div class="d-flex align-items-center justify-content-between">
										<label class="form-label" for="label_title__qc${string}">{{ __('Question') }} <span class="text-danger">*</span></label>
										<button type="button" class="remove-btn d-inline-flex align-items-center justify-content-center button mb-1 remove_question_block__qc">×</button>
									</div>
									<input type="text" name="label_title[]" id="label_title__qc${string}" class="form-control shadow-none qc_question_title">
									<input type="hidden" name="type[]" value="question">
									<input type="hidden" name="qc_header_color[]">
									<input type="hidden" name="question_id[]" value="0">
								</div>
								<div class="form-group">
									<label class="form-label" for="input_type__qc${string}">{{ __('Select Input Type') }} <span class="text-danger">*</span></label>
									<select name="input_type[]" id="input_type__qc${string}"  class="select2_select_option custom-select shadow-none form-control">
										<option value="text">{{ __('Text') }}</option>
										<option value="number">{{ __('Number') }}</option>
										<option value="email">{{ __('Email') }}</option>
										<option value="radio">{{ __('Radio') }}</option>
										<option value="checkbox">{{ __('Checkbox') }}</option>
										<option value="select">{{ __('Dropdown') }}</option>
										<option value="textarea">{{ __('Textarea') }}</option>
									</select>
								</div>
								<div class="form-group">
									<label class="form-label" for="required_optional__qc${string}">{{ __('Required/Optional') }} <span class="text-danger">*</span></label>
									<select name="required_optional[]" id="required_optional__qc${string}"  class="select2_select_option custom-select shadow-none form-control">
										<option value="no">{{ __('Optional') }}</option>
										<option value="yes">{{ __('Required') }}</option>
									</select>
								</div>
								<div class="form-group">
									<label class="form-label" for="options__qc${string}">{{ __('Options') }}</label>
									<textarea name="options[]" id="options__qc${string}" class="form-control shadow-none" placeholder="{{ __('Enter Options. Each option seperate with comma ,') }}"></textarea>
								</div>
							</div>`;
				$('#addMoreQuestion__qc__edit'+id).append(data);
				$('.new_qc__block').slideDown(data);
			});
			$('.add_more_header__edit').click(function(){
				let id = $(this).data('id');
				var string = Math.random().toString(10).substring(2,12);
				var data = `<div class="new_qc__block" style="display:none">
								<div class="form-group">
									<div class="d-flex align-items-center justify-content-between">
										<label class="form-label" for="qc_header${string}">{{ __('Header Title') }} <span class="text-danger">*</span></label>
										<button type="button" class="remove-btn d-inline-flex align-items-center justify-content-center button mb-1 remove_question_block__qc">×</button>
									</div>
									<input type="text" name="label_title[]" id="qc_header${string}" class="form-control shadow-none qc_question_title" required>
									<input type="hidden" name="type[]" value="header">
									<input type="hidden" name="options[]">
									<input type="hidden" name="input_type[]">
									<input type="hidden" name="required_optional[]">
									<input type="hidden" name="question_id[]" value="0">

								</div>
								<div class="form-group">
									<label class="form-label" for="qc_header_color${string}">{{ __('Header Background Color') }} <span class="text-danger">*</span></label>
									<input type="color" name="qc_header_color[]" id="qc_header_color${string}" class="form-control shadow-none" required>
								</div>
							</div>`;
				$('#addMoreQuestion__qc__edit'+id).append(data);
				$('.new_qc__block').slideDown(data);
			});


			$('body').on('click', '.remove_question_block__qc', function(){
				$(this).closest('.new_qc__block').slideUp(function(){
					$(this).remove();
				});
			});

			// Change User password
			$('#passwordChangeBtn').click(function(e){

				e.preventDefault();

				 var user_id				= $('#user_id').val();
				 var oldPassword			= $('#oldPassword').val();
				 var newPassword 			= $('#newPassword').val();
				 var confirmNewPassword 	= $('#retypePassword').val();

				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
                $.ajax({
                    type: "POST",
                    url: "{{ route('password.change') }}",
                    data: {
                        user_id					:user_id,
                        old_password			:oldPassword,
                        new_password			:newPassword,
                        confirm_new_passowrd	:confirmNewPassword,
                    },
                    success: function (response) {
						$("#oldPasswordError").text('');
						$("#newPasswordError").text('');
						$("#ConfirmPasswordError").text('');
						$("#generalInfoForm2").trigger('reset');

						if(response == 'success'){
							$("#alertMessage").removeClass('d-none alert-danger');
							$("#alertMessage").addClass('alert-success');
							$("#alertMessage").html("{{ __('You Password changed') }}");
						}

						if(response == 'fail'){
							$("#alertMessage").removeClass('d-none alert-success');
							$("#alertMessage").addClass('alert-danger');
							$("#alertMessage").html("{{ __('You Password Not changed') }}");
						}

                    },
					error: function(response){
						$("#alertMessage").addClass('d-none');
						$("#oldPasswordError").html(response.responseJSON.errors.old_password);
						$("#newPasswordError").html(response.responseJSON.errors.new_password);
						$("#ConfirmPasswordError").html(response.responseJSON.errors.confirm_new_passowrd);
					}
                });


			});

			$('body').on('click',  '.notificationStatusCheck', function(){
				var module_name = $(this).attr('data-module');
				console.log(module_name);
				if(this.checked){
				var status = 'yes';
				}
				else{
				var	status = 'no';
				}
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
                $.ajax({
                    type: "POST",
                    url: "{{ route('notification.status.change') }}",
                    data: {
                        module_name			:module_name,
                        status				:status,

                    },
                    success: function (response) {
						$('#successMessage').html(response);
						$('.toast.toast--success').toast('show');
                    },
                });

			});

			// $('#input_type').change(function(){
			// 	if($(this).val() == 'radio' || $(this).val() == 'checkbox' || $(this).val() == 'select'){
			// 		$('#optional_options').removeClass('d-none');
			// 	}else{
			// 		$('#optional_options').addClass('d-none');
			// 	}
			// });
			$('#travaux').change(function(){
				var data = $(this).val();
				if(data){
					$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});
					$.ajax({
						type: "POST",
						url: "{{ route('question.input') }}",
						data: {
							data	:data,

						},
						success: function (response) {
							$('#question_inputs').html(response.inputs);
							$('#questions_input_modal').html(response.modal);

						},
					});
				}
			});
			$('#status_type').change(function(){
				var data = $(this).val();
				if(data){
					$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});
					$.ajax({
						type: "POST",
						url: "{{ route('all.status') }}",
						data: {
							data	:data,

						},
						success: function (response) {
							$('#all_status').html(response);
						},
					});
				}
			});
			$('.areaColorChange').change(function(){
				var data = $(this).val();
				var area_id = $(this).attr('data-id');

				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
					type: "POST",
					url: "{{ route('area.color.update') }}",
					data: {
						id      : area_id,
						color	:data,
					},
					success: function (response) {
						console.log(response);
					},
				});
			});
			$('body').on('click', '.status_delete_btn', function(){
				var id = $(this).attr('data-id');
				var data = $(this).attr('data-type');
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
                $.ajax({
                    type: "POST",
                    url: "{{ route('all.status.delete') }}",
                    data: {
                        id			:id,
                        data	 	:data,
                    },
                    success: function (response) {
						$('#all_status').html(response.data);
						$('#successMessage').html(response.alert);
						$('.toast.toast--success').toast('show');
                    },
                });
			})

			$('#regie_form_submit').click(function(){
				var regie = $('#regie_name').val();
				var responsable_commercial = $('#responsable_commercial').val();
				if(regie == ''){
					$('#errorMessage').html("{{ __('Please Enter Regie Name') }}");
					$('.toast.toast--error').toast('show');
					$('#regie_name').focus();
				}
				else if(responsable_commercial == null){
					$('#errorMessage').html("{{ __('Please Select Responsable Commercial') }}");
					$('.toast.toast--error').toast('show');
					$('#responsable_commercial').focus();
				}
				else{
					$("#generalInfoFormRegie").submit();
				}
			});

			$('body').on('click', '.regie_edit_button', function(){
				// var id = $(this).attr('data-id');
				// var regie = $(this).attr('data-name');
				// var team_leader = $(this).attr('data-team_leader');

				$('#regie_form_submit').html("{{ __('Update') }}");
				$('#regie_name').val($(this).attr('data-name'));
				$('#regie_id').val($(this).attr('data-id'));
				$('#responsable_commercial').val($(this).attr('data-responsable_commercial'));
				$('#responsable_commercial').select2();
				$('#regie_name').focus();
				// $.ajaxSetup({
				// 	headers: {
				// 		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				// 	}
				// });
                // $.ajax({
                //     type: "POST",
                //     url: "{{ route('regie.user.list') }}",
                //     data: {
                //         team_leader	 	:team_leader,
                //     },
                //     success: function (response) {
				// 		console.log(response);
				// 		$('#regie_form_submit').html("{{ __('Update') }}");
				// 		$('#regie_name').val(regie);
				// 		$('#team_leader').html(response);
				// 		$('#regie_id').val(id);
				// 		$('#regie_name').focus();
                //     },
                // });

			});

			$('#question_submit_btn').click(function(){
				var travaux = $('#travaux').val();
				if(travaux == ''){
					$('#errorMessage').html("{{ __('Please Select Travaux') }}");
					$('.toast.toast--error').toast('show');
					$('#travaux').focus();
				}
				else{
					$('.question_title').each(function(){
						if($(this).val() == ''){
							$('#errorMessage').html("{{ __('Please Enter Question') }}");
							$('.toast.toast--error').toast('show');
							$(this).focus();
							exit();
						}
					});
					$("#generalInfoForm3").submit();
				}
			});

			$('body').on('click', '.question_input_delete_btn', function(){
				var id = $(this).attr('data-id');
				var data = $(this).attr('data-travaux');
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
                $.ajax({
                    type: "POST",
                    url: "{{ route('question.input.delete') }}",
                    data: {
                        id			:id,
                        data	 	:data,
                    },
                    success: function (response) {
						$('#question_inputs').html(response.data);
						$('#successMessage').html(response.alert);
						$('.toast.toast--success').toast('show');
                    },
                });
			});

			$('#add_more_question_btn').click(function(){
				var string = Math.random().toString(10).substring(2,12);
				var data = `<div id="remove`+string+`">
								<div class="form-group">
									<div class="d-flex align-items-center justify-content-between">
										<label class="form-label" for="label_title`+string+`">{{ __('Question') }} <span class="text-danger">*</span></label>
										<button type="button" class="remove-btn d-inline-flex align-items-center justify-content-center button mb-1 remove_question_block" data-id="`+string+`">×</button>
									</div>
									<input type="text" name="label_title[]" id="label_title`+string+`" class="form-control shadow-none question_title">
								</div>
								<div class="form-group">
									<label class="form-label" for="input_type`+string+`">{{ __('Select Input Type') }} <span class="text-danger">*</span></label>
									<select name="input_type[]" id="input_type`+string+`"  class="select2_select_option custom-select shadow-none form-control">
										<option value="text">{{ __('Text') }}</option>
										<option value="number">{{ __('Number') }}</option>
										<option value="email">{{ __('Email') }}</option>
										<option value="radio">{{ __('Radio') }}</option>
										<option value="checkbox">{{ __('Checkbox') }}</option>
										<option value="select">{{ __('Dropdown') }}</option>
										<option value="textarea">{{ __('Textarea') }}</option>
									</select>
								</div>
								<div class="form-group">
									<label class="form-label">{{ __('Required/Optional') }} <span class="text-danger">*</span></label>
									<select name="required_optional[]" class="select2_select_option custom-select shadow-none form-control">
										<option value="no">{{ __('Optional') }}</option>
										<option value="yes">{{ __('Required') }}</option>
									</select>
								</div>
								<div class="form-group" id="optional_options">
									<label class="form-label">{{ __('Options') }}</label>
									<textarea name="options[]"class="form-control shadow-none" placeholder="{{ __('Enter Options. Each option seperate with comma ,') }}"></textarea>
								</div>
								<div class="form-group">
									<label class="form-label">{{ __('Order') }}</label>
									<input type="number" name="order[]" class="form-control shadow-none">
								</div>
							</div>`;
				$('#addMoreQuestion').append(data);
			});

			$('#add_more_prestation_btn').click(function (){
				var data = `<div class="gruop_item" style="display: none">
								<div class="form-group">
									<div class="d-flex align-items-center justify-content-between">
										<label class="form-label" for="prestation_id"> Prestation : <span class="text-danger">*</span></label>
										<button type="button" class="remove-btn d-inline-flex align-items-center justify-content-center button mb-1 remove_prestation_block">×</button>
									</div>
									<select name="prestation_id[]" id="prestation_id"  class="select2_select_option custom-select shadow-none form-control prestationChange" required>
										@foreach ($benefits as $prestation)
											<option  data-price="{{ $prestation->price }}" data-quantity="{{ $prestation->quantity }}" data-tax="{{ $prestation->tax }}" value="{{ $prestation->id }}">{{ $prestation->alias }}</option>
										@endforeach
									</select>
									<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
								</div>
								<div class="form-group">
									<label class="form-label" for="prestation_price">Prix de vente<span class="text-danger">*</span></label>
									<input type="number" step="any" id="prestation_price" name="price[]" class="form-control shadow-none rounded prestation_price" required>
									<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
								</div>
								<div class="form-group">
									<label class="form-label" for="prestation_quantity">Quantité<span class="text-danger">*</span></label>
									<input type="number" id="prestation_quantity" name="quantity[]" class="form-control shadow-none rounded prestation_quantity" required>
									<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
								</div>
								<div class="form-group">
									<label class="form-label" for="prestation_tax">Taux TVA</label>
									<select id="prestation_tax" name="tax[]"class="select2_select_option form-control select2-hidden-accessible rounded prestation_tax">
										<option value="0">Non spécifiée</option>
										<option value="5.5">Taux réduit à 5,5 %</option>
										<option value="20">Taux normal à 20 %</option>
									</select>
									<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
								</div>
							</div>`;
				$('#prestationGroupItem').append(data);
				$('body .gruop_item').slideDown();
				$('.select2_select_option').select2();
			});

			$(document).on('click', '.remove_prestation_block', function(){
				$(this).closest('.gruop_item').slideUp('normal', function() {
					$(this).remove();
				});
			});
			$(document).on('change', '.prestationChange', function(){
				let price 		= $(this).find(':selected').data('price');
				let quantity 	= $(this).find(':selected').data('quantity');
				let tax 		= $(this).find(':selected').data('tax');

				$(this).closest('.gruop_item').find('.prestation_price').val(price);
				$(this).closest('.gruop_item').find('.prestation_quantity').val(price);
				$(this).closest('.gruop_item').find('.prestation_tax').val(tax).trigger('change');

			});

		});

		$('body').on('click', '.remove_question_block', function(){
			var id = $(this).attr('data-id');
			$('#remove'+id).remove();
		});
		$('body').on('click', '#titleDisabled', function(){
			if($(this).is(':checked')){
				$('#title').prop('disabled', true);
			}else{
				$('#title').prop('disabled', false);
			}
		});
		$('body').on('click', '.titleDisabled', function(){
			let id = $(this).attr('data-id');
			if($(this).is(':checked')){
				$('#title'+id).prop('disabled', true);
			}else{
				$('#title'+id).prop('disabled', false);
			}
		});
		$('body').on('click', '#designationDisabled', function(){
			if($(this).is(':checked')){
				$('#designation').prop('disabled', true);
			}else{
				$('#designation').prop('disabled', false);
			}
		});

		$('body').on('click', '.designationDisabled', function(){
			let id = $(this).attr('data-id');
			if($(this).is(':checked')){
				$('#designation'+id).prop('disabled', true);
			}else{
				$('#designation'+id).prop('disabled', false);
			}
		});

		$('body').on('click', '#priceDesabled', function(){
			if($(this).is(':checked')){
				$('#tax').prop('disabled', true);
				$('#price').prop('disabled', true);
			}else{
				$('#tax').prop('disabled', false);
				$('#price').prop('disabled', false);
			}
		});

		$('body').on('click', '.priceDesabled', function(){
			let id = $(this).attr('data-id');
			if($(this).is(':checked')){
				$('#tax'+id).prop('disabled', true);
				$('#price'+id).prop('disabled', true);
			}else{
				$('#tax'+id).prop('disabled', false);
				$('#price'+id).prop('disabled', false);
			}
		});
		$('body').on('click', '.position_increase', function(){
			let id = $(this).attr('data-id');
			let value = parseInt($("#position"+id).val());
			$("#position"+id).val(value+1);

		});
		$('body').on('click', '.position_decrease', function(){
			let id = $(this).attr('data-id');
			let value = parseInt($("#position"+id).val());
			if(value <= 0){
				return false;
			}else{
				$("#position"+id).val(value-1);
			}

		});


		/* Uploade and change image functions */
		let imgInp = document.querySelector("#setting-form__user-avatarInput");
		let blah = document.querySelector(".setting-form__user-avatar__image");
		imgInp.onchange = evt => {
			const [file] = imgInp.files
			if (file) {
				blah.src = URL.createObjectURL(file)
			}
		}

		$(document).ready(function(){
			if(window.matchMedia("(min-width: 992px)").matches){
				$(".nav-pills .nav-link").on("click", function(){
					$(window).scrollTop(0);
				});
			}else{
				$(".nav-pills .nav-link").on("click", function(){
					$(window).scrollTop($('body').get(0).scrollHeight);
				});
			}

			$(".nav-pills .nav-link").on('click', function () {
				$(this).closest(".parent-nav-pills").find(".nav-link.active").removeClass("active");
				$(this).closest(".parent-nav-pills").find(".nav-link.active").attr("aria-selected", false);
			})

			$(".classHere").select2({
    			placeholder: "Select a state",
			});
		})
	</script>
@endpush
