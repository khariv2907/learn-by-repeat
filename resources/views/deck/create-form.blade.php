@extends('layouts.frontend')

@section('content')
    <div class="row justify-content-md-center mb-4">
        <!-- Standard creation -->
        <div class="col-md-6">
            <div class="card mb-4 box-shadow">
                <div class="card-header">
                    <p class="card-title h4">Standard Deck Creation</p>
                </div>
                <div class="card-body">
                    <!-- form -->
                    {!! Form::open(['route' => 'decks::store']) !!}
                    <div class="form-group row">
                        {!! Form::label('title', 'Title', ['class' => 'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Deck Title']) !!}
                        </div>
                    </div>

                    <hr>

                    <div class="form-group row">
                        {!! Form::label('title', 'Cards:', ['class' => 'col-sm-2 col-form-label']) !!}

                        <div class="col-sm-10 js-form-cards-group">
                            <div class="mb-2">
                                {!! Form::text('cards[0][title]', null, ['class' => 'form-control js-card-title-input', 'placeholder' => 'Card Title #1']) !!}
                            </div>
                            <div class="mb-2">
                                {!! Form::text('cards[][title]', null, ['class' => 'form-control js-card-title-input', 'placeholder' => 'Card Title #2']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            {!! Form::button('Add card', ['class' => 'btn btn-light js-add-one-more-card',]) !!}
                        </div>
                    </div>
                    {!! Form::submit('Save', ['class' => 'btn btn-outline-secondary']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        <!-- Mass creation -->
        <div class="col-md-6">
            <div class="card mb-4 box-shadow">
                <div class="card-header">
                    <p class="card-title h4">Mass Cards Deck Creation</p>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>

</div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\CreateDeckRequest') !!}
@endsection
