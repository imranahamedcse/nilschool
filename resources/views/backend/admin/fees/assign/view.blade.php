<div class="modal-content" id="modalWidth">
    <div class="modal-header">
        <h5 class="modal-title">
            {{ ___('index.Students List') }}
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body">
        <table id="datatable" class="table">
            <thead class="thead">
                <tr>
                    <th class="purchase">{{ ___('index.admission_no') }}</th>
                    <th class="purchase">{{ ___('index.Student Name') }}</th>
                    <th class="purchase">{{ ___('index.class') }}({{ ___('index.section') }})</th>
                    <th class="purchase">{{ ___('index.guardian_name') }}</th>
                    <th class="purchase">{{ ___('index.Mobile Number') }}</th>
                    <th class="purchase">{{ ___('index.fees_type') }}</th>
                </tr>
            </thead>
            <tbody class="tbody">
                @foreach ($data['fees_assign']->feesAssignStudents as $item)
                    <tr id="document-file">
                        <td>{{ @$item->student->admission_no }}</td>
                        <td>{{ @$item->student->first_name }} {{ @$item->student->last_name }}</td>
                        <td>{{ @$data['fees_assign']->class->name }}({{ @$data['fees_assign']->section->name }})
                        </td>
                        <td>{{ @$item->student->parent->guardian_name }}</td>
                        <td>{{ @$item->student->mobile }}</td>
                        <td>
                            <ul>
                                @foreach ($item->feesAssignStudentsChilds as $item)
                                    <li>{{ $item->feesType->name }}</li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
