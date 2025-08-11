

@extends('adminlte::page')

@section('title', 'Paket Management')

@section('content_header')



@section('content')
   <div class="container mt-5">
       <div class="card shadow">
           <div class="card-header bg-primary text-white">
               <h5 class="mb-0"><i class="fas fa-box me-2"></i>+ Tambah  Paket  Baru</h5>
           </div>
           <div class="card-body">
               <form action="/admin/paket" method="POST">
                @csrf


                   <div class="mb-3">
                       <label for="name" class="form-label" value="" >Nama Paket<span >*</span></label>
                       <input type="text" class="form-control"  name="nama" value="" placeholder="Contoh: Paket Besic" required >
                   </div>




                   <div class="mb-3">
                       <label for="email" class="form-label">Harga</label>
                       <input type="number" class="form-control" name="harga"  value=""placeholder="contoh 100.000" required>
                   </div>


                    <div class="mb-3">
                       <label for="phone" class="form-label">Batas Invoice</label>
                       <input type="number" class="form-control" name="batas_invoice" value=""placeholder=" contoh 5" required>
                   </div>











                   <!-- Tombol Aksi -->
                   <div class="d-flex justify-content-between mt-4">
                       <a href="" class="btn btn-outline-secondary">
                           <i class="fas fa-arrow-left me-2"></i> Kembali
                       </a>
                       <button type="submit" class="btn btn-primary">
                           <i class="fas fa-save me-2"></i> Tambah  Data
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

@stop


