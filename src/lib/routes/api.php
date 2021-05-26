<?php
declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::post('/api/v1/auth', 'AuthController@signIn');

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::post('/api/v1/ticket', 'TicketController@storeTicket');
    Route::get('/api/v1/ticket', 'TicketController@retrieveAllTickets');
    Route::get('/api/v1/ticket/{uuid}', 'TicketController@retrieveTicket');
    Route::delete('/api/v1/ticket/{uuid}', 'TicketController@deleteTicket');
    Route::patch('/api/v1/ticket/{uuid}', 'TicketController@modifyTicket');


    Route::post('/api/v1/user', 'UserController@storeUser');
    Route::get('/api/v1/user', 'UserController@retrieveAllUsers');
    Route::get('/api/v1/user/{uuid}', 'UserController@retrieveUser');
    Route::delete('/api/v1/user/{uuid}', 'UserController@deleteUser');
    Route::patch('/api/v1/user/{uuid}', 'UserController@modifyUser');

    Route::get('/api/v1/user/search', 'SearchController@searchUser');
    Route::get('/api/v1/ticket/search', 'SearchController@searchTicket');
    Route::get('/api/v1/ticket/{uuid}/history', 'TicketHistoryController@retrieveTicketHistory');
});
