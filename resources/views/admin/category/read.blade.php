@extends('admin.layouts.app')

@section('content')
<div class="container">

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <div class="row">
                

                <div class="col-md-8">

                    <h4>{{ $category->name }}</h4>
                    <p><strong>Slug:</strong> {{ $category->slug }}</p>
                   
                    <p><strong>Parent id:</strong> {{ $category->parent_id }}</p>
                  
                    <a href="{{ route('category.index') }}"
                        class="btn btn-light me-3">
                        back
                    </a>
                    <a href="{{ route('category.edit', $category->id) }}"
                       class="btn btn-primary mt-3">
                        Edit category
                    </a>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection
