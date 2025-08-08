<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use App\Models\Invoice;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data_total = [
            'total_user' => User::count(),
            'total_client' => Client::count(),
            'total_invoice' => Invoice::count(),
        ];

        // Kirim variabel ke blade
        return view('admin.dashboard', [
            'data_total' => $data_total
        ]);
    }
}