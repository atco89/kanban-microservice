<?php
declare(strict_types=1);

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * get searchTicket
 * Summary: Used to search ticket.
 * Notes: This operation is used to search ticket.
 * Output-Formats: [application/json]
 */
Route::get('/api/v1/ticket/search', 'SearchController@searchTicket');
/**
 * get searchUser
 * Summary: Used to search user.
 * Notes: This operation is used to search user.
 * Output-Formats: [application/json]
 */
Route::get('/api/v1/user/search', 'SearchController@searchUser');
/**
 * get retrieveAllTickets
 * Summary: Used to retrieve all tickets.
 * Notes: This operation is used to retrieve all tickets.
 * Output-Formats: [application/json]
 */
Route::get('/api/v1/ticket', 'TicketController@retrieveAllTickets');
/**
 * post storeTicket
 * Summary: Used to store ticket.
 * Notes: This operation is used to store ticket.
 * Output-Formats: [application/json]
 */
Route::post('/api/v1/ticket', 'TicketController@storeTicket');
/**
 * delete deleteTicket
 * Summary: Used to delete ticket.
 * Notes: This operation is used to delete ticket.
 * Output-Formats: [application/json]
 */
Route::delete('/api/v1/ticket/{uuid}', 'TicketController@deleteTicket');
/**
 * patch modifyTicket
 * Summary: Used to modify ticket.
 * Notes: This operation is used to modify ticket.
 * Output-Formats: [application/json]
 */
Route::patch('/api/v1/ticket/{uuid}', 'TicketController@modifyTicket');
/**
 * get retrieveTicket
 * Summary: Used to retrieve ticket.
 * Notes: This operation is used to retrieve ticket.
 * Output-Formats: [application/json]
 */
Route::get('/api/v1/ticket/{uuid}', 'TicketController@retrieveTicket');
/**
 * get retrieveTicketHistory
 * Summary: Used to retrieve ticket history.
 * Notes: This operation is used to retrieve ticket history.
 * Output-Formats: [application/json]
 */
Route::get('/api/v1/ticket/{uuid}/history', 'TicketHistoryController@retrieveTicketHistory');
/**
 * get retrieveAllUsers
 * Summary: Used to retrieve all users.
 * Notes: This operation is used to retrieve all users.
 * Output-Formats: [application/json]
 */
Route::get('/api/v1/user', 'UserController@retrieveAllUsers');
/**
 * post storeUser
 * Summary: Used to store user.
 * Notes: This operation is used to store user.
 * Output-Formats: [application/json]
 */
Route::post('/api/v1/user', 'UserController@storeUser');
/**
 * delete deleteUser
 * Summary: Used to delete user.
 * Notes: This operation is used to delete user.
 * Output-Formats: [application/json]
 */
Route::delete('/api/v1/user/{uuid}', 'UserController@deleteUser');
/**
 * patch modifyUser
 * Summary: Used to modify user.
 * Notes: This operation is used to modify user.
 * Output-Formats: [application/json]
 */
Route::patch('/api/v1/user/{uuid}', 'UserController@modifyUser');
/**
 * get retrieveUser
 * Summary: Used to retrieve user.
 * Notes: This operation is used to retrieve user.
 * Output-Formats: [application/json]
 */
Route::get('/api/v1/user/{uuid}', 'UserController@retrieveUser');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});