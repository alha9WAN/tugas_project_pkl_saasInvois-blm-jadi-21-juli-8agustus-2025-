<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserClientsController;
use App\Http\Controllers\UserdashboardController;
use App\Http\Controllers\UserInvoiceController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });






// login dan register
Route::redirect('/', '/login');

Route::get('/dashboard', function () {
    return view('admin.dashboard');  // ini view dashboard kamu sendiri
})->middleware(['auth', 'verified'])->name('dashboard');





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



// ROUTE MADDLAWRE ( ADMIN)
Route::middleware(['auth', 'role:admin'])->group(function () {
     Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/clients', fn() => view('admin.clients.index'))->name('clients.index');
    Route::get('/admin/invoices', fn() => view('admin.invoices.index'))->name('invoices.index');
    Route::get('/admin/paket', fn() => view('admin.paket.index'))->name('paket.index');






    // rooute crud clint
//route index(meampilkann halaman)
Route::get('/admin/clients',[ClientController::class, 'index']);


// route untuk tambah data
Route::get('/admin/clients/create',[ClientController::class, 'create']);//menapilkan data
Route::post('/admin/clients',[ClientController::class, 'store']);// mengelola proses tambah dataa
// route update data
Route::get('/admin/clients/{id}/edit',[ClientController::class, 'edit']);//untuk mengambil data yang
// akan diedit/menpilkan
Route::put('/admin/clients/{id}',[ClientController::class, 'update']);//untuk proses edit data
// route untuk detail
Route::get('/admin/clients/{id}/detail',[ClientController::class, 'show']);//untuk mengambil data yang akan ditampilkan mengambil berdasarkan id
// route hapus data
// id untuk memnggil/menghapus sesuai id
Route::delete('/admin/clients/{id}',[ClientController::class, 'destroy']);




// crud invois
//menalpilkan(dihalaman index)
Route::get('/admin/invoices',[InvoiceController::class, 'index']); // route utama nya (1)
// route tambah invois ,berikan name juga agar enak ketika dipanggil   (ini untuk manggil tampilannya)
Route::get('/admin/invoices/create',[InvoiceController::class, 'create'])->name('invoices.create');
//untuk proses tambah datanya nya
Route::post('/admin/invoices',[InvoiceController::class, 'store'])->name('invoices.store');
//untuk detail data
Route::get('/admin/invoices/{id}/show',[InvoiceController::class, 'show'])->name('invoices.show');
//untuk hapus data
Route::delete('/admin/invoices/{id}',[InvoiceController::class, 'destroy'])->name('invoices.destroy');
//untuk edit(menapilkan halaman edit)
Route::get('/admin/invoices/{id}/edit',[InvoiceController::class, 'edit'])->name('invoices.edit');
//untuk proses edit data
Route::put('/admin/invoices/{id}',[InvoiceController::class, 'update'])->name('invoices.update');
//cetak struk
Route::get('/admin/invoices/{id}/cetakStruk',[InvoiceController::class, 'cetakStruk'])->name('invoices.cetakStruk');




});












// strat halaman admin






















//invoices(route ke 2)
// mengarah ke folder user dan ke file indexnya
// Route::get('/admin/invoices', function () {
//    return view('admin.invoices.index');
// });




// end halaman admin





//strat halaman user

//user
// mengarah ke folder user dan ke file indexnya
Route::get('/admin/user', function () {
   return view('admin.user.index');
});


Route::get('/user/history', function () {
   return view('user.invoices.history');
});

// ROUTE MADDLAWRE ( USER)
//roite dashbord
Route::middleware(['auth', 'role:user'])->group(function () {
        // Route::get('/user/dashboard', fn() => view('user.dashboard'))->name('user.dashboard');
             Route::get('/user/dashboard', [UserdashboardController::class, 'index']);





            // rooute crud clint
//route index(meampilkann halaman)
Route::get('/user/clients',[UserClientsController::class,'index']);
Route::get('/user/clients/{id}/show',[UserClientsController::class,'show']);




  // rooute crud Invoice
  Route::get('/user/invoices',[UserInvoiceController::class,'index']);
  //menapilkan halaman tambah data
  Route::get('/user/invoices/create',[UserInvoiceController::class, 'create']);
  //untuk proses tambah data
  Route::post('/user/invoices',[UserInvoiceController::class ,'store']);
  //untuk detail/show data
Route::get('/user/invoices/{id}/show',[UserInvoiceController::class ,'show']);
//untuk hapus data
Route::delete('/user/invoices/{id}',[UserInvoiceController::class ,'destroy']);
//untuk update
//untuk edit(menapilkan halaman edit)
Route::get('/user/invoices/{id}/edit',[UserInvoiceController::class, 'edit']);
//untuk proses edit data
Route::put('/user/invoices/{id}',[UserInvoiceController::class, 'update']);
//route untuk cetak struk
Route::get('/user/invoices/{id}/cetakStruk',[UserInvoiceController::class, 'cetakStruk']);


// route fitur history
// rooute tampilkan data
  Route::get('/user/invoices/history',[UserInvoiceController::class,'history']);
//route mengeblikan data yg sdh dihapus
  Route::post('/user/invoices/{id}/restore',[UserInvoiceController::class,'restore']);
// route untuk hapus permanen
Route::delete('/user/invoices/{id}/forceDelete', [UserInvoiceController::class, 'forceDelete']);





});
