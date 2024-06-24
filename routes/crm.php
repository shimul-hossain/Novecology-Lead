<?php

use App\Http\Controllers\BaremeTravauxTagController;
use App\Http\Controllers\CampagnetypeController;
use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ClientSubStatusController;
use App\Http\Controllers\CommentCategoryController;
use App\Http\Controllers\CRM\AutomatisationController;
use App\Http\Controllers\CRM\ChartController;
use App\Http\Controllers\CRM\ClientController;
use App\Http\Controllers\CRM\CollapseRenderController;
use App\Http\Controllers\CRM\CompanyController;
use App\Http\Controllers\CRM\CrmHomeController;
use App\Http\Controllers\CRM\CrmSettingController;
use App\Http\Controllers\CRM\DocumentControlController;
use App\Http\Controllers\CRM\EventCategoryController;
use App\Http\Controllers\CRM\EventController;
use App\Http\Controllers\CRM\ExportController;
use App\Http\Controllers\CRM\FournisseurTypeController;
use App\Http\Controllers\CRM\LeadController;
use App\Http\Controllers\CRM\LeadSubStatusController;
use App\Http\Controllers\CRM\NewEventController;
use App\Http\Controllers\CRM\NewTaskController;
use App\Http\Controllers\CRM\NotionCategoryController;
use App\Http\Controllers\CRM\PaginationNumberController;
use App\Http\Controllers\CRM\ProfileController;
use App\Http\Controllers\CRM\ProjectController;
use App\Http\Controllers\CRM\QualityControlController;
use App\Http\Controllers\CRM\QuestionController;
use App\Http\Controllers\CRM\RejectReasonController;
use App\Http\Controllers\CRM\RoleController;
use App\Http\Controllers\CRM\ScraperController;
use App\Http\Controllers\CRM\StatusPlanningInterventionController;
use App\Http\Controllers\CRM\StockController;
use App\Http\Controllers\CRM\TabController;
use App\Http\Controllers\CRM\TaskController;
use App\Http\Controllers\CRM\TicketController;
use App\Http\Controllers\EntrepotController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\FournisseurMaterielController;
use App\Http\Controllers\HeatingModeController;
use App\Http\Controllers\LeadCustomFieldController;
use App\Http\Controllers\MandataireMaprimerenovController;
use App\Http\Controllers\NatureMouvementController;
use App\Http\Controllers\NotionController;
use App\Http\Controllers\NotionSubCategoryController;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\PersonalNoteController;
use App\Http\Controllers\PersonnelAutoriseReceptionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectControlPhotoController;
use App\Http\Controllers\ProjectDeadReasonController;
use App\Http\Controllers\ProjectReflectionReasonController;
use App\Http\Controllers\ProjectSubStatusController;
use App\Http\Controllers\RegieController;
use App\Http\Controllers\StatutCommandeController;
use App\Http\Controllers\StatutMaprimerenovController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\TravauxTagController;
use App\Http\Controllers\TypeDeLivraisonController;
use App\Models\CRM\Lead;
use App\Models\CRM\LeadClientProject;
use App\Models\CRM\NewClient;
use App\Models\CRM\NewProject;
use App\Models\CRM\Role;
use FontLib\Table\Type\name;
use GuzzleHttp\middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



//    CRM Routing part start


// Route::get('fiscal', [LeadController::class, 'fiscal'])->name('fiscal');
// Route::post('/check-zone', [LeadController::class, 'checkZone'])->name('check');

// Route::get('modal-parcel', function(){
//     return view('admin.modal_parcel');
// });


// Route::get('get-json/', function(){
//     $path = base_path('resources/lang/fr.json');
//     return response()->download( $path);
// });

// Route::get('demo-pdf', [CrmHomeController::class, 'demoPdf']);
Route::get('pixcel-lead2', [CrmHomeController::class, 'pixcelLead2']);
Route::get('pixcel-lead1', [CrmHomeController::class, 'pixcelLead1']);
Route::get('pixcel-lead', [CrmHomeController::class, 'pixcelLead']);
Route::get('facebook-webhook', [CrmHomeController::class, 'facebookWebhook']);
Route::get('pdf-test', [CrmHomeController::class, 'pdfTest']);
Route::get('template-test', [CrmHomeController::class, 'templateTest']);

