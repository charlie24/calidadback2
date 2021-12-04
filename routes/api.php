<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');

    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        //Users
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
        Route::get('notifications', 'AuthController@notifications');
        Route::post('notifications/{id}/read', 'AuthController@readNotification');
        //Residents
        Route::get('residents', 'ResidentController@list');
        Route::post('resident/create','UserController@createResident');
        Route::post('resident/{id}/delete', 'UserController@deleteResident');
        Route::post('resident/{id}/generatePassword', 'UserController@generatePassword');
        //Roles
        Route::post('role/create','RoleController@create');
        Route::post('role/update/{id}','RoleController@update');
        Route::get('roles','RoleController@list');
        Route::get('role/{id}','RoleController@role');
        //Common Areas
        Route::post('commonArea/create','CommonAreaController@create');
        Route::post('commonArea/update/{id}','CommonAreaController@update');
        Route::get('commonAreas','CommonAreaController@list');
        Route::get('commonArea/{id}','CommonAreaController@commonArea');
        //Reservations
        Route::get('reservations','ReservationController@list');
        Route::post('reserve','ReservationController@reserve');
        Route::post('reservation/{id}/changeStatus','ReservationController@change_status');
        Route::get('reservation/{id}','ReservationController@reservation');
        Route::post('reservation/delete/{id}','ReservationController@delete');
        //Events
        Route::get('event/{id}','EventController@get');
        //Tickets
        Route::post('ticket/{id}/changeStatus','TicketController@changeStatus');
        Route::post('ticket/create','TicketController@create');
        Route::get('ticket/{id}','TicketController@ticket');
        Route::get('tickets','TicketController@list');
        //Comments
        Route::post('comment/create','CommentController@create');
        Route::get('comments/{id}','CommentController@listByTicket');
        //Invitations
        Route::post('invitation/{id}/changeStatus','InvitationController@changeStatus');
        //Route::get('invitation/{id}/guests','GuestController@listByInvitation');
        Route::post('invitation/create','InvitationController@create');
        Route::post('invitation/{id}/addGuest','InvitationController@addGuest');
        Route::get('invitations','InvitationController@list');
        Route::get('invitations/byEvent/{id}','InvitationController@listByEvent');
        Route::get('invitation/{id}','InvitationController@invitation');
        Route::post('invitation/update/{id}','InvitationController@update');
        Route::post('invitation/delete/{id}','InvitationController@delete');
        Route::post('invitations/search','InvitationController@search');
        //Guests
        //Route::post('guest/create','GuestController@create');
        //Route::post('guest/update/{id}','GuestController@update');
        //Route::get('guests','GuestController@list')
        //Route::get('guest/{id}','GuestController@guest');
        //Ticket States
        Route::post('ticketStatus/create','TicketStatusController@create');
        Route::post('ticketStatus/update/{id}','TicketStatusController@update');
        Route::get('ticketStates','TicketStatusController@list');
        Route::get('ticketStatus/{id}','TicketStatusController@ticketStatus');
        //Ticket Categories
        Route::get('ticketCategories','TicketCategoryController@list');
        //Departments
        Route::get('departmentsByEdifice','DepartmentController@listByEdifice');
        //Votes
        Route::post('votes/create','VoteController@store');
        Route::post('votes/update/{id}','VoteController@update');
        Route::post('votes/delete/{id}','VoteController@destroy');
        Route::get('votes/{id}','VoteController@show');
        Route::get('votes','VoteController@list');
        //Choices
        Route::post('choices/create','ChoiceController@store');
        Route::post('choices/update/{id}','ChoiceController@update');
        Route::post('choices/delete/{id}','ChoiceController@destroy');
        Route::get('choices/{id}','ChoiceController@show');
        Route::get('choices/byVote/{id}','ChoiceController@list');
        //Voting
        Route::post('voting/create','VotingController@store');
        //Incidence States
        Route::get('incidenceStates','IncidenceStatusController@list');
        //Incidence Categories
        Route::get('incidenceCategories','IncidenceCategoryController@list');
        //Incidences
        Route::post('incidences/create','IncidenceController@store');
        Route::post('incidences/update/{id}','IncidenceController@update');
        Route::post('incidences/qualify/{id}','IncidenceController@qualify');
        Route::post('incidences/delete/{id}','IncidenceController@destroy');
        Route::get('incidences/{id}','IncidenceController@show');
        Route::get('incidences','IncidenceController@list');
        Route::get('incidencesByResident/{id}','IncidenceController@listByResident');
        //Staff
        Route::post('staff/create','ExternalStaffController@store');
        Route::post('staff/update/{id}','ExternalStaffController@update');
        Route::post('staff/delete/{id}','ExternalStaffController@destroy');
        Route::get('staff/{id}','ExternalStaffController@show');
        Route::get('staff','ExternalStaffController@list');
        Route::get('staff/incidence/{id}','ExternalStaffController@listByIncidence');
        //Document Type
        Route::get('documents','DocumentTypeController@list');
        //Drivers
        Route::post('drivers/create','DriverController@store');
        Route::post('drivers/update/{id}','DriverController@update');
        Route::post('drivers/delete/{id}','DriverController@destroy');
        Route::get('drivers/{id}','DriverController@show');
        Route::get('drivers','DriverController@list');
        //Movings
        Route::post('movings/create','MovingController@store');
        Route::post('movings/update/{id}','MovingController@update');
        Route::post('movings/delete/{id}','MovingController@destroy');
        Route::get('movings/{id}','MovingController@show');
        Route::get('movings','MovingController@list');
    });
});
