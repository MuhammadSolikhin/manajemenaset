<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $guarded = ['id'];

    public function details()
    {
        return $this->hasMany(JournalDetail::class);
    }
}
