<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class counter_transaction extends Model
{
    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'id');
    }

    public function account()
    {
        return $this->belongsTo(accounts::class, 'accountID', 'id');
    }
}
