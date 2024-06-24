
<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\NotificationApiController;
use App\Http\Controllers\Api\RapportApiController;
use App\Http\Controllers\Api\TaskApiController;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\ClientApiController;
use App\Http\Controllers\ClintOpinionController;
use App\Http\Controllers\EventApiController;
use App\Http\Controllers\LeadApiController;
use App\Http\Controllers\ProjectApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Sign in Endpoint 

Route::post('/login',[AuthenticationController::class, 'login']);
Route::post('google-review', [ClintOpinionController::class, 'googleReview']);
Route::get('get/uid', [ClintOpinionController::class, 'getUid']);
//using middleware
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });




    
    

    Route::post('/sign-out', [AuthenticationController::class, 'logout']);
    Route::get('users', [UserApiController::class, 'index']);
    Route::get('users/details/{id}', [UserApiController::class, 'show']);
    Route::post('/user/location', [UserApiController::class, 'location']);
    Route::get('all/user/location', [UserApiController::class, 'allLocation']);
    Route::get('projects', [ProjectApiController::class, 'index']);
    Route::get('project/details/{id}', [ProjectApiController::class, 'show']);
    Route::get('user/projects', [ProjectApiController::class, 'userProject']);
    Route::post('project/travaux', [ProjectApiController::class, 'projectTravaux']);
    Route::get('/project/status', [ProjectApiController::class, 'projectStatus']); 
    Route::post('/project/by/status', [ProjectApiController::class, 'projectByStatus']);
    Route::get('clients', [ClientApiController::class, 'index']);
    Route::get('client/details/{id}', [ClientApiController::class, 'show']);
    Route::get('events', [EventApiController::class, 'index']);
    Route::get('user/events', [EventApiController::class, 'userEvent']);
    Route::get('leads', [LeadApiController::class, 'index']);
    Route::get('tasks', [TaskApiController::class, 'index']);
    Route::get('user/tasks', [TaskApiController::class, 'userTask']);
    Route::post('/rapport_one', [RapportApiController::class, 'rapportOne']);
    Route::post('/rapport_two', [RapportApiController::class, 'rapportTwo']);
    Route::get('/notification', [NotificationApiController::class, 'index']);
});



