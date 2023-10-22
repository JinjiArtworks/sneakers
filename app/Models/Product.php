<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'produks';
    public function categories()
    {
        return $this->belongsTo(Categories::class);
    }
    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
    public function alergi()
    {
        return $this->belongsTo(Alergi::class);
    }
    public function detailproduk()
    {
        return $this->hasOne(DetailProduk::class);
    }
    public function orderdetail()
    {
        return $this->hasOne(OrderDetail::class);
    }
    public function wishlist()
    {
        return $this->hasOne(Wishlist::class);
    }
    public function reviews()
    {
        return $this->hasOne(Review::class);
    }
}
