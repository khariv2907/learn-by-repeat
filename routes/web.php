<?php

use Illuminate\Support\Facades\Route;


Route::get('/', [
    'uses' => 'DeckController@dashboard',
    'as' => 'home'
]);

Route::get('/decks', [
    'uses' => 'DeckController@decks',
    'as' => 'decks'
]);

Route::get('/decks/create-form', [
    'uses' => 'DeckController@create',
    'as' => 'decks::createForm'
]);
