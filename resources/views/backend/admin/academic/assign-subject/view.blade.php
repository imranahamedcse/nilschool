<!-- Start Basic Modal -->

<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="basicModalLabel">{{ ___('index.Subject & Teacher') }}
        </h5>
        <button type="button" class="m-0 btn-close"
            data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times text-white" aria-hidden="true"></i></button>
    </div>
    <div class="modal-body">
        <div class="table-responsive">
            <table class="table">
                <thead class="thead">
                    <tr>
                        <th class="serial">{{ ___('index.subject') }}</th>
                        <th class="purchase">{{ ___('index.teacher') }}</th>
                    </tr>
                </thead>
                <tbody class="tbody">
                    @foreach ($data['subject_assign_children'] as $key => $row)
                        <tr>
                            <td>
                                {{ $row->subject->name }}<br>
                            </td>
                            <td>
                                {{ $row->teacher->first_name }} {{ $row->teacher->last_name }}<br>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- End Basic Modal -->
