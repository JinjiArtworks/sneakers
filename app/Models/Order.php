<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'orders';
    public function orderdetail()
    {
        return $this->hasOne(OrderDetail::class);
    }
    public function validationAdmin()
    {
        return $this->hasOne(AdminValidationOrder::class);
    }
    public function returns()
    {
        return $this->hasOne(Returns::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class);
    }
    public function sellers() // penamaan model kalo bisa sesuai dengan kolom yg berelasi
    {
        return $this->belongsTo(User::class);
    }
}
