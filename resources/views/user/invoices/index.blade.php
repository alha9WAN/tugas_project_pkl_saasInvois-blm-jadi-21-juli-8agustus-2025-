@extends('adminlte::page')


@section('title', 'Clients Management')


@section('content_header')
   <h1>Invoices </h1>
@stop


@section('content')



   <div class="container-fluid">
       <!-- Toolbar -->
       <div class="d-flex justify-content-between align-items-center mb-3">
           <a href="/user/invoices/create" type="button" class="btn btn-primary" >
               <i class="bi bi-plus-circle me-1 "></i> Tambah Invoices
           </a>
       </div>


       <!-- Search & Filter -->
       <div class="row mb-3">
           <div class="col-md-6">
               <form action="">
               <div class="input-group">
                   <input type="text" class="form-control" placeholder="Cari Berdasarkan Id Invoice " name="keyword">
                   <button class="btn btn-outline-secondary mx-3"><i class="bi bi-search"></i></button>
                </form>
                </div>
            </div>

        </div>


       <!-- Clients Table -->
       <div class="card shadow-sm">
           <div class="card-body">
               <div class="table-responsive">
                   <table class="table table-hover">
                       <thead class="table-light">
                           <tr>
                               <th width="5%">ID</th>
                               <th width="15%">Clint_id</th>
                               <th width="20%">Tanggal</th>
                               <th width="15%">Total</th>
                               <th width="15%">Status</th>
                               {{-- <th width="15%">Last Activity</th> --}}
                               <th width="15%" class="text-end">Actions</th>
                           </tr>
                       </thead>
                       <tbody>
                        @foreach ($data_invoice as $item )


                           <tr>

                             <td>  <div class="d-flex align-items-center">
                                       <div class="client-avatar mx-1">{{ $item->id }}</div>
                                   </div> </td>



                                   
                               <td>
                                {{ $item->client_id }}

                               </td>
                               <td>
                                   <div>{{ $item->tanggal }}</</div>
                                   {{-- <small class="text-muted">Budi Santoso</small> --}}
                               </td>
                               <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                               {{-- <td>sukses</td> --}}
                               {{-- <td>2 days ago</td> --}}
                                      <td>
                                @if ($item->status == 'pending')

                                    <span class="badge rounded-pill bg-warning text-dark">Pending</span>
                                @elseif ($item->status == 'sukses')
                                    <span class="badge rounded-pill bg-success text-white">Success</span>
                                @else
                                    <span class="badge rounded-pill bg-danger text-white">Failed</span>
                                @endif
                                      </td>
                               <td class="text-end">
                                   <a href="/user/invoices/{{ $item->id }}/show" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-eye"></i></a>
                                   <a href="/user/invoices/{{ $item->id }}/edit" class="btn btn-sm btn-outline-warning me-1"><i class="bi bi-pencil"></i></a>


                                   <form action="/user/invoices/{{ $item->id }}" method="POST"    onsubmit="return confirm('Yakin hapus ID {{ $item->id }}?')" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                   <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                   </form>
                               </td>
                           </tr>
                           <!-- Tambahkan data lainnya di sini -->
                       </tbody>
                           @endforeach
                   </table>
                         {{ $data_invoice->links() }}
               </div>
           </div>
       </div>
   </div>



@stop


@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<style>


   .client-avatar {
       width: 40px;
       height: 40px;
       border-radius: 50%;
       background-color: #0d6efd;
       color: white;
       display: flex;
       align-items: center;
       justify-content: center;
       font-weight: bold;
   }
</style>
@stop


@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

   <script>
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @elseif (session('error'))
            toastr.error("{{ session('error') }}");
        @elseif (session('info'))
            toastr.info("{{ session('info') }}");
        @elseif (session('warning'))
            toastr.warning("{{ session('warning') }}");
        @endif
    </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stop


