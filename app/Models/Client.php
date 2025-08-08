<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
protected $fillable = [
    'user_id', //untuk rlasi
    'name',
    'email',
    'phone',
];


public function user()
{
    return $this->belongsTo(User::class);
}

// fungsi utamanya adalah untuk menghubungkan Client dengan User melalui kolom user_id.
//Bagaimana Cara Kerjanya?
// Di tabel clients ada kolom user_id.

// Relasi belongsTo(User::class) memberi tahu Laravel bahwa setiap Client dimiliki oleh 1 User.

// Jadi, ketika kita memanggil $client->user, Laravel otomatis mencari data user dengan id yang sama dengan user_id milik client tersebut.
}
