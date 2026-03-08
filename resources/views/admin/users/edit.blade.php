@extends('admin.layouts.app')

@section('content')
<div class="container">

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white">
            <h5>Edit tab</h5>
        </div>

        <div class="card-body">

            <form action="{{ route('users.update', $tab->id) }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">

                    

                    <div class="col-md-8">

                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" name="name"
                                   class="form-control"
                                   value="{{ $tab->name }}">
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email"
                                   class="form-control"
                                   value="{{ $tab->email }}">
                        </div>
                        <div class="mb-3">
                        <select name="role_id" id="" class="form-control">
                            
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ old('role_id', $tab->role_id) == $role->id ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>

                         </div>
                         <a href="{{ route('users.table') }}"
                        class="btn btn-light me-3">
                        back
                    </a>
                        <button type="submit" class="btn btn-primary">
                            Update tab
                        </button>

                    </div>

                </div>

            </form>

        </div>
    </div>

</div>

<script>
function previewImage(event) {
    document.getElementById('preview').src =
        URL.createObjectURL(event.target.files[0]);
}
</script>

@endsection
