<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


// kegunaan relasi ini untuk nanti ketika diindex dan show hanya menapilkan invoice yang login(yang akitf)
    public function invoices()
{
    return $this->hasMany(Invoice::class);
}


//kegunaan relasi ini untuk opsi yang ke 2 user bisa menambahkan Clints dan hanya bisa memilih Clint milik nya sendiri(yang dibuat)
// public function clients()
// {
//     return $this->hasMany(Client::class);
// }

}