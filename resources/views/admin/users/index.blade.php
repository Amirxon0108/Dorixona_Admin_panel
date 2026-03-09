@extends('admin.layouts.app')
@section('title', 'Foydalanuvchilar')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Foydalanuvchilar</h4>
            </div>
        </div>
    </div>

    @if(session()->has('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if(session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Foydalanuvchilar ro'yxati</h4>
                    <a href="{{ route('users.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Yangi foydalanuvchi
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered dt-responsive nowrap w-100" id="datauserle">
                        <thead class="table-light">
                            <tr>
                                <th>Nomi</th>
                                <th>Email</th>
                                <th>Roli</th>
                                <th class="text-center">Amallar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td><span class="badge bg-info">{{ $user->role->name ?? 'Aniqlanmagan' }}</span></td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-info text-white">Ko'rish</a>
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning text-white">Tahrirlash</a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('O\'chirmoqchimisiz?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">O'chirish</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection