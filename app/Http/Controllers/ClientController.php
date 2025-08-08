<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {


        $search = $request->keyword;

        $data_client = Client::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")->orWhere('name', 'like', "{$search}");
        })->paginate(2);

        return view('admin.clients.index', [
            'data_client' => $data_client
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()

    {

        return view('admin.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd('berhasil');
        // validasitambh data

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        //    query tambah data
        Client::create([
            'user_id' => auth()->id(),  // otomatis ambil ID user login
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
        ]);

        // Berhasil
        return redirect('/admin/clients')->with('swal', [
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
        //mengambil data yang ada di model/tabel Client
        $data_client = Client::findOrfail($id);
        return view('admin.clients.detail',[
            'data_client'=> $data_client
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // mengambil data yang akan diedit
        $data_client =  Client::findOrfail($id);

        // arahkan ke halaman edit.blade.php
        return view('admin.clients.edit', [
            'data_client' => $data_client
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // membuat validasi
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
            ],
            //    menpilkan pesan
            [

                'name.required' => 'name wajib disi',
                'email.required' => 'email wajib disi',
                'phone.required' => 'phone wajib disi'

            ]

        );


        //proses update data dan dimasukan didatabase
        Client::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone

        ]);


        return redirect('/admin/clients')->with('swal', [
            'type' => 'success',
            'title' => 'Berhasil!',
            'text' => 'Data berhasil DiUpdate',
        ]);

        // Gagal
        return redirect()->back()->with('swal', [
            'type' => 'error',
            'title' => 'Gagal!',
            'text' => 'Data gagal DiUpdate',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Client::findOrfail($id)->delete();
    return redirect('/admin/clients')->with('swal', [
            'type' => 'success',
            'title' => 'Berhasil!',
            'text' => 'Data berhasil DI Hapus',
        ]);

        // Gagal
        return redirect()->back()->with('swal', [
            'type' => 'error',
            'title' => 'Gagal!',
            'text' => 'Data gagal Di Hapus',
        ]);    }
}