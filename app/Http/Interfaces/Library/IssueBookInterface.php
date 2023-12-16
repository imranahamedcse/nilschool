<?php

namespace App\Http\Interfaces\Library;

interface IssueBookInterface
{
    public function all();

    public function getAll();

    public function store($request);

    public function show($id);

    public function update($request, $id);

    public function destroy($id);

    public function getMember($request);

    public function getBooks($request);

    public function return($id);

    public function searchResult($request);

    public function getUser($id);

    public function getBook($id);
}
