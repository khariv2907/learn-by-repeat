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
                    {!! Form::open(['route' => 'decks::create']) !!}

                    <div class="form-group row">
                        {!! Form::label('title', 'Title', ['class' => 'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Deck title']) !!}
                        </div>
                    </div>

                    <hr>
                    <div class="form-group row">
                        {!! Form::label('title', 'Title', ['class' => 'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Card title']) !!}
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-outline-secondary">Submit</button>
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
