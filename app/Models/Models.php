<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Models extends Model
{
    use HasFactory;
    protected $table = 'models';
    protected $guarded = [];
    public function product()
    {
        return $this->hasMany(Product::class);
    }
    public function productSeller()
    {
        return $this->hasOne(ProductSeller::class);
    }
}
