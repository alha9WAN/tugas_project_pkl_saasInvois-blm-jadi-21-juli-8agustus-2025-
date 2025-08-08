<?php

namespace App\Http\Controllers;
 use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Client;
use Illuminate\Support\Facades\Auth;

use App\Models\Invoice;
use App\Models\InvoiceItem;
// use Illuminate\Container\Attributes\Log;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request )
    {



        $search =$request->keyword;

        $data_invoice = Invoice::when($search, function ($query, $search){
            return $query->where('id','like',"%{$search}%")->orWhere('id','like',"{$search}");
        })->paginate(2);



        // $data_invoice = Invoice::paginate(2); // $data_incoice untuk menampung data
                                                //Invoice::get(); unutk mengambil dan mengambil data yanga ada di tabel/model invois

        return view('admin.invoices.index', [  // mengriim data ke index.blade
            'data_invoice'=> $data_invoice
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $clients = Client::all(); //
    return view('admin.invoices.create', [
        'clients'=> $clients
    ]);

        // return view('admin.invoices.create');
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
   return redirect('/admin/invoices')->with('success', 'Data client berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

 $data_invoice = Invoice::with(['client', 'InvoiceItem'])->findOrFail($id);


return view('admin.invoices.show',[
    'data_invoice'=> $data_invoice
]);
// bisa paaki ini
//  return view('admin.invoices.show', compact('data_invoice'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $clients = Client::all();
         $data_invoice = Invoice::with(['client', 'InvoiceItem'])->findOrFail($id);

        return view('admin.invoices.edit', [
            'data_invoice'=>$data_invoice,
            'clients'=>$clients
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
        Invoice::where('id',$id)->update([
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

    return redirect('/admin/invoices')->with('success', 'Data client berhasil diedit!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //kode hapus data
        Invoice::findOrFail($id)->delete();
 return redirect('/admin/invoices')->with('success', 'Data client berhasil dihapus');

    }


        public function cetakStruk($id)
        {
$data_invoice = Invoice::with(['client', 'InvoiceItem'])->findOrFail($id);

// dd($data_invoice); // ⬅️ Ini akan menampilkan seluruh data invoice + relasinya di browser, lalu berhenti di sini.

$pdf = Pdf::loadView('admin.invoices.struk', [
    'data_invoice' => $data_invoice
]);

return $pdf->download("invoice_{$data_invoice->id}.pdf");
        }
}
