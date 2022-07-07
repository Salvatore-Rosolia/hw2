<?php

use Illuminate\Support\Facades\Route;

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
# QUANDO NON METTO NULLA NELL'URL VERRò RIMANDATO ALLA PAGINA DI LOGIN
Route::get('/', function () {
    return view('register');
});


# FUNZIONE DI INVIO DATI PER REGISTRARE/CREARE L'UTENTE
Route::get('/register', 'App\Http\Controllers\RegisterController@register_form');
Route::post('/register', 'App\Http\Controllers\RegisterController@registrazione');
Route::get('/check_username/{username}', 'App\Http\Controllers\RegisterController@check_username');
Route::get('/check_email/{email}', 'App\Http\Controllers\RegisterController@check_email');




Route::get('/logout', 'App\Http\Controllers\RegisterController@logout');
Route::get('/login', 'App\Http\Controllers\LoginController@login_form');
Route::post('/login', 'App\Http\Controllers\LoginController@do_login');

Route::get('home', 'App\Http\Controllers\GestionController@home');

Route::get('/show_post', 'App\Http\Controllers\GestionController@show_post');
Route::get('/show_comments/{idp}','App\Http\Controllers\GestionController@show_comments' );
Route::get('/remove_comment/{idc}','App\Http\Controllers\GestionController@remove_comment' );
Route::post('add_comment', 'App\Http\Controllers\GestionController@add_comment');

// salva il nuovo_post nel DB
Route::post('/new_post', 'App\Http\Controllers\GestionController@new_post');

// cerca contenuto
Route::get('post/search/{title}', 'App\Http\Controllers\GestionController@search');

Route::get('load_user_case', 'App\Http\Controllers\GestionController@load_user_case');

//controlli dei likesPost
Route::get('controll_like/{c}','App\Http\Controllers\GestionController@controll_like' );
Route::get('add_like/{id_post}', 'App\Http\Controllers\GestionController@add_like');
Route::get('remove_like/{box}', 'App\Http\Controllers\GestionController@remove_like');


//controlli per la ricerca degli utenti
Route::get('search_people/{username}','App\Http\Controllers\GestionController@search_people' );


// controlli per chat

Route::get('check_chat/{iduser}','App\Http\Controllers\ChatController@check_chat' );
Route::get('create_chat_db/{iduser}', 'App\Http\Controllers\ChatController@create_chat_db' );
Route::get('cerca_persone/{usd}','App\Http\Controllers\ChatController@cerca_persone' );
Route::get('chat/{idchat}','App\Http\Controllers\ChatController@chat' );
Route::get('send_mess/{idch}/{mess}','App\Http\Controllers\ChatController@send_mess' );


?>
