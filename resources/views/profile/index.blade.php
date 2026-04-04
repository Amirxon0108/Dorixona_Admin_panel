@extends('admin.layouts.app')
@section('title', 'Profile')

@section('content')
<div class="container-fluid">

    <!-- Page Title -->
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h4 class="fw-bold">👤 Profile</h4>
        </div>
    </div>

    <div class="row">

        <!-- LEFT SIDE -->
        <div class="col-xl-9 col-lg-8">

            <!-- PROFILE CARD -->
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">

                <!-- HEADER -->
                <div class="bg-primary text-white p-4 position-relative">
                    <div class="d-flex align-items-center">

                        <div class="avatar-xl me-4 position-relative">
                            <img src="https://ui-avatars.com/api/?name="
                                 class="rounded-circle border border-3 border-white shadow"
                                 width="100">
                        </div>

                        <div>
                            <h4 class="mb-1">{{ Auth::user()->name }}</h4>
                            <p class="mb-1">
                                {{ Auth::user()->role->name ?? 'No Role Assigned' }}
                            </p>
                            <small>{{ Auth::user()->email }}</small>
                        </div>

                    </div>

                    <!-- EDIT BUTTON -->
                    <div class="position-absolute top-0 end-0 p-3">
                        <a href="{{ route('profile.edit', Auth::id()) }}"
                           class="btn btn-light btn-sm rounded-pill shadow-sm">
                            ✏ Edit
                        </a>
                    </div>
                </div>

                <!-- BODY -->
                <div class="card-body">

                    <div class="row text-center">

                        <div class="col-md-4">
                            <h6 class="text-muted">Department</h6>
                            <p class="fw-semibold">Development</p>
                        </div>

                        <div class="col-md-4">
                            <h6 class="text-muted">Email</h6>
                            <p class="fw-semibold">{{ Auth::user()->email }}</p>
                        </div>

                        <div class="col-md-4">
                            <h6 class="text-muted">Role</h6>
                            <p class="fw-semibold">
                                {{ Auth::user()->role->name ?? '-' }}
                            </p>
                        </div>

                    </div>

                </div>
            </div>

        </div>

        <!-- RIGHT SIDE -->
        <div class="col-xl-3 col-lg-4">

            <!-- SKILLS -->
            <div class="card shadow-sm border-0 rounded-4 mb-3">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">💻 Skills</h5>

                    <div class="d-flex flex-wrap gap-2">
                        @foreach(['Laravel','PHP','HTML','CSS','JavaScript','MySQL','REST API'] as $skill)
                            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">
                                {{ $skill }}
                            </span>
                        @endforeach
                    </div>

                </div>
            </div>

            <!-- PORTFOLIO -->
            <div class="card shadow-sm border-0 rounded-4 mb-3">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">🌐 Portfolio</h5>

                    <ul class="list-unstyled mb-0">
                        <li>
                            <a href="https://amirdev.page.gd" class="text-decoration-none d-block py-2">
                                🌍 Website
                            </a>
                        </li>
                        <li>
                            <a href="https://textopia.42web.io" class="text-decoration-none d-block py-2">
                                📝 Blog
                            </a>
                        </li>
                        <li>
                            <a href="https://tezkornews.ct.ws" class="text-decoration-none d-block py-2">
                                📰 News Blog
                            </a>
                        </li>
                    </ul>

                </div>
            </div>

            <!-- SIMILAR USERS -->
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">👥 Similar Users</h5>

                    @foreach($users as $u)
                        <div class="d-flex align-items-center mb-3 p-2 rounded hover-shadow"
                             style="transition: 0.3s;">
                            
                            <img src="https://ui-avatars.com/api/?name={{ $u->name }}"
                                 class="rounded-circle me-3" width="45">

                            <div>
                                <h6 class="mb-0">{{ $u->name }}</h6>
                                <small class="text-muted">
                                    {{ $u->role->name ?? 'No Role' }}
                                </small>
                            </div>

                        </div>
                    @endforeach

                </div>
            </div>

        </div>
    </div>
</div>

<!-- EXTRA STYLE -->
<style>
.hover-shadow:hover {
    box-shadow: 0 5px 15px rgba(0,0,0,0.15);
    transform: translateY(-2px);
}
</style>

@endsection