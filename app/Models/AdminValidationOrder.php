<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminValidationOrder extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'validation_admin';
    public function order()
    {
        return $this->belongsTo(Order::class); // ada order id di table ini
    }
}
