<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;

class AdminPaketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

                $search = $request->keyword;


        $data_paket = Paket::when($search, function ($query, $search) {
           return $query->where('nama', 'like', "%{$search}%")->orWhere('nama', 'like', "{$search}");
       })->paginate(2);
        return view('admin.paket.index',[
            'data_paket'=> $data_paket
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //untuk menpilkan halaman tambah data
        return view('admin.paket.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //untuk proses tambah data
           $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'batas_invoice' => 'required',
        ]);

        //    query tambah data ke database
        Paket::create([
            'nama'    => $request->nama,
            'harga'   => $request->harga,
            'batas_invoice'   => $request->batas_invoice,

        ]);




    // return redirect('/admin/paket')->with('success', 'Data Paket Berhasil Ditambahkan');
        return redirect('/admin/paket')->with('swal', [
            'type' => 'success',
            'title' => 'Berhasil!',
            'text' => 'Data berhasil Ditambahkan',
        ]);

        // Gagal
        return redirect()->back()->with('swal', [
            'type' => 'error',
            'title' => 'Gagal!',
            'text' => 'Data gagal Ditambahkan',
        ]);


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data_paket = Paket::findOrfail($id);
        return view('admin.paket.show',[
    'data_paket'=>$data_paket
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {


        $data_paket = Paket::findOrfail($id);
        return view('admin.paket.edit',[
            'data_paket'=>$data_paket
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validasi
              $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'batas_invoice' => 'required',
        ]);


        //proses update data
        Paket::where('id',$id)->update([// untuk mengupdate sesaui id
             'nama' => $request->nama,
            'harga' => $request->harga,
            'batas_invoice' => $request->batas_invoice


        ]);

    // return redirect('/admin/paket')->with('success', 'Data Paket Berhasil Diupdate');
        return redirect('/admin/paket')->with('swal', [
            'type' => 'success',
            'title' => 'Berhasil!',
            'text' => 'Data berhasil Di Update',
        ]);

        // Gagal
        return redirect()->back()->with('swal', [
            'type' => 'error',
            'title' => 'Gagal!',
            'text' => 'Data gagal Di Update ',
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Paket::findOrfail($id)->delete();
        // return redirect('/admin/paket')->with('success', 'Data Paket Berhasil Dihapus');
            return redirect('/admin/paket')->with('swal', [
            'type' => 'success',
            'title' => 'Berhasil!',
            'text' => 'Data berhasil Di Hapus',
        ]);

        // Gagal
        return redirect()->back()->with('swal', [
            'type' => 'error',
            'title' => 'Gagal!',
            'text' => 'Data gagal Di Hapus',
        ]);

    }


}
