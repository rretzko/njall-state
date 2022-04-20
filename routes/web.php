<?php

use App\Http\Controllers\Admin\ArtistController;
use App\Http\Controllers\Admin\ArtisttypeController;
use App\Http\Controllers\Admin\CompositionController;
use App\Http\Controllers\Admin\ConductorController;
use App\Http\Controllers\Admin\EnsembleController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\InstrumentationController;
use App\Http\Controllers\Admin\ParticipantController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\ProgramlistController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SchoolController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\UserProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Auth::routes(['register' => false]);

Route::group([
  'as' => 'siteadmin.',
  'namespace' => 'App\Http\Controllers\Siteadmin',
],function(){

    Route::get('siteadmin', [App\Http\Controllers\Siteadmin\LoginController::class, 'index']);

    Route::post('login', [App\Http\Controllers\Siteadmin\LoginController::class, 'update'])
        ->name('login');

    Route::group(['middleware' => 'auth'], function(){

        Route::get('logout', [App\Http\Controllers\Siteadmin\LoginController::class, 'destroy']);

        Route::get('program/new', [App\Http\Controllers\Siteadmin\ProgramController::class, 'create'])
            ->name('program');


    });
});


Route::group([
    'prefix' => 'guest',
    'as' => 'guest.',
    'namespace' => 'App\Http\Controllers\Guest'
], function() {

    Route::get('event/{event}/{participant?}', [App\Http\Controllers\Guest\EventController::class, 'index'])
        ->name('event');

    Route::get('events/', [App\Http\Controllers\Guest\EventController::class, 'index'])
        ->name('events');

    Route::get('years', [App\Http\Controllers\Guest\YearsController::class, 'index'])
        ->name('years');
    /** OLD ROUTES */
    Route::get('conductors', [App\Http\Controllers\Guest\ConductorsController::class, 'index'])
        ->name('conductors');
    Route::get('participants', [App\Http\Controllers\Guest\ParticipantsController::class, 'index'])
        ->name('participants');

    Route::get('myschool/{school}', [App\Http\Controllers\Guest\SchoolController::class, 'show'])
        ->name('myschool');

    Route::get('mystudents/{school}/{event}', [App\Http\Controllers\Guest\SchoolController::class, 'showParticipants'])
        ->name('mystudents');

    Route::get('schools/', [App\Http\Controllers\Guest\SchoolsController::class, 'index'])
        ->name('schools');
    Route::post('schools/search', [App\Http\Controllers\Guest\SchoolsController::class, 'show'])
        ->name('schoolssearch');

    Route::get('titles', [App\Http\Controllers\Guest\TitlesController::class, 'index'])
        ->name('titles');
    Route::post('titles/search', [App\Http\Controllers\Guest\TitlesController::class, 'show'])
        ->name('titlessearch');

    Route::get('years', [App\Http\Controllers\Guest\YearsController::class, 'index'])
        ->name('years');
});

Route::group(['prefix' => 'eventadmin', 'as' => 'eventadmin.'], function () {
    Route::get('eventadmin', [App\Http\Controllers\Eventadmin\EventadminController::class, 'index'])
        ->name('eventadmin');
    Route::get('voiceparts/edit', [App\Http\Controllers\Eventadmin\VoicepartController::class, 'index'])
        ->name('voicepart.edit');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Permissions
    Route::resource('permissions', PermissionController::class, ['except' => ['store', 'update', 'destroy']]);

    // Roles
    Route::resource('roles', RoleController::class, ['except' => ['store', 'update', 'destroy']]);

    // Users
    Route::resource('users', UserController::class, ['except' => ['store', 'update', 'destroy']]);

    // Event
    Route::resource('events', EventController::class, ['except' => ['store', 'update', 'destroy']]);

    // Ensemble
    Route::resource('ensembles', EnsembleController::class, ['except' => ['store', 'update', 'destroy']]);

    // Conductor
    Route::resource('conductors', ConductorController::class, ['except' => ['store', 'update', 'destroy']]);

    // Composition
    Route::resource('compositions', CompositionController::class, ['except' => ['store', 'update', 'destroy']]);

    // Artist
    Route::resource('artists', ArtistController::class, ['except' => ['store', 'update', 'destroy']]);

    // Artisttype
    Route::resource('artisttypes', ArtisttypeController::class, ['except' => ['store', 'update', 'destroy']]);

    // School
    Route::resource('schools', SchoolController::class, ['except' => ['store', 'update', 'destroy']]);

    // Instrumentation
    Route::resource('instrumentations', InstrumentationController::class, ['except' => ['store', 'update', 'destroy']]);

    // Participant
    Route::resource('participants', ParticipantController::class, ['except' => ['store', 'update', 'destroy']]);

    // Program
    Route::resource('programs', ProgramController::class, ['except' => ['store', 'update', 'destroy']]);

    // Programlist
    Route::resource('programlists', ProgramlistController::class, ['except' => ['store', 'update', 'destroy']]);
});

Route::group(['prefix' => 'profile', 'as' => 'profile.', 'middleware' => ['auth']], function () {
    if (file_exists(app_path('Http/Controllers/Auth/UserProfileController.php'))) {
        Route::get('/', [UserProfileController::class, 'show'])->name('show');
    }
});
