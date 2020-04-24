<?php

use Illuminate\Support\Facades\Route;


Route::get('/', [
    'uses' => 'DeckController@dashboard',
    'as' => 'home'
]);

/**
 * Decks
 */
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


/**
 * Cards
 */
Route::get('/cards/ajax-view-history', [
    'uses' => 'CardController@ajaxViewHistory',
]);

Route::get('/cards/change-status/{id}', [
    'uses' => 'CardController@changeStatus',
    'as' => 'cards::changeStatus'
])->where('id', '[0-9]+');


/**
 * Repetition
 */
Route::get('/repetition/done-repetition/{id}', [
    'uses' => 'RepetitionController@doneRepetition',
    'as' => 'repetitions::doneRepetition'
])->where('id', '[0-9]+');

Route::get('/repetition/postpone-repetition/{id}/{days}', [
    'uses' => 'RepetitionController@postponeRepetition',
    'as' => 'repetitions::postponeRepetition'
])->where(['id' => '[0-9]+', 'days' => '[0-9]+']);

Route::get('/repetition/close-day', [
    'uses' => 'RepetitionController@closeDay',
    'as' => 'repetitions::closeDay'
]);
