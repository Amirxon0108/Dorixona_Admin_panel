@extends('admin.layouts.app')
@section('title', 'Foydalanuvchi ma\'lumotlari')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0">Foydalanuvchi profili</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Ismi:</strong>
                            <span>{{ $user->name }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Email:</strong>
                            <span>{{ $user->email }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Roli:</strong>
                            <span class="badge bg-primary rounded-pill">{{ $user->role->name ?? 'Belgilanmagan' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Ro'yxatdan o'tgan:</strong>
                            <span>{{ $user->created_at ? $user->created_at->format('d.m.Y H:i') : 'Noma\'lum' }}</span>
                        </li>
                    </ul>

                    <div class="mt-4">
                        <a href="{{ route('users.table') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left"></i> Orqaga
                        </a>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary px-4">
                            <i class="fas fa-edit"></i> Tahrirlash
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection