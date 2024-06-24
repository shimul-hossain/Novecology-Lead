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
							{{-- @foreach (checkMenuAccess() as $key =>$menu)
								@if(role() == 's_admin')
									@if ($menu->route == 'role.index' || $menu->route == 'superadmin.dashboard')
										<a class="profile-nav-link-header nav-link" @if ($menu->route == 'superadmin.dashboard')
											target="_blank"
										@endif  href="{{ route($menu->route) }}" aria-selected="false">
											<span class="{{ ($menu->route == 'role.index') ? 'novecologie-icon-user-plus' : 'novecologie-icon-settings' }} mr-2"></span>
											{{ $menu->name }}
										</a>
									@endif
								@else
									@if ($menu->getNavigation->route == 'role.index' || $menu->getNavigation->route == 'superadmin.dashboard')
										<a class="profile-nav-link-header nav-link" @if ($menu->getNavigation->route == 'superadmin.dashboard')
											target="_blank"
										@endif  href="{{ route($menu->getNavigation->route) }}" aria-selected="false">
											<span class="{{ ($menu->getNavigation->route == 'role.index') ? 'novecologie-icon-user-plus' : 'novecologie-icon-settings' }} mr-2"></span>
											{{ $menu->getNavigation->name }}
										</a>
									@endif
								@endif
								
							@endforeach --}}

							@if (\App\Models\CRM\Permission::where('user_id', Auth::id())->where('name', 'superadmin.dashboard')->exists() || role() == 's_admin')
								<a class="profile-nav-link-header nav-link " target="_blank" href="{{ route('backoffice.dashboard') }}">
									<span class="novecologie-icon-users mr-2"></span>
									Backend du site Web
								</a> 
                            @endif
							@if (\App\Models\CRM\Permission::where('user_id', Auth::id())->where('name', 'role.index')->exists() || role() == 's_admin')
								<a class="profile-nav-link-header nav-link " href="{{ route('role.index') }}">
									<span class="novecologie-icon-users mr-2"></span>
									Rôle
								</a> 
                            @endif
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
							<button type="button" class="profile-nav-header mb-1" data-toggle="collapse" data-target="#generalSettingsCollapse" aria-expanded="@yield('ParamètresCollapseActive')">
								<i class="bi bi-folder nav-link__icon mr-2"></i>
								<span class="nav-link__text">Paramètres généraux</span>
							</button>
							<div id="generalSettingsCollapse" class="collapse @yield('ParamètresCollapse')">
								<div class="nav flex-column nav-pills p-0" role="tablist" aria-orientation="vertical">
									@if (checkAction(Auth::id(), 'general__setting', 'regie') || role() == 's_admin')
										<a class="nav-link @yield('RegieTabActive')" id="v-pills-regie-tab" href="{{ route('settings.regie') }}">
											<i class="bi bi-person-rolodex mr-2"></i>
											{{ __('Regie') }}
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'question') || role() == 's_admin')
										<a class="nav-link @yield('PrescriptionTabActive')" id="v-pills-3-tab" href="{{ route('settings.prescription.chantier') }}">
											<span class="novecologie-icon-bell mr-2"></span>
											Prescription chantier
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'controle_des_documents') || role() == 's_admin')
										<a class="nav-link @yield('ContrôleTabActive')" id="v-pills-documentControl-tab" href="{{ route('settings.controle.des.documents') }}">
											<i class="bi bi-dpad mr-2"></i>
											Contrôle des Documents
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'banque') || role() == 's_admin')
										<a class="nav-link @yield('BanqueTabActive')" id="v-pills-banque-tab" href="{{ route('settings.banque') }}">
											<i class="bi bi-bank mr-2"></i>
											Banque
										</a>
									@endif  
									@if (checkAction(Auth::id(), 'general__setting', 'status_audit') || role() == 's_admin')
										<a class="nav-link @yield('StatutAuditTabActive')" id="v-pills-status_audit-tab" href="{{ route('settings.statut.audit') }}">
											<i class="bi bi-distribute-horizontal mr-2"></i>
											Statut audit
										</a>
									@endif


									@if (checkAction(Auth::id(), 'general__setting', 'resultat_du_rapport') || role() == 's_admin')
										<a class="nav-link @yield('RésultatRapportAuditTabActive')" id="v-pills-report_result-tab" href="{{ route('settings.resultat.rapport.audit') }}">
											<i class="bi bi-balloon mr-2"></i>
											Résultat du rapport audit
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'commercial_terrain') || role() == 's_admin')
										<a class="nav-link @yield('CommercialTerrainTabActive')" id="v-pills-commercial-tab" href="{{ route('settings.commercial.terrain') }}">
											<i class="bi bi-motherboard mr-2"></i>
											Commercial Terrain
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'bureaux_de_controle') || role() == 's_admin')
										<a class="nav-link @yield('BureauContrôleTabActive')" id="v-pills-13-tab" href="{{ route('settings.bureau.contrôle') }}">
											<i class="bi bi-lamp mr-2"></i>
											Bureau de contrôle
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'status_du_probleme_ticket') || role() == 's_admin')
										<a class="nav-link @yield('TypeProblèmeTabActive')" id="v-pills-ticket_problem_status-tab" href="{{ route('settings.type.probldme') }}">
											<i class="bi bi-flower3 mr-2"></i>
											Type de problème
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'type_energie_chaud') || role() == 's_admin')
										<a class="nav-link @yield('TypeEnergieChaudTabActive')" id="v-pills-energy_type-tab" href="{{ route('settings.type.energie.chaud') }}">
											<i class="bi bi-easel mr-2"></i>
											Type énergie Chaud.
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'prestations_group') || role() == 's_admin')
										<a class="nav-link @yield('PrestationsGoupTabActive')" id="v-pills-prestation_group-tab" href="{{ route('settings.prestations.group') }}">
											<i class="bi bi-dropbox mr-2"></i>
											{{ __('Prestations group') }}
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'comment_category') || role() == 's_admin')
										<a class="nav-link @yield('CommentCategoryTabActive')" id="v-pills-comment_category-tab" href="{{ route('settings.comment.category') }}">
											<i class="bi bi-chat mr-2"></i>
											{{ __('Comment Category') }}
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'quality_control') || role() == 's_admin')
									<a class="nav-link @yield('ContrôleQualitéTabActive')" id="v-pills-quality_control-tab" href="{{ route('settings.controle.qualite') }}">
										<i class="bi bi-alt mr-2"></i>
										Contrôle Qualité
									</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'notion_category') || role() == 's_admin')
									<a class="nav-link @yield('NotionCatégorieTabActive')" id="v-pills-notion_category-tab" href="{{ route('settings.notion.categorie') }}">
										<i class="bi bi-clipboard-data mr-2"></i>
										Notion Catégorie
									</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'notion_sub_category') || role() == 's_admin')
									<a class="nav-link @yield('NotionSousCatégorieTabActive')" id="v-pills-notion_sub_category-tab" href="{{ route('settings.notion.sous.categorie') }}">
										<i class="bi bi-hypnotize mr-2"></i>
										Notion Sous Catégorie
									</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'lead_sub_status') || role() == 's_admin')
										<a class="nav-link @yield('SousStatutProspectTabActive')" id="v-pills-lead_sub_status-tab" href="{{ route('settings.sous.statut.prospect') }}">
											<i class="bi bi-award-fill mr-2"></i>
											Sous statut prospect
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'heating_mode') || role() == 's_admin')
										<a class="nav-link @yield('ModeChauffageTabActive')" id="v-pills-heating_mode-tab" href="{{ route('settings.mode.de.chauffage') }}">
											<i class="bi bi-border-right mr-2"></i>
											Mode de chauffage
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'campagne_type') || role() == 's_admin')
										<a class="nav-link @yield('TypeCampagneTabActive')" id="v-pills-campagne_type-tab" href="{{ route('settings.type.de.campagne') }}">
											<i class="bi bi-bar-chart-steps mr-2"></i>
											Type de campagne
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'project_sub_status') || role() == 's_admin')
										<a class="nav-link @yield('SousStatutChantierTabActive')" id="v-pills-project_sub_status-tab" href="{{ route('settings.sous.statut.chantier') }}">
											<i class="bi bi-bicycle  mr-2"></i>
											Sous statut chantier
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'status_planning_intervention') || role() == 's_admin')
										<a class="nav-link @yield('StatutPlanningInterventionTabActive')" id="v-pills-status_planning_intervention-tab" href="{{ route('settings.statut.planning.intervention') }}">
											<i class="bi bi-book mr-2"></i>
											Statut planning intervention
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'project_ko_reason') || role() == 's_admin')
										<a class="nav-link @yield('ChantiersKORaisonsTabActive')" id="v-pills-project_ko_reason-tab" href="{{ route('settings.chantiers.ko.raisons') }}">
											<i class="bi bi-basket3 mr-2"></i>
											Chantiers KO - Raisons
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'project_reflection_reason') || role() == 's_admin')
										<a class="nav-link @yield('ChantiersReflexionRaisonsTabActive')" id="v-pills-project_reflection_reason-tab" href="{{ route('settings.chantiers.reflexion.raisons') }}">
											<i class="bi bi-border-style mr-2"></i>
											Chantiers Reflexion - Raisons
										</a>
									@endif

									@if (checkAction(Auth::id(), 'general__setting', 'project_control_photo') || role() == 's_admin')
										<a class="nav-link @yield('ContrôleConformitéPhotoChantierTabActive')" id="v-pills-project_control_photo-tab" href="{{ route('settings.controle.conformite.photo.chantier') }}">
											<i class="bi bi-circle-square mr-2"></i>
											Contrôle conformité photo chantier
										</a>
									@endif

									@if (checkAction(Auth::id(), 'general__setting', 'statut_maprimerenov') || role() == 's_admin')
										<a class="nav-link @yield('StatutMaPrimeRénovTabActive')" id="v-pills-statut_maprimerenov-tab" href="{{ route('settings.statut.maprimerenov') }}">
											<i class="bi bi-hdd mr-2"></i>
											Statut MaPrimeRénov
										</a>
									@endif

									@if (checkAction(Auth::id(), 'general__setting', 'mandataire_anah') || role() == 's_admin')
										<a class="nav-link @yield('MandataireANAHTabActive')" id="v-pills-10-tab" href="{{ route('settings.mandataire.anah') }}">
											<i class="bi bi-journal-code mr-2"></i>
											Mandataire ANAH
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'installateurs_rge') || role() == 's_admin')
										<a class="nav-link @yield('EntrepriseTravauxTabActive')" id="v-pills-8-tab" href="{{ route('settings.entreprise.de.travaux') }}">
											<i class="bi bi-layers mr-2"></i>
											Entreprise de travaux
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'reject_reason') || role() == 's_admin')
										<a class="nav-link @yield('MotifRejetTabActive')" id="v-pills-reject_reason-tab" href="{{ route('settings.motif.rejet') }}">
											<i class="bi bi-battery mr-2"></i>
											Motif rejet
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'user_color') || role() == 's_admin')
										<a class="nav-link @yield('ParamètresCouleurUtilisateurTabActive')" id="v-pills-color_user-tab" href="{{ route('settings.parametres.de.couleur.utilisateur') }}">
											<i class="bi bi-rainbow mr-2"></i>
											Paramètres de couleur utilisateur
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'type_fournisseur') || role() == 's_admin')
										<a class="nav-link @yield('TypeFournisseurTabActive')" id="v-pills-type_fournisseur-tab" href="{{ route('settings.type.de.fournisseur') }}">
											<i class="bi bi-badge-vo mr-2"></i>
											Type de fournisseur
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'technical_referee') || role() == 's_admin')
										<a class="nav-link @yield('RéfèrentTechniqueTabActive')" id="v-pills-technical_referee-tab" href="{{ route('settings.referent.technique') }}">
											<i class="bi bi-alt mr-2"></i>
											Réfèrent technique
										</a>
									@endif
								</div>
							</div>

							<button type="button" class="profile-nav-header mb-1" data-toggle="collapse" data-target="#ceeCollapse" aria-expanded="@yield('OperationsCEECollapseActive')">
								<i class="bi bi-folder nav-link__icon mr-2"></i>
								<span class="nav-link__text">Opérations CEE</span>
							</button>
							<div id="ceeCollapse" class="collapse @yield('OperationsCEECollapse')">
								<div class="nav flex-column nav-pills p-0" role="tablist" aria-orientation="vertical">
									@if (checkAction(Auth::id(), 'general__setting', 'baremes') || role() == 's_admin')
										<a class="nav-link @yield('BarèmesTabActive')" id="v-pills-5-tab" href="{{ route('settings.baremes.travaux.tag') }}">
											<span class="novecologie-icon-star mr-2"></span>
											Barèmes/Travaux/Tag
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'delegataires') || role() == 's_admin')
										<a class="nav-link @yield('DélégatairesTabActive')" id="v-pills-6-tab" href="{{ route('settings.delegataire') }}">
											<i class="bi bi-optical-audio mr-2"></i>
											{{ __('Délégataires') }}
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'deals_tarifs') || role() == 's_admin')
										<a class="nav-link @yield('DealsTabActive')" id="v-pills-7-tab" href="{{ route('settings.deals.tarifs') }}">
											<i class="bi bi-peace mr-2"></i>
											{{ __('Deals / Tarifs') }}
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'amo') || role() == 's_admin')
										<a class="nav-link @yield('AMOTabActive')" id="v-pills-9-tab" href="{{ route('settings.amo') }}">
											<i class="bi bi-mailbox mr-2"></i>
											{{ __('AMO') }}
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'auditeur_energetique') || role() == 's_admin')
										<a class="nav-link @yield('AuditeurTabActive')" id="v-pills-11-tab" href="{{ route('settings.auditeur.energetique') }}">
											<i class="bi bi-hdd-rack mr-2"></i>
											{{ __('Auditeur énergétique') }}
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'zones_d_intervention') || role() == 's_admin')
										<a class="nav-link @yield('ZonesTabActive')" id="v-pills-12-tab" href="{{ route('settings.zones.intervention') }}">
											<i class="bi bi-diamond mr-2"></i>
											Zones d'intervention
										</a>
									@endif
								</div>
							</div>
							<button type="button" class="profile-nav-header mb-1" data-toggle="collapse" data-target="#catalogueCollapse" aria-expanded="@yield('CatalogueCollapseActive')">
								<i class="bi bi-folder nav-link__icon mr-2"></i>
								<span class="nav-link__text">Catalogue</span>
							</button>
							<div id="catalogueCollapse" class="collapse @yield('CatalogueCollapse')">
								<div class="nav flex-column nav-pills p-0" role="tablist" aria-orientation="vertical">
									@if (checkAction(Auth::id(), 'general__setting', 'marques') || role() == 's_admin')
										<a class="nav-link @yield('MarquesTabActive')" id="v-pills-14-tab" href="{{ route('settings.marque') }}">
											<i class="bi bi-nut mr-2"></i>
											{{ __('Marques') }}
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'prestations') || role() == 's_admin')
										<a class="nav-link @yield('PrestationsTabActive')" id="v-pills-15-tab" href="{{ route('settings.prestation') }}">
											<i class="bi bi-puzzle mr-2"></i>
											{{ __('Prestations') }}
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'fournisseurs') || role() == 's_admin')
										<a class="nav-link @yield('FournisseursTabActive')" id="v-pills-16-tab"  href="{{ route('settings.fournisseur') }}">
											<i class="bi bi-snow  mr-2"></i>
											{{ __('Fournisseurs') }}
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'societe_client') || role() == 's_admin')
										<a class="nav-link @yield('SocietéClientTabActive')" id="v-pills-17-tab" href="{{ route('settings.societe.client') }}">
											<i class="bi bi-building mr-2"></i>
											{{ __('Societé client') }}
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'produits') || role() == 's_admin')
										<a class="nav-link @yield('ProduitsTabActive')" id="v-pills-18-tab" href="{{ route('settings.product') }}">
											<i class="bi bi-file-earmark-text"></i>
											{{ __('Produits') }}
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'produits_categorie') || role() == 's_admin')
										<a class="nav-link @yield('ProduitsCatégorieTabActive')" id="v-pills-19-tab" href="{{ route('settings.produits.categorie') }}">
											<i class="bi bi-card-list"></i>
											{{ __('Produits Catégorie') }}
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'produits_sous_categorie') || role() == 's_admin')
										<a class="nav-link @yield('ProduitsSousCatégorieTabActive')" id="v-pills-20-tab" href="{{ route('settings.produits.sous.categorie') }}">
											<i class="bi bi-clipboard-minus"></i>
											{{ __('Produits Sous-Catégorie') }}
										</a>
									@endif
									@if (role() == 's_admin')
										<a class="nav-link @yield('BARTH164TabActive')" id="v-pills-BAR_TH_164-tab" href="{{ route('settings.barth') }}">
											<i class="bi bi-fullscreen-exit"></i>
											BAR TH 164
										</a>
									@endif
									@if (role() == 's_admin')
										<a class="nav-link @yield('CalculetteCumacActive')" id="v-pills-BAR_TH_164-tab" href="{{ route('settings.cumac') }}">
											<i class="bi bi-bug-fill"></i>
											Calculette Cumac
										</a>
									@endif
                                    @if (role() == 's_admin')
										<a class="nav-link @yield('RenoTabActive')" id="v-pills-reno-tab" href="{{ route('settings.reno') }}">
											<i class="bi bi-body-text"></i>
											Reno Ampleur
										</a>
									@endif
								</div>
							</div>
							<button type="button" class="profile-nav-header mb-1" data-toggle="collapse" data-target="#stockCollapse" aria-expanded="@yield('stockCollapseActive')">
								<i class="bi bi-folder nav-link__icon mr-2"></i>
								<span class="nav-link__text">Stock</span>
							</button>
							<div id="stockCollapse" class="collapse @yield('stockCollapse')">
								<div class="nav flex-column nav-pills p-0" role="tablist" aria-orientation="vertical">
									@if (checkAction(Auth::id(), 'general__setting', 'nature_mouvement') || role() == 's_admin')
										<a class="nav-link @yield('natureMouvementTabActive')" id="v-pills-nature_mouvement-tab" href="{{ route('settings.nature.mouvement') }}">
											<i class="bi bi-bezier2 mr-2"></i>
											Nature mouvement
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'entrepot') || role() == 's_admin')
										<a class="nav-link @yield('entrepotTabActive')" id="v-pills-entrepot-tab" href="{{ route('settings.entrepot') }}">
											<i class="bi bi-asterisk mr-2"></i>
											Entrepôt
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'personnel_autorise_reception') || role() == 's_admin')
										<a class="nav-link @yield('personnelAutoriseReceptionTabActive')" id="v-pills-personnel_autorise_reception-tab" href="{{ route('settings.personnel.autorise.reception') }}">
											<i class="bi bi-border mr-2"></i>
											Personnel autorise réception
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'statut_commande') || role() == 's_admin')
										<a class="nav-link @yield('statutCommandeTabActive')" id="v-pills-statut_commande-tab" href="{{ route('settings.statut.commande') }}">
											<i class="bi bi-caret-down mr-2"></i>
											Statut Commande
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'fournisseur_materiel') || role() == 's_admin')
										<a class="nav-link @yield('fournisseurMaterielTabActive')" id="v-pills-fournisseur_materiel-tab" href="{{ route('settings.fournisseur.materiel') }}">
											<i class="bi bi-columns mr-2"></i>
											Fournisseur materiel
										</a>
									@endif
									@if (checkAction(Auth::id(), 'general__setting', 'type_de_livraison') || role() == 's_admin')
										<a class="nav-link @yield('typeDeLivraisonTabActive')" id="v-pills-type_de_livraison-tab" href="{{ route('settings.type.de.livraison') }}">
											<i class="bi bi-disc mr-2"></i>
											Type de livraison
										</a>
									@endif
								</div>
							</div>

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
												<label for="userName" class="form-label">Prenom  <span class="text-danger">*</span></label>
												<input type="text" name="name" id="userName" value="{{ $user->name }}" class="form-control shadow-none px-3">
												<input type="hidden" value="{{ $user->id }}" name="id">
												@error('name')
													<span class="text-danger alert">{{ $message }}**</span>
												@enderror
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="name" class="form-label">Nom</label>
												<input type="text" name="first_name" id="name" value="{{ $user->first_name }}" class="form-control shadow-none px-3">
												@error('first_name')
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
							 @yield('tab-content')
						</div>
					</div>
				</div>
			</div>
		</section> 

        @yield('modal-content')



