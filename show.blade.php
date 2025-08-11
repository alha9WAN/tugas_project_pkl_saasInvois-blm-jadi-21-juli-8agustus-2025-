@extends('adminlte::page')

@section('title', 'Detail Paket - ' . $data_paket->nama)

@section('content_header')

@stop

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-box mr-2"></i>Informasi Paket
                    </h3>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <th width="35%" class="text-muted">ID Paket</th>
                                            <td>#PKT-{{ str_pad($data_paket->id, 3, '0', STR_PAD_LEFT) }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-muted">Nama Paket</th>
                                            <td>
                                                <strong>{{ $data_paket->nama }}</strong>

                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-muted">Harga</th>
                                            <td>
                                                <span class="badge bg-lightblue p-2">
                                                    <i class="fas fa-tag mr-1"></i> Rp {{ number_format($data_paket->harga, 0, ',', '.') }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-muted">Batas Invoice</th>
                                            <td>
                                                <span class="badge bg-info">
                                                    {{ $data_paket->batas_invoice }} Invoice
                                                </span>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-4 text-center d-flex flex-column justify-content-center">
                            <div class="mb-4">
                                <i class="fas fa-box-open fa-6x text-primary opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer text-right bg-white">
                    <a href="/user/paket" class="btn btn-default mr-2">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                    {{-- <a href="/admin/paket/{{ $data_paket->id }}/edit" class="btn btn-warning mr-2">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </a> --}}

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <style>
        .badge.bg-lightblue {
            background-color: #e3f2fd;
            color: #1976d2;
            padding: 0.35rem 0.75rem;
            border-radius: 50px;
            font-weight: 600;
        }
        .card-outline {
            border-top: 3px solid #007bff;
        }
        .table-borderless tbody tr td {
            padding: 0.75rem 0;
            border: none;
        }
        .table-borderless tbody tr:not(:last-child) td {
            border-bottom: 1px solid #f4f6f9;
        }
    </style>
@stop

@section('js')

@stop
