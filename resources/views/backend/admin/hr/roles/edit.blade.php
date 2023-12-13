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
                                <label for="validationDefault01" class="form-label ">{{ ___('common.name') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ @$data['role']->name }}" id="validationDefault01"
                                    placeholder="{{ ___('common.enter_name') }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label for="validationDefault02" class="form-label">{{ ___('common.status') }} <span
                                        class="text-danger">*</span></label>

                                <select class="form-control @error('status') is-invalid @enderror" name="status"
                                    id="validationDefault02">

                                    <option value="{{ App\Enums\Status::ACTIVE }}"
                                        {{ @$data['role']->status == App\Enums\Status::ACTIVE ? 'selected' : '' }}>
                                        {{ ___('common.active') }}</option>
                                    <option value="{{ App\Enums\Status::INACTIVE }}"
                                        {{ @$data['role']->status == App\Enums\Status::INACTIVE ? 'selected' : '' }}>
                                        {{ ___('common.inactive') }}
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
                                <table class="basic-table table-bg">
                                    <thead>
                                        <th class="user_roles_border">{{ ___('users_roles.module_module_links') }}</th>
                                        <th class="user_roles_permission">{{ ___('users_roles.Permissions') }}</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['permissions'] as $permission)
                                            <tr>
                                                <td>{{ ___('users_roles.' . $permission->attribute) }}</td>
                                                <td>
                                                    <div class="permission-list-td">
                                                        @foreach ($permission->keywords as $key => $keyword)
                                                            <div class="input-check-radio">
                                                                <div class="form-check d-flex align-items-center">
                                                                    @if ($keyword != '')
                                                                        <input type="checkbox"
                                                                            class="form-check-input mr-4 read common-key"
                                                                            name="permissions[]"
                                                                            value="{{ $keyword }}"
                                                                            id="{{ $keyword }}"
                                                                            {{ in_array($keyword, @$data['role']->permissions ?? []) ? 'checked' : '' }}>
                                                                        <label class="custom-control-label"
                                                                            for="{{ $keyword }}">{{ ___('users_roles.' . $key) }}</label>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
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
                                </span>{{ ___('common.update') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
