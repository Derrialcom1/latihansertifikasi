<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $fillable = ["user_id","nomor_kwh","alamat","id_tarif"];

    public function user()
    {
        return $this->belongTo(User::class);
    }
    public function tarif()
    {
        return $this->belongTo(Tarif::class);
    }
}
