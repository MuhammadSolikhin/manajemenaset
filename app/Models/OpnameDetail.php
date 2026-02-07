<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpnameDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function opname()
    {
        return $this->belongsTo(Opname::class);
    }

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }
}
