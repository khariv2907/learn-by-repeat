@extends('layouts.frontend')

@section('content')
    <div class="row justify-content-md-center mb-4">

        <!-- Today -->
        <div class="col-md-8">
            <div class="card mb-4 box-shadow">
                <div class="card-header">
                    <p class="card-title h4">Today <small>({{ today()->format('d.m') }})</small></p>
                </div>
                <div class="card-body">
                    @include('deck._partials.decks-table', ['decks' => $today, 'type' => 'today'])
                    <a class="btn btn-outline-success" href="">Close Day</a>
                </div>
            </div>
        </div>

        <!-- Tomorrow -->
        <div class="col-md-8">
            <div class="card mb-4 box-shadow">
                <div class="card-header">
                    <p class="card-title h4">Tomorrow <small>({{ today()->addDay()->format('d.m') }})</small></p>
                </div>
                <div class="card-body">
                    @include('deck._partials.decks-table', ['decks' => $tomorrow, 'type' => 'tomorrow'])
                </div>
            </div>
        </div>

        <!-- Yesterday -->
        <div class="col-md-8">
            <div class="card mb-4 box-shadow">
                <div class="card-header">
                    <p class="card-title h4">Yesterday <small>({{ today()->subDay()->format('d.m') }})</small></p>
                </div>
                <div class="card-body">
                    @include('deck._partials.decks-table', ['decks' => $yesterday, 'type' => 'yesterday'])
                </div>
            </div>
        </div>

    </div>
@endsection