Route::group(['prefix' => 'admin', 'middleware' => ['auth','admin']], function(){

    // Stock Controller 

    Route::get('stock', [StockController::class, 'index'])->name('stock.index');
    Route::get('stock/mouvements', [StockController::class, 'Mouvements'])->name('stock.mouvements');
    Route::get('stock/mouvement/filter', [StockController::class, 'mouvementFilter'])->name('stock.mouvement.filter');
    Route::get('stock/mouvement/{id}/details', [StockController::class, 'MouvementDetails'])->name('stock.mouvement.details');
    Route::get('stock/etat-des-stocks', [StockController::class, 'etatDesStocks'])->name('stock.etat.des.stocks');
    Route::get('stock/etat-des-stocks-filter', [StockController::class, 'etatDesStocksFilter'])->name('stock.etat.des.stocks.filter');
    Route::get('stock/commandes', [StockController::class, 'Commandes'])->name('stock.commandes');
    Route::get('stock/commandes/filter', [StockController::class, 'CommandesFilter'])->name('stock.commande.filter');
    Route::get('stock/commande/{id}/details', [StockController::class, 'commandeDetails'])->name('stock.commande.details');
    Route::post('stock/commande/status/change', [StockController::class, 'commandeStatusChange'])->name('stock.commande.status.change');
    Route::post('stock/commande/create', [StockController::class, 'commandeCreate'])->name('stock.commande.create');
    Route::post('stock/commande/update', [StockController::class, 'commandeUpdate'])->name('stock.commande.update');
    Route::post('stock/commande/delete', [StockController::class, 'commandeDelete'])->name('stock.commande.delete');
    Route::get('stock/installations', [StockController::class, 'installations'])->name('stock.installations');
    Route::get('stock/installations/filter', [StockController::class, 'installationsFilter'])->name('stock.installations.filter');
    Route::post('stock/installations/export', [StockController::class, 'installationsExport'])->name('stock.installations.export');
    Route::get('stock/installation/{id}/details', [StockController::class, 'installationDetails'])->name('stock.installation.details');
    Route::post('stock/installation/create', [StockController::class, 'installationCreate'])->name('stock.installation.create');
    Route::post('stock/installation/update', [StockController::class, 'installationUpdate'])->name('stock.installation.update');
    Route::post('stock/installation/delete', [StockController::class, 'installationDelete'])->name('stock.installation.delete');
    Route::post('stock/mouvement/header/filter', [StockController::class, 'mouvementHeaderFilter'])->name('stock.mouvement.header.filter');
    Route::get('stock/mouvement/{id}/pdf', [StockController::class, 'stockMouvementPdf'])->name('stock.mouvement.pdf');
    Route::get('stock/etat-des-stocks/{id}/details', [StockController::class,'etatDesStocksDetails'])->name('stock.etat.des.stocks.details');
    Route::post('stock/commande/header/filter', [StockController::class, 'commandeHeaderFilter'])->name('stock.commande.header.filter');
    Route::get('stock/commande/{id}/pdf', [StockController::class, 'stockCommandePdf'])->name('stock.commande.pdf');
    Route::post('stock/mouvement/create', [StockController::class, 'stockMouvementCreate'])->name('stock.mouvement.create');
    Route::post('stock/mouvement/update', [StockController::class, 'stockMouvementUpdate'])->name('stock.mouvement.update');
    Route::post("stock/mouvement/delete", [StockController::class, 'mouvementDelete'])->name('stock.mouvement.delete');
    Route::post('stock/log/delete', [StockController::class, 'logDelete'])->name('stock.log.delete');

    // Collapse render controller
    Route::post('lead/collapse/block', [CollapseRenderController::class, 'leadCollapseBlock'])->name('lead.collapse.block');
    Route::post('project/collapse/block', [CollapseRenderController::class, 'projectCollapseBlock'])->name('project.collapse.block');

    // CRM setting controller

    Route::get('settings/produits', [CrmSettingController::class, 'product'])->name('settings.product');
    Route::get('settings/marques', [CrmSettingController::class, 'marque'])->name('settings.marque');
    Route::get('settings/prestations', [CrmSettingController::class, 'prestation'])->name('settings.prestation');
    Route::get('settings/fournisseurs', [CrmSettingController::class, 'fournisseur'])->name('settings.fournisseur');
    Route::get('settings/societe-client', [CrmSettingController::class, 'societeClient'])->name('settings.societe.client');
    Route::get('settings/produits-categorie', [CrmSettingController::class, 'produitsCategorie'])->name('settings.produits.categorie');
    Route::get('settings/produits-sous-categorie', [CrmSettingController::class, 'produitsSousCategorie'])->name('settings.produits.sous.categorie');
    Route::get('settings/bar-th-164', [CrmSettingController::class, 'BARTH164'])->name('settings.barth');
    Route::get('settings/cumac', [CrmSettingController::class, 'calculetteCumac'])->name('settings.cumac');
    Route::post('cumac/price/update', [CrmSettingController::class, 'cumacPriceUpdate'])->name('cumac.price.update');
    Route::get('settings/reno-ampleur', [CrmSettingController::class, 'renoAmpleur'])->name('settings.reno');


    Route::get('settings/baremes-travaux-tag', [CrmSettingController::class, 'baremesTravauxTag'])->name('settings.baremes.travaux.tag');
    Route::get('settings/delegataires', [CrmSettingController::class, 'delegataire'])->name('settings.delegataire');
    Route::get('settings/deals-tarifs', [CrmSettingController::class, 'dealsTarif'])->name('settings.deals.tarifs');
    Route::get('settings/amo', [CrmSettingController::class, 'amo'])->name('settings.amo');
    Route::get('settings/auditeur-energetique', [CrmSettingController::class, 'auditeurEnergetique'])->name('settings.auditeur.energetique');
    Route::get('settings/zones-d-intervention', [CrmSettingController::class, 'zonesIntervention'])->name('settings.zones.intervention');


    Route::get('settings/regie', [CrmSettingController::class, 'regie'])->name('settings.regie');
    Route::get('settings/prescription-chantier', [CrmSettingController::class, 'prescriptionChantier'])->name('settings.prescription.chantier');
    Route::get('settings/controle-des-documents', [CrmSettingController::class, 'controleDesDocuments'])->name('settings.controle.des.documents');
    Route::get('settings/banque', [CrmSettingController::class, 'banque'])->name('settings.banque');
    Route::get('settings/statut-audit', [CrmSettingController::class, 'statutAudit'])->name('settings.statut.audit');
    Route::get('settings/resultat-du-rapport-audit', [CrmSettingController::class, 'resultatDuRapportAudit'])->name('settings.resultat.rapport.audit');
    Route::get('settings/commercial-terrain', [CrmSettingController::class, 'commercialTerrain'])->name('settings.commercial.terrain');
    Route::get('settings/bureau-de-contrôle', [CrmSettingController::class, 'bureauDeContrôle'])->name('settings.bureau.contrôle');
    Route::get('settings/type-de-probleme', [CrmSettingController::class, 'typeDeProblème'])->name('settings.type.probldme');
    Route::get('settings/type-energie-chaud', [CrmSettingController::class, 'typeEnergieChaud'])->name('settings.type.energie.chaud');
    Route::get('settings/prestations-group', [CrmSettingController::class, 'prestationsGroup'])->name('settings.prestations.group');
    Route::get('settings/comment-category', [CrmSettingController::class, 'commentCategory'])->name('settings.comment.category');
    Route::get('settings/controle-qualite', [CrmSettingController::class, 'controleQualite'])->name('settings.controle.qualite');
    Route::get('settings/notion-categorie', [CrmSettingController::class, 'notionCategorie'])->name('settings.notion.categorie');
    Route::get('settings/notion-sous-categorie', [CrmSettingController::class, 'notionSousCategorie'])->name('settings.notion.sous.categorie');
    Route::get('settings/sous-statut-prospect', [CrmSettingController::class, 'sousStatutProspect'])->name('settings.sous.statut.prospect');
    Route::get('settings/mode-de-chauffage', [CrmSettingController::class, 'modeDeChauffage'])->name('settings.mode.de.chauffage');
    Route::get('settings/type-de-campagne', [CrmSettingController::class, 'typeDeCampagne'])->name('settings.type.de.campagne');
    Route::get('settings/sous-statut-chantier', [CrmSettingController::class, 'sousStatutChantier'])->name('settings.sous.statut.chantier');
    Route::get('settings/statut-planning-intervention', [CrmSettingController::class, 'statutPlanningIntervention'])->name('settings.statut.planning.intervention');
    Route::get('settings/chantiers-ko-raisons', [CrmSettingController::class, 'chantiersRaisons'])->name('settings.chantiers.ko.raisons');
    Route::get('settings/chantiers-reflexion-raisons', [CrmSettingController::class, 'chantiersReflexionRaisons'])->name('settings.chantiers.reflexion.raisons');
    Route::get('settings/controle-conformite-photo-chantier', [CrmSettingController::class, 'controleConformitePhotoChantier'])->name('settings.controle.conformite.photo.chantier');
    Route::get('settings/statut-maprimerenov', [CrmSettingController::class, 'statutMaprimerenov'])->name('settings.statut.maprimerenov');
    Route::get('settings/mandataire-anah', [CrmSettingController::class, 'mandataireAnah'])->name('settings.mandataire.anah');
    Route::get('settings/entreprise-de-travaux', [CrmSettingController::class, 'entrepriseDeTravaux'])->name('settings.entreprise.de.travaux');
    Route::get('settings/motif-rejet', [CrmSettingController::class, 'motifRejet'])->name('settings.motif.rejet');
    Route::get('settings/parametres-de-couleur-utilisateur', [CrmSettingController::class, 'parametresDeCouleurUtilisateur'])->name('settings.parametres.de.couleur.utilisateur');
    Route::get('settings/type-de-fournisseur', [CrmSettingController::class, 'typeDeFournisseur'])->name('settings.type.de.fournisseur');
    Route::get('settings/referent-technique', [CrmSettingController::class, 'referentTechnique'])->name('settings.referent.technique');
    Route::post('parcel/cadastrale', [CrmHomeController::class, 'parcelCadastrale'])->name('parcel.cadastrale');
    
    Route::get('settings/nature-mouvement', [CrmSettingController::class, 'natureMouvement'])->name('settings.nature.mouvement');
    Route::get('settings/entrepot', [CrmSettingController::class, 'entrepot'])->name('settings.entrepot');
    Route::get('settings/personnel-autorise-reception', [CrmSettingController::class, 'personnelAutoriseReception'])->name('settings.personnel.autorise.reception');
    Route::get('settings/statut-commande', [CrmSettingController::class, 'statutCommande'])->name('settings.statut.commande');
    Route::get('settings/fournisseur-materiel', [CrmSettingController::class, 'fournisseurMateriel'])->name('settings.fournisseur.materiel');
    Route::get('settings/type_de_livraison', [CrmSettingController::class, 'typeDeLivraison'])->name('settings.type.de.livraison');


    // Email
    Route::get('store-emails', [SuperAdminController::class, 'storeEmails'])->name('store.emails');

    // New Event Controller
    Route::post('event-project-change', [NewEventController::class, 'eventProjectChange'])->name('event.project.change');
    Route::post('new-event-store', [NewEventController::class, 'store'])->name('new.event.store');

    // Automatisation Controller
    Route::get('automatisation/block/create', [AutomatisationController::class, 'blockCreate'])->name('automatisation.block.create');
    Route::get('automatisation/block/{id}/edit', [AutomatisationController::class, 'blockEdit'])->name('automatisation.block.edit');
    Route::post('automatisation/block/store', [AutomatisationController::class, 'blockStore'])->name('automatisation.block.store');
    Route::post('automatisation/block/update', [AutomatisationController::class, 'blockUpdate'])->name('automatisation.block.update');
    Route::post('automatisation/block/delete', [AutomatisationController::class, 'blockDelete'])->name('automatisation.block.delete');
    Route::post('automatisation/activate/block', [AutomatisationController::class, 'activateBlock'])->name('automatisation.activate.block');
    Route::get('automatisation', [AutomatisationController::class, 'index'])->name('automatisation.index')->middleware('checkRole');
    Route::post('automatisation/store', [AutomatisationController::class, 'store'])->name('automatisation.store');
    Route::post('automatisation/update', [AutomatisationController::class, 'update'])->name('automatisation.update');
    Route::post('automatisation/delete', [AutomatisationController::class, 'delete'])->name('automatisation.delete');
    Route::post('automatisation/bulk/delete', [AutomatisationController::class, 'bulkDelete'])->name('automatisation.bulk.delete');
    Route::post('automatisation/status/change', [AutomatisationController::class, 'statusChange'])->name('automatisation.status.change');


    // Export Controller
    Route::get('/export', [ExportController::class,'index'])->name('export.index')->middleware('checkRole');
    Route::post('/export', [ExportController::class, 'export'])->name('export');
    Route::get('/export/lite', [ExportController::class,'exportLite'])->name('export.lite')->middleware('checkRole');
    Route::post('/export/lite', [ExportController::class, 'exportLiteExport'])->name('export.lite.export');
    Route::post('export/category/change', [ExportController::class, 'categoryChange'])->name('export.category.change');
    Route::post('export/label/change', [ExportController::class, 'exportLabelChange'])->name('export.label.change');

    // Chat Controller
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index')->middleware('checkRole');

    // Product Controller
    Route::post('product-store', [ProductController::class, 'productStore'])->name('product.store');
    Route::post('product-update', [ProductController::class, 'productUpdate'])->name('product.update');
    Route::post('product-delete', [ProductController::class, 'productDelete'])->name('product.delete');
    Route::post('category-create', [ProductController::class, 'categoryCreate'])->name('category.create');
    Route::post('category-update', [ProductController::class, 'categoryUpdate'])->name('category.update');
    Route::post('category-delete', [ProductController::class, 'categoryDelete'])->name('category.delete');
    Route::post('sub-category-create', [ProductController::class, 'subCategoryCreate'])->name('sub.category.create');
    Route::post('sub-category-update', [ProductController::class, 'subCategoryUpdate'])->name('sub.category.update');
    Route::post('sub-category-delete', [ProductController::class, 'subCategoryDelete'])->name('sub.category.delete');
    Route::post('product-edit-modal', [ProductController::class, 'productEditModal'])->name('product.edit-modal');

    // Task Controller
    Route::get('/token-generate/{id}', [SuperAdminController::class, 'tokenGenerate']);
    Route::post('/add-task', [TaskController::class, 'addTask'])->name('add.task');
    Route::post('task-completed', [TaskController::class, 'taskCompleted'])->name('task.completed');
    Route::post('task-important', [TaskController::class, 'taskImportant'])->name('task.important');
    Route::post('/task-search', [TaskController::class, 'taskSearch'])->name('task.search');
    Route::post('/task-modal-update', [TaskController::class, 'taskModalUpdate'])->name('task.modal.update');
    Route::post('/update-task', [TaskController::class, 'updateTask'])->name('update.task');
    Route::post('/task-destroy', [TaskController::class, 'taskDestroy'])->name('task.destroy');
    Route::post('/priority-filter', [TaskController::class, 'priorityFilter'])->name('priority.filter');
    Route::post('tag-filter', [TaskController::class, 'tagFilter'])->name('tag.filter');
    Route::post('/task-restore', [TaskController::class, 'taskRestore'])->name('task.restore');
    Route::post('/task-confirm', [TaskController::class,  'taskConfirm'])->name('task.confirm');
    Route::post('/task-reassign', [TaskController::class, 'taskReassign'])->name('task.reassign');
    Route::post('task-tag-store', [TaskController::class, 'taskTagStore'])->name('task.tag.store');
    Route::post('/task-tag-delete', [TaskController::class, 'taskTagDelete'])->name('task.tag.delete');
    Route::get('/notification-view-todo/{id}', [TaskController::class, 'notificationViewTodo'])->name('notification.view.todo');

    // CRM Home Controller
    Route::get('/calendar', [CrmHomeController::class, 'Cadendar'])->name('calendar.index');
    Route::get('/calendar-weeks-view/{client_id?}/{week?}', [CrmHomeController::class, 'CadendarWeeksView'])->name('calendar.weeks');
    Route::get('/planning-map-view/{client_id?}', [CrmHomeController::class, 'planningMapView'])->name('planning.map');
    Route::get('calendar-week-filter', [CrmHomeController::class, 'calendarWeekFilter'])->name('calendar.week.filter');
    Route::get('calendar-map-filter', [CrmHomeController::class, 'calendarMapFilter'])->name('calendar.map.filter');
    Route::get('planning/{month?}', [CrmHomeController::class, 'planning'])->name('planning.index')->middleware('checkRole');
    Route::post('planning/filter', [CrmHomeController::class, 'planningFilter'])->name('planning.filter');
    Route::post('planning/intervention/change', [CrmHomeController::class, 'planningInterventionChange'])->name('planning.intervention.change');
    Route::post('planning/intervention/store', [CrmHomeController::class, 'planningInterventionStore'])->name('planning.intervention.store');
    Route::get('planning/menu/filter/{month?}', [CrmHomeController::class, 'planningMenuFilter'])->name('planning.menu.filter');
    Route::post('planning/filter/role/change', [CrmHomeController::class, 'planningFilterRoleChange'])->name('planning.filter.role.change');
    Route::post('planning/filter/role/change2', [CrmHomeController::class, 'planningFilterRoleChange2'])->name('planning.filter.role.change2');
    Route::post('planning/view/change', [CrmHomeController::class, 'planningViewChange'])->name('planning.view.change');
    Route::get('planning/week/view/{week?}', [CrmHomeController::class, 'planningWeeksView'])->name('planning.weeks.view');
    Route::get('planning/week/menu/filter/{week?}', [CrmHomeController::class, 'planningWeekMenuFilter'])->name('planning.week.menu.filter');
    // Route::get('planning/map/view', [CrmHomeController::class, 'planningMapViewNew'])->name('planning.map.view');
    // Route::get('planning/map/menu/filter', [CrmHomeController::class, 'planningMapMenuFilter'])->name('planning.map.menu.filter');
    Route::get('planning/map/view', [CrmHomeController::class, 'newPlanningMapViewNew'])->name('planning.map.view');
    Route::get('planning/map/menu/filter', [CrmHomeController::class, 'newPlanningMapMenuFilter'])->name('planning.map.menu.filter');
    Route::post('map/filter/tab/active', [CrmHomeController::class, 'mapFilterTabActive'])->name('map.filter.tab.active');
    Route::post('planning/custom/filter', [CrmHomeController::class, 'planningCustomFilter'])->name('planning.custom.filter');
    Route::post('planning/week/custom/filter', [CrmHomeController::class, 'planningWeekCustomFilter'])->name('planning.week.custom.filter');
    Route::get('email-body/{id}', [CrmHomeController::class, 'emailBody'])->name('email.body');
    Route::post('project/email/important', [CrmHomeController::class, 'projectEmailImportant'])->name('project.email.important');
    Route::post('admin/all/search', [CrmHomeController::class, 'allSearch'])->name('admin.all.search');
    Route::post('product/import', [CrmHomeController::class, 'productImport'])->name('product.import');
    Route::post('map/date/change', [CrmHomeController::class, 'mapDateChange'])->name('map.date.change');
    Route::post('map/date/change2', [CrmHomeController::class, 'mapDateChange2'])->name('map.date.change2');

    // Route::get('/all-leads', [CrmHomeController::class, 'allLeads'])->name('leads.all')->middleware('checkRole');
    Route::get('/all-leads/{status?}', [CrmHomeController::class, 'allLeadsNew'])->name('leads.all')->middleware('checkRole');
    // Route::get('/all-leads-new/{status?}', [CrmHomeController::class, 'allLeadsNewDesign'])->name('leads.all.new');
    // Route::get('/leads/edit/{company_id}/{lead_id}', [CrmHomeController::class, 'leadPage']);
    Route::get('/leads/{company_id}/{lead_id}', [CrmHomeController::class, 'LeadEdit'])->name('leads.index');
    Route::get('/company-leads/{id}', [CrmHomeController::class, 'companyLead'])->name('leads.company');
    Route::get('/notification/{notify_id}/{lead_id}', [CrmHomeController::class, 'notificationView'])->name('notification.view');
    Route::get('/notification-client/{notify_id}/{client_id}', [CrmHomeController::class, 'clientNotificationView'])->name('notification.view.client');
    Route::get('/notification-all', [CrmHomeController::class, 'allNotifications'])->name('notifications.index');
    Route::post('/notification-delete', [CrmHomeController::class, 'notificationDelete'])->name('notification.delete');
    Route::post('/notification-unread', [CrmHomeController::class, 'notificationUnread'])->name('notification.unread');
    Route::post('/notification-read', [CrmHomeController::class, 'notificationRead'])->name('notification.read');
    Route::post('notification-status-change', [CrmHomeController::class, 'notificationStatusChange'])->name('notification.status.change');
    Route::get('notifications.read.all', [CrmHomeController::class, 'notificationsReadAll'])->name('notifications.read.all');
    Route::post('user-header-filter', [CrmHomeController::class, 'userHeaderFilter'])->name('user.header.filter');
    Route::get('sav', [CrmHomeController::class, 'savIndex'])->name('sav.index')->middleware('checkRole');
    Route::post('sav-header-filter', [CrmHomeController::class, 'savHeaderFilter'])->name('sav.header.filter');
    Route::get('ringover', [CrmHomeController::class, 'ringoverIndex'])->name('ringover.index')->middleware('checkRole');
    Route::get('custom-test-generate', [CrmHomeController::class, 'customTestGenerate']);
    Route::get('/all-lead/filter/{status}', [CrmHomeController::class, 'leadAllFilter'])->name('lead.all.filter');
    Route::get('calculatte-depertidion', [CrmHomeController::class, 'calculatteDepertidion'])->name('calculatte.depertidion')->middleware('checkRole');
    Route::get('depertidion/pdf', [CrmHomeController::class, 'depertidionPdf'])->name('depertidion.pdf');
    Route::get('calculatte-barth', [CrmHomeController::class, 'calculatteBarth'])->name('calculatte.barth')->middleware('checkRole');
    Route::get('calculatte-reno', [CrmHomeController::class, 'calculatteReno'])->name('calculatte.reno');
    Route::post('user-color-update', [CrmHomeController::class, 'userColorUpdate'])->name('user.color.update');
    Route::post('barth-price-update', [CrmHomeController::class, 'barthPriceUpdate'])->name('barth.price.update');
    Route::post('reno-price-update', [CrmHomeController::class, 'renoPriceUpdate'])->name('reno.price.update');
    Route::get('email-templete', [CrmHomeController::class, 'emailTemplete'])->name('admin.email.templete')->middleware('checkRole');
    Route::post('email-templete-store', [CrmHomeController::class, 'emailTemplateStore'])->name('admin.email.template.store');
    Route::get('email-templete-edit/{id}', [CrmHomeController::class, 'emailTemplateEdit'])->name('admin.email.template.edit');
    Route::post('email-templete-update', [CrmHomeController::class, 'emailTemplateUpdate'])->name('admin.email.template.update');
    Route::get('email-templete-delete/{id}', [CrmHomeController::class, 'emailTemplateDelete'])->name('admin.email.template.delete');
    Route::get('sms-templete', [CrmHomeController::class, 'smsTemplete'])->name('admin.sms.templete')->middleware('checkRole');
    Route::post('sms-templete-store', [CrmHomeController::class, 'smsTemplateStore'])->name('admin.sms.template.store');
    Route::get('sms-templete-edit/{id}', [CrmHomeController::class, 'smsTemplateEdit'])->name('admin.sms.template.edit');
    Route::post('sms-templete-update', [CrmHomeController::class, 'smsTemplateUpdate'])->name('admin.sms.template.update');
    Route::get('sms-templete-delete/{id}', [CrmHomeController::class, 'smsTemplateDelete'])->name('admin.sms.template.delete');
    Route::get('calculatte-cumac', [CrmHomeController::class, 'calculatteCumac'])->name('calculatte.cumac')->middleware('checkRole');
    Route::post('cumac-project-change', [CrmHomeController::class, 'cumacProjectChange'])->name('cumac.project.change');
    Route::get('/magic/planning', [CrmHomeController::class, 'magicPlanning'])->name('magic.planning');

    Route::get('map', [CrmHomeController::class, 'mapPage'])->name('map.index')->middleware('checkRole');
    Route::get('map-filter', [CrmHomeController::class, 'mapFilter'])->name('map.filter');
    Route::get('todo', [CrmHomeController::class, 'todoPage'])->name('todo.index')->middleware('checkRole');
    Route::get('user-list', [CrmHomeController::class, 'userList'])->name('user.all');
    Route::post('user-status-change', [CrmHomeController::class, 'userStatusChange'])->name('user.status.change');
    Route::post('/update/user', [CrmHomeController::class, 'updateUser'])->name('update.user');
    Route::post('/all-user-search', [CrmHomeController::class, 'allUserSearch'])->name('all-user.search');
    Route::post('/user-delete', [CrmHomeController::class, 'userDelete'])->name('user.delete');
    Route::post('/user-bulk-delete', [CrmHomeController::class, 'userBulkDelete'])->name('user.bulk.delete');
    Route::get('my-files/edit/{id}', [CrmHomeController::class, 'myFiles']);
    Route::get('my-files/{id}', [CrmHomeController::class, 'projectEdit'])->name('files.index');
    Route::get('my-files-import/{id}', [CrmHomeController::class, 'projectImportEdit'])->name('files-import.index');
    Route::post('/status-add', [CrmHomeController::class, 'statusAdd'])->name('status.add');
    Route::post('all-status', [CrmHomeController::class, 'allStatus'])->name('all.status');
    Route::post('all-status-delete', [CrmHomeController::class, 'allStatusDelete'])->name('all.status.delete');
    Route::get('/leaderboard', [CrmHomeController::class, 'leaderboard'])->name('admin.leaderboard');
    Route::post('analytic/toggler/update', [CrmHomeController::class, 'analyticTogglerUpdate'])->name('analytic.toggler.update');
    Route::post('map/ticket/type/change', [CrmHomeController::class, 'mapTicketTypeChange'])->name('map.ticket.type.change');

    Route::get('/not-permitted', [CrmHomeController::class, 'notPermitted'])->name('permission.none');
    Route::get('/pannel-log', [CrmHomeController::class, 'pannelLog'])->name('pannel.log')->middleware('checkRole');
    Route::post('admin-pannel-log', [CrmHomeController::class, 'pannelLogData'])->name('admin.pannel.log');

    Route::post('map/category/change', [CrmHomeController::class, 'mapCategoryChange'])->name('map.category.change');
    Route::post('map/label/change', [CrmHomeController::class, 'mapLabelChange'])->name('map.label.change');

    Route::post('/user/bar_th_164_permission', [CrmHomeController::class, 'userBarTh164Permission'])->name('user.bar_th_164_permission');
    Route::post('/intervention/travaux/change2', [CrmHomeController::class, 'interventionTravauxChange2'])->name('intervention.travaux.change2');

    Route::get('user/permission/{id}', [CrmHomeController::class, 'userPermission'])->name('admin.user.permission');
    Route::post('planning.intervention.modal.render', [CrmHomeController::class, 'planningInterventionModalRender'])->name('planning.intervention.modal.render');
    Route::post('planning.intervention.modal.render2', [CrmHomeController::class, 'planningInterventionModalRender2'])->name('planning.intervention.modal.render2');
    Route::post('planning/location/distance', [CrmHomeController::class, 'planningLocationDistance'])->name('planning.location.distance');
    Route::post('planning2/location/distance', [CrmHomeController::class, 'planning2LocationDistance'])->name('planning2.location.distance');
    Route::post('planning/project/location/distance', [CrmHomeController::class, 'planningProjectLocationDistance'])->name('planning.project.location.distance');
    Route::post('eligibility/input/change',  [CrmHomeController::class, 'eligibilityInputChange'])->name('eligibility.input.change');
    Route::post('lead-huge-filter', [CrmHomeController::class, 'leadHugeFilter'])->name('lead.huge.filter');
    Route::post('project-huge-filter', [CrmHomeController::class, 'projectHugeFilter'])->name('project.huge.filter');
    // Route::get('all-validar-prospect-testing', [LeadController::class, 'bulkConvert']);

    // Chart Controller
    Route::get('/dashboard', [ChartController::class, 'newDashboard'])->name('dashboard.analytic');
    // Route::get('/dashboard', [ChartController::class, 'dashboardAnalytic'])->name('dashboard.analytic');
    // Route::get('/dashboard-updated', [ChartController::class, 'dashboardAnalyticUpdated'])->name('dashboard.analytic.updated');
    Route::post('/chart-project-filter', [ChartController::class, 'chartProjectFilter'])->name('chart.project.filter');
    Route::post('chart-client-filter', [ChartController::class, 'chartClientFilter'])->name('chart.client.filter') ;
    Route::post('chart-lead-filter', [ChartController::class, 'chartLeadFilter'])->name('chart.lead.filter');
    Route::post('compnay-filter', [ChartController::class, 'compnayFilter'])->name('compnay.filter');
    Route::get('filter/company/{id}', [ChartController::class, 'filterByCompany'])->name('filter.company');
    Route::post('/lead-filter-list', [ChartController::class, 'leadFilterList'])->name('lead.filter.list');
    Route::post('dashboard-filter', [ChartController::class, 'dashboardFilter'])->name('dashboard.filter');
    Route::post('dashboard-filter-clear', [ChartController::class, 'dashboardFilterClear'])->name('dashboard.filter.clear');
    Route::post('lead-client-filter', [ChartController::class, 'leadClientFilter'])->name('lead.client.filter');
    Route::post('rappler/filter/list', [ChartController::class, 'rapplerFilterList'])->name('rappler.filter.list');
    Route::post('rappler/type/change', [ChartController::class, 'rapplerTypeChange'])->name('rappler.type.change');
    Route::post('dashboard/stats/type/change', [ChartController::class, 'dashboardStatsTypeChange'])->name('dashboard.stats.type.change');
    Route::post('chart/tab/stats', [ChartController::class, 'chartTabStats'])->name('chart.tab.stats');
    Route::post('topbar/stats', [ChartController::class , 'topbarStats'])->name('topbar.stats');
    Route::post('chart/stats', [ChartController::class, 'chartStats'])->name('chart.stats');
    Route::post('ringover/history', [ChartController::class, 'ringoverHistory'])->name('ringover.history');
    Route::post('task/edit/modal', [ChartController::class, 'taskEditModal'])->name('task.edit.modal');
    Route::post('initial/render', [ChartController::class, 'initialRender'])->name('initial.render');


    // Profile controller
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');

    // update profile without ajax
    route::post('/update-profile', [ProfileController::class, 'updateProfile'])->name('update.profile');

    // update profile  Single Field with ajax

    // Change User Password
    Route::post('password-change', [ProfileController::class, 'changePassword'])->name('password.change');

    // Event Category Controller
    Route::post('/category-store', [EventCategoryController::class, 'categoryStore'])->name('category.store');
    Route::post('event-category-delete', [EventCategoryController::class, 'CategoryDelete'])->name('event.category.delete');

    // Event Controller
    Route::post('/event-store', [EventController::class, 'eventStore'])->name('event.store');
    Route::post('event-client-project', [EventController::class, 'eventClientProject'])->name('event.client.project');
    Route::post('event-assignee', [EventController::class, 'eventAssignee'])->name('event.assignee');
    Route::post('event-project', [EventController::class, 'eventProject'])->name('event.project');
    Route::post('event-drag', [EventController::class, 'eventDrag'])->name('event.drag');

    // Company Controller
    Route::post('/company-store', [CompanyController::class, 'companyAdd'])->name('company.add');
    Route::post('/company-update', [CompanyController::class, 'companyUpdate'])->name('company.update');
    Route::post('/company-search', [CompanyController::class, 'searchCompany'])->name('company.search');
    Route::post('/company-loadmore', [CompanyController::class, 'loadMore'])->name('company.loadmore');
    Route::post('/create-lead-index', [CompanyController::class, 'createLeadIndex'])->name('create-leads.index');

    // Lead Controller
    Route::post('/lead-create', [LeadController::class, 'createLead'])->name('lead.create');
    Route::post('/lead-project-update', [LeadController::class, 'projectUpdate'])->name('lead.project.update');
    Route::post('/lead-info-update', [LeadController::class, 'infoUpdate'])->name('lead.info.update');
    Route::post('/lead-tax-update', [LeadController::class, 'taxUpdate'])->name('lead.tax.update');
    Route::post('/lead-work-update', [LeadController::class, 'workUpdate'])->name('lead.work.update');
    Route::post('/lead-present-work-update', [LeadController::class, 'presentWorkUpdate'])->name('lead.present.work.update');
    Route::post('/update-image', [LeadController::class, 'updateImage'])->name('update.image');
    Route::post('/update-status', [LeadController::class, 'updateStatus'])->name('lead.status.update');
    Route::post('/lead-delete', [LeadController::class, 'leadDelete'])->name('lead.delete');
    Route::post('/update-telephone', [LeadController::class, 'updateTelephone'])->name('update.telephone');
    Route::post('/update-email', [LeadController::class, 'updateEmail'])->name('update.email');
    Route::post('/update-department', [LeadController::class, 'updateDepartment'])->name('update.department');
    Route::post('/update-precarious', [LeadController::class, 'updatePrecarious'])->name('update.precarious');
    Route::post('/update-zone', [LeadController::class, 'updateZone'])->name('update.zone');
    Route::post('/update-comment', [LeadController::class, 'updateComment'])->name('update.comment');
    Route::post('/lead-to-client', [LeadController::class, 'leadToClient'])->name('lead.to.client');
    Route::get('lead-export/{status}', [LeadController::class, 'leadExport'])->name('leads.export');
    Route::post('lead-import', [LeadController::class, 'leadImport'])->name('leads.import');
    Route::post('lead-header-filter', [LeadController::class, 'leadHeaderFilter'])->name('lead.header.filter');
    Route::post('all-leads-search', [LeadController::class, 'allLeadSearch'])->name('all-lead.search');
    Route::post('all-leads-search-new', [LeadController::class, 'allLeadSearchNew'])->name('all-lead.search.new');
    Route::post('company-lead-search', [LeadController::class, 'companyLeadSearch'])->name('company-lead.search');
    Route::post('lead-assign', [LeadController::class, 'leadAssign'])->name('lead.assign');
    Route::post('/leads-assignee', [LeadController::class, 'leadAssignee'])->name('leads.assignee');
    Route::post('/lead-bulk-assign', [LeadController::class, 'leadBulkAssign'])->name('lead.bulk.assign');
    Route::post('/lead-bulk-assign-supplier', [LeadController::class, 'leadBulkAssignSupplier'])->name('lead.bulk.assign.supplier');
    Route::post('/lead-bulk-regie-assign', [LeadController::class, 'leadBulkRegieAssign'])->name('lead.bulk.regie.assign');
    Route::post('/lead-bulk-delete', [LeadController::class, 'leadBulkDelete'])->name('lead.bulk.delete');
    Route::post('/tax-info-update', [LeadController::class, 'taxInfoUpdate'])->name('tax.info.update');
    Route::post('/tax-primary-change', [LeadController::class, 'taxPrimaryChange'])->name('tax.primary.change');
    Route::post('/tax/remove', [LeadController::class, 'taxRemove'])->name('tax.remove');
    Route::post('lead/tax/remove', [LeadController::class, 'leadTaxRemove'])->name('lead.tax.remove');
    Route::post('/lead-user-status-change', [LeadController::class, 'leadUserStatusChange'])->name('lead.user_status.change');
    Route::post('/lead-ceate-status', [LeadController::class, 'leadCreateStatus'])->name('lead.create.status');
    Route::post('/lead-update-status', [LeadController::class, 'leadUpdateStatus'])->name('lead.update.status');
    Route::post('/lead-delete-status', [LeadController::class, 'leadDeleteStatus'])->name('lead.delete.status');
    Route::post('/lead-foyer-update', [LeadController::class, 'leadFoyerUpdate'])->name('lead.foyer.update');
    Route::post('/lead-tracker-update', [LeadController::class, 'leadTrackerUpdate'])->name('lead.tracker.update');
    Route::post('lead-travaux-update', [LeadController::class, 'leadTravauxUpdate'])->name('lead.travaux.update');
    Route::post('lead-question-update', [LeadController::class, 'leadQuestionUpdate'])->name('lead.question.update');
    Route::post('lead-trait-update', [LeadController::class, 'leadTraitUpdate'])->name('lead.trait.update');
    Route::post('lead-tax-custom-update', [LeadController::class, 'leadTaxCustomUpdate'])->name('lead.tax.custom.update');
    Route::post('lead-tax-custom-update2', [LeadController::class, 'leadTaxCustomUpdate2'])->name('lead.tax.custom.update2');
    Route::post('lead-tax-custom-verify', [LeadController::class, 'leadTaxCustomVerify'])->name('lead.tax.custom.verify');
    Route::post('lead-tax-custom-verify2', [LeadController::class, 'leadTaxCustomVerify2'])->name('lead.tax.custom.verify2');
    Route::post('tax-mark-check', [LeadController::class, 'taxMarkCheck'])->name('tax.mark.check');
    Route::post('lead-tracking-date-update', [LeadController::class, 'leadTrackingDateUpdate'])->name('lead.tracking.date.update');
    Route::post('lead-bulk-unassign', [LeadController::class, 'leadBulkUnassign'])->name('lead.bulk.unassign');
    Route::post('lead-barame-change', [LeadController::class, 'leadBarameChange'])->name('lead.barame.change');
    Route::post('lead-travaux-change', [LeadController::class, 'leadTravauxChange'])->name('lead.travaux.change');
    Route::post('lead-user-limit', [LeadController::class, 'leadUserLimit'])->name('lead.user.limit');
    Route::post('lead-dispatcher', [LeadController::class, 'leadDispatcher'])->name('lead.dispatcher');
    Route::post('lead-comment-store', [LeadController::class, 'leadCommentStore'])->name('lead.comment.store');
    Route::post('lead-lock-access', [LeadController::class, 'leadLockAccess'])->name('lead.lock.access');
    Route::post('lead-log-delete', [LeadController::class, 'leadLogDelete'])->name('lead.log.delete');
    Route::post('lead-status-change', [LeadController::class, 'leadStatusChange'])->name('lead.status.change');
    Route::post('lead-ko-raison-update', [LeadController::class, 'leadKoRaisonUpdate'])->name('lead.ko.raison.update');
    Route::post('lead-bareme-validate', [LeadController::class, 'leadBaremeValidate'])->name('lead.bareme.validate');
    Route::post('lead-number-copy', [LeadController::class, 'leadNumberCopy'])->name('lead.number.copy');
    Route::get('lead-similar-file/{id}', [LeadController::class, 'leadSimilarFile'])->name('lead.similar.file');
    Route::post('/lead/callback/setting', [LeadController::class, 'leadCallbackSetting'])->name('lead.callback.setting');
    Route::post('lead/fiscal/status/change', [LeadController::class, 'leadFiscalStatusChange'])->name('lead.fiscal.status.change');
    Route::post('lead/pre/import', [LeadController::class, 'leadPreImport'])->name('lead.pre.import');
    Route::post('lead/fiscal/info/update', [LeadController::class, 'leadFiscalInfoUpdate'])->name('lead.fiscal.info.update');
    Route::post('postal/code/change', [LeadController::class, 'postalCodeChange'])->name('postal.code.change');
    Route::post('ringover/number/export', [LeadController::class, 'ringoverNumberExport'])->name('ringover.number.export');
    Route::post('lead/tax/declarant/update', [LeadController::class, 'leadTaxDeclarantUpdate'])->name('lead.tax.declarant.update');
    Route::post('lead/import/regie/change', [LeadController::class, 'leadImportRegieChange'])->name('lead.import.regie.change');
    Route::post('lead/status/change/list', [LeadController::class, 'statusChangeList'])->name('lead.status.change.list');
    Route::post('children/removed', [LeadController::class, 'childrenRemoved'])->name('children.removed');
    Route::post('children/update', [LeadController::class, 'childrenUpdate'])->name('children.update');
    Route::post('lead/modal/render', [LeadController::class, 'leadModalRender'])->name('lead.modal.render');
    Route::post("project/tag/product/change", [LeadController::class, 'projectTagProductChange'])->name('project.tag.product.change');
    Route::post('lead-status-change-bulk', [LeadController::class, 'leadStatusChangeBulk'])->name('lead.status.change.bulk');
    Route::post('lead-bulk-remise-zero-regie-assign', [LeadController::class, 'leadBulkRemiseZeroRegieAssign'])->name('lead.bulk.remise.zero.regie.assign');
    Route::post('lead-comment-delete', [LeadController::class, 'leadCommentDelete'])->name('lead.comment.delete');
    Route::post('project-marque-change', [LeadController::class, 'projectMarqueChange'])->name('project.marque.change');
    Route::post('lead/single/delete', [LeadController::class, 'leadSingleDelete'])->name('lead.single.delete');
    Route::post('lead/similar/check', [LeadController::class, 'leadSimilarCheck'])->name('lead.similar.check');
    Route::post('similar/lead/bulk/delete', [LeadController::class, 'similarLeadBulkDelete'])->name('similar.lead.bulk.delete');
    Route::post('/lead/dispatch/render', [LeadController::class, 'leadDispatchRender'])->name('lead.dispatch.render');



    Route::post('lead-assign-checkbox/{status}/{company_id?}', [LeadController::class, 'leadAssignCheckbox'])->name('lead.assign.checkbox');

    // Client Controller
    Route::post('/client-comment-update', [ClientController::class, 'clientCommentUpdate'])->name('update.client.comment');
    Route::post('/client-status-update', [ClientController::class, 'clientStatusUpdate'])->name('update.client.status');
    Route::get('/my-client', [ClientController::class, 'myClient'])->name('clients.index')->middleware('checkRole');
    Route::post('client-header-filter', [ClientController::class, 'clientHeaderFilter'])->name('client.header.filter');
    Route::get('/client-update/{id}', [ClientController::class, 'clientLeadUpdate'])->name('client.lead.update');
    Route::post('/client-search', [ClientController::class, 'clientSearch'])->name('client.search');
    Route::post('/update-client-image', [ClientController::class, 'updateClientImage'])->name('update.client.image');
    Route::post('/client-info-update', [ClientController::class, 'clientInfoUpdate'])->name('client.update');
    Route::post('/client-project-update', [ClientController::class, 'clientProjetUpdate'])->name('client.project.update');
    Route::post('/client-personal-update', [ClientController::class, 'clientPersonalInfoUpdate'])->name('client.info.update');
    Route::post('/client-work-update', [ClientController::class, 'clientWorkUpdate'])->name('client.work.update');
    Route::post('/client-present-work-update', [ClientController::class, 'clientPresentWorkUpdate'])->name('client.present.work.update');
    Route::post('/client-tax-update',[ClientController::class, 'clientTaxUpdate'])->name('client.tax.update');
    Route::post('/tax-client-primary-change', [ClientController::class, 'taxClientPrimaryChange'])->name('tax.client.primary.change');
    Route::post('/tax-client-info-update', [ClientController::class, 'taxCleintInfoUpdate'])->name('tax.client.info.update');
    Route::post('/new-project-create', [ClientController::class, 'newProjectCreate'])->name('new.project.create');
    Route::post('/client-foyer-update', [ClientController::class, 'clientFoyerUpdate'])->name('client.foyer.update');
    Route::post('client-project-create', [ClientController::class, 'clientprojectCreate'])->name('client.project.create');
    Route::get('/client-export/{id}', [ClientController::class, 'clientExport']);
    Route::post('client-bulk-assign', [ClientController::class, 'clientBulkAssign'])->name('client.bulk.assign');
    Route::post('client-single-assigne', [ClientController::class, 'clientSingleAssigne'])->name('client.single.assigne');
    Route::post('/clients-assignee', [ClientController::class, 'clientsAssignee'])->name('clients.assignee');
    Route::post('/client-assign', [ClientController::class, 'clientAssign'])->name('client.assign');
    Route::post('client-delete', [ClientController::class, 'clientDelete'])->name('client.delete');
    Route::post('/client-tracker-update', [ClientController::class, 'clientTrackerUpdate'])->name('client.tracker.update');
    Route::post('client-travaux-update', [ClientController::class, 'clientTravauxUpdate'])->name('client.travaux.update');
    Route::post('client-question-update', [ClientController::class, 'clientQuestionUpdate'])->name('client.question.update');
    Route::post('client-trait-update', [ClientController::class, 'clientTraitUpdate'])->name('client.trait.update');
    Route::post('client-tax-custom-update', [ClientController::class, 'clientTaxCustomUpdate'])->name('client.tax.custom.update');
    Route::post('client-tax-custom-update2', [ClientController::class, 'clientTaxCustomUpdate2'])->name('client.tax.custom.update2');
    Route::post("client-tax-custom-verify", [ClientController::class, 'clientTaxCustomVerify'])->name('client.tax.custom.verify');
    Route::post("client-tax-custom-verify2", [ClientController::class, 'clientTaxCustomVerify2'])->name('client.tax.custom.verify2');
    Route::post('/client-create-status', [ClientController::class, 'clientCreateStatus'])->name('client.create.status');
    Route::post('client-delete-status', [ClientController::class, 'clientDeleteStatus'])->name('client.delete.status');
    Route::post('client-user_status-change', [ClientController::class, 'clientUserStatusChange'])->name('client.user_status.change');
    Route::post('client-update-status', [ClientController::class, 'clientUpdateStatus'])->name('client.update.status');
    Route::post('client-tax-mark-check', [ClientController::class, 'clientTaxMarkCheck'])->name('client.tax.mark.check');
    Route::post('client-comment-store', [ClientController::class, 'clientCommentStore'])->name('client.comment.store');
    Route::post('client-lock-access', [ClientController::class, 'clientLockAccess'])->name('client.lock.access');
    Route::post('client-log-delete', [ClientController::class, 'clientLogDelete'])->name('client.log.delete');
    Route::post('client/tax/remove', [ClientController::class, 'clientTaxRemove'])->name('client.tax.remove');
    Route::post('/client/callback/setting', [ClientController::class, 'clientCallbackSetting'])->name('client.callback.setting');
    Route::post('/client/status/change', [ClientController::class, 'clientStatusChange'])->name('client.status.change');
    Route::post('client/fiscal/status/change', [ClientController::class, 'clientFiscalStatusChange'])->name('client.fiscal.status.change');
    Route::get('client/similar/file/{id}', [ClientController::class, 'clientSimilarFile'])->name('client.similar.file');
    Route::post('client/to/project', [ClientController::class, 'clientToProject'])->name('client.to.project');
    Route::post('client/fiscal/info/update', [ClientController::class, 'clientFiscalInfoUpdate'])->name('client.fiscal.info.update');
    Route::post('client/custom/field', [ClientController::class, 'clientCustomField'])->name('client.custom.field');
    Route::post('client/custom/field/store', [ClientController::class, 'clientCustomFieldStore'])->name('client.custom.field.store');
    Route::post('client/custom/field/delete', [ClientController::class, 'clientCustomFieldDelete'])->name('client.custom.field.delete');
    Route::post('client/bulk/delete', [ClientController::class, 'clientBulkDelete'])->name('client.bulk.delete');
    Route::post('client/tax/declarant/update', [ClientController::class, 'clientTaxDeclarantUpdate'])->name('client.tax.declarant.update');
    Route::post('client/bareme/validate', [ClientController::class, 'clientBaremeValidate'])->name('client.bareme.validate');
    Route::get('client/filter', [ClientController::class, 'clientFilter'])->name('client.filter');
    Route::post('client/default/modal/render', [ClientController::class, 'clientDefaultModalRender'])->name('client.default.modal.render');
    Route::post('client/edit-default/modal/render', [ClientController::class, 'clientEditDefaultModalRender'])->name('client.edit-default.modal.render');
    Route::post('client-comment-delete', [ClientController::class, 'clientCommentDelete'])->name('client.comment.delete');
    Route::post('client-comment-pin', [ClientController::class, 'clientCommentPin'])->name('client.comment.pin');
    Route::post('client/single/delete', [ClientController::class, 'clientSingleDelete'])->name('client.single.delete');


    // Project Controller
    Route::get('project/imoprt-test-done/{id}', [ProjectController::class, 'imoprtTestDone'])->name('project.imoprt-test-done');
    Route::get('/projects-import/{id?}', [ProjectController::class, 'projectImport'])->name('project-import.index');
    Route::get('/projects/{id?}', [ProjectController::class, 'projectIndex'])->name('project.index')->middleware('checkRole');
    Route::post('/project/create', [ProjectController::class, 'projectCreate'])->name('project.create');
    Route::post('/project-import/create', [ProjectController::class, 'projectImportCreate'])->name('project-import.create');
    Route::post('/project-import/moveto', [ProjectController::class, 'projectImportMoveto'])->name('project-import.moveto');
    Route::post('/project-header-filter', [ProjectController::class, 'projectHeaderFilter'])->name('project.header.filter');
    Route::post('/project-search', [ProjectController::class, 'projectSearch'])->name('project.search');
    Route::post('update-project-comment', [ProjectController::class, 'updateProjectComment'])->name('update.project.comment');
    Route::post('project-tax-update', [ProjectController::class, 'projectTaxUpdate'])->name('project.tax.update');
    Route::post('/tax-project-info-update', [ProjectController::class, 'taxProjectInfoUpdate'])->name('tax.project.info.update');
    Route::post('/tax-project-primary-update', [ProjectController::class, 'taxProjectPrimaryUpdate'])->name('tax.project.primary.change');
    Route::post('/project-work-update', [ProjectController::class, 'projectWorkUpdate'])->name('project.work.update');
    Route::post('/project-present-work-update', [ProjectController::class, 'projectPresentWorkUpdate'])->name('project.present.work.update');
    Route::post('/project-foyer-update', [ProjectController::class, 'projectFoyerUpdate'])->name('project.foyer.update');
    Route::post('update-project-image', [ProjectController::class, 'updateProjectImage'])->name('update.project.image');
    Route::post('/project-trait-update', [ProjectController::class, 'projectTraitUpdate'])->name('project.trait.update');
    Route::post('/project-intervention-update', [ProjectController::class, 'projectInterventionUpdate'])->name('project.intervention.update');
    Route::post('/project-report-update', [ProjectController::class, 'projectReportUpdate'])->name('project.report.update');
    Route::post('/project-information-update', [ProjectController::class, 'projectInformationUpdate'])->name('project.information.update');
    Route::post('/project-information-update2', [ProjectController::class, 'projectInformationUpdate2'])->name('project.information.update2');
    Route::post('/project-subvention-update', [ProjectController::class, 'projectSubventionUpdate'])->name('project.subvention.update');
    Route::post('/project-information2-update', [ProjectController::class, 'projectInformation2Update'])->name('project.information2.update');
    Route::post('/project-installation-update', [ProjectController::class, 'projectInterventionInstallationUpdate'])->name('project.intervention.installation.update');
    Route::post('/project-report2-update', [ProjectController::class, 'projectReport2Update'])->name('project.report2.update');
    Route::post('/project-travaux-update', [ProjectController::class, 'projectTravauxUpdate'])->name('project.travaux.update');
    Route::post('/project-question-update', [ProjectController::class, 'projectQuestionUpdate'])->name('project.question.update');
    Route::post('/information-scrap', [ProjectController::class, 'informationScrap'])->name('information.scrap');
    Route::post('/activity-log-delete', [ProjectController::class, 'activityLogDelete'])->name('log.delete');
    Route::post('/project-pre-installation', [ProjectController::class, 'projectPreInstallation'])->name('project.pre.installation');
    Route::post('/project-post-installation', [ProjectController::class, 'projectPostInstallation'])->name('project.post.installation');
    Route::get('/generate-pdf/{id}', [ProjectController::class, 'generatePdf'])->name('generate.pdf');
    Route::post('/generate-document', [ProjectController::class, 'generateDocument'])->name('generate.document');
    Route::get('/generate-post-pdf/{id}', [ProjectController::class, 'generatePostPdf'])->name('generate.post.pdf');
    Route::post('/log-comment-update', [ProjectController::class, 'logCommentUpdate'])->name('log.comment.update');
    Route::get('notification-view-project/{notify_id}/{project_id}', [ProjectController::class, 'notificationViewProject'])->name('notification.view.project');
    Route::get('notification-view-ticket/{notify_id}/{ticket_id}', [TicketController::class, 'notificationViewTicket'])->name('notification.view.ticket');
    Route::post('/project-delete', [ProjectController::class, 'projectDelete'])->name('project.delete');
    Route::post('project-assign', [ProjectController::class, 'projectAssign'])->name('project.assign');
    Route::post('project-bulk-assign', [ProjectController::class, 'projectBulkAssign'])->name('project.bulk.assign');
    Route::post('project-status-create', [ProjectController::class, 'projectStatusCreate'])->name('project.status.create');
    Route::post('/project-status-delete', [ProjectController::class, 'projectStatusDelete'])->name('project.status.delete');
    Route::post('project-tracker-update', [ProjectController::class, 'projectTrackerUpdate'])->name('project.tracker.update');
    Route::post('project-create-status', [ProjectController::class, 'projectCreateStatus'])->name('project.create.status');
    Route::post('project-delete-status', [ProjectController::class, 'projectDeleteStatus'])->name('project.delete.status');
    Route::post('project-user_status-change', [ProjectController::class, 'projectUserStatusChange'])->name('project.user_status.change');
    Route::post('project-update-status', [ProjectController::class, 'projectUpdateStatus'])->name('project.update.status');
    Route::post('project-tax-custom-update', [ProjectController::class, 'projectTaxCustomUpdate'])->name('project.tax.custom.update');
    Route::post('project-tax-custom-update2', [ProjectController::class, 'projectTaxCustomUpdate2'])->name('project.tax.custom.update2');
    Route::post('project-tax-custom-verify', [ProjectController::class, 'projectTaxCustomVerify'])->name('project.tax.custom.verify');
    Route::post('project-tax-custom-verify2', [ProjectController::class, 'projectTaxCustomVerify2'])->name('project.tax.custom.verify2');
    Route::post('project-comment-store', [ProjectController::class, 'projectCommentStore'])->name('project.comment.store');
    Route::post('project-comment-delete', [ProjectController::class, 'projectCommentDelete'])->name('project.comment.delete');
    Route::post('project-comment-pin', [ProjectController::class, 'projectCommentPin'])->name('project.comment.pin');
    Route::post('project-status-planning-create', [ProjectController::class, 'projectStatusPlanningCreate'])->name('project.status.planning.create');
    Route::post('project-status-planning-delete', [ProjectController::class, 'projectStatusPlanningDelete'])->name('project.status.planning.delete');
    Route::post('project-name-change', [ProjectController::class, 'projectNameChange'])->name('project.name.change');
    Route::post('travaux-product-create', [ProjectController::class, 'travauxProductCreate'])->name('travaux.product.create');
    Route::post('travaux-product-delete', [ProjectController::class, 'travauxProductDelete'])->name('travaux.product.delete');
    Route::post('travaux-create', [ProjectController::class, 'travauxCreate'])->name('travaux.create');
    Route::post('travaux-update', [ProjectController::class, 'travauxUpdate'])->name('travaux.update');
    Route::post('travaux-delete', [ProjectController::class, 'travauxDelete'])->name('travaux.delete');
    Route::post('custom-sav-create', [ProjectController::class, 'customSavCreate'])->name('custom.sav.create');
    Route::post('project-sav-field-store', [ProjectController::class, 'projectSavFieldStore'])->name('project.sav.field.store');
    Route::post('project-sav-field-data-store', [ProjectController::class, 'projectSavFieldDataStore'])->name('project.sav.field.data.store');
    Route::post('project-sav-delete', [ProjectController::class, 'projectSavDelete'])->name('project.sav.delete');
    Route::post('project-sav-field', [ProjectController::class, 'projectSavField'])->name('project.sav.field');
    Route::post('project-sav-field-delete', [ProjectController::class, 'projectSavFieldDelete'])->name('project.sav.field.delete');
    Route::post('project-work-done', [ProjectController::class, 'projectWorkDone'])->name('project.work.done');
    Route::Post('work-done-update', [ProjectController::class, 'workDoneUpdate'])->name('work.done.update');
    Route::post('work-done-delete', [ProjectController::class, 'workDoneDelete'])->name('work.done.delete');
    Route::post('additional-prodcut-add', [ProjectController::class, 'additionalProdcutAdd'])->name('additional.prodcut.add');
    Route::post('additional-product-update', [ProjectController::class, 'additionalProductUpdate'])->name('additional.product.update');
    Route::post('additional-product-update2', [ProjectController::class, 'additionalProductUpdate2'])->name('additional.product.update2');
    Route::post('additional-product-delete', [ProjectController::class, 'additionalProductDelete'])->name('additional.product.delete');
    Route::post('project-energy-store', [ProjectController::class, 'projectEnergyStore'])->name('project.energy.store');
    Route::post('sidebar-info-update', [ProjectController::class, 'sidebarInfoUpdate'])->name('sidebar.info.update');
    Route::post('update-active-tab', [ProjectController::class, 'updateActiveTab'])->name('update.active.tab');
    Route::post('project-document-access-update', [ProjectController::class, 'projectDocumentAccessUpdate'])->name('project.document.access.update');
    Route::post('project-tax-mark-check', [ProjectController::class, 'projectTaxMarkCheck'])->name('project.tax.mark.check');
    Route::post('project-compte-update', [ProjectController::class, 'projectCompteUpdate'])->name('project.compte.update');
    Route::post('project-subvention-create', [ProjectController::class, 'projectSubventionCreate'])->name('project.subvention.create');
    Route::post('subvention-update', [ProjectController::class, 'subventionUpdate'])->name('subvention.update');
    Route::post('project-subvention-delete', [ProjectController::class, 'projectSubventionDelete'])->name('project.subvention.delete');
    Route::post('subvention-file-update', [ProjectController::class, 'subventionFileUpdate'])->name('subvention.file.update');
    Route::post('subvention-file2-update', [ProjectController::class, 'subventionFile2Update'])->name('subvention.file2.update');
    Route::post('subvention-file3-update', [ProjectController::class, 'subventionFile3Update'])->name('subvention.file3.update');
    Route::post('banque-create', [ProjectController::class, 'banqueCreate'])->name('banque.create');
    Route::post('banque-update', [ProjectController::class, 'banqueUpdate'])->name('banque.update');
    Route::post('banque-delete', [ProjectController::class, 'banqueDelete'])->name('banque.delete');
    Route::post('banque-depot-create', [ProjectController::class, 'banqueDepotCreate'])->name('project.banque.depot.create');
    Route::post('banque-depot-update', [ProjectController::class, 'banqueDepotUpdate'])->name('banque.depot.update');
    Route::post('banque-depot-delete', [ProjectController::class, 'banqueDepotDelete'])->name('project.banque.depot.delete');
    Route::post('demande-mairie-create', [ProjectController::class, 'demandemairieCreate'])->name('project.demande.mairie.create');
    Route::post('demande-mairie-update', [ProjectController::class, 'demandemairieUpdate'])->name('project.demande.mairie.update');
    Route::post('demande-mairie-delete', [ProjectController::class, 'demandemairieDelete'])->name('project.demande.mairie.delete');
    Route::post('project-audit-create', [ProjectController::class, 'projectAuditCreate'])->name('project.audit.create');
    Route::post('project-audit-delete', [ProjectController::class, 'projectAuditDelete'])->name('project.audit.delete');
    Route::post('office-create', [ProjectController::class, 'officeCreate'])->name('office.create');
    Route::post('office-update', [ProjectController::class, 'officeUpdate'])->name('office.update');
    Route::post('office-delete', [ProjectController::class, 'officeDelete'])->name('office.delete');
    Route::post('audit-status-create', [ProjectController::class, 'auditStatusCreate'])->name('audit.status.create');
    Route::post('audit-status-update', [ProjectController::class, 'auditStatusUpdate'])->name('audit.status.update');
    Route::post('audit-status-delete', [ProjectController::class, 'auditStatusDelete'])->name('audit.status.delete');
    Route::post('audit-report-status-create', [ProjectController::class, 'auditReportStatusCreate'])->name('audit.report.status.create');
    Route::post('audit-report-status-update', [ProjectController::class, 'auditReportStatusUpdate'])->name('audit.report.status.update');
    Route::post('audit-report-status-delete', [ProjectController::class, 'auditReportStatusDelete'])->name('audit.report.status.delete');
    Route::post('report-result-create', [ProjectController::class, 'reportResultCreate'])->name('report.result.create');
    Route::post('report-result-update', [ProjectController::class, 'reportResultUpdate'])->name('report.result.update');
    Route::post('report-result-delete', [ProjectController::class, 'reportResultDelete'])->name('report.result.delete');
    Route::post('project-audit-update', [ProjectController::class, 'projectAuditUpdate'])->name('project.audit.update');
    Route::post('commercial-terrain-create', [ProjectController::class, 'commercialTerrainCreate'])->name('commercial.terrain.create');
    Route::post('commercial-terrain-update', [ProjectController::class, 'commercialTerrainUpdate'])->name('commercial.terrain.update');
    Route::post('commercial-terrain-delete', [ProjectController::class, 'commercialTerrainDelete'])->name('commercial.terrain.delete');
    Route::post('project-intervention-create', [ProjectController::class, 'projectInterventionCreate'])->name('project.intervention.create');
    Route::post('status-study-create', [ProjectController::class, 'statusStudyCreate'])->name('status.study.create');
    Route::post('status-study-update', [ProjectController::class, 'statusStudyUpdate'])->name('status.study.update');
    Route::post('status-study-delete', [ProjectController::class, 'statusStudyDelete'])->name('status.study.delete');
    Route::post('technician-study-create', [ProjectController::class, 'technicianStudyCreate'])->name('technician.study.create');
    Route::post('technician-study-update', [ProjectController::class, 'technicianStudyUpdate'])->name('technician.study.update');
    Route::post('technician-study-delete', [ProjectController::class, 'technicianStudyDelete'])->name('technician.study.delete');
    Route::post('technical-referee-create', [ProjectController::class, 'technicalRefereeCreate'])->name('technical.referee.create');
    Route::post('technical-referee-update', [ProjectController::class, 'technicalRefereeUpdate'])->name('technical.referee.update');
    Route::post('technical-referee-delete', [ProjectController::class, 'technicalRefereeDelete'])->name('technical.referee.delete');
    Route::post('feasibility-study-create', [ProjectController::class, 'feasibilityStudyCreate'])->name('feasibility.study.create');
    Route::post('feasibility-study-update', [ProjectController::class, 'feasibilityStudyUpdate'])->name('feasibility.study.update');
    Route::post('feasibility-study-delete', [ProjectController::class, 'feasibilityStudyDelete'])->name('feasibility.study.delete');
    Route::post('status-previsite-create', [ProjectController::class, 'statusPrevisiteCreate'])->name('status.previsite.create');
    Route::post('status-previsite-update', [ProjectController::class, 'statusPrevisiteUpdate'])->name('status.previsite.update');
    Route::post('status-previsite-delete', [ProjectController::class, 'statusPrevisiteDelete'])->name('status.previsite.delete');
    Route::post('technician-previsite-create', [ProjectController::class, 'technicianPrevisiteCreate'])->name('technician.previsite.create');
    Route::post('technician-previsite-update', [ProjectController::class, 'technicianPrevisiteUpdate'])->name('technician.previsite.update');
    Route::post('technician-previsite-delete', [ProjectController::class, 'technicianPrevisiteDelete'])->name('technician.previsite.delete');
    Route::post('previsite-status-create', [ProjectController::class, 'previsiteStatusCreate'])->name('previsite.status.create');
    Route::post('previsite-status-update', [ProjectController::class, 'previsiteStatusUpdate'])->name('previsite.status.update');
    Route::post('previsite-status-delete', [ProjectController::class, 'previsiteStatusDelete'])->name('previsite.status.delete');
    Route::post('feasibility-previsite-create', [ProjectController::class, 'feasibilityPrevisiteCreate'])->name('feasibility.previsite.create');
    Route::post('feasibility-previsite-update', [ProjectController::class, 'feasibilityPrevisiteUpdate'])->name('feasibility.previsite.update');
    Route::post('feasibility-previsite-delete', [ProjectController::class, 'feasibilityPrevisiteDelete'])->name('feasibility.previsite.delete');
    Route::post('status-planning-counter-visit-create', [ProjectController::class, 'statusPlanningCounterVisitCreate'])->name('status.planning.counter.visit.create');
    Route::post('status-planning-counter-visit-update', [ProjectController::class, 'statusPlanningCounterVisitUpdate'])->name('status.planning.counter.visit.update');
    Route::post('status-planning-counter-visit-delete', [ProjectController::class, 'statusPlanningCounterVisitDelete'])->name('status.planning.counter.visit.delete');
    Route::post('technician-counter-visit-create', [ProjectController::class, 'technicianCounterVisitCreate'])->name('technician.counter.visit.create');
    Route::post('technician-counter-visit-update', [ProjectController::class, 'technicianCounterVisitUpdate'])->name('technician.counter.visit.update');
    Route::post('technician-counter-visit-delete', [ProjectController::class, 'technicianCounterVisitDelete'])->name('technician.counter.visit.delete');
    Route::post('status-counter-visit-create', [ProjectController::class, 'statusCounterVisitCreate'])->name('status.counter.visit.create');
    Route::post('status-counter-visit-update', [ProjectController::class, 'statusCounterVisitUpdate'])->name('status.counter.visit.update');
    Route::post('status-counter-visit-delete', [ProjectController::class, 'statusCounterVisitDelete'])->name('status.counter.visit.delete');
    Route::post('status-feasibility-counter-visit-create', [ProjectController::class, 'statusFeasibilityCounterVisitCreate'])->name('status.feasibility.counter.visit.create');
    Route::post('status-feasibility-counter-visit-update', [ProjectController::class, 'statusFeasibilityCounterVisitUpdate'])->name('status.feasibility.counter.visit.update');
    Route::post('status-feasibility-counter-visit-delete', [ProjectController::class, 'statusFeasibilityCounterVisitDelete'])->name('status.feasibility.counter.visit.delete');
    Route::post('status-planning-installation-create', [ProjectController::class, 'statusPlanningInstallationCreate'])->name('status.planning.installation.create');
    Route::post('status-planning-installation-update', [ProjectController::class, 'statusPlanningInstallationUpdate'])->name('status.planning.installation.update');
    Route::post('status-planning-installation-delete', [ProjectController::class, 'statusPlanningInstallationDelete'])->name('status.planning.installation.delete');
    Route::post('status-planning-sav-create', [ProjectController::class, 'statusPlanningSavCreate'])->name('status.planning.sav.create');
    Route::post('status-planning-sav-update', [ProjectController::class, 'statusPlanningSavUpdate'])->name('status.planning.sav.update');
    Route::post('status-planning-sav-delete', [ProjectController::class, 'statusPlanningSavDelete'])->name('status.planning.sav.delete');
    Route::post('technician-sav-create', [ProjectController::class, 'technicianSavCreate'])->name('technician.sav.create');
    Route::post('technician-sav-update', [ProjectController::class, 'technicianSavUpdate'])->name('technician.sav.update');
    Route::post('technician-sav-delete', [ProjectController::class, 'technicianSavDelete'])->name('technician.sav.delete');
    Route::post('status-resolution-sav-create', [ProjectController::class, 'statusResolutionSavCreate'])->name('status.resolution.sav.create');
    Route::post('status-resolution-sav-update', [ProjectController::class, 'statusResolutionSavUpdate'])->name('status.resolution.sav.update');
    Route::post('status-resolution-sav-delete', [ProjectController::class, 'statusResolutionSavDelete'])->name('status.resolution.sav.delete');
    Route::post('new-project-intervention-update', [ProjectController::class, 'newProjectInterventionUpdate'])->name('new.project.intervention.update');
    Route::post('status-planning-deplacement-create', [ProjectController::class, 'statusPlanningDeplacementCreate'])->name('status.planning.deplacement.create');
    Route::post('status-planning-deplacement-update', [ProjectController::class, 'statusPlanningDeplacementUpdate'])->name('status.planning.deplacement.update');
    Route::post('status-planning-deplacement-delete', [ProjectController::class, 'statusPlanningDeplacementDelete'])->name('status.planning.deplacement.delete');
    Route::post('project-quality-control-create', [ProjectController::class, 'projectQualityControlCreate'])->name('project.quality.control.create');
    Route::post('project-quality-control-delete', [ProjectController::class, 'projectQualityControlDelete'])->name('project.quality.control.delete');
    Route::post('project-quality-control-update', [ProjectController::class, 'projectQualityControlUpdate'])->name('project.quality.control.update');
    Route::post('project-control-sur-site-create', [ProjectController::class, 'projectControlSurSiteCreate'])->name('project.control.sur.site.create');
    Route::post('project-control-sur-site-delete', [ProjectController::class, 'projectControlSurSiteDelete'])->name('project.control.sur.site.delete');
    Route::post('project-control-office-create', [ProjectController::class, 'projectControlOfficeCreate'])->name('project.control.office.create');
    Route::post('project-control-office-update', [ProjectController::class, 'projectControlOfficeUpdate'])->name('project.control.office.update');
    Route::post('project-control-office-delete', [ProjectController::class, 'projectControlOfficeDelete'])->name('project.control.office.delete');
    Route::post('project-inspection-status-create', [ProjectController::class, 'projectInspectionStatusCreate'])->name('project.inspection.status.create');
    Route::post('project-inspection-status-update', [ProjectController::class, 'projectInspectionStatusUpdate'])->name('project.inspection.status.update');
    Route::post('project-inspection-status-delete', [ProjectController::class, 'projectInspectionStatusDelete'])->name('project.inspection.status.delete');
    Route::post('project-controlled-work-create', [ProjectController::class, 'projectControlledWorkCreate'])->name('project.controlled.work.create');
    Route::post('project-controlled-work-update', [ProjectController::class, 'projectControlledWorkUpdate'])->name('project.controlled.work.update');
    Route::post('project-controlled-work-delete', [ProjectController::class, 'projectControlledWorkDelete'])->name('project.controlled.work.delete');
    Route::post('project-compliance-create', [ProjectController::class, 'projectComplianceCreate'])->name('project.compliance.create');
    Route::post('project-compliance-update', [ProjectController::class, 'projectComplianceUpdate'])->name('project.compliance.update');
    Route::post('project-compliance-delete', [ProjectController::class, 'projectComplianceDelete'])->name('project.compliance.delete');
    Route::post('project-company-commissioned-create', [ProjectController::class, 'projectCompanyCommissionedCreate'])->name('project.company.commissioned.create');
    Route::post('project-company-commissioned-update', [ProjectController::class, 'projectCompanyCommissionedUpdate'])->name('project.company.commissioned.update');
    Route::post('project-company-commissioned-delete', [ProjectController::class, 'projectCompanyCommissionedDelete'])->name('project.company.commissioned.delete');
    Route::post('project-commissioning-technician-create', [ProjectController::class, 'projectCommissioningTechnicianCreate'])->name('project.commissioning.technician.create');
    Route::post('project-commissioning-technician-update', [ProjectController::class, 'projectCommissioningTechnicianUpdate'])->name('project.commissioning.technician.update');
    Route::post('project-commissioning-technician-delete', [ProjectController::class, 'projectCommissioningTechnicianDelete'])->name('project.commissioning.technician.delete');
    Route::post('project-commissioning-status-create', [ProjectController::class, 'projectCommissioningStatusCreate'])->name('project.commissioning.status.create');
    Route::post('project-commissioning-status-update', [ProjectController::class, 'projectCommissioningStatusUpdate'])->name('project.commissioning.status.update');
    Route::post('project-commissioning-status-delete', [ProjectController::class, 'projectCommissioningStatusDelete'])->name('project.commissioning.status.delete');
    Route::post('project-status-invoice-create', [ProjectController::class, 'projectStatusInvoiceCreate'])->name('project.status.invoice.create');
    Route::post('project-status-invoice-update', [ProjectController::class, 'projectStatusInvoiceUpdate'])->name('project.status.invoice.update');
    Route::post('project-status-invoice-delete', [ProjectController::class, 'projectStatusInvoiceDelete'])->name('project.status.invoice.delete');
    Route::post('project-control-office-csp-create', [ProjectController::class, 'projectControlOfficeCspCreate'])->name('project.control.office.csp.create');
    Route::post('project-control-office-csp-update', [ProjectController::class, 'projectControlOfficeCspUpdate'])->name('project.control.office.csp.update');
    Route::post('project-control-office-csp-delete', [ProjectController::class, 'projectControlOfficeCspDelete'])->name('project.control.office.csp.delete');
    Route::post('control-sur-site-update', [ProjectController::class, 'controlSurSiteUpdate'])->name('control.sur.site.update');
    Route::post('control-sur-site-file-update', [ProjectController::class, 'controlSurSiteFileUpdate'])->name('control.sur.site.file.update');
    Route::post('project-facturation-update', [ProjectController::class, 'projectFacturationUpdate'])->name('project.facturation.update');
    Route::post('project-facturation-file-update', [ProjectController::class, 'projectFacturationFileUpdate'])->name('project.facturation.file.update');
    Route::post('quality-controle-question-store', [ProjectController::class, 'qualityControleQuestionStore'])->name('quality.controle.question.store');
    Route::post('quality-controle-header-store', [ProjectController::class, 'qualityControleHeaderStore'])->name('quality.controle.header.store');
    Route::post('project-quality-control-post-etude-update', [ProjectController::class, 'projectQualityControlPostEtudeupdate'])->name('project.quality.control.post.etude.update');
    Route::post('project-management-control-update', [ProjectController::class, 'projectManagementControlUpdate'])->name('project.management.control.update');
    Route::post('commercial-invoice-create', [ProjectController::class, 'commercialInvoiceCreate'])->name('commercial.invoice.create');
    Route::post('commercial-invoice-update', [ProjectController::class, 'commercialInvoiceUpdate'])->name('commercial.invoice.update');
    Route::post('commercial-invoice-delete', [ProjectController::class, 'commercialInvoiceDelete'])->name('commercial.invoice.delete');
    Route::post('previsitor-create', [ProjectController::class, 'previsitorCreate'])->name('previsitor.create');
    Route::post('previsitor-update', [ProjectController::class, 'previsitorUpdate'])->name('previsitor.update');
    Route::post('previsitor-delete', [ProjectController::class, 'previsitorDelete'])->name('previsitor.delete');
    Route::post('ticket-problem-create', [ProjectController::class, 'ticketProblemCreate'])->name('ticket.problem.create');
    Route::post('ticket-problem-update', [ProjectController::class, 'ticketProblemUpdate'])->name('ticket.problem.update');
    Route::post('ticket-problem-delete', [ProjectController::class, 'ticketProblemDelete'])->name('ticket.problem.delete');
    Route::post('project-prestation-change', [ProjectController::class, 'projectPrestationChange'])->name('project.prestation.change');
    Route::post('additional-product-bulk-delete', [ProjectController::class, 'additionalProductBulkDelete'])->name('additional.product.bulk.delete');
    Route::post('energy-type-create', [ProjectController::class, 'energyTypeCreate'])->name('energy.type.create');
    Route::post('energy-type-update', [ProjectController::class, 'energyTypeUpdate'])->name('energy.type.update');
    Route::post('energy-type-delete', [ProjectController::class, 'energyTypeDelete'])->name('energy.type.delete');
    Route::post('prestation-group-create', [ProjectController::class, 'prestationGroupCreate'])->name('prestation.group.create');
    Route::post('prestation-group-update', [ProjectController::class, 'prestationGroupUpdate'])->name('prestation.group.update');
    Route::post('prestation-group-delete', [ProjectController::class, 'prestationGroupDelete'])->name('prestation.group.delete');
    Route::post('project-lock-access', [ProjectController::class, 'projectLockAccess'])->name('project.lock.access');
    Route::post('project/tax/remove', [ProjectController::class, 'projectTaxRemove'])->name('project.tax.remove');
    Route::post('/project/callback/setting', [ProjectController::class, 'projectCallbackSetting'])->name('project.callback.setting');
    Route::post('project/fiscal/status/change', [ProjectController::class, 'projectFiscalStatusChange'])->name('project.fiscal.status.change');
    Route::post('project/status/change', [ProjectController::class, 'projectStatusChange'])->name('project.status.change');
    Route::post('project/ko/raison/update', [ProjectController::class, 'projectKoRaisonUpdate'])->name('project.ko.raison.update');
    Route::get('project/similar/file/{id}', [ProjectController::class, 'projectSimilarFile'])->name('project.similar.file');
    Route::post('project/telecommercial/assign', [ProjectController::class, 'projectTelecommercialAssign'])->name('project.telecommercial.assign');
    Route::post('project/telecommercial/unassign', [ProjectController::class, 'projectTelecommercialUnassign'])->name('project.telecommercial.unassign');
    Route::post('project/gestionnaire/assign', [ProjectController::class, 'projectGestionnaireAssign'])->name('project.gestionnaire.assign');
    Route::post('project/gestionnaire/unassign', [ProjectController::class, 'projectGestionnaireUnassign'])->name('project.gestionnaire.unassign');
    Route::post('project/barame/change', [ProjectController::class, 'projectBarameChange'])->name('project.barame.change');
    Route::post('project/travaux/change', [ProjectController::class, 'projectTravauxChange'])->name('project.travaux.change');
    Route::post('project/bareme/validate', [ProjectController::class, 'projectBaremeValidate'])->name('project.bareme.validate');
    Route::post('project/document/control/update', [ProjectController::class, 'projectDocumentControlUpdate'])->name('project.document.control.update');
    Route::post('project/intervention/delete', [ProjectController::class, 'projectInterventionDelete'])->name('project.intervention.delete');
    Route::post('intervention/travaux/change', [ProjectController::class, 'interventionTravauxChange'])->name('intervention.travaux.change');
    Route::post('project/rapport/file/upload', [ProjectController::class, 'projectRapportFileUpload'])->name('project.rapport.file.upload');
    Route::get('project/intervention/pdf/{id}', [ProjectController::class, 'projectInterventionPdf'])->name('project.intervention.pdf');
    Route::post('project/fiscal/info/update', [ProjectController::class, 'projectFiscalInfoUpdate'])->name('project.fiscal.info.update');
    Route::post('project/custom/field', [ProjectController::class,'projectCustomField'])->name('project.custom.field');
    Route::post('project/custom/field/delete', [ProjectController::class, 'projectCustomFieldDelete'])->name('project.custom.field.delete');
    Route::post('project/custom/field/store', [ProjectController::class, 'projectCustomFieldStore'])->name('project.custom.field.store');
    Route::post('project/facturation/create', [ProjectController::class, 'projectFacturationCreate'])->name('project.facturation.create');
    Route::post('project/facturation/delete', [ProjectController::class, 'projectFacturationDelete'])->name('project.facturation.delete');
    Route::post('project/gestion/create', [ProjectController::class, 'projectGestionCreate'])->name('project.gestion.create');
    Route::post('project/gestion/update', [ProjectController::class, 'projectGestionUpdate'])->name('project.gestion.update');
    Route::get('project/controle/pdf/{id}', [ProjectController::class, 'projectControlePdf'])->name('project.controle.pdf');
    Route::post('project/rapport/file/delete', [ProjectController::class, 'projectRapportFileDelete'])->name('project.rapport.file.delete');
    Route::post('project/rapport/file/name/edit', [ProjectController::class, 'projectRapportFileNameEdit'])->name('project.rapport.file.name.edit');
    Route::post('control/sur/site/file/delete', [ProjectController::class, 'controlSurSiteFileDelete'])->name('control.sur.site.file.delete');
    Route::post('control/sur/site/file/name/edit', [ProjectController::class, 'controlSurSiteFileNameEdit'])->name('control.sur.site.file.name.edit');
    Route::post('project/facturation/file/delete', [ProjectController::class, 'projectFacturationFileDelete'])->name('project.facturation.file.delete');
    Route::post('project/facturation/file/name/edit', [ProjectController::class, 'projectFacturationleNameEdit'])->name('project.facturation.file.name.edit');
    Route::post('subvention/file/delete', [ProjectController::class, 'subventionFileDelete'])->name('subvention.file.delete');
    Route::post('subvention/file/name/edit', [ProjectController::class, 'subventionFileNameEdit'])->name('subvention.file.name.edit');
    Route::post('subvention/file2/delete', [ProjectController::class, 'subventionFile2Delete'])->name('subvention.file2.delete');
    Route::post('subvention/file2/name/edit', [ProjectController::class, 'subventionFile2NameEdit'])->name('subvention.file2.name.edit');
    Route::post('subvention/file3/delete', [ProjectController::class, 'subventionFile3Delete'])->name('subvention.file3.delete');
    Route::post('subvention/file3/name/edit', [ProjectController::class, 'subventionFile3NameEdit'])->name('subvention.file3.name.edit');
    Route::post('project/document/generator/change', [ProjectController::class, 'projectDocumentGeneratorChange'])->name('project.document.generator.change');
    Route::post('project/tax/declarant/update', [ProjectController::class, 'projectTaxDeclarantUpdate'])->name('project.tax.declarant.update');
    Route::get('project/filter/{status}', [ProjectController::class, 'projectFilter'])->name('project.filter');
    Route::post('project/pre/import', [ProjectController::class, 'projectPreImport'])->name('project.pre.import');
    Route::post('project/pre/import-manual', [ProjectController::class, 'projectPreImportManual'])->name('project.pre.import-manual');
    Route::post('projects/import', [ProjectController::class, 'projectsImport'])->name('projects.import');
    Route::post('projects/import-manual', [ProjectController::class, 'projectsImportManual'])->name('projects.import-manual');
    Route::post('project/import/regie/change', [ProjectController::class, 'projectImportRegieChange'])->name('project.import.regie.change');
    Route::post('project/modal/render', [ProjectController::class, 'projectModalRender'])->name('project.modal.render');
    Route::post("project-bulk-delete", [ProjectController::class, 'projectBulkDelete'])->name('projects.bulk.delete');
    Route::post('project/status/change/list', [ProjectController::class ,'projectStatusChangeList'])->name('project.status.change.list');
    Route::post('project/single/delete', [ProjectController::class, 'projectSingleDelete'])->name('project.single.delete');
    Route::post('project/similar/check', [ProjectController::class, 'projectSimilarCheck'])->name('project.similar.check');
    Route::post('similar/project/bulk/delete', [ProjectController::class, 'similarProjectBulkDelete'])->name('similar.project.bulk.delete');
    Route::post('project/pixel/create', [ProjectController::class, 'projectPixelCreate'])->name('project.pixel.create');



    // Question Controller
    Route::post('travaux-question-add', [QuestionController::class, 'travauxQuestionAdd'])->name('travaux.question.add');
    Route::post('travaux-question-update', [QuestionController::class, 'travauxQuestionUpdate'])->name('travaux.question.update');
    Route::post('question-input', [QuestionController::class, 'questionInput'])->name('question.input');
    Route::post('question-input-delete', [QuestionController::class, 'questionInputDelete'])->name('question.input.delete');
    Route::post('project-travaux-question-save', [QuestionController::class, 'projectTravauxQuestionSave'])->name('project.travaux.question.save');
    Route::post('lead-travaux-question-save', [QuestionController::class, 'leadTravauxQuestionSave'])->name('lead.travaux.question.save');
    Route::post('client-travaux-question-save', [QuestionController::class, 'clientTravauxQuestionSave'])->name('client.travaux.question.save');
    Route::post('prescription-chantier-note', [QuestionController::class, 'prescriptionChantierNote'])->name('prescription.chantier.note');
    Route::post('prescription-chantier-note-delete', [QuestionController::class, 'prescriptionChantierNoteDelete'])->name('prescription.chantier.note.delete');


    // Tab Controller
    Route::post('custom-tab-create', [TabController::class, 'customTabCreate'])->name('custom.tab.create');
    Route::post('custom-tab-delete', [TabController::class, 'customTabDelete'])->name('custom.tab.delete');
    Route::post('custom-tab-field-store', [TabController::class, 'customTabFieldStore'])->name('custom.tab.field.store');
    Route::post('project-custom-tab-field-data-store', [TabController::class, 'projectCustomTabFieldDataStore'])->name('project.custom.tab.field.data.store');
    Route::post('project-tab-field', [TabController::class, 'projectTabField'])->name('project.tab.field');
    Route::post('custom-tab-field-delete', [TabController::class, 'customTabFieldDelete'])->name('custom.tab.field.delete');
    Route::post('projectStaticTabUpdate', [TabController::class, 'projectStaticTabUpdate'])->name('project.static.tab.update');



    // Role Controller
    Route::get('/role', [RoleController::class, 'roleIndex'])->name('role.index')->middleware('checkRole');
    Route::post('/role-store', [RoleController::class, 'roleStore'])->name('role.store');
    Route::post('/role-update', [RoleController::class, 'roleUpdate'])->name('role.update');
    Route::post('/role-delete', [RoleController::class, 'roleDelete'])->name('role.delete');
    Route::get('/role-category', [RoleController::class, 'roleCategory'])->name('role.category.index');
    Route::post('role-category-store', [RoleController::class, 'categoryStore'])->name('role.category.store');
    Route::post('role-category-update', [RoleController::class, 'categoryUpdate'])->name('role.category.update');
    Route::post('category-permission-update', [RoleController::class, 'permissionUpdate'])->name('category.permission.update');
    Route::post('role-category-permission', [RoleController::class, 'categoryPermissionAction'])->name('role.category.permission.action');
    Route::post('role/duplicate', [RoleController::class, 'roleDuplicate'])->name('role.duplicate');
    Route::post('role/inactive', [RoleController::class, 'roleInactive'])->name('role.inactive');
    Route::post('role/active', [RoleController::class, 'roleActive'])->name('role.active');

    Route::post('/add-permission', [RoleController::class, 'addPermission'])->name('permission.add');
    Route::post('/remove-permission', [RoleController::class, 'removePermission'])->name('permission.remove');
    Route::post('permission-action', [RoleController::class, 'permissionAction'])->name('permission.action');
    Route::post('role-permission-action', [RoleController::class, 'rolePermissionAction'])->name('role.permission.action');
    Route::post('user-permission', [RoleController::class, 'userPermission'])->name('user.permission');

    // Company Permission
    Route::post('/add-company-permission', [RoleController::class, 'addCompanyPermission'])->name('company.permission.add');
    Route::post('/remove-company-permission', [RoleController::class, 'removeCompanyPermission'])->name('company.permission.remove');
    Route::post('/search-company-permission', [RoleController::class, 'searchCompanyPermission'])->name('company.permission.search');

    // Operation Controller
    Route::post('scale-create', [OperationController::class, 'scaleCreate'])->name('scale.create');
    Route::post('scale-update', [OperationController::class, 'scaleUpdate'])->name('scale.update');
    Route::post('scale-delete', [OperationController::class, 'scaleDelete'])->name('scale.delete');
    Route::post('delegate-create', [OperationController::class, 'delegateCreate'])->name('delegate.create');
    Route::post('delegate-update', [OperationController::class, 'delegateUpdate'])->name('delegate.update');
    Route::post('delegate-delete', [OperationController::class, 'delegateDelete'])->name('delegate.delete');
    Route::post('deal-create', [OperationController::class, 'dealCreate'])->name('deal.create');
    Route::post('deal-update', [OperationController::class, 'dealUpdate'])->name('deal.update');
    Route::post('deal-delete', [OperationController::class, 'dealDelete'])->name('deal.delete');
    Route::post('installer-create', [OperationController::class, 'installerCreate'])->name('installer.create');
    Route::post('installer-update', [OperationController::class, 'installerUpdate'])->name('installer.update');
    Route::post('installer-delete', [OperationController::class, 'installerDelete'])->name('installer.delete');
    Route::post('amo-create', [OperationController::class, 'amoCreate'])->name('amo.create');
    Route::post('amo-update', [OperationController::class, 'amoUpdate'])->name('amo.update');
    Route::post('amo-delete', [OperationController::class, 'amoDelete'])->name('amo.delete');
    Route::post('agent-create', [OperationController::class, 'agentCreate'])->name('agent.create');
    Route::post('agent-update', [OperationController::class, 'agentUpdate'])->name('agent.update');
    Route::post('agent-delete', [OperationController::class, 'agentDelete'])->name('agent.delete');
    Route::post('auditor-create', [OperationController::class, 'auditorCreate'])->name('auditor.create');
    Route::post('auditor-update', [OperationController::class, 'auditorUpdate'])->name('auditor.update');
    Route::post('auditor-delete', [OperationController::class, 'auditorDelete'])->name('auditor.delete');
    Route::post('area-create', [OperationController::class, 'areaCreate'])->name('area.create');
    Route::post('area-update', [OperationController::class, 'areaUpdate'])->name('area.update');
    Route::post('area-delete', [OperationController::class, 'areaDelete'])->name('area.delete');
    Route::post('area-color-update', [OperationController::class, 'areaColorUpdate'])->name('area.color.update');
    Route::post('control-create', [OperationController::class, 'controlCreate'])->name('control.create');
    Route::post('control-update', [OperationController::class, 'controlUpdate'])->name('control.update');
    Route::post('control-delete', [OperationController::class, 'controlDelete'])->name('control.delete');


    // Catalogue Controller
    Route::post('brand-create', [CatalogueController::class, 'brandCreate'])->name('brand.create');
    Route::post('brand-update', [CatalogueController::class, 'brandUpdate'])->name('brand.update');
    Route::post('brand-delete', [CatalogueController::class, 'brandDelete'])->name('brand.delete');
    Route::post('benefit-create', [CatalogueController::class, 'benefitCreate'])->name('benefit.create');
    Route::post('benefit-update', [CatalogueController::class, 'benefitUpdate'])->name('benefit.update');
    Route::post('benefit-delete', [CatalogueController::class, 'benefitDelete'])->name('benefit.delete');
    Route::post('fournesser-create', [CatalogueController::class, 'fournesserCreate'])->name('fournesser.create');
    Route::post('fournesser-update', [CatalogueController::class, 'fournesserUpdate'])->name('fournesser.update');
    Route::post('fournesser-delete', [CatalogueController::class, 'fournesserDelete'])->name('fournesser.delete');
    Route::post('client_company-create', [CatalogueController::class, 'client_companyCreate'])->name('client_company.create');
    Route::post('client_company-update', [CatalogueController::class, 'client_companyUpdate'])->name('client_company.update');
    Route::post('client_company-delete', [CatalogueController::class, 'client_companyDelete'])->name('client_company.delete');

    // Lead Custom Field Controller
    Route::post('lead/custom/field', [LeadCustomFieldController::class, 'leadCustomField'])->name('lead.custom.field');
    Route::post('lead-custom-field-store', [LeadCustomFieldController::class, 'leadCustomFieldStore'])->name('lead.custom.field.store');
    Route::post('lead-custom-field-delete', [LeadCustomFieldController::class, 'leadCustomFieldDelete'])->name('lead.custom.field.delete');
    Route::post('lead-custom-field-data-store', [LeadCustomFieldController::class, 'leadCustomFieldDataStore'])->name('lead.custom.field.data.store');

    // Document ControlController
    Route::post('document-control-create', [DocumentControlController::class, 'controlCreate'])->name('document.control.create');
    Route::post('document-control-delete', [DocumentControlController::class, 'controlDelete'])->name('document.control.delete');
    Route::post('document-control-update', [DocumentControlController::class, 'controlUpdate'])->name('document.control.update');




    // Travaux Tag Controller
    Route::post('travaux-tag-create', [TravauxTagController::class, 'tagCreate'])->name('travaux.tag.create');
    Route::post('travaux-tag-delete', [TravauxTagController::class, 'tagDelete'])->name('travaux.tag.delete');
    Route::post('travaux-tag-update', [TravauxTagController::class, 'tagUpdate'])->name('travaux.tag.update');





    // RegieController
    Route::post('user-regie-add', [RegieController::class, 'userRegieAdd'])->name('user.regie.add');
    Route::post('user-regie-destroy', [RegieController::class, 'userRegieDestroy'])->name('user.regie.destroy');
    Route::post('regie-user-list', [RegieController::class, 'regieUserList'])->name('regie.user.list');

    // Comment Category Controller
    Route::post('comment-category-add', [CommentCategoryController::class, 'categoryAdd'])->name('comment.category.add');
    Route::post('comment-category-delete', [CommentCategoryController::class, 'categoryDelete'])->name('comment.category.delete');

    // Ticket Controller
    Route::get('tickets', [TicketController::class, 'index'])->name('ticketing.index');
    Route::get('tickets/dashboard', [TicketController::class, 'dashboard'])->name('ticket.dashboard');
    Route::post('ticket-store', [TicketController::class, 'store'])->name('ticket.store');
    Route::post('ticket-assign-update', [TicketController::class, 'assignUpdate'])->name('ticket.assign.update');
    Route::post('ticket-message-store', [TicketController::class, 'messageStore'])->name('ticket.message.store');
    Route::post('ticket-sidebar-change', [TicketController::class, 'sidebarChange'])->name('ticket.sidebar.change');
    Route::post('ticket-closed', [TicketController::class, 'ticketClosed'])->name('ticket.closed');
    Route::post('ticket-date-filter', [TicketController::class, 'ticketDateFilter'])->name('ticket.date.filter');
    Route::post('ticket-date-filter-clear', [TicketController::class, 'ticketDateFilterClear'])->name('ticket.date.filter.clear');
    Route::post('ticket-type-chart-filter', [TicketController::class, 'ticketTypeChartFilter'])->name('ticket.type.chart.filter');
    Route::post('ticket-status-chart-filter', [TicketController::class, 'ticketStatusChartFilter'])->name('ticket.status.chart.filter');
    Route::get('tickets-details/{id}', [TicketController::class, 'ticketsDetails'])->name('tickets.details');
    Route::get('tickets/filter', [TicketController::class, 'ticketFilter'])->name('ticket.filter');
    Route::post('ticket/create/project/change', [TicketController::class, 'ticketCreateProjectChange'])->name('ticket.create.project.change');
    Route::post('ticket/create/type/change', [TicketController::class, 'ticketCreateTypeChange'])->name('ticket.create.type.change');
    Route::post('ticket/status/update', [TicketController::class, 'ticketStatusUpdate'])->name('ticket.status.update');
    Route::post('ticket/assign/list/filter', [TicketController::class, 'assignListFilter'])->name('ticket.assign.list.filter');
    Route::post('ticket/delete', [TicketController::class, 'ticketDelete'])->name('ticket.delete');
    Route::post('ticket/message/delete', [TicketController::class, 'ticketMessageDelete'])->name('ticket.message.delete');


    // Register New User With Super Admin
    // Super Admin Controller
    Route::get('/register', [SuperAdminController::class, 'registerIndex'])->name('user.register.index')->middleware('checkRole');
    Route::post('/register-user', [SuperAdminController::class, 'RegisterStore'])->name('user.register');

    // Scraper Controller
    Route::get('/scraper', [ScraperController::class, 'index'])->name('scraper.index');

    // NotionController
    Route::get('/notion', [NotionController::class, 'index'])->name('notion.index')->middleware('checkRole');
    Route::post('notion/store', [NotionController::class,'store'])->name('notion.store');
    Route::post('notion/update', [NotionController::class, 'update'])->name('notion.update');
    Route::post('notion/delete', [NotionController::class, 'notionDelete'])->name('notion.delete');
    Route::post('notion/data/store', [NotionController::class, 'dataStore'])->name('notion.data.store');
    Route::post('notion/profile/update', [NotionController::class, 'profileUpdate'])->name('notion.profile.update');
    Route::post('notion/cover/update', [NotionController::class, 'coverUpdate'])->name('notion.cover.update');
    Route::post('notion/title/update', [NotionController::class, 'titleUpdate'])->name('notion.title.update');
    Route::get('notion/details/{id}', [NotionController::class, 'notionDetails'])->name('notion.details');
    Route::post('notion/file/upload', [NotionController::class, 'notionFileUpload'])->name('notion.file.upload');
    Route::post('/uploadFile', [NotionController::class, 'uploadFile'])->name('notion.uploadFile');
    Route::post('/notion/assign/update', [NotionController::class, 'notionAssignUpdate'])->name('notion.assign.update');
    Route::post('notion/category/change', [NotionController::class, 'notionCategoryChange'])->name('notion.category.change');
    Route::post('notion/category/filter', [NotionController::class, 'notionCategoryFilter'])->name('notion.category.filter');
    Route::post('notion/subcategory/filter', [NotionController::class, 'notionSubcategoryFilter'])->name('notion.subcategory.filter');
    Route::post('notion/load/more', [NotionController::class, 'notionLoadMore'])->name('notion.load.more');

    // Quality Control Controller
    Route::post('quality-control-create', [QualityControlController::class, 'qualityControlCreate'])->name('quality.control.create');
    Route::post('quality-control-update', [QualityControlController::class, 'qualityControlUpdate'])->name('quality.control.update');
    Route::post('quality-control-delete', [QualityControlController::class, 'qualityControlDelete'])->name('quality.control.delete');

    // Notion Category Controller
    Route::post('notion-category-create', [NotionCategoryController::class, 'notionCategoryCreate'])->name('notion.category.create');
    Route::post('notion-category-update', [NotionCategoryController::class, 'notionCategoryUpdate'])->name('notion.category.update');
    Route::post('notion-category-delete', [NotionCategoryController::class, 'notionCategoryDelete'])->name('notion.category.delete');

    // Notion Sub Category Controller
    Route::post('notion-subcategory-create', [NotionSubCategoryController::class, 'notionSubCategoryCreate'])->name('notion.subcategory.create');
    Route::post('notion-subcategory-update', [NotionSubCategoryController::class, 'notionSubCategoryUpdate'])->name('notion.subcategory.update');
    Route::post('notion-subcategory-delete', [NotionSubCategoryController::class, 'notionSubCategoryDelete'])->name('notion.subcategory.delete');

    // Lead Sub Status Controller
    Route::post('lead-sub-status-create', [LeadSubStatusController::class, 'leadSubStatusCreate'])->name('lead.sub-status.create');
    Route::post('lead-sub-status-update', [LeadSubStatusController::class, 'leadSubStatusUpdate'])->name('lead.sub-status.update');
    Route::post('lead-sub-status-delete', [LeadSubStatusController::class, 'leadSubStatusDelete'])->name('lead.sub-status.delete');

    // project Sub Status Controller
    Route::post('project-sub-status-create', [ProjectSubStatusController::class, 'projectSubStatusCreate'])->name('project.sub-status.create');
    Route::post('project-sub-status-update', [ProjectSubStatusController::class, 'projectSubStatusUpdate'])->name('project.sub-status.update');
    Route::post('project-sub-status-delete', [ProjectSubStatusController::class, 'projectSubStatusDelete'])->name('project.sub-status.delete');

    // client Sub Status Controller
    Route::post('client-sub-status-create', [ClientSubStatusController::class, 'clientSubStatusCreate'])->name('client.sub-status.create');
    Route::post('client-sub-status-update', [ClientSubStatusController::class, 'clientSubStatusUpdate'])->name('client.sub-status.update');
    Route::post('client-sub-status-delete', [ClientSubStatusController::class, 'clientSubStatusDelete'])->name('client.sub-status.delete');

    // Heating Model Controller
    Route::post('heating-mode-create', [HeatingModeController::class, 'heatingModeCreate'])->name('heating.mode.create');
    Route::post('heating-mode-update', [HeatingModeController::class, 'heatingModeUpdate'])->name('heating.mode.update');
    Route::post('heating-mode-delete', [HeatingModeController::class, 'heatingModeDelete'])->name('heating.mode.delete');

    // BaremesTravauxTagController
    Route::post('bareme-travaux-tag-create', [BaremeTravauxTagController::class, 'create'])->name('bareme.travaux.tag.create');
    Route::post('bareme-travaux-tag-update', [BaremeTravauxTagController::class, 'update'])->name('bareme.travaux.tag.update');
    Route::post('bareme-travaux-tag-delete', [BaremeTravauxTagController::class, 'delete'])->name('bareme.travaux.tag.delete');

    // Campagnetype Model Controller
    Route::post('campagne-type-create', [CampagnetypeController::class, 'campagneTypeCreate'])->name('campagne.type.create');
    Route::post('campagne-type-update', [CampagnetypeController::class, 'campagneTypeUpdate'])->name('campagne.type.update');
    Route::post('campagne-type-delete', [CampagnetypeController::class, 'campagneTypeDelete'])->name('campagne.type.delete');

    // StatusPlanningInterventionController Controller
    Route::post('status-planning-intervention-create', [StatusPlanningInterventionController::class, 'statusPlanningInterventionCreate'])->name('status.planning.intervention.create');
    Route::post('status-planning-intervention-update', [StatusPlanningInterventionController::class, 'statusPlanningInterventionUpdate'])->name('status.planning.intervention.update');
    Route::post('status-planning-intervention-delete', [StatusPlanningInterventionController::class, 'statusPlanningInterventionDelete'])->name('status.planning.intervention.delete');

    // ProjectDeadReasonController Controller
    Route::post('project-ko-reason-create', [ProjectDeadReasonController::class, 'projectKOReasonCreate'])->name('project.ko.reason.create');
    Route::post('project-ko-reason-update', [ProjectDeadReasonController::class, 'projectKOReasonUpdate'])->name('project.ko.reason.update');
    Route::post('project-ko-reason-delete', [ProjectDeadReasonController::class, 'projectKOReasonDelete'])->name('project.ko.reason.delete');

    // ProjectReflectionReasonController Controller
    Route::post('project-reflection-reason-create', [ProjectReflectionReasonController::class, 'projectReflectionAReasonCreate'])->name('project.reflection.reason.create');
    Route::post('project-reflection-reason-update', [ProjectReflectionReasonController::class, 'projectReflectionAReasonUpdate'])->name('project.reflection.reason.update');
    Route::post('project-reflection-reason-delete', [ProjectReflectionReasonController::class, 'projectReflectionAReasonDelete'])->name('project.reflection.reason.delete');

    // StatusPlanningInterventionController Controller
    Route::post('project-control-photo-create', [ProjectControlPhotoController::class, 'projectControlPhotoCreate'])->name('project.control.photo.create');
    Route::post('project-control-photo-update', [ProjectControlPhotoController::class, 'projectControlPhotoUpdate'])->name('project.control.photo.update');
    Route::post('project-control-photo-delete', [ProjectControlPhotoController::class, 'projectControlPhotoDelete'])->name('project.control.photo.delete');

    // StatutMaprimerenovController
    Route::post('statut-maprimerenov-create', [StatutMaprimerenovController::class, 'statutMaprimerenovCreate'])->name('statut.maprimerenov.create');
    Route::post('statut-maprimerenov-update', [StatutMaprimerenovController::class, 'statutMaprimerenovUpdate'])->name('statut.maprimerenov.update');
    Route::post('statut-maprimerenov-delete', [StatutMaprimerenovController::class, 'statutMaprimerenovDelete'])->name('statut.maprimerenov.delete');

    // StatutMaprimerenovController
    Route::post('mandataire-maprimerenov-create', [MandataireMaprimerenovController::class, 'mandataireMaprimerenovCreate'])->name('mandataire.maprimerenov.create');
    Route::post('mandataire-maprimerenov-update', [MandataireMaprimerenovController::class, 'mandataireMaprimerenovUpdate'])->name('mandataire.maprimerenov.update');
    Route::post('mandataire-maprimerenov-delete', [MandataireMaprimerenovController::class, 'mandataireMaprimerenovDelete'])->name('mandataire.maprimerenov.delete');

    // StatutMaprimerenovController
    Route::post('entrepreises-create', [EntrepriseController::class, 'entrepreisesCreate'])->name('entrepreises.create');
    Route::post('entrepreises-update', [EntrepriseController::class, 'entrepreisesUpdate'])->name('entrepreises.update');
    Route::post('entrepreises-delete', [EntrepriseController::class, 'entrepreisesDelete'])->name('entrepreises.delete');

    // Reject Reason Controller
    Route::post('reject-reason-create', [RejectReasonController::class, 'rejectReasonCreate'])->name('reject.reason.create');
    Route::post('reject-reason-update', [RejectReasonController::class, 'rejectReasonUpdate'])->name('reject.reason.update');
    Route::post('reject-reason-delete', [RejectReasonController::class, 'rejectReasonDelete'])->name('reject.reason.delete');

    // Reject Reason Controller
    Route::post('type-fournisseur-create', [FournisseurTypeController::class, 'typeFournisseurCreate'])->name('type.fournisseur.create');
    Route::post('type-fournisseur-update', [FournisseurTypeController::class, 'typeFournisseurUpdate'])->name('type.fournisseur.update');
    Route::post('type-fournisseur-delete', [FournisseurTypeController::class, 'typeFournisseurDelete'])->name('type.fournisseur.delete');

    // Pagination number controller
    Route::post('pagination-number-change', [PaginationNumberController::class, 'paginationNumberChange'])->name('pagination.number.change');

    // Personal Note Controller
    Route::post('personal/note/store', [PersonalNoteController::class, 'store'])->name('personal.note.store');
    Route::post('personal/note/delete', [PersonalNoteController::class, 'delete'])->name('personal.note.delete');

    // New Task Controller
    Route::post('new/task/store', [NewTaskController::class, 'store'])->name('new.task.store');
    Route::post('new/task/project/change', [NewTaskController::class, 'projectChange'])->name('new.task.project.change');
    Route::post('new/task/update', [NewTaskController::class, 'update'])->name('new.task.update');
    Route::post('new/task/type/change', [NewTaskController::class, 'typeChange'])->name('new.task.type.change');
    Route::post('new/event/type/change', [NewTaskController::class, 'eventTypeChange'])->name('new.event.type.change');
    Route::post('new/event/type/change2', [NewTaskController::class, 'eventTypeChange2'])->name('new.event.type.change2');

    // NatureMouvementController Controller
    Route::post('nature-mouvement-create', [NatureMouvementController::class, 'natureMouvementCreate'])->name('nature.mouvement.create');
    Route::post('nature-mouvement-update', [NatureMouvementController::class, 'natureMouvementUpdate'])->name('nature.mouvement.update');
    Route::post('nature-mouvement-delete', [NatureMouvementController::class, 'natureMouvementDelete'])->name('nature.mouvement.delete');

    // EntrepotController Controller
    Route::post('entrepot-create', [EntrepotController::class, 'entrepotCreate'])->name('entrepot.create');
    Route::post('entrepot-update', [EntrepotController::class, 'entrepotUpdate'])->name('entrepot.update');
    Route::post('entrepot-delete', [EntrepotController::class, 'entrepotDelete'])->name('entrepot.delete');

    // PersonnelAutoriseReceptionController Controller
    Route::post('personnel-autorise-reception-create', [PersonnelAutoriseReceptionController::class, 'personnelAutoriseReceptionCreate'])->name('personnel.autorise.reception.create');
    Route::post('personnel-autorise-reception-update', [PersonnelAutoriseReceptionController::class, 'personnelAutoriseReceptionUpdate'])->name('personnel.autorise.reception.update');
    Route::post('personnel-autorise-reception-delete', [PersonnelAutoriseReceptionController::class, 'personnelAutoriseReceptionDelete'])->name('personnel.autorise.reception.delete');

    // StatutCommandeController Controller
    Route::post('statut-commande-create', [StatutCommandeController::class, 'statutCommandeCreate'])->name('statut.commande.create');
    Route::post('statut-commande-update', [StatutCommandeController::class, 'statutCommandeUpdate'])->name('statut.commande.update');
    Route::post('statut-commande-delete', [StatutCommandeController::class, 'statutCommandeDelete'])->name('statut.commande.delete');

    // FournisseurMaterielController Controller
    Route::post('fournisseur-materiel-create', [FournisseurMaterielController::class, 'fournisseurMaterielCreate'])->name('fournisseur.materiel.create');
    Route::post('fournisseur-materiel-update', [FournisseurMaterielController::class, 'fournisseurMaterielUpdate'])->name('fournisseur.materiel.update');
    Route::post('fournisseur-materiel-delete', [FournisseurMaterielController::class, 'fournisseurMaterielDelete'])->name('fournisseur.materiel.delete');

    // TypeDeLivraisonController Controller
    Route::post('type-de-livraison-create', [TypeDeLivraisonController::class, 'typeDeLivraisonCreate'])->name('type.de.livraison.create');
    Route::post('type-de-livraison-update', [TypeDeLivraisonController::class, 'typeDeLivraisonUpdate'])->name('type.de.livraison.update');
    Route::post('type-de-livraison-delete', [TypeDeLivraisonController::class, 'typeDeLivraisonDelete'])->name('type.de.livraison.delete');

});

// Zapier
Route::post('/zapier-leads', [LeadCustomFieldController::class, 'zapierLeadStore'])->name('zap.store');

// MPR
Route::post('/mpr', [ScraperController::class, 'mpr'])->name('mpr.index');
Route::post('mpr/info/update', [ScraperController::class, 'mprInfoUpdate'])->name('mpr.info.update');

Route::get('locale/{locale}', function ($locale) {
    Session::put('locale', $locale);
    return redirect()->back();
})->name('localization');





