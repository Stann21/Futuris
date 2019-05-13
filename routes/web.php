<?php

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

/*Route::get('/users/{id}/{name}', function($id, $name) {
    return "This is user " . $name . " with an id of " . $id;
}); */

//Make sure the pages are logged in only
Route::group(['middleware' => 'auth'], function () {
    //UsersController
    Route::get('/admin/user/create/{id}', 'UsersController@create');
    Route::resource('/admin/user', 'UsersController');

    //FeedbackController
    Route::get('/admin/feedback/create/{userid}/{id}/{feedbackid}', 'FeedbackController@create');
    Route::delete('/admin/feedback/{feedback}/{pages}', 'FeedbackController@destroypages');
    Route::get('/admin/feedback/{feedback}/edit/{locationid}', 'FeedbackController@edit');
    Route::resource('/admin/feedback','FeedbackController');

    //LearningGoalsController
    Route::get('/admin/goals/create/{id}/{goal}/{goalid}', 'LearningGoalsController@create');
    Route::get('/admin/goals/edit/{id}/{goal}/{goalid}', 'LearningGoalsController@edit');
    Route::get('/admin/goals/update/{id}/{goal}/{goalid}', 'LearningGoalsController@update');
    Route::get('/admin/goals/{id}/{userid}', 'LearningGoalsController@show');
    Route::resource('/admin/goals', 'LearningGoalsController');

    //AchievementUserController
    Route::get('/admin/achievement/user/create/{userid}/{onwhat}/{onwhatid}', 'AchievementUserController@create');
    Route::get('/admin/achievement/user/{achievement}/edit/{id}', 'AchievementUserController@edit');
    Route::delete('/admin/achievement/user/{achievement}/{userid}', 'AchievementUserController@destroys');
    Route::resource('/admin/achievement/user', 'AchievementUserController');

    //AchievementController
    Route::resource('/admin/achievement','AchievementController');

    //IconController
    Route::resource('/admin/icon', 'IconController');

    //TemplateLearningGoalsController
    Route::get('/admin/goalstemplate/create/{goal}/{goalid}', 'TemplateLearningGoalsController@create');
    Route::get('/admin/goalstemplate/edit/{goal}/{goalid}', 'TemplateLearningGoalsController@edit');
    Route::resource('/admin/goalstemplate', 'TemplateLearningGoalsController');

    //PrintController
    Route::get('/admin/form/{id}', 'PrintController@index');
    Route::post('/admin/form/download', 'PrintController@pdf');

    //Will create every route we make in a controller
    Route::resource('/admin/backanddashboard','UserController');

    //Frontend pages
    Route::get('/overview', 'PagesController@overview');
    Route::get('/goal/{id}', 'PagesController@goal');
    Route::get('/achievements', 'PagesController@achievements');
    Route::get('/achievementDetail/{id}', 'PagesController@achievementDetail');
    Route::get('/settings', 'PagesController@settings');
    Route::get('/feedback', 'PagesController@feedback');
    Route::get('/feedbackDetail/{id}', 'PagesController@feedbackDetail');
    Route::get('/achievements', 'AchievementController@getAchievementsToFrontend');

    Route::post('/goal/feedbackPost/{id}','LearningGoalsController@insert');
    Route::post('/password/store/{id}', 'PagesController@passwordUpdate');

});



//frontend
Route::resource('/activate', 'ActivateAccountController');
Route::post('/activate/change', 'ActivateAccountController@activateCheck');
Route::get('/', 'PagesController@index');

//loading page
Route::get('/loading', 'PagesController@loading');


Auth::routes();

