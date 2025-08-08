@extends('adminlte::page')

@section('title', 'Tambah Invois')

@section('content')

    <div class="container py-3">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0"><i class="fas fa-file-invoice me-2"></i>Invoice Baru</h3>
            </div>
            <div class="card-body">
                <form id="invoiceForm" action="/user/invoices" method="POST">
                    @csrf
                    <!-- Header Invoice -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="mt-1">
                                {{-- <label class="form-label">Klien <span class="text-danger">*</span></label> --}}
                                <br>
                                <label class="form-label">Klien <span class="text-danger">*</span></label>
                                <select class="form-select" id="client_id" name="client_id" required>
                                    <option value="" disabled selected>Pilih Klien</option>
                                    @foreach ($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                                    @endforeach
                                </select>


                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tanggal Invoice <span class="text-danger">*</span></label>
                                <input name="tanggal" type="date" class="form-control" id="tanggal" required>
                            </div>
                        </div>
                    </div>

                    <!-- Daftar Item -->
                    <div class="mb-4">
                        <h5 class="mb-3"><i class="fas fa-list-ul me-2"></i>Item Invoice</h5>
                        <div id="itemsContainer">
                            <div class="item-row row g-3 mb-3 align-items-center">
                                <div class="col-md-5">
                                    <input name="deskripsi[]" type="text" class="form-control"
                                        placeholder="Deskripsi Item" required>
                                </div>
                                <div class="col-md-2">
                                    <input name="qty[]" type="number" class="form-control" placeholder="Qty"
                                        min="1" value="1" required>
                                </div>
                                <div class="col-md-3 currency-input">
                                    <input name="harga[]" type="number" class="form-control" placeholder="Harga"
                                        min="0" required>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-danger btn-sm w-100" disabled>
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <button type="button" id="addItemBtn" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-plus me-1"></i>Tambah Item
                        </button>
                    </div>

                    <!-- Summary -->
                    <div class="row justify-content-end">
                        <div class="col-md-4">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    {{-- <tr>
                                        <th>Subtotal</th>
                                        <td id="subtotal">Rp0</td>
                                    </tr>
                                    <tr>
                                        <th>PPN (11%)</th>
                                        <td id="ppn">Rp0</td>
                                    </tr> --}}
                                    <tr class="table-active">
                                        <th>Total</th>
                                        <td id="total">Rp0</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Status & Tombol -->
                    <div class="row mt-4">
                        <div class="col-md-3">
                            <div class="mb-3">

                                @php
                                    $statusOptions = ['sukses' => 'Sukses', 'pending' => 'Pending'];
                                @endphp

                                <label class="form-label">Status</label>
                                <select class="form-select" id="status" name="status">
                                    @foreach ($statusOptions as $key => $label)
                                        <option value="{{ $key }}" {{ old('status', $invoice->status ?? '') == $key ? 'selected' : '' }}>{{ $label }}</option>

                                        @endforeach
                                    </select>

                            </div>
                        </div>
                        <div class="col-md-9 text-end">
                            <button type="button" class="btn btn-secondary me-2">
                                <i class="fas fa-times me-1"></i> Batal
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Simpan Invoice
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection




@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection

@section('js')
    <script>
        // Tambah Item Baru
        // Ganti bagian penambahan item dengan ini:
        document.getElementById('addItemBtn').addEventListener('click', function() {
            const newItem = `
        <div class="item-row row g-3 mb-3 align-items-center">
            <div class="col-md-5">
                <input name="deskripsi[]" type="text" class="form-control" placeholder="Deskripsi Item" required>
            </div>
            <div class="col-md-2">
                <input name="qty[]" type="number" class="form-control" placeholder="Qty" min="1" value="1" required>
            </div>
            <div class="col-md-3 currency-input">
                <input name="harga[]" type="number" class="form-control" placeholder="Harga" min="0" required>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-sm w-100 remove-item">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>`;
            document.getElementById('itemsContainer').insertAdjacentHTML('beforeend', newItem);
        });

        // Hapus Item
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-item')) {
                e.target.closest('.item-row').remove();
                calculateTotal();
            }
        });

        // Hitung Total
        function calculateTotal() {
            let subtotal = 0;
            document.querySelectorAll('.item-row').forEach(row => {
                const qtyInput = row.querySelector('input[type="number"]:nth-of-type(1)');
                const priceInput = row.querySelector('.currency-input input');

                const qty = parseFloat(qtyInput.value) || 0;
                const price = parseFloat(priceInput.value) || 0;
                subtotal += qty * price;
            });

            // Total sama dengan subtotal jika tidak ada PPN
            const total = subtotal;

            document.getElementById('total').textContent = formatCurrency(total);
        }

        // Format Mata Uang
        function formatCurrency(amount) {
            return 'Rp' + amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        }

        // Event Listener untuk Kalkulasi
        document.getElementById('itemsContainer').addEventListener('input', calculateTotal);


        // belum dipakai

        //         document.getElementById('cancelBtn').addEventListener('click', function() {
        //   if(confirm('Batalkan pembuatan invoice?')) {
        //     window.location.href = '/invoices'; // Ganti dengan URL tujuan
        //   }
        // });
    </script>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if(session('success'))
            toastr.success("{{ session('success') }}");
        @elseif(session('error'))
            toastr.error("{{ session('error') }}");
        @elseif(session('info'))
            toastr.info("{{ session('info') }}");
        @elseif(session('warning'))
            toastr.warning("{{ session('warning') }}");
        @endif
    </script>



@stop
