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
            <a href="{{ route('medicine.create') }}">Yangi qo'shish</a>           
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
              Tarkibi
             </th>
             <th>
              Description
             </th>
             <th>
              Kategoriya
             </th>
             <th>
              Barcode
             </th>
             <th>
              Narxi_S
             </th>
             <th>
              Narxi_K
             </th>
             <th>
              Soni
             </th>
             <th>
              Muddati
             </th>
             <th>
              Rasmi
             </th>
             <th>
              Status
             </th>
              <th>
              Action
             </th>
            </tr>
           </thead>
           <tbody>
            @foreach($medicines as $med)
            <tr>
             <td>
             {{$med->name}}
             </td>
             <td>
              {{$med->generic_name}}
             </td>
             <td>
              {{$med->description}}
             </td>
             <td>
              {{$med->category->name}}
             </td>
             <td>
              {{$med->barcode}}
             </td>
             <td>
             {{$med->buy_price}}
             </td>
             <td>
            {{$med->sell_price}}
             </td>
             <td>
              {{$med->quantity}}
             </td>
              <td>
              {{$med->expiry_date}}
             </td>
             <td>
             <img src="{{ asset('storage/' . $med->image) }}" alt="Rasm" width="70">
             </td>
             <td>
              @if($med->is_active == 1)
              <span class="badge badge-success" style="background-color: #28a745; color: white; padding: 5px 10px; border-radius: 4px;">
                  Faol
              </span>
              @else
                  <span class="badge badge-danger" style="background-color: #dc3545; color: white; padding: 5px 10px; border-radius: 4px;">
                      Nofaol
                  </span>
              @endif
             </td>
             <td>
                <a href="{{ route('medicine.edit', $med->id) }}">edit</a> <br>
            <a href="{{ route('medicine.show', $med->id) }}">ko'rish</a>
            <form action="{{ route('medicine.destroy', $med->id) }}" method="POST" onsubmit="return confirm('Haqiqatdan ham o'chirmoqchimisiz?')">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm">
        <i class="bx bx-trash"></i> Delete
    </button>
</form>
             </td>
            </tr>
            @endforeach
            
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
