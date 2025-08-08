@extends('adminlte::page')

@section('title', 'Detail')

@section('content_header')
    <h1>Detail Invoice </h1>
@stop

@section('content')


<div class="card shadow rounded">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Detail Invoice</h4>
        <a href="/user/invoices/{{ $data_invoice->id }}/cetakStruk" class="btn btn-danger btn-sm">
            <i class="bi bi-file-earmark-pdf-fill"></i> Download PDF
        </a>
    </div>
    <div class="card-body">
        {{-- menggukan tanpa relasi --}}
            {{-- bgian data_invois --}}
        <div class="row g-3">
            {{-- <div class="col-md-6">
                <label class="form-label"></label>
                <input type="text" class="form-control" value="INV-00123" readonly>
            </div> --}}
            <div class="col-md-6">
                <label class="form-label">Tanggal Invoice</label>
                <input type="text" class="form-control" value="{{  $data_invoice->tanggal }}" disabled >
            </div>
            <div class="col-md-6">
                <label class="form-label">Nama Klien</label>
                <input type="text" class="form-control " value="{{  $data_invoice->client->name  }}"  disabled>
            </div>
            <div class="col-md-6">
                <label class="form-label">Total Pembayaran</label>
                <input type="text" class="form-control" value="{{  $data_invoice->total }}" disabled >
            </div>
            <div class="col-md-6">

                <label class="form-label">Status</label>
                <input type="text" class="form-control" value="{{  $data_invoice->status }}"  disabled>
            </div>
        </div>


        <hr class="my-4">

        <h5>Item dalam Invoice</h5>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                          <th>Deskripsi</th>

                        <th>Qty</th>
                        <th>Harga </th>
                        {{-- <th>Total</th> --}}
                    </tr>
                </thead>
                <tbody>


                        @foreach ( $data_invoice->InvoiceItem as $index => $item )


                    <tr>
                        <td>{{ $index + 1 }}</td>  {{-- unutk menpilkan no urut mulai dari no 1 --}}
                        <td>{{ $item->deskripsi  }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>{{ $item->harga }}</td>

                    </tr>
   @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4 d-flex justify-content-end">
            <a href="/admin/invoices" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
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
@stop
