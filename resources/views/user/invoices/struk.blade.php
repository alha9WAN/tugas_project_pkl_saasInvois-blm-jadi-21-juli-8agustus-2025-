<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Pembayaran</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            max-width: 400px;
            margin: 0 auto;
            padding: 15px;
            color: #333;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 2px solid #4CAF50;
        }
        .logo {
            max-width: 150px;
            height: auto;
            margin-bottom: 10px;
        }
        .header h2 {
            margin: 5px 0;
            font-size: 22px;
            color: #4CAF50;
        }
        .contact-info {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }
        .title {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 8px 0;
            margin: 15px 0;
            border-radius: 4px;
            font-size: 16px;
        }
        .invoice-info {
            margin-bottom: 15px;
            font-size: 14px;
        }
        .invoice-info p {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            margin-bottom: 15px;
        }
        table th {
            background-color: #f5f5f5;
            font-weight: bold;
            padding: 8px;
            text-align: left;
        }
        table td {
            padding: 8px;
            border-bottom: 1px solid #eee;
        }
        .total-section {
            text-align: right;
            margin: 15px 0;
            padding-top: 10px;
            border-top: 2px dashed #4CAF50;
        }
        .total-line {
            font-weight: bold;
            margin: 5px 0;
        }
        .signature {
            text-align: center;
            margin-top: 30px;
        }
        .signature-line {
            width: 200px;
            border-top: 1px solid #000;
            margin: 0 auto 5px auto;
        }
        .signature-name {
            font-weight: bold;
        }
        .signature img.sign-img {
            height: 50px;
            margin-bottom: 5px;
        }
        .footer {
            text-align: center;
            font-size: 11px;
            color: #777;
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px dashed #ccc;
        }
        .payment-method {
            margin: 15px 0;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 4px;
            font-size: 13px;
        }
        .highlight {
            color: #4CAF50;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="header">
        {{-- <img src="https://www.flaticon.com/free-icon/invoice_2490380?term=invoice&page=1&position=24&origin=tag&related_id=2490380" alt="" class="logo"> --}}
        <img src="https://cdn-icons-png.flaticon.com/512/2490/2490380.png" alt="Invoice Logo" class="logo">
        <h2>Invoice</h2>
        <p class="contact-info">Jl. kayi agneg No. 123, Jakarta | Telp: (021) 1234567<br>Email: wan@gamil.com</p>
    </div>

    <div class="title">
        <h3>STRUK PEMBAYARAN</h3>
    </div>

    <div class="invoice-info">
        <p><strong>No. Invoice:</strong> INV-{{ $data_invoice->id }}</p>
        <p><strong>Tanggal:</strong> {{ $data_invoice->tanggal }}</p>
        <p><strong>Nama Pasien:</strong> {{ $data_invoice->client->name }}</p>
        {{-- <p><strong>Dokter:</strong> Dr. {{ $data_invoice->dokter->name ?? 'Umum' }}</p> --}}
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Layanan/Produk</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data_invoice->invoiceItem as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->deskripsi }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td>Rp{{ number_format($item->qty * $item->harga, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-section">
        {{-- <div class="total-line">Subtotal: Rp{{ number_format($data_invoice->total, 0, ',', '.') }}</div>
        <div class="total-line">Diskon: Rp0</div>
        <div class="total-line" style="font-size: 15px; color: #4CAF50;">TOTAL: Rp{{ number_format($data_invoice->total, 0, ',', '.') }}</div> --}}
    </div>

    {{-- <div class="payment-method">
        <strong>Metode Pembayaran:</strong> Tunai<br>
        <strong>Dibayar:</strong> Rp{{ number_format($data_invoice->total, 0, ',', '.') }}<br>
        <strong>Kembalian:</strong> Rp0
    </div> --}}

    <div class="signature">
        <div style="margin-bottom: 10px;">Jakarta, {{ date('d F Y') }}</div>
        {{-- <img src="{{ asset('img/kasir.png') }}" alt="Tanda Tangan" class="sign-img"> --}}
        <div class="signature-line"></div>
        <div class="signature-name">Nama Kasir</div>
        <div>Staff Administrasi</div>
    </div>

    <div class="footer">
        <p><span class="highlight">Terima kasih atas kunjungan Anda</span></p>
        <p>Struk ini merupakan bukti pembayaran yang sah</p>
        <p>Simpan struk ini untuk keperluan garansi atau pengaduan</p>
        <p><em>Melayani dengan Sepenuh Hati</em></p>
    </div>

</body>
</html>
