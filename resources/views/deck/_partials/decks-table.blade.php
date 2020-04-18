<table class="table table-bordered decks-table">
    <thead class="thead-dark">
    <tr>
        <th scope="col" class="table-col-id">#</th>
        <th scope="col">Title</th>
        <th scope="col" class="table-col-repeat">
            {{ ($type === 'yesterday') ? 'Next' : 'Last' }} Repeat
        </th>
        <th scope="col" class="table-col-actions">Actions</th>
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
                    <button type="button" class="btn btn-outline-success btn-sm">Done</button>

                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-outline-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            More
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item" href="#">View History</a>

                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="#">Repeat Tomorrow</a>
                            <a class="dropdown-item" href="#">Repeat After 3 Days</a>
                            <a class="dropdown-item" href="#">Repeat In a Week</a>
                            <a class="dropdown-item" href="#">Repeat After 2 Week</a>
                            <a class="dropdown-item" href="#">Repeat In a Month</a>

                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="#">Disable</a>
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
