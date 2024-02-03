 <!--Start Customize Width Modal -->


     <div class="modal-content" id="modalWidth">
         <div class="modal-header modal-header-image">
             <h5 class="modal-title" id="modalLabel2">
                 {{ ___('common.Question List') }}
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
                            <th>{{ ___('common.sr_no') }}</th>
                            <th class="purchase">{{ ___('common.question') }}</th>
                            <th class="purchase">{{ ___('common.Mark') }}</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @foreach ($data->examQuestions as $key=>$item)
                        <tr id="document-file">
                            <td>{{ ++$key }}</td>
                            <td>

                                {{ $item->question->question }} <br>

                                @if ($item->question->type == 1)

                                    @for($i = 0; $i < $item->question->total_option; $i++)
                                        {{++$i}}. {{$item->question->questionOptions[--$i]->option}} <br>
                                    @endfor
                                    {{ ___('common.Answer') }}: {{$item->question->answer}}.

                                @elseif ($item->question->type == 2)

                                    @for($i = 0; $i < $item->question->total_option; $i++)
                                        {{++$i}}. {{$item->question->questionOptions[--$i]->option}} <br>
                                    @endfor
                                    {{ ___('common.Answer') }}:
                                    @foreach ($item->question->answer as $ans)
                                        {{$ans}}.
                                    @endforeach

                                @elseif($item->question->type == 3)

                                    {{ ___('common.1') }}. {{ ___('common.True') }} <br>
                                    {{ ___('common.2') }}. {{ ___('common.False') }} <br>

                                    {{ ___('common.Answer') }}: {{$item->question->answer}}.

                                @endif

                            </td>
                            <td>{{ $item->question->mark }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
         </div>
         <div class="modal-footer">
             <button type="button" class="btn btn-outline-secondary py-2 px-4"
                 data-bs-dismiss="modal">{{ ___('common.cancel') }}</button>
         </div>
     </div>


<!-- End Customize Width  -->
