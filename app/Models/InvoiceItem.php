<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $fillable = [

    'invoice_id', //untuk rlasi
    'deskripsi',
    'qty',
    'harga',

];

// disini ada frogrnkey invoice_id kita relasikan primarykry id di model invoice

public function invoice()
// ✔ Fungsi ini menjelaskan:
// "Satu item hanya milik satu invoice."
// (Contoh: beli Mouse Logitech masuk ke satu nota/invoice saja, bukan banyak. mouse nota sendri logitech nota sendri bukan seperti itu)


{
    return $this->belongsTo(Invoice::class);
}




}
