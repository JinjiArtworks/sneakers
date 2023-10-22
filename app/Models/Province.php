<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'provinsis';
    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
