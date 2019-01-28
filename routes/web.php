<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the 'web' middleware group. Now create something great!
|
*/

Route::get('', function() { return redirect()->route('home', ['lang' => 'en']); });

Route::get('/refresh-captcha', 'Controller@refreshCaptcha')->name('refresh-captcha');

Route::group(['prefix' => '{lang}', 'middleware' => 'frontEndMiddleware'], function () {

    //======================================= PAGES ========================================

    Route::get('/', 'HomeController@getView')->name('home');

    Route::get('sitemap.xml', 'Controller@getSitemap')->name('sitemap');

    //======================================= AJAX ========================================

    Route::post('get-meeting-day/{id}', 'Controller@getMeetingDay')->name('get-meeting-day');

    Route::get('meeting-confirmation/{link}', 'Controller@meetingConfirmation')->name('meeting-confirmation');

    Route::post('submit-schedule-a-meeting', 'Controller@handleSubmitScheduleAMeеting')->name('submit-schedule-a-meeting');
});