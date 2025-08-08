@extends('adminlte::page')

@section('title', 'invois')

@section('content_header')
    <h1>Invois </h1>
@stop

@section('content')

    @if (session('pesan'))
        <div class="alert alert-success">
            {{ session('pesan') }}
        </div>
    @endif


    <div class="container-fluid">
        <!-- Toolbar -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('invoices.create') }}" type="submit" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i> Add Invois
            </a>
            {{-- <button type="button" class="btn btn-outline-secondary btn-sm">Export</button> --}}
        </div>

        <!-- Search & Filter -->
        <form action="">
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control" name="keyword" placeholder="Search clients...">
                        <button class="btn btn-outline-secondary mx-2" type="submit"><i class="bi bi-search"></i></button>
                    </div>
                </div>
        </form>
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
    <div class="card shadow-sm ">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">ID</th>
                            <th width="15%">User_id</th>
                            <th width="20%">Client_id</th>
                            <th width="15%">Tanggal</th>
                            <th width="15%">Total</th>
                            <th width="15%">Status</th>
                            <th width="15%" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data_invoice as $item)
                            <tr>


                                 <td>  <div class="d-flex align-items-center">
                                       <div class="client-avatar mx-1">{{ $item->id }}</div>
                                   </div>
                                </td>

                                <td>
                                    <div class="d-flex align-items-center">
                                        {{-- <div class="client-avatar me-2">PT</div> --}}
                                        <div>{{ $item->user_id }}</div>
                                    </div>
                                </td>
                                <td>
                                    <div>{{ $item->client_id ?? '-' }}</div>
                                    {{-- <small class="text-muted">Budi Santoso</small> --}}
                                </td>
                                <td>{{ $item->tanggal }}</td>
                                <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>


                                {{-- agar bentuk nya bagus tambahkan:
                                        1..badge

Komponen dasar Bootstrap untuk menampilkan label/tag kecil

Memberikan style dasar seperti display: inline-block, padding, dan font-size
2..rounded-pill

Membuat sudut melengkung sempurna (border-radius 50%)

Membentuk seperti kapsul/pil
3.jarak didlm konten .py-1

Padding atas-bawah (y-axis) sebesar 0.25rem (4px)

Membuat badge tidak terlalu tinggi
4.mt jarak atas nya
                                --}}





{{--
                                <td class="badge rounded-pill bg-success text-white  py-1 mt-3" style="">
                                    {{ ucfirst($item->status) }}</td> --}}
                                     <td>
                                @if ($item->status == 'pending')

                                    <span class="badge rounded-pill bg-warning text-dark">Pending</span>
                                @elseif ($item->status == 'sukses')
                                    <span class="badge rounded-pill bg-success text-white">Success</span>
                                @else
                                    <span class="badge rounded-pill bg-danger text-white">Failed</span>
                                @endif


                                <td class="text-end ">
                                    {{-- dibungkus div agarsejajar bukan kebawah --}}
                                    <div class="d-flex justify-content-end mx-3 ">
                                        {{-- show --}}
                                        <a href="/admin/invoices/{{ $item->id }}/show"
                                            class="btn btn-sm btn-outline-primary me-3 "><i class="bi bi-eye"></i></a>
                                        {{-- edit --}}

                                        <form action="/admin/invoices/{{ $item->id }}/edit" class="d-inline">
                                            <button class="btn btn-sm btn-outline-warning me-3 "><i
                                                    class="bi bi-pencil"></i></button>
                                        </form>
                                        {{-- hapus --}}
                                        <form action="/admin/invoices/{{ $item->id }}" method="POST" onsubmit="return confirm('Yakin hapus ID {{ $item->id }}?')"   class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger"><i
                                                    class="bi bi-trash"></i></button>
                                        </form>
                                    </div>

                                </td>
                            </tr>
                        @empty
                            {{-- end froelse nya --}}
                        @endforelse
                    </tbody>
                </table>
                {{ $data_invoice->links() }}


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

    <style>
        /* Tambahkan spacing tambahan jika perlu */
        table.table td,
        table.table th {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        /* Untuk header */
        table.table thead th {
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
        }
    </style>


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

        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .arrow-box {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .arrow {
            font-size: 5rem;
            color: #1f2c3b;
            line-height: 1;
        }

        .input-line {
            border: 1px solid #ccc;
            width: 300px;
            margin-top: 20px;
            height: 40px;
            border-radius: 4px;
            padding: 0 10px;
            box-sizing: border-box;
        }
    </style>
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
