@extends('admin.layouts.app')
@section('title', 'purchases')

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
            <a href="{{ route('purchase.create') }}">Yangi qo'shish</a>           
          </p>
         </div>
         <div class="card-body">
          <table class="table table-bordered dt-responsive nowrap w-100" id="datatable">
           <thead>
            <tr>
            
             <th>
              Yetkazib ber
             </th>
             <th>
             olgan
             </th>
             
              <th>
             nomer
             </th>
             <th>
             olingan sana
             </th>
            <th>
             jami
             </th>
             <th>
             description
             </th>
             <th>
             Action
             </th>
             
            
            </tr>
           </thead>
           <tbody>
            @foreach ($purchases as $purchase)
            <tr>
             <td>
              {{ $purchase->supplier_id }}
             </td>
            
             <td>
             {{ $purchase->user_id }}
             </td>
             <td>
              {{ $purchase->purchase_no }}
             </td>
             <td>
              {{ $purchase->purchase_date }}
             </td>
             <td>
              {{ $purchase->total_amount }}
             </td>
             <td>
              {{ $purchase->description }}
             </td>
             
             <td>
                <a href="{{ route('purchase.edit', $purchase->id) }}">edit</a> <br>
            <a href="{{ route('purchase.show', $purchase->id) }}">ko'rish</a>

            <form action="{{ route('purchase.destroy', $purchase->id) }}"  method ="POST">
              @csrf
              @method('DELETE').
              <input type="submit" value="ochir">
            </form>
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