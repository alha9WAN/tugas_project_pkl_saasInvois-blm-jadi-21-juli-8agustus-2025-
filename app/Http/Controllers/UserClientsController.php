<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class UserClientsController extends Controller
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


        return view('user.clients.index',[
            'data_client'=> $data_client
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

        $data_client = Client::findOrfail($id);
        return view('user.clients.show',[
            'data_client'=> $data_client
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
