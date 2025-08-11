@extends('adminlte::page')

@section('title', 'paket')

@section('content_header')
    <h1>Paket </h1>
@stop

@section('content')


    <div class="container-fluid">
        <!-- Toolbar -->
        {{-- <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="/admin/paket/create" type="button" class="btn btn-primary"  > <i class="bi bi-plus-circle me-1"></i> Tambah Paket</a>
        </div> --}}

        <!-- Search & Filter -->
        <div class="row mb-3">
            <div class="col-md-6">
                <form action="">
                <div class="input-group ">
                    <input type="text" class="form-control" placeholder="Search Berdasarkan Nama Paket " name="keyword">
                    <button class="btn btn-outline-secondary mx-3"><i class="bi bi-search"></i></button>
                </div>
                </form>
            </div>
            <div class="col-md-6 text-end">

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
                                <th width="15%">Name</th>
                                <th width="15%">Harga</th>
                                <th width="20%">Batas Invois</th>
                                {{-- <th width="15%">Assigned To</th>
                                <th width="15%">Last Activity</th> --}}
                                <th width="15%" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_paket as $item )


                            <tr>
                                <td>  <div class="d-flex align-items-center">
                                        {{-- <div class="client-avatar me-2">PT</div> --}}
                                        <div>{{ $item->id }}</div>
                                    </div></td>
                                <td>
                                    {{ $item->nama }}
                                </td>
                                <td>

                                    <div>Rp {{ number_format($item->harga, 0, ',', '.') }}</div>

                                </td>
                                <td>{{ $item->batas_invoice }} Invoice</td>

                                <td class="text-end">
                                    <a href="/user/paket/{{ $item->id }}/show" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-eye"></i></a>

                                    {{-- <a href="/admin/paket/{{$item->id }}/edit" class="btn btn-sm btn-outline-warning me-1"><i class="bi bi-pencil"></i></a>

                                    <form action="/admin/paket/{{ $item->id }}" method="POST" onsubmit="return confirm('Yakin hapus ID {{ $item->id }}?')"  class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                    </form> --}}
                                </td>
                            </tr>
                            <!-- Tambahkan data lainnya di sini -->
                        </tbody>
                           @endforeach
                    </table>
                                    {{ $data_paket->links() }}

                </div>
            </div>
        </div>
    </div>


@stop

@section('css')
{{-- link bootrpas --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



{{-- swwealert --}}
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

@stop
