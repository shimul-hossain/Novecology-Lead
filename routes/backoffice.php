<?php

use App\Http\Controllers\AuditEnergetiqueController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BannerFormController;
use App\Http\Controllers\BackOffice\AdminController;
use App\Http\Controllers\BackOffice\BannerController;
use App\Http\Controllers\BackOffice\GeneralSettingController;
use App\Http\Controllers\BackOffice\HistoryController;
use App\Http\Controllers\BackOffice\NewContactController;
use App\Http\Controllers\BackOffice\OfferController;
use App\Http\Controllers\BackOffice\ReferenceController;
use App\Http\Controllers\BackOffice\RenovationController;
use App\Http\Controllers\BackOffice\ReviewController;
use App\Http\Controllers\BackOffice\ServiceFeatureController;
use App\Http\Controllers\BackOffice\SupportController;
use App\Http\Controllers\BackOffice\TestimonialController;
use App\Http\Controllers\BackOffice\ValueController;
use App\Http\Controllers\CookiePolicyController;
use App\Http\Controllers\DroitOppositionController;
use App\Http\Controllers\LegalNoticeController;
use App\Http\Controllers\MediathequeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\BandeauInformationController;
use App\Http\Controllers\ThemeSettingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix' => 'testing'],function(){
    Route::get('/', [HomeController::class, 'index'])->name('new.home');
    Route::get('/audit-energetique', [HomeController::class, 'auditEnergetique'])->name('audit.energetique');
    Route::get('/estimer-vos-aides', [HomeController::class, 'estimerVosAides'])->name('estimer.vos.aides');
    Route::get('/nos-conseils', [HomeController::class, 'nosConseils'])->name('nos.conseils');
    Route::get('/nos-conseils/{id}/details', [HomeController::class, 'nosConseilsDetails'])->name('nos.conseils.details');
    Route::get('/nos-offres', [HomeController::class, 'nosOffres'])->name('nos.offres');
    Route::get('/nos-offres/{id}/details', [HomeController::class, 'nosFffresDetails'])->name('nos.offres.details');
    Route::get('/nos-references', [HomeController::class, 'nosReferences'])->name('nos.references');
    Route::get('/nos-valeurs', [HomeController::class, 'nosValeurs'])->name('nos.valeurs');
    Route::get('/notre-histoire', [HomeController::class, 'notreHistoire'])->name('notre.histoire');
    Route::get('/nous-contacter', [HomeController::class, 'nousContacter'])->name('nous.contacter');
    Route::get('/prendre-rdv', [HomeController::class, 'prendreRdv'])->name('prendre.rdv');
    Route::get('/temoignages-clients', [HomeController::class, 'temoignagesClients'])->name('temoignages.clients');
    Route::get('/droit-d-opposition', [HomeController::class, 'droitOpposition'])->name('droit.opposition');
    Route::get('/mentions-légales', [HomeController::class, 'legalNotice'])->name('legal.notice');
    Route::get('/politique-de-cookies', [HomeController::class, 'cookiePolicy'])->name('cookie.policy');
    Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy.policy');
    Route::get('/bandeau-information', [HomeController::class, 'bandeauInformation'])->name('bandeau-information');
    // BannerFormController
    Route::post('banner/form/store', [BannerFormController::class, 'store'])->name('banner.form.store');
});
Route::get('/mediatheque', [MediathequeController::class, 'index'])->name('mediatheque.index');
Route::group(['prefix' => 'backoffice','middleware' => ['auth','backofficeAccess']],function(){

    Route::get('/blank', [AdminController::class, 'blank']);
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('backoffice.dashboard');

    // Banner Controller 
    Route::get('banners', [BannerController::class, 'index'])->name('backoffice.banner.index');
    Route::get('banners/create', [BannerController::class, 'create'])->name('backoffice.banner.create');
    Route::post('banners/store', [BannerController::class, 'store'])->name('backoffice.banner.store');
    Route::post('banner/delete', [BannerController::class, 'delete'])->name('backoffice.banner.delete');
    Route::get('banner/edit/{id}', [BannerController::class, 'edit'])->name('backoffice.banner.edit');
    Route::post('banners/update', [BannerController::class, 'update'])->name('backoffice.banner.update');
    Route::post('banner/order/update', [BannerController::class, 'orderUpdate'])->name('banner.order.update');


    // Banner Form controler
    Route::get('bannerform', [BannerFormController::class, 'index'])->name('banner.form.index');
    Route::post('banner/form/delete', [BannerFormController::class, 'delete'])->name('banner.form.delete');
    Route::post('banner/form/all/delete', [BannerFormController::class, 'deleteAll'])->name('banner.form.all.delete');
    Route::post('bannerform/bulk/download', [BannerFormController::class, 'bannerformBulkDownload'])->name('bannerform.bulk.download');
    Route::post('bannerform/bulk/delete', [BannerFormController::class, 'bannerformBulkDelete'])->name('bannerform.bulk.delete');

    // Service Feature Controller 
    Route::get('feature', [ServiceFeatureController::class, 'index'])->name('backoffice.feature.index');
    Route::post('feature.store', [ServiceFeatureController::class, 'store'])->name('backoffice.feature.store');
    Route::post('feature.update', [ServiceFeatureController::class, 'update'])->name('backoffice.feature.update');
    Route::post('feature.delete', [ServiceFeatureController::class, 'delete'])->name('backoffice.feature.delete');

    // Offer Controller
    Route::get('offer', [OfferController::class, 'index'])->name('backoffice.offer.index');
    Route::get('offer/create', [OfferController::class, 'create'])->name('backoffice.offer.create');
    Route::post('offer/store', [OfferController::class, 'store'])->name('backoffice.offer.store'); 
    Route::get('offer/edit/{id}', [OfferController::class, 'edit'])->name('backoffice.offer.edit');
    Route::post('offer/update', [OfferController::class, 'update'])->name('backoffice.offer.update');
    Route::post('offer/delete', [OfferController::class, 'delete'])->name('backoffice.offer.delete');
    Route::get('offer/category', [OfferController::class, 'category'])->name('backoffice.offer.category');
    Route::post('offer/category/store', [OfferController::class, 'categoryStore'])->name('backoffice.offer.category.store');
    Route::post('offer/category/update', [OfferController::class, 'categoryUpdate'])->name('backoffice.offer.category.update');
    Route::post('offer/category/delete', [OfferController::class, 'categoryDelete'])->name('backoffice.offer.category.delete');


    // Support Controller
    Route::get('support/', [SupportController::class, 'index'])->name('backoffice.support.index');
    Route::post('support/category/store', [SupportController::class, 'store'])->name('backoffice.support.store');
    Route::post('support/category/update', [SupportController::class, 'update'])->name('backoffice.support.update');
    Route::post('support/category/delete', [SupportController::class, 'delete'])->name('backoffice.support.delete');
    Route::post('support/info/update', [SupportController::class, 'infoUpdate'])->name('backoffice.support.info.update');


    // Renovation Controller
    Route::get('renovation/', [RenovationController::class, 'index'])->name('backoffice.renovation.index');
    Route::post('renovation/category/store', [RenovationController::class, 'store'])->name('backoffice.renovation.store');
    Route::post('renovation/category/update', [RenovationController::class, 'update'])->name('backoffice.renovation.update');
    Route::post('renovation/category/delete', [RenovationController::class, 'delete'])->name('backoffice.renovation.delete');
    Route::post('renovation/info/update', [RenovationController::class, 'infoUpdate'])->name('backoffice.renovation.info.update');

    // Testimonial Controller
    Route::get('testimonial', [TestimonialController::class, 'index'])->name('backoffice.testimonial.index');
    Route::get('testimonial/create', [TestimonialController::class, 'create'])->name('backoffice.testimonial.create');
    Route::post('testimonial/store', [TestimonialController::class, 'store'])->name('backoffice.testimonial.store'); 
    Route::get('testimonial/edit/{id}', [TestimonialController::class, 'edit'])->name('backoffice.testimonial.edit');
    Route::post('testimonial/update', [TestimonialController::class, 'update'])->name('backoffice.testimonial.update');
    Route::post('testimonial/delete', [TestimonialController::class, 'delete'])->name('backoffice.testimonial.delete');
    Route::get('testimonial/info', [TestimonialController::class, 'info'])->name('backoffice.testimonial.info'); 
    Route::post('testimonial/info/update', [TestimonialController::class, 'infoUpdate'])->name('backoffice.testimonial.info.update'); 

    // News Controller 
    Route::get('news', [NewsController::class, 'index'])->name('backoffice.news.index');
    Route::get('news/create', [NewsController::class, 'create'])->name('backoffice.news.create');
    Route::post('news/store', [NewsController::class, 'store'])->name('backoffice.news.store'); 
    Route::get('news/edit/{id}', [NewsController::class, 'edit'])->name('backoffice.news.edit');
    Route::post('news/update', [NewsController::class, 'update'])->name('backoffice.news.update');
    Route::post('news/delete', [NewsController::class, 'delete'])->name('backoffice.news.delete');
    Route::get('news/category', [NewsController::class, 'category'])->name('backoffice.news.category');
    Route::post('news/category/store', [NewsController::class, 'categoryStore'])->name('backoffice.news.category.store');
    Route::post('news/category/update', [NewsController::class, 'categoryUpdate'])->name('backoffice.news.category.update');
    Route::post('news/category/delete', [NewsController::class, 'categoryDelete'])->name('backoffice.news.category.delete');
    Route::get('news/info', [NewsController::class, 'info'])->name('backoffice.news.info'); 
    Route::post('news/info/update', [NewsController::class, 'infoUpdate'])->name('backoffice.news.info.update'); 

    // Audit Energetique Controller
    Route::get('audit-energetique', [AuditEnergetiqueController::class, 'index'])->name('backoffice.audit-energetique.index');
    Route::post('audit-energetique/update', [AuditEnergetiqueController::class, 'update'])->name('backoffice.audit-energetique.update');


    // History Controller
    Route::get('history', [HistoryController::class, 'index'])->name('backoffice.history.index');
    Route::post('history/update', [HistoryController::class, 'update'])->name('backoffice.history.update');

    // Value Controller
    Route::get('value', [ValueController::class, 'index'])->name('backoffice.value.index');
    Route::post('value/update', [ValueController::class, 'update'])->name('backoffice.value.update');

    
    // Reference Controller 
    Route::get('reference', [ReferenceController::class, 'index'])->name('backoffice.reference.index');
    Route::get('reference/create', [ReferenceController::class, 'create'])->name('backoffice.reference.create');
    Route::post('reference/store', [ReferenceController::class, 'store'])->name('backoffice.reference.store'); 
    Route::get('reference/edit/{id}', [ReferenceController::class, 'edit'])->name('backoffice.reference.edit');
    Route::post('reference/update', [ReferenceController::class, 'update'])->name('backoffice.reference.update');
    Route::post('reference/delete', [ReferenceController::class, 'delete'])->name('backoffice.reference.delete');
    Route::get('reference/category', [ReferenceController::class, 'category'])->name('backoffice.reference.category');
    Route::post('reference/category/store', [ReferenceController::class, 'categoryStore'])->name('backoffice.reference.category.store');
    Route::post('reference/category/update', [ReferenceController::class, 'categoryUpdate'])->name('backoffice.reference.category.update');
    Route::post('reference/category/delete', [ReferenceController::class, 'categoryDelete'])->name('backoffice.reference.category.delete');
    Route::get('reference/info', [ReferenceController::class, 'info'])->name('backoffice.reference.info'); 
    Route::post('reference/info/update', [ReferenceController::class, 'infoUpdate'])->name('backoffice.reference.info.update'); 

    // New Contact Controller
    Route::get('contact', [NewContactController::class, 'index'])->name('backoffice.contact.index');
    Route::post('contact/update', [NewContactController::class, 'update'])->name('backoffice.contact.update');

    // ThemeSettingController
   Route::get('theme-color', [ThemeSettingController::class, 'color'])->name('theme.color');
   Route::get('theme-toggle', [ThemeSettingController::class, 'toggle'])->name('theme.toggle');

    // General Setting Controller
    Route::get('settings', [GeneralSettingController::class, 'index'])->name('backoffice.settings.index');
    Route::post('settings/update', [GeneralSettingController::class, 'update'])->name('backoffice.settings.update');


    // Mediatheque Controller
    Route::get('/mediatheque', [MediathequeController::class, 'adminIndex'])->name('admin.mediatheque.index');
    Route::get('mediatheque/create', [MediathequeController::class, 'create'])->name('admin.mediatheque.create');
    Route::post('mediatheque/store', [MediathequeController::class, 'store'])->name('admin.mediatheque.store');
    Route::get('mediatheque/edit/{id}', [MediathequeController::class, 'edit'])->name('admin.mediatheque.edit');
    Route::post('mediatheque/update', [MediathequeController::class, 'update'])->name('admin.mediatheque.update');
    Route::post('mediatheque/delete', [MediathequeController::class, 'delete'])->name('admin.mediatheque.delete');

    Route::get('/mediatheque/category', [MediathequeController::class,  'categoryIndex'])->name('admin.mediatheque.category.index');
    Route::get('mediatheque/category/create', [MediathequeController::class, 'categoryCreate'])->name('admin.mediatheque.category.create');
    Route::post('mediatheque/category/store', [MediathequeController::class, 'categoryStore'])->name('admin.mediatheque.category.store');
    Route::get('mediatheque/category/edit/{id}', [MediathequeController::class, 'categoryEdit'])->name('admin.mediatheque.category.edit');
    Route::post('mediatheque/category/update', [MediathequeController::class, 'categoryUpdate'])->name('admin.mediatheque.category.update');
    Route::post('mediatheque/category/delete', [MediathequeController::class, 'categoryDelete'])->name('admin.mediatheque.category.delete');

    // Review Controller 
    Route::get('review', [ReviewController::class, 'index'])->name('review.index');
    Route::post('review/status/change', [ReviewController::class, 'statusChange'])->name('review.status.change');

    // Droit Opposition Controller
    Route::get('/droit-opposition', [DroitOppositionController::class, 'index'])->name('droit.opposition.index');
    Route::post('/droit-opposition/update', [DroitOppositionController::class, 'update'])->name('droit.opposition.update');

    // Droit Cookie Policy
    Route::get('/cookie-policy', [CookiePolicyController::class, 'index'])->name('cookie.policy.index');
    Route::post('/cookie-policy/update', [CookiePolicyController::class, 'update'])->name('cookie.policy.update');

    // Droit Legal Notice
    Route::get('/legal-notice', [LegalNoticeController::class, 'index'])->name('legal.notice.index');
    Route::post('/legal-notice/update', [LegalNoticeController::class, 'update'])->name('legal.notice.update');

    // Droit Privacy Policy
    Route::get('/privacy-policy', [PrivacyPolicyController::class, 'index'])->name('privacy.policy.index');
    Route::post('/privacy-policy/update', [PrivacyPolicyController::class, 'update'])->name('privacy.policy.update');

    // Droit Privacy Policy
    Route::get('/bandeau-information', [BandeauInformationController::class, 'index'])->name('bandeau-information.index');
    Route::post('/bandeau-information/update', [BandeauInformationController::class, 'update'])->name('bandeau-information.update');
    

});




