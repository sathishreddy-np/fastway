<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BitToken extends Model
{
    use HasFactory;
    public function bitcoin(){
        return $this->belongsTo(Bitcoin::class);
    }
}
