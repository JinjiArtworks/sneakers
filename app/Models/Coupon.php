<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $table = 'kupons';
    protected $guarded = [];
    public function product()
    {
        return $this->hasOne(Product::class);
    }
}
