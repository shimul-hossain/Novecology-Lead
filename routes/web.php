<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdviceAndGrantsController;
use App\Http\Controllers\AdviceDetailController;
use App\Http\Controllers\AdviceFaqController;
use App\Http\Controllers\AdviceReasonController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BannerFormController;
use App\Http\Controllers\BienvenueController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\ClintOpinionController;
use App\Http\Controllers\ColorSettingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\CookieController;
use App\Http\Controllers\CRM\CrmHomeController;
use App\Http\Controllers\CRM\ProfileController;
use App\Http\Controllers\ExpertiseController;
use App\Http\Controllers\FaviconController;
use App\Http\Controllers\FooterColumnSettingController;
use App\Http\Controllers\FooterSettingController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\GrantCategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\MediathequeController;
use App\Http\Controllers\OurServiceController;
use App\Http\Controllers\OurSocieteLogoController;
use App\Http\Controllers\OurSocietyController;
use App\Http\Controllers\OurSolutionController;
use App\Http\Controllers\OurSolutionDetailsController;
use App\Http\Controllers\OurSolutionLogoController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\SimulateProjectController;
use App\Http\Controllers\SocialLinkSettingController;
use App\Http\Controllers\SolutionReasonController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\ThemeSettingController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\TranslationController;
use App\Http\Controllers\UserMessageController;
use App\Http\Controllers\WorkWithController;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Row;
use Symfony\Component\HttpKernel\Profiler\Profile;

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
Route::get('/coming-soon', function(){
    return view('frontend.new.coming-soon');
});

Route::get('deactive', [FrontendController::class, 'userDeactive'])->name('user.deactive');

// Route::get('/', [FrontendController::class,'index'])->name('frontend.home');
Route::get('/', function(){
    return view('frontend.new.coming-soon');
});

Route::get('/testimonial', [FrontendController::class,'testimonial'])->name('frontend.testimonial');

Route::get('/chatbot', [ChatbotController::class,'index'])->name('frontend.chatbot');
Route::post('chatbot/option/click', [ChatbotController::class, 'optionClick'])->name('chatbot.option.click');
Route::post('chatbot/data/store', [ChatbotController::class, 'dataStore'])->name('chatbot.data.store');

// BannerFormController
// Route::post('banner/form/store', [BannerFormController::class, 'store'])->name('banner.form.store');

// //our Solution
Route::get('/services', [FrontendController::class,'ourSolution'])->name('frontend.ourSolutions');
Route::get('/ourSolution/details/{id}', [FrontendController::class, 'ourSolutionDetails'])->name('ourSolution.details');
Route::get('custom-test/{test}', [CrmHomeController::class, 'customTest']);
Route::post('custom-test-post', [CrmHomeController::class, 'customTestPost'])->name('custom.test.post');
Route::post('/cookie/store', [CookieController::class, 'cookieStore'])->name('cookie.store');

//our advice
Route::get('/advice/grants', [FrontendController::class,'adviceGrants'])->name('frontend.adviceGrants');
Route::get('/advice/details/{id}', [FrontendController::class, 'adviceDetails'])->name('advice.details');

//our Society
Route::get('/society',[FrontendController::class, 'ourSociety'])->name('frontend.society');


//Custom Page
Route::get('/more/page/{slug}',[FrontendController::class, 'morePage'])->name('more.pages');

//contact
Route::post('/user/contact' , [FrontendController::class, 'contact'])->name('frontend.contact');

//simulate project request
Route::post('/simulate_project/request' , [FrontendController::class, 'simulateProject'])->name('frontend.simulate_project');


//simulate project request
Route::post('frontend/subscribe/post' , [SubscribeController::class, 'store'])->name('subscribe.store');

//our service
Route::get('frontend/our-service' , [FrontendController::class, 'ourService'])->name('frontend.ourService');

//our service
Route::get('frontend/contact' , [FrontendController::class, 'ourContact'])->name('frontend.ourContact');

//extra pages
Route::get('/advice/details/{slug}', [FrontendController::class, 'extraPage'])->name('extra.pages');

//Use Message
Route::post('/user/message/post',[UserMessageController::class, 'store'])->name('frontend.useMassage');

// mediatheque
// Route::get('/mediatheque', [MediathequeController::class, 'index'])->name('mediatheque.index');

Route::group(['prefix' => 'user','middleware' => 'auth'],function(){

    Route::get('/landing',[SuperAdminController::class , 'landing'])->name('super_admin.landing')->Middleware('checkRole');

});





