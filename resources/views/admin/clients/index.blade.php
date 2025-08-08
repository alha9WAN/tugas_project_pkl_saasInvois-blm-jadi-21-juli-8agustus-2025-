@extends('adminlte::page')

@section('title', 'Clients Management')

@section('content_header')
    <h1>Clients </h1>
@stop

@section('content')



    <div class="container-fluid">
        <!-- Toolbar -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addClientModal">
                <i class="bi bi-plus-circle me-1"></i> <a href="/admin/clients/create" style="color: white;   text-decoration: none;">Add Client</a>
            </button>
            {{-- <button type="button" class="btn btn-outline-secondary btn-sm">Export</button> --}}
        </div>

        <!-- Search & Filter -->
        <div class="row mb-3">
            <div class="col-md-6">
                <form  class="input-group"  >

                    <input name="keyword" type="text" class="form-control"  placeholder="Search clients...">
                    <button class="btn btn-outline-secondary mx-1" type="submit" ><i class="bi bi-search"></i></button>

                        @if (Request()->keyword != '')
                        {{-- JIKA keyword != '' penjelsan jika keyword tidak sama dengan(=)kosong
                        maka tampilkan a herf nya ,jika kosong makatidak ditampilkan --}}


                        <a href="/admin/clients" class="btn btn-outline-danger mx-1" type="submit" ><i class="bi bi-x-circle-fill"></i></a>

                        @endif



                </form>
            </div>
            <div class="col-md-6 text-end">
                {{-- <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="bi bi-funnel me-1"></i> Filter
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">All Clients</a></li>
                        <li><a class="dropdown-item" href="#">Active</a></li>
                        <li><a class="dropdown-item" href="#">Inactive</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">By User</a></li>
                    </ul>
                </div> --}}
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
                                <th width="15%">user_id</th>
                                <th width="20%">Name</th>
                                <th width="15%">email</th>
                                <th width="15%">Phone</th>
                                {{-- <th width="15%">Last Activity</th> --}}
                                <th width="15%" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>


@forelse ($data_client as $item )
       <tr>
                                 <td>  <div class="d-flex align-items-center">
                                       <div class="client-avatar mx-1">{{ $item->id }}</div>
                                   </div>
                                </td>
                                

                                <td>
                                    <div class="d-flex align-items-center">
                                     <div>{{ $item->user_id }}</div>
                                    </div>
                                </td>
                                <td>
                                <div>{{ $item->name }}</div>
                                </td>
                                <td>{{ $item->email }}</td>
                                 <td>{{ $item->phone }}</td>

                                <td class="text-end d-flex ">
                                    <a href="/admin/clients/{{ $item->id }}/detail" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-eye"></i></a>



                                    <a href="/admin/clients/{{ $item->id }}/edit" class="btn btn-sm btn-outline-warning mx-3" type="submit"><i class="bi bi-pencil"></i></a>


                                    {{-- delete --}}
                                    <form action="/admin/clients/{{ $item->id }} "    onsubmit="return confirm('Yakin hapus Nama {{ $item->name }}?')"  method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" type="submit"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            {{-- jika kosong --}}
                            <td colspan="5" class="text-center">Data yang anda cari tidak ditemukan</td>
@endforelse

                        </tbody>
                    </table>
                        {{ $data_client->links() }}

                </div>
            </div>
        </div>



    </div>

    <!-- Add Client Modal -->
    {{-- <div class="modal fade" id="addClientModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Client</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="clientName" class="form-label">Client Name</label>
                                <input type="text" class="form-control" id="clientName" required>
                            </div>
                            <div class="col-md-6">
                                <label for="clientType" class="form-label">Client Type</label>
                                <select class="form-select" id="clientType">
                                    <option>Company</option>
                                    <option>Individual</option>
                                    <option>Government</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="clientEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="clientEmail" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Save Client</button>
                </div>
            </div>
        </div>
    </div> --}}
@stop

@section('css')

{{-- notify --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">


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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('swal'))
<script>
    Swal.fire({
        icon: '{{ session('swal.type') }}',
        title: '{{ session('swal.title') }}',
        text: '{{ session('swal.text') }}',
    });
</script>
@endif







<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stop

