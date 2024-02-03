 <!--Start Customize Width Modal -->


     <div class="modal-content" id="modalWidth">
         <div class="modal-header modal-header-image">
             <h5 class="modal-title" id="modalLabel2">
                 {{ ___('index.Student List') }}
             </h5>
             <button type="button" onclick="dismissModal()" class="m-0 btn-close d-flex justify-content-center align-items-center"
                 data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times text-white"
                     aria-hidden="true"></i></button>
         </div>
         <div class="modal-body p-5">
            <div class="table-responsive table_height_450 niceScroll">
                <table class="table table-bg">
                    <thead class="thead">
                        <tr>
                            <th class="serial">{{ ___('index.sr_no') }}</th>
                            <th class="purchase">{{ ___('index.admission_no') }}</th>
                            <th class="purchase">{{ ___('index.Student Name') }}</th>
                            <th class="purchase">{{ ___('index.guardian_name') }}</th>
                            <th class="purchase">{{ ___('index.Mobile Number') }}</th>
                            <th class="purchase">{{ ___('index.Answer') }}</th>
                            <th class="purchase">{{ ___('index.Result') }}</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @foreach ($data->examStudents as $key=>$item)
                        <tr id="document-file">
                            <td>{{ ++$key }}</td>
                            <td>{{ $item->student->admission_no }}</td>
                            <td>{{ $item->student->first_name }} {{ $item->student->last_name }}</td>
                            <td>{{ $item->student->parent->guardian_name }}</td>
                            <td>{{ $item->student->mobile }}</td>
                            <td>
                                @if (in_array($item->student->id, $data->studentAnswer->pluck('student_id')->toArray()))
                                    <a target="_blank" href="{{ route('online-exam.answer',[$data->id, $item->student->id]) }}" class="btn btn-sm btn-primary">
                                        <span><i class="fa-solid fa-eye"></i></span>
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $data->studentAnswer->where('student_id', $item->student->id)->first()->result ?? '' }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
         </div>
         <div class="modal-footer">
             <button type="button" class="btn btn-outline-secondary py-2 px-4"
                 data-bs-dismiss="modal">{{ ___('index.cancel') }}</button>
         </div>
     </div>


<!-- End Customize Width  -->
