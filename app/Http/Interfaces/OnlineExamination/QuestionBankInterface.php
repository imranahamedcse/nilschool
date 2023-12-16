<?php

namespace App\Http\Interfaces\OnlineExamination;

interface QuestionBankInterface
{

    public function all();

    public function allActive();

    public function search($request);

    public function store($request);

    public function show($id);

    public function update($request, $id);

    public function destroy($id);

    public function getQuestionGroup($request);
}
