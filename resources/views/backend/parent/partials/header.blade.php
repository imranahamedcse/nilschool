<div class="row justify-content-between m-0 p-3 rounded-3 bg-white">
    <div class="col p-0">
        <span data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Menu">
            <button type="button" class="btn" id="btn-menu-bar">
                <i class="fa-solid fa-bars"></i>
            </button>
        </span>

        <span data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Search">
            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#searchModal">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </span>
    </div>

    <div class="col p-0 d-flex justify-content-center">
        <span data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="My Childs">
            <form action="{{ route('parent-panel-student.search') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="input-group">
                    <div class="px-1">
                        <select class="form-control @error('student') is-invalid @enderror" name="student">
                            <option value="">{{ ___('student_info.Select student') }}</option>
                            @foreach ($data['students'] as $item)
                                <option {{ old('student', Session::get('student_id')) == $item->id ? 'selected' : '' }}
                                    value="{{ $item->id }}">{{ $item->first_name }} {{ $item->last_name }}
                            @endforeach
                        </select>
                        @error('student')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="px-1">
                        <button class="btn btn-primary" type="submit">
                            {{ ___('common.Switch') }}
                        </button>
                    </div>
                </div>
            </form>
        </span>
    </div>

    <div class="col p-0 text-end">
        <span data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Full Screen">
            <button id="fullScreen" type="button" class="btn">
                <i class="fa-solid fa-expand"></i>
            </button>
        </span>

        <span data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Dark/Light Theme">
            <button id="theme" type="button" class="btn">
                <i class="fa-solid fa-sun"></i>
            </button>
        </span>

        <span data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Notifications">
            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#notificationModal">
                <i class="fa-solid fa-bell"></i>
            </button>
        </span>

        <div class="dropdown d-inline-block">
            <button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                <span data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Language">
                    <i class="fa-solid fa-globe"></i>
                </span>
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Bangla</a></li>
                <li><a class="dropdown-item" href="#">English</a></li>
                <li><a class="dropdown-item" href="#">Hindi</a></li>
            </ul>
        </div>

        <div class="dropdown d-inline-block">
            <button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                <span data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Profile">
                    <i class="fa-solid fa-face-smile"></i>
                </span>
            </button>
            <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item {{ set_menu(['parent-panel/profile'], 'active') }}" href="{{ route('parent-panel.profile') }}">
                        <span>{{ ___('common.my_profile') }}</span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item {{ set_menu(['parent-panel/password/update'], 'active') }}"
                        href="{{ route('parent-panel.password-update') }}">
                        <span>{{ ___('common.update_password') }}</span>
                    </a>
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <span>
                                {{ ___('common.logout') }}</span>
                        </button>
                    </form>
                </li>

            </ul>
        </div>
    </div>
</div>


<!-- Search Modal -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="searchModalLabel">Search</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
        </div>
    </div>
</div>

<!-- Notification Modal -->
<div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="notificationModalLabel">Notifications</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
        </div>
    </div>
</div>
