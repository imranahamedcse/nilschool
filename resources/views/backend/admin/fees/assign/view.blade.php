<div class="modal-content" id="modalWidth">
    <div class="modal-header">
        <h5 class="modal-title">
            {{ ___('common.Students List') }}
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    
    <div class="modal-body">
        <table id="datatable" class="table">
            <thead class="thead">
                <tr>
                    <th class="purchase">{{ ___('common.admission_no') }}</th>
                    <th class="purchase">{{ ___('common.Student Name') }}</th>
                    <th class="purchase">{{ ___('common.class') }}({{ ___('common.section') }})</th>
                    <th class="purchase">{{ ___('common.fees_type') }}</th>
                    <th class="purchase">{{ ___('common.guardian_name') }}</th>
                    <th class="purchase">{{ ___('common.Mobile Number') }}</th>
                </tr>
            </thead>
            <tbody class="tbody">
                @foreach ($data['fees_assign']->feesAssignChilds as $item)
                    <tr id="document-file">
                        <td>{{ @$item->student->admission_no }}</td>
                        <td>{{ @$item->student->first_name }} {{ @$item->student->last_name }}</td>
                        <td>{{ @$data['fees_assign']->class->name }}({{ @$data['fees_assign']->section->name }})
                        </td>
                        <td>{{ @$item->feesMaster->type->name }}</td>
                        <td>{{ @$item->student->parent->guardian_name }}</td>
                        <td>{{ @$item->student->mobile }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>