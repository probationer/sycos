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

Route::get('/', 'pageController@index');
//Route::resource('/','pageController');
//google verification
Route::get('/googlef9fe7aff060ba801.html',function(){
    return view('googlef9fe7aff060ba801');
});
Route::get('/google5003294494e75b52.html',function(){
    return view('google5003294494e75b52');
});

//bing master
Route::get('/BingSiteAuth.xml',function(){
    return response()->view('BingSiteAuth')->header('Content-Type', 'text/xml');
});

Route::get('/about', 'pageController@about');
Route::get('/feeds', 'pageController@feeds');
Route::get('/suggestions', 'pageController@suggestions');
Route::post('/feedback', 'SycosAuthController@feedback');
Route::get('/privacy_policy', 'pageController@privacy_policy');
Route::get('/sycos_team', 'pageController@team');
Route::get('/get_recommendation', 'pageController@recommendation');
Route::get('/student', 'pageController@student');
Route::get('/teacher', 'pageController@teacher');
Route::get('/institute', 'pageController@institute');

//Route::resource('login','loginController');
Route::resource('/article','articleController');
Route::post('/pdfupload','articleController@fileUpload');

Route::resource('/video','videoController');



Auth::routes();

Route::get('/home', 'pageController@index');

Route::get('/signup', 'SycosAuthController@showRegistrationForm')->name('Auth_sycos.signup');
Route::post('/signup', 'SycosAuthController@submitRegistrationForm');
Route::get('/login', 'SycosAuthController@showLoginForm')->name('Auth_sycos.login');
Route::post('/login', 'SycosAuthController@submitLoginForm');
Route::post('/login/{pageAddress}', ['as'=>'info','uses'=>'SycosAuthController@submitLoginForm_viaAnyPage'] );
Route::post('/VerifyEmail', 'SycosAuthController@VerifyEmail');
Route::post('/resendCode', 'SycosAuthController@resendVerificationCode');
Route::post('/privacy/{profilePage}', ['as'=>'info','uses'=>'SycosAuthController@privacySettings']);
Route::post('/changePassword/{profilePage}', ['as'=>'info','uses'=>'SycosAuthController@changesetting']);

Route::post('/requestSend/{ReciverName}', ['as'=>'info','uses'=>'CompanionController@SendRequest']);
Route::post('/AcceptRequest/{SenderName}', ['as'=>'info','uses'=>'CompanionController@AcceptRequest']);
Route::post('/requestReject/{SenderName}', ['as'=>'info','uses'=>'CompanionController@requestReject']);




Route::post('/comment/{pageLink}',['as'=>'info','uses'=>'commentController@store']);
Route::post('/comment/delete/{commentId}',['as'=>'info','uses'=>'commentController@destroy']);

Route::get('/search','searchController@search');
Route::get('/search/{subs}',['as'=>'type','uses'=>'searchController@subtype']);

Route::resource('/teacherForm','dataEntries\teacherDataController');
Route::resource('/studentForm','dataEntries\studentDataController');
Route::resource('/coachingForm','dataEntries\coachingDataController');

Route::get('/guardianForm', function () {
    return view('forms.guardian.form');
});

Route::get('/profile/{profile}/contactStudent',['as'=>'info','uses'=>'dataEntries\contactFormController@showStudentForm']);
Route::post('/profile/{profile}/contactStudent','dataEntries\contactFormController@storeDataStudent');

Route::get('/profile/{profile}/contact',['as'=>'info','uses'=>'dataEntries\contactFormController@showTeachersForm']);
Route::post('/profile/{profile}/contact','dataEntries\contactFormController@storeDataTeacher');

Route::get('/showRequest/{data}',['as'=>'info','uses'=>'dataEntries\contactFormController@showDataTeacher']);
Route::get('/showRequestToStudent/{data}',['as'=>'info','uses'=>'dataEntries\contactFormController@showDataStudent']);

Route::resource('/profile','profileController');

Route::get('/profile/{PageLink}/setting', 'profileController@setting');
Route::get('/profile/{PageLink}/requests', 'profileController@request');
Route::get('/profile/{PageLink}/{tab}', 'profileController@pageTabs');

Route::post('/profile/{PageLink}/setting', 'SycosAuthController@privacySettings');

Route::post('/groupifyNew','SycosAuthController@createContentGroup');
Route::post('/groupify','SycosAuthController@addContentGroup');

Route::post('/sendmail', 'SycosAuthController@sendMailDemo');
Route::get('/sendmail', 'SycosAuthController@showForm');

Route::get('/showUserImage/{fileName}',[
    'as'=>'info',
    'uses'=>'SycosAuthController@getUserFiles'
    ]);

Route::get('/pdfs/{fileName}',[
    'as'=>'info',
    'uses'=>'SycosAuthController@getPdfFiles'
    ]);


Route::get('/sitemap.xml','sitemapController@index');
Route::get('/sitemap/profile.xml','sitemapController@profile');
Route::get('/sitemap/article.xml','sitemapController@article');
Route::get('/sitemap/video.xml','sitemapController@video');
//to change the user_id
//Route::get('/matchId','SycosAuthController@matchId');