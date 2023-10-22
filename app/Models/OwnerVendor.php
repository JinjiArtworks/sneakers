<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OwnerVendor extends Model
{
    use HasFactory;
    protected $table = 'vendor';
    protected $guarded = [];
    public function vendorOrder()
    {
        return $this->hasOne(VendorOrder::class);
    }
}
