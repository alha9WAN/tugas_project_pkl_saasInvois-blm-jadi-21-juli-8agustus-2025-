<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;

class UserPaketController extends Controller
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
        return view('user.paket.index',[
            'data_paket'=> $data_paket
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
           $data_paket = Paket::findOrfail($id);
        return view('user.paket.show',[
    'data_paket'=>$data_paket
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
