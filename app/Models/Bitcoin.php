<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bitcoin extends Model
{
    use HasFactory;

    public function bittokens(){
        return $this->hasMany(BitToken::class);
    }
}
