<?php

Route::group(['middleware' => 'admin'], function(){

  Route::get('/admin', 'HomeController@index');



  Route::get('/admin/mitglieder', 'AdminController@index');

  Route::get('/activation', 'AdminController@activation');

  Route::post('/activation/{user}/activate_user', 'AdminController@activate_user');

  Route::post('/activation/{user}/deactivate_user', 'AdminController@deactivate_user');




  Route::post('/admin/destroy/{user}', 'AdminController@destroy');

  Route::get('/admin/{user}/edit', 'AdminController@edit');

  Route::post('/admin/{user}/edit', 'AdminController@update');

  Route::get('admin/create', 'AdminController@create');

  Route::post('admin/create', 'AdminController@store');



  Route::get('/admin/account/{user}/edit', 'AccountController@edit');

  Route::post('/admin/account/{user}/edit', 'AccountController@update');


  Route::get('/admin/fields', 'FieldsController@index');

  Route::get('/admin/fieldscreate', 'FieldsController@create');

  Route::post('/admin/fieldscreate', 'FieldsController@store');

  Route::get('/admin/fields/{field}', 'FieldsController@show');

  Route::get('/admin/fields/{field}/edit', 'FieldsController@edit');

  Route::post('/admin/fields/{field}/edit', 'FieldsController@update');

  Route::post('/admin/fields/destroy/{field}', 'FieldsController@destroy');



  Route::get('/admin/clubs', 'ClubController@index');

  Route::get('/admin/clubs/create', 'ClubController@create');

  Route::post('/admin/clubs/create', 'ClubController@store');

  Route::get('/admin/clubs/{club}/edit', 'ClubController@edit');

  Route::post('/admin/clubs/{club}/edit', 'ClubController@update');



  Route::get('/admin/sports', 'SportsController@index');

  Route::get('/admin/sports/create', 'SportsController@create');

  Route::post('/admin/sports/create', 'SportsController@store');

  Route::get('/admin/sports/{sport}/edit', 'SportsController@edit');

  Route::post('/admin/sports/{sport}/edit', 'SportsController@update');

  Route::post('/admin/sports/destroy/{sport}', 'SportsController@destroy');



  Route::get('/admin/contacts', 'ContactsController@index');

  Route::get('/admin/contacts/create', 'ContactsController@create');

  Route::post('/admin/contacts/create', 'ContactsController@store');

  Route::get('/admin/contacts/{contact}/edit', 'ContactsController@edit');

  Route::post('/admin/contacts/{contact}/edit', 'ContactsController@update');

  Route::post('/admin/contacts/destroy/{contact}', 'ContactsController@destroy');



  Route::get('/admin/events/{event}', 'EventsController@show');

  Route::get('/admin/event/create', 'EventsController@create');

  Route::post('/admin/event/create', 'EventsController@store');

  Route::post('/admin/events/destroy/{event}', 'EventsController@destroy');

  Route::post('/admin/events/join/{event}', 'EventsController@join');

  Route::post('/admin/events/leave/{event}', 'EventsController@leave');

  Route::get('/admin/findFieldName', 'EventsController@findFieldName');

  Route::get('/admin/checkStart', 'EventsController@checkStart');

  Route::get('/admin/checkEnd', 'EventsController@checkEnd');




  Route::get('/admin/statistics', 'EventsController@statistics');

});

Route::group(['middleware' => 'kunde'], function(){

  Route::get('/startseite', 'KundenController@index');

  Route::post('/user/club/join/{club}', 'KundenController@join');

  Route::post('/user/club/leave/{club}', 'KundenController@leave');



  Route::get('/user/events/{event}', 'EventsController@show');

  Route::get('/user/create', 'EventsController@create');

  Route::post('/user/create', 'EventsController@store');

  Route::post('/user/events/destroy/{event}', 'EventsController@destroy');

  Route::post('/user/events/join/{event}', 'EventsController@join');

  Route::post('/user/events/leave/{event}', 'EventsController@leave');

  Route::get('/user/findFieldName', 'EventsController@findFieldName');

  Route::get('/user/checkStart', 'EventsController@checkStart');

  Route::get('/user/checkEnd', 'EventsController@checkEnd');




  Route::get('/user/clubs', 'ClubController@index');



  Route::get('/user/account/{user}/edit', 'AccountController@edit');

  Route::post('/user/account/{user}/edit', 'AccountController@update');

});

