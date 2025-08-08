<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 use Barryvdh\DomPDF\Facade\Pdf;


class UserInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {



        $search = $request->keyword;



        $data_invoice = Auth::user()->invoices()->when($search, function ($query, $search) {
            return $query->where('id', 'like', "%{$search}%")->orWhere('id', 'like', "%{$search}%");
        })
            ->latest()
            ->paginate(2);

        return view('user.invoices.index', [
            'data_invoice' => $data_invoice
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $clients = Client::all(); //


        return view('user.invoices.create', [
            'clients' => $clients
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validasi
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'tanggal' => 'required|date',
            'status' => 'required',
            'deskripsi.*' => 'required',
            'qty.*' => 'required|numeric|min:1',
            'harga.*' => 'required|numeric|min:0',
        ]);


        // hitung total

        $total = 0;

        foreach ($request->qty as $i => $qty) {
            $harga = $request->harga[$i]; // Ambil harga sesuai index
            $total += $qty * $harga;      // Kalikan qty dan harga lalu tambahkan ke total
        }





        $invoice = Invoice::create([
            'user_id' => Auth::id(), // AMBIL USER DARI YANG LOGIN
            'client_id' => $request->client_id,
            'tanggal' => $request->tanggal,
            'status' => $request->status,
            'total' => $total
        ]);




        //  Simpan item satu per satu ke tabel invoice_items
        foreach ($request->deskripsi as $i => $deskripsi) {
            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'deskripsi' => $deskripsi,
                'qty' => $request->qty[$i],
                'harga' => $request->harga[$i]
            ]);
        }

        //  Redirect setelah berhasil
        return redirect('/user/invoices')->with('success', 'Data client berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {



        $data_invoice = auth()->user()->invoices()->where('id', $id)->firstOrFail(); // akan 404 jika invoice bukan milik user

        return view('user.invoices.show', [
            'data_invoice' => $data_invoice
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {


        $clients = Client::all();
        //  $data_invoice = Invoice::with(['client', 'InvoiceItem'])->findOrFail($id);
        $data_invoice = Auth::user()->invoices()->with(['client', 'InvoiceItem'])->findOrFail($id);

        return view('user.invoices.edit', [
            'clients' => $clients,
            'data_invoice' => $data_invoice

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        // validasi
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'tanggal' => 'required|date',
            'status' => 'required',
            'deskripsi.*' => 'required',
            'qty.*' => 'required|numeric|min:1',
            'harga.*' => 'required|numeric|min:0',
        ]);

        // query hitung total
        $total = 0;

        foreach ($request->qty as $i => $qty) {
            $harga = $request->harga[$i]; // Ambil harga sesuai index
            $total += $qty * $harga;      // Kalikan qty dan harga lalu tambahkan ke total
        }

        // update data  data Invois
        Auth::user()->invoices()->where('id', $id)->update([
            'client_id' => $request->client_id,
            'tanggal' => $request->tanggal,
            'status' => $request->status,
            'total' => $total

        ]);

        // update data InvoisItem

        // Hapus semua item lama
        InvoiceItem::where('invoice_id', $id)->delete();

        // Tambahkan item baru
        foreach ($request->deskripsi as $i => $deskripsi) {
            InvoiceItem::create([
                'invoice_id' => $id,
                'deskripsi' => $deskripsi,
                'qty' => $request->qty[$i],
                'harga' => $request->harga[$i]
            ]);
        }

        return redirect('/user/invoices')->with('success', 'Data client berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //kode hapus data
        Invoice::findOrFail($id)->delete();
        return redirect('/user/invoices')->with('success', 'Data Invoice berhasil dihapus');
    }







    // 1. Menampilkan invoice yang sudah dihapus (soft delete)
    public function history(Request $request)
    {
                $search = $request->keyword;


        // untuk menapilkan data yang dihapus(dihalaman utama)ditampilkan di histroy
        $data_invoice = Invoice::onlyTrashed()->where('user_id', auth()->id())  ->when($search, function ($query, $search) {
           return $query->where('id', 'like', "%{$search}%")->orWhere('id', 'like', "%{$search}%");
       })
       ->paginate(1);

        return view('user.invoices.history', [
            'data_invoice' => $data_invoice
        ]);
    }
    // 2. Restore invoice yang sudah dihapus
    public function restore($id)
    {
        // untuk menggembalikan data yang dihapus
                $data_invoice = Invoice::onlyTrashed()->where('id', $id)->where('user_id', auth()->id())->firstOrFail();
                                                    $data_invoice->restore();



    return redirect('/user/invoices')->with('success', ' Data Invoice berhasil dikembalikan');
    }

    // 3. Hapus permanen invoice
    public function forceDelete($id)
    {
        // untuk hapus permanen
                        $data_invoice = Invoice::onlyTrashed()->where('id', $id)->where('user_id', auth()->id())->firstOrFail();
                                                        $data_invoice->forceDelete(); // untuk hapus data permanen

    return redirect('/user/invoices/history')->with('success', 'Invoice berhasil dihapus secara permanen');
        // return redirect('/user/invoices')->with('success', ' Data Invoice berhasil dihapus secara permanen');


    }





    public function cetakStruk($id)
    {
        //mengambil data data nya: dimodel Invois dan relasi clints dan Invioistem
        $data_invoice = Invoice::with(['client', 'InvoiceItem'])->where('user_id', auth()->id())->findOrFail($id);

            //proses cetak dan mengiri data ke from nya
        $pdf = Pdf::loadView('user.invoices.struk', [
            'data_invoice' => $data_invoice
        ]);

        // return view('user.invoices.struk');
        return $pdf->download("invoice_{$data_invoice->id}.pdf");

    }
}
