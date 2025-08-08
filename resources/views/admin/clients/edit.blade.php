

@extends('adminlte::page')

@section('title', 'Clients Management')

@section('content_header')



@section('content')
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-user-plus me-2"></i>Edit Klien </h5>
            </div>
            <div class="card-body">
                <form action="/admin/clients/{{ $data_client->id }}" method="POST">
                    @csrf
                    @method('PUT')
                    <!-- Nama Klien -->
                    <div class="mb-3">
                        <label for="name" class="form-label"  >Nama Klien<span >*</span></label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $data_client->name }}" placeholder="Contoh: PT. Maju Jaya" >

                        @error('name')

                        <div class="from-text mt-1 text-danger">{{ $message }}</div>
                        @enderror



                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $data_client->email}}" placeholder="contoh@perusahaan.com">
                         @error('email')

                        <div class="from-text mt-1 text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Telepon -->
                    <div class="mb-3">
                        <label for="phone" class="form-label">Telepon</label>
                        <input type="tel" class="form-control" name="phone" id="phone" value="{{ $data_client->phone }}" placeholder="0812-3456-7890">
                         @error('phone')

                        <div class="from-text mt-1 text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="d-flex justify-content-between mt-4">
                        <a href="clients.html" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i> update Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop



@section('css')


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


