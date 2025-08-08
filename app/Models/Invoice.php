<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;  //tambahkan itu

class Invoice extends Model
{


      use SoftDeletes; // ✅ Aktifkan SoftDeletes
      
    protected $fillable = [

    'user_id', //untuk rlasi
    'client_id',
    'tanggal',
    'total',
    'status'
];


// disini ada frogen key user_id dan clinet_id
//buar relasi nya


public function user()
{
    return $this->belongsTo(User::class);
}


public function client()
{
    return $this->belongsTo(Client::class);
}


// relasi many to one karena ini kan model invoice bisa memasukan berpa invoic_item(seperti tambah l
//aptop,mouse,kayak kasir satu nota bisa bnyak item nya)

    public function InvoiceItem()
    {
        return $this->hasMany(InvoiceItem::class);
    }
    // penjelasn 1 invois bisa berisi bnayk item(kayak kasir, 1 nota didlam nota aada barng brag yg dibeli seperti apel,mangga,dll)
}