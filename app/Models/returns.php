<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class returns extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(accounts::class, 'customerID');
    }

    public function details()
    {
        return $this->hasMany(return_details::class, 'returnID');
    }


}
