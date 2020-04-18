@extends('layouts.frontend')

@section('container', 'container-fluid')

@section('content')
    <div class="row justify-content-md-center mb-4">

        @isset($decks)
            @forelse($decks as $deck)
                <!-- Deck -->
                <div class="col-md-6">
                    <div class="card mb-4 box-shadow">
                        <div class="card-header">
                            <p class="card-title">
                                <span class="h4">
                                    @if($deck->status)
                                        {{ $deck->title }}
                                    @else
                                        <del>{{ $deck->title }}</del>
                                    @endif
                                </span>
                                <a href="{{ route('decks::changeStatus', $deck->id) }}" class="float-right" style="line-height: 200%;">
                                    {{ ($deck->status ? 'Disable' : 'Activate') }}
                                </a>
                            </p>
                        </div>
                        <div class="card-body">

                            <table class="table table-bordered cards-table">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="table-col-id">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col" class="table-col-id">Step</th>
                                    <th scope="col" class="table-col-repeat">Repeat at</th>
                                    <th scope="col" class="table-col-status">Status</th>
                                    <th scope="col" class="table-col-actions-100">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($deck->cards as $card)
                                    <tr>
                                        <!-- iteration -->
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <!-- title -->
                                        <td>
                                            @if($card->status)
                                                {{ $card->title }}
                                            @else
                                                <del>{{ $card->title }}</del>
                                            @endif
                                        </td>
                                        <!-- step -->
                                        <td class="text-center">{{ $card->nearestRepetition->iteration }}</td>
                                        <!-- repeat at -->
                                        <td class="text-center">{{ $card->nearestRepetition->repeat_at }}</td>
                                        <!-- status -->
                                        <td class="text-center">
                                            @if($card->status)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">Disabled</span>
                                            @endif
                                        </td>
                                        <!-- actions -->
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-outline-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    More
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                    <a href="#" class="dropdown-item js-view-history" data-id="{{ $card->id }}">View History</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="{{ route('cards::changeStatus', $card->id) }}">
                                                        {{ ($card->status ? 'Disable' : 'Activate') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    * no cards
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        @if(!$deck->status)
                            <div class="card-footer">
                                <small class="text-muted">Disabled</small>
                            </div>
                        @endif

                    </div>
                </div>
            @empty
                <p>* no decks</p>
            @endforelse
        @endisset
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\CreateDeckRequest') !!}
@endsection
