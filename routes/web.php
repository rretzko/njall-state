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

        Route::get('siteadmin/menu', [App\Http\Controllers\Siteadmin\MenuController::class, 'index'])->name('menu');

        Route::get('logout', [App\Http\Controllers\Siteadmin\LoginController::class, 'destroy']);

        //COMPOSITION
        Route::get('compositions/{by?}', [App\Http\Controllers\Siteadmin\CompositionController::class, 'index'])
            ->name('compositions');
        Route::get('composition/edit/{composition}', [App\Http\Controllers\Siteadmin\CompositionController::class, 'edit'])
            ->name('composition.edit');
        Route::get('composition/replace/{old}/{new}', [App\Http\Controllers\Siteadmin\CompositionController::class, 'replace'])
            ->name('composition.replace');
        Route::get('composition/remove/{composition}', [App\Http\Controllers\Siteadmin\CompositionController::class, 'destroy'])
            ->name('composition.remove');
        Route::post('composition/update/{composition}', [App\Http\Controllers\Siteadmin\CompositionController::class, 'update'])
            ->name('composition.update');


        //CONDUCTOR
        Route::get('conductors', [App\Http\Controllers\Siteadmin\ConductorController::class, 'index'])
            ->name('conductors');
        Route::get('conductors/{by_year}', [App\Http\Controllers\Siteadmin\ConductorController::class, 'index'])
            ->name('conductors.byyear');
        //Route::get('event/new', [App\Http\Controllers\Siteadmin\EventController::class, 'index'])
        //    ->name('event');
        Route::get('conductor/edit/{conductor}', [App\Http\Controllers\Siteadmin\ConductorController::class, 'edit'])
            ->name('conductor.edit');
        Route::get('conductor/remove/{conductor}', [App\Http\Controllers\Siteadmin\ConductorController::class, 'destroy'])
            ->name('conductor.remove');
        Route::post('conductor/store', [App\Http\Controllers\Siteadmin\ConductorController::class, 'store'])
            ->name('conductor.store');
        Route::post('conductor/update/{conductor}', [App\Http\Controllers\Siteadmin\ConductorController::class, 'update'])
            ->name('conductor.update');

        //EVENT
        Route::get('event/new', [App\Http\Controllers\Siteadmin\EventController::class, 'index'])
            ->name('event');
        Route::get('event/edit/{event}', [App\Http\Controllers\Siteadmin\EventController::class, 'edit'])
            ->name('event.edit');
        Route::get('event/remove/{event}', [App\Http\Controllers\Siteadmin\EventController::class, 'destroy'])
            ->name('event.remove');
        Route::post('event/store', [App\Http\Controllers\Siteadmin\EventController::class, 'store'])
            ->name('event.store');
        Route::post('event/update/{event}', [App\Http\Controllers\Siteadmin\EventController::class, 'update'])
            ->name('event.update');

        //PARTICIPANT
        Route::get('participant/edit', [App\Http\Controllers\Siteadmin\ParticipantController::class, 'edit'])
            ->name('participant.edit');
        Route::get('participant/editform/{participant}', [App\Http\Controllers\Siteadmin\ParticipantController::class, 'editform'])
            ->name('participant.editform');
        Route::get('participant/new', [App\Http\Controllers\Siteadmin\ParticipantController::class, 'create'])
            ->name('participant');
        Route::get('participant/remove/{participant}', [App\Http\Controllers\Siteadmin\ParticipantController::class, 'destroy'])
            ->name('participant.remove');
        Route::post('participant/show', [App\Http\Controllers\Siteadmin\ParticipantController::class, 'show'])
            ->name('participant.show');
        Route::post('participant/update/{participant}', [App\Http\Controllers\Siteadmin\ParticipantController::class, 'update'])
            ->name('participant.update');
        Route::post('participant/upload', [App\Http\Controllers\Siteadmin\ParticipantController::class, 'upload'])
            ->name('participant.upload');

        //PROGRAM
        Route::get('program/new', [App\Http\Controllers\Siteadmin\ProgramController::class, 'create'])
            ->name('program');
        Route::post('program/upload', [App\Http\Controllers\Siteadmin\ProgramController::class, 'upload'])
            ->name('program.upload');
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

    Route::get('programs', [App\Http\Controllers\Guest\ProgramsController::class, 'index'])
        ->name('programs');

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
