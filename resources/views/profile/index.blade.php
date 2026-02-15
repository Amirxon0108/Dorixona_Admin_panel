@extends('admin.layouts.app')
@section('title', 'Profile')

@section('content')
     <div class="container-fluid">
      <!-- start page title -->
      <div class="row">
       <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
         <h4 class="mb-sm-0 font-size-18">
          Profile
         </h4>
         <div class="page-title-right">
          <ol class="breadcrumb m-0">
           <li class="breadcrumb-item">
            <a href="javascript: void(0);">
             Contacts
            </a>
           </li>
           <li class="breadcrumb-item active">
            Profile
           </li>
          </ol>
         </div>
        </div>
       </div>
      </div>
      <!-- end page title -->
      <div class="row">
       <div class="col-xl-9 col-lg-8">
        <div class="card">
         <div class="card-body">
          <div class="row">
           <div class="col-sm order-2 order-sm-1">
            <div class="d-flex align-items-start mt-3 mt-sm-0">
             <div class="flex-shrink-0">
              <div class="avatar-xl me-3">
               <img alt="" class="img-fluid rounded-circle d-block" src="assets/images/users/avatar-2.jpg"/>
              </div>
             </div>
             <div class="flex-grow-1">
              <div>
               <h5 class="font-size-16 mb-1">
                {{ Auth::user()->name }}
               </h5>
               <p class="text-muted font-size-13">
                {{ Auth::user()->role->name ?? 'No Role Assigned' }}
               </p>
               <div class="d-flex flex-wrap align-items-start gap-2 gap-lg-3 text-muted font-size-13">
                <div>
                 <i class="mdi mdi-circle-medium me-1 text-success align-middle">
                 </i>
                 Development
                </div>
                <div>
                 <i class="mdi mdi-circle-medium me-1 text-success align-middle">
                 </i>
                 {{Auth::user()->email}}
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="col-sm-auto order-1 order-sm-2">
            <div class="d-flex align-items-start justify-content-end gap-2">
            
              
               
              
             
             <div>
              <div class="dropdown">
               <button aria-expanded="false" class="btn btn-link font-size-16 shadow-none text-muted dropdown-toggle" data-bs-toggle="dropdown" type="button">
                <i class="bx bx-dots-horizontal-rounded">
                </i>
               </button>
               <ul class="dropdown-menu dropdown-menu-end">
                <li>
                 <a class="dropdown-item" href="{{ route('profile.edit') }}">
                  Edit
                 </a>
                </li>
                
                
               </ul>
              </div>
             </div>
            </div>
           </div>
          </div>
          
       </div>
       <!-- end col -->
       <div class="col-xl-3 col-lg-4">
        <div class="card">
         <div class="card-body">
          <h5 class="card-title mb-3">
           Skills
          </h5>
          <div class="d-flex flex-wrap gap-2 font-size-16">
           <a class="badge bg-primary-subtle text-primary" href="#">
            Laravel
           </a>
           <a class="badge bg-primary-subtle text-primary" href="#">
            PHP
           </a>
           <a class="badge bg-primary-subtle text-primary" href="#">
            HTML
           </a>
           <a class="badge bg-primary-subtle text-primary" href="#">
            CSS
           </a>
           <a class="badge bg-primary-subtle text-primary" href="#">
            Javascript
           </a>
           <a class="badge bg-primary-subtle text-primary" href="#">
           MySQL
           </a>
           <a class="badge bg-primary-subtle text-primary" href="#">
            REST API
           </a>
          </div>
         </div>
         <!-- end card body -->
        </div>
        <!-- end card -->
        <div class="card">
         <div class="card-body">
          <h5 class="card-title mb-3">
           Portfolio
          </h5>
          <div>
           <ul class="list-unstyled mb-0">
            <li>
             <a class="py-2 d-block text-muted" href="https://amirdev.page.gd">
              <i class="mdi mdi-web text-primary me-1">
              </i>
              Website
             </a>
            </li>
            <li>
             <a class="py-2 d-block text-muted" href="https://textopia.42web.io">
              <i class="mdi mdi-note-text-outline text-primary me-1">
              </i>
              Blog
             </a>
            </li>
             <li>
             <a class="py-2 d-block text-muted" href="https://tezkornews.ct.ws">
              <i class="mdi mdi-note-text-outline text-primary me-1">
              </i>
             News Blog
             </a>
            </li>
           </ul>
           
          </div>
         </div>
         <!-- end card body -->
        </div>
        <!-- end card -->
        <div class="card">
         <div class="card-body">
          <h5 class="card-title mb-3">
           Similar Profiles
          </h5>
          <div class="list-group list-group-flush">
            @foreach($users as $user)
           <a class="list-group-item list-group-item-action" href="#">
            <div class="d-flex align-items-center">
             <div class="avatar-sm flex-shrink-0 me-3">
              <img alt="" class="img-thumbnail rounded-circle" src="assets/images/users/avatar-1.jpg"/>
             </div>
             <div class="flex-grow-1">
              <div>
               <h5 class="font-size-14 mb-1">
                {{ $user->name }}
               </h5>
               <p class="font-size-13 text-muted mb-0">
                {{ $user->role->name ?? 'Role not assignment' }}
               </p>
              </div>
             </div>
            </div>
           </a>
          @endforeach
          </div>
         </div>
         <!-- end card body -->
        </div>
        <!-- end card -->
       </div>
       <!-- end col -->
      </div>
      <!-- end row -->
     </div>
     <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    <footer class="footer">
     <div class="container-fluid">
      <div class="row">
       <div class="col-sm-6">
        <script>
         document.write(new Date().getFullYear())
        </script>
       © StarCode Kh.
       </div>
       <div class="col-sm-6">
        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block"> Design &amp; Custom by
                                <a class="text-decoration-underline" href="https://www.admintem.com/" target="_blank">admintem.com</a>
                            </div>
                        </div>
       </div>
      </div>
     </div>
    </footer>
   </div>
   <!-- end main content-->
  </div>
  <!-- END layout-wrapper -->
  <!-- Right Sidebar -->
  @endsection