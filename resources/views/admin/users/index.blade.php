@extends('admin.layouts.app')
@section('title', 'Medicines')

@section('content')


<div class="container-fluid">
      <!-- start page title -->
      <div class="row">
       <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
         <h4 class="mb-sm-0 font-size-18">
          DataTables
         </h4>
         <div class="page-title-right">
          <ol class="breadcrumb m-0">
           <li class="breadcrumb-item">
            <a href="javascript: void(0);">
             Tables
            </a>
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
           </li>
           <li class="breadcrumb-item active">
            DataTables
           </li>
          </ol>
         </div>
        </div>
       </div>
      </div>
      <!-- end page title -->
      <div class="row">
       <div class="col-12">
        <div class="card">
         <div class="card-header">
          <h4 class="card-title">
           Default Datatable
          </h4>
          <p class="card-title-desc">
            <a href="{{ route('users.create') }}">Yangi qo'shish</a>           
          </p>
         </div>
         <div class="card-body">
          <table class="table table-bordered dt-responsive nowrap w-100" id="datatable">
           <thead>
            <tr>
             <th>
              Nomi
             </th>
             <th>
              Tartibi
             </th>
             <th>
              Slug
             </th>
             
              <th>
              Action
             </th>
            </tr>
           </thead>
           <tbody>
            @foreach ($table as $tab)
            <tr>
             <td>
              {{ $tab->name }}
             </td>
            
             <td>
             {{ $tab->email }}
             </td>
             <td>
              {{ $tab->role->name }}
             </td>
             
             
             
             @endforeach
            </tr>
            
            
            
           </tbody>
          </table>
         </div>
        </div>
       </div>
       <!-- end col -->
      </div>
      <!-- end row -->
       
     </div>
@endsection