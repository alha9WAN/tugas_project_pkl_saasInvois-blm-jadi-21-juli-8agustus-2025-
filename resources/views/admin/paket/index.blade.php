@extends('adminlte::page')

@section('title', 'paket')

@section('content_header')
    <h1>Paket </h1>
@stop

@section('content')


    <div class="container-fluid">
        <!-- Toolbar -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addClientModal"> --}}
                {{-- <i class="bi bi-plus-circle me-1"></i> Add Invois --}}
            </button>
            {{-- <button type="button" class="btn btn-outline-secondary btn-sm">Export</button> --}}
        </div>

        <!-- Search & Filter -->
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search clients...">
                    <button class="btn btn-outline-secondary"><i class="bi bi-search"></i></button>
                </div>
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
                                <th width="15%">Name</th>
                                <th width="15%">Harga</th>
                                <th width="20%">Batas Invois</th>
                                {{-- <th width="15%">Assigned To</th>
                                <th width="15%">Last Activity</th> --}}
                                <th width="15%" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        {{-- <div class="client-avatar me-2">PT</div> --}}
                                        <div>invois basic</div>
                                    </div>
                                </td>
                                <td>

                                    <div>100000</div>
                                    {{-- <small class="text-muted">Budi Santoso</small> --}}

                                </td>
                                <td>10</td>
                                {{-- <td>John Doe</td> --}}
                                {{-- <td>2 days ago</td> --}}
                                <td class="text-end">
                                    <button class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-eye"></i></button>
                                    <button class="btn btn-sm btn-outline-warning me-1"><i class="bi bi-pencil"></i></button>
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                            <!-- Tambahkan data lainnya di sini -->
                        </tbody>
                    </table>
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
@stop
