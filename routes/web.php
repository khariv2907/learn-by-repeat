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

Route::get('/decks/change-status/{id}', [
    'uses' => 'DeckController@changeStatus',
    'as' => 'decks::changeStatus'
])->where('id', '[0-9]+');

Route::get('/decks/create-form', [
    'uses' => 'DeckController@createForm',
    'as' => 'decks::createForm'
]);

Route::post('/decks/create-form', [
    'before' => 'csrf',
    'uses' => 'DeckController@store',
    'as' => 'decks::store'
]);

Route::get('/cards/ajax-view-history', [
    'uses' => 'CardController@ajaxViewHistory',
]);

Route::get('/cards/change-status/{id}', [
    'uses' => 'CardController@changeStatus',
    'as' => 'cards::changeStatus'
])->where('id', '[0-9]+');

Route::get('/cards/done-repetition/{id}', [
    'uses' => 'CardController@doneRepetition',
    'as' => 'cards::doneRepetition'
])->where('id', '[0-9]+');

Route::get('/cards/postpone-repetition/{id}/{days}', [
    'uses' => 'CardController@postponeRepetition',
    'as' => 'cards::postponeRepetition'
])->where(['id' => '[0-9]+', 'days' => '[0-9]+']);

Route::get('/cards/close-day', [
    'uses' => 'CardController@closeDay',
    'as' => 'cards::closeDay'
]);
