@extends('admin.layouts.app')

@section('content')
<div class="container">

    <div class="card shadow-sm border-0">
         @if(session()->has('error'))  <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-danger">
                {!! session('error') !!}
            </div>
        </div>
    </div>
@endif
@if(session()->has(key: 'success'))  <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-primary">
                {!! session('success') !!}
            </div>
        </div>
    </div>
@endif
        <div class="card-body">

            <div class="row">
                

                <div class="col-md-8">

                    <h4>{{ $supplier->name }}</h4>
                    <p><strong>phone:</strong> {{ $supplier->phone }}</p>
                   
                    <p><strong>Address:</strong> {{ $supplier->address }}</p>
                  
                    <a href="{{ route('supplier.index') }}"
                        class="btn btn-light me-3">
                        back
                    </a>
                    <a href="{{ route('supplier.edit', $supplier->id) }}"
                       class="btn btn-primary mt-3">
                        Edit supplier
                    </a>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection
