@extends('backend.admin.partial.master')

@section('title')
  Dashboard
@endsection

@push('style')
    <!-- -->
@endpush


@section('content')

<nav class="mt-3" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><strong>Dashboard</strong></li>
        <li class="breadcrumb-item active" aria-current="page">Datatatable</li>
    </ol>
</nav>

<div class="app-bar row justify-content-between m-0 p-3 rounded-4 rounded-bottom-0">
    <div class="col-4 align-self-center">
        <h4 class="m-0">Table Name</h4>
    </div>
    <div class="col-3">
        <div class="row">
                <div class="input-group">
                <div class="col-3 p-0">
                    <select class="form-select rounded-4 text-center rounded-end-0">
                        <option value="15">15</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div class="col-9 p-0">
                    <input type="text" class="form-control rounded-4 rounded-start-0" placeholder="Search...">
                </div>
            </div>
        </div>
    </div>
    <div class="col-4 text-end">
        <button type="button" class="btn btn-danger rounded-4">
            Delete all
        </button>
        <button type="button" class="btn btn-secondary rounded-4">
            Export
        </button>
        <button type="button" class="btn btn-primary rounded-4">
            Add
        </button>
    </div>
  </div>

<div class="app-bar border p-3">
    <div class="table-responsive">
        <table class="table table-bordered table-dark m-0">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                </tr>
                <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
                </tr>
                <tr>
                <th scope="row">3</th>
                <td colspan="2">Larry the Bird</td>
                <td>@twitter</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="app-bar text-center p-3 rounded-4 rounded-top-0">
    Paginations
</div>

@endsection

@push('script')
    <!-- -->
@endpush