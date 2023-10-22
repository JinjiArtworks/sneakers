<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorOrder extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'pesanan_vendor';
    public function ownerVendor()
    {
        return $this->belongsTo(OwnerVendor::class);
    }
}