@endsection

@push('js')
	<script>
		$(document).ready(function(){
			// $('.datatable').DataTable(); 
			$('body').on('change', '.rankChange', function(){
				let bareme_id = $(this).data('bareme-id');
				if($(this).val() == 1){
					$('#'+$(this).data('id')).slideDown();
					$('#bareme'+bareme_id).prop('required', true);
					$('#bareme_description'+bareme_id).prop('required', true);
				}else{
					$('#'+$(this).data('id')).slideUp();
					$('#bareme'+bareme_id).prop('required', false);
					$('#bareme_description'+bareme_id).prop('required', false);
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
            @if (\Request()->route()->getName() == 'profile.index')
                $('#v-pills-1-tab').addClass('active');
                $('#v-pills-1').addClass('show active');
                $('#v-pills-1-tab').attr('aria-selected', true);  
            @endif
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
			$('body').on('change', '#travaux', function(){
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

							$(".custom-editor-wrapper").each(function (index, element) {
								let quillEditor = new Quill(element.children[0], {
									modules: { 
										toolbar: [ 
													[{ color: [] }, { background: [] }], 
												]
									},
									theme: "snow"
								});
								quillEditor.on("text-change", function (delta, source) {
									$(element).find(".custom-editor-input").val(quillEditor.root.innerHTML);
								});
							});
							$('.ql-color .ql-picker-label').html(`<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000" height="20px" width="20px" version="1.1" id="Icons" viewBox="0 0 32 32" xml:space="preserve">
																	<g>
																		<path d="M29,27H3c-0.6,0-1,0.4-1,1s0.4,1,1,1h26c0.6,0,1-0.4,1-1S29.6,27,29,27z"/>
																		<path d="M5,24h4c0.6,0,1-0.4,1-1s-0.4-1-1-1H8.6l1.9-4h11.1l1.9,4H23c-0.6,0-1,0.4-1,1s0.4,1,1,1h4c0.6,0,1-0.4,1-1s-0.4-1-1-1   h-1.4L16.9,3.6C16.7,3.2,16.4,3,16,3s-0.7,0.2-0.9,0.6L6.4,22H5c-0.6,0-1,0.4-1,1S4.4,24,5,24z M16,6.3l4.6,9.7h-9.2L16,6.3z"/>
																	</g>
																	</svg>`);
							$('.ql-background .ql-picker-label').html(`<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000" width="20px" height="20px" viewBox="0 0 36 36" version="1.1" preserveAspectRatio="xMidYMid meet">
																	<title>highlighter-line</title>
																	<path d="M15.82,26.06a1,1,0,0,1-.71-.29L8.67,19.33a1,1,0,0,1-.29-.71,1,1,0,0,1,.29-.71L23,3.54a5.55,5.55,0,1,1,7.85,7.86L16.53,25.77A1,1,0,0,1,15.82,26.06Zm-5-7.44,5,5L29.48,10a3.54,3.54,0,0,0,0-5,3.63,3.63,0,0,0-5,0Z" class="clr-i-outline clr-i-outline-path-1"/><path d="M10.38,28.28A1,1,0,0,1,9.67,28L6.45,24.77a1,1,0,0,1-.22-1.09l2.22-5.44a1,1,0,0,1,1.63-.33l6.45,6.44A1,1,0,0,1,16.2,26l-5.44,2.22A1.33,1.33,0,0,1,10.38,28.28ZM8.33,23.82l2.29,2.28,3.43-1.4L9.74,20.39Z" class="clr-i-outline clr-i-outline-path-2"/><path d="M8.94,30h-5a1,1,0,0,1-.84-1.55l3.22-4.94a1,1,0,0,1,1.55-.16l3.21,3.22a1,1,0,0,1,.06,1.35L9.7,29.64A1,1,0,0,1,8.94,30ZM5.78,28H8.47L9,27.34l-1.7-1.7Z" class="clr-i-outline clr-i-outline-path-3"/><rect x="3.06" y="31" width="30" height="3" class="clr-i-outline clr-i-outline-path-4"/>
																	<rect x="0" y="0" width="36" height="36" fill-opacity="0"/>
																</svg>`);
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
			// if(window.matchMedia("(min-width: 992px)").matches){
			// 	$(".nav-pills .nav-link").on("click", function(){
			// 		$(window).scrollTop(0);
			// 	});
			// }else{
			// 	$(".nav-pills .nav-link").on("click", function(){
			// 		$(window).scrollTop($('body').get(0).scrollHeight);
			// 	});
			// }

			$(".nav-pills .nav-link").on('click', function () {
				$(this).closest(".parent-nav-pills").find(".nav-link.active").removeClass("active");
				$(this).closest(".parent-nav-pills").find(".nav-link.active").attr("aria-selected", false);
			})

			$(".classHere").select2({
    			placeholder: "Select a state",
			});
		})
	</script>
    @stack('scriptJs')
@endpush
