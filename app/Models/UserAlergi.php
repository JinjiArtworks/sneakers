<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAlergi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'users_alergi';

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
