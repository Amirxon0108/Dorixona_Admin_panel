@extends('admin.layouts.app')

@section('content')
<div class="container">

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <div class="row">
                

                <div class="col-md-8">

                    <h4>{{ $tab->name }}</h4>
                    <p><strong>Email:</strong> {{ $tab->email }}</p>
                   
                    <p><strong>Role</strong> {{ $tab->role->name }}</p>
                  
                    <a href="{{ route('users.table') }}"
                        class="btn btn-light me-3">
                        back
                    </a>
                    <a href="{{ route('users.edit', $tab->id) }}"
                       class="btn btn-primary mt-3">
                        Edit tab
                    </a>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection
