@extends('backend.admin.partial.master')

@section('title')
    {{ @$data['title'] }}
@endsection

@section('content')
    @include('backend.admin.components.breadcrumb')

    <div class="card">
        <div class="card-body">
            <div class="border-bottom pb-3 mb-4">
                <h4 class="m-0">{{ @$data['title'] }}</h4>
            </div>


            <form action="{{ route('roles.update', @$data['role']->id) }}" enctype="multipart/form-data" method="post"
                id="visitForm">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="validationDefault01" class="form-label ">{{ ___('create.name') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ @$data['role']->name }}" id="validationDefault01"
                                    placeholder="{{ ___('create.enter_name') }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label for="validationDefault02" class="form-label">{{ ___('create.status') }} <span
                                        class="text-danger">*</span></label>

                                <select class="form-control @error('status') is-invalid @enderror" name="status"
                                    id="validationDefault02">

                                    <option value="{{ App\Enums\Status::ACTIVE }}"
                                        {{ @$data['role']->status == App\Enums\Status::ACTIVE ? 'selected' : '' }}>
                                        {{ ___('create.active') }}</option>
                                    <option value="{{ App\Enums\Status::INACTIVE }}"
                                        {{ @$data['role']->status == App\Enums\Status::INACTIVE ? 'selected' : '' }}>
                                        {{ ___('create.inactive') }}
                                    </option>
                                </select>
                            </div>
                            @error('status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- table content start  -->
                        <div class="table-container mt-20 role-permisssion-control">
                            <!-- table container start  -->
                            <div class="table-responsive">
                                <!-- table start  -->
                                <table class="table table-bordered">
                                    <thead>
                                        <th class="user_roles_border">{{ ___('create.module_module_links') }}</th>
                                        <th class="user_roles_permission">{{ ___('create.Permissions') }}</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['permissions'] as $permission)
                                            <tr>
                                                <td>{{ ___('create.' . $permission->attribute) }}</td>
                                                <td>
                                                    @foreach ($permission->keywords as $key => $keyword)
                                                        <div class="form-check">
                                                            @if ($keyword != '')
                                                                <input type="checkbox"
                                                                    class="form-check-input"
                                                                    name="permissions[]"
                                                                    value="{{ $keyword }}"
                                                                    id="{{ $keyword }}"
                                                                    {{ in_array($keyword, @$data['role']->permissions ?? []) ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                    for="{{ $keyword }}">{{ ___('create.' . $key) }}</label>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- table end  -->
                            </div>
                            <!-- table container end  -->
                        </div>
                        <!-- table content end -->
                    </div>

                    <div class="col-md-12 mt-24">
                        <div class="text-end">
                            <button class="btn btn-primary"><span><i class="fa-solid fa-save"></i>
                                </span>{{ ___('create.update') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
