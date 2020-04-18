<table class="table table-bordered decks-table">
    <thead class="thead-dark">
    <tr>
        <th scope="col" class="table-col-id">#</th>
        <th scope="col">Title</th>
        <th scope="col" class="table-col-repeat">
            {{ ($type === 'yesterday') ? 'Next' : 'Last' }} Repeat
        </th>
        <th scope="col" class="{{ ($type === 'today') ? 'table-col-actions' : 'table-col-actions-100' }}">Actions</th>
    </tr>
    </thead>
    @forelse($decks as $deck)
        <tr class="table-info">
            <td colspan="4">{{ $deck->title }}</td>
        </tr>

        @foreach($deck->cards as $card)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $card->title }}</td>
                <td class="text-center">{{ $card->repeat_at }}</td>
                <td class="text-center">
                    @if($type === 'today')
                        <a href="{{ route('cards::doneRepetition', $card->id) }}" class="btn btn-outline-success btn-sm">Done</a>
                    @endif

                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-outline-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            More
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item js-view-history" href="#" data-id="{{ $card->id }}">View History</a>

                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="{{ route('cards::postponeRepetition', [$card->id, 1]) }}">Repeat Tomorrow</a>
                            <a class="dropdown-item" href="{{ route('cards::postponeRepetition', [$card->id, 3]) }}">Repeat After 3 Days</a>
                            <a class="dropdown-item" href="{{ route('cards::postponeRepetition', [$card->id, 7]) }}">Repeat In a Week</a>
                            <a class="dropdown-item" href="{{ route('cards::postponeRepetition', [$card->id, 14]) }}">Repeat After 2 Week</a>
                            <a class="dropdown-item" href="{{ route('cards::postponeRepetition', [$card->id, 30]) }}">Repeat In a Month</a>

                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="{{ route('cards::changeStatus', $card->id) }}">
                                {{ ($card->status ? 'Disable' : 'Activate') }}
                            </a>
                        </div>
                    </div>

                </td>
            </tr>
        @endforeach
    @empty
        <tr >
            <td colspan="4">* no cards</td>
        </tr>
    @endforelse
</table>