// Route::group(['prefix' => 'testing'],function(){
//     Route::get('/', [HomeController::class, 'index'])->name('new.home');
//     Route::get('/audit-energetique', [HomeController::class, 'auditEnergetique'])->name('audit.energetique');
//     Route::get('/estimer-vos-aides', [HomeController::class, 'estimerVosAides'])->name('estimer.vos.aides');
//     Route::get('/nos-conseils', [HomeController::class, 'nosConseils'])->name('nos.conseils');
//     Route::get('/nos-conseils/details', [HomeController::class, 'nosConseilsDetails'])->name('nos.conseils.details');
//     Route::get('/nos-offres', [HomeController::class, 'nosOffres'])->name('nos.offres');
//     Route::get('/nos-offres/details/{slug}', [HomeController::class, 'nosFffresDetails'])->name('nos.offres.details');
//     Route::get('/nos-references', [HomeController::class, 'nosReferences'])->name('nos.references');
//     Route::get('/nos-valeurs', [HomeController::class, 'nosValeurs'])->name('nos.valeurs');
//     Route::get('/notre-histoire', [HomeController::class, 'notreHistoire'])->name('notre.histoire');
//     Route::get('/nous-contacter', [HomeController::class, 'nousContacter'])->name('nous.contacter');
//     Route::get('/prendre-rdv', [HomeController::class, 'prendreRdv'])->name('prendre.rdv');
//     Route::get('/temoignages-clients', [HomeController::class, 'temoignagesClients'])->name('temoignages.clients');

