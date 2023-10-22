<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alergi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'alergi';
    public function detail_produk()
    {
        return $this->hasOne(DetailProduk::class);
    }
    public function product()
    {
        return $this->hasOne(Alergi::class);
    }
}
