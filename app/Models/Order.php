<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'pesanans';
    public function orderdetail()
    {
        return $this->hasOne(OrderDetail::class);
    }
    public function returns()
    {
        return $this->hasOne(Returns::class);
    }
}
