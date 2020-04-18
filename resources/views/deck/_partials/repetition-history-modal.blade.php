<!-- Modal -->
<div class="modal fade" id="cardHistoryModal" tabindex="-1" role="dialog" aria-labelledby="cardHistoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cardHistoryModalLabel">Repetition History</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered decks-table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="table-col-id">#</th>
                        <th scope="col" class="table-col-id">Step</th>
                        <th scope="col" class="table-col-repeat">Repetition</th>
                        <th scope="col" class="table-col-status">Status</th>
                    </tr>
                    </thead>
                    @foreach($repetitions as $repetition)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $repetition->iteration }}</td>
                            <td class="text-center">{{ $repetition->repeat_at }}</td>
                            <td class="text-center">
                                @if($repetition->status)
                                    <span class="badge badge-success">To do</span>
                                @else
                                    <span class="badge badge-danger">Done</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