Route::group(['middleware' => 'lieferant'], function(){

  Route::get('/', 'HomeController@index');



  Route::get('/account/{user}/edit', 'AccountController@edit');

  Route::post('/account/{user}/edit', 'AccountController@update');


  Route::get('/uebersicht', 'UebersichtController@index');



  Route::get('/fields', 'FieldsController@index');

  Route::get('/fieldscreate', 'FieldsController@create');

  Route::post('/fieldscreate', 'FieldsController@store');

  Route::get('/fields/{field}', 'FieldsController@show');

  Route::get('/fields/{field}/edit', 'FieldsController@edit');

  Route::post('/fields/{field}/edit', 'FieldsController@update');

  Route::post('/destroy/{field}', 'FieldsController@destroy');



  Route::get('/clubs', 'ClubController@index');

  Route::get('/clubs/create', 'ClubController@create');

  Route::post('/clubs/create', 'ClubController@store');

  Route::get('/clubs/{club}/edit', 'ClubController@edit');

  Route::post('/clubs/{club}/edit', 'ClubController@update');



  Route::get('/sports', 'SportsController@index');

  Route::get('/sports/create', 'SportsController@create');

  Route::post('/sports/create', 'SportsController@store');

  Route::get('/sports/{sport}/edit', 'SportsController@edit');

  Route::post('/sports/{sport}/edit', 'SportsController@update');

  Route::post('/sports/destroy/{sport}', 'SportsController@destroy');



  Route::get('/contacts', 'ContactsController@index');

  Route::get('/contacts/create', 'ContactsController@create');

  Route::post('/contacts/create', 'ContactsController@store');

  Route::get('/contacts/{contact}/edit', 'ContactsController@edit');

  Route::post('/contacts/{contact}/edit', 'ContactsController@update');

  Route::post('/contacts/destroy/{contact}', 'ContactsController@destroy');




  Route::get('/events/{event}', 'EventsController@show');

  Route::get('/create', 'EventsController@create');

  Route::post('/create', 'EventsController@store');

  Route::post('/events/destroy/{event}', 'EventsController@destroy');

  Route::post('/events/join/{event}', 'EventsController@join');

  Route::post('/events/leave/{event}', 'EventsController@leave');

  Route::get('/findFieldName', 'EventsController@findFieldName');

  Route::get('/checkStart', 'EventsController@checkStart');

  Route::get('/checkEnd', 'EventsController@checkEnd');




  Route::get('/statistics', 'EventsController@statistics');



  Route::get('/contact', 'EventsController@contact');

});

Route::group(['middleware' => 'visitors'], function(){

  Route::get('/register', 'RegistrationController@register');

  Route::get('/register_user', 'RegistrationController@register_user');

  Route::post('/register', 'RegistrationController@postRegister');

  Route::post('/register_user', 'RegistrationController@postRegister_user');

  Route::get('/activate/{email}/{activationCode}', 'ActivationController@activate');

  Route::get('/login', 'LoginController@index');

  Route::post('/login', 'LoginController@login');

  Route::get('/testing', 'MailController@show');

  Route::post('/sendmail', function (\Illuminate\Http\Request $request) {
    return redirect('/login');
  })->name('sendmail');

});

Route::post('/logout', 'LoginController@logout');

Route::get('/impressum', 'ImpressumController@index');

Route::get('/datenschutz', 'DatenschutzController@index');

Route::get('/agb', 'AgbController@index');


Route::group(['middleware' => 'cors', 'prefix' => 'api'], function(){

    Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);

    Route::post('authenticate', 'AuthenticateController@authenticate');

    Route::get('authenticate/user', 'AuthenticateController@getAuthenticatedUser');

    Route::post('register', 'AppRegistrationController@postRegister');

});

Route::group(['middleware' => 'cors', 'prefix' => 'api'], function(){

  Route::resource('jokes', 'JokesController');

  Route::resource('fields', 'ApiFieldsController');

  Route::get('question', 'QuestionController@index');

  Route::get('question/{id}', 'QuestionController@show');

  Route::post('question', 'QuestionController@store');

  Route::put('question/{id}', 'QuestionController@update');

  Route::delete('question/{id}', 'QuestionController@destroy');

  Route::get('sports', 'ApiSportsController@index');

  Route::get('sports/{id}', 'ApiSportsController@show');

  Route::post('sports', 'ApiSportsController@store');

  Route::put('sports/{id}', 'ApiSportsController@update');

  Route::delete('sports/{id}', 'ApiSportsController@destroy');
});
