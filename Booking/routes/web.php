<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'Admin','namespace'=>'Admin','middleware' => ['login']], function() {
    Route::resource('Admin','AdminController');


	Route::resource('roomcategorys','RoomCategorysController');
	Route::delete('roomcategorysDelete', 'RoomCategorysController@destroy')->name('roomcategorysDelete');
	Route::resource('kindrooms','KindroomsController');

    Route::get('users', 'PeopleController@index')->name('users');
    Route::get('show/{id}', 'PeopleController@show')->name('ShowPeople');
    Route::delete('UsersDelete', 'PeopleController@destroy')->name('UsersDelete');

    Route::get('/print-order/{checkout_code}','BookingController@print_order');
	Route::get('bookings','BookingController@index')->name('bookings');
    Route::get('shows/{id}', 'BookingController@shows')->name('ShowBookings');
	Route::delete('BookingsDelete','BookingController@destroy')->name('BookingsDelete');

	Route::get('hotels','HotelsController@index')->name('hotels');
	Route::delete('HotelsDelete', 'HotelsController@destroy')->name('HotelsDelete');
	Route::get('Hotels/update/{id}', 'HotelsController@update')->name('Hotelsupdate');
	Route::get('Hotels/update2/{id}', 'HotelsController@update2')->name('Hotelsupdate2');

	Route::delete('kindroomsDelete', 'KindroomsController@destroy')->name('kindroomsDelete');

    Route::resource('sevices','SevicesController');
    Route::delete('SevicesDelete', 'SevicesController@destroy')->name('SevicesDelete');

	Route::resource('regions','RegionsController');
	Route::delete('RegionsDelete', 'RegionsController@destroy')->name('RegionsDelete');

	Route::resource('cities','CitiesController');
	Route::delete('CityDelete', 'CitiesController@destroy')->name('CityDelete');

    Route::resource('tags', 'TagController');
    Route::delete('TagDelete', 'TagController@destroy')->name('TagDelete');

    Route::resource('blog', 'BlogController');
    Route::delete('blogDelete', 'BlogController@destroy')->name('blogDelete');

    Route::resource('icons', 'iconController');

    Route::resource('slide', 'SlideController');
    Route::delete('slideDelete', 'SlideController@destroy')->name('slideDelete');
});


Route::group(['prefix' => 'Hotels','namespace'=>'Hotels','middleware' => ['userlogin']], function() {
    Route::resource('rooms','RoomsController');
    Route::get('rooms/editrooms/{id}','RoomsController@editrooms')->name('editrooms');
	Route::resource('hotel','HotelsController');

	Route::resource('comments','commentsController');
	//Route::resource('booking','BookingsController');
	//thanh toan online return
	Route::get('return-payment/{id}', 'BookroomsController@return');
    Route::resource('bookrooms', 'BookRoomsController');
    Route::post('booking', 'BookRoomsController@booking')->name('booking');
    Route::get('payment', 'BookroomsController@payment');
    Route::post('createbooking', 'BookRoomsController@createbooking')->name('createbooking');
    Route::get('hotel/order/{id}','HotelsController@order')->name('order');
    Route::get('hotel/editorder/{id}','HotelsController@editorder')->name('editorder');
    Route::get('hotel/uporder/{id}','HotelsController@uporder')->name('uporder');
    Route::PUT ('hotel/upDeposit/{id}','HotelsController@upDeposit')->name('upDeposit');

    Route::get('/print-orders/{checkout_codes}','HotelsController@print_orders');


});


Route::group(['prefix' => 'user','namespace'=>'Users','middleware' => ['userlogin']], function() {
    Route::get('user','UserController@index')->name('user');
    Route::put('user/UserUpdate/{id}','UserController@UserUpdate')->name('UserUpdate');
    Route::post('user/userscreate','UserController@userscreate')->name('userscreate');
    Route::get('user/listorder/{id}','UserController@listorder')->name('listorder');
    Route::delete('user/OrderDelete/{id}', 'UserController@destroy')->name('OrderDelete');

});


Route::group(array('prefix'=>'client', 'namespace'=>'Home'),function (){
	Route::resource('peoples','PeolesController');
	Route::get('login', 'LoginController@index')->name('login');
	Route::post('login/checklogin', 'LoginController@checklogin')->name('checklogin');
	Route::get('logout', 'LoginController@logout')->name('logout');
	Route::resource('/','HomeController');
	Route::get('rooms/showrooms/{id}','HomeController@showrooms')->name('showrooms');
	Route::get('hotels/showhotels/{id}','HomeController@showhotels')->name('showhotels');
	Route::get('hotels/listrooms/{id}','HomeController@listrooms')->name('listrooms');
	Route::get('hotels/listhotels/','HomeController@listhotels')->name('listhotels');
    Route::get('hotels/searchrooms/','HomeController@searchrooms')->name('searchrooms');
    Route::get('blog','HomeController@blog')->name('blog');
    Route::get('TagBog/{id}','HomeController@TagBog')->name('TagBog');
    Route::get('showBlog/{id}','HomeController@showBlog')->name('showBlog');
    Route::get('blog_in_tag/{id}','HomeController@blogInTag')->name('blog_post_in_tag');


    //facebook
    Route::get('/redirect/{provider}', 'LoginController@redirect')->name('redirect');
    Route::get('/callback/{provider}', 'LoginController@callback');
});

// Route::group(['prefix' => 'Users','middleware' => ['userlogin']], function() {
//     Route::resource('rooms','ControllerRooms');
// 	Route::resource('hotel','ControllerHotels');
// });
Route::get('ckeditor', 'CkeditorController@index');
Route::post('ckeditor/upload', 'CkeditorController@upload')->name('ckeditor.upload');
//Laravel Localization - Pick Language
Route::get('/set-language/{lang}', 'LanguagesController@set')->name('set.language');
