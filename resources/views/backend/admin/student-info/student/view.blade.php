
        <div class="modal-content" id="modalWidth">
            <div class="modal-header modal-header-image">
                <h5 class="modal-title" id="modalLabel2">
                    {{ ___('common.Students List') }}
                </h5>
                <button type="button" class="m-0 btn-close d-flex justify-content-center align-items-center"
                    data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times text-white"
                        aria-hidden="true"></i></button>
            </div>
            <div class="modal-body p-5">
                <div class="table-responsive table_height_450 niceScroll">
                    <table class="table table-bordered role-table" id="students_table">
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
                                    <td>{{ @$data['fees_assign']->class->name }}({{ @$data['fees_assign']->section->name }})</td>
                                    <td>{{ @$item->feesMaster->type->name }}</td>
                                    <td>{{ @$item->student->parent->guardian_name }}</td>
                                    <td>{{ @$item->student->mobile }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary py-2 px-4"
                    data-bs-dismiss="modal">{{ ___('common.cancel') }}</button>
                <button type="button" class="btn btn-primary"
                    data-bs-dismiss="modal">{{ ___('common.confirm') }}</button>
            </div>
        </div>
