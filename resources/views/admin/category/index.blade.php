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
            <a href="{{ route('category.create') }}">Yangi qo'shish</a>           
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
            @foreach ($categories as $category)
            <tr>
             <td>
              {{ $category->name }}
             </td>
            
             <td>
             {{ $category->parent_id }}
             </td>
             <td>
              {{ $category->slug }}
             </td>
             
             <td>
                <a href="{{ route('category.edit', $category->id) }}">edit</a> <br>
            <a href="{{ route('category.show', $category->id) }}">ko'rish</a>
            <a href="{{ route('category.destroy', $category->id) }}">delete</a>
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