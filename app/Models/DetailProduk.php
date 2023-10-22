<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailProduk extends Model
{
    use HasFactory;
    protected $table = 'detail_produks';
    protected $guarded = [];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function alergi()
    {
        return $this->belongsTo(Alergi::class);
    }
}