// });
Route::group(['prefix' => 'superadmin','middleware' => ['auth','CheckSuperAdmin']],function(){

    Route::get('/dashboard', [SuperAdminController::class, 'index'])->name('superadmin.dashboard')->Middleware('checkRole');

   //banner
    Route::resource('banner' , BannerController::class);

    // Mediatheque Controller
    // Route::get('/mediatheque', [MediathequeController::class, 'adminIndex'])->name('admin.mediatheque.index');
    // Route::get('mediatheque/create', [MediathequeController::class, 'create'])->name('admin.mediatheque.create');
    // Route::post('mediatheque/store', [MediathequeController::class, 'store'])->name('admin.mediatheque.store');
    // Route::get('mediatheque/edit/{id}', [MediathequeController::class, 'edit'])->name('admin.mediatheque.edit');
    // Route::post('mediatheque/update', [MediathequeController::class, 'update'])->name('admin.mediatheque.update');
    // Route::post('mediatheque/delete', [MediathequeController::class, 'delete'])->name('admin.mediatheque.delete');

    // Route::get('/mediatheque/category', [MediathequeController::class,  'categoryIndex'])->name('admin.mediatheque.category.index');
    // Route::get('mediatheque/category/create', [MediathequeController::class, 'categoryCreate'])->name('admin.mediatheque.category.create');
    // Route::post('mediatheque/category/store', [MediathequeController::class, 'categoryStore'])->name('admin.mediatheque.category.store');
    // Route::get('mediatheque/category/edit/{id}', [MediathequeController::class, 'categoryEdit'])->name('admin.mediatheque.category.edit');
    // Route::post('mediatheque/category/update', [MediathequeController::class, 'categoryUpdate'])->name('admin.mediatheque.category.update');
    // Route::post('mediatheque/category/delete', [MediathequeController::class, 'categoryDelete'])->name('admin.mediatheque.category.delete');

    // ChatBot Controller
    Route::get('chatbot', [ChatbotController::class, 'adminIndex'])->name('admin.chatbot');
    Route::post('chatbot/response/delete', [ChatbotController::class, 'responseDelete'])->name('chatbot.response.delete');
    Route::post('chatbot/response/all/delete', [ChatbotController::class, 'deleteAllResponse'])->name('chatbot.response.all.delete');
    Route::post('chatbot/bulk/download', [ChatbotController::class, 'chatbotBulkDownload'])->name('chatbot.bulk.download');
    Route::post('chatbot/bulk/delete', [ChatbotController::class, 'chatbotBulkDelete'])->name('chatbot.bulk.delete');

    //Welcome
    Route::resource('bienvenue' , BienvenueController::class);

    //Expertise
    Route::resource('expertises' , ExpertiseController::class);

    //Work With
    Route::resource('workingwith' , WorkWithController::class);

    //Abouts
    Route::resource('abouts' , AboutController::class);

    //logos
    Route::resource('logos' , LogoController::class);

    //favicon
    Route::resource('favicons' , FaviconController::class);

    //oursotulions
    Route::resource('ourSolutions' , OurSolutionController::class);

    //Advice & Grants
    Route::resource('adviceGrants' , AdviceAndGrantsController::class);

    Route::resource('faqAdvice' , AdviceFaqController::class);

    //oursolutions Details (QNA)
    Route::resource('solutionDetails' , OurSolutionDetailsController::class);

    //oursolutions reasons
    Route::resource('solutionResons' , SolutionReasonController::class);

    //Advice & Grants
    // Route::resource('advices', AdviceController::class);
    // Route::get('/delete/grants/Categories/{id}', [GrantCategoryController::class, 'destroy'])->name('AdvicesCategories.delete');
    Route::resource('categoriesAdvices', GrantCategoryController::class);
    //Advice Details
    Route::resource('detailsAdvice', AdviceDetailController::class);
    //Advice reasons
    Route::resource('reasonsAdvice', AdviceReasonController::class);

    //supliars
    Route::resource('suppliers' , SuppliersController::class);

    //clint Opinions
    Route::resource('clintOpinions' , ClintOpinionController::class);

    //our Societies
    Route::resource('ourSocieties' , OurSocietyController::class);


    //our Service
    Route::resource('ourService' , OurServiceController::class);

    //contact
    Route::resource('contacts', ContactController::class);
    Route::post('contact/bulk/download', [ContactController::class, 'contactBulkDownload'])->name('contact.bulk.download');
    Route::post('contact/bulk/delete', [ContactController::class, 'contactBulkDelete'])->name('contact.bulk.delete');

    //menu contact us
    Route::resource('menueContactus', ContactUsController::class);

    //Simulate Project
    Route::resource('simulateProjects', SimulateProjectController::class);
    Route::post('project/bulk/download', [SimulateProjectController::class, 'projectBulkDownload'])->name('project.bulk.download');
    Route::post('project/bulk/delete', [SimulateProjectController::class, 'projectBulkDelete'])->name('project.bulk.delete');

    // Route::get('superadmin/bannerform', [BannerFormController::class, 'index'])->name('banner.form.index');
    // Route::post('banner/form/delete', [BannerFormController::class, 'delete'])->name('banner.form.delete');
    // Route::post('banner/form/all/delete', [BannerFormController::class, 'deleteAll'])->name('banner.form.all.delete');
    // Route::post('bannerform/bulk/download', [BannerFormController::class, 'bannerformBulkDownload'])->name('bannerform.bulk.download');
    // Route::post('bannerform/bulk/delete', [BannerFormController::class, 'bannerformBulkDelete'])->name('bannerform.bulk.delete');

    //color setting
    Route::resource('colorSetting' , ColorSettingController::class);

    //footer setting
    Route::resource('footerSettings' , FooterSettingController::class);

    //footer setting
    Route::resource('columnSettings' , FooterColumnSettingController::class);

    //Social media Setting
    Route::resource('socialLinks' , SocialLinkSettingController::class);

    //Subscriber
    Route::get('subscribers/all', [SubscribeController::class, 'index'])->name('subscribe.index');

    //Subscriber Delete
    Route::get('delete/subscribers/{id}', [SubscribeController::class, 'destroy'])->name('subscribe.delete');

    //extra pages
    Route::resource('pages', PagesController::class);

    //User Message
    Route::get('user/message/all', [UserMessageController::class, 'index'])->name('user.massage');
    //User Message Delete
    Route::get('user/message/delete/{id}', [UserMessageController::class, 'destroy'])->name('user.massageDelete');
    Route::post('message/bulk/download', [UserMessageController::class, 'messageBulkDownload'])->name('message.bulk.download');
    Route::post('message/bulk/delete', [UserMessageController::class, 'messageBulkDelete'])->name('message.bulk.delete');
    //Our Societe Logo
    Route::resource('ourSocieteLogo', OurSocieteLogoController::class);

    // Translator
    Route::get('/translation', [TranslationController::class, 'translation'])->name('translation');
    Route::post('/modify-fr', [TranslationController::class, 'modifyFr'])->name('modifyFr');
    Route::post('/modify-db', [TranslationController::class, 'modifyDb'])->name('modifyDatabase');
    Route::get('db-translate', [TranslationController::class, 'databaseTranslation'])->name('translation.database');

    // TokenController
    Route::get('token', [TokenController::class, 'index'])->name('token');
    Route::post('token/generate', [TokenController::class, 'generate'])->name('token.generate');



});


   // ThemeSettingController
//    Route::get('theme-color', [ThemeSettingController::class, 'color'])->name('theme.color');
//    Route::get('theme-toggle', [ThemeSettingController::class, 'toggle'])->name('theme.toggle');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');



